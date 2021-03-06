<?php
$this->pageTitle = Yii::app()->name . '课程信息添加';
$this->breadcrumbs = array(
    '课程信息添加',
);
?>
<script>
$(document).ready(function(){

});

</script>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">条件指定</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'add-class-form',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        该页面，可以添加课程的信息。<br/>
                        先选定班级，然后指定该班级的科目，点击"添加"按钮之后，在下方的"课程添加"列表中指定教师。
                    </h6>
                    <hr/>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">班级</label>
                        <div class="col-lg-10 inline-block">
                            <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(false), array('class'=>'form-control required')); ?>
                            <?php echo $form->error($model,'class_id'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">科目</label>
                        <div class="col-lg-10 inline-block">
                            <?php echo $form->checkBoxList($model,'subjects', MSubjects::model()->getAllSubjectsOption(false), array('separator'=>'　')); ?>
                            <br/><?php echo $form->error($model,'subjects'); ?>
                        </div>
                    </div>
                </div>

                <div class="widget-foot">
                    <div class="pull-right">
                        <?php echo CHtml::submitButton('添加', array('class'=>'btn btn-primary')); ?>
                    </div>
                    <div class="clearfix"></div> 
                </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>



<!-- 检索结果 -->
<?php if(isset($data)) { ?>
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">课程添加</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <!-- 以班级为单位添加 --->
        <?php if($model->type ==='1' && isset($class) ) { ?>
            <table class="table table-striped table-bordered table-hover" id="result">
                <thead>
                    <tr><th>班级</th><th>科目</th><th>教师</th><th>操作</th><th>操作结果</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($subjects as $subject) { ?>
                        <tr>
                            <?php
                                // 获取数据库中已经存在的数据
                                $course = MCourses::model()->find("class_id=:class_id and subject_id=:subject_id and status='1'",array(':subject_id' => $subject->ID, ':class_id' => $class->ID));
                                if(!is_null($course)){
                                    $data->teacher_id = $course->teacher_id;
                                } else {
                                    $data->teacher_id = null;
                                }
                            
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'add-course-form' . $subject->ID,
                                    'enableClientValidation' => false,
                                    'method' => 'post',
                                    'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                                ));
                            ?>
                                <td class="center"><?php echo $class->class_name; ?></td>
                                <td class="center"><?php echo $subject->subject_name; ?></td>
                                <td class="center">
                                    <?php echo $form->dropDownList($data,'teacher_id', TTeachers::model()->getAllTeacherWithPinYinOption(true), array('class'=>'form-control', 'id'=> 'teacher'. $subject->ID)); ?>
                                </td>
                                <td class="center">
                                    <?php echo CHtml::ajaxButton("保存",   
                                            Yii::app()->createUrl('ajax/insertCourse'),
                                            array(
                                                'type'=>'POST',
                                                'data' => array(
                                                        'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                        'class_id'=> $class->ID,
                                                        'subject_id'=> $subject->ID,
                                                        'teacher_id'=> "js:$('#teacher$subject->ID').val()",
                                                    ),
                                                'beforeSend'=>"function(xhr, opts){
                                                        $('#result$subject->ID').html('');
                                                        $.blockUI({ message: null });
                                                    }",
                                                'success'=>"function(data){
                                                        $.unblockUI();
                                                        data = JSON.parse(data);
                                                        var show = $('#result$subject->ID');

                                                        show.removeClass();
                                                        if(data.result) {
                                                            show.addClass('label label-success');
                                                        } else {
                                                            show.addClass('label label-danger');
                                                        }
                                                        show.text(data.message);

                                                    }",                                                
                                            ),
                                            array(
                                                'class'=>'btn btn-save'
                                            )); ?>
                                    
                                    <?php 
                                    // 根据科目CODE，获取相应的科目教师
//                                    echo $form->dropDownList($data,'teacher_id', TTeachers::model()->getAllTeacherGroupOption(true, $subject->subject_code), array(
//                                        'class'=>'form-control',
//                                        'id' => 'teacher_id' . $subject->ID ,
//                                        'ajax'=>array(
//                                            'type'=>'POST',
//                                            'data' => array(
//                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
//                                                'class_id'=> $class->ID,
//                                                'subject_id'=> $subject->ID,
//                                                'teacher_id'=> 'js:$(this).val()',
//                                            ),
//                                            'url' => Yii::app()->createUrl('ajax/insertCourse'),
//                                            //'update'=>'#objtype',
//                                            'beforeSend'=>"function(){
//                                                    $('#result$subject->ID').html('');
//                                                    $.blockUI({ message: null });
//                                                }",
//                                            'success'=>"function(data){
//                                                    $.unblockUI();
//                                                    data = JSON.parse(data);
//                                                    var show = $('#result$subject->ID');
//
//                                                    show.removeClass();
//                                                    if(data.result) {
//                                                        show.addClass('label label-success');
//                                                    } else {
//                                                        show.addClass('label label-danger');
//                                                    }
//                                                    show.text(data.message);
//
//                                                }",
//                                        )
//                                        )); ?>
                                </td>
                                <td>
                                    <span id="result<?php echo $subject->ID; ?>"></span>
                                </td>
                            <?php $this->endWidget(); ?>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
<?php } ?>
