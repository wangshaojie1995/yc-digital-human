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
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\digitalhuman\DhOrder;
use app\common\model\digitalhuman\DhPackage;
use app\common\model\user\User;
use app\common\service\ConfigService;
use think\facade\Log;
use Yansongda\Pay\Pay;
use app\common\service\wechat\WeChatConfigService;
use think\facade\Db;

class PayNotifyController extends BaseApiController
{
    public array $notNeedLogin = ['notifyPackage'];

    public function notifyPackage()
    {
        $mini = WeChatConfigService::getPayConfigByTerminal(1);
        $appletConfig = ConfigService::get('mnp_setting') ?? [];
        $mpConfig = ConfigService::get('oa_setting') ?? [];
        $config = [
            'wechat' => [
                'default' => [
                    'mch_id' => $mini['mch_id'],
                    'mini_app_id' => $appletConfig['app_id'] ?? '',
                    'mp_app_id' => $mpConfig['app_id'] ?? '',
                    'mch_secret_key' =>  $mini['secret_key'],
                    'mch_secret_cert' => $mini['private_key'],
                    'mch_public_cert_path' =>  $mini['certificate'],
                    'notify_url' => (string)url('digitalhuman.Notify/notifyPackage', [], false, true),
                ]
            ],
            'logger' => [
                'enable' => false,
                'file' => root_path() . "runtime/wechat/public/wechat.log",
                'level' => 'info',
                'type' => 'single',
                'max_file' => 30
            ],
            'http' => [
                'timeout' => 5.0,
                'connect_timeout' => 5.0,
            ],
        ];
        Pay::config($config);
        $result = Pay::wechat()->callback();
        Log::info('notifyPackage: ' . json_encode($result));
        if ($result['summary'] == '支付成功') {
            $this->order($result['resource']['ciphertext']['out_trade_no'], $result['resource']['ciphertext']['transaction_id']);
        }
        return Pay::wechat()->success();
    }



    private function order($orderNo, $wechatOrderNo)
    {
        Db::startTrans();
        try {
            $order = DhOrder::where('order_no', $orderNo)->find();
            if (!$order) {
                throw new \Exception('未找到订单' . $orderNo);
                return;
            }
            $order->status = '2';
            $order->wechat_order_no = $wechatOrderNo;
            $order->save();
            $package = DhPackage::where('id', $order->package_id)->find();
            $user = User::where('id', $order->uid)->find();
            $user->points += $package->points;
            $user->save();
            AccountLogLogic::add(
                $order->uid,
                AccountLogEnum::PM_INC_RECHARGE,
                AccountLogEnum::INC,
                $package->points,
                '',
                '购买套餐增加',
                []
            );
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            Log::error('order: ' . $e->getMessage());
        }
    }
}
