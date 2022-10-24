<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\GrandStockUpdates $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grand-stock-updates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produit')->textInput() ?>

    <?= $form->field($model, 'dechargement')->textInput() ?>

    <?= $form->field($model, 'old_quantity')->textInput() ?>

    <?= $form->field($model, 'old_selling_price')->textInput() ?>

    <?= $form->field($model, 'old_buying_price')->textInput() ?>

    <?= $form->field($model, 'new_quantity')->textInput() ?>

    <?= $form->field($model, 'new_buying_price')->textInput() ?>

    <?= $form->field($model, 'new_selling_price')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
