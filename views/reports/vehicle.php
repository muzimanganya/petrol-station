<?php

use app\models\User;
use app\modules\api\modules\v1\models\Card;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use sjaakp\gcharts\AreaChart;
use sjaakp\gcharts\PieChart;
use sjaakp\gcharts\LineChart;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\api\modules\v1\models\SearchCard */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Vehicle report');
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => Yii::t('app', 'Showing {begin}-{end} of {totalCount} Cards'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'plateNo',
                'format'=>'html',
                'value'=>function($model) use($start, $end)
                {
                    return Html::a($model['plateNo'], ['details', 'plateNo'=>$model['plateNo'],'start'=>$start,'end'=>$end]);
                }
            ],
            'litters',
			'amount',
			'mileage',
			'rate',
            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	
	<div class="panel panel-default">
    <div class="panel-body">
	
       
		<?= LineChart::widget([
    
    'dataProvider' => $dataProvider,
    'columns' => [

		
		'plateNo:string',
       
		['label'=>Yii::t('app','Rate'),
		 'attribute'=>'rate'
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