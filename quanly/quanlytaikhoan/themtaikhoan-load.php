<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenDangNhap = $_POST['tendangnhap'];
$loaiTaiKhoan = $_POST['loaitaikhoan'];
$hoTen = $_POST['hoten'];
$ngaySinh = $_POST['ngaysinh'];
$thangSinh = $_POST['thangsinh'];
$namSinh = $_POST['namsinh'];
$gioiTinh = $_POST['gioitinh'];
$soDienThoai = $_POST['sodienthoai'];
$diaChi = $_POST['diachi'];
$matKhau = md5(md5($_POST['matkhau'])); 	// ma hoa mat khau md5 2 lan

$sql = "INSERT INTO `tai_khoan`(`Ten_Dang_Nhap`, `Mat_Khau`, `Loai_Tai_Khoan`, `Xoa`) VALUES ('$tenDangNhap','$matKhau', $loaiTaiKhoan, 0);";
$result = $conn->query($sql);
$sql2 = "INSERT INTO `ho_so`(`Ten_Dang_Nhap`, `Ho_Ten`, `Nam_Sinh`, `Gioi_Tinh`, `So_Dien_Thoai`, `Dia_Chi`) VALUES ('$tenDangNhap','$hoTen','$namSinh-$thangSinh-$ngaySinh', $gioiTinh, '$soDienThoai', '$diaChi');";
$result = $conn->query($sql2);

echo "1";	// 1 them thanh cong		
mysqli_close($conn);			// Dong ket noi
?>