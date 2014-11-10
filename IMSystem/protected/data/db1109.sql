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

-- 正在导出表  xsglxtsql.m_authoritys 的数据：~41 rows (大约)
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


-- 导出  表 xsglxtsql.m_config 结构
DROP TABLE IF EXISTS `m_config`;
CREATE TABLE IF NOT EXISTS `m_config` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` char(50) COLLATE utf8_bin NOT NULL COMMENT '键',
  `value` text COLLATE utf8_bin COMMENT '值',
  `comment` text COLLATE utf8_bin COMMENT '详细说明',
  PRIMARY KEY (`ID`),
  KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 正在导出表  xsglxtsql.m_config 的数据：~2 rows (大约)
DELETE FROM `m_config`;
/*!40000 ALTER TABLE `m_config` DISABLE KEYS */;
INSERT INTO `m_config` (`ID`, `key`, `value`, `comment`) VALUES
	(1, 'IMPORT_STUDENT_DATA_RANGE', '2014-10-07|2014-10-30', NULL),
	(2, 'IS_RUNNING', '1', NULL);
/*!40000 ALTER TABLE `m_config` ENABLE KEYS */;


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
  `update_user` int(10) unsigned DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_m_courses_m_subjects` (`subject_id`),
  KEY `FK_m_courses_t_teachers` (`teacher_id`),
  KEY `FK_m_courses_t_classes` (`class_id`),
  CONSTRAINT `FK_m_courses_m_subjects` FOREIGN KEY (`subject_id`) REFERENCES `m_subjects` (`ID`),
  CONSTRAINT `FK_m_courses_t_classes` FOREIGN KEY (`class_id`) REFERENCES `t_classes` (`ID`),
  CONSTRAINT `FK_m_courses_t_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `t_teachers` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='课程表';

-- 正在导出表  xsglxtsql.m_courses 的数据：~9 rows (大约)
DELETE FROM `m_courses`;
/*!40000 ALTER TABLE `m_courses` DISABLE KEYS */;
INSERT INTO `m_courses` (`ID`, `subject_id`, `teacher_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(2, 2, 25, 1, '1', 1, '2014-10-24 15:27:34', 1, '2014-11-06 17:25:24'),
	(3, 3, 21, 1, '1', 1, '2014-10-24 15:27:37', 1, '2014-11-06 17:25:28'),
	(4, 4, 13, 1, '1', 1, '2014-10-24 15:44:01', 1, '2014-10-24 15:44:01'),
	(5, 5, 14, 1, '1', 1, '2014-10-24 15:44:04', 1, '2014-10-24 15:44:04'),
	(6, 6, 11, 1, '1', 1, '2014-10-24 15:44:07', 1, '2014-10-24 15:44:07'),
	(7, 7, 15, 1, '1', 1, '2014-10-24 15:44:09', 1, '2014-10-24 15:44:09'),
	(8, 8, 16, 1, '1', 1, '2014-10-24 15:44:12', 1, '2014-10-24 15:44:12'),
	(9, 9, 20, 1, '1', 1, '2014-10-24 15:44:15', 1, '2014-10-24 15:44:17'),
	(10, 1, 21, 1, '1', 1, '2014-11-06 17:25:18', 1, '2014-11-06 17:25:18');
/*!40000 ALTER TABLE `m_courses` ENABLE KEYS */;


-- 导出  表 xsglxtsql.m_exams 结构
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

-- 正在导出表  xsglxtsql.m_exams 的数据：~15 rows (大约)
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


-- 导出  表 xsglxtsql.m_roles 结构
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

