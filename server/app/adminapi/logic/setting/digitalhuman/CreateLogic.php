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
namespace app\adminapi\logic\setting\digitalhuman;


use app\common\logic\BaseLogic;
use app\common\service\ConfigService;


class CreateLogic extends BaseLogic
{


    public static function getConfig(): array
    {
        return [
            'type' => ConfigService::get('create', 'type', 'yiding'),
            'voice_type' => ConfigService::get('create', 'voice_type', 'yiding'),
            'create_points' => ConfigService::get('create', 'create_points', 0),
            'voice_points' => ConfigService::get('create', 'voice_points', 0),
            'scene_points' => ConfigService::get('create', 'scene_points', 0),
            'token' => ConfigService::get('yiding', 'token', ''),
            'app_secret' => ConfigService::get('guiji', 'app_secret', ''),
            'appid' => ConfigService::get('guiji', 'appid', ''),
            'channel' => ConfigService::get('create', 'channel', 1),
            'video_number' => ConfigService::get('create', 'video_number', 1),
        ];
    }

    public static function setConfig(array $params)
    {
        ConfigService::set('yiding', 'token', $params['token']);
        ConfigService::set('guiji', 'app_secret', $params['app_secret']);
        ConfigService::set('guiji', 'appid', $params['appid']);
        ConfigService::set('create', 'type', $params['type']);
        ConfigService::set('create', 'voice_type', $params['voice_type']);
        ConfigService::set('create', 'create_points', $params['create_points']);
        ConfigService::set('create', 'voice_points', $params['voice_points']);
        ConfigService::set('create', 'scene_points', $params['scene_points']);
        ConfigService::set('create', 'channel', $params['channel']);
        ConfigService::set('create', 'video_number', $params['video_number']);
    }
}
