<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tank;
use app\models\Produit;
use yii\grid\GridView;
use app\models\Account;


/* @var $this yii\web\View */
/* @var $model app\models\Supply */
/* @var $form yii\widgets\ActiveForm */


$payment_mode=['cash'=>'Cash','bank'=>'Bank','check'=>'Check','mobile_money'=>'Mobile Money','receivable'=>'Receivable'];

$user = Yii::$app->user->identity;

$currency=['usd'=>'usd','cdf'=>'FC'];
?>

<div class="supply-form">

<div class="bg-light text-dark border-left" style="color:white;">
<h5>Prix</h5>
<?= GridView::widget([
        'dataProvider' => $dataProviderTarification,
        // 'title'=>'Prix'
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'produit',
            [
                'label'=>'produit',
                'attribute'=>'produit',
                'value'=>function($model){
                   return Yii::$app->db->createCommand("SELECT nom from produit where id=$model->produit")->queryScalar();
                }
            ],
            // 'plaque',
            // 'quantite',
            'usd_price',
            // 'cdf_price',
            [
                'label'=>'CDF Price',
                'attribute'=>'cdf_price',
            ],
        ],
    ]); ?>

</div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nom_client')->textInput() ?>

    <?= $form->field($model, 'telephone')->textInput() ?>

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

<?= $form->field($model, 'quantite')->textInput(['id'=>'quantite']) ?>
    <div class="row">
            <div class="col-md-6"><?= $form->field($model, 'prix')->textInput(['id' => 'prix']) ?></div>
            <div class="col-md-6"><label for="cars">currency:</label><br>
<select id="currency" style="border:0.3px grey;">
  <option value="USD">USD</option>
  <option value="CDF">FC</option>

</select>
<!-- <p>Please select currency:</p> -->
  <!-- <input type="radio" id="currency" name="currency" value="USD">
  <label>USD</label><br>
  <input type="radio" id="currency" name="currency" value="CDF">
  <label>CDF</label><br> -->
    </div>
    </div>
    
    <?= $form->field($model, 'rate')->textInput(['id' => 'rate','class' => 'form-control class-content-title_series','disabled' => true]) ?>
    <?= $form->field($model, "usd")->textInput(['id'=>"usd"]) ?>
    <?= $form->field($model, "cdf")->textInput(['id'=>"cdf"]) ?>

    <script>

var x = document.getElementById("usd");
x.addEventListener("focus", myFocusFunction, true);
x.addEventListener("blur", myBlurFunction, true);

function myFocusFunction() {
//   document.getElementById("myInput").style.backgroundColor = "yellow"; 
if(document.getElementById("currency").value == "USD"){
document.getElementById("usd").value = document.getElementById("prix").value * document.getElementById("quantite").value

}
else{
    document.getElementById("usd").value = 0;
}
}

function myBlurFunction() {
  document.getElementById("usd").style.backgroundColor = "";  
}


var y = document.getElementById("cdf");
y.addEventListener("focus", myFocusFunction2, true);
y.addEventListener("blur", myBlurFunction2, true);

function myFocusFunction2() {
    if(document.getElementById("currency").value == "USD"){
        document.getElementById("cdf").value = 0;
    }
    else{
        document.getElementById("cdf").value = document.getElementById("prix").value * document.getElementById("quantite").value
    }
//   document.getElementById("myInput").style.backgroundColor = "yellow"; 
}

function myBlurFunction2() {
  document.getElementById("cdf").style.backgroundColor = "";  
}

</script>

<?= $form->field($model, 'payment_mode')->dropDownList($payment_mode) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
