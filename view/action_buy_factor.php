<?php
    
    require_once ("_config.php");

    
    if(isset($_POST['insert'])){
    
        $code_number        = VD($_POST['code_number']);
        $customer_id        = VD($_POST['customer_id']);
        $total_price        = (empty(VD($_POST['total_price']))) ? 0 : VD($_POST['total_price']);
        $payment_amount     = (empty(VD($_POST['payment_amount']))) ? 0 :VD($_POST['payment_amount']);
        $remain             =  (empty($_POST['remain'])) ? 0 :  VD($_POST['remain']);
        $date               = VD($_POST['date']);
        $note               = VD($_POST['note']);


        $data = [
            'code_number'       => $code_number,
            'customer_id'       => $customer_id,
            'date'              => $date,
            'note'              => $note,
            'user_id'           => $user_id,
            'type'              => 'buy',
        ];

        $insert           = insert('buy_sell_drug',$data);
        $buy_sell_durg_id = $db->lastInsertId();


        foreach ($_POST['drug_ides'] as $key => $drug_row) {
            
            if(empty($drug_row) || empty($_POST['positiones'][$key]))
                continue;

            $stock_id   = VD($_POST['positiones'][$key]);
            $drug_id    = VD($_POST['drug_ides'][$key]);
            $amount     = (empty(VD($_POST['amount_items'][$key]))) ? 0 : VD($_POST['amount_items'][$key]);
            $unit_price = (empty(VD($_POST['unit_price'][$key])))  ? 0 : VD($_POST['unit_price'][$key]);
            $price      = ( empty($_POST['proice_amount'][$key]) ) ? 0 :  VD($_POST['proice_amount'][$key]);
            
            $data = [
                'buy_sell_drug_id'  => $buy_sell_durg_id,
                'drug_id'           => $drug_id,
                'stock_id'          => $stock_id,
                'amount'            => $amount,
                'price'             => $price,
                'expire_date'       => VD($_POST['expire_dates'][$key]),
                'type'              => 'buy',
                'user_id'           => $user_id,
                'cal_amount'        => $amount,
                'unit_price'        => $unit_price
            ];
            $insert = insert('buy_sell_assets',$data);

            // insert stock_drug_amount in table 
            exchange_amount_durg_stock($stock_id,$drug_id,$amount,'add');

        }

        $data = [
            'buy_sell_drug_id'  => $buy_sell_durg_id,
            'total_amount'      => $total_price,
            'payment_amount'    => $payment_amount,
            'remain_amount'     => $remain,
            'type'              => 'buy',
            'user_id'           => $user_id, 
            'customer_id'       => $customer_id, 
        ];

        $insert  = insert('customer_buy_sell_payment',$data);


        $is_exest = $db->query("SELECT * FROM `customer_transaction` WHERE customer_id = $customer_id LIMIT 1 ");
        if($is_exest->rowCount() > 0 ){
            
            $customer_transaction_row = $is_exest->fetch();
            $current_amount = $customer_transaction_row['amount'] + 0;    
            $edit = edit('customer_transaction',['amount' => $current_amount + $remain],$customer_transaction_row['id']);

        }else {

            $data = [
                'customer_id'   => $customer_id,
                'amount'        => $remain,
                'type'          => 'buyer'
            ];
            $insert  = insert('customer_transaction',$data);
        }

        if($insert){
            header("location: add_buy_factor.php?saved");
            exit();
        }else{
            header("location: add_buy_factor.php?error");
            exit();
        } 
    
    }




    if(isset($_POST['edit'])){


        $id                 =   base64_decode($_POST['id']);
        $total_amount       = (empty(VD($_POST['total_amount']))) ? 0 : VD($_POST['total_amount']) ;
        $payment_amount     = (empty(VD($_POST['payment_amount']))) ? 0 : VD($_POST['payment_amount']);
        $remain             = (empty(VD($_POST['remain'])) ? 0 : VD($_POST['remain']));
        $current_date       = VD($_POST['current_date']);
        $note               = VD($_POST['note']);

        if (!empty($_POST['date'])) {
            $current_date  = VD($_POST['date']);
        }


        $buy_sell_drug                  = select_one('buy_sell_drug',$id);
        $customer_id                    = $buy_sell_drug['customer_id'];
        $customer_balance_row           = $db->query("SELECT * FROM customer_transaction WHERE customer_id = '$customer_id' ")->fetch();  
        $customer_buy_sell_payment_row  = $db->query("SELECT * FROM customer_buy_sell_payment  WHERE buy_sell_drug_id = $id AND deleted = 0 ")->fetch();

        //  step 1 
        
        if($customer_id == $_POST['customer_id']){
            
            $final_amount = (($customer_balance_row['amount'] - $customer_buy_sell_payment_row['remain_amount']) + $remain ) ;
            $edit = edit('customer_transaction',['amount' => $final_amount] , $customer_balance_row['id']);

        }else {

            $final_amount = (($customer_balance_row['amount'] - $customer_buy_sell_payment_row['remain_amount']) ) ;
            $edit = edit('customer_transaction',['amount' => $final_amount] , $customer_balance_row['id']);

            $customer_id = $_POST['customer_id'];
            
            $data = [
                'customer_id'   => $customer_id,
                'amount'        => $remain,
                'type'          => 'buyer'
            ];
            $insert  = insert('customer_transaction',$data);
        }

        // step 2
        $data = [
            'total_amount'      => $total_amount,
            'payment_amount'    => $payment_amount,
            'remain_amount'     => $remain,
            'customer_id'       => $customer_id,
        ];

        $edit = edit('customer_buy_sell_payment',$data,$customer_buy_sell_payment_row['id']);

        // step 3 
        $data = [
            'customer_id' => $customer_id,
            'date'        => $current_date,
            'note'        => $note,
        ];

        $edit = edit('buy_sell_drug',$data,$id);

        if ($edit) {
            header("location: list_buy_factor.php?update");
            exit();
        }else{
            header("location: list_buy_factor.php?error");
            exit();
        }

    }


    if(isset($_GET['deleted_drug'])){


        $buy_sell_assets_id     = base64_decode($_GET['id']);
        $buy_sell_assets_row    = select_one('buy_sell_assets',$buy_sell_assets_id);
        $buy_sell_drug_id       = $buy_sell_assets_row['buy_sell_drug_id'];
        $customer_buy_sell_row  = $db->query("SELECT * FROM customer_buy_sell_payment WHERE buy_sell_drug_id = $buy_sell_drug_id ")->fetch();
        $customer_id            = $customer_buy_sell_row['customer_id'];
        $customer_balance_row   = $db->query("SELECT * FROM customer_transaction WHERE customer_id = $customer_id")->fetch();

        // step 1
        $final_amount = ($customer_balance_row['amount'] - $buy_sell_assets_row['price']);
        $edit = edit('customer_transaction',['amount' => $final_amount] , $customer_balance_row['id']);
        // step 2 
        $data = [
            'total_amount'      => $customer_buy_sell_row['total_amount']  - $buy_sell_assets_row['price'],
            'remain_amount'     => $customer_buy_sell_row['remain_amount'] - $buy_sell_assets_row['price'],
        ];
        $edit = edit('customer_buy_sell_payment',$data,$customer_buy_sell_row['id']);


        // step 3 
        $drug_id    = $buy_sell_assets_row['drug_id'];
        $stock_id   = $buy_sell_assets_row['stock_id'];
        $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $stock_id  ")->fetch();
        $edit = edit('stock_drug_amount',['amount' => $stock_drug_amount_row['amount'] - $buy_sell_assets_row['amount']],$stock_drug_amount_row['id']);

        // step 4
        $deleted = edit('buy_sell_assets',['deleted' => 1],$buy_sell_assets_id);

        if ($deleted) {
            header("location: list_buy_factor.php?deleted");
            exit();
        }else{
            header("location: list_buy_factor.php?error");
            exit();
        }

    }




    if(isset($_POST['edit_buy_sell_assets'])){


        $buy_sell_assets_id     = base64_decode($_POST['id']);
        $buy_sell_assets_row    = select_one('buy_sell_assets',$buy_sell_assets_id);
        $buy_sell_drug_id       = $buy_sell_assets_row['buy_sell_drug_id'];
        $customer_buy_sell_row  = $db->query("SELECT * FROM customer_buy_sell_payment WHERE buy_sell_drug_id = $buy_sell_drug_id ")->fetch();
        $customer_id            = $customer_buy_sell_row['customer_id'];
        $customer_balance_row   = $db->query("SELECT * FROM customer_transaction WHERE customer_id = $customer_id")->fetch();


        $drug_id        = VD($_POST['drug_id']);
        $amount         = (empty(VD($_POST['amount']))) ? 0 :VD($_POST['amount']);
        $price          = (empty(VD($_POST['price']))) ? 0 : VD($_POST['price']);
        $stock_id       = (empty(VD($_POST['stock_id']))) ? 0 :VD($_POST['stock_id']) ;
        $current_date   = VD($_POST['current_date']);
        
        if (!empty($_POST['expire_date'])) {
            $current_date  = VD($_POST['expire_date']);
        }

        // step 1 

        $final_amount = ($customer_balance_row['amount'] - $buy_sell_assets_row['price']) + $price;
        $edit = edit('customer_transaction',['amount' => $final_amount] , $customer_balance_row['id']);

        // step 2

        $data = [
            'total_amount'      => ($customer_buy_sell_row['total_amount']  - $buy_sell_assets_row['price']) + $price,
            'remain_amount'     => ($customer_buy_sell_row['remain_amount'] - $buy_sell_assets_row['price']) + $price,
        ];
        $edit = edit('customer_buy_sell_payment',$data,$customer_buy_sell_row['id']);


        // step 3  
        if($drug_id == $buy_sell_assets_row['drug_id'] ){
            
            if($buy_sell_assets_row['stock_id'] == $stock_id){
                
                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $stock_id  ")->fetch();
                $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] - $buy_sell_assets_row['amount']) + $amount  ) ],$stock_drug_amount_row['id']);

            }else {

                // start back data
                $past_stock_id = $buy_sell_assets_row['stock_id'];
                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $past_stock_id  ")->fetch();
                $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] - $buy_sell_assets_row['amount'])  ) ],$stock_drug_amount_row['id']);
                // end back data  

                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $stock_id  ");
                if($stock_drug_amount_row->rowCount() > 0 ){
                    $stock_drug_amount_row = $stock_drug_amount_row->fetch();
                    $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] + $amount) ) ],$stock_drug_amount_row['id']);
                }else {
            
                    $data = [
                        'drug_id'   => $drug_id,
                        'stock_id'  => $stock_id,
                        'amount'    => $amount,
                    ];
    
                    $insert = insert('stock_drug_amount',$data);
                }
            
                
            }
        }else {
            
            $past_drug_id = $buy_sell_assets_row['drug_id'];
            $past_stock_id = $buy_sell_assets_row['stock_id'];;
                    
            if($buy_sell_assets_row['stock_id'] == $stock_id){

                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $past_drug_id and stock_id = $stock_id  ")->fetch();
                $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] - $buy_sell_assets_row['amount'])   ) ],$stock_drug_amount_row['id']);

                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $stock_id  ");
                if($stock_drug_amount_row->rowCount() > 0 ){
                    $stock_drug_amount_row =  $stock_drug_amount_row->fetch();
                    $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] +  $amount )   ) ],$stock_drug_amount_row['id']);
                }else {
                    $data = [
                        'drug_id'   => $drug_id,
                        'stock_id'  => $stock_id,
                        'amount'    => $amount,
                    ];

                    $insert = insert('stock_drug_amount',$data);
                }

                
                
            }else {

                // start back data 
                    $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $past_drug_id and stock_id = $past_stock_id  ")->fetch();
                    $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] - $buy_sell_assets_row['amount'])   ) ],$stock_drug_amount_row['id']);
                // end back data 

                $stock_drug_amount_row = $db->query("SELECT * FROM `stock_drug_amount` WHERE drug_id = $drug_id and stock_id = $stock_id  ");
                if($stock_drug_amount_row->rowCount() > 0 ){
                    $stock_drug_amount_row = $stock_drug_amount_row->fetch();
                    $edit = edit('stock_drug_amount',['amount' => (($stock_drug_amount_row['amount'] + $amount ) ) ],$stock_drug_amount_row['id']);
                }else {

                    $data = [
                        'drug_id'   => $drug_id,
                        'stock_id'  => $stock_id,
                        'amount'    => $amount,
                    ];

                    $insert = insert('stock_drug_amount',$data);
                }

            }
            
        }

        
        // step 4 

        $data = [
            'drug_id'       => $drug_id,
            'stock_id'      => $stock_id,
            'amount'        => $amount,
            'price'         => $price,
            'expire_date'   => $current_date,
            'cal_amount'    => $amount,
            'unit_price'    => VD($_POST['unit_price']),
        ];

        $edit = edit('buy_sell_assets',$data,$buy_sell_assets_id);

        if ($edit) {
            header("location: list_buy_factor.php?update");
            exit();
        }else{
            header("location: list_buy_factor.php?error");
            exit();
        }
    }

    if(isset($_GET['delete'])){
        
        $buy_sell_drug_id       = base64_decode($_GET['id']);
        $customer_buy_sell_row  = $db->query("SELECT * FROM customer_buy_sell_payment WHERE buy_sell_drug_id = $buy_sell_drug_id ")->fetch();

        if($customer_buy_sell_row['total_amount'] != $customer_buy_sell_row['remain_amount'] || $customer_buy_sell_row['payment_amount'] != 0  ){
            header("location: list_buy_factor.php?not_deleted");
            exit(); 
        }

        $view_data = $db->query("SELECT * FROM buy_sell_assets WHERE  buy_sell_drug_id = $buy_sell_drug_id AND deleted = 0  ");

        if($view_data->rowCount() > 0 ){
            header("location: list_buy_factor.php?has_Item");
            exit();
        }

        $edit = $db->query("UPDATE buy_sell_assets SET deleted = '1' WHERE  buy_sell_drug_id = $buy_sell_drug_id ");

        $deleted = edit('buy_sell_drug',['deleted' => 1],$buy_sell_drug_id);

        if ($deleted) {
            header("location: list_buy_factor.php?deleted");
            exit();
        }else{
            header("location: list_buy_factor.php?error");
            exit();
        }

    }
?>