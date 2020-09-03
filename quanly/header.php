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
    <a href="dangxuat.php">
      <i class="fas fa-power-off" title="Đăng xuất"></i>
      Đăng xuất
    </a>
  </div>
</div>
<div>
	<div class="menu-admin sidebar" id="sidebar">		
		<ul>
			<li class="title-menu">HOẠT ĐỘNG</li>
		    <li id="thongke"><a><span class="glyphicon glyphicon-stats" style="color: #f44336"></span> Thống kê doanh thu</a></li>
		    <li id="tinhtien"><a><i class="fas fa-dollar-sign" style="color: #4caf50;"></i> Tính tiền</a></li>
		    <li id="phucvu"><a><span class="glyphicon glyphicon-list-alt" style="color: #03a9f4
;"></span> Phục vụ</a></li> 
		    <li id="nau"><a><span class="glyphicon glyphicon-cutlery" style="color: #ff9800"></span> Pha chế</a></li>		    
		    <li class="title-menu">KHO HÀNG</li>
		    <li id="chuyendoihanghoa"><a><i class="fas fa-exchange-alt" style="color: #e91e63;"></i> Chuyển đổi hàng hóa</a></li>
		    <li id="lichsuchuyendoi"><a><i class="fas fa-history" style="color: #2196f3;"></i> Lịch sử chuyển đổi hàng hóa</a></li>
		    <li id="kho"><a><span class="glyphicon glyphicon-home" style="color: #03a9f4
;"></span> Kho đồ uống</a></li>
			<li id="lichsukho"><a><i class="fas fa-history" style="color: #607d8b;"></i></span> Lịch sử kho đò uống</a></li> 
			<li id="khohang"><a><i class="fas fa-warehouse" style="color: #009688;"></i> Kho hàng hóa</a></li>
			<li id="lichsukhohang"><a><i class="fas fa-history" style="color: #ffd54f;"></i> Lịch sử kho hàng hóa</a></li>
		    <li class="title-menu">DANH MỤC</li>
		    <li id="quanlymonan"><a><i class="fas fa-mug-hot" style="color: #76ff03;"></i> Đồ uống</a></li>
		    <li id="quanlyloaimonan"><a><span class="glyphicon glyphicon glyphicon-list" style="color: #ff9800;"></span> Loại đồ uống</a></li>
		    <li id="quanlyhanghoa"><a><i class="fas fa-box-open" style="color: #9c27b0;"></i> Hàng hóa</a></li>
		    <li id="quanlydonvitinh"><a><i class="fas fa-balance-scale" style="color: #1de9b6;"></i> Đơn vị tính</a></li>
		    <li id="quanlyban"><a><span class="glyphicon glyphicon-th" style="color: #cddc39;"></span> Bàn</a></li>
		    <li id="loaiban"><a><i class="fas fa-stream" style="color: #795548;"></i> Loại bàn</a></li>
		    <li id="khuvucban"><a><i class="fas fa-map-signs" style="color: #ff9e80;"></i> Khu vực bàn</a></li>
		    <li id="quanlytaikhoan"><a><span class="glyphicon glyphicon-user" style="color: #9c27b0;"></span> Tài khoản</a></li>
			<li id="thietlap"><a><i class="fas fa-cog"></i> Thiết lập hệ thống</a></li>
		</ul>	
		<br><br><br><br><br>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#thongke').click(function(){
					$('#container').load('quanly/thongke.php');
				});
				$('#tinhtien').click(function(){
					$('#container').load('quanly/tinhtien.php');
				});	
				$('#phucvu').click(function(){
			        $('#container').load('phucvu-admin.php');
			      });
				$('#nau').click(function(){
			       $('#container').load('daubep-admin.php');
			    });
			    $('#kho').click(function(){
			       $('#container').load('quanly/luukho.php');
			    });
			    $('#lichsukho').click(function(){
			       $('#container').load('quanly/lichsunhapkho.php');
			    });
				$('#quanlytaikhoan').click(function(){
					$('#container').load('quanly/quanlytaikhoan.php');
				});
				$('#quanlymonan').click(function(){
					$('#container').load('quanly/quanlymonan.php');
				});
				$('#quanlyloaimonan').click(function(){
					$('#container').load('quanly/quanlyloaimonan.php');
				});
				$('#khohang').click(function(){
					$('#container').load('quanly/luukhohang.php');
				});
				$('#lichsukhohang').click(function(){
			       $('#container').load('quanly/lichsunhapkhohang.php');
			    });
			    $('#chuyendoihanghoa').click(function(){
			       $('#container').load('quanly/chuyendoihanghoa.php');
			    });
			    $('#lichsuchuyendoi').click(function(){
			       $('#container').load('quanly/lichsuchuyendoi.php');
			    });
				$('#quanlyhanghoa').click(function(){
					$('#container').load('quanly/quanlyhanghoa.php');
				});
				$('#quanlydonvitinh').click(function(){
					$('#container').load('quanly/quanlydonvitinh.php');
				});
				$('#quanlyban').click(function(){
					$('#container').load('quanly/quanlyban.php');
				});
				$("#loaiban").click(function(){
					$("#container").load("quanly/quanlyloaiban.php");
				});
				$("#khuvucban").click(function(){
					$("#container").load("quanly/quanlykhuvuc.php");
				});
				$("#thietlap").click(function(){
					$("#container").load("quanly/thietlap.php");
				});
			});
		</script>
	</div><!-- menu-admin -->
	<section class="content">
		<div class="container-fluid">	
		