<?php
require_once "_config.php";

  $condition = '';

  if(isset($_POST['search'])){

    if(!empty($_POST['customer_id'])){
        $customer_id   = VD($_POST['customer_id']);
        $condition    .= " AND customer_id = $customer_id  "; 
    }

  }

  $view_data = $db->prepare("SELECT * FROM `customer_transaction` WHERE `type` = 'seller' AND `amount` !=  0  $condition ORDER BY id DESC LIMIT $to OFFSET $from");
  $view_data->execute();

  $list_data  = $db->query("SELECT count(id) as record FROM customer_transaction WHERE `type` = 'seller'  AND `amount` !=  0  $condition ")->fetch();
  $record     = $list_data['record'];


    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست قرض داران ";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "report"; $sub = "report_debt_customer";?>
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
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  جستجو مشتری </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    
                                    <form id="validation-form" class="form-inline form-label-left" method="post" action="">

                                        <input type="hidden" name="search" value="1">

                                        <div class="">
                                            <div class="item form-group col-md-3">
                                                <label class="control-label" for="customer_id"> مشتری </label>
                                                <div class="">
                                                    <select class="form-control basic-single" dir="rtl" name="customer_id" id="customer_id">
                                                    <option value="">  مشتری انتخاب نماید </option> 
                                                    <?php
                                                        $customers = $db->query("SELECT * FROM `customers` WHERE `deleted` = '0' AND `type` = 'buyer' ORDER BY id");
                                                        foreach ($customers as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['fullname'].' - '.$row['company_name'].' </option> ';
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">  &nbsp; </label>
                                                <div>
                                                    <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                    <a  href="report_debt_customer.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <a href="excel_report_debt_customer.php?condition=<?php echo $condition;?>" class="btnc btnc-primary  btnc-icon-anim pointer" style="text-decoration: none;margin-bottom: 0.6rem;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                       <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
                    </a>
                    <br>
                    <br>
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست مشتری های قرضدار </h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="employee_data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center">شماره</th>
                                        <th> نوعیت مشتری </th>
                                        <th> نام کامل  </th>
                                        <th>نام شرکت</th>
                                        <th>شماره تماس</th>
                                        <th>تاریخ</th>
                                        <th>تفصیلات</th>
                                        <th>مقدار قرض </th>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {

                                                $customer_row = select_one('customers',$row['customer_id']);

                                                 if ($row['type'] == "buyer") {
                                                   $type_status = '<td class = "send_money">فروشنده دوا</td>';
                                                }elseif($row['type'] == "seller"){
                                                    $type_status = '<td class = "recive_money">مشتری</td>';
                                                }

                                                echo '
                                                    <tr>
                                                        <td class="text-center" style="height:40px;">'.$count++.' </td>
                                                        '.$type_status.'
                                                        <td> '.$customer_row['fullname'].' </td>
                                                        <td> '.$customer_row['company_name'].' </td>
                                                        <td> '.$customer_row['phone'].' </td>
                                                        <td> '.$customer_row['date'].' </td>
                                                        <td> '.$customer_row['note'].' </td>
                                                        <td> '.$row['amount'].' </td>
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
                 <?php require_once("_footer.php");?>
            </div><!-- /#wrapper -->
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