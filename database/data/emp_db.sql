/*
 Navicat Premium Data Transfer

 Source Server         : docker_localhost
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : emp_db

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 14/11/2022 19:02:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for announcements
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `added_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_company_id_foreign` (`company_id`),
  KEY `announcements_department_id_foreign` (`department_id`),
  KEY `announcements_added_by_foreign` (`added_by`),
  CONSTRAINT `announcements_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `announcements_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of announcements
-- ----------------------------
BEGIN;
INSERT INTO `announcements` VALUES (2, 'New Announcement', '2021-03-30', '2021-04-01', 'New announcement of happiness', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 1, NULL, 'ash', 1, '2021-03-30 05:00:13', '2021-03-30 05:00:13');
INSERT INTO `announcements` VALUES (5, 'Hello', '2020-10-13', '2021-03-30', '2021-03-30', 'dasda', 1, 1, 'ash', 1, '2021-03-30 05:00:13', '2021-03-30 05:00:13');
COMMIT;

-- ----------------------------
-- Table structure for appraisals
-- ----------------------------
DROP TABLE IF EXISTS `appraisals`;
CREATE TABLE `appraisals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `designation_id` bigint(20) unsigned NOT NULL,
  `customer_experience` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `administration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professionalism` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `integrity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of appraisals
-- ----------------------------
BEGIN;
INSERT INTO `appraisals` VALUES (1, 1, 9, 1, 2, 'Beginner', 'Beginner', 'Intermidiate', 'Advanced', 'None', 'None', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', '01/17/2021', '2021-01-17 06:36:09', '2021-01-17 06:43:12');
INSERT INTO `appraisals` VALUES (2, 1, 10, 2, 3, 'Advanced', 'Beginner', 'Advanced', 'Intermidiate', 'Expert/Leader', 'Beginner', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', '01/18/2021', '2021-01-17 06:36:58', '2021-01-17 06:42:56');
INSERT INTO `appraisals` VALUES (4, 1, 12, 3, 5, 'Beginner', 'None', 'None', 'Intermidiate', 'None', 'None', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', '01/19/2021', '2021-01-17 06:37:53', '2021-01-17 06:37:53');
INSERT INTO `appraisals` VALUES (5, 2, 14, 4, 6, 'Intermidiate', 'None', 'None', 'Intermidiate', 'None', 'None', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.', '01/20/2021', '2021-01-17 06:38:20', '2021-01-17 06:38:20');
COMMIT;

-- ----------------------------
-- Table structure for asset_categories
-- ----------------------------
DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE `asset_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `category_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_categories_company_id_foreign` (`company_id`),
  CONSTRAINT `asset_categories_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of asset_categories
-- ----------------------------
BEGIN;
INSERT INTO `asset_categories` VALUES (1, NULL, 'laptop', '2020-07-29 06:15:07', '2020-07-29 06:15:07');
COMMIT;

-- ----------------------------
-- Table structure for assets
-- ----------------------------
DROP TABLE IF EXISTS `assets`;
CREATE TABLE `assets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `asset_code` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assets_category_id` bigint(20) unsigned NOT NULL,
  `Asset_note` mediumtext COLLATE utf8mb4_unicode_ci,
  `manufacturer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asset_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `warranty_date` date NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assets_company_id_foreign` (`company_id`),
  KEY `assets_employee_id_foreign` (`employee_id`),
  KEY `assets_assets_category_id_foreign` (`assets_category_id`),
  CONSTRAINT `assets_assets_category_id_foreign` FOREIGN KEY (`assets_category_id`) REFERENCES `asset_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assets_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assets_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of assets
-- ----------------------------
BEGIN;
INSERT INTO `assets` VALUES (1, 'Laptop', 1, 9, 'lap-01', 1, NULL, 'Asus', '637256', 'Inv-090', NULL, '2020-10-25', '2021-05-30', 'yes', '2020-07-29 06:16:05', '2020-07-29 06:16:05');
COMMIT;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `attendance_date` date NOT NULL,
  `clock_in` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_in_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_out` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_out_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clock_in_out` tinyint(4) NOT NULL,
  `time_late` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `early_leaving` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `overtime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `total_work` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `total_rest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00:00',
  `attendance_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'present',
  PRIMARY KEY (`id`),
  KEY `attendances_employee_id_foreign` (`employee_id`),
  CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attendances
-- ----------------------------
BEGIN;
INSERT INTO `attendances` VALUES (3, 9, '2022-06-08', '10:10', '::1', '11:14', '::1', 0, '00:10', '05:46', '00:00', '01:04', '00:00', 'present');
INSERT INTO `attendances` VALUES (5, 10, '2021-03-30', '10:00', '', '14:00', '', 0, '00:00', '00:00', '00:00', '04:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (6, 11, '2021-03-30', '10:05', '', '14:05', '', 0, '00:05', '00:00', '00:05', '04:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (7, 12, '2021-03-30', '10:20', '', '14:50', '', 0, '00:20', '00:00', '00:50', '04:30', '00:00', 'present');
INSERT INTO `attendances` VALUES (9, 9, '2022-06-07', '10:25', '::1', '12:40', '::1', 0, '00:25', '04:20', '00:40', '02:15', '00:11', 'present');
INSERT INTO `attendances` VALUES (10, 9, '2021-03-29', '10:00', '::1', '14:00', '::1', 0, '00:00', '00:00', '00:00', '04:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (11, 9, '2021-03-29', '10:00', '::1', '14:20', '::1', 0, '00:00', '00:00', '00:20', '04:20', '00:00', 'present');
INSERT INTO `attendances` VALUES (12, 9, '2021-03-29', '10:00', '::1', '13:20', '::1', 0, '00:00', '40:00', '00:00', '03:20', '00:00', 'present');
INSERT INTO `attendances` VALUES (15, 12, '2021-03-29', '12:00', '', '17:00', '', 0, '00:00', '00:00', '00:00', '05:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (16, 11, '2021-03-29', '10:00', '', '17:00', '', 0, '00:00', '00:00', '03:00', '08:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (17, 11, '2021-03-29', '09:00', '', '15:00', '', 0, '00:00', '00:00', '00:00', '06:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (18, 9, '2021-03-29', '11:24', '127.0.0.1', '11:29', '127.0.0.1', 0, '01:24', '05:30', '00:00', '00:05', '00:00', 'present');
INSERT INTO `attendances` VALUES (19, 9, '2021-03-29', '10:00', '127.0.0.1', '00:28', '127.0.0.1', 0, '00:00', '16:31', '00:00', '09:31', '00:00', 'present');
INSERT INTO `attendances` VALUES (23, 38, '2021-03-29', '19:00', '', '15:00', '', 0, '09:00', '02:00', '00:00', '04:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (25, 11, '2021-06-30', '10:00', '', '17:00', '', 0, '00:00', '00:00', '00:00', '08:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (26, 11, '2021-07-01', '22:00', '', '17:00', '', 0, '12:00', '00:00', '03:00', '05:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (27, 9, '2021-07-04', '20:32', '::1', '20:32', '::1', 0, '00:00', '00:00', '00:00', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (29, 9, '2021-09-12', '09:56', '::1', '10:07', '::1', 0, '00:01', '00:00', '00:07', '00:11', '00:00', 'present');
INSERT INTO `attendances` VALUES (36, 9, '2021-11-13', '13:31', '127.0.0.1', '13:40', '127.0.0.1', 0, '04:31', '03:20', '00:00', '00:09', '00:00', 'present');
INSERT INTO `attendances` VALUES (37, 9, '2021-11-15', '09:00', '127.0.0.1', '07:55', '127.0.0.1', 0, '00:00', '09:05', '00:00', '01:04', '00:00', 'present');
INSERT INTO `attendances` VALUES (38, 9, '2021-11-14', '09:40', '154.136.171.168', '19:03', '154.136.171.168', 0, '00:40', '00:00', '02:03', '09:23', '00:00', 'present');
INSERT INTO `attendances` VALUES (39, 9, '2021-11-14', '19:03', '154.136.171.168', '19:03', '154.136.171.168', 0, '00:00', '00:00', '02:03', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (40, 9, '2021-11-14', '19:03', '154.136.171.168', '19:03', '154.136.171.168', 0, '00:00', '00:00', '02:03', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (41, 9, '2021-11-14', '19:03', '154.136.171.168', '19:03', '154.136.171.168', 0, '00:00', '00:00', '02:03', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (42, 9, '2021-11-14', '19:03', '154.136.171.168', '19:04', '154.136.171.168', 0, '00:00', '00:00', '02:04', '00:01', '00:00', 'present');
INSERT INTO `attendances` VALUES (46, 12, '2021-11-15', '14:17', '127.0.0.1', '14:23', '127.0.0.1', 0, '00:17', '00:17', '00:00', '00:06', '00:00', 'present');
INSERT INTO `attendances` VALUES (47, 12, '2021-11-15', '14:24', '127.0.0.1', '14:27', '127.0.0.1', 0, '00:00', '00:13', '00:00', '00:03', '00:01', 'present');
INSERT INTO `attendances` VALUES (48, 12, '2021-11-15', '14:32', '127.0.0.1', '14:34', '127.0.0.1', 0, '00:00', '00:06', '00:00', '00:02', '00:05', 'present');
INSERT INTO `attendances` VALUES (49, 12, '2021-11-15', '14:36', '127.0.0.1', '14:43', '127.0.0.1', 0, '00:00', '00:00', '00:03', '00:07', '00:02', 'present');
INSERT INTO `attendances` VALUES (50, 12, '2021-11-15', '14:46', '127.0.0.1', '15:27', '127.0.0.1', 0, '00:00', '00:00', '00:41', '00:41', '00:03', 'present');
INSERT INTO `attendances` VALUES (60, 9, '2022-08-21', '08:59', '::1', '17:11', '::1', 0, '00:00', '00:00', '00:00', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (63, 9, '2022-09-17', '18:21', '::1', '18:46', '::1', 0, '00:00', '00:00', '00:00', '00:00', '01:10', 'present');
INSERT INTO `attendances` VALUES (64, 9, '2022-09-17', '19:47', '::1', '20:48', '::1', 0, '00:00', '00:00', '01:38', '09:38', '01:01', 'present');
INSERT INTO `attendances` VALUES (69, 9, '2022-10-02', '09:16', '', '13:00', '', 0, '00:16', '04:00', '00:00', '00:00', '00:00', 'present');
INSERT INTO `attendances` VALUES (70, 9, '2022-10-02', '13:30', '', '18:00', '', 0, '00:00', '00:00', '00:14', '08:14', '00:30', 'present');
COMMIT;

-- ----------------------------
-- Table structure for award_types
-- ----------------------------
DROP TABLE IF EXISTS `award_types`;
CREATE TABLE `award_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `award_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of award_types
-- ----------------------------
BEGIN;
INSERT INTO `award_types` VALUES (1, 'Performer Of The Year', '2020-07-26 20:19:34', '2020-07-26 20:19:34');
INSERT INTO `award_types` VALUES (2, 'Best Salesman', '2020-07-26 20:19:47', '2020-07-26 20:19:47');
COMMIT;

-- ----------------------------
-- Table structure for awards
-- ----------------------------
DROP TABLE IF EXISTS `awards`;
CREATE TABLE `awards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `award_information` mediumtext COLLATE utf8mb4_unicode_ci,
  `award_date` date NOT NULL,
  `gift` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `award_type_id` bigint(20) unsigned DEFAULT NULL,
  `award_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `awards_company_id_foreign` (`company_id`),
  KEY `awards_department_id_foreign` (`department_id`),
  KEY `awards_employee_id_foreign` (`employee_id`),
  KEY `awards_award_type_id_foreign` (`award_type_id`),
  CONSTRAINT `awards_award_type_id_foreign` FOREIGN KEY (`award_type_id`) REFERENCES `award_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `awards_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `awards_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `awards_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of awards
-- ----------------------------
BEGIN;
INSERT INTO `awards` VALUES (1, '\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system,', '2021-03-25', 'Flower', '500', 1, 2, 10, 2, 'award_1595848708.jpg', '2020-07-27 11:18:28', '2020-07-27 11:19:55');
INSERT INTO `awards` VALUES (2, 'dfsdf', '2021-03-17', 'watch', '100', 1, 1, 9, 1, NULL, '2020-08-18 06:46:49', '2020-08-18 06:46:49');
COMMIT;

-- ----------------------------
-- Table structure for c_m_s
-- ----------------------------
DROP TABLE IF EXISTS `c_m_s`;
CREATE TABLE `c_m_s` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `home` longtext COLLATE utf8mb4_unicode_ci,
  `about` longtext COLLATE utf8mb4_unicode_ci,
  `contact` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of c_m_s
-- ----------------------------
BEGIN;
INSERT INTO `c_m_s` VALUES (1, '&lt;p&gt;Home Page, You can add your page design here&amp;nbsp;&lt;/p&gt;', '&lt;p&gt;About Page, You can add your page design here&lt;/p&gt;', '&lt;p&gt;Hello world&lt;/p&gt;', '2020-07-27 09:19:39', '2021-07-23 23:01:38');
COMMIT;

-- ----------------------------
-- Table structure for calendarables
-- ----------------------------
DROP TABLE IF EXISTS `calendarables`;
CREATE TABLE `calendarables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of calendarables
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for candidate_interview
-- ----------------------------
DROP TABLE IF EXISTS `candidate_interview`;
CREATE TABLE `candidate_interview` (
  `interview_id` bigint(20) unsigned NOT NULL,
  `candidate_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`interview_id`,`candidate_id`),
  KEY `candidate_interview_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `candidate_interview_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `job_candidates` (`id`),
  CONSTRAINT `candidate_interview_interview_id_foreign` FOREIGN KEY (`interview_id`) REFERENCES `job_interviews` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of candidate_interview
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organisatie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` mediumtext COLLATE utf8mb4_unicode_ci,
  `address2` mediumtext COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `clients_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of clients
-- ----------------------------
BEGIN;
INSERT INTO `clients` VALUES (16, 'Shadat', 'Ashraf', 'shahadatashraf101@gmail.com', '67651111', 'client', NULL, 'Pearls', '', 'www.xyz.com', '564,Jamhan street', '', 'Norwich', 'Wales', '6756', 127, 1, '2020-07-28 14:41:31', '2022-10-02 09:19:25');
INSERT INTO `clients` VALUES (39, 'Kaden', 'Porter', 'kaden@mailinator.com', '441234874', 'kaden95', 'kaden95_1623747054.jpg', 'HR2', '', 'https://www.lyraw.mobi', '930 Cowley Court', 'Tempora quia et aut', 'Sed dolorem consecte', 'Quibusdam commodo do', '40065', 127, 1, '2021-03-30 01:42:31', '2021-06-15 05:50:54');
COMMIT;

-- ----------------------------
-- Table structure for companies
-- ----------------------------
DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `organisatie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trading_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_location_id_foreign` (`location_id`),
  CONSTRAINT `companies_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of companies
-- ----------------------------
BEGIN;
INSERT INTO `companies` VALUES (1, 'HR1', 'corporation', 'omega', '5654335', '54324', 'omega@gmail.com', 'hr1.com', '675436', 1, '2019008832_1595789616.png', NULL, '2020-07-26 18:53:37', '2020-07-26 18:53:37');
INSERT INTO `companies` VALUES (2, 'HR2', 'partnership', 'LLC', '764892', '728923', 'llc@hr2.com', 'llc.com', '4677672', 2, NULL, NULL, '2020-07-26 19:15:00', '2020-07-26 19:15:00');
COMMIT;

-- ----------------------------
-- Table structure for complaints
-- ----------------------------
DROP TABLE IF EXISTS `complaints`;
CREATE TABLE `complaints` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `complaint_title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned NOT NULL,
  `complaint_from` bigint(20) unsigned NOT NULL,
  `complaint_against` bigint(20) unsigned NOT NULL,
  `complaint_date` date NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `complaints_company_id_foreign` (`company_id`),
  KEY `complaints_complaint_from_foreign` (`complaint_from`),
  KEY `complaints_complaint_against_foreign` (`complaint_against`),
  CONSTRAINT `complaints_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `complaints_complaint_against_foreign` FOREIGN KEY (`complaint_against`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `complaints_complaint_from_foreign` FOREIGN KEY (`complaint_from`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of complaints
-- ----------------------------
BEGIN;
INSERT INTO `complaints` VALUES (1, 'Irritating', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur', 1, 13, 11, '2021-03-25', 'Yes', '2020-07-27 17:24:57', '2020-07-27 17:24:57');
COMMIT;

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------
BEGIN;
INSERT INTO `countries` VALUES (1, 'US', 'United States');
INSERT INTO `countries` VALUES (2, 'CA', 'Canada');
INSERT INTO `countries` VALUES (3, 'AF', 'Afghanistan');
INSERT INTO `countries` VALUES (4, 'AL', 'Albania');
INSERT INTO `countries` VALUES (5, 'DZ', 'Algeria');
INSERT INTO `countries` VALUES (6, 'DS', 'American Samoa');
INSERT INTO `countries` VALUES (7, 'AD', 'Andorra');
INSERT INTO `countries` VALUES (8, 'AO', 'Angola');
INSERT INTO `countries` VALUES (9, 'AI', 'Anguilla');
INSERT INTO `countries` VALUES (10, 'AQ', 'Antarctica');
INSERT INTO `countries` VALUES (11, 'AG', 'Antigua and/or Barbuda');
INSERT INTO `countries` VALUES (12, 'AR', 'Argentina');
INSERT INTO `countries` VALUES (13, 'AM', 'Armenia');
INSERT INTO `countries` VALUES (14, 'AW', 'Aruba');
INSERT INTO `countries` VALUES (15, 'AU', 'Australia');
INSERT INTO `countries` VALUES (16, 'AT', 'Austria');
INSERT INTO `countries` VALUES (17, 'AZ', 'Azerbaijan');
INSERT INTO `countries` VALUES (18, 'BS', 'Bahamas');
INSERT INTO `countries` VALUES (19, 'BH', 'Bahrain');
INSERT INTO `countries` VALUES (20, 'BD', 'Bangladesh');
INSERT INTO `countries` VALUES (21, 'BB', 'Barbados');
INSERT INTO `countries` VALUES (22, 'BY', 'Belarus');
INSERT INTO `countries` VALUES (23, 'BE', 'Belgium');
INSERT INTO `countries` VALUES (24, 'BZ', 'Belize');
INSERT INTO `countries` VALUES (25, 'BJ', 'Benin');
INSERT INTO `countries` VALUES (26, 'BM', 'Bermuda');
INSERT INTO `countries` VALUES (27, 'BT', 'Bhutan');
INSERT INTO `countries` VALUES (28, 'BO', 'Bolivia');
INSERT INTO `countries` VALUES (29, 'BA', 'Bosnia and Herzegovina');
INSERT INTO `countries` VALUES (30, 'BW', 'Botswana');
INSERT INTO `countries` VALUES (31, 'BV', 'Bouvet Island');
INSERT INTO `countries` VALUES (32, 'BR', 'Brazil');
INSERT INTO `countries` VALUES (33, 'IO', 'British lndian Ocean Territory');
INSERT INTO `countries` VALUES (34, 'BN', 'Brunei Darussalam');
INSERT INTO `countries` VALUES (35, 'BG', 'Bulgaria');
INSERT INTO `countries` VALUES (36, 'BF', 'Burkina Faso');
INSERT INTO `countries` VALUES (37, 'BI', 'Burundi');
INSERT INTO `countries` VALUES (38, 'KH', 'Cambodia');
INSERT INTO `countries` VALUES (39, 'CM', 'Cameroon');
INSERT INTO `countries` VALUES (40, 'CV', 'Cape Verde');
INSERT INTO `countries` VALUES (41, 'KY', 'Cayman Islands');
INSERT INTO `countries` VALUES (42, 'CF', 'Central African Republic');
INSERT INTO `countries` VALUES (43, 'TD', 'Chad');
INSERT INTO `countries` VALUES (44, 'CL', 'Chile');
INSERT INTO `countries` VALUES (45, 'CN', 'China');
INSERT INTO `countries` VALUES (46, 'CX', 'Christmas Island');
INSERT INTO `countries` VALUES (47, 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `countries` VALUES (48, 'CO', 'Colombia');
INSERT INTO `countries` VALUES (49, 'KM', 'Comoros');
INSERT INTO `countries` VALUES (50, 'CG', 'Congo');
INSERT INTO `countries` VALUES (51, 'CK', 'Cook Islands');
INSERT INTO `countries` VALUES (52, 'CR', 'Costa Rica');
INSERT INTO `countries` VALUES (53, 'HR', 'Croatia (Hrvatska)');
INSERT INTO `countries` VALUES (54, 'CU', 'Cuba');
INSERT INTO `countries` VALUES (55, 'CY', 'Cyprus');
INSERT INTO `countries` VALUES (56, 'CZ', 'Czech Republic');
INSERT INTO `countries` VALUES (57, 'DK', 'Denmark');
INSERT INTO `countries` VALUES (58, 'DJ', 'Djibouti');
INSERT INTO `countries` VALUES (59, 'DM', 'Dominica');
INSERT INTO `countries` VALUES (60, 'DO', 'Dominican Republic');
INSERT INTO `countries` VALUES (61, 'TP', 'East Timor');
INSERT INTO `countries` VALUES (62, 'EC', 'Ecudaor');
INSERT INTO `countries` VALUES (63, 'EG', 'Egypt');
INSERT INTO `countries` VALUES (64, 'SV', 'El Salvador');
INSERT INTO `countries` VALUES (65, 'GQ', 'Equatorial Guinea');
INSERT INTO `countries` VALUES (66, 'ER', 'Eritrea');
INSERT INTO `countries` VALUES (67, 'EE', 'Estonia');
INSERT INTO `countries` VALUES (68, 'ET', 'Ethiopia');
INSERT INTO `countries` VALUES (69, 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `countries` VALUES (70, 'FO', 'Faroe Islands');
INSERT INTO `countries` VALUES (71, 'FJ', 'Fiji');
INSERT INTO `countries` VALUES (72, 'FI', 'Finland');
INSERT INTO `countries` VALUES (73, 'FR', 'France');
INSERT INTO `countries` VALUES (74, 'FX', 'France, Metropolitan');
INSERT INTO `countries` VALUES (75, 'GF', 'French Guiana');
INSERT INTO `countries` VALUES (76, 'PF', 'French Polynesia');
INSERT INTO `countries` VALUES (77, 'TF', 'French Southern Territories');
INSERT INTO `countries` VALUES (78, 'GA', 'Gabon');
INSERT INTO `countries` VALUES (79, 'GM', 'Gambia');
INSERT INTO `countries` VALUES (80, 'GE', 'Georgia');
INSERT INTO `countries` VALUES (81, 'DE', 'Germany');
INSERT INTO `countries` VALUES (82, 'GH', 'Ghana');
INSERT INTO `countries` VALUES (83, 'GI', 'Gibraltar');
INSERT INTO `countries` VALUES (84, 'GR', 'Greece');
INSERT INTO `countries` VALUES (85, 'GL', 'Greenland');
INSERT INTO `countries` VALUES (86, 'GD', 'Grenada');
INSERT INTO `countries` VALUES (87, 'GP', 'Guadeloupe');
INSERT INTO `countries` VALUES (88, 'GU', 'Guam');
INSERT INTO `countries` VALUES (89, 'GT', 'Guatemala');
INSERT INTO `countries` VALUES (90, 'GN', 'Guinea');
INSERT INTO `countries` VALUES (91, 'GW', 'Guinea-Bissau');
INSERT INTO `countries` VALUES (92, 'GY', 'Guyana');
INSERT INTO `countries` VALUES (93, 'HT', 'Haiti');
INSERT INTO `countries` VALUES (94, 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `countries` VALUES (95, 'HN', 'Honduras');
INSERT INTO `countries` VALUES (96, 'HK', 'Hong Kong');
INSERT INTO `countries` VALUES (97, 'HU', 'Hungary');
INSERT INTO `countries` VALUES (98, 'IS', 'Iceland');
INSERT INTO `countries` VALUES (99, 'IN', 'India');
INSERT INTO `countries` VALUES (100, 'ID', 'Indonesia');
INSERT INTO `countries` VALUES (101, 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `countries` VALUES (102, 'IQ', 'Iraq');
INSERT INTO `countries` VALUES (103, 'IE', 'Ireland');
INSERT INTO `countries` VALUES (104, 'IL', 'Israel');
INSERT INTO `countries` VALUES (105, 'IT', 'Italy');
INSERT INTO `countries` VALUES (106, 'CI', 'Ivory Coast');
INSERT INTO `countries` VALUES (107, 'JM', 'Jamaica');
INSERT INTO `countries` VALUES (108, 'JP', 'Japan');
INSERT INTO `countries` VALUES (109, 'JO', 'Jordan');
INSERT INTO `countries` VALUES (110, 'KZ', 'Kazakhstan');
INSERT INTO `countries` VALUES (111, 'KE', 'Kenya');
INSERT INTO `countries` VALUES (112, 'KI', 'Kiribati');
INSERT INTO `countries` VALUES (113, 'KP', 'Korea, Democratic People\'s Republic of');
INSERT INTO `countries` VALUES (114, 'KR', 'Korea, Republic of');
INSERT INTO `countries` VALUES (115, 'KW', 'Kuwait');
INSERT INTO `countries` VALUES (116, 'KG', 'Kyrgyzstan');
INSERT INTO `countries` VALUES (117, 'LA', 'Lao People\'s Democratic Republic');
INSERT INTO `countries` VALUES (118, 'LV', 'Latvia');
INSERT INTO `countries` VALUES (119, 'LB', 'Lebanon');
INSERT INTO `countries` VALUES (120, 'LS', 'Lesotho');
INSERT INTO `countries` VALUES (121, 'LR', 'Liberia');
INSERT INTO `countries` VALUES (122, 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `countries` VALUES (123, 'LI', 'Liechtenstein');
INSERT INTO `countries` VALUES (124, 'LT', 'Lithuania');
INSERT INTO `countries` VALUES (125, 'LU', 'Luxembourg');
INSERT INTO `countries` VALUES (126, 'MO', 'Macau');
INSERT INTO `countries` VALUES (127, 'MK', 'Macedonia');
INSERT INTO `countries` VALUES (128, 'MG', 'Madagascar');
INSERT INTO `countries` VALUES (129, 'MW', 'Malawi');
INSERT INTO `countries` VALUES (130, 'MY', 'Malaysia');
INSERT INTO `countries` VALUES (131, 'MV', 'Maldives');
INSERT INTO `countries` VALUES (132, 'ML', 'Mali');
INSERT INTO `countries` VALUES (133, 'MT', 'Malta');
INSERT INTO `countries` VALUES (134, 'MH', 'Marshall Islands');
INSERT INTO `countries` VALUES (135, 'MQ', 'Martinique');
INSERT INTO `countries` VALUES (136, 'MR', 'Mauritania');
INSERT INTO `countries` VALUES (137, 'MU', 'Mauritius');
INSERT INTO `countries` VALUES (138, 'TY', 'Mayotte');
INSERT INTO `countries` VALUES (139, 'MX', 'Mexico');
INSERT INTO `countries` VALUES (140, 'FM', 'Micronesia, Federated States of');
INSERT INTO `countries` VALUES (141, 'MD', 'Moldova, Republic of');
INSERT INTO `countries` VALUES (142, 'MC', 'Monaco');
INSERT INTO `countries` VALUES (143, 'MN', 'Mongolia');
INSERT INTO `countries` VALUES (144, 'MS', 'Montserrat');
INSERT INTO `countries` VALUES (145, 'MA', 'Morocco');
INSERT INTO `countries` VALUES (146, 'MZ', 'Mozambique');
INSERT INTO `countries` VALUES (147, 'MM', 'Myanmar');
INSERT INTO `countries` VALUES (148, 'NA', 'Namibia');
INSERT INTO `countries` VALUES (149, 'NR', 'Nauru');
INSERT INTO `countries` VALUES (150, 'NP', 'Nepal');
INSERT INTO `countries` VALUES (151, 'NL', 'Netherlands');
INSERT INTO `countries` VALUES (152, 'AN', 'Netherlands Antilles');
INSERT INTO `countries` VALUES (153, 'NC', 'New Caledonia');
INSERT INTO `countries` VALUES (154, 'NZ', 'New Zealand');
INSERT INTO `countries` VALUES (155, 'NI', 'Nicaragua');
INSERT INTO `countries` VALUES (156, 'NE', 'Niger');
INSERT INTO `countries` VALUES (157, 'NG', 'Nigeria');
INSERT INTO `countries` VALUES (158, 'NU', 'Niue');
INSERT INTO `countries` VALUES (159, 'NF', 'Norfork Island');
INSERT INTO `countries` VALUES (160, 'MP', 'Northern Mariana Islands');
INSERT INTO `countries` VALUES (161, 'NO', 'Norway');
INSERT INTO `countries` VALUES (162, 'OM', 'Oman');
INSERT INTO `countries` VALUES (163, 'PK', 'Pakistan');
INSERT INTO `countries` VALUES (164, 'PW', 'Palau');
INSERT INTO `countries` VALUES (165, 'PA', 'Panama');
INSERT INTO `countries` VALUES (166, 'PG', 'Papua New Guinea');
INSERT INTO `countries` VALUES (167, 'PY', 'Paraguay');
INSERT INTO `countries` VALUES (168, 'PE', 'Peru');
INSERT INTO `countries` VALUES (169, 'PH', 'Philippines');
INSERT INTO `countries` VALUES (170, 'PN', 'Pitcairn');
INSERT INTO `countries` VALUES (171, 'PL', 'Poland');
INSERT INTO `countries` VALUES (172, 'PT', 'Portugal');
INSERT INTO `countries` VALUES (173, 'PR', 'Puerto Rico');
INSERT INTO `countries` VALUES (174, 'QA', 'Qatar');
INSERT INTO `countries` VALUES (175, 'RE', 'Reunion');
INSERT INTO `countries` VALUES (176, 'RO', 'Romania');
INSERT INTO `countries` VALUES (177, 'RU', 'Russian Federation');
INSERT INTO `countries` VALUES (178, 'RW', 'Rwanda');
INSERT INTO `countries` VALUES (179, 'KN', 'Saint Kitts and Nevis');
INSERT INTO `countries` VALUES (180, 'LC', 'Saint Lucia');
INSERT INTO `countries` VALUES (181, 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `countries` VALUES (182, 'WS', 'Samoa');
INSERT INTO `countries` VALUES (183, 'SM', 'San Marino');
INSERT INTO `countries` VALUES (184, 'ST', 'Sao Tome and Principe');
INSERT INTO `countries` VALUES (185, 'SA', 'Saudi Arabia');
INSERT INTO `countries` VALUES (186, 'SN', 'Senegal');
INSERT INTO `countries` VALUES (187, 'SC', 'Seychelles');
INSERT INTO `countries` VALUES (188, 'SL', 'Sierra Leone');
INSERT INTO `countries` VALUES (189, 'SG', 'Singapore');
INSERT INTO `countries` VALUES (190, 'SK', 'Slovakia');
INSERT INTO `countries` VALUES (191, 'SI', 'Slovenia');
INSERT INTO `countries` VALUES (192, 'SB', 'Solomon Islands');
INSERT INTO `countries` VALUES (193, 'SO', 'Somalia');
INSERT INTO `countries` VALUES (194, 'ZA', 'South Africa');
INSERT INTO `countries` VALUES (195, 'GS', 'South Georgia South Sandwich Islands');
INSERT INTO `countries` VALUES (196, 'ES', 'Spain');
INSERT INTO `countries` VALUES (197, 'LK', 'Sri Lanka');
INSERT INTO `countries` VALUES (198, 'SH', 'St. Helena');
INSERT INTO `countries` VALUES (199, 'PM', 'St. Pierre and Miquelon');
INSERT INTO `countries` VALUES (200, 'SD', 'Sudan');
INSERT INTO `countries` VALUES (201, 'SR', 'Suriname');
INSERT INTO `countries` VALUES (202, 'SJ', 'Svalbarn and Jan Mayen Islands');
INSERT INTO `countries` VALUES (203, 'SZ', 'Swaziland');
INSERT INTO `countries` VALUES (204, 'SE', 'Sweden');
INSERT INTO `countries` VALUES (205, 'CH', 'Switzerland');
INSERT INTO `countries` VALUES (206, 'SY', 'Syrian Arab Republic');
INSERT INTO `countries` VALUES (207, 'TW', 'Taiwan');
INSERT INTO `countries` VALUES (208, 'TJ', 'Tajikistan');
INSERT INTO `countries` VALUES (209, 'TZ', 'Tanzania, United Republic of');
INSERT INTO `countries` VALUES (210, 'TH', 'Thailand');
INSERT INTO `countries` VALUES (211, 'TG', 'Togo');
INSERT INTO `countries` VALUES (212, 'TK', 'Tokelau');
INSERT INTO `countries` VALUES (213, 'TO', 'Tonga');
INSERT INTO `countries` VALUES (214, 'TT', 'Trinidad and Tobago');
INSERT INTO `countries` VALUES (215, 'TN', 'Tunisia');
INSERT INTO `countries` VALUES (216, 'TR', 'Turkey');
INSERT INTO `countries` VALUES (217, 'TM', 'Turkmenistan');
INSERT INTO `countries` VALUES (218, 'TC', 'Turks and Caicos Islands');
INSERT INTO `countries` VALUES (219, 'TV', 'Tuvalu');
INSERT INTO `countries` VALUES (220, 'UG', 'Uganda');
INSERT INTO `countries` VALUES (221, 'UA', 'Ukraine');
INSERT INTO `countries` VALUES (222, 'AE', 'United Arab Emirates');
INSERT INTO `countries` VALUES (223, 'GB', 'United Kingdom');
INSERT INTO `countries` VALUES (224, 'UM', 'United States minor outlying islands');
INSERT INTO `countries` VALUES (225, 'UY', 'Uruguay');
INSERT INTO `countries` VALUES (226, 'UZ', 'Uzbekistan');
INSERT INTO `countries` VALUES (227, 'VU', 'Vanuatu');
INSERT INTO `countries` VALUES (228, 'VA', 'Vatican City State');
INSERT INTO `countries` VALUES (229, 'VE', 'Venezuela');
INSERT INTO `countries` VALUES (230, 'VN', 'Vietnam');
INSERT INTO `countries` VALUES (231, 'VG', 'Virigan Islands (British)');
INSERT INTO `countries` VALUES (232, 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `countries` VALUES (233, 'WF', 'Wallis and Futuna Islands');
INSERT INTO `countries` VALUES (234, 'EH', 'Western Sahara');
INSERT INTO `countries` VALUES (235, 'YE', 'Yemen');
INSERT INTO `countries` VALUES (236, 'YU', 'Yugoslavia');
INSERT INTO `countries` VALUES (237, 'ZR', 'Zaire');
INSERT INTO `countries` VALUES (238, 'ZM', 'Zambia');
INSERT INTO `countries` VALUES (239, 'ZW', 'Zimbabwe');
COMMIT;

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_head` bigint(20) unsigned DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_company_id_foreign` (`company_id`),
  KEY `departments_department_head_foreign` (`department_head`),
  CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `departments_department_head_foreign` FOREIGN KEY (`department_head`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
BEGIN;
INSERT INTO `departments` VALUES (1, 'CSE', 1, 11, NULL, '2020-07-27 04:44:20', '2020-07-27 04:44:20');
INSERT INTO `departments` VALUES (2, 'Analyst', 1, 13, NULL, '2020-07-27 04:51:45', '2020-07-27 09:06:12');
INSERT INTO `departments` VALUES (3, 'Finance', 1, 9, NULL, '2020-07-27 09:16:38', '2020-07-27 09:16:56');
INSERT INTO `departments` VALUES (4, 'R&D', 2, 15, NULL, '2020-07-27 09:18:38', '2020-07-27 09:19:10');
INSERT INTO `departments` VALUES (5, 'HR', 2, NULL, NULL, '2020-07-27 09:19:39', '2020-07-27 09:19:39');
COMMIT;

-- ----------------------------
-- Table structure for designations
-- ----------------------------
DROP TABLE IF EXISTS `designations`;
CREATE TABLE `designations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designations_company_id_foreign` (`company_id`),
  KEY `designations_department_id_foreign` (`department_id`),
  CONSTRAINT `designations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of designations
-- ----------------------------
BEGIN;
INSERT INTO `designations` VALUES (1, 'Senior Programmer', 1, 1, NULL, '2020-07-27 09:21:30', '2020-07-27 09:21:30');
INSERT INTO `designations` VALUES (2, 'Android Developer', 1, 1, NULL, '2020-07-27 09:28:30', '2020-07-27 09:28:52');
INSERT INTO `designations` VALUES (3, 'Data Analyst', 1, 2, NULL, '2020-07-27 09:29:37', '2020-07-27 09:29:37');
INSERT INTO `designations` VALUES (4, 'Marketing Analyst', 1, 2, NULL, '2020-07-27 09:30:02', '2020-07-27 09:30:02');
INSERT INTO `designations` VALUES (5, 'Finance Manager', 1, 3, NULL, '2020-07-27 09:30:17', '2020-07-27 09:30:17');
INSERT INTO `designations` VALUES (6, 'Trend Researcher', 2, 4, NULL, '2020-07-27 09:30:52', '2020-07-27 09:30:52');
INSERT INTO `designations` VALUES (7, 'HR manager', 2, 5, NULL, '2020-07-27 09:31:05', '2020-07-27 09:31:05');
COMMIT;

-- ----------------------------
-- Table structure for document_types
-- ----------------------------
DROP TABLE IF EXISTS `document_types`;
CREATE TABLE `document_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_types_company_id_foreign` (`company_id`),
  CONSTRAINT `document_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of document_types
-- ----------------------------
BEGIN;
INSERT INTO `document_types` VALUES (1, NULL, 'Driving Licesnse', '2020-07-26 20:27:04', '2020-07-26 20:27:04');
INSERT INTO `document_types` VALUES (2, NULL, 'Passport', '2020-07-26 20:27:16', '2020-07-26 20:27:16');
INSERT INTO `document_types` VALUES (3, NULL, 'National Id', '2020-07-26 20:27:40', '2020-07-26 20:27:40');
COMMIT;

-- ----------------------------
-- Table structure for employee_bank_accounts
-- ----------------------------
DROP TABLE IF EXISTS `employee_bank_accounts`;
CREATE TABLE `employee_bank_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `account_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_bank_accounts_employee_id_foreign` (`employee_id`),
  CONSTRAINT `employee_bank_accounts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_bank_accounts
-- ----------------------------
BEGIN;
INSERT INTO `employee_bank_accounts` VALUES (1, 12, 'Bob638', '674638', 'Standard Charterd', '6738', 'GEC', '2020-10-20 03:45:31', '2020-10-20 03:45:31');
INSERT INTO `employee_bank_accounts` VALUES (2, 11, 'Nei-Dezhi', 'P-123', 'Prime Bank', 'P-987', 'Muradpur', '2021-01-25 21:12:02', '2021-01-25 21:18:32');
INSERT INTO `employee_bank_accounts` VALUES (3, 14, 'Mayanak Agarwal', 'SE-123456', 'South-East Bank', 'SE-123', 'GEC', '2021-01-25 18:18:10', '2021-01-25 18:18:10');
INSERT INTO `employee_bank_accounts` VALUES (4, 15, 'Mansoor-Ahmed', 'D-123456', 'Dutch Bangla', 'D-987', 'Agrabad', '2021-01-25 18:22:58', '2021-01-25 18:22:58');
INSERT INTO `employee_bank_accounts` VALUES (5, 9, 'Sabiha', 'M-123456', 'Mutual Trust Bank', 'MTB-123', 'Dhaka', '2021-01-25 18:25:10', '2021-01-25 18:25:10');
INSERT INTO `employee_bank_accounts` VALUES (6, 10, 'Jhon-Chena', 'IB-1234567', 'Islami Bank', 'IB-4567', 'Chawkbazar', '2021-01-25 18:28:46', '2021-01-25 18:28:46');
INSERT INTO `employee_bank_accounts` VALUES (8, 13, 'Alice B', '1564788541', 'Sonali Bank', 'Sonali Bank-156', 'Agrabad', '2021-01-27 01:09:26', '2021-01-27 01:09:26');
COMMIT;

-- ----------------------------
-- Table structure for employee_contacts
-- ----------------------------
DROP TABLE IF EXISTS `employee_contacts`;
CREATE TABLE `employee_contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `relation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(4) DEFAULT '0',
  `is_dependent` tinyint(4) DEFAULT '0',
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_phone_ext` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `personal_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_contacts_employee_id_foreign` (`employee_id`),
  CONSTRAINT `employee_contacts_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_contacts
-- ----------------------------
BEGIN;
INSERT INTO `employee_contacts` VALUES (1, 12, 'parent', 1, NULL, 'Hogg Hobert', NULL, NULL, '67869689', NULL, NULL, 'Hogg34@gmail.com', '2869  University Street', NULL, 'Seattle', 'Washington', '98155', 1, '2020-10-20 03:09:31', '2020-10-20 03:09:31');
COMMIT;

-- ----------------------------
-- Table structure for employee_documents
-- ----------------------------
DROP TABLE IF EXISTS `employee_documents`;
CREATE TABLE `employee_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `document_type_id` bigint(20) unsigned DEFAULT NULL,
  `document_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_documents_employee_id_foreign` (`employee_id`),
  KEY `employee_documents_document_type_id_foreign` (`document_type_id`),
  CONSTRAINT `employee_documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employee_documents_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_documents
-- ----------------------------
BEGIN;
INSERT INTO `employee_documents` VALUES (3, 12, 1, 'My driving licence', 'driving licesnse for review', 'My driving licence.1603175008.png', '2023-03-30', NULL, '2020-10-20 03:23:28', '2020-10-20 03:23:28');
INSERT INTO `employee_documents` VALUES (4, 38, 2, 'Testing', 'This is Testing', 'Testing.1618469061.png', '2021-04-16', 1, '2021-04-15 06:44:22', '2021-04-15 06:44:22');
INSERT INTO `employee_documents` VALUES (5, 27, 3, 'Test', 'Test', 'Test.1633321238.png', '2021-10-05', NULL, '2021-10-04 04:20:38', '2021-10-04 04:20:38');
COMMIT;

-- ----------------------------
-- Table structure for employee_immigrations
-- ----------------------------
DROP TABLE IF EXISTS `employee_immigrations`;
CREATE TABLE `employee_immigrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `document_type_id` bigint(20) unsigned DEFAULT NULL,
  `document_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `eligible_review_date` date DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_immigrations_employee_id_foreign` (`employee_id`),
  KEY `employee_immigrations_document_type_id_foreign` (`document_type_id`),
  CONSTRAINT `employee_immigrations_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employee_immigrations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_immigrations
-- ----------------------------
BEGIN;
INSERT INTO `employee_immigrations` VALUES (2, 12, 3, '673627839', 'immigration_673627839.png', '2015-08-14', '2023-05-19', '2023-03-30', 1, '2020-10-20 02:51:16', '2020-10-20 02:51:16');
INSERT INTO `employee_immigrations` VALUES (3, 9, 1, '56757577657', 'immigration_56757577657.pdf', '0000-00-00', '2022-05-15', '2022-05-21', 1, '2022-05-26 03:59:37', '2022-05-26 04:24:47');
INSERT INTO `employee_immigrations` VALUES (4, 9, 2, '7868688676', 'immigration_7868688676.pdf', '2022-05-01', '2022-05-10', '2022-05-15', 1, '2022-05-26 04:14:50', '2022-05-26 04:14:50');
COMMIT;

-- ----------------------------
-- Table structure for employee_interview
-- ----------------------------
DROP TABLE IF EXISTS `employee_interview`;
CREATE TABLE `employee_interview` (
  `interview_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`interview_id`,`employee_id`),
  KEY `employee_interview_employee_id_foreign` (`employee_id`),
  CONSTRAINT `employee_interview_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `employee_interview_interview_id_foreign` FOREIGN KEY (`interview_id`) REFERENCES `job_interviews` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_interview
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for employee_meeting
-- ----------------------------
DROP TABLE IF EXISTS `employee_meeting`;
CREATE TABLE `employee_meeting` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `meeting_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`,`meeting_id`),
  KEY `employee_meeting_meeting_id_foreign` (`meeting_id`),
  CONSTRAINT `employee_meeting_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_meeting_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_meeting
-- ----------------------------
BEGIN;
INSERT INTO `employee_meeting` VALUES (9, 1);
INSERT INTO `employee_meeting` VALUES (10, 1);
INSERT INTO `employee_meeting` VALUES (11, 1);
INSERT INTO `employee_meeting` VALUES (12, 1);
COMMIT;

-- ----------------------------
-- Table structure for employee_project
-- ----------------------------
DROP TABLE IF EXISTS `employee_project`;
CREATE TABLE `employee_project` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`,`project_id`),
  KEY `employee_project_project_id_foreign` (`project_id`),
  CONSTRAINT `employee_project_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_project_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_project
-- ----------------------------
BEGIN;
INSERT INTO `employee_project` VALUES (9, 1);
INSERT INTO `employee_project` VALUES (11, 1);
INSERT INTO `employee_project` VALUES (12, 1);
INSERT INTO `employee_project` VALUES (13, 1);
INSERT INTO `employee_project` VALUES (14, 2);
INSERT INTO `employee_project` VALUES (15, 2);
INSERT INTO `employee_project` VALUES (9, 3);
COMMIT;

-- ----------------------------
-- Table structure for employee_qualificaitons
-- ----------------------------
DROP TABLE IF EXISTS `employee_qualificaitons`;
CREATE TABLE `employee_qualificaitons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `education_level_id` bigint(20) unsigned DEFAULT NULL,
  `institution_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_year` date DEFAULT NULL,
  `to_year` date DEFAULT NULL,
  `language_skill_id` bigint(20) unsigned DEFAULT NULL,
  `general_skill_id` bigint(20) unsigned DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_qualificaitons_employee_id_foreign` (`employee_id`),
  KEY `employee_qualificaitons_education_level_id_foreign` (`education_level_id`),
  KEY `employee_qualificaitons_language_skill_id_foreign` (`language_skill_id`),
  KEY `employee_qualificaitons_general_skill_id_foreign` (`general_skill_id`),
  CONSTRAINT `employee_qualificaitons_education_level_id_foreign` FOREIGN KEY (`education_level_id`) REFERENCES `qualification_education_levels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employee_qualificaitons_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_qualificaitons_general_skill_id_foreign` FOREIGN KEY (`general_skill_id`) REFERENCES `qualification_skills` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employee_qualificaitons_language_skill_id_foreign` FOREIGN KEY (`language_skill_id`) REFERENCES `qualification_languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_qualificaitons
-- ----------------------------
BEGIN;
INSERT INTO `employee_qualificaitons` VALUES (1, 12, 1, 'Boston University', '2014-07-09', '2018-10-01', 1, 2, NULL, '2020-10-20 03:34:11', '2020-10-20 03:34:11');
COMMIT;

-- ----------------------------
-- Table structure for employee_support_ticket
-- ----------------------------
DROP TABLE IF EXISTS `employee_support_ticket`;
CREATE TABLE `employee_support_ticket` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `support_ticket_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`,`support_ticket_id`),
  KEY `employee_support_ticket_support_ticket_id_foreign` (`support_ticket_id`),
  CONSTRAINT `employee_support_ticket_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_support_ticket_support_ticket_id_foreign` FOREIGN KEY (`support_ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_support_ticket
-- ----------------------------
BEGIN;
INSERT INTO `employee_support_ticket` VALUES (9, 1);
INSERT INTO `employee_support_ticket` VALUES (10, 1);
COMMIT;

-- ----------------------------
-- Table structure for employee_task
-- ----------------------------
DROP TABLE IF EXISTS `employee_task`;
CREATE TABLE `employee_task` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `task_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`,`task_id`),
  KEY `employee_task_task_id_foreign` (`task_id`),
  CONSTRAINT `employee_task_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_task_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_task
-- ----------------------------
BEGIN;
INSERT INTO `employee_task` VALUES (11, 1);
INSERT INTO `employee_task` VALUES (14, 2);
COMMIT;

-- ----------------------------
-- Table structure for employee_training_list
-- ----------------------------
DROP TABLE IF EXISTS `employee_training_list`;
CREATE TABLE `employee_training_list` (
  `employee_id` bigint(20) unsigned NOT NULL,
  `training_list_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`employee_id`,`training_list_id`),
  KEY `employee_training_list_training_list_id_foreign` (`training_list_id`),
  CONSTRAINT `employee_training_list_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_training_list_training_list_id_foreign` FOREIGN KEY (`training_list_id`) REFERENCES `training_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_training_list
-- ----------------------------
BEGIN;
INSERT INTO `employee_training_list` VALUES (9, 1);
INSERT INTO `employee_training_list` VALUES (10, 1);
INSERT INTO `employee_training_list` VALUES (12, 1);
COMMIT;

-- ----------------------------
-- Table structure for employee_work_experience
-- ----------------------------
DROP TABLE IF EXISTS `employee_work_experience`;
CREATE TABLE `employee_work_experience` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `organisatie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_year` date DEFAULT NULL,
  `to_year` date DEFAULT NULL,
  `post` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_work_experience_employee_id_foreign` (`employee_id`),
  CONSTRAINT `employee_work_experience_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employee_work_experience
-- ----------------------------
BEGIN;
INSERT INTO `employee_work_experience` VALUES (1, 12, 'RanksFc', '2017-08-05', '2019-01-29', 'Junior Executive', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English', '2020-10-20 03:42:50', '2020-10-20 03:42:50');
COMMIT;

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_shift_id` bigint(20) unsigned DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `designation_id` bigint(20) unsigned DEFAULT NULL,
  `location_id` bigint(20) unsigned DEFAULT NULL,
  `role_users_id` bigint(20) unsigned DEFAULT NULL,
  `status_id` bigint(20) unsigned DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `exit_date` date DEFAULT NULL,
  `marital_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedIn_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_id` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basic_salary` double DEFAULT '0',
  `payslip_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendance_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_leave` int(11) DEFAULT '0',
  `remaining_leave` int(11) DEFAULT '0',
  `pension_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pension_amount` double(8,2) DEFAULT '0.00',
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_office_shift_id_foreign` (`office_shift_id`),
  KEY `employees_company_id_foreign` (`company_id`),
  KEY `employees_department_id_foreign` (`department_id`),
  KEY `employees_designation_id_foreign` (`designation_id`),
  KEY `employees_location_id_foreign` (`location_id`),
  KEY `employees_role_users_id_foreign` (`role_users_id`),
  KEY `employees_status_id_foreign` (`status_id`),
  CONSTRAINT `employees_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_office_shift_id_foreign` FOREIGN KEY (`office_shift_id`) REFERENCES `office_shifts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_role_users_id_foreign` FOREIGN KEY (`role_users_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of employees
-- ----------------------------
BEGIN;
INSERT INTO `employees` VALUES (9, 'Sahiba', 'Khatun', '1', 'sahibakhatun@gmail.com', '387292822', '1990-09-25', 'Female', 1, 1, 1, 2, NULL, 5, 1, '2020-01-02', NULL, 'single', '22,new street', 'Sharjha', 'UAE', '222', '6753', NULL, 'Sabiha95', '', '', '', '123456789', 500, 'Monthly', 'general', 30, 7, 'percentage', 50.00, 1, '2020-07-26 19:51:54', '2022-10-02 09:25:21');
INSERT INTO `employees` VALUES (10, 'John', 'Cena', '2', 'johncena@hotmail.com', '456372794', '1991-03-09', 'Male', 1, 1, 2, 3, NULL, 6, 2, '2019-04-16', NULL, 'married', 'New South Wales', 'Sydney', '', '15', '78765', NULL, 'Jhon123', '', '', '', '12354698', 150, 'Monthly', 'general', 0, 0, NULL, 0.00, NULL, '2020-07-26 20:01:39', '2021-09-20 10:46:35');
INSERT INTO `employees` VALUES (11, 'Neo', 'Dezhi', '3', 'neodezhi@gmail.com', '67278232', '1991-03-29', 'Male', 1, 1, 3, 5, NULL, 4, 1, '2020-07-01', NULL, '', '', '', '', '', '', NULL, 'Deshi321', NULL, NULL, NULL, '987456', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2020-07-26 20:03:25', '2022-10-18 15:15:31');
INSERT INTO `employees` VALUES (12, 'Bob', 'Hobart', '4', 'bob@ymail.com', '4678292', '1993-05-18', 'Male', 1, 1, 3, 5, NULL, 2, 1, '2018-12-13', NULL, 'single', '3527  Horseshoe Lane', 'Norristown', 'Pennsylvania', '1', '19403', NULL, 'bobhober05', 'bob.05@facebook.com', '', '', '12354698', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2020-07-27 04:26:35', '2021-09-05 03:17:40');
INSERT INTO `employees` VALUES (13, 'Alice', 'Patrica', '5', 'alicehh4@newmail.com', '8765445698', '1991-07-25', 'Male', 1, 1, 1, 1, NULL, 2, 1, '2021-04-13', NULL, '', '', '', '', '', '', NULL, 'Alica123', '', '', '', '96548789', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2020-07-27 04:28:16', '2021-06-24 16:06:50');
INSERT INTO `employees` VALUES (14, 'Mayank', 'Agarwal', '6', 'mayank@gmail.com', '746389982', '1989-06-03', 'Male', 1, 1, 2, 3, NULL, 2, 3, '2020-07-02', NULL, 'divorced', '', '', '', '', '', NULL, 'mayank23', '', '', '', '465467767', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2020-07-27 04:31:24', '2021-04-15 09:19:08');
INSERT INTO `employees` VALUES (15, 'Mansoor', 'Ahmed', '7', 'mansoor@yahoo.com', '67638299', '1998-08-18', 'Male', 1, 1, 3, 5, NULL, 2, 1, '2019-05-22', NULL, 'single', '', '', '', '', '', NULL, 'Moonsoor', '', '', '', '48787564', 200, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2020-07-27 04:33:54', '2021-04-15 09:20:00');
INSERT INTO `employees` VALUES (27, 'Junayet', 'Istius', '8', 'junayet@gmail.com', '01829496534', '2021-03-01', 'Male', 1, 1, 1, 1, NULL, 2, 1, '2021-10-01', NULL, '', '', '', '', '', '', NULL, 'junayet67', '', '', '', '66456798', 100, 'Monthly', 'general', 15, 11, NULL, 0.00, 1, '2021-03-12 10:47:48', '2021-10-04 01:11:30');
INSERT INTO `employees` VALUES (34, 'Amzad', 'Hossain', '9', 'amzad@gmail.com', '01521225124', '2021-03-01', 'Male', 1, 1, 1, 2, NULL, 2, 1, '2021-01-30', NULL, '', '', '', '', '', '', NULL, 'amjad95', NULL, NULL, NULL, '65412254', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2021-03-28 05:53:57', '2021-04-08 15:16:21');
INSERT INTO `employees` VALUES (38, 'Anisul', 'Islam', '10', 'nasrinchowdhury198@gmail.com', '01521222842', '2021-03-01', 'Male', 1, 1, 1, 2, NULL, 2, 1, '2021-01-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'anis95', NULL, NULL, NULL, '48754121', 100, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2021-03-28 17:35:27', '2021-04-08 15:16:38');
INSERT INTO `employees` VALUES (45, 'Promi', 'Chy', '11', 'promi98@gmail.com', '423213234', '2021-06-29', 'Female', 2, 1, 1, 2, NULL, 4, 1, '2021-06-29', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'general', 0, 0, NULL, 0.00, 1, '2021-06-29 17:16:33', '2021-06-30 00:26:55');
INSERT INTO `employees` VALUES (49, 'Sahiba', 'Chowdhury', '12', 'sahiba95@gmail.com', '01829640631', '2021-12-01', 'Male', 1, 1, 1, 2, NULL, 2, 1, '2022-02-26', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 10, 'Monthly', 'general', 0, 0, NULL, 0.00, 1, '2022-02-26 05:00:03', '2022-02-26 07:29:12');
INSERT INTO `employees` VALUES (51, 'Lacey', 'Wood', '13', 'myjof@mailinator.com', '1211334234', '2022-03-28', 'Female', 1, 1, 1, 1, NULL, 1, 1, '2022-03-24', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'general', 0, 0, NULL, 0.00, 1, '2022-03-28 04:46:07', '2022-05-24 07:08:37');
COMMIT;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `event_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_note` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `event_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_notify` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_company_id_foreign` (`company_id`),
  KEY `events_department_id_foreign` (`department_id`),
  CONSTRAINT `events_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `events_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of events
-- ----------------------------
BEGIN;
INSERT INTO `events` VALUES (1, 1, 2, 'Birthday Party', 'Today is the birthday of our honourable HR', '2021-04-03', '04:20PM', 'approved', 1, '2020-07-28 14:18:56', '2020-07-28 14:24:17');
INSERT INTO `events` VALUES (2, 1, 3, 'test', 'dacd', '2021-02-28', '07:40PM', 'approved', NULL, '2020-10-27 01:29:18', '2020-10-27 01:29:18');
COMMIT;

-- ----------------------------
-- Table structure for expense_types
-- ----------------------------
DROP TABLE IF EXISTS `expense_types`;
CREATE TABLE `expense_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_types_company_id_foreign` (`company_id`),
  CONSTRAINT `expense_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of expense_types
-- ----------------------------
BEGIN;
INSERT INTO `expense_types` VALUES (1, 1, 'utility', '2020-07-26 20:22:56', '2020-07-26 20:22:56');
INSERT INTO `expense_types` VALUES (2, 1, 'supplies', '2020-07-26 20:23:10', '2020-07-26 20:23:10');
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for file_manager_settings
-- ----------------------------
DROP TABLE IF EXISTS `file_manager_settings`;
CREATE TABLE `file_manager_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `allowed_extensions` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_file_size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of file_manager_settings
-- ----------------------------
BEGIN;
INSERT INTO `file_manager_settings` VALUES (1, 'jpg,png,doc,docx,pdf,csv,xls,jpeg', 20, '2020-07-29 05:59:20', '2020-07-29 05:59:20');
COMMIT;

-- ----------------------------
-- Table structure for file_managers
-- ----------------------------
DROP TABLE IF EXISTS `file_managers`;
CREATE TABLE `file_managers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_extension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_managers_department_id_foreign` (`department_id`),
  KEY `file_managers_added_by_foreign` (`added_by`),
  CONSTRAINT `file_managers_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `file_managers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of file_managers
-- ----------------------------
BEGIN;
INSERT INTO `file_managers` VALUES (1, 1, 1, 'New', '185.04 KB', 'pdf', NULL, '2020-07-29 06:01:33', '2020-07-29 06:01:33');
COMMIT;

-- ----------------------------
-- Table structure for finance_bank_cashes
-- ----------------------------
DROP TABLE IF EXISTS `finance_bank_cashes`;
CREATE TABLE `finance_bank_cashes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_branch` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_bank_cashes
-- ----------------------------
BEGIN;
INSERT INTO `finance_bank_cashes` VALUES (1, 'Central Bank', '19234', '50000', '5635636', '676', 'Ethopia', '2020-07-28 17:17:21', '2022-10-25 07:42:42');
INSERT INTO `finance_bank_cashes` VALUES (2, 'New Horizon', '144500', '35000', '5534677', '453', 'Orchestra', '2020-07-28 17:18:15', '2020-07-29 05:36:41');
COMMIT;

-- ----------------------------
-- Table structure for finance_deposits
-- ----------------------------
DROP TABLE IF EXISTS `finance_deposits`;
CREATE TABLE `finance_deposits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `account_id` bigint(20) unsigned DEFAULT NULL,
  `amount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `payment_method_id` bigint(20) unsigned DEFAULT NULL,
  `payer_id` bigint(20) unsigned DEFAULT NULL,
  `deposit_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_deposits_company_id_foreign` (`company_id`),
  KEY `finance_deposits_account_id_foreign` (`account_id`),
  KEY `finance_deposits_payment_method_id_foreign` (`payment_method_id`),
  KEY `finance_deposits_payer_id_foreign` (`payer_id`),
  CONSTRAINT `finance_deposits_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `finance_bank_cashes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_deposits_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_deposits_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `finance_payers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_deposits_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_deposits
-- ----------------------------
BEGIN;
INSERT INTO `finance_deposits` VALUES (1, NULL, 1, '110500', 'interest income', 'gfddds', 3, 1, '564534', NULL, '2021-03-28', '2020-07-28 17:24:20', '2020-07-28 17:26:37');
INSERT INTO `finance_deposits` VALUES (5, NULL, 2, '110500', 'interest income', NULL, 1, 2, '37763', NULL, '2021-03-27', '2020-07-28 18:12:31', '2020-07-29 05:28:25');
COMMIT;

-- ----------------------------
-- Table structure for finance_expenses
-- ----------------------------
DROP TABLE IF EXISTS `finance_expenses`;
CREATE TABLE `finance_expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `account_id` bigint(20) unsigned DEFAULT NULL,
  `amount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `payment_method_id` bigint(20) unsigned DEFAULT NULL,
  `payee_id` bigint(20) unsigned DEFAULT NULL,
  `expense_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_expenses_company_id_foreign` (`company_id`),
  KEY `finance_expenses_account_id_foreign` (`account_id`),
  KEY `finance_expenses_payment_method_id_foreign` (`payment_method_id`),
  KEY `finance_expenses_payee_id_foreign` (`payee_id`),
  KEY `finance_expenses_category_id_foreign` (`category_id`),
  CONSTRAINT `finance_expenses_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `finance_bank_cashes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_expenses_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_expenses_payee_id_foreign` FOREIGN KEY (`payee_id`) REFERENCES `finance_payees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_expenses_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_expenses
-- ----------------------------
BEGIN;
INSERT INTO `finance_expenses` VALUES (3, NULL, 2, '3000', 1, NULL, 2, 1, '455343', NULL, '2021-03-29', '2020-07-28 17:45:41', '2020-07-28 17:45:41');
INSERT INTO `finance_expenses` VALUES (9, NULL, 1, '20000', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 07:20:58', '2020-07-29 07:20:58');
INSERT INTO `finance_expenses` VALUES (10, NULL, 1, '1000', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 07:38:34', '2020-07-29 07:38:34');
INSERT INTO `finance_expenses` VALUES (11, NULL, 1, '1500', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 09:11:51', '2020-07-29 09:11:51');
INSERT INTO `finance_expenses` VALUES (12, NULL, 1, '1500', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 09:33:49', '2020-07-29 09:33:49');
INSERT INTO `finance_expenses` VALUES (13, NULL, 1, '2190', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 18:25:19', '2020-07-29 18:25:19');
INSERT INTO `finance_expenses` VALUES (14, NULL, 1, '1500', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 19:08:48', '2020-07-29 19:08:48');
INSERT INTO `finance_expenses` VALUES (16, NULL, 1, '310', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', '2020-07-29 20:32:34', '2020-07-29 20:32:34');
INSERT INTO `finance_expenses` VALUES (19, NULL, 1, '965', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-02-28', '2020-10-15 06:27:00', '2020-10-15 06:27:00');
INSERT INTO `finance_expenses` VALUES (20, NULL, 1, '310', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-02-28', '2020-10-19 11:54:47', '2020-10-19 11:54:47');
INSERT INTO `finance_expenses` VALUES (21, NULL, 1, '3690', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-01-24', '2020-10-19 11:57:30', '2020-10-19 11:57:30');
INSERT INTO `finance_expenses` VALUES (22, NULL, 1, '310', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-05', '2021-03-05 12:49:44', '2021-03-05 12:49:44');
INSERT INTO `finance_expenses` VALUES (23, NULL, 1, '49800', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 06:18:02', '2021-03-12 06:18:02');
INSERT INTO `finance_expenses` VALUES (24, NULL, 1, '110', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 06:40:21', '2021-03-12 06:40:21');
INSERT INTO `finance_expenses` VALUES (25, NULL, 1, '1705', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 06:52:46', '2021-03-12 06:52:46');
INSERT INTO `finance_expenses` VALUES (26, NULL, 1, '3880', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 07:20:57', '2021-03-12 07:20:57');
INSERT INTO `finance_expenses` VALUES (27, NULL, 1, '3880', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 07:27:15', '2021-03-12 07:27:15');
INSERT INTO `finance_expenses` VALUES (28, NULL, 1, '1110', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 07:31:31', '2021-03-12 07:31:31');
INSERT INTO `finance_expenses` VALUES (29, NULL, 1, '2590', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 10:24:41', '2021-03-12 10:24:41');
INSERT INTO `finance_expenses` VALUES (30, NULL, 1, '175', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 10:26:26', '2021-03-12 10:26:26');
INSERT INTO `finance_expenses` VALUES (31, NULL, 1, '110', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 10:34:06', '2021-03-12 10:34:06');
INSERT INTO `finance_expenses` VALUES (32, NULL, 1, '310', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 11:03:09', '2021-03-12 11:03:09');
INSERT INTO `finance_expenses` VALUES (33, NULL, 1, '2590', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 11:27:41', '2021-03-12 11:27:41');
INSERT INTO `finance_expenses` VALUES (34, NULL, 1, '0', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 11:40:29', '2021-03-12 11:40:29');
INSERT INTO `finance_expenses` VALUES (35, NULL, 1, '2305', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 11:46:25', '2021-03-12 11:46:25');
INSERT INTO `finance_expenses` VALUES (36, NULL, 1, '110', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:03:55', '2021-03-12 13:03:55');
INSERT INTO `finance_expenses` VALUES (37, NULL, 1, '660', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:07:59', '2021-03-12 13:07:59');
INSERT INTO `finance_expenses` VALUES (38, NULL, 1, '660', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:08:48', '2021-03-12 13:08:48');
INSERT INTO `finance_expenses` VALUES (39, NULL, 1, '420', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:12:40', '2021-03-12 13:12:40');
INSERT INTO `finance_expenses` VALUES (40, NULL, 1, '650', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:16:06', '2021-03-12 13:16:06');
INSERT INTO `finance_expenses` VALUES (41, NULL, 1, '310', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', '2021-03-12 13:17:02', '2021-03-12 13:17:02');
INSERT INTO `finance_expenses` VALUES (42, NULL, 1, '660', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-13', '2021-03-13 10:07:03', '2021-03-13 10:07:03');
INSERT INTO `finance_expenses` VALUES (43, NULL, 1, '0', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-13', '2021-03-13 10:07:25', '2021-03-13 10:07:25');
INSERT INTO `finance_expenses` VALUES (44, NULL, 1, '1490', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-20', '2021-03-20 14:25:41', '2021-03-20 14:25:41');
INSERT INTO `finance_expenses` VALUES (45, NULL, 1, '2090', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-20', '2021-03-20 14:37:54', '2021-03-20 14:37:54');
INSERT INTO `finance_expenses` VALUES (46, NULL, 1, '2090', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', '2021-03-22 13:44:20', '2021-03-22 13:44:20');
INSERT INTO `finance_expenses` VALUES (47, NULL, 1, '340', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', '2021-03-22 14:30:06', '2021-03-22 14:30:06');
INSERT INTO `finance_expenses` VALUES (48, NULL, 1, '175', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', '2021-03-22 14:36:02', '2021-03-22 14:36:02');
INSERT INTO `finance_expenses` VALUES (49, NULL, 1, '375', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', '2021-04-06 03:31:41', '2021-04-06 03:31:41');
INSERT INTO `finance_expenses` VALUES (50, NULL, 1, '110', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', '2021-04-06 03:36:28', '2021-04-06 03:36:28');
INSERT INTO `finance_expenses` VALUES (51, NULL, 1, '200', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', '2021-04-06 05:07:42', '2021-04-06 05:07:42');
INSERT INTO `finance_expenses` VALUES (52, NULL, 1, '775', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-08', '2021-04-08 17:35:48', '2021-04-08 17:35:48');
INSERT INTO `finance_expenses` VALUES (53, NULL, 1, '675', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-08', '2021-04-08 17:36:12', '2021-04-08 17:36:12');
INSERT INTO `finance_expenses` VALUES (54, NULL, 1, '675', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', '2021-04-09 07:27:31', '2021-04-09 07:27:31');
INSERT INTO `finance_expenses` VALUES (55, NULL, 1, '800', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', '2021-04-09 07:29:25', '2021-04-09 07:29:25');
INSERT INTO `finance_expenses` VALUES (56, NULL, 1, '1050', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', '2021-04-09 16:48:46', '2021-04-09 16:48:46');
INSERT INTO `finance_expenses` VALUES (57, NULL, 1, '950', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', '2021-04-10 13:45:13', '2021-04-10 13:45:13');
INSERT INTO `finance_expenses` VALUES (58, NULL, 1, '1050', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', '2021-04-10 16:01:21', '2021-04-10 16:01:21');
INSERT INTO `finance_expenses` VALUES (59, NULL, 1, '905', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', '2021-04-10 17:06:06', '2021-04-10 17:06:06');
INSERT INTO `finance_expenses` VALUES (60, NULL, 1, '1090', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', '2021-04-10 17:07:24', '2021-04-10 17:07:24');
INSERT INTO `finance_expenses` VALUES (61, NULL, 1, '990', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 02:29:36', '2021-04-11 02:29:36');
INSERT INTO `finance_expenses` VALUES (62, NULL, 1, '950', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 02:49:48', '2021-04-11 02:49:48');
INSERT INTO `finance_expenses` VALUES (63, NULL, 1, '83.333', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 04:01:42', '2021-04-11 04:01:42');
INSERT INTO `finance_expenses` VALUES (64, NULL, 1, '83.333', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 04:03:00', '2021-04-11 04:03:00');
INSERT INTO `finance_expenses` VALUES (65, NULL, 1, '83.333', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 04:03:57', '2021-04-11 04:03:57');
INSERT INTO `finance_expenses` VALUES (66, NULL, 1, '83.333', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 04:11:40', '2021-04-11 04:11:40');
INSERT INTO `finance_expenses` VALUES (67, NULL, 1, '715', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 17:40:48', '2021-04-11 17:40:48');
INSERT INTO `finance_expenses` VALUES (68, NULL, 1, '715', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', '2021-04-11 17:52:03', '2021-04-11 17:52:03');
INSERT INTO `finance_expenses` VALUES (69, NULL, 1, '605', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 01:16:42', '2021-04-12 01:16:42');
INSERT INTO `finance_expenses` VALUES (70, NULL, 1, '605', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 01:19:09', '2021-04-12 01:19:09');
INSERT INTO `finance_expenses` VALUES (71, NULL, 1, '1615', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 17:33:37', '2021-04-12 17:33:37');
INSERT INTO `finance_expenses` VALUES (72, NULL, 1, '215', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 17:34:45', '2021-04-12 17:34:45');
INSERT INTO `finance_expenses` VALUES (73, NULL, 1, '215', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 17:35:23', '2021-04-12 17:35:23');
INSERT INTO `finance_expenses` VALUES (74, NULL, 1, '215', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 17:36:32', '2021-04-12 17:36:32');
INSERT INTO `finance_expenses` VALUES (75, NULL, 1, '215', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', '2021-04-12 17:36:32', '2021-04-12 17:36:32');
INSERT INTO `finance_expenses` VALUES (76, NULL, 1, '85', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', '2021-04-13 05:06:17', '2021-04-13 05:06:17');
INSERT INTO `finance_expenses` VALUES (77, NULL, 1, '4055', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', '2021-04-13 15:28:42', '2021-04-13 15:28:42');
INSERT INTO `finance_expenses` VALUES (78, NULL, 1, '165', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', '2021-04-13 15:36:59', '2021-04-13 15:36:59');
INSERT INTO `finance_expenses` VALUES (79, NULL, 1, '410', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', '2021-04-13 21:41:16', '2021-04-13 21:41:16');
INSERT INTO `finance_expenses` VALUES (82, NULL, 1, '165', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', '2021-04-14 16:15:33', '2021-04-14 16:15:33');
INSERT INTO `finance_expenses` VALUES (83, NULL, 1, '75', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', '2021-04-14 16:17:30', '2021-04-14 16:17:30');
INSERT INTO `finance_expenses` VALUES (84, NULL, 1, '200', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', '2021-04-14 16:37:09', '2021-04-14 16:37:09');
INSERT INTO `finance_expenses` VALUES (85, NULL, 1, '275', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-15', '2021-04-14 20:39:45', '2021-04-14 20:39:45');
INSERT INTO `finance_expenses` VALUES (86, NULL, 1, '139', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-15', '2021-04-14 21:07:53', '2021-04-14 21:07:53');
INSERT INTO `finance_expenses` VALUES (87, NULL, 1, '740', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-07-03', '2021-07-03 13:48:19', '2021-07-03 13:48:19');
INSERT INTO `finance_expenses` VALUES (88, NULL, 1, '350', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-07-23', '2022-07-23 08:15:27', '2022-07-23 08:15:27');
INSERT INTO `finance_expenses` VALUES (89, NULL, 1, '70', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-18', '2022-10-18 15:22:39', '2022-10-18 15:22:39');
INSERT INTO `finance_expenses` VALUES (90, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 06:59:00', '2022-10-24 06:59:00');
INSERT INTO `finance_expenses` VALUES (91, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 06:59:26', '2022-10-24 06:59:26');
INSERT INTO `finance_expenses` VALUES (92, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:02:13', '2022-10-24 07:02:13');
INSERT INTO `finance_expenses` VALUES (93, NULL, 1, '205', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:03:42', '2022-10-24 07:03:42');
INSERT INTO `finance_expenses` VALUES (94, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:13:06', '2022-10-24 07:13:06');
INSERT INTO `finance_expenses` VALUES (95, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:14:39', '2022-10-24 07:14:39');
INSERT INTO `finance_expenses` VALUES (96, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:16:11', '2022-10-24 07:16:11');
INSERT INTO `finance_expenses` VALUES (97, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:19:20', '2022-10-24 07:19:20');
INSERT INTO `finance_expenses` VALUES (98, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 07:19:55', '2022-10-24 07:19:55');
INSERT INTO `finance_expenses` VALUES (99, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 09:17:34', '2022-10-24 09:17:34');
INSERT INTO `finance_expenses` VALUES (100, NULL, 1, '185', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 09:18:13', '2022-10-24 09:18:13');
INSERT INTO `finance_expenses` VALUES (101, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 09:37:13', '2022-10-24 09:37:13');
INSERT INTO `finance_expenses` VALUES (102, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', '2022-10-24 09:37:26', '2022-10-24 09:37:26');
INSERT INTO `finance_expenses` VALUES (103, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', '2022-10-25 07:41:16', '2022-10-25 07:41:16');
INSERT INTO `finance_expenses` VALUES (104, NULL, 1, '195', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', '2022-10-25 07:41:53', '2022-10-25 07:41:53');
INSERT INTO `finance_expenses` VALUES (105, NULL, 1, '205', NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', '2022-10-25 07:42:42', '2022-10-25 07:42:42');
COMMIT;

-- ----------------------------
-- Table structure for finance_payees
-- ----------------------------
DROP TABLE IF EXISTS `finance_payees`;
CREATE TABLE `finance_payees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payee_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_payees
-- ----------------------------
BEGIN;
INSERT INTO `finance_payees` VALUES (1, 'Mr. A', '563345', '2020-07-28 17:22:13', '2020-07-28 17:22:13');
INSERT INTO `finance_payees` VALUES (2, 'Mr. B', '5656353', '2020-07-28 17:22:31', '2020-07-28 17:22:31');
COMMIT;

-- ----------------------------
-- Table structure for finance_payers
-- ----------------------------
DROP TABLE IF EXISTS `finance_payers`;
CREATE TABLE `finance_payers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payer_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_payers
-- ----------------------------
BEGIN;
INSERT INTO `finance_payers` VALUES (1, 'Mr. X', '34242', '2020-07-28 17:23:01', '2020-07-28 17:23:01');
INSERT INTO `finance_payers` VALUES (2, 'Mr. Z', '54563', '2020-07-28 17:23:19', '2020-07-28 17:23:19');
COMMIT;

-- ----------------------------
-- Table structure for finance_transactions
-- ----------------------------
DROP TABLE IF EXISTS `finance_transactions`;
CREATE TABLE `finance_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `account_id` bigint(20) unsigned DEFAULT NULL,
  `amount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `payment_method_id` bigint(20) unsigned DEFAULT NULL,
  `payee_id` bigint(20) unsigned DEFAULT NULL,
  `payer_id` bigint(20) unsigned DEFAULT NULL,
  `expense_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `deposit_reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_transactions_company_id_foreign` (`company_id`),
  KEY `finance_transactions_account_id_foreign` (`account_id`),
  KEY `finance_transactions_payment_method_id_foreign` (`payment_method_id`),
  KEY `finance_transactions_payee_id_foreign` (`payee_id`),
  KEY `finance_transactions_payer_id_foreign` (`payer_id`),
  KEY `finance_transactions_category_id_foreign` (`category_id`),
  CONSTRAINT `finance_transactions_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `finance_bank_cashes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transactions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `expense_types` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transactions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transactions_payee_id_foreign` FOREIGN KEY (`payee_id`) REFERENCES `finance_payees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transactions_payer_id_foreign` FOREIGN KEY (`payer_id`) REFERENCES `finance_payers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_transactions
-- ----------------------------
BEGIN;
INSERT INTO `finance_transactions` VALUES (1, NULL, 1, '110500', 'interest income', NULL, 'gfddds', 3, NULL, 1, NULL, NULL, NULL, '564534', NULL, '2021-03-28', '2020-07-28 17:24:20', '2020-07-28 17:26:37');
INSERT INTO `finance_transactions` VALUES (3, NULL, 2, '3000', '', 1, NULL, 2, 1, NULL, '455343', NULL, '2021-03-29', NULL, NULL, NULL, '2020-07-28 17:45:41', '2020-07-28 17:45:41');
INSERT INTO `finance_transactions` VALUES (5, NULL, 2, '110500', 'interest income', NULL, NULL, 1, NULL, 2, NULL, NULL, NULL, '37763', NULL, '2021-03-27', '2020-07-28 18:12:31', '2020-07-29 05:28:25');
INSERT INTO `finance_transactions` VALUES (6, NULL, 2, '2000', 'transfer', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '6736', NULL, '2021-03-30', '2020-07-29 05:36:41', '2020-07-29 05:36:41');
INSERT INTO `finance_transactions` VALUES (7, NULL, 1, '2000', 'transfer', NULL, NULL, 1, NULL, NULL, '6736', NULL, '2021-03-30', NULL, NULL, NULL, '2020-07-29 05:36:41', '2020-07-29 05:36:41');
INSERT INTO `finance_transactions` VALUES (9, NULL, 1, '20000', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 07:20:58', '2020-07-29 07:20:58');
INSERT INTO `finance_transactions` VALUES (10, NULL, 1, '1000', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 07:38:34', '2020-07-29 07:38:34');
INSERT INTO `finance_transactions` VALUES (11, NULL, 1, '1500', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 09:11:51', '2020-07-29 09:11:51');
INSERT INTO `finance_transactions` VALUES (12, NULL, 1, '1500', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 09:33:49', '2020-07-29 09:33:49');
INSERT INTO `finance_transactions` VALUES (13, NULL, 1, '2190', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 18:25:19', '2020-07-29 18:25:19');
INSERT INTO `finance_transactions` VALUES (14, NULL, 1, '1500', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 19:08:47', '2020-07-29 19:08:47');
INSERT INTO `finance_transactions` VALUES (16, NULL, 1, '310', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-26', NULL, NULL, NULL, '2020-07-29 20:32:34', '2020-07-29 20:32:34');
INSERT INTO `finance_transactions` VALUES (19, NULL, 1, '965', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-02-28', NULL, NULL, NULL, '2020-10-15 06:27:00', '2020-10-15 06:27:00');
INSERT INTO `finance_transactions` VALUES (20, NULL, 1, '310', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-02-28', NULL, NULL, NULL, '2020-10-19 11:54:47', '2020-10-19 11:54:47');
INSERT INTO `finance_transactions` VALUES (21, NULL, 1, '3690', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-01-24', NULL, NULL, NULL, '2020-10-19 11:57:30', '2020-10-19 11:57:30');
INSERT INTO `finance_transactions` VALUES (22, NULL, 1, '310', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-05', NULL, NULL, NULL, '2021-03-05 12:49:44', '2021-03-05 12:49:44');
INSERT INTO `finance_transactions` VALUES (23, NULL, 1, '49800', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 06:18:02', '2021-03-12 06:18:02');
INSERT INTO `finance_transactions` VALUES (24, NULL, 1, '110', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 06:40:21', '2021-03-12 06:40:21');
INSERT INTO `finance_transactions` VALUES (25, NULL, 1, '1705', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 06:52:46', '2021-03-12 06:52:46');
INSERT INTO `finance_transactions` VALUES (26, NULL, 1, '3880', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 07:20:57', '2021-03-12 07:20:57');
INSERT INTO `finance_transactions` VALUES (27, NULL, 1, '3880', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 07:27:15', '2021-03-12 07:27:15');
INSERT INTO `finance_transactions` VALUES (28, NULL, 1, '1110', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 07:31:31', '2021-03-12 07:31:31');
INSERT INTO `finance_transactions` VALUES (29, NULL, 1, '2590', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 10:24:41', '2021-03-12 10:24:41');
INSERT INTO `finance_transactions` VALUES (30, NULL, 1, '175', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 10:26:26', '2021-03-12 10:26:26');
INSERT INTO `finance_transactions` VALUES (31, NULL, 1, '110', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 10:34:06', '2021-03-12 10:34:06');
INSERT INTO `finance_transactions` VALUES (32, NULL, 1, '310', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 11:03:09', '2021-03-12 11:03:09');
INSERT INTO `finance_transactions` VALUES (33, NULL, 1, '2590', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 11:27:41', '2021-03-12 11:27:41');
INSERT INTO `finance_transactions` VALUES (34, NULL, 1, '0', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 11:40:29', '2021-03-12 11:40:29');
INSERT INTO `finance_transactions` VALUES (35, NULL, 1, '2305', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 11:46:24', '2021-03-12 11:46:24');
INSERT INTO `finance_transactions` VALUES (36, NULL, 1, '110', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:03:55', '2021-03-12 13:03:55');
INSERT INTO `finance_transactions` VALUES (37, NULL, 1, '660', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:07:59', '2021-03-12 13:07:59');
INSERT INTO `finance_transactions` VALUES (38, NULL, 1, '660', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:08:48', '2021-03-12 13:08:48');
INSERT INTO `finance_transactions` VALUES (39, NULL, 1, '420', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:12:40', '2021-03-12 13:12:40');
INSERT INTO `finance_transactions` VALUES (40, NULL, 1, '650', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:16:06', '2021-03-12 13:16:06');
INSERT INTO `finance_transactions` VALUES (41, NULL, 1, '310', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-12', NULL, NULL, NULL, '2021-03-12 13:17:02', '2021-03-12 13:17:02');
INSERT INTO `finance_transactions` VALUES (42, NULL, 1, '660', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-13', NULL, NULL, NULL, '2021-03-13 10:07:03', '2021-03-13 10:07:03');
INSERT INTO `finance_transactions` VALUES (43, NULL, 1, '0', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-13', NULL, NULL, NULL, '2021-03-13 10:07:25', '2021-03-13 10:07:25');
INSERT INTO `finance_transactions` VALUES (44, NULL, 1, '1490', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-20', NULL, NULL, NULL, '2021-03-20 14:25:41', '2021-03-20 14:25:41');
INSERT INTO `finance_transactions` VALUES (45, NULL, 1, '2090', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-20', NULL, NULL, NULL, '2021-03-20 14:37:54', '2021-03-20 14:37:54');
INSERT INTO `finance_transactions` VALUES (46, NULL, 1, '2090', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', NULL, NULL, NULL, '2021-03-22 13:44:20', '2021-03-22 13:44:20');
INSERT INTO `finance_transactions` VALUES (47, NULL, 1, '340', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', NULL, NULL, NULL, '2021-03-22 14:30:06', '2021-03-22 14:30:06');
INSERT INTO `finance_transactions` VALUES (48, NULL, 1, '175', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-03-22', NULL, NULL, NULL, '2021-03-22 14:36:02', '2021-03-22 14:36:02');
INSERT INTO `finance_transactions` VALUES (49, NULL, 1, '375', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', NULL, NULL, NULL, '2021-04-06 03:31:41', '2021-04-06 03:31:41');
INSERT INTO `finance_transactions` VALUES (50, NULL, 1, '110', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', NULL, NULL, NULL, '2021-04-06 03:36:28', '2021-04-06 03:36:28');
INSERT INTO `finance_transactions` VALUES (51, NULL, 1, '200', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-06', NULL, NULL, NULL, '2021-04-06 05:07:42', '2021-04-06 05:07:42');
INSERT INTO `finance_transactions` VALUES (52, NULL, 1, '775', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-08', NULL, NULL, NULL, '2021-04-08 17:35:47', '2021-04-08 17:35:47');
INSERT INTO `finance_transactions` VALUES (53, NULL, 1, '675', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-08', NULL, NULL, NULL, '2021-04-08 17:36:12', '2021-04-08 17:36:12');
INSERT INTO `finance_transactions` VALUES (54, NULL, 1, '675', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', NULL, NULL, NULL, '2021-04-09 07:27:31', '2021-04-09 07:27:31');
INSERT INTO `finance_transactions` VALUES (55, NULL, 1, '800', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', NULL, NULL, NULL, '2021-04-09 07:29:25', '2021-04-09 07:29:25');
INSERT INTO `finance_transactions` VALUES (56, NULL, 1, '1050', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-09', NULL, NULL, NULL, '2021-04-09 16:48:46', '2021-04-09 16:48:46');
INSERT INTO `finance_transactions` VALUES (57, NULL, 1, '950', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', NULL, NULL, NULL, '2021-04-10 13:45:13', '2021-04-10 13:45:13');
INSERT INTO `finance_transactions` VALUES (58, NULL, 1, '1050', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', NULL, NULL, NULL, '2021-04-10 16:01:21', '2021-04-10 16:01:21');
INSERT INTO `finance_transactions` VALUES (59, NULL, 1, '905', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', NULL, NULL, NULL, '2021-04-10 17:06:06', '2021-04-10 17:06:06');
INSERT INTO `finance_transactions` VALUES (60, NULL, 1, '1090', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-10', NULL, NULL, NULL, '2021-04-10 17:07:24', '2021-04-10 17:07:24');
INSERT INTO `finance_transactions` VALUES (61, NULL, 1, '990', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 02:29:36', '2021-04-11 02:29:36');
INSERT INTO `finance_transactions` VALUES (62, NULL, 1, '950', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 02:49:48', '2021-04-11 02:49:48');
INSERT INTO `finance_transactions` VALUES (63, NULL, 1, '83.333', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 04:01:42', '2021-04-11 04:01:42');
INSERT INTO `finance_transactions` VALUES (64, NULL, 1, '83.333', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 04:03:00', '2021-04-11 04:03:00');
INSERT INTO `finance_transactions` VALUES (65, NULL, 1, '83.333', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 04:03:57', '2021-04-11 04:03:57');
INSERT INTO `finance_transactions` VALUES (66, NULL, 1, '83.333', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 04:11:40', '2021-04-11 04:11:40');
INSERT INTO `finance_transactions` VALUES (67, NULL, 1, '715', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 17:40:47', '2021-04-11 17:40:47');
INSERT INTO `finance_transactions` VALUES (68, NULL, 1, '715', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-11', NULL, NULL, NULL, '2021-04-11 17:52:03', '2021-04-11 17:52:03');
INSERT INTO `finance_transactions` VALUES (69, NULL, 1, '605', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 01:16:41', '2021-04-12 01:16:41');
INSERT INTO `finance_transactions` VALUES (70, NULL, 1, '605', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 01:19:09', '2021-04-12 01:19:09');
INSERT INTO `finance_transactions` VALUES (71, NULL, 1, '1615', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 17:33:37', '2021-04-12 17:33:37');
INSERT INTO `finance_transactions` VALUES (72, NULL, 1, '215', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 17:34:45', '2021-04-12 17:34:45');
INSERT INTO `finance_transactions` VALUES (73, NULL, 1, '215', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 17:35:23', '2021-04-12 17:35:23');
INSERT INTO `finance_transactions` VALUES (74, NULL, 1, '215', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 17:36:32', '2021-04-12 17:36:32');
INSERT INTO `finance_transactions` VALUES (75, NULL, 1, '215', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-12', NULL, NULL, NULL, '2021-04-12 17:36:32', '2021-04-12 17:36:32');
INSERT INTO `finance_transactions` VALUES (76, NULL, 1, '85', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', NULL, NULL, NULL, '2021-04-13 05:06:17', '2021-04-13 05:06:17');
INSERT INTO `finance_transactions` VALUES (77, NULL, 1, '4055', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', NULL, NULL, NULL, '2021-04-13 15:28:42', '2021-04-13 15:28:42');
INSERT INTO `finance_transactions` VALUES (78, NULL, 1, '165', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-13', NULL, NULL, NULL, '2021-04-13 15:36:59', '2021-04-13 15:36:59');
INSERT INTO `finance_transactions` VALUES (79, NULL, 1, '410', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', NULL, NULL, NULL, '2021-04-13 21:41:16', '2021-04-13 21:41:16');
INSERT INTO `finance_transactions` VALUES (82, NULL, 1, '165', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', NULL, NULL, NULL, '2021-04-14 16:15:33', '2021-04-14 16:15:33');
INSERT INTO `finance_transactions` VALUES (83, NULL, 1, '75', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', NULL, NULL, NULL, '2021-04-14 16:17:30', '2021-04-14 16:17:30');
INSERT INTO `finance_transactions` VALUES (84, NULL, 1, '200', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-14', NULL, NULL, NULL, '2021-04-14 16:37:09', '2021-04-14 16:37:09');
INSERT INTO `finance_transactions` VALUES (85, NULL, 1, '275', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-15', NULL, NULL, NULL, '2021-04-14 20:39:45', '2021-04-14 20:39:45');
INSERT INTO `finance_transactions` VALUES (86, NULL, 1, '139', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-04-15', NULL, NULL, NULL, '2021-04-14 21:07:53', '2021-04-14 21:07:53');
INSERT INTO `finance_transactions` VALUES (87, NULL, 1, '740', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2021-07-03', NULL, NULL, NULL, '2021-07-03 13:48:19', '2021-07-03 13:48:19');
INSERT INTO `finance_transactions` VALUES (88, NULL, 1, '350', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-07-23', NULL, NULL, NULL, '2022-07-23 08:15:27', '2022-07-23 08:15:27');
INSERT INTO `finance_transactions` VALUES (89, NULL, 1, '70', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-18', NULL, NULL, NULL, '2022-10-18 15:22:39', '2022-10-18 15:22:39');
INSERT INTO `finance_transactions` VALUES (90, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 06:59:00', '2022-10-24 06:59:00');
INSERT INTO `finance_transactions` VALUES (91, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 06:59:26', '2022-10-24 06:59:26');
INSERT INTO `finance_transactions` VALUES (92, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:02:13', '2022-10-24 07:02:13');
INSERT INTO `finance_transactions` VALUES (93, NULL, 1, '205', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:03:42', '2022-10-24 07:03:42');
INSERT INTO `finance_transactions` VALUES (94, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:13:06', '2022-10-24 07:13:06');
INSERT INTO `finance_transactions` VALUES (95, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:14:39', '2022-10-24 07:14:39');
INSERT INTO `finance_transactions` VALUES (96, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:16:11', '2022-10-24 07:16:11');
INSERT INTO `finance_transactions` VALUES (97, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:19:20', '2022-10-24 07:19:20');
INSERT INTO `finance_transactions` VALUES (98, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 07:19:55', '2022-10-24 07:19:55');
INSERT INTO `finance_transactions` VALUES (99, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 09:17:34', '2022-10-24 09:17:34');
INSERT INTO `finance_transactions` VALUES (100, NULL, 1, '185', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 09:18:13', '2022-10-24 09:18:13');
INSERT INTO `finance_transactions` VALUES (101, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 09:37:13', '2022-10-24 09:37:13');
INSERT INTO `finance_transactions` VALUES (102, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-24', NULL, NULL, NULL, '2022-10-24 09:37:26', '2022-10-24 09:37:26');
INSERT INTO `finance_transactions` VALUES (103, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', NULL, NULL, NULL, '2022-10-25 07:41:16', '2022-10-25 07:41:16');
INSERT INTO `finance_transactions` VALUES (104, NULL, 1, '195', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', NULL, NULL, NULL, '2022-10-25 07:41:53', '2022-10-25 07:41:53');
INSERT INTO `finance_transactions` VALUES (105, NULL, 1, '205', '', NULL, NULL, NULL, NULL, NULL, 'Payroll', NULL, '2022-10-25', NULL, NULL, NULL, '2022-10-25 07:42:42', '2022-10-25 07:42:42');
COMMIT;

-- ----------------------------
-- Table structure for finance_transfers
-- ----------------------------
DROP TABLE IF EXISTS `finance_transfers`;
CREATE TABLE `finance_transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `from_account_id` bigint(20) unsigned DEFAULT NULL,
  `to_account_id` bigint(20) unsigned DEFAULT NULL,
  `amount` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `payment_method_id` bigint(20) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_transfers_company_id_foreign` (`company_id`),
  KEY `finance_transfers_from_account_id_foreign` (`from_account_id`),
  KEY `finance_transfers_to_account_id_foreign` (`to_account_id`),
  KEY `finance_transfers_payment_method_id_foreign` (`payment_method_id`),
  CONSTRAINT `finance_transfers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transfers_from_account_id_foreign` FOREIGN KEY (`from_account_id`) REFERENCES `finance_bank_cashes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transfers_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  CONSTRAINT `finance_transfers_to_account_id_foreign` FOREIGN KEY (`to_account_id`) REFERENCES `finance_bank_cashes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of finance_transfers
-- ----------------------------
BEGIN;
INSERT INTO `finance_transfers` VALUES (1, NULL, 1, 2, '2000', '6736', NULL, 1, '2021-03-30', '2020-07-29 05:36:41', '2020-07-29 05:36:41');
COMMIT;

-- ----------------------------
-- Table structure for general_settings
-- ----------------------------
DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_payment_bank` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of general_settings
-- ----------------------------
BEGIN;
INSERT INTO `general_settings` VALUES (1, 'PeoplePro', 'logo.png', 'Asia/Dhaka', '$', 'prefix', '1', 'd-m-Y', 'default.css', 'LionCoders', 'https://www.lion-coders.com', '2020-07-25 19:00:00', '2022-08-01 10:18:08');
COMMIT;

-- ----------------------------
-- Table structure for goal_trackings
-- ----------------------------
DROP TABLE IF EXISTS `goal_trackings`;
CREATE TABLE `goal_trackings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `goal_type_id` bigint(20) unsigned NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_achievement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of goal_trackings
-- ----------------------------
BEGIN;
INSERT INTO `goal_trackings` VALUES (1, 1, 1, 'Testing-1 Subject', 'Testing-1 Achievement', 'Testing-1 Description', '01/17/2021', '01/18/2021', 38, 'In Progress', '2021-01-17 05:14:15', '2021-01-17 05:14:39');
INSERT INTO `goal_trackings` VALUES (2, 2, 2, 'Testing-2 Subject', 'Testing-2 Achievement', 'Testing-2 Description', '01/19/2021', '01/20/2021', 52, 'In Progress', '2021-01-17 05:15:33', '2021-01-17 05:18:11');
INSERT INTO `goal_trackings` VALUES (4, 1, 3, 'Testing-3 Subject', 'Testing-3 Achievement', 'Testing 3 Description', '01/21/2021', '01/22/2021', 90, 'Completed', '2021-01-17 05:16:28', '2021-01-17 05:18:21');
COMMIT;

-- ----------------------------
-- Table structure for goal_types
-- ----------------------------
DROP TABLE IF EXISTS `goal_types`;
CREATE TABLE `goal_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `goal_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of goal_types
-- ----------------------------
BEGIN;
INSERT INTO `goal_types` VALUES (1, 'Event Goal', '2021-01-17 04:14:44', '2021-01-17 04:14:44');
INSERT INTO `goal_types` VALUES (2, 'Success Goal', '2021-01-17 04:14:58', '2021-01-17 04:14:58');
INSERT INTO `goal_types` VALUES (3, 'Complete', '2021-01-17 04:40:18', '2021-01-17 04:40:18');
COMMIT;

-- ----------------------------
-- Table structure for holidays
-- ----------------------------
DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_publish` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `holidays_company_id_foreign` (`company_id`),
  KEY `holidays_department_id_foreign` (`department_id`),
  CONSTRAINT `holidays_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `holidays_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of holidays
-- ----------------------------
BEGIN;
INSERT INTO `holidays` VALUES (1, 'Eid Ul Adha', 'ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum q', 1, NULL, '2021-03-30', '2021-04-01', 1, '2020-07-27 18:07:35', '2020-07-27 18:07:35');
COMMIT;

-- ----------------------------
-- Table structure for indicators
-- ----------------------------
DROP TABLE IF EXISTS `indicators`;
CREATE TABLE `indicators` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `designation_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `customer_experience` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `professionalism` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `integrity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of indicators
-- ----------------------------
BEGIN;
INSERT INTO `indicators` VALUES (1, 1, 2, 1, 'None', 'Beginner', 'Intermidiate', 'Expert/Leader', 'Advanced', 'Advanced', 'admin', '2021-01-17 06:16:32', '2021-01-17 06:16:32');
INSERT INTO `indicators` VALUES (2, 1, 3, 2, 'None', 'Beginner', 'Intermidiate', 'Advanced', 'Advanced', 'Expert/Leader', 'admin', '2021-01-17 06:17:10', '2021-01-17 06:17:10');
INSERT INTO `indicators` VALUES (3, 2, 7, 5, 'Advanced', 'Advanced', 'Beginner', 'Beginner', 'Intermidiate', 'Advanced', 'admin', '2021-01-17 06:17:54', '2021-01-17 06:17:54');
COMMIT;

-- ----------------------------
-- Table structure for invoice_items
-- ----------------------------
DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE `invoice_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_tax_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_tax_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_qty` bigint(20) NOT NULL DEFAULT '0',
  `item_unit_price` bigint(20) NOT NULL,
  `item_sub_total` double NOT NULL,
  `sub_total` double NOT NULL,
  `discount_type` tinyint(4) DEFAULT NULL,
  `discount_figure` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_discount` double NOT NULL,
  `grand_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_items_project_id_foreign` (`project_id`),
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoice_items_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of invoice_items
-- ----------------------------
BEGIN;
INSERT INTO `invoice_items` VALUES (1, 1, 1, 'a', '$0', '0', 4, 30, 120, 225, 0, 10, 5, 10, 225, NULL, '2021-12-15 06:59:38');
INSERT INTO `invoice_items` VALUES (2, 1, 1, 'b', '5', '5', 2, 50, 105, 225, 0, 10, 5, 10, 225, '2020-07-28 16:43:24', '2021-12-15 06:59:38');
INSERT INTO `invoice_items` VALUES (3, 2, 2, 'z', '$0', '0', 1, 10, 10, 10, 0, 0, 0, 0, 10, NULL, '2020-07-28 16:52:54');
INSERT INTO `invoice_items` VALUES (7, 5, 3, 'aa', '$0', '0', 12, 20, 240, 240, 1, 20, 0, 48, 192, NULL, '2021-06-17 04:35:42');
INSERT INTO `invoice_items` VALUES (8, 6, 2, 'item1', '$0', '0', 1, 10, 10, 10, 0, 0, 0, 0, 10, NULL, '2021-06-17 04:33:45');
INSERT INTO `invoice_items` VALUES (9, 6, 2, 'item2', '$0', '0', 1, 0, 0, 10, 0, 0, 0, 0, 10, NULL, '2021-06-17 04:33:45');
INSERT INTO `invoice_items` VALUES (10, 7, 2, 'amarnam', '$0', '0', 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `invoice_items` VALUES (11, 6, 2, 'item3', '$0', '0', 1, 0, 0, 10, 0, 0, 0, 0, 10, '2021-06-17 04:34:12', '2021-06-17 04:34:12');
COMMIT;

-- ----------------------------
-- Table structure for invoices
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `invoice_due_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `discount_type` tinyint(4) DEFAULT NULL,
  `discount_figure` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_discount` double NOT NULL,
  `grand_total` double NOT NULL,
  `invoice_note` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_client_id_foreign` (`client_id`),
  KEY `invoices_project_id_foreign` (`project_id`),
  CONSTRAINT `invoices_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `invoices_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of invoices
-- ----------------------------
BEGIN;
INSERT INTO `invoices` VALUES (1, 'INV-xnL5K2', 16, 1, '2021-03-29', '2021-04-09', 225, 0, 10, 5, 10, 225, 'Thanks', 1, '2020-07-28 16:37:47', '2021-12-15 06:59:38');
INSERT INTO `invoices` VALUES (2, 'INV-NleUqw', 16, 2, '2021-03-26', '2021-04-05', 10, 0, 0, 0, 0, 10, 'Thanks', 2, '2020-07-28 16:48:59', '2020-10-18 03:32:59');
INSERT INTO `invoices` VALUES (5, 'INV-IjAIYl', 16, 3, '2021-03-29', '2021-04-03', 240, 1, 20, 0, 48, 192, '', 1, '2020-10-12 07:49:25', '2021-06-17 04:35:42');
INSERT INTO `invoices` VALUES (6, 'INV-jbd7aR', 16, 2, '2021-06-01', '2021-06-30', 10, 0, 0, 0, 0, 10, '', 0, '2021-06-17 03:06:33', '2021-06-17 04:33:45');
INSERT INTO `invoices` VALUES (7, 'INV-GVnNa4', 16, 2, '2021-06-10', '2021-06-22', 0, 0, 0, 0, 0, 0, '', 0, '2021-06-17 04:32:20', '2021-06-17 04:32:20');
COMMIT;

-- ----------------------------
-- Table structure for ip_settings
-- ----------------------------
DROP TABLE IF EXISTS `ip_settings`;
CREATE TABLE `ip_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ip_settings
-- ----------------------------
BEGIN;
INSERT INTO `ip_settings` VALUES (1, 'FNF', '103.120.140.1', '2021-03-28 14:34:42', '2021-03-28 16:57:27');
INSERT INTO `ip_settings` VALUES (14, 'Lion-Coders', '127.54.03.1', '2021-03-28 16:58:02', '2021-03-28 16:58:02');
INSERT INTO `ip_settings` VALUES (15, 'Local', '127.0.0.2', '2021-03-28 17:26:13', '2021-03-29 05:39:40');
INSERT INTO `ip_settings` VALUES (16, 'XYZ', '103.161.152.57', '2021-07-05 03:36:35', '2021-08-01 13:04:10');
COMMIT;

-- ----------------------------
-- Table structure for job_candidates
-- ----------------------------
DROP TABLE IF EXISTS `job_candidates`;
CREATE TABLE `job_candidates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `cover_letter` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_candidates_job_id_foreign` (`job_id`),
  CONSTRAINT `job_candidates_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_posts` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_candidates
-- ----------------------------
BEGIN;
INSERT INTO `job_candidates` VALUES (1, 1, 'John Stones', 'john_stones@gmail.com', '', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rhoncus, quam et ultricies vulputate, mauris arcu viverra ipsum, nec interdum dui ipsum id elit. Vivamus vehicula posuere commodo. Curabitur consectetur lacus nisi. Mauris vitae pulvinar lacus. Vestibulum malesuada felis magna, in convallis tortor lobortis ac.', 'jonh@fb.com', 'john_stones', 'JohnStones_1603445937.pdf', 'applied', '', '2020-10-23 06:38:57', '2020-10-23 06:38:57');
COMMIT;

-- ----------------------------
-- Table structure for job_categories
-- ----------------------------
DROP TABLE IF EXISTS `job_categories`;
CREATE TABLE `job_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_category` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_categories
-- ----------------------------
BEGIN;
INSERT INTO `job_categories` VALUES (2, 'PHP', 'xdBCMHJABdhRlMqXkA0G');
INSERT INTO `job_categories` VALUES (3, 'Seo', 'YoHOIZmN5jdNLG6gMp3x');
INSERT INTO `job_categories` VALUES (5, 'Analyst', 'gDCJcrUn9M7tt5xVK3wh');
COMMIT;

-- ----------------------------
-- Table structure for job_interviews
-- ----------------------------
DROP TABLE IF EXISTS `job_interviews`;
CREATE TABLE `job_interviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint(20) unsigned NOT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `interview_place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interview_date` date NOT NULL,
  `interview_time` time NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_interviews_job_id_foreign` (`job_id`),
  KEY `job_interviews_added_by_foreign` (`added_by`),
  CONSTRAINT `job_interviews_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `job_interviews_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_interviews
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for job_posts
-- ----------------------------
DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE `job_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `job_category_id` bigint(20) unsigned NOT NULL,
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_vacancy` int(11) NOT NULL,
  `job_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_experience` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_featured` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_posts_job_category_id_foreign` (`job_category_id`),
  KEY `job_posts_company_id_foreign` (`company_id`),
  CONSTRAINT `job_posts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_posts_job_category_id_foreign` FOREIGN KEY (`job_category_id`) REFERENCES `job_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_posts
-- ----------------------------
BEGIN;
INSERT INTO `job_posts` VALUES (1, 1, 2, 'Laravel Developer', 'full_time', 2, 'qPnZoMWx83Qb0YnTVl5F', 'No Preference', '2 Years', 'Lion-Coders is looking for Intermediate level Software Developers (3) for its Laravel based software developments. The primary role of these developers will be to develop/debug new desktop/xamarin/web applications for its overseas clients.', '&lt;p&gt;&amp;bull; Should have experience in working on framework such as Laravel,&lt;br /&gt;Symphony etc&lt;br /&gt;&amp;bull; Excellent working knowledge of Web application development&lt;br /&gt;&amp;bull; Advance coding Skills in PHP, HTML, CSS, JavaScript, and scripting&lt;br /&gt;languages desirable&lt;br /&gt;&amp;bull; Excellent working knowledge of MySQL database&lt;br /&gt;&amp;bull; Good understanding of database performance tuning and sql queries&lt;br /&gt;&amp;bull; Experience working with a PHP framework such as CodeIgniter/Laravel&lt;br /&gt;&amp;bull; Experience in both Front End / Back End Developer.&lt;br /&gt;&amp;bull; Good Knowledge and understanding of CRM, CMS, SHOPPING-CART,&lt;br /&gt;PAYMENT GATEWAY &amp;amp; other API INTEGRATION&lt;/p&gt;', '2021-03-06', 1, 1, '2021-02-22 00:00:00', '2021-03-24 01:46:04');
INSERT INTO `job_posts` VALUES (2, 1, 5, 'Business Analyst', 'part_time', 3, 'OhBIUt70qzUGfzfWifEI', 'Male', '5 Years', 'Business analysts work with organizations to help them improve their processes and systems. They conduct research and analysis in order to come up with solutions to business problems and help to introduce these systems to businesses and their clients.', '&lt;p&gt;Important skills needed :&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;Oral and written communication skills&lt;/li&gt;\r\n&lt;li&gt;nterpersonal and consultative skills&lt;/li&gt;\r\n&lt;li&gt;Facilitation skills&lt;/li&gt;\r\n&lt;li&gt;Analytical thinking and problem solving&lt;/li&gt;\r\n&lt;li&gt;Being detail-oriented and capable of delivering a high level of accuracy&lt;/li&gt;\r\n&lt;li&gt;Organizational skills&lt;/li&gt;\r\n&lt;/ul&gt;', '2021-03-03', 1, 1, '2021-02-23 00:00:00', '2021-03-24 01:46:46');
INSERT INTO `job_posts` VALUES (3, 2, 3, 'SEO Specialist', 'full_time', 5, 'nPJh3pew9HpyzdRlGDj2', 'Other', 'Fresh', 'A Search Engine Optimization Specialist is responsible for analyzing, reviewing and implementing websites that are optimized to be picked up by search engines. An SEO specialist will develop content to include keywords or phrases in order to increase traffic to the website.', '&lt;p&gt;The job of an &lt;strong&gt;SEO&lt;/strong&gt; specialist doesn&amp;rsquo;t stop with a couple of website tweaks and a few links scattered around the internet. Instead, the &lt;span style=&quot;background-color: #e03e2d;&quot;&gt;&lt;strong&gt;specialist&lt;/strong&gt;&lt;/span&gt; has to be on the ball, constantly looking for trends like those noted above and finding new ways to maximize &lt;em&gt;website&lt;/em&gt; traffic.&lt;/p&gt;', '2021-03-06', 1, 1, '2021-02-23 00:00:00', '2021-03-24 01:47:51');
COMMIT;

-- ----------------------------
-- Table structure for leave_types
-- ----------------------------
DROP TABLE IF EXISTS `leave_types`;
CREATE TABLE `leave_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allocated_day` int(11) DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_types_company_id_foreign` (`company_id`),
  CONSTRAINT `leave_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of leave_types
-- ----------------------------
BEGIN;
INSERT INTO `leave_types` VALUES (1, 'Medical', 5, NULL, '2020-07-26 20:18:04', '2021-12-15 05:46:01');
INSERT INTO `leave_types` VALUES (2, 'Casual', 3, NULL, '2020-07-26 20:18:39', '2020-07-26 20:18:39');
INSERT INTO `leave_types` VALUES (3, 'Manual', NULL, NULL, '2020-07-26 20:18:48', '2020-07-26 20:18:48');
COMMIT;

-- ----------------------------
-- Table structure for leaves
-- ----------------------------
DROP TABLE IF EXISTS `leaves`;
CREATE TABLE `leaves` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `leave_type_id` bigint(20) unsigned DEFAULT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `department_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `leave_reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_half` tinyint(4) DEFAULT '0',
  `is_notify` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leaves_company_id_foreign` (`company_id`),
  KEY `leaves_employee_id_foreign` (`employee_id`),
  KEY `leaves_leave_type_id_foreign` (`leave_type_id`),
  KEY `leaves_department_id_foreign` (`department_id`),
  CONSTRAINT `leaves_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leaves_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of leaves
-- ----------------------------
BEGIN;
INSERT INTO `leaves` VALUES (1, 3, 1, 1, 9, '2021-02-14', '2021-02-15', 2, 'tem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatu', 'tem vel eum iure reprehenderit qui in ea', 'approved', NULL, 1, '2020-07-27 18:40:11', '2020-07-27 18:40:11');
INSERT INTO `leaves` VALUES (4, 3, 1, 1, 9, '2021-04-08', '2021-04-10', 3, 'Sick', '', 'approved', NULL, NULL, '2021-04-07 10:32:57', '2021-04-07 13:19:53');
INSERT INTO `leaves` VALUES (6, 3, 1, 1, 9, '2021-04-11', '2021-04-14', 4, '', '', 'approved', NULL, NULL, '2021-04-07 14:45:38', '2021-04-07 14:45:38');
INSERT INTO `leaves` VALUES (7, 3, 1, 1, NULL, '2021-07-28', '2021-07-29', 2, '', '', 'approved', NULL, NULL, '2021-07-29 03:24:40', '2021-07-29 03:24:40');
INSERT INTO `leaves` VALUES (8, 3, 1, 1, 9, '2021-07-27', '2021-07-29', 3, '', '', 'approved', NULL, NULL, '2021-07-29 03:27:08', '2021-07-29 03:27:08');
INSERT INTO `leaves` VALUES (9, 3, 1, 1, NULL, '2021-08-02', '2021-08-03', 2, '', '', 'approved', NULL, NULL, '2021-08-01 06:33:29', '2021-08-01 06:33:29');
INSERT INTO `leaves` VALUES (10, 1, 1, 1, NULL, '2021-08-04', '2021-08-05', 2, '', '', 'approved', NULL, NULL, '2021-08-02 22:32:03', '2021-08-02 22:32:03');
INSERT INTO `leaves` VALUES (12, 1, 1, 1, NULL, '2021-08-04', '2021-08-06', 3, '', '', 'approved', NULL, NULL, '2021-08-02 22:36:08', '2021-08-02 22:36:08');
INSERT INTO `leaves` VALUES (13, 3, 1, 1, NULL, '2021-08-01', '2021-08-03', 3, '', '', 'approved', NULL, NULL, '2021-08-04 19:08:11', '2021-08-04 19:08:11');
INSERT INTO `leaves` VALUES (15, 3, 1, 1, 9, '2021-08-11', '2021-08-13', 3, 'test', '', 'approved', NULL, NULL, '2021-08-05 00:50:50', '2021-08-05 00:51:16');
INSERT INTO `leaves` VALUES (16, 3, 1, 1, 27, '2021-10-05', '2021-10-06', 2, '', '', 'approved', NULL, NULL, '2021-10-04 01:00:33', '2021-10-04 01:00:33');
INSERT INTO `leaves` VALUES (17, 3, 1, 1, 27, '2021-10-09', '2021-10-10', 2, '', '', 'approved', NULL, 1, '2021-10-04 01:11:30', '2021-10-04 01:11:30');
INSERT INTO `leaves` VALUES (18, 3, 1, 1, 27, '2021-10-12', '2021-10-13', 2, '', NULL, 'pending', NULL, NULL, '2021-10-04 01:15:58', '2021-10-04 01:15:58');
INSERT INTO `leaves` VALUES (19, 3, 1, 1, 27, '2021-10-12', '2021-10-13', 2, '', NULL, 'pending', NULL, NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `leaves` VALUES (20, 3, 1, 1, 27, '2021-10-14', '2021-10-15', 2, '', NULL, 'pending', NULL, NULL, '2021-10-04 01:21:08', '2021-10-04 01:21:08');
INSERT INTO `leaves` VALUES (21, 3, 1, 1, 27, '2021-10-14', '2021-10-15', 2, '', NULL, 'pending', NULL, NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `leaves` VALUES (22, 3, 1, 1, 27, '2021-10-21', '2021-10-22', 2, 'Test', NULL, 'pending', NULL, NULL, '2021-10-04 04:08:51', '2021-10-04 04:08:51');
INSERT INTO `leaves` VALUES (23, 3, 1, 1, 27, '2021-10-21', '2021-10-22', 2, 'Test', NULL, 'pending', NULL, NULL, '2021-10-04 04:09:00', '2021-10-04 04:09:00');
INSERT INTO `leaves` VALUES (24, 3, 1, 1, 27, '2021-10-21', '2021-10-22', 2, 'Test', NULL, 'pending', NULL, NULL, '2021-10-04 04:09:04', '2021-10-04 04:09:04');
INSERT INTO `leaves` VALUES (25, 3, 1, 1, 27, '2021-10-21', '2021-10-22', 2, 'Test', NULL, 'pending', NULL, NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
COMMIT;

-- ----------------------------
-- Table structure for locations
-- ----------------------------
DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_head` bigint(20) unsigned DEFAULT NULL,
  `address1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` int(10) unsigned DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locations_location_head_foreign` (`location_head`),
  KEY `locations_country_foreign` (`country`),
  CONSTRAINT `locations_country_foreign` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `locations_location_head_foreign` FOREIGN KEY (`location_head`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of locations
-- ----------------------------
BEGIN;
INSERT INTO `locations` VALUES (1, 'Boston', NULL, '22,westwood', NULL, 'Boston', 'New Boston', 2, 7678, '2020-07-26 18:12:19', '2020-07-26 18:12:19');
INSERT INTO `locations` VALUES (2, 'sydney ranger', 11, 'Waca,22 bekar street', NULL, 'sydney', 'West Australia', 15, 9890, '2020-07-26 18:21:12', '2020-07-27 09:14:58');
COMMIT;

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `meeting_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_note` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_notify` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meetings_company_id_foreign` (`company_id`),
  CONSTRAINT `meetings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of meetings
-- ----------------------------
BEGIN;
INSERT INTO `meetings` VALUES (1, 1, 'Project Vision', 'm et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod', '2021-04-01', '03:20PM', 'pending', 1, '2020-07-28 14:31:11', '2020-07-28 14:31:11');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES (1, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_02_09_103616_create_role_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_02_10_00000_create_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_02_12_091317_create_locations_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_02_12_091344_create_companies_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_02_12_091353_create_departments_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_02_12_091742_create_statuses_table', 1);
INSERT INTO `migrations` VALUES (9, '2020_02_12_091824_create_office_shifts_table', 1);
INSERT INTO `migrations` VALUES (10, '2020_02_12_091936_create_designations_table', 1);
INSERT INTO `migrations` VALUES (11, '2020_02_12_092121_create_leave_types_table', 1);
INSERT INTO `migrations` VALUES (12, '2020_02_13_100750_create_employees_table', 1);
INSERT INTO `migrations` VALUES (13, '2020_02_14_092309_create_leaves_table', 1);
INSERT INTO `migrations` VALUES (14, '2020_02_20_115449_create_general_settings_table', 1);
INSERT INTO `migrations` VALUES (15, '2020_02_23_054028_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (16, '2020_02_23_184712_add_columns_to_permission_table', 1);
INSERT INTO `migrations` VALUES (17, '2020_03_19_132718_add_employee_id_on_locations_table', 2);
INSERT INTO `migrations` VALUES (18, '2020_03_20_162201_create_announcements_table', 2);
INSERT INTO `migrations` VALUES (19, '2020_03_20_201357_create_policies_table', 2);
INSERT INTO `migrations` VALUES (20, '2020_03_22_113701_create_holidays_table', 2);
INSERT INTO `migrations` VALUES (21, '2020_03_23_100213_create_award_types_table', 3);
INSERT INTO `migrations` VALUES (22, '2020_03_23_100248_create_awards_table', 3);
INSERT INTO `migrations` VALUES (23, '2020_03_23_123604_create_transfers_table', 3);
INSERT INTO `migrations` VALUES (24, '2020_03_23_144135_create_resignations_table', 3);
INSERT INTO `migrations` VALUES (25, '2020_03_23_150510_create_travel_types_table', 3);
INSERT INTO `migrations` VALUES (26, '2020_03_23_152610_create_travels_table', 3);
INSERT INTO `migrations` VALUES (27, '2020_03_23_154228_create_promotions_table', 3);
INSERT INTO `migrations` VALUES (28, '2020_03_23_194844_create_complaints_table', 3);
INSERT INTO `migrations` VALUES (29, '2020_03_24_134301_create_warnings_type_table', 3);
INSERT INTO `migrations` VALUES (30, '2020_03_24_134304_create_warnings_table', 3);
INSERT INTO `migrations` VALUES (31, '2020_03_24_143012_create_termination_types_table', 3);
INSERT INTO `migrations` VALUES (32, '2020_03_24_143038_create_terminations_table', 3);
INSERT INTO `migrations` VALUES (33, '2020_04_06_185530_create_training_types_table', 3);
INSERT INTO `migrations` VALUES (34, '2020_04_06_190352_create_trainers_table', 3);
INSERT INTO `migrations` VALUES (35, '2020_04_07_083717_create_training_lists_table', 3);
INSERT INTO `migrations` VALUES (36, '2020_04_07_103503_create_employee_training_list_table', 3);
INSERT INTO `migrations` VALUES (37, '2020_04_08_095050_create_events_table', 3);
INSERT INTO `migrations` VALUES (38, '2020_04_08_163144_create_meetings_table', 3);
INSERT INTO `migrations` VALUES (39, '2020_04_08_163906_create_employee_meeting_table', 3);
INSERT INTO `migrations` VALUES (40, '2020_05_05_212429_create_document_types_table', 3);
INSERT INTO `migrations` VALUES (41, '2020_04_09_063646_create_finance_bank_cashes_table', 4);
INSERT INTO `migrations` VALUES (42, '2020_04_09_154642_create_finance_payees_table', 4);
INSERT INTO `migrations` VALUES (43, '2020_04_09_201357_create_finance_payers_table', 4);
INSERT INTO `migrations` VALUES (44, '2020_04_10_064405_create_payment_methods_table', 4);
INSERT INTO `migrations` VALUES (45, '2020_04_10_094429_create_expense_types_table', 4);
INSERT INTO `migrations` VALUES (46, '2020_04_10_121829_create_finance_deposits_table', 4);
INSERT INTO `migrations` VALUES (47, '2020_04_11_084040_create_finance_expenses_table', 4);
INSERT INTO `migrations` VALUES (48, '2020_04_11_164442_create_finance_transactions_table', 4);
INSERT INTO `migrations` VALUES (49, '2020_04_13_071336_create_finance_transfers_table', 4);
INSERT INTO `migrations` VALUES (50, '2020_04_13_135659_create_asset_categories_table', 5);
INSERT INTO `migrations` VALUES (51, '2020_04_13_160310_create_assets_table', 5);
INSERT INTO `migrations` VALUES (52, '2020_04_15_103730_create_file_manager_settings_table', 5);
INSERT INTO `migrations` VALUES (53, '2020_04_15_193003_create_file_managers_table', 5);
INSERT INTO `migrations` VALUES (54, '2020_04_18_094856_create_support_tickets_table', 5);
INSERT INTO `migrations` VALUES (55, '2020_04_21_052227_create_ticket_comments_table', 5);
INSERT INTO `migrations` VALUES (56, '2020_04_21_172758_create_employee_support_ticket_table', 5);
INSERT INTO `migrations` VALUES (57, '2020_04_24_070148_create_countries_table', 5);
INSERT INTO `migrations` VALUES (58, '2020_04_24_071350_create_clients_table', 5);
INSERT INTO `migrations` VALUES (59, '2020_04_25_083125_create_projects_table', 5);
INSERT INTO `migrations` VALUES (60, '2020_04_25_092544_create_employee_project_table', 5);
INSERT INTO `migrations` VALUES (61, '2020_04_27_132031_create_project_discussions_table', 5);
INSERT INTO `migrations` VALUES (62, '2020_04_27_202219_create_project_bugs_table', 5);
INSERT INTO `migrations` VALUES (63, '2020_04_28_095459_create_project_files_table', 5);
INSERT INTO `migrations` VALUES (64, '2020_04_28_172850_create_tasks_table', 5);
INSERT INTO `migrations` VALUES (65, '2020_04_28_183034_create_employee_task_table', 5);
INSERT INTO `migrations` VALUES (66, '2020_04_29_164820_create_task_discussions_table', 5);
INSERT INTO `migrations` VALUES (67, '2020_04_29_185015_create_task_files_table', 5);
INSERT INTO `migrations` VALUES (68, '2020_05_01_093124_create_tax_types_table', 5);
INSERT INTO `migrations` VALUES (69, '2020_05_02_100902_create_invoices_table', 5);
INSERT INTO `migrations` VALUES (70, '2020_05_02_110310_create_invoice_items_table', 5);
INSERT INTO `migrations` VALUES (71, '2020_05_06_085438_create_employee_immigrations_table', 6);
INSERT INTO `migrations` VALUES (72, '2020_05_07_191655_create_employee_contacts_table', 6);
INSERT INTO `migrations` VALUES (73, '2020_05_08_181821_create_employee_documents_table', 6);
INSERT INTO `migrations` VALUES (74, '2020_05_12_200437_create_qualification_education_levels_table', 6);
INSERT INTO `migrations` VALUES (75, '2020_05_16_204859_create_qualification_languages_table', 6);
INSERT INTO `migrations` VALUES (76, '2020_05_17_181817_create_qualification_skills_table', 6);
INSERT INTO `migrations` VALUES (77, '2020_05_17_191414_create_employee_qualificaitons_table', 6);
INSERT INTO `migrations` VALUES (78, '2020_05_18_191844_create_employee_work_experience_table', 6);
INSERT INTO `migrations` VALUES (79, '2020_05_19_170527_create_employee_bank_accounts_table', 6);
INSERT INTO `migrations` VALUES (80, '2020_05_22_201218_create_salary_allowances_table', 6);
INSERT INTO `migrations` VALUES (81, '2020_05_23_184036_create_salary_commissions_table', 6);
INSERT INTO `migrations` VALUES (82, '2020_05_24_085740_create_salary_deductions_table', 6);
INSERT INTO `migrations` VALUES (83, '2020_05_24_103950_create_salary_other_payments_table', 6);
INSERT INTO `migrations` VALUES (84, '2020_05_24_163618_create_salary_overtimes_table', 6);
INSERT INTO `migrations` VALUES (85, '2020_05_26_134431_create_salary_loans_table', 6);
INSERT INTO `migrations` VALUES (86, '2020_06_11_104501_create_payslips_table', 7);
INSERT INTO `migrations` VALUES (87, '2020_06_17_055449_create_calendarables_table', 7);
INSERT INTO `migrations` VALUES (88, '2020_06_19_083329_create_job_categories_table', 7);
INSERT INTO `migrations` VALUES (89, '2020_06_19_152528_create_job_employers_table', 7);
INSERT INTO `migrations` VALUES (90, '2020_06_22_052056_create_attendances_table', 7);
INSERT INTO `migrations` VALUES (91, '2020_07_05_010713_create_job_posts_table', 7);
INSERT INTO `migrations` VALUES (92, '2020_07_06_162706_create_job_candidates_table', 7);
INSERT INTO `migrations` VALUES (93, '2020_07_07_144320_create_job_interviews_table', 7);
INSERT INTO `migrations` VALUES (94, '2020_07_07_160007_create_candidate_interview_table', 7);
INSERT INTO `migrations` VALUES (95, '2020_07_07_160428_create_employee_interview_table', 7);
INSERT INTO `migrations` VALUES (96, '2020_07_25_003500_create_official_documents_table', 7);
INSERT INTO `migrations` VALUES (97, '2020_04_18_203257_create_notifications_table', 8);
INSERT INTO `migrations` VALUES (98, '2020_10_16_202848_create_c_m_s_table', 9);
INSERT INTO `migrations` VALUES (99, '2018_08_29_200844_create_languages_table', 10);
INSERT INTO `migrations` VALUES (100, '2018_08_29_205156_create_translations_table', 10);
INSERT INTO `migrations` VALUES (101, '2021_01_08_072901_create_goal_types_table', 10);
INSERT INTO `migrations` VALUES (102, '2021_01_08_165133_create_indicators_table', 10);
INSERT INTO `migrations` VALUES (103, '2021_01_09_081319_create_appraisals_table', 10);
INSERT INTO `migrations` VALUES (104, '2021_01_10_080158_create_goal_trackings_table', 10);
INSERT INTO `migrations` VALUES (105, '2021_03_28_184255_create_ip_settings_table', 11);
INSERT INTO `migrations` VALUES (106, '2021_04_05_103029_create_salary_basics_table', 12);
COMMIT;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
BEGIN;
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 1);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 8);
INSERT INTO `model_has_roles` VALUES (5, 'App\\User', 9);
INSERT INTO `model_has_roles` VALUES (6, 'App\\User', 10);
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 11);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 12);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 13);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 14);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 15);
INSERT INTO `model_has_roles` VALUES (5, 'App\\User', 21);
INSERT INTO `model_has_roles` VALUES (5, 'App\\User', 22);
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 23);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 24);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 25);
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 26);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 27);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 28);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 29);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 30);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 31);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 32);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 33);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 34);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 36);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 37);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 38);
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 39);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 40);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 41);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 42);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 43);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 44);
INSERT INTO `model_has_roles` VALUES (4, 'App\\User', 45);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 46);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 47);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 48);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 49);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 50);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 51);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 52);
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 56);
INSERT INTO `model_has_roles` VALUES (3, 'App\\User', 57);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 58);
INSERT INTO `model_has_roles` VALUES (2, 'App\\User', 59);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 60);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 61);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 62);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 66);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 67);
INSERT INTO `model_has_roles` VALUES (1, 'App\\User', 68);
COMMIT;

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------
BEGIN;
INSERT INTO `notifications` VALUES ('00e7234c-517e-4b33-8eb4-0610ef967af3', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 47, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:09', '2021-12-07 13:35:09');
INSERT INTO `notifications` VALUES ('022e77a8-8ab7-4f54-8c07-96866a96cdc2', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 1, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', '2022-06-05 08:14:54', '2021-12-07 13:38:07', '2022-06-05 08:14:54');
INSERT INTO `notifications` VALUES ('054584f3-fb46-4475-aa04-c3956e6542da', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('0962bc16-0584-4f7d-9760-ad37a5f3c09d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('0ac4b300-c8ef-4fd5-9f38-a0eb71e05d6f', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 8, '{\"data\":\"Test1 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/1\"}', NULL, '2020-10-18 11:21:13', '2020-10-18 11:21:13');
INSERT INTO `notifications` VALUES ('0b6fad58-df06-4c09-a154-bb5e3f767530', 'App\\Notifications\\TicketUpdatedNotification', 'App\\User', 1, '{\"data\":\"Issued ticket for Bob Hobart has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', '2020-07-28 17:06:15', '2020-07-28 17:06:02', '2020-07-28 17:06:15');
INSERT INTO `notifications` VALUES ('0c7b565d-2342-4937-8628-1db54d9a0642', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 15, '{\"data\":\"Test2 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/2\"}', NULL, '2020-10-25 17:12:46', '2020-10-25 17:12:46');
INSERT INTO `notifications` VALUES ('1140572c-13d0-456b-b58e-01df812d21b6', 'App\\Notifications\\InvoicePaidNotification', 'App\\User', 16, '{\"data\":\"Payment of Project : Test2 has been paid\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/INV-NleUqw\"}', NULL, '2020-10-18 03:13:41', '2020-10-18 03:13:41');
INSERT INTO `notifications` VALUES ('144c0b47-e39d-4bb2-9742-0a1519d2a8b5', 'App\\Notifications\\InvoicePaidNotification', 'App\\User', 16, '{\"data\":\"Payment of Project : test3 has been paid\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/INV-IjAIYl\"}', NULL, '2020-10-12 07:50:56', '2020-10-12 07:50:56');
INSERT INTO `notifications` VALUES ('14b47e96-7736-494c-9bcf-ef50d6f66bd5', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 04:08:51', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('195ca03d-4cfb-4094-93f6-e2617e675fef', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 36, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:08', '2021-12-07 13:35:08');
INSERT INTO `notifications` VALUES ('1ab2c4a7-078e-424e-ab48-80340fe3f7de', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:09', '2021-10-04 01:21:09');
INSERT INTO `notifications` VALUES ('1c20d2b4-c861-466a-8dd1-0bfc4af880b3', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('1ebe500f-67aa-4dbb-a2ef-42edd1bace4a', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('1f355932-170d-439b-ae87-1f016c92faae', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 31, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('1fb3f81d-3bb5-4c24-94db-44e0cdda1072', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 1, '{\"data\":\"test3 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/3\"}', '2021-06-17 03:14:26', '2020-10-25 17:16:16', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('20daa08e-b8bb-44bd-91e3-f42290570ce9', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:01', '2021-10-04 04:09:01');
INSERT INTO `notifications` VALUES ('2173284b-75a0-4bc4-91f5-17ad34dcc7ed', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('229f3904-5c73-4763-8e99-6ac21e9d32b4', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 44, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('232dbdbd-f4fc-4c6f-93ba-58d5f854e6b2', 'App\\Notifications\\TicketAssignedNotification', 'App\\User', 12, '{\"data\":\"2 Employees has been assigned for Bob Hobart ticket\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 17:05:30', '2020-07-28 17:05:30');
INSERT INTO `notifications` VALUES ('24dc0612-a560-41cb-a466-7dfd8fd648cd', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-10-04 01:17:04', '2021-10-04 01:15:59', '2021-10-04 01:17:04');
INSERT INTO `notifications` VALUES ('26fd9a32-861a-414f-bed9-656b04743199', 'App\\Notifications\\EmployeeTravelStatus', 'App\\User', 9, '{\"data\":\"Your travel request status is --- approved\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/profile#Employee_travel\"}', '2021-07-05 15:53:34', '2020-08-18 07:13:03', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('290cc4dc-26c8-4dbc-9397-f0ab4c7f359a', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:51', '2021-10-04 04:08:51');
INSERT INTO `notifications` VALUES ('29704e06-94fa-4fc3-a25f-4d9278a6fb61', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('29d227bd-8bc9-410d-801c-54f4a45c1cef', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 36, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('2d9f84f7-b18c-4d81-87e3-40ba55ed3ee1', 'App\\Notifications\\InvoiceReceivedNotification', 'App\\User', 16, '{\"data\":\"Invoice of Project : test3 has been received\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/INV-IjAIYl\"}', NULL, '2020-10-12 07:50:00', '2020-10-12 07:50:00');
INSERT INTO `notifications` VALUES ('2f0d94a5-5710-46c8-a6b2-166a4f0c8c1a', 'App\\Notifications\\LeaveNotification', 'App\\User', 27, '{\"data\":\"A new leave-notification has been published\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/profile#Leave\"}', NULL, '2021-10-04 01:11:32', '2021-10-04 01:11:32');
INSERT INTO `notifications` VALUES ('316584ce-9135-4fb6-ab5f-8344025b051c', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('32123099-eeea-465e-9ff1-b6621c5ccc3a', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 04:09:04', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('322b32ae-935d-498e-b581-43235b332154', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('32881f2d-436b-4210-8570-3532e060a29b', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 46, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:08', '2021-12-07 13:35:08');
INSERT INTO `notifications` VALUES ('3386e315-ab4c-430f-af3c-86b128ff2966', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('3480c5be-9187-4d9d-8184-a9fcfedffc12', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:00', '2021-10-04 04:09:00');
INSERT INTO `notifications` VALUES ('38310d31-a52b-4322-ae50-2feb80229870', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 44, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:08', '2021-12-07 13:35:08');
INSERT INTO `notifications` VALUES ('393c9aec-d382-483a-a6fc-743b21f71210', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:52', '2021-10-04 04:08:52');
INSERT INTO `notifications` VALUES ('399d6153-6aca-4952-8eed-54381d115624', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('3b99fa34-18bc-429a-8d74-ccb1fe15f74e', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('3e33cf8b-f258-4a8e-9363-f016d99a221a', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 1, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', '2022-06-05 08:14:54', '2021-12-07 13:35:08', '2022-06-05 08:14:54');
INSERT INTO `notifications` VALUES ('42c091e8-d723-496d-8719-f71903d1abba', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:52', '2021-10-04 04:08:52');
INSERT INTO `notifications` VALUES ('43bf5a15-d83b-45b2-9a39-99ee72b97b67', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('45f188d6-f41b-47e1-938a-7912090d9ce6', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 40, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('47b5d11c-c178-4a01-a460-2b482e6a557b', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('4c64c79c-22c1-4242-bbe7-9935926a98d6', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 48, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('4c9b05be-02ef-45eb-b8a6-d6cb4e1ac890', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 9, '{\"data\":\"Test1 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/1\"}', '2021-07-05 15:53:34', '2020-10-18 11:21:13', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('50073dea-e079-42bd-8c09-dacb4707daca', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('57f5e3b5-a5f6-4867-ba8c-bbf06119e588', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 46, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('58a29e2c-8f33-4f85-b54f-e457d689f2b0', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:01', '2021-10-04 04:09:01');
INSERT INTO `notifications` VALUES ('5bcad5db-10b0-4864-93b3-239c540a0238', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 12, '{\"data\":\"Test1 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/1\"}', NULL, '2020-10-18 11:21:13', '2020-10-18 11:21:13');
INSERT INTO `notifications` VALUES ('641c1c91-d33c-451b-836f-c421e15912f7', 'App\\Notifications\\ClientTaskCreated', 'App\\User', 8, '{\"data\":\"A task has been created of Test2 by a client named maria_g\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/tasks\\/6\"}', NULL, '2020-10-12 01:53:23', '2020-10-12 01:53:23');
INSERT INTO `notifications` VALUES ('6740f5da-8ad7-46f5-b402-6b07e2931163', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('6824efa2-e711-4124-99ee-a53387550e7b', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('68794265-ead0-4050-ad4f-5bb6a5f17d59', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:09', '2021-10-04 01:21:09');
INSERT INTO `notifications` VALUES ('68d675f4-986f-4175-8c53-5b2f9b1ac84f', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 36, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('69319850-8ca7-4734-8cd6-871d976077f1', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 8, '{\"data\":\"Test2 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/2\"}', NULL, '2020-10-25 17:12:46', '2020-10-25 17:12:46');
INSERT INTO `notifications` VALUES ('69d69625-5bfe-4ced-9a77-c778cf3af03e', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:01', '2021-10-04 04:09:01');
INSERT INTO `notifications` VALUES ('6c88206a-2ef9-4b4e-b722-bbcc19b84446', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:08', '2021-10-04 01:21:08');
INSERT INTO `notifications` VALUES ('70aafa4e-434f-4ba2-8aea-ee754cce75c7', 'App\\Notifications\\TicketCreatedNotification', 'App\\User', 1, '{\"data\":\"A ticket has been issued for Bob Hobart\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', '2020-07-28 17:05:45', '2020-07-28 16:59:09', '2020-07-28 17:05:45');
INSERT INTO `notifications` VALUES ('7533d3e8-9950-40aa-a25e-1c95e0af4204', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 40, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:08', '2021-12-07 13:35:08');
INSERT INTO `notifications` VALUES ('757ae95d-6c33-4a59-9968-5d36dc0af936', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:01', '2021-10-04 04:09:01');
INSERT INTO `notifications` VALUES ('75865d0f-944d-43e2-aa43-ab1ad12a6e92', 'App\\Notifications\\TicketCreatedNotification', 'App\\User', 12, '{\"data\":\"A ticket has been issued for Bob Hobart\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 16:59:09', '2020-07-28 16:59:09');
INSERT INTO `notifications` VALUES ('76e6c668-831f-42c4-b1ad-1bf94eef70ed', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:52', '2021-10-04 04:08:52');
INSERT INTO `notifications` VALUES ('773781f5-10f9-4e99-a01c-362cdc650fc6', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('77a66edc-80ca-4b78-83b5-62e88edc7181', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('7914f808-738f-4453-9a28-843a4c1a5951', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 04:09:00', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('795b9487-6bab-4c5d-99b4-f856f136dd38', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:09', '2021-10-04 01:21:09');
INSERT INTO `notifications` VALUES ('7b38e007-e61a-4c18-9cc8-0d072e65df31', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 01:21:08', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('7d2802a2-6c28-480f-8ab9-69b1b8e48a20', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 1, '{\"data\":\"test3 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/3\"}', '2021-06-17 03:14:26', '2020-10-25 17:14:23', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('7fbad02a-1fb1-485d-a451-6c5c8be10824', 'App\\Notifications\\ClientTaskCreated', 'App\\User', 1, '{\"data\":\"A task has been created of Test2 by a client named maria_g\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/tasks\\/6\"}', '2021-06-17 03:14:26', '2020-10-12 01:53:23', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('85a290fa-06ea-453b-b116-1d70ffbd8145', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:52', '2021-10-04 04:08:52');
INSERT INTO `notifications` VALUES ('89e46bdf-1373-44e0-a61c-8b950126a3bf', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 1, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', '2022-06-05 08:14:54', '2021-12-07 13:38:23', '2022-06-05 08:14:54');
INSERT INTO `notifications` VALUES ('8b291e66-2f25-4baa-9a4a-95186bc63bdb', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('8d5c0651-030f-4d23-9041-7904bbedc072', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 40, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('8e1da56e-c9b7-4886-a795-291a7944f044', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:08', '2021-10-04 01:21:08');
INSERT INTO `notifications` VALUES ('8e9054a1-fe5d-4a8b-8b33-40655f1306bf', 'App\\Notifications\\EmployeeAwardNotify', 'App\\User', 9, '{\"data\":\"Congratulation! An Award has been given to you\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/profile#Employee_Core_hr\"}', '2021-07-05 15:53:34', '2020-08-18 06:55:40', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('90cfd472-af51-43fe-92e5-3a8c5266a942', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:09', '2021-10-04 01:21:09');
INSERT INTO `notifications` VALUES ('94454ac0-c2b4-4511-af4e-a3bff878c7f8', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 31, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:00', '2021-10-04 04:09:00');
INSERT INTO `notifications` VALUES ('9a2c3218-774f-4990-b41b-f5ba0d5dad5a', 'App\\Notifications\\TicketUpdatedNotification', 'App\\User', 8, '{\"data\":\"Issued ticket for Bob Hobart has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 17:06:02', '2020-07-28 17:06:02');
INSERT INTO `notifications` VALUES ('9b2fa86f-db94-4694-84be-2c033bbb450d', 'App\\Notifications\\TicketAssignedNotification', 'App\\User', 8, '{\"data\":\"2 Employees has been assigned for Bob Hobart ticket\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 17:05:30', '2020-07-28 17:05:30');
INSERT INTO `notifications` VALUES ('9ce4f9b2-698e-4b79-be29-8572c0c2d6f6', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:00', '2021-10-04 04:09:00');
INSERT INTO `notifications` VALUES ('9e5de11c-c9fd-4b3d-acd5-dc2208b46682', 'App\\Notifications\\EmployeeTravelStatus', 'App\\User', 9, '{\"data\":\"Your travel request status is --- first level approval\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/profile#Employee_travel\"}', '2021-07-05 15:53:34', '2020-08-18 07:11:23', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('9fe492ca-7b37-4419-935d-31cd42d3af77', 'App\\Notifications\\ClientTaskCreated', 'App\\User', 8, '{\"data\":\"new2222 has been updated by a client named maria_g\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/tasks\\/6\"}', NULL, '2020-10-12 02:00:20', '2020-10-12 02:00:20');
INSERT INTO `notifications` VALUES ('a4149d71-fda4-4df1-a9af-8e69f317181d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:51', '2021-10-04 04:08:51');
INSERT INTO `notifications` VALUES ('a4b6b7c9-d8a9-433c-bd3d-7afc27c4e8d7', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('a526d3da-a48a-4148-83fe-7039a0925d28', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('a692f74e-dfc2-445d-ae44-50f4f0225fb1', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 01:22:12', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('a6ef60fe-a7fe-423b-85d8-cd49a8f2236d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-10-04 01:17:04', '2021-10-04 01:16:18', '2021-10-04 01:17:04');
INSERT INTO `notifications` VALUES ('a92e54de-6aa5-4f9e-84ff-db58c857ce6e', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 11, '{\"data\":\"Test1 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/1\"}', NULL, '2020-10-18 11:21:13', '2020-10-18 11:21:13');
INSERT INTO `notifications` VALUES ('ab2e4808-6c93-4da8-8f4d-fb815ba785af', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('adacadc8-0fcd-4b16-98b3-799ed0e41b11', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 46, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('af53a0b7-fcf3-4a5d-acd2-a80f4980b212', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('b0e5a738-ff48-4c14-a02a-2ad571ce0fa6', 'App\\Notifications\\InvoiceReceivedNotification', 'App\\User', 16, '{\"data\":\"Invoice of Project : Test2 has been received\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/INV-NleUqw\"}', NULL, '2020-10-18 03:18:53', '2020-10-18 03:18:53');
INSERT INTO `notifications` VALUES ('b4394ab6-4dec-430f-92d8-a25fe5dae37d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:21:08', '2021-10-04 01:21:08');
INSERT INTO `notifications` VALUES ('b8f87453-1177-4edf-8fc4-4969e2a8d122', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 14, '{\"data\":\"Test2 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/2\"}', NULL, '2020-10-25 17:12:46', '2020-10-25 17:12:46');
INSERT INTO `notifications` VALUES ('baed268a-08f6-4c19-a19a-2e3805ca16d6', 'App\\Notifications\\InvoiceReceivedNotification', 'App\\User', 16, '{\"data\":\"Invoice of Project : Test2 has been received\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/INV-NleUqw\"}', NULL, '2020-10-18 03:33:04', '2020-10-18 03:33:04');
INSERT INTO `notifications` VALUES ('bcdd73f6-8799-4c10-861a-0cb2b87e64d1', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('bd2bb9a5-aca5-494b-8de8-6870ab3aaf9d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('c14d50a8-90b3-42fc-ace1-41c73b16489c', 'App\\Notifications\\TicketAssignedNotification', 'App\\User', 10, '{\"data\":\"2 Employees has been assigned for Bob Hobart ticket\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 17:05:30', '2020-07-28 17:05:30');
INSERT INTO `notifications` VALUES ('c6a47158-f02c-4d44-b96d-543c53edf66a', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 48, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:09', '2021-12-07 13:35:09');
INSERT INTO `notifications` VALUES ('caed272e-87ec-47ea-ae2c-bb515fe992e3', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('cbd8d62e-7758-4224-91e1-6a84d12c00fd', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 31, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:35:08', '2021-12-07 13:35:08');
INSERT INTO `notifications` VALUES ('cc135169-a6a2-480e-9f58-fe29dee5e36d', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:17', '2021-10-04 04:09:17');
INSERT INTO `notifications` VALUES ('ce7e603c-e115-413d-9f14-1d0c2809b75b', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 1, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', '2021-11-27 05:42:22', '2021-10-04 04:09:17', '2021-11-27 05:42:22');
INSERT INTO `notifications` VALUES ('ced1e972-39db-4f13-aaed-8fe492e03947', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 48, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('cf7d4b40-9d91-4431-a780-0abe6abd13ae', 'App\\Notifications\\InvoicePaidNotification', 'App\\User', 16, '{\"data\":\"Test1 has been paid\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/1\"}', '2020-10-12 05:08:12', '2020-10-12 05:05:30', '2020-10-12 05:08:12');
INSERT INTO `notifications` VALUES ('cfd90a21-c28a-4e5a-b0c7-5c60703c47da', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:15:59', '2021-10-04 01:15:59');
INSERT INTO `notifications` VALUES ('d0b5259d-71ec-4937-8e6d-50d217491718', 'App\\Notifications\\TicketAssignedNotification', 'App\\User', 9, '{\"data\":\"2 Employees has been assigned for Bob Hobart ticket\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', '2021-07-05 15:53:34', '2020-07-28 17:05:30', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('d45ac590-d192-442b-afa3-66117f4bb2ec', 'App\\Notifications\\InvoiceReceivedNotification', 'App\\User', 16, '{\"data\":\"Invoice of Project : test3 has been received\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/invoices\\/4\"}', NULL, '2020-10-12 07:28:36', '2020-10-12 07:28:36');
INSERT INTO `notifications` VALUES ('d547f33d-e08c-447c-9db8-129b1f1f82a2', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 44, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('d678bab5-47c1-4ff8-8152-2c92ad954858', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('d69e4610-2282-4cab-892d-ab9a8ec12377', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 36, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('d6bb80f0-8168-429c-ab79-e26e0bfd8d20', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('db3fe78e-ae71-41bd-8922-f485b5a788c7', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 44, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('dc742fb8-d1dd-4825-89f7-446dabab1cf0', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 48, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:09:05', '2021-10-04 04:09:05');
INSERT INTO `notifications` VALUES ('e1f793a3-1ed5-468a-a9dd-9d2e0ce3f960', 'App\\Notifications\\EmployeeTerminationNotify', 'App\\User', 40, '{\"data\":\"You have been terminated from this company  Termination Date-- 16-12-2021\",\"link\":\"\"}', NULL, '2021-12-15 06:06:11', '2021-12-15 06:06:11');
INSERT INTO `notifications` VALUES ('e3b8524c-573e-4b8e-9465-7789189c5224', 'App\\Notifications\\EmployeePromotion', 'App\\User', 9, '{\"data\":\" Congratulation!You have been promoted to  Senior Executive 1\",\"link\":\"\"}', '2021-07-05 15:53:34', '2020-08-18 06:45:52', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('e7faff2c-21f2-49a4-917a-b7c4f0c41b85', 'App\\Notifications\\EmployeeTransferNotify', 'App\\User', 9, '{\"data\":\"You have been transferred To\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/profile#Employee_transfer\"}', '2021-07-05 15:53:34', '2020-08-18 07:44:56', '2021-07-05 15:53:34');
INSERT INTO `notifications` VALUES ('e82fc7b5-2ab7-4799-af55-204684deb53f', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 8, '{\"data\":\"test3 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/3\"}', NULL, '2020-10-25 17:16:16', '2020-10-25 17:16:16');
INSERT INTO `notifications` VALUES ('ec32bc86-7300-4509-b28a-1b91e2e99711', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 8, '{\"data\":\"test3 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/3\"}', NULL, '2020-10-25 17:14:23', '2020-10-25 17:14:23');
INSERT INTO `notifications` VALUES ('ec517324-8a08-46cd-8bcc-e381809474b5', 'App\\Notifications\\ClientTaskCreated', 'App\\User', 1, '{\"data\":\"new2222 has been updated by a client named maria_g\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/tasks\\/6\"}', '2021-06-17 03:14:26', '2020-10-12 02:00:20', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('ecc3dc35-43c0-4f70-9704-c6abf6300464', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 1, '{\"data\":\"Test2 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/2\"}', '2021-06-17 03:14:26', '2020-10-25 17:12:46', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('ed994f46-e157-4ed1-8a8a-1f15120c7845', 'App\\Notifications\\TicketAssignedNotification', 'App\\User', 1, '{\"data\":\"2 Employees has been assigned for Bob Hobart ticket\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', '2020-07-28 17:05:45', '2020-07-28 17:05:30', '2020-07-28 17:05:45');
INSERT INTO `notifications` VALUES ('ee103974-8f7c-4054-b2bb-d26961d15b0b', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 47, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('f4e9fe25-dad1-44a7-8812-d065639d2e42', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 31, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:07', '2021-12-07 13:38:07');
INSERT INTO `notifications` VALUES ('f69f0707-2803-4c0e-8d30-134272ac9637', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 40, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 04:08:52', '2021-10-04 04:08:52');
INSERT INTO `notifications` VALUES ('f6b8fafd-1e8e-4519-b7ea-c0eb8d894f0c', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 47, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:22:12', '2021-10-04 01:22:12');
INSERT INTO `notifications` VALUES ('f6f34a1a-bb5f-4e44-b0ce-5f1e389e84f1', 'App\\Notifications\\LeaveNotificationToAdmin', 'App\\User', 46, '{\"data\":\"A new leave-notification\",\"link\":\"http:\\/\\/localhost\\/peoplepro\\/timesheet\\/leaves\"}', NULL, '2021-10-04 01:16:18', '2021-10-04 01:16:18');
INSERT INTO `notifications` VALUES ('f7b7f0bc-87c5-47de-815c-0da9d6912884', 'App\\Notifications\\ProjectUpdatedNotification', 'App\\User', 1, '{\"data\":\"Test1 has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/project-management\\/projects\\/1\"}', '2021-06-17 03:14:26', '2020-10-18 11:21:13', '2021-06-17 03:14:26');
INSERT INTO `notifications` VALUES ('fa1c5825-43e9-4ee9-a48d-792f43b0d79d', 'App\\Notifications\\TicketUpdatedNotification', 'App\\User', 12, '{\"data\":\"Issued ticket for Bob Hobart has been updated\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 17:06:02', '2020-07-28 17:06:02');
INSERT INTO `notifications` VALUES ('fd8f2436-1abb-4d71-af1a-b8b104891862', 'App\\Notifications\\OfficialDocumentExpiryNotifyToAdmin', 'App\\User', 47, '{\"data\":\"A new notification about official document expiry\",\"link\":\"http:\\/\\/localhost\\/file_manager\\/official_documents\"}', NULL, '2021-12-07 13:38:23', '2021-12-07 13:38:23');
INSERT INTO `notifications` VALUES ('fea68d3b-bf7b-452f-b3de-d41d30a787ec', 'App\\Notifications\\TicketCreatedNotification', 'App\\User', 8, '{\"data\":\"A ticket has been issued for Bob Hobart\",\"link\":\"http:\\/\\/peopleprohrm.com\\/demo\\/tickets\\/Kkqx8gSB\"}', NULL, '2020-07-28 16:59:09', '2020-07-28 16:59:09');
COMMIT;

-- ----------------------------
-- Table structure for office_shifts
-- ----------------------------
DROP TABLE IF EXISTS `office_shifts`;
CREATE TABLE `office_shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default_shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `sunday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_out` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `office_shifts_company_id_foreign` (`company_id`),
  CONSTRAINT `office_shifts_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of office_shifts
-- ----------------------------
BEGIN;
INSERT INTO `office_shifts` VALUES (1, 'Morning Shift', NULL, 1, '09:00AM', '05:00PM', '09:00AM', '05:00PM', '', '', '09:00AM', '05:00PM', '09:00AM', '05:00PM', '09:00AM', '05:00PM', '09:00AM', '05:00PM', '2020-07-27 04:06:46', '2022-09-14 06:19:29');
INSERT INTO `office_shifts` VALUES (2, 'MidDay', NULL, 1, '', '', '04:00PM', '09:00PM', '12:00PM', '09:00PM', '12:00PM', '09:00PM', '', '', '12:00PM', '09:00PM', '12:00PM', '09:00PM', '2020-07-27 04:22:37', '2021-06-30 00:20:24');
COMMIT;

-- ----------------------------
-- Table structure for official_documents
-- ----------------------------
DROP TABLE IF EXISTS `official_documents`;
CREATE TABLE `official_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `document_type_id` bigint(20) unsigned DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `document_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identification_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `document_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `official_documents_company_id_foreign` (`company_id`),
  KEY `official_documents_document_type_id_foreign` (`document_type_id`),
  KEY `official_documents_added_by_foreign` (`added_by`),
  CONSTRAINT `official_documents_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `official_documents_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `official_documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of official_documents
-- ----------------------------
BEGIN;
INSERT INTO `official_documents` VALUES (1, 1, 3, 1, 'Bay Project Info', '8739320', '', 'Bay Project Info.1603366355.pdf', '2021-12-14', 7, '2020-10-22 08:32:35', '2021-12-07 13:33:20');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
INSERT INTO `password_resets` VALUES ('new@gmail.com', '$2y$10$day4AQ4g8sFvMwhMrTxpJuLXZCpVF2IK9kVS.6qZxeR6b7CVt2eGy', '2020-10-06 04:22:35');
COMMIT;

-- ----------------------------
-- Table structure for payment_methods
-- ----------------------------
DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `method_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_percentage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_methods_company_id_foreign` (`company_id`),
  CONSTRAINT `payment_methods_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of payment_methods
-- ----------------------------
BEGIN;
INSERT INTO `payment_methods` VALUES (1, NULL, 'Paypal', '10%', '123', '2020-07-27 03:52:20', '2020-07-27 03:53:03');
INSERT INTO `payment_methods` VALUES (2, NULL, 'Bank', '5%', '786', '2020-07-27 03:53:17', '2020-07-27 03:53:17');
INSERT INTO `payment_methods` VALUES (3, NULL, 'Cash', '%', '999', '2020-07-27 03:53:29', '2020-07-27 03:53:29');
COMMIT;

-- ----------------------------
-- Table structure for payslips
-- ----------------------------
DROP TABLE IF EXISTS `payslips`;
CREATE TABLE `payslips` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payslip_key` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payslip_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `company_id` bigint(20) unsigned NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` double NOT NULL,
  `net_salary` double NOT NULL,
  `allowances` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commissions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `loans` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deductions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtimes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pension_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pension_amount` double NOT NULL,
  `hours_worked` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `month_year` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payslips_employee_id_foreign` (`employee_id`),
  CONSTRAINT `payslips_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of payslips
-- ----------------------------
BEGIN;
INSERT INTO `payslips` VALUES (23, 'Heizf4TsdYLCOgt8GBOQ', '1685181828', 12, 1, 'Monthly', 1500, 1705, '[{\"id\":3,\"employee_id\":12,\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\"},{\"id\":4,\"employee_id\":12,\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\"}]', '[{\"id\":2,\"employee_id\":12,\"commission_title\":\"Sale Increase\",\"commission_amount\":\"15\"},{\"id\":13,\"employee_id\":12,\"commission_title\":\"Work Rate\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":2,\"employee_id\":12,\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\"}]', '[{\"id\":3,\"employee_id\":12,\"overtime_title\":\"Night Shift\",\"no_of_days\":\"5\",\"overtime_hours\":\"10\",\"overtime_rate\":\"5\",\"overtime_amount\":\"50\"},{\"id\":4,\"employee_id\":12,\"overtime_title\":\"Production Hour\",\"no_of_days\":\"2\",\"overtime_hours\":\"2\",\"overtime_rate\":\"5\",\"overtime_amount\":\"10\"}]', '[]', NULL, 0, 0, 1, 'January-2021', '2021-01-27 01:22:07', '2021-01-27 01:22:07');
INSERT INTO `payslips` VALUES (24, 'JlvmZMOa5lI5jLCjiJhG', '4271987981', 14, 2, 'Monthly', 200, 310, '[{\"id\":12,\"employee_id\":14,\"allowance_title\":\"Tea\",\"allowance_amount\":\"10\"}]', '[{\"id\":19,\"employee_id\":14,\"commission_title\":\"Sale\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":7,\"employee_id\":14,\"deduction_title\":\"Health\",\"deduction_amount\":\"10\"}]', '[{\"id\":10,\"employee_id\":14,\"overtime_title\":\"Advance Work\",\"no_of_days\":\"7\",\"overtime_hours\":\"10\",\"overtime_rate\":\"10\",\"overtime_amount\":\"100\"}]', '[]', NULL, 0, 0, 1, 'January-2021', '2021-01-27 01:36:45', '2021-01-27 01:36:45');
INSERT INTO `payslips` VALUES (35, 'qaFrFw7u42ttOPtdUg3X', '1470327139', 14, 2, 'Monthly', 200, 310, '[{\"id\":12,\"employee_id\":14,\"allowance_title\":\"Tea\",\"allowance_amount\":\"10\"}]', '[{\"id\":19,\"employee_id\":14,\"commission_title\":\"Sale\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":7,\"employee_id\":14,\"deduction_title\":\"Health\",\"deduction_amount\":\"10\"}]', '[{\"id\":10,\"employee_id\":14,\"overtime_title\":\"Advance Work\",\"no_of_days\":\"7\",\"overtime_hours\":\"10\",\"overtime_rate\":\"10\",\"overtime_amount\":\"100\"}]', '[]', NULL, 0, 0, 1, 'February-2021', '2021-03-05 12:49:44', '2021-03-05 12:49:44');
INSERT INTO `payslips` VALUES (64, '5egHnALK1DikDtw3qpC9', '9276867492', 15, 2, 'Monthly', 110, 110, '[]', '[]', '[]', '[]', '[]', '[]', NULL, 0, 0, 1, 'February-2021', '2021-03-12 06:40:21', '2021-03-12 06:40:21');
INSERT INTO `payslips` VALUES (65, 'rqKgatx6fEzWtiITw81J', '7754626331', 12, 1, 'Monthly', 1500, 1705, '[{\"id\":3,\"employee_id\":12,\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\"},{\"id\":4,\"employee_id\":12,\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\"}]', '[{\"id\":2,\"employee_id\":12,\"commission_title\":\"Sale Increase\",\"commission_amount\":\"15\"},{\"id\":13,\"employee_id\":12,\"commission_title\":\"Work Rate\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":2,\"employee_id\":12,\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\"}]', '[{\"id\":3,\"employee_id\":12,\"overtime_title\":\"Night Shift\",\"no_of_days\":\"5\",\"overtime_hours\":\"10\",\"overtime_rate\":\"5\",\"overtime_amount\":\"50\"},{\"id\":4,\"employee_id\":12,\"overtime_title\":\"Production Hour\",\"no_of_days\":\"2\",\"overtime_hours\":\"2\",\"overtime_rate\":\"5\",\"overtime_amount\":\"10\"}]', '[{\"id\":1,\"employee_id\":12,\"other_payment_title\":\"Pefomance Bonus\",\"other_payment_amount\":\"15\"}]', NULL, 0, 0, 1, 'February-2021', '2021-03-12 06:52:46', '2021-03-12 06:52:46');
INSERT INTO `payslips` VALUES (146, 'ix7eieBNAuWw5hU3wVWp', '8080407568', 14, 2, 'Monthly', 200, 310, '[{\"id\":12,\"employee_id\":14,\"allowance_title\":\"Tea\",\"allowance_amount\":\"10\"}]', '[{\"id\":19,\"employee_id\":14,\"commission_title\":\"Sale\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":7,\"employee_id\":14,\"deduction_title\":\"Health\",\"deduction_amount\":\"10\"}]', '[{\"id\":10,\"employee_id\":14,\"overtime_title\":\"Advance Work\",\"no_of_days\":\"7\",\"overtime_hours\":\"10\",\"overtime_rate\":\"10\",\"overtime_amount\":\"100\"}]', '[]', NULL, 0, 0, 1, 'March-2021', '2021-03-12 13:17:02', '2021-03-12 13:17:02');
INSERT INTO `payslips` VALUES (147, 'ET6AArlpGdCmexpWMeLi', '2925821330', 10, 1, 'Monthly', 100, 660, '[{\"id\":8,\"employee_id\":10,\"allowance_title\":\"Tea\",\"allowance_amount\":\"10\"},{\"id\":9,\"employee_id\":10,\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\"}]', '[{\"id\":17,\"employee_id\":10,\"commission_title\":\"Sale\",\"commission_amount\":\"50\"}]', '[]', '[{\"id\":5,\"employee_id\":10,\"deduction_title\":\"Testing\",\"deduction_amount\":\"50\"}]', '[{\"id\":8,\"employee_id\":10,\"overtime_title\":\"Advance Work\",\"no_of_days\":\"5\",\"overtime_hours\":\"25\",\"overtime_rate\":\"20\",\"overtime_amount\":\"500\"}]', '[]', NULL, 0, 0, 1, 'March-2021', '2021-03-13 10:07:03', '2021-03-13 10:07:03');
INSERT INTO `payslips` VALUES (152, 'Y8QZy53anJrYBSQDIrvS', '4959778575', 13, 1, 'Monthly', 300, 375, '[{\"id\":5,\"employee_id\":9,\"allowance_title\":\"xyz\",\"allowance_amount\":\"100\"}]', '[{\"id\":14,\"employee_id\":9,\"commission_title\":\"Cofee\",\"commission_amount\":\"15\"},{\"id\":15,\"employee_id\":9,\"commission_title\":\"Tea\",\"commission_amount\":\"10\"}]', '[]', '[{\"id\":3,\"employee_id\":9,\"deduction_title\":\"Test Deduction\",\"deduction_amount\":\"50\"}]', '[]', '[]', NULL, 0, 0, 1, 'April-2021', '2021-04-06 03:31:41', '2021-04-06 03:31:41');
INSERT INTO `payslips` VALUES (153, 'MojiX0BrB2nPkGB8GLEo', '9462137854', 11, 1, 'Hourly', 100, 1615, '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Home\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2020-07-29 22:10:53\",\"updated_at\":\"2020-07-29 22:10:53\"},{\"id\":2,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Tea\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-07-30 00:08:42\",\"updated_at\":\"2020-07-30 00:08:42\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"3\",\"amount_remaining\":\"75\",\"monthly_payable\":\"25.000\"}]', '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Test\",\"deduction_amount\":\"10\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2020-07-30 00:21:22\",\"updated_at\":\"2020-07-30 00:21:22\"}]', '[]', '[]', NULL, 0, 14, 1, 'March-2021', '2021-04-12 17:33:37', '2021-04-12 17:33:37');
INSERT INTO `payslips` VALUES (154, 'tSGyONwrlCeMjeWOemTl', '5146547430', 11, 1, 'Hourly', 100, 215, '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Home\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2020-07-29 22:10:53\",\"updated_at\":\"2020-07-29 22:10:53\"},{\"id\":2,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Tea\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-07-30 00:08:42\",\"updated_at\":\"2020-07-30 00:08:42\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"2\",\"amount_remaining\":\"50\",\"monthly_payable\":\"25.000\"}]', '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Test\",\"deduction_amount\":\"10\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2020-07-30 00:21:22\",\"updated_at\":\"2020-07-30 00:21:22\"}]', '[]', '[]', NULL, 0, 0, 1, 'April-2021', '2021-04-12 17:34:45', '2021-04-12 17:34:45');
INSERT INTO `payslips` VALUES (155, '02fZCnP2WZPMvoAe03C7', '3205941835', 11, 1, 'Hourly', 100, 215, '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Home\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2020-07-29 22:10:53\",\"updated_at\":\"2020-07-29 22:10:53\"},{\"id\":2,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Tea\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-07-30 00:08:42\",\"updated_at\":\"2020-07-30 00:08:42\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"1\",\"amount_remaining\":\"25\",\"monthly_payable\":\"25.000\"}]', '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Test\",\"deduction_amount\":\"10\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2020-07-30 00:21:22\",\"updated_at\":\"2020-07-30 00:21:22\"}]', '[]', '[]', NULL, 0, 0, 1, 'May-2021', '2021-04-12 17:35:23', '2021-04-12 17:35:23');
INSERT INTO `payslips` VALUES (156, 'VIM8lgr0qjgan1fJyOZJ', '5926261822', 11, 1, 'Hourly', 100, 215, '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Home\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2020-07-29 22:10:53\",\"updated_at\":\"2020-07-29 22:10:53\"},{\"id\":2,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Tea\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-07-30 00:08:42\",\"updated_at\":\"2020-07-30 00:08:42\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"25.000\"}]', '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Test\",\"deduction_amount\":\"10\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2020-07-30 00:21:22\",\"updated_at\":\"2020-07-30 00:21:22\"}]', '[]', '[]', NULL, 0, 0, 1, 'June-2021', '2021-04-12 17:36:32', '2021-04-12 17:36:32');
INSERT INTO `payslips` VALUES (164, 'wyJzh8L8YlJjstjyczbA', '3637185451', 12, 1, 'Monthly', 100, 205, '[{\"id\":3,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:01:55\",\"updated_at\":\"2020-10-20 10:01:55\"},{\"id\":4,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:02:25\",\"updated_at\":\"2020-10-20 10:02:25\"}]', '[]', '[]', '[{\"id\":2,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\",\"deduction_type\":\"Home Development Mutual Fund\",\"created_at\":\"2020-10-20 10:50:01\",\"updated_at\":\"2020-10-20 10:50:01\"}]', '[]', '[]', NULL, 0, 0, 1, 'May-2021', '2021-05-01 23:15:07', '2021-05-01 23:15:07');
INSERT INTO `payslips` VALUES (165, 'pww8lAyuz98inC21rMpA', '5538729615', 27, 1, 'Monthly', 100, 100, '[]', '[]', '[]', '[]', '[]', '[]', NULL, 0, 0, 1, 'May-2021', '2021-05-01 23:15:22', '2021-05-01 23:15:22');
INSERT INTO `payslips` VALUES (166, 'v3n2tmqTTSAz5GqS13LR', '5542732803', 15, 1, 'Monthly', 200, 200, '[]', '[]', '[]', '[]', '[]', '[]', NULL, 0, 0, 1, 'May-2021', '2021-05-01 23:15:33', '2021-05-01 23:15:33');
INSERT INTO `payslips` VALUES (167, 'tHhQ0sudoHhVhDRfIpya', '4457156927', 11, 1, 'Hourly', 100, 740, '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Home\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2020-07-29 09:10:53\",\"updated_at\":\"2020-07-29 09:10:53\"},{\"id\":2,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Tea\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-07-29 11:08:42\",\"updated_at\":\"2020-07-29 11:08:42\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"0\"}]', '[{\"id\":1,\"employee_id\":11,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Test\",\"deduction_amount\":\"10\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2020-07-29 11:21:22\",\"updated_at\":\"2020-07-29 11:21:22\"}]', '[]', '[]', NULL, 0, 5, 1, 'July-2021', '2021-07-03 13:48:19', '2021-07-03 13:48:19');
INSERT INTO `payslips` VALUES (168, 'N7ZSEkNPJzeAXwP93juf', '6468694689', 9, 1, 'Monthly', 500, 350, '[{\"id\":15,\"employee_id\":9,\"month_year\":\"August-2021\",\"first_date\":\"2021-08-01\",\"allowance_title\":\"Milk\",\"allowance_amount\":\"200\",\"is_taxable\":0,\"created_at\":\"2021-04-09 11:38:21\",\"updated_at\":\"2021-04-09 11:38:21\"}]', '[]', '[]', '[{\"id\":10,\"employee_id\":9,\"month_year\":\"April-2021\",\"first_date\":\"2021-04-01\",\"deduction_title\":\"Fever\",\"deduction_amount\":\"100\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2021-04-10 19:16:30\",\"updated_at\":\"2021-04-10 19:16:30\"}]', '[]', '[]', 'percentage', 250, 0, 1, 'July-2022', '2022-07-23 08:15:27', '2022-07-23 08:15:27');
INSERT INTO `payslips` VALUES (169, 'zGxSMPfXaZPQTLq4V0PJ', '8615826435', 11, 1, 'Monthly', 100, 70, '[{\"id\":16,\"employee_id\":11,\"month_year\":\"October-2022\",\"first_date\":\"2022-10-01\",\"allowance_title\":\"Transportation\",\"allowance_amount\":\"10\",\"is_taxable\":0,\"created_at\":\"2022-10-18 10:17:19\",\"updated_at\":\"2022-10-18 10:17:19\"},{\"id\":17,\"employee_id\":11,\"month_year\":\"October-2022\",\"first_date\":\"2022-10-01\",\"allowance_title\":\"Communication\",\"allowance_amount\":\"10\",\"is_taxable\":0,\"created_at\":\"2022-10-18 10:17:44\",\"updated_at\":\"2022-10-18 10:17:44\"}]', '[]', '[{\"id\":8,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"100\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"0\"},{\"id\":9,\"employee_id\":11,\"loan_title\":\"Home\",\"loan_amount\":\"50\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"50.00\"}]', '[{\"id\":11,\"employee_id\":11,\"month_year\":\"October-2022\",\"first_date\":\"2022-10-01\",\"deduction_title\":\"Medical\",\"deduction_amount\":\"15\",\"deduction_type\":\"Health Insurance Corporation\",\"created_at\":\"2022-10-18 10:19:18\",\"updated_at\":\"2022-10-18 10:19:18\"}]', '[{\"id\":14,\"employee_id\":11,\"month_year\":\"October-2022\",\"first_date\":\"2022-10-01\",\"overtime_title\":\"OT\",\"no_of_days\":\"4\",\"overtime_hours\":\"8\",\"overtime_rate\":\"0.5\",\"overtime_amount\":\"4\",\"created_at\":\"2022-10-18 10:20:06\",\"updated_at\":\"2022-10-18 10:20:06\"}]', '[{\"id\":5,\"employee_id\":11,\"month_year\":\"October-2022\",\"first_date\":\"2022-10-01\",\"other_payment_title\":\"Reimbursement\",\"other_payment_amount\":\"11\",\"created_at\":\"2022-10-18 10:19:39\",\"updated_at\":\"2022-10-18 10:19:39\"}]', NULL, 0, 0, 1, 'October-2022', '2022-10-18 15:22:39', '2022-10-18 15:22:39');
INSERT INTO `payslips` VALUES (183, 'd1bPIeYPMRGRJeSUIBRu', '5812175064', 12, 1, 'Monthly', 100, 195, '[{\"id\":3,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:01:55\",\"updated_at\":\"2020-10-20 10:01:55\"},{\"id\":4,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:02:25\",\"updated_at\":\"2020-10-20 10:02:25\"}]', '[]', '[{\"id\":13,\"employee_id\":12,\"loan_title\":\"Test 12\",\"loan_amount\":\"20\",\"time_remaining\":\"1\",\"amount_remaining\":\"10\",\"monthly_payable\":\"10.00\"}]', '[{\"id\":2,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\",\"deduction_type\":\"Home Development Mutual Fund\",\"created_at\":\"2020-10-20 10:50:01\",\"updated_at\":\"2020-10-20 10:50:01\"}]', '[]', '[]', NULL, 0, 0, 1, 'October-2022', '2022-10-25 07:41:16', '2022-10-25 07:41:16');
INSERT INTO `payslips` VALUES (184, '289unpDojEx8RXHLZZuv', '8737962192', 12, 1, 'Monthly', 100, 195, '[{\"id\":3,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:01:55\",\"updated_at\":\"2020-10-20 10:01:55\"},{\"id\":4,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:02:25\",\"updated_at\":\"2020-10-20 10:02:25\"}]', '[]', '[{\"id\":13,\"employee_id\":12,\"loan_title\":\"Test 12\",\"loan_amount\":\"20\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"0\"}]', '[{\"id\":2,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\",\"deduction_type\":\"Home Development Mutual Fund\",\"created_at\":\"2020-10-20 10:50:01\",\"updated_at\":\"2020-10-20 10:50:01\"}]', '[]', '[]', NULL, 0, 0, 1, 'November-2022', '2022-10-25 07:41:53', '2022-10-25 07:41:53');
INSERT INTO `payslips` VALUES (185, 'ZQr6CydKy3N9tZS186DL', '2661937152', 12, 1, 'Monthly', 100, 205, '[{\"id\":3,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Snacks\",\"allowance_amount\":\"50\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:01:55\",\"updated_at\":\"2020-10-20 10:01:55\"},{\"id\":4,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"allowance_title\":\"Transport\",\"allowance_amount\":\"60\",\"is_taxable\":0,\"created_at\":\"2020-10-20 10:02:25\",\"updated_at\":\"2020-10-20 10:02:25\"}]', '[]', '[{\"id\":13,\"employee_id\":12,\"loan_title\":\"Test 12\",\"loan_amount\":\"20\",\"time_remaining\":\"0\",\"amount_remaining\":\"0\",\"monthly_payable\":\"0\"}]', '[{\"id\":2,\"employee_id\":12,\"month_year\":\"January-2021\",\"first_date\":\"2021-01-01\",\"deduction_title\":\"Development tax\",\"deduction_amount\":\"5\",\"deduction_type\":\"Home Development Mutual Fund\",\"created_at\":\"2020-10-20 10:50:01\",\"updated_at\":\"2020-10-20 10:50:01\"}]', '[]', '[]', NULL, 0, 0, 1, 'December-2022', '2022-10-25 07:42:42', '2022-10-25 07:42:42');
COMMIT;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=298 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES (1, 'user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (2, 'view-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (3, 'edit-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (4, 'delete-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (5, 'last-login-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (6, 'role-access-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (7, 'details-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (8, 'view-details-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (9, 'store-details-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (10, 'modify-details-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (11, 'customize-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (12, 'role-access', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (13, 'general-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (14, 'view-general-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (15, 'store-general-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (16, 'mail-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (17, 'view-mail-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (18, 'store-mail-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (19, 'language-setting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (20, 'core_hr', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (21, 'view-calendar', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (22, 'promotion', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (23, 'view-promotion', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (24, 'store-promotion', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (25, 'edit-promotion', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (26, 'delete-promotion', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (27, 'award', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (28, 'view-award', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (29, 'store-award', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (30, 'edit-award', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (31, 'delete-award', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (32, 'transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (33, 'view-transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (34, 'store-transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (35, 'edit-transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (36, 'delete-transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (37, 'travel', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (38, 'view-travel', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (39, 'store-travel', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (40, 'edit-travel', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (41, 'delete-travel', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (42, 'resignation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (43, 'view-resignation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (44, 'store-resignation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (45, 'edit-resignation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (46, 'delete-resignation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (47, 'complaint', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (48, 'view-complaint', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (49, 'store-complaint', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (50, 'edit-complaint', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (51, 'delete-complaint', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (52, 'warning', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (53, 'view-warning', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (54, 'store-warning', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (55, 'edit-warning', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (56, 'delete-warning', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (57, 'termination', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (58, 'view-termination', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (59, 'store-termination', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (60, 'edit-termination', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (61, 'delete-termination', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (62, 'timesheet', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (63, 'attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (64, 'view-attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (65, 'edit-attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (66, 'office_shift', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (67, 'view-office_shift', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (68, 'store-office_shift', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (69, 'edit-office_shift', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (70, 'delete-office_shift', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (71, 'holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (72, 'view-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (73, 'store-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (74, 'edit-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (75, 'delete-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (76, 'leave', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (77, 'view-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (78, 'store-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (79, 'edit-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (80, 'delete-holiday', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (81, 'payment-module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (82, 'view-payslip', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (83, 'make-payment', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (84, 'make-bulk_payment', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (85, 'view-paylist', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (86, 'set-salary', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (87, 'hr_report', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (88, 'report-payslip', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (89, 'report-attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (90, 'report-training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (91, 'report-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (92, 'report-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (93, 'report-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (94, 'report-account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (95, 'report-deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (96, 'report-expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (97, 'report-transaction', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (98, 'recruitment', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (99, 'job_employer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (100, 'view-job_employer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (101, 'store-job_employer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (102, 'edit-job_employer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (103, 'delete-job_employer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (104, 'job_post', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (105, 'view-job_post', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (106, 'store-job_post', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (107, 'edit-job_post', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (108, 'delete-job_post', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (109, 'job_candidate', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (110, 'view-job_candidate', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (111, 'store-job_candidate', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (112, 'delete-job_candidate', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (113, 'job_interview', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (114, 'view-job_interview', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (115, 'store-job_interview', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (116, 'delete-job_interview', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (117, 'project-management', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (118, 'project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (119, 'view-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (120, 'store-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (121, 'edit-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (122, 'delete-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (123, 'task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (124, 'view-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (125, 'store-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (126, 'edit-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (127, 'delete-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (128, 'client', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (129, 'view-client', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (130, 'store-client', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (131, 'edit-client', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (132, 'delete-client', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (133, 'invoice', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (134, 'view-invoice', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (135, 'store-invoice', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (136, 'edit-invoice', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (137, 'delete-invoice', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (138, 'ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (139, 'view-ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (140, 'store-ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (141, 'edit-ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (142, 'delete-ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (143, 'import-module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (144, 'import-attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (145, 'import-employee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (146, 'file_module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (147, 'file_manager', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (148, 'view-file_manager', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (149, 'store-file_manager', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (150, 'edit-file_manager', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (151, 'delete-file_manager', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (152, 'view-file_config', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (153, 'official_document', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (154, 'view-official_document', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (155, 'store-official_document', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (156, 'edit-official_document', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (157, 'delete-official_document', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (158, 'event-meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (159, 'meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (160, 'view-meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (161, 'store-meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (162, 'edit-meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (163, 'delete-meeting', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (164, 'event', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (165, 'view-event', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (166, 'store-event', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (167, 'edit-event', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (168, 'delete-event', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (169, 'role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (170, 'view-role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (171, 'store-role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (172, 'edit-role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (173, 'delete-role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (174, 'assign-module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (175, 'assign-role', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (176, 'assign-ticket', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (177, 'assign-project', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (178, 'assign-task', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (179, 'finance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (180, 'account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (181, 'view-account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (182, 'store-account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (183, 'edit-account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (184, 'delete-account', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (185, 'view-transaction', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (186, 'view-balance_transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (187, 'store-balance_transfer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (188, 'expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (189, 'view-expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (190, 'store-expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (191, 'edit-expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (192, 'delete-expense', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (193, 'deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (194, 'view-deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (195, 'store-deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (196, 'edit-deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (197, 'delete-deposit', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (198, 'payer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (199, 'view-payer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (200, 'store-payer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (201, 'edit-payer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (202, 'delete-payer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (203, 'payee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (204, 'view-payee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (205, 'store-payee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (206, 'edit-payee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (207, 'delete-payee', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (208, 'training_module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (209, 'trainer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (210, 'view-trainer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (211, 'store-trainer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (212, 'edit-trainer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (213, 'delete-trainer', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (214, 'training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (215, 'view-training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (216, 'store-training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (217, 'edit-training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (218, 'delete-training', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (219, 'access-module', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (220, 'access-variable_type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (221, 'access-variable_method', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (222, 'access-language', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (223, 'announcement', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (224, 'store-announcement', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (225, 'edit-announcement', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (226, 'delete-announcement', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (227, 'company', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (228, 'view-company', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (229, 'store-company', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (230, 'edit-company', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (231, 'delete-company', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (232, 'department', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (233, 'view-department', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (234, 'store-department', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (235, 'edit-department', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (236, 'delete-department', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (237, 'designation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (238, 'view-designation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (239, 'store-designation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (240, 'edit-designation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (241, 'delete-designation', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (242, 'location', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (243, 'view-location', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (244, 'store-location', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (245, 'edit-location', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (246, 'delete-location', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (247, 'policy', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (248, 'store-policy', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (249, 'edit-policy', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (250, 'delete-policy', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (251, 'view-cms', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (252, 'store-cms', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (253, 'store-user', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (254, 'delete-attendance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (255, 'view-leave', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (256, 'store-leave', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (257, 'edit-leave', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (258, 'delete-leave', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (259, 'cms', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (260, 'performance', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (261, 'goal-type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (262, 'view-goal-type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (263, 'store-goal-type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (264, 'edit-goal-type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (265, 'delete-goal-type', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (266, 'goal-tracking', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (267, 'view-goal-tracking', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (268, 'store-goal-tracking', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (269, 'edit-goal-tracking', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (270, 'delete-goal-tracking', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (271, 'indicator', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (272, 'view-indicator', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (273, 'store-indicator', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (274, 'edit-indicator', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (275, 'delete-indicator', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (276, 'appraisal', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (277, 'view-appraisal', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (278, 'store-appraisal', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (279, 'edit-appraisal', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (280, 'delete-appraisal', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (281, 'assets-and-category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (282, 'category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (283, 'view-assets-category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (284, 'store-assets-category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (285, 'edit-assets-category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (286, 'delete-assets-category', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (287, 'assets', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (288, 'view-assets', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (289, 'store-assets', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (290, 'edit-assets', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (291, 'delete-assets', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (292, 'daily-attendances', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (293, 'date-wise-attendances', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (294, 'monthly-attendances', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (295, 'set-permission', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (296, 'get-leave-notification', 'web', NULL, NULL);
INSERT INTO `permissions` VALUES (297, 'report-pension', 'web', NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for policies
-- ----------------------------
DROP TABLE IF EXISTS `policies`;
CREATE TABLE `policies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `added_by` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `policies_company_id_foreign` (`company_id`),
  KEY `policies_added_by_foreign` (`added_by`),
  CONSTRAINT `policies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of policies
-- ----------------------------
BEGIN;
INSERT INTO `policies` VALUES (2, 'No smoking', 'No smoking during the office hours.Smoke in the smoking zone if you really have to', 1, 'ash', '2020-07-27 09:56:24', '2020-07-27 09:56:24');
COMMIT;

-- ----------------------------
-- Table structure for project_bugs
-- ----------------------------
DROP TABLE IF EXISTS `project_bugs`;
CREATE TABLE `project_bugs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `bug_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_bugs_user_id_foreign` (`user_id`),
  KEY `project_bugs_project_id_foreign` (`project_id`),
  CONSTRAINT `project_bugs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_bugs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_bugs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for project_discussions
-- ----------------------------
DROP TABLE IF EXISTS `project_discussions`;
CREATE TABLE `project_discussions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `project_discussion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `discussion_attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_discussions_user_id_foreign` (`user_id`),
  KEY `project_discussions_project_id_foreign` (`project_id`),
  CONSTRAINT `project_discussions_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_discussions
-- ----------------------------
BEGIN;
INSERT INTO `project_discussions` VALUES (1, 1, 1, 'Hola', '', '2020-07-28 15:12:38', '2020-07-28 15:12:38');
COMMIT;

-- ----------------------------
-- Table structure for project_files
-- ----------------------------
DROP TABLE IF EXISTS `project_files`;
CREATE TABLE `project_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `file_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_files_user_id_foreign` (`user_id`),
  KEY `project_files_project_id_foreign` (`project_id`),
  CONSTRAINT `project_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_files
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) unsigned DEFAULT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `project_priority` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `summary` mediumtext COLLATE utf8mb4_unicode_ci,
  `project_status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not started',
  `project_note` longtext COLLATE utf8mb4_unicode_ci,
  `project_progress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_client_id_foreign` (`client_id`),
  KEY `projects_company_id_foreign` (`company_id`),
  KEY `projects_added_by_foreign` (`added_by`),
  CONSTRAINT `projects_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `projects_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of projects
-- ----------------------------
BEGIN;
INSERT INTO `projects` VALUES (1, 'Test1', 16, 1, '2021-03-29', '2021-04-02', 'medium', '&lt;ul&gt;\r\n&lt;li&gt;Section 2: Functional Objectives&lt;br /&gt;Each objective gives a desired behavior for the system, a business justification, and a measure to determine if the final system has successfully met the objective. These objectives are organized by priority. In order for the new system to be considered successful, all high priority objectives must be met.&lt;/li&gt;\r\n&lt;li&gt;Section 3: Non-Functional Objectives&lt;br /&gt;This section is organized by category. Each objective specifies a technical requirement or constraint on the overall characteristics of the system. Each objective is measurable.&lt;/li&gt;\r\n&lt;li&gt;Section 4: Context Model&lt;br /&gt;This section gives a text description of the goal of the system, and a pictorial description of the scope of the system in a context diagram. Those entities outside the system that interact with the system are described.&lt;/li&gt;\r\n&lt;/ul&gt;', 'tinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will', 'in_progress', 'Note', '36', NULL, NULL, '2020-07-28 14:58:29', '2020-11-02 02:47:03');
INSERT INTO `projects` VALUES (2, 'Test2', 16, 2, '2021-03-30', '2021-03-31', 'highest', '&lt;ul style=&quot;list-style-type: square;&quot;&gt;\r\n&lt;li&gt;The system shall allow for on-line product ordering by either the customer or the sales agent. For customers, this will eliminate the current delay between their decision to buy and the placement of the order. This will reduce the time a sales agent spends on an order by x%. The cost to process an order will be reduced to $y.&lt;/li&gt;\r\n&lt;li&gt;The system shall reflect a new and changed product description within x minutes of the database being updated by the product owner. This will reduce the number of incidents of incorrectly displayed information by x%. This eliminates the current redundant update of information, saving $y dollars annually.&lt;/li&gt;\r\n&lt;/ul&gt;', 'in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis', 'not_started', NULL, '83', NULL, NULL, '2020-07-28 15:36:47', '2020-11-02 02:47:59');
INSERT INTO `projects` VALUES (3, 'test3', 16, 1, '2021-03-31', '2021-04-04', 'high', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li&gt;&lt;strong&gt;A sales agent should be able to use the system in his job after x days of training.&lt;/strong&gt;&lt;/li&gt;\r\n&lt;li&gt;&lt;strong&gt;A user who already knows what product he is interested in should be able to locate and view that page in x seconds.&lt;/strong&gt;&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '', 'not_started', NULL, '55', NULL, NULL, '2020-08-03 09:26:42', '2020-11-02 02:51:05');
COMMIT;

-- ----------------------------
-- Table structure for promotions
-- ----------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `promotion_title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `promotion_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promotions_company_id_foreign` (`company_id`),
  KEY `promotions_employee_id_foreign` (`employee_id`),
  CONSTRAINT `promotions_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `promotions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of promotions
-- ----------------------------
BEGIN;
INSERT INTO `promotions` VALUES (1, 'Senior Executive 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s', 1, 9, '2021-03-07', '2020-07-27 10:04:35', '2020-08-18 06:45:52');
COMMIT;

-- ----------------------------
-- Table structure for qualification_education_levels
-- ----------------------------
DROP TABLE IF EXISTS `qualification_education_levels`;
CREATE TABLE `qualification_education_levels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qualification_education_levels_company_id_foreign` (`company_id`),
  CONSTRAINT `qualification_education_levels_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of qualification_education_levels
-- ----------------------------
BEGIN;
INSERT INTO `qualification_education_levels` VALUES (1, NULL, 'BSC', '2020-07-27 03:54:02', '2020-07-27 03:54:02');
INSERT INTO `qualification_education_levels` VALUES (2, NULL, 'Diploma', '2020-07-27 03:54:06', '2020-07-27 03:54:06');
INSERT INTO `qualification_education_levels` VALUES (3, NULL, 'BBA', '2020-07-27 03:54:14', '2020-07-27 03:54:14');
COMMIT;

-- ----------------------------
-- Table structure for qualification_languages
-- ----------------------------
DROP TABLE IF EXISTS `qualification_languages`;
CREATE TABLE `qualification_languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qualification_languages_company_id_foreign` (`company_id`),
  CONSTRAINT `qualification_languages_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of qualification_languages
-- ----------------------------
BEGIN;
INSERT INTO `qualification_languages` VALUES (1, NULL, 'English', '2020-10-20 03:32:36', '2020-10-20 03:32:36');
INSERT INTO `qualification_languages` VALUES (2, NULL, 'Arabic', '2020-10-20 03:32:44', '2020-10-20 03:32:44');
COMMIT;

-- ----------------------------
-- Table structure for qualification_skills
-- ----------------------------
DROP TABLE IF EXISTS `qualification_skills`;
CREATE TABLE `qualification_skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qualification_skills_company_id_foreign` (`company_id`),
  CONSTRAINT `qualification_skills_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of qualification_skills
-- ----------------------------
BEGIN;
INSERT INTO `qualification_skills` VALUES (1, NULL, 'MS Word', '2020-10-20 03:32:54', '2020-10-20 03:32:54');
INSERT INTO `qualification_skills` VALUES (2, NULL, 'Photoshop', '2020-10-20 03:33:02', '2020-10-20 03:33:02');
COMMIT;

-- ----------------------------
-- Table structure for resignations
-- ----------------------------
DROP TABLE IF EXISTS `resignations`;
CREATE TABLE `resignations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `notice_date` date DEFAULT NULL,
  `resignation_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resignations_company_id_foreign` (`company_id`),
  KEY `resignations_department_id_foreign` (`department_id`),
  KEY `resignations_employee_id_foreign` (`employee_id`),
  CONSTRAINT `resignations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resignations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resignations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of resignations
-- ----------------------------
BEGIN;
INSERT INTO `resignations` VALUES (1, 'Sed ut cc unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo', 1, 3, 12, '2021-04-01', '2021-04-08', '2020-07-27 16:54:41', '2020-07-27 17:13:23');
COMMIT;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
BEGIN;
INSERT INTO `role_has_permissions` VALUES (1, 5);
INSERT INTO `role_has_permissions` VALUES (2, 5);
INSERT INTO `role_has_permissions` VALUES (3, 5);
INSERT INTO `role_has_permissions` VALUES (4, 5);
INSERT INTO `role_has_permissions` VALUES (5, 5);
INSERT INTO `role_has_permissions` VALUES (6, 5);
INSERT INTO `role_has_permissions` VALUES (7, 5);
INSERT INTO `role_has_permissions` VALUES (8, 5);
INSERT INTO `role_has_permissions` VALUES (9, 5);
INSERT INTO `role_has_permissions` VALUES (10, 5);
INSERT INTO `role_has_permissions` VALUES (11, 5);
INSERT INTO `role_has_permissions` VALUES (13, 5);
INSERT INTO `role_has_permissions` VALUES (14, 5);
INSERT INTO `role_has_permissions` VALUES (15, 5);
INSERT INTO `role_has_permissions` VALUES (16, 5);
INSERT INTO `role_has_permissions` VALUES (17, 5);
INSERT INTO `role_has_permissions` VALUES (18, 5);
INSERT INTO `role_has_permissions` VALUES (20, 5);
INSERT INTO `role_has_permissions` VALUES (21, 5);
INSERT INTO `role_has_permissions` VALUES (22, 5);
INSERT INTO `role_has_permissions` VALUES (23, 5);
INSERT INTO `role_has_permissions` VALUES (24, 5);
INSERT INTO `role_has_permissions` VALUES (25, 5);
INSERT INTO `role_has_permissions` VALUES (26, 5);
INSERT INTO `role_has_permissions` VALUES (27, 5);
INSERT INTO `role_has_permissions` VALUES (28, 5);
INSERT INTO `role_has_permissions` VALUES (29, 5);
INSERT INTO `role_has_permissions` VALUES (30, 5);
INSERT INTO `role_has_permissions` VALUES (31, 5);
INSERT INTO `role_has_permissions` VALUES (32, 5);
INSERT INTO `role_has_permissions` VALUES (33, 5);
INSERT INTO `role_has_permissions` VALUES (34, 5);
INSERT INTO `role_has_permissions` VALUES (35, 5);
INSERT INTO `role_has_permissions` VALUES (36, 5);
INSERT INTO `role_has_permissions` VALUES (37, 5);
INSERT INTO `role_has_permissions` VALUES (38, 5);
INSERT INTO `role_has_permissions` VALUES (39, 5);
INSERT INTO `role_has_permissions` VALUES (41, 5);
INSERT INTO `role_has_permissions` VALUES (42, 5);
INSERT INTO `role_has_permissions` VALUES (43, 5);
INSERT INTO `role_has_permissions` VALUES (44, 5);
INSERT INTO `role_has_permissions` VALUES (46, 5);
INSERT INTO `role_has_permissions` VALUES (47, 5);
INSERT INTO `role_has_permissions` VALUES (48, 5);
INSERT INTO `role_has_permissions` VALUES (49, 5);
INSERT INTO `role_has_permissions` VALUES (50, 5);
INSERT INTO `role_has_permissions` VALUES (51, 5);
INSERT INTO `role_has_permissions` VALUES (52, 5);
INSERT INTO `role_has_permissions` VALUES (53, 5);
INSERT INTO `role_has_permissions` VALUES (54, 5);
INSERT INTO `role_has_permissions` VALUES (55, 5);
INSERT INTO `role_has_permissions` VALUES (56, 5);
INSERT INTO `role_has_permissions` VALUES (57, 5);
INSERT INTO `role_has_permissions` VALUES (58, 5);
INSERT INTO `role_has_permissions` VALUES (59, 5);
INSERT INTO `role_has_permissions` VALUES (60, 5);
INSERT INTO `role_has_permissions` VALUES (61, 5);
INSERT INTO `role_has_permissions` VALUES (62, 5);
INSERT INTO `role_has_permissions` VALUES (63, 5);
INSERT INTO `role_has_permissions` VALUES (64, 5);
INSERT INTO `role_has_permissions` VALUES (65, 5);
INSERT INTO `role_has_permissions` VALUES (66, 5);
INSERT INTO `role_has_permissions` VALUES (67, 5);
INSERT INTO `role_has_permissions` VALUES (68, 5);
INSERT INTO `role_has_permissions` VALUES (69, 5);
INSERT INTO `role_has_permissions` VALUES (70, 5);
INSERT INTO `role_has_permissions` VALUES (71, 5);
INSERT INTO `role_has_permissions` VALUES (72, 5);
INSERT INTO `role_has_permissions` VALUES (73, 5);
INSERT INTO `role_has_permissions` VALUES (74, 5);
INSERT INTO `role_has_permissions` VALUES (75, 5);
INSERT INTO `role_has_permissions` VALUES (76, 5);
INSERT INTO `role_has_permissions` VALUES (81, 5);
INSERT INTO `role_has_permissions` VALUES (82, 5);
INSERT INTO `role_has_permissions` VALUES (83, 5);
INSERT INTO `role_has_permissions` VALUES (84, 5);
INSERT INTO `role_has_permissions` VALUES (85, 5);
INSERT INTO `role_has_permissions` VALUES (86, 5);
INSERT INTO `role_has_permissions` VALUES (87, 5);
INSERT INTO `role_has_permissions` VALUES (90, 5);
INSERT INTO `role_has_permissions` VALUES (91, 5);
INSERT INTO `role_has_permissions` VALUES (92, 5);
INSERT INTO `role_has_permissions` VALUES (93, 5);
INSERT INTO `role_has_permissions` VALUES (94, 5);
INSERT INTO `role_has_permissions` VALUES (95, 5);
INSERT INTO `role_has_permissions` VALUES (96, 5);
INSERT INTO `role_has_permissions` VALUES (97, 5);
INSERT INTO `role_has_permissions` VALUES (98, 5);
INSERT INTO `role_has_permissions` VALUES (104, 5);
INSERT INTO `role_has_permissions` VALUES (105, 5);
INSERT INTO `role_has_permissions` VALUES (106, 5);
INSERT INTO `role_has_permissions` VALUES (107, 5);
INSERT INTO `role_has_permissions` VALUES (108, 5);
INSERT INTO `role_has_permissions` VALUES (109, 5);
INSERT INTO `role_has_permissions` VALUES (110, 5);
INSERT INTO `role_has_permissions` VALUES (112, 5);
INSERT INTO `role_has_permissions` VALUES (113, 5);
INSERT INTO `role_has_permissions` VALUES (114, 5);
INSERT INTO `role_has_permissions` VALUES (115, 5);
INSERT INTO `role_has_permissions` VALUES (116, 5);
INSERT INTO `role_has_permissions` VALUES (117, 5);
INSERT INTO `role_has_permissions` VALUES (118, 5);
INSERT INTO `role_has_permissions` VALUES (119, 5);
INSERT INTO `role_has_permissions` VALUES (120, 5);
INSERT INTO `role_has_permissions` VALUES (121, 5);
INSERT INTO `role_has_permissions` VALUES (122, 5);
INSERT INTO `role_has_permissions` VALUES (123, 5);
INSERT INTO `role_has_permissions` VALUES (124, 5);
INSERT INTO `role_has_permissions` VALUES (125, 5);
INSERT INTO `role_has_permissions` VALUES (126, 5);
INSERT INTO `role_has_permissions` VALUES (127, 5);
INSERT INTO `role_has_permissions` VALUES (128, 5);
INSERT INTO `role_has_permissions` VALUES (129, 5);
INSERT INTO `role_has_permissions` VALUES (130, 5);
INSERT INTO `role_has_permissions` VALUES (131, 5);
INSERT INTO `role_has_permissions` VALUES (132, 5);
INSERT INTO `role_has_permissions` VALUES (133, 5);
INSERT INTO `role_has_permissions` VALUES (134, 5);
INSERT INTO `role_has_permissions` VALUES (135, 5);
INSERT INTO `role_has_permissions` VALUES (136, 5);
INSERT INTO `role_has_permissions` VALUES (137, 5);
INSERT INTO `role_has_permissions` VALUES (138, 5);
INSERT INTO `role_has_permissions` VALUES (139, 5);
INSERT INTO `role_has_permissions` VALUES (140, 5);
INSERT INTO `role_has_permissions` VALUES (141, 5);
INSERT INTO `role_has_permissions` VALUES (142, 5);
INSERT INTO `role_has_permissions` VALUES (144, 5);
INSERT INTO `role_has_permissions` VALUES (145, 5);
INSERT INTO `role_has_permissions` VALUES (146, 5);
INSERT INTO `role_has_permissions` VALUES (147, 5);
INSERT INTO `role_has_permissions` VALUES (148, 5);
INSERT INTO `role_has_permissions` VALUES (149, 5);
INSERT INTO `role_has_permissions` VALUES (150, 5);
INSERT INTO `role_has_permissions` VALUES (151, 5);
INSERT INTO `role_has_permissions` VALUES (152, 5);
INSERT INTO `role_has_permissions` VALUES (153, 5);
INSERT INTO `role_has_permissions` VALUES (154, 5);
INSERT INTO `role_has_permissions` VALUES (156, 5);
INSERT INTO `role_has_permissions` VALUES (157, 5);
INSERT INTO `role_has_permissions` VALUES (158, 5);
INSERT INTO `role_has_permissions` VALUES (159, 5);
INSERT INTO `role_has_permissions` VALUES (160, 5);
INSERT INTO `role_has_permissions` VALUES (161, 5);
INSERT INTO `role_has_permissions` VALUES (162, 5);
INSERT INTO `role_has_permissions` VALUES (163, 5);
INSERT INTO `role_has_permissions` VALUES (164, 5);
INSERT INTO `role_has_permissions` VALUES (165, 5);
INSERT INTO `role_has_permissions` VALUES (166, 5);
INSERT INTO `role_has_permissions` VALUES (167, 5);
INSERT INTO `role_has_permissions` VALUES (168, 5);
INSERT INTO `role_has_permissions` VALUES (169, 5);
INSERT INTO `role_has_permissions` VALUES (170, 5);
INSERT INTO `role_has_permissions` VALUES (171, 5);
INSERT INTO `role_has_permissions` VALUES (172, 5);
INSERT INTO `role_has_permissions` VALUES (173, 5);
INSERT INTO `role_has_permissions` VALUES (176, 5);
INSERT INTO `role_has_permissions` VALUES (177, 5);
INSERT INTO `role_has_permissions` VALUES (178, 5);
INSERT INTO `role_has_permissions` VALUES (179, 5);
INSERT INTO `role_has_permissions` VALUES (180, 5);
INSERT INTO `role_has_permissions` VALUES (181, 5);
INSERT INTO `role_has_permissions` VALUES (182, 5);
INSERT INTO `role_has_permissions` VALUES (183, 5);
INSERT INTO `role_has_permissions` VALUES (184, 5);
INSERT INTO `role_has_permissions` VALUES (185, 5);
INSERT INTO `role_has_permissions` VALUES (186, 5);
INSERT INTO `role_has_permissions` VALUES (187, 5);
INSERT INTO `role_has_permissions` VALUES (188, 5);
INSERT INTO `role_has_permissions` VALUES (189, 5);
INSERT INTO `role_has_permissions` VALUES (190, 5);
INSERT INTO `role_has_permissions` VALUES (191, 5);
INSERT INTO `role_has_permissions` VALUES (192, 5);
INSERT INTO `role_has_permissions` VALUES (193, 5);
INSERT INTO `role_has_permissions` VALUES (194, 5);
INSERT INTO `role_has_permissions` VALUES (195, 5);
INSERT INTO `role_has_permissions` VALUES (196, 5);
INSERT INTO `role_has_permissions` VALUES (197, 5);
INSERT INTO `role_has_permissions` VALUES (198, 5);
INSERT INTO `role_has_permissions` VALUES (199, 5);
INSERT INTO `role_has_permissions` VALUES (200, 5);
INSERT INTO `role_has_permissions` VALUES (201, 5);
INSERT INTO `role_has_permissions` VALUES (202, 5);
INSERT INTO `role_has_permissions` VALUES (203, 5);
INSERT INTO `role_has_permissions` VALUES (204, 5);
INSERT INTO `role_has_permissions` VALUES (205, 5);
INSERT INTO `role_has_permissions` VALUES (206, 5);
INSERT INTO `role_has_permissions` VALUES (207, 5);
INSERT INTO `role_has_permissions` VALUES (208, 5);
INSERT INTO `role_has_permissions` VALUES (209, 5);
INSERT INTO `role_has_permissions` VALUES (210, 5);
INSERT INTO `role_has_permissions` VALUES (211, 5);
INSERT INTO `role_has_permissions` VALUES (212, 5);
INSERT INTO `role_has_permissions` VALUES (213, 5);
INSERT INTO `role_has_permissions` VALUES (214, 5);
INSERT INTO `role_has_permissions` VALUES (215, 5);
INSERT INTO `role_has_permissions` VALUES (216, 5);
INSERT INTO `role_has_permissions` VALUES (217, 5);
INSERT INTO `role_has_permissions` VALUES (218, 5);
INSERT INTO `role_has_permissions` VALUES (220, 5);
INSERT INTO `role_has_permissions` VALUES (221, 5);
INSERT INTO `role_has_permissions` VALUES (222, 5);
INSERT INTO `role_has_permissions` VALUES (223, 5);
INSERT INTO `role_has_permissions` VALUES (224, 5);
INSERT INTO `role_has_permissions` VALUES (225, 5);
INSERT INTO `role_has_permissions` VALUES (226, 5);
INSERT INTO `role_has_permissions` VALUES (227, 5);
INSERT INTO `role_has_permissions` VALUES (228, 5);
INSERT INTO `role_has_permissions` VALUES (229, 5);
INSERT INTO `role_has_permissions` VALUES (230, 5);
INSERT INTO `role_has_permissions` VALUES (231, 5);
INSERT INTO `role_has_permissions` VALUES (232, 5);
INSERT INTO `role_has_permissions` VALUES (233, 5);
INSERT INTO `role_has_permissions` VALUES (234, 5);
INSERT INTO `role_has_permissions` VALUES (235, 5);
INSERT INTO `role_has_permissions` VALUES (236, 5);
INSERT INTO `role_has_permissions` VALUES (237, 5);
INSERT INTO `role_has_permissions` VALUES (238, 5);
INSERT INTO `role_has_permissions` VALUES (239, 5);
INSERT INTO `role_has_permissions` VALUES (240, 5);
INSERT INTO `role_has_permissions` VALUES (241, 5);
INSERT INTO `role_has_permissions` VALUES (242, 5);
INSERT INTO `role_has_permissions` VALUES (243, 5);
INSERT INTO `role_has_permissions` VALUES (244, 5);
INSERT INTO `role_has_permissions` VALUES (245, 5);
INSERT INTO `role_has_permissions` VALUES (246, 5);
INSERT INTO `role_has_permissions` VALUES (247, 5);
INSERT INTO `role_has_permissions` VALUES (248, 5);
INSERT INTO `role_has_permissions` VALUES (249, 5);
INSERT INTO `role_has_permissions` VALUES (250, 5);
INSERT INTO `role_has_permissions` VALUES (251, 5);
INSERT INTO `role_has_permissions` VALUES (252, 5);
INSERT INTO `role_has_permissions` VALUES (253, 5);
INSERT INTO `role_has_permissions` VALUES (254, 5);
INSERT INTO `role_has_permissions` VALUES (255, 5);
INSERT INTO `role_has_permissions` VALUES (256, 5);
INSERT INTO `role_has_permissions` VALUES (257, 5);
INSERT INTO `role_has_permissions` VALUES (258, 5);
INSERT INTO `role_has_permissions` VALUES (259, 5);
INSERT INTO `role_has_permissions` VALUES (260, 5);
INSERT INTO `role_has_permissions` VALUES (261, 5);
INSERT INTO `role_has_permissions` VALUES (262, 5);
INSERT INTO `role_has_permissions` VALUES (263, 5);
INSERT INTO `role_has_permissions` VALUES (264, 5);
INSERT INTO `role_has_permissions` VALUES (265, 5);
INSERT INTO `role_has_permissions` VALUES (266, 5);
INSERT INTO `role_has_permissions` VALUES (267, 5);
INSERT INTO `role_has_permissions` VALUES (268, 5);
INSERT INTO `role_has_permissions` VALUES (269, 5);
INSERT INTO `role_has_permissions` VALUES (270, 5);
INSERT INTO `role_has_permissions` VALUES (271, 5);
INSERT INTO `role_has_permissions` VALUES (272, 5);
INSERT INTO `role_has_permissions` VALUES (273, 5);
INSERT INTO `role_has_permissions` VALUES (274, 5);
INSERT INTO `role_has_permissions` VALUES (275, 5);
INSERT INTO `role_has_permissions` VALUES (276, 5);
INSERT INTO `role_has_permissions` VALUES (277, 5);
INSERT INTO `role_has_permissions` VALUES (278, 5);
INSERT INTO `role_has_permissions` VALUES (279, 5);
INSERT INTO `role_has_permissions` VALUES (280, 5);
INSERT INTO `role_has_permissions` VALUES (281, 5);
INSERT INTO `role_has_permissions` VALUES (282, 5);
INSERT INTO `role_has_permissions` VALUES (283, 5);
INSERT INTO `role_has_permissions` VALUES (284, 5);
INSERT INTO `role_has_permissions` VALUES (285, 5);
INSERT INTO `role_has_permissions` VALUES (286, 5);
INSERT INTO `role_has_permissions` VALUES (287, 5);
INSERT INTO `role_has_permissions` VALUES (288, 5);
INSERT INTO `role_has_permissions` VALUES (289, 5);
INSERT INTO `role_has_permissions` VALUES (290, 5);
INSERT INTO `role_has_permissions` VALUES (291, 5);
INSERT INTO `role_has_permissions` VALUES (292, 5);
INSERT INTO `role_has_permissions` VALUES (293, 5);
INSERT INTO `role_has_permissions` VALUES (294, 5);
INSERT INTO `role_has_permissions` VALUES (295, 5);
INSERT INTO `role_has_permissions` VALUES (296, 5);
INSERT INTO `role_has_permissions` VALUES (297, 5);
COMMIT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'admin', 'web', 'Can access and change everything', 1, NULL, NULL);
INSERT INTO `roles` VALUES (2, 'employee', 'web', 'Default access', 1, '2020-07-26 13:50:45', '2020-07-26 13:50:45');
INSERT INTO `roles` VALUES (3, 'client', 'web', 'When you create a client, this role and associated.', 1, '2020-10-08 03:10:23', '2020-10-08 03:10:23');
INSERT INTO `roles` VALUES (4, 'Manager', 'web', 'Can Manage', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58');
INSERT INTO `roles` VALUES (5, 'Editor', 'web', 'Custom access', 1, '2021-02-24 10:24:58', '2021-02-24 10:24:58');
INSERT INTO `roles` VALUES (6, 'HR', 'web', '', 1, '2021-09-05 03:12:28', '2021-09-05 03:12:28');
COMMIT;

-- ----------------------------
-- Table structure for salary_allowances
-- ----------------------------
DROP TABLE IF EXISTS `salary_allowances`;
CREATE TABLE `salary_allowances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `allowance_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowance_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_taxable` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_allowances_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_allowances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_allowances
-- ----------------------------
BEGIN;
INSERT INTO `salary_allowances` VALUES (1, 11, 'January-2021', '2021-01-01', 'Home', '200', 0, '2020-07-29 16:10:53', '2020-07-29 16:10:53');
INSERT INTO `salary_allowances` VALUES (2, 11, 'January-2021', '2021-01-01', 'Tea', '50', 0, '2020-07-29 18:08:42', '2020-07-29 18:08:42');
INSERT INTO `salary_allowances` VALUES (3, 12, 'January-2021', '2021-01-01', 'Snacks', '50', 0, '2020-10-20 04:01:55', '2020-10-20 04:01:55');
INSERT INTO `salary_allowances` VALUES (4, 12, 'January-2021', '2021-01-01', 'Transport', '60', 0, '2020-10-20 04:02:25', '2020-10-20 04:02:25');
INSERT INTO `salary_allowances` VALUES (5, 9, 'January-2021', '2021-01-01', 'xyz', '75', 1, '2021-01-25 19:01:56', '2021-04-09 01:37:55');
INSERT INTO `salary_allowances` VALUES (8, 10, 'January-2021', '2021-01-01', 'Tea', '10', 0, '2021-01-27 00:40:48', '2021-01-27 00:40:48');
INSERT INTO `salary_allowances` VALUES (9, 10, 'January-2021', '2021-01-01', 'Snacks', '50', 0, '2021-01-27 00:40:58', '2021-01-27 00:40:58');
INSERT INTO `salary_allowances` VALUES (10, 13, 'January-2021', '2021-01-01', 'Home', '100', 0, '2021-01-27 01:11:57', '2021-01-27 01:11:57');
INSERT INTO `salary_allowances` VALUES (11, 13, 'January-2021', '2021-01-01', 'Tea', '20', 0, '2021-01-27 01:12:09', '2021-01-27 01:12:09');
INSERT INTO `salary_allowances` VALUES (12, 14, 'January-2021', '2021-01-01', 'Tea', '10', 0, '2021-01-27 01:34:45', '2021-01-27 01:34:45');
INSERT INTO `salary_allowances` VALUES (13, 9, 'April-2021', '2021-04-01', 'Tea', '50', 0, '2021-04-09 00:35:35', '2021-04-09 01:47:08');
INSERT INTO `salary_allowances` VALUES (14, 9, 'April-2021', '2021-04-01', 'Coffee', '50', 0, '2021-04-09 01:39:02', '2021-04-09 01:47:22');
INSERT INTO `salary_allowances` VALUES (15, 9, 'August-2021', '2021-08-01', 'Milk', '200', 0, '2021-04-09 05:38:21', '2021-04-09 05:38:21');
INSERT INTO `salary_allowances` VALUES (16, 11, 'October-2022', '2022-10-01', 'Transportation', '10', 0, '2022-10-18 15:17:19', '2022-10-18 15:17:19');
INSERT INTO `salary_allowances` VALUES (17, 11, 'October-2022', '2022-10-01', 'Communication', '10', 0, '2022-10-18 15:17:44', '2022-10-18 15:17:44');
COMMIT;

-- ----------------------------
-- Table structure for salary_basics
-- ----------------------------
DROP TABLE IF EXISTS `salary_basics`;
CREATE TABLE `salary_basics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `payslip_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `basic_salary` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_basics_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_basics_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_basics
-- ----------------------------
BEGIN;
INSERT INTO `salary_basics` VALUES (1, 9, 'January-2021', '2021-01-01', 'Monthly', 500, NULL, '2022-02-27 06:44:40');
INSERT INTO `salary_basics` VALUES (2, 9, 'April-2021', '2021-04-01', 'Monthly', 700, NULL, '2022-02-27 06:45:00');
INSERT INTO `salary_basics` VALUES (3, 9, 'February-2021', '2021-02-01', 'Monthly', 10, '2021-04-06 01:29:14', '2022-02-27 06:44:50');
INSERT INTO `salary_basics` VALUES (4, 15, 'March-2021', '2021-03-01', 'Monthly', 100, '2021-04-06 03:58:59', '2021-04-06 04:36:34');
INSERT INTO `salary_basics` VALUES (6, 15, 'April-2021', '2021-04-01', 'Monthly', 200, '2021-04-06 04:17:33', '2021-04-06 05:06:44');
INSERT INTO `salary_basics` VALUES (8, 10, 'March-2021', '2021-03-01', 'Monthly', 200, '2021-04-08 15:10:23', '2021-04-08 15:10:42');
INSERT INTO `salary_basics` VALUES (9, 10, 'February-2021', '2021-02-01', 'Monthly', 150, '2021-04-08 15:12:21', '2021-04-08 15:12:21');
INSERT INTO `salary_basics` VALUES (10, 11, 'January-2021', '2021-01-01', 'Hourly', 100, '2021-04-08 15:14:20', '2021-04-08 15:14:20');
INSERT INTO `salary_basics` VALUES (11, 12, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:14:48', '2021-04-08 15:14:48');
INSERT INTO `salary_basics` VALUES (12, 13, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:15:05', '2021-04-08 15:15:05');
INSERT INTO `salary_basics` VALUES (13, 14, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:15:23', '2021-04-08 15:15:23');
INSERT INTO `salary_basics` VALUES (14, 27, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:15:53', '2021-04-08 15:15:53');
INSERT INTO `salary_basics` VALUES (15, 34, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:16:21', '2021-04-08 15:16:21');
INSERT INTO `salary_basics` VALUES (16, 38, 'January-2021', '2021-01-01', 'Monthly', 100, '2021-04-08 15:16:38', '2021-04-08 15:16:38');
INSERT INTO `salary_basics` VALUES (23, 9, 'July-2021', '2021-07-01', 'Monthly', 500, '2021-07-17 01:16:42', '2022-02-27 06:45:12');
INSERT INTO `salary_basics` VALUES (24, 49, 'February-2022', '2022-02-01', 'Monthly', 10, '2022-02-26 07:29:12', '2022-02-26 07:29:12');
INSERT INTO `salary_basics` VALUES (25, 11, 'October-2022', '2022-10-01', 'Monthly', 100, '2022-10-18 15:15:31', '2022-10-18 15:15:31');
COMMIT;

-- ----------------------------
-- Table structure for salary_commissions
-- ----------------------------
DROP TABLE IF EXISTS `salary_commissions`;
CREATE TABLE `salary_commissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `commission_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_commissions_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_commissions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_commissions
-- ----------------------------
BEGIN;
INSERT INTO `salary_commissions` VALUES (1, 11, 'January-2021', 'Sale', '2021-01-01', '20', '2020-07-29 18:13:30', '2020-07-29 18:13:30');
INSERT INTO `salary_commissions` VALUES (2, 12, 'January-2021', 'Sale Increase', '2021-01-01', '15', '2020-10-20 04:04:58', '2020-10-20 04:04:58');
INSERT INTO `salary_commissions` VALUES (13, 12, 'January-2021', 'Work Rate', '2021-01-01', '10', '2020-10-20 04:39:15', '2020-10-20 04:39:15');
INSERT INTO `salary_commissions` VALUES (17, 10, 'January-2021', 'Sale', '2021-01-01', '50', '2021-01-27 01:04:32', '2021-01-27 01:04:32');
INSERT INTO `salary_commissions` VALUES (18, 13, 'January-2021', 'Sale', '2021-01-01', '20', '2021-01-27 01:12:55', '2021-01-27 01:12:55');
INSERT INTO `salary_commissions` VALUES (19, 14, 'January-2021', 'Sale', '2021-01-01', '10', '2021-01-27 01:35:16', '2021-01-27 01:35:16');
INSERT INTO `salary_commissions` VALUES (20, 9, 'January-2021', 'Sale', '2021-01-01', '100', '2021-04-09 15:36:18', '2021-04-09 15:44:58');
INSERT INTO `salary_commissions` VALUES (21, 9, 'April-2021', 'Performance', '2021-04-01', '200', '2021-04-09 15:42:48', '2021-04-09 15:42:48');
INSERT INTO `salary_commissions` VALUES (22, 9, 'April-2021', 'XYZ', '2021-04-01', '50', '2021-04-09 16:01:54', '2021-04-09 16:01:54');
COMMIT;

-- ----------------------------
-- Table structure for salary_deductions
-- ----------------------------
DROP TABLE IF EXISTS `salary_deductions`;
CREATE TABLE `salary_deductions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `deduction_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deduction_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deduction_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_deductions_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_deductions_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_deductions
-- ----------------------------
BEGIN;
INSERT INTO `salary_deductions` VALUES (1, 11, 'January-2021', '2021-01-01', 'Test', '10', 'Health Insurance Corporation', '2020-07-29 18:21:22', '2020-07-29 18:21:22');
INSERT INTO `salary_deductions` VALUES (2, 12, 'January-2021', '2021-01-01', 'Development tax', '5', 'Home Development Mutual Fund', '2020-10-20 04:50:01', '2020-10-20 04:50:01');
INSERT INTO `salary_deductions` VALUES (5, 10, 'January-2021', '2021-01-01', 'Testing', '50', 'Other Statutory Deduction', '2021-01-27 00:43:37', '2021-01-27 00:43:37');
INSERT INTO `salary_deductions` VALUES (6, 13, 'January-2021', '2021-01-01', 'Health', '100', 'Health Insurance Corporation', '2021-01-27 01:13:31', '2021-01-27 01:13:31');
INSERT INTO `salary_deductions` VALUES (7, 14, 'January-2021', '2021-01-01', 'Health', '10', 'Health Insurance Corporation', '2021-01-27 01:35:37', '2021-01-27 01:35:37');
INSERT INTO `salary_deductions` VALUES (8, 9, 'January-2021', '2021-01-01', 'Tax', '20', 'Social Security System', '2021-04-10 12:55:34', '2021-04-10 12:55:34');
INSERT INTO `salary_deductions` VALUES (10, 9, 'April-2021', '2021-04-01', 'Fever', '100', 'Health Insurance Corporation', '2021-04-10 13:16:30', '2021-04-10 13:16:30');
INSERT INTO `salary_deductions` VALUES (11, 11, 'October-2022', '2022-10-01', 'Medical', '15', 'Health Insurance Corporation', '2022-10-18 15:19:18', '2022-10-18 15:19:18');
COMMIT;

-- ----------------------------
-- Table structure for salary_loans
-- ----------------------------
DROP TABLE IF EXISTS `salary_loans`;
CREATE TABLE `salary_loans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `loan_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loan_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_remaining` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_remaining` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monthly_payable` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_loans_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_loans
-- ----------------------------
BEGIN;
INSERT INTO `salary_loans` VALUES (7, 38, 'February-2021', '2021-02-01', 'Health', '100', 'Social Security System Loan', '4', '50', '2', '25.000', 'Health', '2021-04-11 04:50:18', '2021-04-14 16:17:30');
INSERT INTO `salary_loans` VALUES (8, 11, 'March-2021', '2021-03-01', 'Home', '100', 'Home Development Mutual Fund Loan', '4', '0', '0', '0', 'Make House', '2021-04-11 12:43:20', '2022-10-18 15:22:39');
INSERT INTO `salary_loans` VALUES (9, 11, 'October-2022', '2022-10-01', 'Home', '50', 'Home Development Mutual Fund Loan', '1', '0', '0', '50.00', '', '2022-10-18 15:18:13', '2022-10-18 15:22:39');
INSERT INTO `salary_loans` VALUES (13, 12, 'October-2022', '2022-10-01', 'Test 12', '20', 'Social Security System Loan', '2', '0', '0', '0', 'Test', '2022-10-25 07:39:50', '2022-10-25 07:42:42');
COMMIT;

-- ----------------------------
-- Table structure for salary_other_payments
-- ----------------------------
DROP TABLE IF EXISTS `salary_other_payments`;
CREATE TABLE `salary_other_payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `first_date` date DEFAULT NULL,
  `other_payment_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_payment_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_other_payments_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_other_payments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_other_payments
-- ----------------------------
BEGIN;
INSERT INTO `salary_other_payments` VALUES (1, 12, 'January-2021', '2021-01-01', 'Pefomance Bonus', '15', '2020-10-20 04:54:43', '2020-10-20 04:55:44');
INSERT INTO `salary_other_payments` VALUES (2, 9, 'January-2021', '2021-01-01', 'Clean', '150', '2021-04-10 15:05:16', '2021-04-10 15:05:16');
INSERT INTO `salary_other_payments` VALUES (3, 9, 'April-2021', '2021-04-01', 'abc', '50', '2021-04-10 15:06:18', '2021-04-10 15:06:18');
INSERT INTO `salary_other_payments` VALUES (4, 9, 'April-2021', '2021-04-01', 'xyz', '50', '2021-04-10 15:22:47', '2021-04-10 15:22:47');
INSERT INTO `salary_other_payments` VALUES (5, 11, 'October-2022', '2022-10-01', 'Reimbursement', '11', '2022-10-18 15:19:39', '2022-10-18 15:19:39');
COMMIT;

-- ----------------------------
-- Table structure for salary_overtimes
-- ----------------------------
DROP TABLE IF EXISTS `salary_overtimes`;
CREATE TABLE `salary_overtimes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `month_year` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_date` date DEFAULT NULL,
  `overtime_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_of_days` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtime_hours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtime_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overtime_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_overtimes_employee_id_foreign` (`employee_id`),
  CONSTRAINT `salary_overtimes_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of salary_overtimes
-- ----------------------------
BEGIN;
INSERT INTO `salary_overtimes` VALUES (1, 11, '', NULL, 'Test Overtime', '2', '20', '20', '400', '2020-07-29 18:23:33', '2020-07-29 18:23:33');
INSERT INTO `salary_overtimes` VALUES (2, 11, '', NULL, 'test overtime 2', '3', '10', '3', '30', '2020-07-29 18:24:20', '2020-07-29 18:24:20');
INSERT INTO `salary_overtimes` VALUES (3, 12, '', NULL, 'Night Shift', '5', '10', '5', '50', '2020-10-20 05:00:15', '2020-10-20 05:00:15');
INSERT INTO `salary_overtimes` VALUES (4, 12, '', NULL, 'Production Hour', '2', '2', '5', '10', '2020-10-20 05:00:47', '2020-10-20 05:00:47');
INSERT INTO `salary_overtimes` VALUES (8, 10, '', NULL, 'Advance Work', '5', '25', '20', '500', '2021-01-27 00:45:01', '2021-01-27 00:45:01');
INSERT INTO `salary_overtimes` VALUES (9, 13, '', NULL, 'Advance Work', '5', '20', '10', '200', '2021-01-27 01:14:09', '2021-01-27 01:14:09');
INSERT INTO `salary_overtimes` VALUES (10, 14, '', NULL, 'Advance Work', '7', '10', '10', '100', '2021-01-27 01:36:03', '2021-01-27 01:36:03');
INSERT INTO `salary_overtimes` VALUES (11, 9, 'January-2021', '2021-01-01', 'Project-1', '2', '10', '5', '50', '2021-04-10 16:47:20', '2021-04-10 16:47:37');
INSERT INTO `salary_overtimes` VALUES (12, 9, 'April-2021', '2021-04-01', 'Project-2', '5', '10', '3', '30', '2021-04-10 16:52:35', '2021-04-10 17:08:14');
INSERT INTO `salary_overtimes` VALUES (13, 9, 'April-2021', '2021-04-01', 'Project-3', '3', '5', '2', '10', '2021-04-10 16:53:13', '2021-04-10 16:53:13');
INSERT INTO `salary_overtimes` VALUES (14, 11, 'October-2022', '2022-10-01', 'OT', '4', '8', '0.5', '4', '2022-10-18 15:20:06', '2022-10-18 15:20:06');
COMMIT;

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of statuses
-- ----------------------------
BEGIN;
INSERT INTO `statuses` VALUES (1, 'full-time', '2020-07-26 20:24:16', '2020-07-26 20:24:16');
INSERT INTO `statuses` VALUES (2, 'part-time', '2020-07-26 20:24:26', '2020-07-26 20:24:26');
INSERT INTO `statuses` VALUES (3, 'internship', '2020-07-26 20:24:42', '2020-07-26 20:24:42');
INSERT INTO `statuses` VALUES (4, 'terminated', '2020-07-26 20:24:49', '2020-07-26 20:24:49');
COMMIT;

-- ----------------------------
-- Table structure for support_tickets
-- ----------------------------
DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE `support_tickets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `department_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `ticket_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_priority` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `ticket_remarks` mediumtext COLLATE utf8mb4_unicode_ci,
  `ticket_status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `ticket_attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `support_tickets_ticket_code_unique` (`ticket_code`),
  KEY `support_tickets_company_id_foreign` (`company_id`),
  KEY `support_tickets_department_id_foreign` (`department_id`),
  KEY `support_tickets_employee_id_foreign` (`employee_id`),
  CONSTRAINT `support_tickets_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `support_tickets_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `support_tickets_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of support_tickets
-- ----------------------------
BEGIN;
INSERT INTO `support_tickets` VALUES (1, 1, 3, 12, 'Kkqx8gSB', 'Broadcast Issue', 'medium', NULL, 'ASAP', 'open', 'Fix Asap', NULL, 'ticket_Kkqx8gSB.png', '2020-07-28 16:59:08', '2020-07-28 17:06:02');
INSERT INTO `support_tickets` VALUES (2, 1, 1, 9, 'BYrKY0X8', 'Screen Issue', 'medium', '&lt;p&gt;lorem ipsum&lt;strong&gt; lorem&lt;/strong&gt;&lt;/p&gt;', NULL, 'pending', 'fix this issue ASAP', NULL, 'ticket_BYrKY0X8.pdf', '2020-08-03 06:17:26', '2020-08-03 06:17:26');
COMMIT;

-- ----------------------------
-- Table structure for task_discussions
-- ----------------------------
DROP TABLE IF EXISTS `task_discussions`;
CREATE TABLE `task_discussions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `task_discussion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_discussions_user_id_foreign` (`user_id`),
  KEY `task_discussions_task_id_foreign` (`task_id`),
  CONSTRAINT `task_discussions_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_discussions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of task_discussions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for task_files
-- ----------------------------
DROP TABLE IF EXISTS `task_files`;
CREATE TABLE `task_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `file_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_files_user_id_foreign` (`user_id`),
  KEY `task_files_task_id_foreign` (`task_id`),
  CONSTRAINT `task_files_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of task_files
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` bigint(20) unsigned NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `task_hour` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `task_status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not started',
  `task_note` mediumtext COLLATE utf8mb4_unicode_ci,
  `task_progress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify` tinyint(4) DEFAULT NULL,
  `added_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_company_id_foreign` (`company_id`),
  KEY `tasks_added_by_foreign` (`added_by`),
  CONSTRAINT `tasks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tasks_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tasks
-- ----------------------------
BEGIN;
INSERT INTO `tasks` VALUES (1, 'Test1 Task', 1, 1, '2021-03-29', '2021-04-01', '20', '&lt;table style=&quot;border-collapse: collapse; width: 100%; height: 45px;&quot; border=&quot;1&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr style=&quot;height: 15px;&quot;&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;gsba&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;svnba&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 15px;&quot;&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;dfsd&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;dfsf&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr style=&quot;height: 15px;&quot;&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;td style=&quot;width: 20%; height: 15px;&quot;&gt;&amp;nbsp;&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;', '', NULL, '9', NULL, 1, '2020-07-28 15:14:01', '2020-11-02 01:42:14');
INSERT INTO `tasks` VALUES (2, 'Task222', 2, 2, '2021-03-30', '2021-03-30', '12', '&lt;p&gt;fdsafa gs&lt;/p&gt;', 'not started', NULL, NULL, NULL, 1, '2020-07-28 16:26:49', '2020-11-02 01:47:42');
INSERT INTO `tasks` VALUES (3, 'aa', 1, 1, '2021-03-31', '2021-04-02', '16', '&lt;p&gt;new&lt;/p&gt;', 'not started', NULL, NULL, NULL, 16, '2020-10-11 17:12:09', '2020-11-02 01:49:48');
INSERT INTO `tasks` VALUES (6, 'new2222', 2, 1, '2021-03-30', '2021-03-31', '20', '&lt;p style=&quot;text-align: center;&quot;&gt;&lt;strong&gt;fv fsdf&lt;/strong&gt;&lt;/p&gt;\r\n&lt;ul&gt;\r\n&lt;li style=&quot;text-align: center;&quot;&gt;&lt;strong&gt;dfds&lt;/strong&gt;&lt;/li&gt;\r\n&lt;li style=&quot;text-align: center;&quot;&gt;zczcz&lt;/li&gt;\r\n&lt;/ul&gt;', '', NULL, NULL, NULL, 16, '2020-10-12 01:53:22', '2020-11-02 00:44:07');
COMMIT;

-- ----------------------------
-- Table structure for tax_types
-- ----------------------------
DROP TABLE IF EXISTS `tax_types`;
CREATE TABLE `tax_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tax_types
-- ----------------------------
BEGIN;
INSERT INTO `tax_types` VALUES (1, 'No tax', '0', 'fixed', 'zero tax', '2020-07-28 16:31:42', '2020-07-28 16:31:42');
INSERT INTO `tax_types` VALUES (2, 'Vat', '5', 'percentage', '5% vat for all item', '2020-07-28 16:32:12', '2020-07-28 16:32:12');
COMMIT;

-- ----------------------------
-- Table structure for termination_types
-- ----------------------------
DROP TABLE IF EXISTS `termination_types`;
CREATE TABLE `termination_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `termination_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of termination_types
-- ----------------------------
BEGIN;
INSERT INTO `termination_types` VALUES (1, 'voluntery termination', '2020-07-26 20:22:03', '2020-07-26 20:22:03');
INSERT INTO `termination_types` VALUES (2, 'Performance Termination', '2020-07-26 20:22:27', '2020-07-26 20:22:27');
COMMIT;

-- ----------------------------
-- Table structure for terminations
-- ----------------------------
DROP TABLE IF EXISTS `terminations`;
CREATE TABLE `terminations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned NOT NULL,
  `terminated_employee` bigint(20) unsigned NOT NULL,
  `termination_type` bigint(20) unsigned DEFAULT NULL,
  `termination_date` date NOT NULL,
  `notice_date` date NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `terminations_company_id_foreign` (`company_id`),
  KEY `terminations_terminated_employee_foreign` (`terminated_employee`),
  KEY `terminations_termination_type_foreign` (`termination_type`),
  CONSTRAINT `terminations_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `terminations_terminated_employee_foreign` FOREIGN KEY (`terminated_employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `terminations_termination_type_foreign` FOREIGN KEY (`termination_type`) REFERENCES `termination_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of terminations
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for ticket_comments
-- ----------------------------
DROP TABLE IF EXISTS `ticket_comments`;
CREATE TABLE `ticket_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ticket_comments` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_comments_ticket_id_foreign` (`ticket_id`),
  KEY `ticket_comments_user_id_foreign` (`user_id`),
  CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ticket_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ticket_comments
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for trainers
-- ----------------------------
DROP TABLE IF EXISTS `trainers`;
CREATE TABLE `trainers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `expertise` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainers_company_id_foreign` (`company_id`),
  CONSTRAINT `trainers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of trainers
-- ----------------------------
BEGIN;
INSERT INTO `trainers` VALUES (1, 'Pink', 'Floyd', 'floyd@pink.com', '76352839', 1, 'Backstreet 22,Austria', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est', '', '2020-07-27 19:14:54', '2020-07-27 19:14:54');
COMMIT;

-- ----------------------------
-- Table structure for training_lists
-- ----------------------------
DROP TABLE IF EXISTS `training_lists`;
CREATE TABLE `training_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `training_cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `trainer_id` bigint(20) unsigned DEFAULT NULL,
  `training_type_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_lists_company_id_foreign` (`company_id`),
  KEY `training_lists_trainer_id_foreign` (`trainer_id`),
  KEY `training_lists_training_type_id_foreign` (`training_type_id`),
  CONSTRAINT `training_lists_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  CONSTRAINT `training_lists_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `training_lists_training_type_id_foreign` FOREIGN KEY (`training_type_id`) REFERENCES `training_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of training_lists
-- ----------------------------
BEGIN;
INSERT INTO `training_lists` VALUES (1, 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est', '2021-04-01', '2021-04-02', '200', '', NULL, 1, 1, 1, '2020-07-27 19:17:38', '2020-07-27 19:17:38');
COMMIT;

-- ----------------------------
-- Table structure for training_types
-- ----------------------------
DROP TABLE IF EXISTS `training_types`;
CREATE TABLE `training_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint(20) unsigned NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of training_types
-- ----------------------------
BEGIN;
INSERT INTO `training_types` VALUES (1, 0, 'Job Training', '', '2020-07-27 19:10:52', '2020-07-27 19:10:52');
INSERT INTO `training_types` VALUES (2, 0, 'Workshop', '', '2020-07-27 19:10:59', '2020-07-27 19:10:59');
INSERT INTO `training_types` VALUES (3, 0, 'Mind Training', '', '2020-07-27 19:11:07', '2020-07-27 19:11:07');
COMMIT;

-- ----------------------------
-- Table structure for transfers
-- ----------------------------
DROP TABLE IF EXISTS `transfers`;
CREATE TABLE `transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `from_department_id` bigint(20) unsigned DEFAULT NULL,
  `to_department_id` bigint(20) unsigned DEFAULT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `transfer_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transfers_company_id_foreign` (`company_id`),
  KEY `transfers_from_department_id_foreign` (`from_department_id`),
  KEY `transfers_to_department_id_foreign` (`to_department_id`),
  KEY `transfers_employee_id_foreign` (`employee_id`),
  CONSTRAINT `transfers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_from_department_id_foreign` FOREIGN KEY (`from_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfers_to_department_id_foreign` FOREIGN KEY (`to_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of transfers
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for travel_types
-- ----------------------------
DROP TABLE IF EXISTS `travel_types`;
CREATE TABLE `travel_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `arrangement_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_types_company_id_foreign` (`company_id`),
  CONSTRAINT `travel_types_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of travel_types
-- ----------------------------
BEGIN;
INSERT INTO `travel_types` VALUES (1, 'Corporation', NULL, '2020-07-27 03:51:23', '2020-07-27 03:51:23');
INSERT INTO `travel_types` VALUES (2, 'Guest House', NULL, '2020-07-27 03:51:34', '2020-07-27 03:51:34');
INSERT INTO `travel_types` VALUES (3, 'Hotel', NULL, '2020-07-27 03:51:39', '2020-07-27 03:51:39');
COMMIT;

-- ----------------------------
-- Table structure for travels
-- ----------------------------
DROP TABLE IF EXISTS `travels`;
CREATE TABLE `travels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned NOT NULL,
  `travel_type` bigint(20) unsigned DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `purpose_of_visit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_visit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expected_budget` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_budget` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `travel_mode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travels_company_id_foreign` (`company_id`),
  KEY `travels_employee_id_foreign` (`employee_id`),
  KEY `travels_travel_type_foreign` (`travel_type`),
  CONSTRAINT `travels_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `travels_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `travels_travel_type_foreign` FOREIGN KEY (`travel_type`) REFERENCES `travel_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of travels
-- ----------------------------
BEGIN;
INSERT INTO `travels` VALUES (1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud', 1, 12, 1, '2021-03-07', '2021-03-04', 'Product Analysis', 'New Delhi', '800', '750', 'By Train', 'first level approval', '2020-07-27 15:53:52', '2020-07-27 15:53:52');
INSERT INTO `travels` VALUES (2, 'bla bla bla', 1, 9, 3, '2021-03-18', '2021-03-15', 'Rome', 'Athens', '500', NULL, 'By Plane', 'approved', '2020-08-02 07:09:33', '2020-08-18 07:13:03');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_bg` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_users_id` bigint(20) unsigned NOT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `contact_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_ip` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_date` timestamp(2) NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_users_id_foreign` (`role_users_id`),
  CONSTRAINT `users_role_users_id_foreign` FOREIGN KEY (`role_users_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'Irfan', 'Chowdhury', 'admin', 'irfan@gmail.com', NULL, '$2y$10$WcnC16AXG/mNrVBWQGjfoegFO.1wjiIiBv5LxEHR6uQaJYVciYCOa', 'admin_1639557363.jpg', NULL, 1, 1, '1234', '192.168.32.1', '2022-11-14 17:15:16.00', 'p54d4VWmnj2WzBwo2oo4BZHnwU18aNquk0KikcFSnTxkgfQlLHMyEtMPkIMM', NULL, '2022-06-05 08:00:06', NULL);
INSERT INTO `users` VALUES (9, 'Sahiba', 'Khatun', 'staff', 'sahibakhatun@gmail.com', NULL, '$2y$10$49e7SL6g37nIubrws03uJOTMRJHdL.7HIG/UhjJoHSQcRLSfwFt3e', 'staff_1616582111.jpg', NULL, 5, 1, '387292822', '::1', '2022-10-03 05:24:56.00', NULL, '2020-07-26 19:51:54', '2022-10-02 09:25:21', NULL);
INSERT INTO `users` VALUES (10, 'John', 'Cena', 'cena11', 'johncena@hotmail.com', NULL, '$2y$10$8dFCpYwVXgTo2/RFP4z3ZOV9HWygsx/wxLkqVKMgDaYVPXT2RPnSe', NULL, NULL, 6, NULL, '456372794', '::1', '2021-09-05 03:14:05.00', NULL, '2020-07-26 20:01:39', '2021-09-20 10:46:35', NULL);
INSERT INTO `users` VALUES (11, 'Neo', 'Dezhi', 'neo22', 'neodezhi@gmail.com', NULL, '$2y$10$7YXp/7yWhaNhdVulDbhSyOXSoqKk6sDjjru9TOe.WzbAt7sn6q8bu', NULL, NULL, 4, 1, '67278232', NULL, NULL, NULL, '2020-07-26 20:03:25', '2022-02-20 06:27:15', NULL);
INSERT INTO `users` VALUES (12, 'Bob', 'Hobart', 'bob05', 'bob@ymail.com', NULL, '$2y$10$6RcsgFVg1PLJOY8n3VbFAe7oqV/d7.0nqkLdljT0YRnLTlw5/QI9u', NULL, NULL, 2, 1, '4678292', '127.0.0.1', '2021-11-15 04:12:50.00', NULL, '2020-07-27 04:26:35', '2021-09-05 03:17:40', NULL);
INSERT INTO `users` VALUES (13, 'Alice', 'Patrica', 'alicehh4', 'alicehh4@newmail.com', NULL, '$2y$10$etAwdCPWrPMv09LylKoLke5YxWZ4aIS9CgDW9Z8ZmL0Jr.TNcCFF.', NULL, NULL, 2, 1, '8765445698', '::1', '2021-06-24 16:07:06.00', NULL, '2020-07-27 04:28:16', '2021-06-24 16:06:50', NULL);
INSERT INTO `users` VALUES (14, 'Mayank', 'Agarwal', 'mayank06', 'mayank@gmail.com', NULL, '$2y$10$U2jCXdu6YztlaHf/./nbf.mPHDy7gYfK5bhAT8wfu4I7to3SKwX.e', NULL, NULL, 2, 1, '746389982', NULL, NULL, NULL, '2020-07-27 04:31:24', '2021-04-15 09:19:08', NULL);
INSERT INTO `users` VALUES (15, 'Mansoor', 'Ahmed', 'mansoor', 'mansoor@yahoo.com', NULL, '$2y$10$MyFyjN2K1QFL89eKuZQHF.xZ17vl0YviZ1q9d4eIORmMmS0gQs2IK', NULL, NULL, 2, 1, '67638299', NULL, NULL, NULL, '2020-07-27 04:33:54', '2021-04-15 09:20:00', NULL);
INSERT INTO `users` VALUES (16, 'Shadat', 'Ashraf', 'client', 'shahadatashraf10@gmail.com', NULL, '$2y$10$Cf7ZWz1sJJhWu1C30vOJDO7Y9BQ5f.8Wi2NYV9ITs9f0q9zLY3EbW', 'client_1623747532.png', NULL, 3, 1, '67651', '::1', '2022-10-02 08:56:08.00', NULL, '2020-07-28 14:41:31', '2022-10-02 09:21:02', NULL);
INSERT INTO `users` VALUES (27, 'Junayet', 'Istius', 'junayet95', 'junayet@gmail.com', NULL, '$2y$10$Enzuol2OzlDVbP6qa9SMTuXFkQynA0lA0oBrtD0RaBnvwGoBPfZvG', NULL, NULL, 2, 1, '01829496534', '::1', '2021-10-04 04:07:23.00', NULL, '2021-03-12 10:47:47', '2021-10-04 00:59:52', NULL);
INSERT INTO `users` VALUES (34, 'Amzad', 'Hossain', 'amzad95', 'amzad@gmail.com', NULL, '$2y$10$XwP9HJYYQCYqKZGgvGOH/.d6UjwnGE./LNxJmE8Iw9iynnhvwv67W', NULL, NULL, 2, 1, '01521225124', '127.0.0.1', '2021-03-28 06:28:36.00', NULL, '2021-03-28 05:53:57', '2021-03-28 17:29:20', NULL);
INSERT INTO `users` VALUES (38, 'Anisul', 'Islam', 'anis95', 'anis95@gmail.com', NULL, '$2y$10$L0rV6308zcY.h5hccqw1he3yhTCzXm9oxRtmKVpygk2XM3t1D0tHK', NULL, NULL, 2, 1, '01521222842', NULL, NULL, NULL, '2021-03-28 17:35:27', '2021-03-28 17:35:27', NULL);
INSERT INTO `users` VALUES (39, 'Kaden', 'Porter', 'kaden95', 'kaden@mailinator.com', NULL, '$2y$10$v0ppHd14bDVJKi1.Lgm5qes2H9XkkQEl5Lmdw/lRk.zNtKzYTZ4we', 'kaden95_1623747054.jpg', NULL, 3, 1, '441234874', '127.0.0.1', '2021-03-30 01:45:13.00', NULL, '2021-03-30 01:42:31', '2021-06-15 05:50:54', NULL);
INSERT INTO `users` VALUES (45, 'Promi', 'Chy', 'promi98', 'promi98@gmail.com', NULL, '$2y$10$x.6xRw4Tv7u6wezVJSWcPuUx7elTP1SSY1DbiBgsQ5DQxotMgO11K', NULL, NULL, 4, 1, '423213234', NULL, NULL, NULL, '2021-06-29 17:16:33', '2021-06-30 00:27:38', NULL);
INSERT INTO `users` VALUES (49, 'Sahiba', 'Chowdhury', 'sahiba95', 'sahiba95@gmail.com', NULL, '$2y$10$q24PhrX6QJjYxlf/vij7cuwMR7g3LKncZUFabDmGCQ00iwmU4DWA2', NULL, NULL, 2, 1, '01829640631', NULL, NULL, NULL, '2022-02-26 05:00:02', '2022-02-26 05:01:28', NULL);
INSERT INTO `users` VALUES (51, 'Lacey', 'Wood', 'gosofunab', 'myjof@mailinator.com', NULL, '$2y$10$eoqfN2lGpBHXWtj.WztEM.FLLTH0ofOoAWXERZSHC9mwEaf1NXVc6', 'gosofunab_1648442766.jpg', NULL, 1, 1, '1211334234', NULL, NULL, NULL, '2022-03-28 04:46:07', '2022-05-24 07:08:37', NULL);
COMMIT;

-- ----------------------------
-- Table structure for warnings
-- ----------------------------
DROP TABLE IF EXISTS `warnings`;
CREATE TABLE `warnings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `company_id` bigint(20) unsigned NOT NULL,
  `warning_to` bigint(20) unsigned NOT NULL,
  `warning_type` bigint(20) unsigned DEFAULT NULL,
  `warning_date` date NOT NULL,
  `status` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warnings_company_id_foreign` (`company_id`),
  KEY `warnings_warning_to_foreign` (`warning_to`),
  KEY `warnings_warning_type_foreign` (`warning_type`),
  CONSTRAINT `warnings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `warnings_warning_to_foreign` FOREIGN KEY (`warning_to`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `warnings_warning_type_foreign` FOREIGN KEY (`warning_type`) REFERENCES `warnings_type` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of warnings
-- ----------------------------
BEGIN;
INSERT INTO `warnings` VALUES (1, 'Harassment', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 11, 1, '2021-04-06', 'unsolved', '2020-07-27 17:35:31', '2020-07-27 17:35:31');
COMMIT;

-- ----------------------------
-- Table structure for warnings_type
-- ----------------------------
DROP TABLE IF EXISTS `warnings_type`;
CREATE TABLE `warnings_type` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `warning_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of warnings_type
-- ----------------------------
BEGIN;
INSERT INTO `warnings_type` VALUES (1, 'First written warning', '2020-07-26 20:20:57', '2020-07-26 20:20:57');
INSERT INTO `warnings_type` VALUES (2, 'Verbal Warning', '2020-07-26 20:21:17', '2020-07-26 20:21:17');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
