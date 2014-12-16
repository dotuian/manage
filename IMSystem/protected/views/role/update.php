<?php
$this->pageTitle=Yii::app()->name . '角色变更';
$this->breadcrumbs = array(
    '角色变更',
);
?>
<script>

</script>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">角色变更</div>
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
                                <?php echo $form->textField($model,'role_name', array('class'=>'form-control required','placeholder'=>'角色名称')); ?>
                                <?php echo $form->error($model,'role_name'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">我的班级权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'myclass_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('MYCLASS'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'myclass_authoritys'); ?>
                                <div class="tip">※班主任和任课教师必须具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学生管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'student_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('STUDENT'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'student_authoritys'); ?>
                                <div class="tip">※学工科应该具备的权限。</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">教师管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'teacher_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('TEACHER'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'teacher_authoritys'); ?>
                                <div class="tip">※教务处应该具备的权限。</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'class_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('CLASS'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'class_authoritys'); ?>
                                <div class="tip">※教务处应该具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">科目管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'subject_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SUBJECT'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'subject_authoritys'); ?>
                                <div class="tip">※教务处应该具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">课程安排管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'course_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('COURSE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'course_authoritys'); ?>
                                <div class="tip">※教务处应该具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">成绩管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'score_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SCORE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'score_authoritys'); ?>
                                <div class="tip">※教务处，教师，学生可以具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">系统设置权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'system_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('SYSTEM'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'system_authoritys'); ?>
                                <div class="tip">※教务处应该具备的权限。</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">角色管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'role_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('ROLE'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'role_authoritys'); ?>
                                <div class="tip">※校长可以具备的权限。此处的修改会影响到系统的使用！</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">权限管理权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'authority_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('AUTHORITY'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'authority_authoritys'); ?>
                                <div class="tip">※校长可以具备的权限。此处的修改会影响到系统的使用！</div>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">基本权限</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'other_authoritys', MAuthoritys::model()->getAuthorityByCategoryOption('OTHER'), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'other_authoritys'); ?>
                                <div class="tip">※所有用户都应该具备的权限！</div>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                <?php 
                                    if (!in_array($model->role_id, array('1', '2', '3', '4', '5'))) {
                                        echo CHtml::Button("删除", array(
                                            'confirm' => '确定要删除吗？',
                                            'params' => array('ID' => $model->role_id),
                                            'submit' => array('delete'),
                                            'class' => 'btn btn-delete',
                                            'encode' => false,
                                        ));
                                    }
                                ?>
                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-primary')); ?>
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
