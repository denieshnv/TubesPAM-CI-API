<?php
class Users_model extends CI_Model{
    public function getUsers($id = null){
        if ($id === null){
            return $this->db->get('users')->result_array();
        } else {
            return $this->db->get_where('users',['id' => $id])->result_array();
        }
    }
}