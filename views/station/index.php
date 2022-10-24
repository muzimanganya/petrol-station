<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Station;
use app\modules\api\modules\v1\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stations');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
     
      
      btn-primary.right {
        float: right;
      }
    </style>
<div class="station-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Station'), ['create'], ['class' => 'btn btn-primary pull-center']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nom',
            'address',
            'created_at:datetime',
            [
                'label'=>'created_by',
                'value'=>function($model)
                {
                    return User::find()->where(['id'=>$model->created_by])->one()->name;
                }
            ],
            
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Station $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
