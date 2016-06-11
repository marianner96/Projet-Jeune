<?php
  class Savoiretre_model extends CI_Model
  {
    public function __construct()
    {
      $this->load->database();
      $this->load->library('session');
    }
    //Accès
    /**
   * Permet de récuperer l'ensemble des références dont l'état est égal à 1
   * @param $activeOnly : bool = true
   * @return array Retourne l'ensemble des références dont l'état est égal à 1
   */
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

    /**
    * les 4 savoir être les plus utilisés (dans le cas de la deuxième ou plus référence)
    *
    *@return array : les 4 savoir être
    */
    public function getFavori() {
      $sql = 'SELECT id_savoir_etre, COUNT(id_savoir_etre) AS nb 
      FROM savoir_etre_user 
      JOIN savoir_etre ON savoir_etre.id = savoir_etre_user.id_savoir_etre 
      WHERE savoir_etre_user.type = 1  
        AND savoir_etre.etat = 1 
          AND savoir_etre_user.id_ref
          IN (
              SELECT id FROM reference WHERE id_user = ?
          ) 
      GROUP BY savoir_etre_user.id_savoir_etre 
      ORDER BY nb DESC
      LIMIT 4';
      $user = $this->session->userdata('logged_in');
      $res = $this->db->query($sql, [$user['id']])->result_array();
      $res = array_map(function($case) {
        return $case['id_savoir_etre'];
      }, $res);
      return $res;
    }

    /**
    *récupère les savoir être disponible pour le référent
    *
    *@return le résultat de la requête
    */
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

    /**
    *récupère les savoir être d'une référence
    *
    *@param $refsId Prend en paramètre un tableau contenant des id de référence
    *@return array Retourne un tableau contenant pour chaque référence les savoir-être du jeune et du référent
    */
    public function getSavoirEtreByRefs($refsId){
      if(empty($refsId)){
        return [];
      }
      $sqlSE = '
      SELECT *
      FROM savoir_etre_user
      JOIN savoir_etre ON savoir_etre.id = savoir_etre_user.id_savoir_etre
      WHERE id_ref IN ('.implode(',', $refsId).')
    ';
      $querySE = $this->db->query($sqlSE);
      $res = [];
      foreach ($querySE->result_array() as $ref){
        isset($res[$ref['id_ref']]) || $res[$ref['id_ref']] = ['jeune' => [], 'referent' => []];
        $type = $ref['type'] == 1 ? 'jeune' : 'referent';
        $res[$ref['id_ref']][$type][] = $ref['nom'];
      }
      return $res;
    }

    //Modification
    /**
    *récupère les savoir être d'une référence
    *
    *@param $refsId Prend en paramètre un tableau contenant des id de référence
    *@return array Retourne un tableau contenant pour chaque référence les savoir-être du jeune et du référent
    */
    public function create($param){
      $data = array(
        'nom' => urldecode($param['nom']),
        'type' => $param['type']
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
