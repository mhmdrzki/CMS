<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobil extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Mobil_model'));
        $this->load->library('upload');
    }

    // Mobil view in list
    public function index() {

        $data['result'] = $this->Mobil_model->get()->result_array();
        $data['title'] = 'Mobil';
        $data['main'] = 'admin/mobil/index';
        $this->load->view('admin/layout', $data);
    }

    public function search() {

        $jenis = $this->input->post('jenis');
        $query = $this->input->post('keyword');

        if ($jenis == 'brand') {
            $keyword = array('brand' => $query);
        }

        if ($jenis == 'merek') {
            $keyword = array('merek' => $query);
        }

        if ($jenis == 'tahun') {
            $keyword = array('tahun_buat' => $query);
        }

        if ($jenis == 'harga') {
            $keyword = array('harga' => $query);
        }
        
        $data['result'] = $this->Mobil_model->getBy($keyword);
        $data['title'] = 'Mobil';
        $data['main'] = 'admin/mobil/index';
        $this->load->view('admin/layout', $data);
    }

   
    public function add($id = NULL) {
        $this->form_validation->set_rules('kode_sku', 'Kode SKU', 'required|max_length[10]|is_unique[mobil.kode_sku]');
        $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[10]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|max_length[4]');
        $this->form_validation->set_rules('harga', 'Harga', 'required|greater_than_equal_to[178000000]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|max_length[4]');

        

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Tambah Data Mobil';
            $data['main'] = 'admin/mobil/add';
            $this->load->view('admin/layout', $data);
        }
        else
        {
               
            $config['upload_path']          = './media/images/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['min_width']             = 100;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('userfile'))
            {
                $upload = array('upload_data' => $this->upload->data());
                $data = array(
                    'brand' => $this->input->post('brand'),
                    'kode_sku' => $this->input->post('kode_sku'),
                    'merek' => $this->input->post('merek'),
                    'tahun_buat' => $this->input->post('tahun'),
                    'harga' => $this->input->post('harga'),
                    'stok' => $this->input->post('stok'),
                    'foto' => $upload['upload_data']['file_name']
                );

                $this->Mobil_model->add($data);
                $this->session->set_flashdata('success', 'Tambah data berhasil');
                redirect('admin/mobil');
            }

               
        }

        
             
    }

    public function edit($id = NULL) {
        $data['result'] = $this->Mobil_model->get($id)->row();

        if($this->input->post('kode_sku') != $data['result']->kode_sku) {
           $is_unique =  '|is_unique[mobil.kode_sku]';
        } else {
           $is_unique =  '';
        }

        $this->form_validation->set_rules('kode_sku', 'Kode SKU', 'required|max_length[10]'.$is_unique);
        $this->form_validation->set_rules('merek', 'Merek', 'required|max_length[10]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|max_length[4]');
        $this->form_validation->set_rules('harga', 'Harga', 'required|greater_than_equal_to[178000000]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|max_length[4]');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Update Data Mobil';
            $data['main'] = 'admin/mobil/edit';
            $this->load->view('admin/layout', $data);
        }
        else
        {
            
            $id = $this->input->post('id');

            $config['upload_path']          = './media/images/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['min_width']             = 100;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if($this->upload->do_upload('userfile')){
                $upload = array('upload_data' => $this->upload->data());

                $data = array(
                'brand' => $this->input->post('brand'),
                'kode_sku' => $this->input->post('kode_sku'),
                'merek' => $this->input->post('merek'),
                'tahun_buat' => $this->input->post('tahun'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'foto' => $upload['upload_data']['file_name']
                );   
            }else{
                $data = array(
                'brand' => $this->input->post('brand'),
                'kode_sku' => $this->input->post('kode_sku'),
                'merek' => $this->input->post('merek'),
                'tahun_buat' => $this->input->post('tahun'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                );   
            }
            
            
           $query = $this->Mobil_model->edit($data,$id);

      
           if ($query) {
               $this->session->set_flashdata('success', 'Update data berhasil');
                        
            } 
            else
            {
               $this->session->set_flashdata('danger', 'Update data gagal');
            }
           redirect('admin/mobil');
        }

        
             
    }

    

    // Delete mobil
    public function delete($id = NULL) {
        $id = $this->uri->segment('4');
        $result = $this->Mobil_model->delete($id);
         if ($result) {
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/mobil');
        }{
            $this->session->set_flashdata('delete', 'Delete');
        } 
        redirect('admin/mobil');

        
    }

   
}
