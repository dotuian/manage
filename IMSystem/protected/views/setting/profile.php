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
                                <?php echo $form->radioButtonList($model,'sex', StudentForm::getSexOption(false), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'sex'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group input-append" id="datetimepicker1" >
                            <label class="col-lg-2 control-label">出生年月日</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'birthday', array('data-format'=>'yyyy-MM-dd', 'class'=>'form-control dtpicker', 'placeholder'=>'出生年月日')); ?>
                                <span class="add-on">
                                    <i data-time-icon="fa fa-time" data-date-icon="fa fa-calendar" class="btn btn-info fa fa-calendar"></i>
                                <br/><?php echo $form->error($model,'birthday'); ?>
                                </span>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">身份证号码</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'id_card_no', array('class'=>'form-control','placeholder'=>'身份证号码')); ?>
                                <?php echo $form->error($model,'id_card_no'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">家庭住址</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'home_address', array('class'=>'form-control','placeholder'=>'家庭住址')); ?>
                                <?php echo $form->error($model,'home_address'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">担任科目</label>
                            <div class="col-lg-10">
                                <?php echo $form->checkBoxList($model,'subjects', MSubjects::model()->getAllSubjectsOption(false), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'subjects'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">电话号码</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'telephonoe', array('class'=>'form-control','placeholder'=>'电话号码')); ?>
                                <?php echo $form->error($model,'telephonoe'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">民族</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'nation', array('class'=>'form-control','placeholder'=>'民族')); ?>
                                <?php echo $form->error($model,'nation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">籍贯</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'birthplace', array('class'=>'form-control','placeholder'=>'籍贯')); ?>
                                <?php echo $form->error($model,'birthplace'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">工作年月</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'working_date', array('class'=>'form-control','placeholder'=>'工作年月')); ?>
                                <?php echo $form->error($model,'working_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">入党年月</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'party_date', array('class'=>'form-control','placeholder'=>'入党年月')); ?>
                                <?php echo $form->error($model,'party_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">职前学历</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'before_degree', array('class'=>'form-control','placeholder'=>'职前学历')); ?>
                                <?php echo $form->error($model,'before_degree'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">职前毕业时间</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'before_graduate_date', array('class'=>'form-control','placeholder'=>'职前毕业时间')); ?>
                                <?php echo $form->error($model,'before_graduate_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">职前毕业院校</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'before_graduate_school', array('class'=>'form-control','placeholder'=>'职前毕业院校')); ?>
                                <?php echo $form->error($model,'before_graduate_school'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">职前毕业专业</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'before_graduate_major', array('class'=>'form-control','placeholder'=>'职前毕业专业')); ?>
                                <?php echo $form->error($model,'before_graduate_major'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">现在学历</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_degree', array('class'=>'form-control','placeholder'=>'现在学历')); ?>
                                <?php echo $form->error($model,'current_degree'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">现学历毕业时间</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_graduate_date', array('class'=>'form-control','placeholder'=>'现学历毕业时间')); ?>
                                <?php echo $form->error($model,'current_graduate_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">现学历毕业院校</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_graduate_school', array('class'=>'form-control','placeholder'=>'现学历毕业院校')); ?>
                                <?php echo $form->error($model,'current_graduate_school'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">现学历毕业专业</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_graduate_major', array('class'=>'form-control','placeholder'=>'现学历毕业专业')); ?>
                                <?php echo $form->error($model,'current_graduate_major'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">专业技术职务</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'professional_technical_position', array('class'=>'form-control','placeholder'=>'专业技术职务')); ?>
                                <?php echo $form->error($model,'professional_technical_position'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">工作科室及职务</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'work_departments_postion', array('class'=>'form-control','placeholder'=>'工作科室及职务')); ?>
                                <?php echo $form->error($model,'work_departments_postion'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">现在职级</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_position_rank', array('class'=>'form-control','placeholder'=>'现在职级')); ?>
                                <?php echo $form->error($model,'current_position_rank'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">任现职年月</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_position_date', array('class'=>'form-control','placeholder'=>'任现职年月')); ?>
                                <?php echo $form->error($model,'current_position_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">任现级年月</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'current_level_date', array('class'=>'form-control','placeholder'=>'任现级年月')); ?>
                                <?php echo $form->error($model,'current_level_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">基本情况备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'basic_memo', array('class'=>'form-control','placeholder'=>'基本情况备注')); ?>
                                <?php echo $form->error($model,'basic_memo'); ?>
                            </div>
                        </div>
                    
                    <hr />
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">继续教育地址</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'continue_education_address', array('class'=>'form-control','placeholder'=>'继续教育地址')); ?>
                                <?php echo $form->error($model,'continue_education_address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">继续教育时间</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'continue_education_date', array('class'=>'form-control','placeholder'=>'继续教育时间')); ?>
                                <?php echo $form->error($model,'continue_education_date'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">获得学分</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'continue_education_credit', array('class'=>'form-control','placeholder'=>'获得学分')); ?>
                                <?php echo $form->error($model,'continue_education_credit'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">证明人</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'continue_education_prove_people', array('class'=>'form-control','placeholder'=>'证明人')); ?>
                                <?php echo $form->error($model,'continue_education_prove_people'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">表彰情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'moral_praise', array('class'=>'form-control','placeholder'=>'表彰情况')); ?>
                                <?php echo $form->error($model,'moral_praise'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学生测评</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'moral_student_evaluation', array('class'=>'form-control','placeholder'=>'学生测评')); ?>
                                <?php echo $form->error($model,'moral_student_evaluation'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">目标考核</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'moral_target_check', array('class'=>'form-control','placeholder'=>'目标考核')); ?>
                                <?php echo $form->error($model,'moral_target_check'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">师德备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'moral_memo', array('class'=>'form-control','placeholder'=>'师德备注')); ?>
                                <?php echo $form->error($model,'moral_memo'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <label class="col-lg-2 control-label">任教年级</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'teach_grades', array('class'=>'form-control','placeholder'=>'任教年级')); ?>
                                <?php echo $form->error($model,'teach_grades'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">教研职务</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'teaching_research_postion', array('class'=>'form-control','placeholder'=>'教研职务')); ?>
                                <?php echo $form->error($model,'teaching_research_postion'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">招生情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'recruit_students', array('class'=>'form-control','placeholder'=>'招生情况')); ?>
                                <?php echo $form->error($model,'recruit_students'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">考勤情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'attendance', array('class'=>'form-control','placeholder'=>'考勤情况')); ?>
                                <?php echo $form->error($model,'attendance'); ?>
                            </div>
                        </div>
                    
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">履职备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'working_memo', array('class'=>'form-control','placeholder'=>'履职备注')); ?>
                                <?php echo $form->error($model,'working_memo'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">辅导获奖</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'tutorship_award', array('class'=>'form-control','placeholder'=>'辅导获奖')); ?>
                                <?php echo $form->error($model,'tutorship_award'); ?>
                            </div>
                        </div>
                    
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">参赛获奖</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'competition_award', array('class'=>'form-control','placeholder'=>'参赛获奖')); ?>
                                <?php echo $form->error($model,'competition_award'); ?>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">论文著作</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'paper_work', array('class'=>'form-control','placeholder'=>'论文著作')); ?>
                                <?php echo $form->error($model,'paper_work'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">参赛项目情况</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'competition_item', array('class'=>'form-control','placeholder'=>'参赛项目情况')); ?>
                                <?php echo $form->error($model,'competition_item'); ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">业务备注</label>
                            <div class="col-lg-10">
                                <?php echo $form->textArea($model,'business_memo', array('class'=>'form-control','placeholder'=>'业务备注')); ?>
                                <?php echo $form->error($model,'business_memo'); ?>
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
