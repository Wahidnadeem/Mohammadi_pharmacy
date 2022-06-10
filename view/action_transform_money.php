<?php


require_once ("_config.php");

if(isset($_POST['insert'])){
    
    $data = [
        'number'          => VD($_POST['number']),
        'sender_customer' => VD($_POST['sender_customer']),
        'money_type'      => VD($_POST['money_type']),
        'cost'            => VD($_POST['cost']),
        'send_date'       => VD($_POST['send_date']),
        'user_id'         => $user_id,
    ];

    $insert = insert('transform_money',$data);

    if($insert){
        header("location: add_transform_money.php?saved");
        exit();
    }else{
        header("location: add_transform_money.php?error");
        exit();
    }

}


// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);
    
   $deleted = edit('transform_money',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_transform_money.php?deleted");
        exit();
    }else{
        header("location: list_transform_money .php?error");
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
        'number'            => VD($_POST['number']),
        'sender_customer'   => VD($_POST['sender_customer']),
        'cost'              => VD($_POST['cost']),
        'money_type'        => VD($_POST['money_type']),
        'send_date'         => $current_date,
        'note'              => VD($_POST['note']),
        'user_id'           => $user_id,
    ];

    $query = edit('transform_money',$edit_data,$id);

    if ($query) {
        header("location: list_transform_money.php?update");
        exit();
    }else{
        header("location: list_transform_money.php?error");
        exit();
    }
}









?>