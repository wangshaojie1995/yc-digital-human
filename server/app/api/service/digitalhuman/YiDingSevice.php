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
namespace app\api\service\digitalhuman;

use app\common\service\ConfigService;
use GuzzleHttp\Client;
use think\facade\Log;

class YiDingSevice
{

    protected $token;
    public function __construct()
    {
        $this->token = ConfigService::get('yiding', 'token');
    }



    /**
     * 获取公共声音
     * @author:1950781041@qq.com 
     * @Date:2024-10-30
     */
    public function getVoiceList()
    {
        $url = "https://api.yidevs.com/app/human/human/Voice/role";
        $cilent = new Client();
        $response = $cilent->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }


    /**
     * 克隆声音
     * @author:1950781041@qq.com 
     * @Date:2024-10-31
     */
    public function cloneVoice($name, $audio_url)
    {
        $url = "https://api.yidevs.com/app/human/human/Voice/clone";
        $cilent = new Client();
        $response = $cilent->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
            'json' => [
                'name' => $name,
                'audio_url' => $audio_url,
                'description' => '克隆',
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] == 200) {
            return $result['data'];
        } else {
            Log::info('克隆声音失败：' . json_encode($result));
            throw new \Exception($result['msg']);
        }
    }


    /**
     * 场景
     * @author:1950781041@qq.com 
     * @Date:2024-10-31
     */
    public function createScene($name, $video_url)
    {
        $url = "https://api.yidevs.com/app/human/human/Scene/created";
        $cilent = new Client();
        $response = $cilent->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
            'json' => [
                'video_name' => $name,
                'video_url' => $video_url,
                'callback_url' => (string)url('digitalhuman.YDNotify/scene', [], false, true)
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] == 200) {
            return $result['data']['scene_task_id'];
        } else {
            Log::info('创建场景失败：' . json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            throw new \Exception($result['msg']);
        }
    }


    /**
     * 合成声音
     * @author:1950781041@qq.com 
     * @Date:2024-10-30
     */
    public function synthesisVoice($text, $voice_id)
    {
        $url = "https://api.yidevs.com/app/human/human/Voice/created";
        $cilent = new Client();
        $response = $cilent->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
            'form_params' => [
                'text' => $text,
                'voice_id' => $voice_id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] == 200) {
            return $result['data']['audio_url'];
        } else {
            Log::info('合成声音失败：' . json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            throw new \Exception($result['msg']);
        }
    }


    /**
     * 合成视频
     * @author:1950781041@qq.com 
     * @Date:2024-11-01
     */
    public function createVideo($task_id, $voice_url)
    {
        $url = "https://api.yidevs.com/app/human/human/Index/created";
        $cilent = new Client();
        $response = $cilent->request('POST', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ],
            'json' => [
                'scene_task_id' => $task_id,
                'audio_url' => $voice_url,
                'callback_url' => (string)url('digitalhuman.YDNotify/video', [], false, true)
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        Log::info('合成视频返回：' . json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        if ($result['code'] == 200) {
            return $result['data']['video_task_id'];
        } else {
            Log::info('视频生成失败：' . json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            throw new \Exception($result['msg']);
        }
    }




    public function getText()
    {
        $url = "https://api.yidevs.com/app/human/human/Voice/getTraintext";
        $cilent = new Client();
        $response = $cilent->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] == 200) {
            return $result['data'];
        } else {
            Log::info('获取文本失败：' . json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            throw new \Exception($result['msg']);
        }
    }
}
