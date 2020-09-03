<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

$maMon = locSo($_GET['mamon']);
$sql = "SELECT `mon_an`.`Ten_Mon`, `mon_an`.`STT`, `mon_an`.`Ma_Loai`, `mon_an`.`Gia`, `mon_an`.`Khong_Pha_Che`, `loai_mon_an`.`Ten_Loai` FROM `mon_an`, `loai_mon_an` WHERE `mon_an`.`Ma_Loai` = `loai_mon_an`.`Ma_Loai` AND `mon_an`.`Ma_Mon` = $maMon;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenMon = $row['Ten_Mon'];
	$stt = $row['STT'];
	$maLoai = $row['Ma_Loai'];
	$tenLoai = $row['Ten_Loai'];
	$gia = $row['Gia'];
	$khongPhaChe = $row['Khong_Pha_Che'];
}
?>
<div id="thongbao<?php echo($maMon); ?>"></div>
<div class="row">
	<div class="col-xs-4">
		Tên đồ uống:
	</div>
	<div class="col-xs-8">
		
		<div class="form-group">
			<input type="text" name="tenmon" id="tenmonsua<?php echo($maMon); ?>" class="form-control" value="<?php echo($tenMon); ?>">
		</div>
		
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		STT trên menu:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenmon" id="sttsua<?php echo($maMon); ?>" class="form-control" value="<?php echo($stt); ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Loại:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select class="form-control" id="maloaisua<?php echo($maMon); ?>">
<?php
// lay danh sach loai mon an
$sql2 = "SELECT `loai_mon_an`.`Ma_Loai`, `loai_mon_an`.`Ten_Loai` FROM `loai_mon_an` WHERE `loai_mon_an`.`Xoa` = 0;";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
	$maLoai2 = $row2['Ma_Loai'];
	$tenLoai2 = $row2['Ten_Loai'];
	// hien thi ra option

	echo "<option value='$maLoai2'";
	// kiem tra loai dang duoc su dung
	if ($maLoai == $maLoai2) {
		echo "selected='selected'";
	}
	echo ">$tenLoai2</option>";
}
?>			
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Giá:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="gia" id="giasua<?php echo($maMon); ?>" class="form-control" value="<?php echo($gia); ?>">
		</div>
	</div>
</div>
<div class="row margin-5">
	<div class="col-xs-8 col-xs-offset-4">
		<input type="checkbox" class="custom-control-input" id="khongphachesua<?php echo($maMon); ?>" <?php if ($khongPhaChe == 1) { echo "checked"; } ?>>
		<label style="font-weight: normal;" for="khongphachesua<?php echo($maMon); ?>">Không pha chế</label>		
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($maMon); ?>">
			Cập nhật
		</button>
		<button class="btn btn-danger" id="xoa<?php echo($maMon); ?>">
			Xóa
		</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal" id="dong<?php  echo($maMon); ?>">Đóng</button>
	</div>	
</div>
<small>Các loại uống không pha chế là các loại nước đóng chai, sẽ được lưu trữ trong kho</small>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php echo($maMon); ?>').click(function(){
			var maMon = <?php echo $maMon; ?>;
			var tenMon = $('#tenmonsua<?php echo($maMon); ?>').val();
			var maLoai = $('#maloaisua<?php echo($maMon); ?>').val();
			var stt = $('#sttsua<?php echo($maMon); ?>').val();
			if ($("#khongphachesua<?php echo($maMon); ?>").prop("checked")) {
				var khongPhaChe = 1;
			} else {
				var khongPhaChe = 0;
			}
			var gia = $('#giasua<?php echo($maMon); ?>').val();
			$.ajax({
			    url: 'quanly/quanlymonan/suamon-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					mamon: maMon,
					tenmon: tenMon,
					stt: stt,
					maloai: maLoai,
					khongphache: khongPhaChe,
					gia: gia
				 }, success: function (data) {
					$('#thongbao<?php echo($maMon); ?>').html(data);
					$('#xoa<?php echo($maMon); ?>').hide();
				 	$('#capnhat<?php echo($maMon); ?>').hide();				   	
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php echo($maMon); ?>').click(function(){
			var maMon = <?php echo $maMon; ?>;			
			$.ajax({
			    url: 'quanly/quanlymonan/xoamon-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					mamon: maMon,					
				 }, success: function (data) {
					$('#thongbao<?php echo($maMon); ?>').html(data);
					
				 	$('#xoa<?php echo($maMon); ?>').hide();
				 	$('#capnhat<?php echo($maMon); ?>').hide();
				}
			});   
		});
		$("#dong<?php echo($maMon); ?>").click(function(){
			setTimeout(function(){
				$('#danhsachmonan').load('quanly/quanlymonan/load-monan.php'); 
			}, 500);
		});
	})
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);			// Dong ket noi
?>