<?php
$this->pageTitle = Yii::app()->name . '学生成绩录入';
$this->breadcrumbs = array(
    '学生成绩录入',
);



Yii::app()->clientScript->registerScript('create', "

$(document).ready(function(){
    //$('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
});

",CClientScript::POS_HEAD);

?>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生成绩录入</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'add-score-form',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        该页面，可以添加一个班级的成绩信息。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
                            </div>
                        </div>

                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(true), array(
                                        'class'=>'form-control required',
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'data' => array(
                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                'class_id'=> 'js:$(this).val()',
                                                'allowempty' => 'true'
                                            ),
                                            'url' => Yii::app()->createUrl('ajax/getSubjectOption'),
                                            'beforeSend'=>"function(){
                                                    $.blockUI({ message: null });
                                                }",
                                            'success'=>"function(data){
                                                    $.unblockUI();
                                                    $('#subject_id').html(data);
                                                }",
                                        )
                                        )); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group" id="subject">
                            <label class="col-lg-2 control-label">科目</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsByClassOption($model->class_id, true), array('class'=>'form-control required', 'id'=>'subject_id')); ?>
                                <?php echo $form->error($model,'subject_id'); ?>
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


<!-- 检索结果 -->
<?php if(isset($data) && count($students) > 0 ) { ?>
<div class="widget">

    <div class="widget-head">
        <div class="pull-left"><?php echo $class->class_name ?>学生成绩录入</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th class="autohide">序号</th>
                    <th class="autohide">班级</th>
                    <th>学号</th>
                    <th>姓名</th>
                    <th><?php echo $subject->subject_name; ?></th>
                    <th>操作结果</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0 ; foreach ($students as $student) { ?>
                <tr>
                    <td class="center autohide"><?php echo ++$i; ?></td>
                    <td class="center autohide"><?php echo $class->class_name; ?></td>
                    <td class="center"><?php echo $student->student_number; ?></td>
                    <td class="center"><?php echo $student->name; ?></td>
                    <!-- 成绩录入列 --->
                    <td style="width: 80px">
                        <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'add-score-form' . $subject->ID . $student->student_number,
                                'enableClientValidation' => false,
                                'method' => 'post',
                                'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form', 'onsubmit'=>'return false;'), // 阻止在录入成绩过程中，回车提交表单，导致整个页面重新刷新
                            ));
                                // 显示已经登录的成绩信息
                                $key = "$student->ID|$exam->ID|$subject->ID|$class->ID";
                                if(isset($scores[$key])){
                                    $data->score = $scores[$key];
                                } else {
                                    $data->score = null;
                                }

                                echo $form->textField($data,'score', array(
                                    'class'=>'form-control',
                                    'id' => 'text' . $student->student_number . $subject->ID ,
                                    'ajax'=>array(
                                        'type'=>'POST',
                                        'data' => array(
                                            'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                            'class_id'=> $class->ID,
                                            'student_id'=> $student->ID,
                                            'subject_id'=> $subject->ID,
                                            'exam_id'=> $exam->ID,
                                            'student_number'=> $student->student_number,
                                            'score'=> 'js:$(this).val()',
                                        ),
                                        'url' => Yii::app()->createUrl('ajax/insertScore'),
                                        //'update'=>"#$student->code",
                                        'beforeSend'=>"function(xhr, opts){
                                                var data = $('#text$student->student_number$subject->ID');
                                                var show = $('#$student->student_number');
                                                if(data.val().match(/^[0-9]+[.]?[0-9]?$/) && data.val() >= 0 && data.val() <= $subject->total_score) {
                                                    show.text('');
                                                    $.blockUI({ message: null }); 
                                                } else {
                                                    show.removeClass();
                                                    show.addClass('label label-danger');
                                                    show.text('请输入正确的分数。');
                                                    data.focus();
                                                    xhr.abort();// 阻止提交ajax
                                                }
                                            }",
                                        'success'=>"function(data){
                                                $.unblockUI();
                                                data = JSON.parse(data);
                                                var show = $('#$student->student_number');

                                                show.removeClass();
                                                if(data.result) {
                                                    show.addClass('label label-primary');
                                                } else {
                                                    show.addClass('label label-danger');
                                                }
                                                show.text(data.message);
                                            }",
                                    )
                                    )); 
                        $this->endWidget();
                        ?>
                    </td>
                    <td>
                        <span id="<?php echo $student->student_number; ?>"></span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php } ?>