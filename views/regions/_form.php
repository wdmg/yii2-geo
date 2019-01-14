<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeoRegions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geo-regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_published')->checkbox(['label' => '- '.$model->getAttributeLabel('is_published')]) ?>


    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['regions/index'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/geo', 'Save region'), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
