<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = TUsers::model()->find("upper(username)=:username and status='1'", array(':username' => strtoupper($this->username)));
        if (is_null($user)) {
            // 用户不存在
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($this->password !== $user->password) {
            // 密码错误
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            
            $loginUser = TStudents::model()->find("ID=:id and status='1'", array(':id' => $user->ID));
            if (is_null($loginUser)) {
                $loginUser = TTeachers::model()->find("ID=:id and status='1'", array(':id' => $user->ID));
            }
            
            if (!is_null($loginUser)) {
                $user->last_login_time = new CDbExpression('NOW()');
                $user->save(false);
                
                $this->errorCode = self::ERROR_NONE;
                $this->setState('ID',        $user->ID);
                $this->setState('username',  $user->username);
                $this->setState('password',  $user->password);
                
                // 用户类型
                if ('TStudents' == get_class($loginUser)) {
                    $this->setState('user_type',  'student');
                } else {
                    $this->setState('user_type',  'teacher');
                }
                
                // 用户所有的权限
                $this->setState('authoritys',  $user->getAllUserAuthoritys());
                // 用户所有的权限分类
                $this->setState('auth_category', $user->getAllUserAuthorityCategory());
                // 用户所有的角色
                $this->setState('roles', $user->getUserRoleIds());
                
                $this->setState('name',      $loginUser->name);
                $this->setState('user',      $user);
                $this->setState('loginUser', $loginUser);
                
                // 用户角色
                $this->setState('isStudent',      $user->isStudent());
                $this->setState('isTeacher',      $user->isTeacher());
                $this->setState('isXueGongKe',    $user->isXueGongKe());
                $this->setState('isJiaoWuChu',    $user->isJiaoWuChu());
                $this->setState('isHeaderTeacher',$user->isHeaderTeacher());
                
                $this->setState('isBanZhuRen',    $user->isBanZhuRen());
                $this->setState('isRenKeJiaoShi', $user->isRenKeJiaoShi());
                
            } else {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
        }
        
        return $this->errorCode == self::ERROR_NONE;
    }

}