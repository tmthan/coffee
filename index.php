<?php
/**
* Tên phần mềm: CAFFEE
* Phiên bản: 1.0
* Tác giả: Trần Minh Thân
*/

require_once( dirname( __FILE__ ) . '/load.php' );
require_once( dirname( __FILE__ ) . '/include/header.php' );


/**
* Khởi tạo session
* Kiểm tra đã có biến session loại tài khoản chưa
* Nếu loại tài khoản = 1, tương ứng với đầu bếp nạp giao diện đầu bếp vào #container
* Nếu loại tài khoản = 2, tương ứng với nhân viên phục vụ, nạp giao diện phục vụ vào #container
* Nếu loại tài khoản = 3, tương ứng với nhân viên quản lý, nạp giao diện quản lý vào container
* Ngược lại, nếu chưa tồn tại biến session thì nạp giao diện đăng nhập vào #container
*/


	if (isset($_SESSION['loaitaikhoan'])) {	// kiem tra xe co session dang nhap chua
		if ($_SESSION['loaitaikhoan'] == 1) {
			/* Nạp giao diện đầu bếp */
			echo "<script type='text/javascript'> $('#container').load('daubep.php'); </script>";	
		}
		elseif ($_SESSION['loaitaikhoan'] == 2) {
			/* Nạp giao diện phục vụ */
			echo "<script type='text/javascript'> $('#container').load('phucvu.php'); </script>";	
		}
		elseif ($_SESSION['loaitaikhoan'] == 3) {
			/* Nạp giao diện quản lý */
			echo "<script type='text/javascript'> $('#container').load('quanly/thongke.php'); </script>";	
		} elseif ($_SESSION['loaitaikhoan'] == 4) {
			/* Nạp giao diện quản lý */
			echo "<script type='text/javascript'> $('#container').load('thungan/tinhtien.php'); </script>";	
		}
	}
	else
	{
		/* Nạp giao diện đăng nhập */
		echo "<script type='text/javascript'> $('#container').load('dangnhap.php'); </script>";	// form dang nhap
	}
	/** Nếu trình duyệt tắt hoặc không hỗ trợ javascript, người dùng sẽ không thể sử dụng phần mềm
	* Hiển thị thông báo lỗi
	* Nếu trình duyệt có javascript, #container sẽ được nạp vào nên sẽ không thấy thông báo này
	*/
echo "<div class='text-center'>
Đang tải dữ liệu, vui lòng chờ...
</div>";
require_once( dirname( __FILE__ ) . '/include/footer.php' );
?>
<script type="text/javascript">
	/* Vô hiệu hoá nút "back" trên trình duyệt */
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
<?php 

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
		case 'Ngay_Het_Han':
			$ngayHetHan = $noiDung;
			break;
		default:
			# code...
			break;
	}
}		
/* Tính xem còn bao nhiêu ngày nữa hết hạn dùng phần mềm */
$homNay = date('Y-m-d');
$ngayConLai = truNgay($ngayHetHan, $homNay);

if ($ngayConLai >= 0 && $ngayConLai <= 10) {
	echo "
	<script>
		$(document).ready(function(){
			alert('Bạn còn lại $ngayConLai ngày sử dụng phần mềm. Hãy liên hệ nhà cung cấp để gia hạn sử dụng.');
		});
	</script>
	";
} else if ($ngayConLai < 0) {
	header("Location: hethan.php");
}
?>