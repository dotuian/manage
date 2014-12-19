<?php
$this->pageTitle = Yii::app()->name . '班级课程安排';
$this->breadcrumbs = array(
    '班级课程安排',
);

Yii::app()->clientScript->registerScript('js', "

", CClientScript::POS_HEAD);
?>


<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">班级课程安排</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'course-teacher-form',
                        'method' => 'post',
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        查看班级当年的教学，教师安排。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getAllUsingClassOption(), array('class'=>'form-control required')) ?>
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



<?php if(!is_null($data) &&  count($data)> 0 ) { ?>
<!-- 检索结果 -->
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">班级课程安排</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th>年度</th>
                    <th>学期</th>
                    <th>班级名称</th>
                    <th>科目</th>
                    <th>教师</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $value) { ?>
                <tr>
                    <td class="center"><?php echo $value['entry_year']; ?></td>
                    <td class="center"><?php echo TClasses::model()->getTermTypeName($value['term_type']); ?></td>
                    <td class="center"><?php echo $value['class_name']; ?></td>
                    <td class="center"><?php echo $value['subject_name']; ?></td>
                    <td class="center"><?php echo $value['name']; ?></td>
                </tr>
                <?php } ?>
                <div class="clearfix"></div> 
            </tbody>
        </table>

    </div>
</div>
<?php } ?>


