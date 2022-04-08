-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 02:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdoin_dts`
--

-- --------------------------------------------------------

--
-- Table structure for table `docs_location`
--

CREATE TABLE `docs_location` (
  `dl_id` int(11) NOT NULL,
  `dl_tracking` varchar(50) NOT NULL,
  `dl_unit` int(11) NOT NULL,
  `dl_receivedby` int(11) DEFAULT 0,
  `dl_receiveddate` datetime DEFAULT NULL,
  `dl_releaseddate` datetime NOT NULL DEFAULT current_timestamp(),
  `dl_releasedby` int(11) NOT NULL,
  `dl_releasedbyunit` int(11) NOT NULL,
  `dl_forwarded` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctypes`
--

CREATE TABLE `doctypes` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `doc_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctypes`
--

INSERT INTO `doctypes` (`id`, `doc_id`, `doc_type`) VALUES
(1, 201, '042'),
(2, 202, 'Abstract of Quotation/PO-Contract/NOA'),
(3, 203, 'APP-PPMP'),
(4, 204, 'Application Letter'),
(5, 205, 'Audit Observation Memo/Notice of Disallowance'),
(6, 206, 'Authority to Travel'),
(7, 207, 'BAC Resolution'),
(8, 208, 'BAC Resolution/RFQ'),
(9, 209, 'Business Letter'),
(10, 210, 'Certificates/Diploma'),
(11, 211, 'Compensatory Time Off'),
(12, 212, 'CSC Form 33'),
(13, 213, 'CSC Form 6'),
(14, 214, 'CSC Form 9'),
(15, 215, 'DepEd Memorandum'),
(16, 216, 'DepEd Order'),
(17, 217, 'Designation of OIC'),
(18, 218, 'Division Advisory'),
(19, 219, 'Division Memorandum'),
(20, 220, 'Enhanced School Improvement Plan'),
(21, 221, 'Equivalent Record Form (ERF)'),
(22, 222, 'Itinerary of Travel'),
(23, 223, 'LAC Proposal'),
(24, 224, 'LAC Report'),
(25, 225, 'LOEGSI/NOSI'),
(26, 226, 'Mailed letters'),
(27, 227, 'MEMORANDUM'),
(28, 228, 'Notice of Cash Allocation (NCA)'),
(29, 229, 'Office Memorandum'),
(30, 230, 'Other'),
(31, 231, 'Petty Cash Voucher'),
(32, 232, 'Project Proposal'),
(33, 233, 'Purchase Order'),
(34, 234, 'Purchase Request'),
(35, 235, 'Regional Advisory'),
(36, 236, 'Regional Memorandum'),
(37, 237, 'Regional Order'),
(38, 238, 'Request for OIC'),
(39, 239, 'Retirement Papers'),
(40, 240, 'Sub-Allotment Release Order'),
(41, 241, 'Supervisory Plan'),
(42, 242, 'Training Proposal'),
(43, 243, 'Write Up R1AA');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `document_desc` varchar(255) NOT NULL,
  `document_type` int(5) NOT NULL,
  `document_purpose` varchar(255) NOT NULL,
  `document_origin` int(11) NOT NULL,
  `document_owner` int(5) NOT NULL,
  `document_tracking` varchar(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `document_accomplished` int(1) NOT NULL DEFAULT 0,
  `accomp_unit` int(11) DEFAULT NULL,
  `accomp_by` int(11) DEFAULT NULL,
  `accomp_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_id` varchar(55) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_type` varchar(20) NOT NULL,
  `unit_sector` varchar(20) NOT NULL,
  `unit_head` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_id`, `unit_name`, `unit_type`, `unit_sector`, `unit_head`) VALUES
