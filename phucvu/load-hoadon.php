<?php  
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$maBan = locSo($_GET['maban']);	// lay ma ban ?>

<button class="btn btn-default" id="lamtuoihoadon">
	<i class="fas fa-sync-alt"></i>
	Làm mới
</button>
<button class="btn btn-default" id="quaylai">
	<i class="fas fa-chevron-left"></i>
	Danh sách bàn
</button>
<button class="btn btn-default xemtrangthai">
	<i class="fas fa-concierge-bell"></i>
	Trạng thái
</button>
<script type="text/javascript">
	$(document).ready(function(){ 
		$('#lamtuoihoadon').click(function(){
			// Lam tuoi hoa don
			$('#hoadon').load('phucvu/load-hoadon.php?maban=<?php echo($maBan) ?>');
		});
		$("#quaylai").click(function(){
			$('body,html').animate({
				scrollTop: 0 ,
			}, 500);
		});
		$(".xemtrangthai").click(function(){
			$('body,html').animate({
				scrollTop: $('#trangthai').offset().top-100
			}, 500);
		});
	});
</script>
<div class="form-group">
<div class="bang">
<table class="table table-borderless">
	<thead>
		<th>
			Tên món
		</th>
		<th class="text-right">
			Số lượng
		</th>
		<th class="text-right">
			Giá
		</th>
		<th>
			Ghi chú
		</th>
		<th>
			Trạng thái
		</th>
		<th>
			Người pha chế
		</th>
		<th>
			Hủy
		</th>
	</thead>
	<tbody>
	
<?php
// lấy phụ thu cho tất cả hóa đơn và khuyến mãi cho tất cả hóa đơn
$sql = "SELECT * FROM `thiet_lap`;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maThietLap = $row['Ma_Thiet_Lap'];
	$noiDung = $row['Noi_Dung'];
	switch ($maThietLap) {		
		case 'Phu_Thu':
			$phuThuTatCa = $noiDung;
			break;
		case 'Ly_Do_Phu_Thu':
			$lyDoPhuThuTatCa = $noiDung;
			break;
		case 'Giam_Gia':
			$giamGiaTatCa = $noiDung;
			break;
		default:
			# code...
			break;
	}
}		

// lay ma hoa don

$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `hoa_don`.`Trang_Thai_Thanh_Toan`, `hoa_don`.`Tong_Tien`, `hoa_don`.`Phu_Thu`, `hoa_don`.`Ly_Do_Phu_Thu`, `hoa_don`.`Giam_Gia`, `hoa_don`.`Thanh_Tien`, `hoa_don`.`Khach_Tra`, `hoa_don`.`Tien_Thua` FROM `hoa_don`, `ban`, `loai_ban` WHERE `hoa_don`.`Ma_Ban` = $maBan ORDER BY `Ma_Hoa_Don` DESC LIMIT 1;";	//lay ma


$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$maHoaDon = $row['Ma_Hoa_Don'];	
	$trangThaiThanhToan = $row['Trang_Thai_Thanh_Toan'];
	$tongTien = $row['Tong_Tien'];
	$phuThu = $row['Phu_Thu'];
	$lyDoPhuThu = $row['Ly_Do_Phu_Thu'];
	$giamGia = $row['Giam_Gia'];
	$thanhTien = $row['Thanh_Tien'];	
}

// lay tien phu thu, chưa thanh toán thì mới lấy giá phụ thu mới

if ($trangThaiThanhToan == 0) {
	$sql = "SELECT `loai_ban`.`Phu_Thu`, `loai_ban`.`Ten_Loai_Ban` FROM `loai_ban`, `ban` WHERE `ban`.`Ma_Loai_Ban` = `loai_ban`.`Ma_Loai_Ban` AND `ban`.`Ma_Ban` = $maBan;";	//lay ma


	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {
		if ($phuThu == 0) {
				$phuThu = $row['Phu_Thu'];
			}	
	}
}

// Lấy tên loại bàn của bàn (dùn cho gợi ý lý do phụ thu)

