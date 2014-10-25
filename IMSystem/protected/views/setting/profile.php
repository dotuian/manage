<?php
$this->pageTitle = Yii::app()->name . '用户信息变更';
$this->breadcrumbs = array(
    '用户信息变更',
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
                <div class="pull-left">用户信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以修改个人信息。</h6>
                    <hr />
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'modify-profile-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                    
                    <?php if(Yii::app()->user->getState('user_type') === 'student') { // 学生个人信息?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'code',array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'name', array('class'=>'form-control','disabled'=>'disabled')); ?>
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
                            <label class="col-lg-2 control-label">身份证号码</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'id_card_no', array('class'=>'form-control','placeholder'=>'身份证号码')); ?>
                                <?php echo $form->error($model,'id_card_no'); ?>
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
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">住宿情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'accommodation', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'accommodation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第1学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment1', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment1'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第2学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment2', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment2'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第3学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment3', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment3'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第4学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment4', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment4'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第5学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment5', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment5'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第6学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment6', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'payment6'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">奖惩情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'bonus_penalty', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'bonus_penalty'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">家庭住址</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'address', array('class'=>'form-control', 'placeholder'=>'家庭住址')); ?>
                                <?php echo $form->error($model,'address'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">家长电话</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'parents_tel', array('class'=>'form-control', 'placeholder'=>'家长电话')); ?>
                                <?php echo $form->error($model,'parents_tel'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">家长QQ</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'parents_qq', array('class'=>'form-control', 'placeholder'=>'家长QQ')); ?>
                                <?php echo $form->error($model,'parents_qq'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">毕业学校</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'school_of_graduation', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'school_of_graduation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">中考总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'senior_score', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'senior_score'); ?>
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">入学年份</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'school_year', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'school_year'); ?>
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">高考总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'college_score', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'college_score'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">录取学校</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'university', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'university'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'comment', array('class'=>'form-control', 'disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'comment'); ?>
                            </div>
                        </div>
                    
                    
                    <?php } else { // 教师个人信息 ?>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">教工号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'code',array('class'=>'form-control','disabled'=>'disabled')); ?>
                                <?php echo $form->error($model,'code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'name', array('class'=>'form-control','disabled'=>'disabled')); ?>
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
                            <label class="col-lg-2 control-label">家庭住址</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'address', array('class'=>'form-control', 'placeholder'=>'家庭住址')); ?>
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
                    <?php } ?>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-reset" value='重置' />
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                            </div>
                        </div>
                    
                <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
