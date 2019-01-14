<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeoTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geo-translations-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        if($model->id) {
            $source_id_attr = ['readonly' => true];
            $source_type_attr = ['disabled' => 'disabled'];
        } else {
            $source_id_attr = [];
            $source_type_attr = [];
        }
    ?>
    <?= $form->field($model, 'source_id')->textInput($source_id_attr) ?>

    <?= $form->field($model, 'source_type')->dropDownList([
        $model::TR_COUNTRY => Yii::t('app/modules/geo','Country'),
        $model::TR_REGION => Yii::t('app/modules/geo','Region'),
        $model::TR_CITY => Yii::t('app/modules/geo','City'),
    ], $source_type_attr); ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'translation')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['translations/index'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/geo', 'Save translation'), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
