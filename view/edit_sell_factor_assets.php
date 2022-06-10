<?php 
    require_once '_config.php';

     if(!isset($_GET['id'])){
        header("location: list_sell_factor.php?error");
        exit(); 
    }

    $id = base64_decode($_GET['id']);
    $sell_factor_row     = select_one('buy_sell_assets',$id);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        $title = "ویرایش فاکتور  فروش";
        require_once("_head.php");?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "sell_factor"; $sub = "list_sell_factor";?>
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
                                    <li class="active"> ویرایش  فاکتور  فروش</li>
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
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_sell_factor.php">               
                                        
                                        <input type="hidden" name="edit_sell_factor" value="1">
                                        <input type="hidden" name="id" id="id" value="<?php echo base64_encode($sell_factor_row['id']);?>">
                                        <input type="hidden" name="current_date" value="<?php if(isset($sell_factor_row['expire_date'])) echo $sell_factor_row['expire_date']  ?>"  >

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="drug_id">  نام دوا    <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <select class="form-control basic-single" dir="rtl" name="drug_id" id="drug_id" required>
                                                    <option value="">یکی را انتخاب کنید</option>
                                                      <?php
                                                            $drug = $db->query("SELECT * FROM `drug` WHERE `deleted` = '0' ORDER BY id DESC");
                                                            foreach ($drug as $rows){
                                                                if ($rows['id'] == $sell_factor_row['drug_id']) {
                                                                    echo '<option value = "'.$rows['id'].'" selected>'.$rows['scientific_name'].' </option>';
                                                                }
                                                                else{
                                                                    echo '<option value ="'.$rows['id'].'"> '.$rows['scientific_name'].'</option>';
                                                                }

                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="amount"> تعداد <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="number" id="amount" value="<?php if(isset($sell_factor_row['amount'])) echo number_format($sell_factor_row['amount'],0);?>" name="amount" required="required" class="form-control cfont" placeholder="مثلا : 22">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="unit_price"> فی دانه  <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" step="any" id="unit_price"  value="<?php if(isset($sell_factor_row['unit_price'])) echo $sell_factor_row['unit_price'];?>" name="unit_price" required="required" class="form-control cfont" placeholder="مثلا : 1000">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="price"> مبلغ <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="number" id="price"  value="<?php if(isset($sell_factor_row['price'])) echo $sell_factor_row['price'];?>" name="price" required="required" class="form-control cfont" placeholder="مثلا : 1000">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="stock_id">  موقعیت    <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <select class="form-control basic-single" dir="rtl" name="stock_id" id="stock_id" required>
                                                    <option value="">یکی را انتخاب کنید</option>
                                                      <?php
                                                            $stock = $db->query("SELECT * FROM `stock` WHERE `deleted` = '0' ORDER BY id DESC");
                                                            foreach ($stock as $rows){
                                                                if ($rows['id'] == $sell_factor_row['stock_id']) {
                                                                    echo '<option value = "'.$rows['id'].'" selected>'.$rows['name'].' </option>';
                                                                }
                                                                else{
                                                                    echo '<option value ="'.$rows['id'].'"> '.$rows['name'].'</option>';
                                                                }

                                                            }
                                                            ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-lg-9 col-lg-offset-3">
                                                <button type="submit" class="btn btn-warning" name="edit_assets"><i class="fa fa-edit"> </i> ویرایش</button>
                                                <a href="list_sell_factor.php">
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
         function startDateEndDate(expire_date){
                    $("#expire_date").val(''); 
            }
            setTimeout(startDateEndDate, 10);
    </script>