<?php

use app\models\User;
use app\modules\api\modules\v1\models\Card;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use sjaakp\gcharts\AreaChart;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;
use app\components\SumProviderRows;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\api\modules\v1\models\SearchCard */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Station Report from '.$start.' to '.$end);
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'summary' => Yii::t('app', 'Showing {start}-{end} of {totalCount} Cards'),
        'layout' => '{items}',
        'showFooter'=>true, 
        'footerRowOptions'=>['style'=>'font-weight:bold;font-size: 16px;'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            [
                'attribute'=>'HUYE',
                'format'=>'integer',
                'footer'=>SumProviderRows::total($dataProvider, 'HUYE'),
            ],
             [
                'attribute'=>'NYABUGOGO',
                'format'=>'integer',
                'footer'=>SumProviderRows::total($dataProvider, 'NYABUGOGO'),
            ],
            
			
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	
	<div class="panel panel-default">
    <div class="panel-body">
	
       
		<?= AreaChart::widget([
    
    'dataProvider' => $dataProvider,
    'columns' => [

		
		'date:string',
       
		['label'=>Yii::t('app','SP HUYE'),
		 'attribute'=>'HUYE'
		 ],
        ['label'=>Yii::t('app','SP NYABUGOGO'),
		 'attribute'=>'NYABUGOGO'
		 ],
		//'mileage',
       
    ],
    'options' => [
        'title' => Yii::t('app', 'Weekly Consumption Trend')
    ],
])

 ?>
    </div>
</div>