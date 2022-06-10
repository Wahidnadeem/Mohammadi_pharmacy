<?php
require_once '_config.php';
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

    <title>پرینت فاکتور  خرید</title>
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


        <?php 
        
        
        if( isset( $_POST['chackbox_select'] ) &&  count($_POST['chackbox_select']) > 0 ){
            
            foreach($_POST['chackbox_select'] as $key => $row  ){


                $id = base64_decode($row);
                
                $buy_sell_drug_row = $db->query("SELECT * FROM `buy_sell_drug` WHERE `id` = '$id' AND `deleted` = '0' LIMIT 1")->fetch();

                $customer_id = $buy_sell_drug_row['customer_id'];
                $customer_name = $db->query("SELECT * FROM `customers` WHERE `id` = '$customer_id' AND `deleted` = '0' LIMIT 1")->fetch();

                $buy_sell_assets = $db->query("SELECT * FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$id' AND `deleted` = '0' ");
               

        
        ?>



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
                        <input type="text" disabled="" value="<?php echo $buy_sell_drug_row['code_number'];?>" class="form-control myborder text-center">
                    </div>
                </div>
            </div>    
        </div>

        <div class="row mt-3 p-2">
            <div class="col-12 myborder p-3 ps-1 pe-1">
                <span class="">صورت حساب</span><span class="">:</span><span class="text-muted ms-3"></span><span class=""></span><span class="pb-1 text-muted">&nbsp;<?php echo $customer_name['fullname'];?></span><span class="pb-1 text-muted">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted ms-3">تاریخ</span><span class="">:</span><span class="pb-1" style="font-size: 18px; font-weight: bold;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $buy_sell_drug_row['date'];?></span>
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
                $total_price = 0;
                foreach ($buy_sell_assets as $key => $row) {
                    
                    echo '
                    <div class="row ps-2 pe-2">
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                        <div class="col-3 myborder text-center p-1 ps-1 pe-1 text-muted"> '. get_column_value('drug',$row['drug_id'],'scientific_name').'</div>
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"> '.$row['amount'].' </div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted">'.$row['unit_price'].'</div>
                        <div class="col-5 myborder text-center p-1 ps-1 pe-1 text-muted">'.$row['price'].'</div>
                    </div>';     
                    
                    $total_price += $row['price'];
                }


                while ($count <= 10) {
                    echo '
                    <div class="row ps-2 pe-2">
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                        <div class="col-3 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-5 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                    </div>';
                }

            
                echo '
                <div class="row mt-1 p-2">
                    <div class="col-7 myborder p-2 ps-1 pe-1">جمع کل به حروف :  </div>
                    <div class="col-5 myborder p-2 ps-1 pe-1">&nbsp;&nbsp;به عدد : <span style = "font-size:24px;"> &nbsp;&nbsp;&nbsp;&nbsp; '.$total_price.'  '.'افغانی'.'</span> </div>
                </div>
                ';


            }else {
                $count = 1;
                for ($i=0; $i < 10 ; $i++) { 
                    echo '
                        <div class="row ps-2 pe-2">
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                            <div class="col-3 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-5 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        </div>';
                }

                echo '
                <div class="row mt-1 p-2">
                    <div class="col-7 myborder p-2 ps-1 pe-1">جمع کل به حروف :  </div>
                    <div class="col-5 myborder p-2 ps-1 pe-1">&nbsp;&nbsp;به عدد : <span style = "font-size:24px;"> &nbsp;&nbsp;&nbsp;&nbsp; '.$total_price.'  '.'افغانی'.'</span> </div>
                </div>
                ';

            }
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
 
<?php } }else {
        echo "<h1 > لطفا یکی از گذینه ها را انتخاب نمید   </h1>"; 
        echo '<a href="list_buy_factor.php" style="font-size: 36px; " >  برای بازگشت کلید نماید. </a>';
    }
    
    ?>
</body>

</html>