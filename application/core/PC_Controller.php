<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//nsa autoload func ng config.php 
//require_once  APPPATH.'/libraries/rest.php';

class PC_Controller extends Rest{

	public function __construct() {
		parent::__construct();
        $this->time_start = microtime(true); 

        $this->data = '';
	}

    function get_data($curl_url = null, $module='pcommute', $is_request = 'GET', $post_param = array()){

        if(!empty($curl_url)){

            $result = '';
            
            $module_value = $this->config->item($module);

            if(!empty($module_value['key'])){
                $headers = array('PCOMMUTE-API-KEY: '.$module_value['key']);
            }

            if(!empty($module_value['username']) || !empty($module_value['password'])){
                $username = $module_value['username'];
                $password = $module_value['password'];
            }
            
            // Set up and execute the curl process
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $curl_url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $is_request);

            if(strtolower($is_request) == 'post'){
                $fields_string  = '';
                foreach($post_param as $key => $value) { 
                    $fields_string .= $key.'='.$value.'&'; 
                }
                
                rtrim($fields_string, '&');

                curl_setopt($curl_handle, CURLOPT_POST, count($post_param));
                curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $fields_string);
            }

            if(!empty($module_value['key'])){
                curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
            }

            if(!empty($module_value['username']) || !empty($module_value['password'])){
                curl_setopt($curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($curl_handle, CURLOPT_USERPWD, $username . ':' . $password);
            }

            $result = curl_exec($curl_handle);
            
            if($result === FALSE){
                $err = array('status' => false, 'error' => curl_error($curl_handle));
                curl_close($curl_handle);

                return json_encode($err);
            }else{
                curl_close($curl_handle);

                return $result;
            }
        }
    }
}