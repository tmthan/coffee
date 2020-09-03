<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maMon = locSo($_POST['mamon']);
$tenMon = $_POST['tenmon'];
$stt = locSo($_POST['stt']);
$maLoai = locSo($_POST['maloai']);
$gia = locSo($_POST['gia']);
$khongPhaChe = locSo($_POST['khongphache']);

if ($khongPhaChe == 0) {
	$sql = "UPDATE `mon_an` SET `Ma_Loai`= $maLoai,`Ten_Mon`= '$tenMon', `STT` = $stt, `Gia`= $gia, `Khong_Pha_Che`='$khongPhaChe' WHERE `Ma_Mon` = $maMon;";
	$result = $conn->query($sql);
} else {
	// Nếu cập nhật thành không pha chế thì phải kiểm tra xem trong kho có không
	// Nếu không có trong kho thì phải thêm vào kho với số lượng = 0
	$sql = "SELECT * FROM `luu_kho` WHERE `Ma_Mon` = '$maMon';";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
		$thoiGian = date('Y-m-d H:i:s');
		$sql2 = "INSERT INTO `luu_kho`(`Ma_Luu_Kho`, `Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES (NULL,'$maMon','$thoiGian','0');";
		$result2 = $conn->query($sql2);
	}
	$sql = "UPDATE `mon_an` SET `Ma_Loai`= $maLoai,`Ten_Mon`= '$tenMon', `STT` = $stt, `Gia`= $gia, `Khong_Pha_Che`='$khongPhaChe' WHERE `Ma_Mon` = $maMon;";
	$result = $conn->query($sql);
}
echo "<div class='alert alert-success'>Đã cập nhật $tenMon thành công!</div>";
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);
?>