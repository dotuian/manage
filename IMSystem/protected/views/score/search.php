<?php
$this->pageTitle = Yii::app()->name . '成绩信息检索';
$this->breadcrumbs = array(
    '成绩信息检索',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    
});
", CClientScript::POS_HEAD);
?>


<!-- 检索条件 -->
<div class="widget">
    <div class="widget-head">
        <div class="pull-left">检索条件</div>
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'search-form',
                'method' => 'get',
                'enableClientValidation' => false,
                'htmlOptions' => array('class' => 'form-signin'),
            ));
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>班级年份</th>
                    <th>班级代号</th>
                    <th>考试名称</th>
                    <th>科目</th>
                    <th>学号</th>
                    <th>学生姓名</th>
                    <th>成绩</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->textField($model,'entry_year', array('class'=>'form-control', 'placeholder'=>'班级年份')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'class_code', array('class'=>'form-control', 'placeholder'=>'班级代号')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(false), array('class'=>'form-control')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(true), array('class'=>'form-control')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'student_number', array('class'=>'form-control', 'placeholder'=>'学号')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'student_name', array('class'=>'form-control', 'placeholder'=>'姓名')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'score', array('class'=>'form-control', 'placeholder'=>'成绩')); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="widget-foot">
            <div class="pull-right">
                <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-search')); ?>
            </div>
            <div class="clearfix"></div> 
        </div>
        <?php $this->endWidget(); ?>
        
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
                <!--
                <tr>
                    <th colspan="3">班级</th>
                    <th rowspan="2">考试名称</th>
                    <th rowspan="2">科目</th>
                    <th rowspan="2">学号</th>
                    <th rowspan="2">姓名</th>
                    <th rowspan="2">成绩</th>
                    <th rowspan="2">操作</th>
                </tr>
                <tr>
                    <th>年份</th>
                    <th>名称</th>
                    <th>类型</th>
                </tr>
                -->
                <tr>
                    <th>班级年份</th>
                    <th>班级代号</th>
                    <th>班级名称</th>
                    <th>班级类型</th>
                    <th>考试名称</th>
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


