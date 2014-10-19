<?php

/**
 * 成绩控制器
 */
class ScoreController extends Controller {

    /**
     * 学生查询个人成绩
     * @throws CHttpException
     */
    public function actionQuery(){
        
        $student = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->getLoginUserId()));
        if (is_null($student)) {
            throw new CHttpException('500', '当前用户信息不存在！');
        }
        
        $subjects = MSubjects::model()->findAll("status='1' order by level");

        $sql = "select d.exam_name, c.subject_name, b.code, b.name, ";
        $sql .= " sum(case c.subject_name when '语文' then a.score else null end) as '语文',";
        $sql .= " sum(case c.subject_name when '数学' then a.score else null end) as '数学',";
        $sql .= " sum(case c.subject_name when '英语' then a.score else null end) as '英语',";
        $sql .= " sum(case c.subject_name when '物理' then a.score else null end) as '物理',";
        $sql .= " sum(case c.subject_name when '化学' then a.score else null end) as '化学',";
        $sql .= " sum(case c.subject_name when '生物' then a.score else null end) as '生物',";
        $sql .= " sum(case c.subject_name when '政治' then a.score else null end) as '政治',";
        $sql .= " sum(case c.subject_name when '历史' then a.score else null end) as '历史',";
        $sql .= " sum(case c.subject_name when '地理' then a.score else null end) as '地理' ";
        $sql .= "from t_scores a ";
        $sql .= "left join t_students b on a.student_id = b.ID ";
        $sql .= "left join m_subjects c on a.subject_id = c.ID ";
        $sql .= "left join m_exams d on a.exam_id = d.ID ";
        $sql .= "where a.student_id=:student_id ";
        $params = array(':student_id' => $this->getLoginUserId());
        
        $model = new ScoreForm();
        if (isset($_GET['ScoreForm'])) {
            $model->attributes = $_GET['ScoreForm'];
            
            if (trim($model->exam_id) !== '') {
                $sql .= " and a.exam_id = :exam_id ";
                $params[':exam_id'] = trim($model->exam_id);
            }
        }

        $sql .= "group by a.student_id, a.exam_id ";
        
        $data = Yii::app()->db->createCommand($sql)->queryAll(true, $params);
        
        // 没有数据
        if(count($data) === 0) {
            Yii::app()->user->setFlash('warning', "没有检索到相关数据！");
        }
        
        $this->render('query', array(
                    'model' => $model, 
                    'data' => $data,
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
                $students = TStudents::model()->findAll("class_id=:class_id and status='1'", array(':class_id'=>$class->ID));
                
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
    
    
    public function actionClass(){
        
        $model = new ScoreForm();
        
        
        $this->render('class', array('model' => $model, 'dataProvider'=>null));
    }
    
}
