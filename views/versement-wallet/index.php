<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Wallet;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VersementWalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Versement Wallets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="versement-wallet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Versement Wallet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'wallet_from',
            // 'wallet_to',
            [
                'label'=>'Wallet From',
                'attribute'=>'wallet_from',
                'value'=>function($model){
                    return Wallet::find()->where(['id'=>$model['wallet_from']])->one()->name;
                }
                           
            ],
            [
                'label'=>'Wallet To',
                'attribute'=>'wallet_to',
                'value'=>function($model){
                    return Wallet::find()->where(['id'=>$model['wallet_to']])->one()->name;
                }
                           
            ],
            [
                'label'=>'USD',
                'attribute'=>'usd',
            ],
            [
                'label'=>'FC',
                'attribute'=>'cdf',
            ],
            // 'amount',
            // 'currency',
            //'balance_from',
            //'balance_to',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\VersementWallet $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
