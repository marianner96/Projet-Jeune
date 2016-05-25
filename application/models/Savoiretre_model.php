<?php
  class Savoiretre_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function getJeune($activeOnly = true)
    { 
      $this->db->select('id, nom, etat');
      if($activeOnly){
        $this->db->where('etat', '1');
      }else{
        $this->db->where('etat >= 0', NULL);
      }
      $this->db->where('type', 1);
      $query = $this->db->get('savoir_etre');
      return $query->result();
    }

    public function getReferent($activeOnly = true)
    {
      $this->db->select('id, nom, etat');
      if($activeOnly){
        $this->db->where('etat', '1');
      }else{
        $this->db->where('etat >= 0', NULL);
      }
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
        return array('errors' => array('Savoir-être inconnu.'));
      }
      if($res->etat == -1){
        return array('errors' => array('Savoir-être supprimé'));
      }
      $etat = ($res->etat == 0) ? 1 : 0;
      $this->db->set('etat', $etat)
        ->where('id', $param['id'])
        ->update('savoir_etre');
      return array('affectedRows' => $this->db->affected_rows());
    }

    public function delete($param){
      $this->db->set('etat', -1)
        ->where('id', $param['id'])
        ->update('savoir_etre');
      return array('affectedRows' => $this->db->affected_rows());
    }
  } 
