<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$maHang = $_GET['mahang'];


// Lấy thông tin số lượng hiện tại
$sql = "SELECT `luu_kho_hang`.`Ma_Luu_Kho`, `hang_hoa`.`Ten_Hang`, `luu_kho_hang`.`So_Luong`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `luu_kho_hang`, `don_vi_tinh` WHERE `hang_hoa`.`don_vi_tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `luu_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang` AND `luu_kho_hang`.`Ma_Hang` = '$maHang' ORDER BY `luu_kho_hang`.`Ma_Luu_Kho` DESC LIMIT 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {	
	$tenHang = $row['Ten_Hang'];	
	$soLuong = $row['So_Luong'];	
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
}

 ?>
<div class="row margin-5">
	<div class="col-xs-3">
		Tên hàng hóa:
	</div>
	<div class="col-xs-6">
		<b><?php echo "$tenHang"; ?></b>
	</div>	
</div>
<div class="row margin-5">
	<div class="col-xs-3">
		Số lượng hiện tại:
	</div>
	<div class="col-xs-6">
		<b><?php echo "$soLuong $tenDonViTinh"; ?></b>
	</div>	
</div>
<div class="row margin-5">
	<div class="col-xs-3">
		Đặt lại số lượng:
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			<input type="number" name="soluongthaydoi" id="soluongthaydoi" min="0" class="form-control" value="<?php echo($soLuong); ?>">
		</div>
	</div>
</div>
<div class="row margin-5">
	<div class="col-xs-6 col-xs-offset-3">
		<button class="btn btn-success" id="nutthaydoisoluong">
			Cập nhật
		</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#nutthaydoisoluong').click(function(){			
			var maHang = "<?php echo($maHang); ?>";
			var soLuong = $("#soluongthaydoi").val();
			
			$.ajax({
			    url: 'thungan/luukhohang/thaydoisoluong-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					mahang: maHang,
					soluong: soLuong,
				 }, success: function (data) {
					$('#thongbao').html(data);
					$('#danhsachhanghoa').load('thungan/luukhohang/load-kho.php'); 
				 	$('#nutthaydoisoluong').hide();
				   	setTimeout(function(){
				   	// sau 5 giay thi hien lai
				   	$('#thongbao').html('');
				   	$('#nutthaydoisoluong').show();
				   }, 5000);
				   
				}
			});   
		})
	})
</script>
<?php 
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>