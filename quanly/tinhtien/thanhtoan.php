<?php  
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] < 3) {
	header('Location: index.php');
}

$maHoaDon = locSo($_GET['mahoadon']);

/*Lấy thông tin bàn của hóa đơn */
$sql = "SELECT `loai_ban`.`Ten_Loai_Ban`, `ban`.`Ma_Ban`, `ban`.`Ten_Ban` FROM `loai_ban`, `ban`, `hoa_don` WHERE `hoa_don`.`Ma_Ban` = `ban`.`Ma_Ban` AND `ban`.`Ma_Loai_Ban` = `loai_ban`.`Ma_Loai_Ban` AND `hoa_don`.`Ma_Hoa_Don` = $maHoaDon;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoaiBan = $row['Ten_Loai_Ban'];
	$maBan = $row['Ma_Ban'];
	$tenBan = $row['Ten_Ban'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Thanh toán <?php echo($tenBan); ?></title>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="../../include/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../include/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../../include/css/jquery.timepicker.min.css">
	<link rel="stylesheet" type="text/css" href="../../include/css/waves.css">
	<link rel="stylesheet" type="text/css" href="../../include/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script type="text/javascript" src="../../include/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../include/js/bootstrap.min.js"></script>
	<script src="../../include/js/jquery-ui.min.js"></script>
	<script src="../../include/js/jquery.timepicker.min.js"></script>	
	<script src="../../include/js/waves.js"></script>	
	<script src="../../include/js/admin.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container">	
	<div class="row clearfix">
		<div class="col-md-12">
			<div class="hoadon">
				<div class="header bg-light-green">
					<h2>Thanh toán <?php echo($tenBan); ?></h2>
				</div>
				<div class="body">
					<div class="form-group">
					<table class="table table-borderless">
						<thead>
							<tr class="bg-blue">
								<th>
									Tên đồ uống
								</th>
								<th class="text-center">
									Số lượng
								</th>
								<th class="text-right">
									Giá
								</th>
								<th>
									Trạng thái
								</th>
							</tr>
						</thead>
						<tbody>
<?php 


// Lấy danh sách đồ ăn
$sql = "SELECT `chi_tiet_hoa_don`.`Ma_Chi_Tiet`, `mon_an`.`Ten_Mon`, `chi_tiet_hoa_don`.`So_Luong`, `chi_tiet_hoa_don`.`Gia`, `chi_tiet_hoa_don`.`Trang_Thai_Nau`, `chi_tiet_hoa_don`.`Nguoi_Nau` FROM `mon_an`, `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = $maHoaDon AND `chi_tiet_hoa_don`.`Trang_Thai_Nau` > -1;";
$result = $conn->query($sql);
 $tongTien = 0;	// tong so tien
 while ($row = $result->fetch_assoc()){	
 	$maChiTiet = $row['Ma_Chi_Tiet'];
	$tenMon = $row['Ten_Mon'];
	$soLuong = $row['So_Luong'];
	$gia = $row['Gia'];
	$trangThaiNau = $row['Trang_Thai_Nau'];	

	$tongTien = $tongTien + $gia * $soLuong;	// Tinh tong tien		
	echo "<tr>";
	echo "<td>$tenMon</td><td class='text-center'>$soLuong</td><td class='text-right'>" . number_format($gia) . "</td>";
	if ($trangThaiNau == 0) {
		echo "<td>Chưa pha chế</td>";
	} else if ($trangThaiNau == 1) {
		echo "<td>Đang pha chế</td>";
	} else if ($trangThaiNau == 2) {
		echo "<td>Pha chế xong</td>";
	} else if ($trangThaiNau == 3) {
		echo "<td>Món không pha chế</td>";
	}
	echo "</tr>";
}
echo "<tr><td colspan='2'><b>Tổng cộng</b></td><td class='text-right'><b>" . number_format($tongTien) . "</b></td></tr>";

/* Lấy thông tin thanh toán hóa đơn đã được nhân viên phục vụ nhập vào */

$sql = "SELECT `Phu_Thu`,`Ly_Do_Phu_Thu`, `Phu_Thu_Tat_Ca`, `Ly_Do_Phu_Thu_Tat_Ca`, `Giam_Gia`, `Giam_Gia_Tat_Ca`, `Thanh_Tien` FROM `hoa_don` WHERE `Ma_Hoa_Don` = $maHoaDon;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$phuThu = $row['Phu_Thu'];
	$lyDoPhuThu = $row['Ly_Do_Phu_Thu'];
	$phuThuTatCa = $row['Phu_Thu_Tat_Ca'];
	$lyDoPhuThuTatCa = $row['Ly_Do_Phu_Thu_Tat_Ca'];
	$giamGia = $row['Giam_Gia'];
	$giamGiaTatCa = $row['Giam_Gia_Tat_Ca'];
	$thanhTien = $row['Thanh_Tien'];
}
?>							
								<tr>
									<td colspan="2">Phụ thu:</td>
									<td>
										<div class="form-line">
											<input type="number" name="phuthu" id="phuthu" step="1000" class="form-control text-right" value="<?php echo($phuThu); ?>">
										</div>
									</td>
								</tr>
								<tr>
									<td>Lý do phụ thu:</td>
									<td colspan="2">
										<div class="form-line">
											<input type="text" name="lydophuthu" id="lydophuthu" value="<?php echo($lyDoPhuThu); ?>" class="form-control">
										</div>
									</td>
									<td>
										<div class="form-line">
											<select id="chonlydo" class="form-control">
												<option>Chọn lý do phụ thu</option>
