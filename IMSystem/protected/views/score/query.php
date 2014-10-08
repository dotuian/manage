<?php
$this->pageTitle = '成绩查询';
$this->breadcrumbs = array(
    $this->pageTitle,
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false});
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
                    <th>考试名称</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getAllExamsOption(true), array('class'=>'form-control')); ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="widget-foot">
            <div class="pull-right">
                <?php echo CHtml::submitButton('检索', array('class'=>'btn btn-primary ')); ?>
            </div>
            <div class="clearfix"></div> 
        </div>
        <?php $this->endWidget(); ?>
        
    </div>
</div>


<?php if(isset($data) && count($data) > 0) { ?>
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
                    <?php foreach ($subjects as $subject) { ?>
                    <th><?php echo $subject->subject_name;?></td>
                    <?php }?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $value) { ?>
                    <tr>
                        <td class="center"><?php echo $value['exam_name'];?></td>
                        <?php foreach ($subjects as $subject) { ?>
                        <td class="center"><?php echo empty($value[$subject->subject_name]) ? '--' : $value[$subject->subject_name]; ?></td>
                        <?php }?>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
</div>
<?php } ?>


