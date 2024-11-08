<?php

namespace app\api\controller\digitalhuman;

use app\api\controller\BaseApiController;
use app\api\lists\digitalhuman\VoiceTextLists;

class VoiceTextController extends BaseApiController
{
    public array $notNeedLogin = ['lists'];


    public function lists()
    {
        return $this->dataLists(new  VoiceTextLists());
    }
}
