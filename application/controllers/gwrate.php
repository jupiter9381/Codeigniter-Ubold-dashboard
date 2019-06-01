<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gwrate extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("gwrate_model", "gwrate", true);
        if( !$this->session->has_userdata('user') )
            redirect('/user/login');
        
    }

    public function index(){
        $header['user'] = $this->session->user;

        $rates = array();
        if(isset($_SESSION['gw_tariffname'])){
            $content['tariffname'] = $_SESSION['gw_tariffname'];
            $content['prefix'] = $_SESSION['gw_prefix'];
            $content['check_desc'] = $_SESSION['gw_check_desc'];
            $content['desc'] = $_SESSION['gw_desc'];
            $content['custom_desc'] = $_SESSION['gw_custom_desc'];
            if($content['check_desc'] == "1")
                $tariffdesc = $content['desc'];
            else 
                $tariffdesc = $content['custom_desc'];
            $rates = $this->gwrate->search($_SESSION['gw_tariffname'], $_SESSION['gw_prefix'], $tariffdesc);

        } else {
            $rates = array();
            $content['tariffname'] = "";
            $content['prefix'] = "";
            $content['check_desc'] = "1";
            $content['desc'] = "";
            $content['custom_desc'] = "";
        }
    	$tariffnames = $this->gwrate->getTariffnames();
        $tariffdescs = $this->gwrate->getTariffdescs();

        $content['rates'] = $rates;
        

    	$content['rates'] = $rates;
    	$content['tariffnames'] = $tariffnames;
        $content['tariffdescs'] = $tariffdescs;

    	$this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('gwrates/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('gwrates/script');
    }

    public function search(){
        $header['user'] = $this->session->user;

        $tariffname = $this->input->post('search_tariffname');
        $prefix = $this->input->post('search_prefix');
        $check_desc = $this->input->post('check_desc');
        $custom_desc = $this->input->post('search_customtariffdesc');
        $desc = $this->input->post('search_tariffdesc');

        if($check_desc == "1")
            $tariffdesc = $this->input->post('search_tariffdesc');
        else 
            $tariffdesc = $this->input->post('search_customtariffdesc');

        $this->session->set_userdata('gw_tariffname', $tariffname);
        $this->session->set_userdata('gw_prefix', $prefix);
        $this->session->set_userdata('gw_check_desc', $check_desc);
        $this->session->set_userdata('gw_desc', $desc);
        $this->session->set_userdata('gw_custom_desc', $custom_desc);

        $rates = $this->gwrate->search($tariffname, $prefix, $tariffdesc);

        $tariffnames = $this->gwrate->getTariffnames();
        $tariffdescs = $this->gwrate->getTariffdescs();

        $content['tariffname'] = $tariffname;
        $content['prefix'] = $prefix;
        $content['check_desc'] = $check_desc;
        if($check_desc == "1"){
            $content['desc'] = $desc;
            $content['custom_desc'] = "";
        } else {
            $content['desc'] = "";
            $content['custom_desc'] = $custom_desc;
        }

        $content['rates'] = $rates;
        $content['tariffnames'] = $tariffnames;
        $content['tariffdescs'] = $tariffdescs;

        $this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('gwrates/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('gwrates/script');
    }
    public function add(){
        $check_exist = $this->gwrate->check($this->input->post('tariffname'), $this->input->post('prefix'), $this->input->post('date'));

        if(count($check_exist) > 0){
            $result = array("error" => "exist_clrate");
            echo json_encode($result);
        } else { 
            $data = array(
                'id' => '',
                'tariffname' => $this->input->post('tariffname'),
                'prefix' => $this->input->post('prefix'),
                'tariffdesc' => $this->input->post('tariffdesc'),
                'date' => $this->input->post('date'),
                'rate' => $this->input->post('rate'),
                'rate_conn' => $this->input->post('rate_conn'),
            );


            $this->gwrate->add_gwrate($data);

            $this->session->set_userdata('gw_tariffname', $this->input->post('tariffname'));
            $this->session->set_userdata('gw_prefix', $this->input->post('prefix'));
            $this->session->set_userdata('gw_check_desc', '1');
            $this->session->set_userdata('gw_desc', $this->input->post('tariffdesc'));
            $this->session->set_userdata('gw_custom_desc', "");


            $result = array("error" => "success");
            
            echo json_encode($result);
        }

    }

    public function getByRateId(){
    	$rate_id = $this->input->post('rate_id');
    	$data = $this->gwrate->getByRateId($rate_id);
    	echo json_encode(array("result" => $data ));
    }

    public function update(){
        $check_exist = $this->gwrate->check($this->input->post('tariffname'), $this->input->post('prefix'), $this->input->post('date'));

        if(count($check_exist) > 0){
            $result = array("error" => "exist_clrate");
            echo json_encode($result);
        } else { 
            $gwrate_data = array(
                'tariffname' => $this->input->post('tariffname'),
                'prefix' => $this->input->post('prefix'),
                'tariffdesc' => $this->input->post('tariffdesc'),
                'date' => $this->input->post('date'),
                'rate' => $this->input->post('rate'),
                'rate_conn' => $this->input->post('rate_conn'),
            );

            $this->gwrate->update_gwrate($gwrate_data, $this->input->post('id'));

            $this->session->set_userdata('gw_tariffname', $this->input->post('tariffname'));
            $this->session->set_userdata('gw_prefix', $this->input->post('prefix'));
            $this->session->set_userdata('gw_check_desc', '1');
            $this->session->set_userdata('gw_desc', $this->input->post('tariffdesc'));
            $this->session->set_userdata('gw_custom_desc', "");


            $result = array("error" => "success");
            
            echo json_encode($result);

        }
        

    }

    public function delete(){
    	$rate_id = $this->input->post('gw_id');
    	$this->gwrate->delete($rate_id);
    	echo json_encode(array("result" => "Deleted Successfully!"));
    }
}