<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $data = [
        'name'          => VD($_POST['name']),
        'date'          => (VD($_POST['date'])),
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $insert = insert('stock',$data);

    if($insert){
        header("location: add_stock.php?saved");
        exit();
    }else{
        header("location: add_stock.php?error");
        exit();
    }


}

// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);

    $is_exist_category_in_drug = $db->query("SELECT `id` FROM `stock_drug_amount` WHERE `stock_id` = '$id' LIMIT 1");
    if ($is_exist_category_in_drug->rowCount() > 0) {
        header("location:list_stock.php?HaveSubCategory");
        exit();
    }
    
   $deleted = edit('stock',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_stock.php?deleted");
        exit();
    }else{
        header("location: list_stock .php?error");
        exit();
    }
}



//edit query
if (isset($_POST['edit'])) {

    $id       = base64_decode($_POST['id']);
    $current_date = VD($_POST['current_date']);    
    
    if (!empty($_POST['date'])) {
        $current_date  = VD($_POST['date']);
    }

    $edit_data = [
        'name'       => VD($_POST['name']),
        'date'       => $current_date,
        'note'       => VD($_POST['note']),
        'user_id'    => $user_id,
    ];

    $query = edit('stock',$edit_data,$id);

    if ($query) {
        header("location: list_stock.php?update");
        exit();
    }else{
        header("location: list_stock.php?error");
        exit();
    }
}




?>