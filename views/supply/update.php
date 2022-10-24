<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Supply */

$this->title = Yii::t('app', 'Update Supply: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Supplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="supply-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataProviderTarification'=>$dataProviderTarification,
    ]) ?>

</div>
