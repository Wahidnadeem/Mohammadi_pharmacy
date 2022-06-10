<?php
require_once "_config.php";

  $condition = '';

  if(isset($_POST['search'])){

    if(!empty($_POST['number'])){
        $number = VD($_POST['number']);
        $condition  .= " AND number = '$number' ";
    }

    if(!empty($_POST['sender_customer'])){
        $sender_customer = VD($_POST['sender_customer']);
        $condition  .= " AND type = '$sender_customer' ";
    }

    if(!empty($_POST['money_type'])){
        $money_type = VD($_POST['money_type']);
        $condition  .= " AND money_type = '$money_type' ";
    }

    if(!empty($_POST['send_date'])){
        $send_date = VD($_POST['send_date']);
        $condition  .= " AND send_date = '$send_date' ";
    }

    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
        $start_date = VD($_POST['start_date']);
        $end_date   = VD($_POST['end_date']);

        $condition .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
    }
  }

  $view_data = $db->prepare("SELECT * FROM `transform_money` WHERE deleted = :deleted  $condition ORDER BY sender_customer ASC LIMIT $to OFFSET $from");
  $view_data->execute(['deleted' => 0]);

  $list_data  = $db->query("SELECT count(id) as record FROM transform_money WHERE deleted = 0 $condition ")->fetch();
  $record     = $list_data['record'];


    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست حواله جات";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "transform_money"; $sub = "list_transform_money";?>
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
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  جستجو حواله جات </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">

                                    <form id="validation-form" class="form-inline form-label-left" method="post" action="">

                                        <input type="hidden" name="search" value="1">


                                        <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="sender_customer">  نام کامل  </label>
                                                    <div class="">
                                                        <input type="text" id="sender_customer" name="sender_customer" class="form-control cfont" placeholder="مثلا : احمد احمدی">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="number">  نمبر حواله   </label>
                                                    <div class="">
                                                        <input type="text" id="number" name="number" class="form-control cfont"  placeholder="مثلا : 2022"  >
                                                    </div>
                                                </div>
                                            </div>

                                      
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="money_type"> نوعیت پول </label>
                                                    <div class="">
                                                        <select class="form-control basic-single" dir="rtl" name="money_type" id="money_type">
                                                            <option value="">  نوعیت پول را انتخاب نماید </option> 
                                                            <option value="afn"> افغانی </option> 
                                                            <option value="dollar">  دالر </option> 
                                                            <option value="irr">  تومان </option> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label" for="send_date">  تاریخ اجرا احواله   </label>
                                                    <div class="">
                                                        <input type="text" id="send_date" name="send_date" class="form-control cfont"  placeholder="مثلا : ۱۴۰۱-۰۳-۱۲"  >
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

                     <a id="btnhb" href="excel_list_transform_money.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none;bottom: 12px;left: -1px;top: -50px;z-index: unset;background-color: #2879ff;" target="_blank" >
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
                                        <th> نام کامل  </th>
                                        <th>شماره حواله</th>
                                        <th>نوعیت پول</th>
                                        <th>مقدار </th>
                                        <th>تاریخ اجرای حواله</th>
                                        <th>تفصیلات</th>
                                        <th>کاربر</th>
                                        <th class="text-center">تغییرات</th>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {

                                                 if ($row['money_type'] == "afn") {
                                                   $type_status = '<td class = "recive_money">افغانی</td>';
                                             }elseif($row['money_type'] == "dollar"){
                                                   $type_status = '<td class = "recive_money">دالر</td>';
                                             }elseif($row['money_type'] == "irr"){
                                                   $type_status = '<td class = "recive_money">تومان</td>';
                                             }

                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td> '.$row['sender_customer'].' </td>
                                                        <td> '.$row['number'].' </td>
                                                         '.$type_status.'
                                                        <td> '.$row['cost'].' </td>
                                                        <td> '.$row['send_date'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
                                                        <td class="text-center">
                                                            <a href="edit_transform_money.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                                             <a class="left delete-row"  href="action_transform_money.php?delete&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
