<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//call variable
//$this->config->item('variable');


//main error
$config['error_1001'] 	= array('status' => false, 'error' => array('code' => '1001', 'name' => 'Parameter is not a valid json format on.'));
$config['error_1002'] 	= array('status' => false, 'error' => array('code' => '1002', 'name' => 'No data found.'));
$config['error_1003'] 	= array('status' => false, 'error' => array('code' => '1003', 'name' => 'Invalid Required Parameters.'));
$config['error_1004'] 	= array('status' => false, 'error' => array('code' => '1004', 'name' => 'Invalid Data.'));
$config['error_1007'] 	= array('status' => false, 'error' => array('code' => '1007', 'name' => 'Failed to Update Data.'));
$config['error_1008'] 	= array('status' => false, 'error' => array('code' => '1008', 'name' => 'Failed to Create Data.'));
$config['error_1010'] 	= array('status' => false, 'error' => array('code' => '1010', 'name' => 'Failed to Delete Data.'));


//process like /dislike
$config['error_1005'] 	= array('status' => false, 'error' => array('code' => '1005', 'name' => 'IP already Exists.'));
$config['error_1006'] 	= array('status' => false, 'error' => array('code' => '1006', 'name' => 'IP Insert Failed.'));


//api key
$config['error_1009'] 	= array('status' => false, 'error' => array('code' => '1009', 'name' => 'Invalid API Key.'));


//users
$config['error_1011'] 	= array('status' => false, 'error' => array('code' => '1011', 'name' => 'Invalid Username.'));
$config['error_1012'] 	= array('status' => false, 'error' => array('code' => '1012', 'name' => 'Invalid Password.'));

/* End of file config.php */
/* Location: ./application/config/error.php */
