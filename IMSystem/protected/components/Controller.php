<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    
    // 登录用户ID
    public $ID = '';
    // 登录用户角色
    public $role = '';
    
    public function init() {
        Yii::log('POST DATA ' . print_r($_POST, true));
        Yii::log('GET DATA ' . print_r($_GET, true));
        
        // 错误标签的设定
        CHtml::$errorContainerTag = 'span';
        
        // 登录用户ID
        $this->ID = Yii::app()->user->getState('ID');
        
        // 登录用户角色
        $this->role = Yii::app()->user->getState('role');
    }
    
    /**
     * 基于角色访问控制（role-based access (RBAC)）
     * @return type
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }
    
    /**
     * 在控制器（controller）里重载CController::filters方法，
     * 设置访问过滤器来控制访问动作
     * @return type
     * 
     * *: 任何用户，包括匿名和验证通过的用户
     * ?: 匿名用户
     * @: 验证通过的用户
     */
    public function accessRules() {
        return array(
            array('allow',
                'users' => array('@'), // 允许所有验证用户访问
            ),
            array('deny',
                'users' => array('*'), // 拒绝所有用户
            ),
        );
    }
    
    public function getLoginUserId() {
        return Yii::app()->user->getState('ID');
    }
    
    /**
     * 判断登录的用户是否为学生用户
     * @return type
     */    
    public function isStudent(){
        return $this->role === 'S';
    }
    
    /**
     * 判断登录的用户是否为学生用户
     * @return type
     */
    public function isTeacher() {
        return $this->role != 'S';
    }

}