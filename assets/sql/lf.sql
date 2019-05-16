-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2019 at 03:58 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lf`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountId` varchar(50) NOT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AccountType` char(6) DEFAULT NULL,
  `DateJoin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountId`, `Password`, `AccountType`, `DateJoin`) VALUES
('NguyenNgoc', '0d94d92e3dc096f64213a5b34fa9d098', 'Admin', '2019-05-05 17:21:48'),
('tester', 'c4ca4238a0b923820dcc509a6f75849b', 'MB', '2019-05-05 17:21:48'),
('UserTest', '202cb962ac59075b964b07152d234b70', 'MB', '2019-05-12 23:03:25'),
('UserTestApp', '202cb962ac59075b964b07152d234b70', 'MB', '2019-05-12 23:17:12'),
('UserTestNo1', '202cb962ac59075b964b07152d234b70', 'MB', '2019-05-13 09:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `Id` char(6) NOT NULL,
  `TypeName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`Id`, `TypeName`) VALUES
('Admin', 'Adminstrator'),
('MB', 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `Id` char(6) NOT NULL,
  `SchoolName` varchar(50) DEFAULT NULL,
  `Area` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`Id`, `SchoolName`, `Area`, `Address`) VALUES
('BKA', 'ĐH BÁCH KHOA HN', 'Miền Bắc', 'HÀ NỘI'),
('C.T', 'ĐH CODERS.TOKYO', 'Miền Đông', 'KHẮP MỌI MIỀN THẾ GIỚI'),
('CSS', 'ĐH CSND', 'Miền Nam', 'TPHCM'),
('CTU', 'ĐẠI HỌC CẦN THƠ', 'Miền Nam', 'CẦN THƠ'),
('DNC', 'ĐT NAM CT', 'Miền Nam', 'CẦN THƠ'),
('DSD', 'ĐH SK-ĐA TPHCM', 'Miền Nam', 'TPHCM'),
('DSK', 'ĐH SPKT-ĐN', 'Miền Trung', 'ĐÀ NẴNG'),
('DTT', 'ĐH TĐT', 'Miền Nam', 'TPHCM'),
('DVT', 'ĐH TV', 'Miền Nam', 'TRÀ VINH'),
('GTS', 'ĐH GT-VT TPHCM', 'Miền Nam', 'TRÀ VINH'),
('KCC', 'ĐH KT-CN CT', 'Miền Nam', 'CẦN THƠ'),
('OTHER', 'TRƯỜNG KHÁC', 'EARTH', 'EARTH');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `User_UserId` char(6) NOT NULL,
  `Score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` char(6) NOT NULL,
  `FullName` varchar(50) DEFAULT NULL,
  `Dob` date DEFAULT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `School_Id` char(6) DEFAULT NULL,
  `Avatar` varchar(200) DEFAULT NULL,
  `AccountId` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `FullName`, `Dob`, `Gender`, `Address`, `School_Id`, `Avatar`, `AccountId`) VALUES
