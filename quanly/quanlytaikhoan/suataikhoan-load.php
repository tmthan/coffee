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

$sql = "UPDATE `ho_so` SET `Ho_Ten`= '$hoTen', `Nam_Sinh`= '$namSinh-$thangSinh-$ngaySinh',`Gioi_Tinh`= $gioiTinh,`So_Dien_Thoai`= '$soDienThoai',`Dia_Chi`= '$diaChi' WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);

// cap nhat loai tai khoan

$sql = "UPDATE `tai_khoan` SET `Loai_Tai_Khoan`= $loaiTaiKhoan WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);

echo "<div class='alert alert-success'>Đã cập nhật $hoTen thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>