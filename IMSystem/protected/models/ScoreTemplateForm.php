<?php

class ScoreTemplateForm extends CFormModel {

    public $class_id;
    // 需要添加的课程信息
    public $subjects = array();

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('class_id, subjects', 'required'),

            array('class_id, subjects', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'class_id' => '班级',
            'subject_id' => '科目',
            'subjects' => '科目',
        );
    }
    
    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'template') {
            if (!TClasses::model()->exists("ID=:ID and status='1'", array(':ID' => $this->class_id))) {
                $this->addError('class_id', '班级信息不存在！');
            }

            if (empty($this->subjects) || count($this->subjects) == 0) {
                $this->addError('subjects', '请选择科目！');
            }
        }
    }
    
    
    /**
     * 
     */
    public function getStudentData() {
        $sql = "select b.student_number, a.name from t_students a  ";
        $sql .= "inner join t_student_classes b on a.ID=b.student_id and b.`status`='1' ";
        $sql .= "inner join t_classes c on c.ID=b.class_id and c.`status`='1' ";
        $sql .= "where a.`status`='1' ";

        $params = array();
        if($this->class_id != "") {
            $sql .= "and b.class_id=:class_id ";
            $params[':class_id'] = $this->class_id;
        }

        $sql .= "order by b.student_number  ";
        
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll(true, $params);

        return $data;
    }

    public function getSubjectData(){
        $criteria = new CDbCriteria();
        $criteria->addCondition("status='1'");
        $criteria->addInCondition('ID', array_values($this->subjects));
        $subjects = MSubjects::model()->findAll($criteria);
        
        return $subjects;
    }
    
    /**
     * 写文件
     * @param type $class
     * @param type $students
     * @param type $subjects
     */
    public function writeExcel($class, $students, $subjects) {
        $title = $class->getClassDisplayName(false, false) . "成绩表";

        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');

        // Turn off our amazing library autoload 
        spl_autoload_unregister(array('YiiBase', 'autoload'));

        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/IOFactory.php');
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel/Writer/Excel2007.php');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('成绩录入模板');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();

        // =============================================================
        // 标题
        // =============================================================
        // 列数
        $columns = 3 + count($subjects) - 1;
        $lastColumn = PHPExcel_Cell::stringFromColumnIndex($columns);

        // =============================================================
        // 大标题
        // =============================================================
        $row = 1;  // 小标题开始行数
        $col = 0;
        
        $worksheet->mergeCellsByColumnAndRow($col, $row, $columns, $row);
        $worksheet->setCellValueExplicitByColumnAndRow($col, $row, $title);
        $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setName('宋体');
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setSize(15);
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
        $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setWrapText(true);
        

        // =============================================================
        // 小标题
        // =============================================================
        $row = 2;  // 小标题开始行数
        $col = 0;
        
        // 学号
        $worksheet->setCellValueByColumnAndRow($col, $row, "No.");
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
        $worksheet->getColumnDimensionByColumn($col)->setWidth(5);
        $col++;

        // 学号
        $worksheet->setCellValueByColumnAndRow($col, $row, "学号");
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
        $worksheet->getColumnDimensionByColumn($col)->setWidth(15);
        $col++;

        // 姓名
        $worksheet->setCellValueByColumnAndRow($col, $row, "姓名");
        $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
        $col++;

        // 科目标题
        foreach ($subjects as $subject) {
            $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
            $worksheet->getStyleByColumnAndRow($col, $row)->getFont()->setBold(true);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $subject->subject_name);
        }
        
        $worksheet->getStyle("A2:{$lastColumn}2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A2:{$lastColumn}2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $worksheet->getStyle("A2:{$lastColumn}2")->getFont()->setBold(true);
        
        // =============================================================
        // 数据
        // =============================================================
        $row = 3;  // 数据开始行数
        $index = 1;
        foreach ($students as $value) {
            $col = 0;
            // 学号
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueExplicitByColumnAndRow($col, $row, $index++);
            $col++;
            
            // 学号
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueExplicitByColumnAndRow($col, $row, $value["student_number"]);
            $col++;
            
            // 姓名
            $worksheet->getStyleByColumnAndRow($col, $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $worksheet->setCellValueExplicitByColumnAndRow($col, $row, $value["name"]);
            $col++;
            
            $row++;
        }

        // 设置数据区域边框
        $worksheet->getStyle("A2:{$lastColumn}" . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $worksheet->getStyle("A2:{$lastColumn}" . ($row - 1))->getFont()->setName('宋体');
        $worksheet->getStyle("A2:{$lastColumn}" . ($row - 1))->getFont()->setSize(10);
        
        // 固定标题栏
        $worksheet->freezePane('A3');

        
        // =============================================================
        // 文件下载
        // =============================================================
        $filename = "成绩录入模板";
        
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
}
