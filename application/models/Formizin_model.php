<?php
defined('BASEPATH') or exit('No direct script access allowed !');

class FormIzin_Model extends CI_Model
{
    public function getUserData()
    {
        $this->db->where('id', $this->session->idAnggota);
        return $this->db->get('anggota')->row();
    }

    public function getFormData($formId)
    {
        $query = "SELECT fka.*, a.namaDepan `ndAnggota`, a.namaBelakang `nbAnggota`, k.nama `komunitas` FROM form_kuning_anggota fka, anggota a, komunitas k WHERE fka.id = ? AND a.id = fka.idAnggota and a.komunitas = k.id";
        return $this->db->query($query, array($formId))->row();
    }
}
