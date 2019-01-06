<?php

namespace wdmg\geo\controllers;

use yii\web\Controller;

/**
 * Default controller for the `geo` module
 */
class AdminController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
