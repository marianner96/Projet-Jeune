<?php
  class Reference_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function getRef($cle){
      $this->db->select(); 
      $this->db->where('lien_validation', $cle); // selectionne tout parmis les ceux qui ont $cle dans le champ lien_validation
      $query = $this->db->get('reference');

      return $query->row_array();
    }
  }