<?php
$this->pageTitle= '成绩信息添加';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<script>
$(document).ready(function(){
    $("input[name='TScores[score]']").blur(function(){
        console.log('input score : ' + $(this).val());
    });
    
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
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassOption(true), array('class'=>'form-control')); ?>
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
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
        </div>  
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
                                    echo $form->textField($data,'score', array(
                                        'class'=>'form-control',
                                        'id' => 'form' . $student->code . $subject->ID ,
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
                                            //'update'=>'#objtype',
                                            //'beforeSend'=>'function(){}',
                                            'success'=>"function(data){
                                                    console.log(data);
                                                    $('#$student->code$subject->ID').text(data);
                                                }",
                                        )
                                        )); 
                            $this->endWidget(); 
                        ?>
                        </td>
                        <td>
                            <div id="<?php echo $student->code . $subject->ID ;?>"></div>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        
    </div>
</div>
<?php } ?>