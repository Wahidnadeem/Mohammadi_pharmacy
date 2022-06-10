<?php 
    
    require_once ("_config.php");

    $customer_row = $db->query("SELECT COUNT(id) AS number_customer FROM `customers` WHERE `deleted` = '0'")->fetch();
    $user_row = $db->query("SELECT COUNT(id) AS number_user FROM `users` WHERE `deleted` = '0'")->fetch();
    $stock_row = $db->query("SELECT COUNT(id) AS number_stock FROM `stock` WHERE `deleted` = '0'")->fetch();
    $drug_row = $db->query("SELECT COUNT(id) AS number_drug FROM `buy_sell_assets` WHERE type = 'buy' AND deleted = 0 AND status != 'done'")->fetch();
    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
        $title = " خانه ";
        require_once("_head.php");?>  


    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "index"; $sub = ''; ?>
            <!-- Sidebar -->
            <?php require_once("_sidebar.php");?>
            <!-- /.Sidebar -->            
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- <div class="content-header">
                        <div style="background:white;padding:10px;padding-top:6px;padding-bottom:7px;">
                            <div class="header-title" style="margin-right:0px;">
                                <ol class="breadcrumb">
                                    <li class="active"><a href="index.php"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                                    <li class="active"> نمای  از صفحه اصلی </li>
                                </ol>
                            </div>
                        </div>
                    </div> -->
                    <br>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box">
                                <h2><span style="font-size: 30px;"><?php echo $customer_row['number_customer'];?></span></h2>
                                <div class=small>مشتریان</div>
                                <i style="color:#fff" class="fa fa-users statistic_icon"></i>
                                <div class="sparkline3 text-center"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box">
                                <h2><span style="font-size: 30px;"><?php echo $drug_row['number_drug'];?></span> <span class=slight></span></h2>
                                <div class=small>موجودی دوا</div>
                                <i style="color:#fff" class="ti-server statistic_icon"></i>
                                <div class="sparkline1 text-center"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box">
                                <h2><span style="font-size: 30px;"><?php echo $stock_row['number_stock'];?></span></h2>
                                <div class=small>تعداد گدام های فعال</div>
                                <i style="color:#fff" class="ti-layout-grid4-alt statistic_icon"></i>
                                <div class="sparkline2 text-center"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box">
                                <h2><span style="font-size: 30px;"><?php echo $user_row['number_user'];?></span><span class=slight></span> </h2>
                                <div class=small>کاربران</div>
                                <i style="color:#fff" class="ti-user statistic_icon"></i>
                                <div class="sparkline2 text-center"></div>
                            </div>
                        </div>
                        
                    </div>  


                    <div class="row"> 


                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="col-sm-6 col-md-12">
                            <div class="panel panel-info lobidisable" style="height:495px">
                                <div class="panel-heading ">
                                    <div class="panel-title">
                                        <h5 class="bfont">گراف  دواهای پرفروش</h5>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <canvas id="doughutChart" height="310"></canvas>
                                </div>
                            </div>
                        </div>                 
                    </div>  
                     <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="panel panel-bd  panel-info lobidisable" style="height:495px">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h4>گراف </h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <canvas id="pieChart" height="310"></canvas>
                            </div>
                        </div>            
                    </div>   -->


                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="panel panel-info lobidisable">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5 class="bfont"><i class="fa fa-laptop"></i> گزارشات سیستم</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body bfont">
                                        <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tbody>
                                                <tr>
                                                    <th class="hth text-center">
                                                        <a href="report_buy_drug.php">
                                                            <img class="img-home-img" src="img/5.png" style="width:100px;"><br>گزارش فاکتور خرید
                                                        </a>
                                                    </th>
                                                    <th class="hth text-center">
                                                        <a href="report_sell_drug.php">
                                                            <img class="img-home-img" src="img/sell-factor.png" style="width:100px;"><br> گزارش فاکتور فروش
                                                        </a>
                                                    </th>
                                                    
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th class="hth text-center">
                                                        <a href="report_exit_durg.php">
                                                            <img class="img-home-img" src="img/buy-factor.png" style="width:100px;"><br> گزارش دواهای موجود
                                                        </a>
                                                    </th>
                                                    <th class="hth text-center">
                                                        <a href="report_expiry_date.php">
                                                            <img class="img-home-img" src="img/18.png" style="width:150px;"><br> گزارش دواهای تاریخ تیرشده
                                                        </a>
                                                    </th>
                                                    
                                                    
                                                    </tr>
                                                    <tr>
                                                    <th class="hth text-center">
                                                        <a href="list_transaction.php">
                                                            <img class="img-home-img" src="img/12.png" style="width:100px;"><br>گزارش  رسید و برد
                                                        </a>
                                                    </th>
                                                    <th class="hth text-center">
                                                        <a href="report_debt_customer.php">
                                                            <img class="img-home-img" src="img/9.png" style="width:100px;"><br>گزارش قرض داران
                                                        </a>
                                                    </th>
                                                    
                                                    
                                                    </tr>
                                                    <tr>
                                                   
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                        
                        </div>          
                        
                </div>
            </div>
                            
       </div>
    </div><!-- /#page-wrapper -->
<!-- START CORE PLUGINS -->
    
        <?php require_once("_script.php");?>
        <script type="text/javascript">
            //doughut chart
                var ctx = document.getElementById("doughutChart");
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                                data: [45, 25, 20, 10],
                                backgroundColor: [
                                    "rgb(227 16 16 / 90%)",
                                    "rgb(16 139 227 / 90%)",
                                    "rgb(227 191 16 / 90%)",
                                    "rgb(252 181 64)"
                                ],
                                hoverBackgroundColor: [
                                    "rgb(227 16 16 / 90%)",
                                    "rgba(85, 139, 47, 0.7)",
                                    "rgba(85, 139, 47, 0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            }],
                        labels: [
                            "پرستامول",
                            "دیکلیفونک",
                            "ترامادول",
                            "استامنیفون"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });

                //pie chart
                var ctx = document.getElementById("pieChart");
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                                data: [45, 25, 20, 10],
                                backgroundColor: [
                                    "rgb(227 16 16 / 90%)",
                                    "rgb(16 139 227 / 90%)",
                                    "rgb(227 191 16 / 90%)",
                                    "rgb(252 181 64)"
                                ],
                                hoverBackgroundColor: [
                                    "rgba(85, 139, 47, 0.9)",
                                    "rgba(85, 139, 47, 0.7)",
                                    "rgba(85, 139, 47, 0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            }],
                        labels: [
                            "green",
                            "green",
                            "green",
                            "green"
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });

        </script>
    </body>
</html>