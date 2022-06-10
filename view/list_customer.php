<?php
require_once "_config.php";

  $condition = '';

  if(isset($_POST['search'])){

    if(!empty($_POST['fullname'])){
        $fullname = VD($_POST['fullname']);
        $condition  .= " AND id = '$fullname' ";
    }

    if(!empty($_POST['type_customer'])){
        $type_customer = VD($_POST['type_customer']);
        $condition  .= " AND type = '$type_customer' ";
    }

     if(!empty($_POST['company_name'])){
        $company_name = VD($_POST['company_name']);
        $condition  .= " AND company_name LIKE '%$company_name%' ";
    }

    if(!empty($_POST['phone'])){
        $phone = VD($_POST['phone']);
        $condition  .= " AND phone = '$phone' ";
    }

    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
        $start_date = VD($_POST['start_date']);
        $end_date   = VD($_POST['end_date']);

        $condition .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
    }
  }

  $view_data = $db->prepare("SELECT * FROM `customers` WHERE deleted = :deleted  $condition ORDER BY fullname ASC LIMIT $to OFFSET $from");
  $view_data->execute(['deleted' => 0]);

  $list_data  = $db->query("SELECT count(id) as record FROM customers WHERE deleted = 0 $condition ")->fetch();
  $record     = $list_data['record'];


    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست مشتری  ها";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "customer"; $sub = "list_customer";?>
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

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="type_customer"> نوعیت مشتری </label>
                                                    <div class="">
                                                        <select class="form-control basic-single" dir="rtl" name="type_customer" id="type_customer">
                                                            <option value=""> نوعیت  مشتری را انتخاب نماید  </option>
                                                            <option value="seller"> فروشنده دوا </option>
                                                            <option value="buyer"> مشتری </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="fullname"> مشتری </label>
                                                    <div class="">
                                                        <select class="form-control basic-single" dir="rtl" name="fullname" id="fullname">
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
                                                    <label class="control-label" for="company_name">  نام شرکت  </label>
                                                    <div class="">
                                                        <input type="text" id="company_name" name="company_name" class="form-control cfont" placeholder="مثلا : آسیاه فارما">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="phone">  شماره تماس   </label>
                                                    <div class="">
                                                        <input type="text" id="phone" name="phone" class="form-control cfont"  placeholder="مثلا : 0794284644"  >
                                                    </div>
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

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">  &nbsp; </label>
                                                    <div>

                                                        <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                        <a  href="list_customer.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
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

                     <a href="excel_list_customer.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
                    </a>
                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i>  لیست مشتری ها    ، آخرین موارد ثبت شده.</h4>
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
                                        <th>کاربر</th>
                                        <th class="text-center">تغییرات</th>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {

                                                 if ($row['type'] == "seller") {
                                                   $type_status = '<td class = "send_money">فروشنده دوا</td>';
                                             }elseif($row['type'] == "buyer"){
                                                   $type_status = '<td class = "recive_money">مشتری</td>';
                                             }

                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        '.$type_status.'
                                                        <td> '.$row['fullname'].' </td>
                                                        <td> '.$row['company_name'].' </td>
                                                        <td> '.$row['phone'].' </td>
                                                        <td> '.$row['date'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
                                                        <td class="text-center">
                                                            <a href="edit_customer.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                            // <a class="left delete-row"  href="action_customer.php?delete&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
