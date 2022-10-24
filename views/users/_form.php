<?php

use app\models\User;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\api\modules\v1\models\Institutions;
use app\modules\api\modules\v1\models\Faculties;
use app\modules\api\modules\v1\models\Cities;
use app\modules\api\modules\v1\models\Cards;
use app\models\Station;
use app\models\Wallet;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\modules\api\modules\v1\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="panel panel-default">
    <div class="panel-body">
        
         <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      

        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'text_password', ['enableClientValidation' => false])->passwordInput(['maxlength' => true]) ?>
                
            </div>
             
        </div>
         

         <?= $form->field($model, 'location')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Station'],  ArrayHelper::map(Station::find()->all(), 'id', function($model) {
            return $model->nom;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>
        <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'role')->dropDownList(User::getRoles(), ['prompt' => Yii::t('app', 'Select User Role')]) ?></div>
            <div class="col-md-6"><?= $form->field($model, 'wallet')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Wallet'],  ArrayHelper::map(Wallet::find()->all(), 'id', function($model) {
            return $model->name;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>
        </div>
        </div>
        <?= $form->field($model, 'lang')->dropDownList(['en'=>Yii::t('app', 'English'), 'fr'=>Yii::t('app', 'French')], ['prompt' => Yii::t('app', 'Select Language')]) ?>
		
    
	   <?= $form->field($model, 'is_active')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-block btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>