<?php

/**
 * 成绩控制器
 */
class ScoreController extends Controller {

    public function init() {
        parent::init();
        Yii::app()->user->setState('menu', 'score');
    }

}