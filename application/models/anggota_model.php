<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Anggota_Model extends CI_Model {
        public function getDataPribadi($idAnggota){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan, u.idRole, r.namaRole FROM anggota a, gradasi_anggota g, user u, `role` r WHERE a.jenisGradasi = g.id AND u.idRole = r.id AND u.idAnggota = a.id AND a.id = ?";
            return $this->db->query($query, array($idAnggota))->row();
        }

        public function getDataPendidikan($idAnggota){
            $query = "SELECT p.*, namaJenjang FROM pendidikan_anggota p, jenjang_pendidikan j WHERE idAnggota = ? and p.tingkatJenjang = j.id ORDER BY tahunMasuk";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataSakramen($idAnggota){
            $query = "SELECT * FROM sakramen_anggota WHERE idAnggota = ? ORDER BY tanggalPenerimaan";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataBahasa($idAnggota){
            $query = "SELECT * FROM bahasa b, bahasa_anggota ba  WHERE idAnggota = ? AND b.id = ba.idBahasa ORDER BY namaBahasa";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataDokumen($idAnggota){
            $query = "SELECT * FROM dokumen_anggota WHERE idAnggota = ? ORDER BY namaDokumen";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataOrangTua($idAnggota){
            $query = "select ra.*, namaRelasi from relasi_anggota ra, jenis_relasi jr where idAnggota = ? and ra.idJenisRelasi = jr.id and (namaRelasi = 'Ayah' or namaRelasi = 'Ibu') order by namaRelasi";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataSaudaraKandung($idAnggota){
            $query = "select ra.*, namaRelasi from relasi_anggota ra, jenis_relasi jr where idAnggota = ? and ra.idJenisRelasi = jr.id and namaRelasi = 'Saudara Kandung' order by namaLengkap";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataKontakDarurat($idAnggota){
            $query = "select ra.*, namaRelasi from relasi_anggota ra, jenis_relasi jr where idAnggota = ? and ra.idJenisRelasi = jr.id and kontakDarurat = true and statusMeninggal = false order by namaLengkap";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataPerutusan($idAnggota){
            $query = "select * from perutusan_anggota where idAnggota = ? order by tahunMasuk";
            return $this->db->query($query, array($idAnggota))->result();
        }

        public function getDataPerjalanan($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            $this->db->order_by('q1', 'asc');
            return $this->db->get('form_kuning_anggota')->result();
        }

        public function getAllJenisRelasi(){
            return $this->db->get('jenis_relasi')->result();
        }

        public function getDataSerikat($idAnggota){
            return $this->db->get_where('serikat_jesus', array('idAnggota' => $idAnggota))->result();
        }

        public function getDataInformationes($idAnggota){
            return $this->db->get_where("informationes_anggota", array('idAnggota' => $idAnggota))->row();
        }

        public function getDataKomentar($idAnggota){
            return $this->db->get_where("komentar_anggota", array('idAnggota' => $idAnggota))->row();
        }

        public function getDataKaulAkhir($idAnggota){
            return $this->db->get_where("kaul_akhir", array('idAnggota' => $idAnggota))->row();
        }
    }

?>