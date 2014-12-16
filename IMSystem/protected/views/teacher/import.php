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
                    <h6>教师信息批量导入操作步骤：</h6>
                    <ul>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/files/template/teacher.xlsx">下载Excel数据模板</a>，正确填写需要导入的教师信息。</li>
                        <li>填好的模板文件，点击“读取数据”。如果数据有误会在表格的右方提示相应的错误。修改之后，重新执行读取数据操作。</li>
                        <li>如数据无误，点击表格右下方的“导入数据”。</li>
                    </ul>
                    
                    <hr />
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'file-upload-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data','class' => 'form-horizontal', 'role'=>'form', 'onsubmit'=>'return loading()'), // enctype为文件上传说必须选项
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
                    <th>No.</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>民族</th>
                    <th>籍贯</th>
                    <th>身份证</th>
                    <th>出生年月日</th>
                    <th>担任科目</th>
                    <th>工作年月</th>
                    <th>信息</th>
                </tr>
            </thead>

            <tbody>
                <?php $index=0; foreach ($data as $value) { ++$index; ?>
                <tr class="<?php echo isset($value['error']) && is_array($value['error']) && count($value['error'])>0 ? 'error' : ''; ?>">
                    <td class="center"><?php echo $index; ?></td>
                    
                    <td class="center"><?php echo $value["name"]; ?></td>
                    <td class="center"><?php if($value['sex']=='M'){echo '男';} if($value['sex']=='F'){echo '女';} ?></td>
                    <td class="center"><?php echo $value["nation"]; ?></td>
                    <td class="center"><?php echo $value["birthplace"]; ?></td>
                    <td class="center"><?php echo $value["id_card_no"]; ?></td>
                    
                    <td class="center"><?php echo $value["birthday"]; ?></td>
                    <td class="center"><?php echo $value["subjects"]; ?></td>
                    
                    <td class="center"><?php echo $value["working_date"]; ?></td>
                    
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
                    'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form', 'onsubmit'=>'return loading()'), // enctype为文件上传说必须选项
                ));
            ?>
                <?php echo $form->hiddenField($model, 'ID'); ?>
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
