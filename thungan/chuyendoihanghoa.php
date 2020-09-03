<?php
require_once __DIR__.'/../load.php';
if ($_SESSION['loaitaikhoan'] != 4) {
	header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/header.php' );
?>

<div class="block-header">
    <h2>Chuyển đổi hàng hóa</h2>
</div>
<div class="row clearfix">
	<div class="col-md-3 col-sm-4">
		<div class="card">
			<div class="header">
				<h2>Nguyên liệu</h2>
			</div>
			<div class="body">				
				<div class="form-group">
					<select id="nguyenlieu" class="form-control">
						<option>Chọn nguyên liệu</option>
						<?php 
						/* Lấy danh sách hàng hóa (nguyên liệu) */
						$sql = "SELECT `hang_hoa`.`Ma_Hang`, `hang_hoa`.`Ten_Hang`, `don_vi_tinh`.`Ten_Don_Vi_Tinh` FROM `hang_hoa`, `don_vi_tinh` WHERE `hang_hoa`.`Don_Vi_Tinh` = `don_vi_tinh`.`Ma_Don_Vi_Tinh` AND `hang_hoa`.`Xoa` = 0 ORDER BY `hang_hoa`.`Ten_Hang`;";
						$result = $conn->query($sql);
						while ($row = $result->fetch_assoc()) {
							$maHang = $row['Ma_Hang'];
							$tenHang = $row['Ten_Hang'];
							$tenDonViTinh = $row['Ten_Don_Vi_Tinh'];
							echo "<option value='$maHang'>$tenHang ($tenDonViTinh)</option>";
						}
					 ?>
					</select>
				</div>						
				<div class="form-group">
					<input type="number" name="soluongnguyenlieu" id="soluongnguyenlieu" min="0" class="form-control" placeholder="Số lượng">
				</div>
				
			</div>
		</div>
	</div><!-- col-md-4 -->
	<div class="col-md-3 col-sm-4">
		<div class="card">
			<div class="header">
				<h2>Công thức</h2>
			</div>
			<div class="body">				
				<div class="form-group">
					<select id="loaithanhpham" class="form-control">	
						<option>Chọn loại thành phẩm</option>		
						<option value="monan">
							Đồ uống
						</option>
						<option value="hanghoa">
							Hàng hóa
						</option>
					</select>
				</div>
				<div class="form-group">
					<label>Tỷ lệ:</label>					
					<input type="number" name="tylenguyenlieu" id="tylenguyenlieu" min="1" value="1" style="width: 60px; border-top: none; border-left: none; border-right: none; border-bottom: 1px solid #ddd; padding: 5px; text-align: center; color: #333;">
					=
					<input type="number" name="tylethanhpham" id="tylethanhpham" min="1" value="1" style="width: 60px; border-top: none; border-left: none; border-right: none; border-bottom: 1px solid #ddd; padding: 5px; text-align: center; color: #333;">				
				</div>
			</div>
		</div>
	</div><!-- col-md-4 -->
	<div class="col-md-3 col-sm-4">
		<div class="card">
			<div class="header">
				<h2>Thành phẩm</h2>
			</div>
			<div class="body">				
				<div class="form-group">
					<select id="thanhpham" class="form-control">
						<option>Chọn thành phẩm</option>
					</select>
				</div>
				<div class="form-group">
					<input type="number" name="soluongthanhpham" id="soluongthanhpham" min="0" readonly="" placeholder="Số lượng" class="form-control">
				</div>				
			</div>
		</div>
	</div><!-- col-md-4 -->
	<div class="col-md-3 col-sm-4">
		<div class="card">
			<div class="header">
				<h2>Chuyển đổi</h2>
			</div>
			<div class="body">
				<div class="form-group">					
					<button id="chuyendoi" class="btn btn-default">Thực hiện chuyển đổi</button>
				</div>				
			</div>
		</div>
	</div>
</div><!-- row -->


<div id="thongbao"></div>
<script type="text/javascript">
	/* Xử lý hiển thị danh sách thành phẩm sau khi chọn thành phẩm */
	$("#loaithanhpham").change(function(){
		var loaiThanhPham = $("#loaithanhpham").val();
		$("#thanhpham").load("thungan/chuyendoihanghoa/load-thanhpham.php?loaithanhpham=" + loaiThanhPham);
	});

	/* tien hanh chuyen doi khi click */
	$("#chuyendoi").click(function(){
		var nguyenLieu = $("#nguyenlieu").val();
		var soLuongNguyenLieu = $("#soluongnguyenlieu").val();
		var thanhPham = $("#thanhpham").val();
		var loaiThanhPham = $("#loaithanhpham").val();
		var tyLeNguyenLieu = $("#tylenguyenlieu").val();
		var tyLeThanhPham = $("#tylethanhpham").val();
		$.ajax({
		    url: 'thungan/chuyendoihanghoa/load-chuyendoi.php',
			type: 'POST',
		    dataType: 'text',
			data: {					
				nguyenlieu: nguyenLieu,
				soluongnguyenlieu: soLuongNguyenLieu,
				thanhpham: thanhPham,
				loaithanhpham: loaiThanhPham,
				tylenguyenlieu: tyLeNguyenLieu,
				tylethanhpham: tyLeThanhPham				
			}, success: function (data) {
				$('#thongbao').html(data);
				if (data="<div class='alert alert-success'>Chuyển đổi hàng hóa thành công</div>") {
			 		// Chuyển đổi thành công thì reset lại số lượng
			 		$("#soluongnguyenlieu").val("");
			 		$("#tylenguyenlieu").val("1");
			 		$("#tylethanhpham").val("1");
			 	}
			 	$('#chuyendoi').hide();
			   	setTimeout(function(){
			   	// sau 5 giay thi hien lai
			   	$('#thongbao').html('');
			   	$('#chuyendoi').show();
			   }, 5000);			   
			}
		});   
	});
	/* Bắt các sự kiện thay đổi trên nguyên liệu */

	$("#soluongnguyenlieu").change(function(){
		tinhChuyenDoi();
	});
	$("#tylenguyenlieu").change(function(){
		tinhChuyenDoi();
	});
	$("#tylethanhpham").change(function(){
		tinhChuyenDoi();
	});
	function tinhChuyenDoi()
	{
		/* Hàm này chỉ hiển thị trên giao diện để người dùng xem trước, không ảnh hưởng đến dữ liệu */
		var nguyenLieu = $("#nguyenlieu").val();
		var soLuongNguyenLieu = parseInt($("#soluongnguyenlieu").val());
		var thanhPham = $("#thanhpham").val();
		var loaiThanhPham = $("#loaithanhpham").val();
		var tyLeNguyenLieu = parseInt($("#tylenguyenlieu").val());
		var tyLeThanhPham = parseInt($("#tylethanhpham").val());
		var soLuongThanhPham = soLuongNguyenLieu / tyLeNguyenLieu * tyLeThanhPham;
		if (Number.isInteger(soLuongThanhPham)) {
			$("#soluongthanhpham").val(soLuongThanhPham);
			$("#thongbao").html("");
		} else {
			$("#thongbao").html("<div class='alert alert-warning'>Số lượng nguyên liệu phải chia hết cho tỷ lệ nguyên liệu</div>");
			$("#soluongthanhpham").val("");
		}
	}
</script>
<?php 
require_once( dirname( __FILE__ ) . '/footer.php' );
 ?>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#chuyendoihanghoa').addClass('menu-active');
 	});
</script>