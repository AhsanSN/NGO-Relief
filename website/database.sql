-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 04, 2020 at 11:58 AM
-- Server version: 10.3.22-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anomozco_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `Area`
--

CREATE TABLE `Area` (
  `AreaID` int(10) UNSIGNED NOT NULL,
  `Parent_AreaID` int(10) UNSIGNED DEFAULT NULL,
  `AreaName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Area`
--

INSERT INTO `Area` (`AreaID`, `Parent_AreaID`, `AreaName`) VALUES
(1, NULL, 'Korangi');

-- --------------------------------------------------------

--
-- Table structure for table `Beneficiary`
--

CREATE TABLE `Beneficiary` (
  `BeneficiaryID` int(10) UNSIGNED NOT NULL,
  `Occupation_OccupationID` int(10) UNSIGNED NOT NULL,
  `Area_AreaID` int(10) UNSIGNED NOT NULL,
  `Household_HouseholdID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `AltPhone` varchar(20) DEFAULT NULL,
  `NIC` varchar(20) DEFAULT NULL,
  `FamilyRole` varchar(50) DEFAULT NULL,
  `Reference` varchar(50) DEFAULT NULL,
  `CollectionCenter` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `eligibleforZakat` varchar(255) DEFAULT NULL,
  `MonthlyIncome` varchar(255) DEFAULT NULL,
  `RegNo` varchar(50) DEFAULT NULL,
  `RegStatus` varchar(20) DEFAULT NULL,
  `RegDate` date DEFAULT NULL,
  `cnicImage` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Beneficiary`
--

INSERT INTO `Beneficiary` (`BeneficiaryID`, `Occupation_OccupationID`, `Area_AreaID`, `Household_HouseholdID`, `Name`, `Address`, `Phone`, `AltPhone`, `NIC`, `FamilyRole`, `Reference`, `CollectionCenter`, `latitude`, `longitude`, `eligibleforZakat`, `MonthlyIncome`, `RegNo`, `RegStatus`, `RegDate`, `cnicImage`) VALUES
(1, 1, 1, 1, 'Ahsan', 'r343', '03362287283', NULL, '123', '', '', '', '', '', 'no', '80000', NULL, NULL, NULL, ''),
(2, 1, 1, 1, '', '', '', NULL, '1', '', '', '', '', '', '', '', NULL, NULL, NULL, ''),
(3, 1, 1, 1, '', '', '', NULL, '2', '', '', '', '', '', '', '', NULL, NULL, NULL, ''),
(4, 1, 1, 1, '', '', '', NULL, '3', '', '', '', '', '', '', '', NULL, NULL, NULL, ''),
(5, 1, 1, 1, '', '', '', NULL, '4', '', '', '', '', '', '', '', NULL, NULL, NULL, ''),
(6, 1, 1, 1, 'Ahsan', '098213', '2183098', NULL, '1233', '98092183', '8', '8', '24.940787221611', '67.094784148586', 'no', '12000', NULL, NULL, NULL, ''),
(7, 1, 1, 1, '76', '876', '6876', NULL, '7687', '87687', '687', '6876', '24.940787632551', '67.0947836062', 'no', '87', NULL, NULL, NULL, ''),
(8, 1, 1, 1, '76', '67', '767', NULL, '7632', '67', '676', '76', '24.940787221611', '67.094784148586', 'no', '12000', NULL, NULL, NULL, ''),
(9, 1, 1, 1, '76', '67', '767', NULL, '76', '67', '676', '76', '24.940779363992', '67.094782874617', 'no', '12000', NULL, NULL, NULL, ''),
(10, 1, 1, 1, '87', '87', '87', NULL, '87', '878', '78', '787', '24.940771652499', '67.094793275587', 'no', '90000', NULL, NULL, NULL, ''),
(11, 1, 1, 1, '', '', '', NULL, '432', '', '', '', '24.940786848016', '67.09478464168', '', '', NULL, NULL, NULL, ''),
(12, 1, 1, 1, '', '87', '', NULL, '2321', '', '78', '787', '24.940772164953', '67.094793395856', '', '', NULL, NULL, NULL, ''),
(13, 1, 1, 1, '', '87', '', NULL, '412', '', '78', '787', '24.940772164953', '67.094793395856', '', '', NULL, NULL, NULL, ''),
(14, 1, 1, 1, '', '', '', NULL, '1234221', '', '', '', '24.940772164953', '67.094793395856', '', '', NULL, NULL, NULL, ''),
(15, 1, 1, 1, 'Ahsad', '987', '987', NULL, '987', '9', '987', '7871', '24.9407885', '67.0947685', '', '987', NULL, NULL, NULL, ''),
(16, 1, 1, 1, '', '', '', NULL, '7832', '', '', '7871', '24.940781732842', '67.094776009759', 'no', '', NULL, NULL, NULL, ''),
(29, 1, 1, 1, '1', '1', '1', NULL, '2132312', '1', '1', '1', '24.9408123', '67.0948427', 'yes', '1', NULL, NULL, NULL, '1'),
(31, 1, 1, 1, 'Ahsan', 'r343', '03362287283', NULL, '123123213', '1', '', '', '24.9408034', '67.0948242', 'no', '80000', NULL, NULL, NULL, ''),
(32, 1, 1, 1, '', 'r343', '', NULL, '', '', '', '', '24.9407922', '67.0948472', '', '', NULL, NULL, NULL, ''),
(33, 1, 1, 1, 'Ahsan', 'r343', '03362287283', NULL, '123213213213213', '1', '', 'Lahore', '24.9408114', '67.0948242', 'no', '80000', NULL, NULL, NULL, ''),
(52, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408255', '67.0948367', '', '', NULL, NULL, NULL, ''),
(53, 1, 1, 1, '', '', '', NULL, '', '', '', 'Lahore', '24.9408232', '67.0949092', '', '', NULL, NULL, NULL, ''),
(54, 1, 1, 1, 'Ahsan', 'r343', '03362287283', NULL, '123', '1', '', 'Lahore', '24.9408152', '67.0949102', 'no', '80000', NULL, NULL, NULL, 'I4zvckVxW5'),
(55, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9407959', '67.0948377', '', '', NULL, NULL, NULL, 'LraEqNgouI'),
(56, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408238', '67.0948393', '', '', NULL, NULL, NULL, 'psqFjBDHMX'),
(57, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408197', '67.0948435', '', '', NULL, NULL, NULL, 'ej6JUaNQfW'),
(58, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9407975', '67.0948323', '', '', NULL, NULL, NULL, 'fOkaplnWpL'),
(59, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408171', '67.0948332', '', '', NULL, NULL, NULL, 'u4nwFzOs0c'),
(60, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408166', '67.0948597', '', '', NULL, NULL, NULL, 'cd3e7IYKAx'),
(61, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408101', '67.0948314', '', '', NULL, NULL, NULL, 'GzSuKhtOYm'),
(62, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408166', '67.0948245', '', '', NULL, NULL, NULL, 'Vdf8qX69WS'),
(63, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408152', '67.0948417', '', '', NULL, NULL, NULL, 'ysx2LZOGSI'),
(64, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.940812', '67.0948365', '', '', NULL, NULL, NULL, 'NAnEk6Qvu6'),
(65, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408114', '67.0948742', '', '', NULL, NULL, NULL, 'AksjazXysx'),
(66, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408', '67.094833', '', '', NULL, NULL, NULL, 'hst14dZ90f'),
(67, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408012', '67.0948525', '', '', NULL, NULL, NULL, 'VWV7dniIor'),
(68, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408125', '67.0948499', '', '', NULL, NULL, NULL, 'ToQh0JnIQd'),
(69, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408118', '67.0948481', '', '', NULL, NULL, NULL, 'm3UQFZVOtO'),
(70, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408023', '67.0948237', '', '', NULL, NULL, NULL, 'JGfL21qznu'),
(71, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408071', '67.0948175', '', '', NULL, NULL, NULL, 'HgLpYPHuI7'),
(72, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408136', '67.0948161', '', '', NULL, NULL, NULL, '6oeW1oJCmY'),
(73, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408096', '67.0948197', '', '', NULL, NULL, NULL, '2Hus5W9cuw'),
(74, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408137', '67.0948254', '', '', NULL, NULL, NULL, 'zhGcrobnmc'),
(75, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408129', '67.0948428', '', '', NULL, NULL, NULL, 'Xc4joJGffb'),
(76, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.940822', '67.0948346', '', '', NULL, NULL, NULL, '47JgmeBbXy'),
(77, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408167', '67.0948363', '', '', NULL, NULL, NULL, 'aqOHS0BiMP'),
(78, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408092', '67.0948676', '', '', NULL, NULL, NULL, 'jcdygDvYQ7'),
(79, 1, 1, 1, '', 'r343', '', NULL, '', '', '', 'Lahore', '24.9408132', '67.0948426', '', '', NULL, NULL, NULL, 'zJ8Vk0ImTo'),
(80, 1, 1, 1, '', '', '', NULL, '', '', '', 'korangi central', '24.9407955', '67.0948958', '', '', NULL, NULL, NULL, ''),
(81, 1, 1, 1, '', '', '', NULL, '', '', '', 'korangi central', '24.9407516', '67.0949431', '', '', NULL, NULL, NULL, ''),
(82, 1, 1, 1, '', '', '', NULL, '', '', '', '', '24.9407985', '67.0948086', '', '', NULL, NULL, NULL, ''),
(83, 1, 1, 1, 'Ahsan', 'r343', '03362287283', NULL, '123', '1', '', 'Home', '24.9408125', '67.0948426', 'no', '80000', NULL, NULL, NULL, '56d30mhp7K');

-- --------------------------------------------------------

--
-- Table structure for table `Campaign`
--

CREATE TABLE `Campaign` (
  `CampaignID` int(10) UNSIGNED NOT NULL,
  `TriggerEvent_TriggerEventID` int(10) UNSIGNED NOT NULL,
  `Org_OrgID` int(10) UNSIGNED NOT NULL,
  `CampaignType_CampaignTypeID` int(10) UNSIGNED NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `StartDate` varchar(255) DEFAULT NULL,
  `EndDate` varchar(255) DEFAULT NULL,
  `CostPerUnit` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Campaign`
--

INSERT INTO `Campaign` (`CampaignID`, `TriggerEvent_TriggerEventID`, `Org_OrgID`, `CampaignType_CampaignTypeID`, `Title`, `Description`, `StartDate`, `EndDate`, `CostPerUnit`) VALUES
(1, 1, 1, 1, 'Covid', 'covid bad', '2020-04-13', NULL, '100'),
(6, 1, 3, 1, 'Ration Distribution Ramdan 2020', 'Ration Drive ', '2020-04-23', NULL, '2500'),
(7, 1, 3, 1, 'Pandemic Relief', 'Pandemic', '2020-03-20', NULL, '1700');

-- --------------------------------------------------------

--
-- Table structure for table `CampaignBeneficiary_t`
--

CREATE TABLE `CampaignBeneficiary_t` (
  `BeneficiaryID` varchar(20) NOT NULL,
  `CampaignID` varchar(10) NOT NULL,
  `VolunteerID` varchar(20) NOT NULL,
  `Qty` int(10) NOT NULL,
  `receivedBy` int(10) NOT NULL,
  `timeAdded` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CampaignBeneficiary_t`
--

INSERT INTO `CampaignBeneficiary_t` (`BeneficiaryID`, `CampaignID`, `VolunteerID`, `Qty`, `receivedBy`, `timeAdded`) VALUES
('1', '1', '1', 1, 1, NULL),
('3', '1', '1', 1, 1, NULL),
('13', '1', '1587044526597Ngo1', 1, 1, NULL),
('14', '', '1', 1, 1, NULL),
('15', '1', '1587044526597Ngo1', 1, 1, NULL),
('16', '1', '1587044526597Ngo1', 1, 1, NULL),
('17', '', '', 1, 1, '$timeAdded'),
('31', '', '', 1, 1, '$timeAdded'),
('32', '', '1', 1, 1, '1589716694'),
('33', '1', '1', 1, 1, '1589716769'),
('52', '1', '1', 1, 1, '1589716974'),
('53', '1', '1', 1, 1, '1589717008'),
('54', '1', '1', 1, 1, '1589717026'),
('55', '1', '1', 1, 1, '1589717498'),
('56', '1', '1', 1, 1, '1589717599'),
('57', '1', '1', 1, 1, '1589717603'),
('58', '1', '1', 1, 1, '1589717607'),
('59', '1', '1', 1, 1, '1589717633'),
('60', '1', '1', 1, 1, '1589717642'),
('61', '1', '1', 1, 1, '1589717650'),
('62', '1', '1', 1, 1, '1589717659'),
('63', '1', '1', 1, 1, '1589717696'),
('64', '1', '1', 1, 1, '1589717709'),
('65', '1', '1', 1, 1, '1589717714'),
('66', '1', '1', 1, 1, '1589717759'),
('67', '1', '1', 1, 1, '1589717769'),
('68', '1', '1', 1, 1, '1589717848'),
('69', '1', '1', 1, 1, '1589717854'),
('70', '1', '1', 1, 1, '1589717858'),
('71', '1', '1', 1, 1, '1589717873'),
('72', '1', '1', 1, 1, '1589717877'),
('73', '1', '1', 1, 1, '1589717886'),
('74', '1', '1', 1, 1, '1589717890'),
('75', '1', '1', 1, 1, '1589717898'),
('76', '1', '1', 1, 1, '1589717958'),
('77', '1', '1', 1, 1, '1589717965'),
('78', '1', '1', 1, 1, '1589717969'),
('79', '1', '1', 1, 1, '1589717976'),
('80', '1', '1587044526597Ngo1', 1, 1, '1589722701'),
('81', '1', '1587044526597Ngo1', 1, 1, '1589722824'),
('82', '', '1', 1, 1, '1589914005'),
('83', '7', '1', 1, 1, '1590747807');

-- --------------------------------------------------------

--
-- Table structure for table `CampaignType`
--

CREATE TABLE `CampaignType` (
  `CampaignTypeID` int(10) UNSIGNED NOT NULL,
  `CampaignType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CampaignType`
--

INSERT INTO `CampaignType` (`CampaignTypeID`, `CampaignType`) VALUES
(1, 'Timed');

-- --------------------------------------------------------

--
-- Table structure for table `Household`
--

CREATE TABLE `Household` (
  `HouseholdID` int(10) UNSIGNED NOT NULL,
  `Code` varchar(10) NOT NULL,
  `TotalMonthlyIncome` int(10) UNSIGNED DEFAULT NULL,
  `NoofEarningPersons` int(10) UNSIGNED DEFAULT NULL,
  `IsHouseRented` bit(1) DEFAULT NULL,
  `HouseholdSize` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Household`
--

INSERT INTO `Household` (`HouseholdID`, `Code`, `TotalMonthlyIncome`, `NoofEarningPersons`, `IsHouseRented`, `HouseholdSize`) VALUES
(1, '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `LoginID` int(10) UNSIGNED NOT NULL,
  `LoginRole_LoginRoleID` int(10) UNSIGNED NOT NULL,
  `Org_OrgID` int(10) UNSIGNED NOT NULL,
  `UserName` varchar(256) DEFAULT NULL,
  `Pwd` varchar(256) DEFAULT NULL,
  `RegisteredOn` varchar(255) DEFAULT NULL,
  `Email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`LoginID`, `LoginRole_LoginRoleID`, `Org_OrgID`, `UserName`, `Pwd`, `RegisteredOn`, `Email`) VALUES
(1, 1, 1, 'Ahsan Ahmed', '3cce45bf21f047a954e1861c653a14ba', NULL, 'ahsan@volunteer.com'),
(2, 1, 3, 'Volunteer1', 'c4cbf53b3e779e5257cbe3bcce38f13b', NULL, 'asasas@asdsd.com'),
(3, 1, 3, 'v1', 'fee7e03bb7d77842221417760d35357a', NULL, 'v1@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `LoginRole`
--

CREATE TABLE `LoginRole` (
  `LoginRoleID` int(10) UNSIGNED NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LoginRole`
--

INSERT INTO `LoginRole` (`LoginRoleID`, `RoleName`) VALUES
(1, 'Volunteer');

-- --------------------------------------------------------

--
-- Table structure for table `Occupation`
--

CREATE TABLE `Occupation` (
  `OccupationID` int(10) UNSIGNED NOT NULL,
  `OccupationName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Occupation`
--

INSERT INTO `Occupation` (`OccupationID`, `OccupationName`) VALUES
(1, 'Labour'),
(2, 'Stitching kaarigar'),
(3, 'Widow'),
(4, 'Security Guard'),
(5, 'Garments Worker'),
(6, 'Rickshaw Driver'),
(7, 'Senior Citizen'),
(8, 'Zarri kaarigar'),
(9, 'ex Police Welfare'),
(10, 'Unemployed'),
(11, 'Push Cart Wala');

-- --------------------------------------------------------

--
-- Table structure for table `Org`
--

CREATE TABLE `Org` (
  `OrgID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(250) NOT NULL,
  `RegisteredOn` date DEFAULT NULL,
  `RegistrationNo` varchar(50) DEFAULT NULL,
  `ContactPerson` varchar(50) NOT NULL,
  `ContactNumber` varchar(30) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Org`
--

INSERT INTO `Org` (`OrgID`, `Name`, `RegisteredOn`, `RegistrationNo`, `ContactPerson`, `ContactNumber`, `Address`, `email`, `password`) VALUES
(1, 'Ahsan Ahmed', NULL, '218739', 'Ahsan', '9812739821', 'r343', 'admin@ara.com', '3cce45bf21f047a954e1861c653a14ba'),
(2, 'Tooba', NULL, '23', '76', '76', '76', 'tooba@gmail.com', '6abbc99b5b72c468efac48cf99addfef'),
(3, 'SSRNGO', NULL, '1212121', 'SSR', '121212121', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasa', 'saleha.raza@sse.habib.edu.pk', 'c71361ab2d0bfb76fa8464a71ff2f4cb');

-- --------------------------------------------------------

--
-- Table structure for table `TriggerEvent`
--

CREATE TABLE `TriggerEvent` (
  `TriggerEventID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TriggerEvent`
--

INSERT INTO `TriggerEvent` (`TriggerEventID`, `Name`, `Description`) VALUES
(1, 'Covid', 'Covid');

-- --------------------------------------------------------

--
-- Table structure for table `Volunteer`
--

CREATE TABLE `Volunteer` (
  `VolunteerID` int(10) UNSIGNED NOT NULL,
  `VolunteerType_VolunteerTypeID` int(10) UNSIGNED NOT NULL,
  `Org_OrgID` int(10) UNSIGNED NOT NULL,
  `Login_LoginID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(50) NOT NULL,
  `NIC` varchar(25) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Area_AreaID` int(10) UNSIGNED NOT NULL,
  `Cell` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Volunteer`
--

INSERT INTO `Volunteer` (`VolunteerID`, `VolunteerType_VolunteerTypeID`, `Org_OrgID`, `Login_LoginID`, `Name`, `NIC`, `Address`, `Area_AreaID`, `Cell`) VALUES
(1, 1, 1, 1, 'Volunteer', NULL, NULL, 1, '00000');

-- --------------------------------------------------------

--
-- Table structure for table `VolunteerType`
--

CREATE TABLE `VolunteerType` (
  `VolunteerTypeID` int(10) UNSIGNED NOT NULL,
  `TypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `VolunteerType`
--

INSERT INTO `VolunteerType` (`VolunteerTypeID`, `TypeName`) VALUES
(1, 'Volunteer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Area`
--
ALTER TABLE `Area`
  ADD PRIMARY KEY (`AreaID`),
  ADD KEY `Parent_AreaID` (`Parent_AreaID`);

--
-- Indexes for table `Beneficiary`
--
ALTER TABLE `Beneficiary`
  ADD PRIMARY KEY (`BeneficiaryID`),
  ADD KEY `Household_HouseholdID` (`Household_HouseholdID`),
  ADD KEY `Area_AreaID` (`Area_AreaID`),
  ADD KEY `Occupation_OccupationID` (`Occupation_OccupationID`);

--
-- Indexes for table `Campaign`
--
ALTER TABLE `Campaign`
  ADD PRIMARY KEY (`CampaignID`),
  ADD KEY `CampaignType_CampaignTypeID` (`CampaignType_CampaignTypeID`),
  ADD KEY `Org_OrgID` (`Org_OrgID`),
  ADD KEY `TriggerEvent_TriggerEventID` (`TriggerEvent_TriggerEventID`);

--
-- Indexes for table `CampaignType`
--
ALTER TABLE `CampaignType`
  ADD PRIMARY KEY (`CampaignTypeID`);

--
-- Indexes for table `Household`
--
ALTER TABLE `Household`
  ADD PRIMARY KEY (`HouseholdID`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`LoginID`),
  ADD KEY `Org_OrgID` (`Org_OrgID`),
  ADD KEY `LoginRole_LoginRoleID` (`LoginRole_LoginRoleID`);

--
-- Indexes for table `LoginRole`
--
ALTER TABLE `LoginRole`
  ADD PRIMARY KEY (`LoginRoleID`);

--
-- Indexes for table `Occupation`
--
ALTER TABLE `Occupation`
  ADD PRIMARY KEY (`OccupationID`);

--
-- Indexes for table `Org`
--
ALTER TABLE `Org`
  ADD PRIMARY KEY (`OrgID`);

--
-- Indexes for table `TriggerEvent`
--
ALTER TABLE `TriggerEvent`
  ADD PRIMARY KEY (`TriggerEventID`);

--
-- Indexes for table `Volunteer`
--
ALTER TABLE `Volunteer`
  ADD PRIMARY KEY (`VolunteerID`),
  ADD KEY `Org_OrgID` (`Org_OrgID`),
  ADD KEY `Login_LoginID` (`Login_LoginID`),
  ADD KEY `Area_AreaID` (`Area_AreaID`);

--
-- Indexes for table `VolunteerType`
--
ALTER TABLE `VolunteerType`
  ADD PRIMARY KEY (`VolunteerTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Area`
--
ALTER TABLE `Area`
  MODIFY `AreaID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Beneficiary`
--
ALTER TABLE `Beneficiary`
  MODIFY `BeneficiaryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `Campaign`
--
ALTER TABLE `Campaign`
  MODIFY `CampaignID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `CampaignType`
--
ALTER TABLE `CampaignType`
  MODIFY `CampaignTypeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Household`
--
ALTER TABLE `Household`
  MODIFY `HouseholdID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `LoginID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `LoginRole`
--
ALTER TABLE `LoginRole`
  MODIFY `LoginRoleID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Occupation`
--
ALTER TABLE `Occupation`
  MODIFY `OccupationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Org`
--
ALTER TABLE `Org`
  MODIFY `OrgID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `TriggerEvent`
--
ALTER TABLE `TriggerEvent`
  MODIFY `TriggerEventID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Volunteer`
--
ALTER TABLE `Volunteer`
  MODIFY `VolunteerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `VolunteerType`
--
ALTER TABLE `VolunteerType`
  MODIFY `VolunteerTypeID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Area`
--
ALTER TABLE `Area`
  ADD CONSTRAINT `Area_ibfk_1` FOREIGN KEY (`Parent_AreaID`) REFERENCES `Area` (`AreaID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Beneficiary`
--
ALTER TABLE `Beneficiary`
  ADD CONSTRAINT `Beneficiary_ibfk_1` FOREIGN KEY (`Household_HouseholdID`) REFERENCES `Household` (`HouseholdID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Beneficiary_ibfk_2` FOREIGN KEY (`Area_AreaID`) REFERENCES `Area` (`AreaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Beneficiary_ibfk_3` FOREIGN KEY (`Occupation_OccupationID`) REFERENCES `Occupation` (`OccupationID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Campaign`
--
ALTER TABLE `Campaign`
  ADD CONSTRAINT `Campaign_ibfk_1` FOREIGN KEY (`CampaignType_CampaignTypeID`) REFERENCES `CampaignType` (`CampaignTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Campaign_ibfk_2` FOREIGN KEY (`Org_OrgID`) REFERENCES `Org` (`OrgID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Campaign_ibfk_3` FOREIGN KEY (`TriggerEvent_TriggerEventID`) REFERENCES `TriggerEvent` (`TriggerEventID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `Login_ibfk_1` FOREIGN KEY (`Org_OrgID`) REFERENCES `Org` (`OrgID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Login_ibfk_2` FOREIGN KEY (`LoginRole_LoginRoleID`) REFERENCES `LoginRole` (`LoginRoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Volunteer`
--
ALTER TABLE `Volunteer`
  ADD CONSTRAINT `Volunteer_ibfk_1` FOREIGN KEY (`Org_OrgID`) REFERENCES `Org` (`OrgID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Volunteer_ibfk_2` FOREIGN KEY (`Login_LoginID`) REFERENCES `Login` (`LoginID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Volunteer_ibfk_3` FOREIGN KEY (`VolunteerType_VolunteerTypeID`) REFERENCES `VolunteerType` (`VolunteerTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Volunteer_ibfk_4` FOREIGN KEY (`Area_AreaID`) REFERENCES `Area` (`AreaID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
