<?php
require_once __DIR__.'/load.php';
if ($_SESSION['loaitaikhoan'] != 3) {
  header('Location: index.php');
}
require_once( dirname( __FILE__ ) . '/quanly/header.php' );
?>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="body">
          <button class="btn btn-default" id="lammoiban">
            <i class="fas fa-sync-alt"></i>
            Làm mới danh sách
          </button>
          <button class="btn btn-default xemtrangthai">
            <i class="fas fa-concierge-bell"></i>
            Trạng thái
          </button>
          <div id="danhsachban"></div> 
        </div><!-- body -->
      </div><!-- card -->  
      <div class="hoadon">
        <div class="header">
          <h2 id="tenban"></h2>
        </div>
        <div class="body">
          <div id="thongbaothanhtoan"></div>
          <div id="hoadon"></div>
        </div>
      </div><!-- card -->
      <div class="card">
        <div class="header">
          <h2>
            Trạng thái
            <button class="btn btn-default" id="lammoitrangthai">
              <i class="fas fa-sync-alt"></i>
              Làm mới
            </button>
          </h2>                    
        </div>
        <div class="body">
          <div id="trangthai"></div>
        </div>
      </div><!-- card -->
    </div><!-- col-12 -->
  </div><!-- row -->


      <script type="text/javascript">
        $(document).ready(function(){
          $('#trangthai').load('trangthai.php');
          $("#lammoitrangthai").click(function(){
            $('#trangthai').load('trangthai.php'); 
          });
          $(".xemtrangthai").click(function(){
            $('body,html').animate({
              scrollTop: $('#trangthai').offset().top-100
            }, 500);
          });
        });
      </script>

<script type='text/javascript'>
  $(document).ready(function(){
    $('#danhsachban').load('phucvu/load-ban.php');  
    $("#lammoiban").click(function(){
      $('#danhsachban').load('phucvu/load-ban.php');
    });
  });
</script>