-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2025 at 11:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionhub_saas`
--

-- --------------------------------------------------------

--
-- Table structure for table `age_verification`
--

CREATE TABLE `age_verification` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `age_verification_on_off` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `popup_type` varchar(255) DEFAULT NULL,
  `min_age` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `android_link` varchar(255) NOT NULL,
  `ios_link` varchar(255) NOT NULL,
  `mobile_app_on_off` int(11) NOT NULL COMMENT '1=yes,2=no\r\n',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(1) DEFAULT NULL COMMENT '1=category,2=service',
  `section` int(11) NOT NULL DEFAULT 1 COMMENT '0=sliders,1=banner1,2=banner2,3=banner3',
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link_text` varchar(255) DEFAULT NULL,
  `custom_link` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `session_id` text DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `variation_name` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `tax` varchar(255) DEFAULT NULL,
  `product_price` double NOT NULL,
  `price` float DEFAULT NULL,
  `variants_id` varchar(255) DEFAULT NULL,
  `product_tax` varchar(255) DEFAULT NULL,
  `extras_id` varchar(255) DEFAULT NULL,
  `extras_name` varchar(255) DEFAULT NULL,
  `extras_price` varchar(255) DEFAULT NULL,
  `buynow` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1--> yes, 2-->No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1--> yes, 2-->No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes,2=No',
  `reorder_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customdomains`
--

CREATE TABLE `customdomains` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` varchar(255) NOT NULL,
  `requested_domain` varchar(255) NOT NULL,
  `current_domain` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=pending ,2=connected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_status`
--

CREATE TABLE `custom_status` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=default,2=process,3=complete,4=cancel',
  `is_available` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 2,
  `order_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=delivery,2=pickup,3=dinein,4=pos',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custom_status`
--

