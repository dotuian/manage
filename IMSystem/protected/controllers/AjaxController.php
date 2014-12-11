<?php

class AjaxController extends BaseController {
    
	/**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('@'), // 允许所有验证用户
            ),
            array('deny',
                'users' => array('*'), // 拒绝所有用户
            ),
        );
    }

    protected function beforeAction($action) {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(404, '您所访问的页面找不到！');
        }

        return true;
    }

    /**
     * 通过科目ID获取教师信息
     */
    public function actionGetTeachersBySubjectId() {

        if (isset($_POST['subject_id']) && is_numeric($_POST['subject_id'])) {
            $subject_id = trim($_POST['subject_id']);
            $allowempty = isset($_POST['allowempty']) && is_bool($_POST['allowempty']) ? $_POST['allowempty'] : true ;

            // 
            $sql = "select a.ID, a.name from t_teachers a , t_teacher_subjects b , m_subjects c ";
            $sql .= "where a.ID=b.teacher_id and b.subject_id = c.ID and c.status='1' and a.status='1' and c.ID=:subject_id";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindValue(":subject_id", $subject_id);
            $data = $command->query();
            
            if($allowempty){
                echo CHtml::tag('option', array('value'=> ''),CHtml::encode(yii::app()->params['EmptySelectOption']),true);
            }
            
            foreach($data as $value){
                echo CHtml::tag('option', array('value'=>$value['ID']),CHtml::encode($value['name']),true);
            }
        }
    }

