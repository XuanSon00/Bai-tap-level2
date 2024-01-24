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

-- Dumping structure for table test_level_2.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_password` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.admin: ~0 rows (approximately)
INSERT INTO `admin` (`admin_username`, `admin_password`) VALUES
	('admin', '123');

-- Dumping structure for table test_level_2.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` int NOT NULL AUTO_INCREMENT,
  `course_subject` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_class` int NOT NULL,
  `course_description` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `course_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `course_image` mediumblob NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.courses: ~8 rows (approximately)
INSERT INTO `courses` (`course_id`, `course_subject`, `course_name`, `course_class`, `course_description`, `course_status`, `course_image`) VALUES
	(1, 'Tiếng Anh', 'Khóa học Online', 11, 'Verb ', '0', _binary 0x2e2e2f75706c6f6164732f363561643665353162653530612e706e67),
	(2, 'Sinh Học', 'Khóa học Trực tiếp', 10, 'qewq', '1', _binary 0x2e2e2f75706c6f6164732f363561643665373633366263642e706e67),
	(3, 'Địa Lý', 'Khóa học Online', 11, '', '1', _binary 0x2e2e2f75706c6f6164732f363561646262303337626237642e706e67),
	(4, 'Vật Lý', 'Khóa học Trực tiếp', 10, 'AAA+', '1', _binary 0x2e2e2f75706c6f6164732f363561646262323062363838612e6a7067);

-- Dumping structure for table test_level_2.lessons
CREATE TABLE IF NOT EXISTS `lessons` (
  `lesson_id` int NOT NULL AUTO_INCREMENT,
  `lesson_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lesson_des` text COLLATE utf8mb4_general_ci,
  `lesson_video` longblob NOT NULL,
  `lesson_status` enum('Y','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.lessons: ~0 rows (approximately)

-- Dumping structure for table test_level_2.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject_des` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.subjects: ~0 rows (approximately)

-- Dumping structure for table test_level_2.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_pass` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `user_birthday` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_role` int NOT NULL,
  `user_active` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.users: ~6 rows (approximately)
INSERT INTO `users` (`user_id`, `user_name`, `username`, `user_pass`, `user_birthday`, `user_email`, `created_at`, `updated_at`, `user_role`, `user_active`) VALUES
	(1, 'Nguyễn Xuân Sơn', 'son123', '123', '29-12-1997', 'a', '2024-01-09 23:17:05', NULL, 1, 1),
	(2, 'Nguyễn Văn B', 'son00', '123', '29-12-1997', 'c@gmail.com', '2024-01-09 23:46:54', NULL, 1, 0),
	(3, 'Nguyễn Văn A', 'sonson', '123', '29-12-1997', 'sonson@gmail.com', '2024-01-10 06:26:49', NULL, 1, 1),
	(4, 'Nguyễn Văn C', 'sonson000', '123', '29-12-1997', 'abc@gmail.com', '2024-01-10 07:00:01', NULL, 1, 0),
	(5, 'Nguyễn Văn D', 'sonson197', '123', '11-11-1997', 'a@gmail.com', '2024-01-12 13:33:11', NULL, 1, 0),
	(6, 'admin', 'admin', '1', '01-01-1997', 'admin@gmail.com', NULL, NULL, 0, 1);

-- Dumping structure for table test_level_2.user_courses
CREATE TABLE IF NOT EXISTS `user_courses` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `course_subject` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `course_class` int NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test_level_2.user_courses: ~4 rows (approximately)
INSERT INTO `user_courses` (`ID`, `user_name`, `course_subject`, `course_class`, `course_name`, `user_id`, `course_id`) VALUES
	(2, 'Nguyễn Văn A', 'Địa Lý', 11, 'Khóa học Online', 3, 3),
	(9, 'Nguyễn Xuân Sơn', 'Sinh Học', 10, 'Khóa học Trực tiếp', 1, 2),
	(10, 'Nguyễn Xuân Sơn', 'Địa Lý', 11, 'Khóa học Online', 1, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
