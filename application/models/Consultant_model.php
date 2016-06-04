<?php
class Consultant_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
        }

        public function recupIdRef($lien)
        {
                $tabIdRef=[];
                $tab=array(
                        'lien_consultation'=>$lien);
                $tabIdRef = $this->db->get_where("groupement",$tab);
                return $tabIdRef->result();
        }
        public function recupRef($tabIdRef)
        {
        $acc=[];
        for ($i=0; $i <count($tabIdRef) ; $i++) { 
           array_push($acc,$tabIdRef[$i]->id_ref);     
        }
        $this->db->where_in('id', $acc);
        $this->db->from('reference'); 
        $toto = $this->db->get();
        return $toto->result();
        }
} 
