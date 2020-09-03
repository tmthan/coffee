<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$thoiGianBatDau = coverDateToUS($_GET['thoigianbatdau']);
$thoiGianKetThuc = coverDateToUS($_GET['thoigianketthuc']);


?>

<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h2>
<?php 
echo "Từ ngày: ";
echo(coverDateToVN($thoiGianBatDau));
echo " đến ngày: ";
echo(coverDateToVN($thoiGianKetThuc));
 ?>
				</h2>
			</div>
			<div class="body">
				<div class="bang">
					<table class="table">
						<thead>
							<tr class="bg-blue">
								<th>
									Thời gian
								</th>
								<th>
									Nguyên liệu
								</th>
								<th>
									Tỷ lệ
								</th>
								<th>
									Thành phẩm
								</th>
								<th>
									Loại chuyển đổi
								</th>
								<th>
									Người thực hiện
								</th>
							</tr>
						</thead>
						<tbody>
<?php

	// lấy lịch sử chuyển đổi hàng hóa, chưa xác định được tên thành phẩm
$sql = "SELECT `lich_su_chuyen_doi`.`Thoi_Gian`, `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh`, `lich_su_chuyen_doi`.`So_Luong_Nguyen_Lieu`, `lich_su_chuyen_doi`.`Ty_Le_Nguyen_Lieu`, `lich_su_chuyen_doi`.`Ty_Le_Thanh_Pham`, `lich_su_chuyen_doi`.`Ma_Thanh_Pham`, `lich_su_chuyen_doi`.`So_Luong_Thanh_Pham`, `lich_su_chuyen_doi`.`Loai_Thanh_Pham`, `ho_so`.`Ho_Ten` FROM `lich_su_chuyen_doi` LEFT JOIN `hang_hoa` ON `lich_su_chuyen_doi`.`Ma_Nguyen_Lieu` = `hang_hoa`.`Ma_Hang` LEFT JOIN `don_vi_tinh` ON `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` LEFT JOIN `ho_so` ON `lich_su_chuyen_doi`.`Nguoi_Chuyen_Doi` = `ho_so`.`Ten_Dang_Nhap` WHERE `lich_su_chuyen_doi`.`Thoi_Gian` >= '$thoiGianBatDau 00:00:00' AND `lich_su_chuyen_doi`.`Thoi_Gian` <= '$thoiGianKetThuc 23:59:59';";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$thoiGian =  substr( $row['Thoi_Gian'], 10, 6) . "&nbsp" . substr( $row['Thoi_Gian'], 8, 2) . "/" . substr( $row['Thoi_Gian'], 5, 2) . "/" . substr( $row['Thoi_Gian'], 0, 4);	
	$tenNguyenLieu = $row['Ten_Hang'] . " (" . $row['Ten_Don_Vi_Tinh'] . ")";	
	$soLuongNguyenLieu = $row['So_Luong_Nguyen_Lieu'];
	$tyLeNguyenLieu = $row['Ty_Le_Nguyen_Lieu'];
	$tyLeThanhPham = $row['Ty_Le_Thanh_Pham'];
	$maThanhPham = $row['Ma_Thanh_Pham']; // Chưa xác định được tên thành phẩm
	$soLuongThanhPham = $row['So_Luong_Thanh_Pham'];
	$loaiThanhPham = $row['Loai_Thanh_Pham'];
	$nguoithuchien = $row['Ho_Ten'];

	// Tìm được mã thành phẩm và loại thành phẩm rồi, bắt đầu tìm tên thành phẩm tương ứng
	// với hanghoa: tìm trong hàng hóa
	// với monan: tìm trong món ăn

	if ($loaiThanhPham == "hanghoa") {
		$tenLoaiChuyenDoi = "Hàng hóa > Hàng hóa";
		$sql2 = "SELECT `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa` LEFT JOIN `don_vi_tinh` ON `don_vi_tinh`.`Ma_Don_Vi_Tinh` = `hang_hoa`.`Don_Vi_Tinh` WHERE `hang_hoa`.`Ma_Hang` =$maThanhPham;";
		$result2 = $conn->query($sql2);
		while ($row = $result2->fetch_assoc()) {
			$tenThanhPham = $row['Ten_Hang'] . " (" . $row['Ten_Don_Vi_Tinh'] . ")";
		}
	} else if ($loaiThanhPham == "monan"){
		$tenLoaiChuyenDoi = "Hàng hóa > Đồ uống";
		$sql2 = "SELECT `Ten_Mon` FROM `mon_an` WHERE `Ma_Mon` = $maThanhPham;";
		$result2 = $conn->query($sql2);
		while ($row = $result2->fetch_assoc()) {
			$tenThanhPham = $row['Ten_Mon'];
		}
	}

	echo "<tr>		
		<td>$thoiGian</td>
		<td class='text-center'>$tenNguyenLieu <br> $soLuongNguyenLieu</td>
		<td class='text-center'>$tyLeNguyenLieu = $tyLeThanhPham</td>
		<td class='text-center'>$tenThanhPham <br> $soLuongThanhPham</td>
		<td>$tenLoaiChuyenDoi</td>
		<td>$nguoithuchien</td>		
	</td>";
}
?>
						</tbody>
					</table>
				</div><!-- bang -->
			</div>
		</div>
	</div>
</div>


<?php

if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);			// Dong ket noi
?>	
</div>	<!-- row -->
