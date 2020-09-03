<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$maKhuVuc = locSo($_GET['makhuvuc']);
$sql = "SELECT `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `Ma_Khu_Vuc`=$maKhuVuc;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenKhuVuc = $row['Ten_Khu_Vuc'];
}
?>
<div id="thongbao<?php echo($maKhuVuc); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		Tên khu vực:
	</div>
	<div class="col-xs-8">
		<div class="form-group">		
			<input type="text" name="tenkhuvuc" id="tenkhuvucsua<?php echo($maKhuVuc); ?>" class="form-control" value="<?php echo($tenKhuVuc); ?>">		
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($maKhuVuc); ?>">
			Cập nhật
		</button>
		<button class="btn btn-danger" id="xoa<?php echo($maKhuVuc); ?>">
			Xóa
		</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($maKhuVuc); ?>">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php echo($maKhuVuc); ?>').click(function(){
			var maKhuVuc = <?php echo $maKhuVuc; ?>;
			var tenKhuVuc = $("#tenkhuvucsua<?php echo($maKhuVuc); ?>").val();
			$.ajax({
			    url: 'quanly/quanlykhuvuc/suakhuvuc-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					makhuvuc: maKhuVuc,
					tenkhuvuc: tenKhuVuc
				 }, success: function (data) {
					$('#thongbao<?php echo($maKhuVuc); ?>').html(data);
					$('#xoa<?php echo($maKhuVuc); ?>').hide();				   	
				 	$('#capnhat<?php echo($maKhuVuc); ?>').hide();				   	
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php echo($maKhuVuc); ?>').click(function(){
			var maKhuVuc = <?php echo $maKhuVuc; ?>;			
			$.ajax({
			    url: 'quanly/quanlykhuvuc/xoakhuvuc-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					makhuvuc: maKhuVuc
				 }, success: function (data) {
					$('#thongbao<?php echo($maKhuVuc); ?>').html(data);
					$('#capnhat<?php echo($maKhuVuc); ?>').hide();
				 	$('#xoa<?php echo($maKhuVuc); ?>').hide();
				}
			});   
		});

		$("#dong<?php echo($maKhuVuc); ?>").click(function(){
			setTimeout(function(){
				$('#danhsachkhuvuc').load('quanly/quanlykhuvuc/load-khuvuc.php'); 
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