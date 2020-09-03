<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenBan = $_POST['tenban'];
$soChoNgoi = locSo($_POST['sochongoi']);
$khuVuc = locSo($_POST['khuvuc']);
$loaiBan = locSo($_POST['loaiban']);

$sql = "INSERT INTO `ban`(`Ten_Ban`, `Ma_Khu_Vuc`, `Ma_Loai_Ban`, `So_Cho_Ngoi`, `Trang_Thai_Phuc_Vu`) VALUES ('$tenBan',$khuVuc,$loaiBan,$soChoNgoi,0);";
$result = $conn->query($sql);

// Thêm một hóa đơn mẫu
// Trước tiên, lấy mã bàn vừa mới được thêm

// $sql = "SELECT MAX(`Ma_Ban`) as `Ma_Ban` FROM `ban` LIMIT 1;";
// $result = $conn->query($sql);
// while ($row = $result->fetch_assoc()) {
// 	$maban = $row['Ma_Ban'];
// }

// $thoigian = date('Y-m-d H:i:s');

// $tendangnhap = $_SESSION['tendangnhap'];
// $sql = "INSERT INTO `hoa_don` (`Ma_Hoa_Don`, `Ten_Dang_Nhap`, `Ma_Ban`, `Thoi_Gian_Bat_Dau`, `Thoi_Gian_Ket_Thuc`, `Trang_Thai_Thanh_Toan`, `Tong_Tien`, `Phu_Thu`, `Giam_Gia`, `Thanh_Tien`, `Khach_Tra`, `Tien_Thua`) VALUES (NULL, '$tendangnhap', '$maban', '$thoigian', '$thoigian', '1', '0', '0', '0', '0', '0', '0');";
// $result = $conn->query($sql);

echo "<div class='alert alert-success'>Đã thêm $tenBan thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>