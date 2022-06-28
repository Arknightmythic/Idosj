<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Api_Model extends CI_Model {
        public function getAllAnggota(){
            return $this->db->get('anggota')->result();
        }

        public function getAnggotaByLetter($letter){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.kodeGradasi AND namaBelakang LIKE '$letter%'";
            return $this->db->query($query)->result();
        }

        public function getAnggotaBySearch($name){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.kodeGradasi AND (namaDepan LIKE '%$name%' OR namaBelakang LIKE '%$name%')";
            return $this->db->query($query)->result();
        }

        public function getJumlahAnggota(){
            $query = "SELECT g.statusKeanggotaan, COUNT(*) `jumlah` FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.kodeGradasi GROUP BY g.statusKeanggotaan UNION ALL SELECT 'Total',count(*) FROM anggota";
            return $this->db->query($query)->result();
        }

        public function getUserListByRole($role){
            $query = "SELECT u.id, idAnggota, username, namaLengkap, namaRole FROM user u, role r WHERE u.idRole = r.id and namaRole = ?";
            return $this->db->query($query, array($role))->result();
        }

        public function deleteAdmin($userID){
            $this->db->where('id', $userID);
            $this->db->delete('user');
        }

        public function deletePersonal($idAnggota){
            $this->db->where('id', $idAnggota);
            $this->db->delete('anggota');
        }

        public function addAdmin($namaLengkap, $username, $password, $idRole){
            $data = array(
                'username' => $this->input->post('username'),
                'namaLengkap' => $namaLengkap,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'idRole' => $this->input->post('idRole')
            );
            $this->db->insert('user', $data);
        }

        public function addPersonal($idAnggota, $namaDepan, $namaBelakang, $jenisGradasi, $username, $password){
            foreach($this->api_model->getAllRoles() as $role){
                if($role->namaRole == "Personal"){
                    $idRole = $role->id;
                }
            }
            if($this->db->get_where('user', array('idAnggota' => $idAnggota))->num_rows() > 0){
                return "Anggota dengan ID ini sudah memiliki akun personal.";
            }
            
            // Memasukkan data anggota ke tabel anggota
            $dataAnggota = array(
                'id' => $idAnggota,
                'namaDepan' => $namaDepan,
                'namaBelakang' => $namaBelakang,
                'jenisGradasi' => $jenisGradasi,
            );
            $this->db->insert('anggota', $dataAnggota);
            // Memasukkan data user ke tabel user
            $dataUser = array(
                'username' => $username,
                'namaLengkap' => $namaBelakang . ", " .  $namaDepan,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'idRole' => $idRole,
                'idAnggota' => $idAnggota
            );
            $this->db->insert('user', $dataUser);
        }

        public function getAllRoles(){
            return $this->db->get('role')->result();
        }

        public function getAllGradasi(){
            return $this->db->order_by('namaGradasi')->get('gradasi_anggota')->result();
        }

        public function getAllJenjangPendidikan(){
            return $this->db->order_by('namaJenjang')->get('jenjang_pendidikan')->result();
        }

        public function updateDataDiri($data){
            $dataDiri = array(
                'namaDepan' => $data->namaDepan,
                'namaBelakang' => $data->namaBelakang,
                'tempatLahir' => $data->tempatLahir,
                'tanggalLahir' => date('Y-m-d G:i:s', strtotime($data->tanggalLahir)),
                'golonganDarah' => $data->golonganDarah,
                'alamat' => $data->alamat,
                'komunitas' => $data->komunitas,
                'email' => $data->email,
                'nomorTelepon' => $data->nomorTelepon,
                'jenisGradasi' => $data->jenisGradasi,
                'statusMeninggal' => $data->statusMeninggal,
                'idSuperior' => !empty($data->idSuperior) ? $data->idSuperior : NULL,
                'idDelegat' => !empty($data->idDelegat) ? $data->idDelegat : NULL,
            );
            if($data->fotoProfile != NULL){
                $dataDiri["fotoProfile"] = $data->fotoProfile;
            }
            $this->db->where('id', $data->id);
            $this->db->update('anggota', $dataDiri);

            $dataUser = array('namaLengkap' => $data->namaBelakang . ", " .  $data->namaDepan,);
            if(isset($data->idRole)){
                $dataUser["idRole"] = $data->idRole;
            }

            $this->db->where("idAnggota", $data->id);
            $this->db->update("user", $dataUser);
        }

        public function addPendidikanAnggota($data){
            $dataPendidikan = array(
                'namaInstitusi' => $data->namaInstitusi,
                'tahunMasuk' => $data->tahunMasuk,
                'tahunLulus' => $data->tahunLulus,
                'kelengkapanIjazah' => $data->kelengkapanIjazah,
                'tingkatJenjang' => $data->tingkatJenjang,
                'idAnggota' => $data->id,
            );

            $this->db->insert('pendidikan_anggota', $dataPendidikan);
        }

        public function getDataPendidikanById($id){
            $this->db->where("id", $id);
            return $this->db->get('pendidikan_anggota')->row();
        }

        public function getAllPendidikanAnggota($idAnggota){
            return $this->db->get_where('pendidikan_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function updatePendidikanAnggota($data){
            $dataPendidikan = array(
                'namaInstitusi' => $data->namaInstitusi,
                'tahunMasuk' => $data->tahunMasuk,
                'tahunLulus' => $data->tahunLulus,
                'kelengkapanIjazah' => $data->kelengkapanIjazah,
                'tingkatJenjang' => $data->tingkatJenjang,
            );
            
            $this->db->where('id', $data->id);
            $this->db->update('pendidikan_anggota', $dataPendidikan);
        }

        public function deletePendidikanAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('pendidikan_anggota');
        }

        public function addSakramenAnggota($data){
            $dataSakramen = array(
                'namaSakramen' => $data->namaSakramen,
                'tanggalPenerimaan' => date('Y-m-d G:i:s', strtotime($data->tanggalPenerimaan)) ,
                'keterangan' => !empty($data->keterangan) ? $data->keterangan : NULL,
                'idAnggota' => $data->id,
            );

            $this->db->insert('sakramen_anggota', $dataSakramen);
        }

        public function getDataSakramenById($id){
            $this->db->where("id", $id);
            return $this->db->get('sakramen_anggota')->row();
        }

        public function getAllSakramenAnggota($idAnggota){
            return $this->db->get_where('sakramen_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function updateSakramenAnggota($data){
            $dataSakramen = array(
                'namaSakramen' => $data->namaSakramen,
                'tanggalPenerimaan' => date('Y-m-d G:i:s', strtotime($data->tanggalPenerimaan)) ,
                'keterangan' => !empty($data->keterangan) ? $data->keterangan : NULL,
            );
            
            $this->db->where('id', $data->id);
            $this->db->update('sakramen_anggota', $dataSakramen);
        }

        public function deleteSakramenAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('sakramen_anggota');
        }

        public function getAllBahasa(){
            return $this->db->get('bahasa')->result();
        }

        public function addBahasaAnggota($data){
            $dataBahasa = array(
                'statusReading' => isset($data->statusReading) ? 1 : 0,
                'statusWriting' => isset($data->statusWriting) ? 1 : 0,
                'statusSpeaking' => isset($data->statusSpeaking) ? 1 : 0,
                'idBahasa' => $data->idBahasa,
                'idAnggota' => $data->id,
            );

            $this->db->insert('bahasa_anggota', $dataBahasa);
        }

        public function updateBahasaAnggota($data){
            $dataBahasa = array(
                'statusReading' => isset($data->statusReading) ? 1 : 0,
                'statusWriting' => isset($data->statusWriting) ? 1 : 0,
                'statusSpeaking' => isset($data->statusSpeaking) ? 1 : 0,
                'idBahasa' => $data->idBahasa,
            );
            
            $this->db->where('id', $data->id);
            $this->db->update('bahasa_anggota', $dataBahasa);
        }

        public function getDataBahasaById($id){
            $this->db->where("id", $id);
            return $this->db->get('bahasa_anggota')->row();
        }

        public function getAllBahasaAnggota($idAnggota){
            return $this->db->get_where('bahasa_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function deleteBahasaAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('bahasa_anggota');
        }

        public function addDokumenAnggota($data){
            $dataDokumen = array(
                'namaDokumen' => $data->namaDokumen,
                'nomorDokumen' => $data->nomorDokumen,
                'idAnggota' => $data->id,
            );

            $this->db->insert('dokumen_anggota', $dataDokumen);
        }

        public function updateDokumenAnggota($data){
            $dataDokumen = array(
                'namaDokumen' => $data->namaDokumen,
                'nomorDokumen' => $data->nomorDokumen,
            );

            $this->db->where('id', $data->id);
            $this->db->update('dokumen_anggota', $dataDokumen);
        }

        public function getDataDokumenById($id){
            $this->db->where("id", $id);
            return $this->db->get('dokumen_anggota')->row();
        }

        public function getAllDokumenAnggota($idAnggota){
            return $this->db->get_where('dokumen_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function deleteDokumenAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('dokumen_anggota');
        }

        public function addRelasiAnggota($data){
            $dataRelasi = array(
                'namaLengkap' => $data->namaLengkap,
                'alamat' => $data->alamat,
                'pekerjaan' => $data->pekerjaan,
                'nomorTelepon' => $data->nomorTelepon,
                'email' => $data->email,
                'kontakDarurat' => isset($data->kontakDarurat) ? 1 : 0,
                'statusMeninggal' => $data->statusMeninggal,
                'idJenisRelasi' => $data->idJenisRelasi,
                'idAnggota' => $data->id,
            );
            
            $this->db->insert('relasi_anggota', $dataRelasi);
        }

        public function updateRelasiAnggota($data){
            $dataRelasi = array(
                'namaLengkap' => $data->namaLengkap,
                'alamat' => $data->alamat,
                'pekerjaan' => $data->pekerjaan,
                'nomorTelepon' => $data->nomorTelepon,
                'email' => $data->email,
                'kontakDarurat' => isset($data->kontakDarurat) ? 1 : 0,
                'statusMeninggal' => $data->statusMeninggal,
                'idJenisRelasi' => $data->idJenisRelasi,
            );
            
            $this->db->where('id', $data->id);
            $this->db->update('relasi_anggota', $dataRelasi);
        }

        public function deleteRelasiAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('relasi_anggota');
        }

        public function getDataRelasiById($id){
            $this->db->where("id", $id);
            return $this->db->get('relasi_anggota')->row();
        }

        public function getAllRelasiAnggota($idAnggota){
            return $this->db->get_where('relasi_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function addPerutusanAnggota($data){
            $dataPerutusan = array(
                'tempatPerutusan' => $data->tempatPerutusan,
                'keterangan' => $data->keterangan,
                'tahunMasuk' => $data->tahunMasuk,
                'tahunBerakhir' => $data->tahunBerakhir,
                'fileSK' => $data->fileSK,
                'idAnggota' => $data->id,
            );

            $this->db->insert('perutusan_anggota', $dataPerutusan);
        }

        public function updatePerutusanAnggota($data){
            $dataPerutusan = array(
                'tempatPerutusan' => $data->tempatPerutusan,
                'keterangan' => $data->keterangan,
                'tahunMasuk' => $data->tahunMasuk,
                'tahunBerakhir' => $data->tahunBerakhir,
            );
            
            $this->db->where('id', $data->id);
            $this->db->update('perutusan_anggota', $dataPerutusan);
        }

        public function deletePerutusanAnggota($id){
            $this->db->where('id', $id);
            $this->db->delete('perutusan_anggota');
        }

        public function getDataPerutusanById($id){
            $this->db->where("id", $id);
            return $this->db->get('perutusan_anggota')->row();
        }

        public function getAllPerutusanAnggota($idAnggota){
            return $this->db->get_where('perutusan_anggota', array('idAnggota' => $idAnggota))->result();
        }

    }   

?>