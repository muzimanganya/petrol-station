<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dechargement */

$this->title = Yii::t('app', 'Create Achat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dechargements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dechargement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
