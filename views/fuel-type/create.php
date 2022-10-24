<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FuelType */

$this->title = Yii::t('app', 'Create Fuel Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fuel Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuel-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
