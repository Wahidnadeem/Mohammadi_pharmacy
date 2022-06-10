<?php

    require_once "_config.php";

    $condition = '';

  if(isset($_POST['search'])){


    if(!empty($_POST['category_id'])){
        $category_id = VD($_POST['category_id']);
        $condition  .= " AND category_id = '$category_id' ";
    }

     if(!empty($_POST['drug_code'])){
        $drug_code = VD($_POST['drug_code']);
        $condition  .= " AND drug_code = '$drug_code' ";
    }

    if(!empty($_POST['scientific_name'])){
        $scientific_name = VD($_POST['scientific_name']);
        $condition  .= " AND scientific_name LIKE '%$scientific_name%' ";
    }

      if(!empty($_POST['company_name'])){
        $company_name = VD($_POST['company_name']);
        $condition  .= " AND company_name LIKE '%$company_name%' ";
    }

    if(!empty($_POST['start_date']) && !empty($_POST['end_date']) ){
        $start_date = VD($_POST['start_date']);
        $end_date   = VD($_POST['end_date']);

        $condition .= " AND `date` BETWEEN  '$start_date' AND '$end_date' ";
    }

  }

  $view_data = $db->prepare("SELECT * FROM `drug` WHERE deleted = :deleted  $condition ORDER BY scientific_name ASC LIMIT $to OFFSET $from");
  $view_data->execute(['deleted' => 0]);

  $list_data  = $db->query("SELECT count(id) as record FROM drug WHERE deleted = 0 $condition ")->fetch();
  $record     = $list_data['record'];

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            $title = "لیست  دوا  ها";
            require_once("_head.php");
            ?>
    </head>
    <body class="body" style="scrollbar-width: thin;">

        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "drug"; $sub = "list_drug";?>
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
                                                    <label class="control-label " for="category_id">  کتگوری   </label>
                                                    <div >
                                                        <select class="form-control basic-single" width="100%" dir="rtl" name="category_id" id="category_id">
                                                            <option value=""> کتگوری انتخاب نماید  </option>
                                                            <?php
                                                                $category = select_all('categories','','desc');
                                                                foreach ($category as $key => $row) {
                                                                    echo '<option value="'.$row['id'].'"> '.$row['name'].'  </option>';
                                                                }
                                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="drug_code">  کد دوا  </label>
                                                    <div >
                                                        <input type="text" id="drug_code" name="drug_code" class="form-control cfont" placeholder="مثلا : 1202">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="scientific_name">  نام علمی</label>
                                                    <div >
                                                        <input type="text" id="scientific_name" name="scientific_name" class="form-control cfont"  placeholder="مثلا : پاراستامول"  >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="item form-group">
                                                    <label class="control-label " for="company_name">  نام  تجارتی</label>
                                                    <div >
                                                        <input type="text" id="company_name" name="company_name" class="form-control cfont"  placeholder="مثلا : پارل"  >
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
                                                <div class="form-group" style="margin-top:1rem">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-clone"> </i> جستجو</button>
                                                    <a  href="list_drug.php"  class="btn btn-danger"><i class="fa fa-clone"> </i> تازه سازی</a>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>

                    <a href="excel_drug.php?condition=<?php echo $condition;?>" class="btnc btnc-primary btnc-icon-anim pointer" style="text-decoration: none; bottom: 12px;" target="_blank" >
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
                                        <th> نام  کتگوری</th>
                                        <th class="text-center">کد دوا</th>
                                        <th>نام  علمی</th>
                                        <th>نام تجارتی</th>
                                        <th>تفصیلات</th>
                                        <th>تاریخ</th>
                                        <th>کاربر</th>
                                        <th class="text-center">تغییرات</th>
                                    </thead>
                                    <tbody>

                                    <?php

                                        if($view_data->rowCount() ){

                                            foreach ($view_data as $key => $row) {
                                                echo '
                                                    <tr>
                                                        <td class="text-center">'.$count++.' </td>
                                                        <td> '. get_column_value('categories',$row['category_id'],'name').' </td>
                                                        <td class ="text-center"> <p  class ="cfont drug-code"> '.$row['drug_code'].' </p> </td>
                                                        <td> '.$row['scientific_name'].' </td>
                                                        <td> '.$row['company_name'].' </td>
                                                        <td> '.$row['note'].' </td>
                                                        <td> '.$row['date'].' </td>
                                                        <td> '.get_user_name($row['user_id']).' </td>
                                                        <td class="text-center">
                                                            <a href="edit_drug.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                                            <a class="left delete-row" href="action_drug.php?delete&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
