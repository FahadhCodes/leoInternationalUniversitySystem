-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 07:50 PM
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
-- Database: `leouni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessment_id` varchar(255) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `assessment_type` varchar(20) NOT NULL,
  `max_marks` int(11) DEFAULT NULL,
  `weight` decimal(10,5) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `closing_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `date` datetime NOT NULL,
  `department_id` varchar(5) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `faculty_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`date`, `department_id`, `department_name`, `faculty_id`) VALUES
('2025-07-27 16:13:13', 'APF', 'Food Science and Technology', 'AP'),
('2025-07-27 16:13:35', 'APN', 'Natural Resources', 'AP'),
('2025-07-27 16:13:52', 'APP', 'Physical Sciences and Technology', 'AP'),
('2025-07-27 16:14:11', 'APS', 'Sport Sciences and Physical Education', 'AP'),
('2025-07-27 16:05:56', 'ASA', ' Agribusiness Management ', 'AG'),
('2025-07-27 16:09:35', 'ASE', 'Export Agriculture', 'AG'),
('2025-07-27 16:12:43', 'ASL', 'Livestock Production', 'AG'),
('2025-07-27 16:15:15', 'GRS', ' Remote Sensing and GIS', 'GE'),
('2025-07-27 16:15:37', 'GSG', 'Surveying and Geodesy', 'GE'),
('2025-07-27 16:16:56', 'MAF', 'Accountancy & Finance', 'MS'),
('2025-07-27 16:17:37', 'MBM', 'Business Management', 'MS'),
('2025-07-27 16:19:21', 'MDA', 'Anatomy', 'MD'),
('2025-07-27 16:19:42', 'MDB', 'Biochemistry', 'MD'),
('2025-07-27 16:20:05', 'MDF', 'Forensic Medicine & Toxicology', 'MD'),
('2025-07-27 16:23:08', 'MDM', 'Medicine', 'MD'),
('2025-07-27 16:25:01', 'MDMB', 'Microbiology', 'MD'),
('2025-07-27 16:26:19', 'MDP', 'Paediactrics', 'MD'),
('2025-07-27 16:27:28', 'MDPH', 'Physiology', 'MD'),
('2025-07-27 16:25:59', 'MDS', 'Surgery', 'MD'),
('2025-07-27 16:18:04', 'MMM', 'Marketing Management', 'MS'),
('2025-07-27 16:18:27', 'MTM', 'Tourism Management', 'MS'),
('2025-07-27 16:28:13', 'SLE', 'Economics & Statistics', 'SS'),
('2025-07-27 16:29:07', 'SLG', 'Geography & Environmental Management', 'SS'),
('2025-07-27 16:28:50', 'SLL', 'Languages', 'SS'),
('2025-07-27 16:29:46', 'SLT', 'English Language Teaching', 'SS'),
('2025-07-27 16:30:16', 'TBT', 'Biosystems Technology', 'TC'),
('2025-07-27 16:30:31', 'TET', 'Engineering Technology', 'TC');

-- --------------------------------------------------------

--
-- Table structure for table `eventtable`
--

CREATE TABLE `eventtable` (
  `eventID` int(11) NOT NULL,
  `eventTitle` varchar(255) DEFAULT NULL,
  `eventLocation` varchar(255) DEFAULT NULL,
  `eventDate` date DEFAULT NULL,
  `bgmImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventtable`
--

INSERT INTO `eventtable` (`eventID`, `eventTitle`, `eventLocation`, `eventDate`, `bgmImage`) VALUES
(1, 'Inter University Games 2025', 'University Stadium – Ground A', '2025-11-18', '1.jpg'),
(2, 'Hackatons-2025', 'Main Computer Lab Building', '2025-11-11', '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` varchar(5) NOT NULL,
  `facultyName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `facultyName`) VALUES
('AG', 'Faculty of Agricultural Sciences'),
('AP', 'Faculty of Applied Science'),
('C', 'Faculty of Computing '),
('GE', 'Faculty of Geomatics'),
('MD', 'Faculty of Medicine'),
('MS', 'Faculty of Management Studies'),
('SS', 'Faculty of Social Sciences and Languages'),
('TC', 'Faculty of Technology');

-- --------------------------------------------------------

--
-- Table structure for table `finalexam`
--

CREATE TABLE `finalexam` (
  `stdID` varchar(50) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `staffID` varchar(200) DEFAULT NULL,
  `marks` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finalexam`
--

INSERT INTO `finalexam` (`stdID`, `subject_id`, `staffID`, `marks`) VALUES
('21APP7890', 'PST22107', 'ALN_NA_22567', 75.20);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `departments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `title`, `content`, `faculty`, `departments`) VALUES
(1, 'Calling Exam Applications', 'Year III Semester I\r\nMedical & Repeat', 'AP', 'Department of Physical Sciences and Technology '),
(2, 'Issuing Admission Card', 'Year I, Year II and Year III', 'SS', 'All Department');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `status_ID` int(11) NOT NULL,
  `Academic_role` varchar(255) NOT NULL,
  `NON_Academic_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`status_ID`, `Academic_role`, `NON_Academic_role`) VALUES
(1, 'Demonstrator', 'Librarian'),
(2, 'Assistant Lecturer', 'Bursar'),
(3, 'Lecturer', 'Deputy Vice Chancellor'),
(4, 'Senior Lecturer', 'Assistant Registrar'),
(5, 'HOD', 'Senior Registrar'),
(6, 'Dean', 'Vice Chancellor(VC)');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staffID` varchar(200) NOT NULL,
  `staff_fname` varchar(255) NOT NULL,
  `staff_lname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `nic` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `sub_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staffID`, `staff_fname`, `staff_lname`, `dob`, `nic`, `mail`, `gender`, `profile_pic`, `role`, `sub_role`) VALUES
