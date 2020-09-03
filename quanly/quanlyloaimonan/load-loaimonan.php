<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên loại đồ uống</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `Ma_Loai`, `Ten_Loai` FROM `loai_mon_an` WHERE `Xoa` = 0 ORDER BY `Ten_Loai`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maLoai = $row['Ma_Loai'];
	$tenLoai = $row['Ten_Loai'];
	echo '
		<tr data-toggle="modal" data-target="#loaimonan' . $maLoai . '">
			<td>
				' . $tenLoai . '
			</td>
		</tr>
		<!-- Modal -->
		<div class="modal fade" id="loaimonan' . $maLoai .'" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Cập nhật: ' . $tenLoai . '</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div id="thongtinloaimonan' . $maLoai . '"></div>	        
		      </div>	      
		    </div>
		  </div>
		</div>
	';	// hien thi danh sach ban
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					
						$('#thongtinloaimonan" . $maLoai . "').load('quanly/quanlyloaimonan/load-thongtinloai.php?maloai=$maLoai'); 
					
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header">
	<h2>Danh sách loại đồ uống đã xóa</h2>
</div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>
				Tên loại đồ uống
			</th>
			<th>
				Khôi phục
			</th>
		</tr>
	</thead>
	<tbody>
<?php
// Danh sach cac ban an bi xoa
$sql = "SELECT `Ma_Loai`, `Ten_Loai` FROM `loai_mon_an` WHERE `Xoa` = 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maLoai = $row['Ma_Loai'];
	$tenLoai = $row['Ten_Loai'];	
	echo "			
				<tr>
					<td>
						$tenLoai
					</td>									
					<td>
						<button class='btn btn-success' id='khoiphuc$maLoai'>Khôi phục</button>
					</td>
				</tr>";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maLoai').click(function(){				
						var maLoai = $maLoai;			
						$.ajax({
						    url: 'quanly/quanlyloaimonan/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								maloai: maLoai,					
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachloai').load('quanly/quanlyloaimonan/load-loaimonan.php'); 	 	
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

?>		
	</tbody>
</table>