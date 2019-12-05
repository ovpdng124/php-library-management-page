-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 01:12 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publisher` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categoryID` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `numofpage` int(11) UNSIGNED DEFAULT NULL,
  `maxdate` int(11) UNSIGNED DEFAULT NULL,
  `num` int(11) UNSIGNED DEFAULT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `name`, `publisher`, `author`, `categoryID`, `numofpage`, `maxdate`, `num`, `summary`, `picture`) VALUES
('BID1', 'Meb - Viết Cho Người Phàm', 'Meb', 'Meb Keflezighi', 'NOV', 100, 2, 5, 'Novel', 'meb-viet-cho-nguoi-pham.png'),
('BID2', 'Bố Già', 'Dân Trí', 'Mario Puzo', 'NOV', 100, 2, 4, 'Novel', 'bo-gia-3.png'),
('CSD001', 'Cơ sở dữ liệu', 'NXB Giáo dục', 'Ðỗ Trung Tấn', 'CSD', 200, 3, 3, 'Thiết kế CSDL', 'csdl.jpg'),
('CSD002', 'SQL Server 7.0', 'NXB Ðồng Nai', 'Elicom', 'CSD', 200, 3, 2, 'Thiết CSDL và sử dụng SQL Server', 'sqlSerrver.png'),
('CSD003', 'Oracle 8i', 'NXB Giáo dục', 'Trần Tiến Dung', 'CSD', 500, 5, 3, 'Từng bước sử dụng Oracle', 'oracel8i.jpg'),
('HTT001', 'Windows2000 Professional', 'NXB Giáo dục', 'Anh Thư', 'HTT', 500, 3, 3, 'Sử dụng Windows 2000', 'w200pro.jpg'),
('HTT002', 'Windows 2000 Advanced Server', 'NXB Giáo dục', 'Anh Thư', 'HTT', 500, 5, 2, 'Sử dụng Windows 2000 Server', 'advancedserver2.jpg'),
('LTT001', 'Lập trình visual Basic 6', 'NXB Giáo dục', 'Thái Thanh Phong', 'LTT', 600, 3, 3, 'Kỹ thuật lập trình Víual Basic', 'tu-hoc-lap-trinh-visual-basic-6-0.jpg'),
('LTT002', 'Ngôn ngữ lập trình c++', 'NXB Thông tin và truyền thông', 'Nguyễn Ngọc Cương', 'LTT', 500, 5, 3, 'Hướng dẫn lập trình hướng đối tượng và C++', 'c++.jpg'),
('LTT003', 'Lập trình Windows bằng Visual c++', 'NXB Giáo dục', 'Ðặng Văn Ðức', 'LTT', 300, 4, 6, 'Hướng dẫn từng bước lập trình trên Windows', 'visual.jpg'),
('VPP001', 'Excel Toàn tập', 'NXB Trẻ', 'Ðoàn Công Hùng', 'VPP', 1000, 5, 4, 'Trình bày mọi vấn đề về Excel', 'exel toan tap.jpg'),
('VPP002', 'Word 2000 Toàn tập', 'NXB Trẻ', 'Ðoàn Công Hùng', 'VPP', 1000, 4, 3, 'Trình bày mọi vấn đề về Word', 'work200.jpg'),
('VPP003', 'Làm kế toán bằng Excel', 'NXB Thống kê', 'Vu Duy Sanh', 'VPP', 200, 5, 11, 'Trình bày phuong pháp làm kế toán', 'tu-hoc-va-lam-ke-toan-tren-excel-215x300.jpg'),
('WEB001', 'Javascript', 'NXB Trẻ', 'Lê Minh Trí', 'WEB', 200, 5, 4, 'Từng bước thiết kế Web động', 'javascr.jpg'),
('WEB002', 'HTML', 'NXB Giáo Dục', 'Nguyễn Thị Minh Khoa', 'WEB', 100, 3, 2, 'Từng bước làm quen với WEB', 'must-read-html-css-books.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `categoryname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `moreinfo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryname`, `moreinfo`) VALUES
('CSD', 'Cơ sở dữ liệu	Access', 'Oracle'),
('ECO', 'Ecommerce', 'Sách về thương mại điện tử'),
('GTT', 'Giải thuật	các bài toán mẫu', 'các giải thuật, cấu trúc dữ liệu'),
('HTT', 'Hệ thống', 'Windows, Linux, Unix'),
('LTT', 'Ngôn ngữ lập trình', 'Visual Basic, C, C++, Java'),
('NOV', 'Novel', 'Tiểu thuyết, truyện chữ, ngôn tình...'),
('PTK', 'Phân tích và thiết kế', 'Phân tích và thiết kế giải thuật, hệ thống thông tin v.v..'),
('VPP', 'Văn phòng', 'Word, Excel'),
('WEB', 'Web', 'Javascript, Vbscript,HTML, Flash');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `cardID` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `bookID` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `dateborrow` date DEFAULT NULL,
  `datereturn` date DEFAULT NULL,
  `returnOK` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`cardID`, `bookID`, `dateborrow`, `datereturn`, `returnOK`) VALUES
