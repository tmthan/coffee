<?php
require_once __DIR__.'/../load.php';
if (!isset($_SESSION['tendangnhap'])) {
	header("location: /");
}
if (isset($_GET['mahoadon'])) {
	$mahoadon = locSo($_GET['mahoadon']);
}
else
{
	header('Location: /');
}

// Lấy thông tin đơn vị
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
		case 'Kho_Giay':
			$khoGiay = $noiDung;
			break;
		case 'Co_Chu':
			$coChu = $noiDung;
			break;
		
		default:
			# code...
			break;
	}
}
// Lấy các món trong hóa đơn

$sql = "SELECT `hoa_don`.`Ma_Hoa_Don`, `hoa_don`.`Thoi_Gian_Bat_Dau`, `hoa_don`.`Thoi_Gian_Ket_Thuc`, `ban`.`Ten_Ban`, `ho_so`.`Ho_Ten`, `hoa_don`.`Tong_Tien`, `hoa_don`.`Phu_Thu`, `hoa_don`.`Ly_Do_Phu_Thu`, `hoa_don`.`Phu_Thu_Tat_Ca`, `hoa_don`.`Ly_Do_Phu_Thu_Tat_Ca`, `hoa_don`.`Giam_Gia`, `hoa_don`.`Giam_Gia_Tat_Ca`, `hoa_don`.`Thanh_Tien`, `hoa_don`.`Khach_Tra`, `hoa_don`.`Tien_Thua` FROM `hoa_don`, `ban`, `ho_so` WHERE (`ban`.`Ma_Ban` = `hoa_don`.`Ma_Ban` AND `ho_so`.`Ten_Dang_Nhap` = `hoa_don`.`Ten_Dang_Nhap` AND `hoa_don`.`Ma_Hoa_Don` = $mahoadon);";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()){	
	$ngayBD = substr( $row['Thoi_Gian_Bat_Dau'], 8, 2) . "/" . substr( $row['Thoi_Gian_Bat_Dau'], 5, 2) . "/" . substr( $row['Thoi_Gian_Bat_Dau'], 0, 4);	// hien thi ngay gio theo dinh dang viet nam
	$gioBD = substr( $row['Thoi_Gian_Bat_Dau'], 10, 6);	// lay thoi gian
	$ngayKT = substr( $row['Thoi_Gian_Ket_Thuc'], 8, 2) . "/" . substr( $row['Thoi_Gian_Ket_Thuc'], 5, 2) . "/" . substr( $row['Thoi_Gian_Ket_Thuc'], 0, 4);	// hien thi ngay gio theo dinh dang viet nam
	$gioKT = substr( $row['Thoi_Gian_Ket_Thuc'], 10, 6);	// lay thoi gian
	$tenBan = $row['Ten_Ban'];
	$phucVu = $row['Ho_Ten'];
	
	$phuThu = $row['Phu_Thu'];
	$lyDoPhuThu = $row['Ly_Do_Phu_Thu'];
	$phuThutatca = $row['Phu_Thu_Tat_Ca'];
	$lyDoPhuThuTatCa = $row['Ly_Do_Phu_Thu_Tat_Ca'];
	$giamGia = $row['Giam_Gia'];
	$giamGiaTatCa = $row['Giam_Gia_Tat_Ca'];
	$thanhTien = $row['Thanh_Tien'];
	$khachTra = $row['Khach_Tra'];
	$tienThua = $row['Tien_Thua'];
}

$tongTien = 0;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Hóa đơn tạm tính <?php echo($tenBan);?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<script type="text/javascript" src="../include/js/jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<style type="text/css">
		body {
			font-size: <?php echo($coChu); ?>pt;
		}
	</style>
