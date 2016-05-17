<?php
class Jeune extends CI_Controller{
	public function accueil(){
        $this->load->view('templates/head.php');
        $this ->load->view('PartieJeune/accueil');
        $this->load->view('templates/foot.php');
	}
    public function formulaire(){
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('templates/head.php');
                $this->load->view('PartieJeune/fomulaire');
                $this->load->view('templates/foot.php');
            }
            else{                
                $this->load->view('PartieJeune/formsuccess');
            }
    }
}
