<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name. '密码变更';
$this->breadcrumbs = array(
    '密码变更',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    
});
", CClientScript::POS_HEAD);
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">密码变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，用户可以修改自己的登录密码。</h6>
                    <hr />
                    <!-- Form starts.  -->
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'change-password-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">登录用户名</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($user,'username',array('class'=>'form-control','disabled'=>'disabled')); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">旧密码</label>
                            <div class="col-lg-10">
                                <?php echo $form->passwordField($model,'old_password', array('class'=>'form-control required', 'placeholder'=>'旧密码', 'required'=>'')); ?>
                                <?php echo $form->error($model,'old_password'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">新密码</label>
                            <div class="col-lg-10">
                                <?php echo $form->passwordField($model,'new_password', array('class'=>'form-control required', 'placeholder'=>'新密码', 'required'=>'')); ?>
                                <?php echo $form->error($model,'new_password'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">新密码(确认)</label>
                            <div class="col-lg-10">
                                <?php echo $form->passwordField($model,'confirm_password', array('class'=>'form-control required', 'placeholder'=>'新密码(确认)', 'required'=>'')); ?>
                                <?php echo $form->error($model,'confirm_password'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php echo CHtml::resetButton('重置', array('class'=>'btn btn-reset')); ?>
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
