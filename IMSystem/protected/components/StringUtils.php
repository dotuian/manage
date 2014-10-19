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
    
    /**
     * 字符的个数是否在范围内
     */
    public static function isLengthInRange($value, $min, $max) {
        
    }

}

?>
