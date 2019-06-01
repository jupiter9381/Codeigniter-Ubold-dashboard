<?php
class Clrate_model extends CI_Model {
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

    public function getTariffnames(){
    	$this->db->select("DISTINCT(tariffname) tariffname");
    	$this->db->from('add_cl_rates');
        $this->db->order_by('tariffname');
    	$query = $this->db->get();
        return $query->result();
    }

    public function getTariffdescs(){
        $this->db->select("DISTINCT(tariffdesc) tariffdesc");
        $this->db->from('add_cl_rates');
        $this->db->order_by('tariffdesc');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function search($tariffname, $prefix, $tariffdesc){
        $this->db->select("*");
        $this->db->from('add_cl_rates');
        if($tariffname != '')
            $this->db->where('trim(tariffname)', $tariffname);

        $first_character = substr($tariffdesc, 0, 1);
        $last_character = substr($tariffdesc, -1);
        if(($first_character == '%') && ($last_character == '%')){
            $key = substr($tariffdesc, 1, strlen($tariffdesc) - 2);
            $this->db->like('trim(tariffdesc)', $key);
        } else if (($first_character == "%") && ($last_character != '%')){
            $key = substr($tariffdesc, 1, strlen($tariffdesc) - 1);
            $this->db->like('trim(tariffdesc)', $key, 'before');
        } else if (($first_character != "%") && ($last_character == '%')){
            $key = substr($tariffdesc, 0, strlen($tariffdesc) - 1);
            $this->db->like('trim(tariffdesc)', $key, 'after');
        } else {
            $this->db->where('trim(tariffdesc)', $tariffdesc);
        }

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
        // $log = array(
        //     'user_id' => $this->session->user->id,
        //     'date' => date('Y-m-d h:i:s'),
        //     'table' => 'add_cl_rates',
        //     'type' => 'search',
        //     'sql' => $sql
        // );
        // $this->db->insert('logs', $log);
        //echo $sql;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function add_clrate($data){
    	$this->db->insert('add_cl_rates', $data);
        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_cl_rates',
            'type' => 'insert',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);
        return;
    }

    public function getByRateId($id){
    	$this->db->select('*');
        $this->db->from('add_cl_rates');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function update_clrate($data, $id){
        $condition = array(
            'id' => $id
        );
        $this->db->set($data);
        $this->db->where($condition);
        $this->db->update('add_cl_rates');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_cl_rates',
            'type' => 'update',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }

    public function delete($id){
    	$condition = array(
            'id' => $id
        );
        $this->db->where($condition);
        $this->db->delete('add_cl_rates');

        $sql = $this->db->last_query()  . "; \n";
        $log = array(
            'user_id' => $this->session->user->id,
            'date' => date('Y-m-d h:i:s'),
            'table' => 'add_cl_rates',
            'type' => 'delete',
            'sql' => $sql
        );
        $this->db->insert('logs', $log);

        return;
    }

    public function check($tariffname, $prefix, $date){
        $this->db->select("*");
        $this->db->from("add_cl_rates");
        $this->db->where('tariffname', $tariffname);
        $this->db->where('prefix', $prefix);
        $this->db->where('date', $date);
        $query = $this->db->get();
        return $query->result();
    }
}