<?php
    class User_model extends CI_Model {

        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }


        public function login(){
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'name' => $name,
                'password' => md5($password),
            );
            $this->db->where($data);
            $query = $this->db->get('users');
            return $query->result();
        }

         public function signup(){
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $usertype = '1';
            $data = array(
                'name' => $name,
                'password' => md5($password),
                'type' => $usertype,
                'allowed' => 0
            );
            $this->db->insert('users', $data);
            return;
        }

        public function get(){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('type', '1');
            $query = $this->db->get();
            return $query->result();
        }

        public function getById($id){
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->result();
        }

        public function update_status($condition, $data){
            $this->db->set($data);
            $this->db->where($condition);
            $this->db->update('users');
            return;
        }

        public function delete($id){
            $condition = array(
                'id' => $id
            );
            $this->db->where($condition);
            $this->db->delete('users');
            return;
        }
    }
?>