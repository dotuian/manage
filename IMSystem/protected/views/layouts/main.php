<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <!-- MoodStrap CSS framework -->
        <!-- Stylesheets -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <!-- Font awesome icon -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" />
        <!-- jQuery UI -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.9.2.custom.min.css" />
        <!-- Calendar -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.css" />
        <!-- prettyPhoto -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/prettyPhoto.css" />
        <!-- Star rating -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rateit.css" />
        <!-- Date picker -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-datetimepicker.min.css" />
        <!-- CLEditor -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.cleditor.css" />
        <!-- Uniform -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/daterangepicker-bs3.css" />
        <!-- Bootstrap toggle -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-switch.css" />
        
        <!-- Main stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/widgets.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dropzone.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.gritter.css" />
        

        <!-- HTML5 Support for IE -->
        <!--[if lt IE 9]>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shim.js"></script>    
        <![endif]-->

        
        <!-- datatables -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/media/DataTables-1.10.2/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/media/DataTables-1.10.2/css/dataTables.bootstrap.css" />
        
        
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script> 
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

<body>
<header>
<div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
  
    <div class="container">
      <!-- Menu button for smallar screens -->
        <div class="navbar-header">
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>个人设置</span></button>
            

            <a href="<?php echo Yii::app()->homeUrl; ?>" class="navbar-brand">
                 <!--<span class="bold">XXXXXXXXXXX</span><i>zzzzzzzzzzzz</i>-->
            </a>
        </div>

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown pull-right user-data">            
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <i class="fa fa-user"></i>
                    <span class="bold"><?php echo Yii::app()->user->getState('name'); ?></span> 
                    <b class="caret"></b>
                </a>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu">
                    <li><a href="<?php echo $this->createUrl('setting/profile');?>"><i class="fa fa-user"></i> 个人信息</a></li>
                    <li><a href="<?php echo $this->createurl('setting/password');?>"><i class="fa fa-cogs"></i> 密码变更</a></li>
                    <li><a href="<?php echo $this->createurl('site/logout');?>"><i class="fa fa-key"></i>退出</a></li>
                </ul>
            </li>
            
        </ul>
      </nav>

    </div>
</div>
</header>
<!-- Main content starts -->

