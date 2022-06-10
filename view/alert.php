<?php if(isset($_GET['saved'])) {?>
<div class="alert alert-success" role="alert" style="margin-bottom: 3rem;" >
    <strong>تبریک </strong> ذخیره انجام شد
</div>
<?php } if(isset($_GET['update'])) {?> 
<div class="alert alert-success" role="alert" style="margin-bottom: 3rem;" >
    <strong>تبریک </strong> ویرایش انجام شد
</div>
<?php } if(isset($_GET['deleted'])) {?> 
<div class="alert alert-warning" role="alert" style="margin-bottom: 3rem;" >
    <strong>تبریک </strong> حذف انجام شد
</div>
<?php } if(isset($_GET['error'])) {?>
<div class="alert alert-danger" role="alert" style="margin-bottom: 3rem;" >
    <strong>متاسفانه</strong>  عملیه انجام نشد
</div>
<?php } if(isset($_GET['HaveSubCategory'])) {?>
<div class="alert alert-danger" role="alert" style="margin-bottom: 3rem;" >
    <strong>متاسفانه</strong>  این کتگوری دوا های مربوط را دارد
</div>
<?php } if(isset($_GET['users'])) {?>
<div class="alert alert-danger" role="alert" style="margin-bottom: 3rem;" >
    <strong>متاسفانه</strong>  شما با این کاربر  Login  هستید !
</div>
<?php } if(isset($_GET['not_deleted'])) {?>
<div class="alert alert-danger" role="alert" style="margin-bottom: 3rem;" >
    <strong>متاسفانه</strong>  شما نمیتوانید این را حذف کنید !
</div>
<?php } ?>
