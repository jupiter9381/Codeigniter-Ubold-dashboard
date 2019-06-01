<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rule extends Base_Controller {

	public function __construct(){
        parent::__construct();
		$this->load->helper('form', 'url');
		$this->load->library('form_validation');
		$this->load->model("rule_model", "rule", true);
        if( !$this->session->has_userdata('user') )
            redirect('/user/login');
        
    }

    public function index(){
    	$rules = array();
    	$groupids = $this->rule->getGroupIDs();
    	$gwlists = $this->rule->getGwlists();

        $header['user'] = $this->session->user;

        if(isset($_SESSION['rule_gid'])){
            $content['rule_gid'] = $_SESSION['rule_gid'];
            $content['rule_prefix'] = $_SESSION['rule_prefix'];
            $content['rule_gwlist'] = $_SESSION['rule_gwlist'];
            $rules = $this->rule->search($content['rule_gid'], $content['rule_prefix'], $content['rule_gwlist']);
        } else {
            $content['rule_gid'] = "";
            $content['rule_prefix'] = "";
            $content['rule_gwlist'] = "";
            $rules = array();
        }
    	$content['rules'] = $rules;
    	$content['groupids'] = $groupids;
    	$content['gwlists'] = $gwlists;

    	$this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('rules/index', $content);
        $this->load->view('templates/footer');
        $this->load->view('rules/script');
    }

    public function search(){
        $header['user'] = $this->session->user;

        $groupid = $this->input->post('search_groupid');
        $gwlist = $this->input->post('search_gwlist');
        $prefix = $this->input->post('search_prefix');
        $rules = $this->rule->search($groupid, $prefix, $gwlist);

        $groupids = $this->rule->getGroupIDs();
        $gwlists = $this->rule->getGwlists();

        $this->session->set_userdata('rule_gid', $groupid);
        $this->session->set_userdata('rule_prefix', $prefix);
        $this->session->set_userdata('rule_gwlist', $gwlist);

        $search_data = array(
            "groupid" => $groupid,
            "gwlist" => $gwlist,
            "prefix" => $prefix
        );
        $content['rules'] = $rules;
        $content['groupids'] = $groupids;
        $content['gwlists'] = $gwlists;
        $content['search'] = $search_data;

        $this->load->view('templates/header', $header);
        $this->load->view('templates/aside' );
        $this->load->view('rules/search', $content);
        $this->load->view('templates/footer');
        $this->load->view('rules/script');
    }
    public function add(){
        $data = array(
            'ruleid' => '',
            'groupid' => $this->input->post('groupid'),
            'prefix' => $this->input->post('prefix'),
            'timerec' => $this->input->post('timerec'),
            'priority' => $this->input->post('priority'),
            'routeid' => $this->input->post('routeid'),
            'gwlist' => $this->input->post('gwlist'),
            'attrs' => $this->input->post('attrs'),
            'description' => $this->input->post('description')
        );

        $this->rule->add_rule($data);

        $this->session->set_userdata('rule_gid', $this->input->post('groupid'));
        $this->session->set_userdata('rule_prefix', $this->input->post('prefix'));
        $this->session->set_userdata('rule_gwlist', $this->input->post('gwlist'));

        redirect('/rule');

    }

    public function getByRuleId(){
    	$rule_id = $this->input->post('rule_id');
    	$data = $this->rule->getByRuleId($rule_id);
    	echo json_encode(array("rule" => $data ));
    }

    public function update(){
        $rule_data = array(
            'groupid' => $this->input->post('groupid'),
            'prefix' => $this->input->post('prefix'),
            'timerec' => $this->input->post('timerec'),
            'priority' => $this->input->post('priority'),
            'routeid' => $this->input->post('routeid'),
            'gwlist' => $this->input->post('gwlist'),
            'attrs' => $this->input->post('attrs'),
            'description' => $this->input->post('description'),
            "ruleid" => $this->input->post('ruleid')
        );

        $this->rule->update_rule($rule_data, $this->input->post('ruleid'));

        $this->session->set_userdata('rule_gid', $this->input->post('groupid'));
        $this->session->set_userdata('rule_prefix', $this->input->post('prefix'));
        $this->session->set_userdata('rule_gwlist', $this->input->post('gwlist'));
        
        redirect('/rule');
    }

    public function delete(){
    	$rule_id = $this->input->post('rule_id');
    	$this->rule->delete($rule_id);
    	echo json_encode(array("result" => "Deleted Successfully!"));
    }
}