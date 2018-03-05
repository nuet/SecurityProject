-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2018 at 08:18 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasesecurity`
--
CREATE DATABASE IF NOT EXISTS `databasesecurity` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `databasesecurity`;

-- --------------------------------------------------------

--
-- Table structure for table `password_info`
--

CREATE TABLE IF NOT EXISTS `password_info` (
  `p_no` smallint(6) NOT NULL,
  `password` varbinary(40) NOT NULL,
  `salt` varbinary(48) NOT NULL,
  PRIMARY KEY (`p_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_info`
--

INSERT INTO `password_info` (`p_no`, `password`, `salt`) VALUES
(8, 0x38393564373532326631636266306533383863346637373762386331623437313533663836623536, 0x6084cf7b5603517ffa4caf7b8551f10f612e8af530a86a8c01ed897d5d034a85c2e592ea624a91738a60cab43e862b8c),
(21, 0x33663934346561666539353662313861366335623933343262653637313832386266376138666239, 0xab2ad8d6edd7ff475a2efa06eccf2db44b49f4d3eb853d1261a672ab5dc2969f98349ddfd6d88a78f9a29913de6eaa28),
(23, 0x31323734656266646433353366363865656335343965323836393762326563373431306466616634, 0x184c21ff411dba13bff3c163e8166074c575df55098fb1b16d7a45a4db21388d1a4f46d35d61dc587f88ccb2b950e36b);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `u_no` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varbinary(50) NOT NULL,
  `parent_name` varbinary(50) NOT NULL,
  `last_name` varbinary(50) NOT NULL,
  `email` varbinary(100) NOT NULL,
  `birthday` varbinary(28) NOT NULL,
  `id` varbinary(20) NOT NULL,
  `social_security_no` varbinary(25) NOT NULL,
  `priv` tinyint(2) NOT NULL,
  PRIMARY KEY (`u_no`),
  UNIQUE KEY `u_id` (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `u_ssn` (`social_security_no`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`u_no`, `first_name`, `parent_name`, `last_name`, `email`, `birthday`, `id`, `social_security_no`, `priv`) VALUES
(8, 0xa2c68780a2c6f5f65d045d6b025243990a7ba81f69c5ab50194b7d1d418de93e96303fad9afdeda56823f1438ed46766, 0x29d772ac804dc67be51525f81dded16291728d09c1ae06921c8fb7216b97421442839ed4832ca5c806265aba26eee954, 0x93c4b387abe34e55077506daa8c868f299ee27ad6600d746e6057d94d9f51e755d2f3bdbe6c8e98ad378983fa4adcf31, 0x95983a5137531ec612dbe4dffa219dbdc2e592ea624a91738a60cab43e862b8c, 0x2b1f4ef8f01bf775f9e1ba5d21ea0f6b, 0x39536956c7876676652459ff707cda92, 0x46d66f31bb18ecc744a2513c50ecac9c, 1),
(11, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xd33ae74e07fa025d6fefb0d1c372bdd5, 0x2b1f4ef8f01bf775f9e1ba5d21ea0f6b, 0x983d9befa79ce4f7e6ef3305b3ff57bf, 0xcf6a170c13e4c887c7bc8e5532538673, 1),
(12, 0xbd02848c2d3d475f3e99b0d895a8c60a2616dc5379ea9ea47876b089099cc38c, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xb1281895c71602a8b9989487d3a875b5, 0x2b1f4ef8f01bf775f9e1ba5d21ea0f6b, 0xc9fc37eae8349d424710ec07915f9d2b, 0xd91b9991bf8c1e970671751b4d36eda4, 1),
(13, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0xbd02848c2d3d475f3e99b0d895a8c60a1ea85da6ba90a58b478b17344eb40646b77dfa6d3c5cd4c4338ab99b92f76e2b, 0x2ff192d6dfc0b9dcf68c16af980290b6af1cba9e7dcf50ace9c9347d20c73557140a7b7c80365ee852f7797863e64f0e4eb2f1a02be3ac84df3b101fe9f1a557, 0x2b1f4ef8f01bf775f9e1ba5d21ea0f6b, 0xe6992f808ac86cb87847b70d154711fe, 0x9a47a1d8de90ced04c0c90882b1aea7e, 1),
(20, 0x03ea5fd7f0d34ec489087d5bb46421c9, 0x844eaef39964ba1ca67e6b657fd1df5f, 0x2113119c7c413112cfc1c44e33a8b829593d88b3d11f9691982c4bb7f429e1f8, 0x64d61abb1c459d19d8dfdd7954b0f9a4, 0xce6063416c6f0d238da4b17d0e85c407, 0x83a943028eb2c68769f00086ac127a69, 0x54cb5a3e9949cc0f586aaf911629af57, 2),
(21, 0x6724568ab168c68f872ed3de24704dac, 0x54ed0099640bae8a91ae52eae05c40e8, 0x9980ffa51153fb4abc95d0254a708557569516ee8eb504bf90f8c4dbd87a4f31, 0xd27be9eb7914a233b82024d0216121d4, 0xc54dda6bcd143c12fd2a18c219cb3b3b, 0xd304ff7a8fd686b9fbe7e1a2a09bafbf, 0x35ea40fd6b33dccc2d71996c211fbe40, 2),
(22, 0xdf3bfce9dec95c95d7161db9ff9c38af, 0x18df8af6ec77577f9093ab933419df11, 0x695a96786e8ff77d8c3050d72989e0a2, 0xc72dc5c07ee9ffacde1e687f8e299f43, 0x26d5ea830fd324b0041d664254d04d30, 0xf76d4dae338c51b4cd1bae84b530cb15, 0xe986ad6d9aa5c0b5db217ef2d866a560, 2),
(23, 0xb4c6cc3239322a3597d45e3544c3232c, 0xf2451e07df28386c3720b1366d765c1b, 0xb61769b2cd6e712a2c14479af31d1855, 0x4073c45674603b1559556ff8bae833ec, 0xa6d799334e8cd7a0ae74440bc0bbcd1e, 0xf337c19b0b8e9e5569b9c4d496276103, 0x7c1a2671ec0c9e5a9ff9e65f04d5ba6c, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_info`
--
ALTER TABLE `password_info`
  ADD CONSTRAINT `no` FOREIGN KEY (`p_no`) REFERENCES `user_info` (`u_no`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;