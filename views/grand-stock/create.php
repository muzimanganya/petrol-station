<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\GrandStock $model */

$this->title = Yii::t('app', 'Create Grand Stock');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grand Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grand-stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
