<?php

class StringUtils {
    
    public static function escape($keyword) {
        $keyword = strtr($keyword, array('%' => '\%', '_' => '\_'));
        return $keyword;
    }

    /**
     * 是否为英数字
     * @param type $value
     */
    public static function isAlphabets($value) {
        return preg_match('/[A-Za-z0-9]+/', $value);
    }
    
    
    public static function uft8_strlen($str) {
        return mb_strlen($str, 'UTF-8');
    }

}

?>
