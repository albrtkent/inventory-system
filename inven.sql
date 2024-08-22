-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 29, 2021 at 02:41 PM
-- Server version: 10.3.32-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikas1_webphpbarubmn`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` int(20) NOT NULL,
  `kodebarang` varchar(255) NOT NULL,
  `tanggalperoleh` date DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `nup` varchar(255) DEFAULT NULL,
  `koderuangan` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nfctag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `kodebarang`, `tanggalperoleh`, `merk`, `nup`, `koderuangan`, `keterangan`, `nfctag`) VALUES
(81, '03080137040', '2012-12-29', 'Fico Compact Line', '1', 'RTFDC - IC Packaging', 'De-junk, Trim, Form and Singulation (DTFS) Fico, FCL', '66473712'),
(85, '03080137010', '2012-12-29', 'Fico MMS-i', '1', 'RTFDC - IC Packaging', 'IC Molding, Fico, MMS-i', 'e6da3512'),
(86, '03080137010', '2012-12-29', 'Fico MMS-i', '2', 'RTFDC - IC Packaging', 'IC Molding, Fico, MMS-i', '66e23312'),
(91, '03080110162', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Through-Hole Line, Walter Lemmen, Compact L-30 MD', '168c3612'),
(92, '03050105050', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Black Oxide, OSP Machine, Walter Lemmen, Compact L30 Omnibond', '962e3512'),
(93, '03090409173', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Developer-Rinse-Etch Center, Walter Lemmen, Etching Center S20', '96573312'),
(94, '03060102073', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Photoplotter, Walter Lemmen Filmstar', '36c33212'),
(95, '03050105044', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Laminator, Walter Lemmen, RLM 419p', '16083812'),
(96, '03080801020', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Exposure Unit, Walter Lemmen, Aktina S', '269f3412'),
(97, '03130301009', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'In Line Dryer, Walter Lemmen, Air 2000', '76463312'),
(98, '03080111005', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Oven, Walter Lemmen, UFB400', '76483312'),
(99, '03170124003', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Brushing Machine,Walter Lemmen, RBM 300', '86583312'),
(100, '03080140004', '2012-12-29', 'ATMA', '1', 'RTFDC - Manufaktur PCB', 'Electric PCB Wet Film Screen Printer, ATMA AT-EW80P', '66483712'),
(101, '03170124011', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Drilling and Routing Machine, Walter Lemmen, CCD SW', '76863412'),
(102, '03080715005', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Lighting Desk, Walter Lemmen, 19301000', '46303812'),
(103, '03050105063', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - Manufaktur PCB', 'Multilayer Press, Walter Lemmen, RMP-210', '76853412'),
(104, '03030301124', '2019-12-24', 'C SUN', '1', 'RTFDC - Manufaktur PCB', 'Manual UV Exposure System, C Sun UVE-M552', '962d3512'),
(105, '03080140004', '2012-12-24', 'Microcraft', '2', 'RTFDC - PCB Assembly (PCBA)', 'PCB Moving Probe Teste, Microcraft ELX6146', '16063812'),
(106, '03080303999', '2012-12-24', 'Samsung', '1', 'RTFDC - PCB Assembly (PCBA)', 'Auto Magazine Loader, Samsung LD-300L', '26a03412'),
(107, '03080402029', '2012-12-24', 'Samsung', '1', 'RTFDC - PCB Assembly (PCBA)', 'Multi-mode Connection Conveyor, Samsung CC-800', '66463712'),
(108, '03080117008', '2012-12-24', 'Samsung', '1', 'RTFDC - PCB Assembly (PCBA)', 'Automatic High Speed Screen Printer, Samsung SMP-200', '766d3712'),
(109, '03080707015', '2012-12-24', 'Samsung', '1', 'RTFDC - PCB Assembly (PCBA)', 'Work Table, Samsung WT-200L', '26a13412'),
(110, '03080112002', '2012-12-24', 'Samsung', '1', 'RTFDC - PCB Assembly (PCBA)', 'High Performance Air Reflow Oven, Samsung SRF-70i92', '76fb3312'),
(111, '03080303999', '2012-12-24', 'Samsung', '2', 'RTFDC - PCB Assembly (PCBA)', 'Magazine Unloader, Samsung UL-300L', '964e3512'),
(112, '03150404001', '2012-12-24', 'Mechatronic System', '3', 'RTFDC - PCB Assembly (PCBA)', 'Offline Automatic Optical Inspection, Mechatronic Sysem AV-871', '766f3712'),
(113, '03050201028', '2012-12-24', 'JBC', '1', 'RTFDC - PCB Assembly (PCBA)', 'Rework Station, JBC AM-2A', '76883412'),
(115, '03080305019', '2012-12-24', 'Sobot', '1', 'RTFDC - PCB Assembly (PCBA)', 'Lead Free Soldering Machine', '96303512'),
(116, '03030320009', '2012-12-24', 'Malcom', '1', 'RTFDC - PCB Assembly (PCBA)', 'Solder Paste Softener, Malcom SPS-1', '766e3712'),
(117, '03080140005', '2012-12-29', 'Walter Lemmen', '1', 'RTFDC - PCB Assembly (PCBA)', 'Waste Water Treatment, Walter Lemmen, Lonex 1500', '96b03612'),
(119, '03080137008', '2012-12-29', 'Technic Inc', '1', 'RTFDC - IC Packaging', 'De-Flashing and Tin Plating System, Technic, Mini Plating Plant 5', '16093812'),
(121, '03080137060', '2012-12-29', 'Zhongke', '2', 'RTFDC - IC Packaging', 'Wire Bonding, Zhongke, MB-133', '96ae3612'),
(122, '03080137060', '2012-12-29', 'Zhongke', '1', 'RTFDC - IC Packaging', 'Automatic Die Bonder, Zhongke, MB-362', '96ad3612'),
(123, '03080110058', '2012-12-29', 'Royce Instrument', '1', 'RTFDC - IC Packaging', 'Semi-Automatic Die Handler, Royce Instrument, DE-35-ST', '76f93312'),
(124, '03080130018', '2012-12-29', 'ADT 7100', '1', 'RTFDC - IC Packaging', 'Wafer Dicing Saws ADT 7100-2\" Provectus', '964d3512'),
(125, '03080133011', '2012-12-29', 'ADT 977', '1', 'RTFDC - IC Packaging', 'Wafer Cleaning Models ADT 977-200', '96503512'),
(126, '03090409174', '2012-12-29', 'ADT WM-966', '2', 'RTFDC - IC Packaging', 'Wafer Mounting Station ADT MW-966', '76493312'),
(127, '03030305097', '2012-12-29', 'Super Primex', '1', 'RTFDC - IC Packaging', 'Single Color Pad Printer, Super Promex, SP-816C', '86593312'),
(128, '03080203103', '2012-12-24', 'YCY', '1', 'RTFDC - Manufaktur PCB', 'Vacuum Laminator, YCY-1157', '46333812'),
(129, '03080201053', '2012-12-24', 'Malcom', '1', 'RTFDC - PCB Assembly (PCBA)', 'Reflow Checker, Malcom RPC-600', '76f83312'),
(130, '03030301013', '2012-12-24', 'Malcom', '1', 'RTFDC - PCB Assembly (PCBA)', 'Dip Tester, Malcom DS-03', '86cd3812'),
(131, '03080149009', '2012-12-24', 'Bonkote', '1', 'RTFDC - PCB Assembly (PCBA)', 'Digital Thermometer with Dipping Sensor, Bonkote MCA-900II + SC-007', '36c13212');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribarang`
--

CREATE TABLE `kategoribarang` (
  `id` int(11) NOT NULL,
  `kodebarang` varchar(255) NOT NULL,
  `namabarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoribarang`
--

INSERT INTO `kategoribarang` (`id`, `kodebarang`, `namabarang`) VALUES
(11, '03080140004', 'Mesin PCB'),
(12, '03050105063', 'Electric Pressing Machine'),
(13, '03080137010', 'Mesin Molding Injection'),
(14, '03080137008', 'Mesin Flashing'),
(15, '03080137040', 'Mesin Trimming'),
(16, '03170124011', 'Drilling Machine'),
(17, '03170124003', 'Brushing Machine'),
(18, '03050105050', 'Binding Machine'),
(19, '03080110162', 'Electro Plating / Pelapisan Metal'),
(20, '03090409174', 'Mesin Mounting'),
(21, '03080130018', 'Hack Sawing Machine'),
(22, '03080133011', 'Cleaning Instalation'),
(23, '03080137060', 'Mesin Bending'),
(24, '03080110058', 'Handle Strenght'),
(25, '03030305097', 'Hadled Printer'),
(26, '03050105044', 'Mesin Laminating'),
(27, '03080801020', 'Exposure Time Meter'),
(28, '03090409173', 'Alat Re-etching'),
(29, '03080111005', 'Oven (Alat Laboratorium Umum)'),
(30, '03130301009', 'Air Dryer'),
(31, '03080715005', 'Lighting Equipment'),
(32, '03080140005', 'Mesin Waste Water Purification'),
(33, '03060102073', 'Photo Processing Set'),
(34, '03030301124', 'System UV Sterelisasi & Sirkulasi AL'),
(35, '03080203103', 'Vacuum System'),
(36, '03080303999', 'Assembly/ Counting Sistem Lainnya'),
(37, '03080117008', 'Mesin Special Optical Effect Printer'),
(38, '03080402029', 'Intercell Conveyor System CE'),
(39, '03080707015', 'Working Table For Ship Model'),
(40, '03080112002', 'Oven/ Hot Air Sterilizer'),
(41, '03030320009', 'Solder IC'),
(42, '03080201053', 'Check Source'),
(43, '03150404001', 'X-Ray Inspection Machine'),
(44, '03050201028', 'Workstation'),
(45, '03080305019', 'Soldering & Desoldering'),
(46, '03030301013', 'IC Tester Semi TestIV'),
(47, '03080149009', 'Digital Thermometer');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `koderuangan` varchar(255) NOT NULL,
  `uraianruangan` varchar(255) NOT NULL,
  `nfctagruangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `koderuangan`, `uraianruangan`, `nfctagruangan`) VALUES
(33, 'RTFDC - IC Packaging', 'Clean room for IC Packaging', '168f3612'),
(34, 'RTFDC - Manufaktur PCB', 'Clean room for PCB manufacturing', '36c43212'),
(35, 'RTFDC - PCB Assembly (PCBA)', 'PCB Assembly including SMT', '76873412');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'ADMIN', 'admin@gmail.com', 'avatar2.jpg', '$2y$10$us1md9T4FPXuvSOKNID8SOKdt26u00xJ8Oi/oe7i8HTFAD1DVRjJi', 1, 1, 1635922976),
(12, 'USER', 'user@gmail.com', 'default.jpg', '$2y$10$mvZrU1cmHuIk.PcNoC8vUuDE3GpfVea.jC0LG2OYRQepuT1nKWQcO', 2, 1, 1635056904),
(27, 'RIEZTY OKTAVIANA', 'rieztyoktaviana09@gmail.com', 'default.jpg', '$2y$10$t1xPyrLQK1kwmMzaaEcCeOqmF.AfBbUcv00uK4bDgYbAl.yz72odi', 2, 0, 1635407726),
(28, 'ANDRIES LOPPA', 'andriesloppa@gmail.com', 'default.jpg', '$2y$10$sRI8GFxmmuyHQayzymOEUuCgKFrKHsUL2UWYCM9bVaQaaUXVV/z2.', 2, 0, 1635407751),
(32, 'ALBERT KENT', 'albkenttt@gmail.com', 'default.jpg', '$2y$10$gPQNXGso1NryPfNWmcdHDuYhzBeo2PckHDY5a8bAz8m72L5M8ClFW', 1, 1, 1635056902),
(34, 'TES1', 'tes1@gmail.com', 'default.jpg', '$2y$10$.ZBzdnOz3bRqznlYUn/b2uH2zsLJf3dGSwaWAW0nFb8NZudMkS/Ve', 2, 1, 1635918204),
(35, 'TES2', 'tes2@gmail.com', 'default.jpg', '$2y$10$IUIs1cZ1j7C6Kmdgyyy4cu7jLH91fy3sL5nVA8mxpyEBu6awapMJi', 2, 1, 1635918219),
(36, 'WIDY', 'widy@gmail.com', 'default.jpg', '$2y$10$hRaM0a1M0GQ3.wDOjVcLuu5rk72NWpTWEibSZzGs5V4fqZvbsdVea', 2, 1, 1635920359),
(37, 'JON', 'jon@gmail.com', 'default.jpg', '$2y$10$kpfv1sz1QLZToXQzcZIt6.eIVuxJA535fREa9z9k45rkbVYDA/s9u', 2, 1, 1635920368),
(38, 'ERIC', 'eric@gmail.com', 'default.jpg', '$2y$10$zC.jEGtf9zQ2ydWKx0Pg2.fEV0waawcAsZJGWiYhnUsf6jmv6uh4.', 2, 1, 1635920378),
(39, 'WINSON', 'winson@gmail.com', 'default.jpg', '$2y$10$F18eXZ0ZwSM9EUPQH1Xq7.Q19mWRblJmEFF3QbqutlOLfV1kUoGO6', 2, 1, 1635920396),
(42, 'ALBERT KENT', 'crispypotato05@gmail.com', 'default.jpg', '$2y$10$ODS3B5bgfDkgDOaf4ldFwOBfkmWbyJX1N85up6x3CtEWL4fo4T0fK', 2, 0, 1638161987),
(43, 'ALBERT KENT', 'crispypotato06@gmail.com', 'default.jpg', '$2y$10$FzLxpN79GnjU8aJsJ.56WuQ5rId6Fi/j9DFp4fMvWiEj9mEdtMdOS', 2, 0, 1638163643);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3),
(9, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'ADMIN'),
(2, 'USER'),
(3, 'MENU');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'ADMIN'),
(2, 'USER'),
(41, 'JIJIO'),
(42, 'KPO'),
(43, 'POK'),
(44, 'IJIOJ');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(10, 1, 'Users', 'admin/users', 'fas  fa-fw fa-users', 1),
(23, 2, 'Items', 'user/items', 'fas fa-fw fa-box-open', 1),
(24, 2, 'Item Category', 'user/itemcategory', 'fas fa-fw fa-layer-group', 1),
(25, 2, 'Room', 'user/room', 'fas fa-fw fa-store', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(24, 'crispypotato05@gmail.com', 'ld4V2pPoK9MbfCXS2BOZhqGu3Zvil9I5BfCQaC3HtoM=', 1638161987),
(25, 'crispypotato06@gmail.com', 'NflslQYJHyKcojozDNeanApYq2NfV84ziEOwSR98r80=', 1638163643);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `KodeRuangan` (`koderuangan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
