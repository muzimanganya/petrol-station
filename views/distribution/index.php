<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DistributionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Distributions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribution-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Distribution'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dechargement',
            'stock_initiale',
            'quantite',
            'unit_price',
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
            'index_debut',
            'index_fin',
            'sortie_pompe',
            'quantite_finale',
            'station',
            'tank',
            //'transaction',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Distribution $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
