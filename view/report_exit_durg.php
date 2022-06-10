<?php
   require_once "_config.php";
   

   $condition = ''; 
   if(!empty($_POST['search'])){


        if(!empty($_POST['drug_id'])){
            $drug_id = VD($_POST['drug_id']);
            $condition .= " AND  drug_id = $drug_id  "; 
        }

        if(!empty($_POST['stock_id'])){
            $stock_id = VD($_POST['stock_id']);
            $condition .= " AND stock_id = $stock_id ";
        }

   }



   // $view_data = $db->prepare("SELECT * FROM `buy_sell_assets` WHERE type = 'buy' AND deleted = 0 AND status != 'done' $condition group by stock_id,drug_id ORDER BY id  DESC  LIMIT $to OFFSET $from");
   // $view_data->execute();

      $view_data = $db->prepare("SELECT * FROM `stock_drug_amount` $condition ORDER BY id  DESC  LIMIT $to OFFSET $from");
      $view_data->execute();

   $list_data  = $db->query("SELECT count(id) as record FROM  `stock_drug_amount` $condition ")->fetch();
   $record     = $list_data['record'];
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <?php
         $title = " گزارش موجودی دوا ";
         require_once("_head.php");
         ?>
   </head>
   <body class="body" style="scrollbar-width: thin;">
      <div id="wrapper" class="wrapper animsition">
         <!-- Navigation -->
         <?php require_once("_navigation.php");?>
         <!-- /.Navigation -->
         <?php $menu = "report"; $sub = "report_exit_durg";?>
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
               </div>
               <!-- /. Content Header (Page header) -->
               <?php // require_once("message.php");?>
               <?php require_once "alert.php" ?>
          
               <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                     <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  جستجو دوا </h4>
                           </div>
                        </div>
                        <div class="panel-body bfont">
                           <br>
                           <form id="validation-form" class="form-inline form-label-left" method="post" action="">
                              <input type="hidden" name="search" value="1">

                            <div class="row"> 
                                <div class="item form-group col-md-3">
                                    <label class="control-label " for="drug_id">  نام دوا     </label>
                                    <div >
                                        <select class="form-control basic-single" dir="rtl" name="drug_id" id="drug_id">
                                        <option value=""> دوا انتخاب نماید  </option>
                                        <?php
                                            $category = select_all('drug','','desc');
                                            foreach ($category as $key => $row) {
                                                echo '<option value="'.$row['id'].'"> '.$row['scientific_name'].' '.$row['drug_code'].'   </option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                              <div class="item form-group col-md-3">
                                 <label class="control-label " for="stock_id">  گدام     </label>
                                 <div >
                                    <select class="form-control basic-single" dir="rtl" name="stock_id" id="stock_id">
                                       <option value=""> گدام انتخاب نماید  </option>
                                       <?php
                                          $category = select_all('stock','','desc');
                                          foreach ($category as $key => $row) {
                                              echo '<option value="'.$row['id'].'"> '.$row['name'].'  </option>';
                                          }
                                          ?>
                                    </select>
                                 </div>
                              </div>

                                <div class="form-group col-md-3" style="margin-top:2rem">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                    <a  href="report_exit_durg.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                </div>

                            </div>                              

                           </form>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                     </div>
                  </div>
               </div>

              <a href="excel_report_exit_drug.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
              </a>

               <div class="panel panel-default lobidisable">
                  <div class="panel-heading">
                     <div class="panel-title">
                        <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست دوا های موجود </h4>
                     </div>
                  </div>
                  <div class="panel-body scroll" style="overflow-y:hidden;">
                     <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                     <table id="employee_data" class="table table-bordered table-striped table-hover">
                        <thead>
                           <th class="text-center">شماره</th>
                           <th> نام  کتگوری</th>
                           <th class="text-center">کد دوا</th>
                           <th>نام  علمی</th>
                           <th>نام تجارتی</th>
                           <th> تعداد   </th>
                           <th> گدام    </th>
                        </thead>
                        <tbody>
                           <?php
                              if($view_data->rowCount() ){
                              
                                  foreach ($view_data as $key => $row) {
                              
                                      $drug_row = select_one('drug',$row['drug_id']);


                                       // $positiones       = $row['stock_id'];
                                       // $durg_ides        = $row['drug_id'];
                                       
                                       // $amount_exsit_drug_in_stock       = $db->query("SELECT * FROM `stock_drug_amount` WHERE `stock_id` = '$positiones' AND `drug_id` = '$durg_ides' LIMIT 1");
                              
                                       // $drugs_amount = 0;
                                       // if($amount_exsit_drug_in_stock->rowCount() > 0 ){
                                       //    $drugs_amount = $amount_exsit_drug_in_stock->fetch();
                                       //    $drugs_amount =  $drugs_amount['amount'] + 0;
                                       // }

                                       echo '
                                          <tr style="height: 40px;">
                                              <td class="text-center">'.$count++.' </td>
                                              <td> '. get_column_value('categories',$drug_row['category_id'],'name').' </td>
                                              <td> <p  class ="cfont text-center drug-code">  '.$drug_row['drug_code'].'</p> </td>
                                              <td> '.$drug_row['scientific_name'].' </td>
                                              <td> '.$drug_row['company_name'].' </td>
                                              <td> '.$row['amount'].' </td>
                                              <td> '.get_column_value('stock',$row['stock_id'],'name').' </td>
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
                     <div class="center">
                        <?php
                           $pagination->records($record);
                           $pagination->records_per_page($records_per_page);
                           if($record>50){
                               $pagination->render();
                           }
                           ?>
                     </div>
                  </div>
               </div>
               <div class="t-height"></div>
            </div>
            <!-- /.main content -->
         </div>
         <!-- /#page-wrapper -->
         <?php require_once("_footer.php");?>
      </div>
      <!-- /#wrapper -->
      <!-- START CORE PLUGINS -->
      <?php require_once("_script.php");?>
   </body>
</html>
<script type="text/javascript">
   function startDateEndDate(start_date , end_date){
           $("#start_date").val(''); 
           $("#end_date").val(''); 
   }
   setTimeout(startDateEndDate, 10);
</script>