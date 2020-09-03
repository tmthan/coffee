<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Đơn vị tính</h2>
</div>

<div class="row clearfix">
	<div class="card">
		<div class="header bg-light-green">
			<h2>
				DANH SÁCH ĐƠN VỊ TÍNH &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themdonvitinh">Thêm đơn vị tính</button>
			</h2>
		</div>
		<div class="body">
			<div id="danhsachdonvitinh"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachdonvitinh').load('quanly/quanlydonvitinh/load-donvitinh.php'); 
		$("#formthemdonvitinh").load('quanly/quanlydonvitinh/themdonvitinh.php');
	});
</script>
<!-- modal thêm loại bàn -->
<div class="modal fade" id="themdonvitinh" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm đơn vị tính</h5>
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemdonvitinh"></div>
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlydonvitinh').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>