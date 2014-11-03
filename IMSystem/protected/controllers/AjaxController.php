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
                $data = MExams::model()->findAll('ID in (select DISTINCT a.exam_id from t_scores a where a.class_id=:class_id)', array(':class_id' => $class_id));
                foreach ($data as $value) {
                    echo CHtml::tag('option', array('value' => $value['ID']), CHtml::encode($value['exam_name']), true);
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
}