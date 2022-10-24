<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DistributionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distribution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dechargement') ?>

    <?= $form->field($model, 'stock_initiale') ?>

    <?= $form->field($model, 'quantite') ?>

    <?= $form->field($model, 'index_debut') ?>

    <?php // echo $form->field($model, 'index_fin') ?>

    <?php // echo $form->field($model, 'sortie_pompe') ?>

    <?php // echo $form->field($model, 'quantite_finale') ?>

    <?php // echo $form->field($model, 'station') ?>

    <?php // echo $form->field($model, 'tank') ?>

    <?php // echo $form->field($model, 'transaction') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