('ALF_A_22567', 'Alice', 'Perera', '1985-08-22', '198508225678', 'aliceP@c.leo.ac.lk', 'Female', NULL, 'Academic', '2'),
('ALN_NA_22567', 'Ayesha', 'Liyanage', '1980-03-22', '198003223456', 'ayeshaL@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '2'),
('AMF_A_44567', 'Anjali', 'Mendis', '1984-01-20', '198401209876', 'anjaliM@c.leo.ac.lk', 'Female', NULL, 'Academic', '4'),
('AMN_NA_44567', 'Amara', 'Nissanka', '1979-02-20', '197902206789', 'amaraN@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '4'),
('CTM_A_33567', 'Chaminda', 'Tissera', '1979-06-15', '197906154567', 'chamindaT@ap.leo.ac.lk', 'Male', NULL, 'Academic', '3'),
('CTN_NA_33567', 'Chathura', 'Thennakoon', '1974-08-15', '197408152345', 'chathuraT@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '3'),
('DWM_A_31234', 'Dinesh', 'Weerasinghe', '1983-09-12', '198309123456', 'dineshW@tc.leo.ac.lk', 'Male', NULL, 'Academic', '3'),
('DWM_A_31256', 'Damith', 'Wickramasinghe', '1981-10-15', '198110156789', 'damithW@ms.leo.ac.lk', 'Male', NULL, 'Academic', '3'),
('DWN_NA_31234', 'Dilshan', 'Wanniarachchi', '1977-04-12', '197704128765', 'dilshanW@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '2'),
('DWN_NA_31256', 'Dhanushka', 'Wijeratne', '1976-10-15', '197610157654', 'dhanushkaW@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '2'),
('EMF_A_44512', 'Emma', 'Silva', '1982-11-30', '198211309876', 'emmaS@md.leo.ac.lk', 'Female', NULL, 'Academic', '4'),
('EMN_NA_44512', 'Erandi', 'Munaweera', '1978-12-30', '197812302345', 'erandiM@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '4'),
('JDM_A_55623', 'Janaka', 'Dissanayake', '1976-12-05', '197612053214', 'janakaD@ge.leo.ac.lk', 'Male', NULL, 'Academic', '5'),
('JDN_NA_55623', 'Jaliya', 'Dharmasena', '1971-11-05', '197111054321', 'jaliyaD@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '5'),
('JGF_A_22345', 'Jacqueline', 'Gunasekara', '1987-02-28', '198702287654', 'jacquelineG@ag.leo.ac.lk', 'Female', NULL, 'Academic', '2'),
('JGN_NA_22345', 'Jeevani', 'Gajanayake', '1982-01-28', '198201283456', 'jeevaniG@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '1'),
('JSM_A_11024', 'John', 'Fernando', '1980-05-15', '198005151234', 'johnF@ap.leo.ac.lk', 'Male', NULL, 'Academic', '1'),
('JSN_NA_11024', 'Jerome', 'Nanayakkara', '1975-06-18', '197506189876', 'jeromeN@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '1'),
('LMF_A_61234', 'Lakmini', 'Fonseka', '1989-07-30', '198907307654', 'lakminiF@md.leo.ac.lk', 'Female', NULL, 'Academic', '6'),
('LMN_NA_61234', 'Lasanthi', 'Marapana', '1984-09-30', '198409309876', 'lasanthiM@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '6'),
('MTM_A_55678', 'Manoj', 'Jayawardena', '1975-07-18', '197507182345', 'manojJ@ms.leo.ac.lk', 'Male', NULL, 'Academic', '5'),
('MTN_NA_55678', 'Malik', 'Thilakarathne', '1970-05-15', '197005156789', 'malikT@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '5'),
('PTM_A_33489', 'Prasanna', 'Abeykoon', '1977-08-18', '197708185678', 'prasannaA@tc.leo.ac.lk', 'Male', NULL, 'Academic', '3'),
('PTN_NA_33489', 'Pradeep', 'Thalagala', '1973-07-18', '197307183456', 'pradeepT@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '3'),
('RBM_A_33456', 'Rajiv', 'Bandara', '1978-03-10', '197803104321', 'rajivB@ge.leo.ac.lk', 'Male', NULL, 'Academic', '3'),
('RBN_NA_33456', 'Roshan', 'Balasuriya', '1972-09-10', '197209107654', 'roshanB@admin.leo.ac.lk', 'Male', NULL, 'NON-Academic', '3'),
('SGF_A_22378', 'Shanika', 'Galappaththi', '1986-04-22', '198604224321', 'shanikaG@ss.leo.ac.lk', 'Female', NULL, 'Academic', '2'),
('SGN_NA_22378', 'Sachini', 'Gamage', '1981-05-22', '198105225432', 'sachiniG@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '1'),
('SLF_A_65987', 'Samantha', 'Ratnayake', '1988-04-25', '198804256789', 'samanthaR@ss.leo.ac.lk', 'Female', NULL, 'Academic', '6'),
('SLN_NA_65987', 'Shiromi', 'Lokuge', '1983-07-25', '198307254321', 'shiromiL@admin.leo.ac.lk', 'Female', NULL, 'NON-Academic', '6'),
('XXX_NA_2739', '', '', '0000-00-00', '', '', '', 'XXX_NA_2739.', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `staffsaccount`
--

CREATE TABLE `staffsaccount` (
  `IP` varchar(255) DEFAULT NULL,
  `Createddate` datetime DEFAULT NULL,
  `staffID` varchar(50) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `pswrd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffsaccount`
--

INSERT INTO `staffsaccount` (`IP`, `Createddate`, `staffID`, `userName`, `pswrd`) VALUES
('::1', '2025-10-26 00:14:41', 'ALF_A_22567', 'A.Perera', '$2y$10$t11g5tYrILOVomIs1V2R0uycB3slBUFs9iepwrqHFbDTtbNcO.X6.'),
('::1', '2025-11-03 15:47:06', 'ALN_NA_22567', 'A.Liyanage', '$2y$10$U4chqIMEpiACeOWOJzt.2e5hlMDxbQTewJmrAcsEHTGNcW9/p6iR2'),
('::1', '2025-11-04 21:21:50', 'CTM_A_33567', 'C.Tissera', '$2y$10$3rOrM.iYMcPk8s6SQv1nvu4q6famgLc7HeGX0o4vYYvARkVlcU18K');

-- --------------------------------------------------------

--
-- Table structure for table `studentaccount`
--

CREATE TABLE `studentaccount` (
  `IP` varchar(255) DEFAULT NULL,
  `Createddate` datetime DEFAULT NULL,
  `stdID` varchar(50) DEFAULT NULL,
  `userName` varchar(255) NOT NULL,
  `pswrd` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentaccount`
--

INSERT INTO `studentaccount` (`IP`, `Createddate`, `stdID`, `userName`, `pswrd`, `tag`) VALUES
('::1', '2025-08-18 02:08:15', '20APF7261', 'Z.Niyas', '$2y$10$JOVds0o2dEo.agi/cyjfWeKrYVFj8p34QUdLUCsDUa5kYy1ADmROa', 'BR'),
('::1', '2025-08-18 09:53:53', '20MDP2123', 'Q.Perera', '$2y$10$0SUt/bJstYSG7yj4ce.bLe3oWqIl1LZBfz7VfVtdovqGXEO..C996', 'BR'),
('::1', '2025-08-18 09:55:20', '20GRS9123', 'G.Tissera', '$2y$10$8J8KNukc7oi6lq2Q5U9vCOQbdMAmAovFTY8U6okSGESw6FNPE6FjG', 'BR'),
('::1', '2025-08-18 09:56:00', '20GSG5936', 'W.Kariyawasam', '$2y$10$/K6JBQiwlnT6KEUxG.f8buyWpdffH25I2GmSbN4St69.YgryPSS4e', 'BR'),
('::1', '2025-08-18 10:12:12', '21APP7890', 'N.Herath', '$2y$10$eqhBVyx7/mg/tUpsIt0tNO68cSBOvbgGsgSbnXwQhLhue8N7UqzPW', 'TI'),
('::1', '2025-08-18 13:56:57', '20ASL5123', 'R.Gunaratne', '$2y$10$moDQdAr505O80Homz59p6.6V3j1a6zbayQVenn9.gO3WHvWv/1e3C', 'TI'),
('::1', '2025-08-21 01:33:06', '20TET5123', 'H.Peiris', '$2y$10$aPt9hCuNz1WizFV82yFdIe4G6mRlGstTe/9FDOk/ZvY8.GAOmpNGi', 'AE'),
('::1', '2025-08-29 07:37:23', '24MAF7890', 'V.Lokuge', '$2y$10$yftV4gYmr/KkqRvaKkPKZe11Hspdx9XIUYlg2xajAWXy5hMqjxmgm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentmarkings`
--

CREATE TABLE `studentmarkings` (
  `recodeId` varchar(255) NOT NULL,
  `stdID` varchar(50) DEFAULT NULL,
  `assessment_id` varchar(255) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `filePath` varchar(255) DEFAULT NULL,
  `submission_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentmarkings`
--

INSERT INTO `studentmarkings` (`recodeId`, `stdID`, `assessment_id`, `marks`, `status`, `filePath`, `submission_date`) VALUES
('A1', '20MDP2123', NULL, 76, 'compleate', '#random', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studets`
--

CREATE TABLE `studets` (
  `stdID` varchar(50) NOT NULL,
  `std_fname` varchar(255) NOT NULL,
  `std_lname` varchar(255) NOT NULL,
  `std_dob` date NOT NULL,
  `nic` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `faculty_id` varchar(5) NOT NULL,
  `department_id` varchar(5) NOT NULL,
  `aYear` varchar(7) NOT NULL,
  `profile_pic_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studets`
--

INSERT INTO `studets` (`stdID`, `std_fname`, `std_lname`, `std_dob`, `nic`, `email`, `gender`, `faculty_id`, `department_id`, `aYear`, `profile_pic_path`) VALUES
('20APF5123', 'Saman', 'Jayawardena', '2000-04-10', '200004101234', 'samanJ@ap.leo.ac.lk', 'Male', 'AP', 'APF', '19/20', ''),
('20APF7261', 'Zainab', 'Niyas', '2000-02-25', '200002251636', 'zainabN@ap.leo.ac.lk', 'Female', 'AP', 'APF', '19/20', ''),
('20APN3716', 'Erandi', 'Seneviratne', '2000-12-19', '200012196181', 'erandiS@ap.leo.ac.lk', 'Female', 'AP', 'APN', '19/20', ''),
('20APN6123', 'Tharindu', 'Ratnayake', '2000-07-17', '200007171358', 'tharinduR@ap.leo.ac.lk', 'Male', 'AP', 'APN', '19/20', ''),
('20ASA4123', 'Kamal', 'Perera', '2000-05-12', '200005121234', 'kamalP@ag.leo.ac.lk', 'Male', 'AG', 'ASA', '19/20', ''),
('20ASA6157', 'Nuwan', 'Kodithuwakku', '2000-01-14', '200001141575', 'nuwanK@ag.leo.ac.lk', 'Male', 'AG', 'ASA', '19/20', ''),
('20ASL2648', 'Uthpala', 'Kobbekaduwa', '2000-11-03', '200011036020', 'uthpalaK@ag.leo.ac.lk', 'Female', 'AG', 'ASL', '19/20', ''),
('20ASL5123', 'Ruwan', 'Gunaratne', '2000-08-25', '200008251357', 'ruwanG@ag.leo.ac.lk', 'Male', 'AG', 'ASL', '19/20', ''),
('20GRS9123', 'Gayan', 'Tissera', '2000-09-12', '200009121234', 'gayanT@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '19/20', ''),
('20GRS9481', 'Ravindu', 'Fonseka', '2000-04-27', '200004271838', 'ravinduF@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '19/20', ''),
('20GSG0123', 'Lalith', 'Wickremesinghe', '2000-12-05', '200012051360', 'lalithW@ge.leo.ac.lk', 'Male', 'GE', 'GSG', '19/20', ''),
('20GSG5936', 'Wathsala', 'Kariyawasam', '2000-02-12', '200002128383', 'wathsalaK@ge.leo.ac.lk', 'Female', 'GE', 'GSG', '19/20', ''),
('20MAF5123', 'Rangana', 'Gamage', '2000-08-18', '200008181234', 'ranganaG@ms.leo.ac.lk', 'Male', 'MS', 'MAF', '19/20', ''),
('20MAF7269', 'Hiruni', 'Vitharana', '2000-06-08', '200006082939', 'hiruniV@ms.leo.ac.lk', 'Female', 'MS', 'MAF', '19/20', ''),
('20MBM2714', 'Malith', 'Abeysekara', '2000-04-23', '200004237484', 'malithA@ms.leo.ac.lk', 'Male', 'MS', 'MBM', '19/20', ''),
('20MBM6123', 'Wasantha', 'Mendis', '2000-11-27', '200011271362', 'wasanthaM@ms.leo.ac.lk', 'Male', 'MS', 'MBM', '19/20', ''),
('20MDA1123', 'Lakmal', 'Zoysa', '2000-06-25', '200006251234', 'lakmalZ@md.leo.ac.lk', 'Male', 'MD', 'MDA', '19/20', ''),
('20MDA7159', 'Xavier', 'Liyanage', '2000-05-28', '200005281939', 'xavierL@md.leo.ac.lk', 'Male', 'MD', 'MDA', '19/20', ''),
('20MDP2123', 'Quentin', 'Perera', '2000-10-19', '200010191361', 'quentinP@md.leo.ac.lk', 'Male', 'MD', 'MDP', '19/20', ''),
('20MDP2604', 'Chathura', 'Qadir', '2000-03-13', '200003137484', 'chathuraQ@md.leo.ac.lk', 'Male', 'MD', 'MDP', '19/20', ''),
('20SLE6123', 'Wasantha', 'Premaratne', '2000-10-05', '200010051234', 'wasanthaP@ss.leo.ac.lk', 'Male', 'SS', 'SLE', '19/20', ''),
('20SLG7123', 'Chamari', 'Wickramasinghe', '2000-12-15', '200012151363', 'chamariW@ss.leo.ac.lk', 'Female', 'SS', 'SLG', '19/20', ''),
('20TBT4123', 'Chamara', 'Wijesekara', '2000-12-15', '200012151234', 'chamaraW@tc.leo.ac.lk', 'Male', 'TC', 'TBT', '19/20', ''),
('20TET5123', 'Harsha', 'Peiris', '2000-11-25', '200011251364', 'harshaP@tc.leo.ac.lk', 'Male', 'TC', 'TET', '19/20', ''),
('21APN6789', 'Kanchana', 'Wickramasinghe', '2001-08-25', '200108252345', 'kanchanaW@ap.leo.ac.lk', 'Female', 'AP', 'APN', '20/21', ''),
('21APN8372', 'Amila', 'Ovitigala', '2001-07-30', '200107302747', 'amilaO@ap.leo.ac.lk', 'Male', 'AP', 'APN', '20/21', ''),
('21APP4827', 'Fazal', 'Thahir', '2001-10-24', '200110247292', 'fazalT@ap.leo.ac.lk', 'Male', 'AP', 'APP', '20/21', ''),
('21APP6712', 'Fahadh', 'Muhammadh', '2001-11-01', '200130600443', 'fahadmohamed2948@gmail.com', 'male', 'AP', 'APP', '21/22', 'FahadhMuhammadh_21APP6712.jpeg'),
('21APP7890', 'Nadeesha', 'Herath', '2001-05-22', '200105222469', 'nadeeshaH@ap.leo.ac.lk', 'Female', 'AP', 'APP', '20/21', ''),
('21ASA3759', 'Viraj', 'Liyanagamage', '2001-09-16', '200109167131', 'virajL@ag.leo.ac.lk', 'Male', 'AG', 'ASA', '20/21', ''),
('21ASA6879', 'Shiromi', 'Peiris', '2001-04-30', '200104302468', 'shiromiP@ag.leo.ac.lk', 'Female', 'AG', 'ASA', '20/21', ''),
('21ASE5876', 'Nimali', 'Fernando', '2001-03-18', '200103182345', 'nimaliF@ag.leo.ac.lk', 'Female', 'AG', 'ASE', '20/21', ''),
('21ASE7284', 'Piyumi', 'Vithanage', '2001-06-29', '200106292686', 'piyumiV@ag.leo.ac.lk', 'Female', 'AG', 'ASE', '20/21', ''),
('21GRS6789', 'Manori', 'Peiris', '2001-07-10', '200107102471', 'manoriP@ge.leo.ac.lk', 'Female', 'GE', 'GRS', '20/21', ''),
('21GSG1592', 'Sajani', 'Gunatilake', '2001-09-02', '200109022949', 'sajaniG@ge.leo.ac.lk', 'Female', 'GE', 'GSG', '20/21', ''),
('21GSG5678', 'Hiruni', 'Nanayakkara', '2001-04-20', '200104202345', 'hiruniN@ge.leo.ac.lk', 'Female', 'GE', 'GSG', '20/21', ''),
('21MBM5678', 'Sanduni', 'Hettiarachchi', '2001-05-30', '200105302345', 'sanduniH@ms.leo.ac.lk', 'Female', 'MS', 'MBM', '20/21', ''),
('21MBM8370', 'Isuru', 'Wickremasinghe', '2001-11-13', '200111133040', 'isuruW@ms.leo.ac.lk', 'Male', 'MS', 'MBM', '20/21', ''),
('21MDB5678', 'Manori', 'Alwis', '2001-03-12', '200103122345', 'manoriA@md.leo.ac.lk', 'Female', 'MD', 'MDB', '20/21', ''),
('21MDB8260', 'Yasodara', 'Mendis', '2001-10-03', '200110033040', 'yasodaraM@md.leo.ac.lk', 'Female', 'MD', 'MDB', '20/21', ''),
('21MDPH3715', 'Dilrukshi', 'Rathnayake', '2001-08-18', '200108188595', 'dilrukshiR@md.leo.ac.lk', 'Female', 'MD', 'MDPH', '20/21', ''),
('21MDPH6789', 'Ramani', 'Silva', '2001-08-24', '200108242472', 'ramaniS@md.leo.ac.lk', 'Female', 'MD', 'MDPH', '20/21', ''),
('21MMM3825', 'Nimashi', 'Bandara', '2001-09-28', '200109288595', 'nimashiB@ms.leo.ac.lk', 'Female', 'MS', 'MMM', '20/21', ''),
('21MMM7890', 'Yasodha', 'Nanayakkara', '2001-09-02', '200109022473', 'yasodhaN@ms.leo.ac.lk', 'Female', 'MS', 'MMM', '20/21', ''),
('21SLG5678', 'Yasodha', 'Ratnayake', '2001-07-18', '200107182345', 'yasodhaR@ss.leo.ac.lk', 'Female', 'SS', 'SLG', '20/21', ''),
('21SLL6789', 'Dinesh', 'Alwis', '2001-10-20', '200110202474', 'dineshA@ss.leo.ac.lk', 'Male', 'SS', 'SLL', '20/21', ''),
('21TBT6789', 'Iresha', 'Silva', '2001-08-30', '200108302475', 'ireshaS@tc.leo.ac.lk', 'Female', 'TC', 'TBT', '20/21', ''),
('21TET5678', 'Dilhani', 'Ekanayake', '2001-09-22', '200109222345', 'dilhaniE@tc.leo.ac.lk', 'Female', 'TC', 'TET', '20/21', ''),
('22APF5938', 'Gimhani', 'Uduwawala', '2002-06-09', '200206098303', 'gimhaniU@ap.leo.ac.lk', 'Female', 'AP', 'APF', '21/22', ''),
('22APF9345', 'Chaminda', 'Weerasinghe', '2002-10-05', '200210053580', 'chamindaW@ap.leo.ac.lk', 'Male', 'AP', 'APF', '21/22', ''),
('22APP8901', 'Ruwan', 'Gunasekara', '2002-01-12', '200201123456', 'ruwanG@ap.leo.ac.lk', 'Male', 'AP', 'APP', '21/22', ''),
('22APP9483', 'Buddhika', 'Pannila', '2002-04-12', '200204123858', 'buddhikaP@ap.leo.ac.lk', 'Male', 'AP', 'APP', '21/22', ''),
('22ASE4860', 'Yasas', 'Mudalige', '2002-05-21', '200205218242', 'yasasM@ag.leo.ac.lk', 'Male', 'AG', 'ASE', '21/22', ''),
('22ASE8234', 'Lakmal', 'Jayasuriya', '2002-09-15', '200209153579', 'lakmalJ@ag.leo.ac.lk', 'Male', 'AG', 'ASE', '21/22', ''),
('22ASL7234', 'Sunil', 'Rathnayake', '2002-07-22', '200207223456', 'sunilR@ag.leo.ac.lk', 'Male', 'AG', 'ASL', '21/22', ''),
('22ASL8391', 'Roshan', 'Dabare', '2002-03-07', '200203073797', 'roshanD@ag.leo.ac.lk', 'Male', 'AG', 'ASL', '21/22', ''),
('22GRS2603', 'Tharaka', 'Hettiarachchi', '2002-06-17', '200206175050', 'tharakaH@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '21/22', ''),
('22GRS8901', 'Isuru', 'Balasuriya', '2002-08-15', '200208153456', 'isuruB@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '21/22', ''),
('22GSG9012', 'Nalin', 'Karunaratne', '2002-02-25', '200202253582', 'nalinK@ge.leo.ac.lk', 'Male', 'GE', 'GSG', '21/22', ''),
('22MDF8901', 'Niroshan', 'Pathirana', '2002-07-08', '200207083456', 'niroshanP@md.leo.ac.lk', 'Male', 'MD', 'MDF', '21/22', ''),
('22MDF9371', 'Zahir', 'Nanayakkara', '2002-07-18', '200207184151', 'zahirN@md.leo.ac.lk', 'Male', 'MD', 'MDF', '21/22', ''),
('22MDS4826', 'Eshan', 'Samarawickrama', '2002-05-03', '200205039606', 'eshanS@md.leo.ac.lk', 'Male', 'MD', 'MDS', '21/22', ''),
('22MDS9012', 'Saman', 'Fernando', '2002-03-07', '200203073583', 'samanF@md.leo.ac.lk', 'Male', 'MD', 'MDS', '21/22', ''),
('22MMM8901', 'Tharindu', 'Jayasinghe', '2002-09-15', '200209153456', 'tharinduJ@ms.leo.ac.lk', 'Male', 'MS', 'MMM', '21/22', ''),
('22MMM9481', 'Jayani', 'Xavier', '2002-08-28', '200208284151', 'jayaniX@ms.leo.ac.lk', 'Female', 'MS', 'MMM', '21/22', ''),
('22MTM4936', 'Ovin', 'Cooray', '2002-06-13', '200206139606', 'ovinC@ms.leo.ac.lk', 'Male', 'MS', 'MTM', '21/22', ''),
('22MTM9123', 'Zacky', 'Peiris', '2002-04-17', '200204173584', 'zackyP@ms.leo.ac.lk', 'Male', 'MS', 'MTM', '21/22', ''),
('22SLL8901', 'Zacky', 'Seneviratne', '2002-02-28', '200202283456', 'zackyS@ss.leo.ac.lk', 'Male', 'SS', 'SLL', '21/22', ''),
('22SLT9012', 'Eranga', 'Bandara', '2002-05-05', '200205053585', 'erangaB@ss.leo.ac.lk', 'Male', 'SS', 'SLT', '21/22', ''),
('22TBT8901', 'Eshan', 'Kulatunga', '2002-04-05', '200204053456', 'eshanK@tc.leo.ac.lk', 'Male', 'TC', 'TBT', '21/22', ''),
('22TET9012', 'Janaka', 'Almeida', '2002-03-15', '200203153586', 'janakaA@tc.leo.ac.lk', 'Male', 'TC', 'TET', '21/22', ''),
('23APN5678', 'Shamali', 'Dissanayake', '2001-11-28', '200111284691', 'shamaliD@ap.leo.ac.lk', 'Female', 'AP', 'APN', '22/23', ''),
('23APN6049', 'Harsha', 'Vitharana', '2001-11-14', '200111149414', 'harshaV@ap.leo.ac.lk', 'Male', 'AP', 'APN', '22/23', ''),
('23APS1594', 'Chamodi', 'Qureshi', '2001-09-27', '200109274969', 'chamodiQ@ap.leo.ac.lk', 'Female', 'AP', 'APS', '22/23', ''),
('23APS4567', 'Dilini', 'Abeysekara', '2001-09-18', '200109184567', 'diliniA@ap.leo.ac.lk', 'Female', 'AP', 'APS', '22/23', ''),
('23ASA3567', 'Chamari', 'Silva', '2001-11-30', '200111304567', 'chamariS@ag.leo.ac.lk', 'Female', 'AG', 'ASA', '22/23', ''),
('23ASA9426', 'Sachini', 'Hapugoda', '2001-08-22', '200108224808', 'sachiniH@ag.leo.ac.lk', 'Female', 'AG', 'ASA', '22/23', ''),
('23ASL4567', 'Anoma', 'Wickramasinghe', '2001-12-08', '200112084680', 'anomaW@ag.leo.ac.lk', 'Female', 'AG', 'ASL', '22/23', ''),
('23GRS4567', 'Oshadi', 'Samarakoon', '2001-09-08', '200109084693', 'oshadiS@ge.leo.ac.lk', 'Female', 'GE', 'GRS', '22/23', ''),
('23GSG3456', 'Janani', 'Dharmasena', '2001-10-30', '200110304567', 'jananiD@ge.leo.ac.lk', 'Female', 'GE', 'GSG', '22/23', ''),
('23GSG3714', 'Umayanga', 'Illangakoon', '2001-11-22', '200111226161', 'umayangaI@ge.leo.ac.lk', 'Male', 'GE', 'GSG', '22/23', ''),
('23MAF4567', 'Amandi', 'Ratnayake', '2001-10-20', '200110204695', 'amandiR@ms.leo.ac.lk', 'Female', 'MS', 'MAF', '22/23', ''),
('23MDM0482', 'Ama', 'Ovitigama', '2001-12-23', '200112235262', 'amaO@md.leo.ac.lk', 'Female', 'MD', 'MDM', '22/23', ''),
('23MDM3456', 'Oshadi', 'Samarasekara', '2001-11-22', '200111224567', 'oshadiS@md.leo.ac.lk', 'Female', 'MD', 'MDM', '22/23', ''),
('23MDMB4567', 'Tharushi', 'Gunasekara', '2001-12-30', '200112304694', 'tharushiG@md.leo.ac.lk', 'Female', 'MD', 'MDMB', '22/23', ''),
('23MDMB5937', 'Fathima', 'Tissera', '2001-10-08', '200110081717', 'fathimaT@md.leo.ac.lk', 'Female', 'MD', 'MDMB', '22/23', ''),
('23MTM0592', 'Kusal', 'Yapa', '2001-12-03', '200112035262', 'kusalY@ms.leo.ac.lk', 'Male', 'MS', 'MTM', '22/23', ''),
('23MTM3456', 'Upeksha', 'Kariyawasam', '2001-12-08', '200112084567', 'upekshaK@ms.leo.ac.lk', 'Female', 'MS', 'MTM', '22/23', ''),
('23SLE4567', 'Fathima', 'Fernando', '2001-11-18', '200111184696', 'fathimaF@ss.leo.ac.lk', 'Female', 'SS', 'SLE', '22/23', ''),
('23SLT3456', 'Amandi', 'Tennakoon', '2001-08-14', '200108144567', 'amandiT@ss.leo.ac.lk', 'Female', 'SS', 'SLT', '22/23', ''),
('23TBT4567', 'Kusum', 'Fernando', '2001-12-28', '200112284697', 'kusumF@tc.leo.ac.lk', 'Female', 'TC', 'TBT', '22/23', ''),
('23TET3456', 'Fathima', 'Mohideen', '2001-10-18', '200110184567', 'fathimaM@tc.leo.ac.lk', 'Female', 'TC', 'TET', '22/23', ''),
('24APF1234', 'Prasanna', 'Fonseka', '2003-06-30', '200306306789', 'prasannaF@ap.leo.ac.lk', 'Male', 'AP', 'APF', '23/24', ''),
('24APF2605', 'Dhanushka', 'Ratnayake', '2003-05-14', '200305145070', 'dhanushkaR@ap.leo.ac.lk', 'Male', 'AP', 'APF', '23/24', ''),
('24APS1902', 'Dilshan', 'Peiris', '2003-04-15', '200304155702', 'dilshanP@ap.leo.ac.lk', 'Male', 'AP', 'APS', '23/24', ''),
('24APS7150', 'Ishara', 'Wickramasooriya', '2003-08-29', '200308295525', 'isharaW@ap.leo.ac.lk', 'Male', 'AP', 'APS', '23/24', ''),
('24ASA7890', 'Prasanna', 'Alwis', '2003-05-22', '200305225791', 'prasannaA@ag.leo.ac.lk', 'Male', 'AG', 'ASA', '23/24', ''),
('24ASE1537', 'Thilina', 'Jayasekara', '2003-04-18', '200304185919', 'thilinaJ@ag.leo.ac.lk', 'Male', 'AG', 'ASE', '23/24', ''),
('24ASE6890', 'Dinesh', 'Bandara', '2003-02-15', '200302156789', 'dineshB@ag.leo.ac.lk', 'Male', 'AG', 'ASE', '23/24', ''),
('24GRS4825', 'Vihanga', 'Jayakody', '2003-07-07', '200307077272', 'vihangaJ@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '23/24', ''),
('24GRS7890', 'Kasun', 'Herath', '2003-01-18', '200301186789', 'kasunH@ge.leo.ac.lk', 'Male', 'GE', 'GRS', '23/24', ''),
('24GSG1234', 'Pradeep', 'Gamage', '2003-06-20', '200306205704', 'pradeepG@ge.leo.ac.lk', 'Male', 'GE', 'GSG', '23/24', ''),
('24MAF1603', 'Lihini', 'Zoysa', '2003-09-18', '200309186373', 'lihiniZ@ms.leo.ac.lk', 'Female', 'MS', 'MAF', '23/24', ''),
('24MAF7890', 'Viraj', 'Lokuge', '2003-04-22', '200304226789', 'virajL@ms.leo.ac.lk', 'Male', 'MS', 'MAF', '23/24', ''),
('24MBM1234', 'Bhanuka', 'Silva', '2003-07-05', '200307055706', 'bhanukaS@ms.leo.ac.lk', 'Male', 'MS', 'MBM', '23/24', ''),
('24MDA1234', 'Upul', 'Jayasundera', '2003-09-15', '200309155705', 'upulJ@md.leo.ac.lk', 'Male', 'MD', 'MDA', '23/24', ''),
('24MDA6048', 'Gayan', 'Udugama', '2003-06-23', '200306232828', 'gayanU@md.leo.ac.lk', 'Male', 'MD', 'MDA', '23/24', ''),
('24MDMB1593', 'Bhanu', 'Prasanna', '2003-08-08', '200308086373', 'bhanuP@md.leo.ac.lk', 'Male', 'MD', 'MDMB', '23/24', ''),
('24MDMB7890', 'Prabath', 'Wickramaratne', '2003-02-14', '200302146789', 'prabathW@md.leo.ac.lk', 'Male', 'MD', 'MDMB', '23/24', ''),
('24SLE7890', 'Bhanuka', 'Udawatte', '2003-01-30', '200301306789', 'bhanukaU@ss.leo.ac.lk', 'Male', 'SS', 'SLE', '23/24', ''),
('24SLG1234', 'Gayan', 'Gunasekara', '2003-08-03', '200308035707', 'gayanG@ss.leo.ac.lk', 'Male', 'SS', 'SLG', '23/24', ''),
('24TBT7890', 'Gihan', 'Navaratne', '2003-05-30', '200305306789', 'gihanN@tc.leo.ac.lk', 'Male', 'TC', 'TBT', '23/24', ''),
('24TET1234', 'Lakshan', 'Gunasekara', '2003-09-10', '200309105708', 'lakshanG@tc.leo.ac.lk', 'Male', 'TC', 'TET', '23/24', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` varchar(20) NOT NULL,
  `department_id` varchar(5) NOT NULL,
  `Year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `department_id`, `Year`, `semester`, `subject_name`) VALUES
('FST1101', 'APF', 1, 1, 'Introduction to Food Science and Technology'),
('FST1102', 'APF', 1, 1, 'Food Biology and Practicum'),
('FST1103', 'APF', 1, 1, 'General Chemistry for Food Science'),
('FST1104', 'APF', 1, 1, 'Fundamentals of Organic Chemistry'),
('FST1105', 'APF', 1, 1, 'Laboratory in Elementary Inorganic Chemistry'),
('FST1106', 'APF', 1, 1, 'Introduction to Computer Fundamentals'),
('FST1107', 'APF', 1, 1, 'Application of Computer Fundamentals'),
('FST1108', 'APF', 1, 1, 'Principles of Mathematics'),
('FST1109', 'APF', 1, 1, 'Production of Agricultural Raw Materials for Better Food Quality'),
('FST1201', 'APF', 1, 2, 'Fundamentals of Microbiology'),
('FST1202', 'APF', 1, 2, 'Fundamentals of Biochemistry'),
('FST1203', 'APF', 1, 2, 'Postharvest Technology'),
('FST1204', 'APF', 1, 2, 'Postharvest Pest and Disease Management'),
('FST1205', 'APF', 1, 2, 'Laboratory in Postharvest Handling of Food Sources'),
('FST1206', 'APF', 1, 2, 'Fundamentals of Analytical Chemistry'),
('FST1207', 'APF', 1, 2, 'Laboratory in Elementary Organic Chemistry'),
('FST1208', 'APF', 1, 2, 'Fundamentals of Statistics'),
('FST1209', 'APF', 1, 2, 'Fundamentals of Scientific and Technical Writing'),
('FST2101', 'APF', 2, 1, 'Advanced Biochemistry'),
('FST2102', 'APF', 2, 1, 'Food Chemistry'),
('FST2103', 'APF', 2, 1, 'Laboratory in Biochemistry and Food Chemistry'),
('FST2104', 'APF', 2, 1, 'Principles of Human Nutrition'),
('FST2105', 'APF', 2, 1, 'Food Microbiology'),
('FST2106', 'APF', 2, 1, 'Food Preservation and Practicum'),
('FST2107', 'APF', 2, 1, 'Management Process'),
('FST2108', 'APF', 2, 1, 'Statistics for Experimental Analysis'),
('FST2201', 'APF', 2, 2, 'Biotechnology for Food Science'),
('FST2202', 'APF', 2, 2, 'Laboratory in Food Microbiology and Biotechnology'),
('FST2203', 'APF', 2, 2, 'Food Process Engineering I and Practicum'),
('FST2204', 'APF', 2, 2, 'Livestock Production, Aquaculture Practices and Practicum'),
('FST2205', 'APF', 2, 2, 'Applied Human Nutrition and Practicum'),
('FST2206', 'APF', 2, 2, 'Food Toxicology'),
('FST2207', 'APF', 2, 2, 'Food Quality Management'),
('FST2208', 'APF', 2, 2, 'Statistical Methodology'),
('FST2209', 'APF', 2, 2, 'Food Marketing'),
('FST3101', 'APF', 3, 1, 'Food Analysis and Practicum'),
('FST3102', 'APF', 3, 1, 'Dairy Science'),
('FST3103', 'APF', 3, 1, 'Food Process Engineering II and Practicum'),
('FST3104', 'APF', 3, 1, 'Food Packaging'),
('FST3105', 'APF', 3, 1, 'Food Regulations'),
('FST3106', 'APF', 3, 1, 'Food Safety, Risk Analysis, Food Hygiene and Sanitation'),
('FST3107', 'APF', 3, 1, 'Food Product Development'),
('FST3108', 'APF', 3, 1, 'Environmental Sustainability in Food Industries'),
('FST3109', 'APF', 3, 1, 'Human Resource Management'),
('FST3110', 'APF', 3, 1, 'Research Methodology and Scientific Communication'),
('FST3201', 'APF', 3, 2, 'Aquatic Food Processing Technology'),
('FST3202', 'APF', 3, 2, 'Dairy Processing Technology'),
('FST3203', 'APF', 3, 2, 'Laboratory in Dairy Science and Dairy Processing Technology'),
('FST3204', 'APF', 3, 2, 'Beverage Processing Technology'),
('FST3205', 'APF', 3, 2, 'Sensory Evaluation of Foods and Practicum'),
('FST3206', 'APF', 3, 2, 'Functional Foods and Nutraceuticals'),
('FST3207', 'APF', 3, 2, 'Process Control and Automation in Food Industry'),
('FST3208', 'APF', 3, 2, 'Seminars in Trends and Current Issues in Food Science and Technology'),
('FST3209', 'APF', 3, 2, 'Instrumental Techniques in Food Science'),
('FST3210', 'APF', 3, 2, 'Food Plant Layout and Operations'),
('FST3211', 'APF', 3, 2, 'Statistics for Research'),
('FST3212', 'APF', 3, 2, 'Nutritional Aspects of Chronic Diseases'),
('FST4101', 'APF', 4, 1, 'Integrated Project in Food Science and Technology'),
('FST4102', 'APF', 4, 1, 'Chemistry and Technology of Cereals'),
('FST4103', 'APF', 4, 1, 'Chemistry and Technology of Fats and Oils'),
('FST4104', 'APF', 4, 1, 'Spice, Root and Tuber Processing Technology'),
('FST4105', 'APF', 4, 1, 'Pulse and Edible Nut Processing Technology'),
('FST4106', 'APF', 4, 1, 'Sugar and Confectionery Processing Technology'),
('FST4107', 'APF', 4, 1, 'Fruit and Vegetable Processing Technology'),
('FST4108', 'APF', 4, 1, 'Laboratory in Food Processing Technology (Cereals, Spices, Roots, Tubers, Pulses, Confectionery, Fruits, Vegetables)'),
('FST4109', 'APF', 4, 1, 'Meat and Egg Processing Technology'),
('FST4110', 'APF', 4, 1, 'Laboratory in Aquatic Food, Meat and Egg Processing Technology'),
('FST4111', 'APF', 4, 1, 'Advanced Food Quality Management'),
('FST4112', 'APF', 4, 1, 'Entrepreneurship in Food Technology'),
('FST4113', 'APF', 4, 1, 'Nanotechnology and its Applications in Food'),
('FST4114', 'APF', 4, 1, 'Technology and Innovation Management'),
('FST4115', 'APF', 4, 1, 'Food Culture and Traditional Foods'),
('FST4116', 'APF', 4, 1, 'Modern Food Supply and Distribution Systems and Sustainability'),
('FST4117', 'APF', 4, 1, 'Data Science and Informatics Applications in Food Science'),
('FST4201', 'APF', 4, 2, 'Research Project in Food Science and Technology'),
('NR11104', 'APN', 1, 1, 'Biology - Practical'),
('NR11106', 'APN', 1, 1, 'Inorganic Chemistry for Natural Resource Studies - Practical'),
('NR11202', 'APN', 1, 1, 'Biology I: Cellular and Organismic Biology'),
('NR11203', 'APN', 1, 1, 'Biology II: Evolution and the Diversity of Life'),
('NR11205', 'APN', 1, 1, 'General Chemistry'),
('NR11207', 'APN', 1, 1, 'Computer Literacy for Natural Resource Studies (Theory and Practical)'),
('NR11208', 'APN', 1, 1, 'Mathematics for Natural Resource Studies'),
('NR11301', 'APN', 1, 1, 'Introduction to the Environment and Natural Resources'),
('NR12107', 'APN', 1, 2, 'Computer Literacy for Natural Resource Studies - Practical'),
('NR12201', 'APN', 1, 2, 'Earth Materials and Processes'),
('NR12202', 'APN', 1, 2, 'Fundamentals of Hydrology'),
('NR12203', 'APN', 1, 2, 'Concepts of Ecology'),
('NR12204', 'APN', 1, 2, 'Physical Chemistry for Natural Resources Studies'),
('NR12205', 'APN', 1, 2, 'Fundamentals of Analytical Chemistry'),
('NR12206', 'APN', 1, 2, 'Organic Chemistry for Natural Resource Studies (Theory and Practical)'),
('NR12208', 'APN', 1, 2, 'Fundamentals of Statistics (Theory and Practical)'),
('NR21201', 'APN', 2, 1, 'Limnology (Theory and Practical)'),
('NR21202', 'APN', 2, 1, 'Microbiology for Natural Resource Studies (Theory and Practical)'),
('NR21203', 'APN', 2, 1, 'Genetics, Biotechnology and Biosafety (Theory and Practical)'),
('NR21204', 'APN', 2, 1, 'Mineralogy and Petrology'),
('NR21205', 'APN', 2, 1, 'Biodiversity (Theory and Practical)'),
('NR21206', 'APN', 2, 1, 'Physics for Natural Resource Studies'),
('NR21207', 'APN', 2, 1, 'Statistics for Experimental Analysis (Theory and Practical)'),
('NR21208', 'APN', 2, 1, 'Natural Product Chemistry (Theory and Practical)'),
('NR22103', 'APN', 2, 2, 'Geomorphology and Geology of Sri Lanka'),
('NR22104', 'APN', 2, 2, 'Earth Science - Practical'),
('NR22109', 'APN', 2, 2, 'Forestry - Practical'),
('NR22201', 'APN', 2, 2, 'Fundamentals of Soil Science'),
('NR22202', 'APN', 2, 2, 'Introduction to Economics'),
('NR22205', 'APN', 2, 2, 'Statistical Methodology (Theory and Practical)'),
('NR22206', 'APN', 2, 2, 'Analytical Techniques for Environmental Sciences and Natural Resources (Theory and Practical)'),
('NR22207', 'APN', 2, 2, 'Field Techniques in Ecology and Biodiversity (Theory and Practical)'),
('NR22208', 'APN', 2, 2, 'Forestry'),
('NR31102', 'APN', 3, 1, 'Remote Sensing and Geographic Information Systems - Practical'),
('NR31107', 'APN', 3, 1, 'Hydrology and Soil Science - Practical'),
('NR31201', 'APN', 3, 1, 'Remote Sensing and Geographic Information Systems'),
('NR31203', 'APN', 3, 1, 'Environmental and Natural Resource Economics'),
('NR31204', 'APN', 3, 1, 'Environmental Toxicology'),
('NR31205', 'APN', 3, 1, 'Industrial Chemistry and Technology'),
('NR31206', 'APN', 3, 1, 'Industrial Minerals'),
('NR31208', 'APN', 3, 1, 'Biogeography'),
('NR31209', 'APN', 3, 1, 'Waste Management'),
('NR31210', 'APN', 3, 1, 'Research Methodology and Scientific Communication'),
('NR31211', 'APN', 3, 1, 'Literature Review and Research Proposal Development for BSc Dissertation'),
('NR31212', 'APN', 3, 1, 'Managing People in Organizations'),
('NR31213', 'APN', 3, 1, 'Environmental Legislation and Regulation'),
('NR31214', 'APN', 3, 1, 'Statistical Application in Natural Resource Studies (Theory and Practical)'),
('NR32108', 'APN', 3, 2, 'Community Outreach Program (Mini Project)'),
('NR32201', 'APN', 3, 2, 'Resource Efficient and Cleaner Production'),
('NR32202', 'APN', 3, 2, 'Aquatic Resource Management (Theory and Practical)'),
('NR32203', 'APN', 3, 2, 'Coastal and Marine Resource Management (Theory and Practical)'),
('NR32204', 'APN', 3, 2, 'Tools for Environmental Management'),
('NR32205', 'APN', 3, 2, 'Study and Management of Natural Hazards'),
('NR32206', 'APN', 3, 2, 'Biodiversity Conservation and Management (Theory and Practical)'),
('NR32207', 'APN', 3, 2, 'Soil Degradation and Management'),
('NR32210', 'APN', 3, 2, 'Lichenology (Theory and Practical)'),
('NR32211', 'APN', 3, 2, 'Biogeography and Conservation Planning (Theory and Practical)'),
('NR32212', 'APN', 3, 2, 'Environment and Society'),
('NR32213', 'APN', 3, 2, 'Mineral Exploration and Management'),
('NR32214', 'APN', 3, 2, 'Bioinformatics'),
('NR32409', 'APN', 3, 2, 'B.Sc. Dissertation in Environmental Sciences and Natural Resource Management'),
('NR41201', 'APN', 4, 1, 'Research Methodology and Scientific Communication'),
('NR41202', 'APN', 4, 1, 'Environmental Legislation and Regulations'),
('NR41203', 'APN', 4, 1, 'Energy Resource Management (Theory and Practical)'),
('NR41204', 'APN', 4, 1, 'Literature Review and Research Proposal Development for BSc Dissertation'),
('NR41205', 'APN', 4, 1, 'Statistical Application in Natural Resource Studies (Theory and Practical)'),
('NR41206', 'APN', 4, 1, 'Environmental Geochemistry'),
('NR41207', 'APN', 4, 1, 'Field Techniques in Earth Science (Theory and Practical)'),
('NR41208', 'APN', 4, 1, 'Managing People in Organizations (Theory and Practical)'),
('NR41209', 'APN', 4, 1, 'Environmental Governance'),
('NR41210', 'APN', 4, 1, 'Applied Hydrology (Theory and Practical)'),
('NR41211', 'APN', 4, 1, 'Gemmology (Theory and Practical)'),
('NR41212', 'APN', 4, 1, 'Groundwater Exploration and Management (Theory and Practical)'),
('NR41213', 'APN', 4, 1, 'Protected Area Management (Theory and Practical)'),
('NR41214', 'APN', 4, 1, 'Ecotourism (Theory and Practical)'),
('NR41215', 'APN', 4, 1, 'Oil Exploration'),
('NR41216', 'APN', 4, 1, 'Forestry for Rural Development (Theory and Practical)'),
('NR41217', 'APN', 4, 1, 'Basic Methods of Surveying Sciences (Theory and practical)'),
('NR41218', 'APN', 4, 1, 'Climatology'),
('NR41219', 'APN', 4, 1, 'Machine Learning for Natural Resource Studies (Theory and Practical)'),
('NR42801', 'APN', 4, 2, 'B.Sc. Dissertation in Environmental Sciences and Natural Resource Management'),
('PST11103', 'APP', 1, 1, 'Physics Laboratory 1-I'),
('PST11106', 'APP', 1, 1, 'Inorganic Chemistry Laboratory I'),
('PST11107', 'APP', 1, 1, 'Structured Programming'),
('PST11109', 'APP', 1, 1, 'Computer Laboratory I-I'),
('PST11201', 'APP', 1, 1, 'Mechanics and Properties of Matter'),
('PST11202', 'APP', 1, 1, 'Introduction to Electricity and Magnetism'),
('PST11204', 'APP', 1, 1, 'General Chemistry'),
('PST11205', 'APP', 1, 1, 'Fundamentals of Organic Chemistry'),
('PST11208', 'APP', 1, 1, 'Computer Hardware and Software'),
('PST11210', 'APP', 1, 1, 'Calculus and Differential Equations'),
('PST12102', 'APP', 1, 2, 'Semi-Conductor Physics'),
('PST12103', 'APP', 1, 2, 'AC Theory & Circuits'),
('PST12104', 'APP', 1, 2, 'Physics Laboratory I-II'),
('PST12107', 'APP', 1, 2, 'Organic Chemistry Laboratory I'),
('PST12108', 'APP', 1, 2, 'Object Oriented Programming'),
('PST12110', 'APP', 1, 2, 'Computer Laboratory I-II'),
('PST12201', 'APP', 1, 2, 'Physics of Heat and Waves'),
('PST12205', 'APP', 1, 2, 'Fundamentals of Physical Chemistry'),
('PST12206', 'APP', 1, 2, 'Fundamentals of Analytical Chemistry'),
('PST12209', 'APP', 1, 2, 'Fundamentals of Statistics'),
('PST12211', 'APP', 1, 2, 'Database Management Systems'),
('PST21103', 'APP', 2, 1, 'Physics Laboratory 2-I'),
('PST21106', 'APP', 2, 1, 'Organic Chemistry Laboratory II'),
('PST21110', 'APP', 2, 1, 'Computer Laboratory 2-I'),
('PST21111', 'APP', 2, 1, 'Physical Chemistry Laboratory I'),
('PST21201', 'APP', 2, 1, 'Electronics'),
('PST21202', 'APP', 2, 1, 'Geometrical and Physical Optics'),
('PST21204', 'APP', 2, 1, 'Organic Chemistry'),
('PST21205', 'APP', 2, 1, 'Industrial Chemistry and Technology I (Organic)'),
('PST21207', 'APP', 2, 1, 'Data Structures & Algorithms'),
('PST21208', 'APP', 2, 1, 'Computer Architecture and Assembly Language'),
('PST21209', 'APP', 2, 1, 'Statistics for Experimental Analysis'),
('PST22103', 'APP', 2, 2, 'Physics Laboratory 2-II'),
('PST22106', 'APP', 2, 2, 'Inorganic Chemistry Laboratory II'),
('PST22107', 'APP', 2, 2, 'Analytical Chemistry Laboratory I'),
('PST22110', 'APP', 2, 2, 'Computer Laboratory 2-II'),
('PST22112', 'APP', 2, 2, 'Leadership and Communication'),
('PST22114', 'APP', 2, 2, 'Soft Skill Development'),
('PST22116', 'APP', 2, 2, 'Introduction to Astronomy'),
('PST22201', 'APP', 2, 2, 'Physics of Electromagnetic Radiation and Introduction to Laser'),
('PST22202', 'APP', 2, 2, 'Quantum Physics, Atomic & Nuclear Physics'),
('PST22204', 'APP', 2, 2, 'Chemistry of Elements'),
('PST22205', 'APP', 2, 2, 'Physical Chemistry'),
('PST22208', 'APP', 2, 2, 'Software Engineering'),
('PST22209', 'APP', 2, 2, 'Statistical Methodology'),
('PST22211', 'APP', 2, 2, 'Operating Systems'),
('PST22213', 'APP', 2, 2, 'Biology for Physical Sciences'),
('PST22215', 'APP', 2, 2, 'Mathematical Methods'),
('PST22217', 'APP', 2, 2, 'Industrial Metrology'),
('PST22218', 'APP', 2, 2, 'Management Information Systems'),
('PST22219', 'APP', 2, 2, 'Molecular Spectroscopy'),
('PST31014', 'APP', 3, 1, 'Industrial Visit'),
('PST31104', 'APP', 3, 1, 'Material Physics'),
('PST31107', 'APP', 3, 1, 'Introduction to Nanotechnology'),
('PST31108', 'APP', 3, 1, 'Physics Laboratory 3-I'),
('PST31121', 'APP', 3, 1, 'Laboratory Quality Control and Assurance'),
('PST31122', 'APP', 3, 1, 'Physical Chemistry Laboratory II'),
('PST31123', 'APP', 3, 1, 'Analytical Chemistry Laboratory II'),
('PST31128', 'APP', 3, 1, 'Computer Laboratory 3-I'),
('PST31201', 'APP', 3, 1, 'Solid State Physics'),
('PST31202', 'APP', 3, 1, 'Nuclear Physics & Applications'),
('PST31203', 'APP', 3, 1, 'Quantum Mechanics'),
('PST31205', 'APP', 3, 1, 'Special Relativity'),
('PST31206', 'APP', 3, 1, 'Optical Fiber & Telecommunication'),
('PST31209', 'APP', 3, 1, 'The Origin and Evolution of the Universe'),
('PST31210', 'APP', 3, 1, 'Multimedia and Hypermedia Systems Development'),
('PST31211', 'APP', 3, 1, 'Mathematical Programming'),
('PST31212', 'APP', 3, 1, 'Numerical Methods'),
('PST31213', 'APP', 3, 1, 'Economics'),
('PST31216', 'APP', 3, 1, 'Biochemistry - I'),
('PST31217', 'APP', 3, 1, 'Electroanalytical Techniques'),
('PST31218', 'APP', 3, 1, 'Industrial Chemistry and Technology - II (Inorganic)'),
('PST31219', 'APP', 3, 1, 'Environmental Chemistry'),
('PST31220', 'APP', 3, 1, 'Coordination Chemistry'),
('PST31224', 'APP', 3, 1, 'Artificial Intelligence & Expert Systems'),
('PST31225', 'APP', 3, 1, 'Software Project Management'),
('PST31226', 'APP', 3, 1, 'Software Quality Assurances'),
('PST31227', 'APP', 3, 1, 'Object Oriented Analysis and Design'),
('PST31229', 'APP', 3, 1, 'Advanced Database Management Systems'),
('PST31230', 'APP', 3, 1, 'Social and Professional Issues in Computing'),
('PST32102', 'APP', 3, 2, 'Interaction of Radiation with Matter'),
('PST32104', 'APP', 3, 2, 'Advanced Electronics'),
('PST32108', 'APP', 3, 2, 'Current Topics in Physics'),
('PST32109', 'APP', 3, 2, 'Human Resource Management'),
('PST32111', 'APP', 3, 2, 'Physics Laboratory 3-II'),
('PST32118', 'APP', 3, 2, 'Advanced Organic Chemistry'),
('PST32121', 'APP', 3, 2, 'Advanced Inorganic Chemistry Laboratory'),
('PST32122', 'APP', 3, 2, 'Biochemistry Laboratory'),
('PST32130', 'APP', 3, 2, 'Computer Laboratory 3-II'),
('PST32133', 'APP', 3, 2, 'Current Topics in Computer Technology'),
('PST32201', 'APP', 3, 2, 'Statistical Physics'),
('PST32203', 'APP', 3, 2, 'Atmospheric Physics'),
('PST32205', 'APP', 3, 2, 'Solid State Devices'),
('PST32206', 'APP', 3, 2, 'Astrophysics'),
('PST32207', 'APP', 3, 2, 'Atomic and Molecular Spectroscopy'),
('PST32210', 'APP', 3, 2, 'Statistics in Quality Control'),
('PST32212', 'APP', 3, 2, 'Graph Theory'),
('PST32213', 'APP', 3, 2, 'Resource Efficient and Cleaner Production'),
('PST32214', 'APP', 3, 2, 'Chemistry of Drug Design and Drug Action'),
('PST32215', 'APP', 3, 2, 'Polymer Chemistry & Technology'),
('PST32216', 'APP', 3, 2, 'Surface and Colloid Chemistry'),
('PST32217', 'APP', 3, 2, 'Biochemistry II'),
('PST32219', 'APP', 3, 2, 'Introduction to Organic electronics'),
('PST32220', 'APP', 3, 2, 'Structures and Properties of Solids'),
('PST32223', 'APP', 3, 2, 'Organometallic Chemistry'),
('PST32224', 'APP', 3, 2, 'Artificial Neural Networks'),
('PST32225', 'APP', 3, 2, 'Digital Image Processing'),
('PST32226', 'APP', 3, 2, 'Data Mining and Applications'),
('PST32227', 'APP', 3, 2, 'Data Communication and Computer Networks'),
('PST32228', 'APP', 3, 2, 'Computer Graphics and Visualization'),
('PST32229', 'APP', 3, 2, 'Project in Computer Science and Technology (Mini Project)'),
('PST32231', 'APP', 3, 2, 'Human Computer Interactions'),
('PST32232', 'APP', 3, 2, 'Bioinformatics'),
('PST32801', 'APP', 3, 2, 'Project Work (Industrial Exposure): BSc Thesis in Physical Sciences (Major in Applied Physics)'),
('PST32802', 'APP', 3, 2, 'Project Work (Industrial Exposure): BSc Thesis in Physical Sciences (Major in Chemical Technology)'),
('PST32803', 'APP', 3, 2, 'Project Work (Industrial Exposure): BSc Thesis in Physical Sciences (Major in Computer Science & Technology)'),
('PST41013', 'APP', 4, 1, 'Literature Search Seminar in Applied Physics'),
('PST41014', 'APP', 4, 1, 'Independent Research / Project in Applied Physics'),
('PST41120', 'APP', 4, 1, 'Bioinorganic Chemistry'),
('PST41124', 'APP', 4, 1, 'Literature Search in Chemistry'),
('PST41201', 'APP', 4, 1, 'Research Methodology and Scientific Communication'),
('PST41202', 'APP', 4, 1, 'Computational Physics'),
('PST41203', 'APP', 4, 1, 'Robotics'),
('PST41204', 'APP', 4, 1, 'Remote Sensing & GIS'),
('PST41205', 'APP', 4, 1, 'Geophysics'),
('PST41206', 'APP', 4, 1, 'Medical and BioPhysics'),
('PST41207', 'APP', 4, 1, 'Advanced Nanotechnology'),
('PST41208', 'APP', 4, 1, 'Data Acquisition and Signal Processing Methods'),
('PST41209', 'APP', 4, 1, 'Advanced Laser Physics'),
('PST41210', 'APP', 4, 1, 'Automation'),
('PST41211', 'APP', 4, 1, 'Astronomical Instruments and Data Reduction & Analysis Techniques'),
('PST41212', 'APP', 4, 1, 'Electrochemical Power Conversion'),
('PST41215', 'APP', 4, 1, 'Industrial Management'),
('PST41216', 'APP', 4, 1, 'Classical Mechanics'),
('PST41217', 'APP', 4, 1, 'Natural Products Chemistry'),
('PST41218', 'APP', 4, 1, 'Biotechnology'),
('PST41219', 'APP', 4, 1, 'Advanced Solid-State Chemistry'),
('PST41221', 'APP', 4, 1, 'Instrumental Analysis'),
('PST41222', 'APP', 4, 1, 'Applied Molecular Modelling'),
('PST41223', 'APP', 4, 1, 'States of Matter'),
('PST41225', 'APP', 4, 1, 'Independent Research / Project in Chemical Technology'),
('PST41226', 'APP', 4, 1, 'Computer Applications in Instrumentation'),
('PST41227', 'APP', 4, 1, 'Web services'),
('PST41228', 'APP', 4, 1, 'Computer System Security'),
('PST41229', 'APP', 4, 1, 'Advanced Computer Networks'),
('PST41230', 'APP', 4, 1, 'Internet of Things (IoT)'),
('PST41231', 'APP', 4, 1, 'Natural Language Processing'),
('PST41232', 'APP', 4, 1, 'Cloud Computing'),
('PST41233', 'APP', 4, 1, 'Business Process Management Systems'),
('PST41234', 'APP', 4, 1, 'Mobile Computing'),
('PST41235', 'APP', 4, 1, 'Critical Thinking'),
('SSPE1101', 'APS', 1, 1, 'Introduction to Sport Sciences and Physical Education'),
('SSPE1102', 'APS', 1, 1, 'Human Anatomy and Physiology I'),
('SSPE1103', 'APS', 1, 1, 'Fundamentals of Physical Education'),
('SSPE1104', 'APS', 1, 1, 'History and Philosophy of Sports'),
('SSPE1105', 'APS', 1, 1, 'Basic Statistics for Sport Sciences'),
('SSPE1106', 'APS', 1, 1, 'Fundamentals of Psychology'),
('SSPE1107', 'APS', 1, 1, 'Practical Sports I'),
('SSPE1108', 'APS', 1, 1, 'Practical Sports II'),
('SSPE1201', 'APS', 1, 2, 'Human Anatomy and Physiology II'),
('SSPE1202', 'APS', 1, 2, 'Biomechanics I'),
('SSPE1203', 'APS', 1, 2, 'Exercise Physiology I'),
('SSPE1204', 'APS', 1, 2, 'Sports Psychology I'),
('SSPE1205', 'APS', 1, 2, 'Sports Sociology'),
('SSPE1206', 'APS', 1, 2, 'Practical Sports III'),
('SSPE1207', 'APS', 1, 2, 'Practical Sports IV'),
('SSPE2101', 'APS', 2, 1, 'Biomechanics II'),
('SSPE2102', 'APS', 2, 1, 'Exercise Physiology II'),
('SSPE2103', 'APS', 2, 1, 'Sports Psychology II'),
('SSPE2104', 'APS', 2, 1, 'Sports Nutrition'),
('SSPE2105', 'APS', 2, 1, 'Research Methods in Sport Sciences'),
('SSPE2106', 'APS', 2, 1, 'Sports Management I'),
('SSPE2107', 'APS', 2, 1, 'Practical Sports V'),
('SSPE2108', 'APS', 2, 1, 'Practical Sports VI'),
('SSPE2201', 'APS', 2, 2, 'Motor Learning and Control'),
('SSPE2202', 'APS', 2, 2, 'Sports Medicine and First Aid'),
('SSPE2203', 'APS', 2, 2, 'Sports Coaching I'),
('SSPE2204', 'APS', 2, 2, 'Sports Management II'),
('SSPE2205', 'APS', 2, 2, 'Practical Sports VII'),
('SSPE2206', 'APS', 2, 2, 'Practical Sports VIII'),
('SSPE2207', 'APS', 2, 2, 'Field Experience I'),
('SSPE3101', 'APS', 3, 1, 'Sports Biomechanics'),
('SSPE3102', 'APS', 3, 1, 'Advanced Exercise Physiology'),
('SSPE3103', 'APS', 3, 1, 'Sports Psychology III'),
('SSPE3104', 'APS', 3, 1, 'Sports Coaching II'),
('SSPE3105', 'APS', 3, 1, 'Sports Marketing'),
('SSPE3106', 'APS', 3, 1, 'Sports Event Management'),
('SSPE3107', 'APS', 3, 1, 'Practical Sports IX'),
('SSPE3108', 'APS', 3, 1, 'Practical Sports X'),
('SSPE3109', 'APS', 3, 1, 'Field Experience II'),
('SSPE3201', 'APS', 3, 2, 'Sports Performance Analysis'),
('SSPE3202', 'APS', 3, 2, 'Sports Rehabilitation'),
('SSPE3203', 'APS', 3, 2, 'Sports Psychology IV'),
('SSPE3204', 'APS', 3, 2, 'Sports Facility Management'),
('SSPE3205', 'APS', 3, 2, 'Sports Law and Ethics'),
('SSPE3206', 'APS', 3, 2, 'Practical Sports XI'),
('SSPE3207', 'APS', 3, 2, 'Practical Sports XII'),
('SSPE3208', 'APS', 3, 2, 'Field Experience III'),
('SSPE4101', 'APS', 4, 1, 'Advanced Sports Biomechanics'),
('SSPE4102', 'APS', 4, 1, 'Sports Science Research Project I'),
('SSPE4103', 'APS', 4, 1, 'High Performance Coaching'),
('SSPE4104', 'APS', 4, 1, 'Sports Psychology V'),
('SSPE4105', 'APS', 4, 1, 'Sports Entrepreneurship'),
('SSPE4106', 'APS', 4, 1, 'Practical Sports XIII'),
('SSPE4107', 'APS', 4, 1, 'Practical Sports XIV'),
('SSPE4108', 'APS', 4, 1, 'Field Experience IV'),
('SSPE4201', 'APS', 4, 2, 'Sports Science Research Project II'),
('SSPE4202', 'APS', 4, 2, 'Contemporary Issues in Sport Sciences'),
('SSPE4203', 'APS', 4, 2, 'Professional Practice in Sport Sciences'),
('SSPE4204', 'APS', 4, 2, 'Practical Sports XV'),
('SSPE4205', 'APS', 4, 2, 'Practical Sports XVI'),
('SSPE4206', 'APS', 4, 2, 'Field Experience V');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessment_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `eventtable`
--
ALTER TABLE `eventtable`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `finalexam`
--
ALTER TABLE `finalexam`
  ADD PRIMARY KEY (`stdID`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `staffID` (`staffID`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`status_ID`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `studentaccount`
--
ALTER TABLE `studentaccount`
  ADD KEY `stdID` (`stdID`);

--
-- Indexes for table `studentmarkings`
--
ALTER TABLE `studentmarkings`
  ADD PRIMARY KEY (`recodeId`),
  ADD KEY `stdID` (`stdID`),
  ADD KEY `assessment_id` (`assessment_id`);

--
-- Indexes for table `studets`
--
ALTER TABLE `studets`
  ADD PRIMARY KEY (`stdID`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `finalexam`
--
ALTER TABLE `finalexam`
  ADD CONSTRAINT `finalexam_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `studets` (`stdID`),
  ADD CONSTRAINT `finalexam_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `finalexam_ibfk_3` FOREIGN KEY (`staffID`) REFERENCES `staffs` (`staffID`);

--
-- Constraints for table `studentaccount`
--
ALTER TABLE `studentaccount`
  ADD CONSTRAINT `studentaccount_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `studets` (`stdID`);

--
-- Constraints for table `studentmarkings`
--
ALTER TABLE `studentmarkings`
  ADD CONSTRAINT `studentmarkings_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `studets` (`stdID`),
  ADD CONSTRAINT `studentmarkings_ibfk_2` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`assessment_id`);

--
-- Constraints for table `studets`
--
ALTER TABLE `studets`
  ADD CONSTRAINT `studets_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  ADD CONSTRAINT `studets_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
