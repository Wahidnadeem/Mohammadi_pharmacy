<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $remain      = VD($_POST['remain']);
    $customer_id = VD($_POST['customer_id']);


    $data = [
        'code_number'       => VD($_POST['code_number']),
        'type'              => VD($_POST['type']),
        'customer_id'       => VD($_POST['customer_id']),
        'payment_amount'    => VD($_POST['payment_amount']),
        'remain'            => VD($_POST['remain']),
        'date'              => VD($_POST['date']),
        'note'              => VD($_POST['note']),
        'user_id'           => $user_id,
    ];

    $customer_transction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' LIMIT 1");
    if ($customer_transction->rowCount() > 0) {
        $customer_transction_data = $customer_transction->fetch();
        $customer_transction_data_amount = $customer_transction_data['amount'];
        $total_amount_customer = $customer_transction_data_amount - $remain;

        $update_customer_amount = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount_customer' WHERE `customer_id` = '$customer_id'"); 

    }else{

        $customer_data = [
        'customer_id'       => VD($_POST['customer_id']),
        'amount'            => (VD($_POST['remain']) * -1 ),
        'user_id'           => $user_id,
        // 'type'              => 'sell',
    ];
        $customer_transaction_insert = insert('customer_transaction',$customer_data);
    }


    $insert = insert('buy_sell_drug',$data);

    $last_id = $db->lastInsertId();

    

    foreach ($_POST['durg_ides'] as $key => $value) {

        $durg_id            = VD($_POST['durg_ides'][$key]);
        $amount_items       = VD($_POST['amount_items'][$key]);
        $proice_amount      = VD($_POST['proice_amount'][$key]);
        $stock_id           = VD($_POST['positiones'][$key]);

        $data  = [
            'buy_sell_drug_id'      => $last_id,
            'drug_id'               => $durg_id,
            'amount'                => $amount_items,
            'price'                 => $proice_amount,
            'stock_id'              => $stock_id,
            'user_id'               => $user_id,
            'type'                  => ($_POST['type']),
        ];

        $insert = insert('buy_sell_assets',$data);

        $is_exit = $db->query("SELECT * FROM `drugs_amount` WHERE stock_id = '$stock_id' and drug_id = '$durg_id' LIMIT 1 ");
        if($is_exit->rowCount() > 0 ){

            $is_exit_row    = $is_exit->fetch();
            $current_amount = $is_exit_row['amount'];
            $insert = edit('drugs_amount',['amount' => $current_amount - $amount_items ],$is_exit_row['id']);

        }else {
            $data = [
                'drug_id'   => $durg_id,
                'stock_id'  => $stock_id,
                'amount'    => $amount_items,
            ];
            $insert = insert('drugs_amount',$data);
        }
    }


    if($insert){
        header("location: add_sell_factor.php?saved");
        exit();
    }else{
        header("location: add_sell_factor.php?error");
        exit();
    }


}


// delete query buy_sell_drug
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);

    $buy_sell_data = $db->query("SELECT * FROM `buy_sell_drug` WHERE `id` = '$id' limit 1")->fetch();
    $buy_sell_amounts = $buy_sell_data['remain'];
    $customer_iddd    = $buy_sell_data['customer_id'];

    $customers_data = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_iddd' AND `type` = 'credite' limit 1")->fetch();
    $customer_amounts = $customers_data['amount'];

    $totlas_amount = $customer_amounts - $buy_sell_amounts;
    
    $update_customer_transcation = $db->query("UPDATE `customer_transaction` SET `amount` = '$totlas_amount' WHERE `customer_id` = '$customer_iddd' AND `type` = 'credite'"); 



    $buy_sell_assets_data = $db->query("SELECT * FROM `buy_sell_assets` WHERE buy_sell_drug_id = '$id' AND deleted = 0 ");

    foreach ($buy_sell_assets_data as $key => $row) {

        $drug_id    = $row['drug_id'];
        $stock_id   = $row['stock_id'];
        $drug_amount     = $row['amount'];

        $drugs_amount_data = $db->query("SELECT  amount , id  FROM `drugs_amount` WHERE drug_id = '$drug_id' AND stock_id = '$stock_id' limit 1   ");
        if($drugs_amount_data->rowCount() > 0 ){
        
            $drugs_amount_row = $drugs_amount_data->fetch();

            $stock_amount  = $drugs_amount_row['amount'];
            $current_amount = $stock_amount + $drug_amount;
            $edit = edit('drugs_amount',['amount' => $current_amount] , $drugs_amount_row['id']);
        }

    }


    $update = $db->query("UPDATE buy_sell_assets SET deleted = 0 WHERE buy_sell_drug_id = '$id' ");
    
    
   $deleted = edit('buy_sell_drug',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_sell_factor.php?deleted");
        exit();
    }else{
        header("location: list_sell_factor.php?error");
        exit();
    }
}


