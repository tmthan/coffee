<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoaiBan = locSo($_GET['maloaiban']);
$sql = "SELECT `Ten_Loai_Ban`, `Phu_Thu` FROM `loai_ban` WHERE `Ma_Loai_Ban` = $maLoaiBan;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoaiBan = $row['Ten_Loai_Ban'];
	$phuThu = $row['Phu_Thu'];
}
?>
<div id="thongbao<?php echo($maLoaiBan); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		Tên loại bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenloaiban" id="tenloaibansua<?php echo($maLoaiBan); ?>" class="form-control" value="<?php echo($tenLoaiBan); ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Tiền phụ thu:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="phuthu" id="phuthusua<?php echo($maLoaiBan); ?>" class="form-control" value="<?php echo($phuThu); ?>" step="1000" min="0">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($maLoaiBan); ?>">
			Cập nhật	
		</button>
		<button class="btn btn-danger" id="xoa<?php echo($maLoaiBan); ?>">
			Xóa
		</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($maLoaiBan); ?>">Đóng</button>
	</div>	
</div><!-- row -->
<div class="row">
	<div class="col-xs-12">
		<small>
			Tiền phụ thu nhỏ hơn hoặc bằng 100 sẽ tính theo phần trăm, lớn hơn 100 sẽ tính theo số tiền.
		</small>
	</div>
</div><!-- row -->
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php echo($maLoaiBan); ?>').click(function(){
			var maLoaiBan = <?php echo $maLoaiBan; ?>;
			var tenLoaiBan = $('#tenloaibansua<?php echo($maLoaiBan); ?>').val();
			var phuThu = $("#phuthusua<?php echo($maLoaiBan); ?>").val();
			$.ajax({
			    url: 'quanly/quanlyloaiban/sualoaiban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maloaiban: maLoaiBan,
					tenloaiban: tenLoaiBan,
					phuthu: phuThu				
				 }, success: function (data) {
					$('#thongbao<?php echo($maLoaiBan); ?>').html(data);					
				 	$('#capnhat<?php echo($maLoaiBan); ?>').hide();
				 	$('#xoa<?php echo($maLoaiBan); ?>').hide();
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php echo($maLoaiBan); ?>').click(function(){
			var maLoaiBan = <?php echo $maLoaiBan; ?>;			
			$.ajax({
			    url: 'quanly/quanlyloaiban/xoaloaiban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maloaiban: maLoaiBan	
				 }, success: function (data) {
					$('#thongbao<?php echo($maLoaiBan); ?>').html(data);					
				 	$('#xoa<?php echo($maLoaiBan); ?>').hide();
				 	$('#capnhat<?php echo($maLoaiBan); ?>').hide();
				}
			});   
		});

		$("#dong<?php echo($maLoaiBan); ?>").click(function(){
			setTimeout(function(){		
				$('#danhsachloaiban').load('quanly/quanlyloaiban/load-loaiban.php'); 
			}, 500);
		});
	});
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>