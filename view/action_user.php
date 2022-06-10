<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $data = [
        'full_name'     => VD($_POST['full_name']),
        'father_name'   => VD($_POST['father_name']),
        'phone'         => VD($_POST['phone']),
        'username'      => VD($_POST['username']),
        'password'      => VD($_POST['password']),
        'username'      => VD($_POST['username']),
        'date'          => (VD($_POST['date'])),
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $insert = insert('users',$data);

    if($insert){
        header("location: add_user.php?saved");
        exit();
    }else{
        header("location: add_user.php?error");
        exit();
    }


}

// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);
    

    if($user_id == $id){
        header("location:list_user.php?users");
        exit();
    }

   $deleted = edit('users',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_user.php?deleted");
        exit();
    }else{
        header("location: list_user .php?error");
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
            'full_name'     => VD($_POST['full_name']),
            'father_name'   => VD($_POST['father_name']),
            'phone'         => VD($_POST['phone']),
            'username'      => VD($_POST['username']),
            'password'      => VD($_POST['password']),
            'username'      => VD($_POST['username']),
            'date'          => $current_date,
            'note'          => VD($_POST['note']),
            'user_id'       => $user_id,
    ];

    $query = edit('users',$edit_data,$id);

    if ($query) {
        header("location: list_user.php?update");
        exit();
    }else{
        header("location: list_user.php?error");
        exit();
    }
}

?>