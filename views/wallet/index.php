<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\WalletSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wallets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Wallet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            // 'balance_usd',
            // 'balance_cdf',
            [
                'label'=>'balance USD',
                'attribute'=>'balance_usd',
            ],
            [
                'label'=>'balance FC',
                'attribute'=>'balance_cdf',
            ],
           
            'station',
            // 'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
            
        ],
    ]); ?>


</div>
