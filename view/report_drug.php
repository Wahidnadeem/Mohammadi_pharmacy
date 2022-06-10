<?php

    require_once "_config.php";
    
    $condition = '';

  if(isset($_POST['search'])){
    
    
    if(!empty($_POST['drug_id'])){
        $drug_id = VD($_POST['drug_id']);
        $condition  .= " AND drug_id = '$drug_id' ";
    }

     if(!empty($_POST['stock_id'])){
        $stock_id = VD($_POST['stock_id']);
        $condition  .= " AND stock_id = '$stock_id' ";
    }

    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
        $start_date = VD($_POST['start_date']);
        $end_date   = VD($_POST['end_date']);
        
        $condition .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
    }

  }

  $view_data = $db->query("SELECT * FROM `drugs_amount` $condition ORDER BY id DESC LIMIT $to OFFSET $from");

  $list_data  = $db->query("SELECT count(id) as record FROM drugs_amount $condition ")->fetch();
  $record     = $list_data['record'];

    ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            
            $title = ' گزارش  موجودی دوا  ';
            require_once("_head.php");
            ?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "report"; $sub = "report_drug";?>
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

                                        <div class="item form-group">
                                            <label class="control-label" for="drug_id">  دوا   </label>
                                            <div>
                                                <select class="form-control basic-single" dir="rtl" name="drug_id" id="drug_id">
                                                    <option value=""> دوا انتخاب نماید  </option>
                                                    <?php
                                                        $customers = select_all('drug','','desc');
                                                        foreach ($customers as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['scientific_name'].'  </option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="item form-group">
                                            <label class="control-label" for="stock_id">  گدام   </label>
                                            <div>
                                                <select class="form-control basic-single" dir="rtl" name="stock_id" id="stock_id">
                                                    <option value=""> گدام انتخاب نماید  </option>
                                                    <?php
                                                        $customers = select_all('stock','','desc');
                                                        foreach ($customers as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['name'].'  </option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label" for="start_date"> از تاریخ  </label>
                                            <div>
                                                <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label" for="end_date"> تاریخ الی  </label>
                                            <div>
                                                <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            
                                            <label class="control-label" >&nbsp; </label>
                                            <div>
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                <a  href="report_customer.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست  گزارش دوا ها , آخرین موارد ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>کتگوری</th>
                                        <th>دوا</th>
                                        <th>گدام</th>
                                        <th>موجودی</th>
                                        <th class="text-center">دیدن    جزيیات</th>
                                    </thead>
                                    <tbody>
                                    
                                     <?php

                                        if($view_data->rowCount() ){

                                            $count = 1;
                                            foreach ($view_data as $key => $row) {

                                                $id = $row['drug_id'];
                                                $category_row = $db->query("SELECT category_id FROM `drug` WHERE `id` = '$id' AND `deleted` = '0'")->fetch();

                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td> '. get_column_value('categories',$category_row['category_id'],'name').' </td>
                                                        <td> '. get_column_value('drug',$row['drug_id'],'scientific_name').' </td>
                                                        <td> '. get_column_value('stock',$row['stock_id'],'name').' </td>
                                                        <td>'.$row['amount'].'</td>
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