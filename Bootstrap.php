<?php

namespace wdmg\geo;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // Get the module instance
        $module = Yii::$app->getModule('geo');

        // Add module URL rules.
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        $app->getUrlManager()->addRules(
            [
                $prefix.'<_m>' => '<_m>/admin/index',
                $prefix.'<_m>/<_c>' => '<_m>/<_c>/index',
            ],
            false
        );

        /*$app->controllerMap["migrate"]["class"] = 'yii\console\controllers\MigrateController';
        $app->controllerMap["migrate"]["migrationNamespaces"][] = 'wdmg\geo\migrations';*/
    }
}
