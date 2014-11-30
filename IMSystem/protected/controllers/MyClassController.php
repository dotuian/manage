<?php

/**
 * 我的班级控制器
 */
class MyClassController extends BaseController {

    /**
     * 班主任和任课教师查看自己管辖访问内的学生信息
     */
    public function actionIndex() {
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
                $flag = TClasses::model()->isClassTeacher($model->class_id, $this->getLoginUserId());
                
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
            }
        }

        $this->render('index', array(
                    'classes'=>$classes,  // 班级选择列表
                    'model' => $model,    // 收集页面数据
                    'data' => isset($data) ? $data : null, // 检索结果
                    'flag' => isset($flag) ? $flag : false // 当前用户是否为该班班主任
                ));
    }
    
    
    /**
     * 班主任修改学生信息
     * @throws CHttpException
     */
    public function actionStudent() {
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
            
            $class = TClasses::model()->find("ID=:ID and status='1'", array(":ID" => $currentClass->class_id));
            if(is_null($class)) {
                throw new CHttpException(500, "学生对应的班级信息不存在！");
            }
            
            // 当前用户不是该班级的班主任
            if($class->teacher_id != $this->getLoginUserId()) {
                //throw new CHttpException(404, "不是该学生的班主任，没有修改权限！");
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

            $this->render('student', array(
                'model' => $student,
                'class' => $class,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    /**
     * 查看班级的课程安排
     * 班主任和任课教师均可查看
     */
    public function actionCourse() {

        $model = new MyClassForm();

        $classes = TClasses::model()->getClassOptionByUserRole($this->getLoginUserId());

        if (isset($_POST['MyClassForm'])) {
            $model->attributes = $_POST['MyClassForm'];
            if ($model->validate()) {
                
                $class = TClasses::model()->find("Id=:ID and status='1'", array(':ID' => $model->class_id));
                if (is_null($class)) {
                    throw new CHttpException(404, "该班级信息不存在！");
                }

                $sql = "select d.*, b.subject_name, c.name from m_courses a
                        inner join m_subjects b on a.subject_id=b.ID and b.`status`='1'
                        inner join t_teachers c on a.teacher_id=c.ID and c.`status`='1'
                        inner join t_classes  d on a.class_id = d.ID and d.`status`='1'
                        where a.`status`='1' and a.class_id=:class_id ";

                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $command->bindValue(":class_id", $model->class_id);
                $command->order("d.ID asc , b.level asc ");
                $data = $command->queryAll();

                if (count($data) == 0) {
                    $this->setWarningMessage("没有班级的课程安排信息！");
                }
            }
        }

        $this->render('course', array(
            'model' => $model,
            'classes' => $classes,
            'class' => isset($class) ? $class : null,
            'data' => isset($data) ? $data : null,
        ));
    }
    
    /**
     * 查看班级的学生成绩
     * 班主任和任课教师均可查看
     */
    public function actionScore() {

        $model = new MyClassForm();

        $classes = TClasses::model()->getClassOptionByUserRole($this->getLoginUserId());

        if (isset($_POST['MyClassForm'])) {
            $model->attributes = $_POST['MyClassForm'];
            $model->scenario = 'score';
            
            if ($model->validate()) {
                
                $class = TClasses::model()->find("Id=:ID and status='1'", array(':ID' => $model->class_id));
                if (is_null($class)) {
                    throw new CHttpException(404, "该班级信息不存在！");
                }

                $params = array();
                
                $sql = "select e.student_number, a.name, c.exam_name, d.subject_code, d.subject_name, d.subject_short_name, b.score ";
                $sql .= "from t_students a ";
                $sql .= "inner join t_student_classes e on e.student_id= a.ID ";
                $sql .= "inner join t_classes f on f.ID= e.class_id ";
                $sql .= "left join t_scores b on b.student_id= a.ID ";
                
                // 为了没有参加考试的学生，也能够显示出来
                if($model->exam_id != '') {
                    $sql .= "left join m_exams  c on c.ID =  b.exam_id and b.exam_id=:exam_id  ";
                    $params[':exam_id'] = trim($model->exam_id);
                } else {
                    $sql .= "left join m_exams  c on c.ID =  b.exam_id ";
                }
                
                $sql .= "left join m_subjects d on d.ID = b.subject_id ";
                $sql .= "where 1=1 ";

                if($model->class_id != '') {
                    $sql .= " and e.class_id=:class_id ";
                    $params[':class_id'] = trim($model->class_id);
                }
                if($model->subject_id != '') {
                    $sql .= " and b.subject_id=:subject_id ";
                    $params[':subject_id'] = trim($model->subject_id);
                }
                // 排序（学号，考试名称，科目）
                $sql .= "order by e.student_number ";

                $data = Yii::app()->db->createCommand($sql)->queryAll(true,$params);

                // 成绩表示，数据整形
                $dataProvider = null;
                foreach ($data as $value) {
                    $dataProvider[$value['student_number'].'|'.$value['name']][$value['exam_name']][$value['subject_name']] = $value['score'];
                }

                // 该班级全部的科目成绩
                //$subjects = $class->getClassAllSubjects();
                
                // 根据教师角色获取相应的科目
                $subjects = MSubjects::model()->getSubjectInfoByUserRole($this->getLoginUserId(), $model->class_id);
                
            }
        }

        $this->render('score', array(
            'model' => $model,
            'classes' => $classes,
            'class' => isset($class) ? $class : null,
            'data' => isset($dataProvider) ? $dataProvider : null,
            'subjects' => isset($subjects) ? $subjects : null,
        ));
    }
 
    

    public function actionImport() {
        // 导入时间的检查
        $config = MConfig::model()->getConfigByKey('IMPORT_STUDENT_DATA_RANGE');
        if (is_null($config) || (!is_null($config) && empty($config->value))) {
            throw new CHttpException(500, "批量导入时间没有设置！");
        }

        list($start_date, $end_date) = explode('|', $config->value);
        $today = date('Y-m-d');
        if (!($start_date <= $today && $today <= $end_date)) {
            throw new CHttpException(500, "当前日期不能导入学生信息！");
        }
        
        $model = new TImportStudent();
        
        // 学生数据读取
        if (isset($_POST['TImportStudent']) && isset($_POST['validate']) && trim($_POST['validate']) == 'validate') {
            $tran = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['TImportStudent'];
                $model->scenario = 'validate';
                // 上传文件名
                $model->filename = CUploadedFile::getInstance($model, 'filename');
                if ($model->validate()) {
                    // 保存文件名
                    $model->realpath = Yii::app()->params['FilePath'] . time() . '.' . $model->filename->extensionName;
                    $model->create_user = $this->getLoginUserId();
                    $model->update_user = $this->getLoginUserId();
                    $model->filename->saveAs($model->realpath); // 将文件保存在服务器端

                    if ($model->save()) {
                        // 将Excel文件中的数据读取到数组中
                        $data = $model->readExcel2Array();
                        // 数据整形
                        $data = $model->converdata($data);
                        // 数据验证
                        if ($check = $model->validatedata($data)) {
                            $this->setSuccessMessage("数据正常，可以导入！");
                            $tran->commit();
                        } else {
                            $this->setWarningMessage("数据中有格式错误，请修改后重试！");
                        }
                    } else {
                        $this->setErrorMessage("数据读取失败，请检查文件格式之后重试！");
                    }
                }
            } catch (Exception $e) {
                $this->setErrorMessage('数据读取失败！');
            }
        }
        
        // 学生数据导入
        if (isset($_POST['TImportStudent']['ID']) && isset($_POST['TImportStudent']['class_id']) && isset($_POST['import']) && trim($_POST['import']) == 'import') {
            $model->attributes = $_POST['TImportStudent'];
            $model->scenario = 'import';

            $record = TImportStudent::model()->find('ID=:ID', array(':ID' => $model->ID));
            if(is_null($record)){
                throw new CHttpException(500, '数据导入过程中出现异常，请稍后重试！');
            }
            
            $class = TClasses::model()->find("ID=:ID and status='1'", array(':ID' => $model->class_id));
            if(is_null($class)){
                throw new CHttpException(500, '要导入学生信息的班级信息不存在！');
            }

            $tran = Yii::app()->db->beginTransaction();
            try {
                // 将Excel文件中的数据读取到数组中
                $data2 = $record->readExcel2Array();
                // 数据整形
                $data2 = $record->converdata($data2);
                // 数据验证
                if($model->validatedata($data2)) {
                    // 数据导入
                    if($model->importdata($data2, $class)) {
                        $tran->commit();
                        $this->setSuccessMessage("数据导入成功！");
                        
                        $this->redirect($this->createUrl('import'));
                    } else {
                        $this->setErrorMessage("数据导入失败，请检查数据是否正确，然后重试！");
                    }
                } else {
                    $this->setErrorMessage('数据中有异常数据，请修改后再重试！');
                }
            } catch (Exception $ex) {
                throw new CHttpException(500, '数据导入过程中出现了异常！');
            }
        }
        
        $this->render('import', array(
            'model' => $model,
            'check' => isset($check) ? $check : null,  // 对Excel中的数据进行检查的结果
            'data'  => isset($data) ? $data : null, // Excel读取的，经过了检查的数据
        ));
    }
    
}