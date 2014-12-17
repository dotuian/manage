<?php
$this->pageTitle = Yii::app()->name . '学生信息批量添加';
$this->breadcrumbs = array(
    '学生信息批量添加',
);

?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生成绩导入</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>学生成绩导入步骤：</h6>
                    <ul>
                        <li>在<a href="<?php echo $this->createUrl('score/template')?>" target="_blank">学生成绩导入模板</a>页面下载模板文件，正确填写学生的成绩信息。</li>
                        <li>选择对应的班级，选择模板文件，点击“读取数据”。如果数据有误会在表格的右方提示相应的错误。修改之后，重新执行读取数据操作。</li>
                        <li>如数据无误，点击表格右下方的“导入数据”。</li>
                    </ul>
                    
                    <hr />
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'import-score-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class' => 'form-horizontal', 'role'=>'form', 'onsubmit'=>'return loading()'), // enctype为文件上传说必须选项
                        ));
                    ?>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">文件</label>
                            <div class="col-lg-10">
                                <?php echo $form->fileField($model, 'filename', array('class' => 'form-control required')); ?>
                                <?php echo $form->error($model, 'filename'); ?>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="pull-left">

                                </div>
                                <div class="pull-right">
                                    <?php echo CHtml::hiddenField('validate', 'validate'); ?>
                                    <?php echo CHtml::submitButton('读取数据', array('class'=>'btn btn-import')); ?>
                                </div>
                                <div class="clearfix"></div> 
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
                    <?php foreach ($title as $value) { ?>
                        <th><?php echo $value; ?></th>
                    <?php } ?>
                    <th>错误信息</th>
                </tr>
            </thead>

            <tbody>
                <?php $index=0; foreach ($data as $value) { ++$index; ?>
                <tr class="<?php echo isset($value['error']) && is_array($value['error']) && count($value['error'])>0 ? 'error' : ''; ?>">
                    
                    <?php foreach ($title as $s) { ?>
                        <td class="center"><?php echo $value[$s]; ?></td>
                    <?php } ?>
                    
                    <td><?php 
                            if(isset($value['error']) && is_array($value['error'])) {
                                foreach ($value['error'] as $error) {
                                    echo "<span class='label label-mutil-danger'>" . $error . "</span> <br/>";
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
                    'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form', 'onsubmit'=>'return loading()'), 
                ));
            ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php echo $form->hiddenField($model, 'exam_id'); ?>
                <?php echo $form->hiddenField($model, 'class_id'); ?>
                <?php echo CHtml::hiddenField('import', 'import'); ?>
                <?php echo CHtml::submitButton('导入数据', array('class'=>'btn btn-search', 'confirm'=>'确定要导入吗？',)); ?>
            <?php $this->endWidget(); ?>
            </div>
            <div class="clearfix"></div> 
        </div>
        <?php } ?>

    </div>
</div>
<?php } ?>

