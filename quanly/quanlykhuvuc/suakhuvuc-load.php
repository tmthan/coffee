<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maKhuVuc = locSo($_POST['makhuvuc']);
$tenKhuVuc = $_POST['tenkhuvuc'];

$sql = "UPDATE `khu_vuc` SET `Ten_Khu_Vuc`='$tenKhuVuc' WHERE `Ma_Khu_Vuc`=$maKhuVuc;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã cập nhật $tenKhuVuc thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>