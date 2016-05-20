<?php
class Jeune extends CI_Controller{
	public function index(){
        $this->load->view('templates/head.php');
        $this ->load->view('PartieJeune/profil');
        $this->load->view('templates/foot.php');
	}
    public function formulaire(){
        $this->load->model('jeune_model');
        $data['query'] = $this->jeune_model->savoiretre();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('templates/head.php');
                $this->load->view('PartieJeune/fomulaire',$data);
                $this->load->view('templates/foot.php');
            }
            else{                
                $this->load->view('PartieJeune/formsuccess');
            }
    }
    public function consultant(){
        $this->load->view('templates/head.php');
        $this->load->view('PartieJeune/consultant.php');
        $this->load->view('templates/foot.php');
    }
}
