<?php
$this->pageTitle = Yii::app()->name . '教师信息变更';
$this->breadcrumbs = array(
    '教师信息变更',
);
?>
<script>
$(document).ready(function(){
    
});
</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">教师信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个教师的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-teacher-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?php echo $model->getAttributeLabel('code');?></label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'code',array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'name', array('class'=>'form-control','placeholder'=>'姓名')); ?>
                                <?php echo $form->error($model,'name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">性别</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'sex', StudentForm::getSexOption(false), array('disabled'=>'disabled','separator'=>'　')); ?>
                                <?php echo $form->error($model,'sex'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">担任科目</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'subjects', MSubjects::model()->getAllSubjectsOption(false), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'subjects'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group input-append" id="datetimepicker1" >
                            <label class="col-lg-2 control-label">出生年月日</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'birthday', array('data-format'=>'yyyy-MM-dd', 'class'=>'form-control dtpicker', 'placeholder'=>'出生年月日')); ?>
                                <span class="add-on">
                                    <i data-time-icon="fa fa-time" data-date-icon="fa fa-calendar" class="btn btn-info fa fa-calendar"></i>
                                </span>
                                
                                <?php echo $form->error($model,'birthday'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">地址</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'address', array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'address'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">电话号码</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'telephonoe', array('class'=>'form-control', 'placeholder'=>'电话号码')); ?>
                                <?php echo $form->error($model,'telephonoe'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">角色</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'roles', MRoles::model()->getAllRolesOption(false), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'roles'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php 
                                    echo CHtml::Button("删除", array(
                                        'confirm'=>'确定要删除吗？',
                                        'params'=>array('ID' => $model->ID),
                                        'submit' => array('delete'),
                                        'class'=>'btn btn-delete',
                                        'encode'=>false,
                                    ));
                                ?>
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
