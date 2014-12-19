<?php
$this->pageTitle = Yii::app()->name . '教师信息检索';
$this->breadcrumbs = array(
    '教师信息检索',
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
                    <th>姓名</th>
                    <th>性别</th>
                    <th>身份证号码</th>
                    <th>担任科目</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>'姓名')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'sex', TeacherForm::getSexOption(true), array('class'=>'form-control')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'id_card_no', array('class'=>'form-control', 'placeholder'=>'身份证号码')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'subject_id', MSubjects::model()->getAllSubjectsOption(true), array('class'=>'form-control')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'status', TeacherForm::getTeacherStatusOption(true), array('class'=>'form-control')); ?>
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
                <tr>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>出生年月日</th>
                    <th>任教科目</th>
                    <th class="autohide">身份证号码</th>
                    <th class="autohide">地址</th>
                    <th class="autohide">电话号码</th>
                    <th>状态</th>
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
                    <td colspan="8">
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


