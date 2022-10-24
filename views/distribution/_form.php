<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Produit;
use app\models\Tank;
use app\models\Station;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Distribution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distribution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'produit')->widget(\yii2mod\selectize\Selectize::className(), [
        'items'=>ArrayHelper::merge([null=>'Select Product'],  ArrayHelper::map(Produit::find()->all(), 'id', function($model) {
            return $model->nom;
        })),
        'pluginOptions' => [
            'persist' => false,
            'createOnBlur' => true,
            'create' => true
        ]
    ]) ?>


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
      
    
    <?= $form->field($model, 'quantite')->textInput() ?>

    <?= $form->field($model, 'index_debut')->textInput() ?>

 

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
