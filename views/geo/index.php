<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $this->context->module->name;
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
    </div>

    <div>
        <?= Html::a(Yii::t('app/modules/geo', 'View Countries'), ['countries/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'View Regions'), ['regions/index'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'View Cities'), ['cities/index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'View Translations'), ['translations/index'], ['class' => 'btn btn-warning']) ?>
    </div>

<?php echo $this->render('../_debug'); ?>