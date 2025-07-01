<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormKuning extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('api_model');
        $this->load->model('formkuning_model');
        $this->form_validation->set_error_delimiters('', '');

        if (!$this->auth_model->verifyCookies()) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            redirect('/auth');
        }
    }

    public function index()
    {
        $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
        $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
        $data["navbar"] = $this->load->view("include/navbar.php", NULL, TRUE);
        $data["footer"] = $this->load->view("include/footer.php", NULL, TRUE);
        $data["title"] = "IDO SJ | Pengajuan Form Kuning";
        $data['userData'] = $this->formkuning_model->getUserData();
        if (isset($_POST['formKuning'])) {
            $this->_submit((object) $_POST, $data['userData']);
        }

        $this->load->view('page/FormKuning.php', $data, FALSE);
    }

    private function _checkIsIdValid($formId)
    {
        $form = $this->formkuning_model->getFormData($formId);


        if (
            empty($formId) || $form == NULL ||
            ($this->session->role == "Personal" && $this->session->idAnggota !== $form->idAnggota) ||
            ($this->session->role == "Superior" && $this->session->idAnggota !== $form->idSuperior) ||
            $this->session->role == "Delegat"
        ) {
            //   show_404()
        }
    }

    public function print($formId = NULL)
    {
        $this->_checkIsIdValid($formId);

        if (!empty($formId)) {
            $pdf = new \Mpdf\Mpdf([
                'margin_top' => 40,     // Margin atas untuk header
                'margin_bottom' => 25,  // Margin bawah untuk footer
                'margin_left' => 20,
                'margin_right' => 20,
                'margin_header' => 10,  // Jarak header dari tepi atas
                'margin_footer' => 10   // Jarak footer dari tepi bawah
            ]);
            $data["js"] = $this->load->view("include/javascript.php", NULL, TRUE);
            $data["css"] = $this->load->view("include/css.php", NULL, TRUE);
            $data["formData"] = $this->formkuning_model->getFormData($formId);
            $css = file_get_contents(base_url('assets/styles/eprints-form-kuning.css'));

            // Buat HTML untuk header
            $headerHtml = $this->_generateHeader();

            // Buat HTML untuk footer
            $footerHtml = $this->_generateFooter();

            // Set header dan footer
            $pdf->SetHTMLHeader($headerHtml);
            $pdf->SetHTMLFooter($footerHtml);

            $html = $this->load->view('print/PrintsFormKuning.php', $data, TRUE);
            $pdf->WriteHTML($css, 1);
            $pdf->WriteHTML($html);
            $pdf->SetTitle('Form Kuning');
            //albert update
            $pdf->Output('FormKuning_' . $formId . '.pdf', 'I');
            //albert update
        } else {
            show_404();
        }
    }

    private function _generateHeader()
    {
        $headerHtml = '
        <div style="text-align: ; padding-bottom: 10px; margin-bottom: 20px;">
            <table style="width: 100%; border: none;">
                <tr>
                    <td >
                        <!-- Logo bisa ditambahkan disini -->
                        <img src="' . base_url('assets/images/ihs_besar.png') . '" style="height: 70px;" alt="Logo SJ" />
                    </td>
                    <td style="width: 70%; text-align: left; vertical-align: middle;">
                        <h2 style="margin: 0; font-size: 28px; font-weight: bold; color: #852e38; font-family: Times, serif;">INDONESIAN PROVINCE</h2>
                        <h1 style="margin: 5px 0; font-size: 23px; font-weight: bold; color: #852e38;font-family: Times, serif;">OF THE SOCIETY OF JESUS</h1>
            
                    </td>
                    <td style="width: 15%; text-align: right; vertical-align: middle;">
                        <!-- Bisa ditambahkan logo atau info tambahan -->
                    </td>
                </tr>
            </table>
        </div>';

        return $headerHtml;
    }

    private function _generateFooter()
    {
        $footerHtml = '
        <div style="text-align: center; border-top: 1px solid #ccc; padding-top: 10px; color: #666;">
            <table style="width: 100%; color: #4E71FF; border-spacing: 0 0;">
                <tr>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/home_logo.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>Jl. Argopuro 24, Semarang 50231 INDONESIA</strong>
                    </td>
                    <td style="width: 2%; border-right: 1px solid #FFB823;"></td>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/telephone.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>+62-24-831-5004</strong>
                    </td>
                    <td style="width: 2%; border-right: 1px solid #FFB823;"></td>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/globe.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>www.jesuits.id</strong>
                    </td>
                </tr>
                <tr>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/email.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>provincial@jesuits.id</strong>
                    </td>
                    
                    <td style="width: 2%; border-right: 1px solid #FFB823;"></td>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/email.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>socius@jesuits.id</strong>
                    </td>
                    <td style="width: 2%; border-right: 1px solid #FFB823;"></td>
                    <td style="width: 32%; text-align: right; padding: 5px; font-size: 9px; display: flex; align-items: center; justify-content: flex-end;">
                        <img src="' . base_url('assets/images/email.png') . '" alt="Location" style="width: 12px; height: 12px; margin-right: 5px;">
                        <strong>treasurer@jesuits.id</strong>
                    </td>
                </tr>
            </table>
        </div>';

        return $footerHtml;
    }
}
