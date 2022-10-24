<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Station;
use app\models\Produit;
use app\modules\api\modules\v1\models\User;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Supplies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supply-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Supply'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'label'=>'created_by',
                'value'=>function($model)
                {
                    $user=User::find()->where(['id'=>$model->created_by])->one();
                    if(!empty($user))
                    return $user->name;
                    return " ";
                }
            ],
            'nom_client',
            'telephone',
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
            //'usd',
            //'cdf',
            //'tank',
            //'produit',
            //'station',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'account',
            //'payment_mode',
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
            //     'urlCreator' => function ($action, app\models\Supply $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>


</div>
