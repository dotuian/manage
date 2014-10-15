<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$baseUrl = Yii::app()->baseUrl; 
$this->pageTitle=Yii::app()->name . '登录';

$cs=Yii::app()->clientScript;
$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
$cs->registerCssFile($baseUrl.'/css/login.css');

// 错误标签的设定
CHtml::$errorContainerTag = 'div';
?>

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
        <h2 class="form-signin-heading">登录</h2>
		
        <?php echo $form->error($model,'username'); ?>
        <?php echo $form->error($model,'password'); ?>
        
        <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=>'用户名', 'required'=>'', 'autofocus'=>'')); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'密码', 'required'=>'')); ?>
      
        <?php echo CHtml::submitButton('登录', array('class'=>'btn btn-lg btn-primary btn-block')); ?>

    <?php $this->endWidget(); ?>
</div>