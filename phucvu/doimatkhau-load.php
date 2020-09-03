<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$matKhauCu = md5(md5($_POST['matkhaucu']));		// ma hoa mat khau cu 2 lan
$matKhauMoi = md5(md5($_POST['matkhaumoi'])); 	// ma hoa mat khau md5 2 lan
$tenDangNhap = locKyTu($_POST['tendangnhap']);

$sql = "SELECT `Mat_Khau` FROM `tai_khoan` WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	if ($matKhauCu == $row['Mat_Khau']) {
		$sql2 = "UPDATE `tai_khoan` SET `Mat_Khau`= '$matKhauMoi' WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
		$result2 = $conn->query($sql2);
		echo "<div class='alert alert-success'>Đổi mật khẩu thành công!</div>";
	}
	else {
		echo "<div class='alert alert-danger'>Mật khẩu cũ không đúng</div>";
	}	
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>