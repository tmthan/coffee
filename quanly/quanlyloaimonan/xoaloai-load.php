<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoai = locSo($_POST['maloai']);

$sql = "SELECT `Ten_Loai` FROM `loai_mon_an` WHERE `Ma_Loai` = $maLoai;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoai = $row['Ten_Loai'];
}
$sql = "UPDATE `loai_mon_an` SET `Xoa`= 1 WHERE `Ma_Loai` = $maLoai;";
$result = $conn->query($sql);
echo "<div class='alert alert-danger'>Đã xóa $tenLoai thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>