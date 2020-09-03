<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên khu vực:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenkhuvuc" class="form-control" id="tenkhuvucthem">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="them">Thêm</button>
		<button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#them').click(function(){			
			var tenKhuVuc = $("#tenkhuvucthem").val();
			$.ajax({
			    url: 'quanly/quanlykhuvuc/themkhuvuc-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tenkhuvuc: tenKhuVuc				
				 }, success: function (data) {
				 	$("#tenkhuvucthem").val("");
					$('#thongbaothem').html(data);
					$('#danhsachkhuvuc').load('quanly/quanlykhuvuc/load-khuvuc.php');
					setTimeout(function(){
						$("#themkhuvuc").modal('toggle');
					}, 1000);
				}
			});   
		})
	})
</script>