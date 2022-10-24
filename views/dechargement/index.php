<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DechargementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Achat');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dechargement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Dechargement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no',
            // 'produit',
            [
                'label'=>'Produit',
                'attribute'=>'produit',
                'value'=>function($model){

                    return Yii::$app->db->createCommand("SELECT nom from produit where id=$model->produit")->queryScalar();

                }

            ],
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
            'quantite',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Dechargement $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'no' => $model->no]);
                 }
            ],
        ],
    ]); ?>


</div>
