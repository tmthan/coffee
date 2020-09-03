<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] <3) {
	header('Location: index.php');
}
?>
<div class="bang">
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Bàn</th>			
			<th>NV phục vụ</th>			
			<th>TG bắt đầu</th>
			<th>Tổng tiền</th>
			<th>Giảm giá</th>
			<th>Phụ thu</th>
			<th>Thành tiền</th>
			<th>Thao tác</th>
		</tr>
	</thead>
	<tbody>
<?php 
// Lấy ra danh sách bàn, với mỗi bàn sẽ lấy ra hóa đơn mới nhất của bàn đó

$sql = "SELECT `ban`.`Ma_Ban`, `ban`.`Ten_Ban` FROM `ban` WHERE `ban`.`Trang_Thai_Phuc_Vu` >-1 ORDER BY `ban`.`Trang_Thai_Phuc_Vu` DESC, `ban`.`Ma_Ban` ASC;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$maBan = $row['Ma_Ban'];
	$tenBan = $row['Ten_Ban'];

	/* Với mỗi bàn sẽ lấy ra hóa đơn mới nhất */

	$sql2 = "SELECT `hoa_don`.`Ma_Hoa_Don`, `ho_so`.`Ho_Ten`, `hoa_don`.`Thoi_Gian_Bat_Dau`, `hoa_don`.`Tong_Tien`, `hoa_don`.`Giam_Gia`, `hoa_don`.`Phu_Thu`, `hoa_don`.`Thanh_Tien`, `hoa_don`.`Trang_Thai_Thanh_Toan`, `hoa_don`.`Thu_Ngan` FROM `hoa_don` LEFT JOIN `ho_so` ON `hoa_don`.`Ten_Dang_Nhap` = `ho_so`.`Ten_Dang_Nhap` WHERE `hoa_don`.`Ma_Ban` = $maBan ORDER BY `hoa_don`.`Ma_Hoa_Don` DESC LIMIT 1;";
	$result2 = $conn->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$maHoaDon = $row2['Ma_Hoa_Don'];
		$hoTen = $row2['Ho_Ten'];
		$thoiGianBatDau = $row2['Thoi_Gian_Bat_Dau'];
		$tongTien = $row2['Tong_Tien'];
		$giamGia = $row2['Giam_Gia'];
		$phuThu = $row2['Phu_Thu'];
		$thanhTien = $row2['Thanh_Tien'];
		$trangThaiThanhToan = $row2['Trang_Thai_Thanh_Toan'];

		echo "
			<tr>
				<td>
					$tenBan
				</td>
				<td>
					$hoTen
				</td>
				<td>
					$thoiGianBatDau
				</td>
				<td>
					$tongTien
				</td>				
				<td>
					$giamGia
				</td>
				<td>
					$phuThu
				</td>
				<td>
					$thanhTien
				</td>
		";
		if ($trangThaiThanhToan == 0) {
			echo "<td><button class='btn btn-default' id='inhoadontamtinh$maHoaDon'>In phiếu tạm tính</button> <button class='btn btn-success' id='thanhtoan$maHoaDon'>Thanh toán</button>";	
			echo "<script type='text/javascript'>			   
			        $('document').ready(function(){			        	
			        	$('#thanhtoan$maHoaDon').click(function(){
			        		var newWindow = window.open('thungan/tinhtien/thanhtoan.php?mahoadon=$maHoaDon', 'Hóa đơn', 'width=600,height=600');	
			        		newWindow.onbeforeunload = function(){
			        			$('#danhsachban').load('thungan/tinhtien/load-ban.php');
			        		}		         		
			         	});
			         	$('#inhoadontamtinh$maHoaDon').click(function(){
			        		var newWindow = window.open('phucvu/inhoadontamtinh.php?mahoadon=$maHoaDon', 'Hóa đơn', 'width=600,height=600');	
			        		newWindow.onbeforeunload = function(){
			        			$('#danhsachban').load('thungan/tinhtien/load-ban.php');
			        		}		         		
			         	});
			        })
					</script>";	// Goi ajax den file mo ban		
		} else if ($trangThaiThanhToan != 0)
		{
			echo "<td><button id='inhoadon$maHoaDon' class='btn btn-default'>In hóa đơn</button>";
			echo "<script type='text/javascript'>			   
			        $('document').ready(function(){			        	
			        	$('#inhoadon$maHoaDon').click(function(){
			        		var newWindow = window.open('phucvu/inhoadon.php?mahoadon=$maHoaDon', 'Hóa đơn', 'width=600,height=600');		
			        		newWindow.onbeforeunload = function(){
			        			$('#danhsachban').load('thungan/tinhtien/load-ban.php');
			        		}	         		
			         	});
			        })
					</script>";	// Goi ajax den file mo ban
		}
		echo "</td></tr>";
	}

} /* Hết vòng lặp thứ 1 */
if (isset($result)) {
	mysqli_free_result($result);
}
if (isset($result2)) {
	mysqli_free_result($result2);
}
mysqli_close($conn);
?>		
	</tbody>
</table></div><!-- bang -->