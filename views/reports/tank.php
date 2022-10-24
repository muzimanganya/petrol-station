<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use app\models\Produit;
use app\models\Station;
use app\models\Tank;

$this->title=Yii::t('app','Movement Stock from '.$start. ' to '.$end);
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
      'attribute'=>'tank',
      'value'=>function($model){
        $produit=Tank::find()->where(['id'=>$model['tank']])->one()->produit;
        $station=Tank::find()->where(['id'=>$model['tank']])->one()->station;

        return 'TANK '.$model['tank'].' '.Produit::find()->where(['id'=>$produit])->one()->nom;
      }
    ],
     [
        'label'=>'Littles in',
        'attribute'=>'little_in',
        'format'=>['decimal',2],
        'pageSummary'=>true,
     ],
     [
        'label'=>'Littles out',
        'attribute'=>'little_out',
        'format'=>['decimal',2],
        'pageSummary'=>true,
     ],

    ],


]);
?>