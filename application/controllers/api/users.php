<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Users extends REST_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Users_model','user');
    }
    public function index_get(){
        $id = $this->get('id');
        if ($id === null){
            $users = $this->user->getUsers();
        }else{
            $users = $this->user->getUsers($id);
        }
        if ($users){
            $this->response([
                'status' => true,
                'data' => $users
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'ID tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);  
        }
    }
}

?>