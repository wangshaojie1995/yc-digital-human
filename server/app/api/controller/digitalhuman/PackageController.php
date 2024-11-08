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
use app\api\lists\digitalhuman\PackageLists;
use app\api\logic\digitalhuman\OrderLogic;
use app\api\validate\digitalhuman\PackageValidate;

class PackageController extends BaseApiController
{

    public function lists()
    {
        return $this->dataLists(new  PackageLists());
    }

    public function createOrder()
    {
        $data = (new PackageValidate())->post()->goCheck();
        try {
            $res=OrderLogic::create($this->userId, $this->userInfo['terminal'], $data);
            return $this->success('添加成功',$res);
        } catch (\Throwable $e) {
            return $this->fail('失败:' . $e->getMessage());
        }
    }
}
