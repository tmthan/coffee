<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$tenLoaiBan = $_POST['tenloaiban'];
$phuThu = $_POST['phuthu'];

$sql = "INSERT INTO `loai_ban`(`Ten_Loai_Ban`, `Phu_Thu`, `Xoa`) VALUES ('$tenLoaiBan',$phuThu,0);";
$result = $conn->query($sql);


echo "<div class='alert alert-success'>Đã thêm $tenLoaiBan thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>