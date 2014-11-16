<?php

/**
 * 科目控制器
 */
class SubjectController extends BaseController {
    
    /**
     * 查询科目信息
     */
    public function actionSearch() {
        $sql = "select a.* from m_subjects a where 1=1 ";
        $countSql = "select count(*) from m_subjects a where 1=1 ";
        $condition = '';
        $params = array();

        $model = new SubjectForm();
        if (isset($_GET['SubjectForm'])) {
            $model->attributes = $_GET['SubjectForm'];
            
            if (trim($model->subject_code) !== '') {
                $condition .= " and a.subject_code like :subject_code ";
                $params[':subject_code'] = '%' . StringUtils::escape(trim($model->subject_code)) . '%';
            }
            if (trim($model->subject_name) !== '') {
                $condition .= " and a.subject_name like :subject_name ";
                $params[':subject_name'] = '%' . StringUtils::escape(trim($model->subject_name)) . '%';
            }
            if (trim($model->subject_short_name) !== '') {
                $condition .= " and a.subject_short_name like :subject_short_name ";
                $params[':subject_short_name'] = '%' . StringUtils::escape(trim($model->subject_short_name)) . '%';
            }
            if (trim($model->subject_type) !== '') {
                $condition .= " and a.subject_type = :subject_type ";
                $params[':subject_type'] = trim($model->subject_type);
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
                        'asc' => 'a.ID',
                        'desc' => 'a.ID desc',
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
     * 添加科目信息
     */
    public function actionCreate() {

        $model = new SubjectForm('create');

        if (isset($_POST['SubjectForm'])) {
            $model->attributes = $_POST['SubjectForm'];

            if ($model->validate()) {
                $subject = new MSubjects();
                $subject->subject_code = $model->subject_code;
                $subject->subject_name = $model->subject_name;
                $subject->subject_short_name = $model->subject_short_name;
                $subject->subject_type = $model->subject_type;
                $subject->status = '1'; //状态正常
                $subject->level = 0;    // 
                $subject->total_score = $model->total_score;    // 
                $subject->pass_score = $model->pass_score;    // 
                
                $subject->create_user = $this->getLoginUserId();
                $subject->update_user = $this->getLoginUserId();
                $subject->create_time = new CDbExpression('NOW()');
                $subject->update_time = new CDbExpression('NOW()');

                if ($subject->save(false)) {
                    $this->setSuccessMessage("科目信息添加成功！");
                    $this->redirect($this->createUrl('create'));
                } else {
                    Yii::log(print_r($subject->errors, true));
                    $this->setErrorMessage("科目信息添加失败！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            
            $subject = MSubjects::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($subject)) {
                throw new CHttpException(404, "该科目信息不存在！");
            }

            if (isset($_POST['MSubjects'])) {
                $subject->subject_code       = trim($_POST['MSubjects']['subject_code']);
                $subject->subject_name       = trim($_POST['MSubjects']['subject_name']);
                $subject->subject_short_name = trim($_POST['MSubjects']['subject_short_name']);
                $subject->subject_type       = trim($_POST['MSubjects']['subject_type']);
                $subject->total_score        = trim($_POST['MSubjects']['total_score']);
                $subject->pass_score         = trim($_POST['MSubjects']['pass_score']);
                $subject->status             = trim($_POST['MSubjects']['status']);
                
                $subject->update_user = $this->getLoginUserId();
                $subject->update_time = new CDbExpression('NOW()');
                if($subject->validate()) {
                    if ($subject->save()) {
                        $this->setSuccessMessage("科目信息变更成功！");
                    } else {
                        Yii::log(print_r($subject->errors, true));
                        $this->setErrorMessage("科目信息变更失败！");
                    }
                }
            }

            $this->render('update', array(
                'model' => $subject,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
 

    public function actionDelete() {

        if (isset($_POST['ID'])) {
            
            $ID = trim($_POST['ID']);
            $subject = MSubjects::model()->find("ID=:ID and status='1' ", array(":ID" => $ID));
            if (is_null($subject)) {
                throw new CHttpException(404, "该科目信息不存在！");
            }
            
            $subject->status = '2';
            $subject->update_user = $this->getLoginUserId();
            $subject->update_time = new CDbExpression('NOW()');
            if ($subject->save(false)) {
                $this->setSuccessMessage("科目信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($subject->errors, true));
                $this->setErrorMessage("科目信息删除失败！");
            }

            $this->render('update', array(
                'model' => $subject,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

    
    
    
}