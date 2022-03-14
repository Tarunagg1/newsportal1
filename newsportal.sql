-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2022 at 03:22 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `attempt_limit`
--

DROP TABLE IF EXISTS `attempt_limit`;
CREATE TABLE IF NOT EXISTS `attempt_limit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `postlike`
--

DROP TABLE IF EXISTS `postlike`;
CREATE TABLE IF NOT EXISTS `postlike` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` varchar(210) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `ratingaction` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `postid` (`postid`,`useremail`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postlike`
--

INSERT INTO `postlike` (`id`, `postid`, `useremail`, `ratingaction`, `date`) VALUES
(87, '28', 'tarun@gmail.com', 'dislike', '2022-01-11 16:03:35'),
(71, '27', 'tarun@gmail.com', 'dislike', '2020-05-14 03:21:32'),
(73, '26', 'tarun@gmail.com', 'like', '2020-05-14 03:23:01'),
(76, '29', 'tarun@gmail.com', 'like', '2020-05-16 05:12:44'),
(77, '25', 'tarun@gmail.com', 'like', '2020-05-16 11:05:48'),
(78, '24', 'tarun@gmail.com', 'like', '2020-05-16 11:05:51'),
(82, '12', 'tarun@gmail.com', 'dislike', '2020-06-15 04:27:45'),
(84, '10', 'tarun@gmail.com', 'like', '2020-06-15 05:03:19'),
(85, '11', 'tarun@gmail.com', 'dislike', '2020-06-22 03:43:38'),
(86, '28', 'kushal@gmail.com', 'dislike', '2021-06-01 07:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `postratting`
--

DROP TABLE IF EXISTS `postratting`;
CREATE TABLE IF NOT EXISTS `postratting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ratting` varchar(100) NOT NULL,
  `post_id` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `post_id` (`date`),
  UNIQUE KEY `post_id_2` (`post_id`,`user`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postratting`
--

INSERT INTO `postratting` (`id`, `ratting`, `post_id`, `user`, `date`, `ip`) VALUES
(3, '5', '12', 'tarun@gmail.com', '2020-05-16 12:53:24', '::1'),
(4, '3', '29', 'tarun@gmail.com', '2020-05-16 12:55:41', '::1'),
(5, '2', '27', 'tarun@gmail.com', '2020-05-16 12:57:21', '::1'),
(6, '3', '28', 'tarun@gmail.com', '2020-05-16 13:00:20', '::1'),
(7, '2', '29', 'tarun1@gmail.com', '2020-05-16 13:03:58', NULL),
(8, '4', '29', 'taru5n@gmail.com', '2020-05-16 13:04:38', NULL),
(9, '2.5', '29', 'tar88un@gmail.com', '2020-05-16 13:05:11', NULL),
(11, '1', '25', 'tarun@gmail.com', '2020-05-16 14:08:27', '::1'),
(12, '5', '22', 'tarun@gmail.com', '2020-05-16 14:08:46', '::1'),
(17, '2', '24', 'tarun@gmail.com', '2020-05-17 07:15:45', '::1'),
(18, '4', '26', 'tarun@gmail.com', '2020-05-17 07:31:14', '::1'),
(19, '4', '11', 'tarun@gmail.com', '2020-06-15 04:28:14', '::1'),
(20, '3', '7', 'tarun@gmail.com', '2020-06-15 05:24:16', '::1'),
(21, '4', '28', 'kushal@gmail.com', '2021-06-01 07:24:07', '::1'),
(22, '5', '16', 'tarun@gmail.com', '2022-01-11 16:04:52', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AdminUserName` varchar(255) NOT NULL,
  `AdminPassword` varchar(255) NOT NULL,
  `AdminEmailId` varchar(255) NOT NULL,
  `Is_Active` int(11) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `Is_Active`, `CreationDate`, `UpdationDate`) VALUES
(2, 'tarun', '$2y$12$T.9OSVOyywAaW0W0lT81RufYcwyPYkU52.NhY2jZBehoVoCxKzfva', 'tarun@gmail.com', 1, '2020-01-10 18:30:00', '2020-01-10 18:30:00'),
(3, 'tarun1', '$2y$10$CVZAzlYI528gAO5pwOhIbO5NjQAE7GBGqq5V/pJDhlbFS7K7tkf9y', 'tarun1@gmai.com', 1, '2020-02-13 05:11:16', '2020-02-13 05:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Is_Active` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(2, 'Bollywood', 'Bollywood News', '2018-06-06 10:28:09', '2018-06-30 18:41:07', 1),
(3, 'Sports', 'Related to sports news', '2018-06-06 10:35:09', '2018-06-14 11:11:55', 1),
(5, 'Entertainment', 'Entertainment related  News', '2018-06-14 05:32:58', '2018-06-14 05:33:41', 1),
(6, 'Politics', 'Politics', '2018-06-22 15:46:09', '0000-00-00 00:00:00', 1),
(7, 'Business', 'Business', '2018-06-22 15:46:22', '0000-00-00 00:00:00', 1),
(8, 'life', 'things related to life.', '2020-01-11 06:51:45', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

DROP TABLE IF EXISTS `tblcomments`;
CREATE TABLE IF NOT EXISTS `tblcomments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postId` char(11) DEFAULT NULL,
  `name` varchar(120) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `comment` mediumtext,
  `comment_like` int(11) DEFAULT '0',
  `comment_dislike` int(11) DEFAULT '0',
  `postingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lasttime` int(100) DEFAULT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`id`, `postId`, `name`, `email`, `comment`, `comment_like`, `comment_dislike`, `postingDate`, `lasttime`, `parent`, `status`) VALUES
(1, '29', 'tarun aggarwal', 'tarun@gmail.com', 'this is comment', 3, 3, '2020-04-27 09:18:07', 1587979087, 'null', 1),
(2, '29', 'tarun aggarwal', 'tarun@gmail.com', 'koijuh', 0, 0, '2020-04-27 09:21:18', 1587979278, 'null', 1),
(5, '29', 'tarun', 'tarun@gmail.com', 'this is reply', 0, 1, '2020-04-27 09:34:24', 1587980064, '1', 1),
(6, '29', 'tarun', 'tarun@gmail.com', 'this is reply', 0, 0, '2020-04-27 09:35:06', 1587980106, '2', 1),
(8, '28', 'tarun agg', '', 'this is reply', 1, 2, '2020-04-27 10:25:45', 1587983145, '7', 1),
(9, '29', 'aravind', 'tarun@gmail.com', 'thi rep', 0, 0, '2020-04-27 11:03:15', 1587985395, 'null', 1),
(10, '29', 'aravind', 'tarun@gmail.com', 'hehehehhe', 0, 0, '2020-04-27 11:03:39', 1587985419, 'null', 1),
(11, '29', 'tarun agg', 'tarun@gmail.com', 'hahah', 0, 0, '2020-04-27 11:03:55', 1587985435, '1', 1),
(12, '29', 'tarun aggarwal', 'tarun@gmail.com', 'iuy', 0, 0, '2020-04-27 11:05:08', 1587985508, 'null', 1),
(13, '29', 'aravind aggarwal', 'tarun@gmail.com', 'ijuhygt', 0, 0, '2020-04-27 11:05:35', 1587985535, 'null', 1),
(14, '27', 'tarun aggarwal', 'tarun@gmail.com', 'okijuy', 0, 0, '2020-04-27 11:09:05', 1587985745, 'null', 1),
(15, '27', 'tarun aggarwal', 'tarun@gmail.com', 'koijuh', 0, 0, '2020-04-27 11:09:15', 1587985755, 'null', 1),
(16, '27', 'tarun aggarwal', 'tarun@gmail.com', 'koiu8', 0, 0, '2020-04-27 11:09:25', 1587985765, 'null', 1),
(17, '27', 'tarun aggarwal', 'tarun@gmail.com', 'koiju', 0, 0, '2020-04-27 11:10:46', 1587985846, 'null', 1),
(18, '26', 'Tarun', 'tarun@gmail.com', 'hahah', 0, 0, '2020-04-27 11:14:49', 1587986089, 'null', 1),
(19, '26', 'tarun agg', 'tarun@gmail.com', 'this is reply', 0, 0, '2020-04-27 11:14:57', 1587986097, '18', 1),
(20, '29', 'tarun agg', 'tarun@gmail.com', 'ploiu', 0, 0, '2020-04-27 11:46:02', 1587987962, '5', 1),
(21, '29', 'tarun agg', 'tarun@gmail.com', ',lkoiju', 0, 0, '2020-04-29 11:21:00', 1588159260, '6', 1),
(22, '12', 'tarun aggarwal', 'tarun@gmail.com', 'tarij', 2, 0, '2020-05-16 12:25:20', 1589631920, 'null', 1),
(25, '12', 'tarun agg', 'tarun@gmail.com', 'replay hjhjajhj\r\n', 0, 0, '2020-05-16 12:29:01', 1589632141, '22', 1),
(26, '29', 'tarun agg', 'tarun@gmail.com', ',okijuh', 0, 0, '2020-05-17 07:24:06', 1589700246, '10', 1),
(27, '29', 'tarun agg', 'tarun@gmail.com', 'tetette', 0, 0, '2020-05-17 07:24:16', 1589700256, '12', 1),
(28, '11', 'tarun aggarwal', 'tarun@gmail.com', 'this is a comment for a post', 0, 0, '2020-05-20 10:35:24', 1589970924, 'null', 1),
(29, '11', 'tarun agg', 'tarun@gmail.com', 'this is reply on comment', 0, 0, '2020-05-20 10:35:40', 1589970940, '28', 1),
(30, '12', 'this is presentation', 'tarun@gmail.com', 'for show the teachers', 1, 1, '2020-06-15 04:15:00', 1592194500, 'null', 1),
(31, '12', 'tarun', 'tarun@gmail.com', 'this is reply', 0, 0, '2020-06-15 04:15:37', 1592194537, '30', 1),
(32, '12', 'this is presentation', 'tarun@gmail.com', 'fir testing purpose', 0, 0, '2020-06-15 04:36:11', 1592195771, 'null', 1),
(33, '7', 'this is presentation', 'tarun@gmail.com', 'for ts', 0, 0, '2020-06-15 05:24:46', 1592198686, 'null', 1),
(34, '28', 'poi9u8y', 'kushal@gmail.com', 'oiuy', 2, 1, '2021-06-01 07:23:47', 1622532227, 'null', 1),
(35, '28', 'oi9u8y7', 'kushal@gmail.com', '0i9u8y', 0, 0, '2021-06-01 07:24:01', 1622532241, 'null', 1),
(36, '17', 'kkkk', 'kushal@gmail.com', '-o0i9u8y7', 0, 0, '2021-06-01 07:35:00', 1622532900, 'null', 1),
(37, '17', 'kushalll', 'kushal@gmail.com', '[poiuhyg', 0, 0, '2021-06-01 07:36:11', 1622532971, '36', 1),
(38, '28', '[pokijuh', 'tarun@gmail.com', 'lpokijuhy', 0, 0, '2022-01-11 16:03:56', 1641917036, 'null', 1),
(39, '28', 'tarun', 'tarun@gmail.com', '[poiju', 0, 0, '2022-01-11 16:04:04', 1641917044, '34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

DROP TABLE IF EXISTS `tblpages`;
CREATE TABLE IF NOT EXISTS `tblpages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext,
  `Description` longtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<h2><span style=\"color: rgb(59, 56, 53); font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; background-color: rgb(255, 231, 156);\"><b style=\"\">Online news System allows customers to read up to date news related to many fields like Entertainment, National, International, Business, Bollywood ,Hollywood, Politics, Sports, Education etc. ï‚— Without any payment or login. He can also contact us to give suggestions and can also give us feedback related to our site . ï‚— New News can be added or post only by the admin and only admin have the Authorized to update or delete any News.</b></span></h2>', '2018-06-30 18:01:03', '2020-02-12 15:20:27'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><font face=\"Hind Madurai, sans-serif\"><b>Developer Name :&nbsp;</b>&nbsp;</font>Tarun Aggarwal</p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>+826549498</p><p><b>Email -id : </b>tarunaggarwal421@gmail.com</p>', '2018-06-30 18:01:36', '2020-02-12 15:22:04');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

DROP TABLE IF EXISTS `tblposts`;
CREATE TABLE IF NOT EXISTS `tblposts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postedby` varchar(100) DEFAULT NULL,
  `PostTitle` longtext,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext,
  `PostImage` varchar(255) DEFAULT NULL,
  `post_like` int(11) NOT NULL DEFAULT '0',
  `post_dislike` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `postedby`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `post_like`, `post_dislike`) VALUES
(7, NULL, 'Jasprit Bumrah ruled out of England T20I series due to injury', 3, 4, '<p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\"><span style=\"margin: 0px; padding: 0px; font-weight: 700;\">The Indian Cricket Team has received a huge blow right ahead of the commencement of the much-awaited series against England. Star speedster Jasprit Bumrah has been ruled out of the forthcoming 3-match T20I series as he suffered an injury in his left thumb.</span></p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">The 24-year-old pacer picked up a niggle during India’s first T20I match against Ireland played on June 27 at the Malahide cricket ground in Dublin. As per the reports, he is likely to be available for the ODI series against England scheduled to start from July 12.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">In the first, Bumrah exhibited a phenomenal performance with the ball. In his quota of four overs, he conceded 19 runs and picked 2 wickets at an economy rate of 4.75.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">Post his injury, he arrived at team’s optional training session on Thursday but didn’t train. Later, he was rested in the second face-off along with MS Dhoni, Shikhar Dhawan and Bhuvneshwar Kumar.</p><p style=\"margin-bottom: 15px; padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">As of now, no replacement has been announced. However, Umesh Yadav may be be given chance in the team in Bumrah’s absence.</p><p style=\"padding: 0px; font-size: 16px; font-family: PTSans, sans-serif;\">The first T20I match between India and England will be played at Old Trafford, Manchester on July 3.</p>', '2018-06-30 18:49:23', '2018-08-28 15:57:32', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', '6d08a26c92cf30db69197a1fb7230626.jpg', 0, 0),
(10, NULL, 'Tata Steel, Thyssenkrupp Finalise Landmark Steel Deal', 7, 9, '<h1 style=\"box-sizing: inherit; margin-top: 0px; padding: 0px; font-family: Roboto, sans-serif; font-size: 38px; line-height: normal; letter-spacing: -0.5px; color: rgb(51, 51, 51);\"><span itemprop=\"headline\" style=\"box-sizing: inherit;\">Tata Steel, Thyssenkrupp Finalise Landmark Steel Deal</span>Tata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel DealTata Steel, Thyssenkrupp Finalise Landmark Steel Deal</h1>', '2018-06-30 19:08:56', '2018-08-28 15:59:59', 1, 'Tata-Steel,-Thyssenkrupp-Finalise-Landmark-Steel-Deal', '505e59c459d38ce4e740e3c9f5c6caf7.jpg', 0, 0),
(11, NULL, 'UNs Jean Pierre Lacroix thanks India for contribution to peacekeeping', 6, 8, '<p>UNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeeping<br></p>', '2018-06-30 19:10:36', '2018-08-28 16:01:35', 1, 'UNs-Jean-Pierre-Lacroix-thanks-India-for-contribution-to-peacekeeping', '27095ab35ac9b89abb8f32ad3adef56a.jpg', 0, 0),
(12, NULL, 'Shah holds meeting with NE states leaders in Manipur', 6, 7, '<p><span style=\"color: rgb(25, 25, 25); font-family: &quot;Noto Serif&quot;; font-size: 16px;\">New Delhi: BJP president Amit Shah today held meetings with his party leaders who are in-charge of 11 Lok Sabha seats spread across seven northeast states as part of a drive to ensure that it wins the maximum number of these constituencies in the general election next year.</span><br style=\"box-sizing: inherit; color: rgb(25, 25, 25); font-family: &quot;Noto Serif&quot;; font-size: 16px;\"><br style=\"box-sizing: inherit; color: rgb(25, 25, 25); font-family: &quot;Noto Serif&quot;; font-size: 16px;\"><webviewcontentdata style=\"box-sizing: inherit; color: rgb(25, 25, 25); font-family: &quot;Noto Serif&quot;; font-size: 16px;\">Shah held separate meetings with Lok Sabha toli (group) of Arunachal Pradesh, Tripura, Meghalaya, Mizoram, Nagaland, Sikkim and Manipur in Manipur, the partys media head Anil Baluni said.<br style=\"box-sizing: inherit;\"><br style=\"box-sizing: inherit;\">Baluni said that Shah was in West Bengal for two days before he arrived in Manipur. The BJP chief would reach Odisha tomorrow.</webviewcontentdata><br></p>', '2018-06-30 19:11:44', '2020-05-19 11:23:11', 1, 'Shah-holds-meeting-with-NE-states-leaders-in-Manipur', '7fdc1a630c238af0815181f9faa190f5.jpg', 0, 0),
(13, NULL, 'for testing purpose', 3, 4, '<p>hello for testing</p>', '2020-01-11 06:49:00', '2020-04-12 05:45:31', 1, 'for-testing-purpose', 'ea6438293302032889d95108da4018fb.jpg', 0, 0),
(14, 'admin', 'for checking', 3, 4, '<p>this is bollywood post.</p>', '2020-01-30 06:46:16', '2020-03-21 13:55:30', 1, 'for-checking', '042fdc8537fbaeed86c97d7a2719688a.jpg', 0, 0),
(16, 'tarunagg@gmail.com', 'for outside testing', 6, 7, '<p>koijuytfrtgyhujikoijhuygt&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>', '2020-01-30 08:16:05', '2020-03-21 04:32:09', 1, 'for-outside-testing', '6ecf5160b1dbf85cb279d29368b2b22b.jpg', 1, 0),
(17, 'tarun@gmail.com', 'huhhuh', 5, 3, '<p>mhgyuyhgyigiug</p>', '2020-02-03 05:54:29', '2020-03-21 13:54:55', 1, 'huhhuh', 'b7bd85c7c691b057b4a55526665c4f4c.jpg', 3, 0),
(18, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:09:53', '2020-03-21 12:27:12', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 3, 1),
(20, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:10:35', '2020-04-12 05:38:03', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 5, 2),
(24, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:11:52', '2020-04-12 05:45:42', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 0, 0),
(25, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:12:37', '2020-04-12 05:45:44', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 0, 0),
(26, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:12:42', '2020-04-12 05:45:45', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 0, 0),
(27, 'tarun@gmail.com', 'Election Updates', 6, 7, 'Election Exit pole Updates,...', '2020-02-09 14:13:22', '2020-04-26 12:44:24', 1, 'Election-Updates', 'ea6438293302032889d95108da4018fb.jpg', 1, 0),
(28, 'admin', 'for img testing', 7, 9, '<p>this is img testing</p>', '2020-03-14 15:27:32', '2022-01-11 16:14:51', 1, 'for-img-testing', 'a1dbc6c1b452c6bc503a185b2a091e7e.jpg', 21, 2),
(29, 'kushal@gmail.com', 'for img testing by kushal', 5, 3, '<p>by kusha</p>', '2021-06-01 07:27:06', '2022-01-11 16:14:35', 0, 'for-img-testing-by-kushal', 'bf19f5f9a81662673ef9840faaf86968.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

DROP TABLE IF EXISTS `tblsubcategory`;
CREATE TABLE IF NOT EXISTS `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Is_Active` int(1) DEFAULT NULL,
  PRIMARY KEY (`SubCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2018-06-22 15:45:38', '0000-00-00 00:00:00', 1),
(4, 3, 'Cricket', 'Cricket\r\n\r\n', '2018-06-30 09:00:43', '0000-00-00 00:00:00', 1),
(5, 3, 'Football', 'Football', '2018-06-30 09:00:58', '0000-00-00 00:00:00', 1),
(6, 5, 'Television', 'TeleVision', '2018-06-30 18:59:22', '0000-00-00 00:00:00', 1),
(7, 6, 'National', 'National', '2018-06-30 19:04:29', '0000-00-00 00:00:00', 1),
(8, 6, 'International', 'International', '2018-06-30 19:04:43', '0000-00-00 00:00:00', 1),
(9, 7, 'India', 'India', '2018-06-30 19:08:42', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

DROP TABLE IF EXISTS `userlogin`;
CREATE TABLE IF NOT EXISTS `userlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Dob` date NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Profile_Img` varchar(250) DEFAULT NULL,
  `Gender` text,
  `Is_Active` int(11) NOT NULL DEFAULT '1',
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `LastLogin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `Email`, `name`, `Dob`, `Password`, `Profile_Img`, `Gender`, `Is_Active`, `CreationDate`, `LastLogin`) VALUES
(7, 'tarun@gmail.com', 'arun', '2000-04-20', '4ec6b242322a0139def69c6380c7aa27', 'banner_02.png', 'male', 1, '2020-01-16 13:02:08', '11-01-22 09-38-18'),
(8, 'nidhi@gmail.com', 'nidhi', '1999-02-02', '64605c59ab62dbcd925af40d7de11276', NULL, NULL, 1, '2020-01-16 16:58:17', '13-05-20 06-43-23'),
(9, 'naveen@gmail.com', 'naveen', '2007-11-10', 'e691cb702f5d25642aa87009ef1948f8', NULL, NULL, 1, '2020-01-30 07:36:03', '13-05-20 06-44-39'),
(10, 'karan1@gmail.com', 'priyanka', '2000-02-10', '1fd96777aedeadb325c66f3780054765', 'usericon.png', NULL, 1, '2020-02-11 04:10:15', '21-03-20 11:26 03'),
(11, 'shivani@gmail.com', 'shivani', '1998-06-05', 'ea7fd144f2edb73362f531981ed1d6c8', NULL, NULL, 1, '2020-03-24 15:01:46', NULL),
(12, 'karan@gmal.com', 'karan', '2000-12-03', 'db068ce9f744fbb35eedc9a883f91085', NULL, NULL, 1, '2020-03-30 07:44:34', NULL),
(13, 'bharti@gmail.com', 'bharti', '2002-12-01', '95387d140a350afaef5c641beb107efd', NULL, NULL, 1, '2020-03-30 07:48:21', NULL),
(14, 'session@gmail.com', 'uhy', '0005-05-05', '769a605b1c9bdda42486ccc264a18174', NULL, NULL, 1, '2020-03-30 08:08:05', NULL),
(17, 'mkmk@gmail.com', 'Tarun', '2020-09-11', 'pkojihuy', NULL, 'male', 1, '2020-09-18 06:11:25', NULL),
(19, 'kushal@gmail.com', 'kushalll', '2021-06-17', '6ec44a1207a3d9506418c034679087b6', 'IMG_20210331_152504.jpg', 'male', 1, '2021-06-01 07:21:42', '01-06-21 12-53-29');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

DROP TABLE IF EXISTS `views`;
CREATE TABLE IF NOT EXISTS `views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(200) NOT NULL,
  `postid` int(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `postid` (`postid`,`ip`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `ip`, `postid`, `date`) VALUES
(1, '::1', 28, '2021-06-01 07:37:58'),
(2, '::1', 10, '2022-01-11 16:03:23'),
(3, '::1', 16, '2022-01-11 16:04:51'),
(4, '::1', 29, '2022-01-11 16:13:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
