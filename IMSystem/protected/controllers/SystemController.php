<?php

class SystemController extends Controller {

    /**
     * 登录用户信息
     */
    public function actionSetting() {
        $model = new ConfigForm();
        
        
        
        
        
        
        $this->render('setting', array('model' => $model));
    }

}

