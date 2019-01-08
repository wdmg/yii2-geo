<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GeoCitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/geo', 'Cities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/geo', 'Geo Module'), 'url' => ['../admin/geo']];
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'country_id',
            'region_id',
            'title',
            'slug',
            //'created_at',
            //'updated_at',
            //'is_capital',
            //'is_published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <div>
        <?= Html::a(Yii::t('app/modules/geo', '&larr; Back to module'), ['../admin/geo'], ['class' => 'btn btn-default pull-left']) ?>
        <?= Html::a(Yii::t('app/modules/geo', 'Add new city'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
