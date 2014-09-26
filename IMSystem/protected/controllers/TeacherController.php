<?php

class TeacherController extends Controller {

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
    
    /**
     * 添加学生信息
     */
    public function actionAddStudent() {

        $model = new StudentForm('add');
        if (isset($_POST['StudentForm'])) {
            $model->attributes = $_POST['StudentForm'];
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $user = new TUsers();
                    $user->username = $model->code;
                    $user->password = substr($model->id_card_no, 6);
                    $user->status = '1';
                    $user->roles = 'S';
                    $user->create_user = $this->getLoginUserId();
                    $user->update_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');
                    $user->update_time = new CDbExpression('NOW()');
                    
                    if ($user->save()) {
                        $student = new TStudents();
                        $student->attributes = $model->attributes;
                        $student->create_user = $this->getLoginUserId();
                        $student->update_user = $this->getLoginUserId();
                        $student->create_time = new CDbExpression('NOW()');
                        $student->update_time = new CDbExpression('NOW()');
                        if ($student->save()) {
                            $tran->commit();
                            Yii::app()->user->setFlash('success', "学生信息添加成功！");
                            $this->redirect($this->createUrl('addStudent'));
                        }
                    }
                    
                    Yii::log(print_r($user->errors, true));
                    Yii::app()->user->setFlash('warning', "学生信息添加失败！");

                } catch (Exception $e) {
                    throw new CHttpException(400, "系统异常！");
                }
            }
        }

        $this->render('add_student', array('model' => $model));
    }
    
    /**
     * 添加学生信息
     */
    public function actionSearchStudent() {

        $sql = "select a.*, b.class_name from t_students a left join t_classes b on a.class_id=b.ID where 1=1 ";
        $countSql = "select count(*) from t_students a left join t_classes b on a.class_id=b.ID where 1=1 ";
        $params = array();

        if (isset($_GET['code'])) {
            $sql .= " a.code=:code ";
            $params[':code'] = trim($_GET['code']);
        }
        
        $count = Yii::app()->db->createCommand($countSql)->queryScalar($params);
        $dataProvider = new CSqlDataProvider($sql, array(
            'params' => $params,
            'keyField' => 'ID',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'user' => array(
                        'asc' => 'a.code',
                        'desc' => 'a.code desc',
                        'default' => 'desc',
                    )
                ),
                'defaultOrder' => array(
                    'user' => true,
                ),
            ),
            'pagination' => array(
                'pageSize' => 1,
            ),
        ));

        $this->render('search_student', array(
                    'dataProvider' => $dataProvider,
                ));
    }
    
    
    
    
    

}   