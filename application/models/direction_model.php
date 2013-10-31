<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direction_model extends PC_Model {

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_direction($show_all=FALSE, $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select(' p1.place_id as location_id, p1.place_name as location_name, p1.coordinate as location_coordinate, p1.description as location_description, 
                                        p2.place_id as destination_id, p2.place_name as destination_name, p2.coordinate as destination_coordinate, p2.description as destination_description,
                                        d.direction_id, d.instruction, d.total_price, d.vehicle_list, s.like_count, s.dislike_count, s.share_count');
            $this->pcommutedb->from('directions d');
            $this->pcommutedb->join('socials s', 's.social_id = d.social_id');
            $this->pcommutedb->join('places p1', 'p1.place_id = d.location_id');
            $this->pcommutedb->join('places p2', 'p2.place_id = d.destination_id');
        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        if(!$show_all){
            $this->pcommutedb->limit($row, $Offset);
            $this->pcommutedb->order_by('d.e_time_stamp', 'desc'); 
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

    function search_direction($search_val=NULL, $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select(' p1.place_id as location_id, p1.place_name as location_name, p1.coordinate as location_coordinate, p1.description as location_description, 
                                        p2.place_id as destination_id, p2.place_name as destination_name, p2.coordinate as destination_coordinate, p2.description as destination_description,
                                        d.direction_id, d.instruction, d.total_price, d.vehicle_list, s.like_count, s.dislike_count, s.share_count');
            $this->pcommutedb->from('directions d');
            $this->pcommutedb->join('socials s', 's.social_id = d.social_id');
            $this->pcommutedb->join('places p1', 'p1.place_id = d.location_id');
            $this->pcommutedb->join('places p2', 'p2.place_id = d.destination_id');
            $this->pcommutedb->where('p2.place_name', $search_val);

        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        $this->pcommutedb->limit($row, $Offset);
        $this->pcommutedb->order_by('d.e_time_stamp', 'desc'); 

        $query = $this->pcommutedb->get();

        if ($query->num_rows() > 0){
            $this->row['data'] = $query->result_array();
            $this->row['all_row'] = $query_all_rows->num_rows();
            $this->row['num_row'] = $query->num_rows();
        }

        return $this->row;
    }

    function view_direction($id=array(), $row=10, $Offset=0){

        $this->pcommutedb->start_cache();
            $this->pcommutedb->select(' p1.place_id as location_id, p1.place_name as location_name, p1.coordinate as location_coordinate, p1.description as location_description, 
                                        p2.place_id as destination_id, p2.place_name as destination_name, p2.coordinate as destination_coordinate, p2.description as destination_description,
                                        d.direction_id, d.instruction, d.total_price, d.vehicle_list, s.like_count, s.dislike_count, s.share_count');
            $this->pcommutedb->from('directions d');
            $this->pcommutedb->join('socials s', 's.social_id = d.social_id');
            $this->pcommutedb->join('places p1', 'p1.place_id = d.location_id');
            $this->pcommutedb->join('places p2', 'p2.place_id = d.destination_id');
            $this->pcommutedb->where_in('d.direction_id', $id);

        $this->pcommutedb->stop_cache();

        $query_all_rows = $this->pcommutedb->get();

        $this->pcommutedb->limit($row, $Offset);
        $this->pcommutedb->order_by('d.e_time_stamp', 'desc'); 

        $query = $this->pcommutedb->get();

        if ($query->num_rows() > 0){
            $this->row['data'] = $query->result_array();
            $this->row['all_row'] = $query_all_rows->num_rows();
            $this->row['num_row'] = $query->num_rows();
        }

        return $this->row;
    }
}