<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\api\lists\digitalhuman\VoiceLists;
use app\api\logic\digitalhuman\VoiceLogic;
use app\api\validate\digitalhuman\VoiceValidate;
use think\facade\Log;

class VoiceController extends BaseApiController
{


    public function lists()
    {
        return $this->dataLists(new  VoiceLists());
    }


    public function createVoice()
    {
        $data = (new VoiceValidate())->post()->goCheck();
        try {
            VoiceLogic::create($data['name'], $data['local_voice_url'], $this->userId, $data['duration']);
            return $this->success('添加成功');
        } catch (\Throwable $e) {
            return $this->fail('添加失败' . $e->getMessage());
        }
    }



    public function rename()
    {
        $data = (new VoiceValidate())->post()->goCheck('rename');
        $result = VoiceLogic::rename($data['id'], $data['name']);
        if ($result) {
            return $this->success('修改成功');
        }
        return $this->fail('修改失败');
    }



    public function del()
    {
        $id = $this->request->post('id');
        $result = VoiceLogic::del($id);
        if ($result) {
            return $this->success('删除成功');
        }
        return $this->fail('删除失败');
    }



    public function getCommonVoiceList()
    {
        $result = VoiceLogic::getCommonVoiceList();
        return $this->data($result);
    }
}
