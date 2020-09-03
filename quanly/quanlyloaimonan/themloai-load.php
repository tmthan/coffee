<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenLoai = $_POST['tenloai'];

$sql = "INSERT INTO `loai_mon_an`(`Ma_Loai`, `Ten_Loai`, `Xoa`) VALUES (NULL,'$tenLoai', 0);";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã thêm $tenLoai thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>