-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2022 at 04:34 PM
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
(6, 1, '2022-01-05 03:33:19', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Khum co note', 2),
(7, 1, '2022-01-05 17:04:11', 'Anh tri deep try', '0123456789', 'Quang Nam', 'Note cho zui', 2),
(8, 1, '2022-01-05 17:07:08', 'ecec', '0123456789', 'Ec ec', 'Khum note', 2);

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
(8, 3, 1);

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
(1, 'ecec', b'01', '2022-01-02', 'ecec@gmail.com', '123', '0123456789', 'Ec ec', 'ecectd5123');

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
  `email` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `phone`, `address`, `gender`, `dob`, `email`, `password`, `level_id`, `token`) VALUES
(1, 'Tri nha giau', '012345678', 'Quang Nam', b'01', '2001-01-01', 'ecec@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'ecec@gmail.com81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Tri dep trai', '012345678', 'Quang Nam', b'00', '2002-06-29', 'ecec@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'ecec@gmail.com81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Tri hoc gioi ', '012345678', 'Quang Nam', b'01', '2003-02-01', 'ecec@gmail.com', '202cb962ac59075b964b07152d234b70', 2, 'ecec@gmail.com202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Eo vì pha ke'),
(2, 'Chà neo'),
(3, 'Chợ Nhật Tảo Local'),
(4, 'Chợ Bà Chiểu'),
(5, 'Đồ xi đa'),
(6, 'Lượm Local'),
(7, 'Gầm cầu local');

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
(1, 'Áo khoác đen màu hường nam tính', 'Anh Trí đẹp try quá hjhj', '1640843224.png', 200000, 43, 2, 1, 1),
(2, 'Áo phông 100% cottton được làm từ lụa', 'Áo phông 100% cottton được làm từ lụa', '1640843275.png', 50000, 32, 5, 2, 1),
(3, 'Anh người yêu siêu cấp vjp pro', 'Đẹp try, học giỏi, con nhà giàu, body sáu múi là những gì anh ấy méo có', '1640984974.jpg', 3000, 65, 7, 1, 1);

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
-- Indexes for table `level`
--
ALTER TABLE `level`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
