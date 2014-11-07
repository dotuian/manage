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

            $sql = "SELECT b.code, b.name, e.class_code, e.class_name, a.exam_id, d.exam_name, a.subject_id, c.subject_name, a.score ";
            $sql .= "FROM t_scores a ";
            $sql .= "LEFT JOIN t_students b ON a.student_id = b.ID ";
            $sql .= "LEFT JOIN m_subjects c ON a.subject_id = c.ID ";
            $sql .= "LEFT JOIN m_exams d ON a.exam_id = d.ID ";
            $sql .= "LEFT JOIN t_classes e ON a.class_id=e.id ";
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
               inner join t_student_classes f on a.class_id=f.class_id and a.student_id=a.student_id 
               where 1=1 ";
        
        $sql = "select a.*, b.class_code, b.class_name, b.class_type,b.entry_year, c.province_code, c.name, d.subject_code,d.subject_name,d.subject_type, e.exam_code, e.exam_name $from ";
        $countSql = "select count(*) $from ";
        $params = array();
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            
            if (trim($model->exam_id) !== '') {
                $sql .= " and a.exam_id = :exam_id ";
                $countSql .= " and a.exam_id = :exam_id ";
                $params[':exam_id'] = trim($model->exam_id);
            }
            if (trim($model->class_id) !== '') {
                $sql .= " and a.class_id = :class_id ";
                $countSql .= " and a.class_id = :class_id ";
                $params[':class_id'] = trim($model->class_id);
            }
            if (trim($model->subject_id) !== '') {
                $sql .= " and a.subject_id = :subject_id ";
                $countSql .= " and a.subject_id = :subject_id ";
                $params[':subject_id'] = trim($model->subject_id);
            }
            if (trim($model->student_number) !== '') {
                $sql .= " and f.student_number = :student_number ";
                $countSql .= " and f.student_number = :student_number ";
                $params[':school_number'] = trim($model->student_number);
            }
            if (trim($model->student_name) !== '') {
                $sql .= " and d.name like :name ";
                $countSql .= " and d.name like :name ";
                $params[':name'] = '%' . trim($model->student_name) . '%';
            }
            if (trim($model->score) !== '') {
                $sql .= " and a.score = :score ";
                $countSql .= " and a.score = :score ";
                $params[':score'] = trim($model->score);
            }

            $count = Yii::app()->db->createCommand($countSql)->queryScalar($params);
            $dataProvider = new CSqlDataProvider($sql, array(
                'params' => $params,
                'keyField' => 'ID',
                'totalItemCount' => $count,
                'sort' => array(
                    'attributes' => array(
                        'user' => array(
                            'asc' => 'a.create_time',
                            'desc' => 'a.create_time desc',
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
            
            $student = TStudents::model()->find("ID=:ID and status='1'", array(':ID'=>$score->student_id));
            
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
            //$model->scenario = 'class';
            
            if ($model->validate()) {
                
                $class = TClasses::model()->find("status='1' and ID=:ID", array(":ID"=>$model->class_id));

                $exam = MExams::model()->find("status='1' and ID=:ID", array(":ID"=>$model->exam_id));
                
                
                $sql = "select e.student_number, a.name, c.exam_name, d.subject_code, d.subject_name, d.subject_short_name, b.score ";
                $sql .= "from t_students a ";
                $sql .= "inner join t_student_classes e on e.student_id= a.ID ";
                $sql .= "inner join t_classes f on f.ID= e.class_id ";
                $sql .= "left join t_scores b on b.student_id= a.ID ";
                $sql .= "left join m_exams  c on c.ID =  b.exam_id  ";
                $sql .= "left join m_subjects d on d.ID = b.subject_id ";
                $sql .= "where 1=1 ";

                $params = array();
                if($model->class_id != '') {
                    $sql .= " and e.class_id=:class_id ";
                    $params[':class_id'] = trim($model->class_id);
                }
                if($model->subject_id != '') {
                    $sql .= " and b.subject_id=:subject_id ";
                    $params[':subject_id'] = trim($model->subject_id);
                }
                if($model->exam_id != '') {
                    $sql .= " and b.exam_id=:exam_id ";
                    $params[':exam_id'] = trim($model->exam_id);
                }
                // 排序（学号，考试名称，科目）
                $sql .= "order by e.student_number ";

                $data = Yii::app()->db->createCommand($sql)->queryAll(true,$params);

                // 成绩表示，数据整形
                $dataProvider = null;
                foreach ($data as $value) {
                    $dataProvider[$value['student_number'].'|'.$value['name']][$value['exam_name']][$value['subject_name']] = $value['score'];
                }

                Yii::log(print_R($dataProvider, true));

                if(empty($model->subject_id)) {
                    // 该班级全部的科目成绩
                    $subjects = $class->getClassAllSubjects();
                } else {
                    // 该班级指定科目的成绩
                    $subjects = MSubjects::model()->findAll('ID=:ID', array(':ID'=>$model->subject_id));
                }

                $this->render('class', array('model' => $model, 'data' => $dataProvider, 'subjects' => $subjects));
                
            } else {
                $this->render('class', array('model' => $model));
            } 
        } else {
            $this->render('class', array('model' => $model));
        }
    }
    
    
    public function actionAnalysis(){
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
    
}
