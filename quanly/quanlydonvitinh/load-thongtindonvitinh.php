<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maDonViTinh = locSo($_GET['madonvitinh']);
$sql = "SELECT `Ten_Don_Vi_Tinh` FROM `don_vi_tinh` WHERE `Ma_Don_Vi_Tinh`=$maDonViTinh;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];	
}
?>
<div id="thongbao<?php echo($maDonViTinh); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		Tên đơn vị tính:
	</div>
	<div class="col-xs-8">
		<div class="form-group">			
			<input type="text" name="tenmon" id="tendonvitinhsua<?php echo($maDonViTinh); ?>" class="form-control" value="<?php echo($tenDonViTinh); ?>">			
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhatdonvitinh<?php echo($maDonViTinh); ?>">
			Cập nhật	
		</button>
		<button class="btn btn-danger" id="xoadonvitinh<?php echo($maDonViTinh); ?>">
			Xóa
		</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($maDonViTinh); ?>">Đóng</button>
	</div>	
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhatdonvitinh<?php echo($maDonViTinh); ?>').click(function(){
			var maDonViTinh = <?php echo $maDonViTinh; ?>;
			var tenDonViTinh = $('#tendonvitinhsua<?php echo($maDonViTinh); ?>').val();	
			$.ajax({
			    url: 'quanly/quanlydonvitinh/suadonvitinh-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					madonvitinh: maDonViTinh,
					tendonvitinh: tenDonViTinh
				 }, success: function (data) {
					$('#thongbao<?php echo($maDonViTinh); ?>').html(data);
					$('#xoadonvitinh<?php echo($maDonViTinh); ?>').hide();				   	
				 	$('#capnhatdonvitinh<?php echo($maDonViTinh); ?>').hide();
				   	
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoadonvitinh<?php echo($maDonViTinh); ?>').click(function(){
			var maDonViTinh = <?php echo $maDonViTinh; ?>;
			$.ajax({
			    url: 'quanly/quanlydonvitinh/xoadonvitinh-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					madonvitinh: maDonViTinh
				 }, success: function (data) {
					$('#thongbao<?php echo($maDonViTinh); ?>').html(data);
					$('#capnhatdonvitinh<?php echo($maDonViTinh); ?>').hide();
				 	$('#xoadonvitinh<?php echo($maDonViTinh); ?>').hide();				   	
				}
			});   
		});

		$("#dong<?php echo($maDonViTinh); ?>").click(function(){
			setTimeout(function(){
			  	$('#danhsachdonvitinh').load('quanly/quanlydonvitinh/load-donvitinh.php');
			}, 500);
		});
	})
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>