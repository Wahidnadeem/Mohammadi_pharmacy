<?php

    require_once "_config.php";
    
    $condition = '';

  if(isset($_POST['search'])){
    
    
    if(!empty($_POST['code_number'])){
        $code_number = VD($_POST['code_number']);
        $condition  .= " AND code_number = '$code_number' ";
    }

     if(!empty($_POST['customer_id'])){
        $customer_id = VD($_POST['customer_id']);
        $condition  .= " AND customer_id = '$customer_id' ";
    }

    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
        $start_date = VD($_POST['start_date']);
        $end_date   = VD($_POST['end_date']);
        
        $condition .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
    }

  }

  $view_data = $db->prepare("SELECT * FROM `buy_sell_drug` WHERE deleted = :deleted AND `type` = :type  $condition ORDER BY id DESC LIMIT $to OFFSET $from");
  $view_data->execute(['deleted' => 0 , 'type' =>'buy' ]);

  $list_data  = $db->query("SELECT count(id) as record FROM buy_sell_drug WHERE deleted = 0 AND `type` = 'buy' $condition ")->fetch();
  $record     = $list_data['record'];

    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            
            $title = ' لیست فاکتور  های خرید  ';
            require_once("_head.php");
            ?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "buy_factor"; $sub = "list_buy_factor";?>
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
                                    <li class="active"> <?= $title?> </li>
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
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  جستجو  فاکتور خرید </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    <br>
                                    <form id="validation-form" class="form-inline form-label-left" method="post" action="">
                                        <input type="hidden" name="search" value="1">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="code_number"> بل نمبر </label>
                                                    <div class="">
                                                        <input type="text" id="code_number" name="code_number" class="form-control cfont" placeholder="مثلا : 1202">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="customer_id">  فروشنده دوا   </label>
                                                    <div class="">
                                                        <select class="form-control basic-single" dir="rtl" name="customer_id" id="customer_id">
                                                            <option value=""> فروشنده دوا انتخاب نماید  </option>
                                                            <?php
                                                                $customers = $db->query("SELECT * FROM customers WHERE `type` = 'seller' AND deleted = '0' ORDER BY id DESC");
                                                                foreach ($customers as $key => $row) {
                                                                    echo '<option value="'.$row['id'].'"> '.$row['fullname'].'  </option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="start_date"> از تاریخ  </label>
                                                    <div class="">
                                                        <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="end_date"> تاریخ الی  </label>
                                                    <div class="">
                                                        <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label " > &nbsp; </label>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                        <a  href="list_buy_factor.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>

                     <a href="excel_buy_factor.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
                    </a>

                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست فاکتور های خرید، آخرین موارد ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <form action="all_print_buy_factor.php" target="_blank" id="print_form_factor" method="post">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="employee_data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>بل نمبر</th>
                                        <th>فروشنده دوا</th>
                                        <th>جزییات فاکتور خرید</th>
                                        <th>جمع کل</th>
                                        <th>مقدار  پرداختی </th>
                                        <th>الباقی</th>
                                        <th>تاریخ</th>
                                        <th>تفصیلات</th>
                                        <th>کاربر</th>
                                        <th class="text-center">اجرآت</th>
                                    </thead>
                                    <tbody>
                                    
                                     <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {

                                                $buy_sell_id = $row['id'];
                                                $customer_buy_sell_payment  = $db->query("SELECT * FROM customer_buy_sell_payment WHERE buy_sell_drug_id = $buy_sell_id ");

                                                $total_amount   = 0;
                                                $payment_amount = 0;
                                                $remain_amount  = 0;

                                                if($customer_buy_sell_payment->rowCount() > 0 ){
                                                    $customer_buy_sell_payment_row  = $customer_buy_sell_payment->fetch();

                                                    $total_amount   = $customer_buy_sell_payment_row['total_amount'];
                                                    $payment_amount = $customer_buy_sell_payment_row['payment_amount'];
                                                    $remain_amount  = $customer_buy_sell_payment_row['remain_amount'];
                                                }

                                            
                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td class="text-center"><span style="font-size:14px;" class ="label label-pill label-danger-outline"> '.$row['code_number'].'</span> </td>
                                                        <td> '. get_column_value('customers',$row['customer_id'],'fullname').' </td>
                                                        <td style="cursor: pointer;" onclick="showDetails('.$row['id'].')">
                                                         جزییات  فاکتور نمبر  '.$row['code_number'].'
                                                        </td>
                                                        <td style="background-color:#81f579;" class="text-center">'.number_format($total_amount,0).'</td>
                                                        <td style="background-color:#3abee5;" class="text-center"> '.number_format($payment_amount,0).' </td>
                                                        <td style="background-color:#e36f6f;" class="text-center"> '.number_format($remain_amount,0).'</td>
                                                        <td> '.$row['date'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
                                                        <td class="text-center">
                                                            <a href="edit_buy_factor.php?id='.base64_encode($row['id']).'" class="left"><button type="button" class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                                            <a class="left delete-row"  href="action_buy_factor.php?delete&id='.base64_encode($row['id']).'"><button type="button" class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                                            <a href="pdf_buy_factor.php?id='.base64_encode($row['id']).'" target="_blank"  ><button type="button" class="btnc btnc-primary btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-file-pdf-o"></i></button></a>
                                                        </td>
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
                                </form>
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

                    </div> <!-- /.main content -->
                </div><!-- /#page-wrapper -->
                  <?php require_once("_footer.php");?>
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->

        <div class="modal fade larg" id="myModal" tabindex="-1" role="dialog" style="overflow-x:auto;">
             <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="height: 60px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h1 class="modal-title mb-20">جزییات فاکتور  خرید </h1>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>نام دارو</th>
                                        <th>تعداد</th>
                                        <th>    فی دانه </th>
                                        <th>    مبلغ</th>
                                        <th>    موقعیت</th>
                                        <th>تاریخ انقضا</th>
                                        <th class="text-center">کاربر</th>
                                        <th class="text-center">اجرآت</th>
                                    </thead>
                                    <tbody id="factor_customer">
                                        
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="modal-footer" dir="ltr" style="border:none;">
                        <button type="button" class="btnc btnc-danger" data-dismiss="modal">بستن</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php require_once("_script.php");?>
    </body>
</html>

<script type="text/javascript">
    function showDetails(id) {
          $.ajax ({
            url: "ajax.php",
            method: "POST" ,
            data: {
                id     :id,
                type   :"showBuyFactorDetails"
            },
            success:function(data){
                $('#factor_customer').html(data);
                $('#myModal').modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
         function startDateEndDate(start_date , end_date){
                    $("#start_date").val(''); 
                    $("#end_date").val(''); 
            }
            setTimeout(startDateEndDate, 10);
    </script>

<script type="text/javascript">
// $('#print_all').on('ifChecked', function(event){
// $("#is_print").iCheck('check');
// });

// $('#print_all').on('ifUnchecked', function(event){
// $("#is_print").iCheck('uncheck');
// });
// $(document).ready(function(){
//     $("#print_factor").click(function(){
//         $("#print_form_factor").submit();
//     });
// });
</script>