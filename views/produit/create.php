<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Produit */

$this->title = Yii::t('app', 'Create Produit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Produits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="produit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
