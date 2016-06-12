<?php

/**
 * Class Admin_model
 */
class Admin_model extends CI_Model
  {
  /**
   * Admin_model constructor.
   */
  public function __construct()
    {
      $this->load->database();
    }
    /**
     * Permet de déterminer le nombre de jeune inscrit sur le site
     *
     *
     * @return int Retourne le nombre de jeune inscrit sur le site
     */
    public function countUsers(){
      return $this->db->count_all_results('jeune');
    }

    /**
     * Permet de déterminer le nombre de référence ainsi que leurs états
     *
     *
     * @return array Retourne un tableau de taille 3 (nombre de référence en
     * cours de validation, nombre de référence validée, nombre de référence
     * archivée)
     */
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

    /**
     * Permet de récuperer les informations des jeunes inscrits pour chaque page pouvant contenir 10 jeunes
     *
     * @param int $page Prend en paramètre un int correspondant au numéro de la page en cours
     * @return array Retourne un tableau contenant les informations de chaque jeune inscrit
     */
    public function getUsers($page){
      $sql = '
        SELECT *
        FROM jeune
        ORDER BY nom ASC 
        LIMIT 10
        OFFSET ?
      ';
      return $this->db->query($sql, [($page - 1)*10])->result_array();
    }

    /**
     * Permet de mettre un utilisateur normal admin et inversement
     *
     * @param int $id L'id du jeune
     * @return bool Retourne TRUE si tout c'est bien passé ou FALSE si
     * l'utilisateur n'existe pas
     */
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
    

    /**
     * Supprime un jeune ainsi que toutes les informations qui le concernent
     *
     * @param int $id L'id du jeune
     * @return void
     */
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
        DELETE jeune, dashboard, twitter
          FROM jeune 
          LEFT JOIN dashboard 
            ON jeune.id = dashboard.id_user
          LEFT JOIN twitter
            ON jeune.id = twitter.id_user
          WHERE jeune.id = ?;
      ';
      $this->db->query($sql1, [$id]);
      $this->db->query($sql2, [$id]);
    }
  }
