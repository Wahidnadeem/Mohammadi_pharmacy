<?php

    require_once "_config.php";
    
    $condition = '';

  if(isset($_POST['search'])){
    
    
    if(!empty($_POST['type'])){
        $type = VD($_POST['type']);
        $condition  .= " AND type = '$type' ";
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

  $view_data = $db->prepare("SELECT * FROM `transaction` WHERE deleted = :deleted  $condition ORDER BY id DESC LIMIT $to OFFSET $from");
  $view_data->execute(['deleted' => 0]);

  $list_data  = $db->query("SELECT count(id) as record FROM transaction WHERE deleted = 0 $condition ")->fetch();
  $record     = $list_data['record'];

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست   رسید و برد اشخاص / دفاتر";
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
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i>  جستجو دوا </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
                                    <br>
                                    <form id="validation-form" class="form-inline form-label-left" method="post" action="">

                                        <input type="hidden" name="search" value="1">

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="type">  کتگوری   </label>
                                                    <div >
                                                        <select class="form-control basic-single" dir="rtl" name="type" id="type">
                                                            <option value=""> نوعیت انتخاب نماید  </option>
                                                            <option value="debt"> برد  </option>
                                                            <option value="credit"> رسید  </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="customer_id">  شخص / دفتر   </label>
                                                    <div >
                                                        <select class="form-control basic-single" dir="rtl" name="customer_id" id="customer_id">
                                                            <option value=""> شخص یا دفتر انتخاب نماید  </option>
                                                            <?php
                                                            $castomer = select_all('customers','','desc');
                                                            foreach ($castomer as $key => $row) {
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
                                                    <div >
                                                        <input type="text" id="start_date" name="start_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="end_date"> تاریخ الی  </label>
                                                    <div >
                                                        <input type="text" id="end_date" name="end_date" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label" > &nbsp; </label>
                                                    <div>
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                        <a  href="list_transaction.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
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

                    <a href="excel_list_transaction.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
                        <i class="fa fa-print"></i>&nbsp;
                        <span class="ladda-label bfont">خروجی گرفتن از اطلاعات  جدول</span>&nbsp;
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
                                        <th class="text-center">شماره</th>
                                        <th> نام  شخص / دفتر</th>
                                        <th>نوعیت</th>
                                        <th>مقدار پول</th>
                                        <th>تفصیلات</th>
                                        <th>تاریخ</th>
                                        <th>کاربر</th>
                                        <th class="text-center">تغییرات</th>
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
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td> '. get_column_value('customers',$row['customer_id'],'fullname').' </td>
                                                       '.$type_status.'
                                                        <td> '.$row['amount'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.$row['date'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
                                                        <td class="text-center">
                                                            <a href="edit_transaction.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                                            <a class="left delete-row" href="action_transaction.php?delete&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
