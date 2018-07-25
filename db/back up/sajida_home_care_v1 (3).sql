-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2018 at 07:08 AM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.15-0ubuntu0.17.10.1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajida_home_care_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_login`
--

CREATE TABLE `tbl_admin_login` (
  `login_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin_login`
--

INSERT INTO `tbl_admin_login` (`login_id`, `password`, `status`, `tbl_admin_user_admin_user_id`) VALUES
(1, 'f25b45db1a27d1d1c3105b699b6457df', 1, 'appinion'),
(7, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'SF_IT'),
(8, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'SF1111'),
(9, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'S03075'),
(10, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'S04315'),
(11, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'S04795'),
(12, '40be4e59b9a2a2b5dffb918c0e86b3d7', 1, 'S04374');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user`
--

CREATE TABLE `tbl_admin_user` (
  `admin_user_id` varchar(20) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `DOB` date NOT NULL,
  `gender` int(11) NOT NULL,
  `phone_number` varchar(14) DEFAULT NULL,
  `is_emergency` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=yes, 0=no',
  `email` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `tbl_admin_user_type_admin_user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin_user`
--

INSERT INTO `tbl_admin_user` (`admin_user_id`, `admin_name`, `DOB`, `gender`, `phone_number`, `is_emergency`, `email`, `address`, `tbl_admin_user_type_admin_user_type_id`) VALUES
('appinion', 'Appinion Dev', '2017-09-10', 1, '01796633774', 0, 'info@appinionbd.com', 'House 74 (C-5), Road 21 Block B, Banani, Dhaka-1213', 1),
('S03075', 'Nausheen Nafeez', '1988-09-11', 0, '01777773079', 0, 'nausheen@sajidafoundation.org', '620/1 Boro Magbazar, Dhaka', 4),
('S04315', 'Sumiya Simi', '1994-12-12', 0, '01777772612', 0, 'simidubangla@gmail.com', 'M-119, Merul badda,Dhaka -1212', 4),
('S04374', 'Gautom Kumar Sinha', '1982-10-01', 1, '01777772615', 0, 'joy_goutom@yahoo.com', 'Sajida Foundation', 4),
('S04795', 'Arbab-Ur- Rahman', '1980-10-14', 1, '01777772728', 0, 'arbab@sajidafoundation.org', 'Sajida Foundation', 2),
('SF1111', 'Data Entry', '1990-01-01', 1, '01728719171', 0, 'badrujjaman@sajidafoundation.org', 'Dhanmondi,Dhaka', 2),
('SF_IT', 'SAJIDA IT Team', '1990-01-01', 1, '01708500154', 1, 'contact@sajidafoundation.org', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user_type`
--

CREATE TABLE `tbl_admin_user_type` (
  `admin_user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(50) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin_user_type`
--

INSERT INTO `tbl_admin_user_type` (`admin_user_type_id`, `user_type_name`, `created_on`) VALUES
(1, 'Super Admin', '2017-09-10'),
(2, 'IT', '2017-10-04'),
(3, 'Executive', '2017-10-19'),
(4, 'Coordinator', '2017-10-19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_user_login`
--

CREATE TABLE `tbl_app_user_login` (
  `app_user_login_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `tbl_app_user_type_app_user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_app_user_login`
--

INSERT INTO `tbl_app_user_login` (`app_user_login_id`, `user_id`, `password`, `status`, `tbl_app_user_type_app_user_type_id`) VALUES
(1, 'CG1107171', 'b2def9dedebd227073bf547e42723dd4', 1, 1),
(2, 'CG2509171', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(3, 'CG0101171', 'c33367701511b4f6020ec61ded352059', 1, 1),
(5, 'CG2001172', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(6, 'CG0108171', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(7, 'PT1306171', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(8, 'PT1808171', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(9, 'PT1905171', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(10, 'CG0105171', '695ae81e393b3bd7c9ba2c0a722aad50', 1, 1),
(11, 'CG1212161', 'fe743d8d97aa7dfc6c93ccdc2e749513', 1, 1),
(12, 'PT1002181', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(13, 'PT2701181', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(14, 'PT1611161', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(15, 'PT1701181', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(16, 'CG0101181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(17, 'CG0512171', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(18, 'CG1302181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(19, 'CG1302182', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(20, 'CG1302183', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(21, 'CG0101182', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(22, 'PT0107161', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(23, 'CG1303181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(24, 'CG1303182', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(25, 'CG1303183', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(26, 'PT3101171', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(27, 'CG0703181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(28, 'CG0101011', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(29, 'PT0101011', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(30, 'CG2703181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(31, 'CG2703182', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(32, 'CG2703183', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(33, 'PT2703181', 'e10adc3949ba59abbe56e057f20f883e', 1, 2),
(34, 'CG0604181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(35, 'CG0304181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(36, 'CG2503181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(37, 'CG2503182', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(38, 'CG0602181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(39, 'CG1401181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(40, 'CG0701181', 'e10adc3949ba59abbe56e057f20f883e', 1, 1),
(41, 'CG1504181', '5a9172fffa87e4c0b889994609509979', 1, 1),
(42, 'CG2204181', '0a6ecc1a3d2c9be93b4c8c2bd649203d', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_user_type`
--

CREATE TABLE `tbl_app_user_type` (
  `app_user_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_app_user_type`
--

INSERT INTO `tbl_app_user_type` (`app_user_type_id`, `name`, `created_on`) VALUES
(1, 'Caregiver', '2017-10-09'),
(2, 'Patient', '2017-10-01'),
(3, 'Consultant', '2017-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area_code`
--

CREATE TABLE `tbl_area_code` (
  `area_code_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `location` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_area_code`
--

INSERT INTO `tbl_area_code` (`area_code_id`, `name`, `location`) VALUES
(1229, 'Khilkhet', 'Dhaka Metropolitan City'),
(1230, 'Uttara', 'Dhaka Metropolitan City');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_payment`
--

CREATE TABLE `tbl_bank_payment` (
  `bank_id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `tbl_admin_login_login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank_payment`
--

INSERT INTO `tbl_bank_payment` (`bank_id`, `bank_name`, `tbl_admin_login_login_id`) VALUES
(1, 'Brac Bank Limited', 1),
(2, 'Eastern bank Limited', 1),
(3, 'Dutch-Bangla Bank Limited (DBBL)', 7),
(4, 'Al-Arafah Islami Bank Limited', 7),
(5, 'Islami Bank Limited', 7),
(6, 'National Bank Limited', 7),
(7, 'Uttara Bank Limited', 7),
(8, 'Mutual Trust Bank', 7),
(9, 'Premier Bank Limited', 7),
(10, 'Mercantile Bank Limited', 7),
(11, 'Agrani Bank Limited', 7),
(12, 'Rupali Bank Limited', 7),
(13, 'South-East Bank Limited', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_availability`
--

CREATE TABLE `tbl_caregiver_availability` (
  `caregiver_availability_id` int(11) NOT NULL COMMENT '1= Available, 0= Not Available',
  `Sunday` int(11) NOT NULL DEFAULT '0',
  `Monday` int(11) NOT NULL DEFAULT '0',
  `Tuesday` int(11) NOT NULL DEFAULT '0',
  `Wednesday` int(11) NOT NULL DEFAULT '0',
  `Thursday` int(11) NOT NULL DEFAULT '0',
  `Friday` int(11) NOT NULL DEFAULT '0',
  `Saturday` int(11) NOT NULL DEFAULT '0',
  `tbl_caregiver_user_caregiver_user_id` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_availability`
--

INSERT INTO `tbl_caregiver_availability` (`caregiver_availability_id`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `tbl_caregiver_user_caregiver_user_id`) VALUES
(6, 1, 1, 1, 1, 1, 1, 1, 'CG0108171'),
(9, 1, 1, 1, 1, 1, 1, 1, 'CG2509171'),
(10, 1, 1, 1, 1, 1, 1, 1, 'CG1107171'),
(13, 1, 1, 1, 1, 1, 1, 1, 'CG1212161'),
(15, 1, 1, 1, 1, 1, 1, 1, 'CG0105171'),
(16, 1, 1, 1, 1, 1, 1, 1, 'CG2001172'),
(20, 1, 1, 1, 1, 1, 1, 1, 'CG1302182'),
(23, 1, 1, 1, 1, 1, 1, 1, 'CG1303182'),
(24, 1, 1, 1, 1, 1, 1, 1, 'CG1303183'),
(25, 1, 1, 1, 1, 1, 1, 1, 'CG1303181'),
(27, 1, 1, 1, 1, 1, 1, 1, 'CG0703181'),
(29, 1, 1, 1, 1, 1, 1, 1, 'CG2703182'),
(32, 1, 1, 1, 1, 1, 1, 1, 'CG1401181'),
(34, 1, 1, 1, 1, 1, 1, 1, 'CG0701181'),
(35, 1, 1, 1, 1, 1, 1, 1, 'CG0101171'),
(36, 1, 1, 1, 1, 1, 1, 1, 'CG1504181'),
(38, 1, 1, 1, 1, 1, 1, 1, 'CG2703183'),
(41, 1, 1, 1, 1, 1, 1, 1, 'CG2703181'),
(42, 1, 1, 1, 1, 1, 1, 1, 'CG1302183'),
(43, 1, 1, 1, 1, 1, 1, 1, 'CG2204181'),
(45, 1, 1, 1, 1, 1, 1, 1, 'CG1302181');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_engagment_type`
--

CREATE TABLE `tbl_caregiver_engagment_type` (
  `caregiver_engagment_type_id` int(11) NOT NULL,
  `engagement_name` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_engagment_type`
--

INSERT INTO `tbl_caregiver_engagment_type` (`caregiver_engagment_type_id`, `engagement_name`, `created_on`, `tbl_admin_user_admin_user_id`) VALUES
(1, 'Regular', '2017-10-11', 'appinion'),
(2, 'Contractual', '2016-09-14', 'appinion'),
(3, 'Shift Wise', '2017-10-09', 'appinion');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_family_contact`
--

CREATE TABLE `tbl_caregiver_family_contact` (
  `caregiver_family_contact_id` int(11) NOT NULL,
  `family_contact_name` varchar(100) NOT NULL,
  `relationship` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `is_emergency` int(11) NOT NULL COMMENT '1=Yes, 0=No',
  `tbl_caregiver_user_caregiver_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_family_contact`
--

INSERT INTO `tbl_caregiver_family_contact` (`caregiver_family_contact_id`, `family_contact_name`, `relationship`, `address`, `phone_number`, `email`, `is_emergency`, `tbl_caregiver_user_caregiver_user_id`) VALUES
(1, 'Mrs. Tripura', 'Wife', '61/2, T.B. Gate, Moakhali, Dhaka 1212', '01845778598', 'test@gmail.com', 1, 'CG1107171'),
(2, 'Proshanto Peres', 'Spouse', 'Ka-50, Kazi Bari, Jagannathpur, Vatara, Dhaka-1219', '_________01', 'xyz@gmail.com', 1, 'CG2509171'),
(3, 'Md. Farid Munsi', 'Spouse', 'East Nurerchala, Boatghat, Holding no. 36, Nasir Saheber bari', '11111111111', 'xyz@gmail.com', 1, 'CG0101171'),
(4, 'Mrs. David Sarker', 'Spouse', 'Senpara, Mirpur-10, House No. 45/4/B, Dhaka-1216', '01682886309', 'xyz@gmail.com', 1, 'CG2001172'),
(5, 'Md. Suruj', 'Father', 'Ati Bazar, Keraniganj, Dhaka', '01731315468', 'xyz@gmail.com', 1, 'CG0108171'),
(6, 'Timothy Baroi', 'Father', 'Amboula ,Poisherhat, Akulchera,Barishal', '01748934837', 's@f', 1, 'CG0105171'),
(7, 'Ashraful Haque', 'Husband', 'House # 417, Masjid Makki Gali, Rampura West, Dhaka', '01728805505', 'test@test.com', 1, 'CG1212161'),
(8, 'Sovaranjan Baroi', 'Father', 'Torky bandar, Barishal', '01720961120', 'xyz@gmail.com', 1, 'CG0101181'),
(9, 'Md. Abu Hosen', 'Spouse', 'House 14, Road 27, Mirpur 11, Dhaka', '01750681023', 'rekhakhatun413@gmail.com', 1, 'CG0512171'),
(10, 'Ratan ballav', 'Friend', 'Same', '01725631885', 's@f', 1, 'CG1302181'),
(11, 'SHIMON BADDIYA', 'FATHER', 'AMBOLA,POYSER HAT ,AGOLJARA,BARISHAL', '11111111111', 's@f', 1, 'CG1302182'),
(12, 'Asim Sarkar', 'Cousin', 'Satarpul, Shabuddin road,Uttor Badda,Dhaka', '01757647511', 's@f', 1, 'CG1302183'),
(13, 'Md. Habibur Rahman', 'Spouse', 'Plot No. 2590/91, East Nurerchala, Masjid Road, Vatara, Badda, Gulshan--2', '01961461986', 'xyz@gmail.com', 1, 'CG0101182'),
(14, 'a', 'a', '', '11111111111', 'a@f', 1, 'CG1303181'),
(15, 'A.nur Islam Deoyan', 'Father', 'Keranigonj', '11111111111', 's@f', 1, 'CG1303182'),
(16, 'Md. nurul Amin', 'Father', 'Keranigonj', '11111111111', 's@f', 1, 'CG1303183'),
(17, 'Abdul Alim', 'Brother', 'dokkhin Mandail, Zinzira, Keranigonj, Dhaka', '01775831302', 's@f', 1, 'CG0703181'),
(18, 'John Doe', 'N/A', '', '00000000000', '', 1, 'CG0101011'),
(19, 'Sunil Biswas', 'Son', 'Same', '01777841974', 's@f', 1, 'CG2703181'),
(20, 'Monju Sarkar', 'Son', '25 no aga sadek road, GPO-1000,Bongshal,Dhaka', '11111111111', 's@f', 1, 'CG2703182'),
(21, 'Daizy casta', 'Spouse', 'Dharendra,Savar,Dhaka', '01734115638', 's@f', 1, 'CG2703183'),
(22, 'Asma Aktar', 'Roommate', 'G-118, Moddho Badda, Dhaka', '01924290967', '', 1, 'CG0604181'),
(23, 'Hafiza Begum', 'Mother', 'Village- Polashbari, Poschim Para, P.O-Gazir Char Alia Madrasa, P.S- Ashulia, District: Savar, Dhaka ', '01916197341', '', 0, 'CG0604181'),
(24, 'Swapan Malakar', 'Brother', '', '01712716636', '', 1, 'CG0304181'),
(25, 'Shamim Bakhtiyar', 'Hostel Man', 'Ahemd Tower, Green Road, Farm Gate, Dhaka', '01743360450', '', 1, 'CG2503182'),
(26, 'Laal Piyan Sang Bawm', 'Brother', '', '', '', 0, 'CG2503182'),
(27, 'Ariful Hasan Rony', 'Roommate', 'K-16/8, Sohan Manjil, Dakkhin Badda', '01968013797', '', 1, 'CG0602181'),
(28, 'Mr. Monir', 'Husband', 'Tatibajar, Keraniganj, Dhaka', '11111111111', 's@f', 1, 'CG1401181'),
(29, 'Sunia Akter', 'Cousin', 'Hospital, Keraniganj, Dhaka', '01724998616', 's@f', 1, 'CG0701181'),
(30, 'Md. Mobarok ', 'Brother', 'Char Sonmania,Sonmania,Kapasia ,Gazipur,Dhaka', '01757617213', 's@f', 1, 'CG1504181'),
(31, 'Asim ', 'Brother', 'Immam Bari,Zinzira,Keranigonj,Dhaka-1310', '01795712966', 's@f', 1, 'CG2204181');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_patient_schedule`
--

CREATE TABLE `tbl_caregiver_patient_schedule` (
  `caregiver_patient_schedule_id` int(11) NOT NULL,
  `tbl_schedule_maker_schedule_maker_id` int(11) NOT NULL,
  `tbl_caregiver_user_caregiver_user_id` varchar(20) NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_patient_schedule`
--

INSERT INTO `tbl_caregiver_patient_schedule` (`caregiver_patient_schedule_id`, `tbl_schedule_maker_schedule_maker_id`, `tbl_caregiver_user_caregiver_user_id`, `tbl_patient_user_patient_id`) VALUES
(1, 1, 'CG1107171', 'PT1306171'),
(3, 3, 'CG0108171', 'PT1306171'),
(4, 4, 'CG2509171', 'PT1905171'),
(9, 9, 'CG1107171', 'PT1306171'),
(10, 10, 'CG0105171', 'PT1905171'),
(11, 11, 'CG0108171', 'PT1905171'),
(14, 14, 'CG2509171', 'PT1002181'),
(15, 15, 'CG0108171', 'PT1306171'),
(16, 16, 'CG0101171', 'PT1808171'),
(17, 17, 'CG0703181', 'PT3101171'),
(18, 18, 'CG0703181', 'PT3101171'),
(19, 19, 'CG0703181', 'PT3101171'),
(21, 21, 'CG0703181', 'PT3101171'),
(22, 22, 'CG0703181', 'PT3101171'),
(23, 23, 'CG0703181', 'PT3101171'),
(24, 24, 'CG1303182', 'PT3101171'),
(25, 25, 'CG1303183', 'PT3101171'),
(26, 26, 'CG1303183', 'PT3101171'),
(27, 27, 'CG1303183', 'PT3101171'),
(28, 28, 'CG1303182', 'PT3101171'),
(29, 29, 'CG1303183', 'PT3101171'),
(30, 30, 'CG1303182', 'PT3101171'),
(31, 31, 'CG1303183', 'PT3101171'),
(32, 32, 'CG1303182', 'PT3101171'),
(33, 33, 'CG1303183', 'PT3101171'),
(34, 34, 'CG0703181', 'PT3101171'),
(35, 35, 'CG1303183', 'PT3101171'),
(36, 36, 'CG0703181', 'PT3101171'),
(37, 37, 'CG1303183', 'PT3101171'),
(38, 38, 'CG0703181', 'PT3101171'),
(39, 39, 'CG1303183', 'PT3101171'),
(40, 40, 'CG0703181', 'PT3101171'),
(41, 41, 'CG1303182', 'PT3101171'),
(42, 42, 'CG1303182', 'PT3101171'),
(43, 43, 'CG1303182', 'PT3101171'),
(44, 44, 'CG1303182', 'PT3101171'),
(45, 45, 'CG1303183', 'PT3101171'),
(46, 46, 'CG1303183', 'PT3101171'),
(49, 49, 'CG0703181', 'PT3101171'),
(50, 50, 'CG0703181', 'PT3101171'),
(51, 51, 'CG2703183', 'PT2703181'),
(52, 52, 'CG2703183', 'PT2703181'),
(53, 53, 'CG2703182', 'PT2703181'),
(54, 54, 'CG2703182', 'PT2703181'),
(55, 55, 'CG2703182', 'PT2703181'),
(56, 56, 'CG2703183', 'PT2703181'),
(57, 57, 'CG1303182', 'PT3101171'),
(58, 58, 'CG1303181', 'PT3101171'),
(60, 60, 'CG1303181', 'PT1306171'),
(61, 61, 'CG2703183', 'PT2703181'),
(62, 62, 'CG2703182', 'PT2703181'),
(63, 63, 'CG1302181', 'PT1611161'),
(64, 64, 'CG1302183', 'PT1611161'),
(65, 65, 'CG1302181', 'PT1611161'),
(66, 66, 'CG1401181', 'PT1808171'),
(67, 67, 'CG1504181', 'PT2703181'),
(69, 69, 'CG1504181', 'PT2703181'),
(70, 70, 'CG1504181', 'PT2703181'),
(71, 71, 'CG1504181', 'PT2703181'),
(72, 72, 'CG1504181', 'PT2703181'),
(73, 73, 'CG2703183', 'PT2703181'),
(74, 74, 'CG2703183', 'PT2703181'),
(75, 75, 'CG2703183', 'PT2703181'),
(76, 76, 'CG2703183', 'PT2703181'),
(77, 77, 'CG2703183', 'PT2703181'),
(78, 78, 'CG2204181', 'PT2703181'),
(79, 79, 'CG2204181', 'PT2703181'),
(80, 80, 'CG2204181', 'PT2703181'),
(81, 81, 'CG2204181', 'PT2703181'),
(82, 82, 'CG2204181', 'PT2703181'),
(83, 83, 'CG1302183', 'PT1611161'),
(84, 84, 'CG1302183', 'PT1611161'),
(85, 85, 'CG2703181', 'PT1611161'),
(86, 86, 'CG2703181', 'PT1611161'),
(87, 87, 'CG2703181', 'PT1611161'),
(88, 88, 'CG2703181', 'PT1611161'),
(89, 89, 'CG1302181', 'PT1611161'),
(90, 90, 'CG1302181', 'PT1611161'),
(91, 91, 'CG1302183', 'PT1611161'),
(92, 92, 'CG2703181', 'PT1611161'),
(93, 93, 'CG1302183', 'PT1611161'),
(94, 94, 'CG1302181', 'PT1611161'),
(95, 95, 'CG1302181', 'PT1611161'),
(96, 96, 'CG2703181', 'PT1611161');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_salary`
--

CREATE TABLE `tbl_caregiver_salary` (
  `caregiver_salary_id` int(11) NOT NULL,
  `fixed_salary_rate` double NOT NULL,
  `hourly_salary_rate` double NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `tbl_bank_payment_bank_id` int(11) NOT NULL DEFAULT '0',
  `bank_account_number` varchar(40) NOT NULL DEFAULT '0',
  `tbl_mobile_payment_method_id` int(11) NOT NULL DEFAULT '0',
  `mobile_payment_number` varchar(14) NOT NULL DEFAULT '0',
  `tbl_caregiver_user_caregiver_user_id` varchar(20) NOT NULL,
  `tbl_caregiver_engagment_type_caregiver_engagment_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_salary`
--

INSERT INTO `tbl_caregiver_salary` (`caregiver_salary_id`, `fixed_salary_rate`, `hourly_salary_rate`, `payment_type`, `tbl_bank_payment_bank_id`, `bank_account_number`, `tbl_mobile_payment_method_id`, `mobile_payment_number`, `tbl_caregiver_user_caregiver_user_id`, `tbl_caregiver_engagment_type_caregiver_engagment_type_id`) VALUES
(1, 10, 48.08, 'Bank', 1, '1526203147390001', 0, '0', 'CG1107171', 3),
(2, 16000, 76.92, 'Bank', 1, '1501203901492001', 0, '0', 'CG2509171', 3),
(3, 10000, 48.08, 'Bank', 1, '1501203901493001', 0, '0', 'CG0101171', 3),
(4, 10000, 0, 'Cash', 0, '0', 0, '0', 'CG2001171', 3),
(5, 10000, 48.08, 'Bank', -1, '211.103.76767', 0, '0', 'CG2001172', 3),
(6, 10000, 48.08, 'Bank', -1, '198.151.102993', 0, '0', 'CG0108171', 3),
(7, 0, 0, 'Cash', 0, '0', 0, '0', 'CG0105171', 3),
(8, 0, 0, 'Cash', 0, '0', 0, '0', 'CG1212161', 1),
(9, 11660, 56.06, 'Cash', 0, '0', 0, '0', 'CG0101181', 3),
(10, 12720, 61.15, 'Cash', 0, '0', 0, '0', 'CG0512171', 1),
(11, 11130, 53.51, 'Bank', 3, '193.151.0084366', 0, '0', 'CG1302181', 3),
(12, 10600, 60, 'Bank', 2, 'Dutch Bangla: 211.151.0195772', 0, '0', 'CG1302182', 1),
(13, 11130, 53.51, 'Bank', 3, '193.151.83764', 0, '0', 'CG1302183', 3),
(14, 10600, 50.96, 'Cash', 0, '0', 0, '0', 'CG0101182', 3),
(15, 0, 0, 'Cash', 0, '0', 0, '0', 'CG1303181', 1),
(16, 0, 0, 'Cash', 0, '0', 0, '0', 'CG1303182', 1),
(17, 0, 0, 'Cash', 0, '0', 0, '0', 'CG1303183', 1),
(18, 0, 0, 'Cash', 0, '0', 0, '0', 'CG0703181', 1),
(19, 0, 0, 'Cash', 0, '0', 0, '0', 'CG0101011', 1),
(20, 0, 0, 'Bank', 3, '193.151.0084387', 0, '0', 'CG2703181', 3),
(21, 0, 0, 'Cash', 0, '0', 0, '0', 'CG2703182', 1),
(22, 0, 0, 'Bank', 8, '350001929', 0, '0', 'CG2703183', 1),
(23, 16000, 76.92, 'Cash', 0, '0', 0, '0', 'CG0604181', 3),
(24, 10000, 48.08, 'Cash', 0, '0', 0, '0', 'CG0304181', 3),
(25, 12000, 0, 'Cash', 0, '0', 0, '0', 'CG2503181', 3),
(26, 12000, 57.69, 'Cash', 0, '0', 0, '0', 'CG2503182', 3),
(27, 10000, 48.08, 'Bank', 2, '1931510095106', 0, '', 'CG0602181', 1),
(28, 10, 48.08, 'Cash', 0, '0', 0, '0', 'CG1401181', 3),
(30, 10, 48.08, 'Cash', 0, '0', 0, '0', 'CG0701181', 1),
(31, 0, 0, 'Mobile', 0, '', 2, '017236210171', 'CG1504181', 1),
(32, 0, 0, 'Bank', 3, '198.103.0012249', 0, '0', 'CG2204181', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_schedule_feedback`
--

CREATE TABLE `tbl_caregiver_schedule_feedback` (
  `tbl_caregiver_schedule_feedback_id` int(11) NOT NULL,
  `tbl_schedule_maker_schedule_maker_id` int(11) NOT NULL,
  `caregiver_schedule_feedback` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_caregiver_schedule_feedback`
--

INSERT INTO `tbl_caregiver_schedule_feedback` (`tbl_caregiver_schedule_feedback_id`, `tbl_schedule_maker_schedule_maker_id`, `caregiver_schedule_feedback`) VALUES
(1, 6, 'Want to watch cricket match.'),
(2, 5, 'Gurta jabo'),
(3, 11, 'পেশেন্ট এর বাসা দূরে'),
(4, 53, 'ব্যাক্তিগত কারনে'),
(5, 77, 'ব্যাক্তিগত কারনে');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caregiver_user`
--

CREATE TABLE `tbl_caregiver_user` (
  `caregiver_user_id` varchar(20) NOT NULL,
  `caregiver_name` varchar(100) NOT NULL,
  `NID_number` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `gender` int(11) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `picture` varchar(500) NOT NULL,
  `joining_date` date NOT NULL,
  `educational_background` varchar(500) NOT NULL,
  `stored_document` varchar(500) NOT NULL,
  `tbl_caregiver_engagment_type_caregiver_engagment_type_id` int(11) NOT NULL,
  `tbl_level_care_type_level_care_type_id` int(11) NOT NULL,
  `tbl_app_user_type_app_user_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_caregiver_user`
--

INSERT INTO `tbl_caregiver_user` (`caregiver_user_id`, `caregiver_name`, `NID_number`, `DOB`, `gender`, `blood_group`, `phone_number`, `email`, `address`, `picture`, `joining_date`, `educational_background`, `stored_document`, `tbl_caregiver_engagment_type_caregiver_engagment_type_id`, `tbl_level_care_type_level_care_type_id`, `tbl_app_user_type_app_user_type_id`) VALUES
('CG0101011', 'Appinion Mgmt CG', '', '2001-01-01', 1, 'A+', '00000000000', '', 'Dhaka, Bangladesh', 'uploads/caregiver_image/caregiver_image_75627.png', '2001-01-01', '', '', 1, 1, 1),
('CG0101171', 'Mst. Parvin Begum', '2610457045337', '1982-08-10', 0, 'B+', '01679043157', 'xyz@gmail.com', 'East Nurerchala, Boatghat, Holding no. 36, Nasir Saheber bari', 'uploads/caregiver_image/caregiver_image_54180.jpg', '2017-01-01', 'Class-8', 'NID, CV, Charecter and citizenship certificate, School certificate (class-8), SAJIDA Foundation loan clearance.', 3, 1, 1),
('CG0101181', 'Mary Baroi', '19722690421343938', '1975-05-30', 0, 'A+', '01675409373', 'xyz@gmail.com', 'Torky bandar, Barishal', 'uploads/caregiver_image/caregiver_image_179238.jpg', '2018-01-01', 'B.A ', 'NID, CV, Character and citizenship certificate', 3, 1, 1),
('CG0101182', 'Sathi Khanom', '', '1987-02-05', 0, 'B+', '01768402406', '', 'Plot No. 2590/91, East Nurerchala, Masjid Road, Vatara, Badda, Gulshan--2', 'uploads/caregiver_image/caregiver_image_49563.jpg', '2018-01-01', 'SSC', 'NID, Charecter Certificate, SSC Certificate', 3, 1, 1),
('CG0105171', 'Jisaoi Baroi', '', '1996-12-12', 1, 'B+', '01749804202', 's@f', 'Amboula ,Poisherhat, Akulchera,Barishal', 'uploads/caregiver_image/caregiver_image_79447.jpg', '2017-05-01', 'BBS (3rd year)', '', 3, 1, 1),
('CG0108171', 'Suma Akter', '', '1992-03-12', 0, 'B+', '01703454033', 'xyz@gmail.com', 'Ati Bazar, Keraniganj, Dhaka', 'uploads/caregiver_image/caregiver_image_92869.jpg', '2017-08-01', 'SSC', 'CV, SSC Certificate, Birth Certificate', 3, 1, 1),
('CG0304181', 'Purobi Malaker', '', '1974-12-23', 0, 'O+', '01908741225', 'purobimalakar444@gmail.com', 'Khilkhet, Nikunja, Jamtala', 'uploads/caregiver_image/caregiver_image_195041.jpg', '2018-04-03', 'BA', 'CV', 3, 1, 1),
('CG0512171', 'Mst. Rekha Khatun', '19958819458000132', '1995-03-03', 0, 'A+', '01723368355', 'rekhakhatun413@gmail.com', 'House no. 14, Road no. 27, Mirpur-11, Dhaka', 'uploads/caregiver_image/caregiver_image_134286.jpg', '2017-12-05', 'SSC', 'NID, CV', 1, 2, 1),
('CG0602181', 'Anik Buishnab', '19934628001000012', '1993-12-09', 1, 'B+', '01820900507', 'aniktripura5@gmail.com', 'k-16/4, Sohan Manjil, Dakkhin Badda, Badda, Dhaka', 'uploads/caregiver_image/caregiver_image_192512.jpg', '2018-02-06', '4 years diploma in nursing', 'CV', 1, 1, 1),
('CG0604181', 'Asma Jahan Lucky', '19940610313000120', '1994-12-10', 0, 'O+', '01630609757', 'asmajahanlucky@gmail.com', 'G-118, Moddho Badda, Dhaka-1212', 'uploads/caregiver_image/caregiver_image_173267.jpg', '2018-04-06', '3 Years Diploma in Midwifery from Brac', 'NID, cv, midwifery training certifiate', 3, 2, 1),
('CG0701181', 'Moriom Mahinoor', '', '1986-05-04', 0, 'A+', '01997144041', '', 'Keraniganj Hospital, Dhaka', 'uploads/caregiver_image/caregiver_image_130559.jpg', '2018-01-07', '', '', 1, 1, 1),
('CG0703181', 'Rozina Akhter Akhi', '111111111111111', '1994-02-01', 0, 'A+', '01633903573', '', 'Dokkhin mandail, Zinzira, Keranigonj ,Dhaka', 'uploads/caregiver_image/caregiver_image_110266.jpg', '2017-08-31', 'SSC,HSC,BBS (Final year)', '', 1, 1, 1),
('CG1107171', 'Ananda Tripura', '19914628002000008', '1991-12-10', 1, 'O+', '01845778598', 'test@gmail.com', '61/2, T.B. Gate, Moakhali, Dhaka 1212', 'uploads/caregiver_image/caregiver_image_114967.jpg', '2017-07-11', 'HSC; Completed Ayurvedic Training in India', '', 3, 1, 1),
('CG1212161', 'Dilruba Begum', '', '1991-11-19', 0, 'O+', '01630925919', 'test@test.com', 'House # 417, Masjid Makki Gali, Rampura West, Dhaka', 'uploads/caregiver_image/caregiver_image_195065.jpg', '2016-12-12', '', '', 1, 3, 1),
('CG1302181', 'Kamal Ballav ', '19970619452007976', '1997-09-09', 1, 'B+', '01743870625', 's@f', 'Shatar Kul, Porodia Road, Uttor Badda, Dhaka', 'uploads/caregiver_image/caregiver_image_118933.jpg', '2018-02-13', 'HSC', '', 3, 1, 1),
('CG1302182', 'Mily Baidya', '20000610207025548', '1998-11-28', 0, 'A+', '01749294389', 's@f', 'AMBOLA,POYSER HAT ,AGOLJARA,BARISHAL', 'uploads/caregiver_image/caregiver_image_27986.jpg', '2018-02-13', 'SSC', 'Birth Certificate, SSC Certificate', 1, 1, 1),
('CG1302183', 'Ratan Ballav', '', '1998-10-09', 1, 'O+', '01725631885', 's@f', 'Permanent Address: Munsi Talluk, Jollah,Ujirpur, Barishal', 'uploads/caregiver_image/caregiver_image_115641.jpg', '2018-02-13', 'HSC, SSC', '', 3, 1, 1),
('CG1303181', 'Parinita Dakua', '12345678910', '1987-06-17', 0, 'B+', '01771253100', 'a@f', 'a', 'uploads/caregiver_image/caregiver_image_116145.jpg', '2018-03-13', 'HSC, SSC', '', 1, 1, 1),
('CG1303182', 'Nur Nahar Era Moyna', '19882643869018793', '1988-06-12', 0, 'B+', '01830388096', '', 'Kaligonj,Shuvadda,Keranigonj,Dhaka', 'uploads/caregiver_image/caregiver_image_54668.jpg', '2018-03-13', 'SSC,BNS', '', 1, 1, 1),
('CG1303183', 'Nurun Nahar Akter (Nondi)', '19958537669001881', '1995-11-12', 0, 'O+', '01703543726', '', 'Keranigonj', 'uploads/caregiver_image/caregiver_image_59922.jpg', '2018-03-13', '', '', 1, 1, 1),
('CG1401181', 'Mukta Begum', '', '1991-01-17', 0, 'A+', '01992775850', '', 'Tatibajar, Keraniganj, Dhaka', 'uploads/caregiver_image/caregiver_image_65001.jpg', '2018-01-14', 'HSC', '', 3, 1, 1),
('CG1504181', 'Imran Hasan', '11111111111', '1996-02-20', 1, 'O+', '01756830322', 'befamousimran@gmail.com', '75/3-6, Ahmed Tower, Green Road, Farmgate,Dhaka-1215', 'uploads/caregiver_image/caregiver_image_182685.jpg', '2018-04-15', 'LLB (Hons)', '', 1, 1, 1),
('CG2001172', 'David Sarker', '19942914715000009', '1994-09-23', 1, 'O+', '01748493979', 'xyz@gmail.com', 'Senpara, Mirpur-10, House No. 45/4/B, Dhaka-1216', 'uploads/caregiver_image/caregiver_image_161601.jpg', '2017-01-20', 'SSC', 'NID, CV, SSC certificate, Police verification, driving license', 3, 1, 1),
('CG2204181', 'Gautom Chandra Shil', '', '1997-02-06', 1, 'B+', '01793303318', 'srigautomchandrashil18@gmail.com', 'Immam Bari,Zinzira,Keranigonj,Dhaka-1310', 'uploads/caregiver_image/caregiver_image_131798.jpg', '2018-04-22', 'SSC,HSC', '', 1, 1, 1),
('CG2503181', 'Martin Luther Bawm', '', '1998-02-12', 1, 'B+', '01515653959', 'martinbawm0007@gmail.com', 'Ahmed Tower, Green Road, Farmgate, Dhaka', 'uploads/caregiver_image/caregiver_image_226326.jpg', '2018-03-25', 'HSC', 'CV, Certificates', 3, 1, 1),
('CG2503182', 'Martin Luther Bawm', '', '1998-02-12', 1, 'B+', '01515653959', 'martinbawm0007@gmail.com', 'Ahmed Tower, Green Road, Farm Gate, Dhaka', 'uploads/caregiver_image/caregiver_image_79123.jpg', '2018-03-25', 'HSC', 'CV, Certificates', 3, 1, 1),
('CG2509171', 'Provati Gomes', '2692618509607', '1970-06-06', 0, 'O+', '01720118556', 'xyz@gmail.com', 'Ka-50, Kazi Bari, Jagannathpur, Vatara, Dhaka-1219', 'uploads/caregiver_image/caregiver_image_16929.jpg', '2017-09-25', 'SSC', 'NID, Registration from Bangladesh Nursing Council, Certificate from Kumudini Hospital and Kumudini Hospital School of Nursing', 3, 2, 1),
('CG2703181', 'Subrata Biswas', '1999061945205852', '1999-05-03', 1, 'A+', '01756287513', 's@f', 'Vill: Karfa,  Uzirpur,Barishal ', 'uploads/caregiver_image/caregiver_image_156131.jpg', '2018-03-27', 'HSC, SSC', '', 3, 1, 1),
('CG2703182', 'Barun Sarkar', '19963090269133451', '1996-10-12', 1, 'A+', '01764240007', '', 'DC Stuff quarter, Kototali,Dhaka\r\n ', 'uploads/caregiver_image/caregiver_image_242616.jpg', '2018-03-27', '', '', 1, 1, 1),
('CG2703183', 'Dipon Augustine Rozario', '', '1984-07-28', 1, 'A+', '01716160397', 's@f', 'Vill: Dharenda, Post: Savar,Thana: Savar,Dhaka', 'uploads/caregiver_image/caregiver_image_207853.jpg', '2018-03-22', 'HSC, SSC', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultant_patient_schedule`
--

CREATE TABLE `tbl_consultant_patient_schedule` (
  `consultant_patient_schedule_id` int(11) NOT NULL,
  `tbl_schedule_maker_schedule_maker_id` int(11) NOT NULL,
  `tbl_consultant_user_consultant_user_id` varchar(20) NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultant_type`
--

CREATE TABLE `tbl_consultant_type` (
  `consultant_type_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_consultant_type`
--

INSERT INTO `tbl_consultant_type` (`consultant_type_id`, `type_name`, `created_on`, `tbl_admin_user_admin_user_id`) VALUES
(1, 'Medicine', '2017-10-08', 'appinion'),
(2, 'Orthopedics', '2017-10-08', 'appinion'),
(3, 'Gynecologist', '2017-10-08', 'appinion'),
(4, 'Respiratory Specialist', '2017-10-10', 'appinion');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultant_user`
--

CREATE TABLE `tbl_consultant_user` (
  `consultant_user_id` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `address` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` bigint(14) DEFAULT NULL,
  `tbl_consultant_type_consultant_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level_care_type`
--

CREATE TABLE `tbl_level_care_type` (
  `level_care_type_id` int(11) NOT NULL,
  `level_name` varchar(200) NOT NULL,
  `description` varchar(1200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_level_care_type`
--

INSERT INTO `tbl_level_care_type` (`level_care_type_id`, `level_name`, `description`, `created_on`) VALUES
(1, 'Level 1', 'Personal Care: Assistance with mobility, dressing, washing, oral feeding, socialization and basic healtth management.', '2017-10-03'),
(2, 'Level 2', 'Personal Care plus Basic Clinical Care: Vital sign monitoring, oxygen therapy, wound care, ostomy care, tube feeding, medication and pain management, catheterization.', '2017-03-19'),
(3, 'Level 3', 'Personal Care plus Advanced Clinical Care:Comprehensive clinical care and continuous clinical monitoring.', '2017-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mobile_payment_method`
--

CREATE TABLE `tbl_mobile_payment_method` (
  `payment_method_id` int(11) NOT NULL,
  `payment_method_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_mobile_payment_method`
--

INSERT INTO `tbl_mobile_payment_method` (`payment_method_id`, `payment_method_name`) VALUES
(1, 'Bkash'),
(2, 'Rocket'),
(3, 'Sure Cash'),
(4, 'My Cash'),
(5, 'U Cash');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_family_contact`
--

CREATE TABLE `tbl_patient_family_contact` (
  `patient_family_contact_id` int(11) NOT NULL,
  `family_contact_name` varchar(100) NOT NULL,
  `relationship` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(40) NOT NULL,
  `is_emergency` int(11) NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_patient_family_contact`
--

INSERT INTO `tbl_patient_family_contact` (`patient_family_contact_id`, `family_contact_name`, `relationship`, `address`, `phone_number`, `email`, `is_emergency`, `tbl_patient_user_patient_id`) VALUES
(1, 'Safia Choudhury', 'Daughter', 'Gulshan', '01711538981', 'bindi24000@gmail.com', 1, 'PT1306171'),
(2, 'Taskin Fahmina', 'Daughter', 'House-35, Road-117, Gulshan Avenue', '01711405188', 'taskin133@gmail.com', 1, 'PT1808171'),
(3, 'Advocate Adilur Rahman Khan', 'Son', '', '01711405188', '', 0, 'PT1808171'),
(4, 'Rounaq Jahan', 'Daughter', 'Gulshan', '01713244372', 'rounaq44@gmail.com', 1, 'PT1905171'),
(5, 'Ahmad Munir', 'Son', 'Abu Dhabi, UAE', '', 'ahmadamunir@gmail.com', 0, 'PT1905171'),
(6, 'Dr. Kabir', 'Son', '', '', '', 0, 'PT1905171'),
(7, 'Mithu', 'Son', 'House-15, Road-4, Gulshan-1', '01780461205', 'bdunnyan73@gmail.com', 1, 'PT1002181'),
(8, 'Mrs. Jarin', 'Relative', 'Plot-13, Road 112, Mamtaz Apartments, Gulshan-2', '00000000000', 'xyz@gmail.com', 1, 'PT2701181'),
(9, 'Safi Rahman Khan', 'Son', 'Gulshan-2', '01714073633', 'xyz@gmail.com', 1, 'PT1611161'),
(10, 'Safi Rahman Khan', 'Son', 'Gulshan-2', '01714073633', 'xyz@gmail.com', 1, 'PT1701181'),
(11, 'Sumon Sir', 'Son', 'Banani', '01713082683', 'xyz@gmail.com', 1, 'PT0107161'),
(12, 'Rahat Amir', 'Daughter ', 'B-09,AP-1103,Japan Garden City,Mohhamadpur', '01715433264', 's@f', 1, 'PT3101171'),
(13, 'John Doe', 'N/A', '', '00000000000', '', 1, 'PT0101011'),
(14, 'a', 'a', 'sample', '11111111111', '1@a', 1, 'PT2703181');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_medical_history`
--

CREATE TABLE `tbl_patient_medical_history` (
  `patient_medical_history_id` int(11) NOT NULL,
  `disease` varchar(200) NOT NULL,
  `time_period` varchar(200) NOT NULL,
  `activities` varchar(1200) NOT NULL,
  `medication` varchar(1200) NOT NULL,
  `created_date` date NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient_user`
--

CREATE TABLE `tbl_patient_user` (
  `patient_id` varchar(20) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `NID_number` varchar(20) DEFAULT NULL,
  `DOB` date NOT NULL,
  `gender` int(11) DEFAULT NULL COMMENT '1= male, 0= female',
  `blood_group` varchar(255) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `picture` varchar(500) DEFAULT NULL,
  `joining_date` date NOT NULL,
  `tbl_level_care_type_level_care_type_id` int(11) DEFAULT NULL,
  `tbl_referral_referral_id` int(11) DEFAULT NULL,
  `tbl_area_code_area_code_id` int(11) DEFAULT NULL,
  `tbl_app_user_type_app_user_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_patient_user`
--

INSERT INTO `tbl_patient_user` (`patient_id`, `patient_name`, `NID_number`, `DOB`, `gender`, `blood_group`, `phone_number`, `email`, `address`, `picture`, `joining_date`, `tbl_level_care_type_level_care_type_id`, `tbl_referral_referral_id`, `tbl_area_code_area_code_id`, `tbl_app_user_type_app_user_type_id`) VALUES
('PT0101011', 'Appinion Mgmt PT', '', '2001-01-01', 1, 'A+', '00000000000', '', 'Dhaka, Bangladesh', 'uploads/patient_image/patient_image_84698.png', '2001-01-01', 1, 1, 1229, 2),
('PT0107161', 'Hafiza Akter Chowdhury', '', '1945-03-01', 0, 'A+', '01713082683', '', 'Banani', NULL, '2016-07-01', 1, 1, 1229, 2),
('PT1002181', 'Haji Md. Shahjahan', '', '1968-01-01', 1, 'A+', '01711434557', 'bdunnyan2@gmail.com', 'House-15, Road-4, Gulshan-1, First Floor, Flat-A.', 'uploads/patient_image/patient_image_44905.jpg', '2018-02-10', 1, 2, 1229, 2),
('PT1306171', 'Mr. Shamsuddoha', '', '1946-01-01', 1, 'A+', '01711538981', '', 'House 4A, Road 139, Gulshan-1', NULL, '2017-06-13', 1, 1, 1229, 2),
('PT1611161', 'Mr. Harun-ur-Rashid', '', '1935-01-01', 1, 'A+', '01714073633', '', 'Gulshan-2', NULL, '2016-11-16', 1, 1, 1229, 2),
('PT1701181', 'Mrs. Sarowar Murshed Khan', '', '1943-01-01', 0, 'A+', '01714073633', '', 'Gulshan-2', NULL, '2018-01-17', 1, 1, 1229, 2),
('PT1808171', 'Farida Banu', '', '1942-01-01', 0, 'A+', '01819267700', '', 'House-35, Road-117, Gulshan-1', 'uploads/patient_image/patient_image_77070.jpg', '2017-08-18', 1, 1, 1229, 2),
('PT1905171', 'Razia Begum', '', '1924-01-01', 0, 'A+', '01819267700', '', 'Gulshan-2', NULL, '2017-05-19', 1, 1, 1229, 2),
('PT2701181', 'Dr. Lutfunnessa Ahmed', '', '1950-01-01', 0, 'A+', '00000000000', '', 'Plot-13, Road-112, Mamtaz Apartments, Gulshan-2', NULL, '2018-01-27', 2, 1, 1229, 2),
('PT2703181', 'Ruhul Amin', '11111111111111111', '2018-03-27', 1, 'A+', '11111111111', '', 'Banani,Dhaka', 'uploads/patient_image/patient_image_66872.jpg', '2018-03-27', 1, 2, 1229, 2),
('PT3101171', 'Nazma Haque', '11111111111', '1945-04-19', 0, 'O+', '01552548592', '', 'B-09,Ap-1103,Japan garden city,Mohhammadpur', NULL, '2017-01-31', 1, 1, 1229, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preferable_caregiver_list`
--

CREATE TABLE `tbl_preferable_caregiver_list` (
  `preferable_caregiver_list_id` int(11) NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL,
  `tbl_caregiver_user_caregiver_user_id` varchar(20) NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_preferable_caregiver_list`
--

INSERT INTO `tbl_preferable_caregiver_list` (`preferable_caregiver_list_id`, `tbl_patient_user_patient_id`, `tbl_caregiver_user_caregiver_user_id`, `tbl_admin_user_admin_user_id`) VALUES
(16, 'PT1808171', 'CG0101171', 'appinion'),
(17, 'PT1905171', 'CG2001172', 'appinion'),
(18, 'PT1905171', 'CG2509171', 'appinion'),
(19, 'PT1306171', 'CG0108171', 'appinion'),
(20, 'PT1306171', 'CG1107171', 'appinion'),
(21, 'PT2701181', 'CG2509171', 'appinion'),
(22, 'PT1701181', 'CG0101181', 'appinion'),
(23, 'PT3101171', 'CG1303181', 'SF_IT'),
(24, 'PT3101171', 'CG1303182', 'SF_IT'),
(25, 'PT3101171', 'CG1303183', 'SF_IT'),
(33, 'PT2703181', 'CG1504181', 'appinion'),
(34, 'PT2703181', 'CG2703182', 'appinion'),
(35, 'PT2703181', 'CG2703183', 'appinion'),
(36, 'PT1611161', 'CG1302181', 'appinion'),
(37, 'PT1611161', 'CG1302183', 'appinion'),
(38, 'PT1611161', 'CG2703181', 'appinion');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotional_category`
--

CREATE TABLE `tbl_promotional_category` (
  `promotional_category_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_promotional_category`
--

INSERT INTO `tbl_promotional_category` (`promotional_category_id`, `category_name`, `created_on`) VALUES
(1, 'Commode Chair', '2018-02-01'),
(2, 'Walker', '2018-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotional_items`
--

CREATE TABLE `tbl_promotional_items` (
  `promotional_item_id` int(11) NOT NULL,
  `promotional_name` varchar(200) NOT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_description` varchar(1200) DEFAULT NULL,
  `item_price` double NOT NULL,
  `item_picture` varchar(1200) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1=Available, 0=Not Available',
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL,
  `tbl_promotional_category_promotional_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_promotional_items`
--

INSERT INTO `tbl_promotional_items` (`promotional_item_id`, `promotional_name`, `item_quantity`, `item_description`, `item_price`, `item_picture`, `status`, `tbl_admin_user_admin_user_id`, `tbl_promotional_category_promotional_category_id`) VALUES
(1, 'Commode Chair', 10, 'Our Commode Chairs section features padded versions, basketweave, a popular bedroom commode chair and many more. Our commode chairs are effective and affordable toileting aids which are beautifully designed. A commode chair aids elderly and disabled people in remaining independent and maintains dignity thanks to its inconspicious design.', 1000, 'uploads/promotional_items/promo_item_14031006.jpg', 1, 'appinion', 1),
(2, 'Al Walker', 5, 'A walker or walking frame is a tool for disabled or elderly people who need additional support to maintain balance or stability while walking. In the United Kingdom, a common equivalent term for a walker is Zimmer frame, a genericised trademark from Zimmer Holdings, a major manufacturer of such devices and joint ...', 1500, 'uploads/promotional_items/promo_item_3143733.jpg', 1, 'appinion', 2),
(3, 'Knee Walker', 4, 'A walker or walking frame is a tool for disabled or elderly people who need additional support to maintain balance or stability while walking. In the United Kingdom, a common equivalent term for a walker is Zimmer frame, a genericised trademark from Zimmer Holdings, a major manufacturer of such devices and joint ...', 2000, 'uploads/promotional_items/promo_item_9724661.jpeg', 1, 'appinion', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotional_item_request`
--

CREATE TABLE `tbl_promotional_item_request` (
  `promotional_item_request_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_accepted` int(11) NOT NULL,
  `tbl_promotional_items_pomotional_item_id` int(11) NOT NULL,
  `tbl_patient_user_patient_id` varchar(20) NOT NULL,
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_promotional_item_request`
--

INSERT INTO `tbl_promotional_item_request` (`promotional_item_request_id`, `date`, `is_accepted`, `tbl_promotional_items_pomotional_item_id`, `tbl_patient_user_patient_id`, `tbl_admin_user_admin_user_id`) VALUES
(1, '2018-02-11 09:02:00', 1, 1, 'PT1306171', 'appinion'),
(2, '2018-02-11 09:03:03', 1, 2, 'PT1306171', 'appinion'),
(3, '2018-03-14 03:32:24', 0, 3, 'PT1002181', 'appinion'),
(4, '2018-03-14 03:33:04', 0, 1, 'PT3101171', 'appinion'),
(5, '2018-03-14 03:33:11', 0, 2, 'PT3101171', 'appinion'),
(6, '2018-03-14 03:33:13', 0, 3, 'PT3101171', 'appinion'),
(7, '2018-03-14 04:18:01', 0, 1, 'PT2701181', 'appinion'),
(8, '2018-03-14 04:53:20', 0, 2, 'PT2701181', 'appinion'),
(9, '2018-03-14 05:32:48', 0, 3, 'PT2701181', 'appinion'),
(10, '2018-03-14 05:48:44', 0, 1, 'PT1002181', 'appinion'),
(11, '2018-03-14 05:56:15', 0, 2, 'PT1808171', 'appinion'),
(12, '2018-03-14 07:24:27', 0, 1, 'PT1905171', 'appinion'),
(13, '2018-03-14 07:26:40', 0, 2, 'PT1002181', 'appinion');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_referral`
--

CREATE TABLE `tbl_referral` (
  `referral_id` int(11) NOT NULL,
  `referral_name` varchar(200) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_referral`
--

INSERT INTO `tbl_referral` (`referral_id`, `referral_name`, `organization`, `designation`) VALUES
(1, 'Zahida Fizza Kabir', 'SAJIDA Foundation', 'Executive Director'),
(2, 'Dr. Shamsher Ali Khan', 'SAJIDA Foundation', 'Senior Director (Socio Eco Development)');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_maker`
--

CREATE TABLE `tbl_schedule_maker` (
  `schedule_maker_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` bigint(14) NOT NULL,
  `end_time` bigint(14) NOT NULL,
  `carehours` bigint(14) DEFAULT NULL,
  `clock_in_time` bigint(14) DEFAULT NULL,
  `clock_out_time` bigint(14) DEFAULT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `feedback` varchar(255) NOT NULL,
  `is_feedback_given` tinyint(1) NOT NULL,
  `feedback_to_be_given` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=false, 1=true',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL COMMENT '0=no clock in/clockout, 1=clock in, 2= clock out',
  `tbl_admin_user_admin_user_id` varchar(20) NOT NULL,
  `tbl_service_type_service_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_schedule_maker`
--

INSERT INTO `tbl_schedule_maker` (`schedule_maker_id`, `schedule_date`, `start_time`, `end_time`, `carehours`, `clock_in_time`, `clock_out_time`, `rating`, `feedback`, `is_feedback_given`, `feedback_to_be_given`, `created_date`, `status`, `tbl_admin_user_admin_user_id`, `tbl_service_type_service_type_id`) VALUES
(1, '2018-02-01', 1517493600000, 1517536800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-01 00:00:00', 0, 'appinion', 1),
(3, '2018-02-01', 1517450400000, 1517493600000, NULL, 1517485020369, NULL, 0, '', 0, 0, '2018-02-01 11:42:00', 1, 'appinion', 1),
(4, '2018-02-01', 1517450400000, 1517493600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-01 00:00:00', 0, 'appinion', 1),
(9, '2018-02-05', 1517803200000, 1517828400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-01 00:00:00', 0, 'appinion', 1),
(10, '2018-02-05', 1517803200000, 1517828400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-01 00:00:00', 0, 'appinion', 1),
(11, '2018-02-04', 1517716800000, 1517742000000, 1340346, 1517720079838, 1517721420184, 0, '', 0, 0, '2018-02-04 05:16:59', 2, 'appinion', 1),
(14, '2018-02-11', 1518321600000, 1518346800000, NULL, NULL, NULL, 5, '', 1, 0, '2018-02-11 09:43:55', 0, 'appinion', 1),
(15, '2018-02-11', 1518321600000, 1518346800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-11 00:00:00', 0, 'appinion', 1),
(16, '2018-02-11', 1518321600000, 1518433200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-02-11 00:00:00', 0, 'appinion', 1),
(17, '2018-03-15', 1521122400000, 1521165600000, 327829, 1521090344563, 1521090672392, 0, '', 0, 1, '2018-03-15 00:00:00', 2, 'SF_IT', 1),
(18, '2018-03-16', 1521208800000, 1521252000000, NULL, 1521208901076, NULL, 0, '', 0, 0, '2018-03-16 14:06:40', 1, 'SF_IT', 1),
(19, '2018-03-17', 1521295200000, 1521338400000, NULL, 1521294917864, NULL, 0, '', 0, 0, '2018-03-17 14:00:17', 1, 'SF_IT', 1),
(21, '2018-03-18', 1521381600000, 1521424800000, NULL, 1521381342014, NULL, 0, '', 0, 0, '2018-03-18 14:00:40', 1, 'SF_IT', 1),
(22, '2018-03-19', 1521468000000, 1521511200000, NULL, 1521467718868, NULL, 0, '', 0, 0, '2018-03-19 14:00:17', 1, 'SF_IT', 1),
(23, '2018-03-22', 1521727200000, 1521770400000, NULL, 1521727178348, NULL, 0, '', 0, 0, '2018-03-22 14:04:35', 1, 'SF_IT', 1),
(24, '2018-03-16', 1521165600000, 1521208800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-15 00:00:00', 0, 'SF_IT', 1),
(25, '2018-03-17', 1521252000000, 1521295200000, 42605890, 1521252057518, 1521294663408, 0, '', 0, 1, '2018-03-17 13:51:02', 2, 'SF_IT', 1),
(26, '2018-03-18', 1521338400000, 1521381600000, 43488065, 1521338122742, 1521381610807, 0, '', 0, 1, '2018-03-18 14:00:09', 2, 'SF_IT', 1),
(27, '2018-03-19', 1521424800000, 1521468000000, NULL, 1521424619459, NULL, 0, '', 0, 0, '2018-03-19 02:01:57', 1, 'SF_IT', 1),
(28, '2018-03-20', 1521511200000, 1521554400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-18 00:00:00', 0, 'SF_IT', 1),
(29, '2018-03-20', 1521554400000, 1521597600000, NULL, 1521554104547, NULL, 0, '', 0, 0, '2018-03-20 14:00:02', 1, 'SF_IT', 1),
(30, '2018-03-21', 1521597600000, 1521640800000, 39285352, 1521601874133, 1521641159485, 0, '', 0, 1, '2018-03-21 14:05:57', 2, 'SF_IT', 1),
(31, '2018-03-21', 1521640800000, 1521684000000, 44937860, 1521640897146, 1521685835006, 0, '', 0, 1, '2018-03-22 02:30:31', 2, 'SF_IT', 1),
(32, '2018-03-22', 1521684000000, 1521727200000, 45580049, 1521685558286, 1521731138335, 0, '', 0, 1, '2018-03-22 15:05:35', 2, 'SF_IT', 1),
(33, '2018-03-23', 1521770400000, 1521813600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-18 00:00:00', 0, 'SF_IT', 1),
(34, '2018-03-23', 1521813600000, 1521856800000, 42606822, 1521813927859, 1521856534681, 0, '', 0, 1, '2018-03-24 01:55:30', 2, 'SF_IT', 1),
(35, '2018-03-24', 1521856800000, 1521900000000, 45135854, 1521856627616, 1521901763470, 0, '', 0, 1, '2018-03-24 14:29:19', 2, 'SF_IT', 1),
(36, '2018-03-24', 1521900000000, 1521943200000, 41776229, 1521901496729, 1521943272958, 0, '', 0, 1, '2018-03-25 02:01:08', 2, 'SF_IT', 1),
(37, '2018-03-25', 1521943200000, 1521986400000, 43259927, 1521943002124, 1521986262051, 0, '', 0, 1, '2018-03-25 13:57:38', 2, 'SF_IT', 1),
(38, '2018-03-25', 1521986400000, 1522029600000, NULL, 1521986116503, NULL, 0, '', 0, 0, '2018-03-25 14:00:12', 1, 'SF_IT', 1),
(39, '2018-03-26', 1522029600000, 1522072800000, 41979872, 1522030706361, 1522072686233, 0, '', 0, 1, '2018-03-26 13:58:01', 2, 'SF_IT', 1),
(40, '2018-03-26', 1522072800000, 1522116000000, 45364005, 1522072510106, 1522117874111, 0, '', 0, 1, '2018-03-27 02:31:09', 2, 'SF_IT', 1),
(41, '2018-03-27', 1522116000000, 1522159200000, 40396362, 1522118797568, 1522159193930, 0, '', 0, 1, '2018-03-27 13:59:49', 2, 'SF_IT', 1),
(42, '2018-03-28', 1522202400000, 1522245600000, 42716545, 1522203085889, 1522245802434, 0, '', 0, 1, '2018-03-28 14:03:16', 2, 'SF_IT', 1),
(43, '2018-03-29', 1522288800000, 1522332000000, 42463393, 1522289720692, 1522332184085, 0, '', 0, 1, '2018-03-29 14:02:58', 2, 'SF_IT', 1),
(44, '2018-03-30', 1522375200000, 1522418400000, 42691553, 1522375814021, 1522418505574, 0, '', 0, 1, '2018-03-30 14:01:45', 2, 'SF_IT', 1),
(45, '2018-03-27', 1522159200000, 1522202400000, 44432169, 1522158925433, 1522203357602, 0, '', 0, 1, '2018-03-28 02:15:51', 2, 'SF_IT', 1),
(46, '2018-03-28', 1522245600000, 1522288800000, 44533506, 1522245470683, 1522290004189, 0, '', 0, 1, '2018-03-29 02:19:58', 2, 'SF_IT', 1),
(49, '2018-03-29', 1522332000000, 1522375200000, NULL, 1522331901949, NULL, 0, '', 0, 0, '2018-03-29 14:03:16', 1, 'SF_IT', 1),
(50, '2018-03-30', 1522418400000, 1522461600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(51, '2018-03-27', 1522112400000, 1522155600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(52, '2018-03-28', 1522198800000, 1522242000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(53, '2018-03-29', 1522285200000, 1522328400000, 24033031, 1522297096241, 1522321129272, 0, '', 0, 1, '2018-03-29 10:58:49', 2, 'SF_IT', 1),
(54, '2018-03-30', 1522371600000, 1522414800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(55, '2018-03-31', 1522458000000, 1522501200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(56, '2018-04-01', 1522544400000, 1522587600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-03-27 00:00:00', 0, 'SF_IT', 1),
(57, '2018-04-04', 1522814400000, 1522926000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-04 00:00:00', 0, 'SF_IT', 1),
(58, '2018-04-10', 1523332800000, 1523444400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-04 00:00:00', 0, 'SF_IT', 1),
(60, '2018-04-11', 1523455200000, 1523498400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-10 00:00:00', 0, 'SF_IT', 1),
(61, '2018-04-11', 1523408400000, 1523451600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-11 00:00:00', 0, 'SF_IT', 1),
(62, '2018-04-12', 1523494800000, 1523538000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-11 00:00:00', 0, 'SF_IT', 1),
(63, '2018-04-11', 1523412000000, 1523455200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-11 00:00:00', 0, 'SF_IT', 1),
(64, '2018-04-11', 1523455200000, 1523498400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-11 00:00:00', 0, 'SF_IT', 1),
(65, '2018-04-12', 1523498400000, 1523541600000, 43200000, 1523498400000, 1523541600000, 0, '', 0, 1, '2018-04-12 10:03:21', 2, 'SF_IT', 1),
(66, '2018-04-17', 1523962800000, 1524020400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-16 00:00:00', 0, 'S03075', 1),
(67, '2018-04-22', 1524405600000, 1524448800000, 41816149, 1524407138262, 1524448954411, 0, '', 0, 1, '2018-04-23 02:02:34', 2, 'SF_IT', 1),
(69, '2018-04-25', 1524664800000, 1524708000000, 41879587, 1524665104569, 1524706984156, 0, '', 0, 1, '2018-04-26 01:43:05', 2, 'SF_IT', 1),
(70, '2018-04-26', 1524751200000, 1524794400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(71, '2018-04-27', 1524837600000, 1524880800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(72, '2018-04-28', 1524924000000, 1524967200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(73, '2018-04-23', 1524448800000, 1524492000000, NULL, 1524448715299, NULL, 0, '', 0, 0, '2018-04-23 02:03:35', 1, 'SF_IT', 1),
(74, '2018-04-24', 1524535200000, 1524578400000, NULL, 1524535200000, NULL, 0, '', 0, 0, '2018-04-24 03:40:51', 1, 'SF_IT', 1),
(75, '2018-04-25', 1524621600000, 1524664800000, NULL, 1524621600000, NULL, 0, '', 0, 0, '2018-04-25 03:13:08', 1, 'SF_IT', 1),
(76, '2018-04-26', 1524708000000, 1524751200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(77, '2018-04-22', 1524378900000, 1524394800000, 906709, 1524378642233, 1524379548942, 0, '', 0, 1, '2018-04-22 06:45:49', 2, 'SF_IT', 1),
(78, '2018-04-26', 1524708000000, 1524751200000, NULL, 1524708306102, NULL, 0, '', 0, 0, '2018-04-26 02:10:05', 1, 'SF_IT', 1),
(79, '2018-04-27', 1524794400000, 1524837600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(80, '2018-04-22', 1524405600000, 1524448800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(81, '2018-04-23', 1524492000000, 1524535200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(82, '2018-04-24', 1524578400000, 1524621600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-22 00:00:00', 0, 'SF_IT', 1),
(83, '2018-04-24', 1524535200000, 1524578400000, NULL, 1524535200000, NULL, 0, '', 0, 0, '2018-04-24 03:39:13', 1, 'SF_IT', 1),
(84, '2018-04-25', 1524621600000, 1524664800000, NULL, 1524621600000, NULL, 0, '', 0, 0, '2018-04-25 03:12:21', 1, 'SF_IT', 1),
(85, '0000-00-00', 1524708000000, 1524751200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-26 00:00:00', 0, 'SF_IT', 1),
(86, '2018-04-24', 1524578400000, 1524621600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(87, '2018-04-25', 1524664800000, 1524708000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(88, '2018-04-27', 1524794400000, 1524837600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(89, '2018-04-26', 1524751200000, 1524794400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(90, '2018-04-27', 1524837600000, 1524880800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(91, '2018-04-28', 1524924000000, 1524967200000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(92, '2018-04-28', 1524880800000, 1524924000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(93, '2018-04-29', 1525010400000, 1525053600000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(94, '2018-04-29', 1524967200000, 1525010400000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(95, '2018-04-30', 1525053600000, 1525096800000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1),
(96, '2018-04-30', 1525096800000, 1525140000000, NULL, NULL, NULL, 0, '', 0, 0, '2018-04-23 00:00:00', 0, 'SF_IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_type`
--

CREATE TABLE `tbl_service_type` (
  `service_type_id` int(11) NOT NULL,
  `service_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_type`
--

INSERT INTO `tbl_service_type` (`service_type_id`, `service_type_name`) VALUES
(1, 'Caregiver'),
(2, 'Consultant');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_login`
--
ALTER TABLE `tbl_admin_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `tbl_admin_login_tbl_admin_user` (`tbl_admin_user_admin_user_id`);

--
-- Indexes for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  ADD PRIMARY KEY (`admin_user_id`),
  ADD KEY `tbl_admin_user_tbl_admin_user_type` (`tbl_admin_user_type_admin_user_type_id`);

--
-- Indexes for table `tbl_admin_user_type`
--
ALTER TABLE `tbl_admin_user_type`
  ADD PRIMARY KEY (`admin_user_type_id`);

--
-- Indexes for table `tbl_app_user_login`
--
ALTER TABLE `tbl_app_user_login`
  ADD PRIMARY KEY (`app_user_login_id`),
  ADD KEY `tbl_app_user_login_tbl_app_user_type` (`tbl_app_user_type_app_user_type_id`);

--
-- Indexes for table `tbl_app_user_type`
--
ALTER TABLE `tbl_app_user_type`
  ADD PRIMARY KEY (`app_user_type_id`);

--
-- Indexes for table `tbl_area_code`
--
ALTER TABLE `tbl_area_code`
  ADD PRIMARY KEY (`area_code_id`);

--
-- Indexes for table `tbl_bank_payment`
--
ALTER TABLE `tbl_bank_payment`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tbl_caregiver_availability`
--
ALTER TABLE `tbl_caregiver_availability`
  ADD PRIMARY KEY (`caregiver_availability_id`),
  ADD KEY `tbl_caregiver_availability_tbl_caregiver_user` (`tbl_caregiver_user_caregiver_user_id`);

--
-- Indexes for table `tbl_caregiver_engagment_type`
--
ALTER TABLE `tbl_caregiver_engagment_type`
  ADD PRIMARY KEY (`caregiver_engagment_type_id`),
  ADD KEY `tbl_caregiver_engagment_type_tbl_admin_user` (`tbl_admin_user_admin_user_id`);

--
-- Indexes for table `tbl_caregiver_family_contact`
--
ALTER TABLE `tbl_caregiver_family_contact`
  ADD PRIMARY KEY (`caregiver_family_contact_id`),
  ADD KEY `tbl_caregiver_family_contact_tbl_caregiver_user` (`tbl_caregiver_user_caregiver_user_id`);

--
-- Indexes for table `tbl_caregiver_patient_schedule`
--
ALTER TABLE `tbl_caregiver_patient_schedule`
  ADD PRIMARY KEY (`caregiver_patient_schedule_id`),
  ADD KEY `tbl_caregiver_patient_schedule_tbl_caregiver_user` (`tbl_caregiver_user_caregiver_user_id`),
  ADD KEY `tbl_caregiver_patient_schedule_tbl_patient_user` (`tbl_patient_user_patient_id`),
  ADD KEY `tbl_caregiver_patient_schedule_tbl_schedule_maker` (`tbl_schedule_maker_schedule_maker_id`);

--
-- Indexes for table `tbl_caregiver_salary`
--
ALTER TABLE `tbl_caregiver_salary`
  ADD PRIMARY KEY (`caregiver_salary_id`),
  ADD KEY `tbl_caregiver_salary_tbl_caregiver_engagment_type` (`tbl_caregiver_engagment_type_caregiver_engagment_type_id`),
  ADD KEY `tbl_caregiver_salary_tbl_caregiver_user` (`tbl_caregiver_user_caregiver_user_id`);

--
-- Indexes for table `tbl_caregiver_schedule_feedback`
--
ALTER TABLE `tbl_caregiver_schedule_feedback`
  ADD PRIMARY KEY (`tbl_caregiver_schedule_feedback_id`);

--
-- Indexes for table `tbl_caregiver_user`
--
ALTER TABLE `tbl_caregiver_user`
  ADD PRIMARY KEY (`caregiver_user_id`),
  ADD KEY `tbl_caregiver_user_tbl_app_user_type` (`tbl_app_user_type_app_user_type_id`),
  ADD KEY `tbl_caregiver_user_tbl_caregiver_engagment_type` (`tbl_caregiver_engagment_type_caregiver_engagment_type_id`),
  ADD KEY `tbl_caregiver_user_tbl_level_care_type` (`tbl_level_care_type_level_care_type_id`);

--
-- Indexes for table `tbl_consultant_patient_schedule`
--
ALTER TABLE `tbl_consultant_patient_schedule`
  ADD PRIMARY KEY (`consultant_patient_schedule_id`),
  ADD KEY `tbl_consultant_patient_schedule_tbl_consultant_user` (`tbl_consultant_user_consultant_user_id`),
  ADD KEY `tbl_consultant_patient_schedule_tbl_patient_user` (`tbl_patient_user_patient_id`),
  ADD KEY `tbl_consultant_patient_schedule_tbl_schedule_maker` (`tbl_schedule_maker_schedule_maker_id`);

--
-- Indexes for table `tbl_consultant_type`
--
ALTER TABLE `tbl_consultant_type`
  ADD PRIMARY KEY (`consultant_type_id`),
  ADD KEY `tbl_consultant_type_tbl_admin_user` (`tbl_admin_user_admin_user_id`);

--
-- Indexes for table `tbl_consultant_user`
--
ALTER TABLE `tbl_consultant_user`
  ADD PRIMARY KEY (`consultant_user_id`),
  ADD KEY `tbl_consultant_user_tbl_consultant_type` (`tbl_consultant_type_consultant_type_id`);

--
-- Indexes for table `tbl_level_care_type`
--
ALTER TABLE `tbl_level_care_type`
  ADD PRIMARY KEY (`level_care_type_id`);

--
-- Indexes for table `tbl_mobile_payment_method`
--
ALTER TABLE `tbl_mobile_payment_method`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `tbl_patient_family_contact`
--
ALTER TABLE `tbl_patient_family_contact`
  ADD PRIMARY KEY (`patient_family_contact_id`),
  ADD KEY `tbl_patient_family_contact_tbl_patient_user` (`tbl_patient_user_patient_id`);

--
-- Indexes for table `tbl_patient_medical_history`
--
ALTER TABLE `tbl_patient_medical_history`
  ADD PRIMARY KEY (`patient_medical_history_id`),
  ADD KEY `tbl_patient_medical_history_tbl_admin_user` (`tbl_admin_user_admin_user_id`),
  ADD KEY `tbl_patient_medical_history_tbl_patient_user` (`tbl_patient_user_patient_id`);

--
-- Indexes for table `tbl_patient_user`
--
ALTER TABLE `tbl_patient_user`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `tbl_patient_user_tbl_app_user_type` (`tbl_app_user_type_app_user_type_id`),
  ADD KEY `tbl_patient_user_tbl_area_code` (`tbl_area_code_area_code_id`),
  ADD KEY `tbl_patient_user_tbl_level_care_type` (`tbl_level_care_type_level_care_type_id`),
  ADD KEY `tbl_patient_user_tbl_referral` (`tbl_referral_referral_id`);

--
-- Indexes for table `tbl_preferable_caregiver_list`
--
ALTER TABLE `tbl_preferable_caregiver_list`
  ADD PRIMARY KEY (`preferable_caregiver_list_id`),
  ADD KEY `tbl_preferable_caregiver_list_tbl_admin_user` (`tbl_admin_user_admin_user_id`),
  ADD KEY `tbl_preferable_caregiver_list_tbl_caregiver_user` (`tbl_caregiver_user_caregiver_user_id`),
  ADD KEY `tbl_preferable_caregiver_list_tbl_patient_user` (`tbl_patient_user_patient_id`);

--
-- Indexes for table `tbl_promotional_category`
--
ALTER TABLE `tbl_promotional_category`
  ADD PRIMARY KEY (`promotional_category_id`);

--
-- Indexes for table `tbl_promotional_items`
--
ALTER TABLE `tbl_promotional_items`
  ADD PRIMARY KEY (`promotional_item_id`),
  ADD KEY `tbl_promotional_items_tbl_admin_user` (`tbl_admin_user_admin_user_id`),
  ADD KEY `tbl_promotional_items_tbl_promotional_category` (`tbl_promotional_category_promotional_category_id`);

--
-- Indexes for table `tbl_promotional_item_request`
--
ALTER TABLE `tbl_promotional_item_request`
  ADD PRIMARY KEY (`promotional_item_request_id`),
  ADD KEY `tbl_promotional_item_request_tbl_admin_user` (`tbl_admin_user_admin_user_id`),
  ADD KEY `tbl_promotional_item_request_tbl_patient_user` (`tbl_patient_user_patient_id`),
  ADD KEY `tbl_promotional_item_request_tbl_promotional_items` (`tbl_promotional_items_pomotional_item_id`);

--
-- Indexes for table `tbl_referral`
--
ALTER TABLE `tbl_referral`
  ADD PRIMARY KEY (`referral_id`);

--
-- Indexes for table `tbl_schedule_maker`
--
ALTER TABLE `tbl_schedule_maker`
  ADD PRIMARY KEY (`schedule_maker_id`),
  ADD KEY `tbl_schedule_maker_tbl_admin_user` (`tbl_admin_user_admin_user_id`);

--
-- Indexes for table `tbl_service_type`
--
ALTER TABLE `tbl_service_type`
  ADD PRIMARY KEY (`service_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_login`
--
ALTER TABLE `tbl_admin_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_admin_user_type`
--
ALTER TABLE `tbl_admin_user_type`
  MODIFY `admin_user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_app_user_login`
--
ALTER TABLE `tbl_app_user_login`
  MODIFY `app_user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tbl_app_user_type`
--
ALTER TABLE `tbl_app_user_type`
  MODIFY `app_user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_bank_payment`
--
ALTER TABLE `tbl_bank_payment`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_caregiver_availability`
--
ALTER TABLE `tbl_caregiver_availability`
  MODIFY `caregiver_availability_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1= Available, 0= Not Available', AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tbl_caregiver_engagment_type`
--
ALTER TABLE `tbl_caregiver_engagment_type`
  MODIFY `caregiver_engagment_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_caregiver_family_contact`
--
ALTER TABLE `tbl_caregiver_family_contact`
  MODIFY `caregiver_family_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_caregiver_patient_schedule`
--
ALTER TABLE `tbl_caregiver_patient_schedule`
  MODIFY `caregiver_patient_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `tbl_caregiver_salary`
--
ALTER TABLE `tbl_caregiver_salary`
  MODIFY `caregiver_salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_caregiver_schedule_feedback`
--
ALTER TABLE `tbl_caregiver_schedule_feedback`
  MODIFY `tbl_caregiver_schedule_feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_consultant_patient_schedule`
--
ALTER TABLE `tbl_consultant_patient_schedule`
  MODIFY `consultant_patient_schedule_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_consultant_type`
--
ALTER TABLE `tbl_consultant_type`
  MODIFY `consultant_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_level_care_type`
--
ALTER TABLE `tbl_level_care_type`
  MODIFY `level_care_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_mobile_payment_method`
--
ALTER TABLE `tbl_mobile_payment_method`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_patient_family_contact`
--
ALTER TABLE `tbl_patient_family_contact`
  MODIFY `patient_family_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_patient_medical_history`
--
ALTER TABLE `tbl_patient_medical_history`
  MODIFY `patient_medical_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_preferable_caregiver_list`
--
ALTER TABLE `tbl_preferable_caregiver_list`
  MODIFY `preferable_caregiver_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `tbl_promotional_category`
--
ALTER TABLE `tbl_promotional_category`
  MODIFY `promotional_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_promotional_items`
--
ALTER TABLE `tbl_promotional_items`
  MODIFY `promotional_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_promotional_item_request`
--
ALTER TABLE `tbl_promotional_item_request`
  MODIFY `promotional_item_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_referral`
--
ALTER TABLE `tbl_referral`
  MODIFY `referral_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_schedule_maker`
--
ALTER TABLE `tbl_schedule_maker`
  MODIFY `schedule_maker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `tbl_service_type`
--
ALTER TABLE `tbl_service_type`
  MODIFY `service_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_admin_login`
--
ALTER TABLE `tbl_admin_login`
  ADD CONSTRAINT `tbl_admin_login_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`);

--
-- Constraints for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  ADD CONSTRAINT `tbl_admin_user_tbl_admin_user_type` FOREIGN KEY (`tbl_admin_user_type_admin_user_type_id`) REFERENCES `tbl_admin_user_type` (`admin_user_type_id`);

--
-- Constraints for table `tbl_app_user_login`
--
ALTER TABLE `tbl_app_user_login`
  ADD CONSTRAINT `tbl_app_user_login_tbl_app_user_type` FOREIGN KEY (`tbl_app_user_type_app_user_type_id`) REFERENCES `tbl_app_user_type` (`app_user_type_id`);

--
-- Constraints for table `tbl_caregiver_availability`
--
ALTER TABLE `tbl_caregiver_availability`
  ADD CONSTRAINT `tbl_caregiver_availability_tbl_caregiver_user` FOREIGN KEY (`tbl_caregiver_user_caregiver_user_id`) REFERENCES `tbl_caregiver_user` (`caregiver_user_id`);

--
-- Constraints for table `tbl_caregiver_engagment_type`
--
ALTER TABLE `tbl_caregiver_engagment_type`
  ADD CONSTRAINT `tbl_caregiver_engagment_type_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`);

--
-- Constraints for table `tbl_caregiver_family_contact`
--
ALTER TABLE `tbl_caregiver_family_contact`
  ADD CONSTRAINT `tbl_caregiver_family_contact_tbl_caregiver_user` FOREIGN KEY (`tbl_caregiver_user_caregiver_user_id`) REFERENCES `tbl_caregiver_user` (`caregiver_user_id`);

--
-- Constraints for table `tbl_caregiver_patient_schedule`
--
ALTER TABLE `tbl_caregiver_patient_schedule`
  ADD CONSTRAINT `tbl_caregiver_patient_schedule_tbl_caregiver_user` FOREIGN KEY (`tbl_caregiver_user_caregiver_user_id`) REFERENCES `tbl_caregiver_user` (`caregiver_user_id`),
  ADD CONSTRAINT `tbl_caregiver_patient_schedule_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`),
  ADD CONSTRAINT `tbl_caregiver_patient_schedule_tbl_schedule_maker` FOREIGN KEY (`tbl_schedule_maker_schedule_maker_id`) REFERENCES `tbl_schedule_maker` (`schedule_maker_id`);

--
-- Constraints for table `tbl_caregiver_salary`
--
ALTER TABLE `tbl_caregiver_salary`
  ADD CONSTRAINT `tbl_caregiver_salary_tbl_caregiver_engagment_type` FOREIGN KEY (`tbl_caregiver_engagment_type_caregiver_engagment_type_id`) REFERENCES `tbl_caregiver_engagment_type` (`caregiver_engagment_type_id`),
  ADD CONSTRAINT `tbl_caregiver_salary_tbl_caregiver_user` FOREIGN KEY (`tbl_caregiver_user_caregiver_user_id`) REFERENCES `tbl_caregiver_user` (`caregiver_user_id`);

--
-- Constraints for table `tbl_caregiver_user`
--
ALTER TABLE `tbl_caregiver_user`
  ADD CONSTRAINT `tbl_caregiver_user_tbl_app_user_type` FOREIGN KEY (`tbl_app_user_type_app_user_type_id`) REFERENCES `tbl_app_user_type` (`app_user_type_id`),
  ADD CONSTRAINT `tbl_caregiver_user_tbl_caregiver_engagment_type` FOREIGN KEY (`tbl_caregiver_engagment_type_caregiver_engagment_type_id`) REFERENCES `tbl_caregiver_engagment_type` (`caregiver_engagment_type_id`),
  ADD CONSTRAINT `tbl_caregiver_user_tbl_level_care_type` FOREIGN KEY (`tbl_level_care_type_level_care_type_id`) REFERENCES `tbl_level_care_type` (`level_care_type_id`);

--
-- Constraints for table `tbl_consultant_patient_schedule`
--
ALTER TABLE `tbl_consultant_patient_schedule`
  ADD CONSTRAINT `tbl_consultant_patient_schedule_tbl_consultant_user` FOREIGN KEY (`tbl_consultant_user_consultant_user_id`) REFERENCES `tbl_consultant_user` (`consultant_user_id`),
  ADD CONSTRAINT `tbl_consultant_patient_schedule_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`),
  ADD CONSTRAINT `tbl_consultant_patient_schedule_tbl_schedule_maker` FOREIGN KEY (`tbl_schedule_maker_schedule_maker_id`) REFERENCES `tbl_schedule_maker` (`schedule_maker_id`);

--
-- Constraints for table `tbl_consultant_type`
--
ALTER TABLE `tbl_consultant_type`
  ADD CONSTRAINT `tbl_consultant_type_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`);

--
-- Constraints for table `tbl_consultant_user`
--
ALTER TABLE `tbl_consultant_user`
  ADD CONSTRAINT `tbl_consultant_user_tbl_consultant_type` FOREIGN KEY (`tbl_consultant_type_consultant_type_id`) REFERENCES `tbl_consultant_type` (`consultant_type_id`);

--
-- Constraints for table `tbl_patient_family_contact`
--
ALTER TABLE `tbl_patient_family_contact`
  ADD CONSTRAINT `tbl_patient_family_contact_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`);

--
-- Constraints for table `tbl_patient_medical_history`
--
ALTER TABLE `tbl_patient_medical_history`
  ADD CONSTRAINT `tbl_patient_medical_history_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`),
  ADD CONSTRAINT `tbl_patient_medical_history_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`);

--
-- Constraints for table `tbl_patient_user`
--
ALTER TABLE `tbl_patient_user`
  ADD CONSTRAINT `tbl_patient_user_tbl_app_user_type` FOREIGN KEY (`tbl_app_user_type_app_user_type_id`) REFERENCES `tbl_app_user_type` (`app_user_type_id`),
  ADD CONSTRAINT `tbl_patient_user_tbl_area_code` FOREIGN KEY (`tbl_area_code_area_code_id`) REFERENCES `tbl_area_code` (`area_code_id`),
  ADD CONSTRAINT `tbl_patient_user_tbl_level_care_type` FOREIGN KEY (`tbl_level_care_type_level_care_type_id`) REFERENCES `tbl_level_care_type` (`level_care_type_id`),
  ADD CONSTRAINT `tbl_patient_user_tbl_referral` FOREIGN KEY (`tbl_referral_referral_id`) REFERENCES `tbl_referral` (`referral_id`);

--
-- Constraints for table `tbl_preferable_caregiver_list`
--
ALTER TABLE `tbl_preferable_caregiver_list`
  ADD CONSTRAINT `tbl_preferable_caregiver_list_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`),
  ADD CONSTRAINT `tbl_preferable_caregiver_list_tbl_caregiver_user` FOREIGN KEY (`tbl_caregiver_user_caregiver_user_id`) REFERENCES `tbl_caregiver_user` (`caregiver_user_id`),
  ADD CONSTRAINT `tbl_preferable_caregiver_list_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`);

--
-- Constraints for table `tbl_promotional_items`
--
ALTER TABLE `tbl_promotional_items`
  ADD CONSTRAINT `tbl_promotional_items_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`),
  ADD CONSTRAINT `tbl_promotional_items_tbl_promotional_category` FOREIGN KEY (`tbl_promotional_category_promotional_category_id`) REFERENCES `tbl_promotional_category` (`promotional_category_id`);

--
-- Constraints for table `tbl_promotional_item_request`
--
ALTER TABLE `tbl_promotional_item_request`
  ADD CONSTRAINT `tbl_promotional_item_request_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`),
  ADD CONSTRAINT `tbl_promotional_item_request_tbl_patient_user` FOREIGN KEY (`tbl_patient_user_patient_id`) REFERENCES `tbl_patient_user` (`patient_id`),
  ADD CONSTRAINT `tbl_promotional_item_request_tbl_promotional_items` FOREIGN KEY (`tbl_promotional_items_pomotional_item_id`) REFERENCES `tbl_promotional_items` (`promotional_item_id`);

--
-- Constraints for table `tbl_schedule_maker`
--
ALTER TABLE `tbl_schedule_maker`
  ADD CONSTRAINT `tbl_schedule_maker_tbl_admin_user` FOREIGN KEY (`tbl_admin_user_admin_user_id`) REFERENCES `tbl_admin_user` (`admin_user_id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
