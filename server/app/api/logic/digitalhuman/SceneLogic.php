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
use app\api\logic\UserLogic;
use app\api\service\digitalhuman\GuiJiService;
use app\api\service\digitalhuman\YiDingSevice;
use app\common\service\FileService;

class SceneLogic extends BaseLogic
{

    public static function create($name, $local_video_url, $uid)
    {
        $createInfo = ConfigService::get('create');
        $scene_points = $createInfo['scene_points'] ?? 0;
        $type = $createInfo['type'];
        $channel =  $createInfo['channel'] ?? 1;
        if ($scene_points > 0) {
            $user = UserLogic::info($uid);
            if ($user['points'] < $scene_points) {
                throw new \Exception('算力点不足');
            }
        }

        $vr = FileService::getFileUrl($local_video_url);
        switch ($type) {
            case "yiding":
                $servie = new YiDingSevice();
                $task_id = $servie->createScene($name, $vr, $channel);
                break;
            case "guiji":
                $service = new GuiJiService();
                $task_id =  $service->training($name, $vr);
                break;
            default:
                throw new \Exception('系统未配置渠道');
                break;
        }
        $data = [
            'name' => $name,
            'uid' => $uid,
            'type' => $type,
            'channel' => $channel,
            'local_video_url' => $local_video_url,
            'task_id' => $task_id ?? '',
            'create_time' => time(),
            'update_time' => time(),
        ];
        if (!DhScene::create($data)) {
            throw new \Exception('创建数据失败');
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
