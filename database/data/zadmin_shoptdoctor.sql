-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 07:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zadmin_shoptdoctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_products`
--

CREATE TABLE `cat_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cat_products`
--

INSERT INTO `cat_products` (`id`, `name`, `parent_id`, `image`, `slug`, `created_at`, `updated_at`) VALUES
(12, 'Thực phẩm chức năng', 0, '', 'thuc-pham-chuc-nang', '2022-09-04 03:02:09', '2022-09-04 03:02:09'),
(13, 'Sinh lý - Nội tiết tố', 12, 'cp1.png', 'sinh-ly-noi-tiet-to', '2022-09-04 03:02:50', '2022-09-05 20:39:14'),
(14, 'Sức khỏe tim mạch', 12, 'sm2.png', 'suc-khoe-tim-mach', '2022-09-04 10:22:24', '2022-09-04 10:22:24'),
(15, 'Hỗ trợ tiêu hóa', 12, 'sm3.png', 'ho-tro-tieu-hoa', '2022-09-04 10:24:34', '2022-09-04 10:24:34'),
(16, 'Thần kinh não', 12, 'sm4.png', 'than-kinh-nao', '2022-09-04 10:26:38', '2022-09-04 10:26:38'),
(17, 'Hỗ trợ điều trị', 12, 'sm5.png', 'ho-tro-dieu-tri', '2022-09-04 10:27:19', '2022-09-04 10:27:19'),
(18, 'Hỗ trợ làm đẹp', 12, 'sm8.png', 'ho-tro-lam-dep', '2022-09-04 10:27:50', '2022-09-04 10:28:58'),
(19, 'Vitamin và khoáng chất', 12, 'sm9.png', 'vitamin-va-khoang-chat', '2022-09-04 10:29:52', '2022-09-04 10:29:52'),
(20, 'Dinh dưỡng', 12, 'sm10.png', 'dinh-duong', '2022-09-04 10:30:16', '2022-09-04 10:30:16'),
(21, 'Dược mỹ phẩm', 0, '', 'duoc-my-pham', '2022-09-04 10:35:47', '2022-09-04 10:35:47'),
(22, 'Chăm sóc sức khỏe', 21, 'dmp1.png', 'cham-soc-suc-khoe', '2022-09-04 10:36:40', '2022-09-04 10:36:40'),
(23, 'Các vấn đề về da', 21, 'dmp2.png', 'cac-van-de-ve-da', '2022-09-04 11:04:18', '2022-09-04 11:04:18'),
(24, 'Chăm sóc da mặt', 21, 'dmp3.png', 'cham-soc-da-mat', '2022-09-04 11:05:15', '2022-09-04 11:05:15'),
(25, 'Chăm sóc tóc da đầu', 21, 'dmp4.png', 'cham-soc-toc-da-dau', '2022-09-04 11:05:55', '2022-09-04 11:05:55'),
(26, 'Chăm sóc tóc chuyên sâu', 21, 'dmp5.png', 'cham-soc-toc-chuyen-sau', '2022-09-04 11:06:26', '2022-09-04 11:06:26'),
(27, 'Chăm sóc da vùng mặt', 21, 'dmp6.png', 'cham-soc-da-vung-mat', '2022-09-04 11:06:56', '2022-09-04 11:06:56'),
(28, 'Mỹ phẩm trang điểm', 21, 'dmp7.png', 'my-pham-trang-diem', '2022-09-04 11:09:31', '2022-09-04 11:09:31'),
(29, 'Chăm sóc cá nhân', 0, '', 'cham-soc-ca-nhan', '2022-09-04 11:09:59', '2022-09-04 11:09:59'),
(30, 'Hỗ trợ tình dục', 29, 'cscn1.png', 'ho-tro-tinh-duc', '2022-09-04 11:11:02', '2022-09-04 11:11:02'),
(31, 'Chăm sóc răng miệng', 29, 'cscn2.png', 'cham-soc-rang-mieng', '2022-09-04 11:11:28', '2022-09-04 11:11:28'),
(32, 'Vệ sinh cá nhân', 29, 'cscn3.png', 've-sinh-ca-nhan', '2022-09-04 11:11:53', '2022-09-04 11:11:53'),
(33, 'Đồ dùng gia đình', 29, 'cscn4.png', 'do-dung-gia-dinh', '2022-09-04 11:12:43', '2022-09-04 11:12:43'),
(34, 'Tinh dầu các loại', 29, 'cscn5.png', 'tinh-dau-cac-loai', '2022-09-04 11:13:19', '2022-09-04 11:13:19'),
(35, 'Thực phẩm đồ uống', 29, 'cscn6.png', 'thuc-pham-do-uong', '2022-09-04 11:13:44', '2022-09-04 11:13:44'),
(36, 'Thiết bị làm đẹp', 29, 'cscn7.png', 'thiet-bi-lam-dep', '2022-09-04 11:14:13', '2022-09-04 11:14:13'),
(37, 'Dụng cụ cạo râu', 29, 'cscn8.png', 'dung-cu-cao-rau', '2022-09-04 11:14:51', '2022-09-04 11:14:51'),
(38, 'Hàng tổng hợp', 29, 'cscn9.png', 'hang-tong-hop', '2022-09-04 11:15:22', '2022-09-04 11:15:22'),
(39, 'Sinh lý nam', 13, 'sl1.png', 'sinh-ly-nam', '2022-09-04 11:18:12', '2022-09-04 11:18:12'),
(40, 'Sinh lý nữ', 13, 'sl2.png', 'sinh-ly-nu', '2022-09-04 11:18:55', '2022-09-04 11:18:55'),
(41, 'Hỗ trợ mãn kinh', 13, 'sl3.png', 'ho-tro-man-kinh', '2022-09-04 11:20:00', '2022-09-04 11:20:00'),
(42, 'Cân bằng nội tiết tố', 13, 'sl4.png', 'can-bang-noi-tiet-to', '2022-09-04 11:21:19', '2022-09-04 11:21:19'),
(43, 'Sức khỏe tình dục', 13, 'sl5.png', 'suc-khoe-tinh-duc', '2022-09-04 11:21:51', '2022-09-04 11:21:51'),
(44, 'Huyết áp', 14, 'sktm1.png', 'huyet-ap', '2022-09-04 11:23:54', '2022-09-04 11:23:54'),
(45, 'Cholesterol', 14, 'sktm2.png', 'cholesterol', '2022-09-04 11:24:31', '2022-09-04 11:24:31'),
(46, 'Suy giãn tim mạch', 14, 'sktm3.png', 'suy-gian-tim-mach', '2022-09-04 11:25:15', '2022-09-04 11:25:15'),
(47, 'Dạ dày, tá tràng', 15, 'htth.png', 'da-day-ta-trang', '2022-09-04 11:28:47', '2022-09-04 11:28:47'),
(48, 'Nhuận tràng', 15, 'htth1.png', 'nhuan-trang', '2022-09-04 11:29:12', '2022-09-04 11:29:12'),
(49, 'Khó tiêu', 15, 'htth2.png', 'kho-tieu', '2022-09-04 11:29:28', '2022-09-04 11:29:28'),
(50, 'Táo bón', 15, 'htth4.png', 'tao-bon', '2022-09-04 11:29:47', '2022-09-04 11:29:47'),
(51, 'Đại tràng', 15, 'htth5.png', 'dai-trang', '2022-09-04 11:30:05', '2022-09-04 11:30:05'),
(52, 'Bố não, cải thiện trí nhớ', 16, 'tkn1.png', 'bo-nao-cai-thien-tri-nho', '2022-09-04 11:31:17', '2022-09-04 11:31:17'),
(53, 'Kiểm soát căng thẳng', 16, 'tkn2.png', 'kiem-soat-cang-thang', '2022-09-04 11:31:45', '2022-09-04 11:31:45'),
(54, 'Hỗ trợ giấc ngủ', 16, 'tkn3.png', 'ho-tro-giac-ngu', '2022-09-04 11:32:14', '2022-09-04 11:32:14'),
(55, 'Trĩ', 17, 'htdt1.png', 'tri', '2022-09-04 11:33:39', '2022-09-04 11:33:39'),
(56, 'Hô hấp xoang', 17, 'htdt2.png', 'ho-hap-xoang', '2022-09-04 11:35:17', '2022-09-04 11:35:17'),
(57, 'Cơ xương khớp', 17, 'htdt3.png', 'co-xuong-khop', '2022-09-04 11:36:03', '2022-09-04 11:36:03'),
(58, 'Gout', 17, 'htdt4.png', 'gout', '2022-09-04 11:37:09', '2022-09-04 11:37:09'),
(59, 'Tiểu đường', 17, 'htdt5.png', 'tieu-duong', '2022-09-04 11:37:44', '2022-09-04 11:37:44'),
(60, 'Gan - mật', 17, 'htdt6.png', 'gan-mat', '2022-09-04 11:38:39', '2022-09-04 11:38:39'),
(61, 'Thận tiền liệt tuyến', 17, 'htdt7.png', 'than-tien-liet-tuyen', '2022-09-04 11:39:37', '2022-09-04 11:39:37'),
(62, 'xem tất cả', 17, 'htdt8.png', 'xem-tat-ca', '2022-09-04 11:40:35', '2022-09-04 11:40:35'),
(63, 'Da', 18, 'htld1.png', 'da', '2022-09-04 11:58:47', '2022-09-04 11:58:47'),
(64, 'Tóc', 18, 'htld2.png', 'toc', '2022-09-04 12:00:07', '2022-09-04 12:00:07'),
(65, 'Kích cỡ ngực', 18, 'htld3.png', 'kich-co-nguc', '2022-09-04 12:00:35', '2022-09-04 12:00:35'),
(66, 'Hỗ trợ giảm cân', 18, 'htld4.png', 'ho-tro-giam-can', '2022-09-04 12:01:09', '2022-09-04 12:01:09'),
(67, 'Thực phẩm giảm cân', 18, 'htld5.png', 'thuc-pham-giam-can', '2022-09-04 12:01:57', '2022-09-04 12:01:57'),
(68, 'VitaminC', 19, 'vtmkc1.png', 'vitaminc', '2022-09-04 12:03:14', '2022-09-04 12:03:14'),
(69, 'VitaminA', 19, 'vtmkc2.png', 'vitamina', '2022-09-04 12:03:35', '2022-09-04 12:03:35'),
(70, 'VitaminE', 19, 'vtmkc3.png', 'vitamine', '2022-09-04 12:03:54', '2022-09-04 12:03:54'),
(71, 'Canxi', 19, 'vtmkc4.png', 'canxi', '2022-09-04 12:04:11', '2022-09-04 12:04:11'),
(72, 'Sắt', 19, 'vtmkc5.png', 'sat', '2022-09-04 12:04:29', '2022-09-04 12:04:29'),
(73, 'Kẽm', 19, 'vtmkc6.png', 'kem', '2022-09-04 12:04:54', '2022-09-04 12:04:54'),
(74, 'DHA', 19, 'vtmkc7.png', 'dha', '2022-09-04 12:05:18', '2022-09-04 12:05:18'),
(75, 'Sữa', 20, 'ddgd1.png', 'sua', '2022-09-04 12:06:55', '2022-09-04 12:06:55'),
(76, 'Thực phẩm ăn kiêng', 20, 'ddgd2.png', 'thuc-pham-an-kieng', '2022-09-04 12:07:20', '2022-09-04 12:07:20'),
(77, 'Chống nắng toàn thân', 22, 'csct1.png', 'chong-nang-toan-than', '2022-09-05 19:32:31', '2022-09-05 19:32:31'),
(78, 'Dưỡng thể', 22, 'csct2.png', 'duong-the', '2022-09-05 19:33:54', '2022-09-05 19:33:54'),
(79, 'Chăm sóc ngực', 22, 'csct3.png', 'cham-soc-nguc', '2022-09-05 19:34:31', '2022-09-05 19:34:31'),
(80, 'Sữa tắm, xà bông', 22, 'csct4.png', 'sua-tam-xa-bong', '2022-09-05 19:35:43', '2022-09-05 19:35:43'),
(81, 'Khử mùi', 22, 'csct5.png', 'khu-mui', '2022-09-05 19:36:11', '2022-09-05 19:36:11'),
(82, 'Trị rạn da - nứt da', 22, 'csct6.png', 'tri-ran-da-nut-da', '2022-09-05 19:36:47', '2022-09-05 19:36:47'),
(83, 'Dưỡng tay, chân', 22, 'csct7.png', 'duong-tay-chan', '2022-09-05 19:37:26', '2022-09-05 19:37:26'),
(84, 'Dưỡng trắng da', 23, 'cvdvd1.png', 'duong-trang-da', '2022-09-05 19:40:30', '2022-09-05 19:40:30'),
(85, 'Trị sẹo', 23, 'cvdvd2.png', 'tri-seo', '2022-09-05 19:40:49', '2022-09-05 19:40:49'),
(86, 'Mờ vết thâm', 23, 'cvdvd3.png', 'mo-vet-tham', '2022-09-05 19:41:19', '2022-09-05 19:41:19'),
(87, 'Da khô - thiếu ẩm', 23, 'cvdvd4.png', 'da-kho-thieu-am', '2022-09-05 19:41:49', '2022-09-05 19:41:49'),
(88, 'Nhạy cảm', 23, 'cvdvd5.png', 'nhay-cam', '2022-09-05 19:42:06', '2022-09-05 19:42:06'),
(89, 'Kem chống nắng', 24, 'csdm1.png', 'kem-chong-nang', '2022-09-05 19:44:49', '2022-09-05 19:44:49'),
(90, 'Sữa rửa mặt', 24, 'csdm2.png', 'sua-rua-mat', '2022-09-05 19:45:17', '2022-09-05 19:45:17'),
(91, 'Toner', 24, 'csdm3.png', 'toner', '2022-09-05 19:45:41', '2022-09-05 19:45:41'),
(92, 'Trị mụn', 24, 'csdm4.png', 'tri-mun', '2022-09-05 19:46:00', '2022-09-05 19:46:00'),
(93, 'Tẩy trang', 24, 'csdm5.png', 'tay-trang', '2022-09-05 19:46:27', '2022-09-05 19:46:27'),
(94, 'Tẩy tế bào chết', 24, 'csdm6.png', 'tay-te-bao-chet', '2022-09-05 19:46:50', '2022-09-05 19:46:50'),
(95, 'Mặt nạ', 24, 'csdm7.png', 'mat-na', '2022-09-05 19:47:17', '2022-09-05 19:47:17'),
(96, 'Đặc trị cho tóc', 25, 'cst1.png', 'dac-tri-cho-toc', '2022-09-05 19:50:32', '2022-09-05 19:50:32'),
(97, 'Dầu gội dầu xả', 25, 'cst2.png', 'dau-goi-dau-xa', '2022-09-05 19:51:03', '2022-09-05 19:51:03'),
(98, 'Dưỡng tóc, ủ tóc', 25, 'cst3.png', 'duong-toc-u-toc', '2022-09-05 19:51:52', '2022-09-05 19:51:52'),
(99, 'Trị nấm', 26, 'cst2.png', 'tri-nam', '2022-09-05 19:53:16', '2022-09-05 19:53:16'),
(100, 'Dưỡng da mắt', 27, 'csvm1.png', 'duong-da-mat', '2022-09-05 19:56:07', '2022-09-05 19:56:07'),
(101, 'Trị thâm quầng, bọng mắt', 27, 'csvm2.png', 'tri-tham-quang-bong-mat', '2022-09-05 19:56:48', '2022-09-05 19:56:48'),
(102, 'Trang điểm mặt', 28, 'mptd1.png', 'trang-diem-mat', '2022-09-05 19:57:35', '2022-09-05 19:57:35'),
(103, 'Dụng cụ trang điểm', 28, 'mptd2.png', 'dung-cu-trang-diem', '2022-09-05 19:58:04', '2022-09-05 19:58:04'),
(104, 'Son môi', 28, 'mptd3.png', 'son-moi', '2022-09-05 19:58:24', '2022-09-05 19:58:24'),
(105, 'Bao cao su', 30, 'httd1.png', 'bao-cao-su', '2022-09-05 21:05:32', '2022-09-05 21:05:32'),
(106, 'Gel bôi trơn', 30, 'httd2.png', 'gel-boi-tron', '2022-09-05 21:06:38', '2022-09-05 21:06:38'),
(107, 'Nước súc miệng', 31, 'csrm1.png', 'nuoc-suc-mieng', '2022-09-05 21:07:48', '2022-09-05 21:07:48'),
(108, 'Chỉ nha khoa', 31, 'csrm3.png', 'chi-nha-khoa', '2022-09-05 21:08:29', '2022-09-05 21:08:29'),
(109, 'Kem đánh răng', 31, 'csrm3.png', 'kem-danh-rang', '2022-09-05 21:08:54', '2022-09-05 21:08:54'),
(110, 'Bàn chải đánh răng', 31, 'csrm4.png', 'ban-chai-danh-rang', '2022-09-05 21:09:27', '2022-09-05 21:09:27'),
(111, 'Ngừa sâu răng', 31, 'csrm5.png', 'ngua-sau-rang', '2022-09-05 21:10:58', '2022-09-05 21:10:58'),
(112, 'Nước rửa tay', 32, 'vscn1.png', 'nuoc-rua-tay', '2022-09-05 21:13:00', '2022-09-05 21:13:00'),
(113, 'Dung dịch vệ sinh phụ nữ', 32, 'vscn3.png', 'dung-dich-ve-sinh-phu-nu', '2022-09-05 21:13:29', '2022-09-05 21:13:29'),
(114, 'Băng vệ sinh', 32, 'vscn3.png', 'bang-ve-sinh', '2022-09-05 21:14:15', '2022-09-05 21:14:15'),
(115, 'Đồ dùng cho bé', 33, 'ddgd1.png', 'do-dung-cho-be', '2022-09-05 21:15:18', '2022-09-05 21:15:18'),
(116, 'Đồ dùng cho mẹ', 33, 'ddgd2.png', 'do-dung-cho-me', '2022-09-05 21:15:42', '2022-09-05 21:15:42'),
(117, 'Chống muỗi', 33, 'ddgd3.png', 'chong-muoi', '2022-09-05 21:16:39', '2022-09-05 21:16:39'),
(118, 'Dầu dừa', 34, 'tdcl1.png', 'dau-dua', '2022-09-05 21:17:24', '2022-09-05 21:17:24'),
(119, 'Tinh dầu tràm', 34, 'tdcl2.png', 'tinh-dau-tram', '2022-09-05 21:18:07', '2022-09-05 21:18:07'),
(120, 'Kẹo cứng', 35, 'tpdu1.png', 'keo-cung', '2022-09-05 21:18:51', '2022-09-05 21:18:51'),
(121, 'Kẹo cao su', 35, 'tpdu2.png', 'keo-cao-su', '2022-09-05 21:19:10', '2022-09-05 21:19:10'),
(122, 'Nước uống không gas', 35, 'tpdu3.png', 'nuoc-uong-khong-gas', '2022-09-05 21:19:44', '2022-09-05 21:19:44'),
(123, 'Sữa nước', 35, 'tpdu4.png', 'sua-nuoc', '2022-09-05 21:20:38', '2022-09-05 21:20:38'),
(124, 'Trà', 35, 'tpdu5.png', 'tra', '2022-09-05 21:20:58', '2022-09-05 21:20:58'),
(125, 'Dụng cụ tẩy lông', 36, 'tbld1.png', 'dung-cu-tay-long', '2022-09-05 21:21:43', '2022-09-05 21:21:43'),
(126, 'Dao cạo râu', 37, 'dccr1.png', 'dao-cao-rau', '2022-09-05 21:22:32', '2022-09-05 21:22:32'),
(148, 'Thú Y', 0, '', 'thu-y', NULL, NULL),
(149, 'Dung dịch kháng sinh tiêm', 148, 'thy1.png', 'dung-dich-khang-sinh-tiem', NULL, NULL),
(150, 'Thuốc bột kháng sinh uống', 148, 'thy2.png', 'thuoc-bot-khang-sinh-uong', NULL, NULL),
(151, 'Dung dịch kháng sinh uống', 148, 'thy3.png', 'dung-dich-khang-sinh-uong', NULL, NULL),
(152, 'Thuốc chế phẩm bổ trợ hạ sốt, tiêu viêm', 148, 'thy4.png', 'thuoc-che-pham-bo-tro-ha-sot-tieu-viem', NULL, NULL),
(153, 'Thuốc ký sinh trùng dạng dung dịch tiêm bột', 148, 'thy5.png', 'thuoc-ky-sinh-trung-dang-dung-dich-tiem-bot', NULL, NULL),
(154, 'Nhóm men đạm sữa', 148, 'thy6.png', 'nhom-men-dam-sua', NULL, NULL),
(155, 'Vitamin khoáng chất dạng cốm hòa tan', 148, 'thy7.png', 'vitamin-khoang-chat-dang-com-hoa-tan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2022_08_12_164455_create_producers_table', 1),
(4, '2022_08_13_004919_create_units_table', 2),
(6, '2022_08_31_091031_create_sizes_table', 4),
(7, '2022_08_31_093635_create_users_table', 5),
(8, '2022_08_31_094531_create_products_table', 6),
(9, '2022_08_31_101516_create_products_table', 7),
(10, '2022_08_31_102856_create_products_table', 8),
(11, '2022_08_31_103208_create_user_product_table', 9),
(12, '2022_08_31_141425_create_img_products_table', 10),
(13, '2022_08_31_143545_create_warehouses_table', 11),
(14, '2022_09_04_022816_create_cat_products_table', 12),
(15, '2022_09_04_093802_add_cat_id_to_products_table', 13),
(16, '2022_09_04_162407_create_feature_products_table', 14),
(17, '2022_09_04_163545_create_feature_products_table', 15),
(18, '2022_09_08_021557_create_trademarks_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producers`
--

