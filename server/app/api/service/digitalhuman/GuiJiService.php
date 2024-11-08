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

class GuiJiService
{

    protected $AccessKey;
    protected $SecretKey;
    protected $time;

    public function __construct()
    {
        $this->AccessKey = ConfigService::get('guiji', 'appid');
        $this->SecretKey = ConfigService::get('guiji', 'app_secret');
        $this->time = $this->msectime();
    }

    public function getToken()
    {
        $key = md5($this->AccessKey . $this->SecretKey);
        $token = Cache::get($key);
        if (!$token) {
            $sign = md5($this->AccessKey . $this->time . $this->SecretKey);
            $client = new Client();
            $url = "https://meta.guiji.ai/openapi/oauth/token?grant_type=sign&appId=$this->AccessKey&timestamp=$this->time&sign=$sign";
            $response = $client->request('GET', $url);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['code'] != 0) {
                throw new \Exception($result['message']);
            }
            $token = $result['data']['access_token'];
            Cache::set($key, $token, $result['data']['expires_in'] - 60);
        }
        return $token;
    }


    /**
     * 提交合成
     * @author:1950781041@qq.com 
     * @Date:2024-11-06
     */
    public function createVideo($name, $scene_id, $voice_url)
    {
        $data = [
            'videoName' => $name,
            'sceneId' => $scene_id,
            'callbackUrl' => (string)url('digitalhuman.GJNotify/video', [], false, true),
            'audioUrl' => $voice_url,
        ];


        $url = "https://meta.guiji.ai/openapi/video/v2/simpleCreate?access_token=" . $this->getToken();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 0) {
            throw new \Exception($result['message']);
            Log::error('提交合成失败：' . $result['message']);
        }
        Log::info('提交合成成功' .  json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return $result['data']['videoId'];
    }




    /**
     * 训练模型
     * @author:1950781041@qq.com 
     * @Date:2024-11-06
     */
    public function training($name, $videoUrl)
    {
        $url = "https://meta.guiji.ai/openapi/video/v2/create/training?access_token=" . $this->getToken();
        $data = [
            'name' => $name,
            'videoUrl' => $videoUrl,
            'callbackUrl' => (string)url('digitalhuman.GJNotify/scene', [], false, true),
            'level' => 1,
            'greenScreen' => 0
        ];
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 0) {
            throw new \Exception($result['message']);
            Log::error('提交训练失败：' . $result['message']);
        }
        Log::info('提交训练成功：' .  json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return $result['data']['trainingId'];
    }


    public function getFree($page, $size)
    {
        $data = [
            'page' => $page,
            'size' => $size
        ];
        $url = "https://meta.guiji.ai/openapi/robot/v2/freeListPage?access_token=" . $this->getToken();
        $client = new Client();
        $response = $client->request('POST', $url, [
            'json' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['code'] != 0) {
            throw new \Exception($result['message']);
            Log::error('硅语查询模特失败：' . $result['message']);
        }
        return $result['data'];
    }


    private function msectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }
}
