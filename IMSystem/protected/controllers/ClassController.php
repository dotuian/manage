<?php

/**
 * 班级控制器
 */
class ClassController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'class');
    }

}