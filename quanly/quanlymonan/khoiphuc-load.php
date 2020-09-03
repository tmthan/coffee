<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maMon = locSo($_POST['mamon']);

$sql = "SELECT `Ten_Mon` FROM `mon_an` WHERE `Ma_Mon` = $maMon;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenMon = $row['Ten_Mon'];
}
$sql = "UPDATE `mon_an` SET `Xoa`= 0 WHERE `Ma_Mon` = $maMon;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenMon thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>