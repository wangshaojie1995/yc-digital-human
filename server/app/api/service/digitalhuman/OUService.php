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
use think\facade\Cache;
use think\facade\Log;

class OUService
{


    /**
     * 获取token
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function getToken()
    {
        $ak = '';
        $sk = '';
        $key = 'ou_token' . md5($ak);
        $token = Cache::get($key);
        if (!$token) {
            $url = "https://open.oouu.cc/api/Cuser/login";
            $data = [
                'AccessKey' => $ak,
                'timestamp' => time(),
                'Sign' => md5($ak . time() . $sk)
            ];

            $client = new Client();
            $response = $client->request('POST', $url, [
                'json' => $data
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['code'] != 1) {
                throw new \Exception($result['message']);
            }
            $token = $result['data']['access_token'];
            Cache::set($key, $token, $result['data']['end_time'] - 60);
        }
        return $token;
    }


    /**
     * 音频训练
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function trainingVioce($name, $voiceUrl)
    {
        $url = "https://open.oouu.cc/api/Caudio/add_speaker?token=" . $this->getToken();
        $data = [
            'name' => $name,
            'voiceUrl' => $voiceUrl,
            'callbackUrl' => (string)url('digitalhuman.OUNotify/trainingVioce', [], false, true)
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 1) {
            throw new \Exception($result['message']);
        }
        return $result['data']['speaker_id'];
    }


    /**
     * 创建语音合成任务
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function createVoice($name, $text, $model_id)
    {
        $url = "https://open.oouu.cc/api/Caudio/voice?token=" . $this->getToken();
        $data = [
            'name' => $name,
            'text' => $text,
            'model_id' => $model_id,
            'callbackUrl' => (string)url('digitalhuman.OUNotify/voice', [], false, true)
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 1) {
            throw new \Exception($result['message']);
        }
        return $result['data']['speaker_id'];
    }


    /**
     * 场景训练
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function trainingScene($name, $videoUrl, $line_type)
    {
        $url = "https://open.oouu.cc/api/Cvideo/training?token=" . $this->getToken();
        $data = [
            'name' => $name,
            'videoUrl' => $videoUrl,
            'line_type' => $line_type,
            'callbackUrl' => (string)url('digitalhuman.OUNotify/trainingScene', [], false, true)
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 1) {
            throw new \Exception($result['message']);
        }
        return $result['data']['speaker_id'];
    }



    /**
     * 创建场景合成任务-v4版本
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function v4($name, $audioUrl, $sceneId, $line_type = '2')
    {
        $url = "https://open.oouu.cc/api/Cvideo/SimpleCreate?token=" . $this->getToken();
        $data = [
            'name' => $name,
            'audioUrl' => $audioUrl,
            'sceneId' => $line_type,
            'line_type' => $sceneId,
            'callbackUrl' => (string)url('digitalhuman.OUNotify/v4Video', [], false, true)
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 1) {
            throw new \Exception($result['message']);
        }
        return $result['data']['speaker_id'];
    }

    /**
     * 创建场景合成任务-v5版本
     * @author:1950781041@qq.com 
     * @Date:2024-11-07
     */
    public function v5($name, $audioUrl, $videoUrl)
    {
        $url = "https://open.oouu.cc/api/Cjihuo/create?token=" . $this->getToken();
        $data = [
            'name' => $name,
            'audioUrl' => $audioUrl,
            'videoUrl' => $videoUrl,
            'callbackUrl' => (string)url('digitalhuman.OUNotify/v5Video', [], false, true)
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 1) {
            throw new \Exception($result['message']);
        }
        return $result['data']['speaker_id'];
    }
}