('j19161', 'Trần Test', '1997-02-03', 'Female', 'Bến Tre', 'C.T', 'assets/images/やります.jpg', 'tester'),
('ntngoc', 'Nguyễn Thái Ngọc', '1996-07-07', 'Male', 'Cần Thơ', 'CTU', 'assets/images/avatar.jpg', 'NguyenNgoc'),
('pe083a', 'Nguyen Van Binh', '1996-02-22', 'Male', 'Cần Thơ', 'CTU', 'assets/images/avatar.jpg', 'UserTestNo1'),
('uf9fa9', 'Nguyen Van C', '1999-02-09', 'Female', 'Cần Thơ', 'CTU', 'assets/images/user.jpg', 'UserTestApp'),
('z06ca8', 'Nguyen Van B', '1996-06-11', 'Female', 'Cần Thơ', 'CTU', 'assets/images/user.jpg', 'UserTest');

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE `vocabulary` (
  `WordId` char(6) NOT NULL,
  `Word` varchar(50) DEFAULT NULL,
  `WordForm` varchar(10) DEFAULT NULL,
  `Kanji` varchar(20) DEFAULT NULL,
  `Pronounce` varchar(20) DEFAULT NULL,
  `Meaning` varchar(100) DEFAULT NULL,
  `Example` varchar(200) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `Sound` varchar(200) DEFAULT NULL,
  `User_UserId` char(6) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vocabulary`
--

INSERT INTO `vocabulary` (`WordId`, `Word`, `WordForm`, `Kanji`, `Pronounce`, `Meaning`, `Example`, `Image`, `Sound`, `User_UserId`, `DateCreate`) VALUES
('b1d0cd', '運動会', 'Noun', 'VẬN ĐỘNG HỘI', 'うんどうかい', 'hội thi thể thao', '運動会に　参加します。', 'assets/images/words/運動会.JPG', 'assets/sounds/words/undoukai.mp3', 'ntngoc', '2019-05-05 00:53:02'),
('d3e259', '新聞社', 'Noun', 'TÂN VĂN XÃ', 'しんぶんしゃ', 'công ty phát hành báo, tòa soạn báo', '新聞社へ　新聞を　取りに　行きます。', 'assets/images/words/新聞社.jpg', 'assets/sounds/words/shimbunsha.mp3', 'ntngoc', '2019-05-05 00:48:53'),
('g03f8e', '都合が　悪い', 'Adj', 'ĐÔ HỢP ÁC', 'つごうが　わるい', 'không có thời gian, bận, không thuận tiện', '明日は都合が悪いので、すみません。', 'assets/images/words/都合が悪い.jpg', 'assets/sounds/words/tsugougawaruii.mp3', 'ntngoc', '2019-05-04 23:42:25'),
('i720e0', '診ます', 'Verb', 'CHẨN', 'みます', 'xem, khám bệnh', '医者に診てもらいました。', 'assets/images/words/mimasu.jpg', 'assets/sounds/words/mimasu.mp3', 'ntngoc', '2019-05-04 23:13:55'),
('iadfe5', '飼います	', 'Verb', 'TỰ', 'かいます	', 'nuôi (động vật)', '犬を飼います。', 'assets/images/words/飼います.jpg', 'assets/sounds/words/kaimasu_nuoi.mp3', 'z06ca8', '2019-05-12 23:05:03'),
('id5e61', '柔道', 'Noun', 'NHU ĐẠO', 'じゅうどう', 'Judo', '柔道が　好きですか。', 'assets/images/words/柔道.jpg', 'assets/sounds/words/juudou.mp3', 'ntngoc', '2019-05-05 00:50:53'),
('jffe3e', '気分が悪い', 'Noun', 'KHÍ PHÂN ÁC', 'きぶんがわるい', 'cảm thấy không tốt, cảm thấy mệt', '彼は電話を　見たとき、気分が　悪くなります。', 'assets/images/words/気分が悪い.png', 'assets/sounds/words/kibungawaruii.mp3', 'ntngoc', '2019-05-05 00:43:20'),
('kb27b2', '気分がいい', 'Adj', 'KHÍ PHÂN', 'きぶんがいい', 'cảm thấy tốt, cảm thấy khỏe', '音楽を聞いた後で、気分が良くなります。', 'assets/images/words/気分がいい.jpg', 'assets/sounds/words/kibungaii.mp3', 'ntngoc', '2019-05-05 00:29:07'),
('l2c0d5', '～弁', 'Noun', 'BIỆN', '～べん	', 'tiếng ~, giọng ~', '大坂弁は　聞きやすいです。', 'assets/images/words/弁.jpg', 'assets/sounds/words/ben.mp3', 'ntngoc', '2019-05-05 01:03:58'),
('oc0e08', '申し込みます', 'Noun', 'THÂN VÀO', 'もうしこみます', 'đăng ký', 'ボランティアに申し込みます。', 'assets/images/words/申し込みます.jpg', 'assets/sounds/words/moushikomimasu.mp3', 'ntngoc', '2019-05-04 23:30:00'),
('p6f9e5', '都合が　いい', 'Noun', 'ĐÔ HỢP', 'つごうが　いい', 'có thời gian, thuận tiện', '都合が　良かったら、遊びに行きませんか。', 'assets/images/words/都合がいい.jpg', 'assets/sounds/words/tsugougaii.mp3', 'ntngoc', '2019-05-04 23:35:35'),
('s01e02', '飼います	', 'Verb', 'TỰ	', 'かいます', 'nuôi (động vật)', '犬を　飼います。', 'assets/images/words/飼います.jpg', 'assets/sounds/words/kaimasu_nuoi.mp3', 'uf9fa9', '2019-05-12 23:18:53'),
('s7d5dd', '場所', 'Noun', 'TRƯỜNG SỞ', 'ばしょ', 'địa điểm', 'パーティーの場所を　教えてください。', 'assets/images/words/場所.jpg', 'assets/sounds/words/basho.mp3', 'ntngoc', '2019-05-05 00:56:45'),
('sb613d', 'やります', 'Verb', '', 'やります', 'Làm', '宿題を　やります。', 'assets/images/words/やります.jpg', 'assets/sounds/words/yarimasu.mp3', 'ntngoc', '2019-05-04 23:24:28'),
('wa2652', '1', 'Noun', '2121', 'sads', '', '', 'assets/images/words/mimasu.jpg', 'assets/sounds/words/mimasu.mp3', 'pe083a', '2019-05-13 09:52:05'),
('x99532', '参加します', 'Verb', 'THAM GIA', 'さんかします', 'tham gia, dự [buổi tiệc]', 'パーティーに　参加します', 'assets/images/words/参加します.png', 'assets/sounds/words/sankashimasu.mp3', 'ntngoc', '2019-05-04 23:26:55'),
('y85de3', '探します', 'Noun', 'THÁM', 'さがします', 'tìm, tìm kiếm', '日本語の本を探しています。', 'assets/images/words/探します.png', 'assets/sounds/words/sagashimasu.mp3', 'ntngoc', '2019-05-04 23:19:33'),
('ybf66f', '遅れます', 'Verb', 'TRÌ', '[じかんに～] おくれます', 'chậm, muộn [cuộc hẹn,v.v.]', '[時間に 遅れます', 'assets/images/words/遅れます.jpg', 'assets/sounds/words/okuremasu.mp3', 'ntngoc', '2019-05-04 23:22:40'),
('z1d3b9', 'ボランティア', 'Noun', '', 'ボランティア', 'tình nguyện viên', 'ボランティアに　参加します。', 'assets/images/words/ボランティア.jpg', 'assets/sounds/words/borantiia.mp3', 'ntngoc', '2019-05-05 01:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `vocabularylibrary`
--

CREATE TABLE `vocabularylibrary` (
  `WordId` char(6) NOT NULL,
  `Word` varchar(50) DEFAULT NULL,
  `WordForm` varchar(10) DEFAULT NULL,
  `Kanji` varchar(20) DEFAULT NULL,
  `Pronounce` varchar(20) DEFAULT NULL,
  `Meaning` varchar(100) DEFAULT NULL,
  `Example` varchar(200) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `Sound` varchar(200) DEFAULT NULL,
  `User_UserId` char(6) NOT NULL,
  `DateCreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vocabularylibrary`
--

INSERT INTO `vocabularylibrary` (`WordId`, `Word`, `WordForm`, `Kanji`, `Pronounce`, `Meaning`, `Example`, `Image`, `Sound`, `User_UserId`, `DateCreate`) VALUES
('b1d0cd', '運動会', 'Noun', 'VẬN ĐỘNG HỘI', 'うんどうかい', 'hội thi thể thao', '運動会に　参加します。', 'assets/images/words/運動会.JPG', 'assets/sounds/words/undoukai.mp3', 'ntngoc', '2019-05-05 00:53:02'),
('be7d3e', '12', 'Noun', '1', '', '', '', 'assets/images/words/', 'assets/sounds/words/', 'ntngoc', '2019-05-11 20:10:29'),
('d3e259', '新聞社', 'Noun', 'TÂN VĂN XÃ', 'しんぶんしゃ', 'công ty phát hành báo, tòa soạn báo', '新聞社へ　新聞を　取りに　行きます。', 'assets/images/words/新聞社.jpg', 'assets/sounds/words/shimbunsha.mp3', 'ntngoc', '2019-05-05 00:48:53'),
('f568bf', '建てます	.', 'Verb', 'KIẾN', 'たてます	', 'xây, xây dựng', 'うちを　建ってます	。', 'assets/images/words/建てます.jpg', 'assets/sounds/words/tatemasu.mp3', 'uf9fa9', '2019-05-12 23:20:23'),
('g03f8e', '都合が　悪い', 'Adj', 'ĐÔ HỢP ÁC', 'つごうが　わるい', 'không có thời gian, bận, không thuận tiện', '明日は都合が悪いので、すみません。', 'assets/images/words/都合が悪い.jpg', 'assets/sounds/words/tsugougawaruii.mp3', 'ntngoc', '2019-05-04 23:42:25'),
('i579b9', '建てます	。', 'Verb', 'KIẾN', 'たてます	', 'xây, xây dựng', 'うちを　建っています。	', 'assets/images/words/建てます.jpg', 'assets/sounds/words/tatemasu.mp3', 'z06ca8', '2019-05-12 23:09:41'),
('i720e0', '診ます', 'Verb', 'CHẨN', 'みます', 'xem, khám bệnh', '医者に診てもらいました。', 'assets/images/words/mimasu.jpg', 'assets/sounds/words/mimasu.mp3', 'ntngoc', '2019-05-04 23:13:55'),
('iadfe5', '飼います	', 'Verb', 'TỰ', 'かいます	', 'nuôi (động vật)', '犬を飼います。', 'assets/images/words/飼います.jpg', 'assets/sounds/words/kaimasu_nuoi.mp3', 'z06ca8', '2019-05-12 23:05:03'),
('id5e61', '柔道', 'Noun', 'NHU ĐẠO', 'じゅうどう', 'Judo', '柔道が　好きですか。', 'assets/images/words/柔道.jpg', 'assets/sounds/words/juudou.mp3', 'ntngoc', '2019-05-05 00:50:53'),
('jffe3e', '気分が悪い', 'Noun', 'KHÍ PHÂN ÁC', 'きぶんがわるい', 'cảm thấy không tốt, cảm thấy mệt', '彼は電話を　見たとき、気分が　悪くなります。', 'assets/images/words/気分が悪い.png', 'assets/sounds/words/kibungawaruii.mp3', 'ntngoc', '2019-05-05 00:43:20'),
('kb27b2', '気分がいい', 'Adj', 'KHÍ PHÂN', 'きぶんがいい', 'cảm thấy tốt, cảm thấy khỏe', '音楽を聞いた後で、気分が良くなります。', 'assets/images/words/気分がいい.jpg', 'assets/sounds/words/kibungaii.mp3', 'ntngoc', '2019-05-05 00:29:07'),
('l2c0d5', '～弁', 'Noun', 'BIỆN', '～べん	', 'tiếng ~, giọng ~', '大坂弁は　聞きやすいです。', 'assets/images/words/弁.jpg', 'assets/sounds/words/ben.mp3', 'ntngoc', '2019-05-05 01:03:58'),
('oc0e08', '申し込みます', 'Noun', 'THÂN VÀO', 'もうしこみます', 'đăng ký', 'ボランティアに申し込みます。', 'assets/images/words/申し込みます.jpg', 'assets/sounds/words/moushikomimasu.mp3', 'ntngoc', '2019-05-04 23:30:00'),
('p6f9e5', '都合が　いい', 'Noun', 'ĐÔ HỢP', 'つごうが　いい', 'có thời gian, thuận tiện', '都合が　良かったら、遊びに行きませんか。', 'assets/images/words/都合がいい.jpg', 'assets/sounds/words/tsugougaii.mp3', 'ntngoc', '2019-05-04 23:35:35'),
('pd90be', '1', 'Verb', '1', '', '', '', 'assets/images/words/やります.jpg', 'assets/sounds/words/tsugougaii.mp3', 'ntngoc', '2019-05-11 19:46:01'),
('s01e02', '飼います	', 'Verb', 'TỰ	', 'かいます', 'nuôi (động vật)', '犬を　飼います。', 'assets/images/words/飼います.jpg', 'assets/sounds/words/kaimasu_nuoi.mp3', 'uf9fa9', '2019-05-12 23:18:53'),
('s7d5dd', '場所', 'Noun', 'TRƯỜNG SỞ', 'ばしょ', 'địa điểm', 'パーティーの場所を　教えてください。', 'assets/images/words/場所.jpg', 'assets/sounds/words/basho.mp3', 'ntngoc', '2019-05-05 00:56:45'),
('sb613d', 'やります', 'Verb', '', 'やります', 'Làm', '宿題を　やります。', 'assets/images/words/やります.jpg', 'assets/sounds/words/yarimasu.mp3', 'ntngoc', '2019-05-04 23:24:28'),
('wa2652', '1', 'Noun', '2121', 'sads', '', '', 'assets/images/words/mimasu.jpg', 'assets/sounds/words/mimasu.mp3', 'pe083a', '2019-05-13 09:52:05'),
('x99532', '参加します', 'Verb', 'THAM GIA', 'さんかします', 'tham gia, dự [buổi tiệc]', 'パーティーに　参加します', 'assets/images/words/参加します.png', 'assets/sounds/words/sankashimasu.mp3', 'ntngoc', '2019-05-04 23:26:55'),
('y85de3', '探します', 'Noun', 'THÁM', 'さがします', 'tìm, tìm kiếm', '日本語の本を探しています。', 'assets/images/words/探します.png', 'assets/sounds/words/sagashimasu.mp3', 'ntngoc', '2019-05-04 23:19:33'),
('ybf66f', '遅れます', 'Verb', 'TRÌ', '[じかんに～] おくれます', 'chậm, muộn [cuộc hẹn,v.v.]', '[時間に 遅れます', 'assets/images/words/遅れます.jpg', 'assets/sounds/words/okuremasu.mp3', 'ntngoc', '2019-05-04 23:22:40'),
('z1d3b9', 'ボランティア', 'Noun', '', 'ボランティア', 'tình nguyện viên', 'ボランティアに　参加します。', 'assets/images/words/ボランティア.jpg', 'assets/sounds/words/borantiia.mp3', 'ntngoc', '2019-05-05 01:01:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountId`),
  ADD KEY `AccountType` (`AccountType`);

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`User_UserId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `School_Id` (`School_Id`),
  ADD KEY `user_ibfk_2` (`AccountId`);

--
-- Indexes for table `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD PRIMARY KEY (`WordId`,`User_UserId`),
  ADD KEY `vocabulary_ibfk_1` (`User_UserId`);

--
-- Indexes for table `vocabularylibrary`
--
ALTER TABLE `vocabularylibrary`
  ADD PRIMARY KEY (`WordId`,`User_UserId`),
  ADD KEY `vocabularylibrary_ibfk_1` (`User_UserId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`AccountType`) REFERENCES `accounttype` (`Id`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `fk_User_userId` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`School_Id`) REFERENCES `school` (`Id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vocabulary`
--
ALTER TABLE `vocabulary`
  ADD CONSTRAINT `vocabulary_ibfk_1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vocabularylibrary`
--
ALTER TABLE `vocabularylibrary`
  ADD CONSTRAINT `vocabularylibrary_ibfk_1` FOREIGN KEY (`User_UserId`) REFERENCES `user` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
