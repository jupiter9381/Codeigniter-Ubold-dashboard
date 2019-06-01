<?php
class Gateway_model extends CI_Model {
	public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get(){
        $this->db->select('*');
        $this->db->from('add_gateways');
        $this->db->join('dr_gateways', 'dr_gateways.gwid = add_gateways.gw_name');  
        $this->db->order_by('gw_name');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTariffPlNames(){
    	$this->db->select("DISTINCT(tariffname) tariffname");
    	$this->db->from('add_gw_rates');
    	$query = $this->db->get();
        return $query->result();
    }

    public function getTariffNames(){
        $this->db->select("DISTINCT(tariffname) tariffname");
        $this->db->from('add_gw_rates_pl');
        $query = $this->db->get();
        return $query->result();
    }
    public function getGroupNames(){
    	$this->db->select("DISTINCT(destgroupname) name");
    	$this->db->from('add_destinations_pl');
        $query = $this->db->get();
        return $query->result();
    }

    public function add_gateway($data, $data1){
    	$this->db->insert('add_gateways', $data);
        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_gateways',
            'type' => 'insert',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        $this->db->insert('dr_gateways', $data1);

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_gateways',
            'type' => 'insert',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);
        return;
    }

    public function getByName($name){
    	$this->db->select('*');
        $this->db->from('add_gateways');
        $this->db->where('gw_name', $name);
        $query = $this->db->get();
        return $query->result();
    }

    public function getByName1($name){
        $this->db->select('*');
        $this->db->from('dr_gateways');
        $this->db->where('gwid', $name);
        $query = $this->db->get();
        return $query->result();
    }

    public function update_gateway($data, $gateway_id){
        $condition = array(
            'gw_id' => $gateway_id
        );
        $this->db->set($data);
        $this->db->where($condition);
        $this->db->update('add_gateways');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_gateways',
            'type' => 'update',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }

    public function update_gateway1($data, $gateway_name){
        $condition = array(
            'gwid' => $gateway_name
        );
        $this->db->set($data);
        $this->db->where($condition);
        $this->db->update('dr_gateways');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_gateways',
            'type' => 'update',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);
        return;
    }

    public function delete($name){
    	$condition = array(
            'gw_name' => $name
        );
        $this->db->where($condition);
        $this->db->delete('add_gateways');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_gateways',
            'type' => 'delete',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        $condition = array(
            'gwid' => $name
        );
        $this->db->where($condition);
        $this->db->delete('dr_gateways');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_gateways',
            'type' => 'delete',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);
        
        return;
    }
}