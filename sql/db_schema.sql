CREATE DATABASE  IF NOT EXISTS `imagemanager`;
USE `imagemanager`;

--Table structure for table `im_images`

DROP TABLE IF EXISTS `im_images`;

CREATE TABLE `im_images` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_title` varchar(45) NOT NULL,
  `i_name` varchar(45) NOT NULL,
  `i_u_id` int(11) NOT NULL,
  `i_datetime` datetime NOT NULL,
  PRIMARY KEY (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Table structure for table `im_users`
DROP TABLE IF EXISTS `im_users`;

CREATE TABLE `im_users` (
  `u_id` bigint(20) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_password` varchar(45) NOT NULL,
  `u_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `u_is_active` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `userId_UNIQUE` (`u_id`),
  UNIQUE KEY `u_email_UNIQUE` (`u_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

