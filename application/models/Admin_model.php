<?php
  class Admin_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }
    public function getAllSavoirEtre(){
      $this->db->select('id, nom, active');
      $this->db->where('supprime', 0);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

    public function getJeuneSavoirEtre(){
      $this->db->select('id, nom, active');
      $this->db->where('supprime', 0);
      $this->db->where('type', 1);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

    public function getReferentSavoirEtre(){
      $this->db->select('id, nom, active');
      $this->db->where('supprime', 0);
      $this->db->where('type', 2);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

  }