-- 正在导出表  xsglxtsql.m_roles 的数据：~5 rows (大约)
DELETE FROM `m_roles`;
/*!40000 ALTER TABLE `m_roles` DISABLE KEYS */;
INSERT INTO `m_roles` (`ID`, `role_name`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '学生', '1', 0, '2014-10-08 11:10:17', 1, '2014-10-22 15:14:34'),
	(2, '教师', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:23'),
	(3, '学工科', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:51:52'),
	(4, '教务处', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:40'),
	(5, '校长', '1', 1, '2014-10-09 15:34:20', 1, '2014-11-07 12:22:16');
/*!40000 ALTER TABLE `m_roles` ENABLE KEYS */;


-- 导出  表 xsglxtsql.m_role_authoritys 结构
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

-- 正在导出表  xsglxtsql.m_role_authoritys 的数据：~78 rows (大约)
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


-- 导出  表 xsglxtsql.m_subjects 结构
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

-- 正在导出表  xsglxtsql.m_subjects 的数据：~9 rows (大约)
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


-- 导出  表 xsglxtsql.t_classes 结构
DROP TABLE IF EXISTS `t_classes`;
CREATE TABLE IF NOT EXISTS `t_classes` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `class_code` char(20) COLLATE utf8_bin NOT NULL COMMENT '班级CODE',
  `class_name` char(50) COLLATE utf8_bin DEFAULT NULL COMMENT '班级名称',
  `grade` int(1) DEFAULT NULL COMMENT '年级',
  `entry_year` int(4) DEFAULT NULL COMMENT '入学年份',
  `term_type` enum('1','2') COLLATE utf8_bin DEFAULT NULL COMMENT '学期(1:上学期 2:下学期)',
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

-- 正在导出表  xsglxtsql.t_classes 的数据：~40 rows (大约)
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
	(40, '312', '高三(12)', 3, 2012, '1', '0', NULL, '1', 5, 0, '2014-11-04 17:06:41', 1, '2014-11-06 17:21:25');
/*!40000 ALTER TABLE `t_classes` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_file_upload 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 正在导出表  xsglxtsql.t_file_upload 的数据：~32 rows (大约)
DELETE FROM `t_file_upload`;
/*!40000 ALTER TABLE `t_file_upload` DISABLE KEYS */;
INSERT INTO `t_file_upload` (`ID`, `filename`, `realpath`, `category`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(3, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415452447.xls', 'import_student', NULL, 1, '2014-11-08 22:14:07', 1, NULL),
	(4, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415452487.xls', 'import_student', NULL, 1, '2014-11-08 22:14:47', 1, NULL),
	(5, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415452591.xls', 'import_student', NULL, 1, '2014-11-08 22:16:31', 1, NULL),
	(6, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415452707.xls', 'import_student', NULL, 1, '2014-11-08 22:18:27', 1, NULL),
	(7, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453219.xls', 'import_student', NULL, 1, '2014-11-08 22:26:59', 1, NULL),
	(8, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453310.xls', 'import_student', NULL, 1, '2014-11-08 22:28:30', 1, NULL),
	(9, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453337.xls', 'import_student', NULL, 1, '2014-11-08 22:28:57', 1, NULL),
	(10, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453378.xls', 'import_student', NULL, 1, '2014-11-08 22:29:38', 1, NULL),
	(11, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453389.xls', 'import_student', NULL, 1, '2014-11-08 22:29:49', 1, NULL),
	(12, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453480.xls', 'import_student', NULL, 1, '2014-11-08 22:31:20', 1, NULL),
	(13, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453863.xls', 'import_student', NULL, 1, '2014-11-08 22:37:43', 1, NULL),
	(14, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453935.xls', 'import_student', NULL, 1, '2014-11-08 22:38:55', 1, NULL),
	(15, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415453971.xls', 'import_student', NULL, 1, '2014-11-08 22:39:31', 1, NULL),
	(16, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454041.xls', 'import_student', NULL, 1, '2014-11-08 22:40:41', 1, NULL),
	(17, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454074.xls', 'import_student', NULL, 1, '2014-11-08 22:41:14', 1, NULL),
	(18, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454191.xls', 'import_student', NULL, 1, '2014-11-08 22:43:11', 1, NULL),
	(19, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454213.xls', 'import_student', NULL, 1, '2014-11-08 22:43:33', 1, NULL),
	(20, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454341.xls', 'import_student', NULL, 1, '2014-11-08 22:45:41', 1, NULL),
	(21, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454440.xls', 'import_student', NULL, 1, '2014-11-08 22:47:20', 1, NULL),
	(22, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415454499.xls', NULL, NULL, 1, '2014-11-08 22:48:19', 1, NULL),
	(23, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415455604.xls', NULL, NULL, 1, '2014-11-08 23:06:44', 1, NULL),
	(25, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415455863.xls', NULL, NULL, 1, '2014-11-08 23:11:03', 1, NULL),
	(26, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415455930.xls', NULL, NULL, 1, '2014-11-08 23:12:10', 1, NULL),
	(27, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415456139.xls', NULL, NULL, 1, '2014-11-08 23:15:39', 1, NULL),
	(29, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415494536.xls', NULL, NULL, 1, '2014-11-09 09:55:36', 1, NULL),
	(30, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415494667.xls', NULL, NULL, 1, '2014-11-09 09:57:47', 1, NULL),
	(31, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415495500.xls', NULL, NULL, 1, '2014-11-09 10:11:40', 1, NULL),
	(36, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415495735.xls', NULL, NULL, 1, '2014-11-09 10:15:35', 1, NULL),
	(37, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415496041.xls', NULL, NULL, 1, '2014-11-09 10:20:41', 1, NULL),
	(38, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415496321.xls', NULL, NULL, 1, '2014-11-09 10:25:21', 1, NULL),
	(39, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415496498.xls', NULL, NULL, 1, '2014-11-09 10:28:18', 1, NULL),
	(40, '学生信息一览表 总表.xls', 'D:\\PHP\\manage\\IMSystem\\protected\\config\\..\\..\\uploadfile\\1415496669.xls', NULL, NULL, 1, '2014-11-09 10:31:09', 1, NULL);
/*!40000 ALTER TABLE `t_file_upload` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_scores 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='成绩表';

-- 正在导出表  xsglxtsql.t_scores 的数据：~5 rows (大约)
DELETE FROM `t_scores`;
/*!40000 ALTER TABLE `t_scores` DISABLE KEYS */;
INSERT INTO `t_scores` (`ID`, `exam_id`, `subject_id`, `class_id`, `student_id`, `student_number`, `score`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(21, 1, 1, 1, 23, '201410101', 130, 1, '2014-11-07 11:20:53', 1, '2014-11-07 11:25:27'),
	(22, 1, 1, 1, 24, '201410102', 145, 1, '2014-11-07 11:20:57', 1, '2014-11-07 11:25:34'),
	(23, 1, 2, 1, 23, '201410101', 10.5, 1, '2014-11-07 11:21:44', NULL, NULL),
	(24, 1, 3, 1, 23, '201410101', 132, 1, '2014-11-07 11:32:32', 1, '2014-11-07 11:43:09'),
	(25, 1, 3, 1, 24, '201410102', 146, 1, '2014-11-07 11:32:35', 1, '2014-11-07 11:43:43');
/*!40000 ALTER TABLE `t_scores` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_students 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='学生信息表';

-- 正在导出表  xsglxtsql.t_students 的数据：~3 rows (大约)
DELETE FROM `t_students`;
/*!40000 ALTER TABLE `t_students` DISABLE KEYS */;
INSERT INTO `t_students` (`ID`, `province_code`, `name`, `status`, `sex`, `id_card_no`, `birthday`, `accommodation`, `payment1`, `payment2`, `payment3`, `payment4`, `payment5`, `payment6`, `bonus_penalty`, `address`, `parents_tel`, `parents_qq`, `school_of_graduation`, `senior_score`, `school_year`, `college_score`, `university`, `comment`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(9, '20140001', '20140001', '1', 'M', '420984198605252712', '2014-09-16', '', '1', '1', '1', '1', '1', '1', '', '', '', '', '', NULL, NULL, NULL, '', '', 1, '2014-10-24 14:29:02', 1, '2014-11-06 15:30:19'),
	(23, 'AAA', '姓名', '1', 'M', '420984198605252712', '2014-10-13', '', '0', '0', '0', '0', '0', '0', '', '', '', '', '', NULL, NULL, NULL, '', '', 1, '2014-11-06 16:02:38', NULL, NULL),
	(24, 'AAA', '姓名', '1', 'M', '420984198605252712', '2014-10-13', '', '0', '0', '0', '0', '0', '0', '', '', '', '', '', NULL, NULL, NULL, '', '', 1, '2014-11-06 16:09:14', NULL, NULL);
/*!40000 ALTER TABLE `t_students` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_student_classes 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- 正在导出表  xsglxtsql.t_student_classes 的数据：~8 rows (大约)
DELETE FROM `t_student_classes`;
/*!40000 ALTER TABLE `t_student_classes` DISABLE KEYS */;
INSERT INTO `t_student_classes` (`ID`, `student_number`, `student_id`, `class_id`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '20120114', 9, 1, '0', 1, '2014-10-24 14:29:02', 1, '2014-10-24 14:29:02'),
	(2, '20120414', 9, 4, '0', 1, '2014-10-24 14:51:17', 1, '2014-10-24 14:51:17'),
	(3, '20120650', 9, 6, '0', 1, '2014-10-24 14:53:36', 1, '2014-10-24 14:53:36'),
	(4, '20120117', 9, 1, '0', 1, '2014-10-24 14:57:03', 1, '2014-10-24 14:57:03'),
	(5, NULL, 9, 2, '0', 1, '2014-11-06 13:53:31', 1, '2014-11-06 13:53:31'),
	(6, '20120315', 9, 30, '1', 1, '2014-11-06 13:53:46', 1, '2014-11-06 13:53:46'),
	(7, '201410101', 23, 1, '1', 1, '2014-11-06 16:02:39', NULL, NULL),
	(8, '201410102', 24, 1, '1', 1, '2014-11-06 16:09:14', NULL, NULL);
/*!40000 ALTER TABLE `t_student_classes` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_teachers 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- 正在导出表  xsglxtsql.t_teachers 的数据：~17 rows (大约)
DELETE FROM `t_teachers`;
/*!40000 ALTER TABLE `t_teachers` DISABLE KEYS */;
INSERT INTO `t_teachers` (`ID`, `code`, `name`, `status`, `sex`, `birthday`, `id_card_no`, `home_address`, `telephonoe`, `nation`, `birthplace`, `working_date`, `party_date`, `before_degree`, `before_graduate_date`, `before_graduate_school`, `before_graduate_major`, `current_degree`, `current_graduate_date`, `current_graduate_school`, `current_graduate_major`, `professional_technical_position`, `work_departments_postion`, `current_position_rank`, `current_position_date`, `current_level_date`, `basic_memo`, `continue_education_address`, `continue_education_date`, `continue_education_credit`, `continue_education_prove_people`, `moral_praise`, `moral_student_evaluation`, `moral_target_check`, `moral_memo`, `teach_grades`, `teach_subjects`, `teaching_research_postion`, `recruit_students`, `attendance`, `working_memo`, `tutorship_award`, `competition_award`, `paper_work`, `competition_item`, `business_memo`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'ROOT', '管理员', '1', 'F', '2014-10-22', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 0, '2014-10-22 15:02:30', 1, '2014-11-06 15:29:47'),
	(5, 'jwc', '教务处', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(6, 'xgc', '学工科', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', '校长', '1', 'M', '2014-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', '语文教师001', '1', 'M', '2014-10-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(10, 'sx001', '数学01', '1', 'M', '2014-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:01:47', 10, '2014-10-24 15:04:30'),
	(11, 'sw001', '生物01', '1', 'M', '2014-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(12, 'yy001', '英语01', '1', 'F', '2014-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(13, 'wl001', '物理01', '1', 'M', '2014-10-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(14, 'hx01', '化学01', '1', 'M', '2014-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(15, 'zz01', '政治01', '1', 'M', '2014-10-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(16, 'ls01', '历史01', '1', 'M', '2014-10-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(17, 'dl01', '地理01', '1', 'M', '2014-10-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(20, 'dl02', '地理02', '1', 'M', '2014-10-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(21, 'qn01', '全能01', '1', 'M', '2014-10-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(22, '0236', '刘耀', '1', 'M', '1982-11-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46'),
	(25, 'JG004', 'JG004', '1', 'M', '2014-11-04', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', '', '', '', '', '', '', '', 1, '2014-11-06 17:14:57', 1, '2014-11-06 17:14:57');
/*!40000 ALTER TABLE `t_teachers` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_teacher_subjects 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='教师表';

-- 正在导出表  xsglxtsql.t_teacher_subjects 的数据：~23 rows (大约)
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
	(20, 22, 1, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46'),
	(21, 25, 1, 1, '2014-11-06 17:14:57', 1, '2014-11-06 17:14:57'),
	(22, 25, 2, 1, '2014-11-06 17:14:57', 1, '2014-11-06 17:14:57'),
	(23, 25, 3, 1, '2014-11-06 17:14:57', 1, '2014-11-06 17:14:57');
/*!40000 ALTER TABLE `t_teacher_subjects` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_users 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- 正在导出表  xsglxtsql.t_users 的数据：~20 rows (大约)
DELETE FROM `t_users`;
/*!40000 ALTER TABLE `t_users` DISABLE KEYS */;
INSERT INTO `t_users` (`ID`, `username`, `password`, `status`, `last_login_time`, `last_password_time`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, 'root', 'rootadmin', '1', '2014-11-09 09:53:56', '2014-11-05 12:08:13', 0, '2014-10-22 15:01:57', 1, '2014-11-05 12:08:13'),
	(5, 'jwc', 'test1234', '1', NULL, NULL, 1, '2014-10-22 17:12:54', 1, '2014-10-22 17:12:54'),
	(6, 'xgc', 'test1234', '1', NULL, NULL, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(7, 'xz', 'test1234', '1', NULL, NULL, 1, '2014-10-22 17:14:42', 1, '2014-10-22 17:14:42'),
	(8, 'js001', 'test1234', '1', NULL, NULL, 1, '2014-10-22 17:19:59', 1, '2014-10-22 17:19:59'),
	(9, '20140001', 'test1234', '1', NULL, NULL, 1, '2014-10-24 14:29:02', 1, '2014-10-24 14:29:02'),
	(10, 'sx001', 'test1234', '1', NULL, NULL, 1, '2014-10-24 15:01:47', 10, '2014-10-24 15:22:35'),
	(11, 'sw001', '20141021', '1', NULL, NULL, 1, '2014-10-24 15:02:15', 1, '2014-10-24 15:02:15'),
	(12, 'yy001', '20141021', '1', NULL, NULL, 1, '2014-10-24 15:02:44', 1, '2014-10-24 15:02:44'),
	(13, 'wl001', '20141007', '1', NULL, NULL, 1, '2014-10-24 15:28:23', 1, '2014-10-24 15:28:23'),
	(14, 'hx01', '20141019', '1', NULL, NULL, 1, '2014-10-24 15:28:43', 1, '2014-10-24 15:28:43'),
	(15, 'zz01', '20141008', '1', NULL, NULL, 1, '2014-10-24 15:29:07', 1, '2014-10-24 15:29:07'),
	(16, 'ls01', '20141013', '1', NULL, NULL, 1, '2014-10-24 15:29:50', 1, '2014-10-24 15:29:50'),
	(17, 'dl01', '20141009', '1', NULL, NULL, 1, '2014-10-24 15:30:11', 1, '2014-10-24 15:30:11'),
	(20, 'dl02', '20141009', '1', NULL, NULL, 1, '2014-10-24 15:38:09', 1, '2014-10-24 15:38:09'),
	(21, 'qn01', '20141006', '1', NULL, NULL, 1, '2014-10-24 15:38:45', 1, '2014-10-24 15:38:45'),
	(22, '0236', '19821123', '1', NULL, NULL, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46'),
	(23, '201410101', '20141013', '1', NULL, NULL, 1, '2014-11-06 16:02:38', NULL, NULL),
	(24, '201410102', '20141013', '1', NULL, NULL, 1, '2014-11-06 16:09:14', NULL, NULL),
	(25, 'JG004', '20141104', '1', NULL, NULL, 1, '2014-11-06 17:14:56', 1, '2014-11-06 17:14:56');
/*!40000 ALTER TABLE `t_users` ENABLE KEYS */;


-- 导出  表 xsglxtsql.t_user_roles 结构
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色表';

-- 正在导出表  xsglxtsql.t_user_roles 的数据：~21 rows (大约)
DELETE FROM `t_user_roles`;
/*!40000 ALTER TABLE `t_user_roles` DISABLE KEYS */;
INSERT INTO `t_user_roles` (`ID`, `user_id`, `role_id`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(2, 5, 4, 1, '2014-10-22 17:12:55', 1, '2014-10-22 17:12:55'),
	(3, 6, 3, 1, '2014-10-22 17:13:53', 1, '2014-10-22 17:13:53'),
	(4, 1, 5, 1, '2014-11-07 12:23:03', 1, '2014-10-22 17:14:42'),
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
	(19, 22, 2, 1, '2014-10-25 15:15:46', 1, '2014-10-25 15:15:46'),
	(20, 23, 1, 1, '2014-11-06 16:02:38', NULL, NULL),
	(21, 24, 1, 1, '2014-11-06 16:09:14', NULL, NULL),
	(22, 25, 2, 1, '2014-11-06 17:14:57', 1, '2014-11-06 17:14:57');
/*!40000 ALTER TABLE `t_user_roles` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
