<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referent extends J64_Controller {
	
	function validation($cle=''){
		$data['title']=''; //Nom dans l'onglet
		//$data['menu']=''; Dans le menu en haut
		$this->load->model('reference_model');
		$data['ref'] = $this->reference_model->getRef($cle);

		$this->load->library("form_validation");

		$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('referent/validation', $data);
			} else {
				$this->load->view('referent/success', $data);
			}
			$this->load->view('templates/foot');
    	

	} 
}
