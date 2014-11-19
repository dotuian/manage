-- --------------------------------------------------------
-- ホスト:                          219.139.81.43
-- Server version:               5.1.61-community - MySQL Community Server (GPL)
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
  `authority_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '权限名称',
  `category` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '权限分类',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态',
  `level` int(11) DEFAULT NULL COMMENT '排序用',
  `access_path` char(100) COLLATE utf8_bin DEFAULT NULL COMMENT '访问路径',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `access_path` (`access_path`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_authoritys: ~46 rows (approximately)
DELETE FROM `m_authoritys`;
/*!40000 ALTER TABLE `m_authoritys` DISABLE KEYS */;
INSERT INTO `m_authoritys` (`ID`, `authority_name`, `category`, `status`, `level`, `access_path`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '个人信息修改', 'OTHER', '1', 1, 'setting/profile', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(2, '密码变更', 'OTHER', '1', 2, 'setting/password', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(10, '学生添加', 'STUDENT', '1', 1, 'student/create', 0, '2014-10-08 11:01:20', 0, '2014-10-08 11:01:20'),
	(11, '学生检索', 'STUDENT', '1', 2, 'student/search', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(12, '学生更新', 'STUDENT', '1', 3, 'student/update', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(13, '学生删除', 'STUDENT', '1', 4, 'student/delete', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(14, '学生信息导入', 'STUDENT', '1', 5, 'student/import', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	(15, '任教班级学生', 'STUDENT', '1', 6, 'student/class', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	(16, '学生班级变更', 'STUDENT', '1', 7, 'student/changeClass', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	(20, '教师添加', 'TEACHER', '1', 1, 'teacher/create', 0, '2014-10-08 11:02:38', 0, '2014-10-09 12:11:54'),
	(21, '教师检索', 'TEACHER', '1', 2, 'teacher/search', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(22, '教师更新', 'TEACHER', '1', 3, 'teacher/update', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(23, '教师删除', 'TEACHER', '1', 4, 'teacher/delete', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(24, '教师导入', 'TEACHER', '1', 5, 'teacher/import', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(30, '班级添加', 'CLASS', '1', 1, 'class/create', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(31, '班级检索', 'CLASS', '1', 2, 'class/search', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(32, '班级更新', 'CLASS', '1', 3, 'class/update', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(33, '班级暂停(批量)', 'CLASS', '1', 4, 'class/pauseMore', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(34, '班级学生一览', 'CLASS', '1', 6, 'class/student', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(35, '班级暂停(单个)', 'CLASS', '1', 6, 'class/pause', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(40, '课程安排添加', 'COURSE', '1', 1, 'course/create', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(41, '课程安排检索', 'COURSE', '1', 2, 'course/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(42, '课程安排更新', 'COURSE', '1', 3, 'course/update', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(43, '课程安排删除', 'COURSE', '1', 4, 'course/delete', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(44, '班级课程安排', 'COURSE', '1', 5, 'course/class', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(50, '成绩添加', 'SCORE', '1', 1, 'score/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(51, '成绩检索', 'SCORE', '1', 2, 'score/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(52, '成绩更新', 'SCORE', '1', 3, 'score/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(53, '成绩删除', 'SCORE', '1', 4, 'score/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(54, '成绩查询(学生)', 'SCORE', '1', 5, 'score/query', 0, '2014-10-09 14:26:49', 0, '2014-10-09 14:26:49'),
	(55, '班级学生成绩', 'SCORE', '1', 6, 'score/class', 1, '2014-10-24 19:56:33', 1, '2014-11-06 18:46:30'),
	(56, '成绩统计分析', 'SCORE', '1', 7, 'score/analysis', 1, '2014-11-07 12:17:41', NULL, NULL),
	(57, '学生成绩总表', 'SCORE', '1', 8, 'score/report', 1, '2014-11-07 12:17:41', NULL, NULL),
	(60, '角色添加', 'ROLE', '1', 1, 'role/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(61, '角色检索', 'ROLE', '1', 2, 'role/search', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(62, '角色更新', 'ROLE', '1', 3, 'role/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(63, '角色删除', 'ROLE', '1', 4, 'role/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(70, '权限添加', 'AUTHORITY', '1', 1, 'authority/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(71, '权限检索', 'AUTHORITY', '1', 2, 'authority/search', 0, '2014-10-09 14:37:03', 0, '2014-10-09 14:37:03'),
	(72, '权限更新', 'AUTHORITY', '1', 3, 'authority/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(73, '权限删除', 'AUTHORITY', '1', 4, 'authority/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(80, '科目添加', 'SUBJECT', '1', 1, 'subject/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(81, '科目检索', 'SUBJECT', '1', 2, 'subject/search', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(82, '科目更新', 'SUBJECT', '1', 3, 'subject/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(83, '科目删除', 'SUBJECT', '1', 4, 'subject/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(90, '系统设置', 'SYSTEM', '1', 1, 'system/setting', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01');
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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
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
  `update_user` int(10) unsigned DEFAULT NULL,
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
  `role_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '角色名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2：删除)',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

