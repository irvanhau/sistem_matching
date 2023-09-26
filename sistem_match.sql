-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Sep 26, 2023 at 07:35 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_match`
--

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE IF NOT EXISTS `bom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bom_id` varchar(255) NOT NULL,
  `bom_name` varchar(255) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `input_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bom_id` (`bom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`id`, `bom_id`, `bom_name`, `name_file`, `input_date`, `created_at`, `deleted_at`) VALUES
(1, '0089', 'HC550DQG-ABXL2-91B4A', 'upload/bom/HC550DQG-ABXL2-91B4A.xlsx', '2023-08-04', '2023-08-04 06:18:37', NULL),
(2, '123', 'HC550DQG-ABXL2-91B4A_Test', 'upload/bom/HC550DQG-ABXL2-91B4A_Test.xlsx', '2023-08-08', '2023-08-08 03:44:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bom_detail`
--

CREATE TABLE IF NOT EXISTS `bom_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bom_id` int(11) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `specification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bom_id` (`bom_id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bom_detail`
--

INSERT INTO `bom_detail` (`id`, `bom_id`, `part_number`, `qty`, `specification`) VALUES
(1, 1, 'MC55B020097A', '1', 'HC550DQG-ABXL2-91B4A'),
(2, 1, 'LC32771003A', '0.08', 'W20mm*T50M, SINGLE, FIXING.SOOKWANG, OPP, YELLOW, LCM.7250L-0319A'),
(3, 1, 'MC55B030002J', '1', 'HC550DQG-ABXL2-91B41(Global)'),
(4, 1, 'LC55A220074A', '1', 'HC550DQG-SLXL1, PC+ABS+GF15%,.With PAD, BLACK.ADV77126001'),
(5, 1, 'LC55A221079A', '1', 'PC+ABS+GF15%, ë¶€ì‹+.ì „ë©´ Hairline, CERAMIC BLACK.MBN65585101'),
(6, 1, 'LC55701381A', '2', 'BCF-06S, L1216.2*W3.0*0.4T'),
(7, 1, 'LC55701382A', '2', 'BCF-06S, L687.3*W3.0*0.4T'),
(8, 1, 'LC32B981014A', '2.71', 'PET, W28mm, 450g, Protection Film'),
(9, 1, 'LC43B981036A', '1.25', 'PET, W26mm, 450g, Protection Film'),
(10, 1, 'LC55B981050A', '0.04', 'PE Type, 80g,.T50ãŽ›, W15mm'),
(11, 1, 'LC55751027A', '2', 'YGC-CF0703, L32.2*W6.5*0.11T'),
(12, 1, 'LC55271097A', '1', 'EGI, 0.5T'),
(13, 1, 'LZ40111594A', '5', 'M3,L5*D5.5(1.1T), FLAT HEAD.SWCH18A,FZMw(Cr3+CHROMATE)'),
(14, 1, 'LZ40111594B', '7', 'M3,L8*5.5Î¦(1.1T),FLAT HEAD.SWCH18A,FZMw(Cr3+CHROMATE)'),
(15, 1, 'LZ40121407A', '17', 'M3.0xL6, Pan head(Ã¸5.5).p type, SWCH18A, FZMw, Cr3'),
(16, 1, 'LC55A090015B', '1', 'NON-SEALING CINEMA PANEL, BOE, TCON LESS, HV550QUB-F1D, HC550DQG-ABDA'),
(17, 1, 'LZ10301025A', '1', 'L48*W30'),
(18, 1, 'LC55030144F', '1', 'HC550DQG-ABXL2-914B1'),
(19, 1, 'LC55200234F', '1', 'HC550DQG-ABXL2-914B1'),
(20, 1, 'LC55A210018H', '1', 'HC550DQG-ABXL2-91441'),
(21, 1, 'LC55201094A', '1', 'EGI, 0.6T.MCK70425101'),
(22, 1, 'LC55291033A', '1', 'EGI, 0.5T.MGJ66361201'),
(23, 1, 'LC55721135A', '4', 'PET, YHL-D085, L584.3*W14*T0.08'),
(24, 1, 'LC55A131039A', '8', 'DM8570N+DLAT130A+5000S, Black'),
(25, 1, 'LC55741179A', '6', 'L35*W15*0.055T, JA522#, WHITE'),
(26, 1, 'LC55741162A', '2', 'JA522#55, WH.45*45*0.055T'),
(27, 1, 'LC55741181A', '2', 'L40.0*W26.0*0.085T,.JA522#, WHITE(í˜•ìƒ æœ‰)'),
(28, 1, 'LC55700001A', '2', 'EPDM+NITTO GA3014, L42.0 * W15.0 * 3.0T, Black'),
(29, 1, 'LC55490297A', '4', '1616PKG CSP, Anisotropic Shape Lens(Small), Hongli, 8PKG, VLED í­ 2.0mm'),
(30, 1, 'LC43A451001A', '8', '1616, CSP, 2CHIP, Hongli'),
(31, 1, 'LC43361001A', '8', 'MOLD PMMA Hongli LENS'),
(32, 1, 'LC55911046A', '1', 'MCPCB, MCPCB, L582.3*W15*T1, VLED í­ 2.0mm'),
(33, 1, 'LZ50351001A', '1', 'SSC, 70V.EBZ63425001'),
(34, 1, 'LZ50101078A', '1', 'YW500-H02E1, YEONHO, 2PIN'),
(35, 1, 'LC55920052A', '1', 'HC550DQG-SLXL1, 2PIN'),
(36, 1, 'LC55921026A', '1', 'UL10368, #28, 825ãŽœ,.Ã˜0.8, BLUE'),
(37, 1, 'LC55921027A', '2', 'UL10368, #28, 270ãŽœ, .Ã˜0.8, RED'),
(38, 1, 'LC55921028A', '1', 'UL10368, #28, 426ãŽœ,.Ã˜0.8, RED'),
(39, 1, 'LC55921029A', '1', 'UL10368, #28, 332ãŽœ.Ã˜0.8, BLACK'),
(40, 1, 'LC86A901001A', '2', 'SUMITOMO, BLACK, L20.0.EBZ63398801'),
(41, 1, 'LZ50101076A', '4', 'YH500-H02E, YT500-E, 2PIN, YEONHO, WHITE'),
(42, 1, 'LZ50101077A', '1', 'SMH200-07M/YST200-C6, YEONHO, 7PIN'),
(43, 1, 'LC49711011A', '3', 'L30*W25*T0.055,JA522#, WH'),
(44, 1, 'LC49711012A', '1', 'JA522, W30*L40*T0.055, Black'),
(45, 1, 'LC32A861001A', '1', 'L38*W21'),
(46, 1, 'LC55501121A', '1', 'CSR188Y, Solatron, 55\", T0.188, Printed'),
(47, 1, 'LC55551011A', '1', 'CSF413-D3L(2D), T0.270(10mil), Solatron, 55\"'),
(48, 1, 'LC55561032A', '1', 'CSF570-D3L(88D), T0.278(10mil), Solatron, 55\"'),
(49, 1, 'LC55341030A', '1', 'PS, CSP55-12, T1.2, ORZ(Jinfu)'),
(50, 1, 'LC43141003A', '9', 'PC SR1000U, Clear,'),
(51, 1, 'LC43131001A', '4', 'PC SR1200F, White'),
(52, 1, 'LC55100100B', '1', 'HC550DQG-ABXL1-9113, PC+GF 10%.SS, SR2100F, With PAD'),
(53, 1, 'LC55101091A', '1', 'PC+GF 10%, SS, SR2100F.MEA65630101'),
(54, 1, 'LC55701367A', '1', 'LRS40+SKL-D100,.L1214.2xW3.0xT1.0, GRAY'),
(55, 1, 'LC55701373A', '1', 'LRS40+SKL-D100,.L1214.2xW3.0xT1.2, GRAY'),
(56, 1, 'LC55701368A', '2', 'LRS40+SKL-D100,.L685.0xW3.0xT1.0, GRAY'),
(57, 1, 'LC55701376A', '1', 'KVH+ML-35100PL, L1214.4 x W2.5 x T1.4, BLACK'),
(58, 1, 'LC55701377A', '1', 'KVH+ML-35100PL, L1214.4 x W2.5 x T1.6, BLACK'),
(59, 1, 'LC55701378A', '2', 'KVH+ML-35100PL, L685.5 x W2.5 x T1.4, BLACK'),
(60, 2, 'MC55B020096A', '1', 'HC550DQG-ABXL2-91B4A'),
(61, 2, 'LC32771003A', '0.08', 'W20mm*T50M, SINGLE, FIXING.SOOKWANG, OPP, YELLOW, LCM.7250L-0319A'),
(62, 2, 'MC55B030002J', '1', 'HC550DQG-ABXL2-91B41(Global)'),
(63, 2, 'LC55A220074A', '1', 'HC550DQG-SLXL1, PC+ABS+GF15%,.With PAD, BLACK.ADV77126001'),
(64, 2, 'LC55A221079A', '1', 'PC+ABS+GF15%, ë¶€ì‹+.ì „ë©´ Hairline, CERAMIC BLACK.MBN65585101'),
(65, 2, 'LC55701381A', '2', 'BCF-06S, L1216.2*W3.0*0.4T'),
(66, 2, 'LC55701382A', '2', 'BCF-06S, L687.3*W3.0*0.4T'),
(67, 2, 'LC32B981014A', '2.71', 'PET, W28mm, 450g, Protection Film'),
(68, 2, 'LC43B981036A', '1.25', 'PET, W26mm, 450g, Protection Film'),
(69, 2, 'LC55B981050A', '0.04', 'PE Type, 80g,.T50ãŽ›, W15mm'),
(70, 2, 'LC55751027A', '2', 'YGC-CF0703, L32.2*W6.5*0.11T'),
(71, 2, 'LC55271097A', '1', 'EGI, 0.5T'),
(72, 2, 'LZ40111594A', '5', 'M3,L5*D5.5(1.1T), FLAT HEAD.SWCH18A,FZMw(Cr3+CHROMATE)'),
(73, 2, 'LZ40111594B', '7', 'M3,L8*5.5Î¦(1.1T),FLAT HEAD.SWCH18A,FZMw(Cr3+CHROMATE)'),
(74, 2, 'LZ40121407A', '17', 'M3.0xL6, Pan head(Ã¸5.5).p type, SWCH18A, FZMw, Cr3'),
(75, 2, 'LC55A090015B', '1', 'NON-SEALING CINEMA PANEL, BOE, TCON LESS, HV550QUB-F1D, HC550DQG-ABDA'),
(76, 2, 'LZ10301025A', '1', 'L48*W30'),
(77, 2, 'LC55030144F', '1', 'HC550DQG-ABXL2-914B1'),
(78, 2, 'LC55200234F', '1', 'HC550DQG-ABXL2-914B1'),
(79, 2, 'LC55A210018H', '1', 'HC550DQG-ABXL2-91441'),
(80, 2, 'LC55201094A', '1', 'EGI, 0.6T.MCK70425101'),
(81, 2, 'LC55291033A', '1', 'EGI, 0.5T.MGJ66361201'),
(82, 2, 'LC55721135A', '4', 'PET, YHL-D085, L584.3*W14*T0.08'),
(83, 2, 'LC55A131039A', '8', 'DM8570N+DLAT130A+5000S, Black'),
(84, 2, 'LC55741179A', '6', 'L35*W15*0.055T, JA522#, WHITE'),
(85, 2, 'LC55741162A', '2', 'JA522#55, WH.45*45*0.055T'),
(86, 2, 'LC55741181A', '2', 'L40.0*W26.0*0.085T,.JA522#, WHITE(í˜•ìƒ æœ‰)'),
(87, 2, 'LC55700001A', '2', 'EPDM+NITTO GA3014, L42.0 * W15.0 * 3.0T, Black'),
(88, 2, 'LC55490297A', '4', '1616PKG CSP, Anisotropic Shape Lens(Small), Hongli, 8PKG, VLED í­ 2.0mm'),
(89, 2, 'LC43A451001A', '8', '1616, CSP, 2CHIP, Hongli'),
(90, 2, 'LC43361001A', '8', 'MOLD PMMA Hongli LENS'),
(91, 2, 'LC55911046A', '1', 'MCPCB, MCPCB, L582.3*W15*T1, VLED í­ 2.0mm'),
(92, 2, 'LZ50351001A', '1', 'SSC, 70V.EBZ63425001'),
(93, 2, 'LZ50101078A', '1', 'YW500-H02E1, YEONHO, 2PIN'),
(94, 2, 'LC55920052A', '1', 'HC550DQG-SLXL1, 2PIN'),
(95, 2, 'LC55921026A', '1', 'UL10368, #28, 825ãŽœ,.Ã˜0.8, BLUE'),
(96, 2, 'LC55921027A', '2', 'UL10368, #28, 270ãŽœ, .Ã˜0.8, RED'),
(97, 2, 'LC55921028A', '1', 'UL10368, #28, 426ãŽœ,.Ã˜0.8, RED'),
(98, 2, 'LC55921029A', '1', 'UL10368, #28, 332ãŽœ.Ã˜0.8, BLACK'),
(99, 2, 'LC86A901001A', '2', 'SUMITOMO, BLACK, L20.0.EBZ63398801'),
(100, 2, 'LZ50101076A', '4', 'YH500-H02E, YT500-E, 2PIN, YEONHO, WHITE'),
(101, 2, 'LZ50101077A', '1', 'SMH200-07M/YST200-C6, YEONHO, 7PIN'),
(102, 2, 'LC49711011A', '3', 'L30*W25*T0.055,JA522#, WH'),
(103, 2, 'LC49711012A', '1', 'JA522, W30*L40*T0.055, Black'),
(104, 2, 'LC32A861001A', '1', 'L38*W21'),
(105, 2, 'LC55501121A', '1', 'CSR188Y, Solatron, 55\", T0.188, Printed'),
(106, 2, 'LC55551011A', '1', 'CSF413-D3L(2D), T0.270(10mil), Solatron, 55\"'),
(107, 2, 'LC55561032A', '1', 'CSF570-D3L(88D), T0.278(10mil), Solatron, 55\"'),
(108, 2, 'LC55341030A', '1', 'PS, CSP55-12, T1.2, ORZ(Jinfu)'),
(109, 2, 'LC43141003A', '9', 'PC SR1000U, Clear,'),
(110, 2, 'LC43131001A', '4', 'PC SR1200F, White'),
(111, 2, 'LC55100100B', '1', 'HC550DQG-ABXL1-9113, PC+GF 10%.SS, SR2100F, With PAD'),
(112, 2, 'LC55101091A', '1', 'PC+GF 10%, SS, SR2100F.MEA65630101'),
(113, 2, 'LC55701367A', '1', 'LRS40+SKL-D100,.L1214.2xW3.0xT1.0, GRAY'),
(114, 2, 'LC55701373A', '1', 'LRS40+SKL-D100,.L1214.2xW3.0xT1.2, GRAY'),
(115, 2, 'LC55701368A', '2', 'LRS40+SKL-D100,.L685.0xW3.0xT1.0, GRAY'),
(116, 2, 'LC55701376A', '1', 'KVH+ML-35100PL, L1214.4 x W2.5 x T1.4, BLACK'),
(117, 2, 'LC55701377A', '1', 'KVH+ML-35100PL, L1214.4 x W2.5 x T1.6, BLACK'),
(118, 2, 'LC55701378A', '2', 'KVH+ML-35100PL, L685.5 x W2.5 x T1.4, BLACK');

-- --------------------------------------------------------

--
-- Table structure for table `matching_detail`
--

CREATE TABLE IF NOT EXISTS `matching_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bom_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matching_detail_user` (`user_id`),
  KEY `fk_matching_detail_bom` (`bom_id`),
  KEY `fk_matching_detail_part` (`part_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matching_detail`
--

INSERT INTO `matching_detail` (`id`, `user_id`, `bom_id`, `part_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 3, 1, 1),
(4, 1, 1, 1),
(5, 4, 1, 1),
(7, 1, 1, 1),
(9, 1, 2, 1),
(13, 1, 2, 1),
(14, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `part_list`
--

CREATE TABLE IF NOT EXISTS `part_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` varchar(255) NOT NULL,
  `part_name` varchar(255) NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `input_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_list`
--

INSERT INTO `part_list` (`id`, `part_id`, `part_name`, `name_file`, `input_date`, `created_at`, `deleted_at`) VALUES
(1, '0051', 'HC550DQG-ABXL2-91B4A', 'upload/part_list/HC550DQG-ABXL2-91B4A.xlsx', '2023-08-04', '2023-08-04 06:18:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `part_list_detail`
--

CREATE TABLE IF NOT EXISTS `part_list_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `specification` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `part_id` (`part_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `part_list_detail`
--

INSERT INTO `part_list_detail` (`id`, `part_id`, `item_name`, `part_number`, `qty`, `specification`) VALUES
(1, 1, 'ASS\'Y, LCM PACKING', 'MC55B010002J (Global)', '1', 'HC550DQG-ABXL2-91B41 (Global)'),
(2, 1, 'ASS\'Y, LCM PACKING', 'MC55B010096A (IN Domestic)', '1', 'HC550DQG-ABXL2-91B4A (IN Domestic) '),
(3, 1, 'ASS\'Y, LCM GROSS', 'MC55B020002J (Global)', '1', 'HC550DQG-ABXL2-91B41 (Global)'),
(4, 1, 'ASS\'Y, LCM GROSS', 'MC55B020096A (IN Domestic)', '1', 'HC550DQG-ABXL2-91B4A (IN Domestic) '),
(5, 1, 'BAG, AL', 'LZ10221088H', '1', 'BAG, AL.COMMON.55\" Direct(All in one),.1340*835'),
(6, 1, 'TAPE, PET', 'LC32771003A', '0.08(M)', 'W20mm*T50Mm.SOOKWANG, OPP, YELLOW, LCM'),
(7, 1, 'ASS\'Y, LCM', 'MC55B030002J', '1', 'HC550DQG-ABXL2-91B41'),
(8, 1, 'ASS\'Y, CASE TOP', 'LC55A220074A', '1', 'HC550DQG-SLXL1, PC+ABS GF15%, With PAD, BLACK'),
(9, 1, 'CASE TOP', 'LC55A221079A', '1', 'PC+ABS GF15%, ë¶€ì‹+ì „ë©´ Hairline, CELAMIC BLACK'),
(10, 1, 'PAD(UP/DOWN)', 'LC55701381A', '2', 'BCF-06S, L1216.2*W3.0*0.4T'),
(11, 1, 'PAD(SIDE)', 'LC55701382A', '2', 'BCF-06S, L687.3*W3.0*0.4T'),
(12, 1, 'PROTECTOR(U/L/R)', 'LC32B981014A', '2.71M', 'PE Type, 450g, 40um, 28mm'),
(13, 1, 'PROTECTOR(D)', 'LC43B981036A', '1.25M', 'PE Type, 450g, 40um, 26mm'),
(14, 1, 'PROTECTOR(Logo)', 'LC55B981050A', '0.04M', 'PE Type, 80g, T50ãŽ›, W15mm'),
(15, 1, 'TAPE, CONDUCTIVE', 'LC55751027A', '2', 'YGC-CF0703, L32.2*W6.5*0.11T'),
(16, 1, 'COVER SHIELD', 'LC55271097A', '1', 'EGI, 0.5T'),
(17, 1, 'SCREW, MACHINE TYPE', 'LZ40111594A', '5', 'MACHINE, Flat HEAD, M3, L5, FZMw(Cr3+CHROMATE), Silver'),
(18, 1, 'SCREW, MACHINE TYPE', 'LZ40111594B', '7', 'MACHINE, Flat HEAD, M3, L8, FZMw(Cr3+CHROMATE), Silver'),
(19, 1, 'SCREW, TAP TYPE', 'LZ40121407A', '17', 'TAP TYPE, M3.0xL6, Pan head(Ã¸5.5), SWCH18A, FZMw, Cr3'),
(20, 1, 'SREW, TAP TYPE', 'LZ40121407B', '17', 'M3.0xL6, FLAT TYPE HEAD(D5.5*H1.4), SWCH18A, FZMW, WHITE'),
(21, 1, 'ASS\'Y, BOARD', 'LC55A090015B', '1', 'HV550QUB-F1D, BOE, B10'),
(22, 1, 'LABEL, LCM', 'LZ10301025A', '1', 'L48*W30'),
(23, 1, 'ASS\'Y, BACK LIGHT UNIT', 'LC55030144F', '1', 'HC550DQG-ABXL2-91B41'),
(24, 1, 'ASS\'Y, COVER BOTTOM', 'LC55200234F', '1', 'HC550DQG-ABXL2-91B41'),
(25, 1, 'ASS\'Y, COVER BOTTOM SUB', 'LC55A210018H', '1', 'EGI, T0.6, WITH TAPE DOUBLE, S-PCB Holder'),
(26, 1, 'COVER BOTTOM', 'LC55201094A', '1', 'EGI, 0.6T'),
(27, 1, 'FRAME', 'LC55291033A', '1', 'EGI, 0.5T'),
(28, 1, 'TAPE, DOUBLE', 'LC55721135A', '4', 'PET, YHL-D085, L584.3*W14*T0.08'),
(29, 1, 'HOLDER, SPCB', 'LC55A131039A', '8', 'DM8570N+DLAT130A+5000S, Black'),
(30, 1, 'TAPE, SHIELD', 'LC55741179A', '6', 'L35*W15*0.055T, JA522#, WHITE'),
(31, 1, 'TAPE, SHIELD', 'LC55741162A', '2', 'L45*W45*0.055T, JA522#, WHITE'),
(32, 1, 'TAPE, SHIELD', 'LC55741181A', '2', 'L40.0*W26.0*0.085T, JA522#, WHITE(í˜•ìƒ æœ‰)'),
(33, 1, 'EPDM, PCB Holder', 'LC55700001A', '2', 'ASS\'Y, PAD.HC550DQG-SLDA1.EPDM+NITTO GA3014, L42.0 * W15.0 * 3.0T, Black'),
(34, 1, 'ASS\'Y, LED B/L', 'LC55490297A', '4', '1616PKG CSP, Anisotropic Shape Lens(Small), Hongli, 8PKG, VLED í­ 2.0mm'),
(35, 1, 'LED, PKG', 'LC43A451001A', '8', 'Hongli, 1616CSP'),
(36, 1, 'LENS, LED', 'LC43361001A', '8', 'Anisotropic Shape, PMMA'),
(37, 1, 'PCB', 'LC55911046A', '1', 'MCPCB, L582.3*W15*T1, VLED í­ 2.0mm'),
(38, 1, 'Diode (TVS,Zener)', 'LZ50351001A', '1', '84V ì´ìƒ'),
(39, 1, 'CONNECT', 'LZ50101078A', '1', 'YEONHO, YW500-H02E1(Black), 2 PIN, BLACK  '),
(40, 1, 'ASS\'Y, WIRE', 'LC55920052A', '1', 'HC550DQG-SLXL1, 2PIN'),
(41, 1, 'WIRE(A)', 'LC55921026A', '1', 'UL10368, #28, 825ãŽœ, Ã˜0.8, BLUE'),
(42, 1, 'WIRE(B)', 'LC55921027A', '2', 'UL10368, #28, 270ãŽœ, Ã˜0.8, RED'),
(43, 1, 'WIRE(C)', 'LC55921028A', '1', 'UL10368, #28, 426ãŽœ, Ã˜0.8, RED'),
(44, 1, 'WIRE(D)', 'LC55921029A', '1', 'UL10368, #28, 332ãŽœ, Ã˜0.8, BLACK'),
(45, 1, 'TUBE(SHRINK)', 'LC86A901001A', '2', 'NHR-4, 20mm, Î¦2.0'),
(46, 1, 'CONNECTOR', 'LZ50101076A', '4', 'YEONHO, YH500-H02E, YT500-E, 2Pin '),
(47, 1, 'CONNECTOR', 'LZ50101077A', '1', 'YEONHO, SMH200-07M/YST200-C6, 7pin'),
(48, 1, 'TAPE, SHIELD', 'LC49711011A', '3', 'L30*W25*0.055T, JA522#, WHITE'),
(49, 1, 'TAPE, SHIELD', 'LC49711012A', '1', 'L40*W30*0.055T, JA522#, BLACK'),
(50, 1, 'LABEL, COVER BOTTOM', 'LC32A861001A', '1', 'L38*W21'),
(51, 1, 'SHEET, RELFECTOR', 'LC55501121A', '1', '55\", Solatron, CSR188Y, T0.188, Printed'),
(52, 1, 'SHEET, PRISM-UP', 'LC55551011A', '1', '55\", Solatron, CSF413-D3L(2D), T0.270(10mil)'),
(53, 1, 'SHEET, PRISM-DOWN', 'LC55561032A', '1', '55\", Solatron, CSF570-D3L(88D), T0.278(10mil)'),
(54, 1, 'DIFFUSER PLATE, UNPRINTED', 'LC55341030A', '1', 'PS, ORZ(Jinfu), CSP55-12, T1.2'),
(55, 1, 'GUIDE, BOSS', 'LC43141003A', '9', 'PC SR1000U, Clear'),
(56, 1, 'GUIDE SHEET', 'LC43131001A', '4', 'PC SR1200F, White'),
(57, 1, 'ASS\'Y, GUIDE PANEL ', 'LC55100100B', '1', 'HC550DQG-ABXL1-9113, PC+GF 10%, SS, SR2100F, With PAD'),
(58, 1, 'GUIDE PANEL ', 'LC55101091A', '1', 'PC+GF 10%, SS, SR2100F'),
(59, 1, 'PAD(U)', 'LC55701367A', '1', 'LRS40+SKL-D100, L1214.2xW3.0xT1.0, GRAY'),
(60, 1, 'PAD(D)', 'LC55701373A', '1', 'LRS40+SKL-D100, L1214.2xW3.0xT1.2, GRAY'),
(61, 1, 'PAD(S)', 'LC55701368A', '2', 'LRS40+SKL-D100, L685.0xW3.0xT1.0, GRAY'),
(62, 1, 'PAD(U)', 'LC55701376A', '1', 'KVH+ML-35100PL , L1214.4 x W2.5 x T1.4, BLACK'),
(63, 1, 'PAD(D)', 'LC55701377A', '1', 'KVH+ML-35100PL , L1214.4 x W2.5 x T1.6, BLACK'),
(64, 1, 'PAD(S)', 'LC55701378A', '2', 'KVH+ML-35100PL , L685.5 x W2.5 x T1.4, BLACK'),
(65, 1, 'ASS\'Y, PACKING', 'LZ90101321A', '0.0714', 'ASS\'Y, PACKING.55UM73.LGE TV LCM 55UM73'),
(66, 1, 'Packing(Bottom)', 'LZ10252021B', '2', 'PACKING.55UM73(IN).Bottom, 1,315 * 562 * 590'),
(67, 1, 'Foam,PE', 'LZ10111093V', '4', 'FOAM, PE.55UM73.500*118, t20'),
(68, 1, 'Packing(Top)', 'LZ10252021A', '2', 'PACKING.55UM73(IN).Top, 1,315 * 562 * 240'),
(69, 1, 'Foam,PE', 'LZ10111093P', '3', 'FOAM, PE.55UM73.500*118*t15'),
(70, 1, 'Foam,PE', 'LZ10111666B', '1', 'FOAM, PE.55UQ75.EPE, 1,145*1,330*t30'),
(71, 1, 'Box', 'LZ10161041C', '1', 'BOX, PAD.55\" Common.Paper, 1,070*1,125*100'),
(72, 1, 'Pallet', 'LZ10901021B', '1', 'PALLET.55LB5500.LVL, 55LB55(LGD),.1335*1145*126.5'),
(73, 1, 'LABEL, BOX', 'LZ10311009A', '1', 'LABEL, PACKING.COMMON.COMMON, W66*L91.5, YUPO'),
(74, 1, 'LABEL, BOX', 'LC39821002A', '1', 'LABEL, BOX.HC390DUN-VCFP1.W66*L91.5'),
(75, 1, 'BAND', 'LZ10231002A', '8.172(M)', 'BAND.COMMON.PP, 17 * 400M * 1.0'),
(76, 1, 'WRAPING', 'LZ10241005B', '1503', 'LLDPE, 500*600M*0.025.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `profile_image`, `role`, `created_at`, `deleted_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$i1RY5l9V8Rh9YaK27TbsTO2PhcYCd.3JvV6VPJQefE7t4lKeNyTLa', NULL, 0, '2023-07-10 09:30:11', NULL),
(3, 'Irvan', 'irvanhau@gmail.com', '$2y$10$aASzCGGHmK6RCXWb4JdeCOfM5dNPaMwHEafd2vwMh5/mw2dXnE3Wu', '19800101000054_IMG_4095.JPG', 1, '2023-07-11 03:01:56', NULL),
(4, 'Hau', 'hauhau@gmail.com', '$2y$10$Q4FOqpnO7ls9v8r4Rn0RjO3h82kXOXbCKqMws/GY9t8J1mMKadajW', NULL, 1, '2023-07-11 03:02:51', NULL),
(5, 'Irvan Hauwerich', 'hauhau22@gmail.com', '$2y$10$Uy1diOLf/zhtNp/5Qy8PbO/5GWUOjjSTsWV60XH5QXwUnocKoptNO', NULL, 1, '2023-07-27 02:43:26', NULL),
(6, 'test', 'test@gmail.com', '$2y$10$3KAN3mNsCG1vYUam3vtd6uCW8T.BUP5hyEl2oUao3dhGlTn0/LCGy', NULL, 2, '2023-07-27 02:53:47', NULL),
(7, 'asd', 'asd@gmail.com', '$2y$10$PNvOLsXRshhC2BF72SQTZOLanWcjvIJnhdUdzibz5KPqnfZo6wqjW', NULL, 2, '2023-09-19 08:46:14', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bom_detail`
--
ALTER TABLE `bom_detail`
  ADD CONSTRAINT `fk_bom_id` FOREIGN KEY (`bom_id`) REFERENCES `bom` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `matching_detail`
--
ALTER TABLE `matching_detail`
  ADD CONSTRAINT `fk_matching_detail_bom` FOREIGN KEY (`bom_id`) REFERENCES `bom` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_matching_detail_part` FOREIGN KEY (`part_id`) REFERENCES `part_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_matching_detail_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_list_detail`
--
ALTER TABLE `part_list_detail`
  ADD CONSTRAINT `fk_part_id` FOREIGN KEY (`part_id`) REFERENCES `part_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
