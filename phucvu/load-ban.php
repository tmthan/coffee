<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

if (!isset($_SESSION['loaitaikhoan']) || $_SESSION < 2) {
	header('Location: / ');	// Chan truy cap trai phep
}

$sql2 = "SELECT * FROM `khu_vuc` WHERE `Xoa`=0;";
$result2 = $conn->query($sql2);
while ($row2 = $result2->fetch_assoc()) {
	$maKhuVuc = $row2['Ma_Khu_Vuc'];
	$tenKhuVuc = $row2['Ten_Khu_Vuc'];
	echo '<script>$("#khuvuc' . $maKhuVuc . '").click(function(){$("#framekhuvuc' . $maKhuVuc . '").slideToggle()});</script>';
	echo "<div class='tenkhuvuc' id='khuvuc$maKhuVuc'><h2> $tenKhuVuc </h2></div><div class='frameban' id='framekhuvuc$maKhuVuc'>";

	// Ứng với mỗi khu vực, lấy bàn dựa theo khu vực đó
	// Lấy danh sách bàn theo khu vực
	$sql = "SELECT `Ma_Ban`, `Ten_Ban`, `Trang_Thai_Phuc_Vu` FROM `ban` WHERE `Trang_Thai_Phuc_Vu` > -1 AND `Ma_Khu_Vuc`=$maKhuVuc;";


	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()){
		$maBan = $row['Ma_Ban'];
		$tenBan = $row['Ten_Ban'];
		$trangThaiPhucVu = $row['Trang_Thai_Phuc_Vu'];
		
		/**
		* Lay thong tin ban roi hien thi danh sach ban cung trang thai dang phuc vu hay dang trong
		* Gan moi ban mot id gom "ban" + "maban"
		* Thay doi ten ban trong thanh thong tin ban co id #tenban
		* Bat su kien click, khi click vao ban se hien thi hoa don dang phuc vu cho ban do
		*/

		if ($trangThaiPhucVu == 1) {

			// Khi bàn có phục vụ thì làm việc bình thường
			echo "<div class='ban ban-ban' id='ban$maBan'>
					<div class='tenban'>
						<div class='icon-ban'>
							<i class='fas fa-mug-hot'></i>
						</div>
						<div class='content-ban'>
							$tenBan
						</div>
					</div>
				</div>
				<script type='text/javascript'>
					$(document).ready(function(){ 
						$('#ban$maBan').click(function(){	
							$('#tenban').text('$tenBan'); 
							$('#tenban').addClass('text-center'); 
							$('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan'); 
							$('body,html').animate({scrollTop: $('#tenban').offset().top-50 ,}, 500); 
						}); 
					}); 
				</script>";
		}
		else
		{	
			/* Bàn trống thì sẽ phục vụ ngay  */
			echo "<div class='ban ban-trong' id='ban$maBan'>
					<div class='tenban'>
						<div class='icon-ban'>
							<i class='fas fa-mug-hot'></i>
						</div>
						<small>$tenBan</small>
					</div>
				</div>
				<script type='text/javascript'>
					$(document).ready(function(){ 
						$('#ban$maBan').click(function(){	
							$.ajax({
					            url: 'phucvu/moban.php',
					            type: 'POST',
						        dataType: 'text',
					            data: {	                
					                maban: $maBan               
					            }, success: function () {            
					              	$('#tenban').text('$tenBan');  
									$('#tenban').addClass('title'); 
									$('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan'); 
									$('body,html').animate({scrollTop: $('#tenban').offset().top-50 ,}, 500);
									$('#danhsachban').load('phucvu/load-ban.php');
					            }
				         	}); 
						}); 
					}); 
				</script>";
		}
	
	}
	echo "</div>";
}

if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);			// Dong ket noi
?>