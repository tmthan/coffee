<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once __DIR__.'/../../load.php';

$ngay = date('Y-m-d');	// lay ngay thang hom nay

?>

<div class="row clearfix">
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
									Tên đồ uống
								</th>
								<th class="text-right" style="width: 150px;">
									SL cũ
								</th>							
								<th class="text-right" style="width: 100px;">
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

	// lấy lịch sử nhập kho đồ uống
$sql = "SELECT `lich_su_nhap_kho`.`Ma_Lich_Su_Nhap_Kho`, `lich_su_nhap_kho`.`Thoi_Gian`, `mon_an`.`Ten_Mon`, `lich_su_nhap_kho`.`So_Luong_Cu`, `lich_su_nhap_kho`.`So_Luong_Moi`, `ho_so`.`Ho_Ten` FROM `lich_su_nhap_kho` LEFT JOIN `mon_an` ON `lich_su_nhap_kho`.`Ma_Mon` = `mon_an`.`Ma_Mon` LEFT JOIN `ho_so` ON `lich_su_nhap_kho`.`Nguoi_Nhap` = `ho_so`.`Ten_Dang_Nhap` WHERE `lich_su_nhap_kho`.`Thoi_Gian` >= '$ngay 00:00:00' AND `lich_su_nhap_kho`.`Thoi_Gian` <='$ngay 23:59:59' ORDER BY `lich_su_nhap_kho`.`Thoi_Gian`;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$thoiGian =  substr( $row['Thoi_Gian'], 10, 6) . "&nbsp" . substr( $row['Thoi_Gian'], 8, 2) . "/" . substr( $row['Thoi_Gian'], 5, 2) . "/" . substr( $row['Thoi_Gian'], 0, 4);
	$tenMon = $row['Ten_Mon'];
	$soLuongCu = $row['So_Luong_Cu'];
	$soLuongMoi = $row['So_Luong_Moi'];
	$soLuongNhap = $soLuongMoi - $soLuongCu;
	$nguoiNhap = $row['Ho_Ten'];	
	
	echo "<tr>		
		<td title='Thời gian'>$thoiGian</td>
		<td title='Tên đồ uống'>$tenMon</td>
		<td class='text-center' title='Số lượng cũ'>$soLuongCu</td>";		
		echo "
		<td class='text-center' title='Số lượng mới'>$soLuongMoi</td>
		<td class='text-center' title='Thay đổi'>$soLuongNhap</td>
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
mysqli_close($conn);			// Dong ket noi
?>
	
</div>	<!-- row -->

