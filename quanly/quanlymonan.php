<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>
<div class="block-header">
	<h2>Đồ uống</h2>
</div>
<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>
				DANH SÁCH ĐỒ UỐNG &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themmonan">Thêm đồ uống</button>
			</h2>
			</div>
			<div class="body">
				<div id="danhsachmonan"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachmonan').load('quanly/quanlymonan/load-monan.php');
		$("#formthemmonan").load('quanly/quanlymonan/themmonan.php');
	});
</script>
<!-- modal thêm món ăn -->
<div class="modal fade" id="themmonan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm đồ uống</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemmonan"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlymonan').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>