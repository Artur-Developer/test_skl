<?php

use app\models\currency\Currency;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\currency\CurrencySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'rate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Currency $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template'=> '{view}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
