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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `authority_code` (`authority_code`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_authoritys: ~40 rows (approximately)
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
	(15, 'CLA006', '班级学生一览', 'CLASS', 6, 'class/student', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(16, 'COU001', '课程安排添加', 'COURSE', 1, 'course/create', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(17, 'COU002', '课程安排检索', 'COURSE', 2, 'course/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(18, 'COU003', '课程安排更新', 'COURSE', 3, 'course/update', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(19, 'COU004', '课程安排删除', 'COURSE', 4, 'course/delete', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(20, 'SCO001', '成绩添加', 'SCORE', 1, 'score/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(21, 'SCO002', '成绩检索', 'SCORE', 2, 'score/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(22, 'SCO003', '成绩更新', 'SCORE', 3, 'score/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(23, 'SCO004', '成绩删除', 'SCORE', 4, 'score/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(24, 'SCO005', '成绩查询(学生)', 'SCORE', 5, 'score/query', 0, '2014-10-09 14:26:49', 0, '2014-10-09 14:26:49'),
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
	(39, 'SYS001', '系统设置', 'SYSTEM', 1, 'system/setting', 0, '2014-10-22 17:32:05', 0, '2014-10-22 17:32:05'),
	(40, 'SCO006', '班级学生成绩', 'SCORE', 6, 'score/class', 1, '2014-10-24 19:56:33', 1, '2014-10-24 19:56:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_config: ~2 rows (approximately)
DELETE FROM `m_config`;
/*!40000 ALTER TABLE `m_config` DISABLE KEYS */;
INSERT INTO `m_config` (`ID`, `key`, `value`, `comment`) VALUES
	(1, 'IMPORT_STUDENT_DATA_RANGE', '2014-09-09|2014-10-29', NULL),
	(2, 'IS_RUNNING', '1', NULL);
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_m_courses_m_subjects` (`subject_id`),
  KEY `FK_m_courses_t_teachers` (`teacher_id`),
  KEY `FK_m_courses_t_classes` (`class_id`),
  CONSTRAINT `FK_m_courses_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_m_courses_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_m_courses_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程表';

-- Dumping data for table xsglxtsql.m_courses: ~9 rows (approximately)
DELETE FROM `m_courses`;
/*!40000 ALTER TABLE `m_courses` DISABLE KEYS */;
INSERT INTO `m_courses` (`ID`, `subject_id`, `teacher_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 8, 1, '1', 1, '2014-10-24 15:27:31', 1, '2014-10-24 15:27:31'),
	(2, 2, 10, 1, '1', 1, '2014-10-24 15:27:34', 1, '2014-10-24 15:27:34'),
	(3, 3, 12, 1, '1', 1, '2014-10-24 15:27:37', 1, '2014-10-24 15:27:37'),
	(4, 4, 13, 1, '1', 1, '2014-10-24 15:44:01', 1, '2014-10-24 15:44:01'),
	(5, 5, 14, 1, '1', 1, '2014-10-24 15:44:04', 1, '2014-10-24 15:44:04'),
	(6, 6, 11, 1, '1', 1, '2014-10-24 15:44:07', 1, '2014-10-24 15:44:07'),
	(7, 7, 15, 1, '1', 1, '2014-10-24 15:44:09', 1, '2014-10-24 15:44:09'),
	(8, 8, 16, 1, '1', 1, '2014-10-24 15:44:12', 1, '2014-10-24 15:44:12'),
	(9, 9, 20, 1, '1', 1, '2014-10-24 15:44:15', 1, '2014-10-24 15:44:17');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='考试类型';

-- Dumping data for table xsglxtsql.m_exams: ~15 rows (approximately)
DELETE FROM `m_exams`;
/*!40000 ALTER TABLE `m_exams` DISABLE KEYS */;
INSERT INTO `m_exams` (`ID`, `exam_code`, `exam_name`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'E10', '第一学期(期中)', '1', 0, '2014-09-23 10:39:06', 0, '2014-09-23 10:39:06'),
	(2, 'E11', '第一学期(期末)', '1', 0, '2014-09-23 10:39:06', 0, '2014-09-23 10:39:06'),
	(3, 'E20', '第二学期(期中)', '1', 0, '2014-09-23 10:39:06', 0, '2014-09-23 10:39:06'),
	(4, 'E21', '第二学期(期末)', '1', 0, '2014-09-23 10:39:06', 0, '2014-09-23 10:39:06'),
	(5, 'E30', '第三学期(期中)', '1', 0, '2014-09-23 10:41:00', 0, '2014-09-23 10:41:00'),
	(6, 'E31', '第三学期(期末)', '1', 0, '2014-09-23 10:41:31', 0, '2014-09-23 10:41:31'),
	(7, 'E40', '第四学期(期中)', '1', 0, '2014-09-23 10:42:34', 0, '2014-09-23 10:42:34'),
	(8, 'E41', '第四学期(期末)', '1', 0, '2014-09-23 10:42:33', 0, '2014-09-23 10:42:33'),
	(9, 'E50', '第五学期(期中)', '1', 0, '2014-09-23 10:42:32', 0, '2014-09-23 10:42:32'),
	(10, 'E51', '第五学期(期末)', '1', 0, '2014-09-23 10:42:32', 0, '2014-09-23 10:42:32'),
	(11, 'E60', '第六学期(期中)', '1', 0, '2014-09-23 10:42:33', 0, '2014-09-23 10:42:33'),
	(12, 'E61', '第六学期(期末)', '1', 0, '2014-09-23 10:42:34', 0, '2014-09-23 10:42:34'),
	(13, 'T01', '第一次统考', '1', 0, '2014-09-23 10:46:06', 0, '2014-09-23 10:46:06'),
	(14, 'T02', '第二次统考', '1', 0, '2014-09-23 10:46:06', 0, '2014-09-23 10:46:06'),
	(15, 'T02', '第三次统考', '1', 0, '2014-09-23 10:46:06', 0, '2014-09-23 10:46:06');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `role_code` (`role_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

-- Dumping data for table xsglxtsql.m_roles: ~6 rows (approximately)
DELETE FROM `m_roles`;
/*!40000 ALTER TABLE `m_roles` DISABLE KEYS */;
INSERT INTO `m_roles` (`ID`, `role_code`, `role_name`, `status`, `level`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROLE01', '学生', '1', 1, 0, '2014-10-08 11:10:17', 1, '2014-10-22 15:14:34'),
	(2, 'ROLE02', '教师', '1', 2, 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:23'),
	(3, 'ROLE03', '学工科', '1', 3, 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:51:52'),
	(4, 'ROLE04', '教务处', '1', 4, 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:40'),
	(5, 'ROLE05', '校长', '1', 5, 1, '2014-10-09 15:34:20', 1, '2014-10-24 19:57:38'),
	(6, 'ROLE00', '系统管理员', '1', 0, 0, '2014-10-24 18:04:37', 1, '2014-10-24 20:01:11');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `role_id_authority_id` (`role_id`,`authority_id`),
  KEY `FK_m_role_authoritys_m_authoritys` (`authority_id`),
  CONSTRAINT `FK_m_role_authoritys_m_authoritys` FOREIGN KEY (`authority_id`) REFERENCES `m_authoritys` (`ID`),
  CONSTRAINT `FK_m_role_authoritys_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=509 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限表';

-- Dumping data for table xsglxtsql.m_role_authoritys: ~108 rows (approximately)
DELETE FROM `m_role_authoritys`;
/*!40000 ALTER TABLE `m_role_authoritys` DISABLE KEYS */;
INSERT INTO `m_role_authoritys` (`ID`, `role_id`, `authority_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(39, 1, 24, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(40, 1, 37, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(41, 1, 38, 1, '2014-10-22 15:14:34', 1, '2014-10-22 15:14:34'),
	(374, 3, 1, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(375, 3, 2, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(376, 3, 3, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(377, 3, 4, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(378, 3, 5, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(379, 3, 37, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(380, 3, 38, 1, '2014-10-24 19:51:52', 1, '2014-10-24 19:51:52'),
	(411, 5, 10, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(412, 5, 11, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(413, 5, 12, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(414, 5, 13, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(415, 5, 14, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(416, 5, 15, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(417, 5, 33, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(418, 5, 34, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(419, 5, 35, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(420, 5, 36, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(421, 5, 16, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(422, 5, 17, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(423, 5, 18, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(424, 5, 19, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(425, 5, 1, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(426, 5, 2, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(427, 5, 3, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(428, 5, 4, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(429, 5, 5, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(430, 5, 6, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(431, 5, 7, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(432, 5, 8, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(433, 5, 9, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(434, 5, 40, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(435, 5, 20, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(436, 5, 21, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(437, 5, 22, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(438, 5, 23, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(439, 5, 37, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(440, 5, 38, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(441, 5, 39, 1, '2014-10-24 19:57:38', 1, '2014-10-24 19:57:38'),
	(442, 2, 40, 1, '2014-10-24 19:58:23', 1, '2014-10-24 19:58:23'),
	(443, 2, 37, 1, '2014-10-24 19:58:23', 1, '2014-10-24 19:58:23'),
	(444, 2, 38, 1, '2014-10-24 19:58:23', 1, '2014-10-24 19:58:23'),
	(445, 4, 10, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(446, 4, 11, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(447, 4, 12, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(448, 4, 13, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(449, 4, 14, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(450, 4, 15, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(451, 4, 33, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(452, 4, 34, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(453, 4, 35, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(454, 4, 36, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(455, 4, 16, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(456, 4, 17, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(457, 4, 18, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(458, 4, 19, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(459, 4, 6, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(460, 4, 7, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(461, 4, 8, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(462, 4, 9, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(463, 4, 20, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(464, 4, 21, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(465, 4, 22, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(466, 4, 23, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(467, 4, 40, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(468, 4, 37, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(469, 4, 38, 1, '2014-10-24 19:58:40', 1, '2014-10-24 19:58:40'),
	(470, 6, 10, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(471, 6, 11, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(472, 6, 12, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(473, 6, 13, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(474, 6, 14, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(475, 6, 15, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(476, 6, 33, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(477, 6, 34, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(478, 6, 35, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(479, 6, 36, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(480, 6, 16, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(481, 6, 17, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(482, 6, 18, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(483, 6, 19, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(484, 6, 1, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(485, 6, 2, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(486, 6, 3, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(487, 6, 4, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(488, 6, 5, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(489, 6, 6, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(490, 6, 7, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(491, 6, 8, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(492, 6, 9, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(493, 6, 20, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(494, 6, 21, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(495, 6, 22, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(496, 6, 23, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(497, 6, 40, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(498, 6, 25, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(499, 6, 26, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(500, 6, 27, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(501, 6, 28, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(502, 6, 29, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(503, 6, 30, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(504, 6, 31, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(505, 6, 32, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(506, 6, 37, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(507, 6, 38, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11'),
	(508, 6, 39, 1, '2014-10-24 20:01:11', 1, '2014-10-24 20:01:11');
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
  `update_time` timestamp NULL DEFAULT NULL,
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
  `class_type` char(1) COLLATE utf8_bin DEFAULT '0' COMMENT '班级类型(0:普通高中 1:技能专业)',
  `specialty_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '专业名称',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:使用中 2:未使用)',
  `term_year` int(4) DEFAULT NULL COMMENT '入学年份',
  `teacher_id` int(10) unsigned DEFAULT NULL COMMENT '班主任ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_classes_t_teachers` (`teacher_id`),
  CONSTRAINT `FK_t_classes_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='班级表';

-- Dumping data for table xsglxtsql.t_classes: ~6 rows (approximately)
DELETE FROM `t_classes`;
/*!40000 ALTER TABLE `t_classes` DISABLE KEYS */;
INSERT INTO `t_classes` (`ID`, `class_code`, `class_name`, `class_type`, `specialty_name`, `status`, `term_year`, `teacher_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'C0001', '高一(1)', '0', NULL, '1', 2014, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(2, 'C0002', '高一(2)', '0', NULL, '1', 2014, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(3, 'C0003', '高二(1)', '1', NULL, '1', 2013, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(4, 'C0004', '高二(2)', '2', NULL, '1', 2013, NULL, 0, '2014-09-23 17:17:22', 0, '2014-09-23 17:17:22'),
	(5, 'C0005', '高三(1)', '1', NULL, '2', 2012, NULL, 0, '2014-09-23 17:17:22', 0, '2014-10-17 23:19:03'),
	(6, 'C0006', '高三(2)', '2', NULL, '1', 2012, NULL, 0, '2014-09-23 17:17:22', 0, '2014-10-02 15:33:09');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.t_file_upload: ~1 rows (approximately)
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_scores_m_exams` (`exam_id`),
  KEY `FK_t_scores_t_students` (`student_id`),
  KEY `FK_t_scores_m_subjects` (`subject_id`),
  KEY `FK_t_scores_t_classes` (`class_id`),
  CONSTRAINT `FK_t_scores_m_exams` FOREIGN KEY (`exam_id`) REFERENCES `m_exams` (`ID`),
  CONSTRAINT `FK_t_scores_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_t_scores_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_scores_t_students` FOREIGN KEY (`student_id`) REFERENCES `t_students` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='成绩表';

-- Dumping data for table xsglxtsql.t_scores: ~18 rows (approximately)
DELETE FROM `t_scores`;
/*!40000 ALTER TABLE `t_scores` DISABLE KEYS */;
INSERT INTO `t_scores` (`ID`, `exam_id`, `subject_id`, `class_id`, `student_id`, `score`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 1, 1, 9, 100, 1, '2014-10-24 16:24:19', 1, '2014-10-24 16:24:19'),
	(2, 1, 2, 1, 9, 99, 1, '2014-10-24 16:24:46', 1, '2014-10-24 16:24:46'),
	(3, 1, 3, 1, 9, 90, 1, '2014-10-24 16:24:53', 1, '2014-10-24 16:24:53'),
	(4, 1, 4, 1, 9, 88, 1, '2014-10-24 16:25:07', 1, '2014-10-24 16:25:07'),
	(5, 1, 5, 1, 9, 102, 1, '2014-10-24 16:25:18', 1, '2014-10-24 16:25:18'),
	(6, 1, 6, 1, 9, 56, 1, '2014-10-24 16:25:27', 1, '2014-10-24 16:25:27'),
	(7, 1, 7, 1, 9, 99, 1, '2014-10-24 16:25:34', 1, '2014-10-24 16:25:34'),
	(8, 2, 1, 1, 9, 21, 1, '2014-10-24 19:52:55', 1, '2014-10-24 19:52:55'),
	(9, 2, 2, 1, 9, 22, 1, '2014-10-24 19:53:03', 1, '2014-10-24 19:53:03'),
	(10, 2, 3, 1, 9, 23, 1, '2014-10-24 19:53:11', 1, '2014-10-24 19:53:11'),
	(11, 2, 4, 1, 9, 24, 1, '2014-10-24 19:53:18', 1, '2014-10-24 19:53:18'),
	(12, 2, 5, 1, 9, 25, 1, '2014-10-24 19:53:31', 1, '2014-10-24 19:53:31'),
	(13, 2, 6, 1, 9, 26, 1, '2014-10-24 19:53:40', 1, '2014-10-24 19:53:40'),
	(14, 2, 7, 1, 9, 27, 1, '2014-10-24 19:53:47', 1, '2014-10-24 19:53:47'),
	(15, 2, 8, 1, 9, 28, 1, '2014-10-24 19:53:54', 1, '2014-10-24 19:53:54'),
	(16, 2, 9, 1, 9, 29, 1, '2014-10-24 19:54:04', 1, '2014-10-24 19:54:04'),
	(17, 3, 1, 1, 9, 130, 1, '2014-10-24 20:46:26', 1, '2014-10-24 20:46:26'),
	(18, 3, 8, 1, 9, 90, 1, '2014-10-24 20:47:12', 1, '2014-10-24 20:47:12');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `student_code` (`code`),
  CONSTRAINT `FK_t_students_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- Dumping data for table xsglxtsql.t_students: ~0 rows (approximately)
DELETE FROM `t_students`;
/*!40000 ALTER TABLE `t_students` DISABLE KEYS */;
INSERT INTO `t_students` (`ID`, `code`, `name`, `status`, `sex`, `id_card_no`, `birthday`, `accommodation`, `payment1`, `payment2`, `payment3`, `payment4`, `payment5`, `payment6`, `bonus_penalty`, `address`, `parents_tel`, `parents_qq`, `school_of_graduation`, `senior_score`, `school_year`, `college_score`, `university`, `comment`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(9, '20140001', '20140001', '1', 'M', '420984198605252712', '2014-09-16', '', '1', '1', '1', '1', '1', '1', '', '', '', '', '', NULL, NULL, NULL, '', '', 1, '2014-10-24 14:29:02', 1, '2014-10-25 08:30:29');
/*!40000 ALTER TABLE `t_students` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_student_classes
DROP TABLE IF EXISTS `t_student_classes`;
CREATE TABLE IF NOT EXISTS `t_student_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生ID',
  `class_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级ID',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0:暂停 1:正常',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_student_classes_t_classes` (`class_id`),
  KEY `FK_t_student_classes_t_students` (`student_id`),
  CONSTRAINT `FK_t_student_classes_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_student_classes_t_students` FOREIGN KEY (`student_id`) REFERENCES `t_students` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.t_student_classes: ~4 rows (approximately)
DELETE FROM `t_student_classes`;
/*!40000 ALTER TABLE `t_student_classes` DISABLE KEYS */;
INSERT INTO `t_student_classes` (`ID`, `student_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 9, 1, '0', 1, '2014-10-24 14:29:02', 1, '2014-10-24 14:29:02'),
	(2, 9, 4, '0', 1, '2014-10-24 14:51:17', 1, '2014-10-24 14:51:17'),
	(3, 9, 6, '0', 1, '2014-10-24 14:53:36', 1, '2014-10-24 14:53:36'),
	(4, 9, 1, '1', 1, '2014-10-24 14:57:03', 1, '2014-10-24 14:57:03');
/*!40000 ALTER TABLE `t_student_classes` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_teachers
DROP TABLE IF EXISTS `t_teachers`;
CREATE TABLE IF NOT EXISTS `t_teachers` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` char(20) COLLATE utf8_bin NOT NULL COMMENT '教师CODE',
  `name` char(12) COLLATE utf8_bin NOT NULL COMMENT '教师姓名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `sex` enum('F','M') COLLATE utf8_bin NOT NULL COMMENT '性别(F: 女 M:男)',
  `birthday` date DEFAULT NULL COMMENT '出生年月日',
  `id_card_no` char(18) COLLATE utf8_bin DEFAULT NULL COMMENT '身份证号码',
  `home_address` char(100) COLLATE utf8_bin DEFAULT NULL COMMENT '家庭住址',
  `telephonoe` char(11) COLLATE utf8_bin DEFAULT NULL COMMENT '电话号码',
  `nation` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '民族',
  `birthplace` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '籍贯',
  `working_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '工作年月',
  `party_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '入党年月',
  `before_degree` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '职前学历',
  `before_graduate_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '职前毕业时间',
  `before_graduate_school` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '职前毕业院校',
  `before_graduate_major` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '职前毕业专业',
  `current_degree` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '现学历',
  `current_graduate_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '现学历毕业时间',
  `current_graduate_school` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '现学历毕业院校',
  `current_graduate_major` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '现学历毕业专业',
  `professional_technical_position` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '专业技术职务',
  `work_departments_postion` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '工作科室及职务',
  `current_position_rank` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '现职级',
  `current_position_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '任现职年月',
  `current_level_date` char(7) COLLATE utf8_bin DEFAULT NULL COMMENT '任现级年月',
  `basic_memo` text COLLATE utf8_bin COMMENT '基本情况备注',
  `continue_education_address` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '继续教育地址',
  `continue_education_date` char(20) COLLATE utf8_bin DEFAULT NULL COMMENT '继续教育时间',
  `continue_education_credit` int(4) DEFAULT NULL COMMENT '获得学分',
  `continue_education_prove_people` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '证明人',
  `moral_praise` text COLLATE utf8_bin COMMENT '表彰情况',
  `moral_student_evaluation` text COLLATE utf8_bin COMMENT '学生测评',
  `moral_target_check` text COLLATE utf8_bin COMMENT '目标考核',
  `moral_memo` text COLLATE utf8_bin COMMENT '师德备注',
  `teach_grades` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '任教年级',
  `teach_subjects` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '课程',
  `teaching_research_postion` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '教研职务',
  `recruit_students` text COLLATE utf8_bin COMMENT '招生情况',
  `attendance` text COLLATE utf8_bin COMMENT '考勤情况',
  `working_memo` text COLLATE utf8_bin COMMENT '履职备注',
  `tutorship_award` text COLLATE utf8_bin COMMENT '辅导获奖',
  `competition_award` text COLLATE utf8_bin COMMENT '参赛获奖',
  `paper_work` text COLLATE utf8_bin COMMENT '论文著作',
  `competition_item` text COLLATE utf8_bin COMMENT '参赛项目情况',
  `business_memo` text COLLATE utf8_bin COMMENT '业务备注',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `teacher_code` (`code`),
  CONSTRAINT `FK_t_teacher_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teachers: ~3 rows (approximately)
DELETE FROM `t_teachers`;
/*!40000 ALTER TABLE `t_teachers` DISABLE KEYS */;
INSERT INTO `t_teachers` (`ID`, `code`, `name`, `status`, `sex`, `birthday`, `id_card_no`, `home_address`, `telephonoe`, `nation`, `birthplace`, `working_date`, `party_date`, `before_degree`, `before_graduate_date`, `before_graduate_school`, `before_graduate_major`, `current_degree`, `current_graduate_date`, `current_graduate_school`, `current_graduate_major`, `professional_technical_position`, `work_departments_postion`, `current_position_rank`, `current_position_date`, `current_level_date`, `basic_memo`, `continue_education_address`, `continue_education_date`, `continue_education_credit`, `continue_education_prove_people`, `moral_praise`, `moral_student_evaluation`, `moral_target_check`, `moral_memo`, `teach_grades`, `teach_subjects`, `teaching_research_postion`, `recruit_students`, `attendance`, `working_memo`, `tutorship_award`, `competition_award`, `paper_work`, `competition_item`, `business_memo`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROOT', '管理员', '1', 'F', '2014-10-22', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2014-10-22 15:02:30', 1, '2014-10-24 18:30:41'),
	(5, 'jwc', '教务处', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(6, 'xgc', '学工科', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', '校长', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', '语文教师001', '1', 'M', '2014-10-08', NULL, NULL, '电话号', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(10, 'sx001', '数学01', '1', 'M', '2014-10-01', NULL, NULL, '1500712', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:01:47', 10, '2014-10-24 15:04:30'),
	(11, 'sw001', '生物01', '1', 'M', '2014-10-21', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(12, 'yy001', '英语01', '1', 'F', '2014-10-21', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(13, 'wl001', '物理01', '1', 'M', '2014-10-07', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(14, 'hx01', '化学01', '1', 'M', '2014-10-19', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(15, 'zz01', '政治01', '1', 'M', '2014-10-08', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(16, 'ls01', '历史01', '1', 'M', '2014-10-13', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(17, 'dl01', '地理01', '1', 'M', '2014-10-09', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(20, 'dl02', '地理02', '1', 'M', '2014-10-09', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(21, 'qn01', '全能01', '1', 'M', '2014-10-06', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(22, '0236', '刘耀', '1', 'M', '1982-11-23', NULL, NULL, '15971224636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_teacher_subjects_t_teachers` (`teacher_id`),
  KEY `FK_t_teacher_subjects_m_subjects` (`subject_id`),
  CONSTRAINT `FK_t_teacher_subjects_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_t_teacher_subjects_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teacher_subjects: ~20 rows (approximately)
DELETE FROM `t_teacher_subjects`;
/*!40000 ALTER TABLE `t_teacher_subjects` DISABLE KEYS */;
INSERT INTO `t_teacher_subjects` (`ID`, `teacher_id`, `subject_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 8, 1, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(2, 10, 2, 1, '2014-10-24 15:01:47', 1, '2014-10-24 15:01:47'),
	(3, 11, 6, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(4, 12, 3, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(5, 13, 4, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(6, 14, 5, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(7, 15, 7, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(8, 16, 8, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(9, 17, 9, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(10, 20, 9, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(11, 21, 1, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(12, 21, 2, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(13, 21, 3, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(14, 21, 4, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(15, 21, 5, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(16, 21, 6, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(17, 21, 7, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(18, 21, 8, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(19, 21, 9, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(20, 22, 1, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46');
/*!40000 ALTER TABLE `t_teacher_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_users
DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` char(20) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '上次登录时间',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- Dumping data for table xsglxtsql.t_users: ~17 rows (approximately)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`ID`, `username`, `password`, `status`, `last_login_time`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', 'rootadmin', '1', '2014-10-30 13:21:10', 0, '2014-10-22 15:01:57', 0, '2014-10-22 15:01:57'),
	(5, 'jwc', 'test1234', '1', NULL, 1, '2014-10-22 17:12:54', 1, '2014-10-22 17:12:54'),
	(6, 'xgc', 'test1234', '1', NULL, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', 'test1234', '1', NULL, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', 'test1234', '1', NULL, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(9, 'test', 'test1234', '1', '2014-10-28 16:45:35', 1, '2014-10-24 14:29:02', 9, '2014-10-28 16:37:34'),
	(10, 'sx001', 'test1234', '1', NULL, 1, '2014-10-24 15:01:47', 10, '2014-10-24 15:22:35'),
	(11, 'sw001', '20141021', '1', NULL, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(12, 'yy001', '20141021', '1', NULL, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(13, 'wl001', '20141007', '1', NULL, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(14, 'hx01', '20141019', '1', NULL, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(15, 'zz01', '20141008', '1', NULL, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(16, 'ls01', '20141013', '1', NULL, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(17, 'dl01', '20141009', '1', NULL, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(20, 'dl02', '20141009', '1', NULL, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(21, 'qn01', '20141006', '1', NULL, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(22, '0236', '19821123', '1', NULL, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46');
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
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_user_roles_m_roles` (`role_id`),
  KEY `user_id_role_id` (`user_id`,`role_id`),
  CONSTRAINT `FK_t_user_roles_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`),
  CONSTRAINT `FK_t_user_roles_t_users` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- Dumping data for table xsglxtsql.t_user_roles: ~19 rows (approximately)
DELETE FROM `t_user_roles`;
/*!40000 ALTER TABLE `t_user_roles` DISABLE KEYS */;
INSERT INTO `t_user_roles` (`ID`, `user_id`, `role_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 6, 0, '2014-10-22 17:11:40', 0, '2014-10-22 17:11:40'),
	(2, 5, 4, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(3, 6, 3, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(4, 7, 5, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(5, 8, 2, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(6, 9, 1, 1, '2014-10-24 14:29:02', 1, '2014-10-24 14:29:02'),
	(7, 10, 2, 1, '2014-10-24 15:01:47', 1, '2014-10-24 15:01:47'),
	(8, 11, 2, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(9, 12, 2, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(10, 13, 2, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(11, 14, 2, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(12, 15, 2, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(13, 16, 2, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(14, 17, 2, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(15, 17, 4, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(16, 20, 2, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(17, 20, 4, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(18, 21, 2, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(19, 22, 2, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46');
/*!40000 ALTER TABLE `t_user_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
