<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$maBanCu = locSo($_POST['mabancu']);
$maHoaDonCu = locSo($_POST['mahoadoncu']);
$maBanMoi = locSo($_POST['mabanmoi']);

/* Cập nhật hóa đơn lại thành bàn khác */
$sql = "UPDATE `hoa_don` SET `Ma_Ban`= $maBanMoi WHERE `Ma_Hoa_Don` = $maHoaDonCu;";
$result = $conn->query($sql);

/* Cập nhật lại trạng thái bàn cũ thành trống */
$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 0 WHERE `Ma_Ban` = $maBanCu;";
$result = $conn->query($sql);

/* Cập nhật trạng thái bàn mới thành đang phục vụ */
$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 1 WHERE `Ma_Ban` = $maBanMoi;";
$result = $conn->query($sql);

/* Lấy tên bàn mới để đặt lại tên bàn */
$sql = "SELECT `Ten_Ban` FROM `ban` WHERE `Ma_Ban` = $maBanMoi;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenBanMoi = $row['Ten_Ban'];
}

echo "$tenBanMoi";

mysqli_close($conn);
?>