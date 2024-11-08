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

namespace app\adminapi\logic\digitalhuman;


use app\common\model\digitalhuman\DhCdkey;
use app\common\logic\BaseLogic;
use think\facade\Db;


/**
 * DhCdkey逻辑
 * Class DhCdkeyLogic
 * @package app\adminapi\logic\digitalhuman
 */
class DhCdkeyLogic extends BaseLogic
{


    /**
     * @notes 添加
     * @param array $params
     * @return bool
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public static function add(array $params): bool
    {
        Db::startTrans();
        try {
            $data = self::generateUniqueArr($params['number'], $params['points']);
            $model = new DhCdkey();
            $model->saveAll($data);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            self::setError($e->getMessage());
            return false;
        }
    }


    private static function generateUniqueArr($count, $points)
    {
        $arr = [];
        for ($i = 0; $i < $count; $i++) {
            end:
            $suffix = uniqid(); // 生成唯一的后缀

            $uniqueString = $suffix;
            $uniqueStrings = strtoupper($uniqueString);
            $info = DhCdkey::where('code', $uniqueStrings)->find();
            if ($info) {
                goto end;
            }
            $temp = [
                'code' => $uniqueStrings,
                'used_status' => '1',
                'points' => $points
            ];
            $arr[] = $temp;
        }

        return $arr;
    }


    /**
     * @notes 编辑
     * @param array $params
     * @return bool
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public static function edit(array $params): bool
    {
        Db::startTrans();
        try {
            DhCdkey::where('id', $params['id'])->update([
                'used_status' => $params['used_status'],
                'code' => $params['code'],
                'status' => $params['status'],
                'points' => $params['points']
            ]);

            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            self::setError($e->getMessage());
            return false;
        }
    }


    /**
     * @notes 删除
     * @param array $params
     * @return bool
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public static function delete(array $params): bool
    {
        return DhCdkey::destroy($params['id']);
    }


    /**
     * @notes 获取详情
     * @param $params
     * @return array
     * @author likeadmin
     * @date 2024/11/06 10:58
     */
    public static function detail($params): array
    {
        return DhCdkey::findOrEmpty($params['id'])->toArray();
    }
}
