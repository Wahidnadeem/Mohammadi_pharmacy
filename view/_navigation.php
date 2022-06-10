<?php 
    require_once ('_config.php');

    $user_name = $db->query("SELECT * FROM users where id  = $user_id")->fetch();

?>

<style type="text/css">
    .dropdown-messages li:hover{
        color:white !important;
    }
    .inbox-item:hover .inbox-item-text{
        color:white !important;
    }
    .inbox-item:hover .inbox-item-date{
        color:white !important;
    }
    @media screen and (max-width:767px){
        .mob-screen{
            display: none;
        }
        .mob-screen-addicon{
            position: relative;
            left: -215px;
            bottom: 60px;
        }
        .mob-screen-logout{
            position: relative;
            right: -70px;
            bottom: 61px;
        }
        .mob-screen-menu{
            position: relative;
            left: 17px;
            color: #fff;
        }
        .mob-screen-name{
            position: absolute;
            bottom: 17px !important;
            right: 92px;
            color: #fff;
            font-size: 38px;

        }
        .mob-screen-logo{
            height: 61px;
            position: relative;
            bottom: 7px;
            left: -2px;

        }
    }
    @media screen and (max-width:1180px){
        .mob-screen-para{
            font-size: 20px !important;
        }
        
    }
</style>
<!-- Navigation -->
<nav class="navbar navbar-fixed-top" style="background-color:#3f94dfa8;border-bottom:unset !important;height: 70px;">
    
    <div class="nav-container">
        <!-- /.navbar-header -->


        <!-- <span  class="bfont bold" style="position: relative;right: 100px;top: -2px;color: #fff;font-size: 45px;">عمده فروشی ادویه عبدالکریم محمدی و برادران</span> -->
        <ul class="nav navbar-nav hidden-xs" style="margin-right:-250px;">
            <li><a id="fullscreen" href="#"><i class="material-icons">fullscreen</i> </a></li>
            <!-- /.Fullscreen -->
            <li class="hidden-xs"> 
                <a class="search-trigger" href="#">
                    <i class="material-icons">search</i>
                </a>

                <div class="fullscreen-search-overlay" id="search-overlay">
                    <a href="#" class="fullscreen-close" id="fullscreen-close-button"><i class="ti-close"></i></a>
                    <div id="fullscreen-search-wrapper">
                        <form method="get" id="fullscreen-searchform">
                            <input type="text" value="" placeholder="Type keyword(s) here" id="fullscreen-search-input">
                            <i class="ti-search fullscreen-search-icon"><input value="" type="submit"></i>
                        </form>
                    </div>
                </div>
            </li> 

        </ul>

        <img class="main-logo mob-screen-logo" src="../assets/img/logo0.png" id="bg" alt="" style="height: 65px;position: relative;right:330px;">

         <ul class="nav mob-screen" >
            <li>
                <p class="bfont bold mob-screen-para" style="color: #fff;font-size: 35px;margin-top: -60px;text-align: center;margin-left: 100px;">شرکت عمران ویت فارما</p>
            </li>
            
        </ul>


        <ul class="nav navbar-top-links navbar-right" style="position:relative;bottom: 100%;">
            <!-- /.Dropdown -->
            <li class="dropdown bfont mob-screen-addicon">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="material-icons">person_add</i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="edit_user.php?id=<?php if(!empty($user_name['id'])){ echo base64_encode($user_name['id']); }
                      ?>" class="pointer"><i class="ti-user"></i>&nbsp; تنظیمات کاربر</a></li>
                    <li><a href="logout.php"><i class="ti-layout-sidebar-left"></i>&nbsp; خروج از سیستم</a></li>
                </ul><!-- /.dropdown-user -->
            </li><!-- /.Dropdown -->
            <li class="log_out mob-screen-logout">
                 <a href="lockscreen.php" style="background-color:#fff0;">
                    <i class="material-icons">power_settings_new</i>
                </a>
            </li><!-- /.Log out -->
        </ul> <!-- /.navbar-top-links -->
    </div>
</nav>
<!-- /.Navigation -->