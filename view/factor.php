
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("_head.php");?>  

    </head>
    <body class="body" style="scrollbar-width: thin;">
        
        <div id="wrapper" class="wrapper animsition">
            <!-- Navigation -->
            <?php require_once("_navigation.php");?>
            <!-- /.Navigation -->
            <?php $menu = "ACCOUNTS"; $sub = "a";$page= "tr_a.php"; ?>
            <!-- Sidebar -->
            <?php require_once("_sidebar.php");?>
            <!-- /.Sidebar -->            
            <!-- /.Navbar  Static Side -->
            <div class="control-sidebar-bg"></div>
            <!-- Page Content -->
            <div id="page-wrapper">
                <!-- main content -->
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div style="background:white;padding:10px;padding-top:6px;padding-bottom:7px;">
                            <div class="header-title" style="margin-right:0px;">
                                <ol class="breadcrumb">
                                    <li class="active"><a href="index.php"><i class="fa fa-home"></i> صفحه اصلی</a></li>
                                    <li class="active"> فاکتور خرید</li>
                                </ol>
                            </div>
                        </div>
                    </div> <!-- /. Content Header (Page header) -->
                    <?php // require_once("message.php");?>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 m-b-20">
                            <div class="panel panel-default lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4 class=" bold bfont"><i class="fa fa-inbox"> </i> فاکتور خرید</h4>
                                    </div>
                                </div>
                                <div class="panel-body bfont">

                                    

                                    <form id="validation-form" class="form-horizontal form-label-left" method="post" action="tr_aac.php">  
                                        <br>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name"> نمبر قرارداد <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-7">
                                                <input type="text" id="name" name="name" required="required" class="form-control cfont"  placeholder="مثلا: حساب بار نامه ها "  >
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name">مشتری<span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-7">
                                                <select class="form-control">
                                                    <option>علی احد</option>
                                                    <option>متین</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="insertaion" value="1">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-12 col-xs-12 col-lg-2" for="name">فاکتور خرید</label>
                                            <div class="col-md-5 col-sm-12 col-xs-12 col-lg-7" style="overflow-x: auto;">
                                           <table class="table" style="border:1px solid #009688;">
                                                <thead>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">  نام دارو</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">تعداد</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;">مبلغ</th>
                                                    <th style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> موقعیت</th>
                                                    <th colspan="2" style="text-align: right !important;background: #607D8B;font-size: 12px;color:white;;font-weight:bold;"> تاریخ انقضا</th>             
                                                </thead>
                                                <tr class="cfont" id="tr_1" >
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;  width: 190px;">
                                                        <select class="form-control">
                                                            <option>انتخاب</option>
                                                            <option>پرستامول</option>
                                                            <option>دیکلیفونک</option>
                                                        </select>
                                                        
                                                    </td>
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                       <input type="number" required name="item_amount[]" id="item_amount_1" class="form-control cmdesign" placeholder="تعداد ">
                                                    </td>
                                                    
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 120px;">
                                                       <input type="text" name="item_weight[]" id="item_weight_1" class="form-control cmdesign" placeholder="مبلغ ">
                                                    </td>
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 190px;">
                                                       <select class="form-control">
                                                            <option>انتخاب</option>
                                                            <option>پرستامول</option>
                                                            <option>دیکلیفونک</option>
                                                        </select>
                                                    </td>
                                                    <td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;width: 150px;">
                                                       <input type="text" name="item_note[]" id="item_note_1" class="form-control cmdesign" placeholder="تاریخ انقضا">
                                                    </td>
                                                </tr>

                                                    <tr>
                                                        <td colspan="6" class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;">
                                                            <a class="left" onclick="add();">
                                                                <button type="button" class="btnc btnc-primary btnc-icon-anim btnc-circle" style="width:30px;height:30px;"><i class="fa fa-plus"></i></button>
                                                            </a>
                                                           

                                                        </td>
                                                    </tr>
                                                        </tbody>
                                                    </table>   
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-2 col-sm-12 col-xs-12 col-lg-2" for="date"> تاریخ  <span class="required">*</span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-7">
                                                <input type="text" id="date" name="date" required="required" class="form-control mdate"  placeholder="تاریخ">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-2 col-sm-12 col-xs-12 col-lg-2" for="note">تفصیلات<span class=""></span></label>
                                            <div class="col-md-7 col-sm-12 col-xs-12 col-lg-7">
                                                <textarea id="note" name="note" class="form-control" rows="5" style="width:100%;height:40%;overflow-x:auto;" placeholder="لازمی نیست"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-lg-8 col-lg-offset-2">
                                                <button type="submit" class="btn btn-primary" name="send_save"><i class="fa fa-clone"> </i> ثبت و جدید</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"> </i> لغو یا پاک کردن</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>                                
                                <div class="panel-footer">&nbsp;</div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default lobidisable">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="gray bold bfont"><i class="fa fa-inbox"></i> لیست فاکتور خرید ، آخرین موارد ثبت شده.</h4>
                            </div>
                        </div>
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>نمبر قرارد</th>
                                        <th>مشتری</th>
                                        <th>جزییات فاکتور خرید</th>
                                        <th>تاریخ</th>
                                        <th>توسط</th>
                                        <th class="text-center">اجرآت</th>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>نفت</td>
                                        <td>علی احمد</td>
                                         <td style="cursor: pointer;"><p class="btnc btnc-warning   btnc-outline fancy-button btnc-0" data-toggle="modal" data-target="#myModal">
                                            قراداد نمبر 21
                                        </p>               
                                        </td>
                                        <td>1398،عقرب 1</td>
                                        <td>ادمین </td>
                                        <td class="text-center">
                                            <a href="edit.php" class="left"><button class=" btnc  btnc-success  btnc-circle m-b-5  btnc-outline fancy-button btnc-0" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=NA==&amp;page=tr_a.php&amp;delete"><button class=" btnc  btnc-danger  btnc-circle  btnc-outline fancy-button btnc-0" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                
                                    
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="t-height"></div>

                    </div> <!-- /.main content -->
                </div><!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
        <!-- START CORE PLUGINS -->

        <div class="modal fade larg" id="myModal" tabindex="-1" role="dialog" style="overflow-x:auto;">
             <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="height: 60px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h1 class="modal-title mb-20">جزییات فاکتور</h1>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body scroll" style="overflow-y:hidden;">
                            <table  class="table table-bordered table-striped table-hover" style="margin-top:-20px;">
                                <table id="" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <th class="text-center" style="width: 20px">شماره</th>
                                        <th>نام دارو</th>
                                        <th>تعداد</th>
                                        <th>    مبلغ</th>
                                        <th>    موقعیت</th>
                                        <th>تاریخ انقضا</th>
                                        <th class="text-center">اجرآت</th>
                                    </thead>
                                    <tbody>
                                    
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>نفت</td>
                                        <td> تست</td>
                                        <td>1398،عقرب 1</td>
                                        <td>ادمین </td>
                                        <td>ادمین </td>
                                        <td class="text-center">
                                            <a href="edit.php" class="left"><button class=" btnc  btnc-success  btnc-circle m-b-5  btnc-outline fancy-button btnc-0" style="width:30px;height:30px;"><i class="fa fa-edit"></i></button></a>
                                            
                                            <a class="left delete-row" href="tr_aac.php?id=NA==&amp;page=tr_a.php&amp;delete"><button class=" btnc  btnc-danger  btnc-circle  btnc-outline fancy-button btnc-0" style="width:30px;height:30px;"><i class="fa fa-trash-o"></i></button></a>
                                        </td>
                                    </tr>
                                
                                    
                                  
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="modal-footer" dir="ltr" style="border:none;">
                        <button type="button" class="btnc btnc-danger" data-dismiss="modal">بستن</button>
                        <button type="button" class="btnc btnc-success">ذخیره</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php require_once("_script.php");?>

        <script type="text/javascript">
            function add(){
                count = 1;
            
              var tr = '<!-- 1- Start --><tr  class="cfont" id="tr_'+(count+1)+'">';
                                    
                    tr +='<td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;"><select class="form-control" list="item_'+(+count+1)+'" style="width:190px"><option>انتخاب</option><option>پرستامول</option><option>دیکلیفونک</option></select><datalist id="item_'+(+count+1)+'"></datalist></td>';

                    tr +='<td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;"><input type="number" name="item_amount[]" id="item_amount_'+(+count+1)+'" class="form-control cmdesign" placeholder="تعداد " style="width:100px"></td>';

                   

                    tr +='<td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;"><input type="text" name="item_weight[]" id="item_weight_'+(+count+1)+'" class="form-control cmdesign" placeholder="مبلغ " style="width:100px"></td>';

                  tr +='<td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;"><select class="form-control" list="item_'+(+count+1)+'" style="width:170px"><option>انتخاب</option><option>پرستامول</option><option>دیکلیفونک</option></select><datalist id="item_'+(+count+1)+'"></datalist></td>';

                    tr +='<td class="zero-padding" style="padding-bottom:8px !important;border-top:unset !important;padding-top:5px !important;"><input type="text" name="item_note[]" id="item_note_'+(+count+1)+'" class="form-control cmdesign" placeholder="تاریخ انقضا" style="width:150px"></td></tr> <!-- End -->';

              $("#tr_"+count).after(tr);
           //   $("#remover_btn_"+count).hide('slow');
              count++;
            }

            
        </script>
    </body>
</html>