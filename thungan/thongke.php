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
    <h2>Thống kê doanh thu</h2>
</div>

<div class="row clearfix">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="body">
				<div class="row clearfix">
					<div class="col-md-2 col-sm2 col-xs-4">
						<label>Từ: </label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="thoigianbatdau" id="thoigianbatdau" class="form-control" value="<?php echo($homNay); ?>">
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm2 col-xs-4">
						<label>Đến:</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="thoigianketthuc" id="thoigianketthuc" value="<?php echo($homNay); ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm2 col-xs-4">
						<label> &nbsp</label>
						<br>
						<button class="btn btn-info" id="thongketuychon">Xem</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- col-md-12 -->
</div>
	

<div id="noidungthongke">
	

</div>	<!-- noi dung thong ke -->
<script type="text/javascript">
	$(document).ready(function(){

		// noi dung thong ke

		$('#noidungthongke').load('thungan/thongke/thongkehomnay.php');

		$('#thongketuychon').click(function(){
			var thoiGianBatDau = $("#thoigianbatdau").val();
			var thoiGianKetThuc = $("#thoigianketthuc").val();
			$('#noidungthongke').load('thungan/thongke/thongketuychon.php?thoigianbatdau=' + thoiGianBatDau + '&thoigianketthuc=' + thoiGianKetThuc);
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
 		$('#thongke').addClass('menu-active');
 	});
</script>