CREATE TABLE `producers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `producers`
--

INSERT INTO `producers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Công ty Cổ phần Dược Kim Bảng', '2022-08-12 10:15:29', '2022-08-28 02:23:55'),
(7, 'Công ty Cổ phần Hóa - Dược phẩm Mekophar2', '2022-08-28 02:19:45', '2022-09-05 17:00:00'),
(8, 'Công ty dược Hà Nội', '2022-09-05 17:00:00', '2022-09-05 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `producer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tick` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type_price` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `price_vat` bigint(20) UNSIGNED DEFAULT NULL,
  `coefficient` bigint(20) UNSIGNED DEFAULT NULL,
  `type_vat` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `packing` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `local_buy` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amout_max` bigint(20) UNSIGNED DEFAULT NULL,
  `made_country` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dosage_forms` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trademark` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventory` bigint(20) UNSIGNED DEFAULT NULL,
  `specification` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `benefit` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `general_info` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `dosage` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preserve` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `feature` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longs` bigint(12) DEFAULT NULL,
  `wides` bigint(12) DEFAULT NULL,
  `highs` bigint(12) DEFAULT NULL,
  `mass` bigint(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type`, `code`, `cat_id`, `producer_id`, `tick`, `type_price`, `price`, `price_vat`, `coefficient`, `type_vat`, `packing`, `unit`, `local_buy`, `amout_max`, `made_country`, `dosage_forms`, `trademark`, `inventory`, `specification`, `benefit`, `general_info`, `point`, `dosage`, `note`, `preserve`, `image`, `feature`, `longs`, `wides`, `highs`, `mass`, `created_at`, `updated_at`) VALUES
(46, 'Viên uống tăng cường sinh lý nam Maca M Male Power 60 viên', 'Sản phẩm loại thường', 'HGUY89', 39, 7, '', 'Giá bán hàng niêm yết', 660000, 665000, 1, 'Có VAT', 'dong dung', 'Hộp', 'Toàn quốc', 2, 'Việt Nam', 'Viên nang', 'Nature\'s Supplements', 22, 'Hộp 30 viên', 'Maca M Male Power giúp bổ thận, tráng dương, tăng cường sinh lực, tăng cảm xúc ham muốn tình dục. \r\nGiúp tăng cường chức năng thận, điều hòa lượng đường và ngăn ngừa hủy hoại thận. Giảm nguy cơ rối loạn tuyến tiền liệt, giảm tiểu đêm, đái rắt. \r\nTăng năng lượng và sức chịu đựng cho cơ thể, phục hồi trương lực cơ, giảm bớt mệt mỏi. ', '<p>Hỗ trợ phục hồi sinh l&yacute; nam - Lấy lại bản lĩnh đ&agrave;n &ocirc;ng<br />Maca M Male Power l&agrave; sản phẩm tăng cường sinh l&yacute; được nghi&ecirc;n cứu v&agrave; ph&aacute;t triển với c&ocirc;ng thức 100% nguy&ecirc;n liệu thảo dược tự nhi&ecirc;n. Với cơ chế thẩm thấu chuy&ecirc;n s&acirc;u, vi&ecirc;n uống vừa k&iacute;ch th&iacute;ch cơ thể sản sinh testosterone vừa tăng cường chức năng tạng thận v&agrave; n&acirc;ng cao sức khỏe tổng thể, gi&uacute;p k&eacute;o d&agrave;i thời gian quan hệ, giải quyết c&aacute;c vấn đề ph&aacute;t sinh do yếu sinh l&yacute; nam.</p>\r\n<p>Yếu sinh l&yacute; nam l&agrave; t&igrave;nh trạng suy giảm chức năng sinh l&yacute;, gặp nhiều ở nam giới trong độ tuổi trung ni&ecirc;n v&agrave; người cao tuổi do ảnh hưởng của qu&aacute; tr&igrave;nh l&atilde;o h&oacute;a. Ngo&agrave;i ra, yếu sinh l&yacute; c&ograve;n c&oacute; thể bắt nguồn từ th&oacute;i quen lạm dụng rượu bia, quan hệ t&igrave;nh dục qu&aacute; độ, ảnh hưởng của một số bệnh m&atilde;n t&iacute;nh, t&aacute;c dụng phụ của thuốc,&hellip;</p>\r\n<p>Khi gặp phải t&igrave;nh trạng n&agrave;y, nam giới sẽ c&oacute; triệu chứng suy giảm ham muốn t&igrave;nh dục, kh&ocirc;ng kiểm so&aacute;t được khả năng cương cứng v&agrave; thời gian xuất tinh của bản th&acirc;n mỗi khi bước v&agrave;o cuộc y&ecirc;u. Yếu sinh l&yacute; nếu diễn ra trong thời gian d&agrave;i m&agrave; kh&ocirc;ng c&oacute; c&aacute;c biện ph&aacute;p khắc phục đ&uacute;ng c&aacute;ch sẽ t&aacute;c động ti&ecirc;u cực đến t&acirc;m l&yacute; của nam giới. Căn bệnh kh&oacute; n&oacute;i n&agrave;y khiến c&aacute;c đấng m&agrave;y r&acirc;u mất đi sự tự tin v&agrave; bản lĩnh trong chốn ph&ograve;ng the, l&acirc;u dần sẽ dẫn đến t&igrave;nh trạng mất ham muốn t&igrave;nh dục, l&atilde;nh cảm v&agrave; suy giảm khả năng sinh sản.&nbsp;</p>', NULL, 'Cách dùng\n\nNgày dùng 2 lần, mỗi lần 1 viên, tốt nhất là sau bữa trưa và bữa tối. \n\nĐối với người mới sử dụng lần đầu có thể uống 4 viên ngày chia 2 lần trong 1 - 2 tuần đầu tiên để có hiệu quả nhanh hơn. ', 'Không dùng trong các trường hợp:\r\n\r\nNgười dưới 18 tuổi.\r\nNgười mẫn cảm với bất kỳ thành phần nào của sản phẩm.\r\nTham khảo ý kiến bác sĩ trước khi dùng nếu có hoặc nghi ngờ có bệnh, đang dùng thuốc.\r\nNgưng dùng và tham khảo ý kiến bác sĩ nếu xảy ra phản ứng bất lợi.\r\nSản phẩm này không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh.\r\nĐọc kỹ hướng dẫn sử dụng trước khi dùng.', 'Bảo quản nơi khô ráo, thoáng mát, nhiệt độ không quá 30oC, tránh ánh sáng trực tiếp.\r\nĐể xa tầm tay trẻ em.', 'vu2.jfif,vn1.jfif,vu4.jfif,vu5.jfif', 'sản phẩm hậu covid', 22, 22, 22, 33, NULL, NULL),
(47, 'Viên Uống Bảo Xuân Gold Nam Dược (30-50 Tuổi) Cân Bằng Nội Tiết 30 Viên', 'Sản phẩm loại thường', 'GHUY87', 42, 7, '', 'Giá bán hàng niêm yết', 128000, 129000, 1, 'Có VAT', 'dong dung', 'Hộp', 'Kho Hà Nội,Kho Huế,Kho Đà Nẵng', 2, 'Việt Nam', 'Viên nang', 'goodheath', 32, 'Hộp 30 viên', 'Bảo Xuân Gold giúp cải thiện các triệu chứng do thiếu hụt hoặc rối loạn nội tiết tố nữ estrogen: \r\nXuống sắc, bốc hỏa, mắt ngủ, vã mồ hôi, suy giảm trí nhớ, tóc khô xơ, dễ rụng, khô âm đạo, giảm ham muốn tình dục, rối loạn kinh nguyệt, khả năng thụ thai kém.\r\nGiúp hạn chế lão hoá, giảm nếp nhăn trên da, tăng cường đàn hồi da, giảm nám, sạm da, tàn nhang, giúp da đẹp mịn màng, sắc mặt hồng hào, tươi trẻ.\r\nGiúp làm chậm quá trình mãn kinh, kéo dài tuổi xuân phụ nữ.', '<p>C&acirc;n bằng nội tiết, g&igrave;n giữ n&eacute;t thanh xu&acirc;n<br />Bảo Xu&acirc;n Gold được chiết xuất từ c&aacute;c th&agrave;nh phần l&agrave;nh t&iacute;nh gi&uacute;p c&acirc;n bằng nội tiết tố nữ, hạn chế t&igrave;nh trạng l&atilde;o h&oacute;a da, giảm nếp nhăn cũng như tăng cường độ đ&agrave;n hồi cho da. Ngo&agrave;i ra, sản phẩm cũng hỗ trợ giảm t&agrave;n nhang, bốc hỏa, nhăn v&ugrave;ng mắt, kh&ocirc; &acirc;m đạo.</p>\r\n<p>----</p>\r\n<p>Khi tới tuổi 30 trở đi, cơ thể phụ nữ mất dần đi lượng nội tiết tố nữ trong cơ thể. Một trong những dấu hiệu ti&ecirc;u biểu gi&uacute;p bạn nhận ra sự thiếu hụt lượng estrogen như chu kỳ kinh nguyệt kh&ocirc;ng đều, v&ocirc; sinh, xương yếu, đau v&agrave; kh&ocirc; r&aacute;t &acirc;m đạo khi quan hệ, trầm cảm.</p>\r\n<p>Ch&iacute;nh v&igrave; vậy, việc bổ sung estrogen đ&oacute;ng vai tr&ograve; quan trọng. Estrogen l&agrave;m giảm sự ph&aacute;t triển nhanh của nữ giới trong giai đoạn dậy th&igrave;, tăng độ nhạy cảm với insulin. Đồng thời, estrogen mang đến cho phụ nữ tăng ham muốn khi quan hệ t&igrave;nh dục cũng như k&eacute;o d&agrave;i thời gian quan hệ. Hay c&oacute; thể n&oacute;i, estrogen đ&oacute;ng vai tr&ograve; quan trọng với sức khỏe, sắc đẹp v&agrave; sinh l&yacute;.&nbsp;</p>\r\n<p>Một trong những sản phẩm gi&uacute;p bổ sung h&agrave;m lượng estrogen c&oacute; thể kể đến hiện nay l&agrave; Bảo Xu&acirc;n Gold. Sản phẩm mang đến c&ocirc;ng dụng bổ sung, c&acirc;n bằng nội tiết tố cho phụ nữ tr&ecirc;n 30 tuổi v&agrave; phụ nữ tiền m&atilde;n kinh. Sản phẩm đảm bảo an to&agrave;n c&oacute; thể sử dụng l&acirc;u d&agrave;i, thường xuy&ecirc;n để duy tr&igrave; hiệu quả.</p>\r\n<p>Bảo Xu&acirc;n Gold l&agrave; sản phẩm của Nam Dược. Đ&acirc;y c&ocirc;ng ty dược phẩm uy t&iacute;n tại Việt Nam với định hướng ph&aacute;t triển dựa tr&ecirc;n tinh hoa y học cổ truyền v&agrave; tiềm năng dược liệu Việt Nam, kết hợp m&aacute;y m&oacute;c hiện đại, nhằm s&aacute;ng tạo ra sản phẩm an to&agrave;n, tiện dụng, mang lại lợi &iacute;ch cho sức khỏe cộng đồng.</p>', NULL, NULL, 'Không sử dụng cho người mẫn cảm với bất cứ thành phần nào của sản phẩm. \r\nKhông dùng quá liều khuyến cáo.\r\nSản phẩm này không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh.\r\nĐọc kỹ hướng dẫn sử dụng trước khi dùng.', 'Bảo quản nơi khô ráo, thoáng mát, tránh ánh sáng, nhiệt độ dưới 30 độ C.\r\nĐể xa tầm tay trẻ em. ', 'bx1.jfif,bx2.jfif,bx3.jfif,bx4.jfif,bx5.jfif', 'sản phẩm hậu covid,sản phẩm nổi bật,sản phẩm bán chạy nhất', 20, 67, 55, 44, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tinhthanhphos`
--

CREATE TABLE `tinhthanhphos` (
  `matp` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tinhthanhphos`
--

INSERT INTO `tinhthanhphos` (`matp`, `name`, `type`) VALUES
('01', 'Thành phố Hà Nội', 'Thành phố Trung ương'),
('02', 'Tỉnh Hà Giang', 'Tỉnh'),
('04', 'Tỉnh Cao Bằng', 'Tỉnh'),
('06', 'Tỉnh Bắc Kạn', 'Tỉnh'),
('08', 'Tỉnh Tuyên Quang', 'Tỉnh'),
('10', 'Tỉnh Lào Cai', 'Tỉnh'),
('11', 'Tỉnh Điện Biên', 'Tỉnh'),
('12', 'Tỉnh Lai Châu', 'Tỉnh'),
('14', 'Tỉnh Sơn La', 'Tỉnh'),
('15', 'Tỉnh Yên Bái', 'Tỉnh'),
('17', 'Tỉnh Hoà Bình', 'Tỉnh'),
('19', 'Tỉnh Thái Nguyên', 'Tỉnh'),
('20', 'Tỉnh Lạng Sơn', 'Tỉnh'),
('22', 'Tỉnh Quảng Ninh', 'Tỉnh'),
('24', 'Tỉnh Bắc Giang', 'Tỉnh'),
('25', 'Tỉnh Phú Thọ', 'Tỉnh'),
('26', 'Tỉnh Vĩnh Phúc', 'Tỉnh'),
('27', 'Tỉnh Bắc Ninh', 'Tỉnh'),
('30', 'Tỉnh Hải Dương', 'Tỉnh'),
('31', 'Thành phố Hải Phòng', 'Thành phố Trung ương'),
('33', 'Tỉnh Hưng Yên', 'Tỉnh'),
('34', 'Tỉnh Thái Bình', 'Tỉnh'),
('35', 'Tỉnh Hà Nam', 'Tỉnh'),
('36', 'Tỉnh Nam Định', 'Tỉnh'),
('37', 'Tỉnh Ninh Bình', 'Tỉnh'),
('38', 'Tỉnh Thanh Hóa', 'Tỉnh'),
('40', 'Tỉnh Nghệ An', 'Tỉnh'),
('42', 'Tỉnh Hà Tĩnh', 'Tỉnh'),
('44', 'Tỉnh Quảng Bình', 'Tỉnh'),
('45', 'Tỉnh Quảng Trị', 'Tỉnh'),
('46', 'Tỉnh Thừa Thiên Huế', 'Tỉnh'),
('48', 'Thành phố Đà Nẵng', 'Thành phố Trung ương'),
('49', 'Tỉnh Quảng Nam', 'Tỉnh'),
('51', 'Tỉnh Quảng Ngãi', 'Tỉnh'),
('52', 'Tỉnh Bình Định', 'Tỉnh'),
('54', 'Tỉnh Phú Yên', 'Tỉnh'),
('56', 'Tỉnh Khánh Hòa', 'Tỉnh'),
('58', 'Tỉnh Ninh Thuận', 'Tỉnh'),
('60', 'Tỉnh Bình Thuận', 'Tỉnh'),
('62', 'Tỉnh Kon Tum', 'Tỉnh'),
('64', 'Tỉnh Gia Lai', 'Tỉnh'),
('66', 'Tỉnh Đắk Lắk', 'Tỉnh'),
('67', 'Tỉnh Đắk Nông', 'Tỉnh'),
('68', 'Tỉnh Lâm Đồng', 'Tỉnh'),
('70', 'Tỉnh Bình Phước', 'Tỉnh'),
('72', 'Tỉnh Tây Ninh', 'Tỉnh'),
('74', 'Tỉnh Bình Dương', 'Tỉnh'),
('75', 'Tỉnh Đồng Nai', 'Tỉnh'),
('77', 'Tỉnh Bà Rịa - Vũng Tàu', 'Tỉnh'),
('79', 'Thành phố Hồ Chí Minh', 'Thành phố Trung ương'),
('80', 'Tỉnh Long An', 'Tỉnh'),
('82', 'Tỉnh Tiền Giang', 'Tỉnh'),
('83', 'Tỉnh Bến Tre', 'Tỉnh'),
('84', 'Tỉnh Trà Vinh', 'Tỉnh'),
('86', 'Tỉnh Vĩnh Long', 'Tỉnh'),
('87', 'Tỉnh Đồng Tháp', 'Tỉnh'),
('89', 'Tỉnh An Giang', 'Tỉnh'),
('91', 'Tỉnh Kiên Giang', 'Tỉnh'),
('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương'),
('93', 'Tỉnh Hậu Giang', 'Tỉnh'),
('94', 'Tỉnh Sóc Trăng', 'Tỉnh'),
('95', 'Tỉnh Bạc Liêu', 'Tỉnh'),
('96', 'Tỉnh Cà Mau', 'Tỉnh');

-- --------------------------------------------------------

--
-- Table structure for table `trademarks`
--

CREATE TABLE `trademarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trademarks`
--

INSERT INTO `trademarks` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'goodheath', NULL, NULL),
(2, 'Nature\'s Supplements', '2022-09-07 17:00:00', '2022-09-07 17:00:00'),
(3, 'Ecogreen', '2022-09-07 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hộp', '2022-08-12 18:26:53', '2022-08-12 18:26:53'),
(2, 'Lốc', '2022-08-12 18:32:42', '2022-08-12 18:32:42'),
(4, 'Tuýp', '2022-08-28 02:21:47', '2022-08-28 02:21:47'),
(7, 'Thùng', '2022-09-06 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `customer_group` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `local`, `customer_group`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Thành Long', 'vinasoikaka@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'Thành phố Hà Nội', 'Bệnh nhân', '3333', '2022-09-02 01:43:05', '2022-09-02 01:43:05'),
(2, 'Trần Nhân', 'kieptuattuat@gmail.com', '', 'e10adc3949ba59abbe56e057f20f883e', 'Thành phố Hà Nội', 'Nhà thuốc', '6666', '2022-09-04 01:10:45', '2022-09-04 01:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `local` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `local`, `created_at`, `updated_at`) VALUES
(1, 'Kho Đà Nẵng', 'Đà Nẵng', '2022-08-31 09:09:02', '2022-08-31 09:50:37'),
(2, 'Kho Hà Nội', 'Hà Nội', '2022-08-31 09:18:48', '2022-08-31 09:18:48'),
(3, 'Kho HCM', 'TP Hồ Chí Minh', NULL, NULL),
(4, 'Kho Huế', 'Hà Nội', '2022-09-06 17:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_products`
--
ALTER TABLE `cat_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `producers`
--
ALTER TABLE `producers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_producer_id_foreign` (`producer_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `tinhthanhphos`
--
ALTER TABLE `tinhthanhphos`
  ADD PRIMARY KEY (`matp`);

--
-- Indexes for table `trademarks`
--
ALTER TABLE `trademarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_product_product_id_foreign` (`product_id`),
  ADD KEY `user_product_user_id_foreign` (`user_id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_products`
--
ALTER TABLE `cat_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `producers`
--
ALTER TABLE `producers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `trademarks`
--
ALTER TABLE `trademarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_product`
--
ALTER TABLE `user_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `cat_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_producer_id_foreign` FOREIGN KEY (`producer_id`) REFERENCES `producers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `user_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_product_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
