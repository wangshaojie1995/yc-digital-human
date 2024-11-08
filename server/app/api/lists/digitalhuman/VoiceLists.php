<?php

namespace app\api\lists\digitalhuman;

use app\api\lists\BaseApiDataLists;
use app\common\model\digitalhuman\DhVoice;

class VoiceLists extends BaseApiDataLists
{

    public function lists(): array
    {
        $where = [];
        $where[] = ['uid', '=', $this->userId];

        $lists = (new DhVoice())
            ->where($where)
            ->order(['id' => 'desc'])
            ->limit($this->limitOffset, $this->limitLength)
            ->select()->toArray();

        return $lists;
    }

    public function count(): int
    {
        return (new DhVoice())->count();
    }
}
