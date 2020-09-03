<?php
require_once __DIR__.'/load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
  header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/quanly/header.php' );
?>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#nau').addClass('menu-active');
  });
</script>