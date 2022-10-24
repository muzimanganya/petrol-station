<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii\helpers\ArrayHelper;
use app\models\Wallet;
use app\models\Account;

/* @var $this yii\web\View */
/* @var $model app\models\VersementBank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="versement-bank-form">

    <?php $form = ActiveForm::begin(); ?>


    <!-- <?= $form->field($model, 'wallet')->textInput() ?> -->

    <?= $form->field($model, 'wallet')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Wallet'],  ArrayHelper::map(Wallet::find()->all(), 'id', function($model) {
            return $model->name;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>

    <!-- <?= $form->field($model, 'account')->textInput(['maxlength' => true]) ?> -->

    
    
    <?= $form->field($model, 'account')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select account'],  ArrayHelper::map(Account::find()->all(), 'no', function($model) {
            return $model->no."_____".$model->bank."______".$model->currency;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <!-- <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'balance')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
