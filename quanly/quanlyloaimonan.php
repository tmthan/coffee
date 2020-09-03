<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Loại đồ uống</h2>
</div>

<div class="row clearfix">
	<div class="card">
		<div class="header bg-light-green">
			<h2>
				DANH SÁCH LOẠI ĐỒ UỐNG &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themloaimonan">Thêm loại đồ uống</button>
			</h2>
		</div>
		<div class="body">
			<div id="danhsachloai"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachloai').load('quanly/quanlyloaimonan/load-loaimonan.php'); 
		$("#formthemloaimonan").load('quanly/quanlyloaimonan/themloai.php');
	});
</script>
<!-- modal thêm loại bàn -->
<div class="modal fade" id="themloaimonan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm loại đồ uống</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemloaimonan"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlyloaimonan').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>