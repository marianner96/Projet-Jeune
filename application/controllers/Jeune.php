<?php
class Jeune extends CI_Controller{
	public function acceuil(){
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('templates/head.php');
				$this->load->view('PartieJeune/jeune.php');
				$this->load->view('templates/foot.php');
            }
            else{                
                $this->load->view('PartieJeune/formsuccess');
            }
	}
}
