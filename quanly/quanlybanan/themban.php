<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenmon" class="form-control" id="tenbanthem">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Số chỗ ngồi:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="" class="form-control" id="sochongoi" value="0">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Khu vực:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select id="khuvucthem" class="form-control">
					<?php 
					$sql = "SELECT `Ma_Khu_Vuc`, `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `xoa` = 0;";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						$maKhuVuc = $row['Ma_Khu_Vuc'];
						$tenKhuVuc = $row['Ten_Khu_Vuc'];
						echo "<option value='$maKhuVuc'>$tenKhuVuc</option>";				
					}
					 ?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Loại bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select id="loaibanthem" class="form-control">
					<?php 
					$sql = "SELECT `Ma_Loai_Ban`, `Ten_Loai_Ban` FROM `loai_ban` WHERE `xoa` = 0;";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						$maLoaiBan = $row['Ma_Loai_Ban'];
						$tenLoaiBan = $row['Ten_Loai_Ban'];
						echo "<option value='$maLoaiBan'>$tenLoaiBan</option>";				
					}
					 ?>
			</select>
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
			var tenBan = $('#tenbanthem').val();
			var soChoNgoi = $('#sochongoi').val();
			var khuVuc = $("#khuvucthem").val();
			var loaiBan = $("#loaibanthem").val();
			$.ajax({
			    url: 'quanly/quanlybanan/themban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tenban: tenBan,
					sochongoi: soChoNgoi,
					khuvuc: khuVuc,
					loaiban: loaiBan,					
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachban').load('quanly/quanlybanan/load-ban.php'); 		
					$('#tenbanthem').val("");
					setTimeout(function(){
						$("#themban").modal('toggle');
					}, 1000);
				}
			});   
		})
	})
</script>