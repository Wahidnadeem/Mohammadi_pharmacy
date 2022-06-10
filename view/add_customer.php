<?php

    require_once "_config.php";

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "ثبت مشتری ";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
              <?php $menu = "customer"; $sub = "add_customer";?>
            <!-- Sidebar -->
            <?php require_once("_sidebar.php");?>
            <!-- /.Sidebar -->
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div style="background:white;padding:10px;padding-top:6px;padding-bottom:7px;">
                            <div class="header-title" style="margin-right:0px;">
                                <ol class="breadcrumb">
                                    <li class="active"><a href="index.php"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                                    <li class="active"> <?=$title?> </li>
                                </ol>
                            </div>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <?php // require_once("message.php");?>
                    <?php require_once "alert.php" ?>
          
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                            <div class="panel panel-default lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  <?=$title?> </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    <br>
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_customer.php">

                                        <input type="hidden" name="insert" value="1">

                                        <div class="item form-group ">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="type_customer"> نوعیت <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio1"  value="seller">
                                                            <label class="form-check-label" for="inlineRadio1">فروشنده دوا </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="type" id="inlineRadio2" checked value="buyer">
                                                            <label class="form-check-label" for="inlineRadio2">مشتری</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="fullname">  نام کامل      <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="fullname" onblur="is_dublicate(this.value , type_customer.value)" name="fullname" required="required" class="form-control cfont" placeholder="مثلا : احمد محمدی">
                                            </div>
                                            <span id="customer_dublicate" style="display: none;color: red; ">این مشتری تکراری است ! </span>
                                        </div>                                       

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="company_name">  نام شرکت  </label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="company_name" name="company_name" class="form-control cfont" placeholder="مثلا : آسیا فارما">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="phone">  شماره تماس   <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="phone" name="phone" required="required" class="form-control cfont"  placeholder="مثلا : 07998877"  >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="address"> آدرس  <span class=""></span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <textarea id="address" name="address" class="form-control" rows="5" style="width:100%;height:10%;overflow-x:auto;" placeholder="لازمی نیست"></textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="date"> تاریخ ثبت  <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="date" value="<?php echo $PDATE ?>" name="date" required="required" class="form-control p-date"  placeholder="تاریخ">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="note">تفصیلات<span class=""></span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <textarea id="note" name="note" class="form-control" rows="5" style="width:100%;height:20%;overflow-x:auto;" placeholder="لازمی نیست"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <button type="submit" class="btn btn-primary" name="send_save"><i class="fa fa-clone"> </i> ثبت و جدید</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"> </i> لغو یا پاک کردن</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>

                        <div class="t-height"></div>

                    </div> <!-- /.main content -->
                </div><!-- /#page-wrapper -->
                <?php require_once("_footer.php");?>
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <?php require_once("_script.php");?>
    </body>
</html>

<script type="text/javascript">
     function is_dublicate(fullname , type_customer){
        $.ajax ({
            url: "ajax.php",
            method: "POST" ,
            data: {
                   fullname        :fullname,
                   type_customer   :type_customer,
                   type            :"customer_dublicate"},
            success:function(data){
                if(data == "true"){
                    $('#customer_dublicate').show();
                }else{
                    $('#customer_dublicate').hide();
                }
            }
        });
        }
</script>
