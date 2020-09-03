<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên đồ uống:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenmon" class="form-control" id="tenmonthem">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		STT trên menu:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="stt" class="form-control" id="sttthem" min="1">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Loại:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select class="form-control" id="maloaithem">
		<?php
		// lay danh sach loai mon an
		
		$sql2 = "SELECT `loai_mon_an`.`Ma_Loai`, `loai_mon_an`.`Ten_Loai` FROM `loai_mon_an` WHERE `loai_mon_an`.`Xoa` = 0;";
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()) {
			$maLoai2 = $row2['Ma_Loai'];
			$tenLoai2 = $row2['Ten_Loai'];
			// hien thi ra option

			echo "<option value='$maLoai2'>$tenLoai2</option>";
		}

		if (isset($result2)) {
			mysqli_free_result($result2);
		}
		mysqli_close($conn);			// Dong ket noi

		?>		
			</select>
		</div>			
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Giá:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="" class="form-control" id="giathem" step="1000">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-xs-8 col-xs-offset-4">
		<input type="checkbox" name="khongphache" id="khongphachethem">
		<label for="khongphachethem" style="font-weight: normal;">Không pha chế</label>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="nutthem">Thêm</button>
		<button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<small>
			Các đồ uống không pha chế là các loại nước đóng chai, được lưu trữ trong kho
		</small>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#nutthem').click(function(){			
			var tenmon = $('#tenmonthem').val();
			var stt = $('#sttthem').val();
			var maloai = $('#maloaithem').val();
			var gia = $('#giathem').val();
			if ($("#khongphachethem").prop("checked")) {
				var khongphache = 1;
			} else {
				var khongphache = 0;
			}
			$.ajax({
			    url: 'quanly/quanlymonan/themmon-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					tenmon: tenmon,
					stt: stt,
					maloai: maloai,
					gia: gia,
					khongphache: khongphache
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachmonan').load('quanly/quanlymonan/load-monan.php'); 	
					$('#tenmonthem').val("");	
					$('#sttthem').val("");
					$('#giathem').val("");
					$("#khongphachethem").prop("checked", false);
					setTimeout(function(){
						$("#themmonan").modal('toggle');
					}, 1000);		 	
				}
			});   
		});
	});
</script>