<?php

/**
 * 成绩控制器
 */
class ScoreController extends BaseController {

    /**
     * 学生查询个人成绩
     * @throws CHttpException
     */
    public function actionQuery(){
        
        $student = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->getLoginUserId()));
        if (is_null($student)) {
            throw new CHttpException('500', '当前用户信息不存在！');
        }
        
        $sql = "SELECT b.code, b.name, e.class_code, e.class_name, a.exam_id, d.exam_name, c.subject_name, a.score ";
        $sql .= "FROM t_scores a ";
        $sql .= "LEFT JOIN t_students b ON a.student_id = b.ID ";
        $sql .= "LEFT JOIN m_subjects c ON a.subject_id = c.ID ";
        $sql .= "LEFT JOIN m_exams d ON a.exam_id = d.ID ";
        $sql .= "LEFT JOIN t_classes e ON a.class_id=e.id ";
        $sql .= "WHERE a.student_id=:student_id ";
        $params = array(':student_id' => $this->getLoginUserId());
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];

            if (trim($model->exam_id) !== '') {
                $sql .= " and a.exam_id = :exam_id ";
                $params[':exam_id'] = trim($model->exam_id);
            }
        }

        $sql .= "order by a.exam_id, a.create_time desc";
        
        $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
        
        // 没有数据
        if(count($data) === 0) {
            Yii::app()->user->setFlash('warning', "没有检索到相关数据！");
        }

        // 为了页面横排表示，数据整形
        $result = array();
        foreach ($data as $value) {
            $result[$value["exam_name"]][$value["subject_name"]] = $value['score'];
        }
        
        // 从成绩信息中获取又成绩的所有科目名称，用于页面的显示
        $temp = array();
        foreach ($result as $value) {
            $temp = array_merge($temp, array_keys($value));
        }
        $temp = array_unique(array_values($temp));
        
        // 用于页面显示的所有科目
        $subjects = MSubjects::model()->getSubjectsBySubjectName($temp);
                
        $this->render('query', array(
                    'model' => $model, 
                    'data' => $result,
                    'subjects' => $subjects,
                ));
    }
    
    
    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $from = " from t_scores a 
               left join t_classes b on a.class_id = b.ID
               left join t_students c on a.student_id = c.ID
               left join m_subjects d on a.subject_id = d.ID
               left join m_exams e on a.exam_id = e.ID
               where 1=1 ";
        
        $sql = "select a.*, b.class_code, b.class_name, b.class_type,b.term_year, c.code, c.name, d.subject_code,d.subject_name,d.subject_type, e.exam_code, e.exam_name $from ";
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
            if (trim($model->student_code) !== '') {
                $sql .= " and d.code like :code ";
                $countSql .= " and d.code like :code ";
                $params[':code'] = '%' . trim($model->student_code) . '%';
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
                            'asc' => 'c.code',
                            'desc' => 'c.code desc',
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
                Yii::app()->user->setFlash('warning', "没有检索到相关数据！");
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
                $subjects = null;
                if(!empty($model->subject_id)) {
                    $subjects = MSubjects::model()->findAll("ID=:ID and status='1'", array(':ID'=>$model->subject_id));
                } else {
                    if ($class->class_type == '1') {//文科
                        $subjects = MSubjects::model()->findAll("status='1' and subject_type in ('0', '1')");
                    } elseif ($class->class_type == '2') {// 理科
                        $subjects = MSubjects::model()->findAll("status='1' and subject_type in ('0', '2')");
                    } else { // 综合
                        $subjects = MSubjects::model()->findAll("status='1' and subject_type in ('0', '1', '2')");
                    }
                }

                //  获取这个班级上的所有学生
                $students = TStudents::model()->getAllStudentsByClassId($class->ID);
                
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
                $this->render('create', array('model' => $model, 'data'=>$data, 'scores'=>$scores, 'exam'=>$exam, 'class'=>$class, 'subjects'=>$subjects, 'students'=>$students));
                Yii::app()->end();
            } 
            
            Yii::log(print_r($model->errors, true));
        }

        $this->render('create', array('model' => $model));
    }

    
    public function actionInsert(){
        if (Yii::app()->request->isAjaxRequest) {
            
        }
        
        $data = array('result' => false, 'message' => '操作失败！');
        
        if(isset($_POST) && isset($_POST['class_id']) && isset($_POST['student_id']) && isset($_POST['subject_id']) && isset($_POST['exam_id']) && isset($_POST['score'])){
            $class_id = trim($_POST['class_id']);
            $student_id = trim($_POST['student_id']);
            $subject_id = trim($_POST['subject_id']);
            $exam_id = trim($_POST['exam_id']);
            $score = trim($_POST['score']);

            if (!(is_numeric($score) && $score >= 0 && $score <= 150)) {
                $data['message'] = '请输入正确的分数！';
                echo json_encode($data);
                return ;
            }
            
//            $class = TClasses::model()->find("status='1' and ID=:ID", array(":ID"=>$class_id));
//            if(is_null($class)){
//                $data['message'] = '该班级信息不存在！';
//                return ;
//            }
//
//            $student = TStudents::model()->find("status='1' and ID=:ID", array(":ID"=>$student_id));
//            if(is_null($student)){
//                $data['message'] = '该学生信息不存在！';
//                return ;
//            }
//
//            $subject = MSubjects::model()->find("status='1' and ID=:ID", array(":ID"=>$subject_id));
//            if(is_null($subject)){
//                $data['message'] = '该科目信息不存在！';
//                return ;
//            }
//            
//            $exam = MExams::model()->find("status='1' and ID=:ID", array(":ID"=>$exam_id));
//            if(is_null($exam)){
//                $data['message'] = '该考试信息不存在！';
//                return ;
//            }
            
            try {
                $score_info = TScores::model()->find("exam_id=:exam_id and subject_id=:subject_id and class_id=:class_id and student_id=:student_id",
                        array(':exam_id'=>$exam_id, ':subject_id'=>$subject_id, ':class_id'=>$class_id, ':student_id'=>$student_id ));
                if (is_null($score_info)) {
                    // 不存在的情况下，新加一条数据
                    $score_info = new TScores('create');
                    $score_info->exam_id = $exam_id;
                    $score_info->subject_id = $subject_id;
                    $score_info->class_id = $class_id;
                    $score_info->student_id = $student_id;
                    $score_info->score = $score;

                    $score_info->create_user = $this->getLoginUserId();
                    $score_info->update_user = $this->getLoginUserId();
                    $score_info->create_time = new CDbExpression('NOW()');
                    $score_info->update_time = new CDbExpression('NOW()');
                    
                    if ($score_info->save()) {
                        $data['result'] = true;
                        $data['message'] = '录入成功！';
                    }
                } else {
                    // 存在的情况下，更新
                    $score_info->score = $score;
                    $score_info->update_user = $this->getLoginUserId();
                    $score_info->update_time = new CDbExpression('NOW()');
                    if ($score_info->save()) {
                        $data['result'] = true;
                        $data['message'] = '变更成功！';
                    }
                }
                
            }  catch (Exception $e) {
                $data['message'] = '系统异常！';
                throw new CHttpException(404, "系统异常！");
            }
            
            echo json_encode($data);
        }
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
                        Yii::app()->user->setFlash('success', "成绩信息变更成功！");
                    } else {
                        Yii::log(print_r($score->errors, true));
                        Yii::app()->user->setFlash('warning', "成绩信息变更失败！");
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
                Yii::app()->user->setFlash('success', "成绩信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($score->errors, true));
                Yii::app()->user->setFlash('warning', "成绩信息删除失败！");
            }

            $this->render('update', array(
                'model' => $score,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    public function actionClass() {
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            $model->scenario = 'search_class_score';
            
            if ($model->validate()) {
                $sql = "select a.code, a.name, c.exam_name, d.subject_code, d.subject_name, d.subject_short_name, b.score ";
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
                $sql .= "order by a.code, c.ID, d.level";

                $data = Yii::app()->db->createCommand($sql)->queryAll(true,$params);

                // 成绩表示，数据整形
                $dataProvider = null;
                foreach ($data as $value) {
                    $dataProvider[$value['code'].'|'.$value['name']][$value['exam_name']][$value['subject_name']] = $value['score'];
                }

                Yii::log(print_R($dataProvider, true));

                if($model->subject_id != '') {
                    // 该班级全部的科目成绩
                    $subjects = MCourses::model()->getCoursesByClassId($model->class_id);
                } else {
                    // 该班级指定科目的成绩
                    $subjects = MSubjects::model()->findAll('ID=:ID', array(':ID'=>$model->subject_id));
                }
                $subjects = MCourses::model()->getCoursesByClassId($model->class_id);

                $this->render('class', array('model' => $model, 'data' => $dataProvider, 'subjects' => $subjects));
                
            } else {
                $this->render('class', array('model' => $model));
            } 
        } else {
            $this->render('class', array('model' => $model));
        }

    }

}
