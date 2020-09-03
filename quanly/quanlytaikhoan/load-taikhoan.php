<?php 
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
 ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên đăng nhập</th>
			<th>Họ tên</th>
			<th>Loại tài khoản</th>
		</tr>
	</thead>
	<tbody>
<?php
if (!isset($_SESSION['loaitaikhoan']) || $_SESSION < 2) {
	header('Location: / ');	// Chan truy cap trai phep
}
$sql = "SELECT `ho_so`.`Ten_Dang_Nhap`, `ho_so`.`Ho_Ten`, `tai_khoan`.`Loai_Tai_Khoan`, `tai_khoan`.`Xoa` FROM `tai_khoan`, `ho_so` WHERE `tai_khoan`.`Ten_Dang_Nhap` = `ho_so`.`Ten_Dang_Nhap` AND `tai_khoan`.`Xoa` = 0;";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()){
	$tenDangNhap = $row['Ten_Dang_Nhap'];
	$hoTen = $row['Ho_Ten'];
	$loaiTaiKhoan = $row['Loai_Tai_Khoan'];
	
	if ($loaiTaiKhoan == 1) {
		echo "<tr data-toggle='modal' data-target='#taikhoan" . $tenDangNhap . "'>
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Pha chế</td>
			</tr>";
	}
	elseif ($loaiTaiKhoan == 2) {
		echo "<tr data-toggle='modal' data-target='#taikhoan" . $tenDangNhap . "'>
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Phục vụ</td>
			</tr>";
	}
	elseif ($loaiTaiKhoan == 3) {
		echo "<tr data-toggle='modal' data-target='#taikhoan" . $tenDangNhap . "'>
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Quản lý</td>
			</tr>";
	}
	elseif ($loaiTaiKhoan == 4) {
		echo "<tr data-toggle='modal' data-target='#taikhoan" . $tenDangNhap . "'>
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Thu ngân</td>
			</tr>";
	}

	echo '
	<!-- Modal -->
	<div class="modal fade" id="taikhoan' . $tenDangNhap .'" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Cập nhật: ' . $hoTen . '</h5>	        
	      </div>
	      <div class="modal-body">
	        <div id="thongtintaikhoan' . $tenDangNhap . '"></div>	        
	      </div>	      
	    </div>
	  </div>
	</div>
	';
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 					
					$('#thongtintaikhoan" . $tenDangNhap . "').load('quanly/quanlytaikhoan/load-thongtintaikhoan.php?tendangnhap=$tenDangNhap');
				}) 
			</script>";	
}

?>		
	</tbody>
</table>
<div class="header">
	<h2>Danh sách tài khoản đã xóa</h2>
</div>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên đăng nhập</th>
			<th>Họ tên</th>
			<th>Loại tài khoản</th>
			<th>Khôi phục</th>
		</tr>
	</thead>
	<tbody>
<?php

$sql = "SELECT `ho_so`.`Ten_Dang_Nhap`, `ho_so`.`Ho_Ten`, `tai_khoan`.`Loai_Tai_Khoan`, `tai_khoan`.`Xoa` FROM `tai_khoan`, `ho_so` WHERE `tai_khoan`.`Ten_Dang_Nhap` = `ho_so`.`Ten_Dang_Nhap` AND `tai_khoan`.`Xoa` = 1;";


$result = $conn->query($sql);

while ($row = $result->fetch_assoc()){
	$tenDangNhap = $row['Ten_Dang_Nhap'];
	$hoTen = $row['Ho_Ten'];
	$loaiTaiKhoan = $row['Loai_Tai_Khoan'];
	
	if ($loaiTaiKhoan == 1) {
		echo "<tr>
				
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Pha chế</td>
				<td><button class='btn btn-success' id='khoiphuc$tenDangNhap'>Khôi phục</button></td>
				
			</tr>";
	}
	elseif ($loaiTaiKhoan == 2) {
		echo "<tr>
				
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Phục vụ</td>
				<td><button class='btn btn-success' id='khoiphuc$tenDangNhap'>Khôi phục</button></td>
				
			</tr>";
	}
	elseif ($loaiTaiKhoan == 3) {
		echo "<tr>
				
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Quản lý</td>
				<td><button class='btn btn-success' id='khoiphuc$tenDangNhap'>Khôi phục</button></td>
				
			</tr>";
	}
	elseif ($loaiTaiKhoan == 4) {
		echo "<tr>
				
				<td>$tenDangNhap</td>
				<td>$hoTen</td>
				<td>Thu ngân</td>
				<td><button class='btn btn-success' id='khoiphuc$tenDangNhap'>Khôi phục</button></td>
				
			</tr>";
	}	
		// bat su kien click
	echo "<script type='text/javascript'>
				$(document).ready(function(){ 
					$('#khoiphuc$tenDangNhap').click(function(){				
						var tenDangNhap = '$tenDangNhap';			
						$.ajax({
						    url: 'quanly/quanlytaikhoan/khoiphuc-load.php',
							type: 'POST',
		        			dataType: 'text',
							data: {
								tendangnhap: tenDangNhap,					
							 }, success: function (data) {
								$('#thongbao').html(data);	
								$('#danhsachtaikhoan').load('quanly/quanlytaikhoan/load-taikhoan.php'); 	 
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
mysqli_close($conn);
?>		
	</tbody>
</table>