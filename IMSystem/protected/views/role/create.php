<?php
$this->pageTitle = Yii::app()->name . '角色添加';
$this->breadcrumbs = array(
    '角色添加',
);
?>
<script>

</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">角色添加</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以添加一个角色的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'add-teacher-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">角色名称</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'role_name', array('class'=>'form-control','placeholder'=>'角色名称')); ?>
                                <?php echo $form->error($model,'role_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学生管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'student_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('STUDENT'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'student_authoritys'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">教师管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'teacher_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('TEACHER'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'teacher_authoritys'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'class_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('CLASS'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'class_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'subject_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SUBJECT'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'subject_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">课程安排管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'course_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('COURSE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'course_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">成绩管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'score_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SCORE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'score_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">角色管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'role_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('ROLE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'role_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">权限管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'authority_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('AUTHORITY'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'authority_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">系统设置权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'system_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SYSTEM'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'system_authoritys'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">其他权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'other_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('OTHER'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'other_authoritys'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-reset" value='重置' />
                                <?php echo CHtml::submitButton('添加', array('class'=>'btn btn-primary')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
