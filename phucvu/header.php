<div class="row">
  <ul class="nav navbar-nav navbar-right">
    <li><a id="phucvu"><span class="glyphicon glyphicon-list-alt"></span> Phục vụ</a></li> 
    <li><a id="taikhoan"><span class="glyphicon glyphicon-user"></span> Tài khoản</a></li>
    <li><a href="dangxuat.php"><span class="glyphicon glyphicon-share-alt"></span> Đăng xuất</a></li>
</ul>
</div>

 <script type="text/javascript">
   $(document).ready(function(){
      $('#taikhoan').click(function(){
        $('#container').load('phucvu/hoso.php');
      });
      $('#phucvu').click(function(){
        $('#container').load('phucvu.php');
      });
   })
 </script>