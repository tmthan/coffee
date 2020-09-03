<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maHang = locSo($_POST['mahang']);
$sql = "SELECT `Ten_Hang` FROM `hang_hoa` WHERE `Ma_Hang` = $maHang;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenHang = $row['Ten_Hang'];
}
$sql = "UPDATE `hang_hoa` SET `Xoa`=1 WHERE `Ma_Hang`=$maHang;";
$result = $conn->query($sql);
echo "<div class='alert alert-danger'>Đã xóa $tenHang thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>