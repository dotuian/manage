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
        $sql .= "where a.code <> 'root' ";

        $params = array();
        
        if($this->name != "") {
            $sql .= "and a.name like :name ";
            $params[':name'] = "%{$this->name}%";
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

        
        $objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objPHPExcel->load("files\\template\\export_teacher.xlsx");
        
        $worksheet = $objPHPExcel->getActiveSheet();
        
        $row = 5;
        foreach ($data as $key => $value) {
            $col = 0;
            //==============================
            // 基本情况
            //==============================
            //教工编号
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["code"]);
            //姓名
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["name"]);
            //性别
            
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $this->getSexName($value["name"]));
            //身份证号码
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["id_card_no"]);
            //家庭住址
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["home_address"]);
            //民族
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["nation"]);
            //籍贯
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["birthplace"]);
            //出生年月
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["birthday"]);
            //工作年月
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["working_date"]);
            //入党年月
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["party_date"]);
            //职前学历
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["before_degree"]);
            //职前学历毕业时间、院校及专业
            $temp = $value["before_graduate_date"] .PHP_EOL. $value["before_graduate_school"] .PHP_EOL. $value["before_graduate_major"];
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $temp);
            //现学历
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["current_degree"]);
            //现学历毕业时间、院校及专业
            $temp = $value["current_graduate_date"] .PHP_EOL. $value["current_graduate_school"] .PHP_EOL. $value["current_graduate_major"];
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $temp);
            //专业技职务
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["professional_technical_position"]);
            //工作科室及职务
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["work_departments_postion"]);
            //现职级
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["current_position_rank"]);
            //任现职年月
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["current_position_date"]);
            //任现级年月
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["current_level_date"]);
            //备注
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["basic_memo"]);
            
            //==============================
            // 师德档案
            //==============================
            //继续教育地址
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["continue_education_address"]); 
            //继续教育时间
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["continue_education_date"]); 
            //获得学分
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["continue_education_credit"]); 
            //证明人
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["continue_education_prove_people"]); 
            //表彰情况
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["moral_praise"]); 
            //学生测评
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["moral_student_evaluation"]); 
            //目标考核
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["moral_target_check"]); 
            //备注
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["moral_memo"]); 
            
            //==============================
            // 履职档案
            //==============================
            //任教年级
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["teach_grades"]); 
            //课程
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, str_replace(',', PHP_EOL, $value["teach_subjects"])); 
            //教研职务
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["teaching_research_postion"]); 
            //招生情况
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["recruit_students"]); 
            //考勤情况
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["attendance"]); 
            //备注
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["working_memo"]); 
            
            //==============================
            // 业务档案
            //==============================
            //辅导获奖
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["tutorship_award"]); 
            //参赛获奖
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["competition_award"]); 
            //论文著作
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["paper_work"]); 
            //参赛项目情况
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["competition_item"]); 
            //备注
            $worksheet->setCellValueExplicitByColumnAndRow($col++, $row, $value["business_memo"]); 
            
            $worksheet->getStyle("A{$row}:AM{$row}")->getAlignment()->setWrapText(true);
            $worksheet->getStyle("A{$row}:AM{$row}")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $worksheet->getStyle("A{$row}:AM{$row}")->getFont()->setName("宋体");
            $worksheet->getStyle("A{$row}:AM{$row}")->getFont()->setSize(9);
            
            $row++;
        }
        
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
        $objWriter->save($filePath);
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
}