-- Dumping data for table xsglxtsql.m_roles: ~5 rows (approximately)
DELETE FROM `m_roles`;
/*!40000 ALTER TABLE `m_roles` DISABLE KEYS */;
INSERT INTO `m_roles` (`ID`, `role_name`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '学生', '1', 0, '2014-10-08 11:10:17', 1, '2014-11-17 13:39:51'),
	(2, '教师', '1', 0, '2014-10-08 11:11:47', 1, '2014-11-17 13:42:12'),
	(3, '学工科', '1', 0, '2014-10-08 11:11:47', 1, '2014-11-17 13:42:31'),
	(4, '教务处', '1', 0, '2014-10-08 11:11:47', 1, '2014-11-17 13:43:06'),
	(5, '校长', '1', 1, '2014-10-09 15:34:20', 1, '2014-11-17 13:40:14');
/*!40000 ALTER TABLE `m_roles` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_role_authoritys
DROP TABLE IF EXISTS `m_role_authoritys`;
CREATE TABLE IF NOT EXISTS `m_role_authoritys` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `authority_id` int(10) unsigned NOT NULL COMMENT '权限ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `role_id_authority_id` (`role_id`,`authority_id`),
  KEY `FK_m_role_authoritys_m_authoritys` (`authority_id`),
  CONSTRAINT `FK_m_role_authoritys_m_authoritys` FOREIGN KEY (`authority_id`) REFERENCES `m_authoritys` (`ID`),
  CONSTRAINT `FK_m_role_authoritys_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限表';

-- Dumping data for table xsglxtsql.m_role_authoritys: ~83 rows (approximately)
DELETE FROM `m_role_authoritys`;
/*!40000 ALTER TABLE `m_role_authoritys` DISABLE KEYS */;
INSERT INTO `m_role_authoritys` (`ID`, `role_id`, `authority_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(43, 1, 54, 1, '2014-11-17 13:39:51', NULL, NULL),
	(44, 1, 1, 1, '2014-11-17 13:39:51', NULL, NULL),
	(45, 1, 2, 1, '2014-11-17 13:39:51', NULL, NULL),
	(46, 5, 30, 1, '2014-11-17 13:40:14', NULL, NULL),
	(47, 5, 31, 1, '2014-11-17 13:40:14', NULL, NULL),
	(48, 5, 32, 1, '2014-11-17 13:40:14', NULL, NULL),
	(49, 5, 33, 1, '2014-11-17 13:40:14', NULL, NULL),
	(50, 5, 34, 1, '2014-11-17 13:40:14', NULL, NULL),
	(51, 5, 35, 1, '2014-11-17 13:40:14', NULL, NULL),
	(52, 5, 80, 1, '2014-11-17 13:40:14', NULL, NULL),
	(53, 5, 81, 1, '2014-11-17 13:40:14', NULL, NULL),
	(54, 5, 82, 1, '2014-11-17 13:40:14', NULL, NULL),
	(55, 5, 83, 1, '2014-11-17 13:40:14', NULL, NULL),
	(56, 5, 40, 1, '2014-11-17 13:40:14', NULL, NULL),
	(57, 5, 41, 1, '2014-11-17 13:40:14', NULL, NULL),
	(58, 5, 42, 1, '2014-11-17 13:40:14', NULL, NULL),
	(59, 5, 43, 1, '2014-11-17 13:40:14', NULL, NULL),
	(60, 5, 44, 1, '2014-11-17 13:40:14', NULL, NULL),
	(61, 5, 10, 1, '2014-11-17 13:40:14', NULL, NULL),
	(62, 5, 11, 1, '2014-11-17 13:40:14', NULL, NULL),
	(63, 5, 12, 1, '2014-11-17 13:40:14', NULL, NULL),
	(64, 5, 13, 1, '2014-11-17 13:40:14', NULL, NULL),
	(65, 5, 14, 1, '2014-11-17 13:40:14', NULL, NULL),
	(66, 5, 20, 1, '2014-11-17 13:40:14', NULL, NULL),
	(67, 5, 21, 1, '2014-11-17 13:40:14', NULL, NULL),
	(68, 5, 22, 1, '2014-11-17 13:40:14', NULL, NULL),
	(69, 5, 23, 1, '2014-11-17 13:40:14', NULL, NULL),
	(70, 5, 24, 1, '2014-11-17 13:40:14', NULL, NULL),
	(71, 5, 56, 1, '2014-11-17 13:40:14', NULL, NULL),
	(72, 5, 50, 1, '2014-11-17 13:40:14', NULL, NULL),
	(73, 5, 51, 1, '2014-11-17 13:40:14', NULL, NULL),
	(74, 5, 52, 1, '2014-11-17 13:40:14', NULL, NULL),
	(75, 5, 53, 1, '2014-11-17 13:40:14', NULL, NULL),
	(76, 5, 55, 1, '2014-11-17 13:40:14', NULL, NULL),
	(77, 5, 60, 1, '2014-11-17 13:40:14', NULL, NULL),
	(78, 5, 61, 1, '2014-11-17 13:40:14', NULL, NULL),
	(79, 5, 62, 1, '2014-11-17 13:40:14', NULL, NULL),
	(80, 5, 63, 1, '2014-11-17 13:40:14', NULL, NULL),
	(81, 5, 70, 1, '2014-11-17 13:40:14', NULL, NULL),
	(82, 5, 71, 1, '2014-11-17 13:40:14', NULL, NULL),
	(83, 5, 72, 1, '2014-11-17 13:40:14', NULL, NULL),
	(84, 5, 73, 1, '2014-11-17 13:40:14', NULL, NULL),
	(85, 5, 1, 1, '2014-11-17 13:40:14', NULL, NULL),
	(86, 5, 2, 1, '2014-11-17 13:40:14', NULL, NULL),
	(87, 5, 90, 1, '2014-11-17 13:40:14', NULL, NULL),
	(95, 2, 34, 1, '2014-11-17 13:42:12', NULL, NULL),
	(96, 2, 56, 1, '2014-11-17 13:42:12', NULL, NULL),
	(97, 2, 55, 1, '2014-11-17 13:42:12', NULL, NULL),
	(98, 2, 1, 1, '2014-11-17 13:42:12', NULL, NULL),
	(99, 2, 2, 1, '2014-11-17 13:42:12', NULL, NULL),
	(100, 3, 10, 1, '2014-11-17 13:42:31', NULL, NULL),
	(101, 3, 11, 1, '2014-11-17 13:42:31', NULL, NULL),
	(102, 3, 12, 1, '2014-11-17 13:42:31', NULL, NULL),
	(103, 3, 13, 1, '2014-11-17 13:42:31', NULL, NULL),
	(104, 3, 1, 1, '2014-11-17 13:42:31', NULL, NULL),
	(105, 3, 2, 1, '2014-11-17 13:42:31', NULL, NULL),
	(106, 4, 30, 1, '2014-11-17 13:43:06', NULL, NULL),
	(107, 4, 31, 1, '2014-11-17 13:43:06', NULL, NULL),
	(108, 4, 32, 1, '2014-11-17 13:43:06', NULL, NULL),
	(109, 4, 33, 1, '2014-11-17 13:43:06', NULL, NULL),
	(110, 4, 34, 1, '2014-11-17 13:43:06', NULL, NULL),
	(111, 4, 35, 1, '2014-11-17 13:43:06', NULL, NULL),
	(112, 4, 80, 1, '2014-11-17 13:43:06', NULL, NULL),
	(113, 4, 81, 1, '2014-11-17 13:43:06', NULL, NULL),
	(114, 4, 82, 1, '2014-11-17 13:43:06', NULL, NULL),
	(115, 4, 83, 1, '2014-11-17 13:43:06', NULL, NULL),
	(116, 4, 40, 1, '2014-11-17 13:43:06', NULL, NULL),
	(117, 4, 41, 1, '2014-11-17 13:43:06', NULL, NULL),
	(118, 4, 42, 1, '2014-11-17 13:43:06', NULL, NULL),
	(119, 4, 43, 1, '2014-11-17 13:43:06', NULL, NULL),
	(120, 4, 20, 1, '2014-11-17 13:43:06', NULL, NULL),
	(121, 4, 21, 1, '2014-11-17 13:43:06', NULL, NULL),
	(122, 4, 22, 1, '2014-11-17 13:43:06', NULL, NULL),
	(123, 4, 23, 1, '2014-11-17 13:43:06', NULL, NULL),
	(124, 4, 56, 1, '2014-11-17 13:43:06', NULL, NULL),
	(125, 4, 50, 1, '2014-11-17 13:43:06', NULL, NULL),
	(126, 4, 51, 1, '2014-11-17 13:43:06', NULL, NULL),
	(127, 4, 52, 1, '2014-11-17 13:43:06', NULL, NULL),
	(128, 4, 53, 1, '2014-11-17 13:43:06', NULL, NULL),
	(129, 4, 55, 1, '2014-11-17 13:43:06', NULL, NULL),
	(130, 4, 1, 1, '2014-11-17 13:43:06', NULL, NULL),
	(131, 4, 2, 1, '2014-11-17 13:43:06', NULL, NULL),
	(132, 4, 90, 1, '2014-11-17 13:43:06', NULL, NULL);
/*!40000 ALTER TABLE `m_role_authoritys` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.m_subjects
DROP TABLE IF EXISTS `m_subjects`;
CREATE TABLE IF NOT EXISTS `m_subjects` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_code` char(10) COLLATE utf8_bin NOT NULL COMMENT '科目CODE',
  `subject_name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '科目名称',
  `subject_short_name` varchar(4) COLLATE utf8_bin NOT NULL COMMENT '科目名称(简称)',
  `subject_type` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '科目类型(0:普高 1:技能)',
  `total_score` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '总分',
  `pass_score` int(3) unsigned NOT NULL DEFAULT '0' COMMENT '及格分数',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `level` int(2) unsigned NOT NULL COMMENT '显示排序用',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程科目表';

-- Dumping data for table xsglxtsql.m_subjects: ~13 rows (approximately)
DELETE FROM `m_subjects`;
/*!40000 ALTER TABLE `m_subjects` DISABLE KEYS */;
INSERT INTO `m_subjects` (`ID`, `subject_code`, `subject_name`, `subject_short_name`, `subject_type`, `total_score`, `pass_score`, `status`, `level`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'YX', '语文', '语', '0', 150, 90, '1', 1, 0, '2014-09-23 10:47:15', 0, '2014-09-23 10:47:15'),
	(2, 'SX', '数学', '数', '0', 150, 90, '1', 2, 0, '2014-09-23 10:48:58', 0, '2014-09-23 10:48:58'),
	(3, 'YY', '英语', '英', '0', 150, 90, '1', 3, 0, '2014-09-23 10:49:07', 0, '2014-09-23 10:49:07'),
	(4, 'WL', '物理', '物', '1', 120, 72, '1', 4, 0, '2014-09-23 10:49:14', 0, '2014-09-23 10:49:14'),
	(5, 'HX', '化学', '化', '1', 120, 72, '1', 5, 0, '2014-09-23 10:49:18', 0, '2014-09-23 10:49:18'),
	(6, 'SW', '生物', '生', '1', 60, 36, '1', 6, 0, '2014-09-23 10:49:44', 0, '2014-10-15 17:39:55'),
	(7, 'ZZ', '政治(思品)', '政', '1', 120, 72, '1', 7, 0, '2014-09-23 10:49:29', 0, '2014-09-23 10:49:29'),
	(8, 'LS', '历史', '史', '1', 120, 72, '1', 8, 0, '2014-09-23 10:49:34', 0, '2014-09-23 10:49:34'),
	(9, 'DL', '地理', '地', '1', 60, 36, '1', 9, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44'),
	(10, 'YIN', '音乐', '音', '1', 60, 36, '1', 10, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44'),
	(11, 'TY', '体育', '体', '1', 60, 36, '1', 11, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44'),
	(12, 'MS', '美术', '美', '1', 60, 36, '1', 12, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44'),
	(13, 'XXJS', '信息技术', '信', '1', 60, 36, '1', 13, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44');
/*!40000 ALTER TABLE `m_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_classes
DROP TABLE IF EXISTS `t_classes`;
CREATE TABLE IF NOT EXISTS `t_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '班级CODE',
  `class_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '班级名称',
  `grade` int(1) DEFAULT NULL COMMENT '年级',
  `entry_year` int(4) DEFAULT NULL COMMENT '年度',
  `term_type` enum('0','1','2') COLLATE utf8_bin DEFAULT NULL COMMENT '学期(0:整学年 1:上学期 2:下学期)',
  `class_type` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '班级类型(0:普通高中(综合)   1:普通高中(文科)  2:普通高中(理科)  3:技能专业)',
  `specialty_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '专业名称',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:使用中 2:未使用)',
  `teacher_id` int(10) unsigned DEFAULT NULL COMMENT '班主任ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_classes_t_teachers` (`teacher_id`),
  CONSTRAINT `FK_t_classes_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='班级表';

-- Dumping data for table xsglxtsql.t_classes: ~40 rows (approximately)
DELETE FROM `t_classes`;
/*!40000 ALTER TABLE `t_classes` DISABLE KEYS */;
INSERT INTO `t_classes` (`ID`, `class_code`, `class_name`, `grade`, `entry_year`, `term_type`, `class_type`, `specialty_name`, `status`, `teacher_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '101', '高一(1)', 1, 2014, '1', '0', NULL, '2', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 18:07:31'),
	(2, '102', '高一(2)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(3, '103', '高一(3)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(4, '104', '高一(4)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(5, '105', '高一(5)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(6, '106', '高一(6)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(7, '107', '高一(7)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(8, '108', '高一(8)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(9, '109', '高一(9)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(10, '110', '高一(10)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(11, '111', '高一(11)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:53'),
	(12, '112', '高一(12)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(13, '113', '高一(13)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(14, '114', '高一(14)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(15, '115', '高一(15)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(16, '201', '高二(1)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(17, '202', '高二(2)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(18, '203', '高二(3)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 1, '2014-11-13 17:25:54'),
	(19, '204', '高二(4)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(20, '205', '高二(5)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(21, '206', '高二(6)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(22, '207', '高二(7)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(23, '208', '高二(8)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(24, '209', '高二(9)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(25, '210', '高二(10)', 2, 2013, '1', '0', NULL, '2', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 18:32:42'),
	(26, '211', '高二(11)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(27, '212', '高二(12)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(28, '213', '高二(13)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(29, '301', '高三(1)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(30, '302', '高三(2)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(31, '303', '高三(3)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(32, '304', '高三(4)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(33, '305', '高三(5)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(34, '306', '高三(6)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(35, '307', '高三(7)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(36, '308', '高三(8)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(37, '309', '高三(9)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(38, '310', '高三(10)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(39, '311', '高三(11)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54'),
	(40, '312', '高三(12)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-13 17:25:54');
/*!40000 ALTER TABLE `t_classes` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_file_upload
DROP TABLE IF EXISTS `t_file_upload`;
CREATE TABLE IF NOT EXISTS `t_file_upload` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `filename` char(50) COLLATE utf8_bin NOT NULL COMMENT '上传文件名',
  `realpath` char(128) COLLATE utf8_bin NOT NULL COMMENT '保存文件路径',
  `category` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '用途',
  `status` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT '状态(0:未处理  1:处理正常  2:处理异常)',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
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
  `student_number` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '当前学生学号',
  `score` float NOT NULL COMMENT '分数',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='成绩表';

-- Dumping data for table xsglxtsql.t_scores: ~0 rows (approximately)
DELETE FROM `t_scores`;
/*!40000 ALTER TABLE `t_scores` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_scores` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_students
DROP TABLE IF EXISTS `t_students`;
CREATE TABLE IF NOT EXISTS `t_students` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `province_code` char(20) COLLATE utf8_bin DEFAULT NULL COMMENT '省内编号',
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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `FK_t_students_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- Dumping data for table xsglxtsql.t_students: ~0 rows (approximately)
DELETE FROM `t_students`;
/*!40000 ALTER TABLE `t_students` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_students` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_student_classes
DROP TABLE IF EXISTS `t_student_classes`;
CREATE TABLE IF NOT EXISTS `t_student_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `student_number` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '学号',
  `student_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '学生ID',
  `class_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '班级ID',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0' COMMENT '0:暂停 1:正常',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_student_classes_t_classes` (`class_id`),
  KEY `FK_t_student_classes_t_students` (`student_id`),
  CONSTRAINT `FK_t_student_classes_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_t_student_classes_t_students` FOREIGN KEY (`student_id`) REFERENCES `t_students` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.t_student_classes: ~0 rows (approximately)
DELETE FROM `t_student_classes`;
/*!40000 ALTER TABLE `t_student_classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_student_classes` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_teachers
DROP TABLE IF EXISTS `t_teachers`;
CREATE TABLE IF NOT EXISTS `t_teachers` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `code` char(20) COLLATE utf8_bin DEFAULT NULL COMMENT '教师CODE',
  `name` char(12) COLLATE utf8_bin NOT NULL COMMENT '教师姓名',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `sex` enum('F','M') COLLATE utf8_bin NOT NULL COMMENT '性别(F: 女 M:男)',
  `birthday` date DEFAULT NULL COMMENT '出生年月日',
  `id_card_no` char(18) COLLATE utf8_bin DEFAULT NULL COMMENT '身份证号码',
  `home_address` char(100) COLLATE utf8_bin DEFAULT NULL COMMENT '家庭住址',
  `telephone` char(11) COLLATE utf8_bin DEFAULT NULL COMMENT '电话号码',
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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `FK_t_teacher_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teachers: ~1 rows (approximately)
DELETE FROM `t_teachers`;
/*!40000 ALTER TABLE `t_teachers` DISABLE KEYS */;
INSERT INTO `t_teachers` (`ID`, `code`, `name`, `status`, `sex`, `birthday`, `id_card_no`, `home_address`, `telephone`, `nation`, `birthplace`, `working_date`, `party_date`, `before_degree`, `before_graduate_date`, `before_graduate_school`, `before_graduate_major`, `current_degree`, `current_graduate_date`, `current_graduate_school`, `current_graduate_major`, `professional_technical_position`, `work_departments_postion`, `current_position_rank`, `current_position_date`, `current_level_date`, `basic_memo`, `continue_education_address`, `continue_education_date`, `continue_education_credit`, `continue_education_prove_people`, `moral_praise`, `moral_student_evaluation`, `moral_target_check`, `moral_memo`, `teach_grades`, `teach_subjects`, `teaching_research_postion`, `recruit_students`, `attendance`, `working_memo`, `tutorship_award`, `competition_award`, `paper_work`, `competition_item`, `business_memo`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', '系统管理员', '1', 'M', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2014-11-14 17:56:30', NULL, NULL);
/*!40000 ALTER TABLE `t_teachers` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_teacher_subjects
DROP TABLE IF EXISTS `t_teacher_subjects`;
CREATE TABLE IF NOT EXISTS `t_teacher_subjects` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `teacher_id` int(10) unsigned NOT NULL COMMENT '教师ID',
  `subject_id` int(10) unsigned NOT NULL COMMENT '科目ID',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_teacher_subjects_t_teachers` (`teacher_id`),
  KEY `FK_t_teacher_subjects_m_subjects` (`subject_id`),
  CONSTRAINT `FK_t_teacher_subjects_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_t_teacher_subjects_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teacher_subjects: ~0 rows (approximately)
DELETE FROM `t_teacher_subjects`;
/*!40000 ALTER TABLE `t_teacher_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_teacher_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_users
DROP TABLE IF EXISTS `t_users`;
CREATE TABLE IF NOT EXISTS `t_users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` char(20) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `status` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1' COMMENT '状态(1:正常 2:异常)',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '上次登录时间',
  `last_password_time` timestamp NULL DEFAULT NULL COMMENT '上次密码修改时间',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- Dumping data for table xsglxtsql.t_users: ~1 rows (approximately)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`ID`, `username`, `password`, `status`, `last_login_time`, `last_password_time`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', 'rootadmin', '1', '2014-11-19 15:55:24', NULL, 0, '2014-11-14 17:55:57', NULL, NULL);
/*!40000 ALTER TABLE `t_users` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_user_roles
DROP TABLE IF EXISTS `t_user_roles`;
CREATE TABLE IF NOT EXISTS `t_user_roles` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `create_user` int(10) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_t_user_roles_m_roles` (`role_id`),
  KEY `user_id_role_id` (`user_id`,`role_id`),
  CONSTRAINT `FK_t_user_roles_m_roles` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`ID`),
  CONSTRAINT `FK_t_user_roles_t_users` FOREIGN KEY (`user_id`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- Dumping data for table xsglxtsql.t_user_roles: ~1 rows (approximately)
DELETE FROM `t_user_roles`;
/*!40000 ALTER TABLE `t_user_roles` DISABLE KEYS */;
INSERT INTO `t_user_roles` (`ID`, `user_id`, `role_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 5, 0, '2014-11-14 17:57:31', NULL, NULL);
/*!40000 ALTER TABLE `t_user_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
