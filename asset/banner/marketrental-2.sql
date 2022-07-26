-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 06:32 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `bn_id` int(11) NOT NULL,
  `bn_toppic` varchar(100) NOT NULL,
  `bn_detail` varchar(300) NOT NULL,
  `bn_pic` varchar(200) NOT NULL,
  `bn_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`bn_id`, `bn_toppic`, `bn_detail`, `bn_pic`, `bn_link`) VALUES
(57, 'ตลาดต้นตาล', ' “ตลาดต้นตาล ตลาดฝันของคนมีไอเดีย” โดยถูกสร้างขึ้นเพื่อเป็นศูนย์รวม ชิ้นงานศิลปะ ของสะสมที่แต่ละคนโปรดปราน สิ่งประดิษฐ์ หรือของที่คนชื่นชอบ คอเดียวกัน กลุ่มเล่านิทาน กลุ่มละคร กลุ่มเต้นรำ กลุ่มถ่ายภาพ กลุ่มนักแสดงเปิดหมวก กลุ่มดื่มเพื่อสุขภาพ กลุ่มรถคลาสสิคบิ๊กไบค์ ฯลฯ มาโชว์ มาอวด แลกเปลี่ยนผลงานแบ', 'banner/ตลาดต้นตาลขอนแก่น.png', ''),
(58, 'ถนนคนเดิน เชียงใหม่', ' มาถึงเชียงใหม่กันทั้งที ห้ามพลาดที่จะเดินถนนคนเดินวัวลายเลยนะคะ เพราะบอกเลยว่าสินค้าท้องถิ่นเด็ดๆ จะมารวมกันที่นี่! สินค้าจากฝีมือชาวเขามากมายที่นำลงมาจำหน่ายด้านล่าง เช่น กระเป๋า เครื่องประดับ เครื่องเงิน เครื่องสานต่างๆ ซึ่งขายในราคาที่ไม่แพง ', 'banner/ถนนคนเดินเชียงใหม่.png', ''),
(59, 'ตลาดไท', 'ตลาดไท ตลาดกลางการค้าส่ง สินค้าเกษตร ของประเทศไทย · ผักและผลไม้ · เนื้อสัตว์ ปลา & อาหารทะเล · ข้าวสาร · พืชไร่ · อาหารแห้ง & สินค้าเบ็ดเตล็ด · ดอกไม้ ต้นไม้', 'banner/ตลาดไท.png', ''),
(61, 'ตลาดเปิดท้าย มข', 'เปิดท้าย', 'banner/tapae.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE `complain` (
  `comp_id` int(11) NOT NULL,
  `comp_subject` varchar(45) NOT NULL,
  `comp_detail` varchar(99) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `mkr_id` int(11) NOT NULL,
  `toppic_id` int(11) NOT NULL,
  `comp_file` varchar(99) NOT NULL DEFAULT 'complain_file/nopicture.png',
  `users_id` int(11) NOT NULL,
  `req_status` int(11) NOT NULL DEFAULT 1,
  `reply` varchar(99) NOT NULL DEFAULT 'ไม่มีการตอบกลับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`comp_id`, `comp_subject`, `comp_detail`, `timestamp`, `mkr_id`, `toppic_id`, `comp_file`, `users_id`, `req_status`, `reply`) VALUES
(21, 'น้ำขยะไหลเลอะทางเดิน', 'พบน้ำขยะไหลเลอะทางเดินค่ะ', '2022-04-10 13:05:08', 6, 1, 'complain_file/nopicture.png', 7, 1, 'ไม่มีการตอบกลับ	'),
(22, 'การตั้งล็อคล้ำพื้นที่', 'ร้านหนังสือข้างล็อคA32มีการตั้งล็อคล้ำพื้นที่', '2022-04-10 13:05:13', 12, 2, 'complain_file/nopicture.png', 14, 1, 'ไม่มีการตอบกลับ	'),
(30, 'จุดทิ้งขยะ', 'ถังขยะเต็ม\r\n', '2022-04-12 06:51:49', 10, 1, 'complain_file/nopicture.png', 19, 2, 'ค่ะ');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ct_logo` varchar(99) NOT NULL,
  `ct1_fname` varchar(50) NOT NULL,
  `ct1_lname` varchar(45) NOT NULL,
  `ct1_email` varchar(50) NOT NULL,
  `ct1_tel` varchar(10) NOT NULL,
  `ct1_pic` varchar(99) NOT NULL,
  `ct2_fname` varchar(50) NOT NULL,
  `ct2_lname` varchar(45) NOT NULL,
  `ct2_email` varchar(50) NOT NULL,
  `ct2_tel` varchar(10) NOT NULL,
  `ct2_pic` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ct_logo`, `ct1_fname`, `ct1_lname`, `ct1_email`, `ct1_tel`, `ct1_pic`, `ct2_fname`, `ct2_lname`, `ct2_email`, `ct2_tel`, `ct2_pic`) VALUES
('contactpic/logo_marketrental.png', 'สุนิสา', 'ธิสารสังข์', 'sunisa.t@kkumail.com', '08x-xxx-xx', 'contactpic/240057162_3280841175476230_8639066623628243934_n.jpg', 'สหัสทยา', 'เทียนมงคล', 'sahatthaya.t@kkumail.com', '0982955381', 'contactpic/64888250_2353375554705519_3003341342987255808_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `market_detail`
--

CREATE TABLE `market_detail` (
  `mkr_id` int(11) NOT NULL,
  `mkr_name` varchar(45) NOT NULL,
  `mkr_address` varchar(45) NOT NULL,
  `mkr_descrip` varchar(45) NOT NULL,
  `mkr_pic` varchar(99) NOT NULL,
  `market_type_id` int(3) NOT NULL,
  `province_id` int(3) NOT NULL,
  `users_id` int(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `market_detail`
--

INSERT INTO `market_detail` (`mkr_id`, `mkr_name`, `mkr_address`, `mkr_descrip`, `mkr_pic`, `market_type_id`, `province_id`, `users_id`, `email`, `tel`) VALUES
(6, 'ตลาดต้นตาล', 'ขอนแก่น', '“ตลาดต้นตาล ตลาดฝันของคนมีไอเดีย” โดยถูกสร้าง', 'img_market/tontan.jpg', 4, 40, 8, 'sahatthaya.t@gmail.com', '0982955381'),
(9, 'ถนนคนเดินวัวลาย', ' เชียงใหม่', 'ถนนคนเดินวัวลาย เป็นที่ตั้งของหมู่บ้านทำเครื่', 'img_market/wualai.png', 4, 50, 8, '', '0834827759'),
(10, 'ถนนคนเดินท่าแพ', ' เชียงใหม่', 'ถนนคนเดินท่าแพ เป็นถนนคนเดินที่ใหญ่ที่สุดในเช', 'img_market/tapae.jpg', 4, 50, 20, '', '081 952 32'),
(11, 'ถนนคนเดินสันกำแพง', ' เชียงใหม่', '“ถนนคนเดินสันกำแพง” ตั้งอยู่ที่ ถนนเชียงใหม่-', 'img_market/sankamphaeng.png', 4, 50, 9, '', '0886564535'),
(12, 'ถนนคนเดินเชียงคาน', 'Chai Kong, Chiang Khan, Chiang Khan District,', 'ถนนคนเดินเชียงคาน สีสันแห่งการมาเที่ยวเชียงคา', 'img_market/chiangkhan.jpg', 4, 42, 13, 'sahatthaya.t@gmail.com', '0637323245');

-- --------------------------------------------------------

--
-- Table structure for table `market_type`
--

CREATE TABLE `market_type` (
  `market_type_id` int(10) NOT NULL,
  `market_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `market_type`
