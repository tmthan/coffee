<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên loại đồ uống:
	</div>
	<div class="col-xs-8">
		<div class="form-group">		
			<input type="text" name="tenloai" class="form-control" id="tenloaithem">			
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-xs-8 col-xs-offset-4">
		<div class="btn btn-success" id="them">
			Thêm
		</div>	
		<button class="btn btn-secondary" data-dismiss="modal">Đóng</button>	
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#them').click(function(){			
			var tenLoai = $('#tenloaithem').val();			
			$.ajax({
			    url: 'quanly/quanlyloaimonan/themloai-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tenloai: tenLoai,					
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachloai').load('quanly/quanlyloaimonan/load-loaimonan.php'); 
					$('#tenloaithem').val("");	
					setTimeout(function(){
						$("#themloaimonan").modal('toggle');
					}, 1000);
				}
			});   
		})
	})
</script>