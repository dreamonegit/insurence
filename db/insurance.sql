-- Adminer 4.7.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `health_insurance`;
CREATE TABLE `health_insurance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `insurance_type_id` int NOT NULL,
  `insurance_type` tinyint NOT NULL,
  `previous_year` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `status` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `insurance_type`;
CREATE TABLE `insurance_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `insurance_type` tinyint NOT NULL,
  `customer_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `motor_insurance`;
CREATE TABLE `motor_insurance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `insurance_type_id` int NOT NULL,
  `insurance_type` tinyint NOT NULL,
  `vehicle_type` tinyint NOT NULL,
  `previous_year` varchar(200) NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2022-04-27 08:04:12
