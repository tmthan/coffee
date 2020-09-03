<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên bàn</th>
			<th class="text-center">Số chỗ ngồi</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `Ma_Ban`, `Ten_Ban`, `So_Cho_Ngoi` FROM `ban` WHERE `Trang_Thai_Phuc_Vu` >-1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maBan = $row['Ma_Ban'];
	$tenBan = $row['Ten_Ban'];
	$soChoNgoi = $row['So_Cho_Ngoi'];	
	echo "
		<tr data-toggle='modal' data-target='#ban" . $maBan . "'>
			<td>
				$tenBan
			</td>
			<td class='text-center'>
				$soChoNgoi
			</td>
		</tr>
	";
	echo '
	<!-- Modal -->
	<div class="modal fade" id="ban' . $maBan .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cập nhật: ' . $tenBan . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtinban' . $maBan . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtinban" . $maBan . "').load('quanly/quanlybanan/load-thongtinban.php?maban=$maBan');
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header"><h2>Danh sách bàn đã xóa</h2></div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>
				Tên bàn
			</th>
			<th class="text-center">
				Số chỗ ngồi
			</th>
			<th>
				Khôi phục
			</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac ban an bi xoa
$sql = "SELECT `Ma_Ban`, `Ten_Ban`, `So_Cho_Ngoi` FROM `ban` WHERE `Trang_Thai_Phuc_Vu` = -1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maBan = $row['Ma_Ban'];
	$tenBan = $row['Ten_Ban'];
	$soChoNgoi = $row['So_Cho_Ngoi'];	
	echo "
		<tr>
			<td>
				$tenBan
			</td>
			<td class='text-center'>
				$soChoNgoi
			</td>
			<td>
				<button class='btn btn-success' id='khoiphuc$maBan'>Khôi phục</button>
			</td>
		</tr>
		";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maBan').click(function(){				
						var maBan = $maBan;			
						$.ajax({
						    url: 'quanly/quanlybanan/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								maban: maBan,					
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachban').load('quanly/quanlybanan/load-ban.php'); 	 	
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
