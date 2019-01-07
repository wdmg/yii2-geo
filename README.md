# Yii2 GEO Module
Geo module with countries and cities

#Requirements 
* PHP 5.6
* Yii2 (v.2.0.10)

# Installation
To install the module, run the following command in the console:

`$ composer require "wdmg/yii2-geo"`

After configure db connection, run the following command in the console:

`$ php yii geo/init`

And select the operation you want to perform:
  1) Apply all module migrations
  2) Revert all module migrations
  3) Batch insert demo data

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
`http://example.com/admin/geo` - Module dashboard

# Status and version
v.1.0.2 - Added routing path to Bootstrap.
v.1.0.1 - Added migrations path to Bootstrap.
v.1.0.0 - Module in progress development.