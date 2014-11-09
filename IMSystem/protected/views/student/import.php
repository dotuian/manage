<?php
$this->pageTitle = Yii::app()->name . '学生信息批量添加';
$this->breadcrumbs = array(
    '学生信息批量添加',
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
                <div class="pull-left">学生信息批量添加</div>
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
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class' => 'form-horizontal', 'role'=>'form'), // enctype为文件上传说必须选项
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
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
                                <?php echo CHtml::hiddenField('validate', 'validate'); ?>
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



<?php if(!is_null($data) &&  count($data) > 0 ) { ?>
<!-- 检索结果 -->
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">数据确认</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th rowspan="2">学号</th>
                    <th rowspan="2">姓名</th>
                    <th rowspan="2">性别</th>
                    <th rowspan="2">身份证号码</th>
                    <th colspan="2">班级</th>
                    <th rowspan="2">住宿<br/>情况</th>
                    <th rowspan="2">家庭住址</th>
                    <th rowspan="2">家长电话</th>
                    <th rowspan="2">毕业学校</th>
                    <th rowspan="2">数据信息</th>
                </tr>
                <tr>
                    <th>原</th>
                    <th>现</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $value) { ?>
                <tr class="<?php echo isset($value['error']) && is_array($value['error']) && count($value['error'])>0 ? 'error' : ''; ?>">
                    <td class="center"><?php echo $value['student_number']; ?></td>
                    <td class="center"><?php echo $value['name']; ?></td>
                    <td class="center"><?php echo $value['sex']; ?></td>
                    <td><?php echo $value['id_card_no']; ?></td>
                    <td class="center"><?php echo $value['old_class_code']; ?></td>
                    <td class="center"><?php echo $value['new_class_code']; ?></td>
                    <td class="center"><?php echo $value['accommodation']; ?></td>
                    
                    <td title="<?php echo $value['address']; ?>"><?php echo $value['address']; ?></td>
                    <td><?php echo $value['parents_tel']; ?></td>
                    <td class="center"><?php echo $value['school_of_graduation']; ?></td>
                    
                    <td><?php 
                            if(isset($value['error']) && is_array($value['error'])) {
                                foreach ($value['error'] as $error) {
                                    echo "<span class='label label-danger'>" . $error . "</span> <br/>";
                                }
                            }
                        ?>
                    </td>
                </tr>
                <?php } ?>
                <div class="clearfix"></div> 
            </tbody>
        </table>
        
        <?php if(isset($check) && $check) { ?>
        <div class="widget-foot">
            <div class="pull-right">
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'file-upload-form',
                    'enableClientValidation' => false,
                    'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'), // enctype为文件上传说必须选项
                ));
            ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php echo $form->hiddenField($model, 'class_id'); ?>
                <?php echo CHtml::hiddenField('import', 'import'); ?>
                <?php echo CHtml::submitButton('导入数据', array('class'=>'btn btn-search')); ?>
            <?php $this->endWidget(); ?>
            </div>
            <div class="clearfix"></div> 
        </div>
        <?php } ?>

    </div>
</div>
<?php } ?>






