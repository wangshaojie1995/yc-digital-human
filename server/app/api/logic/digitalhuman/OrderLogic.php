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
use app\common\model\digitalhuman\DhOrder;
use app\common\model\digitalhuman\DhPackage;
use app\common\service\digitalhuman\PayService;

class OrderLogic extends BaseLogic
{

    public static function create($userId, $terminal, $params)
    {

        $package = DhPackage::where('id', $params['id'])->find();
        if (!$package) {
            throw new \Exception('套餐不存在');
        }
        try {
            $data = [
                'order_no' => generate_sn(DhOrder::class, 'order_no'),
                'uid' => $userId,
                'package_id' => $params['id'],
                'price' =>  $package['price'],
                'pay_type' => 'applet',
                'status' => '1'
            ];
            DhOrder::create($data);
            $service = new PayService($terminal, $userId);
            $res = $service->pay($data['order_no'],  $package['price'], '购买套餐');
            return $res;
        } catch (\Throwable $e) {
            throw new \Exception('添加失败:' . $e->getMessage());
        }
    }
}
