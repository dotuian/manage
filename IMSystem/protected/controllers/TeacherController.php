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
            if (trim($model->home_address) !== '') {
                $condition .= " and a.home_address like :home_address ";
                $params[':home_address'] = '%' . StringUtils::escape(trim($model->home_address)) . '%';
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
                    $user->username = strtolower(trim($model->id_card_no));   // 身份证当做登录用户名
                    $user->password = substr(strtolower(trim($model->id_card_no)), 6, 8); // 
                    $user->status = '1';
                    $user->create_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');
                    
                    if ($user->save()) {
                        // 教师表信息
                        $teacher = new TTeachers();
                        $teacher->attributes = $model->attributes;
                        $teacher->ID = $user->ID;
                        $teacher->create_user = $this->getLoginUserId();
                        $teacher->create_time = new CDbExpression('NOW()');
                        if ($teacher->save()) {
                            // 角色信息
                            if(is_array($model->roles)){
                                foreach ($model->roles as $key => $value) {
                                    $userRole = new TUserRoles();
                                    $userRole->user_id = $user->ID;
                                    $userRole->role_id = $value;
                                    $userRole->create_user = $this->getLoginUserId();
                                    $userRole->create_time = new CDbExpression('NOW()');
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
                                    $teacherSubject->create_time = new CDbExpression('NOW()');
                                    $teacherSubject->save();
                                }
                            }
                        
                            $tran->commit();
                            $this->setSuccessMessage("教师信息添加成功！");
                            $this->redirect($this->createUrl('create'));
                        }
                    }
                    
                    Yii::log(print_r($user->errors, true));
                    $this->setErrorMessage("教师信息添加失败！");

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
                    $teacher->attributes = $_POST['TTeachers'];
                    
                    $teacher->update_user = $this->getLoginUserId();
                    $teacher->update_time = new CDbExpression('NOW()');
                    
                    if($teacher->validate()) {
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
                                $userRole->create_time = new CDbExpression('NOW()');

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
                                    $teacherSubject->create_time = new CDbExpression('NOW()');
                                    $teacherSubject->save();
                                }
                            }

                            $tran->commit();
                            $this->setSuccessMessage("教师信息变更成功！");
                        } else {
                            Yii::log(print_r($teacher->errors, true));
                            $this->setErrorMessage("教师信息变更失败！");
                        }
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

    
    
    
    
    public function actionImport() {
        
        $model = new TImportTeacher();
        
        // 学生数据读取
        if (isset($_POST['TImportTeacher']) && isset($_POST['validate']) && trim($_POST['validate']) == 'validate') {
            $tran = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['TImportTeacher'];
                $model->scenario = 'validate';
                // 上传文件名
                $model->filename = CUploadedFile::getInstance($model, 'filename');
                if ($model->validate()) {
                    // 保存文件名
                    $model->realpath = Yii::app()->params['FilePath'] . time() . '.' . $model->filename->extensionName;
                    $model->create_user = $this->getLoginUserId();
                    $model->update_user = $this->getLoginUserId();
                    $model->filename->saveAs($model->realpath); // 将文件保存在服务器端

                    if ($model->save()) {
                        // 将Excel文件中的数据读取到数组中
                        $data = $model->readExcel2Array();
                        
                        // 数据整形
                        $data = $model->converdata($data);
                        // 数据验证
                        if ($check = $model->validatedata($data)) {
                            $this->setSuccessMessage("数据正常，可以导入！");
                            $tran->commit();
                        } else {
                            $this->setWarningMessage("数据中有格式错误，请修改后重试！");
                        }
                    } else {
                        $this->setErrorMessage("数据读取失败，请检查文件格式之后重试！");
                    }
                }
            } catch (Exception $e) {
                $this->setErrorMessage('数据读取失败！');
            }
        }
        
        // 学生数据导入
        if (isset($_POST['TImportTeacher']['ID']) && isset($_POST['import']) && trim($_POST['import']) == 'import') {
            $model->attributes = $_POST['TImportTeacher'];
            $model->scenario = 'import';

            $record = TImportTeacher::model()->find('ID=:ID', array(':ID' => $model->ID));
            if(is_null($record)){
                throw new CHttpException(500, '数据导入过程中出现异常，请稍后重试！');
            }
            
            $tran = Yii::app()->db->beginTransaction();
            try {
                // 将Excel文件中的数据读取到数组中
                $data2 = $record->readExcel2Array();
                // 数据整形
                $data2 = $record->converdata($data2);
                // 数据验证
                if($model->validatedata($data2)) {
                    // 数据导入
                    if($model->importdata($data2)) {
                        $tran->commit();
                        $this->setSuccessMessage("数据导入成功！");
                        
                        $this->redirect($this->createUrl('import'));
                    } else {
                        $this->setErrorMessage("数据导入失败，请检查数据是否正确，然后重试！");
                    }
                } else {
                    $this->setErrorMessage('数据中有异常数据，请修改后再重试！');
                }
            } catch (Exception $e) {
                throw new CHttpException(500, '数据导入过程中出现了异常！');
            }
        }
        
        $this->render('import', array(
            'model' => $model,
            'check' => isset($check) ? $check : null,  // 对Excel中的数据进行检查的结果
            'data'  => isset($data) ? $data : null, // Excel读取的，经过了检查的数据
        ));
    }

}   