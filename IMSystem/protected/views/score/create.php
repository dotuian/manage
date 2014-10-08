<?php
$this->pageTitle= '成绩信息添加';
$this->breadcrumbs = array(
    $this->pageTitle,
);



Yii::app()->clientScript->registerScript('search', "
$(document).ready(function(){
    
//    $('input[name=\'TScores[score]]\').blur(function(){
//        alert();
//    });
    
//    function beforeSend(data){
//        if(!data.val().match(/^[0-9]+[.]?[0-9]+$/)){
//            alert('输入正确的数字!');
//            data.focus();
//        }        
//    }

});

",CClientScript::POS_HEAD);

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
                <div class="pull-left"><?php echo $this->pageTitle;?></div>
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
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
                            </div>
                        </div>

                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllClassOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>

                        <div class="form-group" id="subject">
                            <label class="col-lg-2 control-label">科目</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'subject_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-primary ')); ?>
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
        <div class="pull-left">检索结果</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>班级</th>
                    <th>学号</th>
                    <th>姓名</th>
                    <?php foreach ($subjects as $subject) {?>
                        <th><?php echo $subject->subject_name; ?></th>
                    <?php } ?>
                    <th>操作结果</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=0 ; foreach ($students as $student) { ?>
                <tr>
                    <td class="center"><?php echo ++$i; ?></td>
                    <td class="center"><?php echo $class->class_name; ?></td>
                    <td class="center"><?php echo $student->code; ?></td>
                    <td class="center"><?php echo $student->name; ?></td>
                    <?php foreach ($subjects as $subject) {?>
                    <td style="width: 80px">
                        <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'add-score-form' . $subject->ID . $student->code,
                                'enableClientValidation' => false,
                                'method' => 'post',
                                'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
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
                                    'id' => 'text' . $student->code . $subject->ID ,
                                    'ajax'=>array(
                                        'type'=>'POST',
                                        'data' => array(
                                            'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                            'class_id'=> $class->ID,
                                            'student_id'=> $student->ID,
                                            'subject_id'=> $subject->ID,
                                            'exam_id'=> $exam->ID,
                                            'score'=> 'js:$(this).val()',
                                        ),
                                        'url' => Yii::app()->createUrl('score/insert'),
                                        //'update'=>"#$student->code",
                                        'beforeSend'=>"function(xhr, opts){
                                                var data = $('#text$student->code$subject->ID');
                                                var show = $('#$student->code');
                                                if(data.val().match(/^[0-9]+[.]?[0-9]+$/) && data.val() >= 0 && data.val() <=150) {
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
                                                var show = $('#$student->code');

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
                        <span id="<?php echo $student->code?>"></span>
                    </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php } ?>