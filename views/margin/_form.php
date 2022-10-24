<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Margin $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="margin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'margin')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
