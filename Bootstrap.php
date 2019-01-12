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

        // Get URL path prefix if exist
        $prefix = (isset($module->routePrefix) ? $module->routePrefix . '/' : '');

        // Add module URL rules
        $app->getUrlManager()->addRules(
            [
                $prefix.'<controller:(geo|countries|regions|cities|translations)>/' => 'geo/<controller>/index',
                $prefix.'geo/<controller:(geo|countries|regions|cities|translations)>/<action:\w+>' => 'geo/<controller>/<action>',
                $prefix.'<controller:(geo|countries|regions|cities|translations)>/<action:\w+>' => 'geo/<controller>/<action>',
            ],
            false
        );
    }
}