<?php

class SystemController extends BaseController {

    private static $KEY_IMPORT_STUDENT_DATA_RANGE = 'IMPORT_STUDENT_DATA_RANGE';
//    private static $KEY_IS_RUNNING = 'IS_RUNNING';
    
    /**
     * 登录用户信息
     */
    public function actionSetting() {
        $model = new ConfigForm();

        if (isset($_POST['ConfigForm'])) {
            $model->attributes = $_POST['ConfigForm'];

            if ($model->validate()) {
                // 学生数据导入开始结束时间
                $daterange = MConfig::model()->find('`key`=:key', array(':key' => self::$KEY_IMPORT_STUDENT_DATA_RANGE));
                if (is_null($daterange)) {
                    // 设置不存在的情况，添加
                    $daterange = new MConfig();
                    $daterange->key = self::$KEY_IMPORT_STUDENT_DATA_RANGE;
                    $daterange->value = $model->import_student_start_date . '|' . $model->import_student_end_date;
                    $daterange->save();
                } else {
                    // 设置存在的情况下，更新
                    $daterange->value = $model->import_student_start_date . '|' . $model->import_student_end_date;
                    $daterange->save();
                }


                // 系统是否运行中
//                $running = MConfig::model()->find('`key`=:key', array(':key' => self::$KEY_IS_RUNNING));
//                if (is_null($running)) {
//                    $running = new MConfig();
//                    $running->key = self::$KEY_IS_RUNNING;
//                    $running->value = $model->running;
//                    $running->save();
//                }

                $this->setSuccessMessage("系统配置变更成功！");
            }
        } else {
            // 页面数据表示用
            $configs = MConfig::model()->findAll();
            foreach ($configs as $config) {
                switch ($config->key) {
                    // 学生数据导入开始结束时间
                    case self::$KEY_IMPORT_STUDENT_DATA_RANGE:
                        if (!empty($config->value)) {
                            list($model->import_student_start_date, $model->import_student_end_date) = explode('|', $config->value);
                        }
                        break;
                    // 系统是否运行中
//                    case self::$KEY_IS_RUNNING:
//                        $model->running = $config->value;
                        break;

                    default:
                        break;
                }
            }
        }

        $this->render('setting', array('model' => $model));
    }

}

