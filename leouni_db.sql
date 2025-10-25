-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 08:22 PM
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
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(500) DEFAULT NULL,
  `faculty` varchar(255) DEFAULT NULL,
  `departments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-------------------------------------------------------
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

-------------------------------------------------------

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
('', 'MBM', 0, 0, ''),
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
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `studentaccount`
--
ALTER TABLE `studentaccount`
  ADD CONSTRAINT `studentaccount_ibfk_1` FOREIGN KEY (`stdID`) REFERENCES `studets` (`stdID`);

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
