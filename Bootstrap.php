<?php

namespace wdmg\geo;

/**
 * @author          Alexsander Vyshnyvetskyy <alex.vyshnyvetskyy@gmail.com>
 * @copyright       Copyright (c) 2019 W.D.M.Group, Ukraine
 * @license         https://opensource.org/licenses/MIT Massachusetts Institute of Technology (MIT) License
 */

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
                $prefix . '<module:geo>/' => '<module>/geo/index',
                $prefix . '<module:geo>/<controller:(geo|countries|regions|cities|translations)>/' => '<module>/<controller>',
                $prefix . '<module:geo>/<controller:(geo|countries|regions|cities|translations)>/<action:\w+>' => '<module>/<controller>/<action>',
                [
                    'pattern' => $prefix . '<module:geo>/',
                    'route' => '<module>/geo/index',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:geo>/<controller:(geo|countries|regions|cities|translations)>/',
                    'route' => '<module>/<controller>',
                    'suffix' => '',
                ], [
                    'pattern' => $prefix . '<module:geo>/<controller:(geo|countries|regions|cities|translations)>/<action:\w+>',
                    'route' => '<module>/<controller>/<action>',
                    'suffix' => '',
                ],
            ],
            true
        );

    }
}