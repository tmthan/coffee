<?php 
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
  header('Location: index.php');
} 
?>
<div class="margin-5">
	<div class="row" id="trangthaigoimon"></div>
	

	<?php

/**
* Giao diện gọi món
* Lấy thông tin tên món ăn trong bảng mon_an
* Lấy thông tin loại món ăn trong bảng loai_mon_an
* Hiển thị danh sách món ăn sắp xếp theo thứ tự bảng chữ cái
* Nhân viên phục vụ chọn số lượng
* Khi bấm nút Chọn, gửi ajax đến file goimon-load.php
*/ 
	if (isset($_GET['mahoadon'])) {
		$maHoaDon = locSo($_GET['mahoadon']);
	}
?>
<div id="thongbao"></div>
<div class="group-tabs">
  <!--nav tabs-->
  <ul class="nav nav-tabs" role="tablist">
    <?php
    $sql = "SELECT `Ma_Loai`, `Ten_Loai` FROM `loai_mon_an` WHERE `Xoa` = 0;";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
      $maLoai = $row['Ma_Loai'];
      $tenLoai = $row['Ten_Loai'];
      echo "<li role='presentation'><a href='#loai$maLoai' aria-controls='loai$maLoai' role='tab' data-toggle='tab'>$tenLoai</a></li>";      
    }    
    ?>
  </ul>
  <!--tab panes -->
  <div class="tab-content">
    <?php
    $sql = "SELECT `Ma_Loai`, `Ten_Loai` FROM `loai_mon_an` WHERE `Xoa` = 0;";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      $maLoai = $row['Ma_Loai'];
      $tenLoai = $row['Ten_Loai'];
      
      echo "<div role='tabpanel' class='tab-pane' id='loai$maLoai'><div class='bang'><table class='table table-borderless'>";
      $sql2 = "SELECT `mon_an`.`Ma_Mon`, `mon_an`.`STT`, `mon_an`.`Ten_Mon`, `loai_mon_an`.`Ten_Loai`, `mon_an`.`Gia`, `mon_an`.`Khong_Pha_Che` FROM `mon_an`, `loai_mon_an` WHERE `mon_an`.`Ma_Loai` = `loai_mon_an`.`Ma_Loai` AND `mon_an`.`Xoa` = 0 AND `loai_mon_an`.`Ma_Loai` = '$maLoai' ORDER BY `mon_an`.`STT`;";
      $result2 = $conn->query($sql2);      
      while ($row2 = $result2->fetch_assoc()){  
        /* Hiển thị dánh sách món ăn */
        $maMon = $row2['Ma_Mon'];
        $stt = $row2['STT'];
        $tenMon = $row2['Ten_Mon'];
        $tenLoai2 = $row2['Ten_Loai'];
        $gia = $row2['Gia'];
        $khongPhaChe = $row2['Khong_Pha_Che'];

        echo "<tr>
                <td style='padding-top: 15px;'> $stt) $tenMon</td>
                <td style='padding-top: 15px;'>"; echo(number_format($gia)); echo "</td>
                <td>
                    <button class='nut-tron' style='height: 34px; width: 34px;' id='giammon$maMon'><b> - </b></button>
                </td>
                <td><input type='text' style='width: 45px;' value='0' id='soluongmon$maMon' class='onhaplieu text-center'/></td>
                <td><button class='nut-tron' style='height: 34px; width: 34px;' id='tangmon$maMon'><b>+</b></button></td>
                <td>
                  <input type='text' id='ghichu$maMon' placeholder='Ghi chú...' class='onhaplieu'>
                </td>
                <td>
                  <div class='btn btn-primary' id='chonmon$maMon'>Chọn</div>
                </td>
              </tr>";
        echo "

            <script type='text/javascript'>
          $('document').ready(function(){

            /* khi click vao nut giam so luong */
            $('#giammon$maMon').click(function(){
              var soLuong = $('#soluongmon$maMon').val();
              soLuong--;
              if (soLuong >= 0){
                $('#soluongmon$maMon').val(soLuong);
              }      
            });
            /* khi click vao nut tang so luong */
            $('#tangmon$maMon').click(function(){
              var soLuong = $('#soluongmon$maMon').val();
              soLuong++;
              $('#soluongmon$maMon').val(soLuong);
            });
            
            /* khi click vao nut chon */
            $('#chonmon$maMon').click(function(){
              var soLuong = $('#soluongmon$maMon').val();
              var ghiChu = $('#ghichu$maMon').val();
              if (soLuong > 0)  // so luong phai lon hon 0 moi cho goi mon
              {
                $.ajax({
                url: 'phucvu/goimon-load.php',
                type: 'POST',
                dataType: 'text',
                data: {
                    mahoadon: $maHoaDon,
                    mamon: $maMon,
                    soluong: soLuong,
                    ghichu: ghiChu,
                    khongphache: $khongPhaChe,                    
                }, success: function (data) {
                    $('#chonmon$maMon').hide();
                    $('#soluongmon$maMon').val('');
                    $('#thongbao').html(data);
                    setTimeout(function(){
                      $('#thongbao').html('');
                    }, 3000);
                }
              });
              }
            });
          });
        </script>

            ";      
      }
      echo "</table></div>";      
      echo "</div><!--hết tabpanel-->";   
    }
  
?>
    
    
  
</div><!-- hết tabcontent -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.nav-tabs a:first').tab('show'); // Mở tab đầu tiên
  });
</script>
<?php
if (isset($result)) {
  mysqli_free_result($result);
}
if (isset($result2)) {
  mysqli_free_result($result2);
}
mysqli_close($conn);
?>
</div>