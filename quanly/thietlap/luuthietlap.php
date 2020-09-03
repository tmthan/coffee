<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

/* Xử lý việc tải ảnh lên */
$tenDonVi = $_POST['tendonvi'];
$diaChi = $_POST['diachi'];
$khoGiay = $_POST['khogiay'];
$coChu = $_POST['cochu'];
$phuThu = $_POST['phuthu'];
$lyDoPhuThu = $_POST['lydophuthu'];
$giamGia = $_POST['giamgia'];

if (!empty($_FILES['logo']['tmp_name'])) {
	$target_dir = "../../include/logo/";	// đường dẫn chứa ảnh
	$target_file = $target_dir . basename($_FILES["logo"]["name"]);
	$tenLogo = $_FILES["logo"]["name"];
	move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file); //upload file
	$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$tenLogo' WHERE `Ma_Thiet_Lap` = 'Logo';";
	$result = $conn->query($sql);
}

$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$tenDonVi' WHERE `Ma_Thiet_Lap` = 'Ten_Don_Vi';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$diaChi' WHERE `Ma_Thiet_Lap` = 'Dia_Chi';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$khoGiay' WHERE `Ma_Thiet_Lap` = 'Kho_Giay';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$coChu' WHERE `Ma_Thiet_Lap` = 'Co_Chu';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$phuThu' WHERE `Ma_Thiet_Lap` = 'Phu_Thu';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$lyDoPhuThu' WHERE `Ma_Thiet_Lap` = 'Ly_Do_Phu_Thu';";
$result = $conn->query($sql);
$sql = "UPDATE `thiet_lap` SET `Noi_Dung`='$giamGia' WHERE `Ma_Thiet_Lap` = 'Giam_Gia';";
$result = $conn->query($sql);
echo "<div class='alert alert-success'>Đã lưu thiết lập</div>";
mysqli_close($conn);			// Dong ket noi
?>