<div class="content">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- 小屏幕时显示的导航栏  -->
        <div class="sidebar-dropdown">
            <a href="#">导航栏</a>
        </div>

        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
            <li>
                <a href="<?php echo Yii::app()->homeUrl; ?>">
                    <i class="fa fa-home"></i> <span>首页</span>
                </a>
            </li>
            
          <?php
                $controller = Yii::app()->controller->id;  // controller
                $action = $this->getAction()->getId(); // action
                $route =$this->getRoute(); // route 
                
                $authoritys = Yii::app()->user->getState('authoritys');
                // 权限分类
                $category = Yii::app()->user->getState('auth_category');
          ?>
          
            <?php if(in_array('STUDENT', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'student' ? 'open' : ''; ?>">
                    <i class="fa fa-user"></i> <span>学生管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'student' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span>
                </a>
                <ul>
                    <?php if(in_array('student/search', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('student/search');?>">学生信息检索</a></li>
                    <?php } ?>
                        
                    <?php if(in_array('student/create', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('student/create');?>">学生信息添加</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('student/import', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('student/import');?>">学生信息导入</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('TEACHER', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'teacher' ? 'open' : ''; ?>">
                <i class="fa fa-sitemap"></i> <span>教师管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'teacher' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('teacher/search', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('teacher/search');?>">教师信息检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('teacher/create', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('teacher/create');?>">教师信息添加</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('CLASS', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'class' ? 'open' : ''; ?>">
                <i class="fa fa-tasks"></i> <span>班级管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'class' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('class/search', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('class/search');?>">班级信息检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('class/create', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('class/create');?>">班级信息添加</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('class/upgrade', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('class/upgrade');?>">班级升级</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('SUBJECT', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'subject' ? 'open' : ''; ?>">
                <i class="fa fa-tasks"></i> <span>科目管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'subject' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('subject/search', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('subject/search');?>">科目信息检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('subject/create', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('subject/create');?>">科目信息添加</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('COURSE', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'course' ? 'open' : ''; ?>">
                <i class="fa fa-table"></i> <span>课程管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'course' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('course/search', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('course/search');?>">课程信息检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('course/create', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('course/create');?>">课程信息添加</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('course/createmore', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('course/createMore');?>">课程信息添加(批量)</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('SCORE', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'score' ? 'open' : ''; ?>">
                <i class="fa fa-bar-chart-o"></i> <span>成绩管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'score' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('score/search', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('score/search');?>">成绩信息检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('score/create', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('score/create');?>">学生成绩录入</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('ROLE', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'role' ? 'open' : ''; ?>">
                <i class="fa fa-users"></i> <span>角色管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'role' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('role/search', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('role/search');?>">角色检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('role/create', $authoritys)) { ?>
                    <li><a href="<?php echo $this->createUrl('role/create');?>">角色添加</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
          
            <?php if(in_array('AUTHORITY', $category)) { ?>
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'authority' ? 'open' : ''; ?>">
                <i class="fa fa-wrench"></i> <span>权限管理</span> <span class="pull-right"><i class="fa <?php echo $controller == 'authority' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <?php if(in_array('authority/search', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('authority/search');?>">权限检索</a></li>
                    <?php } ?>
                    
                    <?php if(in_array('authority/create', $authoritys)) { ?>
                        <li><a href="<?php echo $this->createUrl('authority/create');?>">权限添加</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
          
            <!-- 学生成绩查询 -->
            <?php if(in_array('authority/create', $authoritys)) { ?>
                <li><a href="<?php echo $this->createUrl('score/query');?>"><i class="fa fa-book"></i> <span>成绩查询</span></a></li> 
            <?php } ?>
          
            <!-- 个人设置 -->
            <li class="has_sub">
                <a href="#" class="<?php echo $controller == 'setting' ? 'open' : ''; ?>">
                <i class="fa fa-cogs"></i> <span>个人设置</span> <span class="pull-right"><i class="fa <?php echo $controller == 'setting' ? 'fa-chevron-down' : 'fa-chevron-left'; ?>"></i></span></a>
                <ul>
                    <li><a href="<?php echo $this->createUrl('setting/profile');?>">个人信息</a></li>
                    <li><a href="<?php echo $this->createUrl('setting/password');?>">密码变更</a></li>
                    <li><a href="<?php echo $this->createUrl('site/logout');?>">退出登录</a></li>
                </ul>
            </li>
            
            
            <li><a href="<?php echo $this->createUrl('system/setting');?>"><i class="fa fa-book"></i> <span>系统配置</span></a></li> 
            
        </ul>
    </div>
    <!-- Sidebar ends -->

    <!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
                <h2 class="pull-left"><?php echo substr($this->pageTitle, 46); ?></h2>
                <div class="clearfix"></div>

                <!-- Breadcrumb -->
                <div class="bread-crumb">
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'homeLink' => CHtml::link('<i class="fa fa-home"></i> 首页</a>', Yii::app()->homeUrl),
                    )); ?>
                </div>

                <div class="clearfix"></div>
	    </div>
	    <!-- Page heading ends -->

	    <!-- Matter start -->
            <div class="matter">
                <div class="container">
                    <!-- 提示消息显示区域 -->
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="alert alert-success alert-info">
                            <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::app()->user->hasFlash('warning')) { ?>
                        <div class="alert alert-warning">
                            <?php echo Yii::app()->user->getFlash('warning'); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::app()->user->hasFlash('danger')) { ?>
                        <div class="alert alert-danger">
                            <?php echo Yii::app()->user->getFlash('danger'); ?>
                        </div>
                    <?php } ?>


                    <?php echo $content; ?>
                </div>
            </div>
            <!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Copyright info -->
                <p class="copy">
                    Copyright &copy; 2014 -- <?php echo date('Y')?> | 
                    <a href="http://xgzhgz.com">孝感市综合高级中学</a> 
                </p>
            </div>
        </div>
    </div>
</footer> 	

<!-- Footer ends -->

<!-- Scroll to top -->
<!--
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
-->


<!-- JS -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script> <!-- Bootstrap -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.9.2.custom.min.js"></script> <!-- jQuery UI -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.rateit.min.js"></script> <!-- RateIt - Star rating -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.prettyPhoto.js"></script> <!-- prettyPhoto -->

<!-- jQuery Flot -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.js"></script>
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.resize.js"></script>-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.pie.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.flot.stack.js"></script>

<!-- jQuery Notification - Noty -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.noty.js"></script> <!-- jQuery Notify -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/default.js"></script> <!-- jQuery Notify -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bottom.js"></script> <!-- jQuery Notify -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/topRight.js"></script> <!-- jQuery Notify -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/top.js"></script> <!-- jQuery Notify -->
<!-- jQuery Notification ends -->

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine-en.js"></script> <!-- jQuery Validation Engine Language File -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine.js"></script> <!-- jQuery Validation Engine -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sparklines.js"></script> <!-- Sparklines -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cleditor.min.js"></script> <!-- CLEditor -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slimscroll.min.js"></script>  
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.min.js"></script>  
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.icheck.min.js"></script>
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dropzone.js"></script>  jQuery Dropzone -->
<!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filter.js"></script>  Filter for support page -->





<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.zh-CN.js"></script> <!-- Date picker -->


<!-- blockUI -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.blockUI.js"></script>
<!-- dataTables -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/media/DataTables-1.10.2/js/jquery.dataTables.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/media/DataTables-1.10.2/js/dataTables.bootstrap.js"></script>



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/daterangepicker.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>


</body>


</html>
