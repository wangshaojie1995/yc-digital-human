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
use app\api\lists\digitalhuman\SceneLists;
use app\api\logic\digitalhuman\SceneLogic;
use app\api\validate\digitalhuman\SceneValidate;

class SceneController extends BaseApiController
{

    public function lists()
    {
        return $this->dataLists(new  SceneLists());
    }

    public function createScene()
    { 
        $data = (new SceneValidate())->post()->goCheck();
        try {
            SceneLogic::create($data['name'], $data['local_video_url'], $this->userId);
            return $this->success('添加成功');
        } catch (\Throwable $e) {
            return $this->fail('添加失败:' . $e->getMessage());
        }
    }



    public function del()
    {
        $id = $this->request->post('id');
        $result = SceneLogic::del($id);
        if ($result) {
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');
    }


    public function rename()
    {
        $data = (new SceneValidate())->post()->goCheck('rename');
        $result = SceneLogic::rename($data['id'], $data['name']);
        if ($result) {
            return $this->success('修改成功');
        }
        return $this->fail('修改失败');
    }


    public function detail()
    {
        $id = $this->request->get('id/d');
        $result = SceneLogic::detail($id, $this->userId);
        return $this->data($result);
    }



    public function retry()
    {
        $id = $this->request->post('id/d');
        try {
            SceneLogic::retry($id, $this->userId);
            return $this->success('重试成功');
        } catch (\Throwable $e) {
            return $this->fail('重试失败:' . $e->getMessage());
        }
    }
}
