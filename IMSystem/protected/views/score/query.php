<?php
$this->pageTitle = Yii::app()->name . '成绩查询';
$this->breadcrumbs = array(
    '成绩查询',
);

Yii::app()->clientScript->registerScript('js', "
//$(document).ready(function(){
//$('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
//});

//$(window).resize(function() {
//  // console.log('width = ' + document.body.scrollWidth + '  height= ' + document.body.scrollHeight);
//    if(document.body.scrollWidth >= 768){
//        $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
//    }
//});
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
                        <?php echo $form->dropDownList($model,'exam_id', MExams::model()->getStudentExamsOption($this->getLoginUserId(), true), array('class'=>'form-control')); ?>
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
                    <th>总分</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $key => $value) { $count=0; ?>
                    <tr>
                        <td class="center"><?php echo $key;?></td>
                        <?php 
                            $sum = 0 ;
                            foreach ($subjects as $subject) {
                                if(isset($value[$subject->subject_name])) {
                                    $s = $value[$subject->subject_name];
                                    $sum += $s;
                                    // 没有及格
                                    $css = $s < $subject->pass_score ? 'nopass' : '';
                                    echo "<td class='center {$css}'>{$s}</td>";
                                } else {
                                    echo "<td class='center'>-</td>";
                                }
                            }
                        ?>
                        <td class="center"><?php echo $sum; ?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
</div>
<?php } ?>


