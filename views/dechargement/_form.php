<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Produit;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Dechargement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dechargement-form">

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

    <?= $form->field($model, 'unit_price')->textInput() ?>

    <?= $form->field($model, 'currency')->dropDownList(['usd'=>'USD','cdf'=>'FC']) ?>

    <?= $form->field($model, 'quantite')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
