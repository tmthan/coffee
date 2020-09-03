<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
    <h2>Tính tiền</h2>
</div>
<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">
			<div class="header bg-light-green">
				<h2>
				Danh sách bàn
				<button class="btn btn-default" id="lammoi">Làm mới</button>
				</h2>
			</div>
			<div class="body">
				<div id="danhsachban"></div>
			</div>
		</div>
	</div>
</div>

<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#tinhtien').addClass('menu-active');
 		$("#danhsachban").load('thungan/tinhtien/load-ban.php');
 		$("#lammoi").click(function(){
 			$("#danhsachban").load('thungan/tinhtien/load-ban.php');
 		});
 	});
</script>