# Yii2 GEO Module
Geo module with countries and cities

# Requirements 
* PHP 5.6 or higher
* Yii2 v.2.0.10 and newest

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

and Bootstrap section:

`
$config['bootstrap'][] = 'wdmg\geo\Bootstrap';
`

# Routing
`http://example.com/admin/geo` - Module dashboard

# Status and version
v.1.0.3 - GridView search and filters, UI translation.
v.1.0.2 - Added routing path to Bootstrap.
v.1.0.1 - Added migrations path to Bootstrap.
v.1.0.0 - Module in progress development.

\* - The demo database contains 144 countries, 111 regions and 4923 cities of such countries as: Russia, Ukraine, Kazakhstan, Azerbaijan, Belarus, Moldova, Poland, South Ossetia, Georgia, Kyrgyzstan, Uzbekistan and contains a total of 20863 translations in EN, UK (Ukrainian), PL, DE.
Sources of demo data of countries, cities and regions are initially presented in Russian.