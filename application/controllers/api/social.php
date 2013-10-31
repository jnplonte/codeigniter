<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends PC_Controller{

    function process_like_post(){

        if(!$this->post('did')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $did = pc_decode($this->post('did'));

        if($did == FALSE){
            $this->response($this->config->item('error_1001'), 400);
        }

        $sid = $this->common_model->get_value('social_id', $did, 'direction_id', 'directions', 'pcommutedb', TRUE);

        $sid = $sid['social_id'];

        if($this->social_model->check_ip_addr($sid , $_SERVER["REMOTE_ADDR"]) == TRUE){
            if($this->social_model->insert_ip_addr($sid , $_SERVER["REMOTE_ADDR"]) == TRUE){
                if($this->social_model->update_like($sid) == TRUE){
                    $this->data['status'] = true;
                    $this->data['data']['like_count'] = $this->social_model->get_like_count($sid);
                    $this->response($this->data, 200); 
                }else{
                    $this->response($this->config->item('error_1007'), 404);
                }
            }else{
                $this->response($this->config->item('error_1006'), 404);
            }
        }else{
            $this->response($this->config->item('error_1005'), 404);
        }
    }


    public function process_dislike_post(){

        if(!$this->post('did')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $did = pc_decode($this->post('did'));

        if($did == FALSE){
            $this->response($this->config->item('error_1001'), 400);
        }

        $sid = $this->common_model->get_value('social_id', $did, 'direction_id', 'directions', 'pcommutedb', TRUE);

        $sid = $sid['social_id'];

        if($this->social_model->check_ip_addr($sid , $_SERVER["REMOTE_ADDR"]) == TRUE){
            if($this->social_model->insert_ip_addr($sid , $_SERVER["REMOTE_ADDR"]) == TRUE){
                if($this->social_model->update_dislike($sid) == TRUE){
                    $this->data['status'] = true;
                    $this->data['data']['dislike_count'] = $this->social_model->get_dislike_count($sid);
                    $this->response($this->data, 200); 
                }else{
                    $this->response($this->config->item('error_1007'), 404);
                }
            }else{
                $this->response($this->config->item('error_1006'), 404);
            }
        }else{
            $this->response($this->config->item('error_1005'), 404);
        }   
    }
}
