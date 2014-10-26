<?php

/**
 * 课程控制器
 */
class CourseController extends BaseController {

    // 未完了
    public function actionSearch() {
        
        
        $model = new CourseForm();
        if (isset($_GET['CourseForm'])) {
            $model->attributes = $_GET['CourseForm'];
            
            $sql = "select a.ID, a.status, b.subject_code, b.subject_name, b.subject_type, c.class_code, c.class_name, c.class_type, d.code as teacher_code, d.name as teacher_name from m_courses a left join m_subjects b on a.subject_id =b.ID and b.status='1' left join t_classes c  on a.class_id =c.ID and c.status='1' left join t_teachers d on a.teacher_id =d.ID and d.status='1' where a.status='1'";
            $countSql = "select count(*) from m_courses a left join m_subjects b on a.subject_id =b.ID and b.status='1' left join t_classes c  on a.class_id =c.ID and c.status='1' left join t_teachers d on a.teacher_id =d.ID and d.status='1' where a.status='1'";
            $params = array();
            $condition = '';
            
            if (trim($model->subject_id) !== '') {
                $condition .= " and a.subject_id = :subject_id ";
                $params[':subject_id'] = trim($model->subject_id);
            }
            if (trim($model->teacher_id) !== '') {
                $condition .= " and d.code = :teacher_id ";
                $params[':teacher_id'] = trim($model->teacher_id);
            }
            if (trim($model->teacher_name) !== '') {
                $condition .= " and d.name like :teacher_name ";
                $params[':teacher_name'] = '%' . trim($model->teacher_name) . '%';
            }
            if (trim($model->class_id) !== '') {
                $condition .= " and a.class_id = :class_id ";
                $params[':class_id'] = trim($model->class_id);
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
                $teachers = TTeachers::model()->findAll("status='1'");

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
    
    public function actionInsert() {
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
                    
                    if (!is_null($course) && $course->delete()) {
                        $data['result'] = true;
                        $data['message'] = '删除成功！';
                    }
                }
                // 添加/修改任课教师
                else if ($teacher_id != '') {
                    if (is_null($course)) {
                        $course = new MCourses();
                        $course->class_id = $class_id;
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
    
    
//    public function actionCreate() {
//
//        $model = new CourseForm('create');
//        
//        if (isset($_POST['CourseForm'])) {
//            $model->attributes = $_POST['CourseForm'];
//            if ($model->validate()) {
//                try {
//                    $courses = new MCourses();
//                    $courses->class_id = $model->class_id;
//                    $courses->subject_id = $model->subject_id;
//                    $courses->teacher_id = $model->teacher_id;
//                    $courses->status = '1';
//                    $courses->create_user = $this->getLoginUserId();
//                    $courses->update_user = $this->getLoginUserId();
//                    $courses->create_time = new CDbExpression('NOW()');
//                    $courses->update_time = new CDbExpression('NOW()');
//                    
//                    if ($courses->save()) {
//                        Yii::app()->user->setFlash('success', "课程信息添加成功！");
//                        $this->redirect($this->createUrl('create'));
//                    } else {
//                        Yii::log(print_r($courses->errors, true));
//                        Yii::app()->user->setFlash('warning', "课程信息添加失败！");
//                    }
//                } catch (Exception $e) {
//                    throw new CHttpException(404, "系统异常！");
//                }
//            }
//        }
//
//        $this->render('create', array('model' => $model));
//    }
//    
    
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
                    Yii::app()->user->setFlash('success', "课程信息变更成功！");
                } else {
                    Yii::log(print_r($course->errors, true));
                    Yii::app()->user->setFlash('warning', "课程信息变更失败！");
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
            if ($course->save()) {
                Yii::app()->user->setFlash('success', "课程信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($course->errors, true));
                Yii::app()->user->setFlash('warning', "课程信息删除失败！");
            }

            $this->render('update', array(
                'model' => $course,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
}