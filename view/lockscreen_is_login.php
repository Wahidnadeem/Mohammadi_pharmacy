<?php
require_once '_config.php';

if(!empty(VD($_POST['password_new']))){
    $password_new   = VD($_POST['password_new']);

    $is_user = $db->query("SELECT * FROM users WHERE `id` = '$user_id' and `password` = '$password_new' and deleted = 0 limit 1")->fetch();
    $old_pass = $is_user['password'];

    if($password_new == $old_pass){
        $_SESSION['auth']           = "b58ac01c6c7a9fb5ffd1a5d9c7d68955-NovaVTeam";
        header("location:index.php");
        exit();
    }else {
        header("location: lockscreen.php?not_user");
        exit();
    }

}else {
    header("location: lockscreen.php?empty");
    exit();
}

header("location: lockscreen.php?empty");
exit();


?>