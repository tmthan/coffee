<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}
	
if (!isset($_SESSION['loaitaikhoan']) || $_SESSION < 2) {
	header('Location: index.php ');	// Chan truy cap trai phep
}

$thoiGianKetThuc = date('Y-m-d H:i:s');
$maHoaDon = locSo($_POST['mahoadon']);
$maBan = locSo($_POST['maban']);
$tenDangNhap = $_SESSION['tendangnhap'];
$tongTien = locSo($_POST['tongtien']);
$phuThu = locSo($_POST['phuthu']);
$lyDoPhuThu = $_POST['lydophuthu'];
$giamGia = locSo($_POST['giamgia']);
$thanhTien = locSo($_POST['thanhtien']);
$khachTra = locSo($_POST['khachtra']);
$tienThua = locSo($_POST['tienthua']);


// Kiểm tra xem còn món nào chưa pha chế xong hay không, nếu còn thì không thể thanh toán ngay được, phải đợi pha chế xong
// Đầu tiên cho biến $coTheThanhToan = true, nếu có món nào cản trở việc thanh toán thì đặt về false ngay

$coTheThanhToan = true;

// Tìm các món trong hóa đơn để kiểm tra trạng thái nấu
$sql = "SELECT `chi_tiet_hoa_don`.`Ma_Chi_Tiet`, `mon_an`.`Ten_Mon`, `chi_tiet_hoa_don`.`So_Luong`, `chi_tiet_hoa_don`.`Gia`, `chi_tiet_hoa_don`.`Trang_Thai_Nau`, `chi_tiet_hoa_don`.`Nguoi_Nau` FROM `mon_an`, `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = $maHoaDon;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$trangThaiNau = $row['Trang_Thai_Nau'];
	if ($trangThaiNau < 2) {
		$coTheThanhToan = false;
	}
}

// Kiểm tra phần tiền khách hàng trả, chỉ cần kiểm tra tiền thừa là biết nhân viên có nhập hay không

if ($tienThua < 0) {
	$coTheThanhToan = false;	
}

/*--------------------*/

if ($coTheThanhToan) {
	$sql1 = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu` = 0 WHERE `Ma_Ban` = '$maBan';";	// Cap nhat trang thai ban
	$sql2 = "UPDATE `hoa_don` SET `Trang_Thai_Thanh_Toan` = 1, `Thoi_Gian_Ket_Thuc` = '$thoiGianKetThuc', `Tong_Tien` = $tongTien, `Phu_Thu`= $phuThu, `Ly_Do_Phu_Thu`= '$lyDoPhuThu', `Giam_Gia`= $giamGia,`Thanh_Tien`= $thanhTien,`Khach_Tra`= $khachTra,`Tien_Thua`= $tienThua,`Thu_Ngan`=$tenDangNhap WHERE `hoa_don`.`Ma_Hoa_Don` = $maHoaDon;";	// cap nhat hoa don
	$sql3 = "  INSERT INTO `trang_thai` (`Ten_Dang_Nhap`, `Thoi_Gian_Trang_Thai`, `Noi_Dung_Trang_Thai`) VALUES ( '$tenDangNhap', '$thoiGianKetThuc', 'Đã thanh toán bàn số $maBan');";	// them trang thai	

			$result = $conn->query($sql1) or die("Lỗi khi thanh toan: " . mysql_error());
			$result = $conn->query($sql2) or die("Lỗi khi thanh toan: " . mysql_error());
			$result = $conn->query($sql3) or die("Lỗi khi thanh toan: " . mysql_error());
} else if ($tienThua < 0) {
	echo "<script>alert('Vui lòng kiểm tra lại phần tiền khách hàng trả');</script>";
} else {
	echo "<script>alert('Không thể thanh toán, còn đồ uống chưa pha chế xong!');</script>";
}
mysqli_close($conn);
?>