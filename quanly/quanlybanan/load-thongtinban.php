<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
$maBan = locSo($_GET['maban']);
$sql = "SELECT `Ten_Ban`, `So_Cho_Ngoi`, `Ma_Khu_Vuc`, `Ma_Loai_Ban` FROM `ban` WHERE `Ma_Ban` = $maBan;";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenBan = $row['Ten_Ban'];
	$soChoNgoi = $row['So_Cho_Ngoi'];
	$khuVuc = $row['Ma_Khu_Vuc'];
	$loaiBan = $row['Ma_Loai_Ban'];
}
?>
<div id="thongbao<?php echo($maBan); ?>"></div>
<div class="row">	
	<div class="col-xs-4">
		Tên bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="text" name="tenmon" id="tenbansua<?php echo($maBan); ?>" class="form-control" value="<?php echo($tenBan); ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Số chỗ ngồi:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<input type="number" name="gia" id="sochongoisua<?php echo($maBan); ?>" class="form-control" value="<?php echo($soChoNgoi); ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Khu vực:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select id="khuvucsua<?php echo($maBan); ?>" class="form-control">
					<?php 
					$sql = "SELECT `Ma_Khu_Vuc`, `Ten_Khu_Vuc` FROM `khu_vuc` WHERE `xoa` = 0;";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						$maKhuVuc = $row['Ma_Khu_Vuc'];
						$tenKhuVuc = $row['Ten_Khu_Vuc'];
						echo "<option value='$maKhuVuc'";
						if ($maKhuVuc == $khuVuc) {
							echo " selected='selected'";
						}
						echo ">$tenKhuVuc</option>";
					}
					 ?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
		Loại bàn:
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select id="loaibansua<?php echo($maBan); ?>" class="form-control">
					<?php 
					$sql = "SELECT `Ma_Loai_Ban`, `Ten_Loai_Ban` FROM `loai_ban` WHERE `xoa` = 0;";
					$result = $conn->query($sql);
					while ($row = $result->fetch_assoc()) {
						$maLoaiBan = $row['Ma_Loai_Ban'];
						$tenLoaiBan = $row['Ten_Loai_Ban'];
						echo "<option value='$maLoaiBan'";
						if ($maLoaiBan == $loaiBan) {
							echo " selected='selected'";
						}
						echo ">$tenLoaiBan</option>";
					}
					 ?>
			</select>
		</div>
	</div>
</div>
<div class="row margin-5">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($maBan); ?>">
			Cập nhật	
		</button>
		<button class="btn btn-danger" id="xoa<?php echo($maBan); ?>">
			Xóa
		</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($maBan); ?>">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	// bat su kien an nut, lay su kien trong form
	$(document).ready(function(){
		// Khi nhan nut cap nhat
		$('#capnhat<?php echo($maBan); ?>').click(function(){
			var maBan = <?php echo $maBan; ?>;
			var tenBan = $('#tenbansua<?php echo($maBan); ?>').val();
			var soChoNgoi = $('#sochongoisua<?php echo($maBan); ?>').val();	
			var khuVuc = $("#khuvucsua<?php echo($maBan); ?>").val();
			var loaiBan = $("#loaibansua<?php echo($maBan); ?>").val();
			$.ajax({
			    url: 'quanly/quanlybanan/suaban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maban: maBan,
					tenban: tenBan,
					sochongoi: soChoNgoi,	
					khuvuc: khuVuc,
					loaiban: loaiBan,				
				 }, success: function (data) {
					$('#thongbao<?php echo($maBan); ?>').html(data);
					$('#xoa<?php echo($maBan); ?>').hide();
				 	$('#capnhat<?php echo($maBan); ?>').hide();
				}
			});   
		});

		// Khi nhan nut xoa

		$('#xoa<?php echo($maBan); ?>').click(function(){
			var maBan = <?php echo $maBan; ?>;			
			$.ajax({
			    url: 'quanly/quanlybanan/xoaban-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					maban: maBan,					
				 }, success: function (data) {
					$('#thongbao<?php echo($maBan); ?>').html(data);
					$('#capnhat<?php echo($maBan); ?>').hide();
				 	$('#xoa<?php echo($maBan); ?>').hide();
				}
			});   
		});

		$("#dong<?php echo($maBan); ?>").click(function(){
			setTimeout(function(){
				$('#danhsachban').load('quanly/quanlybanan/load-ban.php'); 
			}, 500);
		});
	});
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>