$sql = "SELECT `loai_ban`.`Ten_Loai_Ban` FROM `loai_ban`, `ban` WHERE `ban`.`Ma_Loai_Ban` = `loai_ban`.`Ma_Loai_Ban` AND `ban`.`Ma_Ban` = $maBan;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenLoaiBan = $row['Ten_Loai_Ban'];
}

// lay  hoa don
// Lấy danh sách đồ ăn
$sql = "SELECT `chi_tiet_hoa_don`.`Ma_Chi_Tiet`, `mon_an`.`Ten_Mon`, `chi_tiet_hoa_don`.`So_Luong`, `chi_tiet_hoa_don`.`Gia`, `chi_tiet_hoa_don`.`Ghi_Chu`, `chi_tiet_hoa_don`.`Trang_Thai_Nau`, `chi_tiet_hoa_don`.`Nguoi_Nau` FROM `mon_an`, `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = `mon_an`.`Ma_Mon` AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = $maHoaDon AND `chi_tiet_hoa_don`.`Trang_Thai_Nau` > -1;";
$result = $conn->query($sql);
 $tongTien = 0;	// tong so tien
 while ($row = $result->fetch_assoc()){	
 	$maChiTiet = $row['Ma_Chi_Tiet']; $tenmon = $row['Ten_Mon'];
	$soLuong = $row['So_Luong'];
	$gia = $row['Gia'];
	$ghiChu = $row['Ghi_Chu'];
	$trangThaiNau = $row['Trang_Thai_Nau'];
	$nguoiNau = $row['Nguoi_Nau'];	// ten dang nhap cua nguoi nau

	$sql2 = "SELECT `ho_so`.`Ho_Ten` FROM `ho_so` WHERE `ho_so`.`Ten_Dang_Nhap` = 'daubep';";	// lay ten nguoi nau
	$result2 = $conn->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$nguoiNau = $row2['Ho_Ten'];
	}

	$tongTien = $tongTien + $gia * $soLuong;	// Tinh tong tien	

	if ($trangThaiNau == 0) {
		echo "<tr><td>$tenmon</td><td class='text-right'>$soLuong</td><td class='text-right'>" . number_format($gia) . "</td><td>$ghiChu &nbsp</td>
		<td>Chưa pha chế</td><td> &nbsp </td><td><button class='btn btn-danger' id='huymon$maChiTiet'>Hủy</button></td></tr>";
		echo "<script type='text/javascript'>
		  /* khi click vao nut huy */
		    $('#huymon$maChiTiet').click(function(){
		      $.ajax({
		        url: 'phucvu/huymon-load.php',
		        type: 'POST',
		        dataType: 'text',
		        data: {
		            machitiet: $maChiTiet,
		            trangthainau: $trangThaiNau,
		        }, success: function () {		         
		          $('#huymon$maChiTiet').hide();
		          $('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan');
		        }
		      });
		    })
		</script>";

	} else if ($trangThaiNau == 3) {
		// Đây là các món không pha chế
		if ($trangThaiThanhToan == 0) {
			// Khi hóa đơn chưa thanh toán thì có thể hủy món
			echo "<tr><td>$tenmon</td><td class='text-right'>$soLuong</td><td class='text-right'>" . number_format($gia) . "</td><td>$ghiChu &nbsp</td>
				<td>K.Pha chế</td><td> &nbsp </td><td><button class='btn btn-danger' id='huymon$maChiTiet'>Hủy</button></td></tr>";
				echo "<script type='text/javascript'>
				  /* khi click vao nut huy */
				    $('#huymon$maChiTiet').click(function(){
				      $.ajax({
				        url: 'phucvu/huymon-load.php',
				        type: 'POST',
		        		dataType: 'text',        
				        data: {
				            machitiet: $maChiTiet,
				            trangthainau: $trangThaiNau,
				        }, success: function () {		         
				          $('#huymon$maChiTiet').hide();
				          $('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan');
				        }
				      });
				    })
				</script>";
		} else {
			// Hóa đơn thanh toán rồi thì không xuất hiện nút hủy nữa
			echo "<tr><td>$tenmon</td><td class='text-right'>$soLuong</td><td class='text-right'>$gia</td>
			<td>K.Pha chế</td><td> &nbsp </td><td>Không thể hủy</td></tr>";			
		}
		
	}

	elseif ($trangThaiNau == 1)
	{
		echo "<tr><td>$tenmon</td><td class='text-right'>$soLuong</td><td class='text-right'>" . number_format($gia, 0) . "</td><td>$ghiChu &nbsp</td><td>Đang pha chế</td><td>$nguoiNau</td><td>K.thể hủy</td></tr>";
	}
	else
	{
		echo "<tr><td>$tenmon</td><td class='text-right'>$soLuong</td><td class='text-right'>" . number_format($gia, 0) . "</td><td>$ghiChu &nbsp</td><td>Pha chế xong</td>
		<td>$nguoiNau</td><td>K.thể hủy<td></tr>";
	}
}

