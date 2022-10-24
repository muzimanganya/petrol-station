<?php
/* @var $this yii\web\View */
$this->title = 'Find Report'
?>
<div class="panel panel-info">
    <div class="panel-heading"><?php echo Yii::t('app', 'Select the report you like, the relevant date and click submit to see results.<b>NOTE</b> that reference is required by SOME reports like Client report. It is completely Optional');?></div>
    <div class="panel-body"><?= $this->render('_findReport', ['model'=>$model]) ?></div>
    <div class="panel-footer"><small>  <a class='pull-right' href='mailto:sales@hosannahighertech.co.tz'></a></small></div>
</div>