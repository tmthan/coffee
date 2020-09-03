<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
// Lấy thông tin đơn vị
$sql = "SELECT * FROM `thiet_lap`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maThietLap = $row['Ma_Thiet_Lap'];
	$noiDung = $row['Noi_Dung'];
	switch ($maThietLap) {
		case 'Logo':
			$logo = $noiDung;
			break;
		case 'Ten_Don_Vi':
			$tenDonVi = $noiDung;
			break;
		case 'Dia_Chi':
			$diaChi = $noiDung;
			break;
		case 'Kho_Giay':
			$khoGiay = $noiDung;
			break;
		case 'Co_Chu':
			$coChu = $noiDung;
			break;
		case 'Phu_Thu':
			$phuThu = $noiDung;
			break;
		case 'Ly_Do_Phu_Thu':
			$lyDoPhuThu = $noiDung;
			break;
		case 'Giam_Gia':
			$giamGia = $noiDung;
			break;
		default:
			# code...
			break;
	}
}		
?>

<div class="block-header">
    <h2>Thiết lập hệ thống</h2>
</div>
<div class="row clearfix">
	<div class="card">		
		<div class="body">
			<div id="thongbao"></div>
			<form action="quanly/thietlap/luuthietlap.php" method="post" enctype="multipart/form-data" id="form">				
				<div class="row">
					<div class="col-xs-4">
						Tên đơn vị:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="text" name="tendonvi" value="<?php echo($tenDonVi); ?>" class="form-control">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Địa chỉ:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="text" name="diachi" value="<?php echo($diaChi); ?>" class="form-control">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Logo:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="file" class="form-control" name="logo" accept="image/*" onchange="preview_image(event)">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-8 col-xs-offset-4">
						<div class="form-group">
							<img src="include/logo/<?php echo($logo); ?>" id="logo" style="max-width: 100px;">
						</div>
					</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Khổ giấy in hóa đơn:
					</div>
					<div class="col-xs-8">
						<div class="form-group">
							<select class="form-control" name="khogiay">
								<option value="58" <?php if ($khoGiay == 58) { echo "selected='selected'"; } ?> >58mm</option>
								<option value="80" <?php if ($khoGiay == 80) { echo "selected='selected'"; } ?> >80mm</option>
								<option value="210" <?php if ($khoGiay == 210) { echo "selected='selected'"; } ?> >A4</option>
								<option value="148" <?php if ($khoGiay == 148) { echo "selected='selected'"; } ?> >A5</option>
								<option value="105" <?php if ($khoGiay == 105) { echo "selected='selected'"; } ?> >A6</option>
							</select>
						</div>
					</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Kích thước chữ trên hóa đơn:
					</div>
					<div class="col-xs-8">
						<div class="form-group">
							<input type="number" name="cochu" min="5" max="20" value="<?php echo($coChu); ?>" class="form-control" placeholder="pt">
						</div>
					</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Phụ thu cho tất cả hóa đơn:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="text" name="phuthu" value="<?php echo($phuThu); ?>" class="form-control">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Lý do phụ thu:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="text" name="lydophuthu" value="<?php echo($lyDoPhuThu); ?>" class="form-control">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-4">
						Giảm giá cho tất cả hóa đơn:
					</div><!-- col-xs-4 -->
					<div class="col-xs-8">
						<div class="form-group">
							<input type="number" name="giamgia" value="<?php echo($giamGia); ?>" class="form-control">
						</div>
					</div><!-- col-xs-8 -->
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-8 col-xs-offset-4">
						<button class="btn btn-success" type="submit" id="submit">Lưu thiết lập</button>
					</div>
				</div><!-- row -->
				<div class="row">
					<div class="col-xs-8 col-xs-offset-4">
						<small>
							Phụ thu và giảm giá: nhỏ hơn hoặc bằng 100 sẽ tính theo phần trăm, lớn hơn 100 sẽ tính theo số tiền.
							<br>
							Kích thước chữ trên hóa đơn 58mm và 80mm nên từ 8pt đến 10pt, trên khổ giấy A4 A5 A6 nên từ 11 dến 13pt.
						</small>
					</div>
				</div><!-- row -->
			</form>
		</div><!-- body -->
	</div>
</div>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#thietlap').addClass('menu-active');
 	});
 	function preview_image(event)
 	{
		var reader = new FileReader();
		reader.onload = function()
		{
			var output = document.getElementById('logo');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}
	//ajax submit upload
	$("form").submit(function(evt){	 
	      evt.preventDefault();
	      var formData = new FormData($(this)[0]);
	   $.ajax({
	       url: 'quanly/thietlap/luuthietlap.php',
	       type: 'POST',
	       data: formData,
	       async: false,
	       cache: false,
	       contentType: false,
	       enctype: 'multipart/form-data',
	       processData: false,
	       success: function (data) {
	        	$("#thongbao").html(data);
	       }
	   });
	   return false;
	 });
</script>