<?php

    require_once "_config.php";

    $condition = $_GET['condition'];


  $view_data = $db->prepare("SELECT * FROM `transaction` WHERE deleted = :deleted  $condition ORDER BY id DESC");
  $view_data->execute(['deleted' => 0]);


    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست   رسید و برد مشتری";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "transaction"; $sub = "list_transaction";?>
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
                    </div> <!-- /. Content Header (Page header) -->
                    <?php // require_once("message.php");?>


                   <a id="export_button" href="list_transaction.php" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-file-excel-o"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی اکسل</span>&nbsp;
                    </a>
                    &nbsp;
                     <a href="list_transaction.php" class="btnc btnc-success btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;">
                        <i class="fa fa-rotate-left"></i>&nbsp;
                        <span class="ladda-label bfont">برگشت  به لیست  رسید و برد اشخاص / دفاتر</span>&nbsp;
                    </a>

                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i>  لیست  دوا  ها   ، آخرین موارد ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="employee_data" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th> نام  شخص / دفتر</th>
                                        <th>نوعیت</th>
                                        <th>مقدار پول</th>
                                        <th>تفصیلات</th>
                                        <th>تاریخ</th>
                                        <th>کاربر</th>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {

                                                if ($row['type'] == "credit") {
                                                   $type_status = '<td class = "recive_money">رسید</td>';
                                                }elseif($row['type'] == "debt"){
                                                           $type_status = '<td class = "send_money">برد</td>';
                                                     }
                                                echo '
                                                    <tr>
                                                        <td> '. get_column_value('customers',$row['customer_id'],'fullname').' </td>
                                                       '.$type_status.'
                                                        <td> '.$row['amount'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.$row['date'].' </td>
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
