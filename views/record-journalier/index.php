<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecordJournalierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Record Journaliers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-journalier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Record Journalier'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label'=>'Produit',
                'value'=>function($model)
                {
                    return Produit::find()->where(['id'=>$model->produit])->one()->nom;
                }
            ],
            [
                'label'=>'Station',
                'value'=>function($model)
                {
                    return Station::find()->where(['id'=>$model->station])->one()->nom;
                }
            ],
            'index_debut',
            'index_fin',
            'sortie_pompe',
            'date',
            // 'cdf',
            [
                'label'=>'FC',
                'attribute'=>'cdf',
            ],
            [
                'label'=>'USD',
                'attribute'=>'usd',
            ],
            // 'usd',
            'depense_usd',
            'stock_physique',
            'credit_montant_usd',
            'quantite',
            // 'station',
            // 'produit',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\RecordJournalier $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
