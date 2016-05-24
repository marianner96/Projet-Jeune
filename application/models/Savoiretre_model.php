<?php
  class Savoiretre_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function getJeune()
    { 
      $this->db->select('id, nom, etat');
      $this->db->where('etat >= 0', NULL);
      $this->db->where('type', 1);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

    public function getReferent()
    {
      $this->db->select('id, nom, etat');
      $this->db->where('etat >= 0', NULL);
      $this->db->where('type', 2);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

    public function getAll(){
      $this->db->select('id, nom, etat');
      $this->db->where('etat', 1);
      $query = $this->db->get('savoir_etre');

      return $query->result();
    }

    public function create(){
      //validation données
      $data = array(
        'nom' => $this->input->post('nom'),
        'type' => $this->input->post('type')
      );
      //insertion du savoir etre
    }
  } 
