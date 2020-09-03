<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}

$loaiThanhPham = $_GET['loaithanhpham'];

if ($loaiThanhPham == "monan") {
	$sql = "SELECT `Ma_Mon`, `Ten_Mon` FROM `mon_an` WHERE `Khong_Pha_Che`=1 AND `Xoa`=0 ORDER BY `Ten_Mon`;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$maMon = $row['Ma_Mon'];
		$tenMon = $row['Ten_Mon'];
		echo "<option value='$maMon'>$tenMon</option>";
	}
} else if ($loaiThanhPham == "hanghoa") {
	$sql = "SELECT `hang_hoa`.`Ma_Hang`, `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `don_vi_tinh` WHERE `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `hang_hoa`.`Xoa` = 0 ORDER BY `hang_hoa`.`Ten_Hang`;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$maHang = $row['Ma_Hang'];
		$tenHang = $row['Ten_Hang'];
		$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
		echo "<option value='$maHang'>$tenHang ($tenDonViTinh)</option>";
	}
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>