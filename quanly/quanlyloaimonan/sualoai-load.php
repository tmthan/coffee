<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoai = locSo($_POST['maloai']);
$tenLoai = $_POST['tenloai'];

$sql = "UPDATE `loai_mon_an` SET `Ten_Loai`='$tenLoai' WHERE `Ma_Loai` = $maLoai;";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã cập nhật $tenLoai thành công!</div>";
mysqli_close($conn);			// Dong ket noi
?>