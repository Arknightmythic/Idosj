<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('api_model');
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
        show_404();
    }

    public function _sendEmail($subject, $message, $to, $bcc = [])
    {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'idosj@jesuits.id',
            'smtp_pass' => 'secret-key-email',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from($config['smtp_user']);
        $this->email->subject($subject);
        $this->email->message($message);

        if (is_array($to)) {
            $to = implode(',', $to);
        }

        $this->email->to($to);

        if (!empty($bcc)) {
            if (is_array($bcc)) {
                $bcc = implode(',', $bcc);
            }
            $this->email->bcc($bcc);
        }

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function anggota()
    {
        if (!empty($this->input->get('letter'))) {
            $letter = $this->input->get('letter');
            $data = $this->api_model->getAnggotaByLetter($letter, $this->session->role != "Administrator" ? $this->session->idAnggota : NULL);
        } else if (!empty($this->input->get('search'))) {
            $name = $this->input->get('search');
            $data = $this->api_model->getAnggotaBySearch($name, $this->session->role != "Administrator" ? $this->session->idAnggota : NULL);
        } else {
            $data = $this->api_model->getAllAnggota($this->session->role != "Administrator" ? $this->session->idAnggota : NULL);
        }

        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function listUser()
    {
        if (!empty($this->input->post('deleteAdmin'))) {
            if (!empty($this->input->post('userID'))) {
                $this->api_model->deleteAdmin($this->input->post('userID'));
                $result = (object) array("status" => "success", "title" => "Terhapus!", "message" => "User berhasil dihapus.");
            } else {
                $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
        } else if (!empty($this->input->post('deletePersonal'))) {
            if (!empty($this->input->post('idAnggota'))) {
                $this->api_model->deletePersonal($this->input->post('idAnggota'));
                $result = (object) array("status" => "success", "title" => "Terhapus!", "message" => "User personal berhasil dihapus.");
            } else {
                $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
        } else if (!empty($this->input->post('addAdmin'))) {
            if (!empty($this->input->post('namaLengkap') && !empty($this->input->post('username')) && !empty($this->input->post('password')) && !empty($this->input->post('idRole')))) {
                $this->api_model->addAdmin($this->input->post('namaLengkap'), $this->input->post('username'), $this->input->post('password'), $this->input->post('idRole'));
                $result = (object) array("status" => "success", "title" => "Tertambahkan!", "message" => "User admin berhasil ditambahkan.");
            } else {
                $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
        } else if (!empty($this->input->post('addPersonal'))) {
            if (!empty($this->input->post('idAnggota') && !empty($this->input->post('namaDepan')) && !empty($this->input->post('namaBelakang')) && !empty($this->input->post('jenisGradasi')) && !empty($this->input->post('username')) && !empty($this->input->post('password')))) {
                $response = $this->api_model->addPersonal($this->input->post('idAnggota'), $this->input->post('namaDepan'), $this->input->post('namaBelakang'), $this->input->post('jenisGradasi'), $this->input->post('username'), $this->input->post('password'));
                if ($response != NULL) {
                    $result = (object) array("status" => "error", "title" => "Gagal!", "message" => $response);
                } else {
                    $result = (object) array("status" => "success", "title" => "Tertambahkan!", "message" => "User personal berhasil ditambahkan.");
                }
            } else {
                $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
        } else {
            $roles = $this->api_model->getAllRoles();
            foreach ($roles as $role) {
                $result[$role->namaRole] = $this->api_model->getUserListByRole($role->namaRole);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function listRole()
    {
        $result = $this->api_model->getAllRoles();
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function listGradasi()
    {
        $result = $this->api_model->getAllGradasi();
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function editAnggota()
    {
        $data = (object) $_POST;
        if (!empty($this->input->post('editDataDiri'))) {
            $config['upload_path'] = FCPATH . '/uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = "Profile_" . $data->id;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->fotoProfile = NULL;
            if ($this->upload->do_upload('profilePicture')) {
                $data->fotoProfile = $this->upload->data('file_name');
            }
            $this->api_model->updateDataDiri($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('tambahPendidikan'))) {
            $this->api_model->addPendidikanAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editPendidikan'))) {
            $this->api_model->updatePendidikanAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusPendidikan'))) {
            $this->api_model->deletePendidikanAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahSakramen'))) {
            $this->api_model->addSakramenAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editSakramen'))) {
            $this->api_model->updateSakramenAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusSakramen'))) {
            $this->api_model->deleteSakramenAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahBahasa'))) {
            $this->api_model->addBahasaAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editBahasa'))) {
            $this->api_model->updateBahasaAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusBahasa'))) {
            $this->api_model->deleteBahasaAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahDokumen'))) {
            $this->api_model->addDokumenAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editDokumen'))) {
            $this->api_model->updateDokumenAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusDokumen'))) {
            $this->api_model->deleteDokumenAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahRelasi'))) {
            $this->api_model->addRelasiAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editRelasi'))) {
            $this->api_model->updateRelasiAnggota($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusRelasi'))) {
            $this->api_model->deleteRelasiAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahPerutusan'))) {
            $config['upload_path'] = FCPATH . '/uploads/sk-perutusan/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
            $config['file_name'] = "SK_Perutusan_" . $data->id . "_" . time() . rand(100, 999);
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->fileSK = NULL;

            if (!empty($_FILES["fileData"])) {
                if ($this->upload->do_upload('fileData')) {
                    $data->fileSK = $this->upload->data('file_name');
                }
            }

            $this->api_model->addPerutusanAnggota($data);
            $this->_sendEmail(
                "Halo $data->id - $data->namaDepan $data->namaBelakang SK Baru",
                "<p> Pater Socius telah memasukkan SK terbaru Romo/Bruder/Frater dalam Database idosj.org. SK dalam bentuk <i>print out</i> sedang dalam proses pengiriman. 
                            <br><br>
                            Silahkan klik link dibawah ini untuk melihat SK tersebut.
                            <br>
                            <a href='" . base_url("/anggota/perutusan/$data->id") . "' target='_blank'>" . base_url("/anggota/perutusan/$form->idAnggota") . "</a>
                            <br>
                            <br>
                            terima kasih,
                            <br>
                            Pater Socius
                            </p>",
                array(
                    $this->api_model->getEmailByIdAnggota($data->id),
                    $this->api_model->getEmailByIdAnggota($data->idSuperior)
                )
            );

            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('editPerutusan'))) {
            $config['upload_path'] = FCPATH . '/uploads/sk-perutusan/';
            $config['allowed_types'] = 'pdf';
            if (!empty($data->lastFile)) {
                $config['file_name'] = $data->lastFile;
            } else {
                $config['file_name'] = "SK_Perutusan_" . $data->idAnggota . "_" . time() . rand(100, 999);
            }
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->fileSK = NULL;

            if (!empty($_FILES["fileData"])) {
                if ($this->upload->do_upload('fileData')) {
                    $data->fileSK = $this->upload->data('file_name');
                }
            }

            $this->api_model->updatePerutusanAnggota($data);
            $this->_sendEmail(
                "Halo $data->id - $data->namaDepan $data->namaBelakang SK",
                "<p> Pater Socius Telah memasukkan SK terbaru  didatabase.
                            <br><br>
                            Silahkan klik link dibawah ini untuk melihat SK tersebut.
                            <br>
                            <a href='" . base_url("/anggota/perutusan//$data->id") . "' target='_blank'>" . base_url("/anggota/perutusan//$form->idAnggota") . "</a>
                            <br>
                            <br>
                            terima kasih,
                            <br>
                            Pater Socius
                            </p>",

                $this->api_model->getEmailByIdAnggota($data->id)
            );
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusPerutusan'))) {
            unlink(FCPATH . '/uploads/sk-perutusan/' . $data->lastFile);
            $this->api_model->deletePerutusanAnggota($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil dihapus.");
        } else if (!empty($this->input->post('tambahSerikat'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-serikat/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = "Dokumen_" . $data->keterangan . "_" . $data->id . "_" . time() . rand(100, 999);
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->dokumen = NULL;
            if (!empty($_FILES["fileData"])) {
                if ($this->upload->do_upload('fileData')) {
                    $data->fileSK = $this->upload->data('file_name');
                }
            }

            $this->api_model->addSerikat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Serikat anggota berhasil dihapus.");
        } else if (!empty($this->input->post('editSerikat'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-serikat/';
            $config['allowed_types'] = 'pdf';
            if (!empty($data->lastFile)) {
                $config['file_name'] = $data->lastFile;
            } else {
                $config['file_name'] = "Dokumen_" . $data->keterangan . "_" . $data->idAnggota . "_" . time() . rand(100, 999);
            }
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->dokumen = NULL;
            if ($this->upload->do_upload('fileData')) {
                $data->dokumen = $this->upload->data('file_name');
            }

            $this->api_model->updateSerikat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Serikat anggota berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusSerikat'))) {
            unlink(FCPATH . '/uploads/dokumen-serikat/' . $data->lastFile);
            $this->api_model->deleteSerikat($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Serikat anggota berhasil dihapus.");
        } else if (!empty($this->input->post('editInfo'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-informationes/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = "Dokumen_" . $data->jenisInformationes . "_" . $data->id;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $data->dokumen = NULL;
            if ($this->upload->do_upload('fileData')) {
                $data->dokumen = $this->upload->data('file_name');
            }

            $this->api_model->addInformationes($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Informationes anggota berhasil ditambahkan.");
        } else if (!empty($this->input->post('komentar'))) {
            $this->api_model->addKomentar($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Komentar berhasil disimpan.");
        } else if (!empty($this->input->post('editKaulPertama'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-kaul-pertama/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $data->suratPribadi1 = NULL;
            $data->teksKaulPertama = NULL;

            if (!empty($_FILES['fileSuratPribadi1'])) {
                $config['file_name'] = "Dokumen_Surat_Pribadi_Kaul_Pertama" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileSuratPribadi1')) {
                    $data->suratPribadi1 = $this->upload->data('file_name');
                }
            }

            if (!empty($_FILES['fileTeksKaulPertama'])) {
                $config['file_name'] = "Dokumen_Teks_Kaul_Pertama" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileTeksKaulPertama')) {
                    $data->teksKaul = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateKaulPertama($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Kaul Pertama berhasil diperbaharui.");
        } else if (!empty($this->input->post('editEntrance'))) {

            $this->api_model->updateEntrance($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Entrance berhasil diperbaharui.");
        } else if (!empty($this->input->post('editKaulAkhir'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-kaul-akhir/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;
            $data->suratPribadi = NULL;
            $data->dekritKaul = NULL;
            $data->teksKaul = NULL;
            $data->teksPelepasan = NULL;
            $data->testamenNotaris = NULL;

            if (!empty($_FILES['fileSuratPribadi'])) {
                $config['file_name'] = "Dokumen_Surat_Pribadi_" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileSuratPribadi')) {
                    $data->suratPribadi = $this->upload->data('file_name');
                }
            }

            if (!empty($_FILES['fileDekritKaul'])) {
                $config['file_name'] = "Dokumen_Dekrit_Kaul_" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileDekritKaul')) {
                    $data->dekritKaul = $this->upload->data('file_name');
                }
            }

            if (!empty($_FILES['fileTeksKaul'])) {
                $config['file_name'] = "Dokumen_Teks_Kaul_" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileTeksKaul')) {
                    $data->teksKaul = $this->upload->data('file_name');
                }
            }

            if (!empty($_FILES['fileTeksPelepasan'])) {
                $config['file_name'] = "Dokumen_Teks_Pelepasan_Harta_Milik_" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileTeksPelepasan')) {
                    $data->teksPelepasan = $this->upload->data('file_name');
                }
            }

            if (!empty($_FILES['fileTestamenNotaris'])) {
                $config['file_name'] = "Dokumen_Tetamen_Notaris_" . $data->id;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('fileTestamenNotaris')) {
                    $data->testamenNotaris = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateKaulAkhir($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Kaul Akhir berhasil diperbaharui.");
        } else if (!empty($this->input->post('editLektorAkolit'))) {

            $this->api_model->updateLektorAkolit($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Tahbisan Diakon berhasil diperbaharui.");
        } else if (!empty($this->input->post('editDeaconOrdination'))) {

            $this->api_model->updateTahbisanDiakon($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Tahbisan Diakon berhasil diperbaharui.");
        } else if (!empty($this->input->post('updateTahbisanImamat'))) {

            $this->api_model->updateTahbisanImamat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Tahbisan Imamat berhasil diperbaharui.");
        } else if (!empty($this->input->post('updateTersiat'))) {

            $this->api_model->updateTersiat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data Tahbisan Imamat berhasil diperbaharui.");
        } else if (!empty($this->input->post('tambahKeahlian'))) {
            $config['upload_path'] = FCPATH . '/uploads/sertifikat-keahlian/';
            $config['allowed_types'] = 'pdf|png|jpg|jpeg';
            $config['file_name'] = "Sertifikat_Keahlian_" . $data->id . "_" . time() . rand(100, 999);
            $data->dokumen = NULL;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('fileData')) {
                $data->dokumen = $this->upload->data('file_name');
            }

            $this->api_model->addKeahlian($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data keahlian berhasil ditambahkan.");
        } else if (!empty($this->input->post('editKeahlian'))) {
            $config['upload_path'] = FCPATH . '/uploads/sertifikat-keahlian/';
            $config['allowed_types'] = 'pdf|png|jpg|jpeg';
            $config['file_name'] = $data->lastFile;
            $config['overwrite'] = true;

            if (!empty($_FILES['fileData'])) {
                $this->load->library('upload', $config);
                $data->dokumen = NULL;
                if ($this->upload->do_upload('fileData')) {
                    $data->dokumen = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateKeahlian($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data keahlian berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusKeahlian'))) {
            $this->api_model->deleteKeahlian($data->id);
            unlink(FCPATH . '/uploads/sertifikat-keahlian/' . $data->lastFile);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data keahlian berhasil dihapus.");
        } else if (!empty($this->input->post('tambahPublikasi'))) {
            $this->api_model->addPublikasi($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data publikasi berhasil ditambahkan.");
        } else if (!empty($this->input->post('editPublikasi'))) {
            $this->api_model->updatePublikasi($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data publikasi berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusPublikasi'))) {
            $this->api_model->deletePublikasi($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data publikasi berhasil dihapus.");
        } else if (!empty($this->input->post('tambahKesehatan'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-rumahsakit/';
            $config['allowed_types'] = 'pdf|png|jpg|jpeg';
            $config['file_name'] = "Dokumen_Rumah Sakit_" . $data->id . "_" . time() . rand(100, 999);
            $data->dokumen = NULL;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('fileData')) {
                $data->dokumen = $this->upload->data('file_name');
            }

            $this->api_model->addKesehatan($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data kesehatan berhasil ditambahkan.");
        } else if (!empty($this->input->post('editKesehatan'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen-rumahsakit/';
            $config['allowed_types'] = 'pdf|png|jpg|jpeg';
            $config['file_name'] = $data->lastFile;
            $config['overwrite'] = true;

            if (!empty($_FILES['fileData'])) {
                $this->load->library('upload', $config);
                $data->dokumen = NULL;
                if ($this->upload->do_upload('fileData')) {
                    $data->dokumen = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateKesehatan($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data kesehatan berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusKesehatan'))) {
            $this->api_model->deleteKesehatan($data->id);
            unlink(FCPATH . '/uploads/dokumen-rumahsakit/' . $data->lastFile);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data kesehatan berhasil dihapus.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataPendidikan()
    {
        if (!empty($this->input->get("idPendidikan"))) {
            $result = $this->api_model->getDataPendidikanById($this->input->get("idPendidikan"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllPendidikanAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataSakramen()
    {
        if (!empty($this->input->get("idSakramen"))) {
            $result = $this->api_model->getDataSakramenById($this->input->get("idSakramen"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllSakramenAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataBahasa()
    {
        if (!empty($this->input->get("idBahasa"))) {
            $result = $this->api_model->getDataBahasaById($this->input->get("idBahasa"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllBahasaAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataDokumen()
    {
        if (!empty($this->input->get("idDokumen"))) {
            $result = $this->api_model->getDataDokumenById($this->input->get("idDokumen"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllDokumenAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataRelasi()
    {
        if (!empty($this->input->get("idRelasi"))) {
            $result = $this->api_model->getDataRelasiById($this->input->get("idRelasi"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllRelasiAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataPerutusan()
    {
        if (!empty($this->input->get("idPerutusan"))) {
            $result = $this->api_model->getDataPerutusanById($this->input->get("idPerutusan"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllPerutusanAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataSerikat()
    {
        if (!empty($this->input->get("idSerikat"))) {
            $result = $this->api_model->getDataSerikatById($this->input->get("idSerikat"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllSerikatAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataInformationes()
    {
        if (!empty($this->input->get("idInformationes"))) {
            $result = $this->api_model->getDataInformationesById($this->input->get("idInformationes"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllInformationesAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataKeahlian()
    {
        if (!empty($this->input->get("idKeahlian"))) {
            $result = $this->api_model->getDataKeahlianById($this->input->get("idKeahlian"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllKeahlianAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataKesehatan()
    {
        if (!empty($this->input->get("idKesehatan"))) {
            $result = $this->api_model->getDataKesehatanById($this->input->get("idKesehatan"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllKesehatanAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataPublikasi()
    {
        if (!empty($this->input->get("idPublikasi"))) {
            $result = $this->api_model->getDataPublikasiById($this->input->get("idPublikasi"));
        } else if (!empty($this->input->get("idAnggota"))) {
            $result = $this->api_model->getAllPublikasiAnggota($this->input->get("idAnggota"));
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataKomunitas()
    {
        $data = (object) $_POST;
        if (!empty($this->input->get("idKomunitas"))) {
            $result = $this->api_model->getDataKomunitasById($this->input->get("idKomunitas"));
        } else if (!empty($this->input->post("addKomunitas"))) {
            $this->api_model->addKomunitas($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Komunitas baru berhasil dibuat.");
        } else if (!empty($this->input->post("editKomunitas"))) {
            $this->api_model->updateKomunitas($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Komunitas berhasil diperbaharui.");
        } else if (!empty($this->input->post("hapusKomunitas"))) {
            $this->api_model->deleteKomunitas($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Komunitas berhasil dihapus.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function formKuning()
    {
        $data = (object) $_POST;

        if (!empty($this->input->post("addFormKuning"))) {
            $this->api_model->addFormKuning($data);
            $this->_sendEmail(
                "Persetujuan Form Kuning $data->idAnggota - Superior Komunitas",
                "<p>Anggota komunitas Anda baru saja melakukan pengajuan form kuning dan menunggu persetujuan Anda.<br><br>Silahkan klik link dibawah ini untuk melihat detail form kuning tersebut.<br><a href='" . base_url("/anggota/perjalanan/$data->idAnggota") . "' target='_blank'>" . base_url("/anggota/perjalanan/$data->idAnggota") . "</a></p>",
                $this->api_model->getEmailByIdAnggota($data->idSuperior)
            );
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil dikirim.");
        } else if (!empty($this->input->get("formId"))) {
            $result = $this->api_model->getFormKuningById($this->input->get("formId"));
        } else if (!empty($this->input->post('formId'))) {
            $form = $this->api_model->getFormKuningById($this->input->post("formId"));
            if (!empty($data->statusSuperior) && $data->statusSuperior == "true" && !empty($data->tanggapan)) {
                $this->_sendEmail(
                    "Persetujuan Form Kuning $form->idAnggota - Provinsial",
                    "<p>Anda baru saja menerima pengajuan form kuning dan menunggu disetujui.<br><br>Silahkan klik link dibawah ini untuk melihat detail form kuning tersebut.<br><a href='" . base_url("/anggota/perjalanan/$form->idAnggota") . "' target='_blank'>" . base_url("/anggota/perjalanan/$form->idAnggota") . "</a></p>",
                    "provincial@jesuits.id"
                  
                );
            } else if (!empty($data->statusSuperior) && $data->statusSuperior == "false") {
                $this->_sendEmail(
                    "Pengajuan Form Kuning - Ditolak",
                    "<div><p>Pengajuan form kuning Anda ditolak oleh superior komunitas.</p><br /><p>Alasan:</p><p>$data->tanggapan</p></div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
            } else if (!empty($data->statusProvinsial) && $data->statusProvinsial == "false") {
                $this->_sendEmail(
                    "Pengajuan Form Kuning - Ditolak",
                    "<div><p>Pengajuan form kuning Anda ditolak oleh pater provinsial.</p><br /><p>Alasan:</p><p>$data->tanggapan</p></div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
            } else if (!empty($data->statusProvinsial) && $data->statusProvinsial == "true" && !empty($data->tanggapan)) {
                $this->_sendEmail(
                    "Pengajuan Form Kuning - Diterima",
                    "<div><p>Pengajuan form kuning Anda telah diterima dan disetujui oleh provinsial</p><br><br>Silahkan klik link dibawah ini untuk membaca form kuning tersebut.<br><a href='" . base_url("/formkuning/print/$form->id") . "' target='_blank'>" . base_url("/formkuning/print/$form->id") . "</a></div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
                $this->_sendEmail(
                    "Pengajuan Form Kuning $form->idAnggota - Diterima",
                    "<div><p>Pengajuan form kuning oleh $form->ndAnggota $form->nbAnggota telah diterima dan disetujui oleh provinsial</p><br><br>Silahkan klik link dibawah ini untuk membaca form kuning tersebut.<br><a href='" . base_url("/formkuning/print/$form->id") . "' target='_blank'>" . base_url("/formkuning/print/$form->id") . "</a></div>",
                    array(
                        $this->api_model->getEmailByIdAnggota($form->idSuperior),
                        "socius@jesuits.id",
                        "treasurer@jesuits.id"
                        
                    )
                );
            }
            $this->api_model->updateFormKuning($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil diperbaharui.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function formKuningDirectToProvincial()
    {
        $data = (object) $_POST;

        if (!empty($this->input->post("addFormKuningSuperior"))) {
            $this->api_model->addFormKuningSuperior($data);
            $this->_sendEmail(
                "Persetujuan Form Kuning $data->idAnggota - Provinsial",
                "<p>
                        Anggota komunitas Anda baru saja melakukan pengajuan form kuning dan menunggu persetujuan Anda.
                        <br><br>
                        Silahkan klik link dibawah ini untuk melihat detail form kuning tersebut.
                        <br>
                        <a href='" . base_url("/anggota/perjalanan/$data->idAnggota") . "' target='_blank'>" . base_url("/anggota/perjalanan/$data->idAnggota") . "</a>
                    </p>",
                "provincial@jesuits.id"
                
            );
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil dikirim.");
        } else if (!empty($this->input->get("formId"))) {
            $result = $this->api_model->getFormKuningById($this->input->get("formId"));
        } else if (!empty($this->input->post('formId'))) {
            $form = $this->api_model->getFormKuningById($this->input->post("formId"));
            if (!empty($data->statusProvinsial) && $data->statusProvinsial == "true" && !empty($data->tanggapan)) {
                $this->_sendEmail(
                    "Pengajuan Form Kuning $form->idAnggota - Diterima",
                    "<div><p>Pengajuan form kuning oleh $form->ndAnggota $form->nbAnggota telah diterima dan disetujui oleh provinsial</p><br><br>Silahkan klik link dibawah ini untuk membaca form kuning tersebut.<br><a href='" . base_url("/formkuning/print/$form->id") . "' target='_blank'>" . base_url("/formkuning/print/$form->id") . "</a></div>",
                    array(
                        $this->api_model->getEmailByIdAnggota($form->idAnggota),
                        "socius@jesuits.id",
                        "treasurer@jesuits.id"
                        
                    )
                );

            } else if (!empty($data->statusProvinsial) && $data->statusProvinsial == "false") {
                $this->_sendEmail(
                    "Pengajuan Form Kuning - Ditolak",
                    "<div>
                            <p>Pengajuan form kuning Anda ditolak oleh pater provinsial.</p>
                            <br />
                            <p>Alasan:</p>
                            <p>$data->tanggapan</p>
                        </div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
            }
            $this->api_model->updateFormKuning($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil diperbaharui.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function formIzinAnggotaDirectToProvincial()
    {
        $data = (object) $_POST;

        if (!empty($this->input->post("addFormIzin"))) {
            $this->api_model->addFormIzin($data);
            $this->_sendEmail(
                "Persetujuan Form Izin $data->idAnggota - Provinsial",
                "<p>
                        Anggota komunitas Anda baru saja melakukan pengajuan form izin dan menunggu persetujuan Anda.
                        <br><br>
                        Silahkan klik link dibawah ini untuk melihat detail form izin tersebut.
                        <br>
                        <a href='" . base_url("/anggota/perjalanan/$data->idAnggota") . "' target='_blank'>" . base_url("/anggota/perjalanan/$data->idAnggota") . "</a>
                    </p>",
                "provincial@jesuits.id"
            );
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil dikirim.");
        } else if (!empty($this->input->get("formId"))) {
            $result = $this->api_model->getFormIzinById($this->input->get("formId"));
        } else if (!empty($this->input->post('formId'))) {
            $form = $this->api_model->getFormIzinById($this->input->post("formId"));
            if (!empty($data->statusProvinsial) && $data->statusProvinsial == "true" && !empty($data->tanggapan)) {
                $this->_sendEmail(
                    "Pengajuan Form Izin $form->idAnggota - Diterima",
                    "<div><p>Pengajuan form izin oleh $form->ndAnggota $form->nbAnggota telah diterima dan disetujui oleh provinsial</p><br><br>Silahkan klik link dibawah ini untuk membaca form izin tersebut.<br><a href='" . base_url("/formizin/print/$form->id") . "' target='_blank'>" . base_url("/formizin/print/$form->id") . "</a></div>",
                    array(
                        $this->api_model->getEmailByIdAnggota($form->idAnggota),
                        "socius@jesuits.id",
                        "treasurer@jesuits.id"
                        
                    )
                );
               
            } else if (!empty($data->statusProvinsial) && $data->statusProvinsial == "false") {
                $this->_sendEmail(
                    "Pengajuan Form Izin - Ditolak",
                    "<div>
                            <p>Pengajuan form Izin Anda ditolak oleh pater provinsial.</p>
                            <br />
                            <p>Alasan:</p>
                            <p>$data->tanggapan</p>
                        </div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
            }
            $this->api_model->updateFormIzin($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil diperbaharui.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function formIzinSuperiorDirectToProvincial()
    {
        $data = (object) $_POST;

        if (!empty($this->input->post("addFormIzinSuperior"))) {
            $this->api_model->addFormIzinSuperior($data);
            $this->_sendEmail(
                "Persetujuan Form Izin $data->idAnggota - Provinsial",
                "<p>
                        Anggota komunitas Anda baru saja melakukan pengajuan form izin dan menunggu persetujuan Anda.
                        <br><br>
                        Silahkan klik link dibawah ini untuk melihat detail form izin tersebut.
                        <br>
                        <a href='" . base_url("/anggota/perjalanan/$data->idAnggota") . "' target='_blank'>" . base_url("/anggota/perjalanan/$data->idAnggota") . "</a>
                    </p>",
                "provincial@jesuits.id"
            );
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil dikirim.");
        } else if (!empty($this->input->get("formId"))) {
            $result = $this->api_model->getFormIzinById($this->input->get("formId"));
        } else if (!empty($this->input->post('formId'))) {
            $form = $this->api_model->getFormIzinById($this->input->post("formId"));
            if (!empty($data->statusProvinsial) && $data->statusProvinsial == "true" && !empty($data->tanggapan)) {
                $this->_sendEmail(
                    "Pengajuan Form Izin $form->idAnggota - Diterima",
                    "<div><p>Pengajuan form izin oleh $form->ndAnggota $form->nbAnggota telah diterima dan disetujui oleh provinsial</p><br><br>Silahkan klik link dibawah ini untuk membaca form izin tersebut.<br><a href='" . base_url("/formizin/print/$form->id") . "' target='_blank'>" . base_url("/formizin/print/$form->id") . "</a></div>",
                    array(
                        $this->api_model->getEmailByIdAnggota($form->idAnggota),
                        "socius@jesuits.id",
                        "treasurer@jesuits.id"
                       
                    )
                );
              
            } else if (!empty($data->statusProvinsial) && $data->statusProvinsial == "false") {
                $this->_sendEmail(
                    "Pengajuan Form Izin - Ditolak",
                    "<div>
                            <p>Pengajuan form Izin Anda ditolak oleh pater provinsial.</p>
                            <br />
                            <p>Alasan:</p>
                            <p>$data->tanggapan</p>
                        </div>",
                    $this->api_model->getEmailByIdAnggota($form->idAnggota)
                );
            }
            $this->api_model->updateFormIzin($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Permohonan berhasil diperbaharui.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    //End Form Izin KAS



    public function dataDokumenBersama()
    {
        $data = (object) $_POST;

        if (!empty($this->input->post('addDokumen'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = "Dokumen_" . $data->namaDokumen . "_" . time() . rand(100, 999);
            $config['overwrite'] = true;
            $data->fileDokumen = NULL;

            if (!empty($_FILES['fileData'])) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fileData')) {
                    $data->fileDokumen = $this->upload->data('file_name');
                }
            }

            $this->api_model->addDokumenBersama($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen berhasil ditambahkan.");
        } else if (!empty($this->input->get('idDokumen'))) {
            $result = $this->api_model->getDokumenBersamaById($this->input->get('idDokumen'));
        } else if (!empty($this->input->post('editDokumen'))) {
            $config['upload_path'] = FCPATH . '/uploads/dokumen/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = $data->lastFile;
            $config['overwrite'] = true;

            if (!empty($_FILES['fileData'])) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fileData')) {
                    $data->fileDokumen = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateDokumenBersama($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen berhasil diperbaharui.");
        } else if (!empty($this->input->post('hapusDokumen'))) {
            unlink(FCPATH . '/uploads/dokumen/' . $data->lastFile);
            $this->api_model->deleteDokumenBersama($data->id);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen berhasil dihapus.");
        } else {
            $result = (object) $this->api_model->getAllDokumenBersama();
        }

        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function dataCatatan()
    {
        $data = (object) $_POST;
        if (!empty($this->input->post('addCatatan'))) {
            $config['upload_path'] = FCPATH . '/uploads/catatan/';
            $config['allowed_types'] = 'pdf';
            $config['overwrite'] = true;

            if (!empty($this->input->post('dimissi'))) {
                $config['file_name'] = "Dokumen Dimissi_" . $data->idAnggota . "_" . $data->jenisDokumen;
                if (!empty($_FILES['fileData'])) {
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fileData')) {
                        $data->dokumen = $this->upload->data('file_name');
                    }
                }
                $this->api_model->updateDimissi($data);
            } else if (!empty($this->input->post('laisasi'))) {
                $config['file_name'] = "Dokumen Laisasi_" . $data->idAnggota . "_" . $data->jenisDokumen;
                if (!empty($_FILES['fileData'])) {
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fileData')) {
                        $data->dokumen = $this->upload->data('file_name');
                    }
                }
                $this->api_model->updateLaisasi($data);
            } else if (!empty($this->input->post('kematian'))) {
                if (!empty($_FILES['fileData1'])) {
                    $config['file_name'] = "Dokumen Kematian_" . $data->idAnggota . "_" . "Akta Kematian";
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fileData1')) {
                        $data->aktaKematian = $this->upload->data('file_name');
                    }
                }

                if (!empty($_FILES['fileData2'])) {
                    $config['file_name'] = "Dokumen Kematian_" . $data->idAnggota . "_" . "Keterangan Kematian";
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('fileData2')) {
                        $data->keteranganKematian = $this->upload->data('file_name');
                    }
                }
                $this->api_model->updateKematian($data);
            }

            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Catatan berhasil ditambahkan.");
        } else {
            $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function informasiNovisiatTersiat()
    {
        $data = (object) $_POST;
        $config['upload_path'] = FCPATH . '/uploads/informasi-novisiat-tersiat/';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = true;
        $fieldName = "";

        if (!empty($this->input->post('editInformasi'))) {
            if ($data->columnField === "catatanPrimi") {
                $fieldName = "Catatan Primi";
            } else if ($data->columnField === "catatanSecundi") {
                $fieldName = "Catatan Secundi";
            } else {
                $fieldName = "Catatan Tersiat";
            }

            if (!empty($_FILES['fileData'])) {
                $config['file_name'] = $fieldName . "_" . $data->idAnggota;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('fileData')) {
                    $data->dokumen = $this->upload->data('file_name');
                }
            }

            $this->api_model->updateInformasiNovisiatTersiat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Informasi berhasil diperbaharui.");
        } else if (!empty($this->input->post('deleteInformasi'))) {
            unlink(FCPATH . '/uploads/informasi-novisiat-tersiat/' . $data->lastFile);
            $this->api_model->deleteInformasiNovisiatTersiat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Informasi berhasil dihapus.");
        } else if (!empty($this->input->post('editCatatan'))) {
            if (empty($data->catatan)) {
                $data->catatan = NULL;
            }
            $this->api_model->updateCatatanNovisiatTersiat($data);
            $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Catatan berhasil diperbaharui.");
        } else if (!empty($this->input->get('idAnggota'))) {
            $result = (object) $this->api_model->getInformasiNovisiatTersiat($this->input->get('idAnggota'));
        }
        header('Content-Type: application/json');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}
