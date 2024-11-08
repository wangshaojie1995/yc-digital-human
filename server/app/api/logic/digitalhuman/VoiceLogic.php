<?php

namespace app\api\logic\digitalhuman;

use app\api\logic\UserLogic;
use app\api\service\digitalhuman\YiDingSevice;
use app\common\logic\BaseLogic;
use app\common\model\digitalhuman\DhVoice;
use app\common\service\ConfigService;
use app\common\service\FileService;
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\user\User;
use think\facade\Db;

class VoiceLogic extends BaseLogic
{

    public static function create($name, $local_voice_url, $uid, $duration)
    {
        $voice_points = ConfigService::get('create', 'voice_points');
        if ($voice_points > 0) {
            $user = UserLogic::info($uid);
            if ($user['points'] < $voice_points) {
                throw new \Exception('积分不足');
            }
        }
        $local_voice_url = FileService::getFileUrl($local_voice_url);
        Db::startTrans();
        try {
            $sevice = new YiDingSevice();
            $result = $sevice->cloneVoice($name, $local_voice_url);
            $data = [
                'uid' => $uid,
                'name' => $name,
                'local_voice_url' => $local_voice_url,
                'task_id' => $result['task_id'],
                'voice_id' => $result['voice_id'],
                'duration' => $duration,
                'create_time' => time(),
                'update_time' => time(),
            ];
            $result = DhVoice::create($data);
            User::where('id', $uid)->dec('points', $voice_points)->update();
            AccountLogLogic::add(
                $uid,
                AccountLogEnum::PM_DEC_VOICE_CREATE,
                AccountLogEnum::DEC,
                $voice_points,
                '',
                '语音复刻',
                []
            );
            Db::commit();
            return true;
        } catch (\Throwable $e) {
            Db::rollback();
            throw new \Exception('语音复刻失败：' . $e->getMessage());
        }
    }



    public static function getCommonVoiceList()
    {
        $sevice = new YiDingSevice();
        $result = $sevice->getVoiceList();
        return $result;
    }

    public static function del($id)
    {
        $result = DhVoice::destroy($id);
        return $result;
    }


    public static function rename($id, $name)
    {
        $result = DhVoice::update(['name' => $name], ['id' => $id]);
        return $result;
    }
}
