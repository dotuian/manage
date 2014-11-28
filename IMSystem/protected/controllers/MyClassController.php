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

            $this->render('update_student', array(
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
    
    
}