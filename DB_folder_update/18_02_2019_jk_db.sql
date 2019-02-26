-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.35-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for shocconew
DROP DATABASE IF EXISTS `shocconew`;
CREATE DATABASE IF NOT EXISTS `shocconew` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `shocconew`;

-- Dumping structure for table shocconew.sh_albums
DROP TABLE IF EXISTS `sh_albums`;
CREATE TABLE IF NOT EXISTS `sh_albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_albums: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_albums` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_albums` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_book
DROP TABLE IF EXISTS `sh_book`;
CREATE TABLE IF NOT EXISTS `sh_book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `book_date` date NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_book: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_book` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_breeds
DROP TABLE IF EXISTS `sh_breeds`;
CREATE TABLE IF NOT EXISTS `sh_breeds` (
  `breed_id` int(11) NOT NULL AUTO_INCREMENT,
  `breed_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`breed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_breeds: ~4 rows (approximately)
/*!40000 ALTER TABLE `sh_breeds` DISABLE KEYS */;
REPLACE INTO `sh_breeds` (`breed_id`, `breed_name`) VALUES
	(1, 'Abyssinian'),
	(2, 'Aegean'),
	(3, 'American Curl'),
	(4, 'Oscar');
/*!40000 ALTER TABLE `sh_breeds` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_category
DROP TABLE IF EXISTS `sh_category`;
CREATE TABLE IF NOT EXISTS `sh_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_category: ~5 rows (approximately)
/*!40000 ALTER TABLE `sh_category` DISABLE KEYS */;
REPLACE INTO `sh_category` (`cat_id`, `cat_name`) VALUES
	(1, 'Bird'),
	(2, 'Cat'),
	(3, 'Dog'),
	(4, 'Fish'),
	(5, 'Horse');
/*!40000 ALTER TABLE `sh_category` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_color
DROP TABLE IF EXISTS `sh_color`;
CREATE TABLE IF NOT EXISTS `sh_color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_color: ~5 rows (approximately)
/*!40000 ALTER TABLE `sh_color` DISABLE KEYS */;
REPLACE INTO `sh_color` (`color_id`, `color_name`) VALUES
	(1, 'Black'),
	(2, 'Blue'),
	(3, 'Brown'),
	(4, 'Gray'),
	(5, 'Green');
/*!40000 ALTER TABLE `sh_color` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_friends
DROP TABLE IF EXISTS `sh_friends`;
CREATE TABLE IF NOT EXISTS `sh_friends` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `friend_id` int(255) NOT NULL,
  `friend_since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_friends: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_friends` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_friend_request
DROP TABLE IF EXISTS `sh_friend_request`;
CREATE TABLE IF NOT EXISTS `sh_friend_request` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `user_req_to` int(255) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table shocconew.sh_friend_request: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_friend_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_friend_request` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_mail
DROP TABLE IF EXISTS `sh_mail`;
CREATE TABLE IF NOT EXISTS `sh_mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `mail_to` int(255) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date_send` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_mail: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_mail` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_pets
DROP TABLE IF EXISTS `sh_pets`;
CREATE TABLE IF NOT EXISTS `sh_pets` (
  `pet_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `pet_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pet_images` text COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(255) NOT NULL,
  `breed_id` int(255) NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color_id` int(255) NOT NULL,
  `height` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `fav_food` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skills` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vet_clinic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `located` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adoptable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` int(255) NOT NULL,
  `activate_notice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notice_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chip_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `collar_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reward` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lost_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lost_date` date NOT NULL,
  `other_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_contact_info` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_pets: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_pets` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_pets` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_pet_images
DROP TABLE IF EXISTS `sh_pet_images`;
CREATE TABLE IF NOT EXISTS `sh_pet_images` (
  `img_id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_id` int(255) NOT NULL,
  `img_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `album_id` int(255) NOT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_pet_images: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_pet_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_pet_images` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_pet_list
DROP TABLE IF EXISTS `sh_pet_list`;
CREATE TABLE IF NOT EXISTS `sh_pet_list` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `book_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_pet_list: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_pet_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_pet_list` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_posts
DROP TABLE IF EXISTS `sh_posts`;
CREATE TABLE IF NOT EXISTS `sh_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `pl_id` int(255) NOT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table shocconew.sh_posts: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_posts` ENABLE KEYS */;

-- Dumping structure for table shocconew.sh_users
DROP TABLE IF EXISTS `sh_users`;
CREATE TABLE IF NOT EXISTS `sh_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `bio` text NOT NULL,
  `user_img` varchar(255) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table shocconew.sh_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `sh_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `sh_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
