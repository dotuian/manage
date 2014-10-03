<?php

class TeacherController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'teacher');
    }
    
    public function actionCreate() {

        $model = new TeacherForm('add');
        $model->sex = 'M';
        
        if (isset($_POST['TeacherForm'])) {
            
            $model->attributes = $_POST['TeacherForm'];
            
            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    $user = new TUsers();
                    $user->username = $model->code;
                    $user->password = substr($model->birthday, -6); // 密码默认为身份证后六位
                    $user->status = '1';
                    $user->roles = $model->role;
                    $user->create_user = $this->getLoginUserId();
                    $user->update_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');
                    $user->update_time = new CDbExpression('NOW()');
                    
                    if ($user->save()) {
                        $teacher = new TTeachers();
                        $teacher->attributes = $model->attributes;
                        $teacher->ID = $user->ID;
                        $teacher->create_user = $this->getLoginUserId();
                        $teacher->update_user = $this->getLoginUserId();
                        $teacher->create_time = new CDbExpression('NOW()');
                        $teacher->update_time = new CDbExpression('NOW()');
                        if ($teacher->save()) {
                            $tran->commit();
                            Yii::app()->user->setFlash('success', "教师信息添加成功！");
                            $this->redirect($this->createUrl('create'));
                        }
                    }
                    
                    Yii::log(print_r($user->errors, true));
                    Yii::app()->user->setFlash('warning', "教师信息添加失败！");

                } catch (Exception $e) {
                    throw new CHttpException(400, "系统异常！");
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
            $teacher = TTeachers::model()->find("ID=:ID", array(":ID" => $ID));
            if (is_null($teacher)) {
                throw new CHttpException(400, "该教师信息不存在！");
            }
            
            if (isset($_POST['TTeachers'])) {
                $teacher->birthday   = trim($_POST['TTeachers']['birthday']);
                $teacher->address    = trim($_POST['TTeachers']['address']);
                $teacher->telephonoe = trim($_POST['TTeachers']['telephonoe']);
                $teacher->update_user = $this->getLoginUserId();
                $teacher->update_time = new CDbExpression('NOW()');
                
                if ($teacher->save()) {
                    Yii::app()->user->setFlash('success', "教师信息变更成功！");
                } else {
                    Yii::log(print_r($teacher->errors, true));
                    Yii::app()->user->setFlash('warning', "教师信息变更失败！");
                }
            }

            $this->render('update', array(
                'model' => $teacher,
            ));
        } else {
            throw new CHttpException(400, "找不到该页面！");
        }
    }
    
}   