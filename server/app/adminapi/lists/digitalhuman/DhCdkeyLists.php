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
use app\common\model\digitalhuman\DhCdkey;
use app\common\lists\ListsSearchInterface;


/**
 * DhCdkey列表
 * Class DhCdkeyLists
 * @package app\adminapi\listsdigitalhuman
 */
class DhCdkeyLists extends BaseAdminDataLists implements ListsSearchInterface
{


    /**
     * @notes 设置搜索条件
     * @return \string[][]
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public function setSearch(): array
    {
        return [
            '=' => ['used_status', 'code', 'status', 'points'],
        ];
    }


    /**
     * @notes 获取列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public function lists(): array
    {
        return DhCdkey::where($this->searchWhere)
            ->field(['id', 'used_status', 'code', 'status', 'points'])
            ->limit($this->limitOffset, $this->limitLength)
            ->order(['id' => 'desc'])
            ->select()
            ->toArray();
    }


    /**
     * @notes 获取数量
     * @return int
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public function count(): int
    {
        return DhCdkey::where($this->searchWhere)->count();
    }

}