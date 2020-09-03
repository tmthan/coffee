<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}

if (isset($_GET['tendangnhap'])) {
	$tenDangNhap = $_GET['tendangnhap'];
}

$sql = "SELECT `ho_so`.`Ten_Dang_Nhap`, `tai_khoan`.`Loai_Tai_Khoan`, `ho_so`.`Ho_Ten`, `ho_so`.`Nam_Sinh`, `ho_so`.`Gioi_Tinh`, `ho_so`.`So_Dien_Thoai`, `ho_so`.`Dia_Chi` FROM `tai_khoan`, `ho_so` WHERE `ho_so`.`Ten_Dang_Nhap` = `tai_khoan`.`Ten_Dang_Nhap` AND `ho_so`.`Ten_Dang_Nhap` = '$tenDangNhap';";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$hoTen = $row['Ho_Ten'];
	$loaiTaiKhoan = $row['Loai_Tai_Khoan'];
	$ngaySinh = substr( $row['Nam_Sinh'], 8, 2);
	$thangSinh = substr( $row['Nam_Sinh'], 5, 2);
	$namSinh = substr( $row['Nam_Sinh'], 0, 4);
	$gioiTinh = $row['Gioi_Tinh'];
	$soDienThoai = $row['So_Dien_Thoai'];
	$diaChi = $row['Dia_Chi'];
}
?>
<div id="thongbao<?php echo($tenDangNhap); ?>"></div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Tên đăng nhập:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<?php echo("&nbsp" . $tenDangNhap);?>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Loại tài khoản:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<select id="loaitaikhoan<?php echo($tenDangNhap); ?>" class="form-control">
				<option value="1" <?php if ($loaiTaiKhoan == 1) { echo "selected='selected'";}?>>Pha chế</option>
				<option value="2" <?php if ($loaiTaiKhoan == 2) { echo "selected='selected'";}?>>Phục vụ</option>
				<option value="3" <?php if ($loaiTaiKhoan == 3) { echo "selected='selected'";}?>>Quản lý</option>
				<option value="4" <?php if ($loaiTaiKhoan == 4) { echo "selected='selected'";}?>>Thu ngân</option>
			</select>
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Họ tên:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="" class=" form-control" value="<?php echo($hoTen); ?>" id="hoten<?php echo($tenDangNhap); ?>">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Năm sinh:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="ngaysinh" value="<?php echo($ngaySinh); ?>" id="ngaysinh<?php echo($tenDangNhap); ?>" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;">
			
			/
			
			<input type="text" name="thangsinh" value="<?php echo($thangSinh); ?>" id="thangsinh<?php echo($tenDangNhap); ?>" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;">			
				/			
			<input type="text" name="namsinh" value="<?php echo($namSinh); ?>" id="namsinh<?php echo($tenDangNhap); ?>" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Giới tính:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->					
		<div class="form-group">
			<select class="form-control" id="gioitinh<?php echo($tenDangNhap); ?>">
				<option value="1" <?php if ($gioiTinh == 1) { echo "selected='selected'";} ?>>Nam</option>
				<option value="0" <?php if ($gioiTinh == 2) { echo "selected='selected'";} ?>>Nữ</option>
			</select>
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Số điện thoại:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="" class="form-control" value="<?php echo($soDienThoai); ?>" id="sodienthoai<?php echo($tenDangNhap); ?>">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Địa chỉ:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="" class="form-control" value="<?php echo($diaChi); ?>" id="diachi<?php echo($tenDangNhap); ?>">
		</div>
	</div>	<!-- Sua thong tin -->
