<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

if (isset($_POST['machitiet'])) {
	$maChiTiet = locSo($_POST['machitiet']);
}

// Kiem tra xem mon an da duoc nau chua, neu dang nau thi khong duoc huy

$sql = "SELECT `chi_tiet_hoa_don`.`Trang_Thai_Nau` FROM `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Chi_Tiet` = $maChiTiet;";


$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$trangThaiNau = $row['Trang_Thai_Nau'];	
}

// Neu mon an chua nau thi moi duoc xoa

if ($trangThaiNau == 0) 
{

	/* cap nhat trang thai huy mon */

	// lay ten mon

	$sql = "SELECT `mon_an`.`Ten_Mon` FROM `mon_an`, `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `chi_tiet_hoa_don`.`Ma_Chi_Tiet` = $maChiTiet;";

	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		$tenMon = $row['Ten_Mon'];
	}


	$nguoiHuy = $_SESSION['tendangnhap'];
	$thoiGianHuy = date('Y-m-h H:m');

	$sql = "INSERT INTO `trang_thai`( `Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ('$nguoiHuy','$thoiGianHuy','Đã hủy $tenMon');";

	$result = $conn->query($sql) or die("Lỗi khi hủy món: " . mysql_error());
		
	$sql = "UPDATE `chi_tiet_hoa_don` SET `Trang_Thai_Nau`=-1 WHERE `Ma_Chi_Tiet` = $maChiTiet;";

	$result = $conn->query($sql);

} else if ($trangThaiNau == 3)
{
	/* cap nhat trang thai huy mon */

	// lay ten mon

	$sql = "SELECT `mon_an`.`Ten_Mon` FROM `mon_an`, `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `chi_tiet_hoa_don`.`Ma_Chi_Tiet` = $maChiTiet;";

	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		$tenMon = $row['Ten_Mon'];
	}


	$nguoiHuy = $_SESSION['tendangnhap'];
	$thoiGianHuy = date('Y-m-h H:m');

	// Cap nhat kho
	// Trừ vào kho
	
	// Lấy số lượng món được gọi	
	$soLuongGoi = 0;
	$maMon = 0;
	$sql3 = "SELECT `So_Luong`, `Ma_Mon` FROM `chi_tiet_hoa_don` WHERE `Ma_Chi_Tiet` = '$maChiTiet';";
	$result3 = $conn->query($sql3);
	while ($row3 = $result3->fetch_assoc()) {
		$soLuongGoi = $row3['So_Luong'];
		$maMon = $row3['Ma_Mon'];
	}

	// lấy số lượng hiện tại của món
	$sql2 = "SELECT `So_Luong` FROM `luu_kho` WHERE `Ma_Mon` = '$maMon' ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
	$soLuongCu = 0;
	$result2 = $conn->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$soLuongCu = $row2['So_Luong'];
	}

	// Tính số lượng mới

	$soLuongMoi = $soLuongCu + $soLuongGoi;

	/* Cập nhật số lượng trong kho trước rồi mới xóa bỏ chi tiết hóa đơn */

	$sql4 = "INSERT INTO `luu_kho`(`Ma_Luu_Kho`, `Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES (NULL,'$maMon','$thoiGianHuy','$soLuongMoi');";
	$result4 = $conn->query($sql4);


	$sql = "INSERT INTO `trang_thai`( `Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ('$nguoiHuy','$thoiGianHuy','Đã hủy $tenMon');";

	$result = $conn->query($sql) or die("Lỗi khi hủy món: " . mysql_error());
		
	$sql = "UPDATE `chi_tiet_hoa_don` SET `Trang_Thai_Nau`=-1 WHERE `Ma_Chi_Tiet` = $maChiTiet;";

	$result = $conn->query($sql);
}


if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
if (isset($result3)) {
	mysqli_free_result($result3);
}
if (isset($result4)) {
	mysqli_free_result($result4);
}
mysqli_close($conn);

?>