<?php

namespace wdmg\geo;

use Yii;


/**
 * geo module definition class
 */
class Module extends \yii\base\Module
{

    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'wdmg\geo\controllers';

    /**
     * @var string the prefix for routing of module
     */
    public $routePrefix = "admin";

    /**
     * @var string the vendor name of module
     */
    public $vendor = "wdmg";

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'wdmg\geo\commands';
        }

        Yii::$app->language = 'ru-RU';

        // Register custom translations for this module
        $this->registerTranslations();
    }

    // Registers translations for the module
    public function registerTranslations()
    {

        /**This registers translations for the Foo module **/
        Yii::$app->i18n->translations['app/modules/geo*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@vendor/wdmg/yii2-geo/messages',
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('app/modules/geo' . $category, $message, $params, $language);
    }
}
