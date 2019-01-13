<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GeoTranslations */

$this->title = Yii::t('app/modules/geo', 'View translation: {name}', [
    'name' => '#'.$model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Translations'), 'url' => ['index']];
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
                'attribute' => 'language',
                'value' => function($model) {
                    if(class_exists('Locale'))
                        return \Locale::getDisplayLanguage($model->language, Yii::$app->language). ' ('.$model->language.')';
                    else
                        return $model->language;
                }
            ],
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
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to list'), ['translations/index'], ['class' => 'btn btn-default']) ?>
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
