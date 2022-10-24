<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dechargement */

$this->title = Yii::t('app', 'Update Dechargement: {name}', [
    'name' => $model->no,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dechargements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no, 'url' => ['view', 'no' => $model->no]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dechargement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
