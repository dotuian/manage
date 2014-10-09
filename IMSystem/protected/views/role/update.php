<?php
$this->pageTitle= '角色变更';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<script>

</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>
                        该页面，可以修改／删除一个角色的信息。<br/>
                        ※学生，教师，学工科，教务处，校长角色，是系统运行所必须的数据，不能删除。
                    </h6>
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
                            <label class="col-lg-2 control-label">其他权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'other_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('OTHER'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'other_authoritys'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php 
                                    echo CHtml::Button("删除", array(
                                        'confirm'=>'确定要删除吗？',
                                        'params'=>array('ID' => $model->role_id),
                                        'submit' => array('delete'),
                                        'class'=>'btn btn-delete',
                                        'encode'=>false,
                                    ));
                                ?>
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-primary')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>