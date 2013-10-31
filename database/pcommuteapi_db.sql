-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2013 at 08:42 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pcommuteapi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_ip_whitelists`
--

CREATE TABLE IF NOT EXISTS `api_ip_whitelists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `api_ip_whitelists`
--

INSERT INTO `api_ip_whitelists` (`id`, `ip_address`, `active`, `date_created`) VALUES
(2, '119.92.172.141', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, '23371985f509c0b9cfc3b56289daf0dc43a2f240', 0, 0, 0, NULL, '0000-00-00 00:00:00'),
(2, '5dde5a8f99a22acb1c661d8e1ec7fa9648fc4d4d', 1, 1, 0, NULL, '0000-00-00 00:00:00'),
(4, 'jnplonte', 1, 1, 0, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `api_logins`
--

CREATE TABLE IF NOT EXISTS `api_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `api_logins`
--

INSERT INTO `api_logins` (`id`, `username`, `password`, `active`, `date_created`) VALUES
(1, 'test', 'test', 1, '0000-00-00 00:00:00'),
(3, 'jnpl', 'onte', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `api_logs`
--

CREATE TABLE IF NOT EXISTS `api_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `authorized` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=495 ;

--
-- Dumping data for table `api_logs`
--

INSERT INTO `api_logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `authorized`) VALUES
(485, 'api/direction/view_direction/id/12', 'get', '{"id":"12"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(486, 'api/social/process_like', 'post', '{"id":"22"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(487, 'api/direction/view_direction/id/12', 'get', '{"id":"12"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(488, 'api/direction/view_direction/id/12/format/html', 'get', '{"id":"12","format":"html"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(489, 'api/direction/view_direction/id/12/format/xml', 'get', '{"id":"12","format":"xml"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(490, 'api/direction/view_direction/id/12/format/table', 'get', '{"id":"12","format":"table"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(491, 'api/direction/view_direction/id/12/format/csv', 'get', '{"id":"12","format":"csv"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(492, 'api/direction/view_direction/id/12', 'get', '{"id":"12"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(493, 'api/direction/view_direction/id/12', 'get', '{"id":"12"}', 'jnplonte', '127.0.0.1', '0000-00-00 00:00:00', 1),
(494, 'api/direction/view_direction/id/16', 'get', '{"id":"16"}', 'jnplonte', '127.0.0.1', '2013-10-30 08:40:22', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
