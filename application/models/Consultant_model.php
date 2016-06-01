<?php
class Consultant_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
        }

        public function affichage($lien)
        {
                $this->db->select('nom');
                $query = $this->db->get('savoir_etre');
                return $query->result();
        }
} 
?>