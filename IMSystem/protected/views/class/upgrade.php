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
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>每学年，以班为单位批量修改学生班级信息。</h6>
                    <hr />

                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'updrade-class-form',
                            'enableClientValidation'=>true,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(旧学年)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'old_class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'old_class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(新学年)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'new_class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control')); ?>
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
