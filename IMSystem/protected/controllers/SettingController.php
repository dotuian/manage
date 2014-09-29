<?php

class SettingController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'setting');
    }
    
    
    public function accessRules()
    {
        return array(
            array('allow',  //允许所有人执行'login','error','index'
                'actions'=>array('login','error','index'),
                'users'=>array('*'),
            ),
            array('allow', //允许超级管理员执行所有动作
                'actions'=>array('create','update','delete'),
                'expression'=>array($this,'isSuperAdmin'),
            ),
            array('allow',//允许普通管理员执行
                'actions'=>array('update'),
                'expression'=>array($this,'isNormalAdmin'),    //表示调用$this(即AdminController)中的isNormalAdmin方法。
            ),      
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
    
    /**
     * 判断是否是超级管理员
     * @param type $user 代表Yii::app()->user即登录用户
     * @return type
     */
    protected function isSuperAdmin($user) {
        return ($this->loadModel($user->id)->adminAdminFlag == 1);
    }

    /**
     * 判断是否是普通管理员
     * @param type $user 代表Yii::app()->user即登录用户
     * @return type
     */
    protected function isNormalAdmin($user) {
        return ($this->loadModel($user->id)->adminAdminFlag == 0);
    }

    public function loadModel($id) {
        $model = TUsers::model()->findByPk((int) $id);
        if ($model === null) {
            throw new CHttpException(404, '页面不存在！');
        }
        return $model;
    }
    
    
    /**
     * 登录用户信息
     */
    public function actionProfile() {

        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        
        if ($user->roles == 'S') {
            $data = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        } else {
            $data = TTeachers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        }

        if (is_null($user) || is_null($data)) {
            throw new CHttpException('400', '用户信息找不到！');
        }
        
        if ($user->roles == 'S') { // 学生用户信息变更
            if (isset($_POST['TStudents'])) {
                $data->id_card_no = $_POST['TStudents']['id_card_no'];
                $data->birthday = $_POST['TStudents']['birthday'];
                $data->address = $_POST['TStudents']['address'];
                $data->parents_tel = $_POST['TStudents']['parents_tel'];
                $data->parents_qq = $_POST['TStudents']['parents_qq'];
                if ($data->save()) {
                    Yii::app()->user->setFlash('success', "个人信息变更成功！");
                } else {
                    Yii::app()->user->setFlash('warning', "个人信息变更失败！");
                }
            }
        } else {// 教师用户信息变更
            if (isset($_POST['TTeachers'])) {
                $data->birthday = $_POST['TStudents']['birthday'];
                $data->address = $_POST['TStudents']['address'];
                $data->telephonoe = $_POST['TStudents']['telephonoe'];
                if ($data->save()) {
                    Yii::app()->user->setFlash('success', "个人信息变更成功！");
                } else {
                    Yii::app()->user->setFlash('warning', "个人信息变更失败！");
                }
            }
        }

        $this->render('profile', array('user' => $user, 'model' => $data));
    }

    /**
     * 用户密码变更页面
     */
    public function actionChangePassword() {
        $model = new UserForm('changePassword');
        if (isset($_POST['UserForm'])) {
            $model->attributes = $_POST['UserForm'];

            if ($model->validate()) {
                $user = TUsers::model()->find('ID=:ID', array(':ID' => Yii::app()->user->getState('ID')));
                $user->password = $model->new_password;
                if ($user->save()) {
                    // 密码清空
                    $model->clear();
                    Yii::app()->user->setFlash('success', "密码变更成功！");
                } else {
                    Yii::app()->user->setFlash('warning', "密码变更失败！");
                }
            }
        }

        $this->render('changePassword', array('model' => $model));
    }

}   