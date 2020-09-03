<?php
require_once __DIR__.'/../../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
} ?>
<table class="table">
	<thead>
		<tr class="bg-blue">
			<th>Tên hàng hóa</th>
			<th>Đơn vị tính</th>
			<th class="text-right">Số lượng</th>
		</tr>
	</thead>
	<tbody>
<?php 
/* Xem danh sách các món và số lượng trong kho */

$sql = "SELECT `hang_hoa`.`Ma_Hang`, `hang_hoa`.`Ten_Hang`, `luu_kho_hang`.`So_Luong`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `luu_kho_hang`, `don_vi_tinh` WHERE `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `luu_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang` AND `luu_kho_hang`.`Ma_Luu_Kho` = (select max(`Ma_Luu_Kho`) FROM `luu_kho_hang` WHERE `luu_kho_hang`.`Ma_Hang` = `hang_hoa`.`Ma_Hang`);";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
	$maHang = $row['Ma_Hang'];
	$tenHang = $row['Ten_Hang'];
	$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];	
	$soLuong = $row['So_Luong'];
	echo '
		<tr data-toggle="modal" data-target="#khohang' . $maHang . '">
			<td>' . $tenHang . '</td>
			<td>' . $tenDonViTinh . '</td>
			<td class="text-right">' . $soLuong . '</td>
		</tr>
	';
	echo '
			<!-- Modal Dialogs  -->
            <!-- Default Size -->
            <div class="modal fade" id="khohang' . $maHang . '" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Nhập - Xuất: ' . $tenHang . '</h4>
                        </div>
                        <div class="modal-body">
                        	<div id="nhapxuatkho' . $maHang . '"></div>
                        </div>                       
                    </div>
                </div>
            </div>
	';
	echo '<script type="text/javascript">
			$(document).ready(function(){
				$("#nhapxuatkho' . $maHang . '").load("quanly/luukhohang/nhapxuatkho.php?mahang=' . $maHang . '");
			});			
		  </script>';
}
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
 ?>		
	</tbody>
</table>