-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.25 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных library
CREATE DATABASE IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `library`;


-- Дамп структуры для таблица library.authors
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.authors: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` (`id`, `name`, `update_time`, `create_time`) VALUES
	(1, ' М. Лассила', '2014-08-06 20:15:09', '2014-08-05 23:20:12'),
	(2, 'А. Пушкин', '2014-08-06 20:15:17', '2014-08-06 09:19:55'),
	(3, 'Дмитрий Котеров', '2014-08-06 20:15:24', '2014-08-06 09:20:02'),
	(4, 'А.С.Макаров', '2014-08-06 20:15:31', '0000-00-00 00:00:00'),
	(5, 'Лермантов', '2014-08-06 20:15:36', '2014-08-06 14:14:51'),
	(6, 'Краснов', '2014-08-06 20:15:44', '2014-08-06 14:16:03'),
	(7, 'Тургенев', '2014-08-06 20:15:48', '2014-08-06 14:16:18'),
	(8, 'Толстой', '2014-08-06 20:15:55', '2014-08-06 15:10:51');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Дамп структуры для таблица library.books
CREATE TABLE IF NOT EXISTS `books` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.books: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` (`id`, `name`, `update_time`, `create_time`) VALUES
	(1, 'За колючками', '2014-08-06 20:16:37', '2014-08-05 23:14:43'),
	(2, 'Рецепты', '2014-08-06 21:07:57', '2014-08-06 09:56:53'),
	(3, 'Книга 2', '2014-08-06 21:08:02', '2014-08-06 09:58:08'),
	(4, 'PHP 5', '2014-08-06 14:16:28', '2014-08-06 14:16:28'),
	(5, 'Yii. Сборник рецептов', '2014-08-06 20:16:28', '2014-08-06 15:10:55'),
	(6, 'Война и мир', '2014-08-06 21:06:21', '2014-08-06 18:11:51');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;


-- Дамп структуры для таблица library.book_author
CREATE TABLE IF NOT EXISTS `book_author` (
  `book_id` int(10) NOT NULL,
  `author_id` int(10) NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `FK_book_author_authors` (`author_id`),
  CONSTRAINT `FK_book_author_authors` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `FK_book_author_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.book_author: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `book_author` DISABLE KEYS */;
INSERT INTO `book_author` (`book_id`, `author_id`) VALUES
	(1, 1),
	(3, 1),
	(3, 2),
	(3, 3),
	(5, 4),
	(2, 5),
	(4, 6),
	(6, 7),
	(4, 8),
	(5, 8),
	(6, 8);
/*!40000 ALTER TABLE `book_author` ENABLE KEYS */;


-- Дамп структуры для таблица library.book_reader
CREATE TABLE IF NOT EXISTS `book_reader` (
  `book_id` int(10) NOT NULL,
  `reader_id` int(10) NOT NULL,
  PRIMARY KEY (`book_id`,`reader_id`),
  KEY `FK_book_reader_readers` (`reader_id`),
  CONSTRAINT `FK_book_reader_books` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `FK_book_reader_readers` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.book_reader: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `book_reader` DISABLE KEYS */;
INSERT INTO `book_reader` (`book_id`, `reader_id`) VALUES
	(1, 2),
	(3, 2),
	(4, 2),
	(2, 3),
	(3, 3),
	(4, 3),
	(1, 5),
	(4, 5),
	(4, 6);
/*!40000 ALTER TABLE `book_reader` ENABLE KEYS */;


-- Дамп структуры для таблица library.readers
CREATE TABLE IF NOT EXISTS `readers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы library.readers: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `readers` DISABLE KEYS */;
INSERT INTO `readers` (`id`, `name`, `update_time`, `create_time`) VALUES
	(1, 'Иванов', '2014-08-06 20:16:48', '2014-08-06 11:00:11'),
	(2, 'Сидоров', '2014-08-06 20:16:53', '2014-08-06 11:00:19'),
	(3, 'Петров', '2014-08-06 20:16:57', '2014-08-06 11:00:29'),
	(4, 'Козлов', '2014-08-06 20:17:03', '2014-08-06 11:00:46'),
	(5, 'Ушаков', '2014-08-06 20:17:12', '2014-08-06 11:00:52'),
	(6, 'Калашников', '2014-08-06 20:17:26', '2014-08-06 14:14:03');
/*!40000 ALTER TABLE `readers` ENABLE KEYS */;


-- Дамп структуры для таблица library.search_author
CREATE TABLE IF NOT EXISTS `search_author` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Таблица-«зеркала» author в MyISAM';

-- Дамп данных таблицы library.search_author: 8 rows
/*!40000 ALTER TABLE `search_author` DISABLE KEYS */;
INSERT INTO `search_author` (`id`, `name`) VALUES
	(2, 'А. Пушкин'),
	(3, 'Дмитрий Котеров'),
	(6, 'Краснов'),
	(1, ' М. Лассила'),
	(7, 'Тургенев'),
	(4, 'А.С.Макаров'),
	(5, 'Лермантов'),
	(8, 'Толстой');
/*!40000 ALTER TABLE `search_author` ENABLE KEYS */;


-- Дамп структуры для таблица library.search_books
CREATE TABLE IF NOT EXISTS `search_books` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Таблица-«зеркала»  books в MyISAM';

-- Дамп данных таблицы library.search_books: 6 rows
/*!40000 ALTER TABLE `search_books` DISABLE KEYS */;
INSERT INTO `search_books` (`id`, `name`) VALUES
	(1, 'За колючками'),
	(4, 'PHP 5'),
	(6, 'Война и мир'),
	(2, 'Рецепты'),
	(3, 'Книга 2'),
	(5, 'Yii. Сборник рецептов');
/*!40000 ALTER TABLE `search_books` ENABLE KEYS */;


-- Дамп структуры для триггер library.search_author_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_author_delete` AFTER DELETE ON `authors` FOR EACH ROW BEGIN
DELETE FROM search_author WHERE `id`= OLD.`id`;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер library.search_author_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_author_insert` AFTER INSERT ON `authors` FOR EACH ROW BEGIN
INSERT INTO search_author (`id`,`name`) VALUES(
NEW.`id`, 
NEW.`name` 
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер library.search_author_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_author_update` AFTER UPDATE ON `authors` FOR EACH ROW BEGIN
DELETE FROM search_author WHERE `id`= NEW.`id`;
INSERT INTO search_author (`id`,`name`) VALUES(
NEW.`id`,
NEW.`name`
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер library.search_books_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_books_delete` AFTER DELETE ON `books` FOR EACH ROW BEGIN
DELETE FROM search_books WHERE `id`= OLD.`id`;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер library.search_books_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_books_insert` AFTER INSERT ON `books` FOR EACH ROW BEGIN
INSERT INTO search_books (`id`,`name`) VALUES(
NEW.`id`, 
NEW.`name` 
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер library.search_books_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `search_books_update` AFTER UPDATE ON `books` FOR EACH ROW BEGIN
DELETE FROM search_books WHERE `id`= NEW.`id`;
INSERT INTO search_books (`id`,`name`) VALUES(
NEW.`id`,
NEW.`name`
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
