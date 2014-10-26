<?php

class SettingController extends BaseController {

    /**
     * 登录用户信息
     */
    public function actionProfile() {

        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        if (is_null($user)) {
            throw new CHttpException('404', '用户信息不存在');
        }

        if (Yii::app()->user->getState('user_type') === 'student') {
            $data = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        } else {
            $data = TTeachers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        }

        if (is_null($data)) {
            throw new CHttpException('400', '用户信息找不到！');
        }

        if (Yii::app()->user->getState('user_type') === 'student') { // 学生用户信息变更
            if (isset($_POST['TStudents'])) {
                $data->id_card_no = $_POST['TStudents']['id_card_no'];
                $data->birthday = $_POST['TStudents']['birthday'];
                $data->address = $_POST['TStudents']['address'];
                $data->parents_tel = $_POST['TStudents']['parents_tel'];
                $data->parents_qq = $_POST['TStudents']['parents_qq'];
                $data->update_user = $this->getLoginUserId();
                $data->update_time = new CDbExpression('NOW()');

                if ($data->save()) {
                    $this->setSuccessMessage("个人信息变更成功！");
                } else {
                    $this->setErrorMessage("个人信息变更失败！");
                }
            }
        } else {// 教师用户信息变更
            if (isset($_POST['TTeachers'])) {
                $data->birthday = $_POST['TTeachers']['birthday'];
                $data->address = $_POST['TTeachers']['address'];
                $data->telephonoe = $_POST['TTeachers']['telephonoe'];
                $data->update_user = $this->getLoginUserId();
                $data->update_time = new CDbExpression('NOW()');

                if ($data->save()) {
                    $this->setSuccessMessage("个人信息变更成功！");
                } else {
                    $this->setErrorMessage("个人信息变更失败！");
                }
            }
        }

        $this->render('profile', array('user' => $user, 'model' => $data));
    }

    /**
     * 用户密码变更页面
     */
    public function actionPassword() {

        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        if (is_null($user)) {
            throw new CHttpException('404', '用户信息不存在');
        }

        $model = new UserForm('changePassword');
        if (isset($_POST['UserForm'])) {
            $model->attributes = $_POST['UserForm'];

            if ($model->validate()) {
                $user->password = $model->new_password;
                $user->update_user = $this->getLoginUserId();
                $user->update_time = new CDbExpression('NOW()');

                if ($user->save()) {
                    // 密码清空
                    $model->clear();
                    $this->setSuccessMessage("密码变更成功！");
                } else {
                    $this->setErrorMessage("密码变更失败！");
                }
            }
        }

        $this->render('password', array('model' => $model));
    }

}
