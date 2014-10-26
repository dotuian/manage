-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        5.6.20-log - MySQL Community Server (GPL)
-- 服务器操作系统:                      Win32
-- HeidiSQL 版本:                  8.3.0.4820
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 导出 xsglxtsql 的数据库结构
DROP DATABASE IF EXISTS `xsglxtsql`;
CREATE DATABASE IF NOT EXISTS `xsglxtsql` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `xsglxtsql`;


-- 导出  表 xsglxtsql.m_authoritys 结构
DROP TABLE IF EXISTS `m_authoritys`;
CREATE TABLE IF NOT EXISTS `m_authoritys` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `authority_code` char(10) COLLATE utf8_bin NOT NULL COMMENT '权限CODE',
  `authority_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '权限名称',
  `category` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '权限分类',
  `level` int(11) DEFAULT NULL COMMENT '排序用',
  `access_path` char(100) COLLATE utf8_bin DEFAULT NULL COMMENT '访问路径',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `authority_code` (`authority_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_config 结构
DROP TABLE IF EXISTS `m_config`;
CREATE TABLE IF NOT EXISTS `m_config` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(50) COLLATE utf8_bin NOT NULL COMMENT '键',
  `value` text COLLATE utf8_bin COMMENT '值',
  `comment` text COLLATE utf8_bin COMMENT '详细说明',
  PRIMARY KEY (`ID`),
  KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_courses 结构
DROP TABLE IF EXISTS `m_courses`;
CREATE TABLE IF NOT EXISTS `m_courses` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目名称',
  `teacher_id` int(10) unsigned NOT NULL COMMENT '任课教师',
  `class_id` int(10) unsigned NOT NULL COMMENT '上课班级',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_m_courses_m_subjects` (`subject_id`),
  KEY `FK_m_courses_t_teachers` (`teacher_id`),
  KEY `FK_m_courses_t_classes` (`class_id`),
  CONSTRAINT `FK_m_courses_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_m_courses_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_m_courses_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_exams 结构
DROP TABLE IF EXISTS `m_exams`;
CREATE TABLE IF NOT EXISTS `m_exams` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `exam_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '考试CODE',
  `exam_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '考试名称',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='考试类型';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_roles 结构
