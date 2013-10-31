<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Key extends PC_Controller{

	//level api level access 
	//limit limit of api can create
	protected $methods = array(
		'generate_get' => array('level' => 10, 'limit' => 10),

		'delete_post' => array('level' => 10),
		'update_level_post' => array('level' => 10),
		'suspend_post' => array('level' => 10),
		'activate_post' => array('level' => 10),
		'regenerate_post' => array('level' => 10)
	);

	//insert key
	public function generate_get(){
		// Build a new key
		$key = self::_generate_key();

		// If no key level provided, give them a rubbish one
		$level = ($this->get('level')) ? $this->get('level') : 1;
		$ignore_limits = ($this->get('ignore_limits')) ? $this->get('ignore_limits') : 1;

		// Insert the new key
		if (self::_insert_key($key, array('level' => $level, 'ignore_limits' => $ignore_limits))){
			$this->data['status'] = true;
			$this->data['data']['success'] = $key.' API Key was created.';
            $this->response($this->data, 201); // 201 = Created
		}else{
			$this->response($this->config->item('error_1008'), 404);
		}
    }

    //delete Key
	public function delete_post(){

		if(!$this->post('key')){
            $this->response($this->config->item('error_1003'), 400);
        }

		$key = $this->post('key');

		// Does this key even exist?
		if (!self::_key_exists($key)){
			$this->response($this->config->item('error_1009'), 400);
		}

		// Kill it
		if (self::_delete_key($key)){
			// Tell em we killed it
			$this->data['status'] = true;
			$this->data['data']['success'] = $key.' API Key was deleted.';
	        $this->response($this->data, 200);
		}else{
			$this->response($this->config->item('error_1010'), 404);
		}
    }

	//Update level Key
	public function update_level_post(){

		if(!$this->post('key') || !$this->post('level')){
            $this->response($this->config->item('error_1003'), 400);
        }

		$key 		= $this->post('key');
		$new_level 	= $this->post('level');

		// Does this key even exist?
		if ( ! self::_key_exists($key)){
			$this->response($this->config->item('error_1009'), 400);
		}

		// Update the key level
		if (self::_update_key($key, array('level' => $new_level))){
			$this->data['status'] = true;
			$this->data['data']['success'] = $key.' API Key was updated.';
	        $this->response($this->data, 200);
		}else{
			$this->response($this->config->item('error_1007'), 404);
		}
    }

	//suspend key Key
	public function suspend_post(){

		if(!$this->post('key')){
            $this->response($this->config->item('error_1003'), 400);
        }

		$key = $this->post('key');

		// Does this key even exist?
		if ( ! self::_key_exists($key)){
			$this->response($this->config->item('error_1009'), 400);
		}

		// Update the key level
		if (self::_update_key($key, array('level' => 0))){
			$this->data['status'] = true;
			$this->data['data']['success'] = $key.' Key was suspended.';
	        $this->response($this->data, 200);
		}else{
			$this->response($this->config->item('error_1007'), 404);
		}
    }

    //suspend key Key
	public function activate_post(){

		if(!$this->post('key')){
            $this->response($this->config->item('error_1003'), 400);
        }

		$key = $this->post('key');

		// Does this key even exist?
		if ( ! self::_key_exists($key)){
			$this->response($this->config->item('error_1009'), 400);
		}

		// Update the key level
		if (self::_update_key($key, array('level' => 1))){
			$this->data['status'] = true;
			$this->data['data']['success'] = $key.' Key was activated.';
	        $this->response($this->data, 200);
		}else{
			$this->response($this->config->item('error_1007'), 404);
		}
    }

	// Regenerate Key
	public function regenerate_post(){

		if(!$this->post('key')){
            $this->response($this->config->item('error_1003'), 400);
        }

		$old_key = $this->post('key');
		$key_details = self::_get_key($old_key);

		// The key wasnt found
		if ( ! $key_details){
			$this->response($this->config->item('error_1009'), 400);
		}

		// Build a new key
		$new_key = self::_generate_key();

		// Insert the new key
		if (self::_insert_key($new_key, array('level' => $key_details->level, 'ignore_limits' => $key_details->ignore_limits))){
			// Suspend old key
			self::_update_key($old_key, array('level' => 0));

			$this->data['status'] = true;
			$this->data['data']['success'] = $new_key.' API Key was regenerate.';
            $this->response($this->data, 201); // 201 = Created

		}else{
			$this->response($this->config->item('error_1008'), 404);
		}
    }


	// --------------------------------------------------------------------
	/* Helper Methods */
	private function _generate_key(){
		do{
			$salt = do_hash(time().mt_rand());
			$new_key = substr($salt, 0, config_item('rest_key_length'));
		}

		// Already in the DB? Fail. Try again
		while (self::_key_exists($new_key));

		return $new_key;
	}

	// --------------------------------------------------------------------=
	/* Private Data Methods */
	private function _get_key($key){
		return $this->db->where(config_item('rest_key_column'), $key)->get(config_item('rest_keys_table'))->row();
	}

	// --------------------------------------------------------------------
	private function _key_exists($key){
		return $this->db->where(config_item('rest_key_column'), $key)->count_all_results(config_item('rest_keys_table')) > 0;
	}

	// --------------------------------------------------------------------
	private function _insert_key($key, $data){
		
		$data[config_item('rest_key_column')] = $key;
		//$data['date_created'] = function_exists('now') ? now() : time();

		return $this->db->set($data)->insert(config_item('rest_keys_table'));
	}

	// --------------------------------------------------------------------
	private function _update_key($key, $data){
		return $this->db->where(config_item('rest_key_column'), $key)->update(config_item('rest_keys_table'), $data);
	}

	// --------------------------------------------------------------------
	private function _delete_key($key){
		return $this->db->where(config_item('rest_key_column'), $key)->delete(config_item('rest_keys_table'));
	}
}
