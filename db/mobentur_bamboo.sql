-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2016 at 12:55 AM
-- Server version: 5.6.34
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobentur_bamboo`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `zipcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `social_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'FACEBOOK',
  `age` int(11) DEFAULT NULL,
  `profile_picture` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `otp` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1234',
  `otp_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `email_verification_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `vehicle_type` enum('TAXI','AIRPORT','CRANE','TRANSPORTATION','AMBULANCE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'TAXI',
  `terms_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `unique_code_verification` int(11) DEFAULT NULL,
  `car_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_model` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_year` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_color` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `plate_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_province` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `passanger_capacity` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `roof_rack` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `registration_paper` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `owner_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `authorization_paper` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_identity_proof` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_front_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_back_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `car_inside_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_country` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_province` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `driver_district` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `full_address` text COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` enum('CASH','CC','WALLET') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CASH',
  `driver_verification_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `registration_datetime` datetime NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `password_reset_token` (`password_reset_token`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `fname`, `lname`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `zipcode`, `phone_number`, `social_id`, `social_type`, `age`, `profile_picture`, `otp`, `otp_status`, `email_verification_status`, `vehicle_type`, `terms_status`, `unique_code_verification`, `car_type`, `car_model`, `car_year`, `car_color`, `plate_number`, `car_province`, `car_category`, `passanger_capacity`, `roof_rack`, `registration_paper`, `owner_status`, `authorization_paper`, `driver_identity_proof`, `car_front_image`, `car_back_image`, `car_inside_image`, `driver_country`, `driver_province`, `driver_district`, `full_address`, `payment_method`, `driver_verification_status`, `registration_datetime`, `created_at`, `updated_at`) VALUES
(1, 'Ashish', 'Rawat', 'ashish@gmaill.com', '1kkRCJhqEOwN1k8mlLZdQbpKe2DM225R', '$2y$13$K9iojfu0J7wdjtcBgUMMjurE89naHeXwH2cHPlP1eeoBKb72rkffi', '', '12345', '12345678900', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', '', 'NO', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NO', '2016-11-23 14:56:24', 1479893184, 1479893184),
(2, 'Arpit', 'Tripathi', 'arpit@techugo.com', 'olQIoXxZ314eI_swAigRcW_IuBFZQ_yL', '$2y$13$i9Ewbioz5suukWqJTkTs8er0YQ56GxR39xwFFz2M1sET9l15XrDX2', '', '201301', '8699267194', '123456789', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', '', 'NO', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'NO', '2016-11-23 18:38:55', 1479906535, 1479906535),
(3, 'dads', 'asdasd', 'dssa@123.com', 'tE3ftTo1vz48_rHZ0EOfWRhJ6tK_JXWF', '$2y$13$h4JVxL81nh7Vv64V7FtRFeDXPWW43b6b0NOQy/JjRpmJqSo50b9fe', '', ' 91', '5874582546', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 17:53:38', 1479990218, 1479990218),
(4, 'wdasAS', 'ASDASD', 'ASDFD@SFDSF.COM', 'W03MX9OWg2PIwwT6r83CwYxmbdGVbvY9', '$2y$13$c3/IJZpuEydHUtvXObWElu0jdI3.TjTLDoUxcM7jVjBUlE6nYunL.', '', ' 91', '5874125478', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 18:00:22', 1479990622, 1479990622),
(5, 'abc', 'cba', 'abc@gmail.com', 'kLfVbEmTnPEPvEAKiKoW10MzFrXOpV-T', '$2y$13$I5CPGgoIphZvwZPknrV3/eCBqvJM/28aatV.IpUB.ryOH2PWQbiV.', '', '+91', '9602964864', '', 'FACEBOOK', NULL, '', '8446', 'YES', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:00:21', 1479994221, 1479994221),
(6, 'preeti', 'singh', 'preeti@techugo.com', 'xNoCPopLPkILqc_m5AzmjqPdnr6ARvno', '$2y$13$sd.dxbqro6JNsdQ2Qas10uuhvkXGP9bxQsJh20SIVzxeY1YtqtXOi', '', ' 91', '99105556667', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:02:38', 1479994358, 1479994358),
(7, 'preeti', 'singh', 'preeti@techugo.com', 'IBn5lzvlvjLDLXqvQFZkjKf4L08GUy0m', '$2y$13$XQq6TBJ/AphPGclhRF1GoeQLb3fs2hrm7c7GueUw2blhQcvvOMpza', '', ' 91', '99105556667', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:02:38', 1479994358, 1479994358),
(8, 'preeti', 'singh', 'preeti@techugo.com', '6WAsSmafvv1AI79sqUrsVcxPtFk2TmAG', '$2y$13$bbqTXWsCwxVs1mdFNdiDaupAHJrK1x6T4aOnlVJfiP6ysOHVwCaMS', '', ' 91', '99105556667', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:02:39', 1479994359, 1479994359),
(9, 'preeti', 'singh', 'preeti@techugo.com', 'mpWXJOS-QG48R8b-xlDoUJPBs9-Ae4PY', '$2y$13$RQYk9Xi199dP4cDAg5lV9.HOCjJgIFuVLnvXxyR4kXtN6tgphFC4y', '', ' 91', '99105556667', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:02:39', 1479994359, 1479994359),
(10, 'preeti', 'singh', 'preeti1@techugo.com', '5215CbJh3MXkgIJb2ttntzJp9fDMNOZb', '$2y$13$nSjesQXzSbZVHjNLi/07NeOJb9bK8/OapPYbZi4FIIcj2ARJHetV6', '', ' 91', '67788855666', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:10:24', 1479994824, 1479994824),
(11, 'asked my', 'kink', 'ghjhvdjah@abc.com', 'esvIxtKhM_LmSBPvpmcaCs7RKfyijcYK', '$2y$13$vOvtMHOVJU/hX3cBVp5wfOXaghoVg2DGT8Aj6R9rHSTvcpN9d/Oc6', '', ' 91', '5874157489', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:11:47', 1479994907, 1479994907),
(12, 'sdfsafasfsa', 'dsfsdf', 'sdfs@sdfsdf.com', 'jciCNB24NlUniATbtBc4xQQmYB6ZCVxL', '$2y$13$hAiqEz716rzXUK88FQr25.4h9BzsIydQPFelAXJMDxIzDSp8vTlTy', '', ' 91', '58741254788', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:18:20', 1479995300, 1479995300),
(13, 'Rupesh', 'Kumar', 'Rupesh@ty.com', 'RjyTZbLAaENXWzDyGMqvzF3JCWN0hwkN', '$2y$13$qSLk21EBufVQk8kMJMKG.OTA5KqPkrg/tHuuJ0bOcieB120TEsZVK', '', '+91', '5869586958', '', 'FACEBOOK', NULL, '', '1234', 'NO', 'NO', 'TAXI', 'NO', NULL, '', '', '', '', '', '', '', '', 'NO', '', 'NO', '', '', '', '', '', '', '', '', '', 'CASH', 'NO', '2016-11-24 19:58:46', 1479997726, 1479997726);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `pkEmailID` int(11) NOT NULL AUTO_INCREMENT,
  `emailTitle` varchar(225) NOT NULL,
  `emailFromName` varchar(225) NOT NULL,
  `emailFromEmail` varchar(100) NOT NULL,
  `emailSubject` varchar(225) NOT NULL,
  `emailContent` text NOT NULL,
  `emailDateAdded` datetime NOT NULL,
  `emailDateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pkEmailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`pkEmailID`, `emailTitle`, `emailFromName`, `emailFromEmail`, `emailSubject`, `emailContent`, `emailDateAdded`, `emailDateUpdated`) VALUES
