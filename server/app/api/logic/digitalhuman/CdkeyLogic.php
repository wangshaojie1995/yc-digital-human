<?php

namespace app\api\logic\digitalhuman;

use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\logic\BaseLogic;
use app\common\model\digitalhuman\DhCdkey;
use app\common\model\user\User;
use think\facade\Db;

class CdkeyLogic extends BaseLogic
{

    public static function  exchange($key, $uid)
    {
        Db::startTrans();
        try {
            $cdkey = DhCdkey::where('code', $key)->find();
            if (!$cdkey) {
                throw new \Exception('兑换码不存在');
            }
            if ($cdkey['used_status'] == '2') {
                throw new \Exception('兑换码已使用');
            }
            if ($cdkey['status'] == '2') {
                throw new \Exception('兑换码无效');
            }
            $cdkey->used_status = '2';
            $cdkey->uid = $uid;
            $cdkey->save();
            $user = User::where('id', $uid)->find();
            if (!$user) {
                throw new \Exception('用户不存在');
            }
            $user->points += $cdkey->points;
            $user->save();
            AccountLogLogic::add($uid, AccountLogEnum::PM_INC_CDKEY, AccountLogEnum::INC, $cdkey->points, '', '兑换码兑换', []);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            throw new \Exception($e->getMessage());
        }
    }
}
