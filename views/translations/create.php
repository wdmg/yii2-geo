<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeoTranslations */

$this->title = Yii::t('app/modules/geo', 'Add new translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-translations-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
