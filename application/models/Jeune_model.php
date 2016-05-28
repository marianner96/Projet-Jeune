<?php
class Jeune_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->library('session');
        }

        public function savoiretre()
        {
                $this->db->select('nom');
                $query = $this->db->get('savoir_etre');
                return $query->result();
        }
        public function creationReferences()
        {
                $tab = $this->session->userdata('logged_in');
                $reference = array(
                        'id_user' => $tab['id'] ,
                        'description' => set_value('description'),
                        'duree' => set_value('duree') , 
                        'etat' => 1, 
                        'nom' => set_value('nom') , 
                        'prenom' => set_value('prenom'), 
                        'mail' => set_value('mail'));
                $this->db->insert('reference', $reference);
                $nombre =  count($this->input->post('savoirEtre'));
                $lastID=$this->db->insert_id();
                for($i=0;$i<$nombre;$i++){
                        $savoir = array(
                        'id_ref'=>$lastID,
                        'id_savoir_etre'=>set_value('savoirEtre[]'));
                        $this->db->insert('savoir_etre_user',$savoir);
                }
        }
} 
?>