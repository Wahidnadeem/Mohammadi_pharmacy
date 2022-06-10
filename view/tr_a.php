<?php
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> شرکت ترانزیتی و بار چلانی روضه سلطان  محمود  -  حسابات اصلی </title>
        <?php require_once("_head.php");?>  
    </head>
    <body>
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "ACCOUNTS"; $sub = "a";$page= "tr_a.php"; ?>
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
                                    <li class="active"> صورت حسابات</li>
                                     <li class="active">   ایجاد حساب اصلی </li>
                                </ol>
                            </div>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <?php // require_once("message.php");?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                            
                            <div class="panel panel-default lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  ثبت حسابات </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    <br>
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="tr_aac.php">               
                                        
                                        <input type="hidden" name="insertaion" value="1">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="name"> نوع صورت حساب اصلی   <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="name" name="name" required="required" class="form-control cfont"  placeholder="مثلا: حساب بار نامه ها "  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="date"> تاریخ  <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="date" name="date" required="required" class="form-control date"  placeholder="تاریخ">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="note">تفصیلات<span class=""></span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <textarea id="note" name="note" class="form-control" rows="5" style="width:100%;height:40%;overflow-x:auto;" placeholder="لازمی نیست"></textarea>
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
                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i>  ایجاد حسابات اصلی ، آخرین موارید ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="center">شماره</th>
                                        <th> نام  صورت حساب </th>
                                        <th>تفصیلات</th>
                                        <th>تاریخ</th>
                                        <th>توسط</th>
                                        <th class="center">تغییرات</th>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td class="center">1</td>
                                        <td>نفت</td>
                                        <td>برای امتحان است</td>
                                        <td>1398،عقرب 1</td>
                                        <td>ادمین </td>
                                        <td class="center">
                                            <a href="tr_ea.php?eid=NA==&amp;page=tr_a.php&amp;edit" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=NA==&amp;page=tr_a.php&amp;delete"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="center">2</td>
                                        <td>اضافه کاری</td>
                                        <td>برای امتحان است</td>
                                        <td>777،اسد 7</td>
                                        <td>ادمین </td>
                                        <td class="center">
                                            <a href="tr_ea.php?eid=Mw==&amp;page=tr_a.php&amp;edit" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=Mw==&amp;page=tr_a.php&amp;delete"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="center">3</td>
                                        <td>کارگری کارگران</td>
                                        <td>برای امتحان است برای کارگران</td>
                                        <td>777،اسد 7</td>
                                        <td>ادمین </td>
                                        <td class="center">
                                            <a href="tr_ea.php?eid=Mg==&amp;page=tr_a.php&amp;edit" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=Mg==&amp;page=tr_a.php&amp;delete"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="center">4</td>
                                        <td>بار نامه ها</td>
                                        <td></td>
                                        <td>1398،میزان 30</td>
                                        <td>ادمین </td>
                                        <td class="center">
                                            <a href="tr_ea.php?eid=MQ==&amp;page=tr_a.php&amp;edit" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=MQ==&amp;page=tr_a.php&amp;delete"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                        
                                            <!-- <tr>
                                                <td colspan="12" class="center">
                                                    <b>کاربر گرامی٬</b> اطلاعات یافت نشد. 
                                                    <br>
                                                    <img src="../img/empty.png">
                                                </td>
                                            </tr> -->
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="t-height"></div>

                    </div> <!-- /.main content -->
                </div><!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <?php require_once("_script.php");?>
    </body>
</html>