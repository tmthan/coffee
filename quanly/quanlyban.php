<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Bàn</h2>
</div>

<div class="row clearfix">
	<div class="card">
		<div class="header bg-light-green">
			<h2>
				DANH SÁCH BÀN &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themban">Thêm bàn</button>
			</h2>
		</div>
		<div class="body">
			<div id="danhsachban"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachban').load('quanly/quanlybanan/load-ban.php'); 
		$("#formthemban").load('quanly/quanlybanan/themban.php');
	});
</script>
<!-- modal thêm loại bàn -->
<div class="modal fade" id="themban" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm bàn</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemban"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlyban').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>