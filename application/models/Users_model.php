<?php
  class Users_model extends CI_Model {
    public function __construct(){
      $this->load->database();
      $this->load->library('PasswordHash', array(8, FALSE)); 
    }

    public function create_user(){
      $data = array(
        'nom' => $this->input->post('nom'),
        'prenom' => $this->input->post('prenom'),
        'mail' => $this->input->post('mail'),
        'date_naissance' => DateTime::createFromFormat(
            'd-m-Y',
            $this->input->post('jour') . '-' .
            $this->input->post('mois') . '-' .
            $this->input->post('annee'))->getTimestamp()
          ,
        'mdp' => $this->passwordhash->HashPassword($this->input->post('mdp'))
      );
      return $this->db->insert('jeune', $data);
        
    }

  }
?>
