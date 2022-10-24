<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\GrandStockUpdates $model */

$this->title = Yii::t('app', 'Create Grand Stock Updates');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grand Stock Updates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grand-stock-updates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
