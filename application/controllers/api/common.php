<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends PC_Controller{

    function get_common_get(){

        if(!$this->get('sel') || !$this->get('val') || !$this->get('col')  || !$this->get('tbl')  /*|| !$this->get('db')*/ ){
            $this->response($this->config->item('error_1003'), 400);
        }

        $sel = pc_decode($this->get('sel'));
        $val = pc_decode($this->get('val'));
        $col = $this->get('col');
        $tbl = $this->get('tbl');
        $db  = 'pcommutedb'; /*$this->get('db').'db';*/

        if(($sel == FALSE) || ($val  == FALSE)){
            $this->response($this->config->item('error_1001'), 400);
        }

        $this->data = $this->common_model->get_value($sel, $val, $col, $tbl, $db);

        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }
    
}
