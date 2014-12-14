INSERT INTO `m_authoritys` (`ID`, `authority_name`, `category`, `status`, `level`, `access_path`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '个人信息修改', 'OTHER', '1', 1, 'setting/profile', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(2, '密码变更', 'OTHER', '1', 2, 'setting/password', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(3, '系统设置', 'OTHER', '1', 1, 'system/setting', 0, '2014-10-22 17:32:05', 1, '2014-11-06 18:46:48'),


	(10, '学生添加', 'STUDENT', '1', 1, 'student/create', 0, '2014-10-08 11:01:20', 0, '2014-10-08 11:01:20'),
	(11, '学生检索', 'STUDENT', '1', 2, 'student/search', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(12, '学生更新', 'STUDENT', '1', 3, 'student/update', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(13, '学生删除', 'STUDENT', '1', 4, 'student/delete', 0, '2014-10-08 10:59:44', 0, '2014-10-08 10:59:44'),
	(14, '学生信息导入', 'STUDENT', '1', 5, 'student/import', 0, '2014-10-09 15:55:34', 0, '2014-10-09 15:55:34'),
	
	(20, '教师添加', 'TEACHER', '1', 1, 'teacher/create', 0, '2014-10-08 11:02:38', 0, '2014-10-09 12:11:54'),
	(21, '教师检索', 'TEACHER', '1', 2, 'teacher/search', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(22, '教师更新', 'TEACHER', '1', 3, 'teacher/update', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(23, '教师删除', 'TEACHER', '1', 4, 'teacher/delete', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	(24, '教师导入', 'TEACHER', '1', 5, 'teacher/import', 0, '2014-10-08 11:01:51', 0, '2014-10-08 11:01:51'),
	
	(30, '班级添加', 'CLASS', '1', 1, 'class/create', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(31, '班级检索', 'CLASS', '1', 2, 'class/search', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(32, '班级更新', 'CLASS', '1', 3, 'class/update', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(33, '班级暂停(批量)', 'CLASS', '1', 4, 'class/stopMore', 0, '2014-10-08 11:02:38', 0, '2014-10-08 11:02:38'),
	(34, '班级学生一览', 'CLASS', '1', 6, 'class/student', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	(35, '班级暂停(单个)', 'CLASS', '1', 6, 'class/stopOne', 0, '2014-10-10 18:05:58', 0, '2014-10-10 18:05:58'),
	
	(40, '课程安排添加', 'COURSE', '1', 1, 'course/create', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(41, '课程安排检索', 'COURSE', '1', 2, 'course/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(42, '课程安排更新', 'COURSE', '1', 3, 'course/update', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(43, '课程安排删除', 'COURSE', '1', 4, 'course/delete', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	
	(50, '成绩添加', 'SCORE', '1', 1, 'score/create', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(51, '成绩检索', 'SCORE', '1', 2, 'score/search', 0, '2014-10-08 11:05:29', 0, '2014-10-08 11:05:29'),
	(52, '成绩更新', 'SCORE', '1', 3, 'score/update', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(53, '成绩删除', 'SCORE', '1', 4, 'score/delete', 0, '2014-10-08 11:08:01', 0, '2014-10-08 11:08:01'),
	(54, '成绩查询(学生)', 'SCORE', '1', 5, 'score/query', 0, '2014-10-09 14:26:49', 0, '2014-10-09 14:26:49'),
	(55, '班级学生成绩', 'SCORE', '1', 6, 'score/class', 1, '2014-10-24 19:56:33', 1, '2014-11-06 18:46:30'),
	(56, '成绩统计分析', 'SCORE', '1', 0, 'score/analysis', 1, '2014-11-07 12:17:41', NULL, NULL),
	
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
	(83, '科目删除', 'SUBJECT', '1', 4, 'subject/delete', 0, '2014-10-09 14:36:44', 0, '2014-10-09 14:36:44');
	


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




INSERT INTO `m_roles` (`ID`, `role_name`, `status`, `create_user`, `create_time`, `update_user`, `update_time`) VALUES
	(1, '学生', '1', 0, '2014-10-08 11:10:17', 1, '2014-11-12 16:57:34'),
	(2, '教师', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:23'),
	(3, '学工科', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:51:52'),
	(4, '教务处', '1', 0, '2014-10-08 11:11:47', 1, '2014-10-24 19:58:40'),
	(5, '校长', '1', 1, '2014-10-09 15:34:20', 1, '2014-11-13 17:42:01');
/*!40000 ALTER TABLE `m_roles` ENABLE KEYS */;



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