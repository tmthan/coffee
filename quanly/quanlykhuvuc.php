<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Khu vực bàn</h2>
</div>
<div class="row clearfix">
	<div class="card">
		<div class="header bg-light-green">
			<h2>
				DANH SÁCH KHU VỰC &nbsp
				<button class="btn btn-default" data-toggle="modal" data-target="#themkhuvuc">Thêm khu vực</button>
			</h2>
		</div>
		<div class="body">
			<div id="danhsachkhuvuc"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachkhuvuc').load('quanly/quanlykhuvuc/load-khuvuc.php');
		$("#formthemkhuvuc").load('quanly/quanlykhuvuc/themkhuvuc.php');
	});
</script>
<!-- modal thêm khu vực -->
<div class="modal fade" id="themkhuvuc" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm khu vực</h5>	        
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemkhuvuc"></div>	        
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#khuvucban').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>