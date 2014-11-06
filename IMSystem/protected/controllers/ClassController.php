<?php

/**
 * 班级控制器
 */
class ClassController extends BaseController {
    
    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $sql = "select a.*, b.name as teacher_name from t_classes a left join t_teachers b on a.teacher_id=b.ID where a.status=:status ";
        $countSql = "select count(*) from t_classes a left join t_teachers b on a.teacher_id=b.ID where a.status=:status ";
        $condition = '';
        
        $model = new ClassForm();
        $model->status = '1';
        
        $params = array();
        $params[':status'] = trim($model->status);
        
        if (isset($_GET['ClassForm'])) {
            $model->attributes = $_GET['ClassForm'];
            // 检索条件
            if (trim($model->class_code) !== '') {
                $condition .= " and a.class_code like :class_code ";
                $params[':class_code'] = '%' . trim($model->class_code) . '%';
            }
            // 
            if (trim($model->class_name) !== '') {
                $condition .= " and a.class_name like :class_name ";
                $params[':class_name'] = '%' . trim($model->class_name) . '%';
            }
            // 年级
            if (trim($model->grade) !== '') {
                $condition .= " and a.grade = :grade ";
                $params[':grade'] = trim($model->grade);
            }
            // 入学年份
            if (trim($model->entry_year) !== '') {
                $condition .= " and a.entry_year = :entry_year ";
                $params[':entry_year'] = trim($model->entry_year);
            }
            // 学期
            if (trim($model->term_type) !== '') {
                $condition .= " and a.term_type = :term_type ";
                $params[':term_type'] = trim($model->term_type);
            }
            // 班级性质
            if (trim($model->class_type) !== '') {
                $condition .= " and a.class_type = :class_type ";
                $params[':class_type'] = trim($model->class_type);
            }
            // 专业名称
            if (trim($model->specialty_name) !== '') {
                $condition .= " and a.specialty_name like :specialty_name ";
                $params[':specialty_name'] = '%' . trim($model->specialty_name) . '%';
            }
            if (trim($model->status) !== '') {
                $condition .= " and a.status = :status ";
                $params[':status'] = trim($model->status);
            }
            if (trim($model->teacher_id) !== '') {
                $condition .= " and a.teacher_id = :teacher_id ";
                $params[':teacher_id'] = trim($model->teacher_id);
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
            $this->setWarningMessage("没有检索到相关数据！");
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
        $model->entry_year = date('Y');
        
        if (isset($_POST['ClassForm'])) {
            $model->attributes = $_POST['ClassForm'];
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $class = new TClasses();
                    $class->class_code = trim($model->class_code);
                    $class->class_name = trim($model->class_name);
                    $class->entry_year = intval($model->entry_year);
                    $class->term_type = trim($model->term_type);
                    $class->class_type = trim($model->class_type); // 班级类型(0:普通高中 1:技能专业)
                    $class->specialty_name = trim($model->specialty_name); // 专业名称
                    $class->status = '1'; // 新建正常状态的班级信息
                    $class->teacher_id = intval($model->teacher_id);
                    
                    $class->create_user = $this->getLoginUserId();
                    $class->update_user = $this->getLoginUserId();
                    $class->create_time = new CDbExpression('NOW()');
                    $class->update_time = new CDbExpression('NOW()');
                    
                    if ($class->save()) {
                        $tran->commit();
                        $this->setSuccessMessage("班级信息添加成功！");
                        $this->redirect($this->createUrl('create'));
                    } else {
                        Yii::log(print_r($class->errors, true));
                        $this->setErrorMessage("班级信息添加失败！");
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
                $class->entry_year = trim($_POST['TClasses']['entry_year']);
                $class->teacher_id = trim($_POST['TClasses']['teacher_id']);

                $class->update_user = $this->getLoginUserId();
                $class->update_time = new CDbExpression('NOW()');
                
                if ($class->validate()) {
                    if ($class->save()) {
                        $this->setSuccessMessage("班级信息变更成功！");
                    } else {
                        Yii::log(print_r($class->errors, true));
                        $this->setErrorMessage("班级信息变更失败！");
                    }
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

            if ($model->validate()) {
                $new_class = TClasses::model()->exists("ID=:ID and status='1'", array(":ID" => $this->new_class_id));
                
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $count = 0;
                    // 获取旧班级中所有学生班级的信息
                    $studentClass = TStudentClasses::model()->findAll("class_id=:class_id and `status`='1'", array(':class_id'=>$model->old_class_id));
                    foreach ($studentClass as $value) {
                        $value->status = '2'; //暂停状态
                        $value->update_user = $this->getLoginUserId();
                        $value->update_time = new CDbExpression('NOW()');

                        $new = new TStudentClasses();
                        $new->student_id = $value->student_id;
                        $new->class_id = $model->new_class_id;
                        $new->status = '1'; // 正常状态
                        $new->create_user = $this->getLoginUserId();
                        $new->update_user = $this->getLoginUserId();
                        $new->create_time = new CDbExpression('NOW()');
                        $new->update_time = new CDbExpression('NOW()');

                        if ($value->save(false) && $new->save(false)) {
                            $count++;
                        }
                    }

                    $tran->commit();
                    Yii::app()->user->setFlash('success', "升级处理成功！一共{$count}个学生班级信息变更成功！");
                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }

        $this->render('upgrade', array('model' => $model));
    }

    public function actionStudent(){
        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            
            $class = TClasses::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }

            $students = TStudents::model()->findAllBySQL("select DISTINCT a.* from t_students a, t_student_classes b where a.ID=b.student_id and b.class_id=:class_id", array(':class_id'=>$class->ID));

            $this->render('student', array(
                'students' => $students,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
}