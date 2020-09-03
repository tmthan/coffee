<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maMon = $_POST['mamon'];
$soLuong = $_POST['soluong'];
$soLuongHienTai = 0;

/* Lấy số lượng hiện tại trong kho */

$sql = "SELECT `luu_kho`.`Ma_Luu_Kho`, `mon_an`.`Ten_Mon`, `luu_kho`.`So_Luong` FROM `mon_an`, `luu_kho` WHERE `luu_kho`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `luu_kho`.`Ma_Mon` = '$maMon' ORDER BY `luu_kho`.`Ma_Luu_Kho` DESC LIMIT 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {	
	$tenMon = $row['Ten_Mon'];	
	$soLuongHienTai = $row['So_Luong'];	
}

// Cộng số lượng mới vào kho

$soLuongMoi = $soLuong;
$thoiGian = date('Y-m-d H:i:s');

$tenDangNhap = $_SESSION['tendangnhap']; // Người nhập

// thêm vào kho

$sql = "INSERT INTO `luu_kho`(`Ma_Luu_Kho`, `Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES (NULL,'$maMon','$thoiGian','$soLuongMoi');";

$result = $conn->query($sql);

// Lưu lịch sử nhập kho

$sql = "INSERT INTO `lich_su_nhap_kho`(`Ma_Lich_Su_Nhap_Kho`, `Thoi_Gian`, `Ma_Mon`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES (NULL,'$thoiGian','$maMon','$soLuongHienTai','$soLuongMoi','$tenDangNhap');";
$result = $conn->query($sql);

echo "<div class='alert alert-success'>Thay đổi sống lượng thành công!</div>";
mysqli_close($conn);
?>