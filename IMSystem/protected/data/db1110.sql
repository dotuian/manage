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
  `authority_name` char(50) COLLATE utf8_bin NOT NULL COMMENT '权限名称',
  `category` char(10) COLLATE utf8_bin DEFAULT NULL COMMENT '权限分类',
  `level` int(11) DEFAULT NULL COMMENT '排序用',
  `access_path` char(100) COLLATE utf8_bin DEFAULT NULL COMMENT '访问路径',
  `create_user` int(10) unsigned NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `access_path` (`access_path`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.m_authoritys: ~41 rows (approximately)
DELETE FROM `m_authoritys`;
/*!40000 ALTER TABLE `m_authoritys` DISABLE KEYS */;
INSERT INTO `m_authoritys` (`ID`, `authority_name`, `category`, `level`, `access_path`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '学生添加', 'STUDENT', 1, 'student/create', 0, '2014-10-08 11:01:20', 0, '2014-10-08 11:01:20'),
	(2, '学生检索', 'STUDENT', 2, 'student/search', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(3, '学生更新', 'STUDENT', 3, 'student/update', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(4, '学生删除', 'STUDENT', 4, 'student/delete', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(5, '学生信息导入', 'STUDENT', 5, 'student/import', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	(6, '教师添加', 'TEACHER', 1, 'teacher/create', 0, '2014-10-08 11:02:38', 0, '2014-10-09 12:11:54'),
	(7, '教师检索', 'TEACHER', 2, 'teacher/search', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(8, '教师更新', 'TEACHER', 3, 'teacher/update', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(9, '教师删除', 'TEACHER', 4, 'teacher/delete', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(10, '班级添加', 'CLASS', 1, 'class/create', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(11, '班级检索', 'CLASS', 2, 'class/search', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(12, '班级更新', 'CLASS', 3, 'class/update', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(13, '班级删除', 'CLASS', 4, 'class/delete', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(14, '班级升级', 'CLASS', 5, 'class/upgrade', 0, '2014-10-08 11:04:09', 0, '2014-10-08 11:04:09'),
	(15, '班级学生一览', 'CLASS', 6, 'class/student', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(16, '课程安排添加', 'COURSE', 1, 'course/create', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(17, '课程安排检索', 'COURSE', 2, 'course/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(18, '课程安排更新', 'COURSE', 3, 'course/update', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(19, '课程安排删除', 'COURSE', 4, 'course/delete', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(20, '成绩添加', 'SCORE', 1, 'score/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(21, '成绩检索', 'SCORE', 2, 'score/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(22, '成绩更新', 'SCORE', 3, 'score/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(23, '成绩删除', 'SCORE', 4, 'score/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(24, '成绩查询(学生)', 'SCORE', 5, 'score/query', 0, '2014-10-09 14:26:49', 0, '2014-10-09 14:26:49'),
	(25, '角色添加', 'ROLE', 1, 'role/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(26, '角色检索', 'ROLE', 2, 'role/search', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(27, '角色更新', 'ROLE', 3, 'role/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(28, '角色删除', 'ROLE', 4, 'role/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(29, '权限添加', 'AUTHORITY', 1, 'authority/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(30, '权限检索', 'AUTHORITY', 2, 'authority/search', 0, '2014-10-09 14:37:03', 0, '2014-10-09 14:37:03'),
	(31, '权限更新', 'AUTHORITY', 3, 'authority/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(32, '权限删除', 'AUTHORITY', 4, 'authority/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(33, '科目添加', 'SUBJECT', 1, 'subject/create', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(34, '科目检索', 'SUBJECT', 2, 'subject/search', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(35, '科目更新', 'SUBJECT', 3, 'subject/update', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(36, '科目删除', 'SUBJECT', 4, 'subject/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44'),
	(37, '个人信息修改', 'OTHER', 1, 'setting/profile', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(38, '密码变更', 'OTHER', 2, 'setting/password', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(39, '系统设置', 'OTHER', 1, 'system/setting', 0, '2014-10-22 17:32:05', 1, '2014-11-06 18:46:48'),
	(40, '班级学生成绩', 'CLASS', 6, 'score/class', 1, '2014-10-24 19:56:33', 1, '2014-11-06 18:46:30'),
	(42, '成绩统计分析', 'SCORE', 0, 'score/analysis', 1, '2014-11-07 12:17:41', NULL, NULL);
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
	(1, 'IMPORT_STUDENT_DATA_RANGE', '2014-10-07|2014-10-30', NULL),
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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_m_courses_m_subjects` (`subject_id`),
  KEY `FK_m_courses_t_teachers` (`teacher_id`),
  KEY `FK_m_courses_t_classes` (`class_id`),
  CONSTRAINT `FK_m_courses_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_m_courses_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_m_courses_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程表';

-- Dumping data for table xsglxtsql.m_courses: ~9 rows (approximately)
DELETE FROM `m_courses`;
/*!40000 ALTER TABLE `m_courses` DISABLE KEYS */;
INSERT INTO `m_courses` (`ID`, `subject_id`, `teacher_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(11, 1, 108, 13, '1', 1, '2014-11-10 18:18:21', 1, '2014-11-10 18:18:21'),
	(12, 2, 109, 13, '1', 1, '2014-11-10 18:18:24', 1, '2014-11-10 18:18:24'),
	(13, 3, 110, 13, '1', 1, '2014-11-10 18:18:27', 1, '2014-11-10 18:18:27'),
	(14, 4, 111, 13, '1', 1, '2014-11-10 18:18:29', 1, '2014-11-10 18:18:29'),
	(15, 5, 112, 13, '1', 1, '2014-11-10 18:18:31', 1, '2014-11-10 18:18:31'),
	(16, 6, 113, 13, '1', 1, '2014-11-10 18:18:34', 1, '2014-11-10 18:18:34');
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
	(1, '学生', '1', 0, '2014-10-08 11:10:17', 1, '2014-10-22 15:14:34'),
	(2, '教师', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:23'),
	(3, '学工科', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:51:52'),
	(4, '教务处', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:40'),
	(5, '校长', '1', 1, '2014-10-09 15:34:20', 1, '2014-11-07 12:22:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=549 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限表';

-- Dumping data for table xsglxtsql.m_role_authoritys: ~78 rows (approximately)
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
	(509, 5, 10, 1, '2014-11-07 12:22:16', NULL, NULL),
	(510, 5, 11, 1, '2014-11-07 12:22:16', NULL, NULL),
	(511, 5, 12, 1, '2014-11-07 12:22:16', NULL, NULL),
	(512, 5, 13, 1, '2014-11-07 12:22:16', NULL, NULL),
	(513, 5, 14, 1, '2014-11-07 12:22:16', NULL, NULL),
	(514, 5, 15, 1, '2014-11-07 12:22:16', NULL, NULL),
	(515, 5, 40, 1, '2014-11-07 12:22:16', NULL, NULL),
	(516, 5, 33, 1, '2014-11-07 12:22:16', NULL, NULL),
	(517, 5, 34, 1, '2014-11-07 12:22:16', NULL, NULL),
	(518, 5, 35, 1, '2014-11-07 12:22:16', NULL, NULL),
	(519, 5, 36, 1, '2014-11-07 12:22:16', NULL, NULL),
	(520, 5, 16, 1, '2014-11-07 12:22:16', NULL, NULL),
	(521, 5, 17, 1, '2014-11-07 12:22:16', NULL, NULL),
	(522, 5, 18, 1, '2014-11-07 12:22:16', NULL, NULL),
	(523, 5, 19, 1, '2014-11-07 12:22:16', NULL, NULL),
	(524, 5, 1, 1, '2014-11-07 12:22:16', NULL, NULL),
	(525, 5, 2, 1, '2014-11-07 12:22:16', NULL, NULL),
	(526, 5, 3, 1, '2014-11-07 12:22:16', NULL, NULL),
	(527, 5, 4, 1, '2014-11-07 12:22:16', NULL, NULL),
	(528, 5, 5, 1, '2014-11-07 12:22:16', NULL, NULL),
	(529, 5, 6, 1, '2014-11-07 12:22:16', NULL, NULL),
	(530, 5, 7, 1, '2014-11-07 12:22:16', NULL, NULL),
	(531, 5, 8, 1, '2014-11-07 12:22:16', NULL, NULL),
	(532, 5, 9, 1, '2014-11-07 12:22:16', NULL, NULL),
	(533, 5, 42, 1, '2014-11-07 12:22:16', NULL, NULL),
	(534, 5, 20, 1, '2014-11-07 12:22:16', NULL, NULL),
	(535, 5, 21, 1, '2014-11-07 12:22:16', NULL, NULL),
	(536, 5, 22, 1, '2014-11-07 12:22:16', NULL, NULL),
	(537, 5, 23, 1, '2014-11-07 12:22:16', NULL, NULL),
	(538, 5, 25, 1, '2014-11-07 12:22:16', NULL, NULL),
	(539, 5, 26, 1, '2014-11-07 12:22:16', NULL, NULL),
	(540, 5, 27, 1, '2014-11-07 12:22:16', NULL, NULL),
	(541, 5, 28, 1, '2014-11-07 12:22:16', NULL, NULL),
	(542, 5, 29, 1, '2014-11-07 12:22:16', NULL, NULL),
	(543, 5, 30, 1, '2014-11-07 12:22:16', NULL, NULL),
	(544, 5, 31, 1, '2014-11-07 12:22:16', NULL, NULL),
	(545, 5, 32, 1, '2014-11-07 12:22:16', NULL, NULL),
	(546, 5, 37, 1, '2014-11-07 12:22:16', NULL, NULL),
	(547, 5, 39, 1, '2014-11-07 12:22:16', NULL, NULL),
	(548, 5, 38, 1, '2014-11-07 12:22:16', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程科目表';

-- Dumping data for table xsglxtsql.m_subjects: ~9 rows (approximately)
DELETE FROM `m_subjects`;
/*!40000 ALTER TABLE `m_subjects` DISABLE KEYS */;
INSERT INTO `m_subjects` (`ID`, `subject_code`, `subject_name`, `subject_short_name`, `subject_type`, `total_score`, `pass_score`, `status`, `level`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'YX', '语文', '语', '0', 150, 90, '1', 1, 0, '2014-09-23 10:47:15', 0, '2014-09-23 10:47:15'),
	(2, 'SX', '数学', '数', '0', 150, 90, '1', 2, 0, '2014-09-23 10:48:58', 0, '2014-09-23 10:48:58'),
	(3, 'YY', '英语', '英', '0', 150, 90, '1', 3, 0, '2014-09-23 10:49:07', 0, '2014-09-23 10:49:07'),
	(4, 'WL', '物理', '物', '1', 120, 72, '1', 4, 0, '2014-09-23 10:49:14', 0, '2014-09-23 10:49:14'),
	(5, 'HX', '化学', '化', '1', 120, 72, '1', 5, 0, '2014-09-23 10:49:18', 0, '2014-09-23 10:49:18'),
	(6, 'SW', '生物', '生', '1', 60, 36, '1', 6, 0, '2014-09-23 10:49:44', 1526, '2014-10-15 17:39:55'),
	(7, 'ZZ', '政治', '政', '1', 120, 72, '1', 7, 0, '2014-09-23 10:49:29', 0, '2014-09-23 10:49:29'),
	(8, 'LS', '历史', '史', '1', 120, 72, '1', 8, 0, '2014-09-23 10:49:34', 0, '2014-09-23 10:49:34'),
	(9, 'DL', '地理', '地', '1', 60, 36, '1', 9, 0, '2014-09-23 10:49:44', 0, '2014-09-23 10:49:44');
/*!40000 ALTER TABLE `m_subjects` ENABLE KEYS */;


-- Dumping structure for table xsglxtsql.t_classes
DROP TABLE IF EXISTS `t_classes`;
CREATE TABLE IF NOT EXISTS `t_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '班级CODE',
  `class_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '班级名称',
  `grade` int(1) DEFAULT NULL COMMENT '年级',
  `entry_year` int(4) DEFAULT NULL COMMENT '入学年份',
  `term_type` enum('0','1','2') COLLATE utf8_bin DEFAULT NULL COMMENT '学期(0:整学年 1:上学期 2:下学期)',
  `class_type` char(1) COLLATE utf8_bin DEFAULT '0' COMMENT '班级类型(0:普通高中 1:技能专业)',
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
	(1, '101', '高一(1)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(2, '102', '高一(2)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(3, '103', '高一(3)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(4, '104', '高一(4)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(5, '105', '高一(5)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(6, '106', '高一(6)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(7, '107', '高一(7)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(8, '108', '高一(8)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(9, '109', '高一(9)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(10, '110', '高一(10)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(11, '111', '高一(11)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(12, '112', '高一(12)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(13, '113', '高一(13)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(14, '114', '高一(14)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(15, '115', '高一(15)', 1, 2014, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(16, '201', '高二(1)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(17, '202', '高二(2)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(18, '203', '高二(3)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-09-23 17:17:22', 0, NULL),
	(19, '204', '高二(4)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(20, '205', '高二(5)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(21, '206', '高二(6)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(22, '207', '高二(7)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(23, '208', '高二(8)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(24, '209', '高二(9)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(25, '210', '高二(10)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(26, '211', '高二(11)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(27, '212', '高二(12)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(28, '213', '高二(13)', 2, 2013, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(29, '301', '高三(1)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(30, '302', '高三(2)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(31, '303', '高三(3)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(32, '304', '高三(4)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(33, '305', '高三(5)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(34, '306', '高三(6)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(35, '307', '高三(7)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(36, '308', '高三(8)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(37, '309', '高三(9)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(38, '310', '高三(10)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(39, '311', '高三(11)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 0, NULL),
	(40, '312', '高三(12)', 3, 2012, '1', '0', NULL, '1', NULL, 0, '2014-11-04 17:06:41', 1, '2014-11-06 17:21:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.t_file_upload: ~0 rows (approximately)
DELETE FROM `t_file_upload`;
/*!40000 ALTER TABLE `t_file_upload` DISABLE KEYS */;
INSERT INTO `t_file_upload` (`ID`, `filename`, `realpath`, `category`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(58, '113学生信息表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\files\\upload\\1415608054.xls', NULL, NULL, 1, '2014-11-10 17:27:34', 1, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='成绩表';

-- Dumping data for table xsglxtsql.t_scores: ~0 rows (approximately)
DELETE FROM `t_scores`;
/*!40000 ALTER TABLE `t_scores` DISABLE KEYS */;
INSERT INTO `t_scores` (`ID`, `exam_id`, `subject_id`, `class_id`, `student_id`, `student_number`, `score`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(26, 1, 1, 13, 40, '201511302', 88, 1, '2014-11-10 17:46:19', NULL, NULL),
	(27, 1, 1, 13, 41, '201511303', 120, 1, '2014-11-10 17:46:21', NULL, NULL),
	(28, 1, 1, 13, 42, '201511304', 113, 1, '2014-11-10 17:48:19', NULL, NULL),
	(29, 1, 1, 13, 43, '201511305', 145, 1, '2014-11-10 17:48:21', NULL, NULL),
	(30, 1, 1, 13, 44, '201511306', 116, 1, '2014-11-10 17:48:27', NULL, NULL),
	(31, 1, 1, 13, 45, '201511307', 100, 1, '2014-11-10 17:48:29', NULL, NULL),
	(32, 1, 1, 13, 46, '201511308', 89, 1, '2014-11-10 17:48:32', NULL, NULL),
	(33, 1, 1, 13, 47, '201511309', 97, 1, '2014-11-10 17:48:33', NULL, NULL),
	(34, 1, 1, 13, 48, '201511310', 88, 1, '2014-11-10 17:48:35', NULL, NULL),
	(35, 1, 1, 13, 49, '201511311', 123, 1, '2014-11-10 17:48:38', NULL, NULL),
	(36, 1, 1, 13, 50, '201511312', 88, 1, '2014-11-10 17:48:45', NULL, NULL),
	(37, 1, 1, 13, 51, '201511313', 78, 1, '2014-11-10 17:48:47', NULL, NULL),
	(38, 1, 1, 13, 52, '201511314', 98, 1, '2014-11-10 17:48:49', NULL, NULL),
	(39, 1, 1, 13, 53, '201511315', 100, 1, '2014-11-10 17:48:51', NULL, NULL),
	(40, 1, 1, 13, 54, '201511316', 120, 1, '2014-11-10 17:48:53', NULL, NULL),
	(41, 1, 1, 13, 55, '201511317', 85, 1, '2014-11-10 17:48:55', NULL, NULL),
	(42, 1, 1, 13, 56, '201511318', 77, 1, '2014-11-10 17:48:57', NULL, NULL),
	(43, 1, 1, 13, 57, '201511319', 62, 1, '2014-11-10 17:49:00', NULL, NULL),
	(44, 1, 1, 13, 58, '201511320', 98, 1, '2014-11-10 17:49:04', NULL, NULL),
	(45, 1, 1, 13, 59, '201511321', 120, 1, '2014-11-10 17:49:06', NULL, NULL),
	(46, 1, 1, 13, 60, '201511322', 113, 1, '2014-11-10 17:49:08', NULL, NULL),
	(47, 1, 1, 13, 61, '201511323', 112, 1, '2014-11-10 17:49:13', NULL, NULL),
	(48, 1, 1, 13, 62, '201511324', 50, 1, '2014-11-10 17:49:15', NULL, NULL),
	(49, 1, 1, 13, 64, '201511326', 85, 1, '2014-11-10 17:52:15', NULL, NULL),
	(50, 1, 1, 13, 65, '201511327', 16, 1, '2014-11-10 17:52:19', NULL, NULL),
	(51, 1, 1, 13, 66, '201511328', 55, 1, '2014-11-10 17:52:26', NULL, NULL),
	(52, 1, 1, 13, 67, '201511329', 48, 1, '2014-11-10 17:52:28', NULL, NULL),
	(53, 1, 1, 13, 68, '201511330', 90, 1, '2014-11-10 17:52:32', NULL, NULL),
	(54, 1, 1, 13, 69, '201511331', 100, 1, '2014-11-10 17:58:40', NULL, NULL),
	(55, 1, 1, 13, 70, '201511332', 123, 1, '2014-11-10 17:58:44', NULL, NULL),
	(56, 1, 1, 13, 71, '201511333', 143, 1, '2014-11-10 17:58:47', NULL, NULL),
	(57, 1, 1, 13, 72, '201511334', 120, 1, '2014-11-10 17:58:52', NULL, NULL),
	(58, 1, 1, 13, 73, '201511335', 111, 1, '2014-11-10 17:58:54', NULL, NULL),
	(59, 1, 1, 13, 74, '201511336', 84, 1, '2014-11-10 17:58:56', NULL, NULL),
	(60, 1, 1, 13, 75, '201511337', 75, 1, '2014-11-10 17:58:58', NULL, NULL),
	(61, 1, 1, 13, 76, '201511338', 96, 1, '2014-11-10 17:59:00', NULL, NULL),
	(62, 1, 1, 13, 77, '201511339', 88, 1, '2014-11-10 17:59:03', NULL, NULL),
	(63, 1, 1, 13, 78, '201511340', 37, 1, '2014-11-10 17:59:05', NULL, NULL),
	(64, 1, 1, 13, 79, '201511341', 67, 1, '2014-11-10 17:59:07', NULL, NULL),
	(65, 1, 1, 13, 80, '201511342', 77, 1, '2014-11-10 17:59:10', NULL, NULL),
	(66, 1, 1, 13, 81, '201511343', 18, 1, '2014-11-10 17:59:14', NULL, NULL),
	(67, 1, 1, 13, 82, '201511344', 120, 1, '2014-11-10 17:59:17', NULL, NULL),
	(68, 1, 1, 13, 83, '201511345', 123, 1, '2014-11-10 17:59:19', NULL, NULL),
	(69, 1, 1, 13, 84, '201511346', 147, 1, '2014-11-10 17:59:21', NULL, NULL),
	(70, 1, 1, 13, 85, '201511347', 98, 1, '2014-11-10 17:59:26', NULL, NULL),
	(71, 1, 1, 13, 86, '201511348', 99, 1, '2014-11-10 17:59:27', NULL, NULL),
	(72, 1, 1, 13, 87, '201511349', 90, 1, '2014-11-10 17:59:29', NULL, NULL),
	(73, 1, 1, 13, 88, '201511350', 58, 1, '2014-11-10 17:59:32', NULL, NULL),
	(74, 1, 1, 13, 89, '201511351', 107, 1, '2014-11-10 17:59:35', NULL, NULL),
	(75, 1, 1, 13, 90, '201511352', 144, 1, '2014-11-10 17:59:39', NULL, NULL),
	(76, 1, 1, 13, 91, '201511353', 42, 1, '2014-11-10 17:59:42', NULL, NULL),
	(77, 1, 1, 13, 92, '201511354', 77, 1, '2014-11-10 17:59:44', NULL, NULL),
	(78, 1, 1, 13, 93, '201511355', 98, 1, '2014-11-10 17:59:45', NULL, NULL),
	(79, 1, 1, 13, 94, '201511356', 20, 1, '2014-11-10 17:59:47', NULL, NULL),
	(80, 1, 1, 13, 95, '201511357', 1, 1, '2014-11-10 17:59:49', NULL, NULL),
	(81, 1, 1, 13, 96, '201511358', 88, 1, '2014-11-10 17:59:54', NULL, NULL),
	(82, 1, 1, 13, 97, '201511359', 99, 1, '2014-11-10 17:59:56', NULL, NULL),
	(83, 1, 1, 13, 98, '201511360', 24, 1, '2014-11-10 17:59:58', NULL, NULL),
	(84, 1, 1, 13, 99, '201511361', 77, 1, '2014-11-10 18:00:00', NULL, NULL),
	(85, 1, 1, 13, 100, '201511362', 86, 1, '2014-11-10 18:00:03', NULL, NULL),
	(86, 1, 1, 13, 101, '201511363', 104, 1, '2014-11-10 18:00:06', NULL, NULL),
	(87, 1, 1, 13, 102, '201511364', 123, 1, '2014-11-10 18:00:09', NULL, NULL),
	(88, 1, 1, 13, 103, '201511365', 47, 1, '2014-11-10 18:00:12', NULL, NULL),
	(89, 1, 1, 13, 104, '201511366', 80, 1, '2014-11-10 18:00:14', NULL, NULL),
	(90, 1, 1, 13, 105, '201511367', 89, 1, '2014-11-10 18:00:16', NULL, NULL),
	(91, 1, 1, 13, 106, '201511368', 68, 1, '2014-11-10 18:00:18', NULL, NULL),
	(92, 1, 1, 13, 107, '201511369', 132, 1, '2014-11-10 18:00:21', NULL, NULL),
	(93, 1, 1, 13, 63, '201511325', 44, 1, '2014-11-10 18:00:59', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- Dumping data for table xsglxtsql.t_students: ~0 rows (approximately)
DELETE FROM `t_students`;
/*!40000 ALTER TABLE `t_students` DISABLE KEYS */;
INSERT INTO `t_students` (`ID`, `province_code`, `name`, `status`, `sex`, `id_card_no`, `birthday`, `accommodation`, `payment1`, `payment2`, `payment3`, `payment4`, `payment5`, `payment6`, `bonus_penalty`, `address`, `parents_tel`, `parents_qq`, `school_of_graduation`, `senior_score`, `school_year`, `college_score`, `university`, `comment`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(40, NULL, '李宽', '1', 'M', '420902199907122641', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区卧龙乡', '13871855289', '', '西湖中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(41, NULL, '周志', '1', 'M', '420902199904050752', NULL, NULL, '', '', '', '', '', '', '', '南门桥17栋', '18971969963', '', '实验中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(42, NULL, '钱思美', '1', 'F', '420922199809125323', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇黄楼村', '13667235650', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(43, NULL, '李征美', '1', 'F', '420922199903255327', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇韩田村', '15549534193', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(44, NULL, '李思倩', '1', 'F', '420922199909035325', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇西边巷14号', '15571260720', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(45, NULL, '陈尚哲', '1', 'M', '420984199905228436', NULL, NULL, '', '', '', '', '', '', '', '汉川市中州农场建筑路', '15572507180', '', '江汉中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:44', NULL, NULL),
	(46, NULL, '屈哲奡', '1', 'M', '420984199911248417', NULL, NULL, '', '', '', '', '', '', '', '汉川市中州农场正街', '13227143653', '', '中州中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(47, NULL, '冯展', '1', 'M', '420922199811188219', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县三里镇', '15926842928', '', '三里中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(48, NULL, '刘雨', '1', 'F', '420902199907270422', NULL, NULL, '', '', '', '', '', '', '', '孝感市香澳路步行街', '13871918422', '', '丹阳中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(49, NULL, '陈棋', '1', 'F', '420902199812142225', NULL, NULL, '', '', '', '', '', '', '', '杨店镇广源小区', '13487206844', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(50, NULL, '蔡文明', '1', 'M', '422201199712262518', NULL, NULL, '', '', '', '', '', '', '', '杨店镇刘陈村蔡家村', '13687128658', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(51, NULL, '杨沙', '1', 'F', '420902200002102227', NULL, NULL, '', '', '', '', '', '', '', '杨店镇东方二村', '15826869964', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(52, NULL, '吕莹莹', '1', 'F', '420984199804187022', NULL, NULL, '', '', '', '', '', '', '', '汉川市新河镇吕家河村', '15072629458', '', '民乐中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(53, NULL, '张成', '1', 'M', '420902199805048417', NULL, NULL, '', '', '', '', '', '', '', '孝感市大新华村', '15971224048', '', '西湖中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(54, NULL, '刘慧慧', '1', 'F', '42092319990504436X', NULL, NULL, '', '', '', '', '', '', '', '孝感市云梦县', '15971204353', '', '沙河中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(55, NULL, '周争', '1', 'M', '42090219990511643X', NULL, NULL, '', '', '', '', '', '', '', '卧龙乡熊家湾', '13135610267', '', '西湖中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(56, NULL, '李苗', '1', 'M', '420902200001232214', NULL, NULL, '', '', '', '', '', '', '', '杨店镇永红村', '18327607631', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(57, NULL, '黄健康', '1', 'M', '420922199901275316', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇八一村', '18371268119', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(58, NULL, '王洪', '1', 'M', '420922199902185312', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县花桥村', '13476500935', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(59, NULL, '熊建勋', '1', 'M', '340826199912066616', NULL, NULL, '', '', '', '', '', '', '', '杨店镇东大市场', '13789968840', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(60, NULL, '张传恒', '1', 'M', '42090219991110416', NULL, NULL, '', '', '', '', '', '', '', '孝感市河口大桥', '13035189481', '', '永新中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(61, NULL, '熊子超', '1', 'M', '420902199809010432', NULL, NULL, '', '', '', '', '', '', '', '孝感市南桥小区', '15826874868', '', '实验中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(62, NULL, '王成军', '1', 'M', '420922200005267719', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县高店乡', '15871323848', '', '大新中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(63, NULL, '李云阳', '1', 'M', '420921199911205710', NULL, NULL, '', '', '', '', '', '', '', '孝昌县花西乡界河村', '15327156202', '', '台北路中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(64, NULL, '佘加勇', '1', 'M', '420921199802175516', NULL, NULL, '', '', '', '', '', '', '', '孝昌县白沙镇双佘村', '15272765879', '', '白沙中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(65, NULL, '朱淼', '1', 'F', '420118119990901354', NULL, NULL, '', '', '', '', '', '', '', '杨店镇刘陈村蔡家湾', '15629628735', '', '白果镇中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(66, NULL, '孙佳念', '1', 'F', '420902199907056864', NULL, NULL, '', '', '', '', '', '', '', '南大开发区燎原村', '13277129039', '', '西湖中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(67, NULL, '丁一梅', '1', 'F', '420921199810085545', NULL, NULL, '', '', '', '', '', '', '', '孝昌县白沙镇三合村三组', '13992524182', '', '安康初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(68, NULL, '杨盈', '1', 'F', '420921199806083029', NULL, NULL, '', '', '', '', '', '', '', '杨店镇档子镇杨家湾', '15098058201', '', '杨店中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(69, NULL, '曾繁繁', '1', 'F', '42092219980512602X', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县宣化镇新店村', '13534944098', '', '宣化镇中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(70, NULL, '黄贤淑', '1', 'F', '420982199806177220', NULL, NULL, '', '', '', '', '', '', '', '孝感市安陆烟店镇水寨村', '13227178065', '', '烟店初级中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(71, NULL, '周丽铭', '1', 'F', '420982199806167225', NULL, NULL, '', '', '', '', '', '', '', '孝感市安陆烟店镇周冲村', '18771700579', '', '烟店初级中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(72, NULL, '陈阳', '1', 'M', '420922199908231439', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县城关镇建新街', '15072678325', '', '城关中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(73, NULL, '代航', '1', 'M', '420902199906136811', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区毛陈镇', '13871865715', '', '毛陈中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(74, NULL, '普耳泰', '1', 'M', '422202199908051313', NULL, NULL, '', '', '', '', '', '', '', '孝感市应城市', '18071191682', '', '长江中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(75, NULL, '朱光耀', '1', 'M', '420902199910102251', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区杨店镇', '18164139443', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(76, NULL, '涂志怀', '1', 'M', '40922200005048217', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县三里镇', '13545449788', '', '三里中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(77, NULL, '姚海航', '1', 'M', '420921200007184814', NULL, NULL, '', '', '', '', '', '', '', '孝昌县花园镇府东小区', '18672584530', '', '孝昌一初', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(78, NULL, '曾成军', '1', 'M', '42092219990705491X', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县四姑镇', '13297556923', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(79, NULL, '徐程明', '1', 'M', '420921199809103013', NULL, NULL, '', '', '', '', '', '', '', '孝昌市邹岗镇', '15263166167', '', '芦管中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(80, NULL, '唐志杰', '1', 'M', '420923199809260935', NULL, NULL, '', '', '', '', '', '', '', '云梦县倒店乡魏家店唐王村', '13177272895', '', '罗庙中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(81, NULL, '阮业胜', '1', 'M', '420923199810040972', NULL, NULL, '', '', '', '', '', '', '', '云梦县倒店乡小阮', '15826805846', '', '罗庙中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(82, NULL, '夏涛', '1', 'M', '42220219971029183X', NULL, NULL, '', '', '', '', '', '', '', '应城市东子坊', '15928611419', '', '东中中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(83, NULL, '丁若晨', '1', 'F', '', NULL, NULL, '', '', '', '', '', '', '', '香澳路步行街', '13581460239', '', '丹阳中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(84, NULL, '陈梦林', '1', 'F', '420921199804185742', NULL, NULL, '', '', '', '', '', '', '', '文化路富康小区', '15571218870', '', '楚环中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(85, NULL, '陈佳顺', '1', 'M', '420902199901076231', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区', '13609115713', '', '盐步中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(86, NULL, '卢从山', '1', 'M', '420922199809235311', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇砚盘村2组', '15571291218', '', '吕王中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(87, NULL, '陈佳康', '1', 'M', '420902199909147719', NULL, NULL, '', '', '', '', '', '', '', '孝感市', '15971205174', '', '车站中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(88, NULL, '杨康', '1', 'M', '420902199908207214', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区三村', '', '', '东山头学校', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(89, NULL, '杨骐', '1', 'M', '420923199981215003', NULL, NULL, '', '', '', '', '', '', '', '云梦县沙河街3号', '18727485390', '', '沙河中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(90, NULL, '田喜', '1', 'M', '422202199912155713', NULL, NULL, '', '', '', '', '', '', '', '应城市天鹅镇', '13682688835', '', '黄滩中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(91, NULL, '刘聪', '1', 'M', '422201199906173230', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区', '13458634154', '', '成都大学附属中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(92, NULL, '童辉', '1', 'M', '420921199812085514', NULL, NULL, '', '', '', '', '', '', '', '孝南区万福街98号', '13986488068', '', '文昌中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(93, NULL, '宁锐', '1', 'M', '420921199811214636', NULL, NULL, '', '', '', '', '', '', '', '孝昌县花园镇一致村八组', '15869028398', '', '孝昌一初', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(94, NULL, '胡庆阳', '1', 'M', '420922199812036014', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县宣化镇中心街173号', '13823737385', '', '金山中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(95, NULL, '周佑俊', '1', 'M', '420922199911055617', NULL, NULL, '', '', '', '', '', '', '', '孝感市大悟县吕王镇施畈村一组', '', '', '吕王中学', NULL, 2014, NULL, NULL, '未参加中考', 1, '2014-11-10 17:27:45', NULL, NULL),
	(96, NULL, '高原秋儿', '1', 'F', '420902199908060443', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区', '13789938002', '', '实验中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(97, NULL, '徐雨芬', '1', 'F', '420923199808163949', NULL, NULL, '', '', '', '', '', '', '', '云梦县伍洛镇三集村', '13476552053', '', '伍洛中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(98, NULL, '张紫薇', '1', 'F', '420984199810087028', NULL, NULL, '', '', '', '', '', '', '', '汉川市新河镇窑头村', '15926859991', '', '伍洛中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(99, NULL, '李洋', '1', 'M', '42090219981022645X', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区七里村', '13972687210', '', '永新中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(100, NULL, '熊宏宇', '1', 'M', '420984199811130059', NULL, NULL, '', '', '', '', '', '', '', '汉川市汉正服装城旁', '13397278773', '', '北大附中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(101, NULL, '徐文娟', '1', 'F', '42090219990525772X', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区祝站镇联丰村孙家田', '13545460702', '', '祝站二中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(102, NULL, '魏茜', '1', 'F', '422202200003173426', NULL, NULL, '', '', '', '', '', '', '', '应城市城北', '13688942213', '', '巡检中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(103, NULL, '周琴', '1', 'F', '420902199905192221', NULL, NULL, '', '', '', '', '', '', '', '孝感市孝南区杨店镇柏树村道院湾4号', '18710390358', '', '杨店初中', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(104, NULL, '柳庆伟', '1', 'M', '420923199907164373', NULL, NULL, '', '', '', '', '', '', '', '黄花路68号', '13227185479', '', '实验中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(105, NULL, '冷耳聪', '1', 'M', '', NULL, NULL, '', '', '', '', '', '', '', '孝南区公安局三东三单元', '15897723162', '', '实验中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(106, NULL, '李婷婷', '1', 'F', '420921199711074461', NULL, NULL, '', '', '', '', '', '', '', '孝昌县王店镇', '13601220083', '', '裕中中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL),
	(107, NULL, '万惠惠', '1', 'F', '420923199810263949', NULL, NULL, '', '', '', '', '', '', '', '孝感市云梦县伍洛镇沿河街', '15549586843', '', '五洛中学', NULL, 2014, NULL, NULL, '', 1, '2014-11-10 17:27:45', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table xsglxtsql.t_student_classes: ~0 rows (approximately)
DELETE FROM `t_student_classes`;
/*!40000 ALTER TABLE `t_student_classes` DISABLE KEYS */;
INSERT INTO `t_student_classes` (`ID`, `student_number`, `student_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(18, '201511302', 40, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(19, '201511303', 41, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(20, '201511304', 42, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(21, '201511305', 43, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(22, '201511306', 44, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(23, '201511307', 45, 13, '1', 1, '2014-11-10 17:27:44', NULL, NULL),
	(24, '201511308', 46, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(25, '201511309', 47, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(26, '201511310', 48, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(27, '201511311', 49, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(28, '201511312', 50, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(29, '201511313', 51, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(30, '201511314', 52, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(31, '201511315', 53, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(32, '201511316', 54, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(33, '201511317', 55, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(34, '201511318', 56, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(35, '201511319', 57, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(36, '201511320', 58, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(37, '201511321', 59, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(38, '201511322', 60, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(39, '201511323', 61, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(40, '201511324', 62, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(41, '201511325', 63, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(42, '201511326', 64, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(43, '201511327', 65, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(44, '201511328', 66, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(45, '201511329', 67, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(46, '201511330', 68, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(47, '201511331', 69, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(48, '201511332', 70, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(49, '201511333', 71, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(50, '201511334', 72, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(51, '201511335', 73, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(52, '201511336', 74, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(53, '201511337', 75, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(54, '201511338', 76, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(55, '201511339', 77, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(56, '201511340', 78, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(57, '201511341', 79, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(58, '201511342', 80, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(59, '201511343', 81, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(60, '201511344', 82, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(61, '201511345', 83, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(62, '201511346', 84, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(63, '201511347', 85, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(64, '201511348', 86, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(65, '201511349', 87, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(66, '201511350', 88, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(67, '201511351', 89, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(68, '201511352', 90, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(69, '201511353', 91, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(70, '201511354', 92, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(71, '201511355', 93, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(72, '201511356', 94, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(73, '201511357', 95, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(74, '201511358', 96, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(75, '201511359', 97, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(76, '201511360', 98, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(77, '201511361', 99, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(78, '201511362', 100, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(79, '201511363', 101, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(80, '201511364', 102, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(81, '201511365', 103, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(82, '201511366', 104, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(83, '201511367', 105, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(84, '201511368', 106, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL),
	(85, '201511369', 107, 13, '1', 1, '2014-11-10 17:27:45', NULL, NULL);
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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `teacher_code` (`code`),
  CONSTRAINT `FK_t_teacher_t_users` FOREIGN KEY (`ID`) REFERENCES `t_users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teachers: ~15 rows (approximately)
DELETE FROM `t_teachers`;
/*!40000 ALTER TABLE `t_teachers` DISABLE KEYS */;
INSERT INTO `t_teachers` (`ID`, `code`, `name`, `status`, `sex`, `birthday`, `id_card_no`, `home_address`, `telephonoe`, `nation`, `birthplace`, `working_date`, `party_date`, `before_degree`, `before_graduate_date`, `before_graduate_school`, `before_graduate_major`, `current_degree`, `current_graduate_date`, `current_graduate_school`, `current_graduate_major`, `professional_technical_position`, `work_departments_postion`, `current_position_rank`, `current_position_date`, `current_level_date`, `basic_memo`, `continue_education_address`, `continue_education_date`, `continue_education_credit`, `continue_education_prove_people`, `moral_praise`, `moral_student_evaluation`, `moral_target_check`, `moral_memo`, `teach_grades`, `teach_subjects`, `teaching_research_postion`, `recruit_students`, `attendance`, `working_memo`, `tutorship_award`, `competition_award`, `paper_work`, `competition_item`, `business_memo`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROOT', '校长', '1', 'F', '2014-10-22', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 0, '2014-10-22 15:02:30', 1, '2014-11-06 15:29:47'),
	(108, 'T0001', '语文教师01', '1', 'M', '1980-02-04', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:15:12', 1, '2014-11-10 18:15:12'),
	(109, 'T0002', '数学教师01', '1', 'M', '1980-05-25', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:16:00', 1, '2014-11-10 18:16:00'),
	(110, 'T0003', '英语教师01', '1', 'M', '1980-05-25', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:16:34', 1, '2014-11-10 18:16:34'),
	(111, 'T0004', '物理教师01', '1', 'M', '2014-11-12', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:17:04', 1, '2014-11-10 18:17:04'),
	(112, 'T0005', '化学教师01', '1', 'M', '2014-11-04', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:17:31', 1, '2014-11-10 18:17:31'),
	(113, ' 生物', '生物教师01', '1', 'M', '1980-05-25', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-10 18:18:00', 1, '2014-11-10 18:18:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- Dumping data for table xsglxtsql.t_teacher_subjects: ~0 rows (approximately)
DELETE FROM `t_teacher_subjects`;
/*!40000 ALTER TABLE `t_teacher_subjects` DISABLE KEYS */;
INSERT INTO `t_teacher_subjects` (`ID`, `teacher_id`, `subject_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(24, 108, 1, 1, '2014-11-10 18:15:12', 1, '2014-11-10 18:15:12'),
	(25, 109, 2, 1, '2014-11-10 18:16:00', 1, '2014-11-10 18:16:00'),
	(26, 110, 3, 1, '2014-11-10 18:16:34', 1, '2014-11-10 18:16:34'),
	(27, 111, 4, 1, '2014-11-10 18:17:04', 1, '2014-11-10 18:17:04'),
	(28, 112, 5, 1, '2014-11-10 18:17:31', 1, '2014-11-10 18:17:31'),
	(29, 113, 6, 1, '2014-11-10 18:18:00', 1, '2014-11-10 18:18:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- Dumping data for table xsglxtsql.t_users: ~20 rows (approximately)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`ID`, `username`, `password`, `status`, `last_login_time`, `last_password_time`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', 'rootadmin', '1', '2014-11-10 17:21:57', '2014-11-05 12:08:13', 0, '2014-10-22 15:01:57', 1, '2014-11-05 12:08:13'),
	(40, '201511302', '19990712', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(41, '201511303', '19990405', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(42, '201511304', '19980912', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(43, '201511305', '19990325', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(44, '201511306', '19990903', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(45, '201511307', '19990522', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(46, '201511308', '19991124', '1', NULL, NULL, 1, '2014-11-10 17:27:44', NULL, NULL),
	(47, '201511309', '19981118', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(48, '201511310', '19990727', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(49, '201511311', '19981214', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(50, '201511312', '19971226', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(51, '201511313', '20000210', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(52, '201511314', '19980418', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(53, '201511315', '19980504', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(54, '201511316', '19990504', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(55, '201511317', '19990511', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(56, '201511318', '20000123', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(57, '201511319', '19990127', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(58, '201511320', '19990218', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(59, '201511321', '19991206', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(60, '201511322', '19991110', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(61, '201511323', '19980901', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(62, '201511324', '20000526', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(63, '201511325', '19991120', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(64, '201511326', '19980217', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(65, '201511327', '11999090', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(66, '201511328', '19990705', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(67, '201511329', '19981008', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(68, '201511330', '19980608', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(69, '201511331', '19980512', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(70, '201511332', '19980617', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(71, '201511333', '19980616', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(72, '201511334', '19990823', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(73, '201511335', '19990613', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(74, '201511336', '19990805', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(75, '201511337', '19991010', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(76, '201511338', '00005048', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(77, '201511339', '20000718', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(78, '201511340', '19990705', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(79, '201511341', '19980910', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(80, '201511342', '19980926', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(81, '201511343', '19981004', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(82, '201511344', '19971029', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(83, '201511345', '88888888', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(84, '201511346', '19980418', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(85, '201511347', '19990107', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(86, '201511348', '19980923', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(87, '201511349', '19990914', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(88, '201511350', '19990820', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(89, '201511351', '19998121', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(90, '201511352', '19991215', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(91, '201511353', '19990617', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(92, '201511354', '19981208', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(93, '201511355', '19981121', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(94, '201511356', '19981203', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(95, '201511357', '19991105', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(96, '201511358', '19990806', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(97, '201511359', '19980816', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(98, '201511360', '19981008', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(99, '201511361', '19981022', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(100, '201511362', '19981113', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(101, '201511363', '19990525', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(102, '201511364', '20000317', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(103, '201511365', '19990519', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(104, '201511366', '19990716', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(105, '201511367', '88888888', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(106, '201511368', '19971107', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(107, '201511369', '19981026', '1', NULL, NULL, 1, '2014-11-10 17:27:45', NULL, NULL),
	(108, 'T0001', '19800204', '1', NULL, NULL, 1, '2014-11-10 18:15:11', 1, '2014-11-10 18:15:11'),
	(109, 'T0002', '19800525', '1', NULL, NULL, 1, '2014-11-10 18:16:00', 1, '2014-11-10 18:16:00'),
	(110, 'T0003', '19800525', '1', NULL, NULL, 1, '2014-11-10 18:16:34', 1, '2014-11-10 18:16:34'),
	(111, 'T0004', '20141112', '1', NULL, NULL, 1, '2014-11-10 18:17:04', 1, '2014-11-10 18:17:04'),
	(112, 'T0005', '20141104', '1', NULL, NULL, 1, '2014-11-10 18:17:31', 1, '2014-11-10 18:17:31'),
	(113, ' 生物', '19800525', '1', NULL, NULL, 1, '2014-11-10 18:18:00', 1, '2014-11-10 18:18:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- Dumping data for table xsglxtsql.t_user_roles: ~0 rows (approximately)
DELETE FROM `t_user_roles`;
/*!40000 ALTER TABLE `t_user_roles` DISABLE KEYS */;
INSERT INTO `t_user_roles` (`ID`, `user_id`, `role_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 1, 5, 0, '2014-11-10 17:21:36', NULL, NULL),
	(32, 40, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(33, 41, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(34, 42, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(35, 43, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(36, 44, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(37, 45, 1, 1, '2014-11-10 17:27:44', NULL, NULL),
	(38, 46, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(39, 47, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(40, 48, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(41, 49, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(42, 50, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(43, 51, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(44, 52, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(45, 53, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(46, 54, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(47, 55, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(48, 56, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(49, 57, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(50, 58, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(51, 59, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(52, 60, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(53, 61, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(54, 62, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(55, 63, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(56, 64, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(57, 65, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(58, 66, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(59, 67, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(60, 68, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(61, 69, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(62, 70, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(63, 71, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(64, 72, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(65, 73, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(66, 74, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(67, 75, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(68, 76, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(69, 77, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(70, 78, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(71, 79, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(72, 80, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(73, 81, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(74, 82, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(75, 83, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(76, 84, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(77, 85, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(78, 86, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(79, 87, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(80, 88, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(81, 89, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(82, 90, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(83, 91, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(84, 92, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(85, 93, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(86, 94, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(87, 95, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(88, 96, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(89, 97, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(90, 98, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(91, 99, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(92, 100, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(93, 101, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(94, 102, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(95, 103, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(96, 104, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(97, 105, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(98, 106, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(99, 107, 1, 1, '2014-11-10 17:27:45', NULL, NULL),
	(100, 108, 2, 1, '2014-11-10 18:15:12', 1, '2014-11-10 18:15:12'),
	(101, 109, 2, 1, '2014-11-10 18:16:00', 1, '2014-11-10 18:16:00'),
	(102, 110, 2, 1, '2014-11-10 18:16:34', 1, '2014-11-10 18:16:34'),
	(103, 111, 2, 1, '2014-11-10 18:17:04', 1, '2014-11-10 18:17:04'),
	(104, 112, 2, 1, '2014-11-10 18:17:31', 1, '2014-11-10 18:17:31'),
	(105, 113, 2, 1, '2014-11-10 18:18:00', 1, '2014-11-10 18:18:00');
/*!40000 ALTER TABLE `t_user_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
