<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
use app\models\Station;

$this->title=Yii::t('app','Depense from '.$start. ' to '.$end);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report'), 'url' => ['index']];
?>

<?=GridView::widget([
  'dataProvider'=>$dataProvider,
  'summary'=>Yii::t('app','Showing {totalCount}'),
  'showPageSummary'=>true,
  'panel'=>['type'=>'info','heading'=>$this->title],
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
        'value'=>function($model){

          $station =Station::find()->where(['id'=>$model['station']])->one();

          if($station){
            return $station->nom;
          }
          else{
            return "";
          }
          
        }
        
        // 'format'=>['decimal',2],
        // 'pageSummary'=>true,
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

    //   [
    //     'label'=>'USD',
    //     'value'=>function($model){
    //         return $model['id'];
    //     }
    //     // 'pageSummary'=>true,
    //   ],
    //  [
    //    'attribute'=>'quantite_finale',
    //    'format'=>['decimal',2],
    // //    'pageSummary'=>true,
    //  ],


    ],
  // 'rowOptions'   => function ($model, $key, $index, $grid) {
  //   return ['spare_part' => $model->spare_part];
//},


]);
?>