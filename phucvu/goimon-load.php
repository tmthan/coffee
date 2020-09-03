<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$maHoaDon = locSo($_POST['mahoadon']);
$maMon = locSo($_POST['mamon']);
$soLuong = locSo($_POST['soluong']);
$ghiChu = $_POST['ghichu'];
$nguoiGoi = $_SESSION['tendangnhap'];
$thoiGianGoi = date('Y-m-d H:i:s');	// Lay thoi gian goi mon

// Lay gia cua mon an, gia cua mon an co the thay doi theo thoi gian, nhung gia trong hoa don khong duoc thay doi
$sql = "SELECT `mon_an`.`Gia`, `mon_an`.`Khong_Pha_Che` FROM `mon_an` WHERE `mon_an`.`Ma_Mon` = $maMon;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$gia = $row['Gia'];
	$khongPhaChe = $row['Khong_Pha_Che'];
}


/* Kiem tra mon an da ton tai chua

$sql = "SELECT `chi_tiet_hoa_don`.`So_Luong`, `chi_tiet_hoa_don`.`Ma_Hoa_Don` FROM `chi_tiet_hoa_don` WHERE `Ma_Mon` = $maMon;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	if ($row['So_Luong'] >= 1 && $row['Ma_Hoa_Don'] == $mahoadon) {
		$datontaimon = true;
		$soLuong = $row['So_Luong'];	// Neu mon an da ton tai roi thi tang so luong len
		
	}
}

*/


/** Them mau tin vao chi tiet hoa don
*	Ma chi tiet tu dong tang
*	Trang thai cua mon an chua nau (=0)
* 	Chua co dau bep nhan nau mon
*/

/* Nếu là món ăn không pha chế thì trạng thái bằng 3, đây là trạng thái đặc biệt */

if ($khongPhaChe == 0) {
	$sql = "INSERT INTO `chi_tiet_hoa_don` VALUES ( NULL , $maHoaDon, $maMon, '$thoiGianGoi', $soLuong, $gia, '$nguoiGoi', '$ghiChu', 0, '');";
	$result = $conn->query($sql) or die("Lỗi khi gọi món: " . mysql_error());

	echo "<div class='alert alert-success'>Đã gọi món thành công</div>";
	
} else {

	// Kiểm tra số lượng trong kho trước khi gọi
	$sql = "SELECT `So_Luong` FROM `luu_kho` WHERE `Ma_Mon` = $maMon ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$tonKho = $row['So_Luong'];
	}
	if ($soLuong <= $tonKho) {
		
		$sql = "INSERT INTO `chi_tiet_hoa_don` VALUES ( NULL , $maHoaDon, $maMon, '$thoiGianGoi', $soLuong, $gia, '$nguoiGoi', '$ghiChu', 3, '');";	
		$result = $conn->query($sql) or die("Lỗi khi gọi món: " . mysql_error());
		
		// Trừ vào kho
		// lấy số lượng hiện tại của món
		$sql2 = "SELECT `So_Luong` FROM `luu_kho` WHERE `Ma_Mon` = '$maMon' ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
		$soLuongCu = 0;
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()) {
			$soLuongCu = $row2['So_Luong'];
		}
		// Cập nhật số lượng mới vào kho
		$soLuongMoi = $soLuongCu - $soLuong;
		$sql3 = "INSERT INTO `luu_kho`(`Ma_Luu_Kho`, `Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES (NULL,'$maMon','$thoiGianGoi','$soLuongMoi');";
		$result3 = $conn->query($sql3);

		echo "<div class='alert alert-success'>Đã gọi món thành công</div>";
	} else {
		echo "<script>alert('Sản phẩm hiện đang tạm hết');</script>";
	}	
}


/* Them trang thai */


// lay ten ban an va ten mon an
$sql = "SELECT `ban`.`Ten_Ban`, `mon_an`.`Ten_Mon` FROM `hoa_don`, `ban`, `mon_an` WHERE `ban`.`Ma_Ban` = `hoa_don`.`Ma_Ban` AND `hoa_don`.`Ma_Hoa_Don` = $maHoaDon AND `mon_an`.`Ma_Mon` = $maMon;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$tenBan = $row['Ten_Ban'];
	$tenMon = $row['Ten_Mon'];
	
}

// them trang thai

if ($khongPhaChe == 0) {
	$sql = "INSERT INTO `trang_thai`( `Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ('$nguoiGoi','$thoiGianGoi','Đã gọi $soLuong $tenMon cho $tenBan');";

	$result = $conn->query($sql);

} else if ($soLuong <= $tonKho) {
	$sql = "INSERT INTO `trang_thai`( `Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ('$nguoiGoi','$thoiGianGoi','Đã gọi $soLuong $tenMon cho $tenBan');";

	$result = $conn->query($sql);
}

mysqli_close($conn);
?>