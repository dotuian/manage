<?php
$this->pageTitle=Yii::app()->name . '系统配置';
$this->breadcrumbs = array(
    '系统配置',
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">系统配置</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>修改系统运行配置。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'update-subject-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">学生信息批量导入时间区间  </label>
                            <div class="col-lg-2">
                                <div class="input-append" id="start_date" >
                                    <div>
                                        <?php echo $form->textField($model,'import_student_start_date', array('data-format'=>'yyyy-MM-dd', 'class'=>'form-control dtpicker required', 'placeholder'=>'开始日期')); ?>
                                        <span class="add-on">
                                            <i data-time-icon="fa fa-time" data-date-icon="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <?php echo $form->error($model,'import_student_start_date'); ?>
                            </div>

                            <div class="col-lg-2">
                                <div class="input-append" id="end_date" >
                                    <div>
                                        <?php echo $form->textField($model,'import_student_end_date', array('data-format'=>'yyyy-MM-dd', 'class'=>'form-control dtpicker required', 'placeholder'=>'结束日期')); ?>
                                        <span class="add-on">
                                            <i data-time-icon="fa fa-time" data-date-icon="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <?php echo $form->error($model,'import_student_end_date'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-update ')); ?>
                            </div>
                        </div>

                    <?php $this->endWidget(); ?>
                    
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function(){
    $('#start_date').datetimepicker({
        language:  'zh-CN',
        autoclose: true,
        pickTime: false
    });
    $('#end_date').datetimepicker({
        language:  'zh-CN',
        autoclose: true,
        pickTime: false
    });
    
});
</script>