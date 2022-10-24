<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Produit;
use app\models\Station;

/* @var $this yii\web\View */
/* @var $model app\models\RecordJournalier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-journalier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'index_debut')->textInput(['id'=>'index_debut']) ?>

    <?= $form->field($model, 'index_fin')->textInput(['id'=>'index_fin']) ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
                    'options' => ['class' => 'form-control'],
                    //'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
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
     
    <?= $form->field($model,'stock_physique')->textInput() ?>

    <?= $form->field($model, 'cdf')->textInput() ?>

    <?= $form->field($model, 'usd')->textInput() ?>

    <?= $form->field($model, 'depense_usd')->textInput() ?>

    <?= $form->field($model, 'credit_montant_usd')->textInput() ?>

    <?= $form->field($model, 'quantite')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
