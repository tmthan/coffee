<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$nguyenLieu = $_POST['nguyenlieu'];
$soLuongNguyenLieu = $_POST['soluongnguyenlieu'];
$thanhPham = $_POST['thanhpham'];

$loaiThanhPham = $_POST['loaithanhpham'];
$tyLeNguyenLieu = $_POST['tylenguyenlieu'];
$tyLeThanhPham = $_POST['tylethanhpham'];
$thoiGian = date('Y-m-d H:i:s');

$tenDangNhap = $_SESSION['tendangnhap'];

// Tìm số lượng nguyên liệu ban đầu
$sql = "SELECT `So_Luong` FROM `luu_kho_hang` WHERE `Ma_Hang` = $nguyenLieu ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$soLuongNguyenLieuBanDau = $row['So_Luong'];
}

if (is_int($soLuongNguyenLieu / $tyLeNguyenLieu * $tyLeThanhPham) && $soLuongNguyenLieuBanDau >= $soLuongNguyenLieu) {
	// Tỷ lệ hợp lý thì mới cho chuyển đổi
	// tính số nguyên liệu còn lại
	
	$soLuongNguyenLieuConLai = $soLuongNguyenLieuBanDau - $soLuongNguyenLieu;
	// Tính số lượng thành phẩm
	$soLuongThanhPham = $soLuongNguyenLieu / $tyLeNguyenLieu * $tyLeThanhPham;

	if ($loaiThanhPham == "monan") {
		// tính số thành phẩm
		$sql = "SELECT `So_Luong` FROM `luu_kho` WHERE `Ma_Mon` = $thanhPham ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$soLuongThanhPhamBanDau = $row['So_Luong'];
		}
		$soLuongThanhPhamMoi = $soLuongThanhPhamBanDau + $soLuongThanhPham;

		// Cập nhật lại số lượng nguyên liệu (hàng hóa) trong kho
		$sql = "INSERT INTO `luu_kho_hang`(`Ma_Hang`, `Thoi_Gian`, `So_Luong`) VALUES ($nguyenLieu,'$thoiGian',$soLuongNguyenLieuConLai);";
		$result = $conn->query($sql);

		// Cập nhật lại số lượng thành phẩm (Món ăn) trong kho
		$sql = "INSERT INTO `luu_kho`(`Ma_Mon`, `Thoi_Gian`, `So_Luong`) VALUES ($thanhPham,'$thoiGian',$soLuongThanhPhamMoi);";
		$result = $conn->query($sql);

		// Cập nhật lịch sử xuất kho (Lấy nguyên liệu ra)
		$sql = "INSERT INTO `lich_su_nhap_kho_hang`(`Thoi_Gian`, `Ma_Hang`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES ('$thoiGian', $nguyenLieu, $soLuongNguyenLieuBanDau, $soLuongNguyenLieuConLai, '$tenDangNhap');";
		$result = $conn->query($sql);

		// Cập nhật lịch sử nhập kho đồ uống (Thêm thành phẩm vào)
		$sql = "INSERT INTO `lich_su_nhap_kho`(`Thoi_Gian`, `Ma_Mon`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES ('$thoiGian', '$thanhPham', $soLuongThanhPhamBanDau, $soLuongThanhPhamMoi, '$tenDangNhap');";
		$result = $conn->query($sql);
		
	} else if ($loaiThanhPham == "hanghoa") {
		// Tìm số lượng thành phẩm còn lại
		$sql = "SELECT `So_Luong` FROM `luu_kho_hang` WHERE `Ma_Hang` = $thanhPham ORDER BY `Ma_Luu_Kho` DESC LIMIT 1;";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$soLuongThanhPhamBanDau = $row['So_Luong'];		
		}
		$soLuongThanhPhamMoi = $soLuongThanhPhamBanDau + $soLuongThanhPham;

		// Cập nhật lại số lượng nguyên liệu (hàng hóa) trong kho
		$sql = "INSERT INTO `luu_kho_hang`(`Ma_Hang`, `Thoi_Gian`, `So_Luong`) VALUES ($nguyenLieu,'$thoiGian',$soLuongNguyenLieuConLai);";
		
		$result = $conn->query($sql);

		// Cập nhật lại số lượng thành phẩm (hàng hóa) trong kho
		$sql = "INSERT INTO `luu_kho_hang`(`Ma_Hang`, `Thoi_Gian`, `So_Luong`) VALUES ($thanhPham,'$thoiGian',$soLuongThanhPhamMoi);";
		$result = $conn->query($sql);

		// Cập nhật lịch sử xuất kho (Lấy nguyên liệu ra)
		$sql = "INSERT INTO `lich_su_nhap_kho_hang`(`Thoi_Gian`, `Ma_Hang`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES ('$thoiGian', $nguyenLieu, $soLuongNguyenLieuBanDau, $soLuongNguyenLieuConLai, '$tenDangNhap');";
		$result = $conn->query($sql);

		// Cập nhật lịch sử nhập kho (thêm thành phẩm vào kho)
		$sql = "INSERT INTO `lich_su_nhap_kho_hang`(`Thoi_Gian`, `Ma_Hang`, `So_Luong_Cu`, `So_Luong_Moi`, `Nguoi_Nhap`) VALUES ('$thoiGian', $thanhPham, $soLuongThanhPhamBanDau, $soLuongThanhPhamMoi, '$tenDangNhap');";
		$result = $conn->query($sql);

	}
	/* Lưu lịch sử chuyển đổi */
	$sql = "INSERT INTO `lich_su_chuyen_doi`(`Thoi_Gian`, `Ma_Nguyen_Lieu`, `Ma_Thanh_Pham`, `Loai_Thanh_Pham`, `Ty_Le_Nguyen_Lieu`, `Ty_Le_Thanh_Pham`, `So_Luong_Nguyen_Lieu`, `So_Luong_Thanh_Pham`, `Nguoi_Chuyen_Doi`) VALUES ('$thoiGian', $nguyenLieu, $thanhPham, '$loaiThanhPham', $tyLeNguyenLieu, $tyLeThanhPham, $soLuongNguyenLieu, $soLuongThanhPham, '$tenDangNhap');";
	$result = $conn->query($sql);
	echo "<div class='alert alert-success'>Chuyển đổi hàng hóa thành công</div>";
} else if ($soLuongNguyenLieuBanDau < $soLuongNguyenLieu) {
	echo "<div class='alert alert-danger'>Không đủ nguyên liệu trong kho để chuyển đổi</div>";
} else {
	echo "<div class='alert alert-danger'>Số lượng nguyên liệu phải chia hết cho tỷ lệ nguyên liệu</div>";
}
mysqli_close($conn);
?>