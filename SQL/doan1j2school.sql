-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2022 at 08:12 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doan1j2school`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `time_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recipient_name` varchar(20) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` varchar(30) NOT NULL,
  `note` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `customer_id`, `time_order`, `recipient_name`, `customer_phone`, `customer_address`, `note`, `status`) VALUES
(1, 1, '2022-01-02 02:47:09', 'Tri dep trai', '012345678', 'Quang Nam', 'Tri rat dep trai', 2),
(2, 1, '2022-01-02 02:47:31', 'Tri nha giau', '012345678', 'Quang Nam', 'Tri rat dep trai', 2),
(3, 2, '2022-01-02 03:47:31', 'Tri Sau Mui', '012345678', 'Quang Nam', 'Ahjhj d0 ngok', 3),
(4, 1, '2022-01-04 13:27:56', 'ecec', '0123456789', 'Quang Nam', 'Khum co note', 2),
(5, 1, '2022-01-05 03:31:54', 'ecec', '0123456789', 'Quang Nam', 'Khum co note', 2),
(6, 1, '2022-02-05 03:33:19', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Khum co note', 2),
(7, 1, '2022-01-05 17:04:11', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Note cho zui', 2),
(8, 1, '2022-02-05 17:07:08', 'ecec', '0123456789', 'Ec ec', 'Khum note', 2),
(9, 1, '2022-06-02 02:47:09', 'Tri dep trai', '012345678', 'Quang Nam', 'Tri rat dep trai', 2),
(10, 1, '2022-03-02 02:47:31', 'Tri nha giau', '012345678', 'Quang Nam', 'Tri rat dep trai', 2),
(11, 2, '2022-09-02 03:47:31', 'Tri Sau Mui', '012345678', 'Quang Nam', 'Ahjhj d0 ngok', 3),
(12, 1, '2022-08-04 13:27:56', 'ecec', '0123456789', 'Quang Nam', 'Khum co note', 2),
(13, 1, '2022-07-05 03:31:54', 'ecec', '0123456789', 'Quang Nam', 'Khum co note', 2),
(14, 1, '2022-06-05 03:33:19', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Khum co note', 2),
(15, 1, '2022-05-05 17:04:11', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Note cho zui', 2),
(16, 1, '2022-03-05 17:07:08', 'ecec', '0123456789', 'Ec ec', 'Khum note', 2),
(17, 2, '2022-01-26 21:40:06', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Khum note', 2),
(18, 1, '2022-01-26 21:48:48', 'ecec', '0123456789', 'Ec ec', 'Khum note', 2),
(19, 1, '2022-01-26 21:53:54', 'ecec', '0123456789', 'Ec ec', 'Note cho zui', 2),
(20, 1, '2022-01-26 21:54:42', 'ecec', '0123456789', 'Ec ec', 'Khum note', 3);

-- --------------------------------------------------------

--
-- Table structure for table `bill_detail`
--

CREATE TABLE `bill_detail` (
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_detail`
--

INSERT INTO `bill_detail` (`bill_id`, `product_id`, `quantity`) VALUES
(1, 1, 3),
(1, 2, 3),
(1, 3, 2),
(4, 1, 1),
(4, 2, 1),
(4, 3, 1),
(5, 3, 2),
(5, 2, 1),
(5, 1, 5),
(6, 3, 3),
(6, 2, 2),
(6, 1, 6),
(7, 3, 2),
(7, 2, 2),
(7, 1, 1),
(8, 1, 1),
(8, 2, 2),
(8, 3, 1),
(9, 1, 3),
(9, 2, 3),
(9, 3, 2),
(10, 1, 1),
(11, 2, 1),
(11, 3, 1),
(12, 3, 2),
(12, 2, 1),
(13, 1, 5),
(13, 3, 3),
(13, 2, 2),
(14, 1, 6),
(14, 3, 2),
(15, 2, 2),
(15, 1, 1),
(15, 1, 1),
(16, 2, 2),
(16, 3, 1),
(17, 3, 2),
(17, 4, 2),
(17, 1, 2),
(17, 2, 2),
(19, 2, 3),
(19, 3, 4),
(19, 1, 1),
(19, 4, 1),
(20, 2, 1),
(20, 3, 1),
(20, 1, 1),
(20, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` bit(2) NOT NULL DEFAULT b'1',
  `dob` date NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `dob`, `email`, `password`, `phone`, `address`, `token`) VALUES
(1, 'ecec', b'01', '2022-01-02', 'ecec@gmail.com', '123456789', '0123456789', 'Ec ec', 'ecectd5123'),
(2, 'Anh tri deep try', b'01', '2022-01-26', 'ecec1@gmail.com', '123456789', '', '', 'ad71a208b3800f3a469a04e4f8b1061d');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` bit(2) NOT NULL DEFAULT b'1',
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `manager_id` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `phone`, `address`, `gender`, `dob`, `email`, `password`, `level_id`, `token`, `manager_id`) VALUES
(1, 'Trí Deeptry', '012345678', 'Quang Nam', b'01', '2003-02-01', 'ecec1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'ecec1@gmail.com827ccb0eea8a706c4c34a16891f84e7b', 3),
(2, 'Trí nhà giàu', '012345678', 'Quang Nam', b'01', '2003-02-01', 'ecec2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'ecec2@gmail.com81dc9bdb52d04dc20036dbd8313ed055', 3),
(3, 'Trí sợ ma', '012345678', 'Quang Nam', b'01', '2003-02-01', 'trancongtri008@gmail.com', 'bd6fddd42278812354823774c428b159', 2, 'trancongtri008@gmail.combd6fddd42278812354823774c428b159', 0);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`id`, `name`) VALUES
(1, 'Luôn vui tươi'),
(2, 'Chà neo'),
(3, 'Chợ Nhật Tảo Local'),
(4, 'Chợ Bà Chiểu'),
(5, 'Đồ xi đa'),
(6, 'Lượm Local'),
(7, 'Gầm cầu local'),
(8, 'iAó');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `cost` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `cost`, `quantity`, `manufacturer_id`, `sold`, `type_id`) VALUES
(1, 'Áo khoác đen màu hường nam tính', 'Anh Trí đẹp try quá hjhj', '1640843224.png', 200000, 39, 2, 5, 2),
(2, 'Áo phông 100% cottton được làm từ lụa', 'Áo phông 100% cottton được làm từ lụa', '1640843275.png', 50000, 26, 5, 8, 1),
(3, 'Anh người yêu siêu cấp vjp pro', 'Đẹp try, học giỏi, con nhà giàu, body sáu múi là những gì anh ấy méo có', '1640984974.jpg', 3000, 58, 7, 7, 1),
(4, 'Áo tàng hình, càng nhìn càng thấy', 'Áo tàng hình, không nhìn cũng thấy ', '1642809719.jpg', 40000, 20, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate_product`
--

CREATE TABLE `rate_product` (
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate_product`
--

INSERT INTO `rate_product` (`product_id`, `customer_id`, `rating`, `comment`) VALUES
(1, 1, 4, 'Mặt hàng rất đẹp trai'),
(1, 1, 5, 'Tuyệt zời'),
(3, 1, 5, 'Tuyệt vời xứng đáng điểm 10');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Áo dài tay'),
(2, 'Áo ngắn tay'),
(3, 'Áo tay lỡ'),
(4, 'Áo tay phồng'),
(5, 'Áo cổ đức'),
(6, 'Áo cổ trụ'),
(7, 'Áo cổ V'),
(8, 'Áo cổ thắt nơ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
