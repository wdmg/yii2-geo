<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeoRegions */

$this->title = Yii::t('app/modules/geo', 'View region: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-regions-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'country_id',
                'format' => 'raw',
                'label' => Yii::t('app/modules/geo', 'Country'),
                'value' => function($model) {
                    if($model->country_id)
                        return Html::a($model->country['title'], ['../admin/geo/countries/view/?id='.$model->country_id], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]) . ' (ID: '.$model->country_id.')';
                    else
                        return null;
                },
            ],
            'title',
            [
                'attribute' => 'translations',
                'format' => 'raw',
                'value' => function($model) {
                    $values = '';
                    foreach ($model->translations as $key => $value) {
                        $values .= $value->translation . ' ('.$value->language.')';
                        if(intval($key+1) < count($model->translations))
                            $values .= ', ';
                    }
                    return $values;
                }
            ],
            'slug',
            [
                'attribute' => 'created_at',
                'format' => 'datetime'
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'is_published',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->is_published)
                        return '<span class="glyphicon glyphicon-check text-success"></span>';
                    else
                        return '<span class="glyphicon glyphicon-check text-muted"></span>';
                },
            ],
        ],
    ]) ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['regions/index'], ['class' => 'btn btn-default']) ?>
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
