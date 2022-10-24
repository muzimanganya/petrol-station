<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Account;
use app\models\Tank;
use yii\helpers\ArrayHelper;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $model app\models\Dechargement */
/* @var $form yii\widgets\ActiveForm */

$payment_mode=['bank'=>'bank','check'=>'check','mobile_money'=>'mobile_money','cash'=>'cash'];
$currency=['usd'=>'usd','cdf'=>'cdf'];
?>

<div class="dechargement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tank')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Tank'],  ArrayHelper::map(Tank::find()->all(), 'id', function($model) {

            return 'TANK '.$model->id.' '.Produit::find()->where(['id'=>$model->produit])->one()->nom.' '.Station::find()->where(['id'=>$model->station])->one()->nom;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>

    <!-- <?= $form->field($model, 'stock_initiale')->textInput() ?> -->

    <?= $form->field($model, 'quantite')->textInput() ?>

    <?= $form->field($model, 'index_debut')->textInput() ?>

    <!-- <?= $form->field($model, 'index_fin')->textInput() ?>

    <?= $form->field($model, 'quantite_finale')->textInput() ?>
   

    <?= $form->field($model, 'unit_price')->textInput() ?> -->

    <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'unit_price')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'currency')->dropDownList($currency,['prompt'=>'Select currency']) ?></div>
    
    </div>

    <!-- <?= $form->field($model, 'selling_price')->textInput() ?>

    <?= $form->field($model, 'margin')->textInput() ?> 

    <?= $form->field($model, 'station')->textInput() ?>-->

    <?= $form->field($model, 'payment_mode')->dropDownList($payment_mode) ?>

    <?= $form->field($model, 'account')->widget(\yii2mod\selectize\Selectize::className(), [
    'items'=>ArrayHelper::merge([null=>'Select account'],  ArrayHelper::map(Account::find()->all(), 'id', function($model) {
        return $model->no."___ ".$model->bank."____ ".$model->currency;
    })),
    'pluginOptions' => [
        'persist' => false,
        'createOnBlur' => true,
        'create' => true
    ]
]) ?>

    <?= $form->field($model, 'payable')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
