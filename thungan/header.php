<div class="menu">
	<span class="bar-icon" id="bar-icon"><i class="fas fa-bars" style="font-size: 30px; margin-top: 10px; margin-left: 10px;"></i></span>	
	<script type="text/javascript">
	   	$("#bar-icon").click(function(){
	   		setTimeout(function(){
	   			$("body").addClass('overlay-open');
	   		}, 100);
	  	});
	</script>		
	<div class="right">    
		<span id="taikhoan" style="cursor: pointer;"><i class="fas fa-user" title="Tài khoản" id="taikhoan"></i> Tài khoản</span>
	    <a href="dangxuat.php">
	      <i class="fas fa-power-off" title="Đăng xuất"></i>
	      Đăng xuất
	    </a>
	    <script type="text/javascript">
	    	$('#taikhoan').click(function(){
		        $('#container').load('thungan/hoso.php');
		    });
	    </script>
	</div>
</div>
<div style="width: calc(100%); overflow-x: hidden;">
	<div class="menu-admin sidebar">		
		<ul>
			<li class="title-menu">HOẠT ĐỘNG</li>
			<li id="tinhtien"><a><i class="fas fa-dollar-sign" style="color: #4caf50;"></i> Tính tiền</a></li>
			<li id="thongke"><a><span class="glyphicon glyphicon-stats" style="color: #f44336"></span> Thống kê doanh thu</a></li>
			<li class="title-menu">KHO HÀNG</li>
		    <li id="chuyendoihanghoa"><a><i class="fas fa-exchange-alt" style="color: #e91e63;"></i> Chuyển đổi hàng hóa</a></li>
		    <li id="lichsuchuyendoi"><a><i class="fas fa-history" style="color: #2196f3;"></i> Lịch sử chuyển đổi hàng hóa</a></li>
		    <li id="kho"><a><span class="glyphicon glyphicon-home" style="color: #03a9f4
;"></span> Kho đồ uống</a></li>  
			<li id="lichsukho"><a><i class="fas fa-history" style="color: #607d8b;"></i></span> Lịch sử kho đồ uống</a></li>
			<li id="khohang"><a><i class="fas fa-warehouse" style="color: #009688;"></i> Kho hàng hóa</a></li>
			<li id="lichsukhohang"><a><i class="fas fa-history" style="color: #ffd54f;"></i> Lịch sử kho hàng hóa</a></li>
						
		</ul>	
		<script type="text/javascript">
			$(document).ready(function(){
				$('#tinhtien').click(function(){
					$('#container').load('thungan/tinhtien.php');
				});	
				$('#thongke').click(function(){
					$('#container').load('thungan/thongke.php');
				});				
			    $('#kho').click(function(){
			       $('#container').load('thungan/luukho.php');
			    });
			    $('#lichsukho').click(function(){
			       $('#container').load('thungan/lichsunhapkho.php');
			    });
				$('#khohang').click(function(){
					$('#container').load('thungan/luukhohang.php');
				});
				$('#lichsukhohang').click(function(){
			       $('#container').load('thungan/lichsunhapkhohang.php');
			    });
			    $('#chuyendoihanghoa').click(function(){
			       $('#container').load('thungan/chuyendoihanghoa.php');
			    });
			    $('#lichsuchuyendoi').click(function(){
			       $('#container').load('thungan/lichsuchuyendoi.php');
			    });
				$('#quanlyhanghoa').click(function(){
					$('#container').load('thungan/quanlyhanghoa.php');
				});
			});
		</script>
	</div><!-- menu-admin -->
	<section class="content">
		<div class="container-fluid">	
		