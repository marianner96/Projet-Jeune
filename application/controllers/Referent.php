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
		$this->load->model('jeune_model');


		if ($this->reference_model->checkRef($cle)==2){ // Si la ref à déjà été validée
			show_404();
		}

		//envois de données à la vue
		$data['cle'] = $cle; 
		$data['ref'] = $this->reference_model->getRef($cle); // Infos sur la référence
		$data['savoirEtreJeune'] = $this->reference_model->getSavoirByRef($cle); // Savoir être selectionnés par le jeune
		$data['savoirEtreRef'] = $this->savoiretre_model->getReferent(); // Savoir être disponnible pour le referent
		$data['infoJeune'] = $this->reference_model->getInfoJeuneByRef($cle);


		//Regles du formulaire de confirmation
		$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('jourNaissance', 'Jour : date de Naissance', 'trim|required|exact_length[2]|is_natural');
		$this->form_validation->set_rules('moisNaissance', 'Mois : date de Naissance', 'trim|exact_length[2]|is_natural|required');
		$this->form_validation->set_rules('anneeNaissance', 'Année : date de Naissance', 'trim|required|exact_length[4]|is_natural');
		$this->form_validation->set_rules('savoirEtre[]','SavoirEtre','required|callback_savoirEtre_check'); /* Le check est sur une fonction crée plus bas*/
	
		$this->load->view('templates/head');
			if ($this->form_validation->run()==FALSE) {
				$this->load->view('referent/validation', $data);
			} else {
				$this->load->view('referent/success', $data);
				$this->reference_model->addInfoReferent($data['ref']);
				$this->reference_model->addSavoirRef($data['ref']);
				$this->jeune_model->addRefvalidateToDashboard($data['ref']);
			}
			$this->load->view('templates/foot');   	

	} 

	/**
   	* Véréfie si l'utilisateur a entrée un nombre correct de savoir être
   	*
   	* @param string $chaine Un savoir etre
   	* @return bool|string Retourne le savoir etre s'il y a au plus quatre savoir
   	*  être qui on été envoyé au serveur FALSE sinon
   	*/
  	public function savoirEtre_check($chaine){
    if (count($this->input->post('savoirEtre'))>4) {
      $this->form_validation->set_message('savoirEtre_check', 'Veuillez choisir au maximum 4 options');
      return FALSE;
    	}
    else {
      return $chaine;
    	}
  	}
}
