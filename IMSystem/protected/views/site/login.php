<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$baseUrl = Yii::app()->baseUrl; 
$this->pageTitle=Yii::app()->name . '登录';

$cs=Yii::app()->clientScript;

$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
$cs->registerCssFile($baseUrl.'/css/style.css');
$cs->registerCssFile($baseUrl.'/css/login.css');

// 错误标签的设定
CHtml::$errorContainerTag = 'div';
?>

<header>
    <div class="navbar navbar-fixed-top bs-docs-nav" role="banner">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">
                 <span class="bold"><?php echo Yii::app()->name; ?></span>
                 <i><?php echo Yii::app()->params['appName'];?></i> 
            </a>
        </div>
    </div>
</header>


<div class="wrapper">
    
    <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => false,
            'method' => 'post',
            'action' => $this->createUrl('login'),
            'htmlOptions' => array('class' => 'form-signin'),
        ));
    ?>
        <h2 class="form-signin-heading">用户登录</h2>
		
        <?php echo $form->error($model,'username'); ?>
        <?php echo $form->error($model,'password'); ?>
        
        <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>'用户名', 'required'=>'', 'autofocus'=>'')); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'密码', 'required'=>'')); ?>
      
        <?php echo CHtml::submitButton('登录', array('class'=>'btn btn-lg btn-primary btn-block')); ?>

    <?php $this->endWidget(); ?>
</div>

<footer>
    <div class="container">
      <p class="copy">
          孝感市综合高级中学　版权所有　地址：湖北省孝感市槐荫大道100号 , 电话:0712-2462735 , 鄂ICP备000000号
      </p>
    </div>
</footer>