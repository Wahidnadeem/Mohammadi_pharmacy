<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $transfer_data = [

        'from_stock' => VD($_POST['from_stock']),
        'to_stock'   => VD($_POST['to_stock']),
        'drug_id'    => VD($_POST['drug_id']),
        'amount'     => VD($_POST['amount']),
        'date'       => VD($_POST['date']),
        'note'       => VD($_POST['note']),
        'user_id'    => $user_id
    ];

    $insert = insert('transfer_drugs',$transfer_data);

    $from_stock = $_POST['from_stock'];
    $to_stock   = $_POST['to_stock'];
    $amount     = $_POST['amount'];
    $drug_id    = $_POST['drug_id'];

    $is_exest_drug_row = $db->query("SELECT * FROM `drugs_amount` WHERE `stock_id` = '$from_stock' AND `drug_id` = '$drug_id' LIMIT 1"); 
    if ($is_exest_drug_row->rowCount() > 0) {

        $from_stock_row     = $is_exest_drug_row->fetch();
        $remain_amount_from = $from_stock_row['amount'] - $amount; 
        $update_from_stock = $db->query("UPDATE `drugs_amount` SET `amount` = '$remain_amount_from' WHERE `stock_id` = '$from_stock' AND `drug_id` = '$drug_id'");

        $is_exest_to_stock_row = $db->query("SELECT * FROM `drugs_amount` WHERE `stock_id` = '$to_stock' AND `drug_id` = '$drug_id' LIMIT 1");
            if ($is_exest_to_stock_row->rowCount() > 0) {

                    $to_stock_row = $is_exest_to_stock_row->fetch();
                    $remain_amount_total = $amount + $to_stock_row['amount'];
                    $update_to_stock = $db->query("UPDATE `drugs_amount` SET `amount` = '$remain_amount_total' WHERE `stock_id` = '$to_stock' AND `drug_id` = '$drug_id'");

                    if ($update_to_stock) {
                            header("location:transfer_drug.php?saved");
                            exit();
                        }    
                    }

            else{
                    $data = [

                        'stock_id'  => VD($to_stock),
                        'amount'    => VD($amount),
                        'drug_id'   => VD($drug_id)
                    ];

                    $insert = insert('drugs_amount',$data);

                    if($insert){
                        header("location: transfer_drug.php?saved");
                        exit();
                    }else{
                        header("location: transfer_drug.php?error");
                        exit();
                    }

                }
    }else{

     $data = [

        'stock_id'  => VD($to_stock),
        'amount'    => VD($amount),
        'drug_id'   => VD($drug_id)
    ];

    $insert = insert('drugs_amount',$data);

    if($insert){
        header("location: transfer_drug.php?saved");
        exit();
    }else{
        header("location: transfer_drug.php?error");
        exit();
    }
}
}



// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);

    $stock_row = $db->query("SELECT * FROM `transfer_drugs` WHERE `id` = '$id' LIMIT 1")->fetch();

    $amount_stock_row   = $stock_row['amount'];
    $from_stock         = $stock_row['from_stock'];
    $to_stock           = $stock_row['to_stock'];
    $drug_id            = $stock_row['drug_id'];

    $transfer_drugs_to_row = $db->query("SELECT * FROM `drugs_amount` WHERE `drug_id` = '$drug_id' AND `stock_id` = '$to_stock' LIMIT 1")->fetch();
    $amount_transfer_drugs = $transfer_drugs_to_row['amount'];
    $final_amount_to_stock = $amount_transfer_drugs - $amount_stock_row;
    $update_transfer_drugs = $db->query("UPDATE `drugs_amount` SET `amount` = '$final_amount_to_stock' WHERE `stock_id` = '$to_stock' AND `drug_id` = '$drug_id'");


    $transfer_drugs_from_row = $db->query("SELECT * FROM `drugs_amount` WHERE `drug_id` = '$drug_id' AND `stock_id` = '$from_stock' LIMIT 1")->fetch();
    $amount_transfer_drugs_from = $transfer_drugs_from_row['amount'];
    $final_amount_from_stock = $amount_transfer_drugs_from + $amount_stock_row;
    $update_transfer_drugs = $db->query("UPDATE `drugs_amount` SET `amount` = '$final_amount_from_stock' WHERE `stock_id` = '$from_stock' AND `drug_id` = '$drug_id'");
    
   $deleted = edit('transfer_drugs',['deleted' => 1],$id);


    if ($deleted) {
        header("location: list_transfer_drug.php?deleted");
        exit();
    }else{
        header("location: list_transfer_drug .php?error");
        exit();
    }
}



