<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<div id="thongbaothem"></div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Tên đăng nhập:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="" class="form-control" value="" id="tendangnhapthem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Loại tài khoản:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->					
		<div class="form-group">
			<select class="form-control" id="loaitaikhoanthem">
				<option value="1">Pha chế</option>
				<option value="2">Phục vụ</option>
				<option value="3">Quản lý</option>
				<option value="4">Thu ngân</option>
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
			<input type="text" name="" class="form-control" value="" id="hotenthem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Năm sinh:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="ngaysinh" id="ngaysinhthem" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;" placeholder="Ngày">
				
				/
				
			<input type="text" name="thangsinh" id="thangsinhthem" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;" placeholder="Tháng">			
				/			
			<input type="text" name="namsinh" id="namsinhthem" style="padding: 5px; border-top: none; border-right: none; border-left: none; border-bottom: 1px solid #ddd; width: 50px;" placeholder="Năm">			
		</div>	<!-- form-group -->
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Giới tính
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->					
		<div class="form-group">
			<select class="form-control" id="gioitinhthem">
				<option value="1">Nam</option>
				<option value="0">Nữ</option>
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
			<input type="text" name="" class="form-control" value="" id="sodienthoaithem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Địa chỉ:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="text" name="" class="form-control" value="" id="diachithem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Mật khẩu:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="password" name="" class="form-control" id="matkhauthem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-4"> <!--Text -->
		Nhập lại mật khẩu:
	</div> <!--Text -->
	<div class="col-xs-8"> <!--Sua thong tin -->
		<div class="form-group">
			<input type="password" name="" class="form-control" id="nhaplaimatkhauthem">
		</div>
	</div>	<!-- Sua thong tin -->
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<button class="btn btn-success" id="nutthem">
			Thêm tài khoản
		</button>
		<button class="btn btn-secondary" data-dismiss="modal" id="dongthem">Đóng</button>				
	</div>		
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#nutthem').click(function(){
			var tenDangNhap = $('#tendangnhapthem').val();
			var loaiTaiKhoan = $('#loaitaikhoanthem').val();
			var hoTen = $('#hotenthem').val();
			var ngaySinh = $('#ngaysinhthem').val();
			var thangSinh = $('#thangsinhthem').val();
			var namSinh = $('#namsinhthem').val();
			var soDienThoai = $('#sodienthoaithem').val();
			var gioiTinh = $('#gioitinhthem').val();
			var diaChi = $('#diachithem').val();
			var matKhau = $('#matkhauthem').val();
			var nhapLaiMatKhau = $('#nhaplaimatkhauthem').val();
			var patpass = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,33}/;
			if (!patpass.test(matKhau) || !patpass.test(nhapLaiMatKhau)) {
				alert("Mật khẩu phải bao gồm chữ cái, số, ít nhất 6 ký tự và không quá 32 ký tự");
			} else if (matKhau == nhapLaiMatKhau) {

				$.ajax({
				    url: 'quanly/quanlytaikhoan/kiemtrataikhoan-load.php',
					type: 'POST',
		        	dataType: 'text',
					data: {
						tendangnhap: tenDangNhap,						
					 }, success: function (data) {
					 	if (data == 1) {
					 		$('#thongbaothem').html("<div class='alert alert-danger'>Tên đăng nhập đã tồn tại!</div>");
					 	}	
					 	else {
					 		$.ajax({
							    url: 'quanly/quanlytaikhoan/themtaikhoan-load.php',
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
									diachi: diaChi,
									matkhau: matKhau
								 }, success: function (data) {
								 	$('#thongbaothem').html("<div class='alert alert-success'>Đã thêm!</div>");
								 	$('#danhsachtaikhoan').load('quanly/quanlytaikhoan/load-taikhoan.php');
								 	setTimeout(function(){
										$("#themtaikhoan").modal('toggle');
									}, 1000);
								}
							}); 
					 	}			 					   
					}
				}); 
			}  
			else {
				$('#thongbaothem').html("<div class='alert alert-danger'>Mật khẩu nhập lại không khớp</div>");
				$('#matkhauthem').val("");
				$('#nhaplaimatkhauthem').val("");				
			}
		})
	})
</script>