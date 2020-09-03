<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenHang = $_POST['tenhang'];
$maDonViTinh = $_POST['madonvitinh'];

$sql = "INSERT INTO `hang_hoa`(`Ten_Hang`, `Don_Vi_Tinh`, `Xoa`) VALUES ('$tenHang','$maDonViTinh',0);";
$result = $conn->query($sql);

/* Thêm vào kho */

/* Nếu là món không pha chế thì thêm vào kho */
$thoiGian = date('Y-m-d H:i:s');
$maHang = 0;
// Lấy mã hàng vừa mới thêm
$sql = "SELECT MAX(`Ma_Hang`) as `Ma_Hang` FROM `hang_hoa`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maHang = $row['Ma_Hang'];
}
// Thêm số lượng hàng vào kho
$sql = "INSERT INTO `luu_kho_hang`(`Ma_Hang`, `Thoi_Gian`, `So_Luong`) VALUES ($maHang,'$thoiGian',0);";

$result = $conn->query($sql);

echo "<div class='alert alert-success'>Đã thêm $tenHang thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>