/* Kiểm tra trạng thái thanh toán 
* Đã thanh toán rồi thì không hủy đồ uống được 
*/

$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `hoa_don`.`Trang_Thai_Thanh_Toan` FROM `hoa_don` WHERE `hoa_don`.`Ma_Ban` = $maBan ORDER BY `hoa_don`.`Ma_Hoa_Don` DESC LIMIT 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){	
	$trangThaiThanhToan = $row['Trang_Thai_Thanh_Toan'];	// Lay thong tin trang thai thanh toan	
}

?>
	</tbody>
</table>
<table class="table table-borderless">
	<tbody>
<tr>
	<td colspan="2"><b>Tổng cộng</b></td>
	<td class="text-right"><b><?php echo (number_format($tongTien, 0)); ?></b></td>
	<td colspan="2">
		Phụ thu:
	</td>
	<td class="text-right">
		<?php 
		if ($phuThu > 0 && $phuThu <= 100) {
			$phuThu = $tongTien * $phuThu / 100;
		}
		?>
		<div class="form-line">
			<input type="number" name="phuthu" class="text-right form-control" id="phuthu" step="1000" min="0" value="<?php echo($phuThu); ?>">
		</div>
	</td>	
</tr>
<tr>
	<td>Lý do phụ thu:</td>
	<td colspan="3">
		<div class="form-line">
			<input type="text" name="lydophuthu" class="form-control" id="lydophuthu" value="<?php echo($lyDoPhuThu); ?>">
		</div>
	</td>
	<td colspan="2">
		<div class="form-line">
			<select id="chonlydo" class="form-control">
				<option>Chọn nhanh lý do phụ thu</option>
				<?php 
					$sql3 = "SELECT `Ten_Loai_Ban` FROM `loai_ban` WHERE `Xoa` = 0;";
					$result3 = $conn->query($sql3);
					while ($row3 = $result3->fetch_assoc()) {
						$tenLoaiBan3 = $row3['Ten_Loai_Ban'];
						echo "<option value='$tenLoaiBan3'";
						if ($tenLoaiBan3 == $tenLoaiBan) {
							echo " style='color: tomato;'";
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
		<?php 
		if ($phuThuTatCa > 0 && $phuThuTatCa <= 100) {
			$phuThuTatCa = $tongTien * $phuThuTatCa / 100;
		}
		echo "<div class='line'><input type='number' step='1000' id='phuthutatca' value='$phuThuTatCa' class='form-control' readonly></div>";
		?>
	</td>
	<td>
		Lý do:
	</td>
	<td colspan="2">
		<?php
			echo "<div class='line'><input type='text' id='lydophuthutatca' value='$lyDoPhuThuTatCa' class='form-control'></div>";
		?>
	</td>
</tr>
<tr>
	<td>
		Giảm giá:
	</td>
	<td>
		<div class="form-line">
			<input type="number" name="giamgia" class="text-right form-control" id="giamgiaphantram" placeholder="%" min="0" max="100">
		</div>
	</td>
	<td class="text-right">		
		<div class="form-line">
			<input type="number" name="giamgia" class="text-right form-control" id="giamgia" placeholder="Tiền" min="0" step="1000" value="<?php echo($giamGia); ?>">
		</div>
	</td>
	<td colspan="2">
		Giảm giá cho tất cả hóa đơn
	</td>
	<td class="text-right">
		<?php 
		if ($giamGiaTatCa > 0 && $giamGiaTatCa <= 100) {
			$giamGiaTatCa = $tongTien * $giamGiaTatCa / 100;
		}
		?>
		<div class="form-line">
			<input type="number" name="giamgia" class="text-right form-control" id="giamgiatatca" placeholder="Tiền" min="0" step="1000" value="<?php echo($giamGiaTatCa); ?>" readonly>
		</div>
	</td>
</tr>
<tr>
	<td class="text-right">
		Thành tiền:
	</td>
	<td class="text-right">
		<b id="thanhtien"><?php echo($thanhTien); ?></b>
	</td>
</tr>
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
		$("#giamgiaphantram").change(function(){
			var tongTien = <?php echo($tongTien); ?>;
			var phuThu = parseInt($("#phuthu").val());
			var phanTram = parseInt($("#giamgiaphantram").val());
			var giamGia = (tongTien + phuThu + phuThuTatCa) * phanTram / 100;			
			$("#giamgia").val(giamGia);
			tinhTien();
		});
	});
