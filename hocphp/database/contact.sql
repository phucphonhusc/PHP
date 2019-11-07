-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 07, 2019 lúc 12:29 PM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `contact`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `IdContact` int(11) NOT NULL,
  `Ten` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoDienThoai` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`IdContact`, `Ten`, `Email`, `SoDienThoai`) VALUES
(1, 'Phúc Phôn', 'nvpp15598@gmail.com', '098458932'),
(2, 'Công Phượng', 'congphuong1234@gmail.com', '01235434654'),
(3, 'Văn Toàn', 'vantoan21@gmail.com', '0923543745'),
(4, 'Xuân Trường', 'xtruong256@gmail.com', '0982343573'),
(5, 'Ánh', 'ngocanh222@gmail.com', '0982359283'),
(6, 'Tuấn', 'pvtuan34@gmail.com', '0982359733'),
(7, 'Thắng Hoàng', 'hnthang123@gmail.com', '01242353456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacttag`
--

CREATE TABLE `contacttag` (
  `IdContact` int(11) NOT NULL,
  `IdTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag`
--

CREATE TABLE `tag` (
  `IdTag` int(11) NOT NULL,
  `TenTag` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tag`
--

INSERT INTO `tag` (`IdTag`, `TenTag`) VALUES
(1, 'FPT'),
(2, 'Khoa CNTT'),
(3, 'Facbook'),
(4, 'Group B3'),
(5, 'FC K40A'),
(6, 'LQ K40FC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `IdContact` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`IdContact`, `user`, `password`) VALUES
(0, 'phucphonhusc', '123'),
(0, 'phucphonhusc2', '1232');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`IdContact`);

--
-- Chỉ mục cho bảng `contacttag`
--
ALTER TABLE `contacttag`
  ADD KEY `IdTag` (`IdTag`),
  ADD KEY `IdContact` (`IdContact`,`IdTag`);

--
-- Chỉ mục cho bảng `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`IdTag`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdContact`,`user`),
  ADD KEY `IdContact` (`IdContact`),
  ADD KEY `IdContact_2` (`IdContact`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `IdContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tag`
--
ALTER TABLE `tag`
  MODIFY `IdTag` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacttag`
--
ALTER TABLE `contacttag`
  ADD CONSTRAINT `contacttag_ibfk_1` FOREIGN KEY (`IdContact`) REFERENCES `tag` (`IdTag`),
  ADD CONSTRAINT `contacttag_ibfk_2` FOREIGN KEY (`IdTag`) REFERENCES `contact` (`IdContact`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
