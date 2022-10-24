<?php

use app\models\User;
use app\modules\api\modules\v1\models\Faculties;
use app\modules\api\modules\v1\models\Institutions;
use kartik\select2\Select2;
use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\api\modules\v1\models\SearchUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['action' => ['index'],    'method' => 'get',]); ?>

        <div class="row">
            <div class="col-md-4"> <?= $form->field($model, 'name') ?></div>
            
            <div class="col-md-4"><?php echo $form->field($model, 'role')->dropDownList(User::getRoles(), ['prompt' => Yii::t('app', 'All Roles')]) ?></div>
        </div>
        
        <?= Html::submitButton(Yii::t('app', 'Search Matching Records'), ['class' => 'btn btn-block btn-primary']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>