(1, 'One Time Password', 'Bamboo', 'ashishtechugo@gmail.com', 'One Time Password', '<p>\\r\\n	Your one time password is: {one_time_password}<br />\\r\\n	<br />\\r\\n	Regards</p>\\r\\n''', '2016-09-26 00:00:00', '2016-11-18 10:36:36'),
(2, 'Reset Password Link', 'Bamboo', 'ashishtechugo@gmail.com', 'Password Change Request || Bamboo', '<p>Dear {to_email},</p><p>We received a&nbsp;request to&nbsp;reset the&nbsp;password associated with this email address.</p><p><strong>If you made this request please click on below link to reset your password:</strong><br /><a href="{password_reset_link}" target="_blank">{password_reset_link}</a></p><p><br />Regards,<br />Tixilo</p>''', '2016-09-27 00:00:00', '2016-11-22 09:33:15'),
(3, 'Email-Id verification email', 'Bamboo', 'ashishtechugo@gmail.com', 'Email-Id verification || Bamboo', '<p>Dear {to_email},</p><p>We received a&nbsp;request to&nbsp;register you &nbsp;associated with this email address.</p><p><strong>If you made this request please click on below link to activate your account:</strong><br /><a href="{email_verification_link}" target="_blank">{email_verification_link}</a></p><p><br />Regards,<br />Bamboo</p>''', '2016-11-18 00:00:00', '2016-11-18 11:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1479298198),
('m130524_201442_init', 1479298201);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otp_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `email_verification_status` enum('YES','NO') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `fname`, `lname`, `social_id`, `zipcode`, `phone_number`, `otp`, `otp_status`, `email_verification_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ashish', 'DE3sy_WUow5pppmo0qQEUiMUw1NZk7Kc', '$2y$13$uenqCqfDhhqz7Z.OaJVJhuURWiY5zBEa7C9ykMCETveWIwzRk8d3K', '_lFV4f40d_1mjlI9rSjV1ItUe6IWQHhV_1479723095', 'ashishtechugo@gmail.com', '', '', '1234567', '', '1234567890', '1234', 'YES', 'NO', 10, 1479298930, 1479989912),
(3, '', 'BCOyUIjl3syiDweKoqHbrvBjWy_GI9lm', '$2y$13$EYpJexFXRWNJ.AH6Roeg9ev9r5VfAzmLzAQiiWAOnwaXhwrgOto3K', '123456', 'ashish@techugo.com', 'ashish', 'rawat', '', '12345', '12345678900', '1234', 'YES', 'NO', 10, 1479895867, 1479996227);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
