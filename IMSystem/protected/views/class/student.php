<?php
$this->pageTitle = Yii::app()->name . '班级学生信息一览表';
$this->breadcrumbs = array(
    '班级信息检索' => $this->createUrl('search'),
    '班级学生信息一览表',
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
});
", CClientScript::POS_HEAD);
?>


<?php if(isset($students)) { ?>
<div class="widget">

    <div class="widget-head">
        <div class="pull-left">班级学生信息一览表</div>
        <div class="widget-icons pull-right">
          </div> 
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th>学号</th>
                    <th>学生姓名</th>
                    <th>性别</th>
                    <th>出生年月</th>
                    <th>详细</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($students as $student) {?>
                <tr>
                    <td class="center"><?php echo $student->code; ?></td>
                    <td class="center"><?php echo $student->name; ?></td>
                    <td class="center"><?php echo $student->sex === 'M' ? '男' : '女' ; ?></td>
                    <td class="center"><?php echo $student->birthday; ?></td>
                    <td></td>
                </tr>
                <?php } ?>
                <div class="clearfix"></div> 
            </tbody>
        </table>
    </div>
</div>
<?php } ?>


