<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeoCities */
$this->title = Yii::t('app/modules/geo', 'View city: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-cities-view">

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
            [
                'attribute' => 'region_id',
                'format' => 'raw',
                'label' => Yii::t('app/modules/geo', 'Region'),
                'value' => function($model) {
                    if($model->region_id)
                        return Html::a($model->region['title'], ['../admin/geo/regions/view/?id='.$model->region_id], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]) . ' (ID: '.$model->region_id.')';
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
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $created = new DateTime($data->created_at);
                    $interval = $datenow->diff($created);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->created_at) . $along;
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $updated = new DateTime($data->updated_at);
                    $interval = $datenow->diff($updated);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->updated_at) . $along;
                }
            ],
            [
                'attribute' => 'is_capital',
                'format' => 'html',
                'value' => function($model) {
                    if ($model->is_capital)
                        return '<span class="glyphicon glyphicon-check text-success"></span>';
                    else
                        return '<span class="glyphicon glyphicon-check text-muted"></span>';
                },
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

    <p>
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['cities/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/geo', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
