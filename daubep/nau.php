<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 1) {
	header('Location: index.php');
}
if (isset($_POST['machitiet'])) {
	$maChiTiet = $_POST['machitiet'];
}

$nguoiNau = $_SESSION['tendangnhap'];
$thoiGianNau = date('Y-m-d H:i:s');	// thoi gian nau
$sql = "UPDATE `chi_tiet_hoa_don` SET `Trang_Thai_Nau`= 1,`Nguoi_Nau`= '$nguoiNau' WHERE `Ma_Chi_Tiet` = $maChiTiet;";

$result = $conn->query($sql) or die("Lỗi khi nau: " . mysql_error());

/* Them trang thai */


// lay ten ban an va ten mon an
$sql = "SELECT `mon_an`.`Ten_Mon`, `ban`.`Ten_Ban` FROM `ban`, `hoa_don`, `chi_tiet_hoa_don`, `mon_an` WHERE `mon_an`.`Ma_Mon` = `chi_tiet_hoa_don`.`Ma_Mon` AND `ban`.`Ma_Ban` = `hoa_don`.`Ma_Ban` AND `hoa_don`.`Ma_Hoa_Don` = `chi_tiet_hoa_don`.`Ma_Hoa_Don` AND `chi_tiet_hoa_don`.`Ma_Chi_Tiet` = $maChiTiet;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$tenBan = $row['Ten_Ban'];
	$tenMon = $row['Ten_Mon'];
	
}

// them trang thai

$sql = "INSERT INTO `trang_thai`( `Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ('$nguoiNau','$thoiGianNau','Đang pha chế $tenMon cho $tenBan');";

$result = $conn->query($sql) or die("Lỗi khi gọi món: " . mysql_error());

	if (isset($result)) {
		echo "Them trang thai thanh cong";
	}

		
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);

?>