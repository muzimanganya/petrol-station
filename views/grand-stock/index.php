<?php

use app\models\GrandStock;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GrandStockSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Grand Stocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grand-stock-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Grand Stock'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'produit',
            [
                'label'=>'Produit',
                'attribute'=>'produit',
                'value'=>function($model){

                    return Yii::$app->db->createCommand("SELECT nom from produit where id=$model->produit")->queryScalar();

                }

            ],
            'quantite',
            'buying_price',
            'selling_price',
            // 'currency',
            [
                'label'=>'Currency',
                'attribute'=>'currency',
                'value'=>function($model){

                    if($model->currency == "usd"){
                        return "USD";
                    }
                    else if($model->currency=='cdf'){
                        return "FC";
                    }
                    else{
                        return "Not specified";
                    }
                }

            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GrandStock $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
