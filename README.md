[![Progress](https://img.shields.io/badge/required-Yii2_v2.0.33-blue.svg)](https://packagist.org/packages/yiisoft/yii2)
[![Github all releases](https://img.shields.io/github/downloads/wdmg/yii2-geo/total.svg)](https://GitHub.com/wdmg/yii2-geo/releases/)
[![GitHub version](https://badge.fury.io/gh/wdmg%2Fyii2-geo.svg)](https://github.com/wdmg/yii2-geo)
![Progress](https://img.shields.io/badge/progress-in_development-red.svg)
[![GitHub license](https://img.shields.io/github/license/wdmg/yii2-geo.svg)](https://github.com/wdmg/yii2-geo/blob/master/LICENSE)

# Yii2 GEO Module
Geo module with countries and cities

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.33 and newest
* [Yii2 Base](https://github.com/wdmg/yii2-base) module (required)

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-geo"`

After configure db connection, run the following command in the console:

`$ php yii geo/init`

And select the operation you want to perform:
  1) Apply all module migrations
  2) Revert all module migrations
  3) Batch insert demo data<sup>*</sup>

# Migrations
In any case, you can execute the migration and create the initial data, run the following command in the console:

`$ php yii migrate --migrationPath=@vendor/wdmg/yii2-geo/migrations`

# Configure
To add a module to the project, add the following data in your configuration file:

    'modules' => [
        ...
        'geo' => [
            'class' => 'wdmg\geo\Module',
            'routePrefix' => 'admin'
        ],
        ...
    ],

# Routing
Use the `Module::dashboardNavItems()` method of the module to generate a navigation items list for NavBar, like this:

    <?php
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
            'label' => 'Modules',
            'items' => [
                Yii::$app->getModule('geo')->dashboardNavItems(),
                ...
            ]
        ]);
    ?>

# Status and version [in progress development]
* v.1.1.8 - Up to date dependencies
* v.1.1.7 - Fixed deprecated class declaration
* v.1.1.6 - Added extra options to composer.json (for Butterfly.CMS implementation)
* v.1.1.5 - Added choice param for non interactive mode
* v.1.1.4 - Module refactoring
* v.1.1.3 - Module transferred to base module interface. Update Yii2 version.

\* - The demo database contains 144 countries, 111 regions and 4923 cities of such countries as: Russia, Ukraine, Kazakhstan, Azerbaijan, Belarus, Moldova, Poland, South Ossetia, Georgia, Kyrgyzstan, Uzbekistan and contains a total of 20863 translations in EN, UK (Ukrainian), PL, DE.
Sources of demo data of countries, cities and regions are initially presented in Russian.