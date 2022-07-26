-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 02:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

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
(57, 'ตลาดต้นตาล', ' “ตลาดต้นตาล ตลาดฝันของคนมีไอเดีย” โดยถูกสร้างขึ้นเพื่อเป็นศูนย์รวม ชิ้นงานศิลปะ ของสะสมที่แต่ละคนโปรดปราน สิ่งประดิษฐ์ หรือของที่คนชื่นชอบ คอเดียวกัน กลุ่มเล่านิทาน กลุ่มละคร กลุ่มเต้นรำ กลุ่มถ่ายภาพ กลุ่มนักแสดงเปิดหมวก กลุ่มดื่มเพื่อสุขภาพ กลุ่มรถคลาสสิคบิ๊กไบค์ ฯลฯ มาโชว์ มาอวด แลกเปลี่ยนผลงานแบ', 'asset/banner/ตลาดต้นตาลขอนแก่น.png', ''),
(58, 'ถนนคนเดิน เชียงใหม่', ' มาถึงเชียงใหม่กันทั้งที ห้ามพลาดที่จะเดินถนนคนเดินวัวลายเลยนะคะ เพราะบอกเลยว่าสินค้าท้องถิ่นเด็ดๆ จะมารวมกันที่นี่! สินค้าจากฝีมือชาวเขามากมายที่นำลงมาจำหน่ายด้านล่าง เช่น กระเป๋า เครื่องประดับ เครื่องเงิน เครื่องสานต่างๆ ซึ่งขายในราคาที่ไม่แพง ', 'asset/banner/ถนนคนเดินเชียงใหม่.png', ''),
(59, 'ตลาดไท', 'ตลาดไท ตลาดกลางการค้าส่ง สินค้าเกษตร ของประเทศไทย · ผักและผลไม้ · เนื้อสัตว์ ปลา & อาหารทะเล · ข้าวสาร · พืชไร่ · อาหารแห้ง & สินค้าเบ็ดเตล็ด · ดอกไม้ ต้นไม้', 'asset/banner/ตลาดไท.png', ''),
(61, 'ตลาดเปิดท้าย มข', 'เปิดท้าย', 'asset/banner/tapae.jpg', ''),
(64, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่', 'asset/banner/mkr3.jpg', ''),
(65, 'ทดลอง', 'ทดลองประชาสัมพัน', 'asset/banner/mkr10.jpg', ''),
(66, 'ตลาดต้นตาล', ' “ตลาดต้นตาล ตลาดฝันของคนมีไอเดีย” โดยถูกสร้างขึ้นเพื่อเป็นศูนย์รวม ชิ้นงานศิลปะ ของสะสมที่แต่ละคนโปรดปราน สิ่งประดิษฐ์ หรือของที่คนชื่นชอบ คอเดียวกัน กลุ่มเล่านิทาน กลุ่มละคร กลุ่มเต้นรำ กลุ่มถ่ายภาพ กลุ่มนักแสดงเปิดหมวก กลุ่มดื่มเพื่อสุขภาพ กลุ่มรถคลาสสิคบิ๊กไบค์ ฯลฯ มาโชว์ มาอวด แลกเปลี่ยนผลงานแบ', 'asset/banner/ตลาดต้นตาลขอนแก่น.png', ''),
(67, 'ถนนคนเดิน เชียงใหม่', ' มาถึงเชียงใหม่กันทั้งที ห้ามพลาดที่จะเดินถนนคนเดินวัวลายเลยนะคะ เพราะบอกเลยว่าสินค้าท้องถิ่นเด็ดๆ จะมารวมกันที่นี่! สินค้าจากฝีมือชาวเขามากมายที่นำลงมาจำหน่ายด้านล่าง เช่น กระเป๋า เครื่องประดับ เครื่องเงิน เครื่องสานต่างๆ ซึ่งขายในราคาที่ไม่แพง ', 'asset/banner/ถนนคนเดินเชียงใหม่.png', ''),
(68, 'ตลาดไท', 'ตลาดไท ตลาดกลางการค้าส่ง สินค้าเกษตร ของประเทศไทย · ผักและผลไม้ · เนื้อสัตว์ ปลา & อาหารทะเล · ข้าวสาร · พืชไร่ · อาหารแห้ง & สินค้าเบ็ดเตล็ด · ดอกไม้ ต้นไม้', 'asset/banner/ตลาดไท.png', ''),
(69, 'ตลาดเปิดท้าย มข', 'เปิดท้าย', 'asset/banner/tapae.jpg', ''),
(70, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่', 'asset/banner/mkr3.jpg', ''),
(83, 'ทดลองประชาสัมพันธ์1', 'ทดลองประชาสัมพันธ์1', 'asset/banner/mkr9.jfif', ''),
(84, 'ประชาสัมพันธ์ตลาดใหม่', 'ประชาสัมพันธ์ตลาดใหม่', 'asset/banner/mkr6.jpg', ''),
(85, 'ประชาสัมพันธ์ตลาดใหม่1', 'ประชาสัมพันธ์ตลาดใหม่1', 'asset/banner/mkr3.jpg', ''),
(86, 'ทดลอง', 'ทดลองประชาสัมพัน', 'asset/banner/mkr10.jpg', ''),
(87, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/IMG_3393.jpeg', ''),
(96, 'ทดลองประชาสัมพันธ์1', 'ทดลองประชาสัมพันธ์1', 'asset/banner/mkr9.jfif', ''),
(97, 'ประชาสัมพันธ์ตลาดใหม่', 'ประชาสัมพันธ์ตลาดใหม่', 'asset/banner/mkr6.jpg', '');

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
(35, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า สกปรกมากค่ะ ช่วยดูแลด้วย', '2022-04-17 17:10:04', 23, 1, 'asset/complain/NjpUs24nCQKx5e1D7drWjErXXAaumqP8vwyCPvc8A9N.jpg', 21, 1, 'ไม่มีการตอบกลับ'),
(36, 'ห้องน้ำชำรุด', 'ห้องน้ำชำรุดทุกห้อง ไม่มีที่เข้าห้องน้ำจ้า ช่วยแก้ไขด้วย', '2022-04-17 17:10:36', 22, 3, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(37, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า สกปรกมากค่ะ ช่วยดูแลด้วย', '2022-04-17 17:10:04', 20, 1, 'asset/complain/NjpUs24nCQKx5e1D7drWjErXXAaumqP8vwyCPvc8A9N.jpg', 21, 1, 'ไม่มีการตอบกลับ'),
(38, 'ห้องน้ำชำรุด', 'ห้องน้ำชำรุดทุกห้อง ไม่มีที่เข้าห้องน้ำจ้า ช่วยแก้ไขด้วย', '2022-04-17 17:10:36', 19, 3, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(39, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า สกปรกมากค่ะ ช่วยดูแลด้วย', '2022-04-17 17:10:04', 15, 1, 'asset/complain/NjpUs24nCQKx5e1D7drWjErXXAaumqP8vwyCPvc8A9N.jpg', 21, 1, 'ไม่มีการตอบกลับ'),
(40, 'ห้องน้ำชำรุด', 'ห้องน้ำชำรุดทุกห้อง ไม่มีที่เข้าห้องน้ำจ้า ช่วยแก้ไขด้วย', '2022-04-17 17:10:36', 16, 3, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(41, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า สกปรกมากค่ะ ช่วยดูแลด้วย', '2022-04-17 17:10:04', 11, 1, 'asset/complain/NjpUs24nCQKx5e1D7drWjErXXAaumqP8vwyCPvc8A9N.jpg', 21, 1, 'ไม่มีการตอบกลับ'),
(42, 'ห้องน้ำชำรุด', 'ห้องน้ำชำรุดทุกห้อง ไม่มีที่เข้าห้องน้ำจ้า ช่วยแก้ไขด้วย', '2022-04-17 17:10:36', 6, 3, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(43, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางกรุณาแก้ไขด้วยค่ะ', '2022-04-18 04:04:14', 21, 1, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(44, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางกรุณาแก้ไขด้วยค่ะ', '2022-04-18 04:04:18', 21, 1, 'asset/complain/nopicture.png', 21, 1, 'ไม่มีการตอบกลับ'),
(45, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า กรุณษแก้ไขด้วยค่ะ', '2022-04-18 05:30:27', 25, 1, 'asset/complain/sankamphaeng.png', 22, 1, 'ไม่มีการตอบกลับ'),
(46, 'ขยะเต็มทางเท้า', 'ขยะเต็มทางเท้า กรุณษแก้ไขด้วยค่ะ', '2022-04-18 05:30:30', 25, 1, 'asset/complain/sankamphaeng.png', 22, 1, 'ไม่มีการตอบกลับ'),
(49, 'test', '516', '2022-07-22 10:40:49', 26, 1, 'asset/complain/202207221071315292.jpg', 23, 1, 'ไม่มีการตอบกลับ'),
(51, 'test', '516', '2022-07-22 10:42:13', 26, 1, 'asset/complain/202207221276638091.jpg', 23, 1, 'ไม่มีการตอบกลับ'),
(52, 'test', '516', '2022-07-22 10:44:44', 26, 1, 'asset/complain/20220722954422169.jpg', 23, 1, 'ไม่มีการตอบกลับ');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
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

INSERT INTO `contact` (`contact_id`, `ct_logo`, `ct1_fname`, `ct1_lname`, `ct1_email`, `ct1_tel`, `ct1_pic`, `ct2_fname`, `ct2_lname`, `ct2_email`, `ct2_tel`, `ct2_pic`) VALUES
(1, 'asset/contact/202207121990051213.png', 'สุนิสา', 'ธิสารสังข์', 'sunisa.t@kkumail.com', '08x-xxx-xx', 'asset/contact/240057162_3280841175476230_8639066623628243934_n.jpg', 'สหัสทยา', 'เทียนมงคล', 'sahatthaya.t@kkumail.com', '0982955381', 'asset/contact/64888250_2353375554705519_3003341342987255808_n.jpg');

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
(6, 'ตลาดต้นตาล', 'ขอนแก่น', '“ตลาดต้นตาล ตลาดฝันของคนมีไอเดีย” โดยถูกสร้าง', 'asset/img_market/tontan.jpg', 4, 40, 8, 'sahatthaya.t@gmail.com', '0982955381'),
(9, 'ถนนคนเดินวัวลาย', ' เชียงใหม่', 'ถนนคนเดินวัวลาย เป็นที่ตั้งของหมู่บ้านทำเครื่', 'asset/img_market/wualai.png', 4, 50, 8, '', '0834827759'),
(10, 'ถนนคนเดินท่าแพ', ' เชียงใหม่', 'ถนนคนเดินท่าแพ เป็นถนนคนเดินที่ใหญ่ที่สุดในเช', 'asset/img_market/tapae.jpg', 4, 50, 20, '', '081 952 32'),
(11, 'ถนนคนเดินสันกำแพง', ' เชียงใหม่', '“ถนนคนเดินสันกำแพง” ตั้งอยู่ที่ ถนนเชียงใหม่-', 'asset/img_market/sankamphaeng.png', 4, 50, 9, '', '0886564535'),
(12, 'ถนนคนเดินเชียงคาน', 'Chai Kong, Chiang Khan, Chiang Khan District,', 'ถนนคนเดินเชียงคาน สีสันแห่งการมาเที่ยวเชียงคา', 'asset/img_market/chiangkhan.jpg', 4, 42, 13, 'sahatthaya.t@gmail.com', '0637323245'),
(15, 'ถนนคนเดินขอนแก่น ', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/sankamphaeng.png', 4, 40, 19, ' jamjam@gmail.com', ' 096321458'),
(16, 'ตลาดเปิดท้าย มข', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/20220726557016398.jpg', 2, 10, 9, ' sahatthaya.t@kkumail.com', ' 098295538'),
(19, '. ศูนย์การค้ายูดีทาวน์แ', '  88 ถ.ทองใหญ่ ต.หมากแข้ง เมืองอุดรธานีอุดรธา', 'แหล่งท่องเที่ยวใน จ.อุดรธานี(UD TOWN : Enjoy ', 'asset/img_market/IMG_3394.jpeg', 4, 41, 9, ' admin@gmail.com', ' 098295538'),
(20, 'ถนนคนเดิน อุดรธานี', ' :ตำบลหมากแข้งอำเภอเมืองอุดรธานีจังหวัด', 'สถานที่ท่องเที่ยวตลาดท้องถิ่น', 'asset/img_market/IMG_3396.jpeg', 4, 41, 9, ' admin@gmail.com', ' 098295538'),
(21, 'ถนนคนเดิน ขอนแก่น', ' ซอยหน้าศูนย์ราชการ ต.ในเมืองอ.เมืองจ.ขอนแก่น', 'สินค้าประเภท สินค้าท าด้วยมืองานศิลปะ งาน หัต', 'asset/img_market/IMG_3397.jpeg', 2, 40, 9, ' admin@gmail.com', ' 098295538'),
(22, '. ถนนคนเดินเชียงคาน', '  ตำบลเชียงคาน เชียงคาน เลย', 'น สีสันแห่งการมาเที่ยวเชียงคานที่เริ่มตั้งแต่', 'asset/img_market/IMG_3398.jpeg', 2, 42, 9, ' admin@gmail.com', ' 098295538'),
(23, ' ตลาดหัวมุม', ' ที่ตลาดหัวมุมเป็นแหล่งช้อปปิ้งสุดชิคที่รวมทุ', ' เลขที่678 ถนนประเสริฐมนูกิจแขวงลาดพร้าว เขตล', 'asset/img_market/IMG_3399.jpeg', 4, 10, 9, ' admin@gmail.com', ' 098295538'),
(24, 'ถนนคนเดิน2', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/mkr8.jpg', 1, 11, 19, ' ruby@gmail.com', ' 096321458'),
(25, 'ถนนคนเดิน', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/sankamphaeng.png', 2, 40, 19, ' ruby@gmail.com', ' 096321458'),
(26, 'สหัสทยา', ' มข', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/mkr4.jpg', 2, 11, 14, ' sahatthaya.t@kkumail.com', ' 098999999'),
(27, 'ตลาดโดมเขียว', ' จ.สุรินทร์', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้ง', 'asset/img_market/mkr4.jpg', 4, 32, 21, ' sahatthaya.t@gmail.com', ' 098295538'),
(28, 'ตลาดมอดินแดง', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้ง', 'asset/img_market/mkr5.jpg', 4, 40, 9, ' admin@gmail.com', ' 098295538'),
(29, 'ตลาดโดมเขียว', ' จังหวัดสุรินทร์', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้ง', 'asset/img_market/mkr8.jpg', 4, 32, 22, ' sahatthaya.t@gmail.com', ' 098295538');

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
  `req_status_id` int(11) NOT NULL DEFAULT 1,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `req_annouce`
--

INSERT INTO `req_annouce` (`req_an_id`, `bn_toppic`, `bn_detail`, `bn_pic`, `users_id`, `req_status_id`, `timestamp`) VALUES
(1, 'ทดลองประชาสัมพันธ์1', 'ทดลองประชาสัมพันธ์1', 'asset/banner/mkr9.jfif', 8, 3, '2022-04-08 14:03:25'),
(2, 'ประชาสัมพันธ์ตลาดใหม่', 'ประชาสัมพันธ์ตลาดใหม่', 'asset/banner/mkr6.jpg', 8, 3, '2022-04-08 14:03:25'),
(3, 'ประชาสัมพันธ์ตลาดใหม่1', 'ประชาสัมพันธ์ตลาดใหม่1', 'asset/banner/mkr3.jpg', 8, 3, '2022-04-08 14:03:25'),
(4, 'ทดลอง', 'ทดลองประชาสัมพัน', 'asset/banner/mkr10.jpg', 9, 2, '2022-04-08 14:03:25'),
(16, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 3, '2022-04-18 04:22:41'),
(17, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 3, '2022-04-18 04:24:20'),
(18, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/IMG_3393.jpeg', 9, 2, '2022-04-18 05:38:11'),
(19, 'ทดลองประชาสัมพันธ์1', 'ทดลองประชาสัมพันธ์1', 'asset/banner/mkr9.jfif', 8, 2, '2022-04-08 14:03:25'),
(20, 'ประชาสัมพันธ์ตลาดใหม่', 'ประชาสัมพันธ์ตลาดใหม่', 'asset/banner/mkr6.jpg', 8, 2, '2022-04-08 14:03:25'),
(21, 'ประชาสัมพันธ์ตลาดใหม่1', 'ประชาสัมพันธ์ตลาดใหม่1', 'asset/banner/mkr3.jpg', 8, 3, '2022-04-08 14:03:25'),
(22, 'ทดลอง', 'ทดลองประชาสัมพัน', 'asset/banner/mkr10.jpg', 9, 1, '2022-04-08 14:03:25'),
(23, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 1, '2022-04-18 04:22:41'),
(24, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 1, '2022-04-18 04:24:20'),
(25, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/IMG_3393.jpeg', 9, 1, '2022-04-18 05:38:11'),
(26, 'ทดลอง', 'ทดลองประชาสัมพัน', 'asset/banner/mkr10.jpg', 9, 1, '2022-04-08 14:03:25'),
(27, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 1, '2022-04-18 04:22:41'),
(28, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/mkr7.jpg', 9, 1, '2022-04-18 04:24:20'),
(29, 'ตลาดมอดินแดงปรับปรุงใหม่', 'ตลาดมอดินแดงปรับปรุงใหม่ ราคาเดิม', 'asset/banner/IMG_3393.jpeg', 9, 1, '2022-04-18 05:38:11'),
(30, 'sdfghj', 'dfghyjuki', 'banner/mkr-1.png', 9, 1, '2022-07-23 05:05:17'),
(31, 'sdfghj', 'dfghyjuki', 'asset/banner/20220723432805262.png', 9, 1, '2022-07-23 05:07:05');

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
(37, 'ตลาดของสหัสทยา', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/mkr1.jpg', 3, 2, 'สหัสทยา', 'เทียนมงคล', ' sahatthaya.t@kkumail.com', ' 098295538', 'asset/img_idcard/id.jpg', 9, 40, '2022-04-08 14:04:10'),
(38, 'ตลาดของสุนิสา', ' เชียงใหม่', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/id.jpg', 3, 3, 'สุนิสา', 'ธิสารสังข์', ' sunisa.th@kkumail.com', ' 098999999', 'asset/img_idcard/id.jpg', 9, 50, '2022-04-08 14:04:10'),
(39, 'ตลาดของสุนิสา2', ' เชียงใหม่', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/mkr2.jpg', 3, 2, 'สุนิสา', 'ธิสารสังข์', ' sunisa.th@kkumail.com', ' 098999999', 'asset/img_idcard/id.jpg', 9, 50, '2022-04-08 14:04:10'),
(40, 'ตลาดทดลอง', ' ตลาดทดลอง', 'ตลาดทิพย์', 'asset/img_market/mkr7.jpg', 2, 2, 'นายกอไก่', 'กุ๊กกู', ' pirk_lnw3@hotmail.com', ' 098765432', 'asset/img_idcard/id.jpg', 8, 13, '2022-04-08 14:04:10'),
(41, 'ทดลองกรอก', ' ทดลองกรอก', 'ทดลองกรอก', 'asset/img_market/mkr1.jpg', 2, 2, 'สหัสทยา', 'เทียนมงคล', ' sahatthaya.t@gmail.com', ' 098295538', 'asset/img_idcard/id.jpg', 13, 40, '2022-04-08 14:04:10'),
(42, 'ตลาดเปิดท้าย', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/mkr5.jpg', 2, 2, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098295538', 'asset/img_idcard/mkr4.jpg', 9, 10, '2022-04-08 14:04:10'),
(45, 'สหัสทยา', ' มข', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/mkr4.jpg', 2, 2, 'sahat', 'thaya', ' sahatthaya.t@kkumail.com', ' 098999999', 'asset/img_idcard/mkr10.jpg', 14, 11, '2022-04-09 18:43:00'),
(46, 'ตลาดต้นตาล', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/tontan.jpg', 4, 3, 'ton', 'tan', ' tontan@gmail.com', ' 096321458', 'asset/img_idcard/id.jpg', 20, 40, '2022-04-12 06:13:42'),
(47, 'ถนนคนเดินท่าแพ', ' เชียงใหม่', '17:00-22:00', 'asset/img_market/tapae.jpg', 4, 2, 'ton', 'tan', ' tontan@gmail.com', ' 096321458', 'asset/img_idcard/id.jpg', 20, 50, '2022-04-12 06:14:51'),
(48, 'ถนนคนเดินขอนแก่น ', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/sankamphaeng.png', 4, 2, 'jam', 'jam', ' jamjam@gmail.com', ' 096321458', 'asset/img_idcard/id.jpg', 19, 40, '2022-04-12 06:58:19'),
(49, 'ตลาด', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/mkr1.jpg', 1, 3, 'jam', 'jam', ' jamjam@gmail.com', ' 096321458', 'asset/img_idcard/id.jpg', 19, 40, '2022-04-12 06:58:52'),
(50, 'ถนนคนเดิน', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/sankamphaeng.png', 2, 2, 'pp', 'pp', ' ruby@gmail.com', ' 096321458', 'asset/img_idcard/id.jpg', 19, 40, '2022-04-12 06:59:54'),
(51, 'ถนนคนเดิน2', ' ขอนแก่น', '17:00-23:59', 'asset/img_market/mkr8.jpg', 1, 2, 'ta', 'pae', ' ruby@gmail.com', ' 096321458', 'asset/img_idcard/mkr5.jpg', 19, 11, '2022-04-12 07:01:04'),
(55, '', ' ลานจอดรถ หอกาญนาพิเษก มหาวิทยาลัยขอนแก่น', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้งอยู่บริเวณลานจอดรถด้านศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก มี เฉพาะวันศุกร์-อาทิตย์เวลา17.00-22.00 น. แต่ก็ไม่ได้มีทุกอาทิตย์นะคะ (เพื่อน ๆ สามารถติดตามข่าวสารได้ที่ เปิดท้ายหอ กาญ มข. เลยจ้า)', 'asset/img_market/IMG_3393.jpeg', 2, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 40, '2022-04-17 15:35:05'),
(56, '. ศูนย์การค้ายูดีทาวน์แ', '  88 ถ.ทองใหญ่ ต.หมากแข้ง เมืองอุดรธานีอุดรธานี41000', 'แหล่งท่องเที่ยวใน จ.อุดรธานี(UD TOWN : Enjoy More Everyday ) โอเพ่นแอร์มอลล์(Openair Mall) บนพื ้นที่ขนาดใหญ่ที่สุดแห่งแรกในประเทศไทย กับความเป็นศูนย์กลางของไลฟ์ สไตล์และประสบการณ์ระดับพรี เมี่ยมแห่งอินโดจีน พรั่งพร้อมทั้งความสมบูรณ์แบบของโลเคชั่นใจกลางเมือง', 'asset/img_market/IMG_3394.jpeg', 4, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 41, '2022-04-17 15:36:01'),
(57, 'ถนนคนเดิน จังหวัดอุดรธานี', ' :ตำบลหมากแข้งอำเภอเมืองอุดรธานีจังหวัด', 'สถานที่ท่องเที่ยวตลาดท้องถิ่น', 'asset/img_market/IMG_3396.jpeg', 4, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 41, '2022-04-17 15:37:05'),
(58, 'ถนนคนเดิน ขอนแก่น', ' ซอยหน้าศูนย์ราชการ ต.ในเมืองอ.เมืองจ.ขอนแก่น เมืองขอนแก่น ขอนแก่น 40000', 'สินค้าประเภท สินค้าท าด้วยมืองานศิลปะ งาน หัตถกรรม งานอนุรักษ์สิ่งแวดล้อมและประหยัดพลังงาน ที่เน้นงานขายไอเดียและงานสร้างสรรค์ราคาสินค้ามีตั้งแต่10 - 5000 บาทค่ะ', 'asset/img_market/IMG_3397.jpeg', 2, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 40, '2022-04-17 15:37:57'),
(59, '. ถนนคนเดินเชียงคาน', '  ตำบลเชียงคาน เชียงคาน เลย', 'น สีสันแห่งการมาเที่ยวเชียงคานที่เริ่มตั้งแต่ยามเย็นจนพลบค ่า เป็นถนนทางเดินทอดยาวพาดผ่าน บ้านเรือนไม้เก่าแก่ ทั้งสองข้างทางมีทั้งร้านขายของกินร้านค้าสินค้าพื ้นเมือง และของที่ระลึกต่างๆตลอดแนวทางเดิน ถนนคน เดินเชียงคาน ตั้งอยู่ถนนศรีเชียงคานสายล่างใกล้กับแม่น ้าโขง เริ่มต้นตั้งแต่วัดท่าครกไปจนถึงวั', 'asset/img_market/IMG_3398.jpeg', 2, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 42, '2022-04-17 15:38:51'),
(60, ' ตลาดหัวมุม (Huamum Market) ', ' ที่ตลาดหัวมุมเป็นแหล่งช้อปปิ้งสุดชิคที่รวมทุก ความต้องการ เสื ้อผ้า accessorry ของตกแต่ง ของใช้ของป', ' เลขที่678 ถนนประเสริฐมนูกิจแขวงลาดพร้าว เขตลาดพร้าว, กรุงเทพฯ', 'asset/img_market/IMG_3399.jpeg', 4, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 10, '2022-04-17 15:39:49'),
(61, 'ตลาดโดมเขียว', ' จ.สุรินทร์', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้งอยู่บริเวณลานจอดรถด้านศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก มี เฉพาะวันศุกร์-อาทิตย์เวลา17.00-22.00 น. แต่ก็ไม่ได้มีทุกอาทิตย์นะคะ (เพื่อน ๆ สามารถติดตามข่าวสารได้ที่ เปิดท้ายหอ กาญ มข. เลยจ้า)', 'asset/img_market/mkr4.jpg', 4, 2, 'สหัสทยา', 'เทียมมงคล', ' sahatthaya.t@gmail.com', ' 098295538', 'asset/idcard/id.jpg', 21, 32, '2022-04-18 04:06:21'),
(62, 'ตลาดมอดินแดง', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้งอยู่บริเวณลานจอดรถด้านศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก มี เฉพาะวันศุกร์-อาทิตย์เวลา17.00-22.00 น. แต่ก็ไม่ได้มีทุกอาทิตย์นะคะ (เพื่อน ๆ สามารถติดตามข่าวสารได้ที่ เปิดท้ายหอ กาญ มข. เลยจ้า)', 'asset/img_market/mkr5.jpg', 4, 2, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/id.jpg', 9, 40, '2022-04-18 04:21:46'),
(63, 'ตลาดโดมเขียว', ' จังหวัดสุรินทร์', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้งอยู่บริเวณลานจอดรถด้านศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก มี เฉพาะวันศุกร์-อาทิตย์เวลา17.00-22.00 น. แต่ก็ไม่ได้มีทุกอาทิตย์นะคะ (เพื่อน ๆ สามารถติดตามข่าวสารได้ที่ เปิดท้ายหอ กาญ มข. เลยจ้า)', 'asset/img_market/mkr8.jpg', 4, 2, 'สหัสทยา', 'เทียนมงคล', ' sahatthaya.t@gmail.com', ' 098295538', 'asset/idcard/id.jpg', 22, 32, '2022-04-18 05:32:03'),
(64, 'ตลาดมอดินแดง', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ตลาดเปิดท้าย ที่เที่ยวมหาวิทยาลัยขอนแก่น ตั้งอยู่บริเวณลานจอดรถด้านศูนย์ประชุมอเนกประสงค์กาญจนาภิเษก มี เฉพาะวันศุกร์-อาทิตย์เวลา17.00-22.00 น. แต่ก็ไม่ได้มีทุกอาทิตย์นะคะ (เพื่อน ๆ สามารถติดตามข่าวสารได้ที่ เปิดท้ายหอ กาญ มข. เลยจ้า)', 'asset/img_market/IMG_3393.jpeg', 1, 3, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/', 9, 40, '2022-04-18 05:37:41'),
(65, 'sdfg', ' sdfghjk', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/467978241.png', 2, 2, 'sfdghjkl', 'adsfghjkl;', ' sahatthaya.t@gmail.com', ' 098999999', 'asset/idcard/467978241.png', 23, 12, '2022-07-19 12:37:54'),
(66, 'sdfg', ' sdfghjk', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/202207191541995611.png', 2, 2, 'sfdghjkl', 'adsfghjkl;', ' sahatthaya.t@gmail.com', ' 098999999', 'asset/idcard/202207191541995611.png', 23, 12, '2022-07-19 12:38:17'),
(67, 'ตลาดเปิดท้าย', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/202207191266434879.png', 3, 2, 'azxcvbnm,', 'sdgfhjk', ' sahatthaya.t@kkumail.com', ' 098295538', 'asset/idcard/202207191266434879.png', 23, 11, '2022-07-19 12:39:28'),
(68, 'ตลาดเปิดท้าย', ' 123 ขอนแก่น มหาวิทยาลัยขอนแก่น 40000', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/20220719650411792.png', 3, 1, 'azxcvbnm,', 'sdgfhjk', ' sahatthaya.t@kkumail.com', ' 098295538', 'asset/idcard/20220719650411792.png', 23, 11, '2022-07-19 12:39:32'),
(72, 'jhgfd', ' เมือง ลพบุรี', 'hgfd', 'asset/img_market/202207221535536878.jpg', 1, 1, 'sdfgh', 'dfghj', ' sahatthaya.t@gmail.com', ' 098295538', 'asset/idcard/202207221535536878.jpg', 23, 10, '2022-07-22 10:45:38'),
(73, 'zxdcfghjkl', ' มข', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/202207261641852995.png', 1, 1, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/202207261641852995.png', 9, 11, '2022-07-26 11:03:16'),
(74, 'zxdcfghjkl', ' มข', 'ทดลองกรอกข้อมูลตลาด', 'asset/img_market/202207261148222437.png', 1, 1, 'สหัสทยา', 'เทียนมงคล', ' admin@gmail.com', ' 098295538', 'asset/idcard/202207261148222437.png', 9, 11, '2022-07-26 11:03:49');

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
(14, 'testtest', 'ทดลอง', 'ทดลองจ้า', 'd41d8cd98f00b204e9800998ecf8427e', 'test@gmail.com', '0982955381', 2),
(15, 'ryby', 'pampam@gmail.com', 'ppppp@gmail.com', '461e2c2d413f0f8dd6865f7f43d13647', 'pppyuyypp@gmail.com', '0963214587', 3),
(19, 'jaemin', 'jam', 'jam', 'd638f33ee8bd242995e2c420d3c05660', 'jamjam@gmail.com', '0987456321', 2),
(20, 'addmrk', 'ton', 'tan', '08be5f005efe3a35d6f5407ddbd6bf97', 'tontan@gmail.com', '0987654321', 2),
(21, '12345', 'sahat', 'thaya', '25d55ad283aa400af464c76d713c07ad', 'admin@gmail.com', '0982955381', 2),
(22, 'sahatthaya08', 'สหัสทยา', 'เทียนมงคล', '25d55ad283aa400af464c76d713c07ad', 'sahatthaya.t@gmail.com', '0982955381', 2),
(23, 'pixel', 'axcvb', 'f', 'e99246d0435963f025fcf84e60b84de7', 'test@gmail.com', '0982955381', 1);

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

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
  ADD KEY `req_status` (`req_status_id`);

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
  MODIFY `bn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `complain`
--
ALTER TABLE `complain`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `market_detail`
--
ALTER TABLE `market_detail`
  MODIFY `mkr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `req_an_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `req_partner`
--
ALTER TABLE `req_partner`
  MODIFY `req_partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
  MODIFY `users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  ADD CONSTRAINT `req_annouce_ibfk_2` FOREIGN KEY (`req_status_id`) REFERENCES `req_status` (`req_status_id`);

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
