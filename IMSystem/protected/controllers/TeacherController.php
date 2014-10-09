<?php

class TeacherController extends Controller {

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
                    $user->password = substr($model->birthday, -6); // 密码默认为身份证后六位
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
                        
                        if ($teacher->save()) {
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
    
    
    /**
     * 查询教师信息
     */
    public function actionSearch() {
        
        $sql = "select a.* from t_teachers a left join t_users b on a.ID=b.ID where 1=1 ";
        $countSql = "select count(*) from t_teachers a left join t_users b on a.ID=b.ID where 1=1 ";
        $params = array();
        
        $model = new TeacherForm();
        $model->sex = null;
        
        if (isset($_GET['TeacherForm'])) {
            $model->attributes = $_GET['TeacherForm'];
            
            if (trim($model->code) !== '') {
                $sql .= " and a.code like :code ";
                $countSql .= " and a.code like :code ";
                $params[':code'] = '%' . trim($model->code) . '%';
            }
            if (trim($model->name) !== '') {
                $sql .= " and a.name like :name ";
                $countSql .= " and a.name like :name ";
                $params[':name'] = '%' . trim($model->name) . '%';
            }
            if (trim($model->sex) !== '') {
                $sql .= " and a.sex = :sex ";
                $countSql .= " and a.sex = :sex ";
                $params[':sex'] = trim($model->sex);
            }
            if (trim($model->address) !== '') {
                $sql .= " and a.address like :address ";
                $countSql .= " and a.address like :address ";
                $params[':address'] = '%' . trim($model->address) . '%';
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
                        'asc' => 'a.code',
                        'desc' => 'a.code desc',
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
            
            if (isset($_POST['TTeachers'])) {
                $tran = Yii::app()->db->beginTransaction();
                try{
                    $teacher->birthday   = trim($_POST['TTeachers']['birthday']);
                    $teacher->address    = trim($_POST['TTeachers']['address']);
                    $teacher->telephonoe = trim($_POST['TTeachers']['telephonoe']);
                    $teacher->update_user = $this->getLoginUserId();
                    $teacher->update_time = new CDbExpression('NOW()');

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

                    if ($teacher->save()) {
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
    
}   