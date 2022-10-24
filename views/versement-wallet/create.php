<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VersementWallet */

$this->title = Yii::t('app', 'Create Versement Wallet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Versement Wallets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="versement-wallet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
