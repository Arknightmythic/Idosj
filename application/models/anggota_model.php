<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Anggota_Model extends CI_Model {
        public function getDataPribadi($idAnggota){
            // $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan, u.idRole, r.namaRole, k.nama `namaKomunitas`, k.residensi `namaResidensi` FROM anggota a, gradasi_anggota g, user u, `role` r, komunitas k WHERE a.jenisGradasi = g.id AND u.idRole = r.id AND u.idAnggota = a.id AND k.id = a.komunitas AND a.id = ?";
            $query = "  SELECT a.*, g.namaGradasi, g.statusKeanggotaan, u.idRole, r.namaRole,
                        case when a.komunitas is not null then k.nama else null end as `namaKomunitas`,
                        case when a.komunitas is not null then k.residensi else null end as `namaResidensi`,
                        case when a.komunitas is not null then k.alamatResidensi else null end as `alamat`
                        FROM anggota a, gradasi_anggota g, user u, `role` r, komunitas k
                        WHERE a.jenisGradasi = g.id AND u.idRole = r.id AND u.idAnggota = a.id
                        AND CASE WHEN a.komunitas IS NOT NULL THEN k.id = a.komunitas else a.komunitas is null end
                        AND a.id = ? LIMIT 1
                    ";
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
        
        public function getDataKeahlian($idAnggota){
            return $this->db->get_where("keahlian_anggota", array('idAnggota' => $idAnggota))->result();
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
        
        public function getDataKaulPertama($idAnggota){
            return $this->db->get_where("kaul_pertama", array('idAnggota' => $idAnggota))->row();
        }
        
        public function getEntrance($idAnggota){
            return $this->db->get_where("entrance", array('idAnggota' => $idAnggota))->row();
        }
        
        public function getDataLektorAkolit($idAnggota){
            return $this->db->get_where("lektor_akolit", array('idAnggota' => $idAnggota))->row();
        }
        
        public function getDataTahbisanDiakon($idAnggota){
            return $this->db->get_where("tahbisan_diakon", array('idAnggota' => $idAnggota))->row();
        }

        public function getDataTahbisanImamat($idAnggota){
            return $this->db->get_where("tahbisan_imamat", array('idAnggota' => $idAnggota))->row();
        }

        public function getDataTersiat($idAnggota){
            return $this->db->get_where("tersiat", array('idAnggota' => $idAnggota))->row();
        }

        public function getDataPublikasi($idAnggota){
            return $this->db->get_where("publikasi_anggota", array('idAnggota' => $idAnggota))->result();
        }
        
        public function getDataKesehatan($idAnggota){
            return $this->db->get_where("kesehatan_anggota", array('idAnggota' => $idAnggota))->result();
        }

        public function checkIsAnggotaExist($idAnggota){
            if($this->db->get_where('anggota', array('id' => $idAnggota))->num_rows() > 0){
                return true;
            } else {
                return false;
            }
        }

        public function getAllKomunitas($onlyKomunitas = false){
            if($onlyKomunitas){
                $this->db->group_by('nama');
            }
            
            $this->db->order_by('nama', 'asc');
            return $this->db->get('komunitas')->result();
        }

        public function getAllResidensi($namaKomunitas){
            $this->db->where('nama', $namaKomunitas);
            return $this->db->get('komunitas')->result();
        }

        public function getAllAnggotaByResidensi($idResidensi){
            $this->db->where('komunitas', $idResidensi);
            return $this->db->get('anggota')->result();
        }

        public function getAllDokumenBersama(){
            $this->db->order_by('jenisDokumen asc', 'namaDokumen asc');
            return $this->db->get('dokumen')->result();
        }

        public function getDataDimissi($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            return $this->db->get('dimissi_anggota')->row();
        }

        public function getDataLaisasi($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            return $this->db->get('laisasi_anggota')->row();
        }

        public function getDataKematian($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            return $this->db->get('kematian_anggota')->row();
        }

        public function getDataNovisiatTersiat($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            return $this->db->get('informasi_novisiat_tersiat')->row();
        }
    }
