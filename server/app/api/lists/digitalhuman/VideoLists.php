<?php

namespace app\api\lists\digitalhuman;

use app\api\lists\BaseApiDataLists;
use app\common\model\digitalhuman\DhVideo;

class VideoLists extends BaseApiDataLists
{

    public function lists(): array
    {
        $where = [];
        $where[] = ['uid', '=', $this->userId];

        $lists = (new DhVideo())
            ->where($where)
            ->order(['id' => 'desc'])
            ->limit($this->limitOffset, $this->limitLength)
            ->select()->toArray();

        return $lists;
    }

    public function count(): int
    {
        return (new DhVideo())->count();
    }
}
