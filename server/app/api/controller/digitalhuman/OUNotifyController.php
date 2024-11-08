<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\api\service\digitalhuman\OUService;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use app\common\model\digitalhuman\DhVoice;
use think\facade\Log;

class OUNotifyController extends BaseApiController
{
    public array $notNeedLogin = ['trainingVioce', 'voice', 'trainingScene', 'v4Video', 'v5Video'];

    public function trainingVioce()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('ouTrainingVoice', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'tts-model') {
            return;
        }
        $voice = DhVoice::where('task_id', $data['data']['speaker_id'])->find();
        if (!$voice) {
            return;
        }
        if ($data['data']['zstatus'] == '2') {
            $voice->status = '2';
            $voice->voice_id = $data['data']['model_id'];
        }
        if ($data['data']['zstatus'] == '4') {
            $voice->status = '3';
        }
        $voice->save();
    }



    public function voice()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('ouVoice', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'tts-reasoning') {
            return;
        }
        $video = DhVideo::where('voice_task_id', $data['data']['speaker_id'])->find();
        if (!$video) {
            return;
        }
        $video->local_voice_url = $data['data']['voiceUrl'];
        $service = new OUService();
        $task_id = $service->v4($video->name, $data['data']['voiceUrl'], $video->scene_id);
        $video->task_id = $task_id;
        $video->save();
    }



    public function trainingScene()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('ouTrainingScene', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'video-training') {
            return;
        }
        $scene = DhScene::where('task_id', $data['data']['speaker_id'])->find();
        if (!$scene) {
            return;
        }

        if ($data['data']['zstatus'] == 3) {
            $scene->status = '2';
            $scene->scene_id = $data['data']['sceneId'];
            $scene->cover_image = $data['data']['url_image'];
        }
        if ($data['data']['zstatus'] == 4) {
            $scene->status = '3';
        }
        $scene->save();
    }

    public function v4Video()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('ouScene', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'video-synthesis') {
            return;
        }
        $video = DhVideo::where('task_id', $data['data']['speaker_id'])->find();
        if (!$video) {
            return;
        }
        if ($data['data']['zstatus'] == 3) {
            $video->status = '2';
            $video->api_video_url = $data['data']['videoId'];
            $video->cover_image = $data['data']['url_image'];
            $video->duration = $data['data']['duration'];
        }
        if ($data['data']['zstatus'] == 4 || $data['data']['zstatus'] == 6 || $data['data']['zstatus'] == 7) {
            $video->status = '3';
        }
        $video->save();
    }

    public function v5Video()
    {
        $data = $this->request->post();
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        Log::info('ouScene', json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($data['taskType'] != 'video-jihuo') {
            return;
        }
        $video = DhVideo::where('task_id', $data['data']['speaker_id'])->find();
        if (!$video) {
            return;
        }
        if ($data['data']['zstatus'] == 3) {
            $video->status = '2';
            $video->api_video_url = $data['data']['videoId'];
            $video->duration = $data['data']['duration'];
        }
        if ($data['data']['zstatus'] == 4) {
            $video->status = '3';
        }
        $video->save();
    }
}
