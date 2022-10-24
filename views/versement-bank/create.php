<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VersementBank */

$this->title = Yii::t('app', 'Create Versement Bank');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Versement Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="versement-bank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
