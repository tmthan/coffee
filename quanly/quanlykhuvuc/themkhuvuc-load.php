<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenKhuVuc = $_POST['tenkhuvuc'];

$sql = "INSERT INTO `khu_vuc`(`Ten_Khu_Vuc`, `xoa`) VALUES ('$tenKhuVuc',0);";
$result = $conn->query($sql);

echo "<div class='alert alert-success'>Đã thêm $tenKhuVuc thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>