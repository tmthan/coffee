-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 24, 2019 lúc 04:17 AM
-- Phiên bản máy phục vụ: 5.7.23
-- Phiên bản PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Cơ sở dữ liệu: `cafe2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `Ma_Ban` int(2) NOT NULL,
  `Ten_Ban` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `Ma_Khu_Vuc` int(6) NOT NULL,
  `Ma_Loai_Ban` int(6) NOT NULL,
  `So_Cho_Ngoi` int(2) NOT NULL,
  `Trang_Thai_Phuc_Vu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_hoa_don`
--

CREATE TABLE `chi_tiet_hoa_don` (
  `Ma_Chi_Tiet` int(6) NOT NULL,
  `Ma_Hoa_Don` int(6) NOT NULL,
  `Ma_Mon` int(6) NOT NULL,
  `Thoi_Gian_Goi` datetime NOT NULL,
  `So_Luong` int(2) NOT NULL,
  `Gia` int(6) NOT NULL,
  `Nguoi_Goi` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Ghi_Chu` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Trang_Thai_Nau` int(2) NOT NULL,
  `Nguoi_Nau` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_vi_tinh`
--

CREATE TABLE `don_vi_tinh` (
  `Ma_Don_Vi_Tinh` int(6) NOT NULL,
  `Ten_Don_Vi_Tinh` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hang_hoa`
--

CREATE TABLE `hang_hoa` (
  `Ma_Hang` int(6) NOT NULL,
  `Ten_Hang` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Don_Vi_Tinh` int(6) NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `Ma_Hoa_Don` int(6) NOT NULL,
  `Ten_Dang_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Ma_Ban` int(2) NOT NULL,
  `Thoi_Gian_Bat_Dau` datetime NOT NULL,
  `Thoi_Gian_Ket_Thuc` datetime DEFAULT NULL,
  `Trang_Thai_Thanh_Toan` int(2) NOT NULL,
  `Tong_Tien` int(12) NOT NULL,
  `Phu_Thu` int(12) NOT NULL,
  `Ly_Do_Phu_Thu` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Phu_Thu_Tat_Ca` int(12) NOT NULL,
  `Ly_Do_Phu_Thu_Tat_Ca` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Giam_Gia` int(12) NOT NULL,
  `Giam_Gia_Tat_Ca` int(12) NOT NULL,
  `Thanh_Tien` int(12) NOT NULL,
  `Khach_Tra` int(12) NOT NULL,
  `Tien_Thua` int(12) NOT NULL,
  `Thu_Ngan` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ho_so`
--

CREATE TABLE `ho_so` (
  `Ten_Dang_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Ho_Ten` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Nam_Sinh` date NOT NULL,
  `Gioi_Tinh` tinyint(1) NOT NULL,
  `So_Dien_Thoai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `Dia_Chi` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ho_so`
--

INSERT INTO `ho_so` (`Ten_Dang_Nhap`, `Ho_Ten`, `Nam_Sinh`, `Gioi_Tinh`, `So_Dien_Thoai`, `Dia_Chi`) VALUES
('admin', 'Họ tên admin', '2019-04-24', 1, '0987654321', 'Việt Nam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khu_vuc`
--

CREATE TABLE `khu_vuc` (
  `Ma_Khu_Vuc` int(6) NOT NULL,
  `Ten_Khu_Vuc` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_chuyen_doi`
--

CREATE TABLE `lich_su_chuyen_doi` (
  `Ma_Lich_Su_Chuyen_Doi` int(6) NOT NULL,
  `Thoi_Gian` datetime NOT NULL,
  `Ma_Nguyen_Lieu` int(6) NOT NULL,
  `Ma_Thanh_Pham` int(6) NOT NULL,
  `Loai_Thanh_Pham` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Ty_Le_Nguyen_Lieu` int(6) NOT NULL,
  `Ty_Le_Thanh_Pham` int(6) NOT NULL,
  `So_Luong_Nguyen_Lieu` int(6) NOT NULL,
  `So_Luong_Thanh_Pham` int(6) NOT NULL,
  `Nguoi_Chuyen_Doi` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_nhap_kho`
--

CREATE TABLE `lich_su_nhap_kho` (
  `Ma_Lich_Su_Nhap_Kho` int(6) NOT NULL,
  `Thoi_Gian` datetime NOT NULL,
  `Ma_Mon` int(6) NOT NULL,
  `So_Luong_Cu` int(6) NOT NULL,
  `So_Luong_Moi` int(6) NOT NULL,
  `Nguoi_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_nhap_kho_hang`
--

CREATE TABLE `lich_su_nhap_kho_hang` (
  `Ma_Lich_Su_Nhap_Kho` int(6) NOT NULL,
  `Thoi_Gian` datetime NOT NULL,
  `Ma_Hang` int(6) NOT NULL,
  `So_Luong_Cu` int(6) NOT NULL,
  `So_Luong_Moi` int(6) NOT NULL,
  `Nguoi_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_ban`
--

CREATE TABLE `loai_ban` (
  `Ma_Loai_Ban` int(6) NOT NULL,
  `Ten_Loai_Ban` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Phu_Thu` int(12) NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_mon_an`
--

CREATE TABLE `loai_mon_an` (
  `Ma_Loai` int(6) NOT NULL,
  `Ten_Loai` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luu_kho`
--

CREATE TABLE `luu_kho` (
  `Ma_Luu_Kho` int(6) NOT NULL,
  `Ma_Mon` int(6) NOT NULL,
  `Thoi_Gian` datetime NOT NULL,
  `So_Luong` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luu_kho_hang`
--

CREATE TABLE `luu_kho_hang` (
  `Ma_Luu_Kho` int(6) NOT NULL,
  `Ma_Hang` int(6) NOT NULL,
  `Thoi_Gian` datetime NOT NULL,
  `So_Luong` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_an`
--

CREATE TABLE `mon_an` (
  `Ma_Mon` int(6) NOT NULL,
  `Ma_Loai` int(1) NOT NULL,
  `Ten_Mon` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `STT` int(2) NOT NULL,
  `Gia` int(6) NOT NULL,
  `Khong_Pha_Che` tinyint(1) NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `Ten_Dang_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Mat_Khau` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Loai_Tai_Khoan` int(1) NOT NULL,
  `Xoa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`Ten_Dang_Nhap`, `Mat_Khau`, `Loai_Tai_Khoan`, `Xoa`) VALUES
('admin', 'c3284d0f94606de1fd2af172aba15bf3', 3, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai`
--

CREATE TABLE `trang_thai` (
  `Ma_Trang_Thai` int(6) NOT NULL,
  `Ten_Dang_Nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Thoi_Gian_Trang_Thai` datetime NOT NULL,
  `Noi_Dung_Trang_Thai` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Cấu trúc bảng cho bảng `thiet_lap`
--

CREATE TABLE `thiet_lap` (
  `Ma_Thiet_Lap` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `Noi_Dung` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thiet_lap`
--

INSERT INTO `thiet_lap` (`Ma_Thiet_Lap`, `Noi_Dung`) VALUES
('Dia_Chi', 'Địa chỉ'),
('Logo', 'icon.png'),
('Ten_Don_Vi', 'Tên quán'),
('Kho_Giay', '58'),
('Co_Chu', '8'),
('Phu_Thu', '0'),
('Ly_Do_Phu_Thu', 'Khong co'),
('Giam_Gia', '0'),
('Ngay_Khoi_Tao', '2019-01-01'),
('Ngay_Het_Han', '2020-01-01');


--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`Ma_Ban`);

--
-- Chỉ mục cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  ADD PRIMARY KEY (`Ma_Chi_Tiet`);

--
-- Chỉ mục cho bảng `don_vi_tinh`
--
ALTER TABLE `don_vi_tinh`
  ADD PRIMARY KEY (`Ma_Don_Vi_Tinh`);

--
-- Chỉ mục cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  ADD PRIMARY KEY (`Ma_Hang`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`Ma_Hoa_Don`);

--
-- Chỉ mục cho bảng `ho_so`
--
ALTER TABLE `ho_so`
  ADD PRIMARY KEY (`Ten_Dang_Nhap`);

--
-- Chỉ mục cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  ADD PRIMARY KEY (`Ma_Khu_Vuc`);

--
-- Chỉ mục cho bảng `lich_su_chuyen_doi`
--
ALTER TABLE `lich_su_chuyen_doi`
  ADD PRIMARY KEY (`Ma_Lich_Su_Chuyen_Doi`);

--
-- Chỉ mục cho bảng `lich_su_nhap_kho`
--
ALTER TABLE `lich_su_nhap_kho`
  ADD PRIMARY KEY (`Ma_Lich_Su_Nhap_Kho`);

--
-- Chỉ mục cho bảng `lich_su_nhap_kho_hang`
--
ALTER TABLE `lich_su_nhap_kho_hang`
  ADD PRIMARY KEY (`Ma_Lich_Su_Nhap_Kho`);

--
-- Chỉ mục cho bảng `loai_ban`
--
ALTER TABLE `loai_ban`
  ADD PRIMARY KEY (`Ma_Loai_Ban`);

--
-- Chỉ mục cho bảng `loai_mon_an`
--
ALTER TABLE `loai_mon_an`
  ADD PRIMARY KEY (`Ma_Loai`);

--
-- Chỉ mục cho bảng `luu_kho`
--
ALTER TABLE `luu_kho`
  ADD PRIMARY KEY (`Ma_Luu_Kho`);

--
-- Chỉ mục cho bảng `luu_kho_hang`
--
ALTER TABLE `luu_kho_hang`
  ADD PRIMARY KEY (`Ma_Luu_Kho`);

--
-- Chỉ mục cho bảng `mon_an`
--
ALTER TABLE `mon_an`
  ADD PRIMARY KEY (`Ma_Mon`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`Ten_Dang_Nhap`);

--
-- Chỉ mục cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  ADD PRIMARY KEY (`Ma_Trang_Thai`);
  
--
-- Chỉ mục cho bảng `thiet_lap`
--
ALTER TABLE `thiet_lap`
  ADD PRIMARY KEY (`Ma_Thiet_Lap`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ban`
--
ALTER TABLE `ban`
  MODIFY `Ma_Ban` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_hoa_don`
--
ALTER TABLE `chi_tiet_hoa_don`
  MODIFY `Ma_Chi_Tiet` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `don_vi_tinh`
--
ALTER TABLE `don_vi_tinh`
  MODIFY `Ma_Don_Vi_Tinh` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hang_hoa`
--
ALTER TABLE `hang_hoa`
  MODIFY `Ma_Hang` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  MODIFY `Ma_Hoa_Don` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `khu_vuc`
--
ALTER TABLE `khu_vuc`
  MODIFY `Ma_Khu_Vuc` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_chuyen_doi`
--
ALTER TABLE `lich_su_chuyen_doi`
  MODIFY `Ma_Lich_Su_Chuyen_Doi` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_nhap_kho`
--
ALTER TABLE `lich_su_nhap_kho`
  MODIFY `Ma_Lich_Su_Nhap_Kho` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_su_nhap_kho_hang`
--
ALTER TABLE `lich_su_nhap_kho_hang`
  MODIFY `Ma_Lich_Su_Nhap_Kho` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_ban`
--
ALTER TABLE `loai_ban`
  MODIFY `Ma_Loai_Ban` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loai_mon_an`
--
ALTER TABLE `loai_mon_an`
  MODIFY `Ma_Loai` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `luu_kho`
--
ALTER TABLE `luu_kho`
  MODIFY `Ma_Luu_Kho` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `luu_kho_hang`
--
ALTER TABLE `luu_kho_hang`
  MODIFY `Ma_Luu_Kho` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `mon_an`
--
ALTER TABLE `mon_an`
  MODIFY `Ma_Mon` int(6) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT cho bảng `trang_thai`
--
ALTER TABLE `trang_thai`
  MODIFY `Ma_Trang_Thai` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
