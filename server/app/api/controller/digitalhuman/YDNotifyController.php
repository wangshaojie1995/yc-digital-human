<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\common\model\digitalhuman\DhScene;
use app\common\model\digitalhuman\DhVideo;
use think\facade\Log;

class YDNotifyController extends BaseApiController
{
    public array $notNeedLogin = ['scene', 'video'];

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

        $sceneInfo->status = ($data['code'] == 200) ? 2 : 3;
        if ($data['code'] == 200) {
            $sceneInfo->api_video_url = $data['data']['videoUrl'];
            $sceneInfo->cover_image = $coverImageUrl;
            $sceneInfo->scene_id = $data['data']['sceneId'];
        }

        $sceneInfo->save();
    }

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


        if ($data['code'] == 200) {
            $coverImageUrl = $this->saveCoverImage(
                $data['data']['coverUrl'],
                'video',
                $data['data']['video_task_id']
            );
            $video->status = 2;
            $video->api_video_url = $data['data']['videoUrl'];
            $video->duration = $data['data']['duration'];
            $video->cover_image = $coverImageUrl;
        } elseif ($data['code'] == 400) {
            $video->status = 3;
        }

        $video->save();
        return $this->success('');
    }

    private function getRequestData()
    {
        $data = $this->request->post();
        return is_string($data) ? json_decode($data, true) : $data;
    }


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

    
}
