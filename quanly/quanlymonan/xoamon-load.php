<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maMon = $_POST['mamon'];

$sql = "SELECT `Ten_Mon` FROM `mon_an` WHERE `Ma_Mon` = $maMon;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenMon = $row['Ten_Mon'];
}
$sql = "UPDATE `mon_an` SET `Xoa`= 1 WHERE `Ma_Mon` = $maMon;";
$result = $conn->query($sql);
echo "<div class='alert alert-danger'>Đã xóa $tenMon thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>