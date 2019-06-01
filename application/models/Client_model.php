<?php
    class Client_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get(){
            $this->db->select('*');
            $this->db->from('add_clients');
            $this->db->order_by('client_name');
            $query = $this->db->get();
            return $query->result();
        }

        public function getTariffNames(){
        	$this->db->select("DISTINCT(tariffname) tariffname");
        	$this->db->from('add_cl_rates_pl');
            $query = $this->db->get();
            return $query->result();
        }
        public function getTariffPlNames(){
            $this->db->select("DISTINCT(tariffname) tariffname");
            $this->db->from('add_cl_rates');
            $query = $this->db->get();
            return $query->result();
        }
        public function getGroupNames(){
        	$this->db->select("DISTINCT(destgroupname) name");
        	$this->db->from('add_destinations_pl');
            $query = $this->db->get();
            return $query->result();
        }
        public function getTariffNameAz(){
        	$this->db->select("DISTINCT(tariffname) name");
        	$this->db->from('add_cl_rates');
            $query = $this->db->get();
            return $query->result();
        }

        public function getGroupIdPL(){
        	$this->db->select("DISTINCT(groupid) groupid");
        	$this->db->from('dr_rules');
        	$this->db->order_by('groupid');
            $query = $this->db->get();
            return $query->result();
        }

        public function add_client($data){
        	$this->db->insert('add_clients', $data);
            $sql = $this->db->last_query()  . "; \n";
            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clients',
                'type' => 'insert',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);
            return;
        }

        public function add_ip_address($ip_address, $name){
            $sql = '';
        	foreach ($ip_address as $key => $value) {
        		$data = array(
        			"client_name" => $name,
        			"ip" => $value
        		);
        		$this->db->insert('add_clientsip', $data);
                $sql .= $this->db->last_query() . "; \n";
        	}

            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clientsip',
                'type' => 'insert',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);

        	return;
        }

        public function check_ip_address($ip_address, $name){
            $this->db->select('*');
            $this->db->from('add_clientsip');
            $this->db->where('ip', $ip_address);
            $query = $this->db->get();
            return $query->result();
        }
        public function check_edit_ip_address($ip_address, $name){
            $this->db->select('*');
            $this->db->from('add_clientsip');
            $this->db->where('client_name !=', $name);
            $this->db->where('ip', $ip_address);
            $query = $this->db->get();
            return $query->result();
        }
        
        
        public function delete($name){
        	$condition = array(
                'client_name' => $name
            );
            $this->db->where($condition);
            $this->db->delete('add_clients');

            $sql = $this->db->last_query()  . "; \n";
            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clients',
                'type' => 'delete',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);

            $condition = array(
                'client_name' => $name
            );
            $this->db->where($condition);
            $this->db->delete('add_clientsip');
            
            $sql = $this->db->last_query()  . "; \n";
            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clientsip',
                'type' => 'delete',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);

            return;
        }

        public function getByName($name){
        	$this->db->select('*');
            $this->db->from('add_clients');
            $this->db->where('client_name', $name);
            $query = $this->db->get();
            return $query->result();
        }
        public function getIpAddress($name){
            $this->db->select('*');
            $this->db->from('add_clientsip');
            $this->db->where('client_name', $name);
            $query = $this->db->get();
            return $query->result();
        }

        public function update_client($data, $client_id){
            $condition = array(
                'client_id' => $client_id
            );
            $this->db->set($data);
            $this->db->where($condition);
            $this->db->update('add_clients');

            $sql = $this->db->last_query()  . "; \n";
            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clients',
                'type' => 'update',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);

            return;
        }

        public function update_ip_address($ip_address, $name){
            $condition = array(
                'client_name' => $name
            );
            $this->db->where($condition);
            $this->db->delete('add_clientsip');

            $sql = $this->db->last_query()  . "; \n";

            if($ip_address != null){
                foreach ($ip_address as $key => $value) {
                    $data = array(
                        "client_name" => $name,
                        "ip" => $value
                    );
                    $this->db->insert('add_clientsip', $data);
                    $sql .= $this->db->last_query()  . "; \n";
                }
            }
            
            $log = array(
                'user_id' => $this->session->user->id,
                'date' => date('Y-m-d h:i:s'),
                'table' => 'add_clientsip',
                'type' => 'update',
                'sql' => $sql
            );
            $this->db->insert('logs', $log);

            return;
        }
    }
?>