<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Produit;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var app\models\GrandStock $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grand-stock-form">

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
    <?= $form->field($model, 'quantite')->textInput() ?>

    <?= $form->field($model, 'buying_price')->textInput() ?>

    <?= $form->field($model, 'selling_price')->textInput() ?>

    <?= $form->field($model, 'currency')->dropDownList(['usd'=>'USD','cdf'=>'FC']) ?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
