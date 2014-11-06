<?php
$this->pageTitle=Yii::app()->name . '班级升级';
$this->breadcrumbs = array(
    '班级升级',
);
?>
<script>
//$(document).ready(function(){
//    
//    $('#datetimepicker1').datetimepicker({
//        pickTime: false
//    });
//});
</script>



<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">班级升级</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>
                        <ul>
                            <li>每学年，以班为单位批量修改学生班级信息。比如：“高二(2)班上学期”的学生，在新学期开始的时候，该班全班学生的班级信息变为“高二(2)班上学期”时，可以使用该功能。</li>
                            <li>班级学生迁移之前，要将原先的班级(高二(2)班上学期)停止，然后重新添加一个新的班级(高二(2)班上学期)</li>
                        </ul>
                        </br>
                    </h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'updrade-class-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(旧)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'old_class_id', TClasses::model()->getAllStopClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'old_class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(新)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'new_class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'new_class_id'); ?>
                            </div>
                        </div>

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
