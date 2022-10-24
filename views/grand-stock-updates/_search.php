<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\GrandStockUpdatesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grand-stock-updates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'produit') ?>

    <?= $form->field($model, 'dechargement') ?>

    <?= $form->field($model, 'old_quantity') ?>

    <?= $form->field($model, 'old_selling_price') ?>

    <?php // echo $form->field($model, 'old_buying_price') ?>

    <?php // echo $form->field($model, 'new_quantity') ?>

    <?php // echo $form->field($model, 'new_buying_price') ?>

    <?php // echo $form->field($model, 'new_selling_price') ?>

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
