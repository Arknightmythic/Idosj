<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class FormKuning_Model extends CI_Model {
        public function getUserData(){
            $this->db->where('id', $this->session->idAnggota);
            return $this->db->get('anggota')->row();
        }

        public function getFormData($formId){
            $query = "SELECT fka.*, a.namaDepan `ndAnggota`, a.namaBelakang `nbAnggota`, a.komunitas FROM form_kuning_anggota fka, anggota a WHERE fka.id = 6 AND a.id = fka.idAnggota";
            return $this->db->query($query)->row();
        }
    }

?>