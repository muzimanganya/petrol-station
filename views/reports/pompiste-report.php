<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap4;
// use app\models\RetailsInfo;
// use app\models\SpareParts;


$this->title=Yii::t('app','Pompiste Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
?>
<div id="container" style="width: 100%;">
<?=GridView::widget([
  'dataProvider'=>$dataProvider,
  'summary'=>Yii::t('app','Showing {totalCount}'),
  'showPageSummary'=>true,
  'panel'=>['type'=>'dark','heading'=>$this->title],
  'columns'=>[
     ['class'=>'kartik\grid\SerialColumn'],
     //'spare_part',

    
     '_date',
     [
      'attribute'=>'station',
    //   'format'=>['decimal',2],
    //  'pageSummary'=>true,
      ],
      [
        'attribute'=>'_user',
      //   'format'=>['decimal',2],
      //  'pageSummary'=>true,
        ],

      [
        'label'=>'FC',
        'attribute'=>'cdf',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'attribute'=>'usd',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
 


    ],
  // 'rowOptions'   => function ($model, $key, $index, $grid) {
  //   return ['spare_part' => $model->spare_part];
//},


]);
?>
</div>