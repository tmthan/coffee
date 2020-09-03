<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenMon = $_POST['tenmon'];
$stt = $_POST['stt'];
$maLoai = $_POST['maloai'];
$gia = $_POST['gia'];
$khongPhaChe = $_POST['khongphache'];

$sql = "INSERT INTO `mon_an`(`Ma_Loai`, `Ten_Mon`, `STT`, `Gia`, `Khong_Pha_Che`, `Xoa`) VALUES ($maLoai,'$tenMon',$stt,$gia,$khongPhaChe,0);";
$result = $conn->query($sql);

/* Nếu là món không pha chế thì thêm vào kho */
if ($khongPhaChe == 1) {
	$thoiGian = date('Y-m-d H:i:s');
	$maMon = 0;
	// Lấy mã món vừa mới thêm
	$sql = "SELECT MAX(`Ma_Mon`) as `Ma_Mon` FROM `mon_an`;";
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$maMon = $row['Ma_Mon'];
	}
	
	$sql = "INSERT INTO `luu_kho`(`Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES ($maMon,'$thoiGian',0);";
	
	$result = $conn->query($sql);
}

echo "<div class='alert alert-success'>Đã thêm $tenMon thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>