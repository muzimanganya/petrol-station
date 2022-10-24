<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\api\modules\v1\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <p class="pull-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            
            
          
            'username',
            [
                'attribute' => 'role',
                'value' => function ($model) {
                    return User::getRoles()[$model->role] ?? null;
                }
            ],
            
            'is_active:boolean',
            'created_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->createdBy->name ?? null;
                }
            ],
            'updated_at:datetime',
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return $model->updatedBy->name ?? null;
                }
            ],
        ],
    ]) ?>

</div>