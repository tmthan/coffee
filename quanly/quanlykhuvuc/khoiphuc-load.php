<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maKhuVuc = locSo($_POST['makhuvuc']);

$sql = "SELECT `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `Ma_Khu_Vuc` = $maKhuVuc;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenKhuVuc = $row['Ten_Khu_Vuc'];
}
$sql = "UPDATE `khu_vuc` SET `Xoa`= 0 WHERE `Ma_Khu_Vuc` = $maKhuVuc;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenKhuVuc thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>