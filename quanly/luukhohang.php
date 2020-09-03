<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>
<div class="block-header">
    <h2>Kho hàng hóa</h2>
</div>
<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>DANH SÁCH HÀNG HÓA</h2>

			</div><!-- header -->
			<div class="body">
				<div id="danhsachhanghoa"></div>
			</div><!-- body -->
		</div><!-- card -->
	</div><!-- col-md-12 -->
</div><!-- row -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachhanghoa').load('quanly/luukhohang/load-kho.php'); 
	});
</script>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#khohang').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>