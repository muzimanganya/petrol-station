<?php

use kartik\grid\GridView;
use yii\helpers\Html;
// use app\models\RetailsInfo;
use app\models\Station;
use app\models\Tank;
use app\models\Produit;

$this->title=Yii::t('app','Dechargement Report');
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

    
     '_date',
     
      [
        'attribute'=>'quantite',
        'format'=>['decimal',2],
       'pageSummary'=>true,
      ],
      [
        'label'=>'Dechargement FC',
        'attribute'=>'dcdf',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
      [
        'label'=>'Dechargement USD',
        'attribute'=>'dusd',
        'format'=>['decimal',2],
        'pageSummary'=>true,
      ],
     


    ],
  // 'rowOptions'   => function ($model, $key, $index, $grid) {
  //   return ['spare_part' => $model->spare_part];
//},


]);
?>