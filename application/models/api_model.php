<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Api_Model extends CI_Model {
        public function getAllAnggota(){
            return $this->db->get('anggota')->result();
        }

        public function getAnggotaByLetter($letter, $idSupDeg = NULL){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id";
            if($idSupDeg != NULL){
                $query .= " AND (a.idSuperior = '$idSupDeg' OR a.idDelegat = '$idSupDeg' OR a.id = '$idSupDeg')";
            }
            $query .= " AND namaBelakang LIKE '$letter%'";
            return $this->db->query($query)->result();
        }

        public function getAnggotaBySearch($name, $idSupDeg = NULL){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id";
            if($idSupDeg != NULL){
                $query .= " AND (a.idSuperior = '$idSupDeg' OR a.idDelegat = '$idSupDeg' OR a.id = '$idSupDeg')";
            }
            $query .= " AND (namaDepan LIKE '%$name%' OR namaBelakang LIKE '%$name%')";
            return $this->db->query($query)->result();
        }

        public function getJumlahAnggota(){
            $query = "SELECT g.statusKeanggotaan, COUNT(*) `jumlah` FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id AND statusMeninggal = false GROUP BY g.statusKeanggotaan UNION ALL SELECT 'Total',count(*) FROM anggota WHERE statusMeninggal = false";
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
                'komunitas' => $data->komunitas,
                'email' => $data->email,
                'nomorTelepon' => $data->nomorTelepon
            );

            if(isset($data->jenisGradasi)){
                $dataDiri['jenisGradasi'] = $data->jenisGradasi;
            }

            if(isset($data->statusMeninggal)){
                $dataDiri['statusMeninggal'] = $data->statusMeninggal;
            }

            if(isset($data->idSuperior)){
                $dataDiri['idSuperior'] = !empty($data->idSuperior) ? $data->idSuperior : NULL;
            }

            if(isset($data->idDelegat)){
                $dataDiri['idDelegat'] = !empty($data->idDelegat) ? $data->idDelegat : NULL;
            }

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

            if(!empty($data->fileSK)){
                $dataPerutusan['fileSK'] = $data->fileSK;
            }
            
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

        public function addSerikat($data){
            $dataSerikat = array(
                'keterangan' => $data->keterangan,
                'tanggalTempat' => $data->tanggalTempat,
                'pembimbing' => $data->pembimbing,
                'dokumen' => $data->dokumen,
                'idAnggota' => $data->id,
            );

            $this->db->insert('serikat_jesus', $dataSerikat);
        }

        public function getDataSerikatById($id){
            $this->db->where("id", $id);
            return $this->db->get('serikat_jesus')->row();
        }

        public function getAllSerikatAnggota($idAnggota){
            return $this->db->get_where('serikat_jesus', array('idAnggota' => $idAnggota))->result();
        }

        public function updateSerikat($data){
            $dataSerikat = array(
            'keterangan' => $data->keterangan,
            'tanggalTempat' => $data->tanggalTempat,
            'pembimbing' => $data->pembimbing,
            );

            if(!empty($data->dokumen)){
                $dataSerikat['dokumen'] = $data->dokumen;
            }

            $this->db->where('id', $data->id);
            $this->db->update('serikat_jesus', $dataSerikat);
        }

        public function deleteSerikat($id){
            $this->db->where('id', $id);
            $this->db->delete('serikat_jesus');
        }

        public function addInformationes($data){
            $dataInformationes = array('idAnggota' => $data->id);
            if($data->jenisInformationes == "Institusi"){
                $dataInformationes['institusi'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Teologi"){
                $dataInformationes['sebelumTeologi'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Tahbisan"){
                $dataInformationes['sebelumTahbisan'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Kaul Akhir"){
                $dataInformationes['sebelumKaulAkhir'] = $data->dokumen;
            }

            $isExist = $this->db->get_where("informationes_anggota", array('idAnggota' => $data->id))->num_rows();
            if($isExist > 0 ){
                $this->db->where('idAnggota', $data->id);
                $this->db->update('informationes_anggota', $dataInformationes);
            } else {
                $this->db->insert("informationes_anggota", $dataInformationes);
            }
            
        }

        public function updateInformationes($data){
            if($data->jenisInformationes == "Institusi"){
                $dataInformationes['institusi'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Teologi"){
                $dataInformationes['sebelumTeologi'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Tahbisan"){
                $dataInformationes['sebelumTahbisan'] = $data->dokumen;
            } else if($data->jenisInformationes == "Sebelum Kaul Akhir"){
                $dataInformationes['sebelumKaulAkhir'] = $data->dokumen;
            }

            $this->db->where('id', $data->id);
            $this->db->update('informationes_anggota', $dataInformationes);
        }

        public function getDataInformationesById($id){
            $this->db->where("id", $id);
            return $this->db->get('informationes_anggota')->row();
        }

        public function getAllInformationesAnggota($idAnggota){
            return $this->db->get_where('informationes_anggota', array('idAnggota' => $idAnggota))->result();
        }

        public function addKomentar($data){
            $isExist = $this->db->get_where("komentar_anggota", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('komentar_anggota', array('textKomentar' => $data->textKomentar));
            } else {
                $this->db->insert("komentar_anggota", array('idAnggota' => $data->idAnggota, 'textKomentar' => $data->textKomentar));
            }
        }

        public function updateKaul($data){
            $dataKaul = array(
                'tanggalKaulAkhir' => $data->tanggalKaulAkhir,
                'idAnggota' => $data->id,
            );
            if(!empty($data->suratPribadi)){
                $dataKaul['suratPribadi'] = $data->suratPribadi;
            }
            if(!empty($data->dekritKaul)){
                $dataKaul['dekritKaul'] = $data->dekritKaul;
            }
            if(!empty($data->teksKaul)){
                $dataKaul['teksKaul'] = $data->teksKaul;
            }
            if(!empty($data->teksPelepasan)){
                $dataKaul['teksPelepasan'] = $data->teksPelepasan;
            }
            if(!empty($data->testamenNotaris)){
                $dataKaul['testamenNotaris'] = $data->testamenNotaris;
            }
            $isExist = $this->db->get_where("kaul_akhir", array('idAnggota' => $data->id))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->id);
                $this->db->update('kaul_akhir', $dataKaul);
            } else {
                $this->db->insert("kaul_akhir", $dataKaul);
            }
        }

        public function addFormKuning($data){
            $dataPermohonan = array(
                'q1' => $data->q1,
                'q2' => $data->q2,
                'q3' => $data->q3,
                'q4' => $data->q4,
                'q5' => $data->q5,
                'q6' => $data->q6,
                'q7' => $data->q7,
                'q8' => $data->q8,
                'q9' => $data->q9,
                'q10' => $data->q10,
                'idSuperior' => $data->idSuperior,
                'idAnggota' => $data->idAnggota
            );
            
            $this->db->insert('form_kuning_anggota', $dataPermohonan);
        }

        public function getFormKuningById($id){
            $query = "SELECT fka.*, a.namaDepan `ndAnggota`, a.namaBelakang `nbAnggota`, a.komunitas FROM form_kuning_anggota fka, anggota a WHERE fka.id = $id AND a.id = fka.idAnggota";
            return $this->db->query($query)->row();
        }

        public function updateFormKuning($data){
            $dataPermohonan = array();

            if(!empty($data->statusProvinsial)){
                $dataPermohonan['statusProvinsial'] = $data->statusProvinsial == "true" ? 1 : 0;
                $dataPermohonan['tanggapanProvinsial'] = $data->statusProvinsial == "true" ? $data->tanggapan : NULL;
            } else if(!empty($data->statusSuperior)){
                $dataPermohonan['statusSuperior'] = $data->statusSuperior == "true" ? 1 : 0;
                $dataPermohonan['tanggapanSuperior'] = $data->statusSuperior == "true" ? $data->tanggapan : NULL;
            }

            $this->db->where('id', $data->formId);
            $this->db->update('form_kuning_anggota', $dataPermohonan);
        }

        public function addKeahlian($data){
            $dataKeahlian = array(
                "studiKhusus" => $data->studiKhusus,
                "namaInstitusi" => $data->namaInstitusi,
                "levelKeahlian" => $data->levelKeahlian,
                "dokumen" => $data->dokumen,
                "idAnggota" => $data->id,
            );

            $this->db->insert('keahlian_anggota', $dataKeahlian);
        }

        public function updateKeahlian($data){
            $dataKeahlian = array(
                "studiKhusus" => $data->studiKhusus,
                "namaInstitusi" => $data->namaInstitusi,
                "levelKeahlian" => $data->levelKeahlian,
            );
            
            if(!empty($data->dokumen)){
                $dataKeahlian['dokumen'] = $data->dokumen;
            }

            $this->db->where('id', $data->id);
            $this->db->update('keahlian_anggota', $dataKeahlian);
        }

        public function deleteKeahlian($id){
            $this->db->where('id', $id);
            $this->db->delete('keahlian_anggota');
        }

        public function getDataKeahlianById($id){
            $this->db->where('id', $id);
            return $this->db->get('keahlian_anggota')->row();
        }

        public function getAllKeahlianAnggota(){
            return $this->db->get('keahlian_anggota')->result();
        }

        public function addPublikasi($data){
            $dataPublikasi = array(
                "judul" => $data->judul,
                "tahunTerbit" => $data->tahunTerbit,
                "penerbit" => $data->penerbit,
                "jenis" => $data->jenis,
                "idAnggota" => $data->id,
            );

            $this->db->insert('publikasi_anggota', $dataPublikasi);
        }

        public function updatePublikasi($data){
            $dataPublikasi = array(
                "judul" => $data->judul,
                "tahunTerbit" => $data->tahunTerbit,
                "penerbit" => $data->penerbit,
                "jenis" => $data->jenis,
            );
            

            $this->db->where('id', $data->id);
            $this->db->update('publikasi_anggota', $dataPublikasi);
        }

        public function deletePublikasi($id){
            $this->db->where('id', $id);
            $this->db->delete('publikasi_anggota');
        }

        public function getDataPublikasiById($id){
            $this->db->where('id', $id);
            return $this->db->get('publikasi_anggota')->row();
        }

        public function getAllPublikasiAnggota(){
            return $this->db->get('publikasi_anggota')->result();
        }

        public function getDataKomunitasById($id){
            $this->db->where('id', $id);
            return $this->db->get('komunitas')->row();
        }

        public function addKomunitas($data){
            $dataKomunitas = array(
                "nama" => $data->nama,
                "residensi" => $data->residensi,
                "alamatResidensi" => $data->alamatResidensi,
            );

            $this->db->insert('komunitas', $dataKomunitas);
        }

        public function updateKomunitas($data){
            $dataKomunitas = array(
                "nama" => $data->nama,
                "residensi" => $data->residensi,
            );

            $this->db->where('id', $data->id);
            $this->db->update('komunitas', $dataKomunitas);
        }

        public function deleteKomunitas($id){
            $this->db->where('id', $id);
            $this->db->delete('komunitas');
        }

        public function getAllDokumenBersama(){
            $this->db->order_by('jenisDokumen asc', 'namaDokumen asc');
            return $this->db->get('dokumen')->result();
        }

        public function addDokumenBersama($data){
            $dataDokumen = array(
                "namaDokumen" => $data->namaDokumen,
                "jenisDokumen" => $data->jenisDokumen,
                "fileDokumen" => $data->fileDokumen,
            );

            $this->db->insert('dokumen', $dataDokumen);
        }
    }

?>