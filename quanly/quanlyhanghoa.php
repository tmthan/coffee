<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>
<div class="block-header">
	<h2>Hàng hóa</h2>
</div>

<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>
				DANH SÁCH HÀNG HÓA &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themhanghoa">Thêm hàng hóa</button>
			</h2>
			</div>
			<div class="body">
				<div id="danhsachhanghoa"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachhanghoa').load('quanly/quanlyhanghoa/load-hanghoa.php'); 
		$("#formthemhanghoa").load('quanly/quanlyhanghoa/themhanghoa.php');
	});
</script>
<!-- modal thêm hàng hóa -->
<div class="modal fade" id="themhanghoa" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm hàng hóa</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemhanghoa"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlyhanghoa').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>