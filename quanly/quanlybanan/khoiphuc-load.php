<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maBan = locSo($_POST['maban']);

$sql = "SELECT `Ten_Ban` FROM `ban` WHERE `Ma_Ban` = $maBan;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenBan = $row['Ten_Ban'];
}
$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 0 WHERE `Ma_Ban` = $maBan;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenBan thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>