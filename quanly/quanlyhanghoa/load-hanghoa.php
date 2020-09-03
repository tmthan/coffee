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
				Tên hàng hóa
			</th>
			<th>
				Đơn vị tính
			</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `hang_hoa`.`Ma_Hang`, `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa` LEFT JOIN `don_vi_tinh` ON `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` WHERE `hang_hoa`.`Xoa`=0;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maHang = $row['Ma_Hang'];
	$tenHang = $row['Ten_Hang'];
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];	
	echo "<tr data-toggle='modal' data-target='#hang" . $maHang . "'>
			<td>$tenHang</td>
			<td>$tenDonViTinh</td>
		</tr>";	
	echo '
	<!-- Modal -->
	<div class="modal fade" id="hang' . $maHang .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cập nhật: ' . $tenHang . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtinhanghoa' . $maHang . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtinhanghoa" . $maHang . "').load('quanly/quanlyhanghoa/load-thongtinhanghoa.php?mahang=$maHang');
				}) 
			</script>";
}
?>	
	</tbody>
</table>
<div class="header">
	<h2>Danh sách hàng hóa bị xóa</h2>
</div>
<table class="table">
	<thead>
		<tr>
			<th>
				Tên hàng hóa
			</th>
			<th>
				Đơn vị tính
			</th>
			<th>
				Khôi phục
			</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac mon an bi xoa
$sql = "SELECT `hang_hoa`.`Ma_Hang`, `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa` LEFT JOIN `don_vi_tinh` ON `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` WHERE `hang_hoa`.`Xoa`=1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maHang = $row['Ma_Hang'];
	$tenHang = $row['Ten_Hang'];
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];	
	echo "			
				<tr>
					<td>
						$tenHang
					</td>
					<td>
						$tenDonViTinh
					</td>					
					<td>
						<div class='btn btn-success' id='khoiphuc$maHang'>Khôi phục</div>
					</td>
				</div>";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maHang').click(function(){				
						var maHang = $maHang;			
						$.ajax({
						    url: 'quanly/quanlyhanghoa/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								mahang: maHang			
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachhanghoa').load('quanly/quanlyhanghoa/load-hanghoa.php'); 	 	
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
