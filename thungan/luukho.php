<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>
<div class="block-header">
    <h2>Kho đồ uống</h2>
</div>
<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>DANH SÁCH ĐỒ UỐNG</h2>

			</div><!-- header -->
			<div class="body">
				<div id="danhsachmonan"></div>
			</div><!-- body -->
		</div><!-- card -->
	</div><!-- col-md-12 -->
</div><!-- row -->
<script type="text/javascript">
$(document).ready(function(){
	$('#danhsachmonan').load('thungan/luukho/load-kho.php'); 
	});
</script>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#kho').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>