</div><!-- row -->
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="capnhat<?php echo($tenDangNhap); ?>">Cập nhật</button>
		<button class="btn btn-danger" id="xoa<?php echo($tenDangNhap); ?>">Xóa</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dong<?php echo($tenDangNhap); ?>">Đóng</button>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#xoa<?php echo($tenDangNhap); ?>').click(function(){				
			var tenDangNhap = '<?php echo($tenDangNhap); ?>';			
			$.ajax({
			    url: 'quanly/quanlytaikhoan/xoataikhoan-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					tendangnhap: tenDangNhap,					
				 }, success: function (data) {
					$('#thongbao<?php echo($tenDangNhap); ?>').html(data);	
					$("#xoa<?php echo($tenDangNhap); ?>").hide();
					$("#capnhat<?php echo($tenDangNhap); ?>").hide();
				}
			});   
		}) ;
		$('#capnhat<?php echo($tenDangNhap); ?>').click(function(){				
			var tenDangNhap = '<?php echo($tenDangNhap); ?>';		
			var loaiTaiKhoan = $('#loaitaikhoan<?php echo($tenDangNhap); ?>').val();
			var hoTen = $('#hoten<?php echo($tenDangNhap); ?>').val();
			var ngaySinh = $('#ngaysinh<?php echo($tenDangNhap); ?>').val();
			var thangSinh = $('#thangsinh<?php echo($tenDangNhap); ?>').val();
			var namSinh = $('#namsinh<?php echo($tenDangNhap); ?>').val();
			var gioiTinh = $('#gioitinh<?php echo($tenDangNhap); ?>').val();
			var soDienThoai = $('#sodienthoai<?php echo($tenDangNhap); ?>').val();
			var diaChi = $('#diachi<?php echo($tenDangNhap); ?>').val();
			$.ajax({
			    url: 'quanly/quanlytaikhoan/suataikhoan-load.php',
				type: 'POST',
		        dataType: 'text',
				data: {
					tendangnhap: tenDangNhap,
					loaitaikhoan: loaiTaiKhoan,
					hoten: hoTen,
					ngaysinh: ngaySinh,
					thangsinh: thangSinh,
					namsinh: namSinh,
					gioitinh: gioiTinh,
					sodienthoai: soDienThoai,
					diachi: diaChi
				 }, success: function (data) {
					$('#thongbao<?php echo($tenDangNhap); ?>').html(data);
					$("#capnhat<?php echo($tenDangNhap); ?>").hide();
					$("#xoa<?php echo($tenDangNhap); ?>").hide();
				}
			});   
		});
		$("#dong<?php echo($tenDangNhap); ?>").click(function(){
			setTimeout(function(){
			  	$('#danhsachtaikhoan').load('quanly/quanlytaikhoan/load-taikhoan.php');
			}, 500);
		});
	});
</script>

<!-- Doi mat khau -->
<div class="form-group">
	<div class="row">
		<div class="col-xs-4"> <!--Text -->
			Mật khẩu mới:
		</div> <!--Text -->
		<div class="col-xs-8"> <!--Sua thong tin -->
			<div class="form-group">
				<input type="password" name="" class="form-control" id="matkhaumoi<?php echo($tenDangNhap); ?>">
			</div>
		</div>	<!-- Sua thong tin -->
	</div>
	<div class="row">
		<div class="col-xs-4"> <!--Text -->
			Nhập lại mật khẩu mới:
		</div> 
		<div class="col-xs-8"> 
			<div class="form-group">
				<input type="password" name="" class="form-control" id="nhaplaimatkhaumoi<?php echo($tenDangNhap); ?>">
			</div>
		</div>	
	</div>
	<div class="row">		
		<div class="col-xs-8 col-xs-offset-4"> <!--Sua thong tin -->
			<button class="btn btn-success" id="doimatkhau<?php echo($tenDangNhap); ?>">
				Đổi mật khẩu
			</button>
		</div>	<!-- Sua thong tin -->
	</div>
</div><!-- form-group -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#doimatkhau<?php echo($tenDangNhap); ?>').click(function(){	
			var tenDangNhap = '<?php echo($tenDangNhap);?>';		
			var matKhauMoi = $('#matkhaumoi<?php echo($tenDangNhap); ?>').val();
			var nhapLaiMatKhauMoi = $('#nhaplaimatkhaumoi<?php echo($tenDangNhap); ?>').val();
			var patpass = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,32}/;
			if (!patpass.test(matKhauMoi) || !patpass.test(nhapLaiMatKhauMoi)) {
				alert("Mật khẩu phải bao gồm chữ cái, số, ít nhất 6 ký tự và không quá 32 ký tự");
			} else if (matKhauMoi == nhapLaiMatKhauMoi) {
				$.ajax({
				    url: 'quanly/quanlytaikhoan/doimatkhau-load.php',
					type: 'POST',
		        	dataType: 'text',
					data: {
						tendangnhap: tenDangNhap,
						matkhaumoi: matKhauMoi
					 }, success: function (data) {
						$('#thongbao<?php echo($tenDangNhap); ?>').html(data);	
						$("#doimatkhau<?php echo($tenDangNhap); ?>").hide();
					}
				});   
			}
			else {
				$('#matkhaumoi<?php echo($tenDangNhap); ?>').val('');
				$('#nhaplaimatkhaumoi<?php echo($tenDangNhap); ?>').val('');
				$('#thongbao<?php echo($tenDangNhap); ?>').html("<div class='alert alert-danger'>Mật khẩu nhập lại không khớp</div>");				
			}
		})
	})
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);			// Dong ket noi
?>