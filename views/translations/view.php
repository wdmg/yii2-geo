<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeoTranslations */

$this->title = Yii::t('app/modules/geo', 'View translation: {name}', [
    'name' => '#'.$model->id,
]);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->name, 'url' => ['geo/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Translations'), 'url' => ['translations/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-translations-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'source_id',
                'format' => 'raw',
                'label' => Yii::t('app/modules/geo', 'Source'),
                'value' => function($model) {
                    if($model->source_id) {
                        if ($model->source_type == wdmg\geo\models\GeoTranslations::TR_COUNTRY) {
                            return Html::a($model->source['title'], ['../admin/geo/countries/view/?id='.$model->source_id], [
                                    'target' => '_blank',
                                    'data-pjax' => 0
                                ]) . ' (ID: '.$model->source_id.')';
                        } elseif ($model->source_type == wdmg\geo\models\GeoTranslations::TR_REGION) {
                            return Html::a($model->source['title'], ['../admin/geo/regions/view/?id='.$model->source_id], [
                                    'target' => '_blank',
                                    'data-pjax' => 0
                                ]) . ' (ID: '.$model->source_id.')';
                        } elseif ($model->source_type == wdmg\geo\models\GeoTranslations::TR_CITY) {
                            return Html::a($model->source['title'], ['../admin/geo/cities/view/?id='.$model->source_id], [
                                    'target' => '_blank',
                                    'data-pjax' => 0
                                ]) . ' (ID: '.$model->source_id.')';
                        } else {
                            return $model->source_id;
                        }
                    } else {
                        return null;
                    }
                },
            ],
            [
                'attribute' => 'language',
                'value' => function($model) {
                    if(class_exists('Locale'))
                        return \Locale::getDisplayLanguage($model->language, Yii::$app->language). ' ('.$model->language.')';
                    else
                        return $model->language;
                }
            ],
            [
                'attribute' => 'source_type',
                'value' => function($model) {
                    if ($model->source_type == wdmg\geo\models\GeoTranslations::TR_COUNTRY)
                        return Yii::t('app/modules/geo','Country');
                    elseif ($model->source_type == wdmg\geo\models\GeoTranslations::TR_REGION)
                        return Yii::t('app/modules/geo','Region');
                    elseif ($model->source_type == wdmg\geo\models\GeoTranslations::TR_CITY)
                        return Yii::t('app/modules/geo','City');
                    else
                        return false;
                },
            ],
            'translation',
            [
                'attribute' => 'created_at',
                'format' => 'datetime'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
            ],
        ],
    ]) ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['translations/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/geo', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
