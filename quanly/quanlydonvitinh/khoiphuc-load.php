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
$sql = "UPDATE `don_vi_tinh` SET `Xoa`=0 WHERE `Ma_Don_Vi_Tinh`=$maDonViTinh;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Khôi phục $tenDonViTinh thành công!</div>";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>