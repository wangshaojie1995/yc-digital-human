<?php

namespace app\api\logic\digitalhuman;

use app\api\logic\UserLogic;
use app\api\service\digitalhuman\YiDingSevice;
use app\api\service\digitalhuman\GuiJiService;
use app\common\logic\BaseLogic;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use app\common\service\ConfigService;
use app\common\service\FileService;
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\user\User;
use think\facade\Db;

class VideoLogic extends BaseLogic
{

    public static function create($data)
    {
        $create_points = ConfigService::get('create', 'create_points');
        $create_voice_type = ConfigService::get('create', 'voice_type');
        $type = ConfigService::get('create', 'type');
        if ($create_points > 0) {
            $user = UserLogic::info($data['uid']);
            if ($user['points'] < $create_points) {
                throw new \Exception('算力点不足');
            }
        }

        Db::startTrans();
        try {
            $scene = DhScene::where('id', $data['scene_id'])->find();

            if (!$scene) {
                throw new \Exception('场景不存在');
            }

            if ($data['voice_type'] == 1) {
                $local_voice_url =   FileService::getFileUrl($data['local_voice_url']);
            }

            if ($data['voice_type'] == 2) {
                if ($create_voice_type == 'yiding') {
                    $local_voice_url =   (new YiDingSevice())->synthesisVoice($data['text'], $data['voice_id']);
                }
            }


            $scene_id = $scene->scene_id;
            $task_id = null;

            switch($type){
                case 'yiding':
                    $ydService = $ydService ?? new YiDingSevice();
                    $task_id = $ydService->createVideo($scene_id, $local_voice_url);
                    break;
                case 'guiji':
                    $gjService = new GuiJiService();
                    $task_id = $gjService->createVideo($data['name'], $scene_id, $local_voice_url);
                    break;
            }

         
            $arr = [
                'name' => $data['name'],
                'uid' => $data['uid'],
                'task_id' => $task_id,
                'scene_id' => $scene_id,
                'text' => $data['text'] ?? '',
                'local_voice_url' => $local_voice_url,
                'local_video_url' => $scene->api_video_url
            ];
            User::where('id', $data['uid'])->dec('points', $create_points)->update();
            AccountLogLogic::add(
                $data['uid'],
                AccountLogEnum::PM_DEC_VIDEO_CREATE,
                AccountLogEnum::DEC,
                $create_points,
                '',
                '视频创建',
                []
            );
            DhVideo::create($arr);
            Db::commit();
        } catch (\Throwable $e) {
            Db::rollback();
            throw new \Exception('复刻失败：' . $e->getMessage().$e->getLine().$e->getFile());
        }
    }



    public static function del($id)
    {
        $result = DhVideo::destroy($id);
        return $result;
    }


    public static function rename($id, $name)
    {
        $result = DhVideo::update(['name' => $name], ['id' => $id]);
        return $result;
    }



    public static function retry($id, $uid)
    {
        $video = DhVideo::where('id', $id)->where('uid', $uid)->find();
        if (!$video) {
            throw new \Exception('视频不存在');
        }
        if ($video->status != 3) {
            throw new \Exception('状态错误');
        }

        $type = ConfigService::get('create', 'type');
 
        switch($type){
            case 'yiding':
                $ydService = $ydService ?? new YiDingSevice();
                $task_id = $ydService->createVideo($video->scene_id, $video->local_voice_url);
                break;
            case 'guiji':
                $gjService = new guijiService();
                $task_id = $gjService->createVideo($video->name, $video->scene_id, $video->local_voice_url);
                break;
        }
         
        
        $video->task_id = $task_id;
        $video->status = '1';
        $video->save();
        return true;
    }
}
