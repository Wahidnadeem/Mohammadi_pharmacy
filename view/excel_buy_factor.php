<?php

    require_once "_config.php";
    
    $condition = $_GET['condition'];

    $view_data = $db->prepare("SELECT * FROM `buy_sell_drug` WHERE deleted = :deleted AND `type` = :type  $condition ORDER BY id DESC ");
    $view_data->execute(['deleted' => 0 , 'type' =>'buy' ]);

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
                                    <li class="active"> خروجی گرفتن </li>
                                </ol>
                            </div>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->

                     <a id="export_button" href="list_buy_factor.php" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-file-excel-o"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی اکسل</span>&nbsp;
                    </a>
                    &nbsp;
                     <a href="list_buy_factor.php" class="btnc btnc-success btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;">
                        <i class="fa fa-rotate-left"></i>&nbsp;
                        <span class="ladda-label bfont">برگشت  به لیست  فاکتور  های خرید</span>&nbsp;
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
                                        <th>بل نمبر</th>
                                        <th>فروشنده دوا</th>
                                        <th>جمع کل</th>
                                        <th>مقدار  پرداختی </th>
                                        <th>الباقی</th>
                                        <th>تاریخ</th>
                                        <th>تفصیلات</th>
                                        <th>کاربر</th>
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
                                                    <tr style="height:35px;">
                                                        <td class="text-center"><span style="font-size:14px;" class ="label label-pill label-danger-outline"> '.$row['code_number'].'</span> </td>
                                                        <td> '. get_column_value('customers',$row['customer_id'],'fullname').' </td>
                                                        <td style="background-color:#81f579;" class="text-center">'.number_format($total_amount,0).'</td>
                                                        <td style="background-color:#3abee5;" class="text-center"> '.number_format($payment_amount,0).' </td>
                                                        <td style="background-color:#e36f6f;" class="text-center"> '.number_format($remain_amount,0).'</td>
                                                        <td> '.$row['date'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
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
