<?php
$this->pageTitle = '系统异常';
$this->breadcrumbs = array(
    $this->pageTitle,
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    
});
", CClientScript::POS_HEAD);
?>

<!--
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">系统异常</div>
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
        </div>  
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <h2><?php echo $code; ?></h2>
        <div class="alert alert-danger">
            <?php echo CHtml::encode($message); ?>
        </div>
    </div>
</div>-->




        <div class="alert alert-danger">
            <?php echo CHtml::encode($message); ?>
        </div>








