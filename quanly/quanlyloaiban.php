<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Loại bàn</h2>
</div>

<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>
				DANH SÁCH LOẠI BÀN &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themloaiban">Thêm loại bàn</button>
			</h2>
			</div>
			<div class="body">
				<div id="danhsachloaiban"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachloaiban').load('quanly/quanlyloaiban/load-loaiban.php'); 
		$("#formthemloaiban").load('quanly/quanlyloaiban/themloaiban.php');
	});
</script>
<!-- modal thêm loại bàn -->
<div class="modal fade" id="themloaiban" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm loại bàn</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemloaiban"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#loaiban').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>