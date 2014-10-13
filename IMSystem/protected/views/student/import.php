<?php
$this->pageTitle = Yii::app()->name . '学生信息批量添加';
$this->breadcrumbs = array(
    '学生信息批量添加',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){


});
", CClientScript::POS_END );
?>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>该页面，可以对学生信息批量添加。</h6>
                    <hr />
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'file-upload-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data'), // enctype为文件上传说必须选项
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">文件名</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->fileField($model, 'filename', array('class' => 'form-control')); ?>
                                <?php echo $form->error($model, 'filename'); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php echo CHtml::submitButton('批量导入', array('class'=>'btn btn-import')); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>

    </div>
</div>