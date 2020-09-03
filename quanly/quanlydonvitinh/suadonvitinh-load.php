<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maDonViTinh = locSo($_POST['madonvitinh']);
$tenDonViTinh = $_POST['tendonvitinh'];

$sql = "UPDATE `don_vi_tinh` SET `Ten_Don_Vi_Tinh`='$tenDonViTinh' WHERE `Ma_Don_Vi_Tinh`=$maDonViTinh;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã cập nhật $tenDonViTinh thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>