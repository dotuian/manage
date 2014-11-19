<?php

/**
 * 成绩控制器
 */
class ScoreController extends BaseController {

    /**
     * 学生查询个人成绩
     * @throws CHttpException
     */
    public function actionQuery() {

        $student = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->getLoginUserId()));
        if (is_null($student)) {
            throw new CHttpException(500, '当前用户信息不存在！');
        }
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            
            $sql = "SELECT e.student_number, d.name, f.class_code, f.class_name, a.exam_id, b.exam_name, a.subject_id, c.subject_name, a.score ";
            $sql .= "FROM t_scores a  ";
            $sql .= "inner JOIN m_exams b ON a.exam_id = b.ID  ";
            $sql .= "inner JOIN m_subjects c ON a.subject_id = c.ID ";
            $sql .= "inner JOIN t_students d ON a.student_id = d.ID ";
            $sql .= "inner JOIN t_student_classes e ON e.student_id = d.ID ";
            $sql .= "inner join t_classes f on a.class_id = f.ID  ";
            $sql .= "WHERE a.student_id=:student_id ";
            
            $params = array(':student_id' => $this->getLoginUserId());

            if (trim($model->exam_id) !== '') {
                $sql .= " and a.exam_id = :exam_id ";
                $params[':exam_id'] = trim($model->exam_id);
            }
            $sql .= "order by a.create_time desc";

            $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);

            // 没有数据
            if (count($data) === 0) {
                $this->setWarningMessage("没有检索到相关数据！");
            }

            // 参加过的所有考试的科目
            $subject_ids = array();

            // 为了页面横排表示，数据整形
            $result = array();
            foreach ($data as $value) {
                $result[$value["exam_name"]][$value["subject_name"]] = $value['score'];

                $subject_ids[$value['subject_id']] = $value['subject_name'];
            }

            // 用于页面显示的所有科目
            $subjects = MSubjects::model()->getSubjectsBySubjectIds($subject_ids);
        }

        $this->render('query', array(
            'model' => $model,
            'data' => isset($result) ? $result : null,
            'subjects' => isset($subjects) ? $subjects : null,
        ));
    }

    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $from = " from t_scores a  
               inner join t_classes b on a.class_id = b.ID 
               inner join t_students c on a.student_id = c.ID 
               inner join m_subjects d on a.subject_id = d.ID 
               inner join m_exams e on a.exam_id = e.ID 
               inner join t_student_classes f on f.student_id=c.ID 
               where 1=1 ";
        
        $sql = "select a.*, b.class_code, b.class_name, b.class_type, b.entry_year, c.province_code, c.name, d.subject_code,d.subject_name,d.subject_type, e.exam_code, e.exam_name $from ";
        $countSql = "select count(*) $from ";
        $params = array();
        $condition= '';
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            
            if (trim($model->entry_year) !== '') {
                $condition .= " and b.entry_year = :entry_year ";
                $params[':entry_year'] = trim($model->entry_year);
            }
            if (trim($model->class_code) !== '') {
                $condition .= " and b.class_code = :class_code ";
                $params[':class_code'] = trim($model->class_code);
            }
            if (trim($model->exam_id) !== '') {
                $condition .= " and a.exam_id = :exam_id ";
                $params[':exam_id'] = trim($model->exam_id);
            }
            if (trim($model->class_id) !== '') {
                $condition .= " and a.class_id = :class_id ";
                $params[':class_id'] = trim($model->class_id);
            }
            if (trim($model->subject_id) !== '') {
                $condition .= " and a.subject_id = :subject_id ";
                $params[':subject_id'] = trim($model->subject_id);
            }
            if (trim($model->student_number) !== '') {
                $condition .= " and f.student_number = :student_number ";
                $params[':student_number'] = trim($model->student_number);
            }
            if (trim($model->student_name) !== '') {
                $condition .= " and c.name like :name ";
                $params[':name'] = '%' . trim($model->student_name) . '%';
            }
            if (trim($model->score) !== '') {
                $condition .= " and a.score = :score ";
                $params[':score'] = trim($model->score);
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
                            'asc' => 'b.ID, a.student_number, d.level ',
                            'desc' => 'b.ID asc, a.student_number asc, d.level asc',
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
            if($dataProvider->totalItemCount == 0 ) {
                $this->setWarningMessage("没有检索到相关数据！");
            }
        }
        
        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => isset($dataProvider) ? $dataProvider : null,
                ));
    }    
    

    public function actionCreate() {

        $model = new ScoreForm('create');
        
        if (isset($_POST['ScoreForm'])) {
            $model->attributes = $_POST['ScoreForm'];
            
            if($model->validate()) {
                $class = TClasses::model()->find("status='1' and ID=:ID", array(":ID"=>$model->class_id));
                if(is_null($class)){
                    throw new CHttpException('500', '该班级信息不存在！');
                }
                
                $exam = MExams::model()->find("status='1' and ID=:ID", array(":ID"=>$model->exam_id));
                if(is_null($exam)){
                    throw new CHttpException('500', '该考试信息不存在！');
                }
                
                // 该班级所修的科目
                $subject = MSubjects::model()->find("ID=:ID and status='1'", array(':ID'=>$model->subject_id));

                // 获取班级上的所有学生
                $students = $class->getClassAllStudentsForInsertScore();
                if(count($students) == 0){
                    $this->setWarningMessage("所选的班级中没有学生！");
                }
                
                // 获取已经录入的成绩信息
                $scores = array();
                $temp = TScores::model()->findAll("exam_id=:exam_id and subject_id=:subject_id and class_id=:class_id", 
                        array(':exam_id' => $model->exam_id, ':subject_id' => $model->subject_id, ':class_id' => $model->class_id));
                foreach ($temp as $score) {
                    $key = "$score->student_id|$score->exam_id|$score->subject_id|$score->class_id";
                    $scores[$key] = $score->score;
                }
                
                // 收集页面数据
                $data = new TScores();
                $this->render('create', array('model' => $model, 'data'=>$data, 'scores'=>$scores, 'exam'=>$exam, 'class'=>$class, 'subject'=>$subject, 'students'=>$students));
                Yii::app()->end();
            } 
        }

        $this->render('create', array('model' => $model));
    }

    
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            $score = TScores::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($score)) {
                throw new CHttpException(404, "该成绩信息不存在！");
            }
            
            $student = TStudents::model()->find("ID=:ID ", array(':ID'=>$score->student_id));
            if (is_null($student)) {
                throw new CHttpException(404, "该学生信息不存在！");
            }
            
            $class = TClasses::model()->find("ID=:ID ", array(':ID'=>$score->class_id));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }
            
            
            if (isset($_POST['TScores'])) {
                $score->scenario = 'update';
                $score->score  = trim($_POST['TScores']['score']);
                $score->update_user = $this->getLoginUserId();
                $score->update_time = new CDbExpression('NOW()');
                if ($score->validate()) {
                    if ($score->save()) {
                        $this->setSuccessMessage("成绩信息变更成功！");
                    } else {
                        Yii::log(print_r($score->errors, true));
                        $this->setErrorMessage("成绩信息变更失败！");
                    }
                }
            }

            $this->render('update', array(
                'model' => $score,
                'student' => $student,
                'class' => $class,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    public function actionDelete() {

        if (isset($_POST['ID'])) {
            
            $ID = trim($_POST['ID']);
            $score = TScores::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($score)) {
                throw new CHttpException(404, "该成绩信息不存在！");
            }
            
            if ($score->delete()) {
                $this->setSuccessMessage("成绩信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($score->errors, true));
                $this->setErrorMessage("成绩信息删除失败！");
            }

            $this->render('update', array(
                'model' => $score,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    public function actionClass() {
        
        $model = new ScoreForm('class');
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            $model->scenario = 'class';
            
            if ($model->validate()) {
                
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
                
                

                $this->render('class', array('model' => $model, 'data' => $dataProvider, 'subjects' => $subjects));
                
            } else {
                $this->render('class', array('model' => $model));
            } 
        } else {
            $this->render('class', array('model' => $model));
        }
    }
    
    public function actionAnalysis() {
        $model = new ScoreForm();
        
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            $model->scenario = 'analysis';
            
            if($model->validate()){
                
                $sql = "SELECT ";
                $sql .= " a.exam_id, d.exam_name, ";
                $sql .= " a.class_id,   c.class_name,  ";
                $sql .= " a.subject_id, b.subject_name,  ";
                $sql .= " count(a.score) as '考试人数', ";
                $sql .= " count(case a.score >= b.pass_score when 1 then 0 end) as '及格人数' ";
                $sql .= "FROM t_scores a ";
                $sql .= " inner JOIN m_subjects b ON a.subject_id=b.ID ";
                $sql .= " inner JOIN t_classes c ON a.class_id=c.ID and c.`status`='1' ";
                $sql .= " inner join m_exams d   on a.exam_id=d.ID ";
                $sql .= " INNER join t_students e on e.`status`='1' and a.student_id=e.ID ";
                
                $where = "where a.exam_id=:exam_id and c.grade=:grade ";
                $group = "group by a.exam_id, a.subject_id ";
                
                $params = array();
                $params[':exam_id'] = trim($model->exam_id);
                $params[':grade'] = trim($model->grade);
                
                if($model->class_id != ''){
                    $where .= "and a.class_id=:class_id ";
                    $group .= ", a.class_id";
                    $params[':class_id'] = trim($model->class_id);
                }
                if($model->subject_id != ''){
                    $where .= "and a.subject_id=:subject_id ";
                    $group .= ", a.subject_id";
                    $params[':subject_id'] = trim($model->subject_id);
                }
                
                $sql .= $where . $group;
                
                $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
                Yii::log(print_r($data, true));
                // 没有数据
                if (count($data) == 0) {
                    $this->setWarningMessage("没有指定条件的成绩信息！");
                } 
                
                // 数据整形便于显示
                $result = array();
                $subjects = array();
                foreach ($data as $value) {
                    $result[$value['exam_name'] . '|' . $value['class_name']][$value['subject_name']] = array("考试人数"=>$value["考试人数"], "及格人数"=>$value["及格人数"]);
                    $subjects[$value['subject_id']] = $value['subject_name'];
                }
            }
        }
        
        $this->render('analysis', array(
                    'model' => $model,
                    'data' => isset($result) ? $result : null,
                    'subjects' => isset($subjects) ? $subjects : null,
                ));
    }

    /**
     * 下载学生总表
     */
    public function actionReport(){
        $model = new ReportForm();
        if(isset($_POST['ReportForm'])) {
            $model->attributes = $_POST['ReportForm'];
            if($model->validate()) {
                // 数据
                $data = $model->getExcelData();
                //Yii::log(print_R($data, true));
                
                // 标题
                $title = $model->getDataTitle($data);
                //Yii::log(print_R($title, true));
                
                // 下载Excel文件
                $model->writeExcel($title, $data);
                
                Yii::app()->end();
            } else {
                $this->render('report', array('model' => $model));
            }
        } else {
            $model->exam_id = MExams::model()->getAllExamIds();
            $model->subject_id = MSubjects::model()->getAllSubjectIds();
            
            $this->render('report', array('model' => $model));
        }
    }
    
    public function actionTestData() {
        $class_ids = array(29, 30, 31);
        $class_ids = array(29);
        
        $exams = MExams::model()->findAll();
        
        $tran = Yii::app()->db->beginTransaction();
        foreach ($class_ids as $class_id) {
            $students = TStudentClasses::model()->findAll("class_id=:class_id", array(":class_id" =>$class_id));
            $subjects = MCourses::model()->findAll("class_id=:class_id", array(":class_id" =>$class_id));
            
            foreach ($students as $student) {
                foreach ($subjects as $subject) {
                    
                    foreach ($exams as $exam) {
                        $score = new TScores();
                        $score->exam_id= $exam->ID;
                        $score->subject_id = $subject->subject_id;
                        $score->class_id=$student->class_id;
                        $score->student_id=$student->student_id;
                        $score->student_number=$student->student_number;
                        $score->score = rand(0, 150);
                        $score->create_user = $this->getLoginUserId();
                        $score->create_time = new CDbExpression('NOW()');
                        $score->save();
                    }
                }
            }
        }
        $tran->commit();
    }
    
}
