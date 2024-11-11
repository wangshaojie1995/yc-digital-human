<?php
// +----------------------------------------------------------------------
// | 贵州猿创科技 [致力于通过产品和服务，帮助创业者高效化开拓市场]
// +----------------------------------------------------------------------
// | Copyright(c)2019~2024 https://xhadmin.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed 这不是一个自由软件，不允许对程序代码以任何形式任何目的的再发行
// +----------------------------------------------------------------------
// | Author:贵州猿创科技<416716328@qq.com>|<Tel:18786709420>
// +----------------------------------------------------------------------
namespace app\api\logic\digitalhuman;

use app\api\logic\UserLogic;
use app\api\service\digitalhuman\YiDingSevice;
use app\api\service\digitalhuman\GuiJiService;
use app\common\logic\BaseLogic;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use app\common\service\ConfigService;
use app\common\service\FileService;
use think\facade\Db;

class VideoLogic extends BaseLogic
{

    public static function create($data)
    {
        $createInfo = ConfigService::get('create');
        $create_points = $createInfo['create_points'];
        $create_voice_type = $createInfo['voice_type'];
        $number = $createInfo['video_number'] ?? 1;
        $type = $createInfo['type'];
        $channel = $createInfo['channel'] ?? 1;
        if ($create_points > 0) {
            $user = UserLogic::info($data['uid']);
            if ($user['points'] < $create_points) {
                throw new \Exception('算力点不足');
            }
        }
        $count = DhVideo::where('uid', $data['uid'])->where('status', '1')->count();
        if ($count >= $number) {
            throw new \Exception('有视频在生成中，请稍后再试');
        }
        Db::startTrans();
        try {
            $scene = DhScene::where('id', $data['scene_id'])->where('type', $type)->find();

            if (!$scene) {
                throw new \Exception('场景不存在');
            }
            if ($channel == 3 && $scene->channel != 3) {
                throw new \Exception('场景不匹配,请重新选择');
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
            switch ($type) {
                case 'yiding':
                    $ydService = $ydService ?? new YiDingSevice();
                    $task_id = $ydService->createVideo($scene_id, $local_voice_url, $channel);
                    break;
                case 'guiji':
                    $gjService = new GuiJiService();
                    $task_id = $gjService->createVideo($data['name'], $scene_id, $local_voice_url);
                    break;
                default:
                    throw new \Exception('系统未配置渠道');
                    break;
            }
            $arr = [
                'name' => $data['name'],
                'uid' => $data['uid'],
                'task_id' => $task_id,
                'channel' => $channel,
                'scene_id' => $scene_id,
                'text' => $data['text'] ?? '',
                'local_voice_url' => $local_voice_url,
                'local_video_url' => $scene->api_video_url
            ];
            DhVideo::create($arr);
            Db::commit();
        } catch (\Throwable $e) {
            Db::rollback();
            throw new \Exception('失败：' . $e->getMessage() . $e->getLine() . $e->getFile());
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

        $createInfo = ConfigService::get('create');
        $create_points = $createInfo['create_points'];
        if ($create_points > 0) {
            $user = UserLogic::info($uid);
            if ($user['points'] < $create_points) {
                throw new \Exception('算力点不足');
            }
        }
        $number = $createInfo['video_number'] ?? 1;
        $type = $createInfo['type'];
        $channel = $createInfo['channel'] ?? 1;
        $count = DhVideo::where('uid', $uid)->where('status', '1')->count();
        if ($count >= $number) {
            throw new \Exception('等待视频生成中，请稍后再试');
        }
        $video = DhVideo::where('id', $id)->where('uid', $uid)->find();
        if (!$video) {
            throw new \Exception('视频不存在');
        }
        if ($video->status != 3) {
            throw new \Exception('状态错误');
        }
        $type = ConfigService::get('create', 'type');
        switch ($type) {
            case 'yiding':
                $ydService = $ydService ?? new YiDingSevice();
                $task_id = $ydService->createVideo($video->scene_id, $video->local_voice_url, $channel);
                break;
            case 'guiji':
                $gjService = new GuiJiService();
                $task_id = $gjService->createVideo($video->name, $video->scene_id, $video->local_voice_url);
                break;
        }
        $video->task_id = $task_id;
        $video->status = '1';
        $video->save();
        return true;
    }
}
