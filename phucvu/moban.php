<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$tenDangNhap = $_SESSION['tendangnhap'];
$maBan = locSo($_POST['maban']);
$thoiGianBatDau = date('Y-m-d H:i:s');

/* Đầu tiên, kiểm tra xem bàn đó có hóa đơn nào có trạng thái thanh toán == -1 không
*  Nếu có thì tiếp tục sử dụng hóa đơn đó
*  Nếu không có thì tạo hóa đơn mới
*/

// Kiểm tra trạng thái của hóa đơn
$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `hoa_don`.`Trang_Thai_Thanh_Toan` FROM `hoa_don`, `ban` WHERE `hoa_don`.`Ma_Ban` = $maBan ORDER BY `Ma_Hoa_Don` DESC LIMIT 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maHoaDon = $row['Ma_Hoa_Don'];
	$trangThaiThanhToan = $row['Trang_Thai_Thanh_Toan'];
}

if ($trangThaiThanhToan == "-1") {
	// Cập nhật lại trạng thái thanh toán của hóa đơn tương ứng với bàn
	$sql = "UPDATE `hoa_don` SET `Ten_Dang_Nhap`='$tenDangNhap', `Thoi_Gian_Bat_Dau`='$thoiGianBatDau',`Thoi_Gian_Ket_Thuc`=NULL,`Trang_Thai_Thanh_Toan`=0,`Tong_Tien`=0,`Phu_Thu`=0,`Ly_Do_Phu_Thu`=NULL,`Phu_Thu_Tat_Ca`=0,`Ly_Do_Phu_Thu_Tat_Ca`=NULL,`Giam_Gia`=0,`Giam_Gia_Tat_Ca`=0,`Thanh_Tien`=0,`Khach_Tra`=0,`Tien_Thua`=0,`Thu_Ngan`=NULL WHERE `Ma_Hoa_Don` = $maHoaDon;";
	$result = $conn->query($sql);
	// Cập nhật lại tráng thái bàn về bàn đang phục vụ
	$sql = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 1 WHERE `Ma_Ban` = $maBan;";
	$result = $conn->query($sql);
} else {
	// Them hoa don
	$sql1 = "INSERT INTO `hoa_don`(`Ma_Hoa_Don`, `Ten_Dang_Nhap`, `Ma_Ban`, `Thoi_Gian_Bat_Dau`, `Thoi_Gian_Ket_Thuc`, `Trang_Thai_Thanh_Toan`, `Tong_Tien`, `Phu_Thu`, `Ly_Do_Phu_Thu`, `Phu_Thu_Tat_Ca`, `Ly_Do_Phu_Thu_Tat_Ca`, `Giam_Gia`, `Giam_Gia_Tat_Ca`, `Thanh_Tien`, `Khach_Tra`, `Tien_Thua`, `Thu_Ngan`) VALUES (NULL ,'$tenDangNhap', $maBan, '$thoiGianBatDau', NULL, 0, 0, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, NULL);";
	echo "$sql1";
	// cap nhat trang thai ban
	$sql2 = "UPDATE `ban` SET `Trang_Thai_Phuc_Vu`= 1 WHERE `Ma_Ban` = $maBan;";

	$result = $conn->query($sql1);
	$result = $conn->query($sql2);
mysqli_close($conn);
}
?>