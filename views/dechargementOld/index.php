<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Tank;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DechargementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dechargements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dechargement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Dechargement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Station',
                'value'=>function($model)
                {
                    return Station::find()->where(['id'=>$model->station])->one()->nom;
                }
            ],
            [
                'label'=>'Tank',
                'value'=>function($model)
                {
                    $tank= Tank::find()->where(['id'=>$model->tank])->one();
                    if(!empty($tank))
                    {
                        $produit=Produit::find()->where(['id'=>$tank->produit])->one();
                        return $tank->id.' '.$produit->nom;
                    }
                    return "";
                }
            ],
            'stock_initiale',
            'quantite',
            'index_debut',
            'index_fin',
            'sortie_pompe',
            'quantite_finale',
            
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            'unit_price',
            'currency',
            'selling_price',
            'margin',
            //'station',
            'payment_mode',
            'account',
            'payable',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{vprint}',
                'buttons' => [
                    'vprint' => function ($url, $model, $key) {
                       
                        return Html::a('<button class="btn btn-success">Details</i></button>',['view', 'no'=>$model->no,'action'=>'view']
                        ,
                        [
                            'class'=>'user-route'
                        ]);
                        
                        
                    },

                ],
            ],
        ],
    ]); ?>


</div>
