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
        'date_naissance' => 
            $this->input->post('annee') . '-' .
            $this->input->post('mois') . '-' .
            $this->input->post('jour'),
        'mdp' => $this->passwordhash->HashPassword($this->input->post('mdp'))
      );
      return $this->db->insert('jeune', $data);
    }

    public function login($mail, $password) {
      $this->db->select('id, mail, rang, mdp');
      $this->db->from('jeune');
      $this->db->where('mail', $mail);
      $this->db->limit(1);
      $query = $this->db->get();
      if ($query->num_rows() != 1 ) {
        return false;
      } 
      $qr = $query->row();
      if ($this->passwordhash->CheckPassword($password, $qr->mdp)) {
        return array (
          'id'=> $qr->id,
          'mail'=>$qr->mail,
          'rang'=>$qr->rang
          );
      } else {
        return false;
      } 
    }

    public function is_admin(){
      return true;
    }

  }
?>
