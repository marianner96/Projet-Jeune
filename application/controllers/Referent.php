<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Class Referent
 * Controlleur du module "référent". Match les routes de type /referent/*
 */
class Referent extends J64_Controller {
	
	/**
	 * Route /referent/validation/$clé
	 *
	 * Vérifie si la référence à valider existe et affiche le formulaire associé
   * Affiche une page d'erreur 404 si la clé est vide, ou si la référence à été 
	 * validée.
   *
   * @param string $cle la clé correspondant à la référence
	 * @return void
	 */
	function validation($cle=''){
		if ($cle==''){
			show_404();
		}
		
		$data['title']=''; //Nom dans l'onglet
		$this->load->library("form_validation");

		//charge les models
		$this->load->model('reference_model'); 
		$this->load->model('savoiretre_model');
		$this->load->model('jeune_model');


		if ($this->reference_model->checkRef($cle)!=1){ // Si la ref à déjà été validée
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
		$this->form_validation->set_rules('jourNaissance', 'jour de naissance', 'required|is_natural|greater_than_equal_to[1]|less_than_equal_to[31]');
		$this->form_validation->set_rules('moisNaissance', 'mois de naissance', 'required|is_natural|greater_than_equal_to[1]|less_than_equal_to[12]');
		$this->form_validation->set_rules('anneeNaissance', 'année de naissance', 'required|exact_length[4]|is_natural');
		$this->form_validation->set_rules('savoirEtre[]','savoir-être','required|callback_savoirEtre_check'); /* Le check est sur une fonction crée plus bas*/
	
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
   	* Véréfie si l'utilisateur a entré un nombre correct de savoir être
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