(1, '101', 'Accounting', 'Division Office', 'Public', 0),
(2, '102', 'Administrative', 'Division Office', 'Public', 0),
(3, '103', 'ALS', 'Division Office', 'Public', 0),
(4, '104', 'ASDS Office', 'Division Office', 'Public', 0),
(5, '105', 'BAC Office', 'Division Office', 'Public', 0),
(6, '106', 'Budget', 'Division Office', 'Public', 0),
(7, '107', 'Cash Section', 'Division Office', 'Public', 0),
(8, '108', 'CID Proper', 'Division Office', 'Public', 0),
(9, '109', 'Dental Section', 'Division Office', 'Public', 0),
(10, '110', 'DRRM', 'Division Office', 'Public', 0),
(11, '111', 'Educational Facilities Development', 'Division Office', 'Public', 0),
(12, '112', 'HRTD', 'Division Office', 'Public', 0),
(13, '113', 'ICT', 'Division Office', 'Public', 0),
(14, '114', 'Legal', 'Division Office', 'Public', 0),
(15, '115', 'LRMDS', 'Division Office', 'Public', 0),
(16, '116', 'Medical', 'Division Office', 'Public', 0),
(17, '117', 'Office of the SDS', 'Division Office', 'Public', 1),
(18, '118', 'Payroll', 'Division Office', 'Public', 0),
(19, '119', 'Personnel', 'Division Office', 'Public', 0),
(20, '120', 'Planning & Research', 'Division Office', 'Public', 0),
(21, '121', 'Receiving / Records', 'Division Office', 'Public', 0),
(22, '122', 'SGOD Proper', 'Division Office', 'Public', 0),
(23, '123', 'SME', 'Division Office', 'Public', 0),
(24, '124', 'SocMob', 'Division Office', 'Public', 0),
(25, '125', 'Supply', 'Division Office', 'Public', 0),
(26, '126', 'Workplace Improvement Team', 'Division Office', 'Public', 0),
(27, '100216', '100216 - Ab-Abut ES, Piddig', 'School', 'Public', 0),
(28, '100043', '100043 - Abaca ES, Bangui', 'School', 'Public', 0),
(29, '100307', '100307 - Abkir ES, Vintar II', 'School', 'Public', 0),
(30, '100100', '100100 - Ablan Community School, Burgos', 'School', 'Public', 0),
(31, '100217', '100217 - Abucay ES, Piddig', 'School', 'Public', 0),
(32, '100139', '100139 - Acnam-Caray ES, Marcos-Nueva Era', 'School', 'Public', 0),
(33, '100160', '100160 - Adams CES, Pagudpud', 'School', 'Public', 0),
(34, '100101', '100101 - Agaga ES, Burgos', 'School', 'Public', 0),
(35, '100161', '100161 - Aggasi ES, Pagudpud', 'School', 'Public', 0),
(36, '100044', '100044 - Alao-ao ES, Bangui', 'School', 'Public', 0),
(37, '100308', '100308 - Alejo Malasig ES, Vintar II', 'School', 'Public', 0),
(38, '100288', '100288 - Alsem ES, Vintar I', 'School', 'Public', 0),
(39, '100001', '100001 - Apaleng-Libtong ES, Bacarra I', 'School', 'Public', 0),
(40, '100024', '100024 - Ar-Arusip ES, Badoc', 'School', 'Public', 0),
(41, '150001', '150001 - Aring ES, Badoc', 'School', 'Public', 0),
(42, '100251', '100251 - Asuncion ES, San Nicolas', 'School', 'Public', 0),
(43, '100002', '100002 - Bacarra CES, Bacarra I', 'School', 'Public', 0),
(44, '100180', '100180 - Bacsil Elementary School, Paoay', 'School', 'Public', 0),
(45, '100128', '100128 - Bacsil ES, Dingras II', 'School', 'Public', 0),
(46, '100045', '100045 - Bacsil PS, Bangui', 'School', 'Public', 0),
(47, '100234', '100234 - Badio ES, Pinili', 'School', 'Public', 0),
(48, '100025', '100025 - Badoc North Central School, Badoc', 'School', 'Public', 0),
(49, '100026', '100026 - Badoc South Central School SPED Center, Badoc', 'School', 'Public', 0),
(50, '100274', '100274 - Bagbag ES, Solsona', 'School', 'Public', 0),
(51, '100275', '100275 - Bagbago ES, Solsona', 'School', 'Public', 0),
(52, '100289', '100289 - Bago ES, Vintar I', 'School', 'Public', 0),
(53, '150013', '150013 - Bagut ES, Dingras II', 'School', 'Public', 0),
(54, '100162', '100162 - Balaoi ES, Pagudpud', 'School', 'Public', 0),
(55, '100046', '100046 - Banban Elementary School, Bangui', 'School', 'Public', 0),
(56, '100058', '100058 - Bangsar ES, Banna (Espiritu)', 'School', 'Public', 0),
(57, '100013', '100013 - Bangsirit ES, Bacarra II', 'School', 'Public', 0),
(58, '100047', '100047 - Bangui CES, Bangui', 'School', 'Public', 0),
(59, '100059', '100059 - Banna Central Elementary School, Banna (Espiritu)', 'School', 'Public', 0),
(60, '100252', '100252 - Barabar ES, San Nicolas', 'School', 'Public', 0),
(61, '100140', '100140 - Barangobong E/S, Marcos-Nueva Era', 'School', 'Public', 0),
(62, '100235', '100235 - BARBAR ELEMENTARY SCHOOL, Pinili', 'School', 'Public', 0),
(63, '100060', '100060 - Barbarangay ES, Banna (Espiritu)', 'School', 'Public', 0),
(64, '100276', '100276 - Barcelona ES, Solsona', 'School', 'Public', 0),
(65, '100118', '100118 - Baresbes ES, Dingras I', 'School', 'Public', 0),
(66, '150018', '150018 - Barikir ES, Marcos-Nueva Era', 'School', 'Public', 0),
(67, '100119', '100119 - Barong ES, Dingras I', 'School', 'Public', 0),
(68, '100048', '100048 - Baruyen Elementary School, Bangui', 'School', 'Public', 0),
(69, '100102', '100102 - Bayog ES, Burgos', 'School', 'Public', 0),
(70, '100236', '100236 - Bicbica PS, Pinili', 'School', 'Public', 0),
(71, '100141', '100141 - Biding ES, Marcos-Nueva Era', 'School', 'Public', 0),
(72, '100110', '100110 - Bimmanga ES, Currimao', 'School', 'Public', 0),
(73, '100261', '100261 - Binaratan ES, Sarrat', 'School', 'Public', 0),
(74, '100253', '100253 - Bingao ES, San Nicolas', 'School', 'Public', 0),
(75, '100194', '100194 - Binsang ES, Pasuquin', 'School', 'Public', 0),
(76, '100103', '100103 - BLISS ELEMENTARY SCHOOL, Burgos', 'School', 'Public', 0),
(77, '100104', '100104 - Bobon ES, Burgos', 'School', 'Public', 0),
(78, '100061', '100061 - Bomitog ES, Banna (Espiritu)', 'School', 'Public', 0),
(79, '100218', '100218 - Boyboy ES, Piddig', 'School', 'Public', 0),
(80, '100237', '100237 - Buanga ES, Pinili', 'School', 'Public', 0),
(81, '100163', '100163 - Bucarot PS, Pagudpud', 'School', 'Public', 0),
(82, '100062', '100062 - Bugasi ES, Banna (Espiritu)', 'School', 'Public', 0),
(83, '150019', '150019 - Bugayong Elementary Sch., Marcos-Nueva Era', 'School', 'Public', 0),
(84, '100254', '100254 - Bugnay ES, San Nicolas', 'School', 'Public', 0),
(85, '100238', '100238 - Bulbulala Elementary School, Pinili', 'School', 'Public', 0),
(86, '150005', '150005 - Bulbulala PS, Vintar I', 'School', 'Public', 0),
(87, '100164', '100164 - Burayoc ES, Pagudpud', 'School', 'Public', 0),
(88, '100105', '100105 - Burgos Central Elementary School, Burgos', 'School', 'Public', 0),
(89, '100003', '100003 - Buyon ES, Bacarra I', 'School', 'Public', 0),
(90, '100195', '100195 - Cababaan ES, Pasuquin', 'School', 'Public', 0),
(91, '100291', '100291 - Cabangaran ES, Vintar I', 'School', 'Public', 0),
(92, '100239', '100239 - Cabaroan ES, Pinili', 'School', 'Public', 0),
(93, '100014', '100014 - Cabaruan ES, Bacarra II', 'School', 'Public', 0),
(94, '100309', '100309 - Cabayo ES, Vintar II', 'School', 'Public', 0),
(95, '100310', '100310 - Cabisuculan-Columbia ES, Vintar II', 'School', 'Public', 0),
(96, '100142', '100142 - Cabittauran ES, Marcos-Nueva Era', 'School', 'Public', 0),
(97, '100015', '100015 - Cabulalaan ES, Bacarra II', 'School', 'Public', 0),
(98, '100262', '100262 - Cabuloan Elementary School, Sarrat', 'School', 'Public', 0),
(99, '100143', '100143 - Cacafean ES, Marcos-Nueva Era', 'School', 'Public', 0),
(100, '100016', '100016 - Cadaratan ES, Bacarra II', 'School', 'Public', 0),
(101, '100063', '100063 - Caestebanan ES, Banna (Espiritu)', 'School', 'Public', 0),
(102, '100219', '100219 - Calambeg ES, Piddig', 'School', 'Public', 0),
(103, '100017', '100017 - Calioet ES, Bacarra II', 'School', 'Public', 0),
(104, '100027', '100027 - Camanga ES, Badoc', 'School', 'Public', 0),
(105, '100292', '100292 - Canaam ES, Vintar I', 'School', 'Public', 0),
(106, '100165', '100165 - Caparispisan PS, Pagudpud', 'School', 'Public', 0),
(107, '100129', '100129 - Capasan ES, Dingras II', 'School', 'Public', 0),
(108, '500000', '500000 - Caraitan Integrated School, Badoc', 'School', 'Public', 0),
(109, '100220', '100220 - Carasi ES, Piddig', 'School', 'Public', 0),
(110, '100064', '100064 - Caribquib ES, Banna (Espiritu)', 'School', 'Public', 0),
(111, '100196', '100196 - Caruan ES, Pasuquin', 'School', 'Public', 0),
(112, '100197', '100197 - Carusikis ES, Pasuquin', 'School', 'Public', 0),
(113, '100018', '100018 - Casilian ES, Bacarra II', 'School', 'Public', 0),
(114, '150023', '150023 - Casilian PS - Taguipuro Annex, Bacarra II', 'School', 'Public', 0),
(115, '100065', '100065 - Catagtaguen ES, Banna (Espiritu)', 'School', 'Public', 0),
(116, '100277', '100277 - Catangraran ES, Solsona', 'School', 'Public', 0),
(117, '100255', '100255 - Catuguing ES, San Nicolas', 'School', 'Public', 0),
(118, '100166', '100166 - Caunayan Elementary School, Pagudpud', 'School', 'Public', 0),
(119, '100259', '100259 - Cayetano Bumanglag ES, San Nicolas', 'School', 'Public', 0),
(120, '150016', '150016 - Columbia PS, Vintar II', 'School', 'Public', 0),
(121, '100111', '100111 - Comcomloong-Anggapang PS, Currimao', 'School', 'Public', 0),
(122, '100066', '100066 - Crispina ES, Banna (Espiritu)', 'School', 'Public', 0),
(123, '100198', '100198 - Dadaeman Elementary School, Pasuquin', 'School', 'Public', 0),
(124, '100049', '100049 - Dadaor ES, Bangui', 'School', 'Public', 0),
(125, '100167', '100167 - Dampig ES, Pagudpud', 'School', 'Public', 0),
(126, '100293', '100293 - Danao Elementary School, Vintar I', 'School', 'Public', 0),
(127, '100278', '100278 - Darasdas ES, Solsona', 'School', 'Public', 0),
(128, '100240', '100240 - Darat ES, Pinili', 'School', 'Public', 0),
(129, '100311', '100311 - Dasar ES, Vintar II', 'School', 'Public', 0),
(130, '100199', '100199 - Davila ES, Pasuquin', 'School', 'Public', 0),
(131, '100200', '100200 - Dilanis ES, Pasuquin', 'School', 'Public', 0),
(132, '100201', '100201 - Dilavo ES, Pasuquin', 'School', 'Public', 0),
(133, '100294', '100294 - Dimamaga ES, Vintar I', 'School', 'Public', 0),
(134, '100120', '100120 - Dingras Central ES, Dingras I', 'School', 'Public', 0),
(135, '100130', '100130 - Dingras West CES, Dingras II', 'School', 'Public', 0),
(136, '100295', '100295 - Dipilat ES, Vintar I', 'School', 'Public', 0),
(137, '100241', '100241 - Don Mariano Marcos Mem. Sch., Pinili', 'School', 'Public', 0),
(138, '100112', '100112 - Doña Josefa E. Marcos ES, Currimao', 'School', 'Public', 0),
(139, '100050', '100050 - Dumalneg ES, Bangui', 'School', 'Public', 0),
(140, '100221', '100221 - Dupitac E/S, Piddig', 'School', 'Public', 0),
(141, '100256', '100256 - Eladio V. Barangan Mem. ES, San Nicolas', 'School', 'Public', 0),
(142, '150017', '150017 - Elizabeth ES, Marcos-Nueva Era', 'School', 'Public', 0),
(143, '100144', '100144 - Elizabeth ES, Dingras I', 'School', 'Public', 0),
(144, '100121', '100121 - Elizabeth-Lanas ES, Dingras I', 'School', 'Public', 0),
(145, '100145', '100145 - Escoda ES, Marcos-Nueva Era', 'School', 'Public', 0),
(146, '100296', '100296 - Esperanza ES, Vintar I', 'School', 'Public', 0),
(147, '100131', '100131 - Espiritu ES, Dingras II', 'School', 'Public', 0),
(148, '100222', '100222 - Estancia ES, Piddig', 'School', 'Public', 0),
(149, '100297', '100297 - Ester Elementary School, Vintar I', 'School', 'Public', 0),
(150, '100181', '100181 - Evangelista ES, Paoay', 'School', 'Public', 0),
(151, '100146', '100146 - F. Daquioag Mem. ES, Marcos-Nueva Era', 'School', 'Public', 0),
(152, '100147', '100147 - Ferdinand ES, Marcos-Nueva Era', 'School', 'Public', 0),
(153, '100257', '100257 - Filipinas East ES, San Nicolas', 'School', 'Public', 0),
(154, '150022', '150022 - Filipinas West ES, San Nicolas', 'School', 'Public', 0),
(155, '500591', '500591 - Florentino Camaquin Integrated School, Vintar II', 'School', 'Public', 0),
(156, '100148', '100148 - Fortuna ES, Marcos-Nueva Era', 'School', 'Public', 0),
(157, '100122', '100122 - Francisco ES, Dingras I', 'School', 'Public', 0),
(158, '100202', '100202 - Gabaldon ES, Pasuquin', 'School', 'Public', 0),
(159, '100029', '100029 - Gabut ES, Badoc', 'School', 'Public', 0),
(160, '100168', '100168 - Gamaban ES, Pagudpud', 'School', 'Public', 0),
(161, '100004', '100004 - Ganagan Elementary School, Bacarra I', 'School', 'Public', 0),
(162, '100149', '100149 - Garnaden ES, Marcos-Nueva Era', 'School', 'Public', 0),
(163, '100223', '100223 - Gayamat PS, Piddig', 'School', 'Public', 0),
(164, '150011', '150011 - Godogod Elementary School, Pinili', 'School', 'Public', 0),
(165, '100263', '100263 - Golgol ES, Sarrat', 'School', 'Public', 0),
(166, '100298', '100298 - Gubang ES, Vintar I', 'School', 'Public', 0),
(167, '100242', '100242 - Gulpeng PS, Pinili', 'School', 'Public', 0),
(168, '100132', '100132 - Hilaria Salvatierra Mem. ES, Dingras II', 'School', 'Public', 0),
(169, '100067', '100067 - Imelda ES, Banna (Espiritu)', 'School', 'Public', 0),
(170, '100150', '100150 - Imelda ES, Marcos-Nueva Era', 'School', 'Public', 0),
(171, '100313', '100313 - Isic-Isic ES, Vintar II', 'School', 'Public', 0),
(172, '100030', '100030 - Labut ES, Badoc', 'School', 'Public', 0),
(173, '100068', '100068 - Lading ES, Banna (Espiritu)', 'School', 'Public', 0),
(174, '100224', '100224 - Lagandit ES, Piddig', 'School', 'Public', 0),
(175, '100051', '100051 - Lanao ES, Bangui', 'School', 'Public', 0),
(176, '100113', '100113 - Langayan ES, Currimao', 'School', 'Public', 0),
(177, '100031', '100031 - Lasien School, Badoc', 'School', 'Public', 0),
(178, '100225', '100225 - Libnaoan ES, Piddig', 'School', 'Public', 0),
(179, '100243', '100243 - Liliputen ES, Pinili', 'School', 'Public', 0),
(180, '100279', '100279 - Lipay ES, Solsona', 'School', 'Public', 0),
(181, '100314', '100314 - Lipay ES, Vintar II', 'School', 'Public', 0),
(182, '100315', '100315 - Lubnac ES, Vintar II', 'School', 'Public', 0),
(183, '100169', '100169 - Luzong ES, Pagudpud', 'School', 'Public', 0),
(184, '100170', '100170 - Luzuyo PS, Pagudpud', 'School', 'Public', 0),
(185, '150020', '150020 - Maab-abaca PS, Piddig', 'School', 'Public', 0),
(186, '100280', '100280 - Maananteng ES, Solsona', 'School', 'Public', 0),
(187, '150014', '150014 - Mabanbanag PS, Vintar I', 'School', 'Public', 0),
(188, '150021', '150021 - Mabino ES, Dingras I', 'School', 'Public', 0),
(189, '150002', '150002 - Mabusag Sur ES, Badoc', 'School', 'Public', 0),
(190, '100032', '100032 - Mabusag-Napu ES, Badoc', 'School', 'Public', 0),
(191, '100151', '100151 - Mabuti ES, Marcos-Nueva Era', 'School', 'Public', 0),
(192, '100069', '100069 - Macayepyep ES, Banna (Espiritu)', 'School', 'Public', 0),
(193, '100005', '100005 - Macupit ES, Bacarra I', 'School', 'Public', 0),
(194, '100203', '100203 - Madalayap Elementary School, Pasuquin', 'School', 'Public', 0),
(195, '100033', '100033 - Madupayas ES, Badoc', 'School', 'Public', 0),
(196, '100316', '100316 - Magabobo ES, Vintar II', 'School', 'Public', 0),
(197, '100114', '100114 - Maglaoi ES, Currimao', 'School', 'Public', 0),
(198, '150007', '150007 - MALAGGAO PS, Pagudpud', 'School', 'Public', 0),
(199, '500345', '500345 - Malaguip Integrated School, Paoay', 'School', 'Public', 0),
(200, '100317', '100317 - Malampa ES, Vintar II', 'School', 'Public', 0),
(201, '100281', '100281 - Manalpac ES, Solsona', 'School', 'Public', 0),
(202, '100318', '100318 - Manarang ES, Vintar II', 'School', 'Public', 0),
(203, '100133', '100133 - Mandaloque ES, Dingras II', 'School', 'Public', 0),
(204, '100152', '100152 - Marcos Central School, Marcos-Nueva Era', 'School', 'Public', 0),
(205, '100299', '100299 - Margaay PS, Vintar I', 'School', 'Public', 0),
(206, '100226', '100226 - Maruaya PS, Piddig', 'School', 'Public', 0),
(207, '100300', '100300 - Masadsaduel Elementary School, Vintar I', 'School', 'Public', 0),
(208, '100052', '100052 - Masikil ES, Bangui', 'School', 'Public', 0),
(209, '100123', '100123 - Medina Parado ES, Dingras I', 'School', 'Public', 0),
(210, '100183', '100183 - Monte ES, Paoay', 'School', 'Public', 0),
(211, '100034', '100034 - Morong ES, Badoc', 'School', 'Public', 0),
(212, '100184', '100184 - Mumulaan ES, Paoay', 'School', 'Public', 0),
(213, '100204', '100204 - Nagabungan ES, Pasuquin', 'School', 'Public', 0),
(214, '100185', '100185 - Nagbacalan ES, Paoay', 'School', 'Public', 0),
(215, '150003', '150003 - Nagbacalan West ES, Paoay', 'School', 'Public', 0),
(216, '100053', '100053 - Nagbalagan ES, Bangui', 'School', 'Public', 0),
(217, '100205', '100205 - Naglicuan ES, Pasuquin', 'School', 'Public', 0),
(218, '100070', '100070 - Nagpatayan ES, Banna (Espiritu)', 'School', 'Public', 0),
(219, '100282', '100282 - Nagpatpatan ES, Solsona', 'School', 'Public', 0),
(220, '100035', '100035 - Nagrebcan ES, Badoc', 'School', 'Public', 0),
(221, '100206', '100206 - Nagsanga ES, Pasuquin', 'School', 'Public', 0),
(222, '100106', '100106 - Nagsurot Elementary School, Burgos', 'School', 'Public', 0),
(223, '100244', '100244 - Nagtrigoan ES, Pinili', 'School', 'Public', 0),
(224, '100153', '100153 - Naguilian Elementary School, Marcos-Nueva Era', 'School', 'Public', 0),
(225, '100186', '100186 - Nalasin ES, Paoay', 'School', 'Public', 0),
(226, '100006', '100006 - Nambaran ES, Bacarra I', 'School', 'Public', 0),
(227, '100301', '100301 - Namoroc-Mabanbanag ES, Vintar I', 'School', 'Public', 0),
(228, '100187', '100187 - Nanguyudan Elementary School, Paoay', 'School', 'Public', 0),
(229, '100154', '100154 - Nueva Era Central Elementary School, Marcos-Nueva Era', 'School', 'Public', 0),
(230, '100107', '100107 - Paayas ES, Burgos', 'School', 'Public', 0),
(231, '100155', '100155 - Pacifico ES, Marcos-Nueva Era', 'School', 'Public', 0),
(232, '100054', '100054 - Paddagan PS, Bangui', 'School', 'Public', 0),
(233, '100036', '100036 - Pagsanahan Elementary School, Badoc', 'School', 'Public', 0),
(234, '100171', '100171 - Pagudpud Central Elementary School, Pagudpud', 'School', 'Public', 0),
(235, '100172', '100172 - Pagudpud South CES, Pagudpud', 'School', 'Public', 0),
(236, '100115', '100115 - Paguludan PS, Currimao', 'School', 'Public', 0),
(237, '500343', '500343 - Pallas IS, Vintar I', 'School', 'Public', 0),
(238, '100037', '100037 - Paltit ES, Badoc', 'School', 'Public', 0),
(239, '100173', '100173 - Pancian ES, Pagudpud', 'School', 'Public', 0),
(240, '500592', '500592 - Pandan IS, Sarrat', 'School', 'Public', 0),
(241, '100116', '100116 - Pangil ES, Currimao', 'School', 'Public', 0),
(242, '100207', '100207 - Pangil ES, Pasuquin', 'School', 'Public', 0),
(243, '100019', '100019 - Paninaan Elementary School, Bacarra II', 'School', 'Public', 0),
(244, '100188', '100188 - Paoay CES, Paoay', 'School', 'Public', 0),
(245, '100189', '100189 - Paoay East Central ES, Paoay', 'School', 'Public', 0),
(246, '100020', '100020 - Parang E/S, Bacarra II', 'School', 'Public', 0),
(247, '100265', '100265 - Parang ES, Sarrat', 'School', 'Public', 0),
(248, '100319', '100319 - Parparoroc ES, Vintar II', 'School', 'Public', 0),
(249, '100320', '100320 - Parut ES, Vintar II', 'School', 'Public', 0),
(250, '100174', '100174 - Pasaleng ES, Pagudpud', 'School', 'Public', 0),
(251, '100190', '100190 - Pasil ES, Paoay', 'School', 'Public', 0),
(252, '100007', '100007 - Pasiocan ES, Bacarra I', 'School', 'Public', 0),
(253, '100258', '100258 - Pasion Barangan Memorial Elementary School, San Nicolas', 'School', 'Public', 0),
(254, '100038', '100038 - Pasuc-Parang ES, Badoc', 'School', 'Public', 0),
(255, '100208', '100208 - Pasuquin Central Elementary School, Pasuquin', 'School', 'Public', 0),
(256, '100266', '100266 - Patad ES, Sarrat', 'School', 'Public', 0),
(257, '100134', '100134 - Peralta ES, Dingras II', 'School', 'Public', 0),
(258, '100117', '100117 - Pias-Gaang ES, Currimao', 'School', 'Public', 0),
(259, '100227', '100227 - Piddig Central ES, Piddig', 'School', 'Public', 0),
(260, '100228', '100228 - Piddig South CES, Piddig', 'School', 'Public', 0),
(261, '100245', '100245 - Pugaoan-Bungro ES, Pinili', 'School', 'Public', 0),
(262, '100008', '100008 - Pulangi ES, Bacarra I', 'School', 'Public', 0),
(263, '100021', '100021 - Pungto PS, Bacarra II', 'School', 'Public', 0),
(264, '100246', '100246 - Puritac-Dalayap ES, Pinili', 'School', 'Public', 0),
(265, '100209', '100209 - Puyupuyan ES, Pasuquin', 'School', 'Public', 0),
(266, '100247', '100247 - Puzol Elementary School, Pinili', 'School', 'Public', 0),
(267, '100071', '100071 - Quiaoit Memorial ES, Banna (Espiritu)', 'School', 'Public', 0),
(268, '100267', '100267 - Ruiz ES, Sarrat', 'School', 'Public', 0),
(269, '100009', '100009 - Sabas-Sagisi Memorial Elem. School, Bacarra I', 'School', 'Public', 0),
(270, '500593', '500593 - Sacritan IS, Pinili', 'School', 'Public', 0),
(271, '100303', '100303 - Sagpat ES, Vintar I', 'School', 'Public', 0),
(272, '100136', '100136 - Sagpatan ES, Dingras II', 'School', 'Public', 0),
(273, '100268', '100268 - Sagpatan ES, Sarrat', 'School', 'Public', 0),
(274, '100175', '100175 - Saguigui ES, Pagudpud', 'School', 'Public', 0),
(275, '100249', '100249 - Salanap ES, Pinili', 'School', 'Public', 0),
(276, '100191', '100191 - Salbang ES, Paoay', 'School', 'Public', 0),
(277, '500344', '500344 - SALPAD INTEGRATED SCHOOL, Vintar II', 'School', 'Public', 0),
(278, '100322', '100322 - Salsalamagui ES, Vintar II', 'School', 'Public', 0),
(279, '100124', '100124 - Saludares-Cali ES, Dingras I', 'School', 'Public', 0),
(280, '100022', '100022 - San Agustin ES, Bacarra II', 'School', 'Public', 0),
(281, '150015', '150015 - San Andres Elementary School, Sarrat', 'School', 'Public', 0),
(282, '100229', '100229 - San Antonio ES, Piddig', 'School', 'Public', 0),
(283, '100269', '100269 - San Antonio ES, Sarrat', 'School', 'Public', 0),
(284, '100270', '100270 - San Bernabe ES, Sarrat', 'School', 'Public', 0),
(285, '100135', '100135 - San Esteban ES, Dingras II', 'School', 'Public', 0),
(286, '100055', '100055 - San Isidro Elementary School, Bangui', 'School', 'Public', 0),
(287, '150008', '150008 - San Isidro PS, Pasuquin', 'School', 'Public', 0),
(288, '100210', '100210 - San Juan ES, Pasuquin', 'School', 'Public', 0),
(289, '100283', '100283 - San Juan ES, Solsona', 'School', 'Public', 0),
(290, '100125', '100125 - San Marcelino ES, Dingras I', 'School', 'Public', 0),
(291, '100137', '100137 - San Marcos ES, Dingras II', 'School', 'Public', 0),
(292, '100260', '100260 - San Nicolas ES, San Nicolas', 'School', 'Public', 0),
(293, '150009', '150009 - San Pedro ES, Sarrat', 'School', 'Public', 0),
(294, '100156', '100156 - Santiago ES, Marcos-Nueva Era', 'School', 'Public', 0),
(295, '100284', '100284 - Santiago ES, Solsona', 'School', 'Public', 0),
(296, '100011', '100011 - Santo Cristo Elementary School, Bacarra I', 'School', 'Public', 0),
(297, '100157', '100157 - Santo Nino ES, Marcos-Nueva Era', 'School', 'Public', 0),
(298, '100108', '100108 - Saoit ES, Burgos', 'School', 'Public', 0),
(299, '100323', '100323 - Saricao ES, Vintar II', 'School', 'Public', 0),
(300, '100271', '100271 - Sarrat Central School, Sarrat', 'School', 'Public', 0),
(301, '100272', '100272 - Sarrat North CS, Sarrat', 'School', 'Public', 0),
(302, '100039', '100039 - Saud ES, Badoc', 'School', 'Public', 0),
(303, '100176', '100176 - Saud ES, Pagudpud', 'School', 'Public', 0),
(304, '100192', '100192 - Sideg Elementary School, Paoay', 'School', 'Public', 0),
(305, '100072', '100072 - Sinamar ES, Banna (Espiritu)', 'School', 'Public', 0),
(306, '100285', '100285 - Solsona Central ES, Solsona', 'School', 'Public', 0),
(307, '100010', '100010 - SPECIAL EDUCATION CENTER, Bacarra I', 'School', 'Public', 0),
(308, '100286', '100286 - Sta. Ana ES, Solsona', 'School', 'Public', 0),
(309, '100211', '100211 - Sta. Catalina ES, Pasuquin', 'School', 'Public', 0),
(310, '100040', '100040 - Sta. Cruz ES, Badoc', 'School', 'Public', 0),
(311, '100273', '100273 - Sta. Rosa ES, Sarrat', 'School', 'Public', 0),
(312, '100230', '100230 - Sta.Maria ES, Piddig', 'School', 'Public', 0),
(313, '100250', '100250 - Sto. Tomas ES, Pinili', 'School', 'Public', 0),
(314, '100193', '100193 - Suba ES, Paoay', 'School', 'Public', 0),
(315, '100177', '100177 - Subec ES, Pagudpud', 'School', 'Public', 0),
(316, '100212', '100212 - Sulbec PS, Pasuquin', 'School', 'Public', 0),
(317, '100126', '100126 - Sulquiano ES, Dingras I', 'School', 'Public', 0),
(318, '100213', '100213 - Surong PS, Pasuquin', 'School', 'Public', 0),
(319, '100056', '100056 - Suyo ES, Bangui', 'School', 'Public', 0),
(320, '100138', '100138 - Suyo ES, Dingras II', 'School', 'Public', 0),
(321, '100073', '100073 - Tabtabagan Elementary School, Banna (Espiritu)', 'School', 'Public', 0),
(322, '100158', '100158 - Tabucbuc Elementary School, Marcos-Nueva Era', 'School', 'Public', 0),
(323, '100214', '100214 - Tabungao PS, Pasuquin', 'School', 'Public', 0),
(324, '100215', '100215 - Tadao ES, Pasuquin', 'School', 'Public', 0),
(325, '100057', '100057 - Taguipuro ES, Bangui', 'School', 'Public', 0),
(326, '100287', '100287 - Talugtog ES, Solsona', 'School', 'Public', 0),
(327, '100012', '100012 - Tambidao Elementary School, Bacarra I', 'School', 'Public', 0),
(328, '100304', '100304 - Tamdagan ES, Vintar I', 'School', 'Public', 0),
(329, '100109', '100109 - Tanap ES, Burgos', 'School', 'Public', 0),
(330, '100231', '100231 - Tangaoan ES, Piddig', 'School', 'Public', 0),
(331, '100179', '100179 - Tarrag PS, Pagudpud', 'School', 'Public', 0),
(332, '100232', '100232 - Tonoton ES, Piddig', 'School', 'Public', 0),
(333, '100023', '100023 - Tubburan ES, Bacarra II', 'School', 'Public', 0),
(334, '100324', '100324 - Tungel ES, Vintar II', 'School', 'Public', 0),
(335, '100041', '100041 - Turod ES, Badoc', 'School', 'Public', 0),
(336, '500594', '500594 - Uguis Integrated School, Marcos-Nueva Era', 'School', 'Public', 0),
(337, '150004', '150004 - Upon PS, Pinili', 'School', 'Public', 0),
(338, '100074', '100074 - VALDEZ ELEMENTARY SCHOOL, Banna (Espiritu)', 'School', 'Public', 0),
(339, '100127', '100127 - Ver ES, Dingras I', 'School', 'Public', 0),
(340, '100305', '100305 - Vintar CES, Vintar I', 'School', 'Public', 0),
(341, '100233', '100233 - Virbira-Angset ES, Piddig', 'School', 'Public', 0),
(342, '100042', '100042 - Virgen Milagrosa ES, Badoc', 'School', 'Public', 0),
(343, '100306', '100306 - Visaya ES, Vintar I', 'School', 'Public', 0),
(344, '150012', '150012 - Wilbur C. Go Elementary School, Currimao', 'School', 'Public', 0),
(345, '300001', '300001 - Adams National High School, ADAMS', 'School', 'Public', 0),
(346, '320820', '320820 - Adriano P. Arzadon NHS, NUEVA ERA', 'School', 'Public', 0),
(347, '300002', '300002 - Bacarra NCHS, BACARRA', 'School', 'Public', 0),
(348, '320817', '320817 - Bagbag Solsona National High School, SOLSONA', 'School', 'Public', 0),
(349, '320801', '320801 - BANBAN NHS, BANGUI', 'School', 'Public', 0),
(350, '300003', '300003 - Bangui NHS, BANGUI', 'School', 'Public', 0),
(351, '300004', '300004 - Banna National High School, BANNA', 'School', 'Public', 0),
(352, '320815', '320815 - Bingao National High School, SAN NICOLAS', 'School', 'Public', 0),
(353, '300006', '300006 - Burgos Agro-Industrial School, BURGOS', 'School', 'Public', 0),
(354, '300007', '300007 - Cadaratan National High School, BACARRA', 'School', 'Public', 0),
(355, '300008', '300008 - Caestebanan NHS, BANNA (ESPIRITU)', 'School', 'Public', 0),
(356, '500000', '500000 - Caraitan Integrated School, BADOC', 'School', 'Public', 0),
(357, '300009', '300009 - Carasi NHS, CARASI', 'School', 'Public', 0),
(358, '300010', '300010 - Caribquib NHS, BANNA (ESPIRITU)', 'School', 'Public', 0),
(359, '300011', '300011 - Catagtaguen National High School, BANNA (ESPIRITU)', 'School', 'Public', 0),
(360, '320805', '320805 - Currimao NHS, CURRIMAO', 'School', 'Public', 0),
(361, '300014', '300014 - Davila National High School, PASUQUIN', 'School', 'Public', 0),
(362, '300015', '300015 - Dingras NHS/Lt. Edgar Foz Mem. NHS, DINGRAS', 'School', 'Public', 0),
(363, '320806', '320806 - Dingras NHS/Lt. Edgar Foz Mem. NHS (Barong Campus), DINGRAS', 'School', 'Public', 0),
(364, '320808', '320808 - Dingras NHS/Lt. Edgar Foz Mem. NHS (San Marcos Campus), DINGRAS', 'School', 'Public', 0),
(365, '320809', '320809 - Dingras NHS/Lt. Edgar Foz Mem. NHS- (Sulquiano Campus), DINGRAS', 'School', 'Public', 0),
(366, '300017', '300017 - Dumalneg NHS, DUMALNEG', 'School', 'Public', 0),
(367, '500591', '500591 - FLORENTINO CAMAQUIN INTEGRATED SCHOOL, VINTAR', 'School', 'Public', 0),
(368, '300018', '300018 - Ilocos Norte Agricultural College, PASUQUIN', 'School', 'Public', 0),
(369, '320821', '320821 - ISIC-ISIC NATIONAL HIGH SCHOOL, VINTAR', 'School', 'Public', 0),
(370, '320802', '320802 - LANAO NATIONAL HIGH SCHOOL, BANGUI', 'School', 'Public', 0),
(371, '300019', '300019 - Luzong NHS, PAGUDPUD', 'School', 'Public', 0),
(372, '500345', '500345 - Malaguip Integrated School, PAOAY', 'School', 'Public', 0),
(373, '300020', '300020 - Marcos NHS, MARCOS', 'School', 'Public', 0),
(374, '320811', '320811 - Marcos NHS (Agunit Campus), MARCOS', 'School', 'Public', 0),
(375, '320812', '320812 - Marcos NHS (Santiago Campus), MARCOS', 'School', 'Public', 0),
(376, '300021', '300021 - Nagrebcan NHS, BADOC', 'School', 'Public', 0),
(377, '300022', '300022 - NUEVA ERA NATIONAL HIGH SCHOOL, NUEVA ERA', 'School', 'Public', 0),
(378, '300023', '300023 - Pagsanahan NHS, BADOC', 'School', 'Public', 0),
(379, '300024', '300024 - PAGUDPUD NHS, PAGUDPUD', 'School', 'Public', 0),
(380, '500343', '500343 - Pallas Integrated School, VINTAR', 'School', 'Public', 0),
(381, '500592', '500592 - Pandan IS, SARRAT', 'School', 'Public', 0),
(382, '300025', '300025 - Paoay Lake NHS, PAOAY', 'School', 'Public', 0),
(383, '320814', '320814 - Paoay National High School, PAOAY', 'School', 'Public', 0),
(384, '300026', '300026 - Pasaleng National High School, PAGUDPUD', 'School', 'Public', 0),
(385, '300016', '300016 - Piddig National High School, PIDDIG', 'School', 'Public', 0),
(386, '300027', '300027 - Pinili NHS, PINILI', 'School', 'Public', 0),
(387, '500593', '500593 - Sacritan Integrated School, PINILI', 'School', 'Public', 0),
(388, '500344', '500344 - Salpad Integrated School, VINTAR', 'School', 'Public', 0),
(389, '320807', '320807 - San Marcelino National High School, DINGRAS', 'School', 'Public', 0),
(390, '300028', '300028 - San Nicolas NHS, SAN NICOLAS', 'School', 'Public', 0),
(391, '300029', '300029 - Sarrat National High School, SARRAT', 'School', 'Public', 0),
(392, '300030', '300030 - Solsona National High School, SOLSONA', 'School', 'Public', 0),
(393, '320816', '320816 - STA. ROSA NATIONAL HIGH SCHOOL, SARRAT', 'School', 'Public', 0),
(394, '320810', '320810 - SUYO NATIONAL HIGH SCHOOL, DINGRAS', 'School', 'Public', 0),
(395, '320818', '320818 - Talugtog Solsona National High School, SOLSONA', 'School', 'Public', 0),
(396, '500594', '500594 - Uguis Integrated School, NUEVA ERA', 'School', 'Public', 0),
(397, '300031', '300031 - VINTAR NHS, VINTAR', 'School', 'Public', 0),
(398, '300013', '300013 - Wilbur C. Go NHS, CURRIMAO', 'School', 'Public', 0),
(399, '410024', '410024 - Andres Agpalza Memorial Learning Center, VINTAR', 'School', 'Private', 0),
(400, '400002', '400002 - BADOC JUNIOR COLLEGE, INCORPORATED, BADOC', 'School', 'Private', 0),
(401, '410025', '410025 - BADOC LITTLE ANGELS LEARNING CENTER, BADOC', 'School', 'Private', 0),
(402, '400013', '400013 - BANNA ACADEMY INCORPORATED, BANNA (ESPIRITU)', 'School', 'Private', 0),
(403, '408143', '408143 - Banna Church of Christ Disciples Learning Center Inc.., Banna', 'School', 'Private', 0),
(404, '410022', '410022 - Delasan Learning Center Inc, SAN NICOLAS', 'School', 'Private', 0),
(405, '400011', '400011 - Dingras Faith Academy, Inc., DINGRAS', 'School', 'Private', 0),
(406, '410018', '410018 - Early Childhood Learning Center of St. Therese, SAN NICOLAS', 'School', 'Private', 0),
(407, '400024', '400024 - Faith bible baptist academy, SOLSONA', 'School', 'Private', 0),
(408, '410021', '410021 - God Father Learning Center of Pagudpud, PAGUDPUD', 'School', 'Private', 0),
(409, '400023', '400023 - GOV. ROQUE B. ABLAN SR. MEMORIAL ACADEMY,  INC., SOLSONA', 'School', 'Private', 0),
(410, '400003', '400003 - Igama  Colleges Foundation, Inc., BADOC', 'School', 'Private', 0),
(411, '400004', '400004 - JUAN LUNA MEMORIAL ACADEMY, INC., BADOC', 'School', 'Private', 0),
(412, '410020', '410020 - Kids\' Kollege Marcos I. Norte, Inc., MARCOS', 'School', 'Private', 0),
(413, '410014', '410014 - PAOAY FAITH ACADEMY INC., PAOAY', 'School', 'Private', 0),
(414, '400016', '400016 - Paoay North Institute, Inc., PAOAY', 'School', 'Private', 0),
(415, '400017', '400017 - PASUQUIN HIGH SCHOOL OF ILOCOS NORTE, INC., PASUQUIN', 'School', 'Private', 0),
(416, '400021', '400021 - Pinili Institute, PINILI', 'School', 'Private', 0),
(417, '400019', '400019 - Roosevelt High School of Piddig Inc., PIDDIG', 'School', 'Private', 0),
(418, '400020', '400020 - Saint Anne Academy of Piddig Ilocos Norte Inc., PIDDIG', 'School', 'Private', 0),
(419, '410007', '410007 - Saint Joseph Educational Center of Dingras, Inc., DINGRAS', 'School', 'Private', 0),
(420, '400025', '400025 - Saint Nicholas Academy of Vintar, Inc., VINTAR', 'School', 'Private', 0),
(421, '410013', '410013 - Saviours Christian Academy of Pasuquin Inc., PASUQUIN', 'School', 'Private', 0),
(422, '400001', '400001 - St. Andrew Academy, BACARRA', 'School', 'Private', 0),
(423, '410019', '410019 - St. Andrew Grade School, BACARRA', 'School', 'Private', 0),
(424, '400005', '400005 - ST. ELIZABETH ELEMENTARY SCHOOL,INC., BADOC', 'School', 'Private', 0),
(425, '400014', '400014 - St. Gabriel Catholic School, NUEVA ERA', 'School', 'Private', 0),
(426, '400012', '400012 - St. Joseph Institute of Dingras, Inc., DINGRAS', 'School', 'Private', 0),
(427, '400006', '400006 - St. Lawrence the Deacon Academy of Bangui Ilocos Norte Inc, BANGUI', 'School', 'Private', 0),
(428, '400018', '400018 - ST. JAMES ACADEMY OF PASUQUIN ILOCOS NORTE INC., PASUQUIN', 'School', 'Private', 0),
(429, '400015', '400015 - St. Jude High School, PAGUDPUD', 'School', 'Private', 0),
(430, '400022', '400022 - Sta. Rosa Academy of San Nicolas Ilocos Norte Inc., SAN NICOLAS', 'School', 'Private', 0),
(431, '410001', '410001 - The Riverdeep Academy, Inc., BACARRA', 'School', 'Private', 0),
(432, '408506', '408506 - UCCP Learning Center of Pasuquin, PASUQUIN', 'School', 'Private', 0),
(433, '407909', '407909 - UCCP - Kiddie Learning Center of Solsona, Inc., SOLSONA', 'School', 'Private', 0),
(434, '400026', '400026 - Vintar Academy Inc., VINTAR', 'School', 'Private', 0),
(435, '127', 'SGOD Chief', 'Division Office', 'Public', 1),
(436, '128', 'CID Chief', 'Division Office', 'Public', 1);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `up_filename` varchar(100) NOT NULL,
  `up_title` varchar(255) NOT NULL,
  `up_dateadded` datetime NOT NULL DEFAULT current_timestamp(),
  `up_action` varchar(255) NOT NULL,
  `up_receivingunit` int(11) NOT NULL,
  `up_by` int(11) NOT NULL,
  `up_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 3,
  `reset` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `reset`) VALUES
(1, 'loisuperficialvelasco@gmail.com', '$2y$12$FFP9WL8ML5DAUInwd0b5DuyOzF0aJJBBfBHb9qp.x9sTcC7DU/i8G', 1, '0'),
(2, 'ellacutie@gmail.com', '$2y$12$SLBjbdIFshow0LdcW8cqz.cL1hXvjZvsJ7eiCQhL7N4Oc531J20x6', 1, 'IbG9Y2iN'),
(3, 'personnel@dev.com', '$2y$12$CTR3T0Zn.jHKCDOmXMwQWeFhR1nOr/azxzSkFX3L75tlUb.S7Wf3S', 3, 'QyYfq43O'),
(4, 'osds@dev.com', '$2y$12$uyyN.lBXPVMech6dvuVP2unbMXAjyYL9CrLIUfMuSL1fUwYZuMmle', 3, 'th37dueE'),
(5, 'drrm@dev.com', '$2y$12$4LooJ/QyOdbIo2os6zMPk.6dBYpNkw63xDE7QR8O361kTS1fROp.G', 3, 'wNAOHUkj'),
(6, 'als@dev.com', '$2y$12$xsQvRuA1pDlXRS5GzU14cOHq4eusOwgaeXYVTD4.EahmNrivMWOze', 3, 'vx4A7u14'),
(7, 'acct@dev.com', '$2y$12$dL70VSzWUqp5fDNrpTdrMONxvGgc6u/YIXdmx3O1Hgty8yRr2HPp.', 3, 'TtUTL6pn'),
(8, 'lloydrosquita@deped.gov.ph', '$2y$12$oHcrC62OYiosYdq6wWID6.wzHM8BoKC2YF0/LBEnzpTYskVDd7TC.', 3, 'LY6eMGD3');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `ud_id` varchar(22) NOT NULL,
  `ud_unit` varchar(55) NOT NULL,
  `ud_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `ud_id`, `ud_unit`, `ud_name`) VALUES
(1, '1', '122', 'Louis Superficial Velasco'),
(2, '2', '122', 'Ella Santos'),
(3, '3', '119', 'Personnel Acct'),
(4, '4', '117', 'OSDS Office'),
(5, '5', '110', 'DRRM Acc'),
(6, '6', '103', 'ALS Acc'),
(7, '7', '101', 'Accounting acct'),
(8, '8', '127', 'Lloyd Rosquita');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docs_location`
--
ALTER TABLE `docs_location`
  ADD PRIMARY KEY (`dl_id`);

--
-- Indexes for table `doctypes`
--
ALTER TABLE `doctypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docs_location`
--
ALTER TABLE `docs_location`
  MODIFY `dl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctypes`
--
ALTER TABLE `doctypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
