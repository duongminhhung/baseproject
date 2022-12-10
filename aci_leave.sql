-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2022 at 03:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aci_leave`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'hungcom1789', '2022-11-27 08:32:49'),
(2, 'H?ng', 'hungcom1789', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartments`
--

CREATE TABLE `tbldepartments` (
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldepartments`
--

INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `CreationDate`) VALUES
(2, 'Information Technologies', 'ICT', '2017-11-01 07:19:37'),
(3, 'Library', 'LIb', '2021-05-21 08:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `emp_id` int(11) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Staff_ID` varchar(50) NOT NULL,
  `Position_Staff` varchar(100) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Av_leave` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(30) NOT NULL,
  `location` varchar(200) NOT NULL,
  `signature` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`emp_id`, `FirstName`, `LastName`, `Staff_ID`, `Position_Staff`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `Av_leave`, `Phonenumber`, `salary`, `Status`, `RegDate`, `role`, `location`, `signature`) VALUES
(2, 'Hung', 'Duong', '124', 'Registra', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Male', '02 February 2002', 'ICT', 'Ha Noi', '30', '0385166119', 0, 'Online', '2017-11-10 13:40:02', 'Admin', 'soinhunhi1.jpg', 'reg_un_0385166119_2.png'),
(4, 'Nathaniel', 'Nkrumah', '125', 'ICT Director', 'rk@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Male', '3 February, 1990', 'ICT', 'N NEPO', '30', '1110088165', 60, 'Offline', '2017-11-10 13:40:02', 'Admin', 'NO-IMAGE-AVAILABLE.jpg', ''),
(11, 'Khang', 'Pham', '1', 'Intern', '20010865@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'male', '02 November 2022', 'ICT', 'Ha Noi', '2', '0852066719', 50, 'Online', '2022-11-27 08:22:52', 'Staff', 'NO-IMAGE-AVAILABLE.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblleave`
--

CREATE TABLE `tblleave` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `RequestedDays` int(11) NOT NULL,
  `DaysOutstand` int(11) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `ToDate` varbinary(120) DEFAULT NULL,
  `Sign` varchar(120) DEFAULT NULL,
  `PostingDate` date DEFAULT NULL,
  `WorkCovered` varchar(120) DEFAULT NULL,
  `HodRemarks` int(11) NOT NULL DEFAULT 0,
  `HodSign` varchar(200) NOT NULL,
  `HodDate` varchar(120) NOT NULL,
  `RegRemarks` int(1) NOT NULL DEFAULT 0,
  `RegSign` varchar(200) NOT NULL,
  `RegDate` varchar(120) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `num_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblleavetype`
--

CREATE TABLE `tblleavetype` (
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `date_from` varchar(200) NOT NULL,
  `date_to` varchar(200) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `date_from`, `date_to`, `CreationDate`) VALUES
(5, 'Casual Leave', 'Casual Leave', '2021-05-23', '2021-06-20', '2021-05-19 14:32:03'),
(6, 'Medical Leave', 'Medical Leave', '2021-05-05', '2021-05-28', '2021-05-19 15:29:05'),
(8, 'Other', 'Leave all staff', '31-05-2021', '04-06-2021', '2021-05-20 17:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` text NOT NULL,
  `outgoing_msg_id` text NOT NULL,
  `text_message` text NOT NULL,
  `curr_date` text NOT NULL,
  `curr_time` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_message`
--

INSERT INTO `tbl_message` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `text_message`, `curr_date`, `curr_time`) VALUES
(1, '11', '2', 'sadfasd', 'November 27, 2022 ', '8:23 am'),
(2, '2', '11', 'zádfasdf', 'November 27, 2022 ', '8:41 am');

-- --------------------------------------------------------

--
-- Table structure for table `timekepping`
--

CREATE TABLE `timekepping` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `ts` time DEFAULT NULL,
  `te` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timekepping`
--

INSERT INTO `timekepping` (`id`, `emp_id`, `date`, `ts`, `te`) VALUES
(7, 11, '2022-11-30', '10:08:30', '13:08:41'),
(19, 4, '2022-12-15', '08:48:22', '00:48:22'),
(20, 11, '2022-11-28', '15:11:32', '18:16:48'),
(21, 11, '2022-12-01', '10:04:30', '10:04:47'),
(22, 11, '2022-12-02', '07:08:30', '18:16:48'),
(23, 11, '2022-12-03', '10:06:03', '10:06:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `tblleave`
--
ALTER TABLE `tblleave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `timekepping`
--
ALTER TABLE `timekepping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblleave`
--
ALTER TABLE `tblleave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timekepping`
--
ALTER TABLE `timekepping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `timekepping`
--
ALTER TABLE `timekepping`
  ADD CONSTRAINT `timekepping_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tblemployees` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
