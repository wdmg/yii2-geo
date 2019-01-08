<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeoRegions */

$this->title = Yii::t('app/modules/geo', 'Edit region: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/geo', 'Update');
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-regions-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
