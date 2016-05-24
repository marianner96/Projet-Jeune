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

    public function create($param){
      $data = array(
        'nom' => urldecode($param['nom']),
        'type' => ($param['type'] == 'jeune' ? 1 : 2)
      );
      $this->db->insert('savoir_etre', $data);
      return array('id' => $this->db->insert_id());

    }
    public function toggle($param){
      $query = $this->db->select('etat')->where('id', $param['id'])->get('savoir_etre');
      $res = $query->row();
      if(empty($res)){
        return array('errors' => 'Savoir-être inconnu.');
      }
      if($res->etat == -1){
        return array('errors' => 'Savoir-être supprimé');
      }
      $etat = ($res->etat == 0) ? 1 : 0;
      $this->db->set('etat', $etat)
        ->where('id', $param['id'])
        ->update('savoir_etre');
    }
  } 
