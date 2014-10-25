<?php

class UserForm extends CFormModel {

    public $username;
    public $password;

    public $old_password;
    public $new_password;
    public $confirm_password;
    
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('old_password, new_password, confirm_password', 'required', 'on'=>'changePassword'),
            
            array('old_password', 'authenticate', 'on'=>'changePassword'),
            
            array('old_password, new_password, confirm_password', 'length', 'allowEmpty'=>false, 'min' => 6, 'max' => 20, 'on'=>'changePassword'),
            
            array('confirm_password', 'compare', 'compareAttribute'=>'new_password', 'message'=>'新密码(确认)必须与新密码保持一致！', 'on'=>'changePassword'),
            
            array('username, password, old_password, new_password, confirm_password', 'safe'),
        );
    }
    
    public function clear(){
        $this->old_password = null;
        $this->new_password = null;
        $this->confirm_password = null;
    }
    
    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'old_password' => '旧密码',
            'new_password' => '新密码',
            'confirm_password' => '新密码(确认)',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = TUsers::model()->find('ID=:ID', array(':ID' => Yii::app()->user->getState('ID')));
            if ($this->old_password != $user->password) {
                $this->addError('old_password', '密码不正确！');
            }
        }
    }

    
    public function afterValidate() {
        parent::afterValidate();
        
    }
        
}
