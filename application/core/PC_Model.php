<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PC_Model extends CI_Model{
    
	public function __construct() {
		parent::__construct();

		 $this->row = array();

         $this->pcommutedb = $this->load->database('pcommutedb', TRUE);

	}

	function get_like_count($social_id){

        $this->pcommutedb->select('like_count');
        $this->pcommutedb->from('socials');
        $this->pcommutedb->where('social_id', $social_id);

        $query = $this->pcommutedb->get();

        foreach ($query->result() as $key => $value) {
            return $value->like_count;
        } 
    }

    function get_dislike_count($social_id){

        $this->pcommutedb->select('dislike_count');
        $this->pcommutedb->from('socials');
        $this->pcommutedb->where('social_id', $social_id);

        $query = $this->pcommutedb->get();

        foreach ($query->result() as $key => $value) {
            return $value->dislike_count;
        } 
    }

}

    