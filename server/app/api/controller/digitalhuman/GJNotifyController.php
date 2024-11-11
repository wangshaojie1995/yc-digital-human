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
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\user\User;
use app\common\service\ConfigService;
use think\facade\Db;
use think\facade\Log;

class GJNotifyController extends BaseApiController
{
    public array $notNeedLogin = ['video', 'scene'];

    public function scene()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('gjScene: ' . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'video-training') {
            return;
        }
        $scene = DhScene::where('task_id', $data['data']['id'])->find();
        if (!$scene) {
            Log::error('未找到创作记录: ' . $data['data']['id']);
            return;
        }
        Db::startTrans();
        try {
            if ($data['data']['result'] == 'success') {
                $scene->status = '2';
                $scene->cover_image = $data['data']['coverUrl'];
                $scene->robotid = $data['data']['robotId'];
                $scene->scene_id = $data['data']['sceneId'];
            }
            if ($data['data']['result'] == 'fail') {
                $scene->status = '3';
                $scene->message = $data['data']['reason'];
            }
            $scene->save();
            $scene_points = ConfigService::get('create', 'scene_points');
            if ($scene_points > 0) {
                User::where('id', $scene->uid)->dec('points', $scene_points)->update();
                AccountLogLogic::add(
                    $scene->uid,
                    AccountLogEnum::PM_DEC_SCENE_CREATE,
                    AccountLogEnum::DEC,
                    $scene_points,
                    '',
                    '场景复刻',
                    []
                );
            }
            Db::commit();
        } catch (\Throwable $e) {
            Db::rollback();
            Log::error('更新数据库失败 GJSCENE: '  . $e->getMessage());
            return $this->fail($e->getMessage());
        }
    }



    public function video()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('gjVideo: ' . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        if ($data['taskType'] != 'video-synthesis') {
            return $this->success();
        }
        $video = DhVideo::where('task_id', $data['data']['id'])->find();

        if (!$video) {
            Log::error('未找到创作记录: ' . $data['data']['id']);
            return $this->success();
        }
        Db::startTrans();
        try {
            if ($data['data']['result'] == 'success') {
                $video->status = '2';
                $video->api_video_url = $data['data']['videoUrl'];
                $video->cover_image = $data['data']['coverUrl'];
                $video->duration = $data['data']['duration'];
                $create_points = ConfigService::get('create', 'create_points');
                $points =  ceil($data['data']['duration']) * $create_points;
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
                $video->status = '3';
                $video->message = $data['data']['reason'];
            }
            $video->save();
            Db::commit();
            return $this->success();
        } catch (\Throwable $e) {
            Db::rollback();
            Log::error('更新数据库失败 GJVIDEO: ' . $e->getMessage());
            return $this->fail($e->getMessage());
        }
    }
}
