<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Place_model extends PC_Model {

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_place($show_all=FALSE, $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select('place_id, place_name, coordinate, description');
            $this->pcommutedb->from('places');
        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        if(!$show_all){
            $this->pcommutedb->limit($row, $Offset);
            $this->pcommutedb->order_by('e_time_stamp', 'desc'); 
            $query = $this->pcommutedb->get();

            if ($query->num_rows() > 0){
                $this->row['data'] = $query->result_array();
                $this->row['all_row'] = $query_all_rows->num_rows();
                $this->row['num_row'] = $query->num_rows();
            }
        }else{
            if ($query_all_rows->num_rows() > 0){
                $this->row['data'] = $query_all_rows->result_array();
                $this->row['all_row'] = $query_all_rows->num_rows();
            }
        }

        return $this->row;
    }

    function search_place($search_val=NULL, $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select('place_id, place_name, coordinate, description');
            $this->pcommutedb->from('places');
            $this->pcommutedb->like('place_name', $search_val);
        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        $this->pcommutedb->limit($row, $Offset);
        $this->pcommutedb->order_by('e_time_stamp', 'desc'); 

        $query = $this->pcommutedb->get();

        if ($query->num_rows() > 0){
            $this->row['data'] = $query->result_array();
            $this->row['all_row'] = $query_all_rows->num_rows();
            $this->row['num_row'] = $query->num_rows();
        }

        return $this->row;
    }

    function view_place($id=array(), $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select('place_id, place_name, coordinate, description');
            $this->pcommutedb->from('places');
            $this->pcommutedb->where_in('place_id', $id);

        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        $this->pcommutedb->limit($row, $Offset);
        $this->pcommutedb->order_by('e_time_stamp', 'desc'); 

        $query = $this->pcommutedb->get();

        if ($query->num_rows() > 0){
            $this->row['data'] = $query->result_array();
            $this->row['all_row'] = $query_all_rows->num_rows();
            $this->row['num_row'] = $query->num_rows();
        }

        return $this->row;
    }

    function get_feed_place($limit=20){

        $this->pcommutedb->select('p.place_id, p.place_name');
        $this->pcommutedb->from('places p');
        $this->pcommutedb->join('directions d', 'p.place_id = d.destination_id');
        $this->pcommutedb->distinct();
        $this->pcommutedb->limit($limit);
        $this->pcommutedb->order_by('d.e_time_stamp', 'desc'); 

        $query = $this->pcommutedb->get();

        if ($query->num_rows() > 0){
            $this->row['data'] = $query->result_array();
            $this->row['num_row'] = $query->num_rows();
        }

        return $this->row;
    }

    function get_place_suggestion($search_val=NULL, $limit=10){

        $search_val = trim($search_val);
        $search_arr = explode(' ', $search_val);
        $search_row = array();

        foreach ($search_arr as $key => $value) {
            if(strlen($value) > $this->config->item('default_valid_lenght')){
                $this->pcommutedb->select('p.place_id, p.place_name');
                $this->pcommutedb->from('places p');
                $this->pcommutedb->join('directions d', 'p.place_id = d.destination_id');
                $this->pcommutedb->distinct();
                $this->pcommutedb->limit($limit);
                $this->pcommutedb->like('place_name', $value);

                $query = $this->pcommutedb->get();

                if($query->num_rows() > 0){
                    $this->row['data'][$value] = $query->result_array();
                    $this->row['num_row'][$value] = $query->num_rows();
                }
            }
        }

        return $this->row;
    }
}