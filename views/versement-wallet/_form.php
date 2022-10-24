<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Wallet;

/* @var $this yii\web\View */
/* @var $model app\models\VersementWallet */
/* @var $form yii\widgets\ActiveForm */

$user = Yii::$app->user->identity;
$wallet = $user->wallet;
$currency=['usd'=>'usd','cdf'=>'FC'];
?>

<div class="versement-wallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'wallet_from')->textInput() ?> -->

    <?= $form->field($model, 'wallet_from')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Wallet'],  ArrayHelper::map(Wallet::find()->where("id <> $wallet")->all(), 'id', function($model) {
            return $model->name;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>

    <?= $form->field($model, 'wallet_to')->textInput(['class' => 'form-control class-content-title_series','disabled' => true]) ?>

    <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'amount')->textInput()->hint("") ?></div>
            <div class="col-md-6"><?= $form->field($model, 'currency')->dropDownList($currency,['prompt'=>'select Currency'])->hint("") ?></div>
    </div>

    
    <!-- <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance_from')->textInput() ?>

    <?= $form->field($model, 'balance_to')->textInput() ?> -->


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
