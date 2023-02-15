-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2020 at 04:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samosystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `amont_of_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `date`, `activity_name`, `amont_of_time`) VALUES
(5, '2020-03-21', 'วิศวะฮาเฮ', 4),
(7, '2020-03-01', 'วิ่งเกียร์', 7),
(8, '2020-03-02', 'เข้าค่าย', 8),
(9, '2020-03-03', 'สอนน้องร้องเพลง', 3),
(10, '2020-03-04', 'ซ้อมสอนน้องร้องเพลง', 4);

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `award_id` int(11) NOT NULL,
  `award_name` varchar(255) NOT NULL,
  `picture` varchar(45) NOT NULL,
  `amont_of_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`award_id`, `award_name`, `picture`, `amont_of_time`) VALUES
(1, 'เกียร์', '4cb9d970cef36982fa26731cc0b28af3.jpg', 80),
(2, 'เข็มขัด', '3bac24ac04d68dca919ba1d2c7e6dac2.jpg', 60),
(3, 'เสื้อช็อป', '82d0f3d9e5456ebe81c3a82ba87c11be.jpg', 80),
(4, 'ไทด์', '02af66ecd95267e6a689a668907ca6bb.jpg', 100);

-- --------------------------------------------------------

--
-- Table structure for table `checkaward`
--

