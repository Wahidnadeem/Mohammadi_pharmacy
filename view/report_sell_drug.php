<?php
   require_once "_config.php";
   

   $condition = ''; 
   if(!empty($_POST['search'])){

        $start_end_date  = '';
        if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
            $start_date = VD($_POST['start_date']);
            $end_date   = VD($_POST['end_date']);
            
            $start_end_date .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
        }

        if(!empty($_POST['code_number'])){
            $code_number = VD($_POST['code_number']);
            $buy_sell_id = $db->query("SELECT * FROM `buy_sell_drug` WHERE `code_number` = $code_number and `type` = 'sell' AND deleted = 0 $start_end_date LIMIT 1 ");
            if($buy_sell_id->rowCount() > 0 ){
                $buy_sell_id_row    = $buy_sell_id->fetch();
                $buy_sell_drug_id   = $buy_sell_id_row['id'];
                $condition = " AND buy_sell_drug_id = $buy_sell_drug_id  ";
            }else {
                $condition = " AND buy_sell_drug_id = 0 ";
            }
        }

        if(!empty($_POST['customer_id'])){
            
            $customer_id = $_POST['customer_id'];
            $buy_sell_ides = $db->query("SELECT id FROM `buy_sell_drug` WHERE `customer_id` = $customer_id and `type` = 'sell' AND deleted = 0 $start_end_date ");
            
            if($buy_sell_ides->rowCount() > 0){
                $ides = '( ';
                foreach ($buy_sell_ides as $key => $value) {
                    $ides .= $value['id'].' ,'; 
                }
                $ides =  substr_replace($ides ,"", -1);
                $ides .= ' ) '; 
    
            }else {
                $ides  = '( 0 )';
            }

            $condition .= " AND  buy_sell_drug_id IN $ides  ";
        }


        if(!empty($_POST['drug_id'])){
            $drug_id = VD($_POST['drug_id']);
        
            $condition = " AND drug_id = $drug_id  ";
        }

        if(!empty($_POST['stock_id'])){
            $stock_id = VD($_POST['stock_id']);
        
            $condition = " AND stock_id = $stock_id  ";
        }

        if(!empty($_POST['start_date']) && !empty($_POST['end_date']) && empty($_POST['code_number']) && empty($_POST['customer_id']) ){
            $start_date = VD($_POST['start_date']);
            $end_date   = VD($_POST['end_date']);
            

            $buy_sell_ides = $db->query("SELECT id FROM `buy_sell_drug` WHERE `type` = 'sell' AND deleted = 0 AND `date` BETWEEN  '$start_date' AND '$end_date' ");
            
            if($buy_sell_ides->rowCount() > 0){
                $ides = '( ';
                foreach ($buy_sell_ides as $key => $value) {
                    $ides .= $value['id'].' ,'; 
                }
                $ides =  substr_replace($ides ,"", -1);
                $ides .= ' ) '; 
    
            }else {
                $ides  = '( 0 )';
            }

            $condition .= " AND  buy_sell_drug_id IN $ides  ";

        }
        

   }


   $view_data = $db->prepare("SELECT * FROM `buy_sell_assets` WHERE type = 'sell' AND deleted = 0 AND status != 'done' $condition ORDER BY id DESC LIMIT $to OFFSET $from");
   $view_data->execute();
   $list_data  = $db->query("SELECT count(id) as record FROM `buy_sell_assets` WHERE type = 'sell' AND deleted = 0 AND status != 'done' $condition ")->fetch();
   $record     = $list_data['record'];
   
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

                                <div class="item form-group col-md-2">
                                    <label class="control-label " for="code_number">  بل نمبر       </label>
                                    <div>
                                        <input type="number" id="code_number" name="code_number" class="form-control cfont" placeholder="">
                                    </div>
                                </div>


                                <div class="item form-group col-md-2">
                                    <label class="control-label " for="customer_id">  نام مشتری       </label>
                                    <div >
                                        <select class="form-control basic-single" dir="rtl" name="customer_id" id="customer_id">
                                        <option value="">  مشتری انتخاب نماید </option> 
                                            <?php
                                                $customers = $db->query("SELECT * FROM `customers` WHERE `deleted` = '0' AND `type` = 'buyer' ORDER BY id DESC ");
                                                foreach ($customers as $key => $row) {
                                                    echo '<option value="'.$row['id'].'"> '.$row['fullname'].'  '.$row['company_name'].' </option> ';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                              <div class="item form-group col-md-2">
                                 <label class="control-label " for="drug_id">  نام دوا      </label>
                                 <div >
                                    <select class="form-control basic-single" dir="rtl" name="drug_id" id="drug_id">
                                       <option value=""> دوا انتخاب نماید  </option>
                                       <?php
                                          $category = select_all('drug','','desc');
                                          foreach ($category as $key => $row) {
                                              echo '<option value="'.$row['id'].'"> '.$row['scientific_name'].'  </option>';
                                          }
                                          ?>
                                    </select>
                                 </div>
                              </div>

                              <div class="item form-group col-md-2">
                                 <label class="control-label " for="stock_id">  نام گدام       </label>
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

                              <div class="col-md-2">
                                    <div class="item form-group">
                                        <label class="control-label" for="start_date"> از تاریخ  </label>
                                        <div class="">
                                            <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="item form-group">
                                        <label class="control-label" for="end_date"> تاریخ الی  </label>
                                        <div class="">
                                            <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" style="margin-top:1rem">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                    <a  href="report_buy_drug.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                </div>

                            </div>                              

                           </form>
                        </div>
                        <div class="panel-footer">&nbsp;</div>
                     </div>
                  </div>
               </div>

                <a href="excel_sell_drug.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
                </a>

               <div class="panel panel-default lobidisable">
                  <div class="panel-heading">
                     <div class="panel-title">
                        <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست دوا های فروش شده </h4>
                     </div>
                  </div>
                  <div class="panel-body scroll" style="overflow-y:hidden;">
                     <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                     <table id="employee_data" class="table table-bordered table-striped table-hover">
                        <thead>
                           <th class="text-center">شماره</th>
                           <th> بل نمبر فاکتور فروش </th>
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
                                          <tr style="height:40px;">
                                              <td class="text-center">'.$count++.' </td>
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