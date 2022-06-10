<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $customer_id = VD($_POST['customer_id']);
    $amount      = (empty(VD($_POST['amount']))) ? 0 : VD($_POST['amount']);
    $type        = VD($_POST['type']);

    $select_customer_amount = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' ");
    if($select_customer_amount->rowCount() > 0){
        $select_customer_row = $select_customer_amount->fetch();
        $current_amount = $select_customer_row['amount'] * 1;
        if($type == "debt"){
            $edit = edit('customer_transaction',['amount' => ($current_amount + $amount) ],$select_customer_row['id']);
        }else if ($type == "credit"){
            $edit = edit('customer_transaction',['amount' => ($current_amount - $amount)],$select_customer_row['id']);
        }
    }else {

        if($type == "debt"){
            $customer_data = [
                'customer_id'       => VD($_POST['customer_id']),
                'amount'            => (VD($_POST['amount']) * 1 ),
            ];
            $customer_transaction_insert = insert('customer_transaction',$customer_data);
        }else if ($type == "credit"){
            $customer_data = [
                'customer_id'       => VD($_POST['customer_id']),
                'amount'            => (VD($_POST['amount']) * -    1 ),
            ];
            $customer_transaction_insert = insert('customer_transaction',$customer_data);
        }
    }


    $data = [
        'type'          => VD($_POST['type']),
        'customer_id'   => VD($_POST['customer_id']),
        'amount'        => VD($_POST['amount']),
        'date'          => VD(clean_data($_POST['date'])),
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $insert = insert('transaction',$data);

    if($insert){
        header("location: add_transaction.php?saved");
        exit();
    }else{
        header("location: add_transaction.php?error");
        exit();
    }

}




// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);

    $select_transaction = $db->query("SELECT * FROM `transaction` WHERE `id` = '$id' AND `deleted` = '0' LIMIT 1")->fetch();
    $customer_id = $select_transaction['customer_id'];
    $amount      = $select_transaction['amount'];
    $type        = $select_transaction['type'];

    if ($type == "debt") {

        $select_customer_transaction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' LIMIT 1")->fetch();
        $customer_transaction_amount = $select_customer_transaction['amount'];
        $total_amount = $customer_transaction_amount - $amount;

        $update_customers_transaction = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount' WHERE `customer_id` = '$customer_id'  LIMIT 1");

    }elseif($type =="credit"){

        $select_customer_transaction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' LIMIT 1")->fetch();
        $customer_transaction_amount = $select_customer_transaction['amount'];
        $total_amount = $customer_transaction_amount + $amount;

        $update_customers_transaction = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount' WHERE `customer_id` = '$customer_id' LIMIT 1");

    }

    $deleted = edit('transaction',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_transaction.php?deleted");
        exit();
    }else{
        header("location: list_transaction .php?error");
        exit();
    }
}




//edit query
if (isset($_POST['edit'])) {

    $id             = base64_decode($_POST['id']);


    $select_transaction_data = $db->query("SELECT * FROM `transaction` WHERE `id` = '$id' AND `deleted` = '0' LIMIT 1")->fetch();
    $customer_id = $select_transaction_data['customer_id'];
    $amount      = $select_transaction_data['amount'];
    $transaction_type        = $select_transaction_data['type'];

    if ($transaction_type == "debt") {

        $select_customer_transaction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' LIMIT 1")->fetch();
        $customer_transaction_amount = $select_customer_transaction['amount'];
        $total_amount = $customer_transaction_amount - $amount;

        $update_customers_transaction = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount' WHERE `customer_id` = '$customer_id'  LIMIT 1");

    }elseif($transaction_type =="credit"){

        $select_customer_transaction = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' LIMIT 1")->fetch();
        $customer_transaction_amount = $select_customer_transaction['amount'];
        $total_amount = $customer_transaction_amount + $amount;

        $update_customers_transaction = $db->query("UPDATE `customer_transaction` SET `amount` = '$total_amount' WHERE `customer_id` = '$customer_id' LIMIT 1");
    }



    $customer_id    = VD($_POST['customer_id']);
    $type           = VD($_POST['type']);
    $amount         = (empty(VD($_POST['amount']))) ? 0 : VD($_POST['amount']) ;


    $select_customer_amount = $db->query("SELECT * FROM `customer_transaction` WHERE `customer_id` = '$customer_id' ");
    if($select_customer_amount->rowCount() > 0){
        $select_customer_row = $select_customer_amount->fetch();
        $current_amount = $select_customer_row['amount'] * 1;
        if($type == "debt"){
            $edit = edit('customer_transaction',['amount' => ($current_amount + $amount) ],$select_customer_row['id']);
        }else if ($type == "credit"){
            $edit = edit('customer_transaction',['amount' => ($current_amount - $amount)],$select_customer_row['id']);
        }
    }else {

        if($type == "debt"){
            $customer_data = [
                'customer_id'       => VD($_POST['customer_id']),
                'amount'            => (VD($_POST['amount']) * 1 ),
            ];
            $customer_transaction_insert = insert('customer_transaction',$customer_data);
        }else if ($type == "credit"){
            $customer_data = [
                'customer_id'       => VD($_POST['customer_id']),
                'amount'            => (VD($_POST['amount']) * -    1 ),
            ];
            $customer_transaction_insert = insert('customer_transaction',$customer_data);
        }
    }
     

    $current_date = VD($_POST['current_date']);  
    if (!empty($_POST['date'])) {
        $current_date  = VD($_POST['date']);
    }

    $edit_data = [
        'type'          => VD($_POST['type']),
        'customer_id'   => VD($_POST['customer_id']),
        'amount'        => VD($_POST['amount']),
        'date'          => $current_date,
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $query = edit('transaction',$edit_data,$id);

    if ($query) {
        header("location: list_transaction.php?update");
        exit();
    }else{
        header("location: list_transaction.php?error");
        exit();
    }
}
?>