</script>
<?php

// Kiem tra trang thai thanh toan

$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `hoa_don`.`Trang_Thai_Thanh_Toan` FROM `hoa_don` WHERE `hoa_don`.`Ma_Ban` = $maBan ORDER BY `hoa_don`.`Ma_Hoa_Don` DESC LIMIT 1;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){	
	$trangThaiThanhToan = $row['Trang_Thai_Thanh_Toan'];	// Lay thong tin trang thai thanh toan
	$maHoaDon = $row['Ma_Hoa_Don'];
	if ($trangThaiThanhToan == 0) {	// Neu cha thanh toan thi chi hien nut thanh toan
		thanhtoan($maHoaDon, $maBan, $tongTien);
	}
	elseif ($trangThaiThanhToan == 1) {		// Neu thanh toan roi thi cho phep mo ban va xem lai hoa don
		xemHoaDon($maBan, $maHoaDon);
	}
}

function thanhToan($maHoaDon, $maBan, $tongTien){
	echo "<tr>
			<td colspan='6'>
				<button class='btn btn-success' data-toggle='modal' data-target='.goimon'>Gọi món</button>
				<button class='btn btn-default' id='luuhoadon$maHoaDon'>Lưu hóa đơn</button>
				<button class='btn btn-default' id='inhoadontamtinh$maHoaDon'>In phiếu tạm tính</button>
				<button class='btn btn-default' data-toggle='modal' data-target='.doiban'>Đổi bàn</button>
				<button class='btn btn-default' data-toggle='modal' data-target='.gopban'>Gộp bàn</button>
				<button class='btn btn-default' id='huyhoadon$maHoaDon'>Hủy hóa đơn</button>
			</td>
				<div class='modal fade goimon' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
					<div class='modal-dialog modal-lg'> <div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal'>
								<span aria-hidden='true'>&times;</span>
								<span class='sr-only'>Đóng</span>
							</button>
							<h2 class='modal-title'><b>MENU</b></h2>
						</div><!--modal header -->
						<div class='modal-body' id='goimon'>
							Nội dung menu
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Xong</button>
						</div>
					</div>
					</div>
				</div><!-- hết modal gọi món -->
				<!-- modal đổi bàn -->	
				<div class='modal fade doiban' tabindex='-1' role='dialog' aria-hidden='true'>
				  <div class='modal-dialog' role='document'>
				    <div class='modal-content'>
				      <div class='modal-header'>
				        <h2 class='modal-title'>Đổi bàn</h2>
				      </div>
				      <div class='modal-body'>
				        <div id='doiban'></div>
				      </div>	      
				    </div>
				  </div>
				</div><!-- hết modal đổi bàn -->	
				<!-- modal gộp bàn -->	
				<div class='modal fade gopban' tabindex='-1' role='dialog' aria-hidden='true'>
				  <div class='modal-dialog' role='document'>
				    <div class='modal-content'>
				      <div class='modal-header'>
				        <h2 class='modal-title'>Gộp bàn</h2>
				      </div>
				      <div class='modal-body'>
				       	<div id='gopban'></div>
				      </div>	      
				    </div>
				  </div>
				</div><!-- hết modal gộp bàn -->
		</tr>";		// mo cua so popup goi mon
	echo "<script type='text/javascript'>
   /* khi click vao nut luu hoa don */
        $('document').ready(function(){
        	$('#luuhoadon$maHoaDon').click(function(){  
        		tinhTien();      		
		        $.ajax({
		            url: 'phucvu/luuhoadon-load.php',
		            type: 'POST',
			        dataType: 'text',
		            data: {
		                mahoadon: $maHoaDon,
		                maban: $maBan,
		                tongtien: $tongTien,
		                phuthu: phuThu,
		                lydophuthu: lyDoPhuThu,
		                phuthutatca: phuThuTatCa,
		                lydophuthutatca: lyDoPhuThuTatCa,
		                giamgia: giamGia,
		                giamgiatatca: giamGiaTatCa,
		                thanhtien: thanhTien,	               
		            }, success: function (data) {            
		              $('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan');
		              $('#thongbaothanhtoan').html(data);
		              setTimeout(function(){
						$('#thongbaothanhtoan').html('');
						}, 3000);
		            }
         		});
         	})
         	$('#inhoadontamtinh$maHoaDon').click(function(){         		
         		window.open('phucvu/inhoadontamtinh.php?mahoadon=$maHoaDon', 'Hóa đơn', 'width=600,height=600');
         	});
         	$('#huyhoadon$maHoaDon').click(function(){         		
         		var tongTien = $tongTien;
         		if (tongTien > 0) {
         			alert('Hóa đơn đã được gọi món, không thể hủy');
         		} else {
         			$.ajax({
			            url: 'phucvu/huyban-load.php',
			            type: 'POST',
				        dataType: 'text',
			            data: {
			                mahoadon: $maHoaDon,
			                maban: $maBan,			                               
			            }, success: function (data) {  
				            $('body,html').animate({
								scrollTop: 0 ,
							}, 500); 
			            	$('#tenban').removeClass('title');
			            	$('#tenban').html('');
			              	$('#hoadon').html('');
			              	$('#danhsachban').load('phucvu/load-ban.php');
			            }
	         		}); // het ajax
         		}
         	});
        });
		</script>";	// Goi ajax den file thanh toan
}

