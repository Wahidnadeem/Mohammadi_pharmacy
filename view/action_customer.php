<?php


require_once ("_config.php");

if(isset($_POST['insert'])){
    
    $data = [
        'type'          => VD($_POST['type']),
        'fullname'      => VD($_POST['fullname']),
        'company_name'  => VD($_POST['company_name']),
        'phone'         => VD($_POST['phone']),
        'address'       => VD($_POST['address']),
        'date'          => VD($_POST['date']),
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $insert = insert('customers',$data);

    if($insert){
        header("location: add_customer.php?saved");
        exit();
    }else{
        header("location: add_customer.php?error");
        exit();
    }

}


// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);
    
   $deleted = edit('customers',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_customer.php?deleted");
        exit();
    }else{
        header("location: list_customer .php?error");
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
        'fullname'      => VD($_POST['fullname']),
        'company_name'  => VD($_POST['company_name']),
        'phone'         => VD($_POST['phone']),
        'address'       => VD($_POST['address']),
        'date'          => $current_date,
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $query = edit('customers',$edit_data,$id);

    if ($query) {
        header("location: list_customer.php?update");
        exit();
    }else{
        header("location: list_customer.php?error");
        exit();
    }
}









?>