<?php
$this->pageTitle = Yii::app()->name . '我的班级';
$this->breadcrumbs = array(
    '我的班级',
);

Yii::app()->clientScript->registerScript('js', "
//$(document).ready(function(){
//    $('#result').dataTable({'bPaginate': false, 'bFilter':false, 'bInfo':false, 'aaSorting': [],});
//});
", CClientScript::POS_HEAD);
?>

<!-- 检索条件 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生信息</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'myclass-form',
                        'method' => 'get',
                        'action' => $this->createUrl('index'),
                        'enableClientValidation'=>false,
                        'htmlOptions' => array('class' => 'form-horizontal', 'role'=>'form'),
                    ));
                ?>
                <div class="padd">
                    <h6>
                        班主任，任课教师查看自己班级的学生信息。<br/>
                    </h6>
                    <hr/>
                        <div class="form-group" id="class">
                            <label class="col-lg-2 control-label">班级</label>
                            <div class="col-lg-10 inline-block">
                                <?php echo $form->dropDownList($model,'class_id', $classes, array('class'=>'form-control required')); ?>
                                <?php echo $form->error($model,'class_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="widget-foot">
                        <div class="pull-left">

                        </div>
                        
                        <div class="pull-right">
                            <?php echo CHtml::submitButton('查看学生信息', array('class'=>'btn btn-search')); ?>
                        </div>
                        <div class="clearfix"></div> 
                    </div>
                    
                <?php $this->endWidget(); ?>
                    
            </div>
        </div>
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
                    <th rowspan="2">No.</th>
                    <th rowspan="2">学号</th>
                    <th rowspan="2">姓名</th>
                    <th rowspan="2">性别</th>
                    <th rowspan="2">出生年月日</th>
                    <th rowspan="2">住宿</th>
                    <th colspan="6">缴费情况(学期)</th>
                </tr>
                <tr>
                    <th>一</th>
                    <th>二</th>
                    <th>三</th>
                    <th>四</th>
                    <th>五</th>
                    <th>六</th>
                </tr>
            </thead>

            <tbody>
                <?php $index=1 ; foreach ($data as $value) { ?>
                <tr>
                    <td class="center"><?php echo $index++; ?></td>
                    <td class="center"><?php echo $value['student_number']; ?></td>
                    <td class="center">
                        <?php if(!$flag) { ?>
                            <!-- 班主任可以修改学生信息 -->
                            <a href="<?php echo $this->createUrl('myclass/student', array('ID'=> $value['ID']))?>">
                                <?php echo $value['name']; ?>
                            </a>
                        <?php } else { ?>
                            <?php echo $value['name']; ?>
                        <?php } ?>
                    </td>
                    
                    <td class="center"><?php echo TStudents::model()->getSexName($value['sex']); ?></td>
                    <td class="center"><?php echo $value['birthday']; ?></td>
                    <td class="center"><?php echo $value['accommodation']; ?></td>
                    
                    <td class="center">
                         <span class="label <?php echo $value['payment1'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment1']); ?></span>
                    </td>
                    <td class="center">
                         <span class="label <?php echo $value['payment2'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment2']); ?></span>
                    </td>
                    <td class="center">
                         <span class="label <?php echo $value['payment3'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment3']); ?></span>
                    </td>
                    <td class="center">
                         <span class="label <?php echo $value['payment4'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment4']); ?></span>
                    </td>
                    <td class="center">
                         <span class="label <?php echo $value['payment5'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment5']); ?></span>
                    </td>
                    <td class="center">
                         <span class="label <?php echo $value['payment6'] == 0 ? 'label-danger' : 'label-primary'?>"><?php echo TStudents::model()->getPaymentName($value['payment6']); ?></span>
                    </td>
                </tr>
                <?php }?>
                <div class="clearfix"></div> 
            </tbody>
        </table>

    </div>
</div>
<?php } ?>


