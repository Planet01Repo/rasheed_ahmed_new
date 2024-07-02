-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 06:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resource_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartons`
--

CREATE TABLE `cartons` (
  `id` int(11) NOT NULL,
  `length` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartons`
--

INSERT INTO `cartons` (`id`, `length`, `width`, `height`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4, '16.00', '10.00', '10.00', 1, NULL, '2020-09-04 11:25:46', '2020-10-28 09:10:11'),
(5, '17.00', '10.00', '13.50', 1, NULL, '2020-09-05 10:06:12', '2020-10-28 09:10:11'),
(6, '19.00', '12.50', '10.00', 1, NULL, '2020-09-05 10:07:05', '2020-10-28 09:10:11'),
(7, '0.00', '0.00', '0.00', 1, NULL, '2020-09-21 09:55:53', '2020-10-28 09:10:11'),
(8, '20.50', '15.00', '15.00', 1, NULL, '2020-11-19 18:24:50', '2020-11-19 18:24:50'),
(9, '22.00', '17.00', '11.00', 1, NULL, '2020-12-03 18:00:33', '2020-12-03 18:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `header_image` text DEFAULT NULL,
  `footer_image` text DEFAULT NULL,
  `logo_image` text DEFAULT NULL,
  `letter_head` text DEFAULT NULL,
  `pi_prefix` varchar(255) DEFAULT NULL,
  `invoice_prefix` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `title`, `prefix`, `header_image`, `footer_image`, `logo_image`, `letter_head`, `pi_prefix`, `invoice_prefix`, `phone`, `email`, `website`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fine Grip Import Export', 'FG', NULL, NULL, NULL, NULL, 'FG-PI/786-', 'FG-INV/', '+92 302 8244147', 'm.yasirrasheed@gmail.com', NULL, 'Plot 548, Sector 7/A, Korangi Industrial Area,\r\nKarachi, Pakistan', '2020-07-30 12:38:13', '2020-07-30 12:38:13', NULL),
(2, 'Rasheed Ahmed & Sons', 'RAS', NULL, NULL, NULL, NULL, 'RAS-PI/', 'RAS-INV/', '+92 302 8244147', 'ra-sons@hotmail.com', NULL, 'Plot # 433, Sector 7/A, Korangi Industrial Area,\r\nKarachi, Pakistan', '2020-07-30 12:40:32', '2020-07-30 12:40:32', NULL),
(3, 'Alif International', 'ALIF', NULL, NULL, NULL, NULL, 'ALIF-SC/', 'ALIF-INV/', '+92 302 8244147', 'xprosafety@gmail.com', NULL, 'Plot 431 Sector 7/A, Korangi Industrial Area', '2020-07-30 12:42:09', '2020-07-30 12:42:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `prefix` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `prefix`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua And Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BA', 'Bosnia And Herzegovina'),
(29, 'BW', 'Botswana'),
(30, 'BV', 'Bouvet Island'),
(31, 'BR', 'Brazil'),
(32, 'IO', 'British Indian Ocean Territory'),
(33, 'BN', 'Brunei Darussalam'),
(34, 'BG', 'Bulgaria'),
(35, 'BF', 'Burkina Faso'),
(36, 'BI', 'Burundi'),
(37, 'KH', 'Cambodia'),
(38, 'CM', 'Cameroon'),
(39, 'CA', 'Canada'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CD', 'Congo, Democratic Republic'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'CI', 'Cote D\'Ivoire'),
(55, 'C_I', 'Canary Island'),
(56, 'HR', 'Croatia'),
(57, 'CU', 'Cuba'),
(58, 'CY', 'Cyprus'),
(59, 'CZ', 'Czech Republic'),
(60, 'DK', 'Denmark'),
(61, 'DJ', 'Djibouti'),
(62, 'DM', 'Dominica'),
(63, 'DO', 'Dominican Republic'),
(64, 'EC', 'Ecuador'),
(65, 'EG', 'Egypt'),
(66, 'SV', 'El Salvador'),
(67, 'GQ', 'Equatorial Guinea'),
(68, 'ER', 'Eritrea'),
(69, 'EE', 'Estonia'),
(70, 'ET', 'Ethiopia'),
(71, 'FK', 'Falkland Islands (Malvinas)'),
(72, 'FO', 'Faroe Islands'),
(73, 'FJ', 'Fiji'),
(74, 'FI', 'Finland'),
(75, 'FR', 'France'),
(76, 'GF', 'French Guiana'),
(77, 'PF', 'French Polynesia'),
(78, 'TF', 'French Southern Territories'),
(79, 'GA', 'Gabon'),
(80, 'GM', 'Gambia'),
(81, 'GE', 'Georgia'),
(82, 'DE', 'Germany'),
(83, 'GH', 'Ghana'),
(84, 'GI', 'Gibraltar'),
(85, 'GR', 'Greece'),
(86, 'GL', 'Greenland'),
(87, 'GD', 'Grenada'),
(88, 'GP', 'Guadeloupe'),
(89, 'GU', 'Guam'),
(90, 'GT', 'Guatemala'),
(91, 'GG', 'Guernsey'),
(92, 'GN', 'Guinea'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HT', 'Haiti'),
(96, 'HM', 'Heard Island & Mcdonald Islands'),
(97, 'VA', 'Holy See (Vatican City State)'),
(98, 'HN', 'Honduras'),
(99, 'HK', 'Hong Kong'),
(100, 'HU', 'Hungary'),
(101, 'IS', 'Iceland'),
(102, 'IN', 'India'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran, Islamic Republic Of'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IM', 'Isle Of Man'),
(108, 'IL', 'Israel'),
(109, 'IT', 'Italy'),
(110, 'JM', 'Jamaica'),
(111, 'JP', 'Japan'),
(112, 'JE', 'Jersey'),
(113, 'JO', 'Jordan'),
(114, 'KZ', 'Kazakhstan'),
(115, 'KE', 'Kenya'),
(116, 'KI', 'Kiribati'),
(117, 'KR', 'Korea'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People\'s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macao'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'YT', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States Of'),
(144, 'MD', 'Moldova'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NIR', 'Northern Ireland'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'MP', 'Northern Mariana Islands'),
(166, 'NO', 'Norway'),
(167, 'OM', 'Oman'),
(168, 'PK', 'Pakistan'),
(169, 'PW', 'Palau'),
(170, 'PS', 'Palestinian Territory, Occupied'),
(171, 'PA', 'Panama'),
(172, 'PG', 'Papua New Guinea'),
(173, 'PY', 'Paraguay'),
(174, 'PE', 'Peru'),
(175, 'PH', 'Philippines'),
(176, 'PN', 'Pitcairn'),
(177, 'PL', 'Poland'),
(178, 'PT', 'Portugal'),
(179, 'PR', 'Puerto Rico'),
(180, 'QA', 'Qatar'),
(181, 'RE', 'Reunion'),
(182, 'RO', 'Romania'),
(183, 'RU', 'Russian Federation'),
(184, 'RW', 'Rwanda'),
(185, 'BL', 'Saint Barthelemy'),
(186, 'SH', 'Saint Helena'),
(187, 'KN', 'Saint Kitts And Nevis'),
(188, 'LC', 'Saint Lucia'),
(189, 'MF', 'Saint Martin'),
(190, 'PM', 'Saint Pierre And Miquelon'),
(191, 'VC', 'Saint Vincent And Grenadines'),
(192, 'WS', 'Samoa'),
(193, 'SM', 'San Marino'),
(194, 'ST', 'Sao Tome And Principe'),
(195, 'SA', 'Saudi Arabia'),
(196, 'SN', 'Senegal'),
(197, 'RS', 'Serbia'),
(198, 'SC', 'Seychelles'),
(199, 'SL', 'Sierra Leone'),
(200, 'SG', 'Singapore'),
(201, 'SK', 'Slovakia'),
(202, 'SI', 'Slovenia'),
(203, 'SB', 'Solomon Islands'),
(204, 'SO', 'Somalia'),
(205, 'ZA', 'South Africa'),
(206, 'GS', 'South Georgia And Sandwich Isl.'),
(207, 'ES', 'Spain'),
(208, 'LK', 'Sri Lanka'),
(209, 'SD', 'Sudan'),
(210, 'SR', 'Suriname'),
(211, 'SJ', 'Svalbard And Jan Mayen'),
(212, 'SZ', 'Swaziland'),
(213, 'SE', 'Sweden'),
(214, 'CH', 'Switzerland'),
(215, 'SY', 'Syrian Arab Republic'),
(216, 'TW', 'Taiwan'),
(217, 'TJ', 'Tajikistan'),
(218, 'TZ', 'Tanzania'),
(219, 'TH', 'Thailand'),
(220, 'TL', 'Timor-Leste'),
(221, 'TG', 'Togo'),
(222, 'TK', 'Tokelau'),
(223, 'TO', 'Tonga'),
(224, 'TT', 'Trinidad And Tobago'),
(225, 'TN', 'Tunisia'),
(226, 'TR', 'Turkey'),
(227, 'TM', 'Turkmenistan'),
(228, 'TC', 'Turks And Caicos Islands'),
(229, 'TV', 'Tuvalu'),
(230, 'UG', 'Uganda'),
(231, 'UA', 'Ukraine'),
(232, 'AE', 'United Arab Emirates'),
(233, 'GB', 'United Kingdom'),
(234, 'US', 'United States'),
(235, 'UM', 'United States Outlying Islands'),
(236, 'UY', 'Uruguay'),
(237, 'UZ', 'Uzbekistan'),
(238, 'VU', 'Vanuatu'),
(239, 'VE', 'Venezuela'),
(240, 'VN', 'Viet Nam'),
(241, 'VG', 'Virgin Islands, British'),
(242, 'VI', 'Virgin Islands, U.S.'),
(243, 'WF', 'Wallis And Futuna'),
(244, 'EH', 'Western Sahara'),
(245, 'YE', 'Yemen'),
(246, 'ZM', 'Zambia'),
(247, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_company_name` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `currency` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `customer_company_name`, `email`, `phone`, `website`, `city`, `country_id`, `address`, `currency`, `company_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mrs. Ivers Julia', 'Arbill Industries Inc.', 'jivers@arbill.com', '800-523-5367', 'www.arbill.com', 'Philadelphia', 234, '10450 Drummond Rd Philadelphia, PA 19154 USA', 0, 1, '2020-08-10 14:52:16', '2020-08-10 15:05:25', NULL),
(2, 'Claire Wolanin', 'Performance Fabrics, Inc.dba HexArmor', 'claire.wolanin@hexarmor.com', '877-668-3675', 'www.hexarmor.com', 'Grand Rapids', 234, '640 Leffingwell AVE NE HexArmor Grand Rapids MI 49505 USA', 0, 1, '2020-08-10 15:04:41', '2020-08-10 15:04:41', NULL),
(3, 'Josephine Hansen', 'Superior Glove Works Limited', 'josephine.hansen@superiorglove.com', '519-853-1920', 'www.superiorglove.com', 'Toronto', 39, '36 Vimy Street, Acton, Ontario L7J 1S1 Canada.', 0, 2, '2020-08-10 15:19:31', '2020-08-10 15:19:31', NULL),
(4, 'Mikael Hallner', 'JULA AB', 'mikael.hallner@jula.se', '511-342-000', 'www.jula.com', 'Gothenburg', 213, 'Julagatan 2 532 37 Skara Sweden', 0, 2, '2020-08-10 16:03:15', '2020-09-14 13:57:50', NULL),
(5, 'Mr. Shelby Hrechuk', 'Epoch Western Canada Inc.', 'sales@epochwesterncanada.com', '877-558-5547', 'www.stoutgloves.com', 'Red Deer', 39, '110-172 Clearview Dr Red Deer AB T4E 0A1 Canada', 0, 3, '2020-08-10 16:44:44', '2020-09-04 11:34:31', NULL),
(6, 'abbd', 'planet12', 'abbd@gmail.com', '031221212145', 'resourcemanagemnt.pk', 'karachi', 3, 'bahadurabad Karachi', 0, 2, '2020-11-10 17:17:24', '2020-11-10 17:20:36', NULL),
(7, 'Mr. Mark Ryker', 'MAJESTIC GLOVE', 'Mark.Ryker@majesticglove.com', '425-407-1200', 'www.majesticglove.com', 'Washington', 234, '2510 W. Casino Rd. EVERETT WA 98204 USA', 0, 1, '2020-11-19 12:48:57', '2020-12-04 11:20:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CS4060.2_1599287956.PNG', 1, '2020-09-05 10:39:16', '2020-09-05 10:39:16', NULL),
(2, 'CS4060_1599287956.PNG', 1, '2020-09-05 10:39:16', '2020-09-05 10:39:16', NULL),
(5, 'CS4062_1599485125.PNG', 3, '2020-09-07 17:25:25', '2020-09-07 17:25:25', NULL),
(6, 'CS4062-2_1599485125.jpg', 3, '2020-09-07 17:25:25', '2020-09-07 17:25:25', NULL),
(7, 'CS4061_1599636426.PNG', 4, '2020-09-09 11:27:06', '2020-09-09 11:27:06', NULL),
(8, 'CS4061-2_1599636426.PNG', 4, '2020-09-09 11:27:06', '2020-09-09 11:27:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hand_cutting_rate` decimal(10,2) NOT NULL,
  `press_cutting_rate` decimal(10,2) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `title`, `hand_cutting_rate`, `press_cutting_rate`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Leather', '0.00', '3.90', 1, NULL, '2020-09-05 10:14:28', '2020-10-28 09:10:11'),
(2, 'Leather .', '0.00', '4.10', 1, NULL, '2020-09-07 17:18:13', '2020-10-28 09:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_06_22_124838_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packing_lists`
--

CREATE TABLE `packing_lists` (
  `id` int(11) NOT NULL,
  `invoice_no` text NOT NULL,
  `local_invoice_no` text NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `awb_no` text NOT NULL,
  `awb_date` text NOT NULL,
  `form_no` text NOT NULL,
  `form_date` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packing_lists`
--

INSERT INTO `packing_lists` (`id`, `invoice_no`, `local_invoice_no`, `shipping_method`, `awb_no`, `awb_date`, `form_no`, `form_date`, `customer_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'FG-00001', 'asd454', 0, 'asd', 'as', 'AS', 'as', 7, 1, NULL, '2021-08-27 03:24:53', '2021-08-27 03:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `packing_list_details`
--

CREATE TABLE `packing_list_details` (
  `id` int(11) NOT NULL,
  `packing_list_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `cbm` text NOT NULL,
  `pack` int(11) NOT NULL,
  `net_weight` decimal(10,2) NOT NULL,
  `gross_weight` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `packing_list_details`
--

INSERT INTO `packing_list_details` (`id`, `packing_list_id`, `product_id`, `size_id`, `quantity`, `carton`, `cbm`, `pack`, `net_weight`, `gross_weight`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 12, 12, 12, '12', 2, '21.00', '21.00', '2021-08-27 03:24:53', '2021-08-27 03:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfoma_invoices`
--

CREATE TABLE `perfoma_invoices` (
  `id` int(11) NOT NULL,
  `perfoma_invoice_no` text COLLATE utf8_unicode_ci NOT NULL,
  `perfoma_invoice_no_local` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_terms` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `price_base` int(11) NOT NULL,
  `to` text COLLATE utf8_unicode_ci NOT NULL,
  `marks_no_1` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `marks_no_2` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `marks_no_3` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfoma_invoices`
--

INSERT INTO `perfoma_invoices` (`id`, `perfoma_invoice_no`, `perfoma_invoice_no_local`, `customer_id`, `description`, `payment_terms`, `shipping_method`, `price_base`, `to`, `marks_no_1`, `marks_no_2`, `marks_no_3`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'FG-00001', 'Test1', 2, '<p>sdfds</p>', '', 0, 0, '', NULL, NULL, NULL, 1, 1, '2020-09-11 20:10:31', '2020-09-11 20:16:42'),
(2, 'FG-00002', 'Test2', 2, '<p>ghrh</p>', '', 0, 0, '', NULL, NULL, NULL, 1, 1, '2020-09-18 17:14:35', '2020-09-18 17:26:38'),
(3, 'FG-00003', 'Test3', 2, NULL, '', 0, 0, '', NULL, NULL, NULL, 1, NULL, '2020-09-23 12:27:27', '2020-09-23 12:27:27'),
(4, 'FG-00004', 'FG-0001', 2, '<p>HexArmor Gloves</p>', '', 0, 0, '', NULL, NULL, NULL, 1, NULL, '2020-10-03 12:13:24', '2020-10-03 12:13:24'),
(5, 'FG-00005', '12325', 2, '<p>HexArmor Gloves</p>', '', 0, 0, '', NULL, NULL, NULL, 1, NULL, '2020-10-21 11:37:48', '2020-10-21 11:37:48'),
(6, 'FG-00006', 'test12345', 2, '<p>Testing&nbsp;</p>', 'Test Payment', 0, 0, 'Abbas', NULL, NULL, NULL, 1, NULL, '2020-11-04 18:20:40', '2020-11-04 18:20:40'),
(7, 'FG-00007', '456', 2, '<p>package will receive in 2 working days</p>', 'on delivery', 2, 1, 'abbas sheikh', NULL, NULL, NULL, 1, 1, '2020-11-04 18:25:24', '2020-11-04 18:27:07'),
(8, 'FG-00008', '100', 2, 'Leather Gloves', 'T/T before shipment', 0, 1, 'USA', NULL, NULL, NULL, 1, 1, '2020-11-11 11:33:00', '2020-11-13 17:55:09'),
(9, 'FG-00009', 'FINE/786-476/20', 7, '<p>Majestic Gloves</p>', '30 days from B/L date', 0, 1, 'USA', NULL, NULL, NULL, 1, NULL, '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(10, 'FG-00010', 'FINE/786-476/20', 7, '<p>Majestic Gloves</p>', 'T/T before shipment', 0, 1, 'USA', NULL, NULL, NULL, 1, NULL, '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(11, 'FG-00011', 'FINE/786-476/20', 7, '<p>Majestic Gloves</p>', 'T/T before shipment', 0, 1, 'USA', 'RAS', '1 UPTO 0', 'TST', 1, NULL, '2020-12-04 11:31:48', '2020-12-04 11:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `perfoma_invoice_details`
--

CREATE TABLE `perfoma_invoice_details` (
  `id` int(11) NOT NULL,
  `perfoma_invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `article_rate` decimal(10,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfoma_invoice_details`
--

INSERT INTO `perfoma_invoice_details` (`id`, `perfoma_invoice_id`, `product_id`, `size_id`, `quantity`, `unit`, `carton`, `article_rate`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 1, 1000, 1, 0, '0.000', '2020-09-11 20:16:42', '2020-09-11 20:16:42'),
(4, 2, 1, 1, 10, 6, 36, '0.000', '2020-09-18 17:26:38', '2020-09-18 17:26:38'),
(5, 3, 1, 2, 10, 6, 36, '0.000', '2020-09-23 12:27:27', '2020-09-23 12:27:27'),
(6, 4, 1, 2, 72, 6, 2, '0.000', '2020-10-03 12:13:24', '2020-10-03 12:13:24'),
(7, 4, 4, 4, 72, 6, 2, '0.000', '2020-10-03 12:13:24', '2020-10-03 12:13:24'),
(8, 4, 3, 4, 108, 6, 3, '0.000', '2020-10-03 12:13:25', '2020-10-03 12:13:25'),
(9, 5, 1, 1, 100, 6, 3, '1.000', '2020-10-21 11:37:48', '2020-10-21 11:37:48'),
(10, 6, 1, 5, 36, 6, 1, '1.000', '2020-11-04 18:20:41', '2020-11-04 18:20:41'),
(12, 7, 3, 4, 36, 6, 1, '2.000', '2020-11-04 18:27:07', '2020-11-04 18:27:07'),
(19, 8, 3, 4, 72, 6, 2, '2.000', '2020-11-13 17:55:09', '2020-11-13 17:55:09'),
(20, 8, 4, 6, 1080, 6, 30, '3.000', '2020-11-13 17:55:09', '2020-11-13 17:55:09'),
(21, 9, 5, 9, 24, 6, 4, '87.600', '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(22, 9, 5, 10, 72, 6, 12, '87.600', '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(23, 9, 5, 11, 102, 6, 17, '87.600', '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(24, 9, 5, 12, 96, 6, 16, '87.600', '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(25, 9, 5, 13, 30, 6, 5, '87.600', '2020-11-20 09:55:23', '2020-11-20 09:55:23'),
(26, 10, 5, 9, 54, 8, 9, '87.600', '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(27, 10, 5, 10, 150, 8, 25, '87.600', '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(28, 10, 5, 11, 204, 8, 34, '87.600', '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(29, 10, 5, 12, 192, 8, 32, '87.600', '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(30, 10, 5, 13, 24, 8, 4, '87.600', '2020-12-04 11:03:26', '2020-12-04 11:03:26'),
(31, 11, 5, 9, 24, 8, 4, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(32, 11, 5, 10, 72, 8, 12, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(33, 11, 5, 11, 102, 8, 17, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(34, 11, 5, 12, 96, 8, 16, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(35, 11, 5, 13, 30, 8, 5, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(36, 11, 6, 9, 6, 6, 1, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(37, 11, 6, 10, 24, 6, 4, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(38, 11, 6, 11, 72, 6, 12, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(39, 11, 6, 12, 102, 6, 17, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48'),
(40, 11, 6, 13, 96, 6, 16, '87.600', '2020-12-04 11:31:48', '2020-12-04 11:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', '2020-06-23 00:42:06', '2020-06-23 00:42:06'),
(2, 'Admin', 'web', '2020-06-23 00:42:39', '2020-06-23 00:42:39'),
(3, 'Employee', 'web', '2020-06-23 00:44:07', '2020-06-23 00:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `po_materials`
--

CREATE TABLE `po_materials` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `code` text NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `unit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_materials`
--

INSERT INTO `po_materials` (`id`, `name`, `description`, `code`, `price`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Testing PO Material', 'ABCD', '12252`', '10.000', 2, '2020-10-21 15:52:36', '2020-10-28 09:10:12'),
(2, 'TL#3MCS100', '3M Thinsulate ( CS-100)', '5603.9300', '2.520', 1, '2020-10-31 11:45:22', '2020-10-31 11:45:22'),
(3, 'Basic Chromium Sulfate HLS-C', 'Basic Chromium Sulfate', '32029010', '0.735', 0, '2020-11-20 10:19:10', '2020-12-04 11:13:27'),
(4, 'Etc', 'Etc', '32029010', '0.745', 0, '2020-12-04 11:23:09', '2020-12-04 11:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `stitching_rate_a` decimal(10,2) DEFAULT NULL,
  `stitching_rate_b` decimal(10,2) DEFAULT NULL,
  `commission_rate` decimal(10,2) DEFAULT NULL,
  `elastic_commission_rate` decimal(10,2) DEFAULT NULL,
  `magzi_commission_rate` decimal(10,2) DEFAULT NULL,
  `article_rate` decimal(10,2) NOT NULL,
  `customer_article` text NOT NULL,
  `brand_name` text NOT NULL,
  `individual_packing` decimal(10,2) NOT NULL,
  `bundle_packing` decimal(10,2) NOT NULL,
  `inner_carton` decimal(10,2) DEFAULT NULL,
  `inner_carton_dimension` int(11) DEFAULT NULL,
  `master_carton` decimal(10,2) NULL,
  `master_carton_dimension` int(11) NULL,
  `net_weight_per_carton` decimal(10,2) NOT NULL,
  `gross_weight_per_carton` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `unit` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `customer_id`, `stitching_rate_a`, `stitching_rate_b`, `commission_rate`, `elastic_commission_rate`, `magzi_commission_rate`, `article_rate`, `customer_article`, `brand_name`, `individual_packing`, `bundle_packing`, `inner_carton`, `inner_carton_dimension`, `master_carton`, `master_carton_dimension`, `net_weight_per_carton`, `gross_weight_per_carton`, `description`, `unit`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CS4060', 2, '60.00', '0.00', '5.00', '0.55', '1.10', '1.00', 'CS4060', 'HexArmor', '0.00', '12.00', '0.00', 7, '36.00', 5, '0.00', '0.00', 'Chrome SLT Leather with Impact.', 6, 1, '2020-09-05 10:39:16', '2020-10-03 12:11:28', NULL),
(3, 'CS4062', 2, '33.00', '0.00', '0.95', '0.00', '0.00', '2.00', 'CS4062', 'HexArmor', '12.00', '12.00', '0.00', 7, '36.00', 6, '0.00', '0.00', 'Chrome SLT Leather Gloves with extended cuff Hi-Viz.', 6, 1, '2020-09-07 17:25:25', '2020-10-03 12:11:08', NULL),
(4, 'CS4061', 2, '25.65', '0.00', '0.95', '0.55', '1.10', '3.00', 'CS4061', 'HexArmor', '0.00', '12.00', '0.00', 7, '36.00', 6, '0.00', '0.00', 'Chrome SLT Leather.', 6, 1, '2020-09-09 11:27:06', '2020-11-13 17:57:08', NULL),
(5, 'Z21285A', 7, '68.00', '0.00', '0.00', '0.00', '0.00', '87.60', 'Z21285A', 'Majestc', '1.00', '1.00', '0.00', 7, '6.00', 8, '0.00', '0.00', 'Goatskin Leather Gloves BC Grade, ANSI Cut A6, APM Logo TPR Back, Outer: 100% Leather, Inner: Kevlar Lining 35%, Steel 33%, Polyester 16% and Acrylic 16%.', 8, 1, '2020-11-19 18:47:21', '2020-12-04 11:06:49', NULL),
(6, '21285A', 7, '68.00', '0.00', '0.00', '0.00', '0.00', '87.60', '21285A', 'Majestc', '0.00', '1.00', '0.00', 7, '6.00', 8, '0.00', '0.00', 'Goatskin Leather Gloves BC Grade, ANSI Cut A6, APM\r\nLogo TPR Back, Outer: 100% Leather, Inner: Kevlar\r\nLining 35%, Steel 33%, Polyester 16% and Acrylic\r\n16%.', 6, 1, '2020-12-04 11:29:11', '2020-12-04 11:32:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `material_hand_rate` double DEFAULT NULL,
  `material_press_rate` double DEFAULT NULL,
  `consumption` text NOT NULL,
  `measurement` int(11) NOT NULL,
  `usaged` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`id`, `material_id`, `product_id`, `material_hand_rate`, `material_press_rate`, `consumption`, `measurement`, `usaged`, `created_at`, `updated_at`, `deleted_at`) VALUES
(40, 1, 3, 0, 4.1, '.', 6, NULL, '2020-10-03 12:11:08', '2020-10-03 12:11:08', NULL),
(41, 1, 1, 0, 3.9, '.', 6, NULL, '2020-10-03 12:11:28', '2020-10-03 12:11:28', NULL),
(42, 1, 4, 0, 3.9, '.', 6, NULL, '2020-11-13 17:57:08', '2020-11-13 17:57:08', NULL),
(48, 1, 5, 0, 3.9, '.', 6, NULL, '2020-12-04 11:06:49', '2020-12-04 11:06:49', NULL),
(50, 1, 6, 0, 3.9, '.', 6, NULL, '2020-12-04 11:32:39', '2020-12-04 11:32:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `updated_at`, `created_at`) VALUES
(263, 3, 2, '2020-10-03 12:11:08', '2020-10-03 12:11:08'),
(264, 3, 3, '2020-10-03 12:11:08', '2020-10-03 12:11:08'),
(265, 3, 4, '2020-10-03 12:11:08', '2020-10-03 12:11:08'),
(266, 3, 5, '2020-10-03 12:11:08', '2020-10-03 12:11:08'),
(267, 1, 1, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(268, 1, 2, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(269, 1, 3, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(270, 1, 4, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(271, 1, 5, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(272, 1, 6, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(273, 1, 7, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(274, 1, 8, '2020-10-03 12:11:28', '2020-10-03 12:11:28'),
(275, 4, 1, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(276, 4, 2, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(277, 4, 3, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(278, 4, 4, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(279, 4, 5, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(280, 4, 6, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(281, 4, 8, '2020-11-13 17:57:08', '2020-11-13 17:57:08'),
(307, 5, 9, '2020-12-04 11:06:49', '2020-12-04 11:06:49'),
(308, 5, 10, '2020-12-04 11:06:49', '2020-12-04 11:06:49'),
(309, 5, 11, '2020-12-04 11:06:49', '2020-12-04 11:06:49'),
(310, 5, 12, '2020-12-04 11:06:49', '2020-12-04 11:06:49'),
(311, 5, 13, '2020-12-04 11:06:49', '2020-12-04 11:06:49'),
(317, 6, 9, '2020-12-04 11:32:39', '2020-12-04 11:32:39'),
(318, 6, 10, '2020-12-04 11:32:39', '2020-12-04 11:32:39'),
(319, 6, 11, '2020-12-04 11:32:39', '2020-12-04 11:32:39'),
(320, 6, 12, '2020-12-04 11:32:39', '2020-12-04 11:32:39'),
(321, 6, 13, '2020-12-04 11:32:39', '2020-12-04 11:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(11) NOT NULL,
  `po_no` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `import_no` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_terms` text COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `price_base` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_no`, `date`, `supplier_id`, `import_no`, `payment_terms`, `notes`, `shipping_method`, `price_base`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PO_110', '29-12-2020', 1, 'IM-1112', 'Testing', '', 0, 0, 1, 1, '2020-10-28 03:31:27', '2020-11-10 13:02:20'),
(2, 'RAS/TLI/TN/11/20', '31-10-2020', 2, '1', 'T/T Before Shipment', '<ol>\r\n	<li>This is testing note 1.</li>\r\n	<li>This is&nbsp;testing note 2.</li>\r\n	<li>This is testing note 3.</li>\r\n	<li>This is&nbsp;testing note 4.</li>\r\n</ol>', 0, 0, 1, 1, '2020-10-31 11:46:48', '2020-11-10 18:25:22'),
(4, 'PK2050', '19-10-2020', 4, '1', 'T/T before shipment', '<p>1. Point 1</p>\r\n\r\n<p>2. Point 2</p>\r\n\r\n<p>3. Point 3</p>', 0, 0, 1, 1, '2020-11-20 12:24:36', '2020-12-04 11:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `po_material_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(10,3) NOT NULL,
  `unit` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`id`, `po_id`, `po_material_id`, `quantity`, `rate`, `unit`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 10, '10.000', 2, '2020-10-28 03:31:45', '2020-10-28 03:31:45'),
(5, 2, 2, 6400, '2.520', 1, '2020-11-10 18:25:22', '2020-11-10 18:25:22'),
(9, 4, 3, 20000, '0.740', 0, '2020-12-04 11:23:34', '2020-12-04 11:23:34'),
(10, 4, 4, 1500, '0.750', 0, '2020-12-04 11:23:35', '2020-12-04 11:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'web', '2020-06-23 00:58:02', '2020-06-23 00:58:02'),
(2, 'Admin', 'web', '2020-06-23 00:59:21', '2020-06-23 00:59:21'),
(3, 'Employee', 'web', '2020-06-23 00:59:26', '2020-06-23 00:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'S', 1, NULL, '2020-09-05 10:07:55', '2020-10-28 09:10:12'),
(2, 'M', 1, NULL, '2020-09-05 10:08:13', '2020-10-28 09:10:12'),
(3, 'L', 1, NULL, '2020-09-05 10:08:24', '2020-10-28 09:10:12'),
(4, 'XL', 1, NULL, '2020-09-05 10:08:45', '2020-10-28 09:10:12'),
(5, '2XL', 1, NULL, '2020-09-05 10:09:14', '2020-10-28 09:10:12'),
(6, '3XL', 1, NULL, '2020-09-05 10:09:28', '2020-10-28 09:10:12'),
(7, '4XL', 1, NULL, '2020-09-05 10:09:47', '2020-10-28 09:10:12'),
(8, '5XL', 1, NULL, '2020-09-05 10:09:57', '2020-10-28 09:10:12'),
(9, '8/S', 1, NULL, '2020-11-19 18:25:19', '2020-11-19 18:25:19'),
(10, '9/M', 1, NULL, '2020-11-19 18:25:37', '2020-11-19 18:25:37'),
(11, '10/L', 1, NULL, '2020-11-19 18:25:59', '2020-11-19 18:25:59'),
(12, '11/XL', 1, NULL, '2020-11-19 18:26:18', '2020-11-19 18:26:18'),
(13, '12/2XL', 1, NULL, '2020-11-19 18:27:23', '2020-11-19 18:27:23'),
(14, '7/S', 1, NULL, '2020-12-03 18:02:26', '2020-12-03 18:02:26'),
(15, '11/X1', 1, NULL, '2020-12-03 18:03:09', '2020-12-03 18:03:09'),
(16, '12/X2', 1, NULL, '2020-12-03 18:03:37', '2020-12-03 18:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `company_name` text NOT NULL,
  `company_address` text NOT NULL,
  `currency` int(11) NOT NULL,
  `contact_no` text NOT NULL,
  `email` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company_name`, `company_address`, `currency`, `contact_no`, `email`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Abbas', 'planet012', 'abcd efgh\nabcd efgh', 0, '0321652', 'abbas@gmail.com', 1, NULL, '2020-10-21 15:16:15', '2020-10-28 09:10:12'),
(2, 'Mrs. Lynnette Chiou', 'Tiong Liong Industrial Co. Ltd.', 'No. 8, lane 758, Sec. 3, Zhong Qing Road, Da-Ya District, Taichung City 42878, Taiwan.', 0, '+886-4-25666126', 'zkoinex@tiongliong.com', 1, NULL, '2020-10-31 11:43:41', '2020-10-31 11:43:41'),
(3, 'shaikh naseeb', 'mightyvacuum', 'abc tariq road', 1, '03453316856', 'naseeb@gmail.com', 1, NULL, '2020-11-10 17:23:49', '2020-11-10 17:24:30'),
(4, '.', 'Brother Enterprises Holding Co,. Ltd.', 'Zhouwangmiao, Haining City, Zhejiang Province, China', 0, '86-573-87537762', '.', 1, NULL, '2020-11-20 10:17:24', '2020-12-04 11:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@resourcemanagement.com', NULL, '$2y$10$LvzcaSQiYAiCPwhdp1OkHeKKjwOhuvnFDPn7r2K5jWQ8QzuARISOy', NULL, '2020-06-21 19:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartons`
--
ALTER TABLE `cartons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packing_lists`
--
ALTER TABLE `packing_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packing_list_details`
--
ALTER TABLE `packing_list_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `perfoma_invoices`
--
ALTER TABLE `perfoma_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perfoma_invoice_details`
--
ALTER TABLE `perfoma_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po_materials`
--
ALTER TABLE `po_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartons`
--
ALTER TABLE `cartons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packing_lists`
--
ALTER TABLE `packing_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packing_list_details`
--
ALTER TABLE `packing_list_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perfoma_invoices`
--
ALTER TABLE `perfoma_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perfoma_invoice_details`
--
ALTER TABLE `perfoma_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `po_materials`
--
ALTER TABLE `po_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
