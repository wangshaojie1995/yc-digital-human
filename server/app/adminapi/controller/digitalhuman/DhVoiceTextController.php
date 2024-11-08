<?php
// +----------------------------------------------------------------------
// | likeadmin快速开发前后端分离管理后台（PHP版）
// +----------------------------------------------------------------------
// | 欢迎阅读学习系统程序代码，建议反馈是我们前进的动力
// | 开源版本可自由商用，可去除界面版权logo
// | gitee下载：https://gitee.com/likeshop_gitee/likeadmin
// | github下载：https://github.com/likeshop-github/likeadmin
// | 访问官网：https://www.likeadmin.cn
// | likeadmin团队 版权所有 拥有最终解释权
// +----------------------------------------------------------------------
// | author: likeadminTeam
// +----------------------------------------------------------------------


namespace app\adminapi\controller\digitalhuman;


use app\adminapi\controller\BaseAdminController;
use app\adminapi\lists\digitalhuman\DhVoiceTextLists;
use app\adminapi\logic\digitalhuman\DhVoiceTextLogic;
use app\adminapi\validate\digitalhuman\DhVoiceTextValidate;


/**
 * DhVoiceText控制器
 * Class DhVoiceTextController
 * @package app\adminapi\controller\digitalhuman
 */
class DhVoiceTextController extends BaseAdminController
{


    /**
     * @notes 获取列表
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/07 14:46
     */
    public function lists()
    {
        return $this->dataLists(new DhVoiceTextLists());
    }


    /**
     * @notes 添加
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/07 14:46
     */
    public function add()
    {
        $params = (new DhVoiceTextValidate())->post()->goCheck('add');
        $result = DhVoiceTextLogic::add($params);
        if (true === $result) {
            return $this->success('添加成功', [], 1, 1);
        }
        return $this->fail(DhVoiceTextLogic::getError());
    }


    /**
     * @notes 编辑
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/07 14:46
     */
    public function edit()
    {
        $params = (new DhVoiceTextValidate())->post()->goCheck('edit');
        $result = DhVoiceTextLogic::edit($params);
        if (true === $result) {
            return $this->success('编辑成功', [], 1, 1);
        }
        return $this->fail(DhVoiceTextLogic::getError());
    }


    /**
     * @notes 删除
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/07 14:46
     */
    public function delete()
    {
        $params = (new DhVoiceTextValidate())->post()->goCheck('delete');
        DhVoiceTextLogic::delete($params);
        return $this->success('删除成功', [], 1, 1);
    }


    /**
     * @notes 获取详情
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/07 14:46
     */
    public function detail()
    {
        $params = (new DhVoiceTextValidate())->goCheck('detail');
        $result = DhVoiceTextLogic::detail($params);
        return $this->data($result);
    }


}