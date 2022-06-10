        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Nova">
                <title> شرکت عمران ویت فارما -  <?php echo (!empty($title)) ? $title : '' ?></title>

        <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon">

        <!-- <meta http-equiv="refresh" content="50"> -->

        <!-- START GLOBAL MANDATORY STYLE -->
        <link href="../assets/dist/css/base.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/font-material/material.css" rel="stylesheet">

        <link href="../assets/plugins/jquery.sumoselect/sumoselect.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>

        <!-- START THEME LAYOUT STYLE -->
        <link href="../assets/dist/css/component_ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/dist/css/component_ui_rtl.min.css" rel="stylesheet" type="text/css"/>
        <link id="defaultTheme" href="../assets/dist/css/skins/skin-red-light.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/dist/css/custom.css" rel="stylesheet" type="text/css"/>        
        <link href="custom.css" rel="stylesheet" type="text/css"/>    
        <link rel="stylesheet" href="../assets/dist/css/persian-datepicker.min.css"/>
        <link href="../assets/plugins/amcharts/export.css" rel=stylesheet type="text/css"/>
        <link href="imgtab.css" rel=stylesheet type="text/css"/>

    
        <!-- START THEME LAYOUT STYLE -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/all.css"> -->

        <link href="../assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css"/>

        <!-- <link id="bsdp-css" href="../assets/date/css/bootstrap-datepicker3.min.css" rel="stylesheet"> -->

        <!-- START PAGE LABEL PLUGINS --> 
        <link href="../assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
        <!-- START THEME LAYOUT STYLE -->
        
        <link rel="stylesheet" type="text/css" href="../lib/LoadImg/assets/css/loadimg.css">
        <link rel="stylesheet" type="text/css" href="../tcss/custom.css">
        <link href="../assets/font/font-sans.css" rel="stylesheet" type="text/css" >
        <link href="../assets/bfont/bfont.css" rel="stylesheet" type="text/css" >
        
        <!-- Fa -->
        <link rel="stylesheet" type="text/css" href="../assets/scss/custom.css">
        <!-- <link href="../assets/datePicker/css/pwt-datepicker.css" rel="stylesheet" type="text/css" /> -->

        <style type="text/css">
            .min-height{
                min-height:600px;
            }
            .form-control{
                border-radius:0px;
                border:1px solid #bcbcbd;
            }
            .required{
                color:red;
            }
            .nothing_table{
                text-align:left;
                font-size:16px;
                height:30px;
            }
            .ul_list_auto{
            margin-top:4px;
            border-radius:8px;
            width:97%;
            position: absolute;
            z-index: 20;
            list-style: none;
            text-align:left;
            padding-left:20px;
            padding-right:20px;
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
            background-color:white;
            line-height:20px;
            direction:ltr;
            overflow:auto;
          }

          #ul_list:hover {
            background-color:#CCC;
            font-size:16px;
            color:black;
            cursor:pointer;
          }

          #ul_list{
            margin-bottom:6px;
          }

            .info-head{
                font-weight:bold;
                font-size:15px;
            }
            .th{
                background:#f3fbff;
                font-weight:bold;
                font-size:14px;
                text-align:left;
            }
            .td{
                background:#f7f2ff;
                font-size:14px;
                font-weight:bold;
                text-align:left;
            }

            .formstyle{
                /*border:1px dotted gray !important;*/
            }
            .tosize{
                font-size:18px;
            }
            .tosize:hover{
                font-size:20px;
                color:red;
            }
            .form-control{
                font-weight:bold;
                font-size:14px;
            }
            .badge-default{
                background:gray;
                color:white !important;
            }

            table thead tr th{
                background:#a60c13;
                color:white;
                font-weight:bold;
                border:none !important;
                font-size:11px;
            }
            .table-list{
                overflow:auto;
                overflow-y:hidden;
                min-height:600px;
                /*max-height:100%;*/
            }
            .left{
                text-align:left;
            }
       
            .chkExist{
                margin-top:5px;
                border:solid thin red;
                box-shadow:0px 0px 10px 0px gray;
                position:absolute;
                padding:10px;
                background:white;
                display:none;
                z-index:999;
            }
            .modal {
              text-align: center;
            }

            @media screen and (min-width: 768px) { 
              .modal:before {
                display: inline-block;
                vertical-align: middle;
                content: " ";
                height: 100%;
              }
            }

            .modal-dialog {
              display: inline-block;
              text-align: left;
              vertical-align: middle;
            }
            .pointer{
                cursor:pointer;
            }

            .rate{
                background:#f2eeee;
                font-weight:bold;
            }
            .price{
                background:#eafaf8;
                font-weight:bold;
            }
            .total{
                background:#bed1e3;
                font-weight:bold;
            }
            .release{
                font-weight:bold;
                color:green;
                cursor:pointer;
            }

            .edit-label{
                padding:10px;
                text-align:left;
                border-radius:10px 0px 10px 0px !important;
                font-size:16px !important;
                font-weight:bold !important;
                width:100% !important;
            }

            .font-16{
                font-size: 16px;
            }


          ::-webkit-scrollbar {
                width: 8px;
            }

        ::-webkit-scrollbar-track {
            background-color: darkgrey;
        }

        ::-webkit-scrollbar-thumb {
            background: #a50b12;
        }
        
        .select2-selection__rendered {
            width: 20rem !important;
        }
        table thead tr th{
            background: #333;     
        }
        ::-webkit-scrollbar-thumb {
        background: #00a8ff; 
      
        }
        .sidebar ul li.active, .sidebar ul li.active:hover {
        border-color: #333;
        }
        .sidebar ul li a i {
            color: #487eb0 !important;
        }
        #btnhb:hover {
            color: #eee !important
        }
        </style>
<?php 
    // it is for profile user 
    // require_once('tr_profile.php');
?>
