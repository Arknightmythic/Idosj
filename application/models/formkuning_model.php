<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class FormKuning_Model extends CI_Model {
        public function getUserData(){
            $this->db->where('id', $this->session->idAnggota);
            return $this->db->get('anggota')->row();
        }
    }

?>