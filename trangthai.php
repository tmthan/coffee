<?php
require_once( dirname( __FILE__ ). '/load.php');
$sql = "SELECT `trang_thai`.`Thoi_Gian_Trang_Thai`, `ho_so`.`Ho_Ten`, `trang_thai`.`Noi_Dung_Trang_Thai`, `tai_khoan`.`Loai_Tai_Khoan` FROM `trang_thai`, `ho_so`, `tai_khoan` WHERE `tai_khoan`.`Ten_Dang_Nhap` = `ho_so`.`Ten_Dang_Nhap` AND `ho_so`.`Ten_Dang_Nhap` = `trang_thai`.`Ten_Dang_Nhap` ORDER BY `Ma_Trang_Thai` DESC LIMIT 20;";

$result = $conn->query($sql);
 
while ($row = $result->fetch_assoc()){
	$thoiGian = substr( $row['Thoi_Gian_Trang_Thai'], 10, 6);
	$hoTen = $row['Ho_Ten'];
	$loaiTaiKhoan = $row['Loai_Tai_Khoan'];
	$noiDungTrangThai = $row['Noi_Dung_Trang_Thai'];
	if ($loaiTaiKhoan == 1) {
		echo "<div class='status'><span class='font-bold col-cyan'>$thoiGian</span> <span class='font-bold col-orange'>$hoTen</span> $noiDungTrangThai</div>";
	}
	else {
		echo "<div class='status'><span class='font-bold col-cyan'>$thoiGian</span> <span class='font-bold col-teal'>$hoTen</span> $noiDungTrangThai</div>";
	}
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>