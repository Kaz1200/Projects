-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2023 at 07:51 AM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u556402485_doctor_appoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_database`
--

CREATE TABLE `admin_database` (
  `admin_id` int(11) NOT NULL,
  `admin_email_address` varchar(200) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `hospital_name` varchar(200) NOT NULL,
  `hospital_address` mediumtext NOT NULL,
  `hospital_contact_no` varchar(30) NOT NULL,
  `hospital_logo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_database`
--

INSERT INTO `admin_database` (`admin_id`, `admin_email_address`, `admin_password`, `admin_name`, `hospital_name`, `hospital_address`, `hospital_contact_no`, `hospital_logo`) VALUES
(1, 'admin@admin.com', 'password@@', 'Smile Dental Care', 'A+ Dental Care Haven', 'Unit #6 8263 St. Francis Mall D. Arcadio Santos Ave. Brgy.San Dionisio Paranaque City 1700, Philippines', '(02) 8661 4827', '../images/smileIcon2.png');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `services` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  `appointment_number` int(11) NOT NULL,
  `patient_come_into_hospital` enum('No','Yes') NOT NULL,
  `time` varchar(50) NOT NULL,
  `additionalServices` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `doctor_id`, `patient_id`, `date`, `services`, `status`, `appointment_number`, `patient_come_into_hospital`, `time`, `additionalServices`) VALUES
(26, 3, 3, '2023-06-29', 'Veneers', 'Booked', 1000, 'No', '1:20 PM', 'Oral Prophylaxis'),
(27, 2, 66, '2023-06-14', 'Digital Panoramic X-Ray', 'Booked', 1001, 'No', '8:00 AM', ''),
(28, 2, 3, '2023-06-21', 'Complete Dentures', 'Booked', 1002, 'No', '8:00 AM', 'Oral Prophylaxis'),
(29, 2, 3, '2023-07-28', 'Teeth Whitening', 'Booked', 1003, 'No', '8:00 AM', 'Oral Prophylaxis');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_database`
--

CREATE TABLE `appointment_database` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_number` int(11) NOT NULL,
  `services` varchar(100) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `patient_come_into_hospital` enum('No','Yes') NOT NULL,
  `doctor_comment` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assistant_database`
--

