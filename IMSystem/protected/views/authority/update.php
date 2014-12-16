<?php
$this->pageTitle=Yii::app()->name . '权限信息变更';
$this->breadcrumbs = array(
    '权限信息变更',
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
                <div class="pull-left">权限信息检索</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改一个权限的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-class-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">权限名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'authority_name', array('class'=>'form-control required','placeholder'=>'权限名称')); ?>
                                <?php echo $form->error($model,'authority_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">分类</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'category', AuthorityForm::getCategoryOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'category'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">访问路径</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'access_path', array('class'=>'form-control required','placeholder'=>'访问路径')); ?>
                                <?php echo $form->error($model,'access_path'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <?php 
                                        echo CHtml::Button("删除", array(
                                            'confirm'=>'确定要删除吗？',
                                            'params'=>array('ID' => $model->ID),
                                            'submit' => array('delete'),
                                            'class'=>'btn btn-delete',
                                            'encode'=>false,
                                        ));
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                        </div>
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
