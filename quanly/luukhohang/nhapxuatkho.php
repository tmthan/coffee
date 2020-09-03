<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$maHang = $_GET['mahang'];
// Lấy thông tin số lượng hiện tại
$sql = "SELECT `luu_kho_hang`.`Ma_Luu_Kho`, `hang_hoa`.`Ten_Hang`, `luu_kho_hang`.`So_Luong`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `luu_kho_hang`, `don_vi_tinh` WHERE `luu_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang` AND `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `luu_kho_hang`.`Ma_Hang` = '$maHang' ORDER BY `luu_kho_hang`.`Ma_Luu_Kho` DESC LIMIT 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {	
	$tenHang = $row['Ten_Hang'];	
	$soLuong = $row['So_Luong'];	
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
}

 ?>
<div id="thongbao<?php echo($maHang); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		<label>
			Tên hàng hóa:
		</label>
	</div>
	<div class="col-xs-8">
		<label>
			<b><?php echo "$tenHang"; ?></b>
		</label>
	</div>	
</div>
<div class="row">
	<div class="col-xs-4">
		<label>
			Số lượng hiện tại:
		</label>
	</div>
	<div class="col-xs-8">
		<label>
			<b><?php echo "$soLuong $tenDonViTinh"; ?></b>
		</label>
	</div>	
</div>
<div class="row">
	<div class="col-xs-4">
		<label>
			SL nhập/xuất/thay đổi:
		</label>
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<div class="form-line">
				<input type="number" name="soluongnhapxuat" id="soluongnhapxuat<?php echo($maHang); ?>" min="0" class="form-control" value="0">
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="nutnhap<?php echo($maHang); ?>">
			Nhập kho
		</button>
		<button class="btn btn-warning" id="nutxuat<?php echo($maHang); ?>">Xuất kho</button>
		<button class="btn btn-primary" id="nutthaydoi<?php echo($maHang); ?>">Thay đổi số lượng</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal" id="dong<?php  echo($maHang); ?>">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#nutnhap<?php echo($maHang); ?>').click(function(){			
			var maHang = "<?php echo($maHang); ?>";
			var soLuong = parseInt($("#soluongnhapxuat<?php echo($maHang); ?>").val());				
			$.ajax({
			    url: 'quanly/luukhohang/nhapkho-load.php',
				type: 'POST',
		        dataType: 'text',
		        data: {
					mahang: maHang,
					soluong: soLuong,
				 }, success: function (data) {
					$('#thongbao<?php echo($maHang); ?>').html(data);
					$("#nutnhap<?php echo($maHang); ?>").hide();
					$("#nutxuat<?php echo($maHang); ?>").hide();
					$("#nutthaydoi<?php echo($maHang); ?>").hide();							
				}
			});   
		});
		$('#nutxuat<?php echo($maHang); ?>').click(function(){			
			var maHang = "<?php echo($maHang); ?>";
			var soLuong = $("#soluongnhapxuat<?php echo($maHang); ?>").val();
			
			$.ajax({
			    url: 'quanly/luukhohang/xuatkho-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					mahang: maHang,
					soluong: soLuong,
				 }, success: function (data) {
					$('#thongbao<?php echo($maHang); ?>').html(data);
					$("#nutnhap<?php echo($maHang); ?>").hide();
					$("#nutxuat<?php echo($maHang); ?>").hide();
					$("#nutthaydoi<?php echo($maHang); ?>").hide();
				}
			});   
		});
		$('#nutthaydoi<?php echo($maHang); ?>').click(function(){			
			var maHang = "<?php echo($maHang); ?>";
			var soLuong = $("#soluongnhapxuat<?php echo($maHang); ?>").val();
			
			$.ajax({
			    url: 'quanly/luukhohang/thaydoisoluong-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					mahang: maHang,
					soluong: soLuong,
				 }, success: function (data) {
					$('#thongbao<?php echo($maHang); ?>').html(data);	
					$("#nutnhap<?php echo($maHang); ?>").hide();
					$("#nutxuat<?php echo($maHang); ?>").hide();
					$("#nutthaydoi<?php echo($maHang); ?>").hide();	
				}
			});   
		});
		$('#dong<?php echo($maHang); ?>').click(function(){
			setTimeout(function(){
				$('#danhsachhanghoa').load('quanly/luukhohang/load-kho.php'); 
			}, 500);
		});
	});
</script>
<?php 
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>