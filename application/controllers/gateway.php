<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gateway extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("gateway_model", "gateway", true);
        if( !$this->session->has_userdata('user') )
            redirect('/user/login');
        
    }

    public function index(){
        $header['user'] = $this->session->user;

    	$gateways = $this->gateway->get();
    	$tariff_names = $this->gateway->getTariffNames();
        $tariff_pl_names = $this->gateway->getTariffPlNames();
    	$destgroupnames = $this->gateway->getGroupNames();

    	$content['gateways'] = $gateways;
    	$content['tariff_names'] = $tariff_names;
        $content['tariff_pl_names'] = $tariff_pl_names;
    	$content['destgroupnames'] = $destgroupnames;

    	$this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('gateways/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('gateways/script');
    }

    public function add(){
        $check_exist = $this->gateway->getByName($this->input->post('gw_name'));
        if(strlen($this->input->post('gw_name')) < 2){
            echo json_encode(array("error" => "gateway_length"));
        } else if(count($check_exist) > 0){
            echo json_encode(array("error" => "exist_gateway"));
        } else if($this->input->post('ip_address') == ""){
            echo json_encode(array("error" => "gateway_ip"));
        } else {
            if($this->input->post('active') == "on"){
                $active = "1";
            } else {
                $active = "0";
            }

            $gateway_data = array(
                'gw_name' => $this->input->post('gw_name'),
                'tariff_name' => $this->input->post('tariff_name'),
                'destgroupname' => $this->input->post('destgroupname'),
                'account_state' => $this->input->post('account_state'),
                'calls_limit' => $this->input->post('calls_limit'),
                'cps_limit' => $this->input->post('cps_limit'),
                'active' => $active,
                "gw_id" => ''
            );

            $data = array(
                'gwid' => $this->input->post('gw_name'),
                'type' => $this->input->post('type'),
                'address' => $this->input->post('ip_address'),
                'strip' => $this->input->post('strip'),
                'pri_prefix' => $this->input->post('pri_prefix'),
                'attrs' => $this->input->post('attrs'),
                'probe_mode' => $this->input->post('probe_mode'),
                'state' => $this->input->post('state'),
                'socket' => $this->input->post('socket'),
                'description' => $this->input->post('description')
            );

            $this->gateway->add_gateway($gateway_data, $data);
            echo json_encode(array("error" => "success")); 
            
        }
    }

    public function getByName(){
    	$gateway_name = $this->input->post('gateway_name');
    	$data = $this->gateway->getByName($gateway_name);
        $data1 = $this->gateway->getByName1($gateway_name);
    	echo json_encode(array("gateway" => $data, "gateway1" => $data1 ));
    }

    public function update(){
        if($this->input->post('active') == "on"){
            $active = "1";
        } else {
            $active = "0";
        }
        $gateway_data = array(
            'gw_name' => $this->input->post('gw_name'),
            'tariff_name' => $this->input->post('tariff_name'),
            'destgroupname' => $this->input->post('destgroupname'),
            'account_state' => $this->input->post('account_state'),
            'calls_limit' => $this->input->post('calls_limit'),
            'cps_limit' => $this->input->post('cps_limit'),
            'active' => $active,
            "gw_id" => $this->input->post('gw_id')
        );

        $this->gateway->update_gateway($gateway_data, $this->input->post('gw_id'));

        $data = array(
            'gwid' => $this->input->post('gw_name'),
            'type' => $this->input->post('type'),
            'address' => $this->input->post('ip_address'),
            'strip' => $this->input->post('strip'),
            'pri_prefix' => $this->input->post('pri_prefix'),
            'attrs' => $this->input->post('attrs'),
            'probe_mode' => $this->input->post('probe_mode'),
            'state' => $this->input->post('state'),
            'socket' => $this->input->post('socket'),
            'description' => $this->input->post('description')
        );
        $this->gateway->update_gateway1($data, $this->input->post('gw_name'));
        redirect('/gateway');
    }

    public function delete(){
    	$gateway_name = $this->input->post('gateway_name');
    	$this->gateway->delete($gateway_name);
    	echo json_encode(array("result" => "Deleted Successfully!"));
    }
}