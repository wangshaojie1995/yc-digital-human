<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\api\lists\digitalhuman\VideoLists;
use app\api\logic\digitalhuman\VideoLogic;
use app\api\validate\digitalhuman\VideoValidate;

class VideoController extends BaseApiController
{

    public function createVideo()
    {
        $data = (new VideoValidate())->post()->goCheck();
        try {
            $data = $this->request->post();
            $data['uid'] = $this->userId;
            VideoLogic::create($data);
            return $this->success('添加成功');
        } catch (\Throwable $e) {
            return $this->fail($e->getMessage());
        }
    }


    public function lists()
    {
        return $this->dataLists(new  VideoLists());
    }




    public function rename()
    {
        $data = (new VideoValidate())->post()->goCheck('rename');
        $result = VideoLogic::rename($data['id'], $data['name']);
        if ($result) {
            return $this->success('修改成功');
        }
        return $this->fail('修改失败');
    }



    public function del()
    {
        $id = $this->request->post('id');
        $result = VideoLogic::del($id);
        if ($result) {
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');
    }



    public function retry()
    {
        try {
            $id = $this->request->post('id');
            VideoLogic::retry($id, $this->userId);
            return $this->success('重试成功');
        } catch (\Throwable $e) {
            return $this->fail($e->getMessage());
        }
    }
}
