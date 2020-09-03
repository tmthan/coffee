<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$thoiGianBatDau = coverDateToUS($_GET['thoigianbatdau']);
$thoiGianKetThuc = coverDateToUS($_GET['thoigianketthuc']);

/* lay tong tien va so luong hoa don */
$sql = "SELECT SUM(`Thanh_Tien`) as tongtien, COUNT(`Ma_Hoa_Don`) as soluonghoadon FROM `hoa_don` WHERE `Thoi_Gian_Ket_Thuc` >= '$thoiGianBatDau 00:00:00' AND `Thoi_Gian_Ket_Thuc` <= '$thoiGianKetThuc 23:59:59' AND `hoa_don`.`Trang_Thai_Thanh_Toan` = 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$tongTien = $row['tongtien'];
	$soLuongHoaDon = $row['soluonghoadon'];
}
?>
<div class="row">
	<div class="col-xs-6">
		<div class="info-box">
			<div class="icon">
				<i class='fas fa-dollar-sign'></i>
			</div><!-- icon -->
			<div class="content">
				<div class="text">
					Tổng tiền
				</div><!-- text -->
				<div class="number">
					<?php echo(number_format($tongTien)); ?>
				</div><!-- number -->
			</div><!-- content -->
		</div><!-- info-box -->	
	</div><!-- col-6 -->
	<div class="col-xs-6">
		<div class="info-box">
			<div class="icon">
				<i class="fas fa-file-invoice-dollar"></i>
			</div><!-- icon -->
			<div class="content">
				<div class="text">
					SL hóa đơn
				</div><!-- text -->
				<div class="number">
					<?php echo(number_format($soLuongHoaDon)); ?>
				</div><!-- number -->
			</div><!-- content -->
		</div><!-- info-box -->	
	</div><!-- col-6 -->
</div><!-- row -->
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
			</div><!-- header -->
			<div class="body">
<?php
echo '<div class="bang">
	<table class="table">
		<thead>
			<tr class="bg-blue">
				<th>
					Mã
				</th>
				<th>
					Bàn
				</th>
				<th>
					NV phục vụ
				</th>
				<th>
					TG bắt đầu
				</th>
				<th>
					TG kết thúc
				</th>
				<th>
					Tiền
				</th>
				<th>
					Chi tiết
				</th>
			</tr>
		</thead>
		<tbody>
';
$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `ban`.`Ten_Ban`, `ho_so`.`Ho_Ten`, `hoa_don`.`Thoi_Gian_Bat_Dau`, `hoa_don`.`Thoi_Gian_Ket_Thuc`, `hoa_don`.`Thanh_Tien` FROM `ho_so`, `hoa_don`, `ban` WHERE `hoa_don`.`Ma_Ban` = `ban`.`Ma_Ban` AND `hoa_don`.`Ten_Dang_Nhap` = `ho_so`.`Ten_Dang_Nhap` AND `hoa_don`.`Thoi_Gian_Ket_Thuc` >= '$thoiGianBatDau 00:00:00' AND `hoa_don`.`Thoi_Gian_Ket_Thuc` <= '$thoiGianKetThuc 23:59:59' ORDER BY `hoa_don`.`Ma_Hoa_Don`;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$maHoaDon = $row['Ma_Hoa_Don'];
	$tenBan = $row['Ten_Ban'];
	$nhanVienPhucVu = $row['Ho_Ten'];
	$thoiGianBatDau = substr( $row['Thoi_Gian_Bat_Dau'], 10, 6) . "&nbsp" . substr( $row['Thoi_Gian_Bat_Dau'], 8, 2) . "/" . substr( $row['Thoi_Gian_Bat_Dau'], 5, 2) . "/" . substr( $row['Thoi_Gian_Bat_Dau'], 0, 4);
	$thoiGianKetThuc = substr( $row['Thoi_Gian_Ket_Thuc'], 10, 6) . "&nbsp" . substr( $row['Thoi_Gian_Ket_Thuc'], 8, 2) . "/" . substr( $row['Thoi_Gian_Ket_Thuc'], 5, 2) . "/" . substr( $row['Thoi_Gian_Ket_Thuc'], 0, 4);
	$tien = $row['Thanh_Tien'];
	echo "<tr>
			<td title='Mã hóa đơn'>$maHoaDon</td>
			<td title='Tên bàn'>$tenBan</td>
			<td title='Nhân viên phục vụ'>$nhanVienPhucVu</td>
			<td title='Thời gian bắt đầu'>$thoiGianBatDau</td>
			<td title='Thời gian kết thúc'>$thoiGianKetThuc</td>
			<td title='Tiền thanh toán' class='text-right'>"; echo(number_format($tien)); echo "</td>
			<td>
				<a href='phucvu/inhoadon.php?mahoadon=$maHoaDon' target='_blank'>Chi tiết</a>
			</td>
		</tr>";
}
echo "</tbody></table></div><!--bang-->";
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>				
			</div><!-- body -->
		</div><!-- card -->
</div>	<!-- row -->
