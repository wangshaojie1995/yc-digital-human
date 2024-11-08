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
namespace app\api\validate\digitalhuman;


use app\common\validate\BaseValidate;

class SceneValidate extends BaseValidate
{

    protected  $rule = [
        'name' => 'require',
        'local_video_url' => 'require',
    ];

    protected $message = [
        'code.require' => '参数缺失',
        'local_video_url.require' => '参数缺失',
    ];

    protected $scene = [
        'rename' => ['id', 'name'],
    ];
}
