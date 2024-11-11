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
namespace app\api\logic\digitalhuman;

use app\common\logic\BaseLogic;
use app\common\service\ConfigService;

class ConfigLogic extends BaseLogic
{

    public static function getConfig()
    {
        $type = ConfigService::get('create', 'type', 'yiding');
        $voice_type = ConfigService::get('create', 'voice_type', 'yiding');
        $create_points = ConfigService::get('create', 'create_points', 0);
        $voice_points = ConfigService::get('create', 'voice_points', 0);
        $scene_points = ConfigService::get('create', 'scene_points', 0);

        return compact('type', 'voice_type', 'create_points', 'voice_points', 'scene_points');
    }
}
