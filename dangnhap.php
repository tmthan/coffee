<?php
/**
* Giao diện trang đăng nhập
* Tên đăng nhập và mật khẩu được gửi đến file /dangnhap-load.php để xử lý bằng phương thức POST
*/
?>

<div class="container">
	<div class="row">	
		<div class="col-md-3 col-sm-4 col-lg-4 col-xs-12">
			<br><br><br><br><br>
			<div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Đăng nhập
                    </h2>                            
                </div>
                <div class="body">
                    <form method="post" action="dangnhap-load.php">
                    	<div class="form-group">
                            <div class="form-line">
                                <input type="text" name="tendangnhap" class="form-control" id="username" placeholder="Tên đăng nhập">
                            </div>
                        </div>						
						<div class="form-group">
							<div class="form-line">
                                <input type="password" name="matkhau" class="form-control" id="password" placeholder="Mật khẩu">
                            </div>							
						</div>						
							<input type="submit" name="submit" value="Đăng nhập" class="btn btn-default btn-block">
					</form>
                </div>
            </div>			
			<div id="status">
				<!-- Trạng thái đăng nhập -->				
			</div>	
		</div>	<!-- col -->
        <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
            <br><br><br><br><br>
            <div class="card">
                <div class="header">
                    <h2>Coffee House</h2>
                    Phần mềm quản lý quán cà phê chuyên nghiệp
                </div><!-- header -->
                <div class="body">
                    <h2>
                        Có gì mới?
                    </h2>
                    <h3>
                        Thêm tính năng đổi bàn
                    </h3>
                    <p>
                        Giờ đây, bạn có thể đổi bàn cho khách hàng một cách dễ dàng và nhanh chóng
                    </p>
                    <h3>
                        Thêm tính năng gộp bàn
                    </h3>
                    <p>
                        Đôi khi khách gặp một người quen của họ đang ngồi ở một bàn khác và họ muốn sang ngồi cùng. Tính năng gộp bàn đã được thêm vào để làm điều đó
                    </p>
                    <br><br>
                    <p>
                        Hỗ trợ: <a href="mailto:x@caffee.xyz" style="color: #fff !important;">x@caffee.xyz</a>
                        <a href="https://caffee.xyz/huong-dan-su-dung" style="color: #fff !important;" target="_blank">Hướng dẫn sử dụng</a>
                        <br><br>
                        Phần mềm chạy tốt nhất trên trình duyệt <a href="https://www.google.com/intl/vi_vn/chrome/" style="color: #fff !important;">Google Chrome</a>
                    </p>
                </div>
            </div><!-- card -->
        </div>
	</div><!-- row -->
</div><!-- container -->
