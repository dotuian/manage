<?php
$this->pageTitle = '教师信息检索';
$this->breadcrumbs = array(
    $this->pageTitle,
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
                    <th>教工号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>地址</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->textField($model,'code', array('class'=>'form-control', 'placeholder'=>'教工号')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>'姓名')); ?>
                    </td>
                    <td>
                        <?php echo $form->dropDownList($model,'sex', StudentForm::getSexOption(true), array('class'=>'form-control')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'address', array('class'=>'form-control', 'placeholder'=>'地址')); ?>
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


<?php if($dataProvider->totalItemCount > 0 ) { ?>
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
                    <th>教工号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>状态</th>
                    <th>地址</th>
                    <th>电话号码</th>
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


