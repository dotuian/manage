<?php
$this->pageTitle = Yii::app()->name . '班级成绩信息';
$this->breadcrumbs = array(
    '班级成绩信息',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    
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
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        班主任，任课教师可以在该页面查看学生的成绩信息。<br/>
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
                                <?php echo $form->dropDownList($model,'class_id', TClasses::model()->getClassInfoByUserRole($this->getLoginUserId()), array('class'=>'form-control')); ?>
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
                            <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-search')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
    </div>  
</div>



<?php if(!is_null($dataProvider) && $dataProvider->totalItemCount > 0 ) { ?>
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
                    <th>考试名称</th>
                    <th>班级</th>
                    <th>科目</th>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>成绩</th>
                    <th>操作</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $listview = $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $dataProvider,
                        'itemView' => '_view',
                        'summaryText' => '{start}条 - {end}条 / 共{count}条',
                        'template' => "{items}",
                        'pager' => array(
                            'header' => '',
                            'htmlOptions' => array('class'=>'pagination pull-right')
                        ),
                    ));

                ?>
                <div class="clearfix"></div> 
                <tr>
                    <td colspan="7">
                        <center><?php $listview->renderSummary(); ?></center>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <?php if ($dataProvider->getPagination()->pageCount > 1) { ?>
        <div class="widget-foot">
            <?php $listview->renderPager(); ?>
            <div class="clearfix"></div> 
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>