// delete query
if (isset($_GET['id']) AND isset($_GET['sell_factor_assets'])){

    $id    = base64_decode($_GET['id']);

    $select_buy_sell_assets_row = $db->query("SELECT * FROM `buy_sell_assets` WHERE `id` = '$id' AND `deleted` = '0' AND `type` = 'sell'");
            if ($select_buy_sell_assets_row->rowCount() > 0) {
                 $buy_sell_assets_data    = $select_buy_sell_assets_row->fetch();
                 $amount_buy_sell_assets  = $buy_sell_assets_data['amount'];
                 $drug_id                 = $buy_sell_assets_data['drug_id'];
                 $stock_id                = $buy_sell_assets_data['stock_id'];

                 $select_drugs_amount_row = $db->query("SELECT * FROM `drugs_amount` WHERE `drug_id` = '$drug_id' AND `stock_id` = '$stock_id'")->fetch();
                 $drugs_amount_row = $select_drugs_amount_row['amount'];

                 $amount_result = $drugs_amount_row + $amount_buy_sell_assets;

                 $update_drugs_amount = $db->query("UPDATE `drugs_amount` SET `amount` = '$amount_result' WHERE `stock_id` = '$stock_id' AND `drug_id` = '$drug_id'");
         } 
    
   $deleted = edit('buy_sell_assets',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_sell_factor.php?deleted");
        exit();
    }else{
        header("location: list_sell_factor .php?error");
        exit();
    }
}



//edit query
if (isset($_POST['edit'])) {

    $id             = base64_decode($_POST['id']);
    $type_amount    = VD($_POST['type_amount']);
    $remain         = VD($_POST['remain']);
    $customer_id    = VD($_POST['customer_id']);
    $current_date   = VD($_POST['current_date']);

    if (!empty($_POST['date'])) {
        $current_date  = VD($_POST['date']);
    }

    $select_row_buy_sell = $db->query("SELECT * FROM `buy_sell_drug` WHERE `id` = '$id' AND `deleted` = '0' AND `type` = 'sell' LIMIT 1")->fetch();
    $buy_sell_amount =  $select_row_buy_sell['remain'];
    $buy_sell_customer_id = $select_row_buy_sell['customer_id']; 


    $customer_transction_old = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$buy_sell_customer_id' AND `type` = 'credite' LIMIT 1")->fetch();
    $amount_customer_transcation = $customer_transction_old['amount'];
    $customer_transaction_id = $customer_transction_old['customer_id'];

    $customer_transction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' AND `type` = 'credite' LIMIT 1");
    


if ($customer_transction->rowCount() >0) {

    $new_customer_transction = $customer_transction->fetch();
    $new_amount_customer_transcation = $new_customer_transction['amount'];
    $new_customer_transaction_id = $new_customer_transction['customer_id'];

     if ($customer_id == $customer_transaction_id) {

        $total_amount_cutomer_transcation = ($amount_customer_transcation - $buy_sell_amount )+ $remain;
        $update_customer_transcation = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount_cutomer_transcation' WHERE `customer_id` = '$customer_id' AND `type` = '$type_amount'");
        }else{

            $old_amount = $amount_customer_transcation - $buy_sell_amount;
            $old_update_customer_transcation = $db->query("UPDATE `customer_transaction` SET `amount` = '$old_amount' WHERE `customer_id` = '$customer_transaction_id' AND `type` = '$type_amount'");

            $new_amount = $new_amount_customer_transcation + $remain;
            $new_update_customer_transcation = $db->query("UPDATE `customer_transaction` SET `amount` = '$new_amount' WHERE `customer_id` = '$customer_id' AND `type` = '$type_amount'");
        }
    }
        else{

            $amount_not_exsit = $amount_customer_transcation - $buy_sell_amount;
            $new_update_customer_transcation = $db->query("UPDATE `customer_transaction` SET `amount` = '$amount_not_exsit' WHERE `customer_id` = '$customer_transaction_id' AND `type` = '$type_amount'");

             $customer_data = [
                    'type'              => VD($_POST['type_amount']),
                    'customer_id'       => VD($_POST['customer_id']),
                    'amount'            => VD($_POST['remain']),
                    'user_id'           => $user_id,
                ];
                    $customer_transaction_insert = insert('customer_transaction',$customer_data);
                }

    $edit_data = [
        'code_number'       => VD($_POST['code_number']),
        'customer_id'       => VD($_POST['customer_id']),
        'payment_amount'    => VD($_POST['payment_amount']),
        'remain'            => VD($_POST['remain']),
        'date'              => $current_date,
        'note'              => VD($_POST['note']),
        'user_id'           => $user_id,
    ];

    $query = edit('buy_sell_drug',$edit_data,$id);

    if ($query) {
        header("location: list_sell_factor.php?update");
        exit();
    }else{
        header("location: list_sell_factor.php?error");
        exit();
    }
}


