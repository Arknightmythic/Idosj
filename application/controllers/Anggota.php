<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Anggota extends CI_Controller {
        public function __construct() {
            parent::__construct();
		    $this->load->model('auth_model');
            $this->load->model('anggota_model');
            $this->load->model('api_model');
            $this->form_validation->set_error_delimiters('', '');

            if(!$this->auth_model->verifyCookies()){
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
                } else {
                    $uri = uri_string();
                }
                $this->session->set_userdata('redirect', $uri);
                redirect('/auth');
            }
        }

        private function _checkIsIdValid($idAnggota){
            if(empty($idAnggota)){
                redirect('/');
            } else {
                if(!$this->anggota_model->checkIsAnggotaExist($idAnggota)){
                    show_404();
                } else if($this->session->role == "Personal" && $this->session->idAnggota !== $idAnggota){
                    redirect('anggota/pribadi/' . $this->session->idAnggota);
                }
            }
        }

        // Page Pribadi
        public function pribadi($idAnggota = NULL) {
            $this->_checkIsIdValid($idAnggota);

            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Profil Pribadi";

            if(!empty($this->input->get('edit'))){
                $data["editStatus"] = true;
                $data["gradasiAnggota"] = $this->api_model->getAllGradasi();
                $data["jenjangPendidikan"] = $this->api_model->getAllJenjangPendidikan();
                $data["kemampuanBahasa"] = $this->api_model->getAllBahasa();
                $data["listRole"] = $this->api_model->getAllRoles();
                $data["listSuperior"] = $this->api_model->getUserListByRole("Superior");
                $data["listDelegat"] = $this->api_model->getUserListByRole("Delegat");
            } else {
                $data["editStatus"] = false;
            }

            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "pribadi";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPendidikan"] = $this->anggota_model->getDataPendidikan($idAnggota);
            $data["dataSakramen"] = $this->anggota_model->getDataSakramen($idAnggota);
            $data["dataBahasa"] = $this->anggota_model->getDataBahasa($idAnggota);
            $data["dataDokumen"] = $this->anggota_model->getDataDokumen($idAnggota);
            $data["dataKomunitas"] = $this->anggota_model->getAllKomunitas();
            
            $this->load->view('page/PribadiPage.php', $data, FALSE);
        }

        public function keluarga($idAnggota = NULL) {
            $this->_checkIsIdValid($idAnggota);

            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Keluarga dan Relasi";

            if(!empty($this->input->get('edit'))){
                $data["editStatus"] = true;
                $data["jenisRelasi"] = $this->anggota_model->getAllJenisRelasi();
            } else {
                $data["editStatus"] = false;
            }
            
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "keluarga";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataOrangTua"] = $this->anggota_model->getDataOrangTua($idAnggota);
            $data["dataSaudaraKandung"] = $this->anggota_model->getDataSaudaraKandung($idAnggota);
            $data["dataKontakDarurat"] = $this->anggota_model->getDataKontakDarurat($idAnggota);
            
            $this->load->view('page/KeluargaPage.php', $data, FALSE);
        }

        public function perutusan($idAnggota = NULL) {
            $this->_checkIsIdValid($idAnggota);

            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Perutusan";

            if(!empty($this->input->get('edit'))){
                $data["editStatus"] = true;
            } else {
                $data["editStatus"] = false;
            }
            
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "perutusan";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPerutusan"] = $this->anggota_model->getDataPerutusan($idAnggota);

            $this->load->view('page/PerutusanPage.php', $data, FALSE);
        }

        public function perjalanan($idAnggota = NULL) {
            $this->_checkIsIdValid($idAnggota);

            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Perjalanan";
            
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "perjalanan";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPerjalanan"] = $this->anggota_model->getDataPerjalanan($idAnggota);

            $this->load->view('page/PerjalananPage.php', $data, FALSE);
        }

        public function formasi($idAnggota = NULL){
            $this->_checkIsIdValid($idAnggota);
            
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Perutusan";

            if(!empty($this->input->get('edit'))){
                $data["editStatus"] = true;
            } else {
                $data["editStatus"] = false;
            }
            
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "formasi";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataSerikat"] = $this->anggota_model->getDataSerikat($idAnggota);
            $data["dataInfo"] = $this->anggota_model->getDataInformationes($idAnggota);
            $data["dataKomentar"] = $this->anggota_model->getDataKomentar($idAnggota);
            $data["dataKaulAkhir"] = $this->anggota_model->getDataKaulAkhir($idAnggota);
            $data["dataKeahlian"] = $this->anggota_model->getDataKeahlian($idAnggota);
            $data["dataPublikasi"] = $this->anggota_model->getDataPublikasi($idAnggota);
            $this->load->view('page/FormasiPage.php', $data, FALSE);
        }

        public function catatan($idAnggota = NULL){
            $this->_checkIsIdValid($idAnggota);
        }

        public function dokumen($idAnggota = NULL){
            $this->_checkIsIdValid($idAnggota);

            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Dokumen";

            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["activeNav"] = "dokumen";
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataDokumen"] = $this->anggota_model->getAllDokumenBersama();
            $this->load->view("page/DokumenPage.php", $data, FALSE);
        }
    }
?>