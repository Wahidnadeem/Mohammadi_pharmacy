<?php

require_once '_config.php';

    if(!isset($_GET['id'])){
        header("location: list_buy_factor.php?error");
        exit();
    }

    $id = base64_decode($_GET['id']);

    $buy_sell_customer = $db->query("SELECT * FROM `buy_sell_drug` WHERE `id` = '$id'  ")->fetch();

    $customer_id    = $buy_sell_customer['customer_id'];
    $customer_name  = $db->query("SELECT * FROM `customers` WHERE `id` = '$customer_id' AND `deleted` = '0' LIMIT 1")->fetch();

    $buy_sell_assets = $db->query("SELECT * FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$id' AND `deleted` = '0' ");
    $number_print = [];
    $total_price = 0;
    $notting = '';

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

// - '.$DAYS_WEEK[date( 'D', strtotime(jalali_to_gregorian_date($buy_sell_customer['date'],'-')))].'
            $str_head = '
            <div class="container">

            <div class="row pt-12">
                <div class="col-md-12 text-center h3 ">
                    <h1>شرکت عمران ویت فارما  </h1>
                    <h3>شماره های تماس : 0797005951 - 0786892043 - 0705756704</h3>
                </div>
            </div>

            <div class="row mt-1">

                <div class="col-6">
                    <div class="row">
                        <div class="col-6 pt-2">
                            <label class="h5 " for="">شماره تماس مشتری</label>
                        </div>
                        <div class="col-6">
                            <input type="text" disabled="" value="'.$customer_name['phone'].'" class="form-control myborder text-center">
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-4 pt-2">
                            <label class="h5 " for="">بل نمبر فاکتور</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled="" value="'.$buy_sell_customer['code_number'].'" class="form-control myborder text-center">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2 p-2">
                <div class="col-12 myborder p-3 ps-1 pe-1">
                    <span class="">صورت حساب</span><span class="">:</span><span class="text-muted ms-3"></span><span class=""></span><span class="pb-1 text-muted">&nbsp;'.$customer_name['fullname'].'</span><span class="pb-1 text-muted">&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted ms-3">تاریخ</span><span class="">:</span><span class="pb-1" style="font-size: 18px; font-weight: bold;" dir ="rtl"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$buy_sell_customer['date'].'   </span>
                </div>
            </div>

            <div class="row mt-1 p-2">
                <div class="col-1 myborder text-center p-1 ps-1 pe-1">شماره
                </div>
                <div class="col-6 myborder text-center p-1 ps-1 pe-1">نوع جنس
                </div>
                <div class="col-1 myborder text-center p-1 ps-1 pe-1">تعداد
                </div>
                <div class="col-2 myborder text-center p-1 ps-1 pe-1">فی واحد
                </div>
                <div class="col-2 myborder text-center p-1 ps-1 pe-1">جمع کل
                </div>
            </div>
            ';

        ?>


        <?php

            if($buy_sell_assets->rowCount() > 0 ){

                $count = 1;
                foreach ($buy_sell_assets as $key => $row) {

                    $temp = '
                    <div class="row ps-2 pe-2">
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count).'</div>
                        <div class="col-6 myborder text-center p-1 ps-1 pe-1 text-muted"> '. get_column_value('categories',get_column_value('drug',$row['drug_id'],'category_id'),'name') .' - '. get_column_value('drug',$row['drug_id'],'scientific_name').'</div>
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"> '.number_format($row['amount'],0).' </div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted">'.number_format($row['unit_price'],1).'</div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted">'.number_format($row['price'],0).'</div>
                    </div>';

                    $array_index = (floor($count / 13));

                    if(isset($number_print[$array_index]) || ($count % 13) == 0 ){
                        if( ($count % 13) == 0 ){
                            $array_index  -= 1;
                        }

                        $number_print[$array_index] .= $temp;
                    }else {
                        $number_print[$array_index] = $temp;
                    }

                    $total_price += $row['price'];

                    $count++;
                }


                while ($count <= 13) {
                    $temp = '
                    <div class="row ps-2 pe-2">
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                        <div class="col-6 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                    </div>';

                    $number_print[0] .= $temp;
                }
                $footer_factor  =  '
                <div class="row mt-1 p-2">
                    <div class="col-7 myborder p-2 ps-1 pe-1">جمع کل به حروف :  </div>
                    <div class="col-5 myborder p-2 ps-1 pe-1">&nbsp;&nbsp;به عدد : <span style = "font-size:24px;"> &nbsp;&nbsp;&nbsp;&nbsp; '.$total_price.'  '.'افغانی'.'</span> </div>
                </div>
                ';


            }else {

                $count = 1;
                for ($i=0; $i < 13 ; $i++) {
                    $notting ='
                        <div class="row ps-2 pe-2">
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1">'.($count++).'</div>
                            <div class="col-6 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-1 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                            <div class="col-2 myborder text-center p-1 ps-1 pe-1 text-muted"></div>
                        </div>';
                }

                $notting .='
                <div class="row mt-1 p-2">
                    <div class="col-7 myborder p-2 ps-1 pe-1">جمع کل به حروف :  </div>
                    <div class="col-5 myborder p-2 ps-1 pe-1">&nbsp;&nbsp;به عدد : <span style = "font-size:24px;"> &nbsp;&nbsp;&nbsp;&nbsp;0  '.'افغانی'.'</span> </div>
                </div>
                ';

            }

        ?>
    </div>

    <?php

        $address = '
    <span>بدون مهر و  امضا اعتبار ندارد</span>

    <div class="row pt-3 mb-3">
        <div class="col-md-12 text-end h3 ">
            <h5 class="text-center">آدرس :  افغانستان هرات ،شهر نو، جاده عیدگاه، مارکت غزنوی، شرکت عمران ویت فارما</h5>
        </div>
    </div>
        ';

    ?>



        <?php


            foreach ($number_print as $key => $value) {
                echo $str_head.$value.$notting.$footer_factor.$address;
            }

        ?>
    </body>
</html>
<span class="text-right" style="font-size:13px;"> راه های ارتباطی با سازنده سیستم دیتابیس: <i class="fa-fa-whatsapp">0794284644 , 0798238001</i></span>
