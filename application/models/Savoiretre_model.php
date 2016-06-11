<?php

/**
 * Class Savoiretre_model
 */
class Savoiretre_model extends CI_Model
  {
  /**
   * Savoiretre_model constructor.
   */
  public function __construct()
    {
      $this->load->database();
      $this->load->library('session');
    }
    //Accès
    /**
     * Permet de récuperer l'ensemble des références du jeune
     *
     * @param $activeOnly bool TRUE si on veut seulement les savoir-être activés
     * FALSE si on veut les activés et les désactivés
     * @return array Retourne un tableau des savoirs être séléctionnés
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
     * Récupère les quatre savoir-être les plus utilisés par l'utilisateur
     * connecté
     *
     * @return array Un tableau des IDs des quatres savoir-être
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
     * Permet de récuperer l'ensemble des références du référent
     *
     * @param $activeOnly bool TRUE si on veut seulement les savoir-être activés
     * FALSE si on veut les activés et les désactivés
     * @return array Retourne un tableau des savoirs être séléctionnés
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
     * Récupère les savoir être relatifs à un ensemble de références
     *
     * @param $refsId array Un tableau contenant des IDs de référence
     * @return array Un tableau indexé par les ID des références contenant pour
     * chaque référence les savoir-être du jeune et du référent
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
     * Ajout un savoir être dans la base de données
     *
     * @param $param array Un tableau associatif contenant le nom du savoir-etre
     * à ajouter ainsi que le type du savoir-etre
     * @return array Un tableau associatif dont la valeur à la clé "id" contient
     * l'id du savoir-etre ajouté
     * @todo Avoir deux paramêtres au lieu d'un tableau associatif à deux cases
     */
    public function create($param){
      $data = array(
        'nom' => urldecode($param['nom']),
        'type' => $param['type']
      );
      $this->db->insert('savoir_etre', $data);
      return array('id' => $this->db->insert_id());

    }

  /**
   * Active ou désactive un savoir-être
   *
   * @param $param array Un tableau associatif dont la case "id" contient l'ID du
   * savoir-etre sur lequel il faut executer l'action
   * @return array Un tableau associatif renseignant le nombre de lignes
   * affectées par la requête, si tout se passe bien ça devrait être à un
   *
   * @todo Avoir comme paramètre seulement l'id voulue et non pas un tableau associatif contenant l'id
   */
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

  /**
   * Supprime un savoir-être
   *
   * @param $param array Un tableau associatif dont la case "id" contient l'ID du
   * savoir-etre à supprimer
   * @return array Un tableau associatif renseignant le nombre de lignes
   * affectées par la requête, si tout se passe bien ça devrait être à un
   *
   * @todo Avoir comme paramètre seulement l'id voulue et non pas un tableau associatif contenant l'id
   */
  public function delete($param){
      $this->db->set('etat', -1)
        ->where('id', $param['id'])
        ->update('savoir_etre');
      return array('affectedRows' => $this->db->affected_rows());
    }
  } 
