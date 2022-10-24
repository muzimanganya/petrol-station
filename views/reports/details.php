<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

use yii\grid\GridView;

$this->title = Yii::t('app', 'Fuel Management - Welcome!');
$this->params['breadcrumbs'][] = $this->title;
?>



<h3><?= Yii::t('app', 'Today\'s Details Consumption of ') ?></h3>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null, //$searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

       
		'plateNo', 
        
        [
			'attribute'=>'rura_quantity',
			'format'=>'decimal',

		],
         [
                'attribute' =>  'rura_price',
				
				'format'=>'integer',
                'value' => function ($model) {
				if($model['rura_quantity']==0)
                    return 0;
                else
                	return $model['rura_price'];
                }
                
         ],
        
        [
			'attribute'=>'no_rura_quantity',
			'format'=>'decimal',

		],
        
        [
                'attribute' =>  'no_rura_price',
				
				'format'=>'integer',
                'value' => function ($model) {
				if($model['no_rura_quantity']==0)
                    return 0;
                else 
                	return $model['no_rura_price'];
                }
         ],
       
		[
			'attribute'=>'litters',
			'format'=>'decimal',

		],
		
        
        [
			'attribute'=>'total_cost',
			'format'=>'integer',

		],
		'station',
		[
                'attribute' =>  'mileage',
				'label'=>'Mileage on board',
				'format'=>'integer',
               
            ],
			
			'time',
			'driver',

       // ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>