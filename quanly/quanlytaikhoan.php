<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
	<h2>Tài khoản</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>
					DANH SÁCH TÀI KHOẢN &nbsp
					<button class="btn btn-default" data-toggle="modal" data-target="#themtaikhoan">
						Thêm tài khoản
					</button>
				</h2>
			</div>
			<div class="body">
				<div id="danhsachtaikhoan"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#danhsachtaikhoan').load('quanly/quanlytaikhoan/load-taikhoan.php'); 
		$("#formthemtaikhoan").load('quanly/quanlytaikhoan/themtaikhoan.php');
	});
</script>

<!-- modal thêm tài khoản -->
<div class="modal fade" id="themtaikhoan" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<h5 class="modal-title">Thêm tài khoản</h5>	        
	      	</div>
	      	<div class="modal-body">
	        	<div id="formthemtaikhoan"></div>	        
	      	</div>	      
	    </div>
	</div>
</div>
<script type="text/javascript">
 	$(document).ready(function(){
 		$('#quanlytaikhoan').addClass('menu-active');
 	});
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>