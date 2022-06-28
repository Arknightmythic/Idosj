<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Auth extends CI_Controller {
        public function __construct() {
            parent::__construct();
		    $this->load->model('auth_model');
            $this->form_validation->set_error_delimiters('', '');
        }

        public function index() {
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Auth";
            
            if($this->auth_model->verifyCookies()){
                redirect('/');
            }

            $this->form_validation->set_rules('username', 'username', 'trim|required');
            $this->form_validation->set_rules('password', 'password', 'trim|required');

            if($this->form_validation->run()) {
                $this->_login();
            }
            
            $this->load->view('page/LoginPage.php', $data, FALSE);
        }

        private function _login() {
            $username = htmlspecialchars($this->input->post('username'));
            $password = htmlspecialchars($this->input->post('password'));
            $remember = htmlspecialchars($this->input->post('remember'));
            $key = $this->auth_model->login($username, $password);
            
            if(!empty($key)) {
                // jika remeber di check maka buat cookies untuk 7 hari
                if($remember){
                    $cookieDuration = 3600 * 24 * 7; // durasi 7 hari
                } else {
                    $cookieDuration = 3600; // durasi 1 jam 
                }
                // membuat cookies auth
                set_cookie('login', true, $cookieDuration);
                set_cookie('userId', $username, $cookieDuration);
                set_cookie('key', $key, $cookieDuration);
                redirect('/');
            } else {
                $this->session->set_flashdata('login', 'Username atau password salah.');
            }
        }

        public function logout() {
            delete_cookie('login');
            delete_cookie('userId');
            delete_cookie('key');
            $this->session->sess_destroy();
            
            redirect('/auth');
        }
    }
?>