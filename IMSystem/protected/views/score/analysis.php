<?php
$this->pageTitle = Yii::app()->name . '成绩统计分析';
$this->breadcrumbs = array(
    '成绩统计分析',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
//    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
});
", CClientScript::POS_HEAD);
?>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">成绩统计分析</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'class-score-form',
                        'method' => 'get',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        对一次考试，以班级，课程为单位，对学生成绩数据进行汇总。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">年级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'grade', ClassForm::getGradeOption(true), array(
                                        'class'=>'form-control required',
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'data' => array(
                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                'grade'=> 'js:$(this).val()',
                                                'allowempty' => 'true'
                                            ),
                                            'url' => Yii::app()->createUrl('ajax/getClassOptionByGrade'),
                                            'beforeSend'=>"function(){
                                                    $.blockUI({ message: null });
                                                }",
                                            'success'=>"function(data){
                                                    $.unblockUI();
                                                    $('#class_id').html(data);
                                                }",
                                        )
                                        )); ?>
                                
                                <?php echo $form->error($model,'grade'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('id'=>'exam_id', 'class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassOptionByUserRole($this->getLoginUserId()), array('id'=>'class_id', 'class'=>'form-control')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">科目</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(true), array('class'=>'form-control')); ?>
                                <?php echo $form->error($model,'subject_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="widget-foot">
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('统计', array('class'=>'btn btn-search')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>



<?php if(isset($data) && count($data)> 0 && isset($subjects) && count($subjects) > 0) { ?>
<!-- 统计结果 -->
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">统计结果</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th rowspan="2">考试名称</th>
                    <th rowspan="2">班级</th>
                    <?php foreach ($subjects as $subject) { ?>
                        <th colspan="3"><?php echo $subject; ?></th>
                    <?php } ?>
                </tr>
                <tr>
                    <?php foreach ($subjects as $subject) { ?>
                        <th>及格人数</th>
                        <th>考试人数</th>
                        <th>及格比率</th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php 
                    foreach ($data as $key => $value) {
                        list($exam_name, $class_name) = explode('|', $key);
                ?>
                <tr>
                    <td class="center"><?php echo $exam_name; ?></td>
                    <td class="center"><?php echo $class_name; ?></td>
                    <?php foreach ($subjects as $subject) { ?>
                        <td class="center"><?php echo $value[$subject]['及格人数']; ?></td>
                        <td class="center"><?php echo $value[$subject]['考试人数']; ?></td>
                        <td class="center">
                            <?php 
                                $percentage = $value[$subject]['考试人数'] > 0 ? $value[$subject]['及格人数'] / $value[$subject]['考试人数'] : 0;
                                echo Yii::app()->numberFormatter->formatPercentage($percentage);
                            ?>
                        </td>
                    <?php } ?>
                </tr>
                <?php } ?>

                <div class="clearfix"></div> 
            </tbody>
        </table>

    </div>
</div>
<?php } ?>


