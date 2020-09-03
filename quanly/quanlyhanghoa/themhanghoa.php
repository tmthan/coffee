<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4">
		Tên hàng hóa:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenhanghoa" class="form-control" id="tenhangthem">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Đơn vị tính:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select class="form-control" id="madonvitinhthem">
		<?php
		$sql = "SELECT `Ma_Don_Vi_Tinh`, `Ten_Don_Vi_Tinh` FROM `don_vi_tinh` WHERE `Xoa`=0;";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			$maDonViTinh = $row['Ma_Don_Vi_Tinh'];
			$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
			// hien thi ra option

			echo "<option value='$maDonViTinh'>$tenDonViTinh</option>";
		}
		if (isset($result)) {
			mysqli_free_result($result);
		}
		mysqli_close($conn);			// Dong ket noi
		?>		
			</select>			
		</div>			
	</div><!-- col-xs-8 -->
</div><!-- row -->
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="them">
			Thêm
		</button>
		<button class="btn btn-secondary" data-dismiss="modal">Đóng</button>
	</div>	
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#them').click(function(){			
			var tenHang = $('#tenhangthem').val();
			var maDonViTinh = $("#madonvitinhthem").val();
			$.ajax({
			    url: 'quanly/quanlyhanghoa/themhanghoa-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					tenhang: tenHang,
					madonvitinh: maDonViTinh
				 }, success: function (data) {
					$('#thongbaothem').html(data);
					$('#danhsachhanghoa').load('quanly/quanlyhanghoa/load-hanghoa.php'); 
					$("#tenhangthem").val("");
					setTimeout(function(){
						$("#themhanghoa").modal('toggle');
					}, 1000);
				}
			});   
		});
	});
</script>