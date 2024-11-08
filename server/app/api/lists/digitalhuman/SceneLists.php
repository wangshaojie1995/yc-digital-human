<?php

namespace app\api\lists\digitalhuman;

use app\api\lists\BaseApiDataLists;
use app\common\model\digitalhuman\DhScene;

class SceneLists extends BaseApiDataLists
{

    public function lists(): array
    {
        $where = [];
        $where[] = ['uid', '=', $this->userId];

        $data = $this->request->get();
        if (isset($data['status'])) {
            $where[] = ['status', '=', $data['status']];
        }
        $lists = (new DhScene())
            ->where($where)
            ->order(['id' => 'desc'])
            ->limit($this->limitOffset, $this->limitLength)
            ->select()->toArray();

        return $lists;
    }

    public function count(): int
    {
        return (new DhScene())->count();
    }
}
  