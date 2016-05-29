<?php
  class Admin_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function countUsers(){
      return $this->db->count_all_results('jeune');
    }

    public function countRefs(){
      $sql = '
        SELECT etat, COUNT(*) AS nb
        FROM reference
        GROUP BY etat
      ';
      $query = $this->db->query($sql);
      $res = array(1 => 0, 2 => 0, 3 => 0);
      foreach ($query->result_array() as $row){
        $res[$row['etat']] = $row['nb'];
      }
      return $res;
    }
  }
