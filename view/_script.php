        <script  src="../assets/dist/js/jquery.js" type="text/javascript"></script>
        <script  src="../assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/metisMenu/metisMenu.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/animsition/js/animsition.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <!-- START PAGE LABEL PLUGINS -->
        <!-- START THEME LABEL SCRIPT -->
        <script src="../assets/dist/js/app.min.js" type="text/javascript"></script>
        <script src="../assets/dist/js/jQuery.style.switcher.js" type="text/javascript"></script>

        <!-- STRAT PAGE LABEL PLUGINS -->
        <script src="../assets/plugins/icheck/icheck.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-toggle/bootstrap-toggle.min.js" type="text/javascript"></script>
        <!-- START THEME LABEL SCRIPT -->
        
        <script src="../assets/plugins/modals/classie.js" type="text/javascript"></script>
        <script src="../assets/plugins/modals/modalEffects.js" type="text/javascript"></script>
        <script src="../assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>

        
        <script src="../lib/LoadImg/assets/js/loadimg.js"></script>
        <script type="text/javascript">
                $('#upload').loadImg({
                        "text"                  : "Click to upload Picture with extension png,jpg,gif.",
                        "fileExt"               : ['jpg','png','gif','JPG','PNG','GIF'],
                        "fileSize_min"  : 0,
                        "fileSize_max"  : 5
                });
        </script>
        <!-- STRAT PAGE LABEL PLUGINS -->
        <script src="../assets/plugins/jquery.sumoselect/jquery.sumoselect.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <!-- START THEME LABEL SCRIPT -->
        <!-- <script src="../assets/dist/js/jquery.js" ></script> -->
        <script src="../assets/dist/js/persian-date.min.js"></script>
        <script src="../assets/dist/js/persian-datepicker.min.js"></script>

        <script type="text/javascript">

        $(document).ready(function() {
          $(".p-date").pDatepicker({
            initialValueType: "persian",
            format: "YYYY-MM-DD",
            onSelect: "year"
          });
        });
        $(document).ready(function() {
            $('.p-date2').pDatepicker({
            format: 'YYYY-MM-DD',
            calendarType: 'gregorian',
            });
        });
        
        



            //     //select2
                $(".basic-single").select2();
                $(".form-control").attr("autocomplete","off");
            // });

            // // For Date
            // var dp;
            // $(document).ready(function() {
            //     var options = {
            //         format : "YYYY-MM-DD",
            //         formatter : function(unix) {
            //             var pdate = new persianDate(unix);
            //             pdate.formatPersian = false;
            //             return pdate.format("YYYY-MM-DD");
            //             //return new persinDate(unix).format("YYYY/MM/DD");
            //         },
            //         daysTitleFormat : "YYYY MMMM",
            //         observer : true,
            //         sendOption : "p",
            //         //position : [2, 2],
            //         autoclose : true,
            //         toolbox : true,
            //         altField : "#alternateField",
            //         altFormat : "u",
            //         altFieldFormatter : function(unix) {
            //             var pdate = new persianDate(unix);
            //             pdate.formatPersian
            //             pdate.formatPersian = false;
            //             return pdate.format("YYYY-MM-DD");
            //         },
            //         onShow : function() {
            //             //console.log("user config onShow event ")
            //         },
            //         onHide : function() {
            //             //console.log("user config onHide event ")
            //         },
            //         onSelect : function(unix) {
            //            this.hide();
            //         }
            //     };
            //     $(".date").persianDatepicker(options);
            //     dp = $(".date").data("datepicker");
            // });
        </script>
        
        <script type="text/javascript">


            $(".delete-row").click(function(){
                var confirms = window.confirm("You click on the delete option, the selected record will be remove. Do you Want to continue??");
                if(confirms){
                    window.location = $("a").attr("href");
                }else{
                  return false;
                }
            });

            // $(".nDelete-row").click(function(){
            //     var confirms = window.confirm("این اطلاعات قابل حذف نمیباشد . ");
            // });

            // $(".notice").click(function(){
            //     var confirms = window.confirm("Are you sure to do this action!?");
            //     if(confirms){
            //         window.location = $("a").attr("href");
            //     }else{
            //       return false;
            //     }
            // }); 
            

            

            $(".inactive").click(function(){
                var confirms = window.confirm("Continue to Inactive?");
                if(confirms){
                    window.location = $("a").attr("href");
                }else{
                  return false;
                }

            });

            $(document).mouseup(function(e){
                var container = $(".ul_list_auto");

                // if the target of the click isn't the element nor an element of the element
                if (!container.is(e.target) && container.has(e.target).length === 0) 
                {
                    container.hide();
                }
            });

            // avoid space typing
            $('input.nospace').keydown(function(e) {
                if (e.keyCode == 32) {
                    return false;
                }
            });
			
			$("form").submit(function(){
                $('button[type=submit]').attr('disabled', 'disabled');
                $('input[type=submit]').attr('disabled','disabled');
				$("form button[type='submit']").attr('disabled',true);
				$("form button[type='submit']").attr('type','button');

			});

        </script>
     
        <style type="text/css">
            #md-overlay {
                position: fixed;
                width: 100%;
                height: 100%;
                visibility: hidden;
                top: 0;
                left: 0;
                z-index: 1000;
                opacity:0;
                background: rgba(0,0,0,0.5);
                -webkit-transition: all 0.3s;
                -moz-transition: all 0.3s;
                transition: all 0.3s;
            }
        </style>

        <div id="page_loading" style="position:fixed;top:40%;margin:auto;left:50%;display:block;z-index:2000;visibility:hidden;">
            <div style="border-radius:100% !important;width:150px;height:150px;background:white;text-align:center;padding:10px;padding-top:19px;"><img src="../assets/loader.gif"><br>Pleae Waith...</div>
        </div>
        <div id="md-overlay"></div>
        <script type="text/javascript">
            function start() {
               document.getElementById("md-overlay").style.opacity ="1";
               document.getElementById("md-overlay").style.visibility="visible";
               document.getElementById("page_loading").style.visibility="visible";
            }
            function end() {
               document.getElementById("md-overlay").style.opacity ="0";
               document.getElementById("md-overlay").style.visibility="hidden";
               document.getElementById("page_loading").style.visibility="hidden";
            }
        </script>


