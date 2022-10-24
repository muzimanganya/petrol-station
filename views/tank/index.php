<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Tank;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tanks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'New Tank'), ['create'], ['class' => 'btn btn-primary pull-right']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'capacity',
            
            [
                'attribute'=>'produit',
                'value'=>function($model)
                {
                    
                    return Produit::find()->where(['id'=>$model->produit])->one()->nom;
                }
            ],
            [
                'attribute'=>'station',
                'value'=>function($model)
                {
                    
                    return Station::find()->where(['id'=>$model->station])->one()->nom;
                }
            ],
            
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            'location',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tank $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            
        ],
    ]); ?>


</div>
