<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenDonViTinh = $_POST['tendonvitinh'];

$sql = "INSERT INTO `don_vi_tinh`(`Ten_Don_Vi_Tinh`, `Xoa`) VALUES ('$tenDonViTinh',0);";
$result = $conn->query($sql);


echo "<div class='alert alert-success'>Đã thêm $tenDonViTinh thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>