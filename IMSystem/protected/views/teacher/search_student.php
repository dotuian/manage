<?php
$this->pageTitle = '学生信息检索';
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
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
        </div>  
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>Norway</td>
                    <td>23/12/2012</td>
                    <td>Paid</td>
                    <td><span class="label label-success">Active</span></td>
                    <td>
                        <button class="btn btn-xs btn-success"><i class="fa fa-check"></i> </button>
                        <button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i> </button>
                        <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i> </button>
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

    </div>
</div>




<!-- 检索结果 -->
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">检索结果</div>
        <div class="widget-icons pull-right">
            <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
        </div>  
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>身份证号码</th>
                    <th>出生日期</th>
                    <th>所在班级</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $listview = $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $dataProvider,
                        'itemView' => '_search_student__view',
                        'summaryText' => '{start}条 - {end}条 / 共{count}条',
                        'template' => "{items}",
                        'pager' => array(
                            'header' => '',
                            //'firstPageLabel' => '&lt;&lt; 第一页',
                            'prevPageLabel' => '&laquo; 前一页',
                            'nextPageLabel' => '下一页 &raquo;',
                            //'lastPageLabel' => '最后一页 &gt;&gt;',
                            'htmlOptions' => array('class'=>'pagination pull-right')
                        ),
                    ));
                ?>
                
                <tr>
                    <td colspan="7">
                        <?php $listview->renderSummary(); ?>
                    </td>
                </td>
                
                
            </tbody>
        </table>
        
        <div class="widget-foot">
            <?php $listview->renderPager(); ?>
            <div class="clearfix"></div> 
        </div>

    </div>

</div>



