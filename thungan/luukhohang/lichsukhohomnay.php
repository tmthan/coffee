<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}
$ngay = date('Y-m-d');	// lay ngay thang hom nay

?>


<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header">
				<h2>
					<?php echo "Hôm nay: " . substr( $ngay, 8, 2) . "/" . substr( $ngay, 5, 2) . "/" . substr( $ngay, 0, 4); ?>
				</h2>
			</div>
			<div class="body">
				<div class="bang">
					<table class="table table-bordered">
						<thead>
							<tr class="bg-blue">
								<th>
									Thời gian
								</th>
								<th>
									Tên hàng hóa
								</th>
								<th>
									Đơn vị tính
								</th>
								<th>
									SL cũ
								</th>
								<th>
									SL mới
								</th>	
								<th>
									Thay đổi
								</th>						
								<th>
									Người thực hiện
								</th>
							</tr>
						</thead>
						<tbody>
<?php

	// lấy lịch sử nhập kho hàng hóa
$sql = "SELECT `lich_su_nhap_kho_hang`.`Ma_Lich_Su_Nhap_Kho`, `lich_su_nhap_kho_hang`.`Thoi_Gian`, `hang_hoa`.`Ten_Hang`, `lich_su_nhap_kho_hang`.`So_Luong_Cu`, `lich_su_nhap_kho_hang`.`So_Luong_Moi`, `ho_so`.`Ho_Ten`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `lich_su_nhap_kho_hang` LEFT JOIN `hang_hoa` ON `lich_su_nhap_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang` LEFT JOIN `don_vi_tinh` ON `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` LEFT JOIN `ho_so` ON `lich_su_nhap_kho_hang`.`Nguoi_Nhap` = `ho_so`.`Ten_Dang_Nhap` WHERE `lich_su_nhap_kho_hang`.`Thoi_Gian` >= '$ngay 00:00:00' AND `lich_su_nhap_kho_hang`.`Thoi_Gian` <='$ngay 23:59:59' ORDER BY `lich_su_nhap_kho_hang`.`Thoi_Gian`;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$thoiGian =  substr( $row['Thoi_Gian'], 10, 6) . "&nbsp" . substr( $row['Thoi_Gian'], 8, 2) . "/" . substr( $row['Thoi_Gian'], 5, 2) . "/" . substr( $row['Thoi_Gian'], 0, 4);
	$tenHang = $row['Ten_Hang'];
	$soLuongCu = $row['So_Luong_Cu'];
	$soLuongMoi = $row['So_Luong_Moi'];
	$soLuongNhap = $soLuongMoi - $soLuongCu;
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
	$nguoiNhap = $row['Ho_Ten'];	
	
	echo "<tr>		
		<td title='Thời gian'>$thoiGian</td>
		<td title='Tên hàng hóa'>$tenHang</td>
		<td class='text-center' title='Đơn vị tính'>$tenDonViTinh</td>
		<td class='text-center' title='Số lượng cũ'>$soLuongCu</td>";	
	echo "<td class='text-center' title='Số lượng mới'>$soLuongMoi</td>
		<td title='Thay đổi'>$soLuongNhap</td>
		<td title='Người thực hiện'>$nguoiNhap</td>
	</tr>";
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
mysqli_close($conn);
?>
	
</div>	<!-- row -->