DROP TABLE IF EXISTS `m_roles`;
CREATE TABLE IF NOT EXISTS `m_roles` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_code` char(10) COLLATE utf8_bin NOT NULL COMMENT '角色CODE',
  `role_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '角色名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2：删除)',
  `level` bigint(2) unsigned DEFAULT NULL COMMENT '排序用',
  `create_user` int(11) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `role_code` (`role_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_role_authoritys 结构
DROP TABLE IF EXISTS `m_role_authoritys`;
CREATE TABLE IF NOT EXISTS `m_role_authoritys` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `authority_id` int(10) unsigned NOT NULL COMMENT '权限ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `role_id_authority_id` (`role_id`,`authority_id`),
  KEY `FK_m_role_authoritys_m_authoritys` (`authority_id`),
  CONSTRAINT `FK_m_role_authoritys_m_authoritys` FOREIGN KEY (`authority_id`) REFERENCES `m_authoritys` (`ID`),
  CONSTRAINT `FK_m_role_authoritys_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.m_subjects 结构
DROP TABLE IF EXISTS `m_subjects`;
CREATE TABLE IF NOT EXISTS `m_subjects` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_code` char(10) COLLATE utf8_bin NOT NULL COMMENT '科目CODE',
  `subject_name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '科目名称',
  `subject_short_name` varchar(4) COLLATE utf8_bin NOT NULL COMMENT '科目名称(简称)',
  `subject_type` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '科目类型(0:普高 1:技能)',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `level` int(2) unsigned NOT NULL COMMENT '显示排序用',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程科目表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_classes 结构
DROP TABLE IF EXISTS `t_classes`;
CREATE TABLE IF NOT EXISTS `t_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '班级CODE',
  `class_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '班级名称',
  `class_type` char(1) COLLATE utf8_bin DEFAULT '0' COMMENT '班级类型(0:普通高中 1:技能专业)',
  `specialty_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '专业名称',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:使用中 2:未使用)',
  `term_year` int(4) DEFAULT NULL COMMENT '入学年份',
  `teacher_id` int(10) unsigned DEFAULT NULL COMMENT '班主任ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_classes_t_teachers` (`teacher_id`),
  CONSTRAINT `FK_t_classes_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='班级表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_file_upload 结构
DROP TABLE IF EXISTS `t_file_upload`;
CREATE TABLE IF NOT EXISTS `t_file_upload` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `filename` char(50) COLLATE utf8_bin NOT NULL COMMENT '上传文件名',
  `realpath` char(128) COLLATE utf8_bin NOT NULL COMMENT '保存文件路径',
  `category` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用途',
  `status` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '状态(0:未处理  1:处理正常  2:处理异常)',
  `create_user` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_scores 结构
DROP TABLE IF EXISTS `t_scores`;
CREATE TABLE IF NOT EXISTS `t_scores` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `exam_id` int(10) unsigned NOT NULL COMMENT '考试名称ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `class_id` int(10) unsigned NOT NULL COMMENT '班级ID',
  `student_id` int(10) unsigned NOT NULL COMMENT '学生ID',
  `score` float NOT NULL COMMENT '分数',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_scores_m_exams` (`exam_id`),
  KEY `FK_t_scores_t_students` (`student_id`),
  KEY `FK_t_scores_m_subjects` (`subject_id`),
  KEY `FK_t_scores_t_classes` (`class_id`),
  CONSTRAINT `FK_t_scores_m_exams` FOREIGN KEY (`exam_id`) REFERENCES `m_exams` (`ID`),
  CONSTRAINT `FK_t_scores_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_t_scores_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_scores_t_students` FOREIGN KEY (`student_id`) REFERENCES `t_students` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='成绩表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_students 结构
DROP TABLE IF EXISTS `t_students`;
CREATE TABLE IF NOT EXISTS `t_students` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` char(20) COLLATE utf8_bin NOT NULL COMMENT '学号',
  `name` char(12) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:在校 2:离校)',
  `sex` enum('F','M') COLLATE utf8_bin NOT NULL COMMENT '性别(F: 女 M:男)',
  `id_card_no` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '身份证号码',
  `birthday` date DEFAULT NULL COMMENT '出生年月日',
  `accommodation` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '住宿情况',
  `payment1` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第1学期）(0: 未缴  1:已缴)',
  `payment2` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第2学期）',
  `payment3` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第3学期）',
  `payment4` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第4学期）',
  `payment5` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第5学期）',
  `payment6` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '缴费情况（第6学期）',
  `bonus_penalty` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '奖惩情况',
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '家庭住址',
  `parents_tel` char(11) COLLATE utf8_bin DEFAULT NULL COMMENT '家长电话',
  `parents_qq` char(15) COLLATE utf8_bin DEFAULT NULL COMMENT '家长QQ',
  `school_of_graduation` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '毕业学校',
  `senior_score` float unsigned DEFAULT NULL COMMENT '中考总分',
  `school_year` int(11) DEFAULT NULL COMMENT '入学年份',
  `college_score` float unsigned DEFAULT NULL COMMENT '高考总分',
  `university` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '录取学校',
  `comment` text COLLATE utf8_bin COMMENT '备注',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `student_code` (`code`),
  CONSTRAINT `FK_t_students_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_student_classes 结构
DROP TABLE IF EXISTS `t_student_classes`;
CREATE TABLE IF NOT EXISTS `t_student_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生ID',
  `class_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级ID',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0:暂停 1:正常',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_student_classes_t_classes` (`class_id`),
  KEY `FK_t_student_classes_t_students` (`student_id`),
  CONSTRAINT `FK_t_student_classes_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_student_classes_t_students` FOREIGN KEY (`student_id`) REFERENCES `t_students` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_teachers 结构
DROP TABLE IF EXISTS `t_teachers`;
CREATE TABLE IF NOT EXISTS `t_teachers` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` char(20) COLLATE utf8_bin NOT NULL COMMENT '教师CODE',
  `name` char(12) COLLATE utf8_bin NOT NULL COMMENT '教师姓名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `sex` enum('F','M') COLLATE utf8_bin NOT NULL COMMENT '性别(F: 女 M:男)',
  `birthday` date DEFAULT NULL COMMENT '出生年月日',
  `address` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '地址',
  `telephonoe` char(11) COLLATE utf8_bin DEFAULT NULL COMMENT '电话号码',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `teacher_code` (`code`),
  CONSTRAINT `FK_t_teacher_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_teacher_subjects 结构
DROP TABLE IF EXISTS `t_teacher_subjects`;
CREATE TABLE IF NOT EXISTS `t_teacher_subjects` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `teacher_id` int(10) unsigned NOT NULL COMMENT '教师ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_teacher_subjects_t_teachers` (`teacher_id`),
  KEY `FK_t_teacher_subjects_m_subjects` (`subject_id`),
  CONSTRAINT `FK_t_teacher_subjects_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_t_teacher_subjects_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_users 结构
DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` char(20) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- 数据导出被取消选择。


-- 导出  表 xsglxtsql.t_user_roles 结构
DROP TABLE IF EXISTS `t_user_roles`;
CREATE TABLE IF NOT EXISTS `t_user_roles` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `create_user` int(10) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_user` int(10) NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_user_roles_m_roles` (`role_id`),
  KEY `user_id_role_id` (`user_id`,`role_id`),
  CONSTRAINT `FK_t_user_roles_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`),
  CONSTRAINT `FK_t_user_roles_t_users` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- 数据导出被取消选择。
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
