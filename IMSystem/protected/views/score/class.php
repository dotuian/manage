<?php
$this->pageTitle = Yii::app()->name . '班级成绩信息';
$this->breadcrumbs = array(
    '班级成绩信息',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
});
", CClientScript::POS_HEAD);
?>


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
                        'method' => 'get',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        以班级单位，查看当前在校学生的成绩信息。<br/>
                    </h6>
                    <hr/>
                        <?php

                        ?>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassOptionByUserRole($this->getLoginUserId()), array(
                                        'class'=>'form-control',
                                        'ajax'=>array(
                                            'type'=>'POST',
                                            'data' => array(
                                                'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken,
                                                'class_id'=> 'js:$(this).val()',
                                                'allowempty' => 'true'
                                            ),
                                            'url' => Yii::app()->createUrl('ajax/getExamOption'),
                                            'beforeSend'=>"function(){
                                                    $.blockUI({ message: null });
                                                }",
                                            'success'=>"function(data){
                                                    $.unblockUI();
                                                    $('#exam_id').html(data);
                                                }",
                                        )
                                        )); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">考试名称</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getExamOptionByClassId($model->class_id, true), array('id'=>'exam_id', 'class'=>'form-control')); ?>
                                <?php echo $form->error($model,'exam_id'); ?>
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



<?php if(isset($data) &&  count($data)> 0 ) { ?>
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
                    <?php foreach ($subjects as $subject) {?>
                    <th><?php echo $subject->subject_name; ?></th>
                    <?php }?>
                    <?php if(count($subjects) > 1) { ?>
                    <th>合计</th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $key => $value) { list($code, $name) = explode('|', $key); ?>
                <tr>
                    <!-- 学号 -->
                    <td class="center"><?php echo $code; ?></td>
                    <!-- 姓名 -->
                    <td class="center"><?php echo $name; ?></td>
                    
                    <?php 
                        foreach ($value as $score) {
                            // 按照考试名称循环
                            $sum = 0 ; 
                            foreach ($subjects as $subject) {
                                //按照科目名称循环 
                                if(isset($score[$subject->subject_name])) {
                                    $s = $score[$subject->subject_name];
                                    $sum += $s;
                                    
                                    // 没有及格
                                    $css = $s < $subject->pass_score ? 'nopass' : '';
                                    
                                    echo "<td class='center {$css}'>{$s}</td>";
                                    
                                } else {
                                    echo "<td class='center'>-</td>";
                                }
                            }
                            
                            // 总分
                            if(count($subjects) > 1) {
                                echo "<td class='center'><b>{$sum}</td><b>";
                            }
                        } 
                    ?>
                </tr>
                <?php } ?>

                <div class="clearfix"></div> 
            </tbody>
        </table>

    </div>
</div>
<?php } ?>


