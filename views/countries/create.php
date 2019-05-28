<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeoCountries */

$this->title = Yii::t('app/modules/geo', 'Add new country');
$this->params['breadcrumbs'][] = ['label' => $this->context->module->name, 'url' => ['geo/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Countries'), 'url' => ['countries/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-countries-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
