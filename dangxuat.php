<?php
/**
* Đăng xuất
* Kiểm tra xem có tồn tại biến session loại tài khoản hay chưa
* Nếu có thì hủy biến session, đăng xuất
* Nếu chưa có, nghĩa là người dùng chưa đăng nhập, thông báo người dùng chưa đăng nhập, chuyển hướng về trang chủ
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Đang đăng xuất</title>
</head>
<body>
<?php
require_once __DIR__.'/load.php';
if (isset($_SESSION['loaitaikhoan'])) {	// kiem tra xem co dang nhap hay chua
	session_destroy();	// huy phien dang nhap
	echo "Đăng xuất thành công! <br> Nhấp vào <a href='index.php'> đây </a> để đăng nhập lại";
	header('Location: /');	// chuyen huong ve trang chu
}
else {
	echo "Bạn chưa đăng nhập";
	header('Location: /');
}
?>
</body>
</html>