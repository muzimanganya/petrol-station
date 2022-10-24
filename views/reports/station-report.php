<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
// use app\models\SpareParts;

$this->title=Yii::t('app','Station Report');
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
        'label'=>'vente en FC',
        'attribute'=>'vcdf',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'label'=>'Vente en USD',
        'attribute'=>'vusd',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'label'=>'depense en FC',
        'attribute'=>'dcdf',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'depense en USD',
        'attribute'=>'dusd',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'profit en USD',
        'attribute'=>'profit_usd',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'label'=>'versement Banque en CDF',
        'attribute'=>'cdf_versement_bank',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'versement Banque en USD',
        'attribute'=>'usd_versement_bank',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'reste en compte cdf',
        'attribute'=>'rcdf',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'label'=>'reste en compte usd',
        'attribute'=>'rusd',
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