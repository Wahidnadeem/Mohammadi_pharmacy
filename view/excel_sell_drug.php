<?php
   require_once "_config.php";
   
 $condition = $_GET['condition'];
   $view_data = $db->prepare("SELECT * FROM `buy_sell_assets` WHERE type = 'sell' AND deleted = 0 AND status != 'done' $condition ORDER BY id DESC");
   $view_data->execute();
  
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php
         $title = " گزارش  فروش دوا ";
         require_once("_head.php");
         ?>
   </head>
   <body class="body" style="scrollbar-width: thin;">
      <div id="wrapper" class="wrapper animsition">
         <!-- Navigation -->
         <?php require_once("_navigation.php");?>
         <!-- /.Navigation -->
         <?php $menu = "report"; $sub = "report_sell_drug";?>
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
                           <li class="active"> خروجی گرفتن </li>
                        </ol>
                     </div>
                  </div>
               </div>
               <!-- /. Content Header (Page header) -->
               <?php // require_once("message.php");?>

              <a id="export_button" href="report_sell_drug.php" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-file-excel-o"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی اکسل</span>&nbsp;
                </a>
                    &nbsp;
                <a href="report_sell_drug.php" class="btnc btnc-success btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;">
                        <i class="fa fa-rotate-left"></i>&nbsp;
                        <span class="ladda-label bfont">برگشت  به   لیست  فروش دوا ها</span>&nbsp;
                </a>

               <div class="panel panel-default lobidisable">
                  <div class="panel-heading">
                     <div class="panel-title">
                        <h4 class="gray bold bfont"><i class="fa fa-inbox"></i>  لیست  دوا  ها   .</h4>
                     </div>
                  </div>
                  <div class="panel-body scroll" style="overflow-y:hidden;">
                     <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                     <table id="employee_data" class="table table-bordered table-striped table-hover">
                        <thead>
                           <th> کد نمبر فاکتور فروش </th>
                           <th> نام  مشتری </th>
                           <th> نام  کتگوری</th>
                           <th class="text-center">کد دوا</th>
                           <th>نام  علمی</th>
                           <th>نام تجارتی</th>
                           <th> تعداد   </th>
                           <th> گدام    </th>
                           <th> تاریخ  </th>
                        </thead>
                        <tbody>
                           <?php
                              if($view_data->rowCount() ){
                              
                                  foreach ($view_data as $key => $row) {
                              
                                      $drug_row = select_one('drug',$row['drug_id']);
                                      $buy_sell_row = select_one('buy_sell_drug',$row['buy_sell_drug_id']);
                              
                                      echo '
                                          <tr>
                                              <td> '. $buy_sell_row['code_number']  .' </td>
                                              <td> '. get_column_value('customers',$buy_sell_row['customer_id'],'fullname').' </td>
                                              <td> '. get_column_value('categories',$drug_row['category_id'],'name').' </td>
                                              <td> <p  class ="cfont drug-code"> '. $drug_row['drug_code'].' </p> </td>
                                              <td> '.$drug_row['scientific_name'].' </td>
                                              <td> '.$drug_row['company_name'].' </td>
                                              <td> '.$row['cal_amount'].' </td>
                                              <td> '.get_column_value('stock',$row['stock_id'],'name').' </td>
                                              <td> '.$buy_sell_row['date'].' </td>
                                          </tr>
                                      ';
                                  }
                              
                              }else {
                              
                                  echo '
                                  <tr>
                                      <td colspan="12"  style="text-align:center" >
                                          <br>
                                          <img src="img/empty.png" style="margin-top:-60px;">
                                          <p>هیچ اطلاعاتی برای نمایش وجود ندارد</p>
                                      </td>
                                  </tr>
                                  ';
                              }
                              ?>
                        </tbody>
                     </table>
                    
                  </div>
               </div>
               <div class="t-height"></div>
            </div>
            <!-- /.main content -->
         </div>
         <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
      <!-- START CORE PLUGINS -->
      <?php require_once("_script.php");?>
   </body>
</html>
