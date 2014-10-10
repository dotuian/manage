<?php


class StringUtils {
    
    public static function escape($keyword) {
        $keyword = strtr($keyword, array('%' => '\%', '_' => '\_'));
        return $keyword;
    }
    
}

?>
