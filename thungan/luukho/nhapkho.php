<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}

$maMon = $_GET['mamon'];
$tenMon = "";
$soLuong = "";

$sql = "SELECT `luu_kho`.`Ma_Luu_Kho`, `mon_an`.`Ten_Mon`, `luu_kho`.`So_Luong` FROM `mon_an`, `luu_kho` WHERE `luu_kho`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `luu_kho`.`Ma_Mon` = '$maMon' ORDER BY `luu_kho`.`Ma_Luu_Kho` DESC LIMIT 1;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {	
	$tenMon = $row['Ten_Mon'];	
	$soLuong = $row['So_Luong'];	
}

 ?>

<div class="row margin-5">
	<div class="col-xs-3">
		Tên món:
	</div>
	<div class="col-xs-6">
		<b><?php echo "$tenMon"; ?></b>
	</div>	
</div>
<div class="row margin-5">
	<div class="col-xs-3">
		Số lượng hiện tại:
	</div>
	<div class="col-xs-6">
		<b><?php echo "$soLuong"; ?></b>
	</div>	
</div>
<div class="row margin-5">
	<div class="col-xs-3">
		Số lượng nhập:
	</div>
	<div class="col-xs-6">
		<div class="form-group">
			<input type="number" name="soluongnhap" id="soluongnhap" min="0" class="form-control" value="0">
		</div>
	</div>
</div>
<div class="row margin-5">
	<div class="col-xs-6 col-xs-offset-3">
		<button class="btn btn-success" id="nutnhap">
			Nhập kho
		</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#nutnhap').click(function(){			
			var maMon = "<?php echo($maMon); ?>";
			var soLuong = $("#soluongnhap").val();
			
			$.ajax({
			    url: 'thungan/luukho/nhapkho-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {					
					mamon: maMon,
					soluong: soLuong,
				 }, success: function (data) {
					$('#thongbao').html(data);
					$('#danhsachmonan').load('thungan/luukho/load-kho.php'); 
				 	$('#nutnhap').hide();
				   	setTimeout(function(){
				   	// sau 5 giay thi hien lai
				   	$('#thongbao').html('');
				   	$('#nutnhap').show();
				   }, 5000);
				   
				}
			});   
		});
	});
</script>
<?php 
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>