<?php 
/* Lấy ra tên loại bàn để gợi ý lý do phụ thu */

$sql3 = "SELECT `Ten_Loai_Ban` FROM `loai_ban` WHERE `Xoa` = 0;";
$result3 = $conn->query($sql3);
while ($row3 = $result3->fetch_assoc()) {
	$tenLoaiBan3 = $row3['Ten_Loai_Ban'];
	echo "<option value='$tenLoaiBan3'";
	if ($tenLoaiBan3 == $tenLoaiBan) {
	echo " style='color: tomato;' selected='selected'";
	}	
	echo ">$tenLoaiBan3";
	if ($tenLoaiBan3 == $tenLoaiBan) {
		echo " (Chọn)";
	}
	echo "</option>";
	echo "$tenLoaiBan3";
}
?>
											</select>
										</div>
										<script type="text/javascript">
											$("#chonlydo").change(function(){
												var lyDo = $("#chonlydo").val();
												$("#lydophuthu").val(lyDo);
											});
										</script>
									</td>									
								</tr>
								<tr>
									<td colspan="2">
										Phụ thu cho tất cả hóa đơn:
									</td>
									<td>
										<div class="form-line">
											<input type="number" name="" id="phuthutatca" class="form-control text-right" value="<?php echo($phuThuTatCa); ?>" readonly>
										</div>
									</td>
									<td>
										<div class="form-line">
											<input type="text" name="" id="lydophuthutatca" class="form-control" value="<?php echo($lyDoPhuThuTatCa); ?>" placeholder="Lý do phụ thu cho tất cả hóa đơn">
										</div>
									</td>
								</tr>
								<tr>
									<td>
										Giảm giá:
									</td>
									<td>
										<div class="text-right">
											<input type="number" name="giamgia" class="text-right" id="giamgiaphantram" placeholder="%" min="0" max="100" style="width: 50px; border-bottom: 1px solid #ddd; border-top: none; border-right: none; border-left: none;">
										
											<input type="number" name="giamgia" class="text-right" id="giamgia" placeholder="Tiền" min="0" value="0" step="1000" value="<?php echo($giamGia); ?>" style="width: calc(100% - 60px); border-bottom: 1px solid #ddd; border-top: none; border-right: none; border-left: none;">
										</div>
									</td>
									<td>
										G.giá cho T.cả hóa đơn:
									</td>
									<td>
										<div class="form-line">
											<input type="number" name="" class="form-control" id="giamgiatatca" value="<?php echo($giamGiaTatCa); ?>" readonly>
										</div>
									</td>									
								</tr>
								<tr>
									<td colspan="2">
										<b>Thành tiền:</b>
									</td>
									<td class="text-right">
										<b id="thanhtien"></b>
									</td>
								</tr>
								<tr>
									<td>
										Khách trả: 
									</td>
									<td class="text-right">
										<div class="form-line">
											<input type="number" name="khachtra" id="khachtra" class="text-right form-control" step="1000" min="0" value="0">
										</div>
									</td>
									<td>
										Tiền thừa:
									</td>
									<td class="text-right">
										<b id="tienthua" style="color: red;">
										</b>
									</td>
								</tr>
							
						</tbody>
					</table>
					</div><!-- form-group -->
					<div id="thongbaothanhtoan"></div>
					<button class="btn btn-success btn-block" id="thanhtoan">Thanh toán</button>
					<button class="btn btn-default btn-block" id="dong">Đóng</button>
				</div><!-- body -->
			</div><!-- card -->
		</div><!-- col-md-12 -->
	</div>	<!-- row -->
