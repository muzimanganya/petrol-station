<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\modules\api\modules\v1\models\User */

$this->title = Yii::t('app', 'New Account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if (isset(User::getRoles()[$model->role])) {
    $this->params['breadcrumbs'][] = User::getRoles()[$model->role];
}
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>