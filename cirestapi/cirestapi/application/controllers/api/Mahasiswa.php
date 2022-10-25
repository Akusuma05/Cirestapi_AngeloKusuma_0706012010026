<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('Mahasiswamodel', 'model');
    }

    public function index_get(){
        $data = $this->model->getMahasiswa();
        $data2 = $this->model->getMahasiswa();
        $this->set_response([
            'status' => TRUE,
            'code' => 200,
            'message' => 'Success',
            'data' => $data,            
        ], REST_Controller::HTTP_OK);
    }

    public function sendmail_post(){
        $to_email = $this->post('email');
        $this->load->Library('email');
        $this->email->from('info@angelo.ngantokimt.com', 'Angelo');
        $this->email->to($to_email);
        $this->email->subject('Informasi penting dari SIDU');
        $this->email->message("
            <center>
                <h1 style='color: #FF5555;'>WELCOME TO NGANTOK IMT</h1>
                <p>Kami siap melayani Anda!</p>
            </center>
        ");

        if($this->email->send()){
            $this->set_response([
                   'status' => TRUE,
                   'code' => 200,
                   'message'=> 'Success'
                    ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                   'status' => FALSE,
                   'code' => 404,
                   'message' => 'Not Found'
                    ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}