<?php

class SettingController extends BaseController {

    /**
     * 登录用户信息
     */
    public function actionProfile() {

        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        if (is_null($user)) {
            throw new CHttpException('404', '用户信息不存在');
        }

        if (Yii::app()->user->getState('user_type') === 'student') {
            $data = TStudents::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        } else {
            $data = TTeachers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        }

        if (is_null($data)) {
            throw new CHttpException('400', '用户信息找不到！');
        }

        if (Yii::app()->user->getState('user_type') === 'student') { // 学生用户信息变更
            if (isset($_POST['TStudents'])) {
                $data->id_card_no = $_POST['TStudents']['id_card_no'];
                $data->birthday = $_POST['TStudents']['birthday'];
                $data->address = $_POST['TStudents']['address'];
                $data->parents_tel = $_POST['TStudents']['parents_tel'];
                $data->parents_qq = $_POST['TStudents']['parents_qq'];
                $data->update_user = $this->getLoginUserId();
                $data->update_time = new CDbExpression('NOW()');

                if ($data->save()) {
                    $this->setSuccessMessage("个人信息变更成功！");
                } else {
                    $this->setErrorMessage("个人信息变更失败！");
                }
            }
        } else {// 教师用户信息变更
            if (isset($_POST['TTeachers'])) {
                $data->sex           = $_POST['TTeachers']['sex'];           //性别
                $data->birthday      = $_POST['TTeachers']['birthday'];      // 出生年月日
                $data->id_card_no    = $_POST['TTeachers']['id_card_no'];    // 身份证号码
                $data->home_address  = $_POST['TTeachers']['home_address'];  // 家庭住址
                $data->telephonoe    = $_POST['TTeachers']['telephonoe'];    // 电话号码
                $data->nation        = $_POST['TTeachers']['nation'];        // 民族
                $data->birthplace    = $_POST['TTeachers']['birthplace'];    // 籍贯
                $data->working_date  = $_POST['TTeachers']['working_date'];  // 工作年月
                $data->party_date    = $_POST['TTeachers']['party_date'];    // 入党年月
                
                $data->before_degree = $_POST['TTeachers']['before_degree']; // 职前学历
                $data->before_graduate_date   = $_POST['TTeachers']['before_graduate_date'];   // 职前毕业时间
                $data->before_graduate_school = $_POST['TTeachers']['before_graduate_school']; // 职前毕业院校
                $data->before_graduate_major  = $_POST['TTeachers']['before_graduate_major'];  // 职前毕业专业
                $data->current_degree         = $_POST['TTeachers']['current_degree'];         // 现学历
                $data->current_graduate_date  = $_POST['TTeachers']['current_graduate_date'];  // 现学历毕业时间
                $data->current_graduate_school= $_POST['TTeachers']['current_graduate_school'];// 现学历毕业院校
                $data->current_graduate_major = $_POST['TTeachers']['current_graduate_major']; // 现学历毕业专业
                
                $data->professional_technical_position = $_POST['TTeachers']['professional_technical_position']; // 专业技术职务
                $data->work_departments_postion = $_POST['TTeachers']['work_departments_postion']; // 工作科室及职务
                $data->current_position_rank    = $_POST['TTeachers']['current_position_rank'];    // 现职级
                $data->current_position_date    = $_POST['TTeachers']['current_position_date'];    // 任现职年月   
                $data->current_level_date       = $_POST['TTeachers']['current_level_date'];       // 任现级年月
                $data->basic_memo               = $_POST['TTeachers']['basic_memo'];               // 基本情况备注
                
                $data->continue_education_address = $_POST['TTeachers']['continue_education_address']; // 继续教育地址
                $data->continue_education_date    = $_POST['TTeachers']['continue_education_date'];    // 继续教育时间
                $data->continue_education_credit  = $_POST['TTeachers']['continue_education_credit'];  // 获得学分
                $data->continue_education_prove_people = $_POST['TTeachers']['continue_education_prove_people']; // 证明人
                $data->moral_praise              = $_POST['TTeachers']['moral_praise'];              // 表彰情况
                $data->moral_student_evaluation  = $_POST['TTeachers']['moral_student_evaluation'];  // 学生测评
                $data->moral_target_check        = $_POST['TTeachers']['moral_target_check'];        // 目标考核
                $data->moral_memo                = $_POST['TTeachers']['moral_memo'];                // 师德备注
                
                $data->teach_grades              = $_POST['TTeachers']['teach_grades'];     // 任教年级
                //$data->teach_subjects            = $_POST['TTeachers']['teach_subjects'];   // 课程
                $data->teaching_research_postion = $_POST['TTeachers']['teaching_research_postion']; // 教研职务
                $data->recruit_students          = $_POST['TTeachers']['recruit_students']; // 招生情况
                $data->attendance                = $_POST['TTeachers']['attendance'];       // 考勤情况
                $data->working_memo              = $_POST['TTeachers']['working_memo'];     // 履职备注
                
                $data->tutorship_award    = $_POST['TTeachers']['tutorship_award'];   // 辅导获奖
                $data->competition_award  = $_POST['TTeachers']['competition_award']; // 参赛获奖
                $data->paper_work         = $_POST['TTeachers']['paper_work'];        // 论文著作
                $data->competition_item   = $_POST['TTeachers']['competition_item'];  // 参赛项目情况
                $data->business_memo      = $_POST['TTeachers']['business_memo'];     // 业务备注
                
                $data->update_user = $this->getLoginUserId();
                $data->update_time = new CDbExpression('NOW()');

                if ($data->save()) {
                    $this->setSuccessMessage("个人信息变更成功！");
                } else {
                    $this->setErrorMessage("个人信息变更失败！");
                }
            }
        }

        $this->render('profile', array('user' => $user, 'model' => $data));
    }

    /**
     * 用户密码变更页面
     */
    public function actionPassword() {

        $user = TUsers::model()->find("ID=:ID and status='1'", array(':ID' => $this->ID));
        if (is_null($user)) {
            throw new CHttpException('404', '用户信息不存在');
        }

        $model = new UserForm('changePassword');
        if (isset($_POST['UserForm'])) {
            $model->attributes = $_POST['UserForm'];

            if ($model->validate()) {
                $user->password = $model->new_password;
                $user->last_password_time = new CDbExpression('NOW()');
                $user->update_user = $this->getLoginUserId();
                $user->update_time = new CDbExpression('NOW()');

                if ($user->save()) {
                    // 密码清空
                    $model->clear();
                    $this->setSuccessMessage("密码变更成功！");
                } else {
                    $this->setErrorMessage("密码变更失败！");
                }
            }
        }

        $this->render('password', array('model' => $model));
    }

}
