<?php


use app\modules\api\modules\v1\models\Card;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\api\modules\v1\models\SearchCard */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Paid Report from '.$start.' to '.$end);
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => //$searchModel,
    'showPageSummary' => true,
    'pjax' => true,
    'striped' => false,
    'hover' => true,
    'panel' => ['type' => 'info', 'heading' => $this->title],
    'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        
        [
            'attribute' => 'supplier', 
            'width' => '250px',
            // 'value'=>function($model){
            //     //   return 'Order No : '.$model->order_id. ' ';
            //     $a = $model['order_id'];
            //     return "Order No " . $a;
            // },
            
            
            'group' => true,  // enable grouping,
             'subGroupOf' => 1,
            'groupedRow' => true,                    // move grouped column to a single grouped row
            'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
            'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
            'groupFooter' => function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns' => [[0,2]], // columns to merge in summary
                    'content' => [             // content to show in each summary cell
                        0 => 'Total Amount (' . $model['supplier'] . ')',
                        3 => GridView::F_SUM,
                        // 6 => GridView::F_SUM,
                        // 6 => GridView::F_SUM,
                    ],
                    'contentFormats' => [      // content reformatting for each summary cell
                        3 => ['format' => 'number', 'decimals' => 2],
                        // 6 => ['format' => 'number', 'decimals' => 2],
                        // 5 => ['format' => 'number', 'decimals' => 0],
                        // 6 => ['format' => 'number', 'decimals' => 2],
                    ],
                    'contentOptions' => [      // content html attributes for each summary cell
                        0 => ['style' => 'font-variant:small-caps'],
                        3 => ['style' => 'text-align:right'],
                        // 6 => ['style' => 'text-align:right'],
                        // 5 => ['style' => 'text-align:right'],
                        // 6 => ['style' => 'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options' => ['class' => 'info table-info','style' => 'font-weight:bold;']
                ];
            }
        ],
        [
            'attribute' => 'order_id',
            'group' => true,
             'value'=>function($model){
                //   return 'Order No : '.$model->order_id. ' ';
                $a = $model['order_id'];
                return "Order No " . $a;
            },
            'pageSummary'=>'TOTAL',
            'pageSummaryOptions' => ['class' => 'text-right text-end'],
        ],

        [
            'attribute' => 'amount',
            'width' => '150px',
            'hAlign' => 'right',
            'format' => ['decimal', 2],
            'pageSummary' => true,
            //'pageSummaryFunc' => GridView::F_AVG,
        ],
        
     
    ],
]); ?>
	
