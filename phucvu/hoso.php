<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
} ?>
<div class="menu">
  <div class="right">
    <span id="phucvu" style="cursor: pointer;"><i class="fas fa-clipboard-list" title="Phục vụ"></i> Phục vụ</span>
    <span id="taikhoan" style="cursor: pointer;"><i class="fas fa-user" title="Tài khoản" id="taikhoan"></i> Tài khoản</span>
    <a href="dangxuat.php">
	    <i class="fas fa-power-off" title="Đăng xuất"></i>
	     Đăng xuất
    </a>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#phucvu").click(function(){
        $('#container').load('phucvu.php');
      });
      $("#taikhoan").click(function(){
        $('#container').load('phucvu/hoso.php');        
      });
    });
  </script>
</div>
<div style="height: 60px;"></div>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-8">
			<div class="card">
				<div class="header bg-blue">
					<h2>Thông tin tài khoản</h2>
				</div>
				<div class="body">
		<?php			
			
			$tenDangNhap = $_SESSION['tendangnhap'];

			$sql = "SELECT `ho_so`.`Ten_Dang_Nhap`, `tai_khoan`.`Loai_Tai_Khoan`, `ho_so`.`Ho_Ten`, `ho_so`.`Nam_Sinh`, `ho_so`.`Gioi_Tinh`, `ho_so`.`So_Dien_Thoai`, `ho_so`.`Dia_Chi` FROM `tai_khoan`, `ho_so` WHERE `ho_so`.`Ten_Dang_Nhap` = `tai_khoan`.`Ten_Dang_Nhap` AND `ho_so`.`Ten_Dang_Nhap` = '$tenDangNhap';";
		

			$result = $conn->query($sql);
			while ($row = $result->fetch_assoc()) {
				$hoTen = $row['Ho_Ten'];
				$loaiTaiKhoan = $row['Loai_Tai_Khoan'];
				switch ($loaiTaiKhoan) {
					case 1:
						$loaiTaiKhoan = "Đầu bếp";
						break;
					case 2:
						$loaiTaiKhoan = "Phục vụ";			
						break;
					case 3:
						$loaiTaiKhoan = "Quản lý";
						break;
					
					default:
						# code...
						break;
				}
				$ngaySinh = substr( $row['Nam_Sinh'], 8, 2);
				$thangSinh = substr( $row['Nam_Sinh'], 5, 2);
				$namSinh = substr( $row['Nam_Sinh'], 0, 4);
				$gioiTinh = $row['Gioi_Tinh'];
				if ($gioiTinh == 1) {
					$gioiTinh = "Nam";
				}
				else {
					$gioiTinh = "Nữ";
				}
				$soDienThoai = $row['So_Dien_Thoai'];
				$diaChi = $row['Dia_Chi'];
			}
			?>		<div class="row">
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
							<?php echo "$loaiTaiKhoan"; ?>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-xs-4"> <!--Text -->
							Họ tên:
						</div> <!--Text -->
						<div class="col-xs-8"> <!--Sua thong tin -->
							<?php echo($hoTen); ?>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-xs-4"> <!--Text -->
							Năm sinh:
						</div> <!--Text -->
						<div class="col-xs-8"> <!--Sua thong tin -->
							<?php echo "$ngaySinh"; ?>
							/
							<?php echo "$thangSinh"; ?>
							/
							<?php echo "$namSinh"; ?>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-xs-4"> <!--Text -->
							Giới tính
						</div> <!--Text -->
						<div class="col-xs-8"> <!--Sua thong tin -->					
							<?php echo "$gioiTinh";	 ?>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-xs-4"> <!--Text -->
							Số điện thoại:
						</div> <!--Text -->
						<div class="col-xs-8"> <!--Sua thong tin -->
							<?php echo($soDienThoai); ?>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-xs-4"> <!--Text -->
							Địa chỉ:
						</div> <!--Text -->
						<div class="col-xs-8"> <!--Sua thong tin -->
							<?php echo($diaChi); ?>
						</div>	<!-- Sua thong tin -->
					</div>
					
				</div><!-- body -->
			</div><!-- card -->
		</div><!-- col-md-8 -->
		<div class="col-md-4">
			<div class="card">
				<div class="header bg-blue">
					<h2>Đổi mật khẩu</h2>
				</div>
				<div class="body">
					<div class="row">
						<div class="col-md-4"> <!--Text -->
							Mật khẩu cũ:
						</div> <!--Text -->
						<div class="col-md-8"> <!--Sua thong tin -->
							<div class="form-group">
								<input type="password" name="" class="form-control" id="matkhaucu">
							</div>
							</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-md-4"> <!--Text -->
							Mật khẩu mới:
						</div> <!--Text -->
						<div class="col-md-8"> <!--Sua thong tin -->
							<div class="form-group">
								<input type="password" name="" class="form-control" id="matkhaumoi">
							</div>
						</div>	<!-- Sua thong tin -->
					</div>
					<div class="row">
						<div class="col-md-4"> <!--Text -->
							Nhập lại mật khẩu mới:
						</div> 
						<div class="col-md-8"> 
							<div class="form-group">
								<input type="password" name="" class="form-control" id="nhaplaimatkhaumoi">
							</div>
						</div>	
					</div>
					<div class="row">				
						<div class="col-md-8 col-md-offset-4"> <!--Sua thong tin -->
							<button class="btn btn-success" id="doimatkhau">
								Đổi mật khẩu
							</button>								
						</div>	<!-- Sua thong tin -->
					</div><!-- row -->					
					<div id="thongbao"></div>
				</div>
			</div>
		</div><!-- col-md-4 -->
	</div><!-- row -->
</div><!-- container -->
			<script type="text/javascript">
				$(document).ready(function(){
					$('#doimatkhau').click(function(){	
						var matKhauCu = $('#matkhaucu').val();
						var tenDangNhap = '<?php echo($tenDangNhap);?>';		
						var matKhauMoi = $('#matkhaumoi').val();
						var nhapLaiMatKhauMoi = $('#nhaplaimatkhaumoi').val();
						var patpass = /(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{5,33}/;
						if (!patpass.test(matKhauMoi) || !patpass.test(nhapLaiMatKhauMoi)) {
							alert("Mật khẩu phải bao gồm chữ cái, số, ít nhất 6 ký tự và không quá 32 ký tự");
						} else if (matKhauMoi == nhapLaiMatKhauMoi) {
							$.ajax({
							    url: 'phucvu/doimatkhau-load.php',
								type: 'POST',
		        				dataType: 'text',
								data: {
									tendangnhap: tenDangNhap,
									matkhaucu: matKhauCu,
									matkhaumoi: matKhauMoi
								 }, success: function (data) {
									$('#thongbao').html(data);	
									$('#matkhaucu').val('');
									$('#matkhaumoi').val('');
							 		$('#nhaplaimatkhaumoi').val('');
										 
								   	setTimeout(function(){
								   	// sau 5 giay thi hien lai
								   	$('#thongbao').html('');							   	
								   }, 5000);							   
								}
							});   
						}
						else {
							$('#matkhaumoi').val('');
							$('#nhaplaimatkhaumoi').val('');
							$('#thongbao').html("<div class='alert alert-danger'>Mật khẩu nhập lại không khớp</div>");
							setTimeout(function(){
								$('#thongbao').html('');
							}, 5000)
						}
					})
				})
			</script>
<?php  
if (isset($result)) {
  mysqli_free_result($result);
}
mysqli_close($conn);
?>