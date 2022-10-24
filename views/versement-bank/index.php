<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Wallet;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VersementBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Versement Banks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="versement-bank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Versement Bank'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'wallet',
            [
                'label'=>'Wallet From',
                'attribute'=>'wallet',
                'value'=>function($model){
                    return Wallet::find()->where(['id'=>$model['wallet']])->one()->name;
                }
                           
            ],
            'account',
            [
                'label'=>'FC',
                'attribute'=>'cdf',
            ],
            [
                'label'=>'USD',
                'attribute'=>'usd',
            ],
            // 'amount',
            // 'currency',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            // 'balance',
            [
                'label'=>'Wallet Balance',
                'attribute'=>'balance',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\VersementBank $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