INSERT INTO `custom_status` (`id`, `reorder_id`, `vendor_id`, `name`, `type`, `is_available`, `is_deleted`, `order_type`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Pending', 1, 1, 2, 1, '2023-12-26 05:25:24', '2023-12-26 05:25:24'),
(2, 0, 1, 'Accepted', 2, 1, 2, 1, '2023-12-26 05:25:37', '2023-12-26 05:25:37'),
(3, 0, 1, 'Out For Delivery', 2, 1, 2, 1, '2023-12-26 05:25:52', '2023-12-26 05:25:52'),
(4, 0, 1, 'Complete', 3, 1, 2, 1, '2023-12-26 05:26:05', '2023-12-26 05:26:05'),
(5, 0, 1, 'Cancel', 4, 1, 2, 1, '2023-12-26 05:26:15', '2023-12-26 05:26:15'),
(6, 0, 1, 'Pending', 1, 1, 2, 4, '2023-12-26 05:25:24', '2023-12-26 05:25:24'),
(7, 0, 1, 'Accepted', 2, 1, 2, 4, '2023-12-26 05:25:37', '2023-12-26 05:25:37'),
(8, 0, 1, 'Out For Delivery', 2, 1, 2, 4, '2023-12-26 05:25:52', '2023-12-26 05:25:52'),
(9, 0, 1, 'Complete', 3, 1, 2, 4, '2023-12-26 05:26:05', '2023-12-26 05:26:05'),
(10, 0, 1, 'Cancel', 4, 1, 2, 4, '2023-12-26 05:26:15', '2023-12-26 05:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `answer` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firebase`
--

CREATE TABLE `firebase` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` longtext NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footerfeatures`
--

CREATE TABLE `footerfeatures` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fun_fact`
--

CREATE TABLE `fun_fact` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `global_extras`
--

CREATE TABLE `global_extras` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `howitworks`
--

CREATE TABLE `howitworks` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_settings`
--

CREATE TABLE `landing_settings` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `landing_home_banner` varchar(255) DEFAULT NULL,
  `subscribe_image` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) DEFAULT NULL,
  `secondary_color` varchar(255) DEFAULT NULL,
  `faq_image` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `landing_settings`
--

INSERT INTO `landing_settings` (`id`, `vendor_id`, `landing_home_banner`, `subscribe_image`, `primary_color`, `secondary_color`, `faq_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'banner-65954af0ee77d.webp', 'subscribe-67ce91f71f4d4.png', '#0d070d', '#d7002d', 'faq-66069cdf2341b.png', '2023-08-15 05:05:24', '2025-03-10 07:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `layout` int(11) NOT NULL DEFAULT 1 COMMENT '1=ltr,2=rtl',
  `is_default` int(11) NOT NULL DEFAULT 2 COMMENT '1 = yes , 2 = no',
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `image`, `layout`, `is_default`, `is_available`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 'flag-64f1dd9a3700d.webp', 1, 1, 1, 2, '2022-12-13 05:15:46', '2025-01-31 07:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` text DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_number_digit` int(11) DEFAULT NULL,
  `order_number_start` int(11) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mobile` varchar(255) NOT NULL,
  `billing_address` varchar(255) DEFAULT NULL,
  `billing_landmark` varchar(255) DEFAULT NULL,
  `billing_postal_code` varchar(255) DEFAULT NULL,
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_state` varchar(255) DEFAULT NULL,
  `billing_country` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_landmark` varchar(255) DEFAULT NULL,
  `shipping_postal_code` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_state` varchar(255) DEFAULT NULL,
  `shipping_country` varchar(255) DEFAULT NULL,
  `sub_total` double NOT NULL DEFAULT 0,
  `product_price` float DEFAULT NULL,
  `offer_code` varchar(255) DEFAULT NULL,
  `offer_amount` double DEFAULT 0,
  `tax_amount` varchar(255) DEFAULT '0',
  `tax_name` varchar(255) DEFAULT NULL,
  `shipping_area` varchar(255) DEFAULT NULL,
  `delivery_charge` double NOT NULL DEFAULT 0,
  `grand_total` double NOT NULL DEFAULT 0,
  `tips` double NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `transaction_type` varchar(255) NOT NULL DEFAULT '0',
  `payment_status` int(11) NOT NULL COMMENT '1=unpaid,2=paid',
  `status` int(11) NOT NULL COMMENT '1 = order placed , 2 = order confirmed/accepted , 3 = order cancelled/rejected - by admin , 4 = order cancelled/rejected - by user/customer , 5 = order delivered , ',
  `status_type` int(11) NOT NULL COMMENT '1=pending,2=process,3=complete,4=cancel',
  `is_notification` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Unread , 2 = Read',
  `notes` longtext DEFAULT NULL,
  `order_from` varchar(255) DEFAULT NULL,
  `order_type` int(11) NOT NULL COMMENT '1=delivery,4=pos,5=digital',
  `vendor_note` varchar(255) NOT NULL,
  `screenshot` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` text DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `product_image` varchar(255) NOT NULL,
  `attribute` varchar(255) DEFAULT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `variation_name` varchar(255) DEFAULT NULL,
  `extras_id` varchar(255) DEFAULT NULL,
  `extras_name` varchar(255) DEFAULT NULL,
  `extras_price` varchar(255) DEFAULT NULL,
  `product_price` double NOT NULL,
  `price` float DEFAULT NULL,
  `product_tax` double DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_settings`
--

CREATE TABLE `other_settings` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `tips_settings` int(11) DEFAULT NULL,
  `trusted_badge_image_1` text DEFAULT NULL,
  `trusted_badge_image_2` text DEFAULT NULL,
  `trusted_badge_image_3` text DEFAULT NULL,
  `trusted_badge_image_4` text DEFAULT NULL,
  `safe_secure_checkout_payment_selection` varchar(255) DEFAULT NULL,
  `safe_secure_checkout_text` varchar(255) DEFAULT NULL,
  `safe_secure_checkout_text_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `unique_identifier` varchar(255) DEFAULT NULL,
  `environment` int(11) NOT NULL DEFAULT 1 COMMENT '1=sandbox,2=production',
  `payment_name` text NOT NULL,
  `payment_type` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `public_key` text DEFAULT NULL,
  `secret_key` text DEFAULT NULL,
  `encryption_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_description` varchar(255) DEFAULT NULL,
  `base_url_by_region` text DEFAULT NULL,
  `is_available` int(11) NOT NULL,
  `is_activate` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `vendor_id`, `reorder_id`, `unique_identifier`, `environment`, `payment_name`, `payment_type`, `image`, `currency`, `public_key`, `secret_key`, `encryption_key`, `payment_description`, `base_url_by_region`, `is_available`, `is_activate`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, 1, 'cod', 1, 'cod.png', '', '', '', '', NULL, '', 1, 1, '2020-12-28 04:24:50', '2025-04-17 11:08:56'),
(2, 1, 2, 'razorpay', 1, 'RazorPay', 2, 'razorpay.png', 'INR', 'rzp_test_4r8y0wDMkrUDFn', 'nys_ty_key', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(3, 1, 1, 'stripe', 1, 'Stripe', 3, 'stripe.png', 'USD', 'pk_test_51IjNgIJwZppK21ZQa6e7ZVOImwJ2auI54TD6xHici94u7DD5mhGf1oaBiDyL9mX7PbN5nt6Weap4tmGWLRIrslCu00d8QgQ3nI', 'sk_test_51IjNgIJwZppK21ZQK85uLARMdhtuuhA81PB24VDfiqSW8SXQZKrZzvbpIkigEb27zZPBMF4UEG7PK9587Xresuc000x8CdE22A', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-04-16 06:15:00'),
(4, 1, 3, 'flutterwave', 1, 'Flutterwave', 4, 'flutterwave.png', 'NGN', 'FLWPUBK_TEST-4de3dcae2196d3aaf5594d600f32fab6-X', 'FLWSECK_TEST-e94cd88ad6ebea4d6901ff40653f938b-X', 'FLWSECK_TEST863a39eb1475', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(5, 1, 4, 'paystack', 1, 'Paystack', 5, 'paystack.png', 'GHS', 'pk_test_8a6a139a3bae6e41cbbbc41f4d7b65d4da9f7967', 'sk_test_6ab143b6f0c2a209373adeef55a64411c1a91ae9', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(6, 1, 5, 'bank_trasfer', 1, 'BankTransfer', 6, 'banktransfer.png', NULL, NULL, NULL, '', '<p>Bank:Axis Bank</p>\r\n\r\n<p>Account No:755674565</p>', NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(7, 1, 6, 'mercadopago', 1, 'MercadoPago', 7, 'mercadopago.png', 'R$', '-', 'APP_USR-3693146734015792-042811-c6deca56df8ac66e83efb5334c46110c-126508225', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(8, 1, 7, 'paypal', 1, 'PayPal', 8, 'paypal.png', 'USD', 'AcRx7vvy79nbNxBemacGKmnnRe_CtxkItyspBS_eeMIPREwfCEIfPg1uX-bdqPrS_ZFGocxEH_SJRrIJ', 'EGtgNkjt3I5lkhEEzicdot8gVH_PcFiKxx6ZBiXpVrp4QLDYcVQQMLX6MMG_fkS9_H0bwmZzBovb4jLP', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(9, 1, 8, 'myfatoorah', 1, 'MyFatoorah', 9, 'myfatoorah.png', 'KWT', '-', 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:45'),
(10, 1, 9, 'toyyibpay', 1, 'toyyibpay', 10, 'toyyibpay.png', 'RM', 'ts75iszg', 'luieh2jt-8hpa-m2xv-wrkv-ejrfvhjppnsj', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(11, 1, 10, 'phonepe', 1, 'phonepe', 11, 'phonepe.png', 'INR', 'PGTESTPAYUAT86', '96434309-7796-489d-8924-ab56988a6076', '', NULL, '', 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(12, 1, 11, 'paytab', 1, 'paytab', 12, 'paytab.png', 'INR', '132879', 'SZJ99G6MRL-JH66MZL26H-G9BBKKMKM6', '', NULL, 'https://secure-global.paytabs.com/payment/request', 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(13, 1, 12, 'mollie', 1, 'mollie', 13, 'mollie.png', 'EUR', '', 'test_FbVACj7UbsdkHtAUWnCnmSNGFWMuuA', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(14, 1, 13, 'khalti', 1, 'khalti', 14, 'khalti.png', 'INR', '', 'live_secret_key_68791341fdd94846a146f0457ff7b455', '', NULL, NULL, 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(15, 1, 14, 'xendit', 1, 'xendit', 15, 'xendit.png', 'INR', 'xnd_development_IqYpzXrPJZlxhQDlU9rNoiPQtTFFQAjAf211dK2UDXHkdfj3q1BRgIR3zvp25', 'xnd_development_IqYpzXrPJZlxhQDlU9rNoiPQtTFFQAjAf211dK2UDXHkdfj3q1BRgIR3zvp25', '', NULL, '', 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46'),
(16, 1, 15, NULL, 1, 'wallet', 16, 'wallet.png', '', '', '', '', NULL, '', 1, 1, '2020-12-28 04:15:15', '2025-01-09 12:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pixcel_settings`
--

CREATE TABLE `pixcel_settings` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `twitter_pixcel_id` varchar(255) DEFAULT NULL,
  `facebook_pixcel_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `linkedin_pixcel_id` varchar(255) DEFAULT NULL,
  `google_tag_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` float NOT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `themes_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_type` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL COMMENT '1=1 month\r\n2=3 month\r\n3=6 month\r\n4=1\r\n year\r\n\r\n\r\n',
  `order_limit` int(11) NOT NULL,
  `appointment_limit` int(11) NOT NULL,
  `custom_domain` int(11) NOT NULL DEFAULT 2 COMMENT '1 = yes, 2 = no',
  `google_analytics` int(11) NOT NULL COMMENT '1 = yes , 2 = no',
  `pos` int(11) DEFAULT NULL COMMENT '1 = yes , 2 = no',
  `vendor_app` int(11) NOT NULL COMMENT '1 = yes , 2 = no',
  `is_available` int(11) DEFAULT 1 COMMENT '1=Yes\r\n2=No\r\n',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_management` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `customer_app` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `pwa` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `coupons` int(11) DEFAULT NULL,
  `blogs` int(11) DEFAULT NULL,
  `social_logins` int(11) DEFAULT NULL,
  `sound_notification` int(11) DEFAULT NULL,
  `whatsapp_message` int(11) DEFAULT NULL,
  `telegram_message` int(11) DEFAULT NULL,
  `pixel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `has_variation` int(11) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `has_extras` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `attribute` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `original_price` double NOT NULL DEFAULT 0,
  `sku` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `low_qty` int(11) DEFAULT NULL,
  `min_order` int(11) DEFAULT NULL,
  `max_order` int(11) DEFAULT NULL,
  `stock_management` int(11) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `additional_info` longtext DEFAULT NULL,
  `top_deals` int(11) DEFAULT 2,
  `video_url` varchar(255) DEFAULT NULL,
  `is_imported` int(11) DEFAULT NULL,
  `attchment_name` varchar(255) DEFAULT NULL,
  `attchment_file` varchar(255) DEFAULT NULL,
  `download_file` varchar(255) DEFAULT NULL,
  `variants_json` longtext DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1="yes",2="no"',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1="yes",2="no"',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `is_imported` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `offer_name` varchar(255) NOT NULL,
  `offer_code` varchar(255) NOT NULL,
  `offer_type` int(11) NOT NULL COMMENT '1=fixed,2=percentage',
  `offer_amount` varchar(255) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `usage_type` int(11) DEFAULT NULL COMMENT '1=Limited time\r\n,2=multiple times',
  `usage_limit` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `description` longtext NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotionalbanner`
--

CREATE TABLE `promotionalbanner` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE `role_access` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `add` int(11) NOT NULL,
  `edit` int(11) NOT NULL,
  `delete` int(11) NOT NULL,
  `manage` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_manager`
--

CREATE TABLE `role_manager` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module` longtext NOT NULL,
  `is_available` varchar(255) NOT NULL,
  `is_deleted` int(11) NOT NULL COMMENT '1=yes,2=no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `maintenance_mode` int(11) NOT NULL COMMENT '1 = yes, 2 = no',
  `checkout_login_required` int(11) NOT NULL DEFAULT 2,
  `currency` varchar(255) NOT NULL DEFAULT 'INR',
  `currency_position` varchar(255) NOT NULL DEFAULT '1' COMMENT '1=left, 2=right',
  `currency_formate` int(11) NOT NULL,
  `currency_space` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `decimal_separator` int(11) NOT NULL DEFAULT 1,
  `logo` varchar(255) DEFAULT 'default-logo.png',
  `favicon` varchar(255) NOT NULL DEFAULT 'default-favicon.png',
  `subscribe_image` varchar(255) DEFAULT NULL,
  `viewallpage_banner` varchar(255) DEFAULT NULL,
  `delivery_type` varchar(10) DEFAULT NULL,
  `timezone` varchar(255) NOT NULL DEFAULT 'Asia/Kolkata',
  `referral_amount` varchar(255) DEFAULT NULL,
  `wait_time` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT '-',
  `mobile` varchar(255) DEFAULT '-',
  `contact` varchar(255) NOT NULL DEFAULT '-',
  `email` varchar(255) DEFAULT '-',
  `footer_description` longtext DEFAULT NULL,
  `copyright` varchar(255) NOT NULL DEFAULT 'Copyright © 2021-2022',
  `web_title` varchar(255) NOT NULL DEFAULT 'admin',
  `web_layout` varchar(255) NOT NULL DEFAULT '1' COMMENT '1=LTR, 2=RTL',
  `primary_color` varchar(255) NOT NULL DEFAULT '#16162e',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#f15a24',
  `landing_website_title` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `custom_domain` text DEFAULT NULL,
  `cname_text` text NOT NULL,
  `cname_title` text NOT NULL,
  `terms_content` longtext DEFAULT NULL,
  `privacy_content` longtext DEFAULT NULL,
  `about_content` longtext DEFAULT NULL,
  `refund_policy` longtext DEFAULT NULL,
  `theme` int(11) DEFAULT 1,
  `firebase` longtext NOT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `view_id` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) NOT NULL,
  `notification_sound` varchar(255) NOT NULL,
  `recaptcha_version` varchar(255) DEFAULT NULL,
  `google_recaptcha_site_key` varchar(255) DEFAULT '-',
  `google_recaptcha_secret_key` varchar(255) DEFAULT NULL,
  `score_threshold` varchar(255) DEFAULT NULL,
  `recaptcha` int(11) DEFAULT NULL,
  `app_name` varchar(255) DEFAULT NULL,
  `app_title` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `theme_color` varchar(255) DEFAULT NULL,
  `app_logo` varchar(255) DEFAULT NULL,
  `pwa` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `mail_driver` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_encryption` varchar(255) DEFAULT NULL,
  `mail_fromaddress` varchar(255) DEFAULT NULL,
  `mail_fromname` varchar(255) DEFAULT NULL,
  `landing_page` int(11) NOT NULL,
  `vendor_register` int(11) NOT NULL,
  `google_client_id` varchar(255) NOT NULL DEFAULT '-',
  `google_client_secret` varchar(255) NOT NULL DEFAULT '-',
  `google_redirect_url` varchar(255) NOT NULL DEFAULT 'http://your-domain-url.com/checklogin/google/callback-google',
  `facebook_client_id` varchar(255) NOT NULL DEFAULT '-',
  `facebook_client_secret` varchar(255) NOT NULL DEFAULT '-',
  `facebook_redirect_url` varchar(255) NOT NULL DEFAULT 'http://your-domain-url.com/checklogin/facebook/callback-facebook',
  `facebook_mode` int(11) DEFAULT NULL,
  `google_mode` int(11) DEFAULT NULL,
  `whoweare_title` varchar(255) DEFAULT NULL,
  `whoweare_subtitle` varchar(255) DEFAULT NULL,
  `whoweare_description` varchar(255) DEFAULT NULL,
  `whoweare_image` varchar(255) DEFAULT NULL,
  `contact_image` varchar(255) DEFAULT NULL,
  `order_detail_image` varchar(255) DEFAULT NULL,
  `auth_image` varchar(255) DEFAULT NULL,
  `product_type` int(11) DEFAULT 1 COMMENT '1=physical,2=digital	',
  `product_ratting_switch` int(11) DEFAULT NULL COMMENT '1=on,2=off',
  `order_success_image` varchar(255) DEFAULT NULL,
  `google_review` varchar(255) DEFAULT NULL,
  `online_order` int(11) NOT NULL DEFAULT 1 COMMENT '1=yes,2=no',
  `min_order_amount` int(11) DEFAULT NULL,
  `no_data_image` varchar(255) DEFAULT NULL,
  `time_format` int(11) DEFAULT NULL,
  `date_format` varchar(255) DEFAULT NULL,
  `order_prefix` varchar(255) DEFAULT NULL,
  `is_checkout_login_required` int(11) DEFAULT NULL,
  `order_number_start` varchar(255) DEFAULT NULL,
  `image_size` float DEFAULT NULL,
  `tawk_widget_id` longtext DEFAULT NULL,
  `tawk_on_off` int(11) NOT NULL DEFAULT 2,
  `languages` longtext DEFAULT NULL,
  `maintenance_image` longtext DEFAULT NULL,
  `store_unavailable_image` longtext DEFAULT NULL,
  `referral_image` text DEFAULT NULL,
  `wizz_chat_settings` text DEFAULT NULL,
  `wizz_chat_on_off` int(11) DEFAULT NULL,
  `default_language` longtext DEFAULT NULL,
  `shopify_store_url` text DEFAULT NULL,
  `shopify_access_token` text DEFAULT NULL,
  `quick_call` int(11) NOT NULL,
  `quick_call_mobile_view_on_off` int(11) DEFAULT NULL,
  `quick_call_position` int(11) NOT NULL DEFAULT 1 COMMENT '1= Left, 2= Right',
  `quick_call_name` text DEFAULT NULL,
  `quick_call_description` text DEFAULT NULL,
  `quick_call_mobile` text DEFAULT NULL,
  `quick_call_image` text DEFAULT NULL,
  `fake_sales_notification` int(11) NOT NULL,
  `product_source` int(11) NOT NULL,
  `next_time_popup` int(11) NOT NULL,
  `notification_display_time` int(11) NOT NULL,
  `sales_notification_position` int(11) NOT NULL,
  `product_fake_view` int(11) NOT NULL,
  `fake_view_message` text DEFAULT NULL,
  `min_view_count` int(11) NOT NULL,
  `max_view_count` int(11) NOT NULL,
  `ship_rocket_on_off` int(11) NOT NULL,
  `api_user_email` text DEFAULT NULL,
  `api_user_password` text DEFAULT NULL,
  `cart_checkout_countdown` int(11) NOT NULL,
  `countdown_message` text DEFAULT NULL,
  `countdown_expired_message` text DEFAULT NULL,
  `countdown_mins` int(11) NOT NULL,
  `min_order_amount_for_free_shipping` text DEFAULT NULL,
  `shipping_charges` text DEFAULT NULL,
  `shipping_area` int(11) DEFAULT NULL,
  `cart_checkout_progressbar` int(11) DEFAULT NULL,
  `progress_message` text DEFAULT NULL,
  `progress_message_end` text DEFAULT NULL,
  `forget_password_email_message` longtext DEFAULT NULL,
  `delete_account_email_message` longtext DEFAULT NULL,
  `banktransfer_request_email_message` longtext DEFAULT NULL,
  `cod_request_email_message` longtext DEFAULT NULL,
  `subscription_reject_email_message` longtext DEFAULT NULL,
  `subscription_success_email_message` longtext DEFAULT NULL,
  `admin_subscription_request_email_message` longtext DEFAULT NULL,
  `admin_subscription_success_email_message` longtext DEFAULT NULL,
  `vendor_register_email_message` longtext DEFAULT NULL,
  `admin_vendor_register_email_message` longtext DEFAULT NULL,
  `vendor_status_change_email_message` longtext DEFAULT NULL,
  `contact_email_message` longtext DEFAULT NULL,
  `new_order_invoice_email_message` longtext DEFAULT NULL,
  `vendor_new_order_email_message` longtext DEFAULT NULL,
  `order_status_email_message` longtext DEFAULT NULL,
  `referral_earning_email_message` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `vendor_id`, `maintenance_mode`, `checkout_login_required`, `currency`, `currency_position`, `currency_formate`, `currency_space`, `decimal_separator`, `logo`, `favicon`, `subscribe_image`, `viewallpage_banner`, `delivery_type`, `timezone`, `referral_amount`, `wait_time`, `address`, `mobile`, `contact`, `email`, `footer_description`, `copyright`, `web_title`, `web_layout`, `primary_color`, `secondary_color`, `landing_website_title`, `meta_title`, `meta_description`, `og_image`, `custom_domain`, `cname_text`, `cname_title`, `terms_content`, `privacy_content`, `about_content`, `refund_policy`, `theme`, `firebase`, `tracking_id`, `view_id`, `cover_image`, `notification_sound`, `recaptcha_version`, `google_recaptcha_site_key`, `google_recaptcha_secret_key`, `score_threshold`, `recaptcha`, `app_name`, `app_title`, `background_color`, `theme_color`, `app_logo`, `pwa`, `mail_driver`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_fromaddress`, `mail_fromname`, `landing_page`, `vendor_register`, `google_client_id`, `google_client_secret`, `google_redirect_url`, `facebook_client_id`, `facebook_client_secret`, `facebook_redirect_url`, `facebook_mode`, `google_mode`, `whoweare_title`, `whoweare_subtitle`, `whoweare_description`, `whoweare_image`, `contact_image`, `order_detail_image`, `auth_image`, `product_type`, `product_ratting_switch`, `order_success_image`, `google_review`, `online_order`, `min_order_amount`, `no_data_image`, `time_format`, `date_format`, `order_prefix`, `is_checkout_login_required`, `order_number_start`, `image_size`, `tawk_widget_id`, `tawk_on_off`, `languages`, `maintenance_image`, `store_unavailable_image`, `referral_image`, `wizz_chat_settings`, `wizz_chat_on_off`, `default_language`, `shopify_store_url`, `shopify_access_token`, `quick_call`, `quick_call_mobile_view_on_off`, `quick_call_position`, `quick_call_name`, `quick_call_description`, `quick_call_mobile`, `quick_call_image`, `fake_sales_notification`, `product_source`, `next_time_popup`, `notification_display_time`, `sales_notification_position`, `product_fake_view`, `fake_view_message`, `min_view_count`, `max_view_count`, `ship_rocket_on_off`, `api_user_email`, `api_user_password`, `cart_checkout_countdown`, `countdown_message`, `countdown_expired_message`, `countdown_mins`, `min_order_amount_for_free_shipping`, `shipping_charges`, `shipping_area`, `cart_checkout_progressbar`, `progress_message`, `progress_message_end`, `forget_password_email_message`, `delete_account_email_message`, `banktransfer_request_email_message`, `cod_request_email_message`, `subscription_reject_email_message`, `subscription_success_email_message`, `admin_subscription_request_email_message`, `admin_subscription_success_email_message`, `vendor_register_email_message`, `admin_vendor_register_email_message`, `vendor_status_change_email_message`, `contact_email_message`, `new_order_invoice_email_message`, `vendor_new_order_email_message`, `order_status_email_message`, `referral_earning_email_message`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, '$', '1', 2, 2, 1, 'logo-67ce934e2fa95.png', 'favicon-660698f157b3f.png', NULL, NULL, NULL, 'Asia/Kolkata', NULL, NULL, '248 Cedar Swamp Rd, Jackson, New Mexico - 08527', '919016996697', '+919016996697', 'paponapp2244@gmail.com', NULL, 'Copyright ©  Papon IT Solutions. All Rights Reserved', 'FashionHub SaaS | Admin Panel', '', '#0d070d', '#d7002d', 'FashionHub SaaS | eCommerce Multi Store Business Website Builder', 'FashionHub SaaS - Multi Vendor SaaS eCommerce Business Website Builder SaaS', 'FashionHub works by allowing businesses to create an online store using the provided templates and tools. Once the store has been created, businesses can start adding products and making changes to their store\'s design as needed. They can also set up shipping and payment options, and more. Additionally, FashionHub provides users with access to a wide range of features designed to help them improve their online presence and increase sales', 'og_image-6790b9b2b6dce.png', NULL, '<p>If you&#39;re using cPanel or Plesk then you need to manually add custom domain in your server with the same root directory as the script&#39;s installation&nbsp;and user need to point their custom domain A record with your server IP Ex.&nbsp;<strong>68.178.145.4</strong></p>', 'Read All Instructions Carefully Before Sending Custom Domain Request', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 1, '', 'UA-198831188-3', '286776379', '', '', 'v2', '6Le4thUqAAAAANTzQ3XbjY7iv_RjPwu4_up1MLGn', '6Le4thUqAAAAACmz2XBgGOKJZG1hnzFAkaQ5HXEh', '0.5', 1, NULL, NULL, NULL, NULL, '', NULL, 'smtp', 'smtp.gmail.com', '587', 'infogravity2022@gmail.com', 'vopumcetyxasfyux', 'tls', 'hello@example.com', 'Gravity', 1, 1, 'google_client_id', 'google_client_secret', 'https://domainurl.com/checklogin/google/callback-google', 'facebook_client_id', 'facebook_client_id', 'https://domainurl.com/checklogin/facebook/callback-facebook', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'auth_image-6790b99d74ab4.png', 0, NULL, '', NULL, 0, NULL, NULL, 2, 'd M, Y', NULL, 2, NULL, 2, '<script type=\"text/javascript\">\n                var Tawk_API = Tawk_API || {},\n                    Tawk_LoadStart = new Date();\n                (function() {\n                    var s1 = document.createElement(\"script\"),\n                        s0 = document.getElementsByTagName(\"script\")[0];\n                    s1.async = true;\n                    s1.src =\n                        \'https://embed.tawk.to/65d7258a9131ed19d9700056/1hn86l9qi\';\n                    s1.charset = \'UTF-8\';\n                    s1.setAttribute(\'crossorigin\', \'*\');\n                    s0.parentNode.insertBefore(s1, s0);\n                })();\n            </script>', 1, '', 'maintenance-66069cdf23edc.png', 'store_unavailable-66069cdf24b45.png', NULL, '<script id=\"chat-init\" src=\"https://app.wizzchat.com/account/js/init.js?id=6505747\"></script>', 1, 'en', NULL, NULL, 1, 1, 1, 'Papon IT Solution', 'Hey there 👋 Need help? I\'m here for you, so just give me a call.', '+919016996697', 'quick-call-678b38d6aed0d.png', 0, 0, 0, 0, 0, 0, NULL, 0, 0, 0, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, 0, NULL, NULL, 'Dear {user},\r\n\r\nYour Temporary Password Is : {password}', 'Dear {vendorname},\n\nWe hope this message finds you well. We regret to inform you that your account has been deleted', 'Dear {vendorname},\r\n\r\nWe hope this email finds you well. We are writing to confirm that we have received your recent subscription request and payment via bank transfer. We appreciate your business and thank you for choosing our services.\r\n\r\nWe are currently processing your subscription request and will be in touch with you shortly. Depending on the nature of the subscription, you may receive further instructions, access to a service, or confirmation of your subscription.\r\n\r\nIf you have any questions or concerns, please do not hesitate to reach out to us. Our customer support team is available to assist you with any inquiries you may have.\r\n\r\nThank you again for choosing our services. We look forward to providing you with the best possible experience.\r\n\r\nSincerely\r\n{adminname}\r\n{adminemail}', 'Dear {vendorname},\r\n\r\nWe hope this email finds you well. We are writing to confirm that we have received your recent subscription request and payment via COD. We appreciate your business and thank you for choosing our services.\r\n\r\nWe are currently processing your subscription request and will be in touch with you shortly. Depending on the nature of the subscription, you may receive further instructions, access to a service, or confirmation of your subscription.\r\n\r\nIf you have any questions or concerns, please do not hesitate to reach out to us. Our customer support team is available to assist you with any inquiries you may have.\r\n\r\nThank you again for choosing our services. We look forward to providing you with the best possible experience.\r\n\r\nSincerely\r\n{adminname}\r\n{adminemail}', 'Dear {vendorname},\r\n\r\nI am writing to inform you that your recent {payment_type} request has been rejected. After careful review of your account and the transaction, we have identified a some issues.\r\n\r\nHere are the details of your purchase\r\n\r\nSubscription Plans : {plan_name}\r\nPayment Type : {payment_type}\r\n\r\nYou can take benefits of our online payment system\r\n\r\nIf you have any questions or concerns regarding your subscription, please do not hesitate to contact our customer support team. We are always available to assist you with any queries you may have.\r\n\r\nSincerely\r\n{adminname}\r\n{adminemail}', 'Dear {vendorname},\r\n\r\nI hope this email finds you well. I am writing to confirm your recent subscription purchase with our company.\r\n\r\nWe are thrilled to have you as a subscriber and we appreciate your trust in us. Your subscription will provide you access to our premium services, exclusive content and special offers throughout the duration of your subscription period.\r\n\r\nHere are the details of your purchase\r\n\r\nSubscription Plans :  {plan_name}\r\nSubscription Duration : {subscription_duration}\r\nSubscription Cost : {subscription_price}\r\nPayment Type : {payment_type}\r\n\r\nYour subscription is now active and you can start enjoying the benefits of our services right away. You can log in to your account using the email address and password you provided during registration.\r\n\r\nIf you have any questions or concerns regarding your subscription, please do not hesitate to contact our customer support team. We are always available to assist you with any queries you may have.\r\n\r\nThank you once again for choosing us as your preferred service provider. We look forward to providing you with the best experience possible.\r\n\r\nSincerely\r\n{adminname}\r\n{adminemail}', 'Dear {adminname},\r\n\r\nYou have received new subscription request from {vendorname} and the email is {vendoremail}\r\n\r\nLogin to your account and check the details. You may Approve OR Reject\r\n\r\nHere are the details\r\n\r\nSubscription Plans : {plan_name}\r\n\r\nSubscription Duration : {subscription_duration}\r\n\r\nSubscription Cost : {subscription_price}\r\n\r\nPayment Type : {payment_type}', 'Dear {adminname},\r\n\r\nI am writing to inform you that a new subscription has been purchased for our service. The details of the subscription are as follows:\r\n\r\nName of Subscriber : {vendorname}\r\nSubscription Plans : {plan_name}\r\nSubscription Duration : {subscription_duration}\r\nSubscription Cost : {subscription_price}\r\nPayment Type : {payment_type}\r\n\r\nThe payment for the subscription has been successfully processed, and the subscriber is now able to access the features of their subscription.\r\n\r\nBest Regards\r\n{vendorname}\r\n{vendoremail}', 'Dear {vendorname},\r\n\r\nThank you for choosing to join our vibrant community! We\'re thrilled to have you on board and want to extend a warm welcome to you.', 'Dear {adminname},\r\n\r\nI am writing to inform you that new vendor registration has been done successfully.\r\n\r\nName : {vendorname}\r\nEmail : {vendoremail}\r\nMobile : {vendormobile}', 'Dear {vendorname},\r\n\r\nWe hope this message finds you well. We regret to inform you that your account has been suspended', 'Dear {vendorname},\r\n\r\nYou have received new inquiry\r\n\r\nFull Name : {username}\r\n\r\nEmail : {useremail}\r\n\r\nMobile : {usermobile}\r\n\r\nMessage : {usermessage}', 'Dear {customername},\n\nWe are pleased to confirm that we have received your Order.\n\nOrder details\n\nOrder number : #{ordernumber}\nOrder Date : {orderdate}\nGrand Total : {grandtotal}\n\nClick Here : {track_order_url}\n\nThank you for choosing.\n\nSincerely,\n{vendorname}', 'Dear {vendorname},\n\nWe are writing to confirm that you have received new Order.\n\nOrder details\n\nOrder number : #{ordernumber}\nOrder Date : {orderdate}\nGrand Total : {grandtotal}\n\nSincerely,\n{customername}', 'Dear {customername},\n\nI am writing to inform you that {status_message}\n\nSincerely\n{vendorname}', 'Dear {referral_user},\n\nYour friend {new_user} has used your referral code to register with {company_name}.\nYou have earned {referral_amount} referral amount in your wallet.\n\nNote : Do not reply to this notification message,this message was auto-generated by the sender\'s security system.\n\nAll Rights Reserved.', '0000-00-00 00:00:00', '2025-04-17 10:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_area`
--

CREATE TABLE `shipping_area` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `area_name` varchar(255) NOT NULL,
  `delivery_charge` double NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1 = yes, 2 = no',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `icon` text NOT NULL,
  `link` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_category`
--

CREATE TABLE `store_category` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes,2=No',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes, 2=No',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `systemaddons`
--

CREATE TABLE `systemaddons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `version` varchar(20) NOT NULL,
  `activated` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemaddons`
--

INSERT INTO `systemaddons` (`id`, `name`, `unique_identifier`, `version`, `activated`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Coupons', 'coupon', '3.9', 1, 'coupons.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(2, 'Language Translation', 'language', '3.9', 1, 'language.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(3, 'Personalised Store Link', 'unique_slug', '3.9', 1, 'unique_slug.jpg', 1, '2025-05-03 11:43:00', '2025-01-31 03:38:14'),
(4, 'Blogs', 'blog', '3.9', 1, 'blog.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(5, 'Whatsapp Message (Manual)', 'whatsapp_message', '3.9', 1, 'whatsapp_message.jpg', 1, '2025-05-03 11:43:00', '2025-01-22 05:13:19'),
(6, 'Sound Notification', 'notification', '3.9', 1, 'notification.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(7, 'Subscription Plans', 'subscription', '3.9', 1, 'subscription.jpg', 1, '2025-05-03 11:43:00', '2025-04-16 23:39:27'),
(8, 'Cookie Consent', 'cookie', '3.9', 1, 'cookie.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(9, 'Fashion Theme', 'theme_1', '3.9', 1, 'fashion_theme.jpg', 1, '2025-05-03 11:43:00', '2024-10-26 11:43:00'),
(10, 'Store Reviews', 'store_reviews', '3.9', 1, 'store_reviews.jpg', 1, '2025-05-03 11:43:00', '2025-04-16 07:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1=Yes,2=No',
  `is_deleted` int(11) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `telegram_message`
--

CREATE TABLE `telegram_message` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `item_message` longtext NOT NULL,
  `telegram_message` longtext NOT NULL,
  `order_created` int(11) NOT NULL,
  `telegram_access_token` text NOT NULL,
  `telegram_chat_id` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `telegram_message`
--

INSERT INTO `telegram_message` (`id`, `vendor_id`, `item_message`, `telegram_message`, `order_created`, `telegram_access_token`, `telegram_chat_id`, `created_at`, `updated_at`) VALUES
(1, 1, '🔵 {item_name}{variantsdata} ({item_price} * {qty}) = {total}', 'Hi, \nI would like to place an order 👇\n\nOrder No: {order_no}\n---------------------------\n{item_variable}\n---------------------------\n👉Subtotal : {sub_total}\n{total_tax}\n👉Delivery charge : {delivery_charge}\n👉Discount : - {discount_amount}\n---------------------------\n📃 Total : {grand_total}\n📃 Tips : {tips}\n---------------------------\n📄 Comment : {notes}\n✅ Customer Info\n---------------------------\nCustomer name : {customer_name}\nCustomer email: {customer_email}\nCustomer phone : {customer_mobile}\n---------------------------\n📍 Billing Details\nAddress : {billing_address}, {billing_landmark}, {billing_postal_code}, {billing_city}, {billing_state}, {billing_country}.\n---------------------------\n📍 Shipping Details\nAddress : {shipping_address}, {shipping_landmark}, {shipping_postal_code}, {shipping_city}, {shipping_state}, {shipping_country}.\n---------------------------\n👉 Payment status : {payment_status}\n💳 Payment type : {payment_type}\n\n{store_name} will confirm your order upon receiving the message.\n\nTrack your order 👇\n{track_order_url}\n\nClick here for next order 👇\n{store_url}\n\nThanks for the Order 🥳', 1, '5500991005:AAE_2nAxls6jkJmVjKoun_IjZd3N6b-NJX0', '756897635', '2025-03-28 06:35:07', '2025-03-28 12:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `star` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `reorder_id`, `vendor_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 14, 1, 'Fashion', 'theme-1.png', '2023-08-14 10:24:27', '2025-01-22 17:11:44'),
(2, 7, 1, 'Jewellery', 'theme-2.png', '2023-08-14 10:34:59', '2025-02-19 15:09:28'),
(3, 15, 1, 'Sneakers', 'theme-3.png', '2023-08-14 10:35:12', '2025-01-22 17:11:44'),
(4, 16, 1, 'Glasses', 'theme-4.png', '2023-08-14 10:35:27', '2025-01-22 17:11:44'),
(5, 8, 1, 'Watches', 'theme-5.png', '2023-08-14 10:35:39', '2025-01-22 17:10:12'),
(9, 17, 1, 'Bags', 'theme-654f2a8391eea.png', '2023-11-11 07:17:23', '2025-01-22 17:11:44'),
(10, 18, 1, 'Cosmetic', 'theme-654f2a8be17c1.png', '2023-11-11 07:17:31', '2025-01-22 17:11:44'),
(11, 12, 1, 'Electronic', 'theme-654f2a93f1edd.png', '2023-11-11 07:17:39', '2025-01-22 17:11:44'),
(12, 1, 1, 'Perfume', 'theme-654f2a9ce1f23.png', '2023-11-11 07:17:48', '2025-02-19 15:09:28'),
(13, 20, 1, 'Lingerie', 'theme-654f2aa58051f.png', '2023-11-11 07:17:57', '2025-01-22 17:11:45'),
(14, 9, 1, 'Pet Shop', 'theme-66226108a3d99.png', '2024-04-19 17:48:16', '2025-01-22 17:10:12'),
(15, 19, 1, 'Furniture', 'theme-662261171d64a.png', '2024-04-19 17:48:31', '2025-01-22 17:11:45'),
(16, 10, 1, 'Kid Shop', 'theme-66226123264fd.png', '2024-04-19 17:48:43', '2025-01-22 17:10:12'),
(17, 11, 1, 'Plantify', 'theme-66226134c8a24.png', '2024-04-19 17:49:00', '2025-01-22 17:11:44'),
(18, 13, 1, 'Kitchen', 'theme-6622614612c89.png', '2024-04-19 17:49:18', '2025-01-22 17:11:44'),
(20, 3, 1, 'Clothing', 'theme-6790cad0dbf28.webp', '2025-01-22 16:09:12', '2025-02-19 15:09:28'),
(21, 2, 1, 'HandyArt', 'theme-6790cade9d180.webp', '2025-01-22 16:09:26', '2025-02-19 15:09:28'),
(22, 4, 1, 'Gifty', 'theme-6790cae9be3b6.webp', '2025-01-22 16:09:37', '2025-02-19 15:09:28'),
(23, 5, 1, 'Supermarket', 'theme-6790caf8ca245.webp', '2025-01-22 16:09:52', '2025-02-19 15:09:28'),
(24, 6, 1, 'Flower', 'theme-6790cb152b8ae.webp', '2025-01-22 16:10:21', '2025-02-19 15:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `top_deals`
--

CREATE TABLE `top_deals` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `offer_type` int(11) NOT NULL,
  `deal_type` int(11) NOT NULL COMMENT '1=one time,2=daily',
  `top_deals_switch` int(11) NOT NULL DEFAULT 2 COMMENT '1=yes,2=no',
  `offer_amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_number` varchar(255) DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL COMMENT '1 = added-money-wallet, 2 = order placed (using wallet), 3 = order cancel ,',
  `transaction_number` varchar(255) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL COMMENT '1=offline,3=RazorPay,4=''Stripe'',5=''Flutterwave'',6=''PayStack''',
  `payment_id` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `tips` float NOT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `tax_name` varchar(255) DEFAULT NULL,
  `grand_total` float NOT NULL,
  `offer_code` varchar(255) DEFAULT NULL,
  `offer_amount` float DEFAULT NULL,
  `duration` varchar(255) NOT NULL COMMENT '1=1 Month,\r\n2=3Month\r\n3=6 Month\r\n4=1 Year',
  `days` int(11) DEFAULT NULL,
  `purchase_date` varchar(255) NOT NULL,
  `service_limit` varchar(255) NOT NULL,
  `appoinment_limit` varchar(255) NOT NULL,
  `themes_id` varchar(255) DEFAULT NULL,
  `expire_date` varchar(255) NOT NULL,
  `screenshot` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 = pending, 2 = yes/BankTransferAccepted,3=no/BankTransferDeclined',
  `custom_domain` int(11) DEFAULT 2 COMMENT '1=yes,2=no',
  `google_analytics` int(11) NOT NULL,
  `pos` int(11) NOT NULL COMMENT '1 = yes , 2 = no',
  `vendor_app` int(11) NOT NULL COMMENT '1 = yes , 2 = no',
  `coupons` int(11) DEFAULT NULL,
  `blogs` int(11) DEFAULT NULL,
  `social_logins` int(11) DEFAULT NULL,
  `sound_notification` int(11) DEFAULT NULL,
  `whatsapp_message` int(11) DEFAULT NULL,
  `telegram_message` int(11) DEFAULT NULL,
  `role_management` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `customer_app` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `pwa` int(11) DEFAULT NULL COMMENT '1=yes,2=no',
  `features` varchar(255) DEFAULT NULL,
  `pixel` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_type` varchar(255) NOT NULL,
  `google_id` text DEFAULT NULL,
  `facebook_id` text DEFAULT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=Admin,2=vendor,3=User/customer,4=Employee',
  `description` text DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `plan_id` varchar(255) DEFAULT NULL,
  `purchase_amount` varchar(255) DEFAULT NULL,
  `purchase_date` varchar(255) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL COMMENT '1=COD,2=Wallet,3=Razorpay,4=stripe,5=Flutterwave,6=paystack',
  `referral_code` varchar(255) DEFAULT NULL,
  `wallet` varchar(255) DEFAULT '0',
  `otp` varchar(255) DEFAULT NULL,
  `available_on_landing` int(11) DEFAULT NULL COMMENT '1=Yes,2=No',
  `allow_without_subscription` int(11) NOT NULL COMMENT '1=Yes,2=No',
  `is_verified` tinyint(1) NOT NULL COMMENT '1=Yes,2=No',
  `is_available` tinyint(4) NOT NULL COMMENT '1=Yes,2=No	',
  `is_deleted` int(11) NOT NULL DEFAULT 2,
  `username` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `license_key` text DEFAULT NULL,
  `hostdomain` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `license_type` text DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `store_id`, `name`, `slug`, `email`, `mobile`, `image`, `password`, `login_type`, `google_id`, `facebook_id`, `type`, `description`, `token`, `payment_id`, `plan_id`, `purchase_amount`, `purchase_date`, `payment_type`, `referral_code`, `wallet`, `otp`, `available_on_landing`, `allow_without_subscription`, `is_verified`, `is_available`, `is_deleted`, `username`, `country_id`, `city_id`, `license_key`, `hostdomain`, `remember_token`, `license_type`, `vendor_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin', 'admin@gmail.com', '9016996697', 'profile-6606981f16695.png', '$2y$10$axQ2h3UiuHgvZ4cTs8QWz.xwzcAdRlXqEA./hLFCbea5oAa69njoq', 'normal', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0', NULL, NULL, 0, 1, 1, 2, NULL, 0, 0, NULL, NULL, '30xnMF9NlS6nBKItCY7wzOPxSFzkoila2MOS3eB4MKmWQYv9RmZysVKxmFbp', NULL, NULL, NULL, NULL, '2025-01-10 03:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `original_price` double NOT NULL DEFAULT 0,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `min_order` int(11) DEFAULT NULL,
  `max_order` int(11) DEFAULT NULL,
  `low_qty` int(11) DEFAULT NULL,
  `stock_management` int(11) DEFAULT NULL,
  `is_available` int(11) NOT NULL COMMENT '1=yes,2=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_message`
--

CREATE TABLE `whatsapp_message` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `item_message` longtext NOT NULL,
  `order_whatsapp_message` longtext DEFAULT NULL,
  `order_status_message` longtext DEFAULT NULL,
  `whatsapp_number` varchar(255) NOT NULL,
  `whatsapp_phone_number_id` varchar(255) NOT NULL,
  `whatsapp_access_token` longtext NOT NULL,
  `whatsapp_chat_on_off` int(11) NOT NULL,
  `whatsapp_mobile_view_on_off` int(11) NOT NULL,
  `whatsapp_chat_position` int(11) NOT NULL DEFAULT 1 COMMENT '1=left, 2=right',
  `order_created` int(11) NOT NULL COMMENT '1 = Yes , 2 = No',
  `status_change` int(11) NOT NULL COMMENT '1 = Yes , 2 = No',
  `message_type` int(11) NOT NULL COMMENT '1 = automatic_using_api , 2 = manually	',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whatsapp_message`
--

INSERT INTO `whatsapp_message` (`id`, `vendor_id`, `item_message`, `order_whatsapp_message`, `order_status_message`, `whatsapp_number`, `whatsapp_phone_number_id`, `whatsapp_access_token`, `whatsapp_chat_on_off`, `whatsapp_mobile_view_on_off`, `whatsapp_chat_position`, `order_created`, `status_change`, `message_type`, `created_at`, `updated_at`) VALUES
(1, 1, '🔵 {item_name}{variantsdata} ({item_price} * {qty}) = {total}', 'Hi, \nI would like to place an order 👇\n\nOrder No: {order_no}\n---------------------------\n{item_variable}\n---------------------------\n👉Subtotal : {sub_total}\n{total_tax}\n👉Delivery charge : {delivery_charge}\n👉Discount : - {discount_amount}\n---------------------------\n📃 Total : {grand_total}\n📃 Tips : {tips} \n---------------------------\n📄 Comment : {notes}\n✅ Customer Info\n---------------------------\nCustomer name : {customer_name}\nCustomer email: {customer_email}\nCustomer phone : {customer_mobile}\n---------------------------\n📍 Billing Details\nAddress : {billing_address}, {billing_landmark}, {billing_postal_code}, {billing_city}, {billing_state}, {billing_country}.\n---------------------------\n📍 Shipping Details\nAddress : {shipping_address}, {shipping_landmark}, {shipping_postal_code}, {shipping_city}, {shipping_state}, {shipping_country}.\n---------------------------\n👉 Payment status : {payment_status}\n💳 Payment type : {payment_type}\n\n{store_name} will confirm your order upon receiving the message.\n\nTrack your order 👇\n{track_order_url}\n\nClick here for next order 👇\n{store_url}\n\nThanks for the Order 🥳', '🛍️ Order Status Update 📦\r\n\r\nHello {customer_name},\r\n\r\nWe\'re excited to share the latest status of your order with us. Here are the details:\r\n\r\n📝 Order Number: #{order_no}\r\n\r\n📦 **Order Status**: {status}\r\n\r\n📌 **Tracking Information**:\r\n   - You can track your order with the tracking number: #{order_no}.\r\n   - Tracking Link: {track_order_url}\r\n\r\nIf you have any questions or need assistance, feel free to reply to this message.\r\n\r\nWe appreciate your business and hope you enjoy your purchase.\r\n\r\nBest regards', '919016996697', '109087992245712', 'EAAVIMtjwDLUBO0GDmKiv9ZA7sc6VCjIQoZCqT1a5rZCj3orHVrJImr9YncYAQkV3S96V0ZCfuS4qXbN9Kt6ZB6Od0ZAKZAMxRZAYxcY0vulRc77kCKAoOaZCjKCsZAp0ZAuVRKbaFWomvbTdUgdZBGrPFYzjquH0V9kibR8KLA8ZArjnESZCjYurRBeGNnO9pIIdR3ZCeyvEnOETZAfhGm5dOnb7DI8c3ZCZCbWJYiJKrDzfXyISZAAxfAZD', 1, 1, 1, 1, 1, 2, '2025-04-24 10:18:37', '2025-04-17 10:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `whoweare`
--

CREATE TABLE `whoweare` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `reorder_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `age_verification`
--
ALTER TABLE `age_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customdomains`
--
ALTER TABLE `customdomains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_status`
--
ALTER TABLE `custom_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `firebase`
--
ALTER TABLE `firebase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footerfeatures`
--
ALTER TABLE `footerfeatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fun_fact`
--
ALTER TABLE `fun_fact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_extras`
--
ALTER TABLE `global_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `howitworks`
--
ALTER TABLE `howitworks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_settings`
--
ALTER TABLE `landing_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_settings`
--
ALTER TABLE `other_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pixcel_settings`
--
ALTER TABLE `pixcel_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotionalbanner`
--
ALTER TABLE `promotionalbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_manager`
--
ALTER TABLE `role_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_area`
--
ALTER TABLE `shipping_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_category`
--
ALTER TABLE `store_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemaddons`
--
ALTER TABLE `systemaddons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telegram_message`
--
ALTER TABLE `telegram_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_deals`
--
ALTER TABLE `top_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsapp_message`
--
ALTER TABLE `whatsapp_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whoweare`
--
ALTER TABLE `whoweare`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `age_verification`
--
ALTER TABLE `age_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customdomains`
--
ALTER TABLE `customdomains`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_status`
--
ALTER TABLE `custom_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `firebase`
--
ALTER TABLE `firebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footerfeatures`
--
ALTER TABLE `footerfeatures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fun_fact`
--
ALTER TABLE `fun_fact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `global_extras`
--
ALTER TABLE `global_extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `howitworks`
--
ALTER TABLE `howitworks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_settings`
--
ALTER TABLE `landing_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other_settings`
--
ALTER TABLE `other_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pixcel_settings`
--
ALTER TABLE `pixcel_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotionalbanner`
--
ALTER TABLE `promotionalbanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_manager`
--
ALTER TABLE `role_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipping_area`
--
ALTER TABLE `shipping_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_category`
--
ALTER TABLE `store_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemaddons`
--
ALTER TABLE `systemaddons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telegram_message`
--
ALTER TABLE `telegram_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `top_deals`
--
ALTER TABLE `top_deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `whatsapp_message`
--
ALTER TABLE `whatsapp_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `whoweare`
--
ALTER TABLE `whoweare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
