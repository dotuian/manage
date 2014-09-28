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
                    $user->password = substr($model->id_card_no, -6); // 密码默认为身份证后六位
                    $user->status = '1';
                    $user->roles = 'S';
                    $user->create_user = $this->getLoginUserId();
                    $user->update_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');
                    $user->update_time = new CDbExpression('NOW()');
                    
                    if ($user->save()) {
                        $student = new TStudents();
                        $student->attributes = $model->attributes;
                        $student->ID = $user->ID;
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
        
        
        $sql = "select a.*, b.class_name as class_name from t_students a left join t_classes b on a.class_id=b.ID where 1=1 ";
        $countSql = "select count(*) from t_students a left join t_classes b on a.class_id=b.ID where 1=1 ";
        $params = array();
        
        $model = new StudentForm();
        $model->sex = null;
        if (isset($_GET['StudentForm'])) {
            $model->attributes = $_GET['StudentForm'];
            
            if (trim($model->code) !== '') {
                $sql .= " and a.code like :code ";
                $countSql .= " and a.code like :code ";
                $params[':code'] = '%' . trim($model->code) . '%';
            }
            if (trim($model->name) !== '') {
                $sql .= " and a.name like :name ";
                $countSql .= " and a.name like :name ";
                $params[':name'] = '%' . trim($model->name) . '%';
            }
            if (trim($model->sex) !== '') {
                $sql .= " and a.sex = :sex ";
                $countSql .= " and a.sex = :sex ";
                $params[':sex'] = trim($model->sex);
            }
            if (trim($model->id_card_no) !== '') {
                $sql .= " and a.id_card_no like :id_card_no ";
                $countSql .= " and a.id_card_no like :id_card_no ";
                $params[':id_card_no'] = '%' . trim($model->id_card_no) . '%';
            }
            if (trim($model->class_id) !== '') {
                $sql .= " and a.class_id = :class_id ";
                $countSql .= " and a.class_id = :class_id ";
                $params[':class_id'] = trim($model->class_id);
            }
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
                'pageSize' => Yii::app()->params['PageSize'],
            ),
        ));

        $this->render('search_student', array(
                    'model' => $model, 
                    'dataProvider' => $dataProvider,
                ));
    }
    
    public function actionModifyStudent() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            $student = TStudents::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(400, "该学生信息不存在！");
            }
            
            if ($_POST['TStudents']) {
                $student->name          = trim($_POST['TStudents']['name']);
                $student->id_card_no    = trim($_POST['TStudents']['id_card_no']);
                $student->birthday      = trim($_POST['TStudents']['birthday']);
                $student->old_class_id  = $student->class_id;
                $student->class_id      = trim($_POST['TStudents']['class_id']);
                $student->accommodation = trim($_POST['TStudents']['accommodation']);
                $student->payment1      = trim($_POST['TStudents']['payment1']);
                $student->payment2      = trim($_POST['TStudents']['payment2']);
                $student->payment3      = trim($_POST['TStudents']['payment3']);
                $student->payment4      = trim($_POST['TStudents']['payment4']);
                $student->payment5      = trim($_POST['TStudents']['payment5']);
                $student->payment6      = trim($_POST['TStudents']['payment6']);
                
                $student->bonus_penalty = trim($_POST['TStudents']['bonus_penalty']);
                $student->address       = trim($_POST['TStudents']['address']);
                $student->parents_tel   = trim($_POST['TStudents']['parents_tel']);
                $student->parents_qq    = trim($_POST['TStudents']['parents_qq']);
                $student->school_of_graduation = trim($_POST['TStudents']['school_of_graduation']);
                $student->senior_score  = trim($_POST['TStudents']['senior_score']);
                $student->school_year   = trim($_POST['TStudents']['school_year']);
                $student->college_score = trim($_POST['TStudents']['college_score']);
                $student->university    = trim($_POST['TStudents']['university']);
                $student->comment       = trim($_POST['TStudents']['comment']);
                
                $student->update_user = $this->getLoginUserId();
                $student->update_time = new CDbExpression('NOW()');
                
                if ($student->save()) {
                    Yii::app()->user->setFlash('success', "学生信息变更成功！");
//                    $this->redirect($this->createUrl('addStudent'));
                } else {
                    Yii::log(print_r($student->errors, true));
                    Yii::app()->user->setFlash('warning', "学生信息变更失败！");
                }
            }


            $this->render('modify_student', array(
                'model' => $student,
            ));
        } else {
            throw new CHttpException(400, "找不到该页面！");
        }
    }

}   