<?php
$this->pageTitle = Yii::app()->name . '教师信息导出';
$this->breadcrumbs = array(
    '教师信息导出',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){


});
", CClientScript::POS_HEAD);
?>

<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">教师信息导出</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'export-teacher-form',
                        'method' => 'post',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        导出包含指定条件所对应教师的信息到Excel文件中。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'姓名')); ?>
                                <?php echo $form->error($model,'name'); ?>
                            </div>
                        </div>
                    
                    </div>

                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('导出', array('class'=>'btn btn-export')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>
