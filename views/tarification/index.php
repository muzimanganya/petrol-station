<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TarificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tarifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tarification'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
                'label'=>'Produit',
                // 'attribute'=>'produit',
                'value'=>function($model)
                {
                    return Produit::find()->where(['id'=>$model->produit])->one()->nom;
                }
            ],
            [
                'label'=>'Station',
                'value'=>function($model)
                {
                    return Station::find()->where(['id'=>$model->station])->one()->nom;
                }
            ],
            [
                'label'=>'USD price',
                'attribute'=>'usd_price',
            ],
            [
                'label'=>'FC price',
                'attribute'=>'cdf_price',
            ],
            // 'usd_price',
            // 'cdf_price',
            //'station',
            'created_at:date',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Tarification $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station]);
                 }
            ],
        ],
    ]); ?>


</div>
