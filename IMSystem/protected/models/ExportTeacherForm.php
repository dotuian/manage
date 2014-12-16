<?php

class ExportTeacherForm extends CFormModel {

    public $name;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name' => '姓名',
        );
    }

    public function afterValidate() {
        parent::afterValidate();
    }

    public function createFileName() {
        $filename = "教师基本信息_";
        $filename .= date('Ymd') . '.xlsx';
        
        return $filename;
    }
    
    /**
     * 
     */
    public function getExcelData() {
        
        $sql = "select a.* from t_teachers a ";
        $sql .= "where 1=1 ";

        $params = array();
        
        if($this->name != "") {
            $sql .= "and c.name like '%:name%' ";
            $params[':name'] = $this->name;
        }

        $sql .= "order by a.ID ";
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll(true, $params);

        return $data;
    }

    /**
     * 写文件
     * @param type $data
     * @param type $filename 下载的文件名
     */
    public function writeExcel($data, $filename) {
        //error_reporting(E_ALL);

        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');

        // Turn off our amazing library autoload 
        spl_autoload_unregister(array('YiiBase', 'autoload'));

        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/IOFactory.php');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/Writer/Excel2007.php');


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("student infomation");

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('教师基本信息');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();

        // 第1行：大标题
        // 第2,3行，小标题
        // 第4行开始，数据
        // =============================================================
        // 标题
        // =============================================================
        // 最大列数39列
        $lastColumn = PHPExcel_Cell::stringFromColumnIndex(38);
        
        // 大标题
        $row = 1;
        $worksheet->mergeCellsByColumnAndRow(0, $row, 38, $row);
        $worksheet->setCellValue("A1", "教师信息管理");
        $worksheet->getStyle("A1")->getFont()->setBold(true);
        $worksheet->getStyle("A1")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $worksheet->getStyle("A1")->getFont()->setName('Consolas');
        $worksheet->getStyle("A1")->getFont()->setSize(12);
        
        $title = array(
            "基本情况" => array(
                "教工编号",
                "姓名",
                "性别",
                "身份证号码",
                "家庭住址",
                "民族",
                "籍贯",
                "出生年月",
                "工作年月",
                "入党年月",
                "职前学历",
                "职前学历毕业时间、院校及专业",
                "现学历",
                "现学历毕业时间、院校及专业",
                "专业技职务",
                "工作科室及职务",
                "现职级",
                "任现职年月",
                "任现级年月",
                "备注"
            ),
            "师德档案" => array(
                "继续教育情况" => array(
                    "继续教育地址",
                    "继续教育时间",
                    "获得学分",
                    "证明人"
                ),
                "表彰情况",
                "学生测评",
                "目标考核",
                "备注"
            ),
            "履职档案" => array(
                "任教年级",
                "课程",
                "教研职务",
                "招生情况",
                "考勤情况",
                "备注"
            ),
            "业务档案" => array(
                "辅导获奖",
                "参赛获奖",
                "论文著作",
                "参赛项目情况",
                "备注"
            )
        );
        
        //$index = 1;
        
        // 第二行(大标题)
        $row = 2; 
        $col = 0;
        foreach ($title as $key => $value) {
            if(count($value, COUNT_RECURSIVE) !== count($value)) {
                $count = count($value, COUNT_RECURSIVE) -1 ;
            } else {
                $count = count($value);
            }
            
            // 第一行大标题
            $worksheet->mergeCellsByColumnAndRow($col, $row, $col + $count - 1, $row);
            $worksheet->setCellValueByColumnAndRow($col, $row, $key);
            
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setWrapText(true);
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            
            $col += $count;
        }
        

        // 第三行小标题
        $row = 3; 
        $col = 0;
        foreach ($title as $key => $value) {
            foreach ($value as $sub_key => $sub_value) {
                if(is_string($sub_value)) {
                    $count = 1;
                    $worksheet->mergeCellsByColumnAndRow($col, $row, $col + $count - 1, $row + 1);
                    $worksheet->setCellValueByColumnAndRow($col, $row, $sub_value);
                    
                    $col += $count;
                } else {
                    // 师德档案-- 继续教育情况
                    $count = count($sub_value, COUNT_RECURSIVE);
                    $worksheet->mergeCellsByColumnAndRow($col, $row, $col + $count - 1, $row);
                    $worksheet->setCellValueByColumnAndRow($col, $row, $sub_key);
                    
                    foreach ($sub_value as $v) {
                        $worksheet->setCellValueByColumnAndRow($col++, $row + 1, $v);
                    }
                }
                
            }
        }
        
        // 标题设置为粗体，水平/垂直居中
        //$worksheet->getStyle("A2:{$lastColumn}3")->getFont()->setBold(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        
        
