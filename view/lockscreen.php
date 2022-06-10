<?php 
require_once '_config.php';

 $user_name = $db->query("SELECT * FROM users WHERE id = '$user_id' AND deleted = 0")->fetch();

?>

<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_rtl_v2.0/lockscreen.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2019 17:19:10 GMT -->
<head>
         <?php require_once("_head.php");?>  
    </head>
    <body>
        <!-- Content Wrapper -->
        <div class="lock-wrapper-page">
            <div class="text-center">
                <a  class="logo-lock bfont" style="font-size: 14px;cursor: pointer;"><i class="icon socicon-feedburner"></i><span>سیستم مدیریت   شرکت عمران ویت فارما</span> </a>
            </div>

        <div class="text-center">    
            <div class="user-thumb">
                    <img src="../assets/dist/img/avatar.png" class="img-responsive img-circle img-thumbnail" alt="thumbnail">
                </div>
                 <h3>
                    <?php 
                    if (!empty($user_name['username'])) {
                        echo $user_name['username'];
                    }
                        
                 ?></h3>
                    <p class="text-muted">رمز عبور خودر را وارد نمایید</p>
        </div>

            <form id="validation-form" class="form-horizontal text-center m-t-20" method="post" action="lockscreen_is_login.php">

                <div class="form-group">   
                    <div class="input-group m-t-20">
                        <input class="form-control" placeholder="رمز عبور" type="password" name="password_new">
                        <i class="fa fa-key"></i>
                        <span class="input-group-btn"> 
                            <button type="submit" class="btn btn-success bfont">ورود</button>
                        </span>
                    </div>

                </div>

            </form>
                <div class="col-md-12">
                    <a href="novavteam.tech">
                        <span style="position: absolute;right: 70px;font-size: 18px;font-weight: bold;">  NovaVTeam 2022 &copy</span>
                    </a>
                </div>
        </div>
        <!-- /.content-wrapper -->
        <!-- jQuery -->
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- bootstrap js -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>

<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_rtl_v2.0/lockscreen.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2019 17:19:10 GMT -->
</html>