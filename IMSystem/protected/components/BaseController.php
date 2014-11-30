<?php

/**
 * BaseController is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class BaseController extends CController {

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
    // 当前用户拥有的权限列表
    public $authoritys;
    // 当前用户拥有的权限种类
    public $category;
    
    
    public function init() {
        // 错误标签的设定
        CHtml::$errorContainerTag = 'span';
        
        // 登录用户ID
        $this->ID = Yii::app()->user->getState('ID');
        // 登录用户角色
        $this->role = Yii::app()->user->getState('role');
        // 权限列表
        $this->authoritys = Yii::app()->user->getState('authoritys');
        // 权限种类
        $this->category = Yii::app()->user->getState('auth_category');
        
        Yii::log("_POST_ \r\n" . print_r($_POST, true));
        Yii::log("_GET__ \r\n" . print_r($_GET,  true));
    }
    
    /**
     * 在init()方法之后执行，进行权限检查
     * @param type $action
     * @return boolean
     * @throws CHttpException
     */
    protected function beforeAction($action){
        if (parent::beforeAction($action)) {
            if (Yii::app()->request->isAjaxRequest) {
                // Ajax请求不进行权限检查
                return true;
            }

            if (!in_array($this->getRoute(), Yii::app()->user->getState('authoritys'))) {
//                throw new CHttpException(500,'没有权限！');
            }
        } else {
            return false;
        }
        
        return true;
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
    
    /**
     * 获取登录用户ID
     * @return type
     */
    public function getLoginUserId() {
        return Yii::app()->user->getState('ID');
    }
    
    /**
     * 判断该登录用户是否为学生
     * @return boolean
     */
    public function isStudent() {
        return Yii::app()->user->getState('isStudent');
    }
    
    /**
     * 判断该登录用户是否为教师
     * @return boolean
     */
    public function isTeacher() {
        return Yii::app()->user->getState('isTeacher');
    }
    
    /**
     * 判断该登录用户是否为学工科
     * @return boolean
     */
    public function isXueGongKe() {
        return Yii::app()->user->getState('isXueGongKe');
    }
    
    /**
     * 判断该登录用户是否为教务处
     * @return boolean
     */
    public function isJiaoWuChu() {
        return Yii::app()->user->getState('isJiaoWuChu');
    }
    
    /**
     * 判断该登录用户是否为校长
     * @return boolean
     */
    public function isHeaderTeacher() {
        return Yii::app()->user->getState('isHeaderTeacher');
    }
    
    /**
     * 是否为班主任
     */
    public function isBanZhuRen() {
        return Yii::app()->user->getState('isBanZhuRen');
    }
    
    /**
     * 是否为任课教师
     */
    public function isRenKeJiaoShi(){
        return Yii::app()->user->getState('isRenKeJiaoShi');
    }

    /**
     * 错误消息
     * @param type $message
     */
    public function setErrorMessage($message) {
        Yii::app()->user->setFlash('error', $message);
    }

    /**
     * 警告消息
     * @param type $message
     */
    public function setWarningMessage($message) {
        Yii::app()->user->setFlash('warning', $message);
    }

    /**
     * 成功消息
     * @param type $message
     */
    public function setSuccessMessage($message) {
        Yii::app()->user->setFlash('success', $message);
    }

}