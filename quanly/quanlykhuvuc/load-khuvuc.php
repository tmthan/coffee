<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên khu vực</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `Ma_Khu_Vuc`, `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `xoa`=0;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maKhuVuc = $row['Ma_Khu_Vuc'];
	$tenKhuVuc = $row['Ten_Khu_Vuc'];	
	echo "
		<tr data-toggle='modal' data-target='#khuvuc" . $maKhuVuc . "'>
			<td>
				$tenKhuVuc
			</td>
		</tr>
	";
	echo '
	<!-- Modal -->
	<div class="modal fade" id="khuvuc' . $maKhuVuc .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cập nhật: ' . $tenKhuVuc . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtinkhuvuc' . $maKhuVuc . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtinkhuvuc" . $maKhuVuc . "').load('quanly/quanlykhuvuc/load-thongtinkhuvuc.php?makhuvuc=$maKhuVuc');
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header">
	<h2>Danh sách khu vực đã xóa</h2>
</div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên khu vực</th>
			<th>Khôi phục</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac ban an bi xoa
$sql = "SELECT `Ma_Khu_Vuc`, `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `xoa`=1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maKhuVuc = $row['Ma_Khu_Vuc'];
	$tenKhuVuc = $row['Ten_Khu_Vuc'];
	echo "
		<tr>
			<td>$tenKhuVuc</td>
			<td>
				<button class='btn btn-success' id='khoiphuc$maKhuVuc'>Khôi phục</button>
			</td>
		</tr>			
		";
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maKhuVuc').click(function(){				
						var maKhuVuc = $maKhuVuc;			
						$.ajax({
						    url: 'quanly/quanlykhuvuc/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								makhuvuc: maKhuVuc
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachkhuvuc').load('quanly/quanlykhuvuc/load-khuvuc.php'); 	 	
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