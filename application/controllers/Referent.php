<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referent extends J64_Controller {
	
	function validation($cle=''){
		if ($cle==''){
			show_404();
		}
		
		$data['title']=''; //Nom dans l'onglet
		//$data['menu']=''; Dans le menu en haut
		$this->load->library("form_validation");

		//charge les models
		$this->load->model('reference_model'); 
		$this->load->model('savoiretre_model');

		//envois de données à la vue
		$data['cle'] = $cle; 
		$data['ref'] = $this->reference_model->getRef($cle); // Infos sur la référence
		$data['savoirEtreJeune'] = $this->reference_model->getSavoirByRef($cle); // Savoir être selectionnés par le jeune
		$data['savoirEtreRef'] = $this->savoiretre_model->getReferent(); // Savoir être disponnible pour le referent

		//Regles du formulaire de confirmation
		$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('jourNaissance', 'Jour : date de Naissance', 'required');
		$this->form_validation->set_rules('moisNaissance', 'Mois : date de Naissance', 'required');
		$this->form_validation->set_rules('anneeNaissance', 'Année : date de Naissance', 'required');

		$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('referent/validation', $data);
			} else {
				$this->load->view('referent/success', $data);
			}
			$this->load->view('templates/foot');
    	

	} 
}
