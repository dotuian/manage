<?php
$this->pageTitle = Yii::app()->name . '班级学生信息一览表';
$this->breadcrumbs = array(
    '班级信息检索' => $this->createUrl('search'),
    "学生信息一览",
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
                    <th>姓名</th>
                    <th>状态</th>
                    <th>性别</th>
                    <th>出生年月</th>
                    <th class="autohide">家长电话</th>
                    <th class="autohide">家庭住址</th>
                </tr>
            </thead>

            <tbody>
                <?php $index=1 ; foreach ($students as $student) { ?>
                <tr>
                    <td class="center"><?php echo $index++; ?></td>
                    <td class="center"><?php echo $student->student_number; ?></td>
                    <td class="center" nowrap>
                        <?php if(in_array('student/update', $this->authoritys)) { ?>
                            <a href="<?php echo $this->createUrl('student/update',  array('ID' => $student->ID)) ?>"><?php echo $student->name; ?></a>
                        <?php } else { ?>
                            <?php echo $student->name; ?>
                        <?php } ?>
                    </td>
                    <td class="center">
                        <span class="label <?php echo $student->status === '1' ? 'label-active' : 'label-stop';?>"><?php echo $student->status === '1' ? '在校' : '离校'; ?></span>
                    </td>
                    <td class="center"><?php if($student->sex == 'M') echo '男' ; if($student->sex == 'F') echo '女'; ?></td>
                    <td class="center"><?php echo $student->birthday; ?></td>
                    <td class="center autohide"><?php echo $student->parents_tel; ?></td>
                    <td class="autohide"><?php echo $student->address; ?></td>
                </tr>
                <?php } ?>
                <div class="clearfix"></div>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>


