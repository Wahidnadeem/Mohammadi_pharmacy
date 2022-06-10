<?php 
    
    require_once "_config.php";
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            $title = "ثبت انتقال  دوا  ";
            require_once("_head.php");
            ?>  
    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "transfer_drug"; $sub = "add_transfer_durg";?>
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
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_transfer_drug.php" >               
                                        
                                        <input type="hidden" name="insert" value="1">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="from_stock"> از گدام <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <select class="form-control basic-single" dir="rtl" name="from_stock" id="from_stock" required>
                                                    <option> گدام را انتخاب نماید  </option> 
                                                    <?php
                                                        $category = select_all('stock','','desc');
                                                        foreach ($category as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['name'].'  </option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="to_stock"> به گدام <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <select class="form-control basic-single" dir="rtl" name="to_stock" id="to_stock" required>
                                                    <option> گدام را انتخاب نماید  </option> 
                                                    <?php
                                                        $category = select_all('stock','','desc');
                                                        foreach ($category as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['name'].'  </option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="drug_id"> نام دوا <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <select class="form-control basic-single" dir="rtl" name="drug_id" id="drug_id" required>
                                                    <option> دوا را انتخاب نماید </option> 
                                                    <?php
                                                        $category = select_all('drug','','desc');
                                                        foreach ($category as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['scientific_name'].'  </option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="amount"> مقدار     <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="amount" name="amount" required="required" class="form-control cfont"  placeholder="200">
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-3" for="date"> تاریخ  <span class="required">*</span></label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5">
                                                <input type="text" id="date" name="date" value="<?php echo $PDATE ?>" required="required" class="form-control p-date"  placeholder="تاریخ">
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
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->
        <?php require_once("_script.php");?>
    </body>
</html>