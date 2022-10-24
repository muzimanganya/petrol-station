<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
// use app\models\SpareParts;

$this->title=Yii::t('app','opérations bancaires');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
?>

<?=GridView::widget([
  'dataProvider'=>$dataProvider,
  'summary'=>Yii::t('app','Showing {totalCount}'),
  'showPageSummary'=>true,
  'panel'=>['type'=>'dark','heading'=>$this->title],
  'columns'=>[
     ['class'=>'kartik\grid\SerialColumn'],
     //'spare_part',

    
    //  '_date',
     [
        'attribute'=>'_date',
        'group'=>true,
     ],
     [
        'label'=>'Wallet From',
        'attribute'=>'_from',

      ],
      [
        'label'=>'FC',
        'attribute'=>'CDF',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
     [
       'attribute'=>'USD',
       'format'=>['decimal',2],
       'pageSummary'=>true,
     ],


    ],
  // 'rowOptions'   => function ($model, $key, $index, $grid) {
  //   return ['spare_part' => $model->spare_part];
//},


]);
?>