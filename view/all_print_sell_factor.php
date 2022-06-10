<?php

require_once '_config.php';

 

    if( isset( $_POST['chackbox_select'] ) &&  count($_POST['chackbox_select']) > 0 ){
            
            $output = [];

            foreach($_POST['chackbox_select'] as $key => $row  ){

                $temp = [];

                $temp['id'] = base64_decode($row);
                $id = $temp['id'];

                 $buy_sell_customer = $db->query("SELECT * FROM `buy_sell_drug` WHERE `id` = '$id' AND `deleted` = '0' AND `type` = 'sell' LIMIT 1")->fetch();

                $customer_id = $buy_sell_customer['customer_id'];
                $customer_name = $db->query("SELECT * FROM `customers` WHERE `id` = '$customer_id' AND `deleted` = '0' LIMIT 1")->fetch();

                $buy_sell_assets = $db->query("SELECT * FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$id' AND `deleted` = '0' AND `type` = 'sell'");
               
                array_push($output , $temp);


?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">

    <title>پرینت فاکتور های فروش</title>
</head>

<body>
    <style>
        @font-face {
        font-family: lalezar;
        src: url('../assets/font/Lalezar-Regular.ttf');
        font-weight: bold;
        }
        body {
            font-family: lalezar;
        }

        .myborder {
            border: 3px solid #555 !important;
            border-radius: 0.5rem !important;
        }

        @media (min-width: 1400px) {
            .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
                max-width: 1111px !important;
            }
        }
       
    </style>

    <div class="container">
        <div class="row pt-4">
            <div class="col-md-12 text-center h3 ">
                <h1>عمده فروشی  ادویه عبدالکریم محمدی و برادران</h1>
                <h3>شماره های تماس : 0700869810 - 0797869810</h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-5">
                <div class="row">
                    <div class="col-6 pt-2">
                        <label class="h5 " for="">تماس مشتری</label>
                    </div>
                    <div class="col-6">
                        <input type="text" disabled="" value="<?php echo $customer_name['phone'];?>" class="form-control myborder text-center">
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-5">
                <div class="row">
                    <div class="col-4 pt-2">
                        <label class="h5 " for="">کد نمبر</label>
                    </div>
                    <div class="col-8">
                        <input type="text" disabled="" value="<?php echo $buy_sell_customer['code_number'];?>" class="form-control myborder text-center">
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row mt-3 p-2">
            <div class="col-12 myborder p-3 ps-1 pe-1">
                <span class="">صورت حساب</span><span class="">:</span><span class="text-muted ms-3"></span><span class=""></span><span class="pb-1 text-muted">&nbsp;<?php echo $customer_name['fullname'];?></span><span class="pb-1 text-muted">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted ms-3">تاریخ</span><span class="">:</span><span class="pb-1" style="font-size: 18px; font-weight: bold;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $buy_sell_customer['date'];?></span>
            </div>
        </div>

        <div class="row mt-1 p-2">
            <div class="col-1 myborder text-center p-1 ps-1 pe-1">شماره
            </div>
            <div class="col-3 myborder text-center p-1 ps-1 pe-1">نوع جنس
            </div>
            <div class="col-1 myborder text-center p-1 ps-1 pe-1">تعداد
            </div>
            <div class="col-2 myborder text-center p-1 ps-1 pe-1">فی واحد
            </div>
            <div class="col-5 myborder text-center p-1 ps-1 pe-1">جمع کل
            </div>
        </div>
         <?php
                if($buy_sell_assets->rowCount() > 0 ){

                    $count = 1;
                    foreach ($buy_sell_assets as $key => $row) {

                        $buy_sell_id = $row['buy_sell_drug_id'];
                        $sum_price_factor = $db->query("SELECT SUM(price) AS total_price_factor FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$buy_sell_id' AND deleted = 0 AND `type` = 'sell'")->fetch();
                        $total_price_factor = $sum_price_factor['total_price_factor'];

                        $drug_id = $row['drug_id'];
                        $drug_name = $db->query("SELECT * FROM `drug` WHERE `id` = '$drug_id' AND deleted = 0 LIMIT 1")->fetch();

                        $amount = $row['amount'];
                        $price = $row['price'];

                        $total_price = ($price / $amount);

                        $mode =  fmod($total_price,2);

                     

                        if($mode == 1) {
                            $final =  $total_price;
                        }else{
                            $final =  number_format($total_price, 1);
                        }

                        echo '

                         <div class="row ps-2 pe-2">
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                            <div class="col-3 myborder text-center p-1 ps-1 pe-1 text-muted"> '. get_column_value('categories',$drug_name['category_id'],'name').'  '. get_column_value('drug',$row['drug_id'],'scientific_name').'</div>
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted">'.$row['amount'].'</div>
                            <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted">'.$final.'</div>
                            <div class="col-5 myborder text-center p-1 ps-1 pe-1 text-muted">'.$price.'</div>
                        </div>
                            
                        ';
                    }

                }

                $buy_sell_id = $row['buy_sell_drug_id'];
                $sum_price_factor = $db->query("SELECT COUNT(id) AS factor_id FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$buy_sell_id' AND deleted = 0 AND `type` = 'sell'")->fetch();
                $factor_id = $sum_price_factor['factor_id'];

                $fix = 11;
                $print_row = $fix - $factor_id;

                for ($x = 0; $x < $print_row ; $x++) {

                     echo '

                        <div class="row ps-2 pe-2">
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                            <div class="col-3 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-5 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        </div>
                ';                    
                }

                echo '

                     

                         <div class="row mt-1 p-2">
                            <div class="col-7 myborder p-2 ps-1 pe-1">جمع کل به حروف :  </div>
                            <div class="col-5 myborder p-2 ps-1 pe-1">&nbsp;&nbsp;به عدد : <span style = "font-size:24px;"> &nbsp;&nbsp;&nbsp;&nbsp; '.$total_price_factor.'  '.'افغانی'.'</span> </div>
                        </div>

                ';
                    ?>       
    </div>
    <div class="container">

        <div class="row pt-4 mb-4">
            <div class="col-md-12 text-center h3 ">
                <h3>آدرس :  افغانستان هرات ، جاده عیدگاه ، مارکت قادر هروی ، منزل دوم دوکان نمبر 5</h3>
            </div>
        </div>
        <span>بدون مهر و  امضا اعتبار ندارد</span>
        <br>
        <br>
        <br>
    </div>
<?php }

}else{
        echo ' <h1 >! لطفا یک فاکتور خرید را انتخاب کنید</h1> ';
        exit();
}
?>

</body>

</html>