<?php
  class Users_model extends CI_Model {
    public function __construct(){
      $this->load->database();
      $this->load->library('PasswordHash', array(8, FALSE)); 
      $this->load->library('session');
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
      $this->db->select('id, mail, rang, mdp, nom, prenom, date_naissance');
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
          'rang'=>$qr->rang,
          'prenom'=>$qr->prenom,
          'nom'=>$qr->nom,
          'date_naissance'=>$qr->date_naissance
          );
      } else {
        return false;
      } 
    }
    public function is_logger(){
      return $this->session->has_userdata('logged_in');
    }
    public function is_admin(){
      if(!$this->session->has_userdata('logged_in'))
        return false;
      return $this->session->logged_in['rang'] >= 100;
    }

    public function change_mail(){
      $id_user = $this->session->userdata('logged_in')['id'];
      $nv = $this->input->post('mail');
      $this->db->set('mail', $nv);
      $this->db->where('id', $id_user);
      $this->db->update('jeune');
      return array('affectedRows' => $this->db->affected_rows());
    }

    public function change_mdp() {
      $id_user = $this->session->userdata('logged_in')['id'];
      $nv = $this->passwordhash->HashPassword($this->input->post('nvmdp'));
      $this->db->set('mdp', $nv);
      $this->db->where('id', $id_user);
      $this->db->update('jeune');
      return array('affectedRows' => $this->db->affected_rows());
    }
  }
?>
