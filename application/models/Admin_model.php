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

    public function getUsers($page){
      $sql = '
        SELECT *
        FROM jeune
        ORDER BY nom ASC 
        LIMIT 5
        OFFSET ?
      ';
      return $this->db->query($sql, [($page - 1)*5])->result_array();
    }
    
    public function toggleAdmin($id){
      $sqlGet = '
        SELECT rang
        FROM jeune
        WHERE id = ?
      ';
      $res = $this->db->query($sqlGet, [$id])->row_array();
      if(empty($res)){
        return false;
      }
      $sqlUpdate = '
        UPDATE jeune 
        SET rang = ? 
        WHERE id = ?
      ';
      $this->db->query($sqlUpdate, [$res['rang'] >= 100 ? 0 : 100, $id]);
      return true;
    }
    
    public function deleteUser($id){
      $sql1 = '
        DELETE groupement, reference, savoir_etre_user FROM groupement 
          INNER JOIN reference 
            ON groupement.id_ref=reference.id
          INNER JOIN savoir_etre_user 
            ON reference.id=savoir_etre_user.id_ref
          WHERE reference.id_user = ?;
      ';
      $sql2 = '
        DELETE jeune, dashboard 
          FROM jeune 
          LEFT JOIN dashboard 
            ON jeune.id = dashboard.id_user
          WHERE jeune.id = ?;
      ';
      $this->db->query($sql1, [$id]);
      $this->db->query($sql2, [$id]);
    }
  }
