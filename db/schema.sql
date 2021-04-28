-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               8.0.23 - MySQL Community Server - GPL
-- Операционная система:         Linux
-- HeidiSQL Версия:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица school_register.classrooms
CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `begin_year` date NOT NULL,
  `letter` char(1) NOT NULL DEFAULT '',
  `is_graduated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.classrooms: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;
INSERT INTO `classrooms` (`id`, `begin_year`, `letter`, `is_graduated`) VALUES
	(1, '2020-09-01', 'А', 0);
/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.homeworks
CREATE TABLE IF NOT EXISTS `homeworks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `classroom_id` int NOT NULL DEFAULT '0',
  `subject_id` int NOT NULL DEFAULT '0',
  `text` text,
  `until_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classroom_id` (`classroom_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `FK__classrooms` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_homeworks_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.homeworks: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `homeworks` DISABLE KEYS */;
INSERT INTO `homeworks` (`id`, `classroom_id`, `subject_id`, `text`, `until_date`) VALUES
	(1, 1, 1, 'Сделать задание 1.1', '2021-03-25 23:12:14'),
	(2, 1, 3, 'Сделать задание 2.1', '2021-05-15 23:38:19'),
	(3, 1, 2, 'Сделать задание 3.1', '2021-05-15 23:38:19');
/*!40000 ALTER TABLE `homeworks` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.marks
CREATE TABLE IF NOT EXISTS `marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `mark` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `FK__subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__users_student` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__users_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.marks: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` (`id`, `student_id`, `teacher_id`, `subject_id`, `mark`) VALUES
	(1, 1, 2, 2, 5),
	(2, 1, 2, 1, 5),
	(3, 1, 2, 3, 4);
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.students
CREATE TABLE IF NOT EXISTS `students` (
  `user_id` int NOT NULL,
  `classroom_id` int NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `classroom_id` (`classroom_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_students_classrooms` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.students: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` (`user_id`, `classroom_id`) VALUES
	(1, 1);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.subjects
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.subjects: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `name`) VALUES
	(1, 'Физика'),
	(2, 'Математика'),
	(3, 'Русский язык');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id` int NOT NULL,
  PRIMARY KEY (`teacher_id`),
  CONSTRAINT `FK__users_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.teachers: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

-- Дамп структуры для таблица school_register.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы school_register.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password_hash`, `first_name`, `last_name`, `status`) VALUES
	(1, 'student', '$2y$10$CwBfIq4HtS7DB/hH2/A0E.j7y2IjnEDSRvGW3N5EYWiY9rcX90aUO', 'Super', 'Student', 1),
	(2, 'teacher', '$2y$10$CwBfIq4HtS7DB/hH2/A0E.j7y2IjnEDSRvGW3N5EYWiY9rcX90aUO', 'Super', 'Teacher', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
