-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2015 at 11:51 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `examples`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
`id_announcement` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `announcement` varchar(255) NOT NULL,
  `type` enum('danger','info','warning','success') NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id_announcement`, `title`, `announcement`, `type`, `status`) VALUES
(1, 'I am a warning callout!', 'This is a yellow callout.', 'success', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `groups_header`
--

CREATE TABLE IF NOT EXISTS `groups_header` (
  `id_header_menu` int(11) NOT NULL,
  `id_groups` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_header`
--

INSERT INTO `groups_header` (`id_header_menu`, `id_groups`) VALUES
(0, 1),
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE IF NOT EXISTS `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 83),
(2, 83),
(1, 84),
(2, 84),
(1, 85),
(1, 86),
(2, 86),
(1, 91),
(2, 91),
(1, 90),
(2, 90),
(1, 87),
(2, 87),
(1, 88),
(2, 88),
(1, 89),
(2, 89),
(1, 92),
(1, 94),
(1, 96),
(2, 93),
(1, 93),
(1, 97);

-- --------------------------------------------------------

--
-- Table structure for table `header_menu`
--

CREATE TABLE IF NOT EXISTS `header_menu` (
`id_header_menu` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `header` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_menu`
--

INSERT INTO `header_menu` (`id_header_menu`, `order`, `header`) VALUES
(1, 1, 'MAIN NAVIGATION');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `id_header_menu` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `menu_id` varchar(150) NOT NULL,
  `level_one` int(11) NOT NULL DEFAULT '0',
  `level_two` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `order`, `id_header_menu`, `label`, `icon`, `url`, `menu_id`, `level_one`, `level_two`) VALUES
(83, 1, 1, 'Dashboard', 'dashboard', 'crud/index', '', 0, 0),
(84, 2, 1, 'Grocery', 'table', '#', '', 0, 0),
(85, 3, 1, 'Ion Auth', 'lock', '#', '', 0, 0),
(86, 1, 1, 'Offices', 'circle-o', 'examples/offices_management', '', 84, 0),
(87, 2, 1, 'Employees', 'circle-o', 'examples/employees_management', '', 84, 0),
(88, 3, 1, 'Customers', 'circle-o', 'examples/customers_management', '', 84, 0),
(89, 4, 1, 'Orders', 'circle-o', 'examples/orders_management', '', 84, 0),
(90, 5, 1, 'Products', 'circle-o', 'examples/products_management', '', 84, 0),
(91, 6, 1, 'Films', 'circle-o', 'examples/film_management', '', 84, 0),
(92, 5, 1, 'Menu Management', 'bars', 'crud/header_menu', 'menu-menu', 0, 0),
(93, 6, 1, 'Settings', 'gears', 'crud/settings', '', 0, 0),
(94, 1, 1, 'Users', 'circle-o', 'crud/users', '', 85, 0),
(96, 3, 1, 'Groups', 'circle-o', 'crud/groups', '', 85, 0),
(97, 7, 1, 'Announcement', 'bullhorn', 'crud/announcement', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id_settings` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `logo` varchar(150) NOT NULL,
  `skin` enum('skin-blue','skin-black','skin-purple','skin-green','skin-red','skin-yellow','skin-blue-light','skin-black-light','skin-purple-light','skin-green-light','skin-red-light','skin-yellow-light') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_settings`, `judul`, `nama_perusahaan`, `alamat`, `logo`, `skin`) VALUES
(1, 'MyIgniter 3.1', 'Kotaxdev', 'Jember', 'b62b7-kotaxdev_large.png', 'skin-red');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'admin', '$2y$08$v.Lr4yujxQxzZNdmCpgJWu7WLR5hzFDxkh0mRRmSuBartWDE93ySO', '', 'admin@admin.com', NULL, 'asGsHoh0iWTpOuVLM.EMUO900526bdd0557906ac', 1421981304, NULL, 1268889823, 1435463115, 1, 'Admin', 'istrator', 'ADMIN', '1234567890');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(5, 1, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_header_menu`
--
CREATE TABLE IF NOT EXISTS `view_header_menu` (
`id_groups` int(11)
,`id_header_menu` int(11)
,`header` varchar(50)
,`order` int(11)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `view_menu`
--
CREATE TABLE IF NOT EXISTS `view_menu` (
`id_groups` int(11)
,`id_menu` int(11)
,`order` int(11)
,`id_header_menu` int(11)
,`label` varchar(50)
,`icon` varchar(50)
,`url` varchar(150)
,`menu_id` varchar(150)
,`level_one` int(11)
,`level_two` int(11)
);
-- --------------------------------------------------------

--
-- Structure for view `view_header_menu`
--
DROP TABLE IF EXISTS `view_header_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_header_menu` AS select `gh`.`id_groups` AS `id_groups`,`hm`.`id_header_menu` AS `id_header_menu`,`hm`.`header` AS `header`,`hm`.`order` AS `order` from (`groups_header` `gh` join `header_menu` `hm` on((`gh`.`id_header_menu` = `hm`.`id_header_menu`)));

-- --------------------------------------------------------

--
-- Structure for view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu` AS select `gm`.`id_groups` AS `id_groups`,`m`.`id_menu` AS `id_menu`,`m`.`order` AS `order`,`m`.`id_header_menu` AS `id_header_menu`,`m`.`label` AS `label`,`m`.`icon` AS `icon`,`m`.`url` AS `url`,`m`.`menu_id` AS `menu_id`,`m`.`level_one` AS `level_one`,`m`.`level_two` AS `level_two` from (`groups_menu` `gm` join `menu` `m` on((`gm`.`id_menu` = `m`.`id_menu`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
 ADD PRIMARY KEY (`id_announcement`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header_menu`
--
ALTER TABLE `header_menu`
 ADD PRIMARY KEY (`id_header_menu`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id_settings`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
MODIFY `id_announcement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `header_menu`
--
ALTER TABLE `header_menu`
MODIFY `id_header_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id_settings` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
