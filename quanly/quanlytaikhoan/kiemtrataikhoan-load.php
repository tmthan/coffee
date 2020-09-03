<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenDangNhap = $_POST['tendangnhap'];
// Kiem tra tai khoan co ton tai hay khong

$sql = "SELECT `Ten_Dang_Nhap` FROM `tai_khoan` WHERE `Ten_Dang_Nhap` = '$tenDangNhap';";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	if ($tenDangNhap == $row['Ten_Dang_Nhap']) {
		echo "1";
	}
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>