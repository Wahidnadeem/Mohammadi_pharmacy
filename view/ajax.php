<?php
    require_once ("_config.php");
    $type = VD(trim($_POST['type'])); 

     // =========================  Check Double customer =============================== 

    if ($type == "customer_dublicate") {

        $fullname           = $_POST['fullname'];
        $type_customer      = $_POST['type_customer'];
        $is_exsit_customer  = $db->query("SELECT * FROM `customers` WHERE `fullname` = '$fullname' AND `type` = '$type_customer' AND `deleted` = '0' LIMIT 1");
       
        if($is_exsit_customer->rowCount() > 0 ){
            echo "true";
            exit();
        }else{
            echo "false";
            exit();
        }
    }

     // =========================  Check Double Category Name ===============================

    else  if ( $type == "category_dublicate" ) {

        $name           = $_POST['name'];
        $category_name  = $db->query("SELECT name FROM `categories` WHERE `name` = '$name' AND deleted = '0' LIMIT 1");
       
        if($category_name->rowCount() > 0 ){
            echo "true";
            exit();
        }else{
            echo "false";
            exit();
        }

      
    }

     // =========================  Check Double Stock Name ===============================
     else  if ( $type == "stock_dublicate" ) {

        $name        = $_POST['name'];
        $stock_name  = $db->query("SELECT name FROM `stock` WHERE `name` = '$name' AND deleted = '0' LIMIT 1");
       
        if($stock_name->rowCount() > 0 ){
            echo "true";
            exit();
        }else{
            echo "false";
            exit();
        }

      
    }

     // =========================  Check Double Drug Name ===============================
     else  if ( $type == "drug_dublicate" ) {

        $scientific_name  = $_POST['scientific_name'];
        $drug_name        = $db->query("SELECT scientific_name FROM `drug` WHERE `scientific_name` = '$scientific_name' AND deleted = '0' LIMIT 1");
       
        if($drug_name->rowCount() > 0 ){
            echo "true";
            exit();
        }else{
            echo "false";
            exit();
        }

      
    }

     // =========================  Check Double Drug Name ===============================
     else  if ( $type == "calculate_drugs_in_stocks" ) {
        
        $positiones       = $_POST['positiones'];
        $durg_ides        = $_POST['durg_ides'];
        
        $amount_exsit_drug_in_stock       = $db->query("SELECT * FROM `stock_drug_amount` WHERE `stock_id` = '$positiones' AND `drug_id` = '$durg_ides' LIMIT 1");

        if($amount_exsit_drug_in_stock->rowCount() > 0 ){
            $drugs_amount = $amount_exsit_drug_in_stock->fetch();
            echo $drugs_amount['amount'] + 0;
            exit();
        }
    }

     // =========================  Show table Buy Factor of Drug ===============================
     else  if ( $type == "showBuyFactorDetails" ) {

        $id        = $_POST['id'];
        $buy_sell_assets_data = $db->query("SELECT * FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$id' AND `deleted` = '0' ");

        if($buy_sell_assets_data->rowCount() > 0 ){
            
            $count = 1;
            foreach ($buy_sell_assets_data as $key => $row) {

                echo '
                    <tr>
                        <td class="text-center">'.$count++.' </td>
                        <td class="text-right"> '. get_column_value('drug',$row['drug_id'],'scientific_name').' </td>
                        <td class="text-right"> '.number_format($row['amount'],0).' </td>
                        <td class="text-right"> '.number_format($row['unit_price'],1).' </td>
                        <td class="text-right"> '.number_format($row['price'],0).' </td>
                        <td class="text-right"> '. get_column_value('stock',$row['stock_id'],'name').' </td>
                        <td class="text-right"> '.$row['expire_date'].' </td>
                        <td class="text-right"> '.get_user_name($row['user_id']).' </td>
                        <td class="text-center">
                            <a href="edit_buy_factor_assets.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                            <a class="left delete-row"  href="action_buy_factor.php?deleted_drug&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
    }


     // =========================  Show table Sell Factor of Drug ===============================
     else  if ( $type == "SellFactorCodeNumber" ) {

        $id        = $_POST['id'];
        $factor_code_number = $db->query("SELECT * FROM `buy_sell_assets` WHERE `buy_sell_drug_id` = '$id' AND `deleted` = '0'");

        if($factor_code_number->rowCount() > 0 ){
            
            $count = 1;
            foreach ($factor_code_number as $key => $row) {

                echo '
                    <tr>
                        <td class="text-center">'.$count++.' </td>
                        <td class="text-right"> '. get_column_value('drug',$row['drug_id'],'scientific_name').' </td>
                        <td class="text-right"> '.number_format($row['amount'],0).' </td>
                        <td class="text-right"> '.number_format($row['unit_price'],1).' </td> 
                        <td class="text-right"> '.number_format($row['price'],0).' </td> 
                        <td class="text-right"> '. get_column_value('stock',$row['stock_id'],'name').' </td>
                        <td class="text-right"> '.get_user_name($row['user_id']).' </td>
                        <td class="text-center">
                            <a href="edit_sell_factor_assets.php?id='.base64_encode($row['id']).'" class="left"><button class="btnc btnc-success btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                            <a class="left delete-row"  href="action_sell_factor.php?deleted_sell_factor&id='.base64_encode($row['id']).'"><button class="btnc btnc-danger btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
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
    }


?>