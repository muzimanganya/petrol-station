<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
// use app\models\SpareParts;

$this->title=Yii::t('app','Summary Report');
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
        'attribute'=>'little_in',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'attribute'=>'little_out',
        'format'=>['decimal',2],
       'pageSummary'=>true,
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
     [
       'attribute'=>'cdf_versement',
       'format'=>['decimal',2],
       'pageSummary'=>true,
     ],

     [
        'attribute'=>'usd_versement',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'attribute'=>'depense_cdf',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'attribute'=>'depense_usd',
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