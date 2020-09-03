<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maDonViTinh = locSo($_POST['madonvitinh']);

$sql = "SELECT `Ten_Don_Vi_Tinh` FROM `don_vi_tinh` WHERE `Ma_Don_Vi_Tinh` = $maDonViTinh;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
}
$sql = "UPDATE `don_vi_tinh` SET `Xoa`=1 WHERE `Ma_Don_Vi_Tinh`=$maDonViTinh;";
$result = $conn->query($sql);
echo "<div class='alert alert-danger'>Đã xóa $tenDonViTinh thành công!</div>";
mysqli_close($conn);
?>