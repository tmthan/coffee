<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maBan = locSo($_POST['maban']);
$tenBan = $_POST['tenban'];
$soChoNgoi = locSo($_POST['sochongoi']);
$khuVuc = locSo($_POST['khuvuc']);
$loaiBan = locSo($_POST['loaiban']);

$sql = "UPDATE `ban` SET `Ten_Ban`= '$tenBan',`So_Cho_Ngoi`= $soChoNgoi, `Ma_Khu_Vuc`=$khuVuc,`Ma_Loai_Ban`=$loaiBan WHERE `Ma_Ban` = $maBan;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã cập nhật $tenBan thành công!</div>";

mysqli_close($conn);			// Dong ket noi
?>