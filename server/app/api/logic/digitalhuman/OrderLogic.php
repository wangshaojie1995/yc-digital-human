<?php

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
