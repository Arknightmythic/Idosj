<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class FormKuning extends CI_Controller {
        public function __construct() {
            parent::__construct();
		    $this->load->model('auth_model');
            $this->load->model('api_model');
            $this->load->model('formkuning_model');
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

        public function index() {
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
            $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
            $data["title"] = "IDO SJ | Pengajuan Form Kuning";
            $data['userData'] = $this->formkuning_model->getUserData();
            if(isset($_POST['formKuning'])){
                $this->_submit((object) $_POST, $data['userData']);    
            }

            $this->load->view('page/FormKuning.php', $data, FALSE);
        }

        private function _checkIsIdValid($formId){
            $form = $this->formkuning_model->getFormData($formId);

            if(empty($formId) || $form == NULL || 
                ($this->session->role == "Personal" && $this->session->idAnggota !== $form->idAnggota) || 
                ($this->session->role == "Superior" && $this->session->idAnggota !== $form->idSuperior) || 
                $this->session->role == "Delegat"){
                show_404();
            }
        }

        public function print($formId = NULL) {
            $this->_checkIsIdValid($formId);
            
            if(!empty($formId)){
                $pdf = new \Mpdf\Mpdf();
                $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
                $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
                $data["formData"] = $this->formkuning_model->getFormData($formId);
                $css = file_get_contents(base_url('assets/styles/eprints-form-kuning.css'));
                $html = $this->load->view('print/PrintsFormKuning.php', $data, TRUE);
                $pdf->WriteHTML($css, 1);
                $pdf->WriteHTML($html);
                $pdf->SetTitle('Form Kuning');
                $pdf->Output('test.pdf', 'I');
            } else {
                show_404();
            }
        }
    }
?>