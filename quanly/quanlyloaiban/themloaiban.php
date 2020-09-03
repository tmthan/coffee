<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
?>
 <div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên loại bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenloaiban" class="form-control" id="tenloaibanthem">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Tiền phụ thu:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="phuthu" class="form-control" id="phuthuthem" value="0">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="them">Thêm</button>
		<button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
	</div>
</div><!-- row -->
<div class="row">
	<div class="col-xs-12">
		<small>Tiền phụ thu nhỏ hơn hoặc bằng 100 sẽ tính theo phần trăm, lớn hơn 100 sẽ tính theo số tiền.</small>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#them').click(function(){			
			var tenLoaiBan = $('#tenloaibanthem').val();
			var phuThu = $("#phuthuthem").val();
			$.ajax({
			    url: 'quanly/quanlyloaiban/themloaiban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tenloaiban: tenLoaiBan,
					phuthu: phuThu
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachloaiban').load('quanly/quanlyloaiban/load-loaiban.php'); 
					$('#tenloaibanthem').val("");
					$("#phuthuthem").val("0");					
					setTimeout(function(){
						$("#themloaiban").modal('toggle');
					}, 1000);
				}
			});   
		})
	})
</script>