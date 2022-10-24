<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\api\modules\v1\models\SearchUser */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>


<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<p>
        <?= Html::a(Yii::t('app', 'New User'), ['create'], ['class' => 'btn btn-info pull-right']) ?>
    </p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'name',
       
        
        [
            'attribute' => 'role',
            'value' => function ($model) {
                return User::getRoles()[$model->role] ?? null;
            }
        ],
        'location',
       
        'is_active:boolean',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>