`       <script>
            $(document).ready(function () {

                "use strict"; // Start of use strict

                $('.skin-minimal .i-check input').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal',
                    increaseArea: '20%'
                });

                $('.skin-square .i-check input').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green'
                });


                $('.skin-flat .i-check input').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                $('.skin-line .i-check input').each(function () {
                    var self = $(this),
                            label = self.next(),
                            label_text = label.text();

                    label.remove();
                    self.iCheck({
                        checkboxClass: 'icheckbox_line-blue',
                        radioClass: 'iradio_line-blue',
                        insert: '<div class="icheck_line-icon"></div>' + label_text
                    });
                });

            });
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#modal-profile-form").submit( function(e){
                e.preventDefault()
                $.ajax({
                    url         :"ajax_materials.php",
                    method      :"post",
                    data        : new FormData(this),
                    contentType : false,
                    cache       : false,
                    processData : false, 
                    success     : function(respose){
                        if(respose.trim() == "error"){
                            location.search = "error";
                        }else if (respose.trim() == 1){
                            window.location.href = 'logout.php';
                        }else{
                            location.search = "error";
                        }
                    }
               })
            });
        });

        var now_username = $("#username");
        function is_username(key){
            if(now_username != key){
                $.ajax({
                    url:"ajax_materials.php",
                    method :"post",
                    data :{
                        key : key,
                        type : "is_userName"
                    },beforeSend:function(){
                        $("#username").css("background","url(../img/input-loading-g.gif) no-repeat center");
                    },success:function(respose){
                        if(respose.trim()== 1){
                            $("#p-username").show("slow");
                        }else{
                            $("#p-username").hide("slow");
                        }

                        $("#username").css("background","");
                    }
                })
            }
        }

        function is_password(key){
            if(key.length > 0 ){
                $.ajax({
                    url:"ajax_materials.php",
                    method :"post",
                    data :{
                        key : key,
                        type : "is_password"
                    },beforeSend:function(){
                        $("#now_password").css("background","url(../img/input-loading-g.gif) no-repeat center");
                    },success:function(respose){
                        if(respose.trim()== 1){
                            $("#p-password").hide("slow");
                        }else{
                            $("#p-password").show("slow");
                        }
                        
                        $("#now_password").css("background","");
                    }
                })
            }
        }


        $(window).load(function(){
            getMessage();
        });
        function getMessage(){
            $.ajax({
                method:"post",
                url:"ajax_message_an.php",
                data:{},
                success:function(resutl){
                    $("#message_an").html(resutl);
                }
            });
        }
    </script>
     <script src="../assets/xlsx.js"></script>
  <script>
    
        function html_table_to_excel(type)
        {
            var data = document.getElementById('employee_data');

            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

            XLSX.writeFile(file, 'file.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () =>  {
            html_table_to_excel('xlsx');
    });

    </script>


