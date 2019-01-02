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
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'wdmg\geo\commands';
        }
    }
}