//edit query
if (isset($_POST['edit_assets'])) {

    $id       = base64_decode($_POST['id']);
    $amount   = base64_decode($_POST['amount']);
    $stock_id = base64_decode($_POST['stock_id']);
    $drug_id  = base64_decode($_POST['drug_id']);
    $current_date = VD($_POST['current_date']);    
    
    if (!empty($_POST['expire_date'])) {
        $current_date  = VD($_POST['expire_date']);
    }

        $select_buy_sell_assets_row = $db->query("SELECT * FROM `buy_sell_assets` WHERE `id` = '$id' AND `deleted` = '0' AND `type` = 'sell' LIMIT 1");
            if ($select_buy_sell_assets_row->rowCount() > 0) {
                 $buy_sell_assets_data    = $select_buy_sell_assets_row->fetch();
                 $amount_buy_sell_assets  = $buy_sell_assets_data['amount'];
                 $drug_idd                = $buy_sell_assets_data['drug_id'];
                 $stock_idd               = $buy_sell_assets_data['stock_id'];
                 $select_drugs_amount_row = $db->query("SELECT * FROM `drugs_amount` WHERE `drug_id` = '$drug_idd' AND `stock_id` = '$stock_idd' LIMIT 1")->fetch();
                 $drugs_amount_row = $select_drugs_amount_row['amount'];
                 $amount_result = $drugs_amount_row + $amount_buy_sell_assets;
                 $update_drugs_amount = $db->query("UPDATE `drugs_amount` SET `amount` = '$amount_result' WHERE `stock_id` = '$stock_idd' AND `drug_id` = '$drug_idd'");


                 $select_drug_amount_update = $db->query("SELECT * FROM `drugs_amount` WHERE `stock_id` = $stock_id AND `durg_id` = '$durg_id' LIMIT 1")->fetch();
                 $amount_assets = $select_drug_amount_update['amount'] - $amount;

                 $update_assets = $db->query("UPDATE `drugs_amount` SET `amount` = '$amount_assets' , `stock_id` = '$stock_id' , `durg_id` = $drug_id");
         } 



    $edit_data = [
        'drug_id'     => VD($_POST['drug_id']),
        'amount'      => VD($_POST['amount']),
        'price'       => VD($_POST['price']),
        'stock_id'    => VD($_POST['stock_id']),
        'expire_date' => $current_date,
        'user_id'     => $user_id,
    ];

    $query = edit('buy_sell_assets',$edit_data,$id);

    if ($query) {
        header("location: list_sell_factor.php?update");
        exit();
    }else{
        header("location: list_sell_factor.php?error");
        exit();
    }
}

?>