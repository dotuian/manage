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


<?php if(!$this->isStudent()) { ?>
<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-head">
                <div class="pull-left">系统功能说明</div>
                <div class="clearfix"></div>
            </div>

            <div class="widget-content">
                <div class="padd">
                    
                    <?php if(in_array('MYCLASS', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>我的班级</h4>
                            <ul>
                              <li>学生信息：查看自己班级学生的基本信息。</li>
                              <li>学生成绩：查看自己班级学生的成绩信息。</li>
                              <li>学生导入：班主任可以批量导入学生信息。</li>
                              <li>课程安排：查看班级当前的课程安排信息。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(in_array('STUDENT', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>学生管理</h4>
                            <ul>
                              <li>学生信息检索：检索/修改学生信息。</li>
                              <li>学生信息添加：添加一个学生。</li>
                              <li>学生信息导入：通过Excel文件批量导入学生信息。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('TEACHER', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>教师管理</h4>
                            <ul>
                              <li>教师信息检索：检索/修改教师信息。</li>
                              <li>教师信息添加：添加一个教师。</li>
                              <li>教师信息导出：将全校教师的信息导出到Excel文件中。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('CLASS', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>班级管理</h4>
                            <ul>
                              <li>班级信息检索：检索/修改班级的信息。</li>
                              <li>班级信息添加：添加一个班级（每学期开始之前，都需要做的操作）。</li>
                              <li>班级批量暂停：新的学期开始之后，添加新的班级之前需要对旧的班级进行修改。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('SUBJECT', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>科目管理</h4>
                            <ul>
                              <li>科目信息检索：检索/修改科目的信息。</li>
                              <li>科目信息添加：添加一个科目。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('COURSE', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>课程管理</h4>
                            <ul>
                              <li>课程信息检索：检索/修改课程的信息。</li>
                              <li>课程信息添加：添加一个课程。</li>
                              <li>课程信息安排：查看当前班级的课程安排。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('SCORE', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>成绩管理</h4>
                            <ul>
                              <li>成绩信息检索：检索/修改学生的各科的成绩的信息。</li>
                              <li>学生成绩信息录入：每次考试之后，以班，科目为单位对学生成绩信息进行录入。</li>
                              <li>学生成绩信息导入：通过Excel模板，批量导入学生成绩信息。</li>
                              <li>班级学生成绩：以班，科目为单位，查看对应的学生成绩信息。</li>
                              <li>成绩统计分析：分析某一次考试学生的及格率等信息。</li>
                              <li>学生成绩总表：下载学生多次的成绩信息。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('ROLE', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>角色管理</h4>
                            <ul>
                              <li>角色信息检索：检索/修改角色(目前根据需要，有学生，教师，教务处，学工科，校长5种角色)。</li>
                              <li>角色信息添加：添加一个新的角色。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(in_array('AUTHORITY', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>权限管理</h4>
                            <ul>
                              <li>权限检索：检索/修改权限信息。</li>
                              <li>权限添加：添加一个新的权限。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(in_array('SYSTEM', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>系统设置</h4>
                            <ul>
                              <li>设置系统运行过程中的一些参数。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    
                    <?php if(in_array('OTHER', $this->category)) { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>个人设置</h4>
                            <ul>
                              <li>个人信息：修改用户个人信息。</li>
                              <li>密码变更：用户密码变更。</li>
                              <li>退出登录：退出当前用户登录。</li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php } ?>
