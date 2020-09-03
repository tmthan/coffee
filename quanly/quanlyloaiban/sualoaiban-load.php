<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoaiBan = locSo($_POST['maloaiban']);
$tenLoaiBan = $_POST['tenloaiban'];
$phuThu = $_POST['phuthu'];

$sql = "UPDATE `loai_ban` SET `Ten_Loai_Ban`='$tenLoaiBan',`Phu_Thu`=$phuThu WHERE `Ma_Loai_Ban`=$maLoaiBan;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã cập nhật $tenLoaiBan thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>