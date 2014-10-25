<?php
$this->pageTitle=Yii::app()->name . '系统错误';
$this->breadcrumbs = array(
    '系统错误',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    
});
", CClientScript::POS_HEAD);
?>

<div class="alert alert-danger">
    <?php echo CHtml::encode($message); ?>
</div>








