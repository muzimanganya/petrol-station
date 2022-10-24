<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Dechargement */

$this->title = $model->no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Achat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dechargement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?= Html::a(Yii::t('app', 'depense'), ['/depense/create','no' => $model->no,'transaction'=>1], ['class' => 'btn btn-success pull-right']) ?>
       
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'no' => $model->no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'no' => $model->no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no',
            'produit',
            'unit_price',
            'currency',
            'quantite',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'description',
            'quantite',
            'prix',
            'dechargemt',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            // [
            //     'class' => ActionColumn::className(),
            //     'urlCreator' => function ($action, app\models\Depense $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      }
            // ],
        ],
    ]); ?>

</div>
