<?php
$this->pageTitle= '学生信息添加';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<script>
$(document).ready(function(){
    
    $('#datetimepicker1').datetimepicker({
        pickTime: false
    });
});
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
                    <h6>该页面，可以添加一个学生的信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'add-student-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'code',array('class'=>'form-control','placeholder'=>'学号')); ?>
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
                                <?php echo $form->radioButtonList($model,'sex', StudentForm::getSexOption(false), array('separator'=>'　')); ?>
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
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">住宿情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'accommodation', array('class'=>'form-control', 'placeholder'=>'住宿情况')); ?>
                                <?php echo $form->error($model,'accommodation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第1学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment1', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第1学期）')); ?>
                                <?php echo $form->error($model,'payment1'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第2学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment2', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第2学期）')); ?>
                                <?php echo $form->error($model,'payment2'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第3学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment3', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第3学期）')); ?>
                                <?php echo $form->error($model,'payment3'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第4学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment4', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第4学期）')); ?>
                                <?php echo $form->error($model,'payment4'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第5学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment5', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第5学期）')); ?>
                                <?php echo $form->error($model,'payment5'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第6学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'payment6', StudentForm::getPaymentOption(true) , array('class'=>'form-control', 'placeholder'=>'缴费情况（第6学期）')); ?>
                                <?php echo $form->error($model,'payment6'); ?>
                            </div>
                        </div>
                    
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">奖惩情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'bonus_penalty', array('class'=>'form-control', 'placeholder'=>'奖惩情况')); ?>
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
                                <?php echo $form->textField($model,'school_of_graduation', array('class'=>'form-control', 'placeholder'=>'毕业学校')); ?>
                                <?php echo $form->error($model,'school_of_graduation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">中考总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'senior_score', array('class'=>'form-control', 'placeholder'=>'中考总分')); ?>
                                <?php echo $form->error($model,'senior_score'); ?>
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">入学年份</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'school_year', array('class'=>'form-control', 'placeholder'=>'入学年份')); ?>
                                <?php echo $form->error($model,'school_year'); ?>
                            </div>
                        </div>
                    

                        <div class="form-group">
                            <label class="col-lg-2 control-label">高考总分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'college_score', array('class'=>'form-control', 'placeholder'=>'高考总分')); ?>
                                <?php echo $form->error($model,'college_score'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">录取学校</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'university', array('class'=>'form-control', 'placeholder'=>'录取学校')); ?>
                                <?php echo $form->error($model,'university'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'comment', array('class'=>'form-control', 'placeholder'=>'备注')); ?>
                                <?php echo $form->error($model,'comment'); ?>
                            </div>
                        </div>
                    

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <input type="reset" class="btn btn-default" value='重置' />
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-primary ')); ?>
                            </div>
                        </div>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
