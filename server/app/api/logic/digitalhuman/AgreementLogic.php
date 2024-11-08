<?php

namespace app\api\logic\digitalhuman;

use app\common\logic\BaseLogic;
use app\common\service\ConfigService;

class AgreementLogic extends BaseLogic
{

    public static function getConfig($type)
    {
        $content = ConfigService::get($type, $type.'_content', '');
        return $content;
    }
}
