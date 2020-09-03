<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
} ?>
<!-- Tieu de bang -->
<table class="table">
	<thead>
		<tr class="bg-cyan">
			<th>
				Tên đồ uống
			</th>
			<th>
				Loại
			</th>
			<th class="text-right">
				Giá
			</th>
			<th class="text-right">
				Số lượng
			</th>
		</tr>
	</thead>
	<tbody>
		
<?php 

/* Xem danh sách các món và số lượng trong kho */

$sql = "SELECT `mon_an`.`Ma_Mon`, `mon_an`.`Ten_Mon`, `luu_kho`.`So_Luong`, `loai_mon_an`.`Ten_Loai`, `mon_an`.`Gia` FROM `mon_an`, `luu_kho`, `loai_mon_an` WHERE `mon_an`.`Ma_Loai` = `loai_mon_an`.`Ma_Loai` AND `luu_kho`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `mon_an`.`Khong_Pha_Che` = 1 AND `luu_kho`.`Ma_Luu_Kho` = (select max(`Ma_Luu_Kho`) FROM `luu_kho` WHERE `luu_kho`.`Ma_Mon` = `mon_an`.`Ma_Mon`);";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$maMon = $row['Ma_Mon'];
	$tenMon = $row['Ten_Mon'];
	$tenLoai = $row['Ten_Loai'];
	$gia = $row['Gia'];
	$soLuong = $row['So_Luong'];
	echo "<tr data-toggle='modal' data-target='#kho" . $maMon . "'><td>$tenMon</td><td>$tenLoai</td><td class='text-right'>$gia</td><td class='text-right'>$soLuong</span></tr>";	

	echo '
			<!-- Modal Dialogs  -->
            <!-- Default Size -->
            <div class="modal fade" id="kho' . $maMon . '" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Nhập: ' . $tenMon . '</h4>
                        </div>
                        <div class="modal-body">
                        	<div id="thongbao' . $maMon . '"></div>
                        	<div class="form-group">
	                            <div class="row">
									<div class="col-xs-4">
										<label>Tên món:</label>
									</div>
									<div class="col-xs-8">
										<label><b>' . $tenMon . '</b></label>
									</div>	
								</div>
								<div class="row">
									<div class="col-xs-4">
										<label>Số lượng hiện tại:</label>
									</div>
									<div class="col-xs-8">
											<b>' . $soLuong . '</b>
									</div>	
								</div>
								<div class="row">
									<div class="col-xs-4">
										<label>Số lượng nhập/thay đổi:</label>
									</div>
									<div class="col-xs-8">
										
											<div class="form-line">
												<input type="number" name="soluongnhap" id="soluongnhap' . $maMon . '" min="0" class="form-control" value="0">
											</div>
									</div>
								</div>	
							</div>				
							<div class="row">
								<div class="col-xs-8 col-xs-offset-4">
									<button type="button" class="btn btn-success" id="nutnhap' . $maMon . '">Nhập kho</button>
									<button type="button" class="btn btn-primary" id="nutthaydoisoluong' . $maMon . '">Thay đổi số lượng</button>
	                            	<button type="button" class="btn btn-secondary" data-dismiss="modal" id="nutdong' . $maMon . '">Đóng</button>
								</div>
							</div>
                        </div>                       
                    </div>
                </div>
            </div>
	';
	
	?>

	<!-- End Modal -->


	<?php
	echo "<script type='text/javascript'>
			$('#nutnhap" . $maMon . "').click(function(){
				var maMon = '$maMon';
				var soLuong = $('#soluongnhap" . $maMon . "').val();
			
				$.ajax({
				    url: 'quanly/luukho/nhapkho-load.php',
					type: 'POST',
			        dataType: 'text',
					data: {					
						mamon: maMon,
						soluong: soLuong,
					 }, success: function (data) {
						$('#thongbao" . $maMon . "').html(data);					
					 	$('#nutnhap" . $maMon . "').hide();
					 	$('#nutthaydoisoluong" . $maMon . "').hide();
					}
				}); 
			});
			$('#nutthaydoisoluong" . $maMon . "').click(function(){
				var maMon = '$maMon';
				var soLuong = $('#soluongnhap" . $maMon . "').val();
			
				$.ajax({
				    url: 'quanly/luukho/thaydoisoluong-load.php',
					type: 'POST',
			        dataType: 'text',
					data: {					
						mamon: maMon,
						soluong: soLuong,
					 }, success: function (data) {
						$('#thongbao" . $maMon . "').html(data);					
					 	$('#nutthaydoisoluong" . $maMon . "').hide();
					 	$('#nutnhap" . $maMon . "').hide();
					}
				}); 
			});
			$('#nutdong" . $maMon . "').click(function(){
				setTimeout(function(){
			   	// sau 0.5 giay thi nap lai danh sach				   	
			   	$('#danhsachmonan').load('quanly/luukho/load-kho.php'); 
				}, 500);
			});
		  </script>";
}

 ?>


	</tbody>
</table>