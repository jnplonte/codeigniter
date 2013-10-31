<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends PC_Controller{

    function get_place_get(){

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->place_model->get_place(FALSE, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function all_place_get(){

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->place_model->get_place(TRUE, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function search_place_get(){

        if(!$this->get('q')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $search_val = $this->get('q');

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->place_model->search_place($search_val, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function view_place_get(){

        if(!$this->get('id')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $id = pc_decode($this->get('id'));

        if($id == FALSE){
            $this->response($this->config->item('error_1001'), 400);
        }

        $row = ($this->get('row')) ? $this->get('row') : $this->config->item('default_row');
        $offset = ($this->get('offset')) ? $this->get('offset') : $this->config->item('default_offset');

        $this->data = $this->place_model->view_place($id, $row, $offset);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function feed_place_get(){

        $limit = ($this->get('limit')) ? $this->get('limit') : $this->config->item('default_feed_limit');

        $this->data = $this->place_model->get_feed_place($limit);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }

    function suggestion_place_get(){

        if(!$this->get('q')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $search_val = $this->get('q');

        $limit = ($this->get('limit')) ? $this->get('limit') : $this->config->item('default_sugested_lenght');

        $this->data = $this->place_model->get_place_suggestion($search_val, $limit);
        
        if(!empty($this->data['data'])){
            $this->data['status'] = true;
            $this->response($this->data, 200); 
        }else{
            $this->response($this->config->item('error_1002'), 404);
        }
    }
    
}
