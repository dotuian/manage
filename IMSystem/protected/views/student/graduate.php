<?php
$this->pageTitle = Yii::app()->name . '学生毕业处理';
$this->breadcrumbs = array(
    '学生毕业处理',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function() {
    $('#selectAll').click(function(event) {
        if(this.checked) {
            $('.option').each(function() {
                this.checked = true;
            });
        }else{
            $('.option').each(function() {
                this.checked = false;
            });         
        }
    });
});

function check(){
    var flag = false;
    console.log('aaa');
    $('.option').each(function() {
        if(this.checked) {
            flag = this.checked;
        }
    });
    if(!flag) {
        alert('请选择要进行离校处理的班级！');
        return false;
    } else {
        return true;
    }
}

", CClientScript::POS_HEAD);
?>

<!-- 检索条件 -->
<?php if(count($classes) > 0 ) { ?>
<div class="widget">
    <div class="widget-head">
        <div class="pull-left">学生毕业处理</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'stop-class-form',
                'method' => 'post',
                'enableClientValidation' => false,
                'htmlOptions' => array('class' => 'form-signin', 'onsubmit'=>'return check()'),
            ));
        ?>
            <table class="table table-striped table-bordered table-hover" id="result">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>班级代号</th>
                        <th>班级名称</th>
                        <th>年级</th>
                        <th>入学年份</th>
                        <th>学期</th>
                        <th>班级类型</th>
                        <th>专业名称</th>
                        <th>班主任</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($classes as $class) { ?>
                    <tr>
                        <td class="center">
                            <?php echo $form->checkBox($model,"class_ids[{$class['ID']}]", array('class'=>'option')); ?>
                        </td>
                        <td class="center"><?php echo $class['class_code']; ?></td>
                        <td class="center"><?php echo $class['class_name']; ?></td>
                        <td class="center"><?php echo $class['grade']; ?></td>
                        <td class="center"><?php echo $class['entry_year']; ?></td>
                        <td class="center"><?php echo TClasses::model()->getTermTypeName($class['term_type']); ?></td>
                        <td class="center"><?php echo TClasses::model()->getClassTypeName($class['class_type']); ?></td>
                        <td class="center"><?php echo $class['specialty_name']; ?></td>
                        <td class="center"><?php echo $class['name']; ?></td>
                        <td class="center">
                            <span class="label <?php echo $class['status'] === '1' ? 'label-active' : 'label-stop';?>">
                                <?php echo TClasses::model()->getClassStatusName($class['status']); ?>
                            </span>
                        </td>
                        <td class="center">
                            <?php if(in_array('class/student', $this->authoritys)) { ?>
                                <a href="<?php echo $this->createUrl('class/student', array('ID' => $class['ID'])) ?>">学生一览</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <div class="clearfix"></div> 
                </tbody>
            </table>

            <div class="widget-foot">
                <div class="pull-right">
                    <?php echo CHtml::submitButton('毕业离校处理', array('class'=>'btn btn-delete')); ?>
                </div>
                <div class="clearfix"></div> 
            </div>
        <?php $this->endWidget(); ?>
        
    </div>
</div>
<?php } ?>