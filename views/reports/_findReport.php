<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FindReport */
/* @var $form ActiveForm */
?>
<div class="reports-_findReport">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'report')->dropDownList([
            'daily-sales'=>Yii::t('app', 'Daily Report'),
            'summary'=>Yii::t('app', 'Summary Report'),
			'dechargement'=>Yii::t('app', 'Rapport de dechargement'),
			'revenue-fuel'=>Yii::t('app', 'Rapport de ventes'),
            'depense'=>Yii::t('app', 'Rapport de Depenses'),
			            'tank'=>Yii::t('app','Movement Stock'),
            'bank-transactions'=>Yii::t('app','operations bancaires'),
            'wallet-transactions'=>Yii::t('app','transactions de portefeuille'),
            'station-report'=>Yii::t('app','Rapport de stations'),
            'pompiste-report'=>Yii::t('app','Pompiste report'),
            'operational-expenses'=>Yii::t('app','Operational Expenses'),
            'dechargement-expenses'=>Yii::t('app','Dechargement expenses'),
            'rapport-journalier'=>Yii::t('app','Rapport Journalier'),
            'income-statement'=>Yii::t('app','Income Statement'),
        ]) ?>

        <div class='row'>
            <div class='col-md-6'>
                <?= $form->field($model, 'start')->widget(\kartik\date\DatePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'end')->widget(\kartik\date\DatePicker::classname(), [
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>
            </div>
        </div>    
        
        <?= $form->field($model, 'reference')->textInput() ?> 
        
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Find'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- reports-_findReport -->
