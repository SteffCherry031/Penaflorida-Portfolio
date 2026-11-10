-- database.sql
CREATE DATABASE IF NOT EXISTS `penaflorida_portfolio`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `penaflorida_portfolio`;

CREATE TABLE IF NOT EXISTS `messages` (
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(100)  NOT NULL,
  `phone`      VARCHAR(30)   DEFAULT NULL,
  `email`      VARCHAR(150)  NOT NULL,
  `subject`    VARCHAR(200)  NOT NULL,
  `message`    TEXT          NOT NULL,
  `created_at` TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `name`          VARCHAR(100) NOT NULL,
  `email`         VARCHAR(150) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;