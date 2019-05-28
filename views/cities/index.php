<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GeoCitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/geo', 'Cities');
$this->params['breadcrumbs'][] = ['label' => $this->context->module->name, 'url' => ['geo/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="geo-cities-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{summary}<br\/>{items}<br\/>{summary}<br\/><div class="text-center">{pager}</div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'country_id',
                'header' => Yii::t('app/modules/geo', 'Country'),
                'format' => 'raw',
                'value' => function($model) {
                    if($model->country_id)
                        return Html::a($model->country['title'], ['../admin/geo/countries/view/?id='.$model->country_id], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                    else
                        return null;
                },
            ],
            [
                'attribute' => 'region_id',
                'header' => Yii::t('app/modules/geo', 'Region'),
                'format' => 'raw',
                'value' => function($model) {
                    if($model->region_id)
                        return Html::a($model->region['title'], ['../admin/geo/regions/view/?id='.$model->region_id], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                    else
                        return null;
                },
            ],
            'title',
            'slug',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'is_capital',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function($data) {
                    if ($data->is_capital)
                        return '<span class="glyphicon glyphicon-check text-success"></span>';
                    else
                        return '<span class="glyphicon glyphicon-check text-muted"></span>';
                },
            ],
            [
                'attribute' => 'is_published',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function($data) {
                    if ($data->is_published)
                        return '<span class="glyphicon glyphicon-check text-success"></span>';
                    else
                        return '<span class="glyphicon glyphicon-check text-muted"></span>';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app/modules/geo', 'Actions'),
                'contentOptions' => [
                    'class' => 'text-center'
                ],
            ],
        ],
        'pager' => [
            'options' => [
                'class' => 'pagination',
            ],
            'maxButtonCount' => 5,
            'activePageCssClass' => 'active',
            'linkContainerOptions' => [
                'class' => 'linkContainerOptions',
            ],
            'linkOptions' => [
                'class' => 'linkOptions',
            ],
            'prevPageCssClass' => '',
            'nextPageCssClass' => '',
            'firstPageCssClass' => 'previous',
            'lastPageCssClass' => 'next',
            'firstPageLabel' => Yii::t('app/modules/geo', 'First page'),
            'lastPageLabel'  => Yii::t('app/modules/geo', 'Last page'),
            'prevPageLabel'  => Yii::t('app/modules/geo', '&larr; Prev page'),
            'nextPageLabel'  => Yii::t('app/modules/geo', 'Next page &rarr;')
        ],
    ]); ?>

    <div>
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to module'), ['../admin/geo'], ['class' => 'btn btn-default pull-left']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Add new city'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
