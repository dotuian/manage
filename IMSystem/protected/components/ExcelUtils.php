<?php

class ExcelUtils {
    
    public static function readExcel2Array($filename) {
        $data = null;

        spl_autoload_unregister(array('YiiBase', 'autoload'));
        try {

            $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
            
            //include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/IOFactory.php');
            include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
            
            if (strtolower(substr($filename, -3)) === 'xls') {
                $objReader = new PHPExcel_Reader_Excel5();
            } else if (strtolower(substr($filename, -4)) === 'xlsx') {
                $objReader = new PHPExcel_Reader_Excel2007();
            }

            if (isset($objReader)) {
                $objPHPExcel = $objReader->load($filename);
                $data = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            }
        } catch (Exception $exc) {
            Yii::log(print_r($exc->getTraceAsString(), true));
        }

        spl_autoload_register(array('YiiBase', 'autoload'));

        return $data;
    }

    
    
    
    
    
    
    public function getExcelReader($filename) {
        // 默认用excel2007读取excel，若格式不对，则用之前的版本进行读取
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if($PHPReader->canRead($filename)){
            return $PHPReader;
        }
        
        $PHPReader = new PHPExcel_Reader_Excel5();
        if ($PHPReader->canRead($filename)) {
            return $PHPReader;
        }
        
        return null;
    }
    /**
     * 
     * @param type $filePath
     * @param type $startRow
     * @param type $column
     */
    public function _readExcel2Array($filename, $startRow, $column) {
        $result = array();
        
        $phpExcelPath = Yii::getPathOfAlias('ext');
        
        spl_autoload_unregister(array('YiiBase','autoload'));        

        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        
        $PHPReader = $this->getExcelReader($filename);
        if (is_null($PHPReader)) {
            return $result;
        }
        
        $PHPExcel = $PHPReader->load($filename);  

        /**读取excel文件中的第一个工作表*/  
        $currentSheet = $PHPExcel->getSheet(0);
        
        /**取得最大的列号*/  
        $allColumn = $currentSheet->getHighestColumn();  
        
        /**取得一共有多少行*/  
        $allRow = $currentSheet->getHighestRow();  

        for ($rowIndex = $startRow; $rowIndex <= $allRow; $rowIndex++) {
            $row = array();
            
            for ($colIndex = 'A'; $colIndex <= $column; $colIndex++) {
                $addr = $colIndex . $rowIndex;
                $cell = $currentSheet->getCell($addr)->getValue();
                if ($cell instanceof PHPExcel_RichText) {
                    //富文本转换字符串  
                    $cell = $cell->__toString();
                }
                // 行
                $row[] = $cell;
            }
            // 所有的行
            $result[] = $row;
        }
        
        spl_autoload_register(array('YiiBase','autoload'));
        
        return $result;
    }

    
    
}

?>
