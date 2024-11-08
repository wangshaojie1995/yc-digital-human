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
use app\common\model\digitalhuman\DhScene;
use app\common\service\ConfigService;
use think\facade\Db;
use app\api\logic\UserLogic;
use app\api\service\digitalhuman\GuiJiService;
use app\api\service\digitalhuman\YiDingSevice;
use app\common\enum\user\AccountLogEnum;
use app\common\logic\AccountLogLogic;
use app\common\model\user\User;
use app\common\service\FileService;

class SceneLogic extends BaseLogic
{

    public static function create($name, $local_video_url, $uid)
    {
        $scene_points = ConfigService::get('create', 'scene_points');
        if ($scene_points > 0) {
            $user = UserLogic::info($uid);
            if ($user['points'] < $scene_points) {
                throw new \Exception('积分不足');
            }
        }
        $type = ConfigService::get('create', 'type');
        Db::startTrans();
        try {
            $vr = FileService::getFileUrl($local_video_url);
            switch ($type) {
                case "yiding":
                    $servie = new YiDingSevice();
                    $task_id = $servie->createScene($name, $vr);
                    break;
                case "guiji":
                    $service = new GuiJiService();
                    $task_id =  $service->training($name, $vr);
                    break;
            }
            $data = [
                'name' => $name,
                'uid' => $uid,
                'type' => $type,
                'local_video_url' => $local_video_url,
                'task_id' => $task_id ?? '',
                'create_time' => time(),
                'update_time' => time(),
            ];
            User::where('id', $uid)->dec('points', $scene_points)->update();
            AccountLogLogic::add(
                $uid,
                AccountLogEnum::PM_DEC_SCENE_CREATE,
                AccountLogEnum::DEC,
                $scene_points,
                '',
                '场景复刻',
                []
            );
            DhScene::create($data);
            Db::commit();
            return true;
        } catch (\Throwable $e) {
            Db::rollback();
            throw new \Exception('复刻失败：' . $e->getMessage().$e->getLine().$e->getFile());
        }
    }


    public static function del($id)
    {
        $result = DhScene::destroy($id);
        return $result;
    }


    public static function rename($id, $name)
    {
        $result = DhScene::update(['name' => $name], ['id' => $id]);
        return $result;
    }

    public static function detail($id, $uid)
    {
        $result = DhScene::where('id', $id)->where('uid', $uid)->find();
        return $result->toArray();
    }


    public static function retry($id, $uid)
    {
        $scene = DhScene::where('uid', $uid)->where('id', $id)->find();
        if (!$scene) {
            throw new \Exception('场景不存在');
        }
        if ($scene->status != 3) {
            throw new \Exception('状态错误');
        }

        $type = ConfigService::get('create', 'type');

        switch ($type) {
            case "yiding":
                $servie = new YiDingSevice();
                $task_id = $servie->createScene($scene->name, $scene->local_video_url);
                break;
            case "guiji":
                $service = new GuiJiService();
                $task_id =  $service->training($scene->name, $scene->local_video_url);
                break;
        }

        $scene->task_id = $task_id;
        $scene->status = '1';
        $scene->save();
    }
}
