<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
use app\models\Station;

$this->title=Yii::t('app','Operational expenses '.Station::find()->where(['id'=>$station])->one()->nom.' on '.$date);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dechargement Depenses'), 'url' => ['/reports/dechargement-depenses?start='.$start.'&end='.$end.'&reference=']];
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
        'group'=>True,
    
     ],
     [
        // 'label'=>'Date',
        'attribute'=>'description',
        // 'pageSummary'=>"Total",
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
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],



    ],



]);
?>