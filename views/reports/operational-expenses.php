<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
use app\models\Station;

$this->title=Yii::t('app','Operational expenses from '.$start. ' to '.$end);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
?>

<?=GridView::widget([
  'dataProvider'=>$dataProvider,
  'summary'=>Yii::t('app','Showing {totalCount}'),
  'showPageSummary'=>true,
  'panel'=>['type'=>'secondary','heading'=>$this->title],
  'columns'=>[
     ['class'=>'kartik\grid\SerialColumn'],
     //'spare_part',

    
     [
        'label'=>'Date',
        'attribute'=>'_date',
        'pageSummary'=>"Total",
     ],
     [
        'attribute'=>'station',
        'format'=>'Html',
        // 'pageSummary'=>true,
        'value'=>function($model) 
        {
            return Html::a(Station::find()->where(['id'=>$model['station']])->one()->nom, ['operational-expenses-details', 'station'=>$model['station'],'date'=>$model['_date'],'start'=>$_REQUEST['start'],'end'=>$_REQUEST['end']]);
        },
      ],
      [
        'label'=>'USD',
        'attribute'=>'dusd',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'FC',
        'attribute'=>'dcdf',
        'pageSummary'=>true,
      ],



    ],



]);
?>