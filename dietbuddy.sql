-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 07:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dietbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`) VALUES
(1, 'admin', 'admin'),
(2, 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `diet_plan`
--

CREATE TABLE `diet_plan` (
  `dpid` int(50) NOT NULL,
  `dpbmi` varchar(100) DEFAULT NULL,
  `dpbreakfast` varchar(100) DEFAULT NULL,
  `dpmidmeal` varchar(100) DEFAULT NULL,
  `dplunch` varchar(100) DEFAULT NULL,
  `dpevening` varchar(100) DEFAULT NULL,
  `dpdinner` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diet_plan`
--

INSERT INTO `diet_plan` (`dpid`, `dpbmi`, `dpbreakfast`, `dpmidmeal`, `dplunch`, `dpevening`, `dpdinner`) VALUES
(1, '25', '2 besan cheela + 1/2 cup low fat curd', '1 apple', '1 cup masoor dal + 1 chapatti + 1/2 up low fat curd + salad', 'anything you want', '1 cup carrot peas vegetable +1 chapatti + salad'),
(2, '25', '2 besan cheela + 1/2 cup low fat curd', '1 apple', '1 cup masoor dal + 1 chapatti + 1/2 up low fat curd + salad', 'Khaane bhai tu', '1 cup carrot peas vegetable +1 chapatti + salad'),
(4, '18', '1 cup vegetable brown bread upma + 1/2 cup low fat milk (no sugar)', '1 cup musk melon', '1 cup rajma curry + 1 chapatti + salad', NULL, '1 cup parwal vegetable + 1 chapatti + salad'),
(6, '26.67', '2 besan cheela + 1/2 cup low fat curd', '1 cup musk melon', '1 cup rajma curry + 1 chapatti + salad', '1 cup vegetable soup', '1 cup carrot peas vegetable +1 chapatti + salad');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_registration`
--

CREATE TABLE `doctor_registration` (
  `id` int(50) NOT NULL,
  `dname` varchar(100) DEFAULT NULL,
  `dcno` varchar(100) DEFAULT NULL,
  `demail` varchar(100) DEFAULT NULL,
  `dgender` varchar(100) DEFAULT NULL,
  `ddesc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_registration`
--

INSERT INTO `doctor_registration` (`id`, `dname`, `dcno`, `demail`, `dgender`, `ddesc`) VALUES
(4, 'Dr Dev Panchal', '789456123', 'vfgyewuf@gmail.com', 'Male', 'MBBS In Santram Mandir'),
(5, 'Dr Dhruv Chavda', '789456123', 'vfgyewuf@gmail.com', 'male', 'MBBS In Santram Mandir');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `eid` int(50) NOT NULL,
  `ename` varchar(100) DEFAULT NULL,
  `eimage` varchar(255) DEFAULT NULL,
  `ecategory` varchar(100) DEFAULT NULL,
  `edesc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`eid`, `ename`, `eimage`, `ecategory`, `edesc`) VALUES
(1, 'Bicep Curl', 'image\\MTk2MTM2MDM1OTgwODc4OTkz.jpg', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(2, 'Bicep Curl', '', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(3, 'Bicep Curl', '', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(4, 'Bicep Curl', '', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(5, 'Bicep Curl', 'C:\\xampp\\htdocs\\Diet-Buddy\\image\\MTk2MTM2MDM1OTgwODc4OTkz.jpg', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(7, 'Bicep Curl', 'image/6.jpg', 'Biceps', 'Begin standing tall with your feet about hip-width apart. Keep your abdominal muscles engaged. Hold one dumbbell in each hand. Let your arms relax down at the sides of your body with palms facing forward. Keep your upper arms stable and shoulders relaxed,'),
(8, '', 'image/strict drill.gif', 'Biceps', ''),
(9, '', '', 'Biceps', ''),
(10, '', '', 'Biceps', ''),
(11, '', 'image/MTk2MTM2MDM1OTgwODc4OTkz.jpg', 'Biceps', ''),
(12, '', 'image/exercise/MTk2MTM2MDM1OTgwODc4OTkz.jpg', 'Biceps', ''),
(13, '', 'image/exercise/strict drill.gif', 'Biceps', '');

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `fid` int(50) NOT NULL,
  `fimage` varchar(255) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `fcategory` varchar(100) DEFAULT NULL,
  `fcalories` varchar(100) DEFAULT NULL,
  `fcarbs` varchar(100) DEFAULT NULL,
  `ffat` varchar(100) DEFAULT NULL,
  `fprotein` varchar(100) DEFAULT NULL,
  `ffiber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`fid`, `fimage`, `fname`, `fcategory`, `fcalories`, `fcarbs`, `ffat`, `fprotein`, `ffiber`) VALUES
(1, 'this is food image', 'Grapes', 'Fruit', NULL, '22..5g', '0.3g', '0.2g', '1.5g'),
(2, 'sdf sdfdsf dfsdfdsfdsfd', 'Jamfadfsdfd', 'Fruitsdfsd', '21', '22..5gfdsfds', '0.3g', '0.2gsdfsd', '1.5gsdffd'),
(10, 'image/Screenshot 2023-12-22 151707.png', 'sadcsa', 'Vegetable', 'sadd', 'sfsdaf', 'dasd', 'dsad', 'czxcs'),
(11, 'image/Screenshot 2023-12-25 012354.png', 'Mango', 'Fruit', '21', '1.2g', '0.3g', '0.2g', '1.5g'),
(12, 'image/strict drill.gif', '', 'Vegetable', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `id` int(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cno` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`id`, `name`, `cno`, `email`, `gender`, `age`) VALUES
(14, 'user123', '7862017750', 'deep.pd.42000@gmail.com', 'Male', 'user123'),
(15, 'dev', '123456789', 'dev@dev.com', 'Male', 'dev'),
(16, 'dev', '489465132', 'fuilbsdf@hamil.com', 'Male', 'dev');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diet_plan`
--
ALTER TABLE `diet_plan`
  ADD PRIMARY KEY (`dpid`);

--
-- Indexes for table `doctor_registration`
--
ALTER TABLE `doctor_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diet_plan`
--
ALTER TABLE `diet_plan`
  MODIFY `dpid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor_registration`
--
ALTER TABLE `doctor_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `eid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `fid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
