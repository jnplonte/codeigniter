<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social_model extends PC_Model {

    function __construct(){
		parent::__construct();	
															
	}

    function check_ip_addr($social_id, $remote_addr){

        $this->pcommutedb->select('rating_id');
        $this->pcommutedb->from('ratings');
        $this->pcommutedb->where('social_id',$social_id);
        $this->pcommutedb->where('ip_addr',$remote_addr);

        $query = $this->pcommutedb->get();

        if($query->num_rows() == 1){
            return false;
        }else{
            return true;
        }

    }

    function insert_ip_addr($social_id, $remote_addr){

        $data = array(
           'social_id'  => $social_id,
           'ip_addr'    => $remote_addr
        );

        $this->pcommutedb->insert('ratings', $data); 

        if($this->pcommutedb->affected_rows() == 0){
            return false;
        }else{
            return true;  
        }

    }

    function update_like($social_id){

        $data = array('like_count' => $this->get_like_count($social_id) + 1);

        $this->pcommutedb->where('social_id', $social_id);
        $this->pcommutedb->update('socials', $data); 

        if($this->pcommutedb->affected_rows() == 0){
            return false;
        }else{
            return true;  
        }
    }

    function update_dislike($social_id){

        $data = array('dislike_count' => $this->get_dislike_count($social_id) + 1);

        $this->pcommutedb->where('social_id', $social_id);
        $this->pcommutedb->update('socials', $data); 

        if($this->pcommutedb->affected_rows() == 0){
            return false;
        }else{
            return true;  
        }
    }
}
