<?php
$this->pageTitle = Yii::app()->name . '学生班级信息变更';
$this->breadcrumbs = array(
    '学生班级信息变更',
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
    var flag = false; // 是否有被选中的
//    var isError = false; // 是否有学号错误的
    
//    $('span').each(function(){
//        //console.log(this);
//        $(this).removeClass();
//        $(this).text('');
//    });

    $('.option').each(function() {
        if(this.checked) {
//            var error = $('#ERROR' + this.id + '');
//            var input = $('#NO' + this.id + '');
//            console.log(input.val());
//            
//            if(input.val() == '') {
//                error.addClass('label label-danger');
//                error.text('学号不能为空！');
//                isError = true;
//            } 
//            else if(!input.val().match(/^[2][0-9]+[0-9]?$/)) {
//                error.addClass('label label-danger');
//                error.text('学号信息有误！');
//                isError = true;
//            }

            flag = this.checked;
        }
    });
    
//    // 如果页面输入有误，直接返回
//    if(isError) {
//        return false;
//    }

    if(!flag) {
        alert('请选择要要变更班级的学生！');
        return false;
    } else {
        if(confirm('确定要变更所选学生的班级信息吗？')) {
            $.blockUI({ message: null }); 
            return true;
        } else {
            return false;
        }
    }
}

", CClientScript::POS_HEAD);
?>

<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生班级信息变更</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <h6>学生班级信息变更</h6>
                    
                    <hr />
                    <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'change-class-form',
                            'enableClientValidation' => false,
                            'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                        ));
                    ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(变更前)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'old_class_id', TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'old_class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">班级(变更后)</label>
                            <div class="col-lg-10">
                                <?php echo $form->dropDownList($model,'new_class_id', TClasses::model()->getAllUsingClassOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'new_class_id'); ?>
                            </div>
                        </div>
                    
                        <hr />
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-9">
                                <?php echo CHtml::hiddenField('search', 'search'); ?>
                                <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-import')); ?>
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
        <div class="pull-left">学生信息</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'change-class-form',
                'method' => 'post',
                'enableClientValidation' => false,
                'htmlOptions' => array('class' => 'form-signin', 'onsubmit'=>'return check()'),
            ));
        ?>
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th rowspan="2"><input type="checkbox" id="selectAll"></th>
                    <th rowspan="2">学号</th>
                    <th rowspan="2">姓名</th>
                    <th rowspan="2">性别</th>
                    <th colspan="4">班级(变更前)</th>
                    <th colspan="5">班级(变更后)</th>
                    <!--<th rowspan="2">提示消息</th>-->
                </tr>
                <tr>
                    <th>年级</th>
                    <th>班级年份</th>
                    <th>名称</th>
                    <th>学期</th>
                    <th>年级</th>
                    <th>班级年份</th>
                    <th>名称</th>
                    <th>学期</th>
                    <!--
                    <th>学号</th>
                    -->
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $value) { ?>
                <tr>
                    <td class="center">
                        <?php echo $form->checkBox($model,"student_ids[{$value['ID']}]", array('class'=>'option', 'id'=> $value['ID'])); ?>
                    </td>
                    <td class="center"><?php echo $value['student_number']; ?></td>
                    <td class="center"><?php echo $value['name']; ?></td>
                    <td class="center"><?php if($value['sex']=='M') echo '男'; if($value['sex']=='F') echo '女'; ?></td>
                    
                    <td class="center"><?php echo TClasses::model()->getEntryYearDisplayName($value['grade']); ?></td>
                    <td class="center"><?php echo $value['entry_year'] ?></td>
                    <td class="center"><?php echo $value['class_name'] ?></td>
                    <td class="center"><?php echo TClasses::model()->getTermTypeDisplayName($value['term_type']) ?></td>
                    
                    <td class="center"><?php echo TClasses::model()->getEntryYearDisplayName($new_class->grade); ?></td>
                    <td class="center"><?php echo $new_class->entry_year; ?></td>
                    <td class="center"><?php echo $new_class->class_name; ?></td>
                    <td class="center"><?php echo TClasses::model()->getTermTypeDisplayName($new_class->term_type); ?></td>
                    <!--
                    <td>
                        <?php echo $form->textField($model,"student_numbers[{$value['ID']}]", array('class'=>'form-control', 'id'=>"NO{$value['ID']}", 'maxlength'=>10)); ?>
                    </td>
                    <td>
                        <span id="ERROR<?php echo $value['ID']; ?>"></span>
                    </td>
                    -->
                </tr>
                <?php } ?>
                <div class="clearfix"></div> 
            </tbody>
        </table>
        
        <div class="widget-foot">
            <div class="pull-right">
                <?php echo $form->hiddenField($model, 'old_class_id'); ?>
                <?php echo $form->hiddenField($model, 'new_class_id'); ?>
                <?php echo CHtml::hiddenField('change', 'change'); ?>
                <?php echo CHtml::submitButton('变更', array('class'=>'btn btn-search')); ?>
            </div>
            <div class="clearfix"></div> 
        </div>

        <?php $this->endWidget(); ?>
        
    </div>
</div>
<?php } ?>

