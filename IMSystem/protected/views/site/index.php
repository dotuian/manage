<?php
$this->pageTitle=Yii::app()->name . '首页';
//$this->breadcrumbs = array(
//    $this->pageTitle,
//);
?>

<?php if($this->isStudent()) { ?>
<!-- 学生使用说明 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">学生使用须知</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>功能说明</h4>
                            <ul>
                              <li>成绩查询：查询登录到系统中的相关科目成绩。</li>
                              <li>个人设置＞个人信息：查看和修改个人的基本信息。</li>
                              <li>个人设置＞密码变更：修改登录密码，第一次登录，请务必修改自己的登录密码。</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php } ?>


<?php if($this->isTeacher()) { ?>
<!-- 教师使用说明 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">教师使用须知</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul>
                              <li>如果您有教学安排，请务必在“个人设置”--“个人信息”页面中“担任科目”项目中，勾选自己所担任的科目。然后点击最下方的“变更”按钮。不然不能进行课程安排的设定。</li>
                              <li>如果您在使用的遇到了任何问题，可与屏幕下方的QQ号联系。</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>



<?php if($this->isHeaderTeacher()) { ?>
<!-- 校长使用说明 -->
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">系统功能</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>说明</h3>
                            <ul>
                              <li>学生的成绩信息，是建立在学生信息，教师信息，班级信息，科目信息，课程安排，考试类型(考试名称)等数据的基础之上的。</li>
                              <li>在进行学生成绩录入之前，需要事先组织好学生，教师，班级，科目，课程安排等信息。</li>
                              <li>每个学期和上一次学期，可能存在学生，教师，科目，课程安排等信息的变动。在每学期录入学生成绩数据之前，需要事先调整好学生，教师，科目，课程安排等信息的数据。</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>学生管理</h3>
                            <ul>
                              <li>学生信息检索：检索/修改学生信息</li>
                              <li>学生信息添加：添加一个学生</li>
                              <li>学生信息导入：通过Excel文件批量导入学生信息</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>教师管理</h3>
                            <ul>
                              <li>教师信息检索：检索/修改教师信息</li>
                              <li>教师信息添加：添加一个教师</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h3>班级管理</h3>
                            <ul>
                              <li>班级信息检索：检索/修改班级的信息</li>
                              <li>班级信息添加：添加一个班级（每学期开始之前，都需要做的操作）</li>
                              <li>班级升级：学期开始之初，学生班级信息的批量变更</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h3>科目管理(课程管理)</h3>
                            <ul>
                              <li>科目信息检索：检索/修改科目的信息</li>
                              <li>科目信息添加：添加一个科目</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>课程安排管理(哪个教师担任哪个班级哪项科目的信息)</h3>
                            <ul>
                              <li>课程信息检索：检索/修改课程的信息</li>
                              <li>课程信息添加：添加一个课程</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>成绩管理</h3>
                            <ul>
                              <li>成绩信息检索：检索/修改学生的各科的成绩的信息</li>
                              <li>学生成绩信息录入：每次考试之后，以班，科目为单位对学生成绩信息进行录入</li>
                              <li>班级学生成绩：以班，科目为单位，查看对应的学生成绩信息</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h3>角色管理</h3>
                            <ul>
                              <li>角色信息检索：检索/修改角色(目前根据需要，有学生，教师，教务处，学工科，校长5种角色)</li>
                              <li>角色信息添加：添加一个新的角色</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>个人设置</h3>
                            <ul>
                              <li>个人信息：修改用户个人信息</li>
                              <li>密码变更：用户密码变更</li>
                              <li>退出登录：退出当前用户登录</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>系统设置</h3>
                            <ul>
                              <li>设置系统运行过程中的一些参数</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            ......
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>