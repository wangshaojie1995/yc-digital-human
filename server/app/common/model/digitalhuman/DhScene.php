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
namespace app\common\model\digitalhuman;


use app\common\service\FileService;

 
class DhScene extends DhBaseModel
{

    protected $name = 'dh_scene';



    /**
     * @notes 关联user
     * @return \think\model\relation\HasOne
     * @author likeadmin
     * @date 2024/11/06 11:33
     */
    public function user()
    {
        return $this->hasOne(\app\common\model\user\User::class, 'id', 'uid');
    }

    public function getCoverImageAttr($value)
    {
        if (!$value) {
            return '';
        }
        return FileService::getFileUrl($value);
    }

    public function getLocalVideoUrlAttr($value)
    {
        if (!$value) {
            return '';
        }
        return FileService::getFileUrl($value);
    }
}