--

INSERT INTO `market_type` (`market_type_id`, `market_type`) VALUES
(1, 'ตลาดสด'),
(2, 'ตลาดเปิดท้าย'),
(3, 'ตลาดค้าส่ง'),
(4, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(10, 'กรุงเทพมหานคร'),
(11, 'สมุทรปราการ'),
(12, 'นนทบุรี'),
(13, 'ปทุมธานี'),
(14, 'พระนครศรีอยุธยา'),
(15, 'อ่างทอง'),
(16, 'ลพบุรี'),
(17, 'สิงห์บุรี'),
(18, 'ชัยนาท'),
(19, 'สระบุรี'),
(20, 'ชลบุรี'),
(21, 'ระยอง'),
(22, 'จันทบุรี'),
(23, 'ตราด'),
(24, 'ฉะเชิงเทรา'),
(25, 'ปราจีนบุรี'),
(26, 'นครนายก'),
(27, 'สระแก้ว'),
(30, 'นครราชสีมา'),
(31, 'บุรีรัมย์'),
(32, 'สุรินทร์'),
(33, 'ศรีสะเกษ'),
(34, 'อุบลราชธานี'),
(35, 'ยโสธร'),
(36, 'ชัยภูมิ'),
(37, 'อำนาจเจริญ'),
(38, 'บึงกาฬ'),
(39, 'หนองบัวลำภู'),
(40, 'ขอนแก่น'),
(41, 'อุดรธานี'),
(42, 'เลย'),
(43, 'หนองคาย'),
(44, 'มหาสารคาม'),
(45, 'ร้อยเอ็ด'),
(46, 'กาฬสินธุ์'),
(47, 'สกลนคร'),
(48, 'นครพนม'),
(49, 'มุกดาหาร'),
(50, 'เชียงใหม่'),
(51, 'ลำพูน'),
(52, 'ลำปาง'),
(53, 'อุตรดิตถ์'),
(54, 'แพร่'),
(55, 'น่าน'),
(56, 'พะเยา'),
(57, 'เชียงราย'),
(58, 'แม่ฮ่องสอน'),
(60, 'นครสวรรค์'),
(61, 'อุทัยธานี'),
(62, 'กำแพงเพชร'),
(63, 'ตาก'),
(64, 'สุโขทัย'),
(65, 'พิษณุโลก'),
(66, 'พิจิตร'),
(67, 'เพชรบูรณ์'),
(70, 'ราชบุรี'),
(71, 'กาญจนบุรี'),
(72, 'สุพรรณบุรี'),
(73, 'นครปฐม'),
(74, 'สมุทรสาคร'),
(75, 'สมุทรสงคราม'),
(76, 'เพชรบุรี'),
(77, 'ประจวบคีรีขันธ์'),
(80, 'นครศรีธรรมราช'),
(81, 'กระบี่'),
(82, 'พังงา'),
(83, 'ภูเก็ต'),
(84, 'สุราษฎร์ธานี'),
(85, 'ระนอง'),
(86, 'ชุมพร'),
(90, 'สงขลา'),
(91, 'สตูล'),
(92, 'ตรัง'),
(93, 'พัทลุง'),
(94, 'ปัตตานี'),
(95, 'ยะลา'),
(96, 'นราธิวาส');

-- --------------------------------------------------------

--
-- Table structure for table `req_annouce`
--

CREATE TABLE `req_annouce` (
  `req_an_id` int(11) NOT NULL,
  `bn_toppic` varchar(45) NOT NULL,
  `bn_detail` varchar(45) NOT NULL,
  `bn_pic` varchar(99) NOT NULL,
  `users_id` int(11) NOT NULL,
  `req_status` int(11) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_annouce`
--

INSERT INTO `req_annouce` (`req_an_id`, `bn_toppic`, `bn_detail`, `bn_pic`, `users_id`, `req_status`, `timestamp`) VALUES
(1, 'ทดลองประชาสัมพันธ์1', 'ทดลองประชาสัมพันธ์1', 'banner/mkr9.jfif', 8, 2, '2022-04-08 14:03:25'),
(2, 'ประชาสัมพันธ์ตลาดใหม่', 'ประชาสัมพันธ์ตลาดใหม่', 'banner/mkr6.jpg', 8, 2, '2022-04-08 14:03:25'),
(3, 'ประชาสัมพันธ์ตลาดใหม่1', 'ประชาสัมพันธ์ตลาดใหม่1', 'banner/mkr3.jpg', 8, 1, '2022-04-08 14:03:25'),
(4, 'ทดลอง', 'ทดลองประชาสัมพัน', 'banner/mkr10.jpg', 9, 1, '2022-04-08 14:03:25'),
(12, '55555555', 'sdfghjklkjhgfd', 'sdfghjk', 9, 1, '2022-04-10 16:41:16'),
(13, '55555555', 'jhgfds', 'banner/mkr8.jpg', 9, 1, '2022-04-10 16:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `req_partner`
--

CREATE TABLE `req_partner` (
  `req_partner_id` int(11) NOT NULL,
  `market_name` varchar(100) NOT NULL,
  `market_address` varchar(100) NOT NULL,
  `market_descrip` varchar(300) NOT NULL,
  `market_pic` varchar(300) NOT NULL,
  `market_type_id` int(11) NOT NULL,
  `req_status_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `cardIDcpy` varchar(100) NOT NULL,
  `users_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_partner`
--

INSERT INTO `req_partner` (`req_partner_id`, `market_name`, `market_address`, `market_descrip`, `market_pic`, `market_type_id`, `req_status_id`, `firstName`, `lastName`, `email`, `tel`, `cardIDcpy`, `users_id`, `province_id`, `timestamp`) VALUES
(37, 'ตลาดของสหัสทยา', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'img_market/mkr1.jpg', 3, 2, 'สหัสทยา', 'เทียนมงคล', ' sahatthaya.t@kkumail.com', ' 098295538', 'img_idcard/id.jpg', 9, 40, '2022-04-08 14:04:10'),
(38, 'ตลาดของสุนิสา', ' เชียงใหม่', 'ทดลองกรอกข้อมูลตลาด', 'img_market/id.jpg', 3, 3, 'สุนิสา', 'ธิสารสังข์', ' sunisa.th@kkumail.com', ' 098999999', 'img_idcard/id.jpg', 9, 50, '2022-04-08 14:04:10'),
(39, 'ตลาดของสุนิสา2', ' เชียงใหม่', 'ทดลองกรอกข้อมูลตลาด', 'img_market/mkr2.jpg', 3, 2, 'สุนิสา', 'ธิสารสังข์', ' sunisa.th@kkumail.com', ' 098999999', 'img_idcard/id.jpg', 9, 50, '2022-04-08 14:04:10'),
(40, 'ตลาดทดลอง', ' ตลาดทดลอง', 'ตลาดทิพย์', 'img_market/mkr7.jpg', 2, 2, 'นายกอไก่', 'กุ๊กกู', ' pirk_lnw3@hotmail.com', ' 098765432', 'img_idcard/id.jpg', 8, 13, '2022-04-08 14:04:10'),
(41, 'ทดลองกรอก', ' ทดลองกรอก', 'ทดลองกรอก', 'img_market/mkr1.jpg', 2, 2, 'สหัสทยา', 'เทียนมงคล', ' sahatthaya.t@gmail.com', ' 098295538', 'img_idcard/id.jpg', 13, 40, '2022-04-08 14:04:10'),
(42, 'ตลาดเปิดท้าย', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'img_market/mkr5.jpg', 2, 1, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098295538', 'img_idcard/mkr4.jpg', 9, 10, '2022-04-08 14:04:10'),
(43, 'ตลาดเปิดท้ายsdfgh', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'img_market/64888250_2353375554705519_3003341342987255808_n.jpg', 2, 1, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098999999', 'img_idcard/mkr4.jpg', 14, 11, '2022-04-09 18:40:52'),
(44, 'ตลาดมุกุคิกๆคักๆ5555555555555555', ' kjhgfd', 'ทดลองกรอกข้อมูลตลาด', 'img_market/mkr7.jpg', 2, 1, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098295538', 'img_idcard/mkr4.jpg', 14, 12, '2022-04-09 18:41:14'),
(45, 'สหัสทยา', ' มข', 'ทดลองกรอกข้อมูลตลาด', 'img_market/mkr4.jpg', 2, 1, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098999999', 'img_idcard/mkr10.jpg', 14, 11, '2022-04-09 18:43:00'),
(46, 'ตลาดต้นตาล', ' ขอนแก่น', '17:00-23:59', 'img_market/tontan.jpg', 4, 1, 'ton', 'tan', ' tontan@gmail.com', ' 096321458', 'img_idcard/id.jpg', 20, 40, '2022-04-12 06:13:42'),
(47, 'ถนนคนเดินท่าแพ', ' เชียงใหม่', '17:00-22:00', 'img_market/tapae.jpg', 4, 2, 'ton', 'tan', ' tontan@gmail.com', ' 096321458', 'img_idcard/id.jpg', 20, 50, '2022-04-12 06:14:51'),
(48, 'ถนนคนเดินขอนแก่น ', ' ขอนแก่น', '17:00-23:59', 'img_market/sankamphaeng.png', 4, 1, 'jam', 'jam', ' jamjam@gmail.com', ' 096321458', 'img_idcard/id.jpg', 19, 40, '2022-04-12 06:58:19'),
(49, 'ตลาด', ' ขอนแก่น', '17:00-23:59', 'img_market/mkr1.jpg', 1, 1, 'jam', 'jam', ' jamjam@gmail.com', ' 096321458', 'img_idcard/id.jpg', 19, 40, '2022-04-12 06:58:52'),
(50, 'ถนนคนเดิน', ' ขอนแก่น', '17:00-23:59', 'img_market/sankamphaeng.png', 2, 1, 'pp', 'pp', ' ruby@gmail.com', ' 096321458', 'img_idcard/id.jpg', 19, 40, '2022-04-12 06:59:54'),
(51, 'ถนนคนเดิน2', ' ขอนแก่น', '17:00-23:59', 'img_market/mkr8.jpg', 1, 1, 'ta', 'pae', ' ruby@gmail.com', ' 096321458', 'img_idcard/mkr5.jpg', 19, 11, '2022-04-12 07:01:04');

-- --------------------------------------------------------

--
-- Table structure for table `req_status`
--

CREATE TABLE `req_status` (
  `req_status_id` int(11) NOT NULL,
  `req_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_status`
--

INSERT INTO `req_status` (`req_status_id`, `req_status`) VALUES
(1, 'รออนุมัติ'),
(2, 'อนุมัติ'),
(3, 'ไม่อนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `toppic`
--

CREATE TABLE `toppic` (
  `toppic_id` int(11) NOT NULL,
  `toppic` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toppic`
--

INSERT INTO `toppic` (`toppic_id`, `toppic`) VALUES
(1, 'ปัญหาความสะอาด'),
(2, 'ปัญหาพื้นที่'),
(3, 'ปัญหาสิ่งอำนวยความสะดวก'),
(4, 'ปัญหาสินค้าและบริการ'),
(5, 'ปัญหาอื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(10) NOT NULL,
  `username` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `username`, `firstName`, `lastName`, `password`, `email`, `tel`, `type`) VALUES
(7, 'admin', 'ผู้ดูแลระบบ', 'ผู้ดูแลระบบ', '751cb3f4aa17c36186f4856c8982bf27', 'admin@gmail.com', '0982955381', 3),
(8, 'Test1234', 'คนสวย', 'ไอที', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 'test@gmail.com', '0982955381', 2),
(9, 'prik', 'สหัสทยา', 'เทียนมงคล', 'e99246d0435963f025fcf84e60b84de7', 'admin@gmail.com', '0982955381', 2),
(13, 'maroon12345', 'พริก', 'มิสแกรนด์ขอนแก่น', 'df70fcf2344f857f22a423f03c2e44e9', 'maroon12345@hotmail.com', '0982955381', 2),
(14, 'testtest', 'ทดลอง', 'ทดลองจ้า', '05a671c66aefea124cc08b76ea6d30bb', 'test@gmail.com', '0982955381', 1),
(15, 'ryby', 'pampam@gmail.com', 'ppppp@gmail.com', '461e2c2d413f0f8dd6865f7f43d13647', 'pppyuyypp@gmail.com', '0963214587', 3),
(18, 'ruby', 'pam', 'thi', 'c9e7a0dde104f3a4f8c7af17e5ea667a', 'rubypp@gmail.com', '0963214588', 3),
(19, 'jaemin', 'jam', 'jam', 'd638f33ee8bd242995e2c420d3c05660', 'jamjam@gmail.com', '0987456321', 1),
(20, 'addmrk', 'ton', 'tan', '08be5f005efe3a35d6f5407ddbd6bf97', 'tontan@gmail.com', '0987654321', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userstype`
--

CREATE TABLE `userstype` (
  `userstype_id` int(1) NOT NULL,
  `userstype` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userstype`
--

INSERT INTO `userstype` (`userstype_id`, `userstype`) VALUES
(1, 'ผู้ใช้ทั่วไป'),
(2, 'เจ้าของตลาด'),
(3, 'ผู้ดูแลระบบ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`bn_id`);

--
-- Indexes for table `complain`
--
ALTER TABLE `complain`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `mkr_id` (`mkr_id`),
  ADD KEY `toppic` (`toppic_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `market_detail`
--
ALTER TABLE `market_detail`
  ADD PRIMARY KEY (`mkr_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `market_type_id` (`market_type_id`);

--
-- Indexes for table `market_type`
--
ALTER TABLE `market_type`
  ADD PRIMARY KEY (`market_type_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `req_annouce`
--
ALTER TABLE `req_annouce`
  ADD PRIMARY KEY (`req_an_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `req_status` (`req_status`);

--
-- Indexes for table `req_partner`
--
ALTER TABLE `req_partner`
  ADD PRIMARY KEY (`req_partner_id`),
  ADD KEY `market_type_id` (`market_type_id`),
  ADD KEY `req_status_id` (`req_status_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `province_id` (`province_id`);

--
-- Indexes for table `req_status`
--
ALTER TABLE `req_status`
  ADD PRIMARY KEY (`req_status_id`);

--
-- Indexes for table `toppic`
--
ALTER TABLE `toppic`
  ADD PRIMARY KEY (`toppic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `userstype`
--
ALTER TABLE `userstype`
  ADD PRIMARY KEY (`userstype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `bn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `market_detail`
--
ALTER TABLE `market_detail`
  MODIFY `mkr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `market_type`
--
ALTER TABLE `market_type`
  MODIFY `market_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `req_annouce`
--
ALTER TABLE `req_annouce`
  MODIFY `req_an_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `req_partner`
--
ALTER TABLE `req_partner`
  MODIFY `req_partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `req_status`
--
ALTER TABLE `req_status`
  MODIFY `req_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toppic`
--
ALTER TABLE `toppic`
  MODIFY `toppic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complain`
--
ALTER TABLE `complain`
  ADD CONSTRAINT `complain_ibfk_1` FOREIGN KEY (`mkr_id`) REFERENCES `market_detail` (`mkr_id`),
  ADD CONSTRAINT `complain_ibfk_3` FOREIGN KEY (`toppic_id`) REFERENCES `toppic` (`toppic_id`),
  ADD CONSTRAINT `complain_ibfk_4` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `market_detail`
--
ALTER TABLE `market_detail`
  ADD CONSTRAINT `market_detail_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `market_detail_ibfk_2` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`),
  ADD CONSTRAINT `market_detail_ibfk_3` FOREIGN KEY (`market_type_id`) REFERENCES `market_type` (`market_type_id`);

--
-- Constraints for table `req_annouce`
--
ALTER TABLE `req_annouce`
  ADD CONSTRAINT `req_annouce_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `req_annouce_ibfk_2` FOREIGN KEY (`req_status`) REFERENCES `req_status` (`req_status_id`);

--
-- Constraints for table `req_partner`
--
ALTER TABLE `req_partner`
  ADD CONSTRAINT `req_partner_ibfk_1` FOREIGN KEY (`market_type_id`) REFERENCES `market_type` (`market_type_id`),
  ADD CONSTRAINT `req_partner_ibfk_3` FOREIGN KEY (`req_status_id`) REFERENCES `req_status` (`req_status_id`),
  ADD CONSTRAINT `req_partner_ibfk_4` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `req_partner_ibfk_5` FOREIGN KEY (`province_id`) REFERENCES `province` (`province_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type`) REFERENCES `userstype` (`userstype_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
