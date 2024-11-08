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

namespace app\adminapi\lists\digitalhuman;


use app\adminapi\lists\BaseAdminDataLists;
use app\common\model\digitalhuman\DhOrder;
use app\common\lists\ListsSearchInterface;


/**
 * DhOrder列表
 * Class DhOrderLists
 * @package app\adminapi\listsdigitalhuman
 */
class DhOrderLists extends BaseAdminDataLists implements ListsSearchInterface
{


    /**
     * @notes 设置搜索条件
     * @return \string[][]
     * @author likeadmin
     * @date 2024/11/07 15:00
     */
    public function setSearch(): array
    {
        return [
            '=' => ['order_no', 'wechat_order_no'],
        ];
    }


    /**
     * @notes 获取列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author likeadmin
     * @date 2024/11/07 15:00
     */
    public function lists(): array
    {
        return DhOrder::where($this->searchWhere)
            ->field(['id', 'order_no', 'wechat_order_no', 'package_id', 'price', 'uid', 'status', 'pay_type', 'pay_time'])
            ->limit($this->limitOffset, $this->limitLength)
            ->with(['user','package'])
            ->order(['id' => 'desc'])
            ->select()
            ->toArray();
    }


    /**
     * @notes 获取数量
     * @return int
     * @author likeadmin
     * @date 2024/11/07 15:00
     */
    public function count(): int
    {
        return DhOrder::where($this->searchWhere)->count();
    }

}