<?php

class StudentController extends BaseController {

    /**
     * 查询学生信息
     */
    public function actionSearch() {

        $model = new StudentForm();
        $model->sex = null;
        if (isset($_GET['StudentForm'])) {
            $model->attributes = $_GET['StudentForm'];

            // 查询SQL
            $sql = "select DISTINCT a.* ";
            $countSql = "select count(DISTINCT a.ID ) ";
            $condition = "FROM t_students a inner join t_student_classes b on a.ID = b.student_id inner join t_classes c on c.ID = b.class_id ";

            $params = array();
            // 省内编号
            if (trim($model->province_code) !== '') {
                $condition .= " and a.province_code = :province_code ";
                $params[':province_code'] = trim($model->province_code);
            }
            // 学号
            if (trim($model->student_number) !== '') {
                $condition .= " and b.student_number = :student_number ";
                $params[':student_number'] = trim($model->student_number);
            }
            // 学生姓名
            if (trim($model->name) !== '') {
                $condition .= " and a.name like :name ";
                $params[':name'] = '%' . StringUtils::escape(trim($model->name)) . '%';
            }
            // 性别
            if (trim($model->sex) !== '') {
                $condition .= " and a.sex = :sex ";
                $params[':sex'] = trim($model->sex);
            }
            // 身份证号
            if (trim($model->id_card_no) !== '') {
                $condition .= " and a.id_card_no like :id_card_no ";
                $params[':id_card_no'] = '%' . StringUtils::escape(trim($model->id_card_no)) . '%';
            }
            // 入学年份
            if (trim($model->school_year) !== '') {
                $condition .= " and a.school_year = :school_year ";
                $params[':school_year'] = trim($model->school_year);
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
            if ($dataProvider->totalItemCount == 0) {
                $this->setWarningMessage('没有检索到相关数据！');
            }
        }

        $this->render('search', array(
            'model' => $model,
            'dataProvider' => isset($dataProvider) ? $dataProvider : null,
        ));
    }

    /**
     * 添加学生信息
     */
    public function actionCreate() {

        $model = new StudentForm('create');

        if (isset($_POST['StudentForm'])) {
            $model->attributes = $_POST['StudentForm'];

            if ($model->validate()) {
                $tran = Yii::app()->db->beginTransaction();
                try {
                    // 登录用的用户信息
                    $user = new TUsers();
                    $user->username = trim($model->student_number);
                    $user->password = str_replace('-', '', $model->birthday); // 密码默认为身份证后六位
                    $user->status = '1';
                    $user->create_user = $this->getLoginUserId();
                    $user->create_time = new CDbExpression('NOW()');

                    if ($user->save()) {
                        // 学生用户信息
                        $student = new TStudents();
                        $student->attributes = $model->attributes;
                        $student->ID = $user->ID;
                        $student->create_user = $this->getLoginUserId();
                        $student->create_time = new CDbExpression('NOW()');

                        // 学生权限用户信息
                        $userRole = new TUserRoles();
                        $userRole->user_id = $user->ID;
                        $userRole->role_id = '1'; //学生角色(固定值)
                        $userRole->create_user = $this->getLoginUserId();
                        $userRole->create_time = new CDbExpression('NOW()');

                        // 学生班级信息
                        $studentClass = new TStudentClasses();
                        $studentClass->student_number = trim($model->student_number);  // 学号
                        $studentClass->class_id = $model->class_id;
                        $studentClass->student_id = $student->ID;
                        $studentClass->status = '1';
                        $studentClass->create_user = $this->getLoginUserId();
                        $studentClass->create_time = new CDbExpression('NOW()');

                        if ($student->save() && $userRole->save() && $studentClass->save()) {
                            $tran->commit();
                            // 清空页面的值
                            $model->unsetAttributes();
                            // 成功消息
                            $this->setSuccessMessage('学生信息添加成功！');
                        } else {
                            $this->setErrorMessage('学生信息添加失败！');
                        }
                    }

                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionView() {
        if (isset($_GET['ID'])) {

            $ID = trim($_GET['ID']);
            $student = TStudents::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(404, "该学生信息不存在！");
            }
            
            $oldClass = TStudentClasses::model()->find("student_id=:student_id and status='1'", array(':student_id' => $student->ID));
            if (!is_null($oldClass)) {
                $student->class_id = $oldClass->class_id;
            }

            $this->render('update', array(
                'model' => $student,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

    /**
     * 
     * @throws CHttpException
     */
    public function actionUpdate() {
        
        if (isset($_GET['ID'])) {

            $ID = trim($_GET['ID']);
            $student = TStudents::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(404, "该学生信息不存在！");
            }
            
            // 当前所在班级信息
            $currentClass = TStudentClasses::model()->find("student_id=:student_id and status='1'", array(':student_id' => $student->ID));
            if (!is_null($currentClass)) {
                // 目前所在班级学号
                $student->student_number = $currentClass->student_number;
                // 目前所在班级
                $student->class_id = $currentClass->class_id;
                
                // 班级和学号信息临时保存
                $student->old_class_id = $currentClass->class_id;
                $student->old_student_number  = $currentClass->student_number;
            }

            if (isset($_POST['TStudents'])) {
                $student->scenario = 'update';

                $student->id_card_no    = trim($_POST['TStudents']['id_card_no']);
                $student->birthday      = trim($_POST['TStudents']['birthday']);
                $student->accommodation = trim($_POST['TStudents']['accommodation']);
                $student->payment1      = trim($_POST['TStudents']['payment1']);
                $student->payment2      = trim($_POST['TStudents']['payment2']);
                $student->payment3      = trim($_POST['TStudents']['payment3']);
                $student->payment4      = trim($_POST['TStudents']['payment4']);
                $student->payment5      = trim($_POST['TStudents']['payment5']);
                $student->payment6      = trim($_POST['TStudents']['payment6']);
                $student->bonus_penalty = trim($_POST['TStudents']['bonus_penalty']);
                $student->address       = trim($_POST['TStudents']['address']);
                $student->parents_tel   = trim($_POST['TStudents']['parents_tel']);
                $student->parents_qq    = trim($_POST['TStudents']['parents_qq']);
                $student->school_of_graduation = trim($_POST['TStudents']['school_of_graduation']);
                $student->senior_score  = trim($_POST['TStudents']['senior_score']);
                $student->school_year   = trim($_POST['TStudents']['school_year']);
                $student->college_score = trim($_POST['TStudents']['college_score']);
                $student->university    = trim($_POST['TStudents']['university']);
                $student->comment       = trim($_POST['TStudents']['comment']);

                $student->update_user  = $this->getLoginUserId();
                $student->update_time  = new CDbExpression('NOW()');
                
                // 最新的学生班级信息
                $student->class_id     = trim($_POST['TStudents']['class_id']);
                // 最新的学生班级学号
                $student->student_number = trim($_POST['TStudents']['student_number']);
                
                $tran = Yii::app()->db->beginTransaction();
                try {
                    if($student->validate()) {

                        if (is_null($currentClass)) {
                            // 学生班级信息不存在，新建班级信息
                            $newClass = new TStudentClasses();
                            $newClass->student_number = $student->student_number; // 学号
                            $newClass->class_id       = $student->class_id;
                            $newClass->student_id     = $student->ID;
                            $newClass->status = '1';
                            $newClass->create_user = $this->getLoginUserId();
                            $newClass->create_time = new CDbExpression('NOW()');
                            $newClass->save(false);
                        } else {
                            // 存在，并且修改了班级信息时
                            if ($student->old_class_id != $student->class_id) { // 班级信息不一致时，表示修改了班级信息
                                // 当前班级信息状态设置为暂停
                                $currentClass->status = '0';
                                $currentClass->save(false);
                                
                                // 新加新的班级信息
                                $newClass = new TStudentClasses();
                                $newClass->student_number = $student->student_number; // 学号
                                $newClass->class_id       = $student->class_id;
                                $newClass->student_id     = $student->ID;
                                $newClass->status = '1';
                                $newClass->create_user = $this->getLoginUserId();
                                $newClass->create_time = new CDbExpression('NOW()');
                                $newClass->save(false);
                            } else {
                                // 班级信息委发生变化，而学号发生了修改的情况
                                if ($student->old_student_number != $student->student_number) {
                                    $currentClass->student_number = $student->student_number;
                                    $currentClass->save(false);
                                }
                            }
                        }

                        if ($student->save()) {
                            $tran->commit();
                            $this->setSuccessMessage("学生信息变更成功！");
                        } else {
                            Yii::log(print_r($student->errors, true));
                            $this->setErrorMessage("学生信息变更失败！");
                        }
                    }
                } catch (Exception $e) {
                    throw new CHttpException(404, "系统异常！");
                }
            }

            $this->render('update', array(
                'model' => $student,
            ));
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }

    /**
     * 学生信息删除
     * @throws CHttpException
     */
    public function actionDelete() {
        if (isset($_POST['ID'])) {
            $ID = trim($_POST['ID']);

            $user = TUsers::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($user)) {
                throw new CHttpException(404, "该用户信息不存在！");
            }

            $student = TStudents::model()->find("ID=:ID and status='1'", array(":ID" => $ID));
            if (is_null($student)) {
                throw new CHttpException(404, "该学生信息不存在！");
            }

            $tran = Yii::app()->db->beginTransaction();
            try {
                $user->status = '2';
                $user->update_user = $this->getLoginUserId();
                $user->update_time = new CDbExpression('NOW()');

                $student->status = '2';
                $student->update_user = $this->getLoginUserId();
                $student->update_time = new CDbExpression('NOW()');

                if ($user->save() && $student->save()) {
                    $this->setSuccessMessage("学生信息删除成功！");
                    $tran->commit;
                    
                    $this->redirect($this->createUrl('search'));
                } else {
                    $this->setErrorMessage("学生信息删除失败！");
                    $this->redirect($this->createUrl('update', array('ID'=>$ID)));
                }
            } catch (Exception $e) {
                throw new CHttpException(404, "系统异常！");
            }
        } else {
            throw new CHttpException(404, "找不到该页面！");
        }
    }
    

    public function actionImport() {
        // 导入时间的检查
        $config = MConfig::model()->getConfigByKey('IMPORT_STUDENT_DATA_RANGE');
        if (is_null($config) || (!is_null($config) && empty($config->value))) {
            throw new CHttpException(500, "批量导入时间没有设置！");
        }

        list($start_date, $end_date) = explode('|', $config->value);
        $today = date('Y-m-d');
        if (!($start_date <= $today && $today <= $end_date)) {
            throw new CHttpException(500, "当前日期不能导入学生信息！");
        }
        
        $model = new TImportStudent();
        
        // 学生数据读取
        if (isset($_POST['TImportStudent']) && isset($_POST['validate']) && trim($_POST['validate']) == 'validate') {
            $tran = Yii::app()->db->beginTransaction();
            try {
                $model->attributes = $_POST['TImportStudent'];
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
        if (isset($_POST['TImportStudent']['ID']) && isset($_POST['TImportStudent']['class_id']) && isset($_POST['import']) && trim($_POST['import']) == 'import') {
            $model->attributes = $_POST['TImportStudent'];
            $model->scenario = 'import';

            $record = TImportStudent::model()->find('ID=:ID', array(':ID' => $model->ID));
            if(is_null($record)){
                throw new CHttpException(500, '数据导入过程中出现异常，请稍后重试！');
            }
            
            $class = TClasses::model()->find("ID=:ID and status='1'", array(':ID' => $model->class_id));
            if(is_null($class)){
                throw new CHttpException(500, '要导入学生信息的班级信息不存在！');
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
                    if($model->importdata($data2, $class)) {
                        $tran->commit();
                        $this->setSuccessMessage("数据导入成功！");
                        
                        $this->redirect($this->createUrl('import'));
                    } else {
                        $this->setErrorMessage("数据导入失败，请检查数据是否正确，然后重试！");
                    }
                } else {
                    $this->setErrorMessage('数据中有异常数据，请修改后再重试！');
                }
            } catch (Exception $ex) {
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
