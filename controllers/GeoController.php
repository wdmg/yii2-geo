<?php

namespace wdmg\geo\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * GeoController controller for the `geo` module
 */
class GeoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}
