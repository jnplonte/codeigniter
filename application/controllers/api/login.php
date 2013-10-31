<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends PC_Controller{

    //level api level access 
    //limit limit of api can create
    protected $methods = array(
        'create_post' => array('level' => 10, 'limit' => 10),
        'delete_post' => array('level' => 10),
        'update_pword_post' => array('level' => 10),
        'suspend_post' => array('level' => 10),
        'activate_post' => array('level' => 10)
    );

    //insert users
    public function create_post(){
        
        if(!$this->post('uname') || !$this->post('pword')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $uname  = trim($this->post('uname'));
        $pword  = trim($this->post('pword'));

        if (self::_username_exists($uname)){
            $this->response($this->config->item('error_1011'), 400);
        }

        // Update the key level
        if (self::_insert_login($uname, $pword)){
            $this->data['status'] = true;
            $this->data['data']['success'] = $uname.' was created.';
            $this->response($this->data, 200);
        }else{
            $this->response($this->config->item('error_1007'), 404);
        }
    }

    //delete users
    public function delete_post(){

        if(!$this->post('uname')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $uname  = trim($this->post('uname'));

        // Does this key even exist?
        if (!self::_username_exists($uname)){
            $this->response($this->config->item('error_1011'), 400);
        }

        // Kill it
        if (self::_delete_login($uname)){
            // Tell em we killed it
            $this->data['status'] = true;
            $this->data['data']['success'] = $uname.' was deleted.';
            $this->response($this->data, 200);
        }else{
            $this->response($this->config->item('error_1010'), 404);
        }
    }

    //Update password users
    public function update_pword_post(){

        if(!$this->post('uname') || !$this->post('pword') || !$this->post('npword')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $uname  = trim($this->post('uname'));
        $pword  = trim($this->post('pword'));
        $npword  = trim($this->post('npword'));

        $uname_details = self::_get_user($uname);

        if ( ! $uname_details){
            $this->response($this->config->item('error_1011'), 400);
        }

        if($pword != $uname_details->{config_item('rest_login_pass_column')}){
            $this->response($this->config->item('error_1012'), 400);
        }

        // Update the key level
        if (self::_update_login($uname, array(config_item('rest_login_pass_column') => $npword))){
            $this->data['status'] = true;
            $this->data['data']['success'] = $uname.' was updated.';
            $this->response($this->data, 200);
        }else{
            $this->response($this->config->item('error_1007'), 404);
        }
    }

    //suspend users
    public function suspend_post(){

        if(!$this->post('uname')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $uname  = trim($this->post('uname'));

        // Does this key even exist?
        if (!self::_username_exists($uname)){
            $this->response($this->config->item('error_1011'), 400);
        }

        // Update the key level
        if (self::_update_login($uname, array('active' => 0))){
            $this->data['status'] = true;
            $this->data['data']['success'] = $uname.' was suspended.';
            $this->response($this->data, 200);
        }else{
            $this->response($this->config->item('error_1007'), 404);
        }
    }

    //activate users
    public function activate_post(){

        if(!$this->post('uname')){
            $this->response($this->config->item('error_1003'), 400);
        }

        $uname  = trim($this->post('uname'));

        // Does this key even exist?
        if (!self::_username_exists($uname)){
            $this->response($this->config->item('error_1011'), 400);
        }

        // Update the key level
        if (self::_update_login($uname, array('active' => 1))){
            $this->data['status'] = true;
            $this->data['data']['success'] = $uname.' was activated.';
            $this->response($this->data, 200);
        }else{
            $this->response($this->config->item('error_1007'), 404);
        }
    }



    // --------------------------------------------------------------------=
    /* Private Data Methods */
    private function _get_user($uname){
        return $this->db->where(config_item('rest_login_user_column'), $uname)->get(config_item('rest_login_table'))->row();
    }

    // --------------------------------------------------------------------
    private function _username_exists($uname){
        return $this->db->where(config_item('rest_login_user_column'), $uname)->count_all_results(config_item('rest_login_table')) > 0;
    }

    // --------------------------------------------------------------------
    private function _insert_login($uname, $pword){
        $data[config_item('rest_login_user_column')] = $uname;
        $data[config_item('rest_login_pass_column')] = $pword;
        $data['active'] = 1;
        return $this->db->set($data)->insert(config_item('rest_login_table'));
    }

    // --------------------------------------------------------------------
    private function _update_login($uname, $data){
        return $this->db->where(config_item('rest_login_user_column'), $uname)->update(config_item('rest_login_table'), $data);
    }

    // --------------------------------------------------------------------
    private function _delete_login($uname){
        return $this->db->where(config_item('rest_login_user_column'), $uname)->delete(config_item('rest_login_table'));
    }

    
}
