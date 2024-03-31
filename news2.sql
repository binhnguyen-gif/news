-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for database
DROP DATABASE IF EXISTS `database`;
CREATE DATABASE IF NOT EXISTS `database` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `database`;

-- Dumping structure for table database.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table database.categories: ~0 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
	(1, 'CELEB PETS', NULL);

-- Dumping structure for table database.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_general_ci,
  `category_id` int DEFAULT NULL,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `view` int DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table database.posts: ~8 rows (approximately)
DELETE FROM `posts`;
INSERT INTO `posts` (`id`, `title`, `description`, `author`, `date`, `details`, `category_id`, `image_url`, `view`, `slug`) VALUES
	(1, 'Jon Stewart Announces Death of Family Dog on ‘The Daily Show’', 'All-around funny man Jon Stewart broke character on the Feb. 26 episode of “The', 'JENNA WADSWORTH ', '2024-03-19', NULL, 1, 'GettyImages-912145654-e168705067.png', 1, 'jon-stewart-announces-death-of-family-dog-on-the-daily-show-'),
	(2, '14 Arrests Made This Week Associated With Dog Fighting Event', 'All-around funny man Jon Stewart broke character on the Feb. 26 episode of “The', 'JENNA WADSWORTH ', '2024-03-19', NULL, 1, 'GettyImages-1342172928-e17104920.png', 2, '14-arrests-made-this-week-associated-with-dog-fighting-event'),
	(3, 'Jon Stewart Announces Death of Family Dog on ‘The Daily Show’', 'All-around funny man Jon Stewart broke character on the Feb. 26 episode of “The', 'JENNA WADSWORTH ', '2024-03-19', NULL, 1, 'GettyImages-1323553634-e16898152.png', 3, 'jon-stewart-announces-death-of-family-dog-on-the-daily-show-'),
	(4, '14 Arrests Made This Week Associated With Dog Fighting Event', 'All-around funny man Jon Stewart broke character on the Feb. 26 episode of “The', 'JENNA WADSWORTH ', '2024-03-19', NULL, 1, 'dog-fighting-event.png', 4, '14-arrests-made-this-week-associated-with-dog-fighting-event'),
	(5, 'Jon Stewart Announces Death of Family Dog on ‘The Daily Show’', 'All-around funny man Jon Stewart broke character on the Feb. 26 episode of “The', 'JENNA WADSWORTH ', '2024-03-19', NULL, 1, 'GettyImages-1263320809-e17098988.png', 1, 'jon-stewart-announces-death-of-family-dog-on-the-daily-show-'),
	(6, 'UFC’s Mark Coleman Risked Life Trying To Save Dog From Fire', 'In the aftermath of the devastating blaze that destroyed his home, UFC legend Mark Coleman’s courageous deeds are being revealed. Sadly, the fire resulted in severe injuries to Coleman, and claimed the life of his beloved family dog, Hammer. ', 'SAKCHAM TIWARI', '2024-03-20', NULL, 1, 'GettyImages-1342172928-e17104920.png', 0, 'ufc-s-mark-coleman-risked-life-trying-to-save-dog-from-fire'),
	(7, 'World’s Cutest Rescue Dog Contest Now Accepting Submissions', 'Your rescue dog is the cutest pup in the whole world, we know. But every pet parent thinks the same thing about their canine companion. ', 'ERICA RIVERA', '2024-03-20', NULL, 1, 'GettyImages-912145654-e168705067.png', 0, 'world-s-cutest-rescue-dog-contest-now-accepting-submissions'),
	(8, 'World’s Cutest Rescue Dog Contest Now Accepting Submissions', 'Your rescue dog is the cutest pup in the whole world, we know. But every pet parent thinks the same thing about their canine companion.', 'ERICA RIVERA', '2024-03-20', NULL, 1, 'GettyImages-1319962847-e16919834.png', 0, 'world-s-cutest-rescue-dog-contest-now-accepting-submissions');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
