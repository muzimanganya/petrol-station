<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $model app\models\Wallet */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

</style>

<div class="wallet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance_usd')->textInput() ?>

    <?= $form->field($model, 'balance_cdf')->textInput() ?>

    <?= $form->field($model, 'station')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Station'],  ArrayHelper::map(Station::find()->all(), 'id', function($model) {
            return $model->nom;
        })),
        'pluginOptions' => [
            'plugins' => ['drag_drop', 'remove_button'],
            'persist' => false,
            'createOnBlur' => true,
            'create' => false,
            'id'=>'select'
        ]
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
