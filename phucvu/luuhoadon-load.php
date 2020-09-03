<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

if (!isset($_SESSION['loaitaikhoan']) || $_SESSION < 2) {
	header('Location: index.php ');	// Chan truy cap trai phep
}


$maHoaDon = locSo($_POST['mahoadon']);
$maBan = locSo($_POST['maban']);
$tenDangNhap = $_SESSION['tendangnhap'];
$tongTien = locSo($_POST['tongtien']);
$phuThu = locSo($_POST['phuthu']);
$lyDoPhuThu = $_POST['lydophuthu'];
$giamGia = locSo($_POST['giamgia']);
$thanhTien = locSo($_POST['thanhtien']);
$phuThuTatCa = locSo($_POST['phuthutatca']);
$lyDoPhuThuTatCa = $_POST['lydophuthutatca'];
$giamGiaTatCa = $_POST['giamgiatatca'];


	
$sql2 = "UPDATE `hoa_don` SET `Tong_Tien` = $tongTien, `Phu_Thu`= $phuThu, `Ly_Do_Phu_Thu`= '$lyDoPhuThu', `Phu_Thu_Tat_Ca`=$phuThuTatCa,`Ly_Do_Phu_Thu_Tat_Ca`='$lyDoPhuThuTatCa', `Giam_Gia`= $giamGia, `Giam_Gia_Tat_Ca`=$giamGiaTatCa, `Thanh_Tien`= $thanhTien WHERE `hoa_don`.`Ma_Hoa_Don` = $maHoaDon;";	// cap nhat hoa don
$result = $conn->query($sql2);
echo "<div class='alert alert-success'>Đã lưu thông tin hóa đơn</div>";
mysqli_close($conn);
?>