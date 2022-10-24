<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Depense */

$this->title = Yii::t('app', 'Create Depense');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Depenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="depense-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
