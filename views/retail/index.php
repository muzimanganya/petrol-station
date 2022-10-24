<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Retails');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Retail'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'produit',
             'id',
            [
                'label'=>'Produit',
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
            'plaque',
            'quantite',
            'prix',
            [
                'label'=>'USD',
                'attribute'=>'usd',
            ],
            [
                'label'=>'FC',
                'attribute'=>'cdf',
            ],
           
            //'station',

            //'tank',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            'payment_mode',
            'account',
            'receivable',
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
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, app\models\Retail $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>
