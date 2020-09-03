<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maHang = locSo($_POST['mahang']);
$tenHang = $_POST['tenhang'];
$maDonViTinh = locSo($_POST['madonvitinh']);

$sql = "UPDATE `hang_hoa` SET `Ten_Hang`='$tenHang',`Don_Vi_Tinh`=$maDonViTinh WHERE `Ma_Hang` = $maHang;";
	$result = $conn->query($sql);

echo "<div class='alert alert-success'>Đã cập nhật $tenHang thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>