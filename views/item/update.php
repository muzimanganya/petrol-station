<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

$this->title = Yii::t('app', 'Update Item: {name}', [
    'name' => $model->nom,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nom, 'url' => ['view', 'nom' => $model->nom]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
