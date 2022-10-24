<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SupplySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nom_client') ?>

    <?= $form->field($model, 'telephone') ?>

    <?= $form->field($model, 'quantite') ?>

    <?= $form->field($model, 'prix') ?>

    <?php // echo $form->field($model, 'usd') ?>

    <?php // echo $form->field($model, 'cdf') ?>

    <?php // echo $form->field($model, 'tank') ?>

    <?php // echo $form->field($model, 'produit') ?>

    <?php // echo $form->field($model, 'station') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'account') ?>

    <?php // echo $form->field($model, 'payment_mode') ?>

    <?php // echo $form->field($model, 'receivable') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