//        // 
//        $worksheet->mergeCellsByColumnAndRow($col, $index, $col+7, $index);
//        $worksheet->setCellValueByColumnAndRow(1, $index, "师德档案");
//        $col += 7;
//        
//        // 
//        $worksheet->mergeCellsByColumnAndRow($col, $index, $col+5, $index);
//        $worksheet->setCellValueByColumnAndRow(2, $index, "履职档案");
//        $col += 5;
//        
//        // 
//        $worksheet->mergeCellsByColumnAndRow($col, $index, $col+4, $index);
//        $worksheet->setCellValueByColumnAndRow(3, $index, "业务档案");
//        $col += 4;
        
        
        
//        
//        // 学号
//        
//        $worksheet->mergeCellsByColumnAndRow($col, $index, $col, $index);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "学号");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
//        $col++;
//
//        // 姓名
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "姓名");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
//        $col++;
//
//        //性别
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "性别");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//
//        //身份证号码
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "身份证号码");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(20);
//        $col++;
//
//        //班级
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col + 1, $index + 1);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "班级");
//        //班级(原)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "原");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(现)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "现");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//
//        //住宿情况
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "住宿" . PHP_EOL . "情况");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
//        $col++;
//
//        //缴费情况
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col + 5, $index + 1);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "缴费情况");
//        //班级(原)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第一".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(现)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第二".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(原)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第三".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(现)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第四".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(原)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第五".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        //班级(现)
//        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第六".PHP_EOL."学期");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
//        $col++;
//        
//        //奖惩情况
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "奖惩" . PHP_EOL . "情况");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
//        $col++;
//        
//        //家庭住址
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家庭住址");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(40);
//        $col++;
//        
//        //家长电话
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家长电话");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
//        $col++;
//        
//        //家长QQ
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家长QQ");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
//        $col++;
//        
//        //毕业学校
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "毕业学校");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
//        $col++;
//        
//        //备注
//        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
//        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "备注");
//        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
//        $col++;
//
//        // 标题设置为粗体，水平/垂直居中
//        //$worksheet->getStyle("A2:{$lastColumn}3")->getFont()->setBold(true);
//        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setWrapText(true);
//        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
//
//        // =============================================================
//        // 数据
//        // =============================================================
//        $index = 4;  // 数据开始行数
//        $column = 0;
//        foreach ($data as $key => $value) {
//            $colIndex = 0 ;
//            // 姓名
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["student_number"], PHPExcel_Cell_DataType::TYPE_STRING); // 学号
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["name"]); 
//            // 性别
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getSexName($value["sex"]));
//            // 身份证号码
//            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["id_card_no"], PHPExcel_Cell_DataType::TYPE_STRING); 
//            // 班级(原)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["old_class_code"]); 
//            // 班级(现)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["class_code"]); 
//            
//            // 住宿情况
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["accommodation"]); 
//            
//            // 缴费情况(第一学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment1"]));
//            // 缴费情况(第二学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment2"])); 
//            // 缴费情况(第三学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment3"])); 
//            // 缴费情况(第四学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment4"])); 
//            // 缴费情况(第五学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment5"])); 
//            // 缴费情况(第六学期)
//            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment6"])); 
//            // 奖惩情况
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["bonus_penalty"]); 
//            // 家庭住址
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["address"]); 
//            // 家长电话
//            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["parents_tel"], PHPExcel_Cell_DataType::TYPE_STRING); 
//            // 家长QQ
//            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["parents_qq"], PHPExcel_Cell_DataType::TYPE_STRING); 
//            // 毕业学校
//            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["school_of_graduation"]); 
//            // 备注
//            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["comment"], PHPExcel_Cell_DataType::TYPE_STRING); 
//
//            $index++;
//        }
//
        
        $index = 10;
        
        // 设置数据区域边框
        $worksheet->getStyle("A2:{$lastColumn}" . ($index + 4))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->getStyle("A2:{$lastColumn}" . ($index + 4))->getFont()->setName('Consolas');
        $worksheet->getStyle("A2:{$lastColumn}" . ($index + 4))->getFont()->setSize(10);
        
        // 固定标题栏
        $worksheet->freezePane('A5');

        
        // =============================================================
        // 文件下载
        // =============================================================
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Cache-Control: max-age=1');

        ob_end_clean(); //避免下载的文件打开出现格式错误
        ob_start();
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // 官方提供下载的方式是下面一行代码，但是在有些平台下会出现格式错误。
        $objWriter->save('php://output');
        
        // 在有些平台下，下载会出现格式错误时，可以采用下面的下载方式
//        $filePath = "files\\download\\" . rand(0, getrandmax()) . rand(0, getrandmax()) . ".xlsx";
//        $objWriter->save($filePath);
//        readfile($filePath);
//        unlink($filePath);

        spl_autoload_register(array('YiiBase', 'autoload'));
    }
    
    public function getSexName($sex){
        $sexname = '';
        switch ($sex) {
            case 'M':
                $sexname = '女';
                break;
            case 'F':
                $sexname = '男';
                break;
            default:
                break;
        }
        
        return $sexname;
    }
    
    public function getPaymentName($payment){
        $result = '';
        switch ($payment) {
            case '0':
                $result = '未';
                break;
            case '1':
                $result = '缴';
                break;
            default:
                break;
        }
        return $result;
    }

}