</head>
<body>
<div style="width: <?php echo($khoGiay); ?>mm; padding: 5mm; margin: 0 auto;">
	<!-- Nút in hóa đơn -->
	<div class="btn btn-default" id="inhoadon"><span class="glyphicon glyphicon-print"></span> In hóa đơn (Ctrl + P)</div>	
	<table>
		<tr>
			<td style="max-width: 30mm">
				<div class="text-center">
					<img src="../include/logo/<?php echo($logo) ?>" style="max-width: 100%">
				</div>	
			</td>
			<td>
				<div class="text-center"><?php echo($tenDonVi); ?>
					<br>
					<?php echo($diaChi); ?>
					<br>					
				</div>	
			</td>
		</tr>
	</table>
	<div class="text-center">
		<br>HÓA ĐƠN TẠM TÍNH<br><br>
	</div>	

	<table>
		<tr>
			<td>
				Bàn: 
			</td>
			<td>
				&nbsp <?php echo($tenBan); ?>
			</td>
		</tr>
		<tr>
			<td>
				Số phiếu: 
			</td>
			<td>
				&nbsp <?php echo($mahoadon); ?>
			</td>
		</tr>
		<tr>
			<td>
				
					Giờ vào: 
				
			</td>
			<td>
				
					&nbsp <?php echo($gioBD); ?>
					-
					<?php echo($ngayBD); ?>
				
			</td>
		</tr>		
		<tr>
			<td>
				Phục vụ: 
			</td>
			<td>
				&nbsp <?php echo($phucVu);?>
			</td>
		</tr>		
	</table>
<br>

<table border=0 width="100%">
<tr style="border-bottom: 1px solid #333">	
	<td style="width: 50%;">
		<b>Tên</b>
	</td>
	<td class="text-center" style="width: 10%;">
		<b>SL</b>
	</td>
	<td class="text-right" style="width: 20%;">
		<b>Đ.Giá</b>
	</td>
	<td class="text-right" style="width: 20%;">
		<b>T.Tiền</b>
	</td>
</tr>


<?php
/* tranh cac mon an da bi trung lap */
// lay ma mon an, loai bo cac ban tin trung nhau
$sql = "SELECT DISTINCTROW `chi_tiet_hoa_don`.`Ma_Mon` FROM `chi_tiet_hoa_don`, `hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Hoa_Don` = `hoa_don`.`Ma_Hoa_Don` AND `chi_tiet_hoa_don`.`trang_thai_nau` <= 3 AND `hoa_don`.`Ma_Hoa_Don` = $mahoadon AND `chi_tiet_hoa_don`.`trang_thai_nau` > -1;";
$result = $conn->query($sql);



while ($row = $result->fetch_assoc()){	
	$mamon = $row['Ma_Mon'];	// lay duoc ma mon

	// Lay ten mon
	$sql2 = "SELECT `mon_an`.`Ten_Mon` FROM `mon_an` WHERE `mon_an`.`Ma_Mon` = $mamon;";
	$result2 = $conn->query($sql2);
	while ($row2 = $result2->fetch_assoc()) {
		$tenmon = $row2['Ten_Mon']; // Lay duoc ten mon		
	}

	// Lay so luong
	$sql3 = "SELECT SUM(`chi_tiet_hoa_don`.`So_Luong`) as `So_Luong` FROM `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = $mamon AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = $mahoadon AND `chi_tiet_hoa_don`.`trang_thai_nau` > -1;";
	$result3 = $conn->query($sql3);
	while ($row3 = $result3->fetch_assoc()) {
		$soluong = $row3['So_Luong'];	// lay duoc so luong
	}

	// Lay gia

	$sql4 = "SELECT DISTINCTROW `chi_tiet_hoa_don`.`Gia` FROM `chi_tiet_hoa_don` WHERE `chi_tiet_hoa_don`.`Ma_Mon` = $mamon AND `chi_tiet_hoa_don`.`Ma_Hoa_Don` = $mahoadon AND `chi_tiet_hoa_don`.`trang_thai_nau` > -1;";
	$result4 = $conn->query($sql4);
	while ($row4 = $result4->fetch_assoc()) {
		$gia = $row4['Gia'];	// lay duoc gia tien
		$tonggia = $gia * $soluong;	// Tinh tong gia cua moi mon
		$tongTien += $tonggia;
	}

	

	// In ra noi dung hoa don
	echo "<tr style='border-bottom: 1px dotted #eee;'><td style='width: 50%;'>$tenmon</td><td style='width: 10%;' class='text-center'>$soluong</td><td class='text-right' style='width: 20%;'>" . number_format($gia, 0) . "đ</td><td class='text-right' style='width: 20%;'>" . number_format($tonggia, 0) . "đ</td></tr>";
}



mysqli_free_result($result);	// Giai phong bo nho
mysqli_close($conn);			// Dong ket noi

