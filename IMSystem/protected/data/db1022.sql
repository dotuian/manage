-- --------------------------------------------------------
-- ホスト:                          127.0.0.1
-- Server version:               5.6.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL バージョン:               7.0.0.4389
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for xsglxtsql
DROP DATABASE IF EXISTS `xsglxtsql`;
CREATE DATABASE IF NOT EXISTS `xsglxtsql` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `xsglxtsql`;


-- Dumping structure for table xsglxtsql.m_authoritys
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_authoritys: ~39 rows (approximately)
DELETE FROM `m_authoritys`;
/*!40000 ALTER TABLE `m_authoritys` DISABLE KEYS */;
INSERT INTO `m_authoritys` (`ID`, `authority_code`, `authority_name`, `category`, `level`, `access_path`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'STU001', '学生添加', 'STUDENT', 1, 'student/create', 0, '2014-10-08 11:01:20', 0, '2014-10-08 11:01:20'),
	(2, 'STU002', '学生检索', 'STUDENT', 2, 'student/search', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(3, 'STU003', '学生更新', 'STUDENT', 3, 'student/update', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(4, 'STU004', '学生删除', 'STUDENT', 4, 'student/delete', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(5, 'STU005', '学生信息导入', 'STUDENT', 5, 'student/import', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	(6, 'TEA001', '教师添加', 'TEACHER', 1, 'teacher/create', 0, '2014-10-08 11:02:38', 0, '2014-10-09 12:11:54'),
	(7, 'TEA002', '教师检索', 'TEACHER', 2, 'teacher/search', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(8, 'TEA003', '教师更新', 'TEACHER', 3, 'teacher/update', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(9, 'TEA004', '教师删除', 'TEACHER', 4, 'teacher/delete', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(10, 'CLA001', '班级添加', 'CLASS', 1, 'class/create', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(11, 'CLA002', '班级检索', 'CLASS', 2, 'class/search', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(12, 'CLA003', '班级更新', 'CLASS', 3, 'class/update', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(13, 'CLA004', '班级删除', 'CLASS', 4, 'class/delete', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(14, 'CLA005', '班级升级', 'CLASS', 5, 'class/upgrade', 0, '2014-10-08 11:04:09', 0, '2014-10-08 11:04:09'),
	(15, 'CLA006', '班级学生一览', 'CLASS', 6, 'class/stulist', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(16, 'COU001', '课程安排添加', 'COURSE', 1, 'course/create', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(17, 'COU002', '课程安排检索', 'COURSE', 2, 'course/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(18, 'COU003', '课程安排更新', 'COURSE', 3, 'course/update', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(19, 'COU004', '课程安排删除', 'COURSE', 4, 'course/delete', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(20, 'SCO001', '成绩添加', 'SCORE', 1, 'score/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(21, 'SCO002', '成绩检索', 'SCORE', 2, 'score/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(22, 'SCO003', '成绩更新', 'SCORE', 3, 'score/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(23, 'SCO004', '成绩删除', 'SCORE', 4, 'score/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(24, 'SCO005', '学生成绩查询', 'SCORE', 5, 'score/query', 0, '2014-10-09 14:26:49', 0, '2014-10-09 14:26:49'),
	(25, 'ROL001', '角色添加', 'ROLE', 1, 'role/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(26, 'ROL002', '角色检索', 'ROLE', 2, 'role/search', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(27, 'ROL003', '角色更新', 'ROLE', 3, 'role/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(28, 'ROL004', '角色删除', 'ROLE', 4, 'role/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(29, 'AUT001', '权限添加', 'AUTHORITY', 1, 'authority/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(30, 'AUT002', '权限检索', 'AUTHORITY', 2, 'authority/search', 0, '2014-10-09 14:37:03', 0, '2014-10-09 14:37:03'),
	(31, 'AUT003', '权限更新', 'AUTHORITY', 3, 'authority/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(32, 'AUT004', '权限删除', 'AUTHORITY', 4, 'authority/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(33, 'SUB001', '科目添加', 'SUBJECT', 1, 'subject/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(34, 'SUB002', '科目检索', 'SUBJECT', 2, 'subject/search', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(35, 'SUB003', '科目更新', 'SUBJECT', 3, 'subject/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(36, 'SUB004', '科目删除', 'SUBJECT', 4, 'subject/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(37, 'SET001', '个人信息修改', 'OTHER', 1, 'setting/profile', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(38, 'SET002', '密码变更', 'OTHER', 2, 'setting/password', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(39, 'SYS001', '系统设置', 'SYSTEM', 1, 'system/setting', 0, '2014-10-22 17:32:05', 0, '2014-10-22 17:32:05');
/*!40000 ALTER TABLE `m_authoritys` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_config
DROP TABLE IF EXISTS `m_config`;
CREATE TABLE IF NOT EXISTS `m_config` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(50) COLLATE utf8_bin NOT NULL COMMENT '键',
  `value` text COLLATE utf8_bin COMMENT '值',
  `comment` text COLLATE utf8_bin COMMENT '详细说明',
  PRIMARY KEY (`ID`),
  KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_config: ~0 rows (approximately)
DELETE FROM `m_config`;
/*!40000 ALTER TABLE `m_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_config` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_courses
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

-- Dumping data for table xsglxtsql.m_courses: ~0 rows (approximately)
DELETE FROM `m_courses`;
/*!40000 ALTER TABLE `m_courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_courses` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_exams
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

-- Dumping data for table xsglxtsql.m_exams: ~0 rows (approximately)
DELETE FROM `m_exams`;
/*!40000 ALTER TABLE `m_exams` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_exams` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_roles
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

-- Dumping data for table xsglxtsql.m_roles: ~6 rows (approximately)
DELETE FROM `m_roles`;
/*!40000 ALTER TABLE `m_roles` DISABLE KEYS */;
INSERT INTO `m_roles` (`ID`, `role_code`, `role_name`, `status`, `level`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROLE01', '学生', '1', 1, 0, '2014-10-08 11:10:17', 1, '2014-10-22 15:14:34'),
	(2, 'ROLE02', '教师', '1', 2, 0, '2014-10-08 11:11:47', 1, '2014-10-22 15:17:40'),
	(3, 'ROLE03', '学工科', '1', 3, 0, '2014-10-08 11:11:47', 1, '2014-10-22 15:16:55'),
	(4, 'ROLE04', '教务处', '1', 4, 0, '2014-10-08 11:11:47', 1, '2014-10-22 15:16:39'),
	(5, 'ROLE05', '校长', '1', 5, 1, '2014-10-09 15:34:20', 7, '2014-10-22 17:33:53'),
	(6, 'ROLE00', '系统管理员', '1', 0, 0, '2014-10-18 08:02:20', 7, '2014-10-22 17:32:27');
/*!40000 ALTER TABLE `m_roles` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_role_authoritys
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
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限表';

-- Dumping data for table xsglxtsql.m_role_authoritys: ~220 rows (approximately)
DELETE FROM `m_role_authoritys`;
/*!40000 ALTER TABLE `m_role_authoritys` DISABLE KEYS */;
INSERT INTO `m_role_authoritys` (`ID`, `role_id`, `authority_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 6, 10, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(2, 6, 11, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(3, 6, 12, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(4, 6, 13, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(5, 6, 14, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(6, 6, 15, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(7, 6, 33, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(8, 6, 34, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(9, 6, 35, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(10, 6, 36, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(11, 6, 16, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(12, 6, 17, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(13, 6, 18, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(14, 6, 19, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(15, 6, 1, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(16, 6, 2, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(17, 6, 3, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(18, 6, 4, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(19, 6, 5, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(20, 6, 6, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(21, 6, 7, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(22, 6, 8, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(23, 6, 9, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(24, 6, 20, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(25, 6, 21, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(26, 6, 22, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(27, 6, 23, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(28, 6, 24, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(29, 6, 25, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(30, 6, 26, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(31, 6, 27, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(32, 6, 28, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(33, 6, 29, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(34, 6, 30, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(35, 6, 31, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(36, 6, 32, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(37, 6, 37, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(38, 6, 38, 1, '2014-10-22 15:13:49', 1, '2014-10-22 15:13:49'),
	(39, 1, 24, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(40, 1, 37, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(41, 1, 38, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(42, 2, 37, 1, '2014-10-22 15:15:37', 1, '2014-10-22 15:15:37'),
	(43, 2, 38, 1, '2014-10-22 15:15:37', 1, '2014-10-22 15:15:37'),
	(44, 4, 10, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(45, 4, 11, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(46, 4, 12, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(47, 4, 13, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(48, 4, 14, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(49, 4, 15, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(50, 4, 33, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(51, 4, 34, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(52, 4, 35, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(53, 4, 36, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(54, 4, 16, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(55, 4, 17, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(56, 4, 18, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(57, 4, 19, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(58, 4, 6, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(59, 4, 7, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(60, 4, 8, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(61, 4, 9, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(62, 4, 20, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(63, 4, 21, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(64, 4, 22, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(65, 4, 23, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(66, 4, 24, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(67, 4, 37, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(68, 4, 38, 1, '2014-10-22 15:16:39', 1, '2014-10-22 15:16:39'),
	(69, 3, 1, 1, '2014-10-22 15:16:55', 1, '2014-10-22 15:16:55'),
	(70, 3, 4, 1, '2014-10-22 15:16:55', 1, '2014-10-22 15:16:55'),
	(71, 3, 5, 1, '2014-10-22 15:16:55', 1, '2014-10-22 15:16:55'),
	(72, 3, 37, 1, '2014-10-22 15:16:55', 1, '2014-10-22 15:16:55'),
	(73, 3, 38, 1, '2014-10-22 15:16:55', 1, '2014-10-22 15:16:55'),
	(74, 2, 14, 1, '2014-10-22 15:17:40', 1, '2014-10-22 15:17:40'),
	(75, 2, 15, 1, '2014-10-22 15:17:40', 1, '2014-10-22 15:17:40'),
	(76, 2, 37, 1, '2014-10-22 15:17:40', 1, '2014-10-22 15:17:40'),
	(77, 2, 38, 1, '2014-10-22 15:17:40', 1, '2014-10-22 15:17:40'),
	(78, 5, 10, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(79, 5, 11, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(80, 5, 12, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(81, 5, 13, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(82, 5, 14, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(83, 5, 15, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(84, 5, 33, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(85, 5, 34, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(86, 5, 35, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(87, 5, 36, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(88, 5, 16, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(89, 5, 17, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(90, 5, 18, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(91, 5, 19, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(92, 5, 1, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(93, 5, 2, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(94, 5, 3, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(95, 5, 4, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(96, 5, 5, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(97, 5, 6, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(98, 5, 7, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(99, 5, 8, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(100, 5, 9, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(101, 5, 20, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(102, 5, 21, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(103, 5, 22, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(104, 5, 23, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(105, 5, 24, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(106, 5, 25, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(107, 5, 26, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(108, 5, 27, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(109, 5, 28, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(110, 5, 37, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(111, 5, 38, 1, '2014-10-22 17:23:15', 1, '2014-10-22 17:23:15'),
	(112, 6, 10, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(113, 6, 11, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(114, 6, 12, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(115, 6, 13, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(116, 6, 14, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(117, 6, 15, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(118, 6, 33, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(119, 6, 34, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(120, 6, 35, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(121, 6, 36, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(122, 6, 16, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(123, 6, 17, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(124, 6, 18, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(125, 6, 19, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(126, 6, 1, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(127, 6, 2, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(128, 6, 3, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(129, 6, 4, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(130, 6, 5, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(131, 6, 6, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(132, 6, 7, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(133, 6, 8, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(134, 6, 9, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(135, 6, 20, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(136, 6, 21, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(137, 6, 22, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(138, 6, 23, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(139, 6, 24, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(140, 6, 25, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(141, 6, 26, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(142, 6, 27, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(143, 6, 28, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(144, 6, 29, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(145, 6, 30, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(146, 6, 31, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(147, 6, 32, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(148, 6, 37, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(149, 6, 38, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(150, 6, 39, 7, '2014-10-22 17:32:27', 7, '2014-10-22 17:32:27'),
	(151, 5, 10, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(152, 5, 11, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(153, 5, 12, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(154, 5, 13, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(155, 5, 14, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(156, 5, 15, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(157, 5, 33, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(158, 5, 34, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(159, 5, 35, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(160, 5, 36, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(161, 5, 16, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(162, 5, 17, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(163, 5, 18, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(164, 5, 19, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(165, 5, 1, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(166, 5, 2, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(167, 5, 3, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(168, 5, 4, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(169, 5, 5, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(170, 5, 6, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(171, 5, 7, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(172, 5, 8, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(173, 5, 9, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(174, 5, 20, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(175, 5, 21, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(176, 5, 22, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(177, 5, 23, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(178, 5, 24, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(179, 5, 25, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(180, 5, 26, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(181, 5, 27, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(182, 5, 28, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(183, 5, 37, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(184, 5, 38, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(185, 5, 39, 7, '2014-10-22 17:32:38', 7, '2014-10-22 17:32:38'),
	(186, 5, 10, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(187, 5, 11, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(188, 5, 12, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(189, 5, 13, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(190, 5, 14, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(191, 5, 15, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(192, 5, 33, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(193, 5, 34, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(194, 5, 35, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(195, 5, 36, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(196, 5, 16, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(197, 5, 17, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(198, 5, 18, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(199, 5, 19, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(200, 5, 1, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(201, 5, 2, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(202, 5, 3, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(203, 5, 4, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(204, 5, 5, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(205, 5, 6, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(206, 5, 7, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(207, 5, 8, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(208, 5, 9, 7, '2014-10-22 17:33:53', 7, '2014-10-22 17:33:53'),
	(209, 5, 20, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(210, 5, 21, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(211, 5, 22, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(212, 5, 23, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(213, 5, 24, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(214, 5, 25, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(215, 5, 26, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(216, 5, 27, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(217, 5, 28, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(218, 5, 37, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(219, 5, 38, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54'),
	(220, 5, 39, 7, '2014-10-22 17:33:54', 7, '2014-10-22 17:33:54');
/*!40000 ALTER TABLE `m_role_authoritys` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_subjects
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程科目表';

-- Dumping data for table xsglxtsql.m_subjects: ~9 rows (approximately)
DELETE FROM `m_subjects`;
/*!40000 ALTER TABLE `m_subjects` DISABLE KEYS */;
INSERT INTO `m_subjects` (`ID`, `subject_code`, `subject_name`, `subject_short_name`, `subject_type`, `status`, `level`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'YX', '语文', '语', '0', '1', 1, 0, '2014-09-23 10:47:15', 0, '2014-09-23 10:47:15'),
	(2, 'SX', '数学', '数', '0', '1', 2, 0, '2014-09-23 10:48:58', 0, '2014-09-23 10:48:58'),
	(3, 'YY', '英语', '英', '0', '1', 3, 0, '2014-09-23 10:49:07', 0, '2014-09-23 10:49:07'),
	(4, 'WL', '物理', '物', '1', '1', 4, 0, '2014-09-23 10:49:14', 0, '2014-09-23 10:49:14'),
	(5, 'HX', '化学', '化', '1', '1', 5, 0, '2014-09-23 10:49:18', 0, '2014-09-23 10:49:18'),
	(6, 'SW', '生物', '生', '1', '1', 6, 0, '2014-09-23 10:49:44', 1526, '2014-10-15 17:39:55'),
	(7, 'ZZ', '政治', '政', '1', '1', 7, 0, '2014-09-23 10:49:29', 0, '2014-09-23 10:49:29'),
	(8, 'LS', '历史', '史', '1', '1', 8, 0, '2014-09-23 10:49:34', 0, '2014-09-23 10:49:34'),
	(9, 'DL', '地理', '地', '1', '1', 9, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44');
/*!40000 ALTER TABLE `m_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_classes
DROP TABLE IF EXISTS `t_classes`;
CREATE TABLE IF NOT EXISTS `t_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '班级CODE',
  `class_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '班级名称',
  `class_type` char(1) COLLATE utf8_bin DEFAULT '0' COMMENT '班级类型(0:综合   1:文科   2:理科)',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:在校 2:毕业)',
  `term_year` int(4) DEFAULT NULL COMMENT '届',
  `teacher_id` int(10) unsigned DEFAULT NULL COMMENT '班主任ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `FK_t_classes_t_teachers` (`teacher_id`),
  CONSTRAINT `FK_t_classes_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='班级表';

-- Dumping data for table xsglxtsql.t_classes: ~6 rows (approximately)
DELETE FROM `t_classes`;
/*!40000 ALTER TABLE `t_classes` DISABLE KEYS */;
INSERT INTO `t_classes` (`ID`, `class_code`, `class_name`, `class_type`, `status`, `term_year`, `teacher_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'C0001', '高一(1)', '0', '1', 2014, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(2, 'C0002', '高一(2)', '0', '1', 2014, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(3, 'C0003', '高二(1)', '1', '1', 2013, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(4, 'C0004', '高二(2)', '2', '1', 2013, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(5, 'C0005', '高三(1)', '1', '2', 2012, NULL, 0, '2014-09-23 17:17:22', 0, '2014-10-17 23:19:03'),
	(6, 'C0006', '高三(2)', '2', '1', 2012, NULL, 0, '2014-09-23 17:17:22', 0, '2014-10-02 15:33:09');
/*!40000 ALTER TABLE `t_classes` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_file_upload
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

-- Dumping data for table xsglxtsql.t_file_upload: ~0 rows (approximately)
DELETE FROM `t_file_upload`;
/*!40000 ALTER TABLE `t_file_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_file_upload` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_scores
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

-- Dumping data for table xsglxtsql.t_scores: ~0 rows (approximately)
DELETE FROM `t_scores`;
/*!40000 ALTER TABLE `t_scores` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_scores` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_students
DROP TABLE IF EXISTS `t_students`;
CREATE TABLE IF NOT EXISTS `t_students` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` char(20) COLLATE utf8_bin NOT NULL COMMENT '学号',
  `name` char(12) COLLATE utf8_bin NOT NULL COMMENT '姓名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:在校 2:离校)',
  `sex` enum('F','M') COLLATE utf8_bin NOT NULL COMMENT '性别(F: 女 M:男)',
  `id_card_no` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '身份证号码',
  `birthday` date DEFAULT NULL COMMENT '出生年月日',
  `class_id` int(10) unsigned NOT NULL COMMENT '现在所在班级ID',
  `old_class_id` int(10) unsigned DEFAULT NULL COMMENT '原先所在班级ID',
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
  KEY `FK_t_students_t_classes` (`class_id`),
  KEY `FK_t_students_t_classes_2` (`old_class_id`),
  CONSTRAINT `FK_t_students_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_students_t_classes_2` FOREIGN KEY (`old_class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_students_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- Dumping data for table xsglxtsql.t_students: ~0 rows (approximately)
DELETE FROM `t_students`;
/*!40000 ALTER TABLE `t_students` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_students` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_teachers
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teachers: ~5 rows (approximately)
DELETE FROM `t_teachers`;
/*!40000 ALTER TABLE `t_teachers` DISABLE KEYS */;
INSERT INTO `t_teachers` (`ID`, `code`, `name`, `status`, `sex`, `birthday`, `address`, `telephonoe`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROOT', '管理员', '1', 'F', '2014-10-22', NULL, NULL, 0, '2014-10-22 15:02:30', 0, '2014-10-22 15:02:30'),
	(5, 'jwc', '教务处', '1', 'M', '2014-10-22', NULL, NULL, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(6, 'xgc', '学工科', '1', 'M', '2014-10-22', NULL, NULL, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', '校长', '1', 'M', '2014-10-22', NULL, NULL, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', '语文教师001', '1', 'M', '2014-10-08', '地址不', '电话号', 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59');
/*!40000 ALTER TABLE `t_teachers` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_teacher_subjects
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teacher_subjects: ~1 rows (approximately)
DELETE FROM `t_teacher_subjects`;
/*!40000 ALTER TABLE `t_teacher_subjects` DISABLE KEYS */;
INSERT INTO `t_teacher_subjects` (`ID`, `teacher_id`, `subject_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 8, 1, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59');
/*!40000 ALTER TABLE `t_teacher_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_users
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- Dumping data for table xsglxtsql.t_users: ~5 rows (approximately)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`ID`, `username`, `password`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', 'rootadmin', '1', 0, '2014-10-22 15:01:57', 0, '2014-10-22 15:01:57'),
	(5, 'jwc', 'test1234', '1', 1, '2014-10-22 17:12:54', 1, '2014-10-22 17:12:54'),
	(6, 'xgc', 'test1234', '1', 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', 'test1234', '1', 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', 'test1234', '1', 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59');
/*!40000 ALTER TABLE `t_users` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_user_roles
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- Dumping data for table xsglxtsql.t_user_roles: ~5 rows (approximately)
DELETE FROM `t_user_roles`;
/*!40000 ALTER TABLE `t_user_roles` DISABLE KEYS */;
INSERT INTO `t_user_roles` (`ID`, `user_id`, `role_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 6, 0, '2014-10-22 17:11:40', 0, '2014-10-22 17:11:40'),
	(2, 5, 4, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(3, 6, 3, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(4, 7, 5, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(5, 8, 2, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59');
/*!40000 ALTER TABLE `t_user_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