//edit query
if (isset($_POST['edit'])) {

    $id             = base64_decode($_POST['id']);
    
    $transfer_drugs_row = $db->query("SELECT * FROM `transfer_drugs` WHERE `deleted` = '0' AND id = '$id' LIMIT 1 ")->fetch();


    $from_stock = $transfer_drugs_row['from_stock'];
    $to_stock   = $transfer_drugs_row['to_stock'];
    $drug_id    = $transfer_drugs_row['drug_id'];
    $amount     = $transfer_drugs_row['amount'];


    $stock_from_drug_amount = $db->query(" SELECT amount,id FROM drugs_amount WHERE stock_id = $from_stock and drug_id = $drug_id LIMIT 1  ");
    if($stock_from_drug_amount->rowCount() > 0 ){
        $stock_from_drug_amount_row = $stock_from_drug_amount->fetch();
        $edit = edit('drugs_amount',['amount' > $stock_from_drug_amount_row['amount'] + $amount ],$id);
    }

    $stock_to_drug_amount = $db->query(" SELECT amount,id FROM drugs_amount WHERE stock_id = $to_stock and drug_id = $drug_id LIMIT 1  ");
    if($stock_to_drug_amount->rowCount() > 0 ){
        $stock_to_drug_amount_row = $stock_to_drug_amount->fetch();
        $edit = edit('drugs_amount',['amount' > $stock_to_drug_amount_row['amount'] - $amount ],$id);
    }


    $from_stock = VD($_POST['from_stock']);
    $to_stock   = VD($_POST['to_stock']);
    $drug_id    = VD($_POST['drug_id']);
    $amount     = VD($_POST['amount']);
    $note       = VD($_POST['note']);
    $current_date   = VD($_POST['current_date']);
    if (!empty($_POST['date'])) {
        $current_date  = VD($_POST['date']);
    }



    $stock_from_drug_amount = $db->query(" SELECT amount,id FROM drugs_amount WHERE stock_id = $from_stock and drug_id = $drug_id LIMIT 1  ");
    if($stock_from_drug_amount->rowCount() > 0 ){
        $stock_from_drug_amount_row = $stock_from_drug_amount->fetch();
        $edit = edit('drugs_amount',['amount' > $stock_from_drug_amount_row['amount'] - $amount ],$id);
    }else {
        
        $data = [
            'drug_id'   => $drug_id,
            'stock_id'  => $from_stock,
            'amount'    => -$amount
        ];

        $insert = insert('drugs_amount',$data);
    }

    $stock_to_drug_amount = $db->query(" SELECT amount,id FROM drugs_amount WHERE stock_id = $to_stock and drug_id = $drug_id LIMIT 1  ");

    if($stock_to_drug_amount->rowCount() > 0 ){
        $stock_to_drug_amount_row = $stock_to_drug_amount->fetch();
        $edit = edit('drugs_amount',['amount' > $stock_to_drug_amount_row['amount'] + $amount ],$id);
    }else {
        $data = [
            'drug_id'   => $drug_id,
            'stock_id'  => $to_stock,
            'amount'    => $amount
        ];
        $insert = insert('drugs_amount',$data);
    }


    $edit_data = [
        'from_stock'      => VD($_POST['from_stock']),
        'to_stock'        => VD($_POST['to_stock']),
        'drug_id'         => VD($_POST['drug_id']),
        'amount'          => VD($_POST['amount']),
        'date'            => $current_date,
        'note'            => VD($_POST['note']),
        'user_id'         => $user_id,
    ];

    $query = edit('transfer_drugs',$edit_data,$id);

    if ($query) {
        header("location: list_transfer_drug.php?update");
        exit();
    }else{
        header("location: list_transfer_drug.php?error");
        exit();
    }
}

?>