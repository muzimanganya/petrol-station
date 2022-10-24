<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tarification */

$this->title = Yii::t('app', 'Create Tarification');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarification-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?php $tar ?></p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
