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
        $user = TUsers::model()->find("username=:username and status='1'", array(':username' => $this->username));

        if (is_null($user)) {
            // 用户不存在
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($this->password !== $user->password) {
            // 密码错误
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $loginUser = null;
            if ($user->roles === 'S') {
                $loginUser = TStudents::model()->find("ID=:id and status='1'", array(':id' => $user->ID));
            } else {
                $loginUser = TTeachers::model()->find("ID=:id and status='1'", array(':id' => $user->ID));
            }

            if (!is_null($loginUser)) {
                $this->errorCode = self::ERROR_NONE;
                
                $this->setState('ID',        $user->ID);
                $this->setState('username',  $user->username);
                $this->setState('password',  $user->password);
                $this->setState('role',      $user->roles);
                switch ($user->roles) {
                    case 'S':
                        $this->setState('rolename', '学生');
                        break;
                    case 'T':
                        $this->setState('rolename', '教师');
                        break;
                    case 'T1':
                        $this->setState('rolename', '教务处');
                        break;
                    case 'T2':
                        $this->setState('rolename', '学生科');
                        break;
                    case 'A':
                        $this->setState('rolename', '校长');
                        break;
                    default:
                        break;
                }
                
                $this->setState('name',      $loginUser->name);
                $this->setState('user',      $user);
                $this->setState('loginUser', $loginUser);
            } else {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
            
        }

        return !$this->errorCode;
    }

}