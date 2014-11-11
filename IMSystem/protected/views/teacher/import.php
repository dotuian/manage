<?php
$this->pageTitle = Yii::app()->name . '教师信息批量添加';
$this->breadcrumbs = array(
    '教师信息批量添加',
);

?>

<style>
ul.error{

}
    
</style>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">教师信息批量添加</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'file-upload-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class' => 'form-horizontal', 'role'=>'form'), // enctype为文件上传说必须选项
                        ));
                    ?>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">文件名</label>
                            <div class="col-lg-10">
                                <?php echo $form->fileField($model, 'filename', array('class' => 'form-control required')); ?>
                                <?php echo $form->error($model, 'filename'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php echo CHtml::submitButton('读取数据', array('class'=>'btn btn-import')); ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>

    </div>
</div>