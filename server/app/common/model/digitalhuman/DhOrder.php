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

namespace app\common\model\digitalhuman;


use app\common\model\BaseModel;



/**
 * DhOrder模型
 * Class DhOrder
 * @package app\common\model\digitalhuman
 */
class DhOrder extends BaseModel
{
    
    protected $name = 'dh_order';
    

    
    /**
     * @notes 关联user
     * @return \think\model\relation\HasOne
     * @author likeadmin
     * @date 2024/11/07 15:00
     */
    public function user()
    {
        return $this->hasOne(\app\common\model\user\User::class, 'id', 'uid');
    }

    /**
     * @notes 关联package
     * @return \think\model\relation\HasOne
     * @author likeadmin
     * @date 2024/11/07 15:00
     */
    public function package()
    {
        return $this->hasOne(\app\common\model\digitalhuman\DhPackage::class, 'id', 'package_id');
    }

}