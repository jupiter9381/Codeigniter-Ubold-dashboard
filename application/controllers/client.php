<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("client_model", "client", true);
        if( !$this->session->has_userdata('user') )
            redirect('/user/login');
        
    }

    public function index(){
    	$clients = $this->client->get();
    	$tariff_names = $this->client->getTariffNames();
        $tariff_pl_names = $this->client->getTariffPlNames();
    	$destgroupnames = $this->client->getGroupNames();

        $header['user'] = $this->session->user;

    	$content['clients'] = $clients;
    	$content['tariff_names'] = $tariff_names;
        $content['tariff_pl_names'] = $tariff_pl_names;
    	$content['destgroupnames'] = $destgroupnames;
    	$content['tariff_name_az'] = $this->client->getTariffNameAz();
    	$content['groupid_pl'] = $this->client->getGroupIdPL();

        $this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('clients/index', $content );
        $this->load->view('templates/footer');
        $this->load->view('clients/script');
    }

    public function add(){
        $check_exist = $this->client->getByName($this->input->post('client_name'));
        if(strlen($this->input->post('client_name')) < 2){
            echo json_encode(array("error" => "client_length"));
        } else if(count($check_exist) > 0){
            echo json_encode(array("error" => "exist_client"));
        } else {
            $ip_address = $this->input->post('ip_address');
            $exist_address = array();
            for($i = 0; $i < count($ip_address); $i++){
                $check_ip = $this->client->check_ip_address($ip_address[$i], $this->input->post('client_name'));
                if(count($check_ip) > 0){
                    array_push($exist_address, $check_ip[0]);
                }
            }
            if(count($exist_address) > 0){
                echo json_encode(array("error" => "ip_address", "ip_address" => $exist_address));
            } else {
                if($this->input->post('active') == "on"){
                    $active = "1";
                } else {
                    $active = "0";
                }
                $tariff_name_AZ = "";
                if($this->input->post('tariff_name_AZ') != null){
                    $tariff_name_AZ = $this->input->post('tariff_name_AZ');
                }
                $client_data = array(
                    'client_name' => $this->input->post('client_name'),
                    'tariff_name' => $this->input->post('tariff_name'),
                    'destgroupname' => $this->input->post('destgroupname'),
                    'dr_groupid_PL' => $this->input->post('dr_groupid_PL'),
                    'tariff_name_AZ' => $tariff_name_AZ,
                    'dr_groupid_AZ' => $this->input->post('dr_groupid_AZ'),
                    'strip' => $this->input->post('strip'),
                    'strip_prefix' => $this->input->post('strip_prefix'),
                    'account_state' => $this->input->post('account_state'),
                    'calls_limit' => $this->input->post('calls_limit'),
                    'cps_limit' => $this->input->post('cps_limit'),
                    'zip_code' => $this->input->post('zip_code'),
                    'active' => $active,
                    "client_id" => ''
                );
                $this->client->add_client($client_data);
                
                $ip_address = $this->input->post('ip_address');
                if(count($ip_address) > 0){
                    $this->client->add_ip_address($ip_address, $this->input->post('client_name'));
                }
                echo json_encode(array("error" => "success")); 
            }
            
        }
    	
    }

    public function delete(){
    	$client_name = $this->input->post('client_name');
    	$this->client->delete($client_name);
    	echo json_encode(array("result" => "Deleted Successfully!"));
    }

    public function getByName(){
    	$client_name = $this->input->post('client_name');
    	$data = $this->client->getByName($client_name);
        $ip_address = $this->client->getIpAddress($client_name);
    	echo json_encode(array("client" => $data, "ip" => $ip_address));
    }

    public function update(){
        $ip_address = $this->input->post('ip_address');
        $exist_address = array();
        for($i = 0; $i < count($ip_address); $i++){
            $check_ip = $this->client->check_edit_ip_address($ip_address[$i], $this->input->post('client_name'));

            if(count($check_ip) > 0){
                array_push($exist_address, $check_ip[0]);
            }
        }
        if(count($exist_address) > 0){
            echo json_encode(array("error" => "ip_address", "ip_address" => $exist_address));
        } else {
            if($this->input->post('active') == "on"){
                $active = "1";
            } else {
                $active = "0";
            }
            $client_data = array(
                'client_name' => $this->input->post('client_name'),
                'tariff_name' => $this->input->post('tariff_name'),
                'destgroupname' => $this->input->post('destgroupname'),
                'dr_groupid_PL' => $this->input->post('dr_groupid_PL'),
                'tariff_name_AZ' => $this->input->post('tariff_name_AZ'),
                'dr_groupid_AZ' => $this->input->post('dr_groupid_AZ'),
                'strip' => $this->input->post('strip'),
                'strip_prefix' => $this->input->post('strip_prefix'),
                'account_state' => $this->input->post('account_state'),
                'calls_limit' => $this->input->post('calls_limit'),
                'cps_limit' => $this->input->post('cps_limit'),
                'zip_code' => $this->input->post('zip_code'),
                'active' => $active,
                "client_id" => $this->input->post('client_id')
            );

            $this->client->update_client($client_data, $this->input->post('client_id'));


            $ip_address = $this->input->post('ip_address');
            $this->client->update_ip_address($ip_address, $this->input->post('client_name'));
            echo json_encode(array("error" => "success")); 
        }
    }

    public function duplicate(){
        $client_name = $this->input->post('client_name');
        $client = $this->client->getByName($client_name);
        $client = $client[0];
        $client_data = array(
            'client_name' => $client->client_name,
            'tariff_name' => $client->tariff_name,
            'destgroupname' => $client->destgroupname,
            'dr_groupid_PL' => $client->dr_groupid_PL,
            'tariff_name_AZ' => $client->tariff_name_AZ,
            'dr_groupid_AZ' => $client->dr_groupid_AZ,
            'strip' => $client->strip,
            'strip_prefix' => $client->strip_prefix,
            'account_state' => $client->account_state,
            'calls_limit' => $client->calls_limit,
            'cps_limit' => $client->cps_limit,
            'zip_code' => $client->zip_code,
            'active' => $client->active,
            "client_id" => ''
        );
        $this->client->add_client($client_data);
        echo json_encode(array("result" => "Duplicated successfully!"));
    }
}