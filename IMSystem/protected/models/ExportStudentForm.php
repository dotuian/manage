<?php

class ExportStudentForm extends CFormModel {

    public $grade;
    public $class_id;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('grade', 'required'),
            array('grade, class_id', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'grade' => '年级',
            'class_id' => '班级',
        );
    }

    public function afterValidate() {
        parent::afterValidate();
    }

    public function createFileName() {
        $filename = "学生基本信息_";
        
        if($this->grade != "") {
            $filename .= TClasses::model()->getEntryYearDisplayName($this->grade);
            $filename .= "_";
        }
        
        if($this->class_id != "") {
            $class = TClasses::model()->find("ID=:ID", array(":ID" => $this->class_id));
            if (!is_null($class)) {
                $filename .= $class->class_name;
                $filename .= "_";
            }
        }
        $filename .= date('Ymd') . '.xlsx';
        
        return $filename;
    }
    
    /**
     * 
     */
    public function getExcelData() {
        
        $sql = "SELECT a.*, b.student_number, c.class_code, ";
        $sql .= "(select aa.class_code from t_classes aa, t_student_classes bb where aa.ID=bb.class_id and bb.student_id=a.ID order by bb.create_time asc limit 1, 1) as old_class_code ";
        $sql .= "FROM t_students a  ";
        $sql .= "inner join t_student_classes b on a.ID=b.student_id and b.`status`='1' ";
        $sql .= "inner join t_classes c on c.ID=b.class_id  ";
        $sql .= "where 1=1 ";

        $params = array();
        
        if($this->grade != "") {
            $sql .= "and c.grade=:grade ";
            $params[':grade'] = $this->grade;
        }
        if($this->class_id != "") {
            $sql .= "and c.ID=:class_id ";
            $params[':class_id'] = $this->class_id;
        }

        $sql .= "order by c.class_code, b.student_number ";
        
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
        $objPHPExcel->getActiveSheet()->setTitle('学生基本信息');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();

        // 第1行：大标题
        // 第2,3行，小标题
        // 第4行开始，数据
        // =============================================================
        // 标题
        // =============================================================
        // 最大列数19列
        $lastColumn = PHPExcel_Cell::stringFromColumnIndex(18);
        // 大标题
        $worksheet->mergeCellsByColumnAndRow(0, 1, 18, 1);
        $worksheet->setCellValue("A1", "孝感生物工程学校学生信息一览表");
        $worksheet->getStyle("A1")->getFont()->setBold(true);
        $worksheet->getStyle("A1")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $worksheet->getStyle("A1")->getFont()->setName('宋体');
        $worksheet->getStyle("A1")->getFont()->setSize(12);
        
        $index = 1;  // 小标题开始行数
        // 学号
        $col = 0;
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "学号");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
        $col++;

        // 姓名
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "姓名");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
        $col++;

        //性别
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "性别");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;

        //身份证号码
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "身份证号码");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(20);
        $col++;

        //班级
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col + 1, $index + 1);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "班级");
        //班级(原)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "原");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(现)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "现");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;

        //住宿情况
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "住宿" . PHP_EOL . "情况");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
        $col++;

        //缴费情况
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col + 5, $index + 1);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "缴费情况");
        //班级(原)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第一".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(现)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第二".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(原)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第三".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(现)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第四".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(原)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第五".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        //班级(现)
        $worksheet->setCellValueByColumnAndRow($col, $index + 2, "第六".PHP_EOL."学期");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;
        
        //奖惩情况
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "奖惩" . PHP_EOL . "情况");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
        $col++;
        
        //家庭住址
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家庭住址");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(40);
        $col++;
        
        //家长电话
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家长电话");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
        $col++;
        
        //家长QQ
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "家长QQ");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
        $col++;
        
        //毕业学校
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "毕业学校");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
        $col++;
        
        //备注
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "备注");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
        $col++;

        // 标题设置为粗体，水平/垂直居中
        //$worksheet->getStyle("A2:{$lastColumn}3")->getFont()->setBold(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        // =============================================================
        // 数据
        // =============================================================
        $index = 4;  // 数据开始行数
        $column = 0;
        foreach ($data as $key => $value) {
            $colIndex = 0 ;
            // 姓名
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["student_number"], PHPExcel_Cell_DataType::TYPE_STRING); // 学号
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["name"]); 
            // 性别
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getSexName($value["sex"]));
            // 身份证号码
            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["id_card_no"], PHPExcel_Cell_DataType::TYPE_STRING); 
            // 班级(原)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["old_class_code"]); 
            // 班级(现)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["class_code"]); 
            
            // 住宿情况
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["accommodation"]); 
            
            // 缴费情况(第一学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment1"]));
            // 缴费情况(第二学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment2"])); 
            // 缴费情况(第三学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment3"])); 
            // 缴费情况(第四学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment4"])); 
            // 缴费情况(第五学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment5"])); 
            // 缴费情况(第六学期)
            $worksheet->getStyleByColumnAndRow($colIndex, $index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $this->getPaymentName($value["payment6"])); 
            // 奖惩情况
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["bonus_penalty"]); 
            // 家庭住址
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["address"]); 
            // 家长电话
            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["parents_tel"], PHPExcel_Cell_DataType::TYPE_STRING); 
            // 家长QQ
            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["parents_qq"], PHPExcel_Cell_DataType::TYPE_STRING); 
            // 毕业学校
            $worksheet->setCellValueByColumnAndRow($colIndex++, $index, $value["school_of_graduation"]); 
            // 备注
            $worksheet->setCellValueExplicitByColumnAndRow($colIndex++, $index, $value["comment"], PHPExcel_Cell_DataType::TYPE_STRING); 

            $index++;
        }

        // 设置数据区域边框
        $worksheet->getStyle("A2:{$lastColumn}" . ($index - 1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->getStyle("A2:{$lastColumn}" . ($index - 1))->getFont()->setName('宋体');
        $worksheet->getStyle("A2:{$lastColumn}" . ($index - 1))->getFont()->setSize(10);
        
        // 固定标题栏
        $worksheet->freezePane('A4');

        
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
        //$objWriter->save('php://output');
        
        // 在有些平台下，下载会出现格式错误时，可以采用下面的下载方式
        $filePath = "files\\download\\" . rand(0, getrandmax()) . rand(0, getrandmax()) . ".xlsx";
        $objWriter->SAVE($filePath);
        readfile($filePath);
        unlink($filePath);

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
