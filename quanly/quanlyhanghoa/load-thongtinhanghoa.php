<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maHang = locSo($_GET['mahang']);
$sql = "SELECT * FROM `hang_hoa` WHERE `Ma_Hang`=$maHang;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenHang = $row['Ten_Hang'];
	$maDonViTinh = $row['Don_Vi_Tinh'];
}
?>
<div id="thongbao<?php echo($maHang); ?>"></div>
<div class="row">	
	<div class="col-xs-4">
		Tên hàng hóa:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenhang" id="tenhangsua<?php echo($maHang); ?>" class="form-control" value="<?php echo($tenHang); ?>">
		</div>
	</div>	
</div>
<div class="row">	
	<div class="col-xs-4">
		Đơn vị tính:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select class="form-control" id="madonvitinhsua<?php echo($maHang); ?>">
	<?php
	// lay danh sach don vi tinh
	$sql2 = "SELECT `Ma_Don_Vi_Tinh`, `Ten_Don_Vi_Tinh` FROM `don_vi_tinh` WHERE `Xoa`=0;";
	$result2 = $conn->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$maDonViTinh2 = $row2['Ma_Don_Vi_Tinh'];
		$tenDonViTinh2 = $row2['Ten_Don_Vi_Tinh'];
		// hien thi ra option

		echo "<option value='$maDonViTinh2'";
		// kiem tra loai dang duoc su dung
		if ($maDonViTinh == $maDonViTinh2) {
			echo "selected='selected'";
		}
		echo ">$tenDonViTinh2</option>";
	}
	?>			
			</select>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($maHang); ?>">Cập nhật</button>
		<button class="btn btn-danger" id="xoa<?php echo($maHang); ?>">Xóa</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($maHang); ?>">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php echo($maHang); ?>').click(function(){
			var maHang = <?php echo $maHang; ?>;
			var tenHang = $('#tenhangsua<?php echo($maHang); ?>').val();
			var maDonViTinh = $('#madonvitinhsua<?php echo($maHang); ?>').val();
			$.ajax({
			    url: 'quanly/quanlyhanghoa/suahanghoa-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					mahang: maHang,
					tenhang: tenHang,
					madonvitinh: maDonViTinh
				 }, success: function (data) {
					$('#thongbao<?php echo($maHang); ?>').html(data);
					$('#xoa<?php echo($maHang); ?>').hide();				   	
				 	$('#capnhat<?php echo($maHang); ?>').hide();				   	
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php echo($maHang); ?>').click(function(){
			var maHang = <?php echo $maHang; ?>;			
			$.ajax({
			    url: 'quanly/quanlyhanghoa/xoahanghoa-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					mahang: maHang
				 }, success: function (data) {
					$('#thongbao<?php echo($maHang); ?>').html(data);
					$('#capnhat<?php echo($maHang); ?>').hide();				   	
				 	$('#xoa<?php echo($maHang); ?>').hide();				   	
				}
			});   
		});

		// Khi nhấn nút đóng

		$("#dong<?php echo($maHang); ?>").click(function(){
			setTimeout(function(){
			   	$('#danhsachhanghoa').load('quanly/quanlyhanghoa/load-hanghoa.php'); 
			}, 500);
		});
	});
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);			// Dong ket noi
?>