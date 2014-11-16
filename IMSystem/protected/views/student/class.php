<?php
$this->pageTitle = Yii::app()->name . '学生信息检索';
$this->breadcrumbs = array(
    '学生信息检索',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){


});
", CClientScript::POS_END );
?>

<script>
</script>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">班级成绩信息</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'class-score-form',
                        'method' => 'post',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        班主任，任课教师查看权限范围内学生信息。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassOptionByUserRole($this->getLoginUserId(), false), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-search')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>

<?php if(isset($data) && count($data) > 0) { ?>
<!-- 检索结果 -->
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">检索结果</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>身份证号</th>
                    <th>入学年份</th>
                    <th>现在所在班级</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) {?>
                <tr>
                    <td class="center"><?php echo $value['student_number']; ?></td>
                    <td class="center"><?php echo $value['name']; ?></td>
                    <td class="center"><?php if($value['sex'] == 'M') echo '男' ; if($value['sex'] == 'F') echo '女'; ?></td>
                    <td class="center"><?php echo $value['id_card_no']; ?></td>
                    <td class="center"><?php echo $value['school_year']; ?></td>
                    <td class="center"><?php echo $value['class_name']; ?></td>
                    <td class="center">
                        <span class="label <?php echo $value['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $value['status'] === '1' ? '在校' : '离校'; ?></span>
                    </td>
                </tr>
                <?php } ?>
                <div class="clearfix"></div> 
            </tbody>
        </table>

    </div>
</div>
<?php } ?>


