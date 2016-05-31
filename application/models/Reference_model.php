<?php
  class Reference_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
    }

    public function getRef($cle){
      $this->db->select(); 
      $this->db->where('lien_validation', $cle); // selectionne tout parmis ceux qui ont $cle dans le champ lien_validation
      $query = $this->db->get('reference');

      return $query->row_array(); // row array retourne un tableau associatif
    }

    public function getSavoirByRef($ref){
      // recup id de la ref      
      $this->db->select('id'); 
      $this->db->where('lien_validation', $ref); // selectionne tout parmis ceux qui ont $ref dans le champ lien_validation
      $query = $this->db->get('reference');
      $idRef = $query->row_array();
      // recup id des savoirs etres
      $sqlRef= '
        SELECT nom
        FROM savoir_etre_user
        JOIN savoir_etre ON savoir_etre.id = savoir_etre_user.id_savoir_etre
        WHERE id_ref IN (SELECT id FROM reference WHERE lien_validation = ?)';
      $query = $this->db->query($sqlRef, array($ref));
      foreach ($query->result_array() as $nom){
        $res[]=$nom['nom'];
       }
      return $res;
    }


    public function getRefByUser($id){
      $sqlRef = '
        SELECT id, description, duree, commentaire, etat, nom, prenom, DATE_FORMAT(date_naissance, \'%d/%m/%Y\') AS naissance, mail
        FROM reference
        WHERE id_user = ?
       ';
      $sqlSE = '
        SELECT *
        FROM savoir_etre_user
        JOIN savoir_etre ON savoir_etre.id = savoir_etre_user.id_savoir_etre
        WHERE id_ref IN (SELECT id FROM reference WHERE id_user = ?)
      ';
      $queryRef = $this->db->query($sqlRef, array($id));
      $querySE = $this->db->query($sqlSE, array($id));
      $res = array();
      foreach ($queryRef->result_array() as $ref){
        $res[$ref['id']] = $ref;
      }
      foreach ($querySE->result_array() as $se){
        $res[$se['id_ref']]['savoir_etre'][] = array('nom' => $se['nom'], 'id' => $se['id']);
      }
      return $res;
    }

    public function countRefUser($id){
      $sql = '
        SELECT etat, COUNT(*) AS nb
        FROM reference
        WHERE id_user = ?
        GROUP BY etat
      ';
      $query = $this->db->query($sql, array($id));
      $res = array(1 => 0, 2 => 0, 3 => 0);
      foreach ($query->result_array() as $row){
        $res[$row['etat']] = $row['nb'];
      }
      return $res;
    }
  }