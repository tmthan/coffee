<?php
require_once __DIR__.'/load.php';
if ($_SESSION['loaitaikhoan'] != 1) {
  header('Location: index.php');
} ?>
<div class="menu">
  <div class="right">
    <span id="nau" style="cursor: pointer;"><i class="fas fa-mug-hot" title="Pha chế"></i> Pha chế</span>
    <span id="taikhoan" style="cursor: pointer;"><i class="fas fa-user" title="Tài khoản" id="taikhoan"></i> Tài khoản</span>
    <a href="dangxuat.php"> Đăng xuất
      <i class="fas fa-power-off" title="Đăng xuất"></i>    
    </a>
  </div>
</div>

<div class="container">
  <div style="margin-top: 65px;">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="header bg-light-green">
            <h2>
              Chờ pha chế &nbsp
              <button class="btn btn-default" id="lammoidanhsachchonau">Làm mới</button>
            </h2>
          </div>
          <div class="body">          
            <div id="danhsachchonau"></div>
          </div>
        </div>
      </div><!-- col-md-8 -->
      <div class="col-md-4">
        <div class="card">
          <div class="header bg-light-green">
            <h2>
              Trạng thái &nbsp
              <button class="btn btn-default" id="lammoitrangthai">Làm mới</button>
            </h2>
          </div>
          <div class="body">
            <div id="trangthai"></div>
          </div>
        </div>
      </div><!-- col-md-4 -->
    </div><!-- row -->
  </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){
      $('#taikhoan').click(function(){
        $('#container').load('daubep/hoso.php');
      });
      $('#nau').click(function(){
        $('#container').load('daubep.php');
      });
   })
 </script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#danhsachchonau').load('daubep/load-danhsachnau.php'); 
  });
  $("#lammoidanhsachchonau").click(function(){
    $('#danhsachchonau').load('daubep/load-danhsachnau.php'); 
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#trangthai').load('trangthai.php'); 
  });
  $("#lammoitrangthai").click(function(){
    $('#trangthai').load('trangthai.php'); 
  });
</script>