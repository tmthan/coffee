<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenDangNhap = $_POST['tendangnhap'];

$sql = "SELECT `Ho_Ten` FROM `ho_so` WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$hoTen = $row['Ho_Ten'];
}
$sql = "UPDATE `tai_khoan` SET `Xoa`= 0 WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $hoTen thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>