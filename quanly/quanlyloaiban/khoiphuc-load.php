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
$sql = "UPDATE `loai_ban` SET `Xoa`=0 WHERE `Ma_Loai_Ban`=$maLoaiBan;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenLoaiBan thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>