CREATE TABLE `assistant_database` (
  `assistant_id` int(11) NOT NULL,
  `assistant_email_address` varchar(200) NOT NULL,
  `assistant_password` varchar(100) NOT NULL,
  `assistant_name` varchar(100) NOT NULL,
  `assistant_profile_image` varchar(100) NOT NULL,
  `assistant_phone_no` varchar(30) NOT NULL,
  `assistant_address` mediumtext NOT NULL,
  `assistant_date_of_birth` date NOT NULL,
  `assistant_status` enum('Active','Inactive') NOT NULL,
  `assistant_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assistant_database`
--

INSERT INTO `assistant_database` (`assistant_id`, `assistant_email_address`, `assistant_password`, `assistant_name`, `assistant_profile_image`, `assistant_phone_no`, `assistant_address`, `assistant_date_of_birth`, `assistant_status`, `assistant_added_on`) VALUES
(1, 'ricacalumarde@gmail.com', 'password@@', 'Rica Calumarde', '../images/322523264.png', '09123456789', 'Cebu City', '1985-10-29', 'Active', '2022-02-15 17:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `billing_database`
--

CREATE TABLE `billing_database` (
  `billing_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `paid` float(10,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  `billing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `billing_database`
--

INSERT INTO `billing_database` (`billing_id`, `patient_id`, `doctor_id`, `doctor_name`, `service`, `amount`, `paid`, `status`, `billing_date`) VALUES
(14, 23, 1, 'Dr. Mikk Hernalyn Eusebio', 'Veneers', 1000.00, 1000.00, 'Paid', '2023-05-23'),
(15, 3, 2, 'Dr. Chloe Marianelle Hernando', 'Tooth Extraction', 1000.00, 1000.00, 'Unpaid', '2023-05-24'),
(16, 5, 2, 'Dr. Chloe Marianelle Hernando', 'Veneers', 500.00, 500.00, 'Paid', '2023-05-30'),
(17, 4, 2, 'Dr. Chloe Marianelle Hernand', 'Teeth Whitening', 1000.00, 1000.00, 'paid', '2023-05-23'),
(19, 3, 2, 'Dr. Chloe Marianelle Hernando', 'Periapical X-Ray', 900.00, 900.00, 'Paid', '2023-05-24'),
(20, 3, 1, 'Dr. Mikk Hernalyn Eusebio', 'Periapical X-Ray', 900.00, 900.00, 'Paid', '2023-05-23'),
(21, 3, 3, 'Dr. Alroze Regala', 'Periapical X-Ray', 900.00, 900.00, 'Paid', '2023-05-24'),
(22, 3, 3, 'Dr. Alroze Regala', 'Removable Dentures (Ordinary & Flexite)', 900.00, 900.00, 'Paid', '2023-05-25'),
(23, 3, 2, 'Dr. Chloe Marianelle Hernand', 'Veneers', 1000.00, 1000.00, 'paid', '2023-05-22'),
(24, 3, 1, 'Dr. Mikk Hernalyn Eusebio', 'Crowns and Bridges', 900.00, 900.00, 'Paid', '2023-05-25'),
(25, 3, 3, 'Dr. Alroze Regala', 'Removable Dentures (Ordinary & Flexite)', 800.00, 800.00, 'Paid', '2023-05-23'),
(26, 3, 2, 'Dr. Chloe Marianelle Hernando', 'Oral Prophylaxis', 900.00, 900.00, 'Paid', '2023-05-30'),
(27, 3, 1, 'Dr. Mikk Hernalyn Eusebio', 'Periapical X-Ray', 900.00, 900.00, 'Paid', '2023-05-10'),
(28, 3, 2, 'Dr. Chloe Marianelle Hernando', 'Complete Dentures', 700.00, 700.00, 'Paid', '2023-05-25'),
(30, 3, 1, 'Dr. Mikk Hernalyn Eusebi', 'Complete Dentures', 1000.00, 1000.00, 'unpaid', '2023-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `user_id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Subject` varchar(15) NOT NULL,
  `Message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`user_id`, `Name`, `Email`, `Subject`, `Message`, `is_read`) VALUES
(9, 'chris', 'christiannnn@gmail.com', 'Braces', 'Email and SMS are a match made in heaven. Understanding when and where to talk to customers is vital for driving conversions. Luckily, Dotdigital has the tools you need to craft personalized customer journeys across both channels, so you can ensure you’re always using the right channel to drive customers into action.', 0),
(10, 'chris', 'chris@gmail.com', 'Braces', 'IBM has a rich history with machine learning. One of its own, Arthur Samuel, is credited for coining the term, “machine learning” with his research (PDF, 481 KB) (link resides outside IBM) around the game of checkers. Robert Nealey, the self-proclaimed checkers master, played the game on an IBM 7094 computer in 1962, and he lost to the computer. Compared to what can be done today, this feat seems trivial, but it’s considered a major milestone in the field of artificial intelligence.\r\n\r\nOver the last couple of decades, the technological advances in storage and processing power have enabled some innovative products based on machine learning, such as Netflix’s recommendation engine and self-driving cars.', 0),
(11, 'Karl Nelson Calupaz', 'calupazkarl1225@gmail.com', 'Booking Appoint', 'The Booking appointment has a problem.', 0),
(12, 'Ken Cruz', 'kenphotography2023@gmail.com', 'System', 'Your Website is so clean.', 0),
(13, 'magnolia dumaguit', 'dumaguitmagnolia18@gmail.com', 'teeth', 'to fix the damage', 0),
(14, 'test', 'test@gmail.com', 'test', 'This is a test', 0),
(15, 'Kaela Mae', 'kaelamaemabuhay@gmail.com', 'Dunno', 'Nice! Good job! Keep it up!', 0),
(16, 'SASSYMAE', 'maealthea05@gmail.com', 'PASSWORD', 'hirap mag gawa ng password pero ok naman overall. goodluck!', 0),
(17, 'daniice ', 'danice.llido@gmail.com', 'dasdadasddddddd', 'adsdadadadasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_database`
--

CREATE TABLE `doctor_database` (
  `doctor_id` int(11) NOT NULL,
  `doctor_email_address` varchar(200) NOT NULL,
  `doctor_password` varchar(100) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `doctor_profile_image` varchar(100) NOT NULL,
  `doctor_phone_no` varchar(30) NOT NULL,
  `doctor_address` mediumtext NOT NULL,
  `doctor_date_of_birth` date NOT NULL,
  `doctor_degree` varchar(200) NOT NULL,
  `doctor_expert_in` varchar(100) NOT NULL,
  `doctor_status` enum('Active','Inactive') NOT NULL,
  `doctor_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_database`
--

INSERT INTO `doctor_database` (`doctor_id`, `doctor_email_address`, `doctor_password`, `doctor_name`, `doctor_profile_image`, `doctor_phone_no`, `doctor_address`, `doctor_date_of_birth`, `doctor_degree`, `doctor_expert_in`, `doctor_status`, `doctor_added_on`) VALUES
(1, 'Mikkeusebio@gmail.com', 'password@@', 'Dr. Mikk Hernalyn Eusebio', '../images/1655582988.jpg', '7539518520', 'Paranaque City', '1985-10-29', 'Dentistry', 'Aesthetic Dentistry, Orthodontic', 'Active', '2022-02-15 17:04:59'),
(2, 'chloe@gmail.com', 'password@@', 'Dr. Chloe Hernando', '../images/1845346131.jpg', '09123456789', 'Quezon City', '1982-08-10', 'Dentistry', 'Aesthetic Dentistry, Orthodontics, Oral Surgery', 'Active', '2022-02-18 15:00:32'),
(3, 'alrozeregala@gmail.com', 'password@@', 'Dr. Alroze Regala', '../images/1524704857.jpg', '7417417410', 'Paranaque City', '1989-04-03', 'Dentistry', 'Aesthetic Dentistry, Orthodontic', 'Active', '2022-02-18 15:05:02');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule_table`
--

CREATE TABLE `doctor_schedule_table` (
  `doctor_schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `doctor_schedule_start_time` varchar(20) NOT NULL,
  `doctor_schedule_end_time` varchar(20) NOT NULL,
  `average_consulting_time` int(5) NOT NULL,
  `doctor_schedule_status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule_table`
--

INSERT INTO `doctor_schedule_table` (`doctor_schedule_id`, `doctor_id`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `average_consulting_time`, `doctor_schedule_status`) VALUES
(27, 2, '2023-05-24', 'Wednesday', '9:00', '4:00', 0, 'Active'),
(29, 2, '2023-06-07', 'Wednesday', '8:00', '5:00', 0, 'Inactive'),
(32, 3, '2023-05-31', 'Wednesday', '8:00', '5:00', 0, 'Inactive'),
(37, 2, '2023-05-31', 'Wednesday', '8:40', '8:20', 0, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `page_views`
--

CREATE TABLE `page_views` (
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page_views`
--

INSERT INTO `page_views` (`id`, `count`) VALUES
(1, 625);

-- --------------------------------------------------------

--
-- Table structure for table `patient_database`
--

CREATE TABLE `patient_database` (
  `patient_id` int(11) NOT NULL,
  `patient_email_address` varchar(200) NOT NULL,
  `patient_password` varchar(100) NOT NULL,
  `patient_first_name` varchar(100) NOT NULL,
  `patient_last_name` varchar(100) NOT NULL,
  `patient_date_of_birth` date NOT NULL,
  `patient_gender` enum('Male','Female','Other') NOT NULL,
  `patient_address` mediumtext NOT NULL,
  `patient_phone_no` varchar(30) NOT NULL,
  `patient_maritial_status` varchar(30) NOT NULL,
  `patient_added_on` datetime NOT NULL,
  `patient_verification_code` varchar(100) NOT NULL,
  `email_verify` enum('No','Yes') NOT NULL,
  `patient_suffix` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_database`
--

INSERT INTO `patient_database` (`patient_id`, `patient_email_address`, `patient_password`, `patient_first_name`, `patient_last_name`, `patient_date_of_birth`, `patient_gender`, `patient_address`, `patient_phone_no`, `patient_maritial_status`, `patient_added_on`, `patient_verification_code`, `email_verify`, `patient_suffix`) VALUES
(3, 'nielmar@gmail.com', 'password', 'Nielmar', 'Legaspi', '2001-02-26', 'Male', 'Unit 12, Sta Scholastica Street, Barangay San Antonio, Paranaque City, Metro Manila, 1700,  Philippines', '85745635210', 'Single', '2022-02-18 16:34:55', '44846959a68c07995d08893540e777be', 'Yes', 'Jr.'),
(4, 'dieqcohr@gmail.com', 'password', 'Dieqcohr', 'Rufino', '2001-04-05', 'Male', '476, Las Piñas, PHL', '7539518520', 'Married', '2022-02-19 18:28:23', '8902e16ef62a556a8e271c9930068fea', 'Yes', ''),
(5, 'krystel@programmer.net', 'password', 'Krystel', 'Suarez', '1995-07-25', 'Female', '8292, Quezon, PHL', '75394511442', 'Single', '2022-02-23 17:50:06', '1909d59e254ab7e433d92f014d82ba3d', 'Yes', ''),
(20, 'christianfiguron17@gmail.com', 'Drix123@', 'Christian', 'Figuron', '2023-05-22', 'Male', 'Quezon City', '09123456789', 'Single', '2023-05-19 15:34:26', 'e82def268246c3716031e47a7d7ca96b', 'Yes', ''),
(22, 'kristinafidelino@yahoo.com', 'Smilehaven55!', 'MA. KRISTINA JOY', 'FIDELINO', '2000-12-31', 'Female', 'Sta. Scholastica St., Barangay San Antonio, Valley 1', '09273823490', 'Single', '2023-05-19 17:39:16', '40e14804a9155488f4c7f1b644ee5173', 'Yes', ''),
(27, 'jennifermalong14@gmail.com', 'Kendy14@', 'Jennifer', 'Malong', '2003-06-14', 'Male', '183 Isarog St. Brgy. Paang Bundok QC', '09456148987', 'Single', '2023-05-20 17:27:32', '60f3650999e3f0fac218563a0ba7f3c2', 'Yes', ''),
(28, 'jasmin.sanjose@yahoo.com', 'Bunso@24', 'Jasmin', 'San Jose', '1979-11-24', 'Female', '292 Army Rd, Quezon City, Metro Manila, Philippines', '09059250529', 'Married', '2023-05-20 17:31:50', '696adfab29ea03b4f5479a986414cc92', 'Yes', ''),
(30, 'victorevangelista0810@gmail.com', 'Francisvictor@107', 'Francis', 'Evangelista', '2001-08-10', 'Male', '418 Purok 4 San Fabian, Sto. Domingo, Nueva Ecija', '09615709756', 'Single', '2023-05-20 17:48:48', '941ca1506d419f099a08ade1f8bbd860', 'Yes', ''),
(31, 'montefalcoyhaj@gmail.com', 'Airopogi@123', 'Airo', 'Romblon', '2000-08-08', 'Male', 'Lot 12 Block 32 San Pablo St. Valley 1 Paranaque City', '09518951289', 'Single', '2023-05-20 17:57:35', '61dd0b09ec74d06ad33762c572465314', 'Yes', ''),
(32, 'jorelramirez023@gmail.com', '@Masterme20', 'Jorel', 'Ramirez', '1999-11-20', 'Male', 'LOT 12 BLK 32 SAN PABLO ST, SAN ANTONIO VALLEY ONE, PARAÑAQUE CITY.', '09323215425', 'Single', '2023-05-20 18:01:29', 'c2980b3610c6754db7b0739e3b3ba331', 'No', ''),
(33, 'anthonyjuniorlapada@gmail.com', '@Test123', 'Anthony', 'Lapada', '2001-11-24', 'Male', 'Tondo, Manila', '09277966197', 'Single', '2023-05-20 18:18:50', '19ff23869c0602db0e3a8e18ba03a740', 'Yes', ''),
(34, 'bustosvince01@gmail.com', 'Vincebustos2023!', 'Vince', 'Bustos', '2007-06-01', 'Male', '294 army Road barangay holy spirit QC', '09682514809', 'Single', '2023-05-20 18:28:28', '3db41f94022ccff6b2e70b6f57fa0924', 'Yes', ''),
(35, 'seankenexequiel.delapena@patts.edu.ph', 'Seanken08@', 'Sean Ken Exequiel', 'Dela Peña', '2000-08-01', 'Male', '3850 Cuatro De Julio St. Baclaran Parañaque', '09979556110', 'Single', '2023-05-20 19:06:06', '6abce257f751ecaae5ef251574329cf7', 'Yes', ''),
(36, 'jelenainoviooo@gmail.com', 'Jinovio*0995', 'Jelena', 'Inovio', '2002-09-07', 'Female', '#56 Rizal St. Barangay Poblacion, San Pedro City, Laguna', '09150620995', 'Single', '2023-05-20 19:12:38', '5314d8e46082d55490639e249aab778b', 'Yes', ''),
(38, 'markcarljosephfidelino@gmail.com', 'Opo2133!', 'Mark Carl Joseph', 'Fidelino', '2003-08-26', 'Male', 'Sta. Scholastica St. San Antonio Valley 1 Paranaque City', '09054210753', 'Single', '2023-05-20 19:34:25', 'cfe60fae9de96cc1587b08d78e8029ad', 'Yes', ''),
(39, 'cabuyocmae8@gmail.com', 'Maeceelee1624@', 'Mae', 'Cabuyoc', '2004-07-16', 'Female', '24 F. Carlos Baesa Q.C', '09564764156', 'Single', '2023-05-20 19:37:03', '93945367bfc5a1680db10bd98ff174c0', 'Yes', ''),
(40, 'mikefrancisco@gmail.com', 'Richmike2003*', 'Mike', 'Francisco', '2003-12-12', 'Male', 'C2 High-way Capulong Cornet Lacson Street Tondo Manila.', '09617160734', 'Single', '2023-05-20 19:42:20', '5f384890a2d019920a50a0028dea6877', 'No', ''),
(41, 'cristopher.avanzado@tup.edu.ph', '@chieveYourDREAMS07', 'Cristopher', 'Avanzado', '1999-06-07', 'Male', '1640 Sulu St., Sta. Cruz, Manila', '09760070441', 'Single', '2023-05-20 19:55:47', '55fbc4f88cc3823cfadc1453a042fa52', 'Yes', ''),
(42, 'ejvera07@gmail.com', '123@Survey', 'Enrique', 'Vera', '2001-02-07', 'Male', 'quezon city', '09123456788', 'Single', '2023-05-20 20:07:55', 'e488b35ef08bd4a7d41855fe93f6f83f', 'Yes', ''),
(43, 'horisankyoko1@gmail.com', 'hor!SAN052023', 'Gay', 'Cagang', '2001-02-27', 'Female', 'Phase 1 Greenville, Deparo Street  Brgy 171, Caloocan', '09480188178', 'Single', '2023-05-20 20:21:57', 'ce80765c63a50bd23557f1f8514d9a0f', 'Yes', ''),
(44, 'viralz000g@gmail.com', 'Qweasdzxc123@', 'Jeremiah', 'Roberto', '1998-08-10', 'Male', 'asd', '09956502786', 'Single', '2023-05-20 20:24:45', '235ac693641264197105d999640f34de', 'No', ''),
(45, 'shariuchihasasuke@gmail.com', 'Uchihasasuke@3', 'Shari', 'Quinzon', '2002-07-03', 'Female', 'San Pablo St. Lower Barangay SAV-1 Parañaque City', '09271889554', 'Single', '2023-05-20 20:25:40', '4995502e368434d545875994826cc681', 'Yes', ''),
(46, 'Sulit.136544142114@depedqc.ph', 'Andrian123@', 'Andrian', 'Sulit', '2005-06-08', 'Male', '292 army barangay Holy Spirit Quezon city', '09462458700', 'Single', '2023-05-20 20:26:18', 'bdfdd62edaf8a3863cab7fec34ffc61a', 'Yes', ''),
(47, 'kennedyrivas25@gmail.com', 'February272022*', 'Jhon Kennedy', 'Rivas', '2000-06-25', 'Male', '2318 C. Rizal Ave Sta Cruz Manila', '09995514094', 'Single', '2023-05-20 21:09:20', 'd529aa0fdd2c4ab4e0c4c9462ee97682', 'Yes', ''),
(48, 'ordovezagenevamae1999@gmail.com', 'Datuputisoysauce04!', 'Geneva Mae', 'Ordoveza', '1999-02-02', 'Female', '14 Makisig St. Spiritual Cmpd. Litex Rd, Q.C', '09156433707', 'Single', '2023-05-20 22:18:24', 'b6d7d2105b7fe31b88405aa0a418358d', 'Yes', ''),
(49, 'karl.ybanez@tup.edu.ph', 'Hulaanm0@', 'Karl', 'L', '2003-03-30', 'Male', 'Makati', '09499634101', 'Single', '2023-05-20 22:58:45', '99b463544a53b74e89be85d42675ba8a', 'Yes', ''),
(50, 'jayannefiguron@yahoo.com', 'Siargao@2021!', 'Dianna', 'Fuentebella', '0008-04-07', 'Female', 'Cebu', '09458127890', 'Single', '2023-05-21 01:31:46', 'da6939cff2518dc5d065c86fe3eeb28c', 'Yes', ''),
(51, 'kaelamaemabuhay@gmail.com', 'Kaela31*', 'Kaela Mae', 'Mabuhay', '1999-08-31', 'Female', '57 Bill St., Batasan Hills Quezon City', '09276327803', 'Single', '2023-05-21 12:47:36', '52f978cd818b233b2c0b8c80f152d19e', 'Yes', ''),
(52, 'alain.elemia@gmail.com', 'gVwCj@rydwdN8oj', 'Alain', 'Elemia', '1992-11-03', 'Male', 'Test', '09777744156', 'Married', '2023-05-21 16:01:25', 'b73e12a1fc274546d7505feac2f302c1', 'Yes', ''),
(53, 'cpe.ericmedalla@gmail.com', 'Secret12345!', 'ERIC', 'MEDALLA', '2005-11-28', 'Male', 'Diyan lang', '09959210061', 'Single', '2023-05-21 16:11:53', '4c1df892525c7697a71de4ef6c0ac8ea', 'Yes', ''),
(54, 'abayanp@gmail.com', 'SH@b4yan18', 'Paul Andrei', 'Abayan', '2000-08-18', 'Male', '656 Gate 3 Area A Parola Tondo Manila', '09278277956', 'Single', '2023-05-21 16:27:55', 'ebd537fbb83d2f203bee79b620751877', 'Yes', ''),
(59, 'maealthea05@gmail.com', '@Yokonga1', 'weh', 'di nga', '2006-10-06', 'Male', 'weh ayoko nga mamaya hauntingin niyo ko eh', '09083101076', 'Single', '2023-05-22 12:29:23', 'b9487c0aaf9f6ae7e8f1af873f58fcf4', 'Yes', ''),
(60, 'danice.llido@gmail.com', 'Panalokana21?', 'Danice', 'Llido', '2023-05-22', 'Female', 'hello bbby', '09121344568', 'Single', '2023-05-22 13:29:33', 'fab2da44362ad0f5866a057078f29766', 'Yes', ''),
(61, 'a@a.com', 'mmSi$320O', 'Asher', 'Hill', '0000-00-00', 'Female', 'Molestias consequatu', '09092314453', 'Single', '2023-05-22 13:41:31', '500adb2d33b4268d6b83bd64c4cf5b8c', 'No', ''),
(62, 'medinaronaldcarlo@gmail.com', 'Password123@', 'Ronald', 'Medina', '2000-01-01', 'Male', 'Manila', '09000008564', 'Single', '2023-05-22 19:02:53', '20083705a7c946670b8801b2ac850c8f', 'Yes', ''),
(63, 'fidelinomakristinajoy@gmail.com', 'Taylorswift13@', 'MA. KRISTINA JOY', 'FIDELINO', '2000-12-31', 'Male', 'Sta. Scholastica St., Barangay San Antonio, Valley 1,  Paranaque City', '09273823490', '', '2023-05-24 11:32:13', '7c7bbcf08259e4632cdc0ea201412643', 'Yes', ''),
(64, 'karlnelson.calupaz@tup.edu.ph', 'Karl1224009!', 'Karl', 'Calupaz', '1993-11-29', 'Male', 'Marine Street, Diliman Village, Manila', '09236273137', 'Single', '2023-05-28 20:51:28', '5f1d73cb04d62838061df0576695e0e0', 'No', ''),
(65, 'smilecarehaven@gmail.com', 'Karl1224009!', 'Karl', 'Calupaz', '2003-06-25', 'Male', '#23 Diliman Street Brgy. Kundiman, Manila 1123', '09112777391', '', '2023-05-28 21:06:02', '4b6ef8c50bf892a3f29cbee49c125145', 'Yes', ''),
(66, 'calupazkarl1225@gmail.com', 'Tatay12!', 'Ken', 'Ken', '2000-05-16', 'Male', 'Unit 12, Santa Scholastica Street, Barangay San Antonio, Paranaque City, Metro Manila, 1700, Philippines', '09992323627', 'Single', '2023-05-29 20:07:49', '9cc580f1ebbfc9380f2d5cd3b277e15a', 'Yes', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_database`
--
ALTER TABLE `admin_database`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `assistant_database`
--
ALTER TABLE `assistant_database`
  ADD PRIMARY KEY (`assistant_id`);

--
-- Indexes for table `billing_database`
--
ALTER TABLE `billing_database`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `doctor_database`
--
ALTER TABLE `doctor_database`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  ADD PRIMARY KEY (`doctor_schedule_id`);

--
-- Indexes for table `page_views`
--
ALTER TABLE `page_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_database`
--
ALTER TABLE `patient_database`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_database`
--
ALTER TABLE `admin_database`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `assistant_database`
--
ALTER TABLE `assistant_database`
  MODIFY `assistant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `billing_database`
--
ALTER TABLE `billing_database`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctor_database`
--
ALTER TABLE `doctor_database`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  MODIFY `doctor_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `page_views`
--
ALTER TABLE `page_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_database`
--
ALTER TABLE `patient_database`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
