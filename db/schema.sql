# ************************************************************
# Sequel Ace SQL dump
# Version 3028
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.23)
# Database: school-register
# Generation Time: 2021-05-07 15:40:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attendance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `visit` int DEFAULT '0',
  `lateness` int DEFAULT '0',
  `truancy` int DEFAULT '0',
  `disease` int DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;

INSERT INTO `attendance` (`id`, `student_id`, `subject_id`, `visit`, `lateness`, `truancy`, `disease`, `date`)
VALUES
	(1,1,1,1,0,0,0,'2021-04-29');

/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table classrooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `classrooms`;

CREATE TABLE `classrooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `begin_year` date NOT NULL,
  `letter` char(1) NOT NULL DEFAULT '',
  `is_graduated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `classrooms` WRITE;
/*!40000 ALTER TABLE `classrooms` DISABLE KEYS */;

INSERT INTO `classrooms` (`id`, `begin_year`, `letter`, `is_graduated`)
VALUES
	(1,'2020-09-01','А',0);

/*!40000 ALTER TABLE `classrooms` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table homeworks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `homeworks`;

CREATE TABLE `homeworks` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `homeworks` WRITE;
/*!40000 ALTER TABLE `homeworks` DISABLE KEYS */;

INSERT INTO `homeworks` (`id`, `classroom_id`, `subject_id`, `text`, `until_date`)
VALUES
	(1,1,1,'Сделать задание 1.1','2021-03-25 23:12:14'),
	(2,1,3,'Сделать задание 2.1','2021-05-15 23:38:19'),
	(3,1,2,'Сделать задание 3.1','2021-05-15 23:38:19');

/*!40000 ALTER TABLE `homeworks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table marks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `marks`;

CREATE TABLE `marks` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;

INSERT INTO `marks` (`id`, `student_id`, `teacher_id`, `subject_id`, `mark`)
VALUES
	(1,1,2,2,5),
	(2,1,2,1,5),
	(3,1,2,3,4);

/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table students
# ------------------------------------------------------------

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `user_id` int NOT NULL,
  `classroom_id` int NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `classroom_id` (`classroom_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_students_classrooms` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;

INSERT INTO `students` (`user_id`, `classroom_id`)
VALUES
	(1,1);

/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subjects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;

INSERT INTO `subjects` (`id`, `name`)
VALUES
	(1,'Физика'),
	(2,'Математика'),
	(3,'Русский язык');

/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table teachers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `teachers`;

CREATE TABLE `teachers` (
  `teacher_id` int NOT NULL,
  PRIMARY KEY (`teacher_id`),
  CONSTRAINT `FK__users_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(64) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password_hash`, `first_name`, `last_name`, `status`)
VALUES
	(1,'student','$2y$10$CwBfIq4HtS7DB/hH2/A0E.j7y2IjnEDSRvGW3N5EYWiY9rcX90aUO','Super','Student',1),
	(2,'teacher','$2y$10$CwBfIq4HtS7DB/hH2/A0E.j7y2IjnEDSRvGW3N5EYWiY9rcX90aUO','Super','Teacher',1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
