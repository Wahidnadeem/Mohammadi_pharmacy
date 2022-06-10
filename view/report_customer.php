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

  $view_data = $db->prepare("SELECT * FROM `customer_transaction` WHERE `type`=:type  $condition ORDER BY id DESC LIMIT $to OFFSET $from");
  $view_data->execute(['type' => 'buyer' ]);

  $list_data  = $db->query("SELECT count(id) as record FROM customer_transaction WHERE `type` = 'buyer' $condition ")->fetch();
  $record     = $list_data['record'];

    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            
            $title = ' گزارش مشتری ها  ';
            require_once("_head.php");
            ?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "report"; $sub = "report_customer";?>
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
                                                    <label class="control-label" for="customer_id">  مشتری   </label>
                                                    <div>
                                                        <select class="form-control basic-single" dir="rtl" name="customer_id" id="customer_id">
                                                            <option value=""> مشتری انتخاب نماید  </option>
                                                            <?php
                                                                $customers = select_all('customers','','desc');
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
                                                    <label class="control-label" for="start_date"> از تاریخ  </label>
                                                    <div>
                                                        <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="end_date"> تاریخ الی  </label>
                                                    <div>
                                                        <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    
                                                    <label class="control-label" >&nbsp; </label>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                        <a  href="report_customer.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
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

                    <a id="export_button" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی اکسل  </span>&nbsp;
                    </a>

                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست  گزارش مشتری ها , آخرین موارد ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="employee_data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>نام مشتری</th>
                                        <th>خرید</th>
                                        <th>فروش</th>
                                        <th>موجودی</th>
                                        <th class="text-center">دیدن    جزيیات</th>
                                    </thead>
                                    <tbody>
                                    
                                     <?php

                                        if($view_data->rowCount() ){

                                            $count = 1;
                                            foreach ($view_data as $key => $row) {

                                                $customer_id = $row['customer_id'];
                                                $customer_amount_row = $db->query("SELECT amount FROM `customer_transaction` WHERE `customer_id` = '$customer_id' AND `type` = 'seller'")->fetch();
                                                $amount_credite = $customer_amount_row['amount'];
                                                @$total_amount = ($amount_credite - $row['amount']);

                                                if ($total_amount > 0) {
                                                    $total_amounts = '<td style ="color: #16df64fa !important;">'.$total_amount.'</td>';
                                                }else{
                                                     $total_amounts = '<td style ="color: #f6465d !important;">'.$total_amount.'</td>';
                                                }

                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td> '. get_column_value('customers',$row['customer_id'],'fullname').' </td>
                                                        <td>'.@$customer_amount_row['amount'].'</td>
                                                        <td>'.$row['amount'].'</td>
                                                        '.$total_amounts.'
                                                        <td class="text-center">
                                                            <a href="report_total_transaction.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-info btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-info"></i></button></a>
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
    function getCodeNumber(id) {
          $.ajax ({
            url: "ajax.php",
            method: "POST" ,
            data: {
                   id     :id,
                   type   :"BuyFactorCodeNumber"},
            success:function(data){
                $('#factor_customer').html(data);
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