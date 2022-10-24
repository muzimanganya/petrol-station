<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Station;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Item;
/* @var $this yii\web\View */
/* @var $model app\models\Depense */
/* @var $form yii\widgets\ActiveForm */

$currency=['usd'=>'USD','cdf'=>'FC'];
?>

<div class="depense-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'station')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Station'],  ArrayHelper::map(Station::find()->all(), 'id', function($model) {
            return $model->nom;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>
    
    <?php if($_REQUEST['no']){

    ?>
    
    <?= $form->field($model, 'description')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Description'],  ArrayHelper::map(Item::find()->all(), 'nom', function($model) {
            return $model->nom;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>


    <?php
    }else{
    ?>
    <?= $form->field($model, 'description')->textInput() ?>
      <?php  
    }
    ?>

    

    <?= $form->field($model, 'quantite')->textInput() ?>

    <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'prix')->textInput() ?></div>
            <div class="col-md-6"><?= $form->field($model, 'currency')->dropDownList($currency,['prompt'=>'Select currency']) ?></div>
    </div>
    <?= $form->field($model, 'observation')->textarea(['rows'=>3,'maxlength' => true]) ?>
    <!-- <?= $form->field($model, 'dechargemt')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
