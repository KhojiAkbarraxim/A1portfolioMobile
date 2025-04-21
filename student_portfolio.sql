-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 25 2023 г., 00:03
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `student_portfolio`
--

-- --------------------------------------------------------

--
-- Структура таблицы `announcement`
--

CREATE TABLE `announcement` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_begin` date DEFAULT NULL,
  `app_deadline` date DEFAULT NULL,
  `selection_begin` date DEFAULT NULL,
  `selection_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `announcement`
--

INSERT INTO `announcement` (`id`, `name`, `image`, `thumb_image`, `app_begin`, `app_deadline`, `selection_begin`, `selection_date`, `description`, `created_at`, `updated_at`) VALUES
(10, 'Tanlov test', 'tanlov/7bgxJy258DackjdBvI1vlxhrVAsJqZBvrLwwm76k.jpg', 'thumb/tanlov/7bgxJy258DackjdBvI1vlxhrVAsJqZBvrLwwm76k.jpg', '2022-12-01', '2022-12-03', '2022-12-08', '2022-12-09', '<p>&nbsp;Tanlov tahrirlandi</p>', '2022-12-16 07:56:26', '2023-01-04 06:13:46'),
(12, 'Test tanlov', 'tanlov/1mJC9s72jfcQyn8toHJd1ZOlt9CDmOCHgfrd1zxz.png', 'thumb/tanlov/1mJC9s72jfcQyn8toHJd1ZOlt9CDmOCHgfrd1zxz.png', '2022-12-30', '2023-01-10', '2023-01-11', '2023-01-12', '<p>q4thwrht</p>', '2023-01-23 11:04:24', '2023-01-23 11:04:24');

-- --------------------------------------------------------

--
-- Структура таблицы `applications`
--

