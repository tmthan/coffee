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
				Tên đồ uống
			</th>
			<th>
				Loại
			</th>
			<th class="text-center">
				Giá
			</th>
			<th class="text-center">K.Pha chế</th>
		</tr>
	</thead>
	<tbody>
<?php
$sql = "SELECT `mon_an`.`Ma_Mon`, `mon_an`.`Ten_Mon`, `loai_mon_an`.`Ten_Loai`, `mon_an`.`Gia`, `mon_an`.`Khong_Pha_Che` FROM `mon_an`, `loai_mon_an` WHERE `mon_an`.`Ma_Loai` = `loai_mon_an`.`Ma_Loai` AND `mon_an`.`Xoa` = 0 ORDER BY `loai_mon_an`.`Ten_Loai`, `mon_an`.`Ten_Mon`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maMon = $row['Ma_Mon'];
	$tenMon = $row['Ten_Mon'];
	$tenLoai = $row['Ten_Loai'];
	$gia = $row['Gia'];
	$khongPhaChe = $row['Khong_Pha_Che'];
	echo "<tr data-toggle='modal' data-target='#monan" . $maMon . "'>
			<td>
				$tenMon
			</td>
			<td>
				$tenLoai
			</td>
			<td class='text-right'>";
				echo(number_format($gia));
	echo "	</td>
			<td class='text-center' title='Không pha chế'>";
	if ($khongPhaChe == 1) {
		echo "<i class='fas fa-times' style='color: tomato;'></i>";
	}

	echo "</td>
		</tr>";	// hien thi danh sach mon an
	echo '
	<!-- Modal -->
	<div class="modal fade" id="monan' . $maMon .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Cập nhật: ' . $tenMon . '</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="thongtinmonan' . $maMon . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtinmonan" . $maMon . "').load('quanly/quanlymonan/load-thongtinmonan.php?mamon=$maMon'); 					
				}) 
			</script>";
}
?>		
	</tbody>
</table>
<div class="header">
	<h2>Danh sách đồ uống đã xóa</h2>
</div>
<table class="table">

			<thead>
				<tr class="bg-blue">
					<th>
						Tên món
					</th>
					<th>
						Loại
					</th>
					<th class="text-right">
						Giá
					</th>
					<th>
						Khôi phục
					</th>
				</tr>
			</thead>
			<tbody>
<?php
// Danh sach cac mon an bi xoa
$sql = "SELECT `mon_an`.`Ma_Mon`, `mon_an`.`Ten_Mon`, `loai_mon_an`.`Ten_Loai`, `mon_an`.`Gia` FROM `mon_an`, `loai_mon_an` WHERE `mon_an`.`Ma_Loai` = `loai_mon_an`.`Ma_Loai` AND `mon_an`.`Xoa` = 1 ORDER BY `loai_mon_an`.`Ten_Loai`, `mon_an`.`Ten_Mon`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maMon = $row['Ma_Mon'];
	$tenMon = $row['Ten_Mon'];
	$tenLoai = $row['Ten_Loai'];
	$gia = $row['Gia'];
	echo "			
				<tr>
					<td>
						$tenMon
					</td>
					<td>
						$tenLoai
					</td>
					<td class='text-right'>
						$gia
					</td>
					<td>
						<button class='btn btn-success' id='khoiphuc$maMon'>Khôi phục</button>
					</td>
				</tr>";	// hien thi danh sach mon an
	// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$maMon').click(function(){				
						var maMon = $maMon;			
						$.ajax({
						    url: 'quanly/quanlymonan/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								mamon: maMon,					
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachmonan').load('quanly/quanlymonan/load-monan.php'); 	 	
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