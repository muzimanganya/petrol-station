<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Retail */

$this->title = Yii::t('app', 'Create Retail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Retails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataProviderTarification'=>$dataProviderTarification,
    ]) ?>

</div>
