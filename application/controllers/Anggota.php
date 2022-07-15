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

            if(empty($this->input->get('id'))){
                redirect('/');
            }
        }

        public function index(){
            redirect('anggota/pribadi?id=' . $this->input->get('id'));
        }

        // Page Pribadi
        public function pribadi() {
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

            $idAnggota = $this->input->get('id');
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPendidikan"] = $this->anggota_model->getDataPendidikan($idAnggota);
            $data["dataSakramen"] = $this->anggota_model->getDataSakramen($idAnggota);
            $data["dataBahasa"] = $this->anggota_model->getDataBahasa($idAnggota);
            $data["dataDokumen"] = $this->anggota_model->getDataDokumen($idAnggota);
            
            $this->load->view('page/PribadiPage.php', $data, FALSE);
        }

        public function keluarga() {
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
            
            $idAnggota = $this->input->get('id');
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataOrangTua"] = $this->anggota_model->getDataOrangTua($idAnggota);
            $data["dataSaudaraKandung"] = $this->anggota_model->getDataSaudaraKandung($idAnggota);
            $data["dataKontakDarurat"] = $this->anggota_model->getDataKontakDarurat($idAnggota);
            
            $this->load->view('page/KeluargaPage.php', $data, FALSE);
        }

        public function perutusan() {
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
            
            $idAnggota = $this->input->get('id');
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPerutusan"] = $this->anggota_model->getDataPerutusan($idAnggota);

            $this->load->view('page/PerutusanPage.php', $data, FALSE);
        }

        public function perjalanan() {
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Perjalanan";
            
            $idAnggota = $this->input->get('id');
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataPerjalanan"] = $this->anggota_model->getDataPerjalanan($idAnggota);

            $this->load->view('page/PerjalananPage.php', $data, FALSE);
        }

        public function formasi(){
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
            
            $idAnggota = $this->input->get('id');
            $data["dataPribadi"] = $this->anggota_model->getDataPribadi($idAnggota);
            $data["submenu"] = $this->load->view("include/anggota_submenu.php", $data, TRUE);
            $data["dataSerikat"] = $this->anggota_model->getDataSerikat($idAnggota);
            $data["dataInfo"] = $this->anggota_model->getDataInformationes($idAnggota);
            $data["dataKomentar"] = $this->anggota_model->getDataKomentar($idAnggota);
            $data["dataKaulAkhir"] = $this->anggota_model->getDataKaulAkhir($idAnggota);
            $this->load->view('page/FormasiPage.php', $data, FALSE);
        }
    }
?>