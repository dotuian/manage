<?php
$this->pageTitle=Yii::app()->name . '系统配置';
$this->breadcrumbs = array(
    '系统配置',
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
                            <label class="col-lg-2 control-label">系统运行状态</label>
                            <div class="col-lg-10">
                                <?php echo $form->textField($model,'import_student_end_date', array('class'=>'form-control form_datetime', 'placeholder'=>'结束日期')); ?>
                                <?php echo $form->textField($model,'import_student_end_date', array('class'=>'form-control form_datetime', 'placeholder'=>'结束日期')); ?>
                                <?php echo $form->error($model,'import_student_end_date'); ?>
                            </div>
                        </div>

<script>
$(document).ready(function(){
    $('.form_datetime').datetimepicker({
        language:  'zh-CN',
        format: 'yyyy-mm-dd',
        autoclose: 1,
    });
});
</script>


<div class="input-append date form_datetime">
    <input size="16" type="text" value="" readonly>
    <span class="add-on"><i class="icon-th"></i></span>
</div>
 
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "dd MM yyyy - hh:ii"
    });
</script>            




                        <div class="form-group">
                            <label class="col-lg-2 control-label">系统运行状态</label>
                            <div class="col-lg-10">
                                <?php echo $form->radioButtonList($model,'maintenance', ConfigForm::getMaintenanceOption(false), array('separator'=>'　')); ?>
                                <?php echo $form->error($model,'maintenance'); ?>
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
