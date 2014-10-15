<?php

/**
 * 班级控制器
 */
class ClassController extends Controller {
    
    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $model = new ClassForm();
        $model->term_year = date('Y');
        if (isset($_GET['ClassForm'])) {
            $model->attributes = $_GET['ClassForm'];
            
            $sql = "select a.*, b.name as teacher_name from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
            $countSql = "select count(*) from t_classes a left join t_teachers b on a.teacher_id=b.ID where 1=1 ";
            $params = array();
            $condition = '';
            
            if (trim($model->class_code) !== '') {
                $condition .= " and a.class_code like :class_code ";
                $params[':class_code'] = '%' . trim($model->class_code) . '%';
            }
            if (trim($model->class_name) !== '') {
                $condition .= " and a.class_name like :class_name ";
                $params[':class_name'] = '%' . trim($model->class_name) . '%';
            }
            if (trim($model->class_type) !== '') {
                $condition .= " and a.class_type = :class_type ";
                $params[':class_type'] = trim($model->class_type);
            }
            if (trim($model->status) !== '') {
                $condition .= " and a.status = :status ";
                $params[':status'] = trim($model->status);
            }
            if (trim($model->term_year) !== '') {
                $condition .= " and a.term_year=:term_year ";
                $params[':term_year'] = trim($model->term_year);
            }
            if (trim($model->teacher_id) !== '') {
                $condition .= " and a.teacher_id = :teacher_id ";
                $params[':teacher_id'] = trim($model->teacher_id);
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

        }

        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => isset($dataProvider) ? $dataProvider : null ,
                ));
    }
    
    
    /**
     * 添加班级信息
     */
    public function actionCreate() {

        $model = new ClassForm('create');
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
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }
    
    
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            
            $class = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }

            if (isset($_POST['TClasses'])) {
                $class->class_name = trim($_POST['TClasses']['class_name']);
                $class->class_type = trim($_POST['TClasses']['class_type']);
                $class->status = trim($_POST['TClasses']['status']);
                $class->term_year = trim($_POST['TClasses']['term_year']);
                $class->teacher_id = trim($_POST['TClasses']['teacher_id']);

                $class->update_user = $this->getLoginUserId();
                $class->update_time = new CDbExpression('NOW()');

                if ($class->save()) {
                    Yii::app()->user->setFlash('success', "班级信息变更成功！");
                } else {
                    Yii::log(print_r($class->errors, true));
                    Yii::app()->user->setFlash('warning', "班级信息变更失败！");
                }
            }

            $this->render('update', array(
                'model' => $class,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
 
    
    /**
     * 新学年的开始，学生的班级信息批量变更
     */
    public function actionUpgrade() {
        
        $model = new ClassUpgradeForm();
        
        if (isset($_POST['ClassUpgradeForm'])) {
            $model->attributes = $_POST['ClassUpgradeForm'];
            
            if($model->validate()){
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $sql = "update t_students set class_id=:new_class_id, old_class_id=:old_class_id, update_user=:update_user, update_time=now() where class_id=:old_class_id and status='1'";
                    $command = Yii::app()->db->createCommand($sql);
                    $command->bindValue(":new_class_id", $model->new_class_id);
                    $command->bindValue(":old_class_id", $model->old_class_id);
                    $command->bindValue(":update_user", $this->getLoginUserId());
                    $count = $command->execute();
                    if($count > 0 ) {
                        $tran->commit();
                        Yii::app()->user->setFlash('success', "升级处理成功！一共{$count}个学生班级信息变更成功！");
                    } else {
                        Yii::app()->user->setFlash('success', "升级处理成功！");
                    }
                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }
        
        $this->render('upgrade', array('model' => $model));
        
    }
    
    
    public function actionStulist(){
        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            
            $class = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }

            $students = TStudents::model()->findAll("class_id=:class_id and status='1'", array(':class_id'=>$class->ID));

            $this->render('stulist', array(
                'students' => $students,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
}