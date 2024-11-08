<?php

namespace app\api\lists\digitalhuman;

use app\api\lists\BaseApiDataLists;
use app\common\model\digitalhuman\DhVoiceText;

class VoiceTextLists extends BaseApiDataLists
{

    public function lists(): array
    {
        $lists = (new DhVoiceText())
            ->order(['sort' => 'asc', 'id' => 'desc'])
            ->select()->toArray();

        return $lists;
    }

    public function count(): int
    {
        return (new DhVoiceText())->count();
    }
}
