<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maHang = locSo($_POST['mahang']);

$sql = "SELECT `Ten_Hang` FROM `hang_hoa` WHERE `Ma_Hang`=$maHang;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenHang = $row['Ten_Hang'];
}
$sql = "UPDATE `hang_hoa` SET `Xoa`= 0 WHERE `Ma_Hang` = $maHang;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenHang thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>