<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tarification */

$this->title = $model->produit;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tarification-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station], [
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
            'produit',
            'usd_price',
            'cdf_price',
            'station',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
