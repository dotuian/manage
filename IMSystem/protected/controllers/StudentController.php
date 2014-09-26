<?php

class StudentController extends Controller {

    /**
     * 用户密码变更页面
     */
    public function actionIndex() {
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

        $this->render('index', array('model' => $model));
    }
    
    public function actionQueryScore() {
        
    }

}   