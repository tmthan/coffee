<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên loại bàn</th>
			<th class="text-right">Tiền phụ thu</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `Ma_Loai_Ban`, `Ten_Loai_Ban`, `Phu_Thu` FROM `loai_ban` WHERE `Xoa`=0;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maLoaiBan = $row['Ma_Loai_Ban'];
	$tenLoaiBan = $row['Ten_Loai_Ban'];
	$phuThu = $row['Phu_Thu'];
	echo "
		<tr data-toggle='modal' data-target='#loaiban" . $maLoaiBan . "'>
			<td>
				$tenLoaiBan
			</td>
			<td class='text-right'>
				$phuThu
			</td>
		</tr>
	";
	echo '
	<!-- Modal -->
	<div class="modal fade" id="loaiban' . $maLoaiBan .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cập nhật: ' . $tenLoaiBan . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtinloaiban' . $maLoaiBan . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtinloaiban" . $maLoaiBan . "').load('quanly/quanlyloaiban/load-thongtinloaiban.php?maloaiban=$maLoaiBan');
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header"><h2>Danh sách loại bàn đã xóa</h2></div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên loại bàn</th>
			<th class="text-right">Phụ thu</th>
			<th>Khôi phục</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac ban an bi xoa
$sql = "SELECT `Ma_Loai_Ban`, `Ten_Loai_Ban`, `Phu_Thu` FROM `loai_ban` WHERE `Xoa`=1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maLoaiBan = $row['Ma_Loai_Ban'];
	$tenLoaiBan = $row['Ten_Loai_Ban'];
	$phuThu = $row['Phu_Thu'];
	echo "
		<tr>
			<td>$tenLoaiBan</td>
			<td class='text-right'>$phuThu</td>
			<td>
				<button class='btn btn-success' id='khoiphuc$maLoaiBan'>Khôi phục</button>
			</td>
		</tr>			
		";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maLoaiBan').click(function(){				
						var maLoaiBan = $maLoaiBan;			
						$.ajax({
						    url: 'quanly/quanlyloaiban/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								maloaiban: maLoaiBan			
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachloaiban').load('quanly/quanlyloaiban/load-loaiban.php'); 	 	
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
mysqli_close($conn);			// Dong ket noi
?>		
	</tbody>
</table>