CREATE TABLE `checkaward` (
  `checkaward_id` int(11) NOT NULL,
  `award_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkaward`
--

INSERT INTO `checkaward` (`checkaward_id`, `award_id`, `activity_id`) VALUES
(4, 1, 7),
(5, 1, 8),
(6, 1, 9),
(7, 1, 10),
(11, 3, 9),
(12, 4, 5),
(13, 3, 8),
(14, 2, 10),
(21, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `checkname`
--

CREATE TABLE `checkname` (
  `checkname_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `check_activity` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkname`
--

INSERT INTO `checkname` (`checkname_id`, `activity_id`, `list_id`, `check_activity`) VALUES
(12, 7, 603, '1'),
(20, 10, 607, '1'),
(21, 10, 608, '1'),
(22, 9, 607, '1'),
(23, 8, 607, '1'),
(24, 9, 603, '1'),
(28, 5, 607, '1'),
(31, 7, 607, '1'),
(36, 8, 603, '1'),
(38, 5, 603, '1'),
(43, 9, 608, '1'),
(44, 5, 608, '1');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `list_id` int(11) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `major_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`list_id`, `student_id`, `student_name`, `major_id`) VALUES
(603, '6030300920', 'วัชรวิทย์ อยู่ทอง', 1),
(607, '6030300628', 'ปาณัสม์ มูหะหมัด', 1),
(608, '6030301152', 'อนันต์วิชญ์ ล้อวัฒนาดุล', 4),
(609, '6030301187', 'อิทธิกร วิเศษพงษ์', 1),
(992, '6030300924', 'ปัณณวัชร์ ธนาภิรมย์โภคินน', 1),
(1081, '6230300028', 'กฤษณพล จุ้ยประเสริฐ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `major_id` int(11) NOT NULL,
  `major_code` varchar(11) NOT NULL,
  `major_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`major_id`, `major_code`, `major_name`) VALUES
(1, 'T12', 'CPE'),
(2, 'T13', 'ME'),
(3, 'T05', 'CE'),
(4, 'T14', 'EE'),
(5, 'T18', 'MME'),
(6, 'T17', 'IE'),
(7, 'T19', 'RASE');

-- --------------------------------------------------------

--
-- Table structure for table `palace`
--

CREATE TABLE `palace` (
  `palace_id` int(11) NOT NULL,
  `student_id` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `major_id` int(11) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `picture` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `palace`
--

INSERT INTO `palace` (`palace_id`, `student_id`, `name`, `major_id`, `rank`, `picture`) VALUES
(24, '6030300920', 'วัชรวิทย์ อยู่ทอง', 1, '11', 'd202e18354431661c073e4ba206d05ee.jpg'),
(26, '6030300628', 'ปาณัสม์ มูหะหมัด', 1, '10', '6890533628489da398fb1efd74d74055.jpg'),
(27, '6030301152', 'อนันต์วิชญ์ ล้อวัฒนาดุล', 4, '17', '07c43f17bed4022ad243bd54cd86d780.jpg'),
(28, '6030301187', 'อิทธิกร วิเศษพงษ์', 1, '23', 'c1e355ee601c367075f666a22c0bafff.jpg'),
(29, '6030300028', 'กฤษณพล จุ้ยประเสริฐ', 2, 'เเม่บ้าน', '6ed75775121e94f860355410f30dc0e6.jpg'),
(30, '6030300082', 'กรธวัช สุวรรณากุล', 2, '12', 'd28bfac9377a308c50c1977c8ffe3986.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `time` varchar(45) NOT NULL,
  `schedule_name` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `activity_id`, `time`, `schedule_name`, `note`) VALUES
(14, 5, '20:00', 'ขึ้นสเเตน', '-'),
(15, 7, '08:00', 'กินข้าว', 'โรงอาหาร'),
(17, 5, '10:00', 'กินข้าว', 'อาคาร23'),
(18, 7, '09:00', 'เริ่มวิ่งรอบที่1', '-'),
(19, 7, '10:00', 'พัก เบรก', '-'),
(20, 7, '11:00', 'เริ่มวิ่งรอบที่2', '-'),
(21, 7, '12:00', 'กินข้าว', '-'),
(22, 7, '13:00', 'เริ่มวิ่งรอบที่3', '-'),
(23, 7, '16:00', 'เสร็จสิ้นกิจกรรม', '-'),
(24, 8, '08:00', 'เดินทาง', 'เช็คชื่อก่อนขึ้นรถ เดินทาง'),
(25, 8, '10:00', 'ถึงจุดหมายปลายทาง', '-'),
(26, 8, '12:00', 'กินข้าว', '-'),
(27, 9, '14:00', 'เข้าเเถว', '-'),
(28, 9, '15:00', 'เริ่มกิจกรรมสอนน้องร้องเพลง', '-'),
(29, 9, '19:00', 'เสร็จกิจกรรมสอนน้องรองเพลง', '-'),
(30, 10, '19:00', 'เช็คชื่อ', '-'),
(31, 10, '20:00', 'เริ่มฝึกร้องเพลง', '-'),
(32, 5, '22:00', 'เสร็จสิ้นกิจกรรม', '-');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL,
  `pic` varchar(45) CHARACTER SET utf16 NOT NULL,
  `name` varchar(255) CHARACTER SET utf16 NOT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(255) CHARACTER SET utf16 NOT NULL,
  `status` varchar(45) CHARACTER SET utf16 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `pic`, `name`, `price`, `detail`, `status`) VALUES
(8, '96db4c0756babd9b6ebfa0e771b20754.jpg', 'writbands', 89, 'wristbands Vidva', 'มีสินค้า'),
(9, 'aa52b115b9b1dee1524fad3e0752392b.jpg', 'เสื้อวิศวะ 5 เกียร์', 250, 'เสื้อกีฬาสานสัมพันธ์วิศวะเกษตรศาสตร์ 5 วิทยาเขต', 'มีสินค้า'),
(10, '145befaa3524cb09babb58730cbe87fc.jpg', 'เสื้อ INTANIA WAR T-SHIRT', 150, 'สินค้ามีจำนวนจำกัด', 'มีสินค้า'),
(11, '89018f64f5ffd6ad8d567eab503e8e38.jpg', 'GIFT SET', 300, 'เสื้อ หมวก ริสเเบนด์', 'สินค้าหมด'),
(12, '1b521df20bd354d041d288bb5444b519.jpg', 'เสื้อเจ็คเก็ต', 690, 'เสื้อเจ็คเก็ต คณะวิศวกรรมศาสตร์ศรีราชา', 'สินค้าหมด'),
(13, '23d126c9e13603f9ea4f4d92477d6f4a.jpg', 'เครื่องคิดเลข', 1890, 'เครื่องคิดเลขรุ่น FX-5800P', 'มีสินค้า');

-- --------------------------------------------------------

--
-- Table structure for table `shop_status`
--

CREATE TABLE `shop_status` (
  `shopstatus_id` int(11) NOT NULL,
  `shopstatus` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_status`
--

INSERT INTO `shop_status` (`shopstatus_id`, `shopstatus`) VALUES
(0, 'ปิด');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `permisstion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `username`, `firstname`, `lastname`, `permisstion`) VALUES
(1, '$2y$10$YTVIrM2YX063g7R.KpPI5egchDXEUVA7HLXM429mR3MmhizhRNz8O', 'admin', 'samo', 'system', 'superadmin'),
(21, '$2y$10$P2m35db2JlyrwsdDawNKquO8GVWtVvJrdj20jduZh2CEDit5jd0Me', 'watwit', 'watcharawit', 'yuthong', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`award_id`);

--
-- Indexes for table `checkaward`
--
ALTER TABLE `checkaward`
  ADD PRIMARY KEY (`checkaward_id`),
  ADD KEY `fk_checkaward_award1_idx` (`award_id`),
  ADD KEY `fk_checkaward_activity1_idx` (`activity_id`);

--
-- Indexes for table `checkname`
--
ALTER TABLE `checkname`
  ADD PRIMARY KEY (`checkname_id`),
  ADD KEY `fk_checkname_activity1_idx` (`activity_id`),
  ADD KEY `fk_checkname_list1_idx` (`list_id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`list_id`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `palace`
--
ALTER TABLE `palace`
  ADD PRIMARY KEY (`palace_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `fk_schedule_activity_idx` (`activity_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `shop_status`
--
ALTER TABLE `shop_status`
  ADD PRIMARY KEY (`shopstatus_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checkaward`
--
ALTER TABLE `checkaward`
  MODIFY `checkaward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `checkname`
--
ALTER TABLE `checkname`
  MODIFY `checkname_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1085;

--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `palace`
--
ALTER TABLE `palace`
  MODIFY `palace_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkaward`
--
ALTER TABLE `checkaward`
  ADD CONSTRAINT `fk_checkaward_activity1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_checkaward_award1` FOREIGN KEY (`award_id`) REFERENCES `award` (`award_id`) ON DELETE CASCADE;

--
-- Constraints for table `checkname`
--
ALTER TABLE `checkname`
  ADD CONSTRAINT `fk_checkname_activity1` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_checkname_list1` FOREIGN KEY (`list_id`) REFERENCES `list` (`list_id`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_schedule_activity` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`activity_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
