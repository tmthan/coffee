<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

/*
* Gộp bàn được tính theo công thức
* Lấy mã hóa đơn của bàn mới được gộp vào
* Đổi chi mã hóa đơn của chi tiết hóa đơn thành mã hóa đơn của bàn mới
* Đổi trạng thái hóa đơn cũ thành -1 (bàn bị hủy)
* Cập nhật lại trạng thái bàn cũ thành trống
*/

$maBanCu = locSo($_POST['mabancu']);
$maHoaDonCu = locSo($_POST['mahoadoncu']);
$maBanMoi = locSo($_POST['mabanmoi']);

/* Lấy mã hóa đơn của bàn mới được gộp vào */
$sql = "SELECT `hoa_don`.`Ma_Hoa_Don` FROM `hoa_don`, `ban`, `loai_ban` WHERE `hoa_don`.`Ma_Ban` = $maBanMoi ORDER BY `Ma_Hoa_Don` DESC LIMIT 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maHoaDonMoi = $row['Ma_Hoa_Don'];
}

/* Cập nhật chi tiết hóa đơn của bàn cũ thành bàn mới */
$sql = "UPDATE `chi_tiet_hoa_don` SET `Ma_Hoa_Don`= $maHoaDonMoi WHERE `Ma_Hoa_Don` = $maHoaDonCu;";
$result = $conn->query($sql);

/* Đổi trạng thái hóa đơn cũ thành -1 */
$sql = "UPDATE `hoa_don` SET `Trang_Thai_Thanh_Toan`= -1 WHERE `Ma_Hoa_Don` = $maHoaDonCu;";
$result = $conn->query($sql);

/* Cập nhật lại trạng thái bàn cũ thành trống */
$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 0 WHERE `Ma_Ban` = $maBanCu;";
$result = $conn->query($sql);

/* Lấy tên bàn mới để đặt lại tên bàn */
$sql = "SELECT `Ten_Ban` FROM `ban` WHERE `Ma_Ban` = $maBanMoi;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenBanMoi = $row['Ten_Ban'];
}

echo "$tenBanMoi";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>