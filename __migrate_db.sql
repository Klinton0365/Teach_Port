-- Adminer 4.8.1 MySQL 8.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `Klinton_03_teach_port` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `Klinton_03_teach_port`;

CREATE TABLE `login_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `token` varchar(32) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `fingerprint` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `login_history` (`id`, `uid`, `user_email`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`) VALUES
(6,	9,	'klinton.developer365@gmail.com',	'7782649cee462070944347079188fcf1',	'2024-07-06 00:14:01',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(7,	9,	'klinton.developer365@gmail.com',	'5f9e2539b38f7fa0b4bb3d6532974729',	'2024-07-06 00:24:45',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(8,	9,	'klinton.developer365@gmail.com',	'171f0ee0b3cc73e704bb461c9777cebd',	'2024-07-06 01:18:49',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(9,	9,	'klinton.developer365@gmail.com',	'2a60750eb4db0a8410766928cdb13f5e',	'2024-07-06 01:24:53',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(10,	9,	'klinton.developer365@gmail.com',	'cdce03f542ddeaf24616858ebcd7a108',	'2024-07-06 01:27:02',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(11,	9,	'klinton.developer365@gmail.com',	'1d7c66d8779a64144268f6360d829612',	'2024-07-06 01:37:26',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(12,	9,	'klinton.developer365@gmail.com',	'a7d6eb15a462a43460f7798cc5e586df',	'2024-07-06 01:38:40',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(13,	9,	'klinton.developer365@gmail.com',	'be203d441f5046288a2330ed761f4d4c',	'2024-07-06 01:39:41',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(14,	9,	'klinton.developer365@gmail.com',	'3446a4c81899e414c656cc089f5e514b',	'2024-07-06 01:48:27',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(15,	9,	'klinton.developer365@gmail.com',	'005cfcd3e560c03d93f99aae2b6b5170',	'2024-07-06 01:49:07',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(16,	9,	'klinton.developer365@gmail.com',	'17e23c5041361fc0c0c6d67b36e72257',	'2024-07-06 01:50:23',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(17,	9,	'klinton.developer365@gmail.com',	'ca0a0945bd6baded0f5b4679c41a53b9',	'2024-07-06 02:10:05',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(18,	9,	'klinton.developer365@gmail.com',	'2da4c721fa5993764eb0ce0b661de889',	'2024-07-06 02:11:17',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(19,	9,	'klinton.developer365@gmail.com',	'25d5862163e6cf5011c7272ece184ce1',	'2024-07-06 02:14:08',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(20,	9,	'klinton.developer365@gmail.com',	'43d997ca30524ab5392a624215d28c78',	'2024-07-06 09:31:51',	'10.11.2.231',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'cf7cf133aa0a4301ee28c560ccad703f'),
(21,	9,	'klinton.developer365@gmail.com',	'8594ee74314282c04b8a237c45b5413c',	'2024-07-06 09:45:27',	'10.11.2.231',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'cf7cf133aa0a4301ee28c560ccad703f'),
(22,	9,	'klinton.developer365@gmail.com',	'824c2731d8dc661b63e3ca2d1147e002',	'2024-07-06 12:17:41',	'10.11.2.231',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'cf7cf133aa0a4301ee28c560ccad703f');

CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `active` int NOT NULL,
  `fingerprint` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `session` (`id`, `uid`, `user_email`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`) VALUES
(5,	9,	'klinton.developer365@gmail.com',	'171f0ee0b3cc73e704bb461c9777cebd',	'2024-07-06 01:18:49',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(6,	9,	'klinton.developer365@gmail.com',	'2a60750eb4db0a8410766928cdb13f5e',	'2024-07-06 01:24:53',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(7,	9,	'klinton.developer365@gmail.com',	'cdce03f542ddeaf24616858ebcd7a108',	'2024-07-06 01:27:02',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(8,	9,	'klinton.developer365@gmail.com',	'1d7c66d8779a64144268f6360d829612',	'2024-07-06 01:37:26',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(9,	9,	'klinton.developer365@gmail.com',	'a7d6eb15a462a43460f7798cc5e586df',	'2024-07-06 01:38:40',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(10,	9,	'klinton.developer365@gmail.com',	'be203d441f5046288a2330ed761f4d4c',	'2024-07-06 01:39:41',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(11,	9,	'klinton.developer365@gmail.com',	'3446a4c81899e414c656cc089f5e514b',	'2024-07-06 01:48:27',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(12,	9,	'klinton.developer365@gmail.com',	'005cfcd3e560c03d93f99aae2b6b5170',	'2024-07-06 01:49:07',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(13,	9,	'klinton.developer365@gmail.com',	'17e23c5041361fc0c0c6d67b36e72257',	'2024-07-06 01:50:23',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(14,	9,	'klinton.developer365@gmail.com',	'ca0a0945bd6baded0f5b4679c41a53b9',	'2024-07-06 02:10:05',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(15,	9,	'klinton.developer365@gmail.com',	'2da4c721fa5993764eb0ce0b661de889',	'2024-07-06 02:11:17',	'10.11.2.223',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'277008e34449b665a0754898df0f9696'),
(17,	9,	'klinton.developer365@gmail.com',	'43d997ca30524ab5392a624215d28c78',	'2024-07-06 09:31:51',	'10.11.2.231',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'cf7cf133aa0a4301ee28c560ccad703f'),
(19,	9,	'klinton.developer365@gmail.com',	'824c2731d8dc661b63e3ca2d1147e002',	'2024-07-06 12:17:41',	'10.11.2.231',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',	1,	'cf7cf133aa0a4301ee28c560ccad703f');

CREATE TABLE `student` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `marks` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `student` (`id`, `name`, `subject`, `marks`) VALUES
(1,	'JohnDev',	'CS',	155),
(2,	'Wick',	'MEch',	97),
(4,	'Vishnu',	'M Tech',	99),
(5,	'JohnDev',	'Mechatronics',	90),
(7,	'Rebecca',	'M Tech',	95),
(8,	'Jeeva',	'BCA',	96);

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(9,	'Klinton',	'klinton.developer365@gmail.com',	'$2y$08$NteQivLHO/.qoE6JCAvqJ..QWakIBMIbCM.Hbj11iK1VIFmRYrlRy'),
(10,	'Vishnu',	'vishnucool20001@gmail.com',	'$2y$08$.Cm5EP4mbFSLAUer2.y9Xe87n8ZSVytwZslsJROyguFMglKeYvKeW');

-- 2024-07-06 07:10:49