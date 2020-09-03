<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên đơn vị tính:
	</div>
	<div class="col-xs-8">
		<div class="form-group">		
			<input type="text" name="tendonvitinh" class="form-control" id="tendonvitinhthem">			
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
			var tenDonViTinh = $('#tendonvitinhthem').val();			
			$.ajax({
			    url: 'quanly/quanlydonvitinh/themdonvitinh-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tendonvitinh: tenDonViTinh
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachdonvitinh').load('quanly/quanlydonvitinh/load-donvitinh.php'); 
					$("#tendonvitinhthem").val("");
					setTimeout(function(){
						$("#themdonvitinh").modal('toggle');
					}, 1000);
				}
			});   
		})
	})
</script>