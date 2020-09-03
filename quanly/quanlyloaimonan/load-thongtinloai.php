<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maLoai = locSo($_GET['maloai']);
$sql = "SELECT `Ma_Loai`, `Ten_Loai` FROM `loai_mon_an` WHERE `Ma_Loai` = $maLoai;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoai = $row['Ten_Loai'];	
}
?>
<div id="thongbao<?php  echo($maLoai); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		Tên loại đồ uống:
	</div>
	<div class="col-xs-8">
		<div class="form-group">			
			<input type="text" name="tentheloai" id="tenloaisua<?php  echo($maLoai); ?>" class="form-control" value="<?php echo($tenLoai); ?>">			
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button id="capnhat<?php echo($maLoai);  ?>" class="btn btn-success">
		Cập nhật
		</button>
		<button id="xoa<?php echo($maLoai);  ?>" class="btn btn-danger">Xóa</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal" id="dong<?php  echo($maLoai); ?>">Đóng</button>	
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php  echo($maLoai); ?>').click(function(){
			var maLoai = <?php echo $maLoai; ?>;
			var tenLoai = $('#tenloaisua<?php  echo($maLoai); ?>').val();			
			$.ajax({
			    url: 'quanly/quanlyloaimonan/sualoai-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maloai: maLoai,
					tenloai: tenLoai					
				 }, success: function (data) {
					$('#thongbao<?php  echo($maLoai); ?>').html(data);
					$('#xoa<?php  echo($maLoai); ?>').hide();
				 	$('#capnhat<?php  echo($maLoai); ?>').hide();				   	
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php  echo($maLoai); ?>').click(function(){
			var maLoai = <?php echo $maLoai; ?>;			
			$.ajax({
			    url: 'quanly/quanlyloaimonan/xoaloai-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maloai: maLoai					
				 }, success: function (data) {
					$('#thongbao<?php  echo($maLoai); ?>').html(data);
					
				 	$('#xoa<?php  echo($maLoai); ?>').hide();
				 	$('#capnhat<?php  echo($maLoai); ?>').hide();
				}
			});   
		});

		$("#dong<?php  echo($maLoai); ?>").click(function(){
			setTimeout(function(){
				$('#danhsachloai').load('quanly/quanlyloaimonan/load-loaimonan.php'); 
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