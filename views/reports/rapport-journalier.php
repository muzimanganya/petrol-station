<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap4;
// use app\models\RetailsInfo;
// use app\models\SpareParts;


$this->title=Yii::t('app','Rapport Journalier');
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

    
     'date',
     [
      'attribute'=>'station',
    //   'format'=>['decimal',2],
    //  'pageSummary'=>true,
      ],
      [
        'attribute'=>'index_debut',
      //   'format'=>['decimal',2],
      //  'pageSummary'=>true,
        ],

        [
            'attribute'=>'index_fin',
          //   'format'=>['decimal',2],
          //  'pageSummary'=>true,
         ],
         [
            'attribute'=>'sortie_pompe',
          //   'format'=>['decimal',2],
          //  'pageSummary'=>true,
         ],
         [
           'attribute'=>'stock_physique',
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
        'attribute'=>'depense_usd',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
 
      [
        'attribute'=>'credit_montant_usd',
        'format'=>['decimal',2],
      ],
      [
        'attribute'=>'quantite',
        'format'=>['decimal',2],
  
      ],
      [
        'attribute'=>'total_credit',
        'format'=>['decimal',2],
      ],


    ],
  // 'rowOptions'   => function ($model, $key, $index, $grid) {
  //   return ['spare_part' => $model->spare_part];
//},


]);
?>
</div>