    /**
     * 根据角色，来获取可以查询科目的列表
     */
    public function actionGetScoreSubjectOption() {
        if (isset($_POST['class_id']) && is_numeric($_POST['class_id'])) {
            $user_id = Yii::app()->user->getState('ID'); // 
            $class_id = trim($_POST['class_id']);

            $data = MSubjects::model()->getSubjectInfoByUserIdAndClassId($user_id, $class_id);

            echo CHtml::tag('option', array('value'=> ''),CHtml::encode('所有科目'),true);
            
            foreach ($data as $value) {
                echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['subject_name']), true);
            }
        }
    }
    
    /**
     * 班级成绩查询页面，考试名称
     */
    public function actionGetExamOption() {
        if (isset($_POST['class_id'])) {
            echo CHtml::tag('option', array('value' => ''), CHtml::encode(yii::app()->params['EmptySelectOption']), true);

            if (is_numeric($_POST['class_id'])) {
                $class_id = trim($_POST['class_id']);
                $sql = "select DISTINCT a.* from m_exams a inner join t_scores b on a.ID=b.exam_id and b.class_id=:class_id ";
                $data = MExams::model()->findAllBySql($sql, array(':class_id' => $class_id));
                foreach ($data as $value) {
                    echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['exam_name']), true);
                }
            }
        }
    }
    
    /**
     * 班级成绩查询页面，考试名称
     */
    public function actionGetSubjectOption() {
        if (isset($_POST['class_id'])) {
            echo CHtml::tag('option', array('value' => ''), CHtml::encode(yii::app()->params['EmptySelectOption']), true);

            if (is_numeric($_POST['class_id'])) {
                $class_id = trim($_POST['class_id']);
                $sql = "select a.* from m_subjects a inner join m_courses b on a.ID=b.subject_id where b.class_id=:class_id ";
                $data = MSubjects::model()->findAllBySql($sql, array(':class_id' => $class_id));
                foreach ($data as $value) {
                    echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['subject_name']), true);
                }
            }
        }
    }

    /***
     * 根据年级获取改年级说对应的所有班级
     */
    public function actionGetClassOptionByGrade(){
        if (isset($_POST['grade'])) {
            echo CHtml::tag('option', array('value' => ''), CHtml::encode(yii::app()->params['EmptySelectOption']), true);

            if (is_numeric($_POST['grade'])) {
                $grade = trim($_POST['grade']);
                $data = TClasses::model()->findAll("grade=:grade and status='1'", array(':grade'=>$grade));
                foreach ($data as $value) {
                    echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['class_name']), true);
                }
            }
        }
        
    }
    
    public function actionGetClassOptionByGradeAndEntryYear(){
        if (isset($_POST['grade']) && isset($_POST['entry_year']) && isset($_POST['class_type'])) {
            echo CHtml::tag('option', array('value' => ''), CHtml::encode(yii::app()->params['EmptySelectOption']), true);

            if (is_numeric($_POST['grade']) && is_numeric($_POST['entry_year'])) {
                $grade = trim($_POST['grade']);
                $entry_year = trim($_POST['entry_year']);
                $class_type = trim($_POST['class_type']);
                
                if(trim(isset($_POST['class_type'])) != '') {
                    $data = TClasses::model()->findAll("grade=:grade and entry_year=:entry_year and class_type=:class_type", 
                            array(':grade'=>$grade, ':entry_year'=>$entry_year, ':class_type'=>$class_type));
                } else {
                    $data = TClasses::model()->findAll("grade=:grade and entry_year=:entry_year", array(':grade'=>$grade, ':entry_year'=>$entry_year));
                }
                
                foreach ($data as $value) {
                    echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['class_name']), true);
                }
            }
        }
    }
    
    
    /**
     * 学生成绩录入
     * @return type
     * @throws CHttpException
     */
    public function actionInsertScore(){
        
        $data = array('result' => false, 'message' => '操作失败！');
        
        if(isset($_POST) && isset($_POST['class_id']) && isset($_POST['student_id']) && isset($_POST['subject_id']) && isset($_POST['exam_id']) && isset($_POST['score']) && isset($_POST['student_number'])){
            $class_id = trim($_POST['class_id']);
            $student_id = trim($_POST['student_id']);
            $subject_id = trim($_POST['subject_id']);
            $exam_id = trim($_POST['exam_id']);
            $score = trim($_POST['score']);
            $student_number = trim($_POST['student_number']);

            if (!(is_numeric($score) && $score >= 0 && $score <= 150)) {
                $data['message'] = '请输入正确的分数！';
                echo json_encode($data);
                return ;
            }
            
            try {
                $score_info = TScores::model()->find("exam_id=:exam_id and subject_id=:subject_id and class_id=:class_id and student_id=:student_id and student_number=:student_number",
                        array(':exam_id'=>$exam_id, ':subject_id'=>$subject_id, ':class_id'=>$class_id, ':student_id'=>$student_id, ':student_number'=>$student_number));
                if (is_null($score_info)) {
                    // 不存在的情况下，新加一条数据
                    $score_info = new TScores('create');
                    $score_info->exam_id = $exam_id;
                    $score_info->subject_id = $subject_id;
                    $score_info->class_id = $class_id;
                    $score_info->student_id = $student_id;
                    $score_info->student_number = $student_number; // 学号
                    $score_info->score = $score; // 学生成绩
                    $score_info->create_user = $this->getLoginUserId();
                    $score_info->create_time = new CDbExpression('NOW()');
                    
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
    
    /**
     * 课程安排
     * @return type
     * @throws CHttpException
     */
    public function actionInsertCourse() {
        if (!Yii::app()->request->isAjaxRequest) {
            return;
        }
        
        $data = array('result' => false, 'message' => '操作失败！');
        
        if (isset($_POST['class_id']) && isset($_POST['subject_id']) && isset($_POST['teacher_id'])) {
            $class_id = trim($_POST['class_id']);
            $subject_id = trim($_POST['subject_id']);
            $teacher_id = trim($_POST['teacher_id']);

            try {
                // 判断该课程是否已经存在
                $course = MCourses::model()->find("class_id=:class_id and subject_id=:subject_id and status='1'",array(':subject_id' => $subject_id, ':class_id' => $class_id));
                
                // 删除
                if(empty($teacher_id)) {
                    if (is_null($course)) {
                        $data['message'] = '课程不存在，无法删除！';
                    } else {
                        if ($course->delete()) {
                            $data['result'] = true;
                            $data['message'] = '删除成功！';
                        }
                    }
                }
                // 添加/修改任课教师
                else if ($teacher_id != '') {
                    if (is_null($course)) {
                        $course = new MCourses();
                        $course->class_id   = $class_id;
                        $course->subject_id = $subject_id;
                        $course->teacher_id = $teacher_id;
                        $course->status = '1';
                        $course->create_user = $this->getLoginUserId();
                        $course->update_user = $this->getLoginUserId();
                        $course->create_time = new CDbExpression('NOW()');
                        $course->update_time = new CDbExpression('NOW()');                    
                    } else {
                        $course->teacher_id = $teacher_id;
                        $course->update_user = $this->getLoginUserId();
                        $course->update_time = new CDbExpression('NOW()');
                    }

                    if ($course->save()) {
                        $data['result'] = true;
                        $data['message'] = '操作成功！';
                    }
                }
                
            } catch (Exception $e) {
                $data['message'] = '系统异常！';
                throw new CHttpException(404, "系统异常！");
            }
        }
        
        echo json_encode($data);
    }
    
}