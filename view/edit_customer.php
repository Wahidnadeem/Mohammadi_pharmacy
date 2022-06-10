<?php 
    require_once '_config.php';

    if(!isset($_GET['id'])){
        header("location: list_customer.php?error");
        exit(); 
    }

    $id = base64_decode($_GET['id']);
    $customer_row     = select_one('customers',$id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        $title = "ویرایش مشتری";
        require_once("_head.php");?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "customer"; $sub = "list_customer";?>
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
                                    <li class="active"> ویرایش مشتری</li>
                                </ol>
                            </div>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <?php // require_once("message.php");?>
                    <?php require_once "alert.php" ?>
          
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                            <div class="panel panel-warning lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  ویرایش اطلاعات </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    <br>
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_customer.php">               
                                        
                                        <input type="hidden" name="edit" value="1">
                                        <input type="hidden" name="id" id="id" value="<?php echo base64_encode($customer_row['id']);?>">
                                        <input type="hidden" name="current_date" value="<?php if(isset($customer_row['date'])) echo $customer_row['date']  ?>"  >

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="fullname"> نام کامل <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="fullname" value="<?php if(isset($customer_row['fullname'])) echo $customer_row['fullname'];?>" name="fullname" required="required" class="form-control cfont" placeholder="مثلا : احمد محمدی">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="company_name"> نام  شرکت   </label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="company_name" value="<?php if(isset($customer_row['company_name'])) echo $customer_row['company_name'];?>" name="company_name" class="form-control cfont"  placeholder="مثلا : آسیا فارما">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="phone"> شماره تماس <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="phone" value="<?php if(isset($customer_row['phone'])) echo $customer_row['phone'];?>" name="phone" required="required" class="form-control cfont" placeholder="مثلا : 07998877"  >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="address"> آدرس  </label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <textarea id="address" name="address" class="form-control" rows="5" style="width:100%;height:10%;overflow-x:auto;" placeholder="لازمی نیست"><?php if(isset($customer_row['address'])) echo $customer_row['address'];?></textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="date"> تاریخ قبلی </label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <?php if(isset($customer_row['date'])) echo $customer_row['date'];?>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="date"> تاریخ </label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="date" name="date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="note">تفصیلات<span class=""></span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <textarea id="note" name="note" class="form-control" rows="5" style="width:100%;height:20%;overflow-x:auto;" placeholder="لازمی نیست"><?php if(isset($category_row['note'])) echo $category_row['note'];?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <button type="submit" class="btn btn-warning" name="edit"><i class="fa fa-edit"> </i> ویرایش</button>
                                                <a href="list_customer.php">
                                                <button type="button" class="btn btn-danger"><i class="fa fa-refresh"> </i> لغو یا بازکشت</button></a>
                                            </div>
                                        </div>

                                    </form>
                                </div>                                
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    
                </div><!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <?php require_once("_script.php");?>
    </body>
</html>

<script type="text/javascript">
         function startDateEndDate(date){
                    $("#date").val(''); 
            }
            setTimeout(startDateEndDate, 10);
    </script>