<?php
require_once "_config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php 
            
            $title = ' فاکتور فروش   ';
            require_once("_head.php");
            ?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "sell_factor"; $sub = "add_sell_factor";?>
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
 
                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="action_sell_factor.php">  
                                        <br>

                                        <input type="hidden" name="insert"  value="1">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="code_number"> بل نمبر <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="text" id="code_number" name="code_number"  readonly="readonly" value="<?php echo code_number_facor('sell'); ?>" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name">مشتری<span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8 ">
                                                <select class="form-control basic-single" dir="rtl" required="required" name="customer_id" id="customer_id" >
                                                    <option value="">  مشتری انتخاب نماید </option> 
                                                    <?php
                                                        $customers = $db->query("SELECT * FROM `customers` WHERE `deleted` = '0' AND `type` = 'buyer' ORDER BY id DESC");
                                                        foreach ($customers as $key => $row) {
                                                            echo '<option value="'.$row['id'].'"> '.$row['fullname'].' - '.$row['company_name'].' </option> ';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name">فاکتور فروش</label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-8" style="overflow-x: auto;">
                                           <table class="table" style="border:1px solid #009688;">
                                                <thead>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">  نام دارو</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> موقعیت</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> تعداد موجود</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">تعداد</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">فی دانه </th>    
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">مبلغ</th>    
                                                </thead >
                                                <thead id="thead-add-data" > 
                                                <tr class="cfont" >

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;  width: 190px;">
                                                        <select class="form-control basic-single" id="durg_ides_1" name="durg_ides[]" >
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

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 190px;">
                                                       <select class="form-control basic-single" id="positiones_1" onchange="calculate_drug_in_stock(positiones_1.value,durg_ides_1.value,1)" name="positiones[]" >
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

                                                    <td class="zero-padding" style="padding-bottom:12px !important;border-top:unset !important;padding-top:5px !important;padding-right:7px !important;font-size: 22px;">
                                                       <span id="drug_amount_1" class="label label-pill label-danger-outline">0</span>
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                       <input type="number" step="any" required name="amount_items[]" class="form-control cmdesign" id="amount_items" placeholder="تعداد ">
                                                    </td>

                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                        <input type="number" step="any" id="unit_price" value="0" name="unit_price[]" onkeyup="calculate_total_price(amount_items.value, unit_price.value);calculate_price();calculate_remain_price(payment_amount.value, total_amount.value)" class="form-control cmdesign" placeholder="تعداد ">
                                                    </td>
                                                    
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 120px;">
                                                       <input type="number" step="any" value="0" name="proice_amount[]" id="proice_amount" class="form-control cmdesign proice_amount " placeholder="مبلغ ">
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
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="total_amount">  جمع کل   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" step="any" id="total_amount" readonly="" name="total_amount" value="0" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="payment_amount">  مقدار پرداخت   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" step="any" id="payment_amount" value="0" name="payment_amount" onkeyup="calculate_remain_price(payment_amount.value, total_amount.value)" required="required" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="remain">  الباقی   <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="number" step="any" id="remain" name="remain" value="0" required="required" readonly="" class="form-control cfont"  placeholder="0"  >
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-12 col-xs-12 col-lg-2" for="date"> تاریخ  <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-8">
                                                <input type="text" id="date" name="date" required="required" class="form-control p-date"  placeholder="تاریخ">
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
                                                <button type="submit" class="btn btn-primary" name="insert"><i class="fa fa-clone"> </i> ثبت و جدید</button>
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
                            <select class="form-control basic-single" id ="durg_ides_${count}" name="durg_ides[]">
                                <option value=''>انتخاب</option>
                                    ${'<?php echo $druges ?>'}
                            </select>
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 190px;">
                            <select class="form-control basic-single" id ="positiones_${count}" onchange="calculate_drug_in_stock(positiones_${count}.value,durg_ides_${count}.value,${count})" name="positiones[]" >
                            <option value="">  انتخاب نماید  </option>
                                '<?php echo $stocks_data  ?>'
                            </select>
                        </td>

                        <td class="zero-padding" style="padding-bottom:12px !important;border-top:unset !important;padding-top:5px !important;padding-right:7px !important;font-size: 22px;">
                            <span class="label label-pill label-danger-outline" id = "drug_amount_${count}">0</span>
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                            <input step="any" type="number" value="0" id = "amount_items_${count}"  name="amount_items[]" class="form-control cmdesign" placeholder="تعداد ">
                        </td>

                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                            <input step="any" type="number" value="0" onkeyup="calculate_total_prices(amount_items_${count}.value, unit_price_${count}.value,${count});calculate_price();calculate_remain_price(payment_amount.value, total_amount.value)" id = "unit_price_${count}" name="unit_price[]" class="form-control cmdesign" placeholder="تعداد ">
                        </td>
                        
                        <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 120px;">
                            <input step="any" type="number" value="0" id = "proice_amounts_${count}" name="proice_amount[]" class="form-control cmdesign proice_amount " placeholder="مبلغ ">
                        </td>
                    </tr>
                `;
                count++;
                $('#thead-add-data').append(str);
                $(".basic-single").select2();
                //   $("#remover_btn_"+count).hide('slow');
            }
        

            function calculate_price(){
                var total_amount = 0;
                $(".proice_amount").each(function(){
                    total_amount += ( $(this).val() * 1 );
                });
                $("#total_amount").val(total_amount);
            }

            function calculate_remain_price (total_amount , payment_amount ){
                var remain = 0;
                var remain = payment_amount - total_amount;
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


           function calculate_drug_in_stock(positiones , durg_ides,count){

             $.ajax({
                url: "ajax.php",
                method: "POST" ,
                data: {
                       positiones  :positiones,
                       durg_ides   :durg_ides,
                       type        :"calculate_drugs_in_stocks"},
                success:function(data){
                    // $('#drug_amount_1').html(data);
                    $(`#drug_amount_${count}`).html(data);
                }
            });
        }

            
        </script>
    </body>
</html>