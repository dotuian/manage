<?php

/**
 * 班级控制器
 */
class ClassController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'class');
    }
    
    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $sql = "select a.*, b.name as teacher_name from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
        $countSql = "select count(*) from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
        $params = array();
        
        $model = new ClassForm();
        $model->term_year = date('Y');
        if (isset($_GET['ClassForm'])) {
            $model->attributes = $_GET['ClassForm'];
            
            if (trim($model->class_code) !== '') {
                $sql .= " and a.class_code like :class_code ";
                $countSql .= " and a.class_code like :class_code ";
                $params[':class_code'] = '%' . trim($model->class_code) . '%';
            }
            if (trim($model->class_name) !== '') {
                $sql .= " and a.class_name like :class_name ";
                $countSql .= " and a.class_name like :class_name ";
                $params[':class_name'] = '%' . trim($model->class_name) . '%';
            }
            if (trim($model->class_type) !== '') {
                $sql .= " and a.class_type = :class_type ";
                $countSql .= " and a.class_type = :class_type ";
                $params[':class_type'] = trim($model->class_type);
            }
            if (trim($model->status) !== '') {
                $sql .= " and a.status = :status ";
                $countSql .= " and a.status = :status ";
                $params[':status'] = trim($model->status);
            }
            if (trim($model->term_year) !== '') {
                $sql .= " and a.term_year=:term_year ";
                $countSql .= " and a.term_year=:term_year ";
                $params[':term_year'] = trim($model->term_year);
            }
            if (trim($model->teacher_id) !== '') {
                $sql .= " and a.teacher_id = :teacher_id ";
                $countSql .= " and a.teacher_id = :teacher_id ";
                $params[':teacher_id'] = trim($model->teacher_id);
            }
        }

        $count = Yii::app()->db->createCommand($countSql)->queryScalar($params);
        $dataProvider = new CSqlDataProvider($sql, array(
            'params' => $params,
            'keyField' => 'ID',
            'totalItemCount' => $count,
            'sort' => array(
                'attributes' => array(
                    'user' => array(
                        'asc' => 'a.class_code',
                        'desc' => 'a.class_code desc',
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
        
        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => $dataProvider,
                ));
    }
    
    
    /**
     * 添加班级信息
     */
    public function actionCreate() {

        $model = new ClassForm('add');
        $model->term_year = date('Y');
        
        if (isset($_POST['ClassForm'])) {
            $model->attributes = $_POST['ClassForm'];
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $class = new TClasses();
                    $class->class_code = $model->class_code;
                    $class->class_name = $model->class_name;
                    $class->status = $model->status;
                    $class->term_year = $model->term_year;
                    $class->teacher_id = $model->teacher_id;
                    
                    $class->create_user = $this->getLoginUserId();
                    $class->update_user = $this->getLoginUserId();
                    $class->create_time = new CDbExpression('NOW()');
                    $class->update_time = new CDbExpression('NOW()');
                    
                    if ($class->save()) {
                        $tran->commit();
                        Yii::app()->user->setFlash('success', "班级信息添加成功！");
                        $this->redirect($this->createUrl('create'));
                    } else {
                        Yii::log(print_r($class->errors, true));
                        Yii::app()->user->setFlash('warning', "班级信息添加失败！");
                    }
                } catch (Exception $e) {
                    throw new CHttpException(400, "系统异常！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }
    
    
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            
            $student = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(400, "该班级信息不存在！");
            }

            if (isset($_POST['TClasses'])) {
                $student->class_name = trim($_POST['TClasses']['class_name']);
                $student->class_type = trim($_POST['TClasses']['class_type']);
                $student->status = trim($_POST['TClasses']['status']);
                $student->term_year = trim($_POST['TClasses']['term_year']);
                $student->teacher_id = trim($_POST['TClasses']['teacher_id']);

                $student->update_user = $this->getLoginUserId();
                $student->update_time = new CDbExpression('NOW()');

                if ($student->save()) {
                    Yii::app()->user->setFlash('success', "班级信息变更成功！");
                } else {
                    Yii::log(print_r($student->errors, true));
                    Yii::app()->user->setFlash('warning', "班级信息变更失败！");
                }
            }

            $this->render('update', array(
                'model' => $student,
            ));
        } else {
            throw new CHttpException(400, "找不到该页面！");
        }
    }
    
    
}