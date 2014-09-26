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
            <button class="navbar-toggle btn-navbar" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse"><span>Menu</span></button>
            <a href="#" class="pull-left menubutton hidden-xs"><i class="fa fa-bars"></i></a>
            <!-- Site name for smallar screens -->
            <a href="<?php echo Yii::app()->homeUrl; ?>" class="navbar-brand">IM<span class="bold">System</span></a>
        </div>

      <!-- Navigation starts -->
      <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">         
        
        <!-- Links -->
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown pull-right user-data">            
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user.png"> 
                    <span class="bold"><?php echo Yii::app()->user->getState('name'); ?></span> 
                    <b class="caret"></b>
                </a>

                <!-- Dropdown menu -->
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
                    <li><a href="<?php echo $this->createurl('site/logout');?>"><i class="fa fa-key"></i>退出</a></li>
                </ul>
            </li>
            
            
          <!-- Upload to server link. Class "dropdown-big" creates big dropdown -->
          <li class="dropdown dropdown-big leftonmobile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cloud-upload"></i></a>
            <!-- Dropdown -->
            <ul class="dropdown-menu">
              <li>
                <!-- Progress bar -->
                <p>Photo Upload in Progress</p>
                <!-- Bootstrap progress bar -->
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-info"  role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40% Complete</span>
                    </div>
                </div>

                <hr />

                <!-- Progress bar -->
                <p>Video Upload in Progress</p>
                <!-- Bootstrap progress bar -->
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete</span>
                    </div>
                </div> 

                <hr />             

                <!-- Dropdown menu footer -->
                <div class="drop-foot">
                  <a href="#">View All</a>
                </div>

              </li>
            </ul>
          </li>

          <!-- Sync to server link -->
          <li class="dropdown dropdown-big leftonmobile">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-refresh"></i></a>
            <!-- Dropdown -->
            <ul class="dropdown-menu">
              <li>
                <!-- Using "fa fa-spin" class to rotate icon. -->
                <p><span class="label label-info"><i class="fa fa-cloud"></i></span> Syncing Photos to Server</p>
                <hr />
                <p><span class="label label-warning"><i class="fa fa-cloud"></i></span> Syncing Bookmarks Lists to Cloud</p>

                <hr />

                <!-- Dropdown menu footer -->
                <div class="drop-foot">
                  <a href="#">View All</a>
                </div>

              </li>
            </ul>
          </li>
          <li class="dropdown dropdown-big leftonmobile">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-comments"></i><span class="label label-info">6</span> 
              </a>

                <ul class="dropdown-menu">
                  <li class="dropdown-header padless">
                    <!-- Heading - h5 -->
                    <h5><i class="fa fa-comments"></i> Chats</h5>
                    <!-- Use hr tag to add border -->                   
                  </li>
                  <li>
                    <hr />
                    <!-- List item heading h6 -->
                    <h6><a href="#">Hi :)</a> <span class="label label-warning pull-right">10:42</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">How are you?</a> <span class="label label-warning pull-right">20:42</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">What are you doing?</a> <span class="label label-warning pull-right">14:42</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>                  
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li>
            
            <!-- Message button with number of latest messages count-->
            <li class="dropdown dropdown-big messages-dd leftonmobile">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i> <span class="label label-primary">3</span> 
              </a>

                <ul class="dropdown-menu">
                  <li class="dropdown-header padless">
                    <!-- Heading - h5 -->
                    <h5><i class="fa fa-envelope-alt"></i> Messages</h5>
                    <!-- Use hr tag to add border -->
                    
                  </li>
                  <li>
                    <hr /><!-- List item heading h6 -->
                    <h6><a href="#">Hello how are you?</a></h6>
                    <!-- List item para -->
                    <p>Quisque eu consectetur erat eget  semper...</p>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">Today is wonderful?</a></h6>
                    <p>Quisque eu consectetur erat eget  semper...</p>
                    <hr />
                  </li>
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
                </ul>
            </li>

            <!-- Members button with number of latest members count -->
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-user"></i> <span class="label label-success">7</span> 
              </a>

                <ul class="dropdown-menu">
                  <li class="dropdown-header padless">
                    <!-- Heading - h5 -->
                    <h5><i class="fa fa-user"></i> Users</h5>
                    <!-- Use hr tag to add border -->                    
                  </li>
                  <li>
                    <hr />
                    <!-- List item heading h6-->
                    <h6><a href="#">John Doe</a> <span class="label label-warning pull-right">Free</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">Iron Man</a> <span class="label label-important pull-right">Premium</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>
                  <li>
                    <h6><a href="#">Salamander</a> <span class="label label-warning pull-right">Free</span></h6>
                    <div class="clearfix"></div>
                    <hr />
                  </li>                  
                  <li>
                    <div class="drop-foot">
                      <a href="#">View All</a>
                    </div>
                  </li>                                    
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
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

        <!--- Sidebar navigation -->
        <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
        <ul id="nav">
          <!-- Main menu with font awesome icon -->
          <li>
              <a href="<?php echo Yii::app()->homeUrl; ?>">
                  <i class="fa fa-home"></i> <span>首页</span>
              </a>
          </li>
          
          <li class="has_sub">
            <a href="#">
                <i class="fa fa-list-alt"></i> <span>学生管理</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span>
            </a>
            <ul>
              <li><a href="<?php echo $this->createUrl('teacher/searchStudent');?>">学生信息查询</a></li>
              <li><a href="<?php echo $this->createUrl('teacher/addStudent');?>">学生信息添加</a></li>
            </ul>
          </li>
          
          <li class="has_sub">
            <a href="#">
            <i class="fa fa-user"></i> <span>个人信息</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="<?php echo $this->createUrl('setting/changePassword');?>">密码变更</a></li>
              <li><a href="#">学生登录</a></li>
            </ul>
          </li>
          
          <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> <span>Charts</span></a></li> 
          <li><a href="tables.html"><i class="fa fa-table"></i> <span>Tables</span></a></li>
          <li><a href="forms.html" class="open"><i class="fa fa-tasks"></i> <span>Forms</span></a></li>
          <li><a href="ui.html"><i class="fa fa-magic"></i> <span>User Interface</span></a></li>
          <li><a href="typography.html"><i class="fa fa-edit"></i> <span>Typography</span></a></li>
          <li><a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
          <li class="has_sub"><a href="#"><i class="fa fa-sitemap"></i> <span>Extra Pages #1</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="post.html">Post</a></li>
              <li><a href="login.html">Login</a></li>
              <li><a href="register.html">Register</a></li>
              <li><a href="support.html">Support</a></li>
              <li><a href="invoice.html">Invoice</a></li>
              <li><a href="profile.html">Profile</a></li>
              <li><a href="gallery.html">Gallery</a></li>
            </ul>
          </li> 
          <li class="has_sub"><a href="#"><i class="fa fa-file-text"></i> <span>Extra Pages #2</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="media.html">Media</a></li>
              <li><a href="statement.html">Statement</a></li>
              <li><a href="error.html">Error</a></li>
              <li><a href="error-log.html">Error Log</a></li>
              <li><a href="calendar.html">Calendar</a></li>
              <li><a href="grid.html">Grid</a></li>
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="fa fa-heart"></i> <span>3 Level Menu</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="#"><i class="fa fa-bookmark"></i> Subitem 1</a></li>
              <li class="has_sub"><a href="#"><i class="fa fa-glass"></i> Subitem 2 <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
                  <ul>
                    <li><a href="#"><i class="fa fa-bell"></i> Subitem 1</a></li>
                    <li><a href="#"><i class="fa fa-camera"></i> Subitem 2</a></li>
                  </ul>
              </li>
            </ul>
          </li>
          <li class="has_sub"><a href="#"><i class="fa fa-folder"></i> <span>4 Level Menu</span> <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
            <ul>
              <li><a href="#"><i class="fa fa-thumb-tack"></i> Subitem 1</a></li>
              <li class="has_sub"><a href="#"><i class="fa fa-thumbs-up"></i> Subitem 2 <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
                  <ul>
                    <li><a href="#"><i class="fa fa-trophy"></i> Subitem 1</a></li>
                    <li class="has_sub"><a href="#"><i class="fa fa-share"></i> Subitem 2 <span class="pull-right"><i class="fa fa-chevron-left"></i></span></a>
                        <ul>
                          <li><a href="#"><i class="fa fa-microphone"></i> Subitem 1</a></li>
                          <li><a href="#"><i class="fa fa-phone"></i> Subitem 2</a></li>
                        </ul>
                    </li>
                  </ul>
              </li>
            </ul>
          </li>
        </ul>
    </div>
    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
            <h2 class="pull-left"><?php echo $this->pageTitle; ?></h2>
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

	    <!-- Matter -->
	    <div class="matter">
            
            <div class="container">
                <!-- 提示消息显示区域 -->
                <?php if (Yii::app()->user->hasFlash('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php } ?>
                <?php if (Yii::app()->user->hasFlash('warning')) { ?>
                    <div class="alert alert-warning">
                        <?php echo Yii::app()->user->getFlash('warning'); ?>
                    </div>
                <?php } ?>
                <?php if (Yii::app()->user->hasFlash('info')) { ?>
                    <div class="alert alert-info">
                        <?php echo Yii::app()->user->getFlash('info'); ?>
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
            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script> <!-- Date picker -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.slimscroll.min.js"></script> <!-- jQuery SlimScroll -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-switch.min.js"></script> <!-- Bootstrap Toggle -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.maskedinput.min.js"></script> <!-- jQuery Masked Input -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.icheck.min.js"></script> <!-- jQuery iCheck -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/dropzone.js"></script> <!-- jQuery Dropzone -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filter.js"></script> <!-- Filter for support page -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom.js"></script>


</body>

</html>
