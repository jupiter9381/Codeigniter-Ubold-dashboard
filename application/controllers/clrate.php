<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clrate extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("clrate_model", "clrate", true);
        if( !$this->session->has_userdata('user') )
            redirect('/user/login');
        
    }

    public function index(){
        $header['user'] = $this->session->user;
        $rates = array();
        if(isset($_SESSION['tariffname'])){
            $content['tariffname'] = $_SESSION['tariffname'];
            $content['prefix'] = $_SESSION['prefix'];
            $content['check_desc'] = $_SESSION['check_desc'];
            $content['desc'] = $_SESSION['desc'];
            $content['custom_desc'] = $_SESSION['custom_desc'];
            if($content['check_desc'] == "1")
                $tariffdesc = $content['desc'];
            else 
                $tariffdesc = $content['custom_desc'];
            $rates = $this->clrate->search($_SESSION['tariffname'], $_SESSION['prefix'], $tariffdesc);

        } else {
            $rates = array();
            $content['tariffname'] = "";
            $content['prefix'] = "";
            $content['check_desc'] = "1";
            $content['desc'] = "";
            $content['custom_desc'] = "";
        }
        
    	$tariffnames = $this->clrate->getTariffnames();
        $tariffdescs = $this->clrate->getTariffdescs();

    	$content['rates'] = $rates;
        
    	$content['tariffnames'] = $tariffnames;
        $content['tariffdescs'] = $tariffdescs;
        

    	$this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('clrates/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('clrates/script');
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


        $this->session->set_userdata('tariffname', $tariffname);
        $this->session->set_userdata('prefix', $prefix);
        $this->session->set_userdata('check_desc', $check_desc);
        $this->session->set_userdata('desc', $desc);
        $this->session->set_userdata('custom_desc', $custom_desc);

        $rates = $this->clrate->search($tariffname, $prefix, $tariffdesc);

        $tariffnames = $this->clrate->getTariffnames();
        $tariffdescs = $this->clrate->getTariffdescs();

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
        $this->load->view('clrates/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('clrates/script');
    }
    public function add(){
        $check_exist = $this->clrate->check($this->input->post('tariffname'), $this->input->post('prefix'), $this->input->post('date'));
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
                'cost_margin' => $this->input->post('cost_margin'),
                'cost_margin_conn' => $this->input->post('cost_margin_conn')
            );


            $this->clrate->add_clrate($data);

            $this->session->set_userdata('tariffname', $this->input->post('tariffname'));
            $this->session->set_userdata('prefix', $this->input->post('prefix'));
            $this->session->set_userdata('check_desc', '1');
            $this->session->set_userdata('desc', $this->input->post('tariffdesc'));
            $this->session->set_userdata('custom_desc', "");

            $result = array("error" => "success");
            echo json_encode($result);
        }
        

        //redirect('/clrate');

    }

    public function getByRateId(){
    	$rate_id = $this->input->post('rate_id');
    	$data = $this->clrate->getByRateId($rate_id);
    	echo json_encode(array("result" => $data ));
    }

    public function update(){
        $check_exist = $this->clrate->check($this->input->post('tariffname'), $this->input->post('prefix'), $this->input->post('date'));

        if(count($check_exist) > 0){
            $result = array("error" => "exist_clrate");
            echo json_encode($result);
        } else { 
            $clrate_data = array(
                'tariffname' => $this->input->post('tariffname'),
                'prefix' => $this->input->post('prefix'),
                'tariffdesc' => $this->input->post('tariffdesc'),
                'date' => $this->input->post('date'),
                'rate' => $this->input->post('rate'),
                'rate_conn' => $this->input->post('rate_conn'),
                'cost_margin' => $this->input->post('cost_margin'),
                'cost_margin_conn' => $this->input->post('cost_margin_conn')
            );

            $this->clrate->update_clrate($clrate_data, $this->input->post('id'));

            $this->session->set_userdata('tariffname', $this->input->post('tariffname'));
            $this->session->set_userdata('prefix', $this->input->post('prefix'));
            $this->session->set_userdata('check_desc', '1');
            $this->session->set_userdata('desc', $this->input->post('tariffdesc'));
            $this->session->set_userdata('custom_desc', "");

            $result = array("error" => "success");
            
            echo json_encode($result);
        }
    }

    public function delete(){
    	$rate_id = $this->input->post('rate_id');
    	$this->clrate->delete($rate_id);
    	echo json_encode(array("result" => "Deleted Successfully!"));
    }
}