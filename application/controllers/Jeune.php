<?php
class Jeune extends CI_Controller{
	public function index(){
        $data['content'] = 'accueil';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this ->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
	}
    public function formulaire(){
        $this->load->model('jeune_model');
        $data['query'] = $this->jeune_model->savoiretre();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $data['content'] = 'fomulaire';
        $data['menu'] = 'jeune';
        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/head', $data);
            $this->load->view('templates/jeunes', $data);
            $this->load->view('templates/foot');
        }
        else{                
            $this->load->view('PartieJeune/formsuccess');
        }
    }
    public function consultant(){
        $data['content'] = 'consultant';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }
    public function profil(){
        $data['content'] = 'profil';
        $data['menu'] = 'jeune';
        $this->load->view('templates/head', $data);
        $this->load->view('templates/jeunes', $data);
        $this->load->view('templates/foot');
    }
}
