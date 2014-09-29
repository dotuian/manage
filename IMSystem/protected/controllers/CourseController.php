<?php

/**
 * 课程控制器
 */
class CourseController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'course');
    }

}