<?php

/**
 * 课程控制器
 */
class CourseController extends BaseController {

    public function actionSearch() {
        
        $model = new CourseForm();
        if (isset($_GET['CourseForm'])) {
            $model->attributes = $_GET['CourseForm'];
            
            $sql = "select a.ID, a.status, b.subject_code, b.subject_name, b.subject_type, c.class_code, c.class_name, c.class_type, d.code as teacher_code, d.name as teacher_name ";
            $countSql = "select count(*) ";

            $condition = " FROM m_courses a ";
            $condition .= " LEFT JOIN m_subjects b ON a.subject_id =b.ID AND b.status='1' ";
            $condition .= " inner JOIN t_classes c ON a.class_id =c.ID AND c.status='1' ";
            $condition .= " inner JOIN t_teachers d ON a.teacher_id =d.ID AND d.status='1' ";
            $condition .= " WHERE a.status='1' ";
            
            $params = array();
            
            if (trim($model->class_code) !== '') {
                $condition .= " and c.class_code = :class_code ";
                $params[':class_code'] = trim($model->class_code);
            }
            if (trim($model->class_id) !== '') {
                $condition .= " and a.class_id = :class_id ";
                $params[':class_id'] = trim($model->class_id);
            }
            if (trim($model->subject_id) !== '') {
                $condition .= " and a.subject_id = :subject_id ";
                $params[':subject_id'] = trim($model->subject_id);
            }
//            if (trim($model->teacher_id) !== '') {
//                $condition .= " and d.code = :teacher_id ";
//                $params[':teacher_id'] = trim($model->teacher_id);
//            }
            if (trim($model->teacher_name) !== '') {
                $condition .= " and d.name like :teacher_name ";
                $params[':teacher_name'] = '%' . trim($model->teacher_name) . '%';
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
                            'asc' => 'a.subject_id',
                            'desc' => 'a.subject_id desc',
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
                $this->setWarningMessage('没有检索到相关数据！');
            }
        }

        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => isset($dataProvider) ? $dataProvider : null,
                ));
    }
    
    
    public function actionCreate() {

        $model = new CourseForm();
        $model->type = '1';
        
        if (isset($_POST['CourseForm'])) {
            $model->attributes = $_POST['CourseForm'];
            
            if($model->validate()){
                $class = TClasses::model()->find("status='1' and ID=:ID", array(":ID"=>$model->class_id));
                if(is_null($class)){
                    throw new CHttpException('500', '该班级信息不存在！');
                }

                $criteria = new CDbCriteria();
                $criteria->addCondition("status='1'");
                $criteria->addInCondition('ID', array_values($model->subjects));
                $subjects = MSubjects::model()->findAll($criteria);

                // 所有的教师信息
                $teachers = TTeachers::model()->findAll("status='1' and code<>'root' ");

                // 收集页面数据
                $data = new MCourses();

                $this->render('create', array('model' => $model, 'data'=>$data, 'class'=>$class, 'subjects'=>$subjects, 'teachers'=>$teachers));
            } else {
                $this->render('create', array('model' => $model));
            }
        } else {
            $this->render('create', array('model' => $model));
        }
        
    }
    
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            $course = MCourses::model()->find("ID=:ID and status='1' ", array(":ID" => $ID));
            if (is_null($course)) {
                throw new CHttpException(404, "该课程信息不存在！");
            }
            
            if (isset($_POST['MCourses'])) {
                $course->teacher_id  = trim($_POST['MCourses']['teacher_id']);
                $course->update_user = $this->getLoginUserId();
                $course->update_time = new CDbExpression('NOW()');
                
                if ($course->save()) {
                    $this->setSuccessMessage("课程信息变更成功！");
                } else {
                    Yii::log(print_r($course->errors, true));
                    $this->setErrorMessage("课程信息变更失败！");
                }
            }

            $this->render('update', array(
                'model' => $course,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    public function actionDelete() {

        if (isset($_POST['ID'])) {
            
            $ID = trim($_POST['ID']);
            $course = MCourses::model()->find("ID=:ID and status='1' ", array(":ID" => $ID));
            if (is_null($course)) {
                throw new CHttpException(404, "该课程信息不存在！");
            }
            
            $course->status = '2';
            $course->update_user = $this->getLoginUserId();
            $course->update_time = new CDbExpression('NOW()');
            
            if ($course->save(false)) {
                $this->setSuccessMessage("课程信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($course->errors, true));
                $this->setErrorMessage("课程信息删除失败！");
            }

            $this->render('update', array(
                'model' => $course,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
 
    /**
     * 普通教师查看对应班级的课程教师安排
     * @throws CHttpException
     */
    public function actionClass() {
        
        $model = new CourseForm();
        
        if (isset($_POST['CourseForm'])) {
            $model->attributes = $_POST['CourseForm'];
            
            $class = TClasses::model()->find("Id=:ID", array(':ID' => $model->class_id));
            if (is_null($class)) {
                throw new CHttpException(404, "该班级信息不存在！");
            }
            
            $sql = "select d.*, b.subject_name, c.name from m_courses a
                    inner join m_subjects b on a.subject_id=b.ID and b.`status`='1'
                    inner join t_teachers c on a.teacher_id=c.ID and c.`status`='1'
                    inner join t_classes  d on a.class_id = d.ID and d.`status`='1'
                    where a.`status`='1' and a.class_id=:class_id ";

            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->bindValue(":class_id", $model->class_id);
            $command->order("d.ID asc , b.level asc ");
            $data = $command->queryAll();
            
            if(count($data) == 0) {
                $this->setWarningMessage("没有班级的课程安排信息！");
            }
        }

        $this->render('class', array(
            'model' => $model,
            'class'  => isset($class) ? $class : null,
            'data'   => isset($data)  ? $data  : null,
        ));
    }
    
    
}