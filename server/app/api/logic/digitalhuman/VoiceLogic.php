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

    public static function create($params)
    {
        $name = $params['name'];
        $local_voice_url = $params['local_voice_url'];
        $uid = $params['uid'];
        $duration = $params['duration'];

        $voice_points = ConfigService::get('create', 'voice_points');
        if ($voice_points > 0) {
            $user = UserLogic::info($uid);
            if ($user['points'] < $voice_points) {
                throw new \Exception('算力点不足');
            }
        }
        $local_voice_url = FileService::getFileUrl($local_voice_url);
        Db::startTrans();
        try {
            $sevice = new YiDingSevice();
            $voice = new DhVoice();
            $voice->status = 1;
            $voice->type = 'yidng';
            if ($params['voice_type'] == 1) {
                $result = $sevice->cloneVoice($name, $local_voice_url);
                $voice->task_id = $result['task_id'];
                $voice->voice_id = $result['voice_id'];
                $voice->status = 2;
            } else {
                $result = $sevice->professionalCreatedTask($params['sex'], $params['ageGroup']);
                $voice->task_id = $result['task_id'];
            }
            $voice->uid = $uid;
            $voice->name = $name;
            $voice->local_voice_url = $local_voice_url;
            $voice->duration = $duration;
            $voice->save();

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
            throw new \Exception($e->getMessage());
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


    public static function getTraintext()
    {
        $sevice = new YiDingSevice();
        $result = $sevice->getTraintext();
        return $result;
    }
}
