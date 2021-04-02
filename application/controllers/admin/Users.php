<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->helper('url');  
        $this->load->model('Users_model');   

    }
   
    public function register() {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Passowrd', 'required|exact_length[6]|regex_match[/^[0-9]*$/]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/register');
        }
        else
        {
            $password = hash ( "sha256", $this->input->post('password'));
            $data = array(
                'nama' => $this->input->post('nama'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'email' => $this->input->post('email'),
                'password' => $password,
            );

            $this->Users_model->add($data);
            echo "<script>
                alert('Register berhasil!! Silahkan Login.');
                window.location.href='".base_url()."';
                </script>";
        } 

        
             
    }


   
}
