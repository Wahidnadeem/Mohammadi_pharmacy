<?php



    function get_column_value( $table , $id , $column , $error = false){

        if($error){
            echo "SELECT $column FROM `$table` WHERE deleted = '0' AND id = '$id'";
            exit;
        }
    
        global $db;
        $data   = $db->query("SELECT $column FROM `$table` WHERE deleted = '0' AND id = '$id' ");
        return  ($data->rowCount() >  0 ) ? $data->fetch()[$column] : '';
    }

    function get_user_name ($id){
        return get_column_value('users',$id,'full_name');
    }


    function change_master_balance($from_id,$from_amount,$to_id,$to_amount){
        
        //  this function use to update master balance table 
        //  this function well use to all system 
        
        global $db;
        $exe = true;
        
        $update  = increase_currency_amount('master_balance',$from_id,$from_amount);
        if(!$update)
            $exe = false;

        $update =  decrease_currency_amount('master_balance',$to_id,$to_amount);
        if(!$update)
            $exe = false;

        return $exe;
    }


    function code_number_facor($type){
        global $db;
        
        $view_data = $db->query("SELECT `code_number` FROM `buy_sell_drug` WHERE  `type` = '$type'  ORDER BY id DESC LIMIT 1 ");
        if($view_data->rowCount() ){
            return ($view_data->fetch()['code_number'] ) + 1 ;
        }else {
            return 1;
        }
    }


    //  this funcion user action_buy_factor
    function exchange_amount_durg_stock($stock_id , $drug_id , $amount , $type ){
        
        global $db;
        $is_exist = $db->query("SELECT * FROM stock_drug_amount WHERE stock_id  = $stock_id AND drug_id = $drug_id LIMIT 1 ");
        if($is_exist->rowCount() > 0 ){
            $stock_drug_amount = $is_exist->fetch();

            if($type == "add")
                return edit('stock_drug_amount',['amount' => $stock_drug_amount['amount'] + $amount ] , $stock_drug_amount['id']);
            else if ($type == "minus")
                return edit('stock_drug_amount',['amount' => $stock_drug_amount['amount'] - $amount ] , $stock_drug_amount['id']);

        }else {

            $data = [
                'drug_id'   => $drug_id,
                'stock_id'  => $stock_id,
                'amount'    => ($type == "add") ? $amount : -$amount,
            ];
            
            return insert('stock_drug_amount',$data);
        }

    }


    function  cal_back_expire_date_durg($drug_id,$amount){

        global $db;

        $view_data = $db->query("SELECT * FROM buy_sell_assets WHERE `type` = 'buy' AND `drug_id` = $drug_id AND ( `status` = 'done' OR (  `cal_amount` != 0  and `cal_amount` != `amount` )  ) ORDER BY id DESC");
        $this_amount = $amount;
        // echo $this_amount;
        foreach ($view_data as $key => $value) {

            if($this_amount == 0)
                break;

            $cal_amount = $value['amount'];

            if($this_amount >= $cal_amount ){
                $edit = edit('buy_sell_assets',['status' => 'notDone','cal_amount' => $cal_amount],$value['id']);
                $this_amount -= $cal_amount;
            }else {
                $edit = edit('buy_sell_assets',['cal_amount' => ($value['cal_amount'] + $this_amount) ],$value['id']);
                $this_amount = 0;
                break;
            }
        }

    }


    function cal_add_expire_date_durg ($drug_id , $amount){

        global $db;

        $view_data = $db->query("SELECT * FROM buy_sell_assets WHERE `type` = 'buy' AND `drug_id` = $drug_id AND `status` = 'notDone' ");
        $this_amount = $amount;

        foreach ($view_data as $key => $value) {

            if($this_amount == 0)
                break;

            $cal_amount = $value['amount'];

            if($this_amount >= $cal_amount ){
                $edit = edit('buy_sell_assets',['status' => 'done','cal_amount' => 0],$value['id']);
                $this_amount -= $cal_amount;
            }else {
                $edit = edit('buy_sell_assets',['cal_amount' => ($value['cal_amount'] - $this_amount) ],$value['id']);
                $this_amount = 0;
                break;
            }
        }
    }


?>