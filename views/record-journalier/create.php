<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RecordJournalier */

$this->title = Yii::t('app', 'Create Record Journalier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Record Journaliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-journalier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
