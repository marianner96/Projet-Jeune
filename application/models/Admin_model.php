<?php
  class Admin_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }
    public function getAllSavoirEtre(){
      $query = $this->db->get('savoir_etre');
      return $query->result();
    }

  }