<?php

class TeacherController extends BaseController {

    /**
     * 查询教师信息
     */
    public function actionSearch() {
        $model = new TeacherForm();
        $model->sex = null;
        
        // SQL
        if (isset($_GET['TeacherForm'])) {
            $model->attributes = $_GET['TeacherForm'];
            
            $sql = "select DISTINCT a.* ";
            $countSql = "select count(DISTINCT a.ID) ";
            $condition = "from t_teachers a left join t_teacher_subjects b on b.teacher_id=a.ID left join m_subjects c on c.ID=b.subject_id and c.status='1' where a.status='1' ";
            $params = array();
            
            if (trim($model->code) !== '') {
                $condition .= " and a.code like :code ";
                $params[':code'] = '%' . StringUtils::escape(trim($model->code)) . '%';
            }
            if (trim($model->name) !== '') {
                $condition .= " and a.name like :name ";
                $params[':name'] = '%' . StringUtils::escape(trim($model->name)). '%';
            }
            if (trim($model->subject_id) !== '') {
                $condition .= " and c.ID=:subject_id  ";
                $params[':subject_id'] = trim($model->subject_id);
            }
            if (trim($model->sex) !== '') {
                $condition .= " and a.sex = :sex ";
                $params[':sex'] = trim($model->sex);
            }
            if (trim($model->address) !== '') {
                $condition .= " and a.address like :address ";
                $params[':address'] = '%' . StringUtils::escape(trim($model->address)) . '%';
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
            if($dataProvider->totalItemCount == 0 ) {
                $this->setWarningMessage("没有检索到相关数据！");
            }
        }
        
        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => isset($dataProvider) ? $dataProvider : null,
                ));
    }
    
    
    public function actionCreate() {

        $model = new TeacherForm('create');
        $model->sex = 'M';
        
        if (isset($_POST['TeacherForm'])) {
            
            $model->attributes = $_POST['TeacherForm'];
            
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    // 用户表信息
                    $user = new TUsers();
                    $user->username = $model->code;
                    $user->password = str_replace('-', '', $model->birthday); // 密码默认为身份证后六位
                    $user->status = '1';
                    $user->create_user = $this->getLoginUserId();
                    $user->update_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');
                    $user->update_time = new CDbExpression('NOW()');
                    
                    if ($user->save()) {
                        // 教师表信息
                        $teacher = new TTeachers();
                        $teacher->attributes = $model->attributes;
                        $teacher->ID = $user->ID;
                        $teacher->create_user = $this->getLoginUserId();
                        $teacher->update_user = $this->getLoginUserId();
                        $teacher->create_time = new CDbExpression('NOW()');
                        $teacher->update_time = new CDbExpression('NOW()');
                        if ($teacher->save()) {
                            // 角色信息
                            if(is_array($model->roles)){
                                foreach ($model->roles as $key => $value) {
                                    $userRole = new TUserRoles();
                                    $userRole->user_id = $user->ID;
                                    $userRole->role_id = $value;
                                    $userRole->create_user = $this->getLoginUserId();
                                    $userRole->update_user = $this->getLoginUserId();
                                    $userRole->create_time = new CDbExpression('NOW()');
                                    $userRole->update_time = new CDbExpression('NOW()');
                                    $userRole->save();
                                }
                            }
                            // 担任科目
                            if(is_array($model->subjects)){
                                foreach ($model->subjects as $key => $value) {
                                    $teacherSubject = new TTeacherSubjects();
                                    $teacherSubject->teacher_id = $user->ID;
                                    $teacherSubject->subject_id = $value;
                                    $teacherSubject->create_user = $this->getLoginUserId();
                                    $teacherSubject->update_user = $this->getLoginUserId();
                                    $teacherSubject->create_time = new CDbExpression('NOW()');
                                    $teacherSubject->update_time = new CDbExpression('NOW()');
                                    $teacherSubject->save();
                                }
                            }
                        
                            $tran->commit();
                            Yii::app()->user->setFlash('success', "教师信息添加成功！");
                            $this->redirect($this->createUrl('create'));
                        }
                    }
                    
                    Yii::log(print_r($user->errors, true));
                    Yii::app()->user->setFlash('warning', "教师信息添加失败！");

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
            $user = TUsers::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($user)) {
                throw new CHttpException(404, "该用户信息不存在！");
            }
            
            $teacher = TTeachers::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($teacher)) {
                throw new CHttpException(404, "该教师信息不存在！");
            }
            
            // 获取该教师用户的角色
            $teacher->roles = $user->getUserRoleIds();
            
            // 获取该教师担任的科目
            $teacher->subjects = $teacher->getTeacherSubjectIds();
            
            if (isset($_POST['TTeachers'])) {
                $tran = Yii::app()->db->beginTransaction();
                try{
                    $teacher->name = trim($_POST['TTeachers']['name']);;
                    $teacher->birthday   = empty($_POST['TTeachers']['birthday']) ? null : trim($_POST['TTeachers']['birthday']);
                    $teacher->address    = trim($_POST['TTeachers']['address']);
                    $teacher->telephonoe = trim($_POST['TTeachers']['telephonoe']);
                    $teacher->update_user = $this->getLoginUserId();
                    $teacher->update_time = new CDbExpression('NOW()');
                    if ($teacher->save()) {
                        // 删除所有与该教师关联的角色信息
                        TUserRoles::model()->deleteAll("user_id=:user_id", array(":user_id"=>$user->ID));
                        // 添加角色信息
                        $teacher->roles = is_array($_POST['TTeachers']['roles']) ? $_POST['TTeachers']['roles'] : array();
                        foreach ($teacher->roles as $role) {
                            $userRole = new TUserRoles();
                            $userRole->user_id = $user->ID;
                            $userRole->role_id = $role;
                            $userRole->create_user = $this->getLoginUserId();
                            $userRole->update_user = $this->getLoginUserId();
                            $userRole->create_time = new CDbExpression('NOW()');
                            $userRole->update_time = new CDbExpression('NOW()');
                            $userRole->save();
                        }

                        // 删除担任科目信息
                        TTeacherSubjects::model()->deleteAll("teacher_id=:teacher_id", array(':teacher_id'=>$user->ID));
                        // 添加担任科目信息
                        $teacher->subjects  = is_array($_POST['TTeachers']['subjects']) ? $_POST['TTeachers']['subjects'] : array();
                        if(is_array($teacher->subjects)){
                            foreach ($teacher->subjects as $key => $value) {
                                $teacherSubject = new TTeacherSubjects();
                                $teacherSubject->teacher_id = $user->ID;
                                $teacherSubject->subject_id = $value;
                                $teacherSubject->create_user = $this->getLoginUserId();
                                $teacherSubject->update_user = $this->getLoginUserId();
                                $teacherSubject->create_time = new CDbExpression('NOW()');
                                $teacherSubject->update_time = new CDbExpression('NOW()');
                                $teacherSubject->save();
                            }
                        }
                    
                        $tran->commit();
                        Yii::app()->user->setFlash('success', "教师信息变更成功！");
                    } else {
                        Yii::log(print_r($teacher->errors, true));
                        Yii::app()->user->setFlash('warning', "教师信息变更失败！");
                    }
                }  catch (Exception $e){
                    throw new CHttpException(500, "系统异常！");
                }
            }

            $this->render('update', array(
                'model' => $teacher,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    /**
     * 教师信息息删除
     * @throws CHttpException
     */
    public function actionDelete() {
        if (isset($_POST['ID'])) {
            $ID = trim($_POST['ID']);
            
            $user = TUsers::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($user)) {
                throw new CHttpException(404, "该用户信息不存在！");
            }
            
            $teacher = TTeachers::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($teacher)) {
                throw new CHttpException(404, "该教师信息不存在！");
            }
            
            $tran = Yii::app()->db->beginTransaction();
            try{
                $user->update_user = $this->getLoginUserId();
                $user->update_time = new CDbExpression('NOW()');

                $teacher->status = '2'; 
                $teacher->update_user = $this->getLoginUserId();
                $teacher->update_time = new CDbExpression('NOW()');

                if ($user->save() && $teacher->save(false)) {
                    $tran->commit();
                    $this->setSuccessMessage("教师信息删除成功！");
                    
                    $this->redirect($this->createUrl('search'));
                } else {
                    $this->setErrorMessage("教师信息删除失败！");
                }
            }  catch (Exception $e) {
                throw new CHttpException(500, "系统异常！");
            }
                
            $this->render('update', array(
                'model' => $teacher,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
}   