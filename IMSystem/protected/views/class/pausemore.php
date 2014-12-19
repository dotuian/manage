<?php
$this->pageTitle = Yii::app()->name . '暂停班级';
$this->breadcrumbs = array(
    '暂停班级',
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
        alert('请选择要暂停的班级！');
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
        <div class="pull-left">暂停班级</div>
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
                        <th class="autohide">班级代号</th>
                        <th>班级名称</th>
                        <th class="autohide">年级</th>
                        <th>入学年份</th>
                        <th>学期</th>
                        <th>班级类型</th>
                        <th class="autohide">专业名称</th>
                        <th class="autohide">班主任</th>
                        <th>状态</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($classes as $class) { ?>
                    <tr>
                        <td class="center">
                            <?php echo $form->checkBox($model,"class_ids[{$class['ID']}]", array('class'=>'option')); ?>
                        </td>
                        <td class="center autohide"><?php echo $class['class_code']; ?></td>
                        <td class="center"><?php echo $class['class_name']; ?></td>
                        <td class="center autohide"><?php echo $class['grade']; ?></td>
                        <td class="center"><?php echo $class['entry_year']; ?></td>
                        <td class="center"><?php echo TClasses::model()->getTermTypeName($class['term_type']); ?></td>
                        <td class="center"><?php echo TClasses::model()->getClassTypeName($class['class_type']); ?></td>
                        <td class="center autohide"><?php echo $class['specialty_name']; ?></td>
                        <td class="center autohide"><?php echo $class['name']; ?></td>
                        <td class="center">
                            <span class="label <?php echo $class['status'] === '1' ? 'label-active' : 'label-stop';?>">
                                <?php echo TClasses::model()->getClassStatusName($class['status']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                    <div class="clearfix"></div> 
                </tbody>
            </table>

            <div class="widget-foot">
                <div class="pull-right">
                    <?php echo CHtml::submitButton('暂停所选班级', array('class'=>'btn btn-delete')); ?>
                </div>
                <div class="clearfix"></div> 
            </div>
        <?php $this->endWidget(); ?>
        
    </div>
</div>
<?php } ?>