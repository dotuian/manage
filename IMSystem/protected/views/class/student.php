<?php
$this->pageTitle = Yii::app()->name . '班级学生信息一览表';
$this->breadcrumbs = array(
    '班级信息检索' => $this->createUrl('search'),
    "{$class->entry_year}年{$class->class_name} 学生信息一览表",
);

Yii::app()->clientScript->registerScript('js', "
$(document).ready(function(){
//    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
});
", CClientScript::POS_HEAD);
?>


<?php if(isset($students) && count($students) > 0) { ?>
<div class="widget">

    <div class="widget-head">
        <div class="pull-left"><?php echo "{$class->entry_year}年{$class->class_name} 学生信息一览表"; ?> </div>
        <div class="widget-icons pull-right">
          </div> 
        <div class="clearfix"></div>
    </div>

    <div class="widget-content">
        <table class="table table-striped table-bordered table-hover" id="result">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>学号</th>
                    <th>学生姓名</th>
                    <th>性别</th>
                    <th>出生年月</th>
                    <th>家长电话</th>
                    <th>家庭住址</th>
                    <!--<th>详细</th>-->
                </tr>
            </thead>

            <tbody>
                <?php $index=1 ; foreach ($students as $student) { ?>
                <tr>
                    <td class="center"><?php echo $index++; ?></td>
                    <td class="center"><?php echo $student->student_number; ?></td>
                    <td class="center">
                        <?php if(in_array('student/update', $this->authoritys)) { ?>
                            <a href="<?php echo $this->createUrl('student/update',  array('ID' => $student->ID)) ?>"><?php echo $student->name; ?></a>
                        <?php } else { ?>
                            <?php echo $student->name; ?>
                        <?php } ?>
                    </td>
                    <td class="center"><?php if($student->sex == 'M') echo '男' ; if($student->sex == 'F') echo '女'; ?></td>
                    <td class="center"><?php echo $student->birthday; ?></td>
                    <td class="center"><?php echo $student->parents_tel; ?></td>
                    <td><?php echo $student->address; ?></td>
                    <!--<td></td>-->
                </tr>
                <?php } ?>
                <div class="clearfix"></div>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>