CREATE TABLE `applications` (
  `id` int NOT NULL,
  `fio` text NOT NULL,
  `university` text NOT NULL,
  `grade` int NOT NULL,
  `phone` varchar(255) NOT NULL,
  `direction` varchar(255) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `announcement_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `applications`
--

INSERT INTO `applications` (`id`, `fio`, `university`, `grade`, `phone`, `direction`, `group_name`, `announcement_id`) VALUES
(1, 'Musobek Madrimov', 'SamISI', 5, '999661999', 'Iqtisodiyot', 'IK-S-119', 12),
(2, 'Musobek Madrimov', 'SamISI', 5, '999661999', 'Iqtisodiyot', 'IK-S-119', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `attach`
--
  
CREATE TABLE `attach` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attach`
--

INSERT INTO `attach` (`id`, `student_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 15, 4, '2022-10-10 00:56:27', '2022-10-10 00:56:27'),
(2, 12, 9, '2022-10-10 03:21:52', '2022-10-10 03:21:52'),
(3, 17, 8, '2022-10-17 06:10:33', '2022-10-17 06:10:33'),
(4, 16, 8, '2022-10-17 06:43:24', '2022-10-17 06:43:24'),
(5, 18, 10, '2022-10-20 05:40:55', '2022-10-20 05:40:55');  

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  `work_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '-1',
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comment`
--

INSERT INTO `comment` (`id`, `student_id`, `teacher_id`, `work_id`, `message`, `date`, `status`, `answer`, `created_at`, `updated_at`) VALUES
(3, 17, 10, 13, 'xatoku bu photoshopda qilingan', '2023-03-04 20:21:21', 1, 'nimalar deyapsan sen ?', '2022-10-28 08:45:44', '2023-03-04 20:21:21'),
(4, 17, 10, 13, 'Ojayip!', '2022-11-09 07:08:42', 0, 'Javob berildi', '2022-10-28 12:48:47', '2022-11-09 07:08:42'),
(5, 16, 10, 17, 'sababi izoh', '2022-10-31 07:33:24', 0, 'unday emas!', '2022-10-28 13:11:37', '2022-10-31 07:33:24');

-- --------------------------------------------------------

--
-- Структура таблицы `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint UNSIGNED NOT NULL,
  `announcement_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `commissions`
--

INSERT INTO `commissions` (`id`, `announcement_id`, `name`, `phone`, `created_at`, `updated_at`) VALUES
(1, 2, 'Murodjon Shomuratov', '+998904333699', '2022-12-06 07:35:14', '2022-12-06 07:35:14'),
(2, 2, 'Musobek Madrimov', '+998991999999', '2022-12-06 09:12:34', '2022-12-06 09:12:34'),
(3, 2, 'Zaripov Shohrux', '+998971228899', '2022-12-06 09:16:09', '2022-12-06 09:16:09'),
(4, 5, 'Murodjon Shomuratov', '+998904333699', '2022-12-06 09:34:10', '2022-12-06 09:34:10'),
(5, 2, 'Sirojiddin Safayev', '+998991231231', '2022-12-06 13:22:42', '2022-12-06 13:22:42');

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `service_type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `subject`, `message`, `created_at`, `service_type`) VALUES
(1, 'Murodjon', '998904333699', 'Diplom', 'Nagap indi', '2022-11-04 09:13:40', NULL),
(2, 'Murodjon Shomuratov', '998904333699', 'Test sertifikat', 'sgdfdgf', '2022-11-04 10:07:15', NULL),
(3, 'Murodjon', '', 'Diplom', 'fgfdbgfv', '2022-11-04 10:07:38', NULL),
(4, 's', '45', '89894', '84964', '2022-11-04 10:13:40', NULL),
(5, 'fa', '123123123123', 'Diplom', '123123123', '2022-11-04 10:29:51', NULL),
(6, 'Murodjon', '998904333699', 'Talabalar portfoliosi', 'salom', '2022-11-07 06:03:57', NULL),
(7, 'Murodjon', '998904333699', 'Talabalar portfoliosi', 'salom', '2022-11-07 06:06:00', NULL),
(8, 'Murodjon', '998904333699', 'Talabalar portfoliosi', 'ewfdf', '2022-11-07 06:07:48', NULL),
(9, 'Murodjon', '998904333699', 'Xizmatni tanlang', 'sdgfsrg', '2022-11-07 06:09:04', NULL),
(10, 'Murodjon', '998904333699', 'Xizmatni tanlang', 'srfdd', '2022-11-07 06:13:45', NULL),
(11, 'Murodjon', '998904333699', 'Talabalar portfoliosi', '15:33', '2022-11-07 10:33:47', NULL),
(12, 'Murodjon', '998904333699', 'Talabalar portfoliosi', '213212651', '2022-11-07 10:41:42', NULL),
(13, 'Murodjon', '998904333699', 'Talabalar portfoliosi', 'Salom', '2022-11-07 13:19:59', NULL),
(14, 'Musobek Madrimov', '998999661999', 'Talabalar portfoliosi', 'Уялмайсиздарми $1,000 нарх қўйгани ?', '2022-11-07 13:24:32', NULL),
(15, 'Masharipov San&#039;atbek', '998995481008', 'Talabalar portfoliosi', 'asfsdfdafsdfasf  sdf df sdafsdfasdfsdf', '2022-11-07 13:34:52', NULL),
(16, 'Dasturiy injiniringi', '998904333699', 'Talabalar portfoliosi', 'dsfghjk', '2022-12-05 13:32:58', NULL),
(17, 'Murodjon Shomuratov', '998904333699', 'Talabalar portfoliosi', 'Assalomu alaykum', '2022-12-07 12:16:26', NULL),
(18, 'Dasturiy injiniringi', '998904333699', 'Talabalar portfoliosi', '123test', '2022-12-07 12:18:50', NULL),
(19, 'Shohruh', '998975288899', 'Talabalar portfoliosi', 'Menga kerak', '2022-12-07 12:46:07', NULL),
(20, 'Murodjon', '998904333699', 'Talabalar portfoliosi', 'sdfgf', '2022-12-12 06:42:06', NULL),
(21, 'Musobek Madrimov G\'aniy o\'g\'li', '123123123123', 'Talabalar portfoliosi', '123123123', '2023-05-29 09:56:53', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `criteria`
--

CREATE TABLE `criteria` (
  `id` bigint UNSIGNED NOT NULL,
  `announcement_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ball` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `criteria`
--

INSERT INTO `criteria` (`id`, `announcement_id`, `name`, `ball`, `created_at`, `updated_at`) VALUES
(1, 5, 'mezon', 25, '2022-12-07 10:48:16', '2022-12-07 10:48:16'),
(2, 5, 'mezon2', 32, '2022-12-07 10:48:16', '2022-12-07 10:48:16'),
(3, 5, 'mezon 3', 15, '2022-12-07 10:48:16', '2022-12-07 10:48:16'),
(4, 2, 'ajoyib korinish', 25, '2022-12-07 11:33:08', '2022-12-07 11:33:08'),
(5, 4, 'ajoyib korinish', 15, '2022-12-07 12:04:17', '2022-12-07 12:04:17');

-- --------------------------------------------------------

--
-- Структура таблицы `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `faculte_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `departments`
--

INSERT INTO `departments` (`id`, `faculte_id`, `name`, `created_at`, `updated_at`) VALUES
(5, 10, 'Gumanitar', '2022-09-26 00:04:27', '2022-09-26 00:04:27'),
(12, 18, 'Dasturiy injiniringi', '2022-10-10 03:24:33', '2022-10-10 03:24:33');

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE `direction` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Dasturiy injiniringi.', '2022-09-12 00:40:09', '2022-09-12 00:44:12'),
(5, 'Telekommunikatsiya injiniringi', '2022-09-19 01:25:59', '2022-09-23 05:05:50'),
(6, 'Kompyuter injiniring', '2022-09-26 08:26:01', '2022-09-26 08:26:01'),
(7, 'Axborot xavfsizligi', '2022-09-29 00:37:07', '2022-09-29 00:41:27');

-- --------------------------------------------------------

--
-- Структура таблицы `facultes`
--

CREATE TABLE `facultes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `facultes`
--

INSERT INTO `facultes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(10, 'Kompyuter injiniring', '2022-09-21 00:55:39', '2022-09-21 00:55:39'),
(18, 'Telekommunikatsiya injiniringi', '2022-10-10 03:24:11', '2022-10-10 03:24:11');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculte_id` bigint UNSIGNED NOT NULL,
  `direction_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `name`, `faculte_id`, `direction_id`, `created_at`, `updated_at`) VALUES
(8, '914-18', 10, 6, '2022-09-28 06:50:11', '2022-09-28 06:50:11'),
(14, '943-18', 18, 4, '2022-10-11 00:23:49', '2022-10-11 00:23:49'),
(15, '942-18', 18, 4, '2022-10-21 11:50:56', '2022-10-21 11:50:56'),
(16, '932-18', 18, 5, '2022-11-01 11:35:34', '2022-11-01 11:35:34'),
(17, '951-18', 10, 7, '2022-11-10 06:25:38', '2022-11-10 06:25:38');

-- --------------------------------------------------------

--
-- Структура таблицы `itb_bolim`
--

CREATE TABLE `itb_bolim` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `user_id` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `itb_bolim`
--

INSERT INTO `itb_bolim` (`id`, `name`, `email`, `password`, `user_id`, `updated_at`) VALUES
(1, 'Bo\'lim boshlig\'i', 'admin@123', '030303', 3, '2022-10-21 13:19:47');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2022_08_29_064047_create_roles_table', 1),
(4, '2022_08_29_064506_create_facultes_table', 1),
(5, '2022_08_29_064653_create_departments_table', 1),
(6, '2022_08_29_071911_create_groups_table', 1),
(9, '2014_10_12_000000_create_users_table', 2),
(10, '2022_09_07_073312_create_direction_table', 3),
(11, '2022_09_07_073840_create_group_table', 4),
(13, '2022_09_07_085455_create_student_table', 5),
(14, '2022_09_19_070603_create_professor_table', 5),
(23, '2022_09_20_070524_alter_professor_table', 6),
(24, '2022_09_21_053114_alter_student_add_login_parol', 6),
(25, '2022_09_22_112616_alter_users_table', 6),
(26, '2022_09_30_073436_create_work_table', 7),
(33, '2022_10_04_074137_create_work_scale_table', 8),
(38, '2022_09_30_070233_create_work_type_table', 9),
(39, '2022_09_30_070937_create_score_table', 9),
(42, '2022_10_04_122939_create_attach_table', 10),
(44, '2022_10_11_054434_create_work_table', 11),
(47, '2022_10_26_164042_create_complaint_work_table', 12),
(52, '2022_11_15_105802_create_announcement_table', 13),
(54, '2022_12_06_103705_create_commissions_table', 14),
(55, '2022_12_07_150714_create_criteria_table', 15),
(57, '2022_12_14_155410_alter_announcement_table', 16),
(58, '2023_03_04_193414_applications', 17),
(59, '2023_03_04_195152_alter_applications_table', 18);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('murod@gmail.com', '$2y$10$69L5/4rPHfbuFG7cuZtideVinb0x7IjppS0GAc0sfmNZD1gTfvqp.', '2022-12-09 07:29:42');

-- --------------------------------------------------------

--
-- Структура таблицы `professor`
--

CREATE TABLE `professor` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `department_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `professor`
--

INSERT INTO `professor` (`id`, `name`, `login`, `parol`, `status`, `department_id`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 'Abdullayev Sherzod', 'Sher@0203', '030303', 1, 5, 81, '2022-10-10 01:04:00', '2022-10-19 09:41:09'),
(10, 'Axmedov Ergash', 'ergash@012', '012012', 1, 12, 85, '2022-10-19 08:32:38', '2022-10-20 05:41:52');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Iqtidorli talabalar bo`limi', NULL, NULL),
(2, 'Ilmiy rahbar', NULL, NULL),
(3, 'Talaba', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `score`
--

CREATE TABLE `score` (
  `id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `ball` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `score`
--

INSERT INTO ` ` (`id`, `type_id`, `ball`, `created_at`, `updated_at`) VALUES
(6, 6, 5, '2022-10-25 13:01:36', '2022-10-25 13:01:36'),
(7, 7, 15, '2022-10-26 06:53:47', '2022-10-26 06:53:47'),
(8, 9, 10, '2022-10-26 07:00:00', '2022-10-26 07:00:00'),
(9, 10, 5, '2022-10-26 10:11:46', '2022-10-31 09:06:25');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `attach_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `name`, `group_id`, `user_id`, `phone`, `login`, `parol`, `status`, `attach_status`, `created_at`, `updated_at`) VALUES
(16, 'Murodjon Shomuratov', 14, 83, '+998904333699', 'murodbek.0338@gmail.com', '010101', 1, 1, '2022-10-11 00:24:32', '2022-11-10 05:29:26'),
(17, 'Abdullayev Umar', 8, 84, '+998909992111', 'umar@001', '020202', 1, 1, '2022-10-11 07:46:08', '2022-11-10 05:42:50'),
(18, 'Zaripov Shohrux', 14, 86, '+998904333699', 'murod.3699@gmail.com', '123123', 1, 1, '2022-10-19 13:43:53', '2022-10-20 05:40:55'),
(19, 'Omonov Ravshan', 15, 87, '+998992563256', 'ravshan@1', '123', 1, 0, '2022-10-25 09:00:33', '2022-10-25 09:00:33'),
(20, 'Musobek Madrimov', 8, 88, '+998999661999', 'musobekmadrimov9999999999@gmail.com', '123', 1, 0, '2022-10-25 09:23:39', '2022-10-25 09:23:39'),
(21, 'Abdiyev Shohruh', 16, 89, '+998991450203', 'shoxa@789', '789789', 1, 0, '2022-11-01 11:36:56', '2022-11-01 11:36:56'),
(22, 'Omonboyev Shavkat', 17, 90, '+998992568714', 'shavkat@123', 'shavkat@123', 1, 0, '2022-11-10 06:26:50', '2022-11-10 06:26:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Bo\'lim boshlig\'i', 'admin@123', 1, 1, '$2y$10$EEW2FfDRX1gyXozcwLcMqu.0P4ESJU8RoAVV0rQUOUbt3d0bp.IvC', NULL, '2022-08-31 02:00:22', '2022-10-21 13:19:47'),
(81, 'Abdullayev Sherzod', 'Sher@0203', 2, 1, '$2y$10$3PNlpicKPeEp7jQvWGiR4.Bq/H0bberyOMdFj5YVOn4KtlWApM7r.', NULL, '2022-10-10 01:03:59', '2022-10-19 09:41:09'),
(83, 'Murodjon Shomuratov', 'murodbek.0338@gmail.com', 3, 1, '$2y$10$PzRukkhL9Y509c5OuNlNPeH0wm483bVZtOq5FBEoBoX7GGvWFniLy', NULL, '2022-10-11 00:24:32', '2022-11-10 05:29:26'),
(84, 'Abdullayev Umar', 'umar@001', 3, 1, '$2y$10$.5UWw0SUljimCgFhQrFQ3ORA9V7pC/YFlEq4N2Ku.bd/xBVjGPfNq', NULL, '2022-10-11 07:46:08', '2022-11-10 05:42:50'),
(85, 'Axmedov Ergash', 'ergash@012', 2, 1, '$2y$10$h0WoAdb1z9SeTIkx5CUzr.rhSj.exP9aFJubpOuStJJBhn3jlJ0vu', NULL, '2022-10-19 08:32:38', '2022-10-20 05:41:52'),
(86, 'Zaripov Shohrux', 'murod.3699@gmail.com', 3, 1, '$2y$10$Gc83kh/iychtUhEGLR1W3ee5otI44QuGvcqEVppX.enKVMBCYn52u', NULL, '2022-10-19 13:43:53', '2022-10-19 13:43:53'),
(87, 'Omonov Ravshan', 'ravshan@1', 3, 1, '$2y$10$Z6m6HIPL3tnIQ4ou9BMtK.3enWf5Sj7M1Hk8MUpCtpPWPBmuGv2p2', NULL, '2022-10-25 09:00:33', '2022-10-25 09:00:33'),
(89, 'Abdiyev Shohruh', 'shoxa@789', 3, 1, '$2y$10$NqkkLA9Qh5iuP5DWCzjppet4jekdBmouSjtiCXfFRYwWfwsFT2NoO', NULL, '2022-11-01 11:36:56', '2022-11-01 11:36:56'),
(90, 'Omonboyev Shavkat', 'shavkat@123', 3, 1, '$2y$10$eigJqB1lNxE1J7Qn8BIJEuaQfm3J.zDiu19noML7uIsgmChWCOQdq', NULL, '2022-11-10 06:26:50', '2022-11-10 06:26:50'),
(101, 'hg', 'admin@123.ru', 3, 0, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL),
(102, 'Dasturiy injiniringi', 'rahbar@gmail.com', 3, 0, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL),
(103, 'Murodjon', 'murod@gmail.com', 3, 0, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL),
(104, 'Dasturiy injiniringi', 'rahbar12@gmail.com', 3, 0, 'c20ad4d76fe97759aa27a0c99bff6710', NULL, NULL, NULL),
(105, 'Shohruh', 'rahbar00@gmail.com', 3, 0, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL),
(106, 'Murodjon', 'murod699@gmail.com', 3, 0, '2f1ceb2af54cf69232c4ea139d9333a2', NULL, NULL, NULL),
(107, 'rgetdg', 'dfgh@213', 3, 0, '6ba667f2e5fb6e2e9a9edd14f49a3d53', NULL, NULL, NULL),
(108, 'Musobek Madrimov G\'aniy o\'g\'li', 'musobekmadrimov99@gmail.com', 3, 1, '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `work`
--

CREATE TABLE `work` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `work`
--

INSERT INTO `work` (`id`, `student_id`, `type_id`, `subject`, `score`, `link`, `status`, `desc`, `date`, `created_at`, `updated_at`) VALUES
(13, 17, 7, 'baxolarim', 15, 'http://ko\'rgazma.uz', 1, NULL, '2022-10-26', '2022-10-26 09:42:26', '2022-10-28 06:53:32'),
(15, 17, 6, 'Kompyuter to\'garagidan diplom', 5, 'http://uzbekcoders.uz', 1, NULL, '2022-10-05', '2022-10-28 13:06:53', '2022-11-01 10:20:22'),
(16, 16, 9, 'Shaxsiy baholarim', 10, 'http://disk.google.com', 1, NULL, '2022-09-27', '2022-10-28 13:09:09', '2022-11-01 11:32:54'),
(17, 16, 6, 'axborot texnologiyalari', 5, 'http://test.uz', 1, NULL, '2022-10-04', '2022-10-28 13:09:45', '2022-11-01 11:33:01'),
(18, 17, 7, 'ilmiy maqola', 15, 'https://www.ubtuit.uz/yangiliklar/tanlovlar', 1, NULL, '2021-01-01', '2022-10-28 13:22:05', '2022-11-01 10:20:28'),
(19, 21, 7, 'fan baxolari', 15, 'http://fan.net', 1, NULL, '2022-10-31', '2022-11-01 11:38:13', '2022-11-01 11:39:19'),
(20, 17, 10, 'Baholar', 0, 'http://baho.com', 2, 'boshqa narsa', '2018-03-17', '2022-11-08 11:25:24', '2022-11-16 11:12:39');

-- --------------------------------------------------------

--
-- Структура таблицы `work_scale`
--

CREATE TABLE `work_scale` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `work_scale`
--

INSERT INTO `work_scale` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Xalqaro', NULL, NULL),
(2, 'Respublika', NULL, NULL),
(3, 'Mahalliy', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `work_type`
--

CREATE TABLE `work_type` (
  `id` bigint UNSIGNED NOT NULL,
  `scale_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `work_type`
--

INSERT INTO `work_type` (`id`, `scale_id`, `name`, `created_at`, `updated_at`) VALUES
(6, 3, '5 tashabbus axborot texnologiyalari', '2022-10-25 13:01:20', '2022-10-25 13:01:20'),
(7, 3, 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 86-100', '2022-10-26 06:53:07', '2022-10-26 07:37:55'),
(9, 3, 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 71-86', '2022-10-26 06:59:29', '2022-10-26 07:38:15'),
(10, 3, 'Barcha fanlardan o\'zlashtirish ko\'rsatkichi 55-70', '2022-10-26 07:39:06', '2022-10-26 07:39:06');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_announcement_id_foreign` (`announcement_id`);

--
-- Индексы таблицы `attach`
--
ALTER TABLE `attach`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_faculte_id_foreign` (`faculte_id`);

--
-- Индексы таблицы `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `facultes`
--
ALTER TABLE `facultes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_faculte_id_foreign` (`faculte_id`),
  ADD KEY `group_direction_id_foreign` (`direction_id`);

--
-- Индексы таблицы `itb_bolim`
--
ALTER TABLE `itb_bolim`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_department_id_foreign` (`department_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_type_id_foreign` (`type_id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_group_id_foreign` (`group_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_student_id_foreign` (`student_id`),
  ADD KEY `work_type_id_foreign` (`type_id`);

--
-- Индексы таблицы `work_scale`
--
ALTER TABLE `work_scale`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work_type`
--
ALTER TABLE `work_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_type_scale_id_foreign` (`scale_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `attach`
--
ALTER TABLE `attach`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `direction`
--
ALTER TABLE `direction`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `facultes`
--
ALTER TABLE `facultes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `itb_bolim`
--
ALTER TABLE `itb_bolim`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `professor`
--
ALTER TABLE `professor`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `score`
--
ALTER TABLE `score`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT для таблицы `work`
--
ALTER TABLE `work`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `work_scale`
--
ALTER TABLE `work_scale`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `work_type`
--
ALTER TABLE `work_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculte_id_foreign` FOREIGN KEY (`faculte_id`) REFERENCES `facultes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `direction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_faculte_id_foreign` FOREIGN KEY (`faculte_id`) REFERENCES `facultes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `work_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `work_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `work_type`
--
ALTER TABLE `work_type`
  ADD CONSTRAINT `work_type_scale_id_foreign` FOREIGN KEY (`scale_id`) REFERENCES `work_scale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
