<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeoCountries */

$this->title = Yii::t('app/modules/geo', 'Edit country: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->name, 'url' => ['geo/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Countries'), 'url' => ['countries/index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/geo', 'Update');
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-countries-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
