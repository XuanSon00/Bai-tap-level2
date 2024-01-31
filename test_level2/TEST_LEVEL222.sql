-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table test_level_2.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `course_subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_class` int NOT NULL,
  `course_description` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `course_teacher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_image` mediumblob NOT NULL,
  `course_price` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.courses: ~0 rows (approximately)

-- Dumping structure for table test_level_2.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subject_des` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.subjects: ~8 rows (approximately)
INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_des`) VALUES
	(1, 'Toán Học', 'Đại số/Hình Học'),
	(2, 'Vật Lý', 'Cơ Học/Nhiệt Học/Quang Học'),
	(3, 'Hóa Học', 'Hóa hữu cơ/ Hóa vô cơ/Hóa Lý'),
	(4, 'Tiếng Anh', 'Writing/Speaking/Grammar/Listening'),
	(5, 'Ngữ Văn', 'Văn Học Việt Nam/ Văn Học Thế Giới'),
	(6, 'Sinh Học', 'Sinh Thái Học/ Di truyền Học/ Sinh Lý Học'),
	(7, 'Lịch Sử', 'Lịch sử Việt Nam/ Lịch sử Thế Giới'),
	(8, 'Địa Lý', 'Địa lý Việt Nam/ Địa Lý thế giới');

-- Dumping structure for table test_level_2.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_birthday` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `teacher_email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.teachers: ~1 rows (approximately)
INSERT INTO `teachers` (`teacher_id`, `teacher_name`, `teacher_birthday`, `teacher_email`, `created_at`, `updated_at`) VALUES
	(9, 'Lê Văn E', '1989-02-02', 'levanE@gmail.com', '2024-01-28 16:58:10', NULL);

-- Dumping structure for table test_level_2.teach_subject
CREATE TABLE IF NOT EXISTS `teach_subject` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `teacher_id` int NOT NULL,
  `subject_id` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.teach_subject: ~0 rows (approximately)

-- Dumping structure for table test_level_2.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_pass` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_birthday` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` int NOT NULL,
  `user_active` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.users: ~8 rows (approximately)
INSERT INTO `users` (`user_id`, `user_name`, `username`, `user_pass`, `user_birthday`, `user_email`, `created_at`, `updated_at`, `user_role`, `user_active`) VALUES
	(2, 'Nguyễn Văn B', 'son00', '123', '29-12-1997', 'c@gmail.com', '2024-01-09 23:46:54', NULL, 1, 1),
	(3, 'Nguyễn Văn A', 'sonson', '$2y$10$MmB08Rw1KVjUaRdpzet08O.t2GziX1gMoAdOiJk.pgp0Gt3gzQVxO', '1997-12-29', 'sonson@gmail.com', '2024-01-10 06:26:49', '2024-01-31 13:46:42', 1, 0),
	(4, 'Nguyễn Văn C', 'sonson000', '123', '29-12-1997', 'abc@gmail.com', '2024-01-10 07:00:01', NULL, 1, 1),
	(5, 'Nguyễn Văn D', 'sonson197', '123', '11-11-1997', 'a@gmail.com', '2024-01-12 13:33:11', NULL, 1, 0),
	(6, 'admin', 'admin', '1', '01-01-1997', 'admin@gmail.com', NULL, NULL, 0, 1),
	(7, 'Nguyễn Văn F', 'aaabbb', '$2y$10$IcakZFIyu32GUgTO6xjNkemTpL6TCQctVbevgqn6sFIO66ypkClOO', '29-12-1994', 'b@gmail.com', '2024-01-24 13:26:42', NULL, 1, 0),
	(8, 'Nguyễn Văn AAA', 'sonsonson01', '$2y$10$hOuYyzhmqlhGILsQRFGydu6XAz2S9uYfoEHMM9w96Ies/S0sYlvI6', '29-12-1999', 'sonnguyen0@gmail.com', '2024-01-24 14:10:44', NULL, 1, 1),
	(9, 'Nguyễn Xuân Sơn', 'sonnguyen197', '$2y$10$I9cRZGGrlL4s2DZwUMBTeeq83YPK.f0eqoZj36yfQjwAnqaWtlyxy', '29-12-1997', 'sonnguyen@gmail.com', '2024-01-29 06:04:19', NULL, 0, 1);

-- Dumping structure for table test_level_2.user_courses
CREATE TABLE IF NOT EXISTS `user_courses` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `course_subject` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_class` int NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_teacher` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.user_courses: ~6 rows (approximately)
INSERT INTO `user_courses` (`ID`, `user_name`, `course_subject`, `course_class`, `course_name`, `course_teacher`, `user_id`, `course_id`, `created_at`) VALUES
	(13, 'Nguyễn Văn A', ' Toán Học', 10, 'Khóa học Online', ' Lê Văn A', 3, 25, '2024-01-26 19:10:48'),
	(14, 'Nguyễn Văn A', ' Toán Học', 11, 'Khóa học Trực tiếp', ' Lê Văn A', 3, 26, '2024-01-26 19:11:46'),
	(15, 'Nguyễn Văn A', ' Ngữ Văn', 10, 'Khóa học Online', ' Lê Văn D', 3, 28, '2024-01-26 19:11:54'),
	(22, 'Nguyễn Xuân Sơn', ' Vật Lý', 11, 'Khóa học Trực tiếp', ' Lê Văn B', 9, 27, '2024-01-29 21:25:42'),
	(23, 'Nguyễn Xuân Sơn', ' Toán Học', 11, 'Khóa học Trực tiếp', ' Lê Văn A', 9, 26, '2024-01-31 12:28:04'),
	(24, 'Nguyễn Văn A', ' Hóa Học', 10, 'Khóa học Online', ' Lê Văn B', 9, 4, '2024-01-31 22:03:48');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
