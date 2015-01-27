<?php
$this->pageTitle=Yii::app()->name . '学生信息变更';
$this->breadcrumbs=array(
    "学生信息检索"  => $this->createUrl('search'),
    "学生信息变更",
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>查看/修改学生基本信息。</h6>
                    <ul>
                        <li>在校学生：可以查看和修改在校学生的信息。</li>
                        <li>离校学生：可以查看离校学生的信息，但不能修改。</li>
                    </ul>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-student-form',
                            'enableClientValidation'=>true,
                            'method' => 'post',
                            'action' => $this->createUrl('update', array('ID' => $model->ID)),
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">省内编号</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->textField($model,'province_code',array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'province_code'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">姓名</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'name', array('class'=>'form-control required','placeholder'=>'姓名', 'disabled'=>'disabled')); ?>
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
                                <?php echo $form->textField($model,'id_card_no', array('class'=>'form-control required','placeholder'=>'身份证号码')); ?>
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
                                
                                <?php echo "<br/>" . $form->error($model,'birthday'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级履历</label>
                            <div class="col-lg-10">
                                <?php $classes = $model->getStudentAllClassInfo(); ?>
                                <?php if(count($classes) > 0) {  ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <th class="center">年度</th>
                                    <th class="center autohide">年级</th>
                                    <th class="center autohide">学期</th>
                                    <th class="center autohide">类型</th>
                                    <th class="center autohide">专业</th>
                                    <th class="center">班级</th>
                                    <th class="center">学号</th>
                                    <th class="center">班主任</th>
                                    <?php foreach ($classes as $class) { ?>
                                    <tr>
                                        <td class="center"><?php echo $class['entry_year']; ?></td>
                                        <td class="center autohide"><?php echo TClasses::model()->getEntryYearDisplayName($class['grade']); ?></td>
                                        <td class="center autohide"><?php echo TClasses::model()->getTermTypeDisplayName($class['term_type']);?></td>
                                        <td class="center autohide"><?php echo TClasses::model()->getClassTypeName($class['class_type']); ?></td>
                                        <td class="center autohide"><?php echo $class['specialty_name']; ?></td>
                                        <td class="center"><?php echo $class['class_name']; ?></td>
                                        <td class="center"><?php echo $class['student_number']; ?></td>
                                        <td class="center"><?php echo $class['name']; ?></td>
                                    </tr>
                                    <?php }?>
                                </table>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- 
                        <div class="form-group">
                            <label class="col-lg-2 control-label">目前所在班级</label>
                            <div class="col-lg-10">
                                <?php // echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control required', 'disabled'=>'disabled',)); ?>
                                <?php // echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">目前所在班级学号</label>
                            <div class="col-lg-10">
                                <?php // echo $form->textField($model,'student_number', array('class'=>'form-control required', 'placeholder'=>'目前所在班级学号', 'disabled'=>'disabled',)); ?>
                                <?php // echo $form->error($model,'student_number'); ?>
                            </div>
                        </div>
                        -->

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
                                <?php echo $form->radioButtonList($model,'payment1', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'payment1'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第2学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'payment2', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'payment2'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第3学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'payment3', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'payment3'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第4学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'payment4', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'payment4'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第5学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'payment5', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'payment5'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">缴费情况（第6学期）</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'payment6', StudentForm::getPaymentOption(false) , array('separator'=>'　')); ?>
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
                                <?php echo $form->telField($model,'parents_tel', array('class'=>'form-control', 'placeholder'=>'家长电话')); ?>
                                <?php echo $form->error($model,'parents_tel'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">家长QQ</label>
                            <div class="col-lg-10">
                                <?php echo $form->numberField($model,'parents_qq', array('class'=>'form-control', 'placeholder'=>'家长QQ')); ?>
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
                        <?php if($model->status == '1') { ?>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">
                                    <?php 
                                        echo CHtml::Button('离校', array(
                                            'confirm'=>'确定要将该学生设置为离校状态吗？',
                                            'params'=>array('ID' => $model->ID),
                                            'submit' => array('delete'),
                                            'class'=>'btn btn-delete',
                                            'encode'=>false,
                                        ));
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update')); ?>
                                </div>
                                <div class="clearfix"></div> 
                            </div>
                        </div>
                        <?php } ?>
                    
                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>  

    </div>
</div>
