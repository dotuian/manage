<?php

class ReportForm extends CFormModel {

    public $entry_year;
    public $grade;
    public $exam_id;
    public $class_id;
    public $subject_id; 
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('entry_year, grade, exam_id, subject_id', 'required'),

            array('entry_year, grade, exam_id, subject_id, class_id', 'safe'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'entry_year' => '年度',
            'grade'      => '年级',
            'exam_id'    => '考试名称',
            'subject_id' => '科目',
            'class_id'   => '班级',
        );
    }
    
    
    public function afterValidate() {
        parent::afterValidate();

        if ($this->scenario === 'class') {

        }
    }
    
    /**
     * 
     */
    public function getExcelData() {
        $sql = "SELECT ";
        $sql .= "a.student_id, d.province_code, d.name, d.sex, d.senior_score, d.college_score, d.university, a.exam_id, b.exam_name, a.subject_id, c.subject_short_name, a.score, ";
        $sql .= " '101' as old_class_code, "; // 班级(原)
        $sql .= " (select aa.class_code from t_classes aa, t_student_classes bb where aa.ID=bb.class_id and bb.student_id=d.ID and bb.status='1') as new_class_code "; // 班级(旧)
        $sql .= "FROM t_scores a  ";
        $sql .= "inner JOIN m_exams b ON a.exam_id = b.ID   ";
        $sql .= "inner JOIN m_subjects c ON a.subject_id = c.ID  ";
        $sql .= "inner JOIN t_students d ON a.student_id = d.ID  ";
        $sql .= "inner JOIN t_student_classes e ON e.student_id = d.ID  ";
        $sql .= "inner join t_classes f on a.class_id = f.ID ";
        $sql .= "where f.grade=:grade and f.entry_year=:entry_year ";
        
        $params=array();
        $params[':grade'] = $this->grade;
        $params[':entry_year'] = $this->entry_year;
        
        // 考试
        if(is_array($this->exam_id) && count($this->exam_id) > 0) {
            $temp=array();
            foreach ($this->exam_id as $key => $value) {
                $temp[':exam_id' . $key] = $value;
            }
            $sql .= " and a.exam_id in (" . implode(", ",$temp) . ")";
        }

        // 科目
        if(is_array($this->subject_id) && count($this->subject_id) > 0) {
            $temp=array();
            foreach ($this->subject_id as $key => $value) {
                $temp[':subject_id' . $key] = $value;
            }
            $sql .= " and a.subject_id in (" . implode(", ",$temp) . ")";
        }

        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->queryAll(true, $params);
        
        // 数据整理
        $result=array();
        foreach ($data as $value) {
            // 学生KEY值（ID+省编学号+姓名）
            $key_student = $value['student_id'] . '|';
            $key_student .= $value['province_code']  . '|';
            $key_student .= $value['name']  . '|';
            $key_student .= ($value['sex'] == 'M' ? '女' : '男') . '|';
            $key_student .= $value['old_class_code']  . '|';  // 班级(原)
            $key_student .= $value['new_class_code']  . '|';  // 班级(现)
            $key_student .= $value['senior_score']  . '|';
            $key_student .= $value['college_score']  . '|';
            $key_student .= $value['university']  . '|';
            
            // 考试KEY值
            $key_exam = $value['exam_name'];
            // 科目KEY值
            $key_subject = $value['subject_short_name'];
            
            $result[$key_student][$key_exam][$key_subject] = $value['score'];
        }
        return $result;
    }
    
    public function getDataTitle($data) {
        $title = array();
        foreach ($data as $value) {
            foreach ($value as $exam => $score) {
                
                if(!isset($title[$exam])) {
                   $title[$exam] = array_keys($score);
                } else {
                    $title[$exam] = array_merge($title[$exam], array_keys($score));
                }
                
                $title[$exam] = array_unique($title[$exam]);
            }
        }
        return $title;
    }
    
    /**
     * 写文件
     * @param type $title
     * @param type $data
     */
    public function writeExcel($title, $data) {
        //error_reporting(E_ALL);
        
        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
        
        // Turn off our amazing library autoload 
        spl_autoload_unregister(array('YiiBase','autoload'));        

        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
        
        
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");
        
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('学生成绩总表');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $worksheet = $objPHPExcel->getActiveSheet();
        
        // 第1行：总标题
        // 第2,3行，标题
        // 第4行开始，数据
        
        
        // =============================================================
        // 标题
        // =============================================================
        $index = 1;  // 标题开始行数
        
        // 学号
        $col = 0;
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "学号");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(10);
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
        
        //中考分数
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "中考" . PHP_EOL . "分数");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
        $col++;
        
        //高考分数
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "高考" . PHP_EOL . "分数");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(8);
        $col++;
        
        //录取学校o
        $worksheet->mergeCellsByColumnAndRow($col, $index + 1, $col, $index + 2);
        $worksheet->setCellValueByColumnAndRow($col, $index + 1, "录取学校");
        $worksheet->getColumnDimensionByColumn($col)->setWidth(20);
        $col++;
        
        // 成绩开始填充的列数
        $startColumn = 8;
        // 考试名称标题
        foreach ($title as $key => $value) {
            // 考试名称
            $width = count($value);
            // 设置考试名称标题
            $worksheet->setCellValueByColumnAndRow($startColumn, $index + 1, $key);
            // 合并考试名称单元格
            $worksheet->mergeCellsByColumnAndRow($startColumn, $index + 1, $startColumn + $width - 1, $index + 1);

            // 科目名称
            foreach ($value as $v) {
                // 设置列宽
                $worksheet->getColumnDimensionByColumn($startColumn)->setWidth(5);
                
                // 标题数据
                $worksheet->setCellValueByColumnAndRow($startColumn++, $index + 2, $v);
            }
        }
        
        // 最后一列的字母表示
        $lastColumn = PHPExcel_Cell::stringFromColumnIndex($startColumn - 1);
        
        // 标题设置为粗体，水平/垂直居中
        $worksheet->getStyle("A2:{$lastColumn}3")->getFont()->setBold(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setWrapText(true);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $worksheet->getStyle("A2:{$lastColumn}3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        
        
        // =============================================================
        // 数据
        // =============================================================
        $index = 4;  // 数据开始行数
        $column = 0;
        foreach ($data as $key => $exams) {
            $s = explode('|', $key);
            
            // 设置学生信息列的数据
            $worksheet->setCellValueByColumnAndRow(0, $index, $s[1]); // 省编学号
            $worksheet->setCellValueByColumnAndRow(1, $index, $s[2]); // 姓名
            $worksheet->setCellValueByColumnAndRow(2, $index, $s[3]); // 性别
            $worksheet->setCellValueByColumnAndRow(3, $index, $s[4]); // 班级(原)
            $worksheet->setCellValueByColumnAndRow(4, $index, $s[5]); // 班级(现)
            $worksheet->setCellValueByColumnAndRow(5, $index, $s[6]); // 中考
            $worksheet->setCellValueByColumnAndRow(6, $index, $s[7]); // 高考
            $worksheet->setCellValueByColumnAndRow(7, $index, $s[8]); // 录取学校

//            $key_student = $value['student_id'] . '|';
//            $key_student .= $value['province_code']  . '|';
//            $key_student .= $value['name']  . '|';
//            $key_student .= ($value['sex'] == 'M' ? '女' : '男') . '|';
//            $key_student .= $value['senior_score']  . '|';  // 班级(原)
//            $key_student .= $value['new_class_code']  . '|';  // 班级(现)
//            $key_student .= $value['senior_score']  . '|';
//            $key_student .= $value['college_score']  . '|';
//            $key_student .= $value['university']  . '|';
            
            // 成绩开始的列
            $column = 8;
            foreach ($title as $key => $value) {
                foreach ($value as $v) {
                    $score = isset($exams[$key][$v]) ? $exams[$key][$v] : '';
                    $worksheet->setCellValueByColumnAndRow($column++, $index, $score);
                }
            }
            
            $index++;
        }
        
        // 设置数据区域边框
        $worksheet->getStyle("A2:{$lastColumn}" . ($index-1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        
        // 固定标题栏
        $worksheet->freezePane('I4');
        
        
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

//        $filename = time() . '.xlsx';
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//        $objWriter->save($filename);

        // Once we have finished using the library, give back the 
        // power to Yii... 
        spl_autoload_register(array('YiiBase','autoload'));
        
        return $filename;
    }
    
}
