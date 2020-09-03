<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}
/* lay ngay thang hien tai */
$homNay = coverDateToVN(date('Y-m-d'));

require_once( dirname( __FILE__ ) . '/header.php' );
?>
<div class="block-header">
    <h2>Lịch sử nhập/xuất/tồn hàng hóa</h2>
</div>
<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="body">
				<div class="form-group">
					<div class="row">
						<div class="col-md2 col-sm-2 col-xs-4">
							<label>Từ:</label>
							<div class="form-line">
								<input type="text" name="thoigianbatdau" id="thoigianbatdau" value="<?php echo($homNay); ?>" class="form-control">
							</div>
						</div>
						<div class="col-md2 col-sm-2 col-xs-4">
							<label>Đến:</label>
							<div class="form-line">
								<input type="text" name="thoigianketthuc" id="thoigianketthuc" value="<?php echo($homNay); ?>" class="form-control">
							</div>
						</div>
						<div class="col-md2 col-sm-2 col-xs-4">
							<label>&nbsp</label>
							<br>
							<button class="btn btn-info" id="xemlichsukho">Xem</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="noidunglichsukho">
	

</div>	<!-- noi dung thong ke -->
<script type="text/javascript">
	$(document).ready(function(){

		// noi dung thong ke

		$('#noidunglichsukho').load('thungan/luukhohang/lichsukhohomnay.php');

		$('#xemlichsukho').click(function(){
			var thoiGianBatDau = $("#thoigianbatdau").val();
			var thoiGianKetThuc = $("#thoigianketthuc").val();
			$('#noidunglichsukho').load('thungan/luukhohang/lichsukhotuychon.php?thoigianbatdau=' + thoiGianBatDau + '&thoigianketthuc=' + thoiGianKetThuc);
		})

		$(function() {
			$("#thoigianbatdau").datepicker({
				dateFormat: 'dd/mm/yy',
				maxDate: "+0D"	     
			});	
			$("#thoigianketthuc").datepicker({
				dateFormat: 'dd/mm/yy',
				maxDate: "+0D"
			});	
		});
	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#lichsukhohang').addClass('menu-active');
 	});
</script>