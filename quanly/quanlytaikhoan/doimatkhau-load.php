<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$matKhauMoi = md5(md5($_POST['matkhaumoi'])); 	// ma hoa mat khau md5 2 lan
$tenDangNhap = $_POST['tendangnhap'];

$sql = "UPDATE `tai_khoan` SET `Mat_Khau`= '$matKhauMoi' WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đổi mật khẩu thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>