<?php
/**
* Xử lý đăng nhập
* Tên đăng nhập được gán vào biến $tenDangNhap
* Mật khẩu được má hóa md5 2 lần rồi gán vào biến $matKhau
* Lấy tên đăng nhập và loại tài khoản trong CSDL với điều kiện truy vấn là tên đăng nhập và mật khẩu đã mã hóa
* Nếu lấy được, gán biến session tên đăng nhập và loại tài khoản. Chuyển hướng về trang chủ, đăng nhập thành công
* Nếu không có thì thông báo đăng nhập thất bại, hiện form đăng nhập với tên đăng nhập đã được nhập sẵn
*/
?>


<!DOCTYPE html>
<html>
<head>
	<title>Đang đăng nhập</title>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="include/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="include/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="include/css/jquery.timepicker.min.css">
	<link rel="stylesheet" type="text/css" href="include/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script type="text/javascript" src="include/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="include/js/bootstrap.min.js"></script>
	<script src="include/js/jquery-ui.min.js"></script>
	<script src="include/js/jquery.timepicker.min.js"></script>	
	<script src="include/js/admin.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
<?php
/* Nạp file cấu hình */
require_once( dirname( __FILE__ ). '/load.php');

/* lấy tên đăng nhập từ form */
$tenDangNhap = locKyTu($_POST['tendangnhap']);

/* Lấy mật khẩu từ form, mã hóa md5 2 lần */
$matKhau = md5(md5($_POST['matkhau']));

/* Câu lệnh sql để kiểm tra thông tin đăng nhập, lấy tên đăng nhập và loại tài khoản */
$sql = "SELECT `Ten_Dang_Nhap`, `Loai_Tai_Khoan` FROM `tai_khoan` WHERE `Ten_Dang_Nhap` = '$tenDangNhap' AND `Mat_Khau` = '$matKhau';";	// cau lenh sql kiem tra thong tin dang nhap

/* Thực thi câu truy vấn SQL */
$result = $conn->query($sql);

if ($row = $result->fetch_assoc()){
	/* Nếu có dữ liệu trả về, khởi tạo biến session, lưu tên đăng nhập và loại tài khoản vào session */	
	$_SESSION['tendangnhap'] = $row['Ten_Dang_Nhap'];
	$_SESSION['loaitaikhoan'] = $row['Loai_Tai_Khoan'];
	echo "Đăng nhập thành công! <br> Nhấp vào <a href='index.php'> đây </a> để tiếp tục";	
	if (isset($result)) {
		mysqli_free_result($result);
	}
	mysqli_close($conn);
	header('Location: /');	// chuyen huong ve trang chu
}
else {
	/* Ngược lại, hiển thị giao diện thông báo lỗi và form đăng nhập */
	echo '
	<div class="container">	
	<div class="row">	
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<br><br><br><br><br>
			<div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Đăng nhập
                    </h2>                            
                </div>
                <div class="body">
                <div class="alert alert-danger">Sai tên đăng nhập hoặc mật khẩu</div>
                    <form method="post" action="dangnhap-load.php">
                    	<div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tendangnhap" class="form-control" id="username" placeholder="Tên đăng nhập" value="' . $tenDangNhap . '">
                            </div>
                        </div>						
						<div class="form-group">
							<div class="form-line">
                                <input type="password" name="matkhau" class="form-control" id="password" placeholder="Mật khẩu">
                            </div>							
						</div>						
							<input type="submit" name="submit" value="Đăng nhập" class="btn btn-success btn-block">
					</form>
                </div>
            </div>			
			<div id="status">
				<!-- Trạng thái đăng nhập -->				
			</div>	
		</div>	
	</div>
</div>
	';
}
mysqli_close($conn);
?>
</body>
</html>