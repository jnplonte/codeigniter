<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//for debuging
if ( ! function_exists('pc_print')){
	function pc_print($data_arr = array(), $exit = 0){
		
		if(is_array($data_arr) || is_object($data_arr)){
			echo '<pre>';
			print_r($data_arr);
			echo '</pre>';
		}else{
			echo $data_arr;
		}

		if($exit == 1){
			exit();
		}

		return;
	}
}


//load config data
if ( !function_exists('load_config_data')) {
	function load_config_data($name){
		$data = get_instance(); // CI_Loader instance
		$data->load->config($name);

		return $data;
	}	
	
}


//mas decode data 
if ( !function_exists('pc_decode')) {
	function pc_decode($data){

		$data_value = urldecode($data);

		if(is_fcking_json($data_value) == FALSE){
			return FALSE;
		}
		
		$final_data = json_decode($data_value);

		return (array)$final_data;
	}	
}


//check if json
if ( !function_exists('is_fcking_json')) {
	function is_fcking_json($string) {
		json_decode($string);
		if (json_last_error() == JSON_ERROR_NONE){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}


//convert to uppercase for transaction db
if ( !function_exists('convert_to_uppercase')) {
	function convert_to_uppercase($data) {
		
		function upercase($value){
            return strtoupper($value);
        }

		if(is_array($data)){
			$converted = array_map("upercase", $data);
		}else if(is_object($data)){
			$converted = array_map("upercase", (array)$data);
		}else{
			$converted = strtoupper($data);
		}

		return $converted;
	}
}


//get exec time
if ( !function_exists('get_exec_time')) {
	function get_exec_time($start_time) {
		$time_end = microtime(true);

		//return number_format(($time_end - $start_time), 2, '.', '');
		return ($time_end - $start_time);
	}
}