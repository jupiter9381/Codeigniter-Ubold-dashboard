<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("user_model", "user", true);
        /*if( !$this->session->has_userdata('user') )
            redirect('/user');*/
        
    }

    public function index(){
    	$users = $this->user->get();

        $header['user'] = $this->session->user;
        $content['users'] = $users;

        $this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('user/list', $content );
        $this->load->view('templates/footer');
        $this->load->view('user/script');
    }

    public function login(){
    	$this->load->view('user/login');
    }
    public function register(){
    	$this->load->view('user/register');
    }

    public function signin(){
    	$result = $this->user->login();
		if(count($result) == 0){
			$content['error'] = "Please make sure email address and password";
			$this->load->view('user/login', $content);
		} else {
            if($result[0]->allowed == '0'){
                $content['error'] = "You must wait until admin gives you permission.";
                $this->load->view('user/login', $content);
            } else {
                $this->session->set_userdata('user', $result[0]);
                if($result[0]->client_status[0] == '1')
                    redirect('/client');
                if($result[0]->gateway_status[0] == '1')
                    redirect('/gateway');
                if($result[0]->rule_status[0] == '1')
                    redirect('/rule');
                if($result[0]->cl_status[0] == '1')
                    redirect('/clrate');
                if($result[0]->gw_status[0] == '1')
                    redirect('/gwrate');
                $content['error'] = "You are not allowed to visit any page";
                $this->load->view('user/login', $content);
            }
			
		}
    }

    public function signup(){
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('username', 'Name', 'required');
		if ($this->form_validation->run() == FALSE){
            $this->load->view('user/register');
        } else {
			$this->user->signup();
			redirect('/user/login');
		}
	}

    public function logout(){
    	$this->session->sess_destroy();
		redirect('/user/login');
    }


    public function getById(){
        $id = $this->input->post('id');
        $user = $this->user->getById($id);
        echo json_encode($user[0]);
    }

    public function status_update(){
        $data = $this->input->post();
        $check_array = array();
        foreach ($data as $key => $value) {
            array_push($check_array, $key);
        }
        $client_view = in_array('client_view', $check_array) ? '1' : '0';
        $client_add = in_array('client_add', $check_array) ? '1' : '0';
        $client_edit = in_array('client_edit', $check_array) ? '1' : '0';
        $client_delete = in_array('client_delete', $check_array) ? '1' : '0';
        $client_duplicate = in_array('client_duplicate', $check_array) ? '1' : '0';
        $gateway_view = in_array('gateway_view', $check_array) ? '1' : '0';
        $gateway_add = in_array('gateway_add', $check_array) ? '1' : '0';
        $gateway_edit = in_array('gateway_edit', $check_array) ? '1' : '0';
        $gateway_delete = in_array('gateway_delete', $check_array) ? '1' : '0';
        $gateway_duplicate = in_array('gateway_duplicate', $check_array) ? '1' : '0';
        $rule_view = in_array('rule_view', $check_array) ? '1' : '0';
        $rule_add = in_array('rule_add', $check_array) ? '1' : '0';
        $rule_edit = in_array('rule_edit', $check_array) ? '1' : '0';
        $rule_delete = in_array('rule_delete', $check_array) ? '1' : '0';
        $rule_duplicate = in_array('rule_duplicate', $check_array) ? '1' : '0';
        $cl_view = in_array('cl_view', $check_array) ? '1' : '0';
        $cl_add = in_array('cl_add', $check_array) ? '1' : '0';
        $cl_edit = in_array('cl_edit', $check_array) ? '1' : '0';
        $cl_delete = in_array('cl_delete', $check_array) ? '1' : '0';
        $cl_duplicate = in_array('cl_duplicate', $check_array) ? '1' : '0';
        $gw_view = in_array('gw_view', $check_array) ? '1' : '0';
        $gw_add = in_array('gw_add', $check_array) ? '1' : '0';
        $gw_edit = in_array('gw_edit', $check_array) ? '1' : '0';
        $gw_delete = in_array('gw_delete', $check_array) ? '1' : '0';
        $gw_duplicate = in_array('gw_duplicate', $check_array) ? '1' : '0';

        $client_status = $client_view.$client_add.$client_edit.$client_delete.$client_duplicate;
        $gateway_status = $gateway_view.$gateway_add.$gateway_edit.$gateway_delete.$gateway_duplicate;
        $rule_status = $rule_view.$rule_add.$rule_edit.$rule_delete.$rule_duplicate;
        $cl_status = $cl_view.$cl_add.$cl_edit.$cl_delete.$cl_duplicate;
        $gw_status = $gw_view.$gw_add.$gw_edit.$gw_delete.$gw_duplicate;

        $permission = in_array('permission', $check_array) ? '1' : '0';

        $data = array(
            'client_status' => $client_status,
            'gateway_status' => $gateway_status,
            'rule_status' => $rule_status,
            'cl_status' => $cl_status,
            'gw_status' => $gw_status,
            'allowed' => $permission
        );
        $condition = array(
            'id' => $this->input->post('user_id')
        );
        $this->user->update_status($condition, $data);
        redirect('/user');
    }

    public function delete(){
        $user_id = $this->input->post('user_id');
        $this->user->delete($user_id);
        echo json_encode(array("result" => "Deleted Successfully!"));
    }

    public function dashboard(){
        $user = $this->session->user;
        if($user->client_status[0] == '1')
            redirect('/client');
        if($user->gateway_status[0] == '1')
            redirect('/gateway');
        if($user->rule_status[0] == '1')
            redirect('/rule');
        if($user->cl_status[0] == '1')
            redirect('/clrate');
        if($user->gw_status[0] == '1')
            redirect('/gwrate');
    }
}