function docTien($amount)
{
         if($amount <0)
        {
            return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "nghìn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);
        
        for ($i = 0; $i < $length; $i++)
        $unread[$i] = 0;
        
        for ($i = 0; $i < $length; $i++)
        {               
            $so = substr($amount, $length - $i -1 , 1);                
            
            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($amount,$length - $j -1, 1);
                    if ($so1 != 0)
                        break;
                }                       
                       
                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                        $unread[$k] =1;
                }
            }
        }
        
        for ($i = 0; $i < $length; $i++)
        {        
            $so = substr($amount,$length - $i -1, 1);       
            if ($unread[$i] ==1)
            continue;
            
            if ( ($i% 3 == 0) && ($i > 0))
            $textnumber = $TextLuythua[$i/3] ." ". $textnumber;     
            
            if ($i % 3 == 2 )
            $textnumber = 'trăm ' . $textnumber;
            
            if ($i % 3 == 1)
            $textnumber = 'mươi ' . $textnumber;
            
            
            $textnumber = $Text[$so] ." ". $textnumber;
        }
        
        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
        
        return ucfirst($textnumber." đồng");
}

?>
<tr style="border-top: 1px solid #333; margin-top: 5px; padding-top:  5px;">	
	<td width="80%" colspan="3" class="text-right">Tổng cộng: </td>
	<td width="20%" class="text-right"><b><?php echo(number_format($tongTien, 0));?>đ</b></td>
</tr>
<?php 

// Xử lý hiển thị phụ thu

if ($phuThu > 0 || $phuThutatca > 0) {
	echo '
<tr>	
	<td width="80%" class="text-right" colspan="3">Phụ thu: </td>
	<td width="20%" class="text-right">';
	if ($phuThu > 0) {
		echo(number_format($phuThu, 0)); echo 'đ';
	}
	if ($phuThu > 0 && $phuThutatca > 0) {
		// Trường hợp có cả 2 phụ thu thì sẽ có một dấu xuống dòng
		echo "<br>";
	}
	if ($phuThutatca > 0) {
		echo(number_format($phuThutatca, 0)); echo 'đ';
	} 
	echo'</td>
</tr>
<tr>
	<td width="100%" colspan="4" class="text-right">
		Lý do phụ thu: '; 
		if ($phuThu > 0) {
			echo($lyDoPhuThu);
		}
		if ($phuThu > 0 && $phuThutatca > 0) {
			echo ', ';
		}
		if ($phuThutatca > 0) {
			echo($lyDoPhuThuTatCa);
		}		
		echo '
	</td>
</tr>
	';
}

// Xử lý hiển thị giảm giá

if ($giamGia > 0 || $giamGiaTatCa > 0) {
	echo '
<tr>
	<td width="50%"></td>	
	<td width="30%" class="text-right" colspan="2">Giảm giá:</td>
	<td width="20%" class="text-right">';
	if ($giamGia > 0) {
		echo(number_format($giamGia, 0));
		echo "đ";
	}
	if ($giamGia > 0 && $giamGiaTatCa > 0) {
		echo "<br>";
	}
	if ($giamGiaTatCa > 0) {
		echo(number_format($giamGiaTatCa, 0));
		echo "đ";
	}
	echo '</td>
</tr>
	';
}

?>
<tr style="">		
	<td width="90%" class="text-right" style="background: #fdfdfd;" colspan="3"><b>Thành tiền: </b></td>
	<td width="20%" class="text-right" style="background: #fdfdfd;"><b><?php echo(number_format($thanhTien, 0));?>đ</b></td>
</tr>
<tr>
	<td colspan="4" class="text-right">
		<i><?php echo(docTien($thanhTien));; ?></i>
	</td>
</tr>
</table>
<br>
<div class="text-center">
	Xin cảm ơn quý khách và hẹn gặp lại
</div>
<br>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		//window.print();
		// Bat su kien an vao nut in
		$('#inhoadon').click(function(){
			$('#inhoadon').hide();	// an nut in
			window.print();
		})

		//  Bat su kien nhan Ctrl + P
		var checkCtrl=false
	    $('*').keydown(function(e){
	        if(e.keyCode=='17'){
	            checkCtrl=true
	        }
	    }).keyup(function(ev){
	        if(ev.keyCode=='17'){
	            checkCtrl=false
	        }
	    }).keydown(function(event){
	        if(checkCtrl){
	            if(event.keyCode=='80'){
	                $('#inhoadon').hide();
	            }
	        }
	    })
	 // window.onfocus=function(){ window.close();} // Tự động đóng sau khi in xong
	});

</script>
</body>
</html>
<?php 
if (isset($result2)) {
	mysqli_free_result($result2);
}
if (isset($result3)) {
	mysqli_free_result($result3);
}
if (isset($result4)) {
	mysqli_free_result($result4);
}
?>