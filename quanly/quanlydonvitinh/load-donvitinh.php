<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
 <table class="table">
	<thead>
		<tr class="bg-blue">
			<th>
				Tên đơn vị tính
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT * FROM `don_vi_tinh` WHERE `Xoa` = 0;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maDonViTinh = $row['Ma_Don_Vi_Tinh'];
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
	
	echo "
		<tr data-toggle='modal' data-target='#donvitinh" . $maDonViTinh . "'>
			<td>
			 $tenDonViTinh
			</td>
		</tr>
	";
	echo '
	<!-- Modal -->
	<div class="modal fade" id="donvitinh' . $maDonViTinh .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cập nhật: ' . $tenDonViTinh . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtindonvitinh' . $maDonViTinh . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtindonvitinh" . $maDonViTinh . "').load('quanly/quanlydonvitinh/load-thongtindonvitinh.php?madonvitinh=$maDonViTinh');
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header">
	<h2>Danh sách đơn vị tính đã xóa</h2>
</div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>
				Tên đơn vị tính
			</th>
			<th>
				Khôi phục
			</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac don vi tinh bi xoa
$sql = "SELECT * FROM `don_vi_tinh` WHERE `Xoa` = 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maDonViTinh = $row['Ma_Don_Vi_Tinh'];
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];	
	echo "			
				<tr>
					<td>
						$tenDonViTinh
					</td>					
					<td>
						<button class='btn btn-success' id='khoiphuc$maDonViTinh'>Khôi phục</button>
					</tr>
				</div>";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maDonViTinh').click(function(){				
						var maDonViTinh = $maDonViTinh;			
						$.ajax({
						    url: 'quanly/quanlydonvitinh/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								madonvitinh: maDonViTinh
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachdonvitinh').load('quanly/quanlydonvitinh/load-donvitinh.php'); 	 	
							   	setTimeout(function(){
							   	// sau 5 giay thi hien lai
							   	$('#thongbao').html('');							   	
							   }, 5000);							   
							}
						});   
					}) ;
				}) 
			</script>";
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>		
	</tbody>
</table>