function xemHoaDon($maBan, $maHoaDon){
	echo "<tr><td colspan='6'><button class='btn btn-success' id='moban'>Phục vụ</button> <button class='btn btn-default' id='inhoadon'>In hóa đơn</button></td></tr>";
	echo "<script type='text/javascript'>
   /* khi click vao nut phucvu */
        $('document').ready(function(){
        	$('#moban').click(function(){
	          $.ajax({
	            url: 'phucvu/moban.php',
	            type: 'POST',
		        dataType: 'text',
	            data: {	                
	                maban: $maBan               
	            }, success: function () {            
	              $('#hoadon').load('phucvu/load-hoadon.php?maban=$maBan');
	            }
         	});         	
        	});
        	$('#inhoadon').click(function(){
        		window.open('phucvu/inhoadon.php?mahoadon=$maHoaDon', 'Hóa đơn', 'width=600,height=600');
         		
         	});
        })
		</script>";	// Goi ajax den file mo ban
}

 mysqli_free_result($result);
 if (isset($result2)) {
 	mysqli_free_result($result2);
 }
 mysqli_close($conn);
?>
<script type='text/javascript'>	
	// Tai danh sach goi mon
    $('#goimon').load('phucvu/goimon.php?mahoadon=<?php echo($maHoaDon); ?>'); 
    $("#doiban").load('phucvu/doiban.php?mabancu=<?php echo($maBan) ?>&mahoadoncu=<?php echo($maHoaDon); ?>');
    $("#gopban").load('phucvu/gopban.php?mabancu=<?php echo($maBan) ?>&mahoadoncu=<?php echo($maHoaDon); ?>');
</script>
</tbody>
</table></div><!-- bang -->
</div><!-- form-group -->