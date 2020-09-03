<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 1) {
	header('Location: index.php');
}
?>
<div class="bang">
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên món</th>
			<th class="text-center">Số lượng</th>
			<th>Ghi chú</th>
			<th>Người gọi</th>
			<th class="text-center">Thời gian</th>
			<th>Bàn</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
<?php

// Lay ma hoa don

$sql = "SELECT `chi_tiet_hoa_don`.`Ma_Chi_Tiet`, `mon_an`.`Ten_Mon`, `chi_tiet_hoa_don`.`So_Luong`, `chi_tiet_hoa_don`.`Ghi_Chu`, `ho_so`.`Ho_Ten`, `chi_tiet_hoa_don`.`Thoi_Gian_Goi`, `ban`.`Ten_Ban`, `chi_tiet_hoa_don`.`Trang_Thai_Nau` FROM `chi_tiet_hoa_don`, `ho_so`, `mon_an`, `ban`, `hoa_don` WHERE `mon_an`.`Ma_Mon` = `chi_tiet_hoa_don`.`Ma_Mon` AND `ho_so`.`Ten_Dang_Nhap` = `chi_tiet_hoa_don`.`Nguoi_Goi` AND `ban`.`Ma_Ban` = `hoa_don`.`Ma_Ban` AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = `hoa_don`.`Ma_Hoa_Don` AND (`chi_tiet_hoa_don`.`Trang_Thai_Nau` = 0 OR `chi_tiet_hoa_don`.`Trang_Thai_Nau` = 1) ORDER BY `chi_tiet_hoa_don`.`Thoi_Gian_Goi`;";	//lay danh sach cac mon cho nau

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()){
	$maChiTiet = $row['Ma_Chi_Tiet'];
	$tenMon = $row['Ten_Mon'];
	$soLuong = $row['So_Luong'];
	$ghiChu = $row['Ghi_Chu'];
	$nguoiGoi = $row['Ho_Ten'];
	$thoiGianGoi = substr($row['Thoi_Gian_Goi'], 10, 6);
	$ban = $row['Ten_Ban'];
	$trangThaiNau = $row['Trang_Thai_Nau'];

	echo "<tr>
		<td>
			$tenMon
		</td>
		<td class='text-center'>
			$soLuong
		</td>
		<td>
			$ghiChu
		</td>
		<td>
			$nguoiGoi
		</td>
		<td class='text-center'>
			$thoiGianGoi
		</td>
		<td>
			$ban
		</td>";

	// Neu mon chua nau thi hien nut nau mau xanh
	if ($trangThaiNau == 0) {
		echo "<td>
			<button class='btn btn-default' id='nau$maChiTiet'>
				Pha chế
			</button>
		</td>
	</tr>";

	// ajax thuc hien hanh dong nau

	echo "<script type='text/javascript'>
				/* khi click vao nut nau */
			    $(document).ready(function(){
			    	$('#nau$maChiTiet').click(function(){
				      $.ajax({
				        url: 'daubep/nau.php',
				        type: 'POST',
		        		dataType: 'text',
				        data: {
				            machitiet: $maChiTiet
				        }, success: function () {
				            $('#nau$maChiTiet').hide();
				            $('#danhsachchonau').load('daubep/load-danhsachnau.php');            
				        }
				      });      
				    });
			    })
			</script>";

	}
	else

	// Neu mon dang nau thi hien nut nau xong mau vang
	{
		echo "<td>
			<button class='btn btn-success ' id='nauxong$maChiTiet'>
				Xong
			</button>
			<button class='btn btn-secondary' id='huynau$maChiTiet'>Hủy</button>
		</td>
	</tr>";

	// ajax thuc hien hanh dong nau xong

	echo "<script type='text/javascript'>
				/* khi click vao nut nau */
			    $(document).ready(function(){
			    	$('#nauxong$maChiTiet').click(function(){
				      $.ajax({
				        url: 'daubep/nauxong.php',
				        type: 'POST',
		        		dataType: 'text',
				        data: {
				            machitiet: $maChiTiet
				        }, success: function () {
				            $('#nauxong$maChiTiet').hide();
				            $('#danhsachchonau').load('daubep/load-danhsachnau.php');
				        }
				      });      
				    });
				    $('#huynau$maChiTiet').click(function(){
				      $.ajax({
				        url: 'daubep/huynau.php',
				        type: 'POST',
		        		dataType: 'text',
				        data: {
				            machitiet: $maChiTiet
				        }, success: function () {
				            $('#huynau$maChiTiet').hide();
				            $('#danhsachchonau').load('daubep/load-danhsachnau.php');
				        }
				      });      
				    });
			    })
			</script>";
	}

}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>		
	</tbody>
</table>
</div><!-- het bang -->