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
            $data['uid'] = $this->userId;
            VoiceLogic::create($data);
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


    public function getTraintext()
    {
        $result = VoiceLogic::getTraintext();
        return $this->data($result);
    }



    public function getCommonVoiceList()
    {
        $result = VoiceLogic::getCommonVoiceList();
        return $this->data($result);
    }
}
