<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}
$maHang = $_POST['mahang'];
$soLuong = $_POST['soluong'];
$soLuongHienTai = 0;

/* Lấy số lượng hiện tại trong kho */

$sql = "SELECT `luu_kho_hang`.`Ma_Luu_Kho`, `hang_hoa`.`Ten_Hang`, `luu_kho_hang`.`So_Luong`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `luu_kho_hang`, `don_vi_tinh` WHERE `luu_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang` AND `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `luu_kho_hang`.`Ma_Hang` = '$maHang' ORDER BY `luu_kho_hang`.`Ma_Luu_Kho` DESC LIMIT 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {	
	$tenHang = $row['Ten_Hang'];	
	$soLuongHienTai = $row['So_Luong'];	
}


if ($soLuongHienTai >= $soLuong) {
	// Cập nhật lại số lượng trong kho sau khi xuất

	$soLuongMoi = $soLuongHienTai - $soLuong;
	$thoiGian = date('Y-m-d H:i:s');
	
	$tenDangNhap = $_SESSION['tendangnhap']; // Người nhập

	// thêm vào kho

	$sql = "INSERT INTO `luu_kho_hang`(`Ma_Luu_Kho`, `Ma_Hang`, `Thoi_Gian`, `So_Luong`) VALUES (NULL,'$maHang','$thoiGian','$soLuongMoi');";

	$result = $conn->query($sql);

	// Lưu lịch sử xuất kho

	$sql = "INSERT INTO `lich_su_nhap_kho_hang`(`Ma_Lich_Su_Nhap_Kho`, `Thoi_Gian`, `Ma_Hang`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES (NULL,'$thoiGian','$maHang','$soLuongHienTai','$soLuongMoi','$tenDangNhap');";
	$result = $conn->query($sql);
} else {
	echo "<div class='alert alert-danger'>Không đủ số lượng trong kho để xuất</div>";
}

echo "<div class='alert alert-success'>Xuất kho $tenHang thành công!</div>";
mysqli_close($conn);
?>