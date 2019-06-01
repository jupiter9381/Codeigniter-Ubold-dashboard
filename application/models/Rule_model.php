<?php
class Rule_model extends CI_Model {
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

    public function getGroupIDs(){
    	$this->db->select("DISTINCT(groupid) groupid");
    	$this->db->from('dr_rules');
        $this->db->order_by('groupid');
    	$query = $this->db->get();
        return $query->result();
    }
    public function getGwlists(){
    	$this->db->select("DISTINCT(gwlist) gwlist");
    	$this->db->from('dr_rules');
        $this->db->order_by('gwlist');
        $query = $this->db->get();
        return $query->result();
    }

    public function search($groupid, $prefix, $gwlist){
        $this->db->select("*");
        $this->db->from('dr_rules');
        if($groupid != '')
            $this->db->where('groupid', $groupid);
        if($gwlist != '')
            $this->db->where('gwlist', $gwlist);

        if($prefix != ""){
            $first_character = substr($prefix, 0, 1);
            $last_character = substr($prefix, -1);
            if(($first_character == '%') && ($last_character == '%')){
                $key = substr($prefix, 1, strlen($prefix) - 2);
                $this->db->like('prefix', $key);
            } else if (($first_character == "%") && ($last_character != '%')){
                $key = substr($prefix, 1, strlen($prefix) - 1);
                $this->db->like('prefix', $key, 'before');
            } else if (($first_character != "%") && ($last_character == '%')){
                $key = substr($prefix, 0, strlen($prefix) - 1);
                $this->db->like('prefix', $key, 'after');
            } else {
                $this->db->where('prefix', $prefix);
            }
        }
        $this->db->limit(500, 0);
        $sql = $this->db->get_compiled_select();
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function add_rule($data){
    	$this->db->insert('dr_rules', $data);
        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_rules',
            'type' => 'insert',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }

    public function getByRuleId($id){
    	$this->db->select('*');
        $this->db->from('dr_rules');
        $this->db->where('ruleid', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function update_rule($data, $rule_id){
        $condition = array(
            'ruleid' => $rule_id
        );
        $this->db->set($data);
        $this->db->where($condition);
        $this->db->update('dr_rules');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_rules',
            'type' => 'update',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }


    public function delete($id){
    	$condition = array(
            'ruleid' => $id
        );
        $this->db->where($condition);
        $this->db->delete('dr_rules');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'dr_rules',
            'type' => 'delete',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }
}