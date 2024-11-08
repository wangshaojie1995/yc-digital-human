<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
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
        return  $this->success('');
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

        if ($data['data']['result'] == 'success') {
            $video->status = '2';
            $video->api_video_url = $data['data']['videoUrl'];
            $video->cover_image = $data['data']['coverUrl'];
            $video->duration = $data['data']['duration'];
        } elseif ($data['code'] == 400) {
            $video->status = '3';
            $video->message = $data['data']['reason'];
        }
        $video->save();
    }
}
