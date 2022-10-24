<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tarification */

$this->title = Yii::t('app', 'Update Tarification: {name}', [
    'name' => $model->produit,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->produit, 'url' => ['view', 'produit' => $model->produit, 'usd_price' => $model->usd_price, 'cdf_price' => $model->cdf_price, 'station' => $model->station]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tarification-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
