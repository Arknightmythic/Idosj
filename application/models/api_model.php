<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Api_Model extends CI_Model {
        public function getAllAnggota($idSupDeg = NULL){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id";
            if($idSupDeg != NULL){
                $query .= " AND (a.idSuperior = '$idSupDeg' OR a.idDelegat = '$idSupDeg' OR a.id = '$idSupDeg')";
            }
            return $this->db->query($query)->result();
        }
        
        // public function getJumlahAnggotaPerDekad() {
        //       // Ambil data anggota, urutkan berdasarkan tahun lahir
        //     $this->db->select('tanggalLahir');
        //     $this->db->where('jenisGradasi !=',1); // Use where_not_in for arrays
        //     $this->db->order_by('tanggalLahir', 'ASC');
        //     $query = $this->db->get('anggota');
        //     $result = $query->result_array();
    
        //     $anggotaPerDekad = [];
        //     $tahunAwalDekad = null;
    
        //     foreach ($result as $row) {
        //         $tahunLahir = substr($row['tanggalLahir'], 0, 4);
    
        //         // Hitung dekade awal
        //         if ($tahunAwalDekad === null || $tahunLahir >= $tahunAwalDekad + 10) {
        //             $tahunAwalDekad = floor($tahunLahir / 10) * 10;
        //         }
    
        //         // Pastikan $dekad adalah string
        //         $dekad = (string)($tahunAwalDekad . '-' . ($tahunAwalDekad + 9));
    
        //         if (!isset($anggotaPerDekad[$dekad])) {
        //             $anggotaPerDekad[$dekad] = 1;
        //         } else {
        //             $anggotaPerDekad[$dekad]++;
        //         }
        //     }
    
        //     return $anggotaPerDekad;
        // }
        
         public function getJumlahAnggotaPerDekad() {
        // Ambil data anggota, urutkan berdasarkan tahun lahir, dan join dengan tabel gradasi_anggota
        $this->db->select('a.tanggalLahir');
        $this->db->from('anggota a');
        $this->db->join('gradasi_anggota g', 'a.jenisGradasi = g.id');
        $this->db->where('g.statusKeanggotaan !=', 'Keluar');
        // Tambahkan kondisi untuk statusMeninggal
        $this->db->where('a.statusMeninggal', 0);
        $this->db->order_by('a.tanggalLahir', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();

        $anggotaPerDekad = [];
        $tahunAwalDekad = null;

        foreach ($result as $row) {
            $tahunLahir = substr($row['tanggalLahir'], 0, 4);

            // Hitung dekade awal
            if ($tahunAwalDekad === null || $tahunLahir >= $tahunAwalDekad + 10) {
                $tahunAwalDekad = floor($tahunLahir / 10) * 10;
            }

            // Pastikan $dekad adalah string
            $dekad = (string)($tahunAwalDekad . '-' . ($tahunAwalDekad + 9));

            if (!isset($anggotaPerDekad[$dekad])) {
                $anggotaPerDekad[$dekad] = 1;
            } else {
                $anggotaPerDekad[$dekad]++;
            }
        }

        return $anggotaPerDekad;
    }//mendapatkan data tahun lahir di statistik
    
    public function getRentangUmur(){
        $this->db->select('a.tanggalLahir');
        $this->db->from('anggota a');
        $this->db->join('gradasi_anggota g', 'a.jenisGradasi = g.id');
        $this->db->where('g.statusKeanggotaan !=', 'Keluar'); 
        $this->db->where('a.statusMeninggal', 0);
        $this->db->order_by('a.tanggalLahir', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        
        
         $anggotaPerRentangUmur = [];
        foreach ($result as $row) {
            $tahunLahir = substr($row['tanggalLahir'], 0, 4);
            $umur = date('Y') - $tahunLahir;
    
            // Pastikan umur minimal 18
            if ($umur < 18) {
                continue; // Lewati data jika umur kurang dari 18
            }
    
            // Kelompokkan berdasarkan rentang 5 tahun, mulai dari 18, atau 72++ untuk usia di atas 72
            if ($umur >= 72) {
                $rentangUmur = '72++';
            } else {
                $rentangAwal = floor(($umur - 18) / 5) * 5 + 18;
                $rentangAkhir = $rentangAwal + 4;
                $rentangUmur = "$rentangAwal-$rentangAkhir";
            }
    
            if (!isset($anggotaPerRentangUmur[$rentangUmur])) {
                $anggotaPerRentangUmur[$rentangUmur] = 1;
            } else {
                $anggotaPerRentangUmur[$rentangUmur]++;
            }
        }
    
        return $anggotaPerRentangUmur;
    }
    
         public function getJumlahAnggotaPerStatusKeanggotaan() {
                // Definisikan status keanggotaan yang ingin dihitung
                $statuses = ['Priest', 'Brother', 'Scholastic'];
                $result = [];
        
                foreach ($statuses as $status) {
                    $this->db->select('COUNT(a.id) as jumlah');
                    $this->db->from('anggota a');
                    $this->db->join('gradasi_anggota g', 'a.jenisGradasi = g.id');
                    $this->db->where('g.statusKeanggotaan', $status);
                    $this->db->where('a.statusMeninggal', 0);
                    $query = $this->db->get();
                    $row = $query->row_array();
                    $result[$status] = $row['jumlah'];
                }
        
                return $result;
            }//mendapatkan data banyaknya anggota bedasarkan status keanggotaan untuk statistik.
            
        public function getJumlahAnggotaJesuit() {
            $this->db->select('COUNT(a.id) as total_jesuit');
            $this->db->from('anggota a');
            $this->db->join('gradasi_anggota g', 'a.jenisGradasi = g.id');
            $this->db->where_in('g.statusKeanggotaan', ['Priest', 'Brother', 'Scholastic']);
            $this->db->where('a.statusMeninggal', 0);
            $query = $this->db->get();
            $result = $query->row_array();
            return $result['total_jesuit'];
        }

        
        

        public function getAnggotaByLetter($letter, $idSupDeg = NULL){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id";
            if($idSupDeg != NULL){
                $query .= " AND (a.idSuperior = '$idSupDeg' OR a.idDelegat = '$idSupDeg' OR a.id = '$idSupDeg')";
            }
            $query .= " AND namaBelakang LIKE '$letter%'";
            return $this->db->query($query)->result();
        }

        public function getAnggotaBySearch($searchQuery, $idSupDeg = NULL){
            $query = "SELECT a.*, g.namaGradasi, g.statusKeanggotaan FROM anggota a, gradasi_anggota g WHERE a.jenisGradasi = g.id";
            if($idSupDeg != NULL){
                $query .= " AND (a.idSuperior = '$idSupDeg' OR a.idDelegat = '$idSupDeg' OR a.id = '$idSupDeg')";
            }
            $query .= " AND (namaDepan LIKE '%$searchQuery%' OR namaBelakang LIKE '%$searchQuery%' OR a.id LIKE '%$searchQuery%')";
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
        
        public function updateKaulPertama($data){
            $dataKaulPertama = array(
                'tanggalKaulPertama' => $data->tanggalKaulPertama,
                'idAnggota' => $data->id,
                "tempatKaulPertama" => $data->tempatKaulPertama,
                "penerimaKaulPertama" => $data->penerimaKaulPertama,
            );
            
            if(!empty($data->suratPribadi)){
                $dataKaulPertama['suratPribadi1'] = $data->suratPribadi;
            }
            if(!empty($data->teksKaulPertama)){
                $dataKaulPertama['teksKaulPertama'] = $data->teksKaulPertama;
            }
            $isExist = $this->db->get_where("kaul_pertama", array('idAnggota' => $data->id))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->id);
                $this->db->update('kaul_pertama', $dataKaulPertama);
            } else {
                $this->db->insert("kaul_pertama", $dataKaulPertama);
            }
        }
        
        public function deleteKaulPertama($id){
            $this->db->where('id', $id);
            $this->db->delete('kaul_pertama', $dataKaulPertama);
        }

        public function getDataKaulPertamaById($id){
            $this->db->where('id', $id);
            $this->db->get('kaul_pertama', $dataKaulPertama)->row();
        }
        
        public function updateEntrance($data){
            $dataEntrance = array(
                'tanggalEntrance' => $data->tanggalEntrance,
                'idAnggota' => $data->id,
            );
            
            $isExist = $this->db->get_where("entrance", array('idAnggota' => $data->id))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->id);
                $this->db->update('entrance', $dataEntrance);
            } else {
                $this->db->insert("entrance", $dataEntrance);
            }
        }
        
        public function deleteEntrance($id){
            $this->db->where('id', $id);
            $this->db->delete('entrance', $dataEntrance);
        }

        public function getEntranceById($id){
            $this->db->where('id', $id);
            $this->db->get('entrance', $dataEntrance)->row();
        }

        
        
        public function updateLektorAkolit($data){
            $dataLektorAkolit = array(
                'tanggalLektorAkolit' => $data->tanggalLektorAkolit,
                'idAnggota' => $data->id,
                "tempatLektorAkolit" => $data->tempatLektorAkolit,
                "penerimaLektorAkolit" => $data->penerimaLektorAkolit,
            );

            $isExist = $this->db->get_where("lektor_akolit", array('idAnggota' => $data->id))->num_rows();
            if ($isExist > 0) {
                $this->db->where('idAnggota', $data->id);
                $this->db->update('lektor_akolit', $dataLektorAkolit);
            } else {
                $this->db->insert("lektor_akolit", $dataLektorAkolit);
            }
        }

        public function deleteLektorAkolit($id){
            $this->db->where('id', $id);
            $this->db->delete('lektor_akolit', $dataLetorAkolit);
        }

        public function getDataLektorAkolitById($id){
            $this->db->where('id', $id);
            $this->db->get('lektor_akolit', $dataLetorAkolit);
        }
        
        public function updateTahbisanDiakon($data){
            $dataTahbisanDiakon = array(
                'tanggalTahbisanDiakon' => $data->tanggalDeaconOrdination,
                'idAnggota' => $data->id,
                "tempatTahbisanDiakon" => $data->tempatDeaconOrdination,
                "pentahbis" => $data->penerimaDeaconOrdination,
            );

            $isExist = $this->db->get_where("tahbisan_diakon", array('idAnggota' => $data->id))->num_rows();
            if ($isExist > 0) {
                $this->db->where('idAnggota', $data->id);
                $this->db->update('tahbisan_diakon', $dataTahbisanDiakon);
            } else {
                $this->db->insert("tahbisan_diakon", $dataTahbisanDiakon);
            }
        }

        public function deleteTahbisanDiakon($id){
            $this->db->where('id', $id);
            $this->db->delete('tahbisan_diakon', $dataTahbisanDiakon);
        }

        public function getDataTahbisanDiakonById($id){
            $this->db->where('id', $id);
            $this->db->get('tahbisan_diakon', $dataTahbisanDiakon);
        }
        
        public function updateTahbisanImamat($data){
            $dataTahbisanImamat = array(
                'tanggalTahbisanImamat' => $data->tanggalTahbisanImamat,
                'idAnggota' => $data->id,
                "tempatTahbisanImamat" => $data->tempatTahbisanImamat,
                "ordainer" => $data->ordainer,
            );
            
            $isExist = $this->db->get_where("tahbisan_imamat", array('idAnggota' => $data->id))->num_rows();
            if ($isExist > 0) {
                $this->db->where('idAnggota', $data->id);
                $this->db->update('tahbisan_imamat', $dataTahbisanImamat);
            } else {
                $this->db->insert("tahbisan_imamat", $dataTahbisanImamat);
            }
        }

        public function deleteTahbisanImamat($id){
            $this->db->where('id', $id);
            $this->db->delete('tahbisan_imamat', $dataTahbisanImamat);
        }

        public function getDataTahbisanImamatById($id){
            $this->db->where('id', $id);
            $this->db->get('tahbisan_imamat', $dataTahbisanImamat);
        }
        
        public function updateTersiat($data){
            $dataTersiat = array(
                'fromDateTersiat' => $data->fromDateTersiat,
                'endDateTersiat' => $data->endDateTersiat,
                'idAnggota' => $data->id,
                "tempatTersiat" => $data->tempatTersiat,
                "instrukturTersiat" => $data->instrukturTersiat,
            );
            
            $isExist = $this->db->get_where("tersiat", array('idAnggota' => $data->id))->num_rows();
            if ($isExist > 0) {
                $this->db->where('idAnggota', $data->id);
                $this->db->update('tersiat', $dataTersiat);
            } else {
                $this->db->insert("tersiat", $dataTersiat);
            }
        }

        public function deleteTersiat($id){
            $this->db->where('id', $id);
            $this->db->delete('tersiat', $dataTersiat);
        }

        public function getDataTersiatById($id){
            $this->db->where('id', $id);
            $this->db->get('tersiat', $dataTersiat);
        }

        
        public function updateKaulAkhir($data){
            $dataKaulAkhir = array(
                'tanggalKaulAkhir' => $data->tanggalKaulAkhir,
                'idAnggota' => $data->id,
                 "tempatKaulAkhir" => $data->tempatKaulAkhir,
                "penerimaKaulAkhir" => $data->penerimaKaulAkhir,
            );
            if(!empty($data->suratPribadi)){
                $dataKaulAkhir['suratPribadi'] = $data->suratPribadi;
            }
            if(!empty($data->dekritKaul)){
                $dataKaulAkhir['dekritKaul'] = $data->dekritKaul;
            }
            if(!empty($data->teksKaul)){
                $dataKaulAkhir['teksKaul'] = $data->teksKaul;
            }
            if(!empty($data->teksPelepasan)){
                $dataKaulAkhir['teksPelepasan'] = $data->teksPelepasan;
            }
            if(!empty($data->testamenNotaris)){
                $dataKaulAkhir['testamenNotaris'] = $data->testamenNotaris;
            }
            $isExist = $this->db->get_where("kaul_akhir", array('idAnggota' => $data->id))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->id);
                $this->db->update('kaul_akhir', $dataKaulAkhir);
            } else {
                $this->db->insert("kaul_akhir", $dataKaulAkhir);
            }
        }
        
         public function deleteKaulAkhir($id){
            $this->db->where('id', $id);
            $this->db->delete('kaul_akhir', $dataKaulAkhir);
        }

        public function getDataKaulAkhirById($id){
            $this->db->where('id', $id);
            $this->db->get('kaul_akhir', $dataKaulAkhir);
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
                'q11' => $data->q11,
                'idSuperior' => $data->idSuperior,
                'idAnggota' => $data->idAnggota
            );
            
            $this->db->insert('form_kuning_anggota', $dataPermohonan);
        }
        
        public function addFormKuningSuperior($data){
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
                'q11' => $data->q11,
                'statusSuperior'=>$data->statusSuperior,
                // 'idSuperior' => $data->idSuperior,
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

        //albert update
        public function addFormIzin($data){
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
                'FormType' => $data->FormType,
                'statusSuperior'=>$data->statusSuperior,
                'idSuperior' => $data->idSuperior,
                'idAnggota' => $data->idAnggota
            );
            
            $this->db->insert('form_kuning_anggota', $dataPermohonan);
        }
        
        public function addFormIzinSuperior($data){
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
                'FormType' => $data->FormType,
                'statusSuperior'=>$data->statusSuperior,
                // 'idSuperior' => $data->idSuperior,
                'idAnggota' => $data->idAnggota
            );
            
            $this->db->insert('form_kuning_anggota', $dataPermohonan);
        }

        public function getFormIzinById($id){
            $query = "SELECT fka.*, a.namaDepan `ndAnggota`, a.namaBelakang `nbAnggota`, a.komunitas FROM form_kuning_anggota fka, anggota a WHERE fka.id = $id AND a.id = fka.idAnggota";
            return $this->db->query($query)->row();
        }

        public function updateFormIzin($data){
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

        //albert finish update

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
        
        public function addKesehatan($data){
            $dataKesehatan = array(
                "diagnosis" => $data->diagnosis,
                "hospital" => $data->hospital,
                "date" => $data->date,
                "notes" => $data->notes,
                "dokumen" => $data->dokumen,
                "idAnggota" => $data->id,
            );

            $this->db->insert('kesehatan_anggota', $dataKesehatan);
        }

        public function updateKesehatan($data){
            $dataKesehatan = array(
                "diagnosis" => $data->diagnosis,
                "hospital" => $data->hospital,
                "date" => $data->date,
                "notes" => $data->notes,
            );
            
            if(!empty($data->dokumen)){
                $dataKeahlian['dokumen'] = $data->dokumen;
            }

            $this->db->where('id', $data->id);
            $this->db->update('kesehatan_anggota', $dataKesehatan);
        }

        public function deleteKesehatan($id){
            $this->db->where('id', $id);
            $this->db->delete('kesehatan_anggota');
        }
        
        public function getDataKesehatanById($id){
            $this->db->where('id', $id);
            return $this->db->get('kesehatan_anggota')->row();
        }

        public function getAllKesehatanAnggota(){
            return $this->db->get('kesehatan_anggota')->result();
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

        public function getDokumenBersamaById($id){
            $this->db->where('id', $id);
            return $this->db->get('dokumen')->row();
        }

        public function addDokumenBersama($data){
            $dataDokumen = array(
                "namaDokumen" => $data->namaDokumen,
                "jenisDokumen" => $data->jenisDokumen,
                "fileDokumen" => $data->fileDokumen,
            );

            $this->db->insert('dokumen', $dataDokumen);
        }

        public function updateDokumenBersama($data){
            $dataDokumen = array(
                "namaDokumen" => $data->namaDokumen,
                "jenisDokumen" => $data->jenisDokumen,
            );

            if(!empty($data->fileDokumen)){
                $dataDokumen['fileDokumen'] = $data->fileDokumen;
            }

            $this->db->where('id', $data->id);
            $this->db->update('dokumen', $dataDokumen);
        }

        public function deleteDokumenBersama($id){
            $this->db->delete('dokumen', array('id' => $id));
        }
        
        public function updateDimissi($data){
            $dataDimissi = array(
                "idAnggota" => $data->idAnggota,
            );
            $dataDimissi["$data->jenisDokumen"] = $data->dokumen;

            $isExist = $this->db->get_where("dimissi_anggota", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('dimissi_anggota', $dataDimissi);
            } else {
                $this->db->insert("dimissi_anggota", $dataDimissi);
            }
        }

        public function updateLaisasi($data){
            $dataLaisasi = array(
                "idAnggota" => $data->idAnggota,
            );
            $dataLaisasi["$data->jenisDokumen"] = $data->dokumen;

            $isExist = $this->db->get_where("laisasi_anggota", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('laisasi_anggota', $dataLaisasi);
            } else {
                $this->db->insert("laisasi_anggota", $dataLaisasi);
            }
        }

        public function updateKematian($data){
            $dataKematian = array(
                "tanggal" => $data->tanggal,
                "tempat" => $data->tempat,
                "waktu" => $data->waktu,
                "makam" => $data->makam,
                "aktaKematian" => $data->aktaKematian,
                "keteranganKematian" => $data->keteranganKematian,
                "idAnggota" => $data->idAnggota,
            );

            $isExist = $this->db->get_where("kematian_anggota", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('kematian_anggota', $dataKematian);
            } else {
                $this->db->insert("kematian_anggota", $dataKematian);
            }
        }

        public function getEmailByIdAnggota($idAnggota){
            $this->db->where('id', $idAnggota);
            return $this->db->get('anggota')->row()->email;
        }

        public function getInformasiNovisiatTersiat($idAnggota){
            $this->db->where('idAnggota', $idAnggota);
            return $this->db->get('informasi_novisiat_tersiat')->row();
        }

        public function updateInformasiNovisiatTersiat($data){
            $isExist = $this->db->get_where("informasi_novisiat_tersiat", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('informasi_novisiat_tersiat', array($data->columnField => $data->dokumen));
            } else {
                $this->db->insert("informasi_novisiat_tersiat", array('idAnggota' => $data->idAnggota, $data->columnField => $data->dokumen));
            }
        }

        public function deleteInformasiNovisiatTersiat($data){
            $this->db->where('idAnggota', $data->idAnggota);
            $this->db->update('informasi_novisiat_tersiat', array($data->columnField => NULL));
        }

        public function updateCatatanNovisiatTersiat($data){
            $isExist = $this->db->get_where("informasi_novisiat_tersiat", array('idAnggota' => $data->idAnggota))->num_rows();
            if($isExist > 0){
                $this->db->where('idAnggota', $data->idAnggota);
                $this->db->update('informasi_novisiat_tersiat', array($data->columnField => $data->catatan));
            } else {
                $this->db->insert("informasi_novisiat_tersiat", array('idAnggota' => $data->idAnggota, $data->columnField => $data->catatan));
            }
        }
    }

?>