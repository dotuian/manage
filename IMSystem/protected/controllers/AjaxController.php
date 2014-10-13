<?php

class AjaxController extends Controller {
    
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

}