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
use app\adminapi\lists\digitalhuman\DhSceneLists;
use app\adminapi\logic\digitalhuman\DhSceneLogic;
use app\adminapi\validate\digitalhuman\DhSceneValidate;


/**
 * DhScene控制器
 * Class DhSceneController
 * @package app\adminapi\controller\digitalhuman
 */
class DhSceneController extends BaseAdminController
{


    /**
     * @notes 获取列表
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/06 11:33
     */
    public function lists()
    {
        return $this->dataLists(new DhSceneLists());
    }

    /**
     * @notes 删除
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/11/06 11:33
     */
    public function delete()
    {
        $params = (new DhSceneValidate())->post()->goCheck('delete');
        DhSceneLogic::delete($params);
        return $this->success('删除成功', [], 1, 1);
    }




}