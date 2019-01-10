<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeoRegionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            <a data-toggle="collapse" href="#geoRegionsSearch">
                <span class="glyphicon glyphicon-search"></span> <?= Yii::t('app/modules/geo', 'Regions search') ?>
            </a>
        </h5>
    </div>
    <div id="geoRegionsSearch" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="geo-regions-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                <?= $form->field($model, 'id') ?>

                <?= $form->field($model, 'country_id') ?>

                <?= $form->field($model, 'title') ?>

                <?= $form->field($model, 'slug') ?>

                <?= $form->field($model, 'created_at') ?>

                <?= $form->field($model, 'updated_at') ?>

                <?= $form->field($model, 'is_published') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app/modules/geo', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app/modules/geo', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>