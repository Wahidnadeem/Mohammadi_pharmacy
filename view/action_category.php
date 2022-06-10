<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    // Validition category name
    $name = $_POST['name'];
    $query = $db->query("SELECT * FROM `categories` WHERE `name` = '$name' AND `deleted` = '0'");
    if($query->rowCount()>0){
        header("location:add_category.php?Duplicate");
        exit();
    }
    
    $data = [
        'name'          => VD($_POST['name']),
        'date'          => VD($_POST['date']),
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $insert = insert('categories',$data);

    if($insert){
        header("location: add_category.php?saved");
        exit();
    }else{
        header("location: add_category.php?error");
        exit();
    }

}

// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);

    $is_exist_category_in_drug = $db->query("SELECT `category_id` FROM `drug` WHERE `category_id` = '$id' LIMIT 1");
    if ($is_exist_category_in_drug->rowCount() > 0) {
        header("location:list_category.php?HaveSubCategory");
        exit();
    }

    $deleted = edit('categories',['deleted' => 1],$id);


    if ($deleted) {
        header("location: list_category.php?deleted");
        exit();
    }else{
        header("location: list_category .php?error");
        exit();
    }
}




//edit query
if (isset($_POST['edit'])) {

    $id       = base64_decode($_POST['id']);
    $current_date = VD($_POST['current_date']);  

    // Validition category name
    $name = $_POST['name'];
    $query = $db->query("SELECT * FROM `categories` WHERE `name` = '$name' AND `deleted` = '0' AND `id` != '$id'");
    if($query->rowCount()>0){
        header("location:list_category.php?Duplicate");
        exit();
    }  
    
    if (!empty($_POST['date'])) {
        $current_date  = VD($_POST['date']);
    }

    $edit_data = [
        'name'          => VD($_POST['name']),
        'date'          => $current_date,
        'note'          => VD($_POST['note']),
        'user_id'       => $user_id,
    ];

    $query = edit('categories',$edit_data,$id);

    if ($query) {
        header("location: list_category.php?update");
        exit();
    }else{
        header("location: list_category.php?error");
        exit();
    }
}
?>
