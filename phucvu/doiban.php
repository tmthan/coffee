<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] < 2) {
	header('Location: index.php');
}

$maBanCu = locSo($_GET['mabancu']);
$maHoaDonCu = locSo($_GET['mahoadoncu']);
/* Lấy tên bàn cũ */
$sql = "SELECT `Ten_Ban` FROM `ban` WHERE `Ma_Ban` = $maBanCu;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$tenBanCu = $row['Ten_Ban'];
}
?>
<div id="thongbaodoiban"></div>
<div class="row">
	<div class="col-xs-4">
		<label>
			Bàn hiện tại:
		</label>
	</div>
	<div class="col-xs-8">
		<label>
			<?php echo($tenBanCu); ?>
		</label>
	</div>
</div><!-- row -->
<div class="row">
	<div class="col-xs-4">
		<label>
			Đổi sang bàn:
		</label>
	</div>
	<div class="col-xs-8">
		<div class="form-group">
			<select class="form-control" id="banmoidoi">
				<?php
				/* Lấy ra danh sách các bàn đang trống*/
				$sql = "SELECT `Ma_Ban`, `Ten_Ban` FROM `ban` WHERE `Trang_Thai_Phuc_Vu` = 0;";
				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) {
					$maBanMoi = $row['Ma_Ban'];
					$tenBanMoi = $row['Ten_Ban'];
					echo "<option value='$maBanMoi'>$tenBanMoi</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-8 col-xs-offset-4">
		<div class="form-group">
			<button class="btn btn-success" id="xacnhandoiban">Đổi bàn</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
		</div>
	</div>
</div><!-- row -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#xacnhandoiban").click(function(){
			var maBanCu = <?php echo($maBanCu); ?>;
			var maBanMoi = $("#banmoidoi").val();
			var maHoaDonCu = <?php echo($maHoaDonCu) ?>;
			$.ajax({
			    url: "phucvu/doiban-load.php",
			    type: "POST",
			    dataType: "text",
			    data: {
			        mabancu: maBanCu,
			        mabanmoi: maBanMoi,
			        mahoadoncu: maHoaDonCu
			    }, 
			    success: function (tenBanMoi) {			        
			        $("#thongbaodoiban").html("<div class='alert alert-success'>Đổi bàn thành công. Đang chuyển sang bàn mới</div>");
			        $(".doiban").modal('toggle');
			        setTimeout(function(){			        	
			            $("#hoadon").load("phucvu/load-hoadon.php?maban=" + maBanMoi);
			            $("#danhsachban").load("phucvu/load-ban.php");
			            $("#tenban").text(tenBanMoi);
			        }, 1000);
			    }
			});
		});
	});
</script>
<?php
if (isset($result)) {
	mysqli_free_result($result);
}
mysqli_close($conn);
?>