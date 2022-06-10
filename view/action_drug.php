<?php

require_once ("_config.php");

if(isset($_POST['insert'])){

    $data = [
        'category_id'           => VD($_POST['category_id']),
        'drug_code'             => VD($_POST['drug_code']),
        'scientific_name'       => VD($_POST['scientific_name']),
        'company_name'          => VD($_POST['company_name']),
        'date'                  => VD($_POST['date']),
        'note'                  => VD($_POST['note']),
        'user_id'               => $user_id,
    ];

    $insert = insert('drug',$data);

    if($insert){
        header("location: add_drug.php?saved");
        exit();
    }else{
        header("location: add_drug.php?error");
        exit();
    }


}

// delete query
if (isset($_GET['id']) AND isset($_GET['delete'])){

    $id    = base64_decode($_GET['id']);
    
   $deleted = edit('drug',['deleted' => 1],$id);

    if ($deleted) {
        header("location: list_drug.php?deleted");
        exit();
    }else{
        header("location: list_drug .php?error");
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
        'category_id'           => VD($_POST['category_id']),
        'drug_code'             => VD($_POST['drug_code']),
        'scientific_name'       => VD($_POST['scientific_name']),
        'company_name'          => VD($_POST['company_name']),
        'date'                  => $current_date,
        'note'                  => VD($_POST['note']),
        'user_id'               => $user_id,
    ];

    $query = edit('drug',$edit_data,$id);

    if ($query) {
        header("location: list_drug.php?update");
        exit();
    }else{
        header("location: list_drug.php?error");
        exit();
    }
}

?>