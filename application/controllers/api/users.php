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

    public function index_post(){
        $data = [
            'nama' => $this->post('nama'),
            'password' => $this->post('password'),
            'email' => $this->post('email'),
            'no_telepon' => $this->post('no_telepon')
        ];

        if( $this->user->createUsers($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'Pendaftaran berhasil'
            ], REST_Controller::HTTP_CREATED);  
        }else{
            $this->response([
                'status' => false,
                'message' => 'Ada yang salah, coba lagi yuk'
            ], REST_Controller::HTTP_BAD_REQUEST);  
        }
    }
}

?>