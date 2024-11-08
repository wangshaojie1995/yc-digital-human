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
namespace app\common\service\digitalhuman;

use app\common\model\user\UserAuth;
use app\common\service\ConfigService;
use app\common\service\wechat\WeChatConfigService;
use Yansongda\Pay\Pay;

class PayService
{

    protected $config;
    protected $appletConfig;
    protected $oaConfig;
    protected $auth;
    protected $terminal;
    public function __construct($terminal, $userId = 0)
    {
        $this->terminal = $terminal;
        $this->config = WeChatConfigService::getPayConfigByTerminal($terminal);
        $this->appletConfig = ConfigService::get('mnp_setting') ?? [];
        $this->oaConfig =  ConfigService::get('oa_setting') ?? [];
        if ($userId !== null) {
            $this->auth = UserAuth::where(['user_id' => $userId, 'terminal' => $terminal])->findOrEmpty();
        }
    }
    private function getConfig()
    {
        $config = [
            'wechat' => [
                'default' => [
                    'mch_id' => $this->config['mch_id'],
                    'mch_secret_key' => $this->config['secret_key'],
                    'mch_secret_cert' => $this->config['private_key'],
                    'mch_public_cert_path' => $this->config['certificate'],
                    'notify_url' => (string)url('digitalhuman.PayNotify/notifyPackage', [], false, true),
                    'mini_app_id' => $this->terminal == 1 ? $this->appletConfig['app_id'] : null,
                    'mp_app_id' => $this->terminal != 1 ? $this->oaConfig['app_id'] : null,
                ]
            ],
            'logger' => [
                'enable' => true,
                'file' => root_path() . "/runtime/wechat/public/wechat.log",
                'level' => 'info',
                'type' => 'single',
                'max_file' => 30
            ],
            'http' => [
                'timeout' => 5.0,
                'connect_timeout' => 5.0,
            ],
        ];
        return $config;
    }

    private function getClientIp()
    {
        return (!empty(env('project.test_web_ip')) && env('APP_DEBUG'))
            ? env('project.test_web_ip')
            : request()->ip();
    }

    public function pay($order_no, $price, $description = '')
    {
        $config = $this->getConfig();
        $order = [
            'out_trade_no' => $order_no,
            'amount' => [
                'total' => (int)($price * 10 * 10),
                'currency' => 'CNY'
            ],
            'description' => $description
        ];
       
        switch ($this->terminal) {
            case 1:
                $order['payer']['openid'] = $this->auth['openid'];
                $result = Pay::wechat($config)->mini($order);
                break;

            case 3:
                $order['scene_info'] = [
                    'payer_client_ip' => $this->getClientIp(),
                    'h5_info' => [
                        'type' => 'Wap',
                    ]
                ];
                $result = Pay::wechat($config)->h5($order);
                break;
            default:
                $order['payer']['openid'] = $this->auth['openid'];
                $result = Pay::wechat($config)->mp($order);
                break;
        }

        return $result->toArray();
    }


    // private function getConfig()
    // {
    //     $config = [
    //         'wechat' => [
    //             'default' => [
    //                 'mch_id' => $this->config['mch_id'],
    //                 'mch_secret_key' =>  $this->config['secret_key'],
    //                 'mch_secret_cert' => $this->config['private_key'],
    //                 'mch_public_cert_path' =>  $this->config['certificate'],
    //                 'notify_url' => (string)url('digitalhuman.PayNotify/notifyPackage', [], false, true),
    //             ]
    //         ],
    //         'logger' => [
    //             'enable' => true,
    //             'file' => root_path() . "/runtime/wechat/public/wechat.log",
    //             'level' => 'info',
    //             'type' => 'single',
    //             'max_file' => 30
    //         ],
    //         'http' => [
    //             'timeout' => 5.0,
    //             'connect_timeout' => 5.0,
    //         ],
    //     ];

    //     if ($this->terminal == 1) {
    //         $config['wechat']['default']['mini_app_id'] = $this->appletConfig['app_id'];
    //     } elseif ($this->terminal == 3) {
    //     } else {
    //         $config['wechat']['default']['mp_app_id'] = $this->oaConfig['app_id'];
    //     }
    //     return $config;
    // }


    // public function pay($order_no, $price, $str = '')
    // {
    //     $config = $this->getConfig();
    //     $order = [
    //         'out_trade_no' => $order_no,
    //         'amount' => [
    //             'total' => (int)($price * 10 * 10)
    //         ],
    //         'description' => $str
    //     ];

    //     if ($this->terminal == 1) {
    //         $order['amount']['currency'] = 'CNY';
    //         $order['payer']['openid'] = $this->auth['openid'];
    //         $result = Pay::wechat($config)->mini($order);
    //     } elseif ($this->terminal == 3) {

    //         $ip = request()->ip();
    //         if (!empty(env('project.test_web_ip')) && env('APP_DEBUG')) {
    //             $ip = env('project.test_web_ip');
    //         }
    //         $order['scene_info'] = [
    //             'payer_client_ip' => $ip,
    //             'h5_info' => [
    //                 'type' => 'Wap',
    //             ]
    //         ];
    //         $result = Pay::wechat($config)->h5($order);
    //     } else {
    //         $order['payer']['openid'] = $this->auth['openid'];
    //         $result = Pay::wechat($config)->mp($order);
    //     }
    //     return $result->toArray();
    // }
}
