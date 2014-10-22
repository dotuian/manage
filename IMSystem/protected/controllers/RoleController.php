<?php

/**
 * 角色权限管理
 */
class RoleController extends Controller {
    /**
     * 角色信息添加
     * @throws CHttpException
     */
    public function actionCreate(){
        
        $model = new RoleForm('create');
        
        if (isset($_POST['RoleForm'])) {
            $model->attributes = $_POST['RoleForm'];
            $model->initAuthoritys();
            
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $role = new MRoles();
                    $role->role_code = $model->autoRoleCode();
                    $role->role_name = $model->role_name;
                    $role->level = 0;
                    $role->create_user = $this->getLoginUserId();
                    $role->update_user = $this->getLoginUserId();
                    $role->create_time = new CDbExpression('NOW()');
                    $role->update_time = new CDbExpression('NOW()');
                    if ($role->save()) { // 角色添加
                        
                        // 角色权限添加
                        foreach ($model->authoritys as $value) {
                            $roleAuthoritys = new MRoleAuthoritys();
                            $roleAuthoritys->authority_id = trim($value);
                            $roleAuthoritys->role_id = $role->ID;
                            $roleAuthoritys->create_user = $this->getLoginUserId();
                            $roleAuthoritys->update_user = $this->getLoginUserId();
                            $roleAuthoritys->create_time = new CDbExpression('NOW()');
                            $roleAuthoritys->update_time = new CDbExpression('NOW()');
                            $roleAuthoritys->save();
                        }

                        $tran->commit();
                        Yii::app()->user->setFlash('success', "角色信息添加成功！");
                        $this->redirect($this->createUrl('create'));
                    } else {
                        $tran->rollback();
                        Yii::app()->user->setFlash('warning', "角色信息添加失败！");
                    }
                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }
    
    
    /**
     * 角色信息检索
     */
    public function actionSearch() {
        
        $sql = "select a.* from m_roles a where a.status='1'  ";
        $countSql = "select count(*) from m_roles a where a.status='1' ";
        $params = array();
        
        $model = new RoleForm();
        
        if (isset($_GET['RoleForm'])) {
            $model->attributes = $_GET['RoleForm'];
            
            if (trim($model->role_name) !== '') {
                $sql .= " and a.role_name like :role_name ";
                $countSql .= " and a.role_name like :role_name ";
                $params[':role_name'] = '%' . trim($model->role_name) . '%';
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
            Yii::app()->user->setFlash('warning', "没有检索到相关数据！");
        }
        
        $this->render('search', array(
                    'model' => $model, 
                    'dataProvider' => $dataProvider,
                ));
    }
    
    /**
     * 角色信息变更
     * @throws CHttpException
     */
    public function actionUpdate() {

        if (isset($_GET['ID'])) {
            $ID = trim($_GET['ID']);
            $role = MRoles::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($role)) {
                throw new CHttpException(404, "该角色信息不存在！");
            }

            // 页面初始化
            $model = new RoleForm('update');
            $model->role_id = $role->ID;
            $model->role_code = $role->role_code;
            $model->role_name = $role->role_name;
            $model->class_authoritys = array_keys($role->getRoleAuthorityByCategory('CLASS'));
            $model->subject_authoritys = array_keys($role->getRoleAuthorityByCategory('SUBJECT'));
            $model->course_authoritys = array_keys($role->getRoleAuthorityByCategory('COURSE'));
            $model->student_authoritys = array_keys($role->getRoleAuthorityByCategory('STUDENT'));
            $model->teacher_authoritys = array_keys($role->getRoleAuthorityByCategory('TEACHER'));
            $model->score_authoritys = array_keys($role->getRoleAuthorityByCategory('SCORE'));
            $model->role_authoritys = array_keys($role->getRoleAuthorityByCategory('ROLE'));
            $model->authority_authoritys = array_keys($role->getRoleAuthorityByCategory('AUTHORITY'));
            $model->other_authoritys = array_keys($role->getRoleAuthorityByCategory('OTHER'));
            $model->system_authoritys = array_keys($role->getRoleAuthorityByCategory('SYSTEM'));

            // 角色的权限更新处理
            if (isset($_POST['RoleForm'])) {
                $model->attributes = $_POST['RoleForm'];
                $model->initAuthoritys();
                
                // 数据验证
                if ($model->validate()) {
                    $tran = Yii::app()->db->beginTransaction();
                    try {
                        // 角色信息
                        $role->role_name = $model->role_name;
                        $role->update_user = $this->getLoginUserId();
                        $role->update_time = new CDbExpression('NOW()');
                        if ($role->save()) {// 角色变更
                            // 权限信息删除
                            MRoleAuthoritys::model()->delete("role_id=:role_id", array(':role_id' => $role->ID));
                            
                            // 权限添加
                            foreach ($model->authoritys as $value) {
                                $roleAuthoritys = new MRoleAuthoritys();
                                $roleAuthoritys->authority_id = trim($value);
                                $roleAuthoritys->role_id = $role->ID;
                                $roleAuthoritys->create_user = $this->getLoginUserId();
                                $roleAuthoritys->update_user = $this->getLoginUserId();
                                $roleAuthoritys->create_time = new CDbExpression('NOW()');
                                $roleAuthoritys->update_time = new CDbExpression('NOW()');
                                $roleAuthoritys->save();
                            }

                            $tran->commit();
                            Yii::app()->user->setFlash('success', "角色信息变更成功！");
                        } else {
                            $tran->rollback();
                            Yii::app()->user->setFlash('warning', "角色信息变更失败！");
                        }
                    } catch (Exception $e) {
                        $tran->rollback();
                        throw new CHttpException(404, "系统异常！");
                    }
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    /**
     * 角色信息删除
     * @throws CHttpException
     */
    public function actionDelete() {
        if (isset($_POST['ID'])) {
            $ID = trim($_POST['ID']);
            
            if(in_array($ID , array('1','2','3','4', '5'))) {
                throw new CHttpException(404, "该信息为系统运行所必须的数据，不能删除！");
            }
            
            $role = MRoles::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($role)) {
                throw new CHttpException(404, "该角色信息不存在！");
            }
            
            $role->status = '2'; //删除状态
            $role->update_user = $this->getLoginUserId();
            $role->create_time = new CDbExpression('NOW()');
            if ($role->save()) {
                Yii::app()->user->setFlash('success', "角色信息删除成功！");
                $this->redirect($this->createUrl('search'));
            } else {
                Yii::log(print_r($role->errors, true));
                Yii::app()->user->setFlash('warning', "角色信息删除失败！");
            }

            $this->render('update', array(
                'model' => $role,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
}   