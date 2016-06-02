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
                $tabIdRef=[];
                $this->db->select('lien_consultation');
                $lienCon = $this->db->get('groupement');
                foreach ($lienCon as $value) {
                if($value== $lien) {
                        $this->db->select('id_ref');
                        $id = $this->db->get('groupement');
                        $tabIdRef = [$tabIdRef]
                }
                }
                return $query->result();
        }
} 
?>