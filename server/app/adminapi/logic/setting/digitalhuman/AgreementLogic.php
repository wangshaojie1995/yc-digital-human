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


class AgreementLogic extends BaseLogic
{


    public static function getConfig(): array
    {
        return [
            'voice_title' => ConfigService::get('voice', 'voice_title', ''),
            'voice_content' => ConfigService::get('voice', 'voice_content', ''),
            'video_title' => ConfigService::get('video', 'video_title', ''),
            'video_content' => ConfigService::get('video', 'video_content', ''),
            'scene_title' => ConfigService::get('scene', 'scene_title', ''),
            'scene_content' => ConfigService::get('scene', 'scene_content', ''),
        ];
    }

    public static function setConfig(array $params)
    {
        ConfigService::set('voice', 'voice_title', $params['voice_title']);
        ConfigService::set('voice', 'voice_content', $params['voice_content']);
        ConfigService::set('video', 'video_title', $params['video_title']);
        ConfigService::set('video', 'video_content', $params['video_content']);
        ConfigService::set('scene', 'scene_title', $params['scene_title']);
        ConfigService::set('scene', 'scene_content', $params['scene_content']);
    }
}
