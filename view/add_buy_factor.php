<?php

require_once "_config.php";

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            
            $title = ' فاکتور خرید  ';
            require_once("_head.php");
            ?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "buy_factor"; $sub = "add_buy_factor";?>
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
                    <?php require_once "alert.php" ?>
          
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                            <div class="panel panel-default lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i> <?= $title?> </h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">
 
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_buy_factor.php">  
                                        <br>

                                        <input type="hidden" name="insert"  value="1">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="code_number"> بل نمبر <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="text" id="code_number" readonly="readonly" value="<?php echo code_number_facor('buy'); ?>" name="code_number" required="required" class="form-control cfont"  placeholder="مثلا: حساب بار نامه ها "  >
                                            </div>
                                        </div>

                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="customer_id"> فروشنده دوا  <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8 ">
                                                <select class="form-control basic-single" dir="rtl" required name="customer_id" id="customer_id" >
                                                    <option value="">  مشتری انتخاب نماید </option> 
                                                    <?php
                                                        $customers = $db->query("SELECT * FROM `customers` WHERE `deleted` = '0' AND `type` = 'seller' ORDER BY id DESC ");
                                                        foreach ($customers as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['fullname'].'  '.$row['company_name'].' </option> ';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name">فاکتور خرید</label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8" style="overflow-x: auto;">
                                           <table class="table" style="border:1px solid #009688;">
                                                <thead>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">  نام دارو</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">تعداد</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> فی دانه  </th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">مبلغ</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> موقعیت</th>
                                                    <th colspan="2" style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> تاریخ انقضا</th>             
                                                </thead >
                                                <thead id="thead-add-data" > 
                                                <tr class="cfont" >

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;  width: 190px;">
                                                        <select class="form-control basic-single" name="drug_ides[]" >
                                                            <option value="">انتخاب</option>
                                                            <?php
                                                                $durg = select_all('drug','','desc');
                                                                $druges = '';
                                                                foreach ($durg as $key => $row) {
                                                                    $druges .= '<option value="'.$row['id'].'" > '.$row['scientific_name'].' - '.$row['drug_code'].' </option>';
                                                                }

                                                                echo $druges;
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                       <input type="number" step="any" required name="amount_items[]" id="amount_items" value="0" class="form-control cmdesign" placeholder="تعداد ">
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                       <input type="number" step="any" required name="unit_price[]" id="unit_price"  onkeyup="calculate_total_price(amount_items.value, unit_price.value);calculate_price();calculate_remain_price(payment_amount.value, total_amount.value)" value="0" class="form-control cmdesign" placeholder="فی دانه ">
                                                    </td>
                                                    
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 120px;">
                                                       <input type="number" name="proice_amount[]" id="proice_amount" value="0" step="any" class="form-control cmdesign proice_amount " placeholder="مبلغ ">
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 190px;">
                                                       <select class="form-control basic-single " name="positiones[]" >
                                                            <option value="">  انتخاب نماید  </option>
                                                            <?php
                                                                $stocks = select_all('stock','','DESC');
                                                                $stocks_data = '';
                                                                foreach ($stocks as $key => $row) {
                                                                    $stocks_data .= '<option value="'.$row['id'].'"> '.$row['name'].' </option>';
                                                                }
                                                                echo $stocks_data;
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 150px;">
                                                       <input type="text" name="expire_dates[]" autocomplete="off" class="form-control cmdesign p-date2" placeholder="تاریخ انقضا">
                                                    </td>

                                                </tr>
                                            
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="6" class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                                <a class="left" onclick="add();">
                                                                    <button type="button" class="btnc btnc-primary btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-plus"></i></button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tfoot>

                                                </table>   
                                            </div>
                                        </div>
                                        

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="total_price">  جمع کل   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" id="total_price" step="any" readonly="" name="total_price" value="0" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="payment_amount">  مقدار پرداخت   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" onkeyup="calculate_remain_price(payment_amount.value, total_price.value)" step="any" id="payment_amount" value="0" name="payment_amount" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="remain">  الباقی   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" id="remain" readonly="" step="any" name="remain" value="0" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-12 col-xs-12 col-lg-2" for="date"> تاریخ  <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="text" id="date" name="date" required="required" autocomplete="off" class="form-control p-date"  placeholder="تاریخ">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-12 col-xs-12 col-lg-2" for="note">تفصیلات<span class=""></span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <textarea id="note" name="note" class="form-control" rows="5" style="width:100%;height:20%;overflow-x:auto;" placeholder="لازمی نیست"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-8 col-lg-offset-2">
                                                <button type="submit" class="btn btn-primary" name="send_save"><i class="fa fa-clone"> </i> ثبت و جدید</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"> </i> لغو یا پاک کردن</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>                                
                                <div class="panel-footer">&nbsp;</div>
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

        <script type="text/javascript">
             var count = 2;
            function add(){
                var str  = `
                    <tr class="cfont" >
                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;  width: 190px;">
                            <select class="form-control basic-single" name="drug_ides[]">
                                <option value=''>انتخاب</option>
                                    ${'<?php echo $druges ?>'}
                            </select>
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                            <input type="number" value="0" step="any" name="amount_items[]" id = "amount_items_${count}" class="form-control cmdesign" placeholder="تعداد ">
                        </td>
                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                            <input type="number" value="0" step="any" required name="unit_price[]" onkeyup="calculate_total_prices(amount_items_${count}.value, unit_price_${count}.value,${count});calculate_price();calculate_remain_price(payment_amount.value, total_amount.value)" id = "unit_price_${count}" class="form-control cmdesign" placeholder="فی دانه ">
                        </td>
                        
                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 120px;">
                            <input type="number" value="0" step="any" name="proice_amount[]" id="proice_amounts_${count}" class="form-control cmdesign proice_amount " placeholder="مبلغ ">
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 190px;">
                            <select class="form-control basic-single " name="positiones[]" >
                            <option value="">  انتخاب نماید  </option>
                                '<?php echo $stocks_data  ?>'
                            </select>
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 150px;">
                            <input type="text" name="expire_dates[]" autocomplete="off" class="form-control cmdesign p-date2" placeholder="تاریخ انقضا">
                        </td>

                    </tr>
                `;
                 count++;
                $('#thead-add-data').append(str);
                $(".basic-single").select2();
                $('.p-date2').pDatepicker({
                    format: 'YYYY-MM-DD',
                    calendarType: 'gregorian',
                });
                
                //   $("#remover_btn_"+count).hide('slow');
            }


            function calculate_price(){
                var total_price = 0;
                $(".proice_amount").each(function(){
                    total_price += ( $(this).val() * 1 );
                });
                $("#total_price").val(total_price);
                $("#remain").val(total_price);
            }

            function calculate_remain_price (total_price , payment_amount ){
                var remain = 0;
                var remain = payment_amount - total_price;
                   $('#remain').val(remain);

            }

             function calculate_total_price(amount_items , unit_price){
                var total_price = amount_items * unit_price;
                $('#proice_amount').val(total_price);

            }

            function calculate_total_prices(amount_items , unit_price , count){
                var total_prices = amount_items * unit_price;
                $(`#proice_amounts_${count}`).val(total_prices);
            }


            
        </script>
    </body>
</html>