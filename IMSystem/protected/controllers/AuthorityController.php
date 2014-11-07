<?php

/**
 * 权限控制器
 */
class AuthorityController extends BaseController {

    /**
     * 查询班级信息
     */
    public function actionSearch() {
        
        $sql = "select a.* from m_authoritys a where 1=1 ";
        $countSql = "select count(*) from m_authoritys a where 1=1 ";
        $params = array();
        $condition = '';
        $model = new AuthorityForm();

        if (isset($_GET['AuthorityForm'])) {
            $model->attributes = $_GET['AuthorityForm'];
            
            if (trim($model->authority_name) !== '') {
                $condition .=  " and a.authority_name like :authority_name ";
                $params[':authority_name'] = '%' . trim($model->authority_name) . '%';
            }
            if (trim($model->category) !== '') {
                $condition .= " and a.category = :category ";
                $params[':category'] = trim($model->category);
            }
            if (trim($model->access_path) !== '') {
                $condition .=  " and a.access_path like :access_path ";
                $params[':access_path'] = '%' . trim($model->access_path) . '%';
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
        if($dataProvider->totalItemCount == 0 ) {
            $this->setWarningMessage("没有检索到相关数据！");
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

        $model = new AuthorityForm('create');
        
        if (isset($_POST['AuthorityForm'])) {
            $model->attributes = $_POST['AuthorityForm'];
            
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $authority = new MAuthoritys();
                    $authority->authority_name = trim($model->authority_name);
                    $authority->category = trim($model->category);
                    $authority->access_path = trim($model->access_path);
                    $authority->level = '0';
                    
                    $authority->create_user = $this->getLoginUserId();
                    $authority->create_time = new CDbExpression('NOW()');
                    if ($authority->save()) {
                        $tran->commit();
                        // 清空页面的值
                        $model->unsetAttributes();
                        $this->setSuccessMessage("权限信息添加成功！");
                    } else {
                        Yii::log(print_r($authority->errors, true));
                        $this->setErrorMessage("权限信息添加失败！");
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
            
            $authority = MAuthoritys::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($authority)) {
                throw new CHttpException(404, "该权限信息不存在！");
            }

            if (isset($_POST['MAuthoritys'])) {
                $authority->authority_name = trim($_POST['MAuthoritys']['authority_name']);
                $authority->category = trim($_POST['MAuthoritys']['category']);
                $authority->access_path = trim($_POST['MAuthoritys']['access_path']);
                $authority->update_user = $this->getLoginUserId();
                $authority->update_time = new CDbExpression('NOW()');
                
                if ($authority->validate()) {
                    if ($authority->save()) {
                        $this->setSuccessMessage("权限信息变更成功！");
                    } else {
                        Yii::log(print_r($authority->errors, true));
                        $this->setErrorMessage("权限信息变更失败！");
                    }
                }
            }

            $this->render('update', array(
                'model' => $authority,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    
    
    public function actionDelete() {

        if (isset($_POST['ID'])) {
            $ID = trim($_POST['ID']);
            
            $authority = MAuthoritys::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($authority)) {
                throw new CHttpException(404, "该权限信息不存在！");
            }

            
            $tran = Yii::app()->db->beginTransaction();
            try {
                MRoleAuthoritys::model()->deleteAll('authority_id=:authority_id', array(':authority_id'=>$authority->ID));
                if ($authority->delete()) {
                    $tran->commit();
                    $this->setSuccessMessage("权限信息删除成功！");
                    
                    // 删除成功之后，跳转检索页面
                    $this->redirect($this->createUrl('search'));
                } else {
                    $this->setErrorMessage("权限信息删除失败！");
                }
                
            } catch (Exception $e){
                throw new CHttpException(500, "系统异常！");
            }
            
            $this->render('update', array(
                'model' => $authority,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

}