<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

if (!isset($_SESSION['loaitaikhoan']) || $_SESSION < 2) {
	header('Location: / ');	// Chan truy cap trai phep
}

$maHoaDon = locSo($_POST['mahoadon']);
$maBan = locSo($_POST['maban']);


// Cập nhật lại trạng thái bàn về trống
$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu` = 0 WHERE `Ma_Ban` = '$maBan';";
$result = $conn->query($sql);
// Cập nhật lại trạng thái hóa đơn
$sql = "UPDATE `hoa_don` SET `Trang_Thai_Thanh_Toan`=-1 WHERE `Ma_Hoa_Don` = $maHoaDon;";
echo "$sql";
$result = $conn->query($sql);
// Xóa các món trong hóa đơn
$sql = "DELETE FROM `chi_tiet_hoa_don` WHERE `Ma_Hoa_Don` = $maHoaDon;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã hủy bàn</div>";
if (isset($result)) {
  mysqli_free_result($result);
}
mysqli_close($conn);
?>