<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Home extends CI_Controller {
        public function __construct() {
            parent::__construct();
		    $this->load->model('auth_model');
            $this->load->model('api_model');
            $this->load->model('anggota_model');
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

            if($this->session->role == "Personal"){
                redirect("/anggota/pribadi/".$this->session->idAnggota);
            }
        }

        public function index() {
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Home";
            $data['daftarAnggota'] = $this->api_model->getAllAnggota();
            $data['jumlahAnggota'] = $this->api_model->getJumlahAnggota();
            
            $this->load->view('page/HomePage.php', $data, FALSE);
        }

        public function kuria(){
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Kuria";
            $data['daftarAnggota'] = $this->api_model->getAllAnggota();
            
            $this->load->view('page/KuriaPage.php', $data, FALSE);
        }

        public function admin(){
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | List Admin";
            $data['daftarAnggota'] = $this->api_model->getAllAnggota();
            
            $this->load->view('page/AdminPage.php', $data, FALSE);
        }

        public function user(){
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | List User";
            $data['daftarAnggota'] = $this->api_model->getAllAnggota();

            $this->load->view('page/UserPage.php', $data, FALSE);
        }

        public function komunitas($param = ''){
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);

            if(empty($param)){
                $data["title"] = "IDO SJ | List Komunitas";
                $data["dataKomunitas"] = $this->anggota_model->getAllKomunitas($onlyKomunitas = true);
                $this->load->view('page/KomunitasPage.php', $data, FALSE);
            } else {
                $data["title"] = "IDO SJ | List Residensi";
                $param = preg_replace('/-+/', ' ', $param);
                $data["dataResidensi"] = $this->anggota_model->getAllResidensi($param);
                foreach($data["dataResidensi"] as $residensi){
                    $residensi->anggota = $this->anggota_model->getAllAnggotaByResidensi($residensi->id);
                }
                // echo "<pre>".json_encode($data["dataResidensi"], JSON_PRETTY_PRINT)."</pre>";
                $this->load->view('page/ResidensiPage.php', $data, FALSE);
            }
        }

        public function dokumen(){
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);

            $data["title"] = "IDO SJ | List Dokumen";
            $data["dataDokumen"] = $this->anggota_model->getAllDokumenBersama();
            $this->load->view('page/AddDokumenPage.php', $data, FALSE);
        }
    }
?>