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
namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use app\common\model\digitalhuman\DhVoice;
use app\common\model\user\User;
use app\common\service\ConfigService;
use think\facade\Db;
use think\facade\Log;

class YDNotifyController extends BaseApiController
{
    public array $notNeedLogin = ['scene', 'video', 'professionalClone'];

    /**
     * 场景回调
     * @author:1950781041@qq.com 
     * @Date:2024-11-11
     */
    public function scene()
    {
        $data = $this->getRequestData();
        Log::info('ydScene: ' . json_encode($data));
        $sceneInfo = DhScene::where('task_id', $data['data']['scene_task_id'])->find();
        if (!$sceneInfo) {
            Log::error('未找到场景信息: ' . $data['data']['scene_task_id']);
            return;
        }

        $coverImageUrl = $this->saveCoverImage(
            $data['data']['coverUrl'],
            'scene',
            $data['data']['scene_task_id']
        );
        Db::startTrans();
        try {
            $sceneInfo->status = ($data['code'] == 200) ? 2 : 3;
            if ($data['code'] == 200) {
                $sceneInfo->api_video_url = $data['data']['videoUrl'];
                $sceneInfo->cover_image = $coverImageUrl;
                $sceneInfo->scene_id = $data['data']['sceneId'];
                $scene_points = ConfigService::get('create', 'scene_points');
                User::where('id', $sceneInfo->uid)->dec('points', $scene_points)->update();
                AccountLogLogic::add(
                    $sceneInfo->uid,
                    AccountLogEnum::PM_DEC_SCENE_CREATE,
                    AccountLogEnum::DEC,
                    $scene_points,
                    '',
                    '场景复刻',
                    []
                );
            }
            $sceneInfo->save();
            Db::commit();
        } catch (\Throwable $e) {
            Db::rollback();
            Log::error('更新数据库失败: ' . $data['data']['scene_task_id']);
            return;
        }
    }

    /**
     * 视频回调
     * @author:1950781041@qq.com 
     * @Date:2024-11-11
     */
    public function video()
    {
        $data = $this->getRequestData();
        Log::info('ydVideo: ' . json_encode($data));
        if (!isset($data['data']['video_task_id'])) {
            Log::error('未找到video_task_id');
            return $this->fail('未找到video_task_id');
        }
        $video = DhVideo::where('task_id', $data['data']['video_task_id'])->find();
        if (!$video) {
            Log::error('未找到创作记录: ' . $data['data']['video_task_id']);
            return $this->fail('未找到创作记录');
        }
        Db::startTrans();
        try {
            if ($data['code'] == 200) {
                $create_points = ConfigService::get('create', 'create_points');
                $points =  ceil($data['data']['duration']) * $create_points;
                $coverImageUrl = $this->saveCoverImage(
                    $data['data']['coverUrl'],
                    'video',
                    $data['data']['video_task_id']
                );
                $video->status = 2;
                $video->api_video_url = $data['data']['videoUrl'];
                $video->duration = $data['data']['duration'];
                $video->cover_image = $coverImageUrl;
                $video->points = $points;
                if ($points > 0) {
                    User::where('id', $video->uid)->dec('points', $points)->update();
                    AccountLogLogic::add(
                        $video->uid,
                        AccountLogEnum::PM_DEC_VIDEO_CREATE,
                        AccountLogEnum::DEC,
                        $points,
                        '',
                        '视频创建',
                        []
                    );
                }
            } elseif ($data['code'] == 400) {
                $video->status = 3;
            }
            $video->save();
            Db::commit();
            return $this->success('');
        } catch (\Throwable $e) {
            Db::rollback();
            Log::error('更新数据库失败: ' . $data['data']['video_task_id']);
            return $this->fail($e->getMessage());
        }
    }

    /**
     *  获取请求数据
     * @author:1950781041@qq.com 
     * @Date:2024-11-11
     */
    private function getRequestData()
    {
        $data = $this->request->post();
        return is_string($data) ? json_decode($data, true) : $data;
    }


    /**
     * 保存封面图
     * @author:1950781041@qq.com 
     * @Date:2024-11-11
     */
    private function saveCoverImage($coverUrl, $type, $taskId)
    {
        $coverDir = public_path("/uploads/digitalhuman/{$type}/cover");
        $coverImagePath = "{$coverDir}/{$taskId}.png";
        $coverImageUrl = "/uploads/digitalhuman/{$type}/cover/{$taskId}.png";

        if (!is_dir($coverDir)) {
            mkdir($coverDir, 0777, true);
        }

        $coverContent = file_get_contents($coverUrl);
        if ($coverContent !== false) {
            file_put_contents($coverImagePath, $coverContent);
        } else {
            Log::error("封面图错误: {$coverUrl}");
        }

        return $coverImageUrl;
    }



    /**
     * 克隆声音回调
     * @author:1950781041@qq.com 
     * @Date:2024-11-11
     */
    public function professionalClone()
    {
        $data = $this->getRequestData();
        Log::info('ydProfessionalClone: ' . json_encode($data));
        $voice = DhVoice::where('task_id', $data['task_id'])->find();
        if (!$voice) {
            Log::error('未找到创作记录: ' . $data['task_id']);
            return $this->fail('未找到创作记录');
        }
        if ($data['status'] == 1) {
            $voice->status = 2;
        } else {
            $voice->status = 3;
        }
        $voice->save();
    }
}
