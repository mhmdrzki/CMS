<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Auth controllers class
 *
 ** @package     HRA CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('string');
        $this->load->helper('url');        
    }

    function index() {  
        redirect('admin/auth/login');
    }

    function login() {
        if ($this->session->userdata('logged')) {
            redirect('admin');
        }
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            if ($this->input->post('location')) {
                $lokasi = $this->input->post('location');
            } else {
                $lokasi = NULL;
            }
            $this->process_login($lokasi);
        } else {
            $this->load->view('admin/login');
        }
    }

    // Login Prosessing
    function process_login($lokasi = '') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $this->db->from('users');
            $this->db->where('email', $email);
            $this->db->where('password', hash ( "sha256",$password));
            
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $this->session->set_userdata('logged', TRUE);
                $this->session->set_userdata('id', $query->row('id'));
                $this->session->set_userdata('nama', $query->row('nama'));
                if ($lokasi != '') {
                    header("Location:" . htmlspecialchars($lokasi));
                } else {
                    redirect('admin');
                }
            } else {
                if ($lokasi != '') {
                    $this->session->set_flashdata('failed', 'Sorry, email and password do not match');
                    header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($lokasi));
                } else {
                    $this->session->set_flashdata('failed', 'Sorry, email and password do not match');
                    redirect('admin/auth/login');
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Sorry, email and password are not complete');
            redirect('admin/auth/login');
        }
    }

    // Logout Processing
    function logout() {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_role');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_full_name');
        $this->session->unset_userdata('user_image');
        if ($this->input->post('location')) {
            $lokasi = $this->input->post('location');
        } else {
            $lokasi = NULL;
        }
        header("Location:" . $lokasi);
    }

}