</div><!-- container -->
<script type="text/javascript">
	// Lưu các biến toàn cục để sử dụng
	var tongTien = 0;
	var phuThu = 0;
	var lyDoPhuThu = "";
	var phuThuTatCa = 0;
	var lyDoPhuThuTatCa = "";
	var giamGia = 0;
	var giamGiaTatCa = 0;
	var thanhTien = 0;
	var khachTra = 0;
	var tienThua = 0;
	// Tính tiền
	function tinhTien()
	{
		tongTien = <?php echo($tongTien); ?>;
		phuThu = parseInt($("#phuthu").val());
		lyDoPhuThu = $("#lydophuthu").val();
		phuThuTatCa = parseInt($("#phuthutatca").val());
		lyDoPhuThuTatCa = $("#lydophuthutatca").val();
		giamGia = parseInt($("#giamgia").val());
		giamGiaTatCa = parseInt($("#giamgiatatca").val());
		thanhTien = tongTien + phuThu + phuThuTatCa - giamGia - giamGiaTatCa;
		khachTra = parseInt($("#khachtra").val());
		tienThua = khachTra - thanhTien;
		$("#thanhtien").text(formatNumber(thanhTien));
		if (tienThua < 0) {
			$("#tienthua").text("Chưa nhập tiền khách trả");
		} else {
			$("#tienthua").text(formatNumber(tienThua));	
		}
	}
	// Định dạng tiền tệ
	function formatNumber(num) {
	  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
	}
	// Bắt các sự kiện để tính tiền
	$(document).ready(function(){
		tinhTien();
		$("#phuthu").change(function(){
			tinhTien();
		});
		$("#giamgia").change(function(){
			tinhTien();
		});		
		$("#khachtra").change(function(){
			tinhTien();			
		});
		$("#khachtra").click(function(){
			$(this).select();
		});
		$("#giamgiaphantram").change(function(){
			var tongTien = <?php echo($tongTien); ?>;
			var phuThu = parseInt($("#phuthu").val());
			var phanTram = parseInt($("#giamgiaphantram").val());
			var giamGia = (tongTien + phuThu) * phanTram / 100;			
			$("#giamgia").val(giamGia);
			tinhTien();
		});

		$("#dong").click(function(){
			window. close();
		});
		// Xử lý click nút thanh toán

		$("#thanhtoan").click(function(){
			$.ajax({
		        url: 'thanhtoan-load.php',
		        type: 'POST',
			    dataType: 'text',
		        data: {
		            mahoadon: <?php echo($maHoaDon); ?>,
		            maban: <?php echo($maBan); ?>,
		            tongtien: tongTien,
		            phuthu: phuThu,
		            lydophuthu: lyDoPhuThu,
		            phuthutatca: phuThuTatCa,
		            lydophuthutatca: lyDoPhuThuTatCa,
		            giamgia: giamGia,
		            giamgiatatca: giamGiaTatCa,
		            thanhtien: thanhTien,
		            khachtra: khachTra,
		            tienthua: tienThua,
		        }, success: function (data) {            	        
		            $('#thongbaothanhtoan').html(data);		            
		            if (data == "<div class='alert alert-success'>Đã thanh toán. Vui lòng đóng cửa sổ này và làm mới danh sách bàn để in hóa đơn</div>") {
		            	window.open('../../phucvu/inhoadon.php?mahoadon=<?php echo($maHoaDon); ?>', 'Hóa đơn', 'width=600,height=600');
		            }		            
		        }
		    });
		});		
	});
</script>
</body>
</html>
<?php 
if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
if (isset($result3)) {
	mysqli_free_result($result3);
}
mysqli_close($conn);
?>