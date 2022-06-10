
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
        	 شرکت عمران ویت فارما
        </title>
        <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">
        <!-- Bootstrap -->
        <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap rtl -->
        <link href="../assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <!-- Pe-icon-7-stroke -->
        <link href="../assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="../assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style rtl -->
        <link href="../assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css"/>
        <!-- Custom css -->
        <link href="../assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css-login.css" rel="stylesheet" type="text/css" >
        <link href="../assets/font/font-sans.css" rel="stylesheet" type="text/css" >
    </head>
    <body style="background-image: url('../assets/img/B_P_M_S.jpg');  position: fixed; top: 0; left: 0;min-width: 100%;min-height: 100%;">
        <!-- Content Wrapper -->
        <div class="lock-wrapper-page c-login" style="box-shadow: 0 0 4px 2px #040000, inset 0 -3px 0 #e6e6e6;
    border-radius: 3px;" >
            
            <div class="header-title">
                <h3 style="font-size:17px"><small class="fsize" style="font-size:10px">برای وارد شدن در سیستم  نام کاربری و رمز کاربری خود را وارد نمایید</small></h3>
            </div>
            <hr>
            
            <div class="text-center">
                <a href="login.php" class="logo-lock"><img src="../assets/img/logo.png" class="img-responsive" alt="Roze Soltan Mahmood"></a>
            </div>

            <form method="post" action="is_login.php" >
                <div class="form-group">
                    <div class="input-group col-xs-12 col-lg-12 col-sm-12 col-lx-12 col-sx-12 col-md-12" >
                        <input class="form-control text-left" dir="ltr" placeholder="نام کاربری" type="username"  name="username" required>
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="input-group col-xs-12 col-lg-12 col-sm-12 col-lx-12 col-sx-12 col-md-12 ">
                        <input class="form-control text-left" dir="ltr" placeholder="رمز عبور" type="password"  name="password" required>
                        <i class="fa fa-key" style="right:unset !important;"></i>
                    </div>
                </div>
			
            	<div class="form-group text-right">
					 <div class="checkbox checkbox-replace">
						<input type="checkbox" value="1" id="remeber" class='checkbox-info'  name="remeber">
						<!-- <label for="remeber">بخاطر بسپار</label> -->
					  </div>
				 </div>
            
                <?php if(isset($_GET['not_user'])){ ?>
                    <p style="font-size:13px;padding:5px;margin-top:-5px;color: #be0e49"> <i class="fa fa-warning"></i><b >نام کاربری یا رمز عبور تان اشتباه است.</b></p>
                <?php }else if (isset($_GET['empty'])){ ?>
                    <p style="font-size:13px;padding:5px;margin-top:-5px;color: orange;"> <i class="fa fa-clone"></i><b > نام کاربری یا رمز عبور تان  وجود ندارد.</b></p>
                <?php }?>
            
                <div class="form-group">
                    <div class="input-group col-xs-12 col-lg-12 col-sm-12 col-lx-12 col-sx-12 col-md-12 ">
						<!--<input type="checkbox" value='1' name='remeber' />-->
                        <button type="submit" class="btn btn-danger" style="width:100%;">ورود به سیستم</button>
                    </div>
                </div>

            
                <div class="text-right">
                    <a href="javascript:void();" onclick="hint();" class="text-muted">پسورد تان را فراموش کردید؟</a>
                </div>
            
            </form>

        </div>
        <!-- /.content-wrapper -->

    <!-- footer -->
        <div style="text-align:center;margin-top:-58px;position:relative; right:220px;" class="col-md-8">
             <footer class="footer" style="padding: 2px;text-align: center; font-size: 20px;" >
                <div style="background-color:#e8f0fe87;">
                    <span  class="bfont"><a href="https://www.NovaVTeam.tech" style="color: #000000;"> گروه خدمات تکنالوژی  NovaVTeam - حق کاپی این پروگرام محفوظ است . </a></span><br>
                    <span  class="bfont" style="font-size:16px;color:black;">شماره های تماس : 0794284644 , 0798238001</span>
                </div>
            </footer>
        </div>
    <!--footer  -->

    </body>
</html>