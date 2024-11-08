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
namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\api\logic\digitalhuman\AgreementLogic;

class AgreementController extends BaseApiController
{
    public function getConfig()
    {
        $type = $this->request->get('type/s', '');
        $result = AgreementLogic::getConfig($type);
        return $this->success('获取成功', ['content'=>$result]);
    }
}