('STIT0004', 'CSD003', '2019-12-04', '2019-12-04', 1),
('STIT0005', 'CSD003', '2019-12-04', NULL, 0),
('STIT0006', 'CSD003', '2019-12-04', NULL, 0),
('STIT0007', 'CSD003', '2019-12-04', NULL, 0),
('STIT0008', 'CSD003', '2019-12-04', '2019-12-04', 1),
('STIT0009', 'BID1', '2019-12-04', NULL, 0),
('STIT0002', 'BID1', '2019-12-05', '2019-12-04', 1),
('STIT0002', 'CSD002', '2019-12-05', '2019-12-04', 1),
('STIT0002', 'BID2', '2019-12-05', '2019-12-04', 1),
('STIT0002', 'CSD003', '2019-12-05', NULL, 0),
('STIT0002', 'CSD002', '2019-12-05', NULL, 0),
('STIT0002', 'VPP003', '2019-12-05', NULL, 0),
('STIT0002', 'BID2', '2019-12-05', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `cardID` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`cardID`, `name`, `address`, `tel`) VALUES
('STIT0001', 'Ông Văn Phát ', '324 Hà Huy Tập - Đà Nẵng', '0905671240'),
('STIT0002', 'Trịnh Đình Thông', '196 - Nguyễn Du - Đà Nẵng', '0906660706'),
('STIT0004', 'Hồ Phước Thoi', '458-Châu Thị Vĩnh Tế- Đà Nãng', '0905112486'),
('STIT0005', 'Nguyễn Văn Định', '567-Ngũ Hành Sơn- Đà Nãng', '0933668559'),
('STIT0006', 'Nguyễn Văn Hải', '54-Quang Dũng- Đà Nãng', '0706458521'),
('STIT0007', 'Nguyễn Thị Thuý Hà', '7-Tôn Thất Đạm- Đà Nãng', '0989511909'),
('STIT0008', 'Đỗ Thị Thiên Ngân', '487-Trần Cao Vân- Đà Nãng', '0905411585'),
('STIT0009', 'Hồ Văn An', '30- Phan Chu Trinh- Đà Nẵng', '0913576890');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `userID` int(11) NOT NULL,
  `userName` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `librarianName` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`userID`, `userName`, `password`, `librarianName`) VALUES
(1, 'ovpdng124', '123123123', 'No'),
(5, 'admin', 'admin123', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `books_fk_categoies` (`categoryID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD KEY `receipts_fk_students` (`cardID`),
  ADD KEY `receipts_fk_books` (`bookID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`cardID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_fk_categoies` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_fk_books` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`),
  ADD CONSTRAINT `receipts_fk_students` FOREIGN KEY (`cardID`) REFERENCES `students` (`cardID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
