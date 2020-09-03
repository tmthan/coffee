<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoaiBan = locSo($_POST['maloaiban']);

$sql = "SELECT `Ten_Loai_Ban` FROM `loai_ban` WHERE `Ma_Loai_Ban` = $maLoaiBan;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoaiBan = $row['Ten_Loai_Ban'];
}
$sql = "UPDATE `loai_ban` SET `Xoa`=1 WHERE `Ma_Loai_Ban` = $maLoaiBan;";
$result = $conn->query($sql);
echo "<div class='alert alert-danger'>Đã xóa $tenLoaiBan thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>