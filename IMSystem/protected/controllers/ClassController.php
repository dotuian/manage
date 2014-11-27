<?php

/**
 * 班级控制器
 */
class ClassController extends BaseController {

    /**
     * 班级里的所有学生信息
     * @throws CHttpException
     */
    public function actionStudent() {
        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);

            $class = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }

            $sql = "select b.student_number, a.* from t_students a ";
            $sql .= "inner join t_student_classes b on a.ID = b.student_id ";
            $sql .= "inner join t_classes c on c.ID = b.class_id ";
            $sql .= "where b.class_id=:class_id ";
            $sql .= " and ((c.status='1' and b.status='1') or (c.status='2' and b.status='0')) "; // 目前班级的学生，以及以前班级的学生

            $students = TStudents::model()->findAllBySQL($sql, array(':class_id' => $class->ID));

            if (count($students) === 0) {
                $this->setWarningMessage('没有学生信息！');
            }

            $this->render('student', array(
                'students' => $students,
                'class' => $class,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    /**
     * 查询班级信息
     */
    public function actionSearch() {

        $sql = "select a.*, b.name as teacher_name from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
        $countSql = "select count(*) from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
        $condition = '';

        $model = new ClassForm();
        $params = array();

        if (isset($_GET['ClassForm'])) {
            $model->attributes = $_GET['ClassForm'];
            // 检索条件
            if (trim($model->class_code) !== '') {
                $condition .= " and a.class_code like :class_code ";
                $params[':class_code'] = '%' . trim($model->class_code) . '%';
            }
            // 年级
            if (trim($model->grade) !== '') {
                $condition .= " and a.grade = :grade ";
                $params[':grade'] = trim($model->grade);
            }
            // 
            if (trim($model->class_name) !== '') {
                $condition .= " and a.class_name like :class_name ";
                $params[':class_name'] = '%' . trim($model->class_name) . '%';
            }
            // 年度
            if (trim($model->entry_year) !== '') {
                $condition .= " and a.entry_year = :entry_year ";
                $params[':entry_year'] = trim($model->entry_year);
            }
            // 学期
            if (trim($model->term_type) !== '') {
                $condition .= " and a.term_type = :term_type ";
                $params[':term_type'] = trim($model->term_type);
            }
            // 班级性质
            if (trim($model->class_type) !== '') {
                $condition .= " and a.class_type = :class_type ";
                $params[':class_type'] = trim($model->class_type);
            }
            // 专业名称
            if (trim($model->specialty_name) !== '') {
                $condition .= " and a.specialty_name like :specialty_name ";
                $params[':specialty_name'] = '%' . trim($model->specialty_name) . '%';
            }
            if (trim($model->status) !== '') {
                $condition .= " and a.status = :status ";
                $params[':status'] = trim($model->status);
            }
            if (trim($model->teacher_id) !== '') {
                $condition .= " and a.teacher_id = :teacher_id ";
                $params[':teacher_id'] = trim($model->teacher_id);
            }
        }
        $sql .= $condition;
        $countSql .= $condition;

        $count = Yii::app()->db->createCommand($countSql)->queryScalar($params);
        $dataProvider = new CSqlDataProvider($sql, array(
            'params' => $params,
            'keyField' => 'ID',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'user' => array(
                        'asc' => 'a.status, a.entry_year, a.class_code',
                        'desc' => 'a.status asc, a.entry_year desc, a.class_code asc',
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

        // 没有数据
        if ($dataProvider->totalItemCount == 0) {
            $this->setWarningMessage("没有检索到相关数据！");
        }

        $this->render('search', array(
            'model' => $model,
            'dataProvider' => isset($dataProvider) ? $dataProvider : null,
        ));
    }

    /**
     * 添加班级信息
     */
    public function actionCreate() {

        $model = new ClassForm('create');
        $model->entry_year = date('Y');

        if (isset($_POST['ClassForm'])) {
            $model->attributes = $_POST['ClassForm'];
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $class = new TClasses();
                    $class->class_code = trim($model->class_code);
                    $class->class_name = trim($model->class_name);
                    $class->entry_year = intval($model->entry_year);
                    $class->term_type  = trim($model->term_type);
                    $class->grade      = trim($model->grade); 
                    $class->class_type = trim($model->class_type); // 班级类型(0:普通高中 1:技能专业)
                    $class->specialty_name = trim($model->specialty_name); // 专业名称
                    $class->status = '1'; // 新建正常状态的班级信息
                    $class->teacher_id = intval($model->teacher_id);

                    $class->create_user = $this->getLoginUserId();
                    $class->create_time = new CDbExpression('NOW()');
                    if ($class->save(false)) {
                        $tran->commit();
                        $this->setSuccessMessage("班级信息添加成功！");
                        $this->redirect($this->createUrl('create'));
                    } else {
                        Yii::log(print_r($class->errors, true));
                        $this->setErrorMessage("班级信息添加失败！");
                    }
                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    
    /**
     * 班级信息更新
     * @throws CHttpException
     */
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);

            $class = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }
            
            // 暂停状态的班级信息不能修改
            if (isset($_POST['TClasses']) && $class->status == '1') {
                $class->class_name = trim($_POST['TClasses']['class_name']);
                $class->teacher_id = trim($_POST['TClasses']['teacher_id']);
                $class->status = trim($_POST['TClasses']['status']);
                
                
                $class->update_user = $this->getLoginUserId();
                $class->update_time = new CDbExpression('NOW()');

                if ($class->validate()) {
                    if ($class->save()) {
                        $this->setSuccessMessage("班级信息变更成功！");
                    } else {
                        $this->setErrorMessage("班级信息变更失败！");
                    }
                }
            }

            $this->render('update', array(
                'model' => $class,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

    /**
     * 暂停单个班级
     * @throws CHttpException
     */
    public function actionPause() {
        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);

            $class = TClasses::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }

            if (isset($_POST['TClasses'])) {
                $class->status = '2'; // 暂停
                $class->update_user = $this->getLoginUserId();
                $class->update_time = new CDbExpression('NOW()');
                
                // 该班级对应的学生信息也全都暂停
                $sql = "update t_student_classes set status= '0', update_user=:update_user, update_time=now() where class_id=:class_id and status='1'";
                $command=Yii::app()->db->createCommand($sql);
                $command->bindValue(":update_user", $this->getLoginUserId());
                $command->bindValue(":class_id", $class->ID);
                $command->execute();
                
                if ($class->save(false)) {
                    $this->setSuccessMessage("班级暂停成功！");
                } else {
                    Yii::log(print_r($class->errors, true));
                    $this->setErrorMessage("班级暂停失败！");
                }
            }
            
            $this->redirect($this->createUrl('search'));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

    /**
     * 暂停多个班级
     * @throws CHttpException
     */
    public function actionPauseMore() {
        
        $model = new StopClassForm();
        
        if (isset($_POST['StopClassForm'])) {
            $model->attributes = $_POST['StopClassForm'];
            
            $tran = Yii::app()->db->beginTransaction();
            try {
                $result = true;
                foreach ($model->class_ids as $class_id => $value) {
                    if($value == 1) {
                        $class = TClasses::model()->find("ID=:ID and status='1'", array(":ID" => $class_id));
                        if(!is_null($class)){
                            $class->status = '2'; // 未使用
                            $class->update_user = $this->getLoginUserId();
                            $class->update_time = new CDbExpression('NOW()');
                            
                            // 该班级对应的学生信息也全都暂停
                            $sql = "update t_student_classes set status= '0', update_user=:update_user, update_time=now() where class_id=:class_id and status='1'";
                            $command=Yii::app()->db->createCommand($sql);
                            $command->bindValue(":update_user", $this->getLoginUserId());
                            $command->bindValue(":class_id", $class->ID);
                            $command->execute();
                            
                            if(!$class->save(false)){
                                $result = false;
                                break;
                            }
                        }
                    }
                }
                if($result) {
                    $tran->commit();
                    $this->setSuccessMessage('所选班级信息暂停成功！');
                } else {
                    $this->setErrorMessage('所选班级信息暂停失败！');
                }
                
            } catch (Exception $exc) {
                Yii::log($exc->getTraceAsString());
            }
        }
        
        $sql = "select a.*, b.name from t_classes a left join t_teachers b on a.teacher_id=b.ID where a.status='1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $classes = $command->queryAll();
        
        $this->render('pausemore', array('model' => $model, 'classes' => $classes));
    }

    
    /**
     * 班主任和任课教师查看自己管辖访问内的学生信息
     */
    public function actionMyclass() {
        $model = new MyClassForm();
        
        // 当前教师可以访问的班级
        $classes = TClasses::model()->getClassOptionByUserRole($this->getLoginUserId());
        
        if (isset($_GET['MyClassForm'])) {
            $model->attributes = $_GET['MyClassForm'];
            
            // 检查是否有权限查看该班级的信息
            if (!in_array($model->class_id, array_keys($classes))) {
                throw new CHttpException(500, "您没有权限查看该班级的信息！");
            }
            
            if ($model->validate()) {

                $sql = "select a.*, b.student_number from t_students a ";
                $sql .= " inner join t_student_classes b on a.ID=b.student_id ";
                $sql .= " inner join t_classes c         on c.ID=b.class_id ";
                $sql .= "where a.`status`='1' and b.`status`='1' and c.`status`='1' ";
                $sql .= "and c.ID=:class_id";
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(":class_id", $model->class_id);
                $data = $command->queryAll();
                
                if (count($data) === 0) {
                    $this->setWarningMessage('没有学生信息！');
                }
                
                Yii::log(print_r($data, true));
            }
        }

        $this->render('myclass', array('classes'=>$classes, 'model' => $model, 'data' => isset($data) ? $data : null));
    }
    
    
    /**
     * 班主任修改自己班级学生的信息
     * @throws CHttpException
     */
    public function actionUpdateMyStudent() {
        if (isset($_GET['ID'])) {

            $ID = trim($_GET['ID']);
            $student = TStudents::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(404, "该学生信息不存在！");
            }
            
            // 当前所在班级信息
            $currentClass = TStudentClasses::model()->find("student_id=:student_id and status='1'", array(':student_id' => $student->ID));
            if (!is_null($currentClass)) {
                // 目前所在班级学号
                $student->student_number = $currentClass->student_number;
                // 目前所在班级
                $student->class_id = $currentClass->class_id;
            }
            
            $class = TClasses::model()->find("ID=:ID and status='1'", array(':ID'=>$currentClass->class_id));
            if (is_null($class) || $class->teacher_id != $this->getLoginUserId()) {
//                throw new CHttpException(404, "不是该学生的班主任，没有修改权限！");
            }

            // 变更学生信息
            if (isset($_POST['TStudents'])) {
                $student->scenario = 'update';
                $student->province_code = trim($_POST['TStudents']['province_code']);
                $student->name = trim($_POST['TStudents']['name']);
                $student->sex = trim($_POST['TStudents']['sex']);
                $student->id_card_no = trim($_POST['TStudents']['id_card_no']);
                $student->birthday = trim($_POST['TStudents']['birthday']);
                $student->accommodation = trim($_POST['TStudents']['accommodation']);
                $student->payment1 = trim($_POST['TStudents']['payment1']);
                $student->payment2 = trim($_POST['TStudents']['payment2']);
                $student->payment3 = trim($_POST['TStudents']['payment3']);
                $student->payment4 = trim($_POST['TStudents']['payment4']);
                $student->payment5 = trim($_POST['TStudents']['payment5']);
                $student->payment6 = trim($_POST['TStudents']['payment6']);
                $student->bonus_penalty = trim($_POST['TStudents']['bonus_penalty']);
                $student->address = trim($_POST['TStudents']['address']);
                $student->parents_tel = trim($_POST['TStudents']['parents_tel']);
                $student->parents_qq = trim($_POST['TStudents']['parents_qq']);
                $student->school_of_graduation = trim($_POST['TStudents']['school_of_graduation']);
                $student->senior_score = trim($_POST['TStudents']['senior_score']);
                $student->school_year = trim($_POST['TStudents']['school_year']);
                $student->college_score = trim($_POST['TStudents']['college_score']);
                $student->university = trim($_POST['TStudents']['university']);
                $student->comment = trim($_POST['TStudents']['comment']);

                $student->update_user = $this->getLoginUserId();
                $student->update_time = new CDbExpression('NOW()');

                if ($student->validate()) {
                    if ($student->save()) {
                        $this->setSuccessMessage("学生信息变更成功！");
                    } else {
                        Yii::log(print_r($student->errors, true));
                        $this->setErrorMessage("学生信息变更失败！");
                    }
                }
            }
            
            Yii::log(print_r($student->errors, true));

            $this->render('updatemystudent', array(
                'model' => $student,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
}