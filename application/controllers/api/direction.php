<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Direction extends PC_Controller{

    function get_direction_get(){

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->direction_model->get_direction(FALSE, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function all_direction_get(){

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->direction_model->get_direction(TRUE, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function search_direction_get(){

        if(!$this->get('q')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $search_val = $this->get('q');

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->direction_model->search_direction($search_val, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function view_direction_get(){

        if(!$this->get('id')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $id = pc_decode($this->get('id'));

        if($id == FALSE){
            $this->response($this->config->item('error_1001'), 400);
        }

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->direction_model->view_direction($id, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }
    
}
