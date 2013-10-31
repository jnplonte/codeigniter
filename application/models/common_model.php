<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends PC_Model {

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function check_value($value=array(), $col=NULL, $table=NULL, $db=NULL){

        if(empty($value) || empty($col) || empty($table) || empty($db)){
            return FALSE;
        }

        $this->{$db}->select($col);
    	$this->{$db}->from($table);
    	$this->{$db}->where_in($col, $value);

    	$query = $this->{$db}->get();
    	
    	if ($query->num_rows() > 0){
    		return TRUE;
		}else{
			return FALSE;
		}
    }

    function get_value($select=array(), $value=array(), $col=NULL, $table=NULL, $db=NULL, $is_internal=FALSE){

        $this->{$db}->select($select);
        $this->{$db}->from($table);

        if(is_array($value)){
            $this->{$db}->where_in($col, $value);
        }else{
            $this->{$db}->where($col, $value);
        }

        $query = $this->{$db}->get();

        if ($query->num_rows() > 0){
            if($is_internal){
                foreach ($query->result() as $key => $value) {
                    if(is_array($select)){
                        foreach ($select as $k => $v) {
                            $this->row[$v] = $value->{$v};
                        }
                    }else{
                        $this->row[$select] = $value->{$select};
                    }
                } 
            }else{
                $this->row['data'] = $query->result();
                $this->row['num_row'] = $query->num_rows();
            }
        }

        return $this->row;
    }
}