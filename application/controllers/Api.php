<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Api extends CI_Controller {
        public function __construct() {
            parent::__construct();
		    $this->load->model('auth_model');
            $this->load->model('api_model');
            $this->form_validation->set_error_delimiters('', '');

            // if(!$this->auth_model->verifyCookies()){
            //     redirect('/auth');
            // }
        }

        public function index() {
            show_404();
        }

        public function anggota(){
            if(!empty($this->input->get('letter'))){
                $letter = $this->input->get('letter');
                $data = $this->api_model->getAnggotaByLetter($letter);
            } else if(!empty($this->input->get('search'))){
                $name = $this->input->get('search');
                $data = $this->api_model->getAnggotaBySearch($name);
            }
            else {
                $data = $this->api_model->getAllAnggota();
            }
            
            header('Content-Type: application/json');
            echo json_encode($data, JSON_PRETTY_PRINT);
        }

        public function listUser(){
            if(!empty($this->input->post('deleteAdmin'))){
                if(!empty($this->input->post('userID'))){
                    $this->api_model->deleteAdmin($this->input->post('userID'));
                    $result = (object) array("status" => "success", "title" => "Terhapus!", "message" => "User berhasil dihapus.");
                } else {
                    $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
                }
            } else if(!empty($this->input->post('deletePersonal'))){
                if(!empty($this->input->post('idAnggota'))){
                    $this->api_model->deletePersonal($this->input->post('idAnggota'));
                    $result = (object) array("status" => "success", "title" => "Terhapus!", "message" => "User personal berhasil dihapus.");
                } else {
                    $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
                }
            } else if(!empty($this->input->post('addAdmin'))){
                if(!empty($this->input->post('namaLengkap') && !empty($this->input->post('username')) && !empty($this->input->post('password')) && !empty($this->input->post('idRole')))){
                    $this->api_model->addAdmin($this->input->post('namaLengkap'), $this->input->post('username'), $this->input->post('password'), $this->input->post('idRole'));
                    $result = (object) array("status" => "success", "title" => "Tertambahkan!", "message" => "User admin berhasil ditambahkan.");
                } else {
                    $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Parameter yang dikirimkan tidak valid.");
                }
            } else if(!empty($this->input->post('addPersonal'))){
                if(!empty($this->input->post('idAnggota') && !empty($this->input->post('namaDepan')) && !empty($this->input->post('namaBelakang')) && !empty($this->input->post('jenisGradasi'))&& !empty($this->input->post('username')) && !empty($this->input->post('password')))){
                    $response = $this->api_model->addPersonal($this->input->post('idAnggota'), $this->input->post('namaDepan'), $this->input->post('namaBelakang'), $this->input->post('jenisGradasi'), $this->input->post('username'), $this->input->post('password'));
                    if($response != NULL) {
                        $result = (object) array("status" => "error", "title" => "Gagal!", "message" => $response);    
                    }else {
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

        public function listRole(){
            $result = $this->api_model->getAllRoles();
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function listGradasi(){
            $result = $this->api_model->getAllGradasi();
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function editAnggota(){
            $data = (object) $_POST;
            if(!empty($this->input->post('editDataDiri'))){
                $config['upload_path'] = FCPATH.'/uploads/profile/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_name'] = "Profile_" . $data->id;
                $config['overwrite'] = true;
                $this->load->library('upload', $config);
                $data->fotoProfile = NULL;
                if ($this->upload->do_upload('profilePicture')){
                    $data->fotoProfile = $this->upload->data('file_name');
                }
                $this->api_model->updateDataDiri($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Data anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('tambahPendidikan'))){
                $this->api_model->addPendidikanAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editPendidikan'))){
                $this->api_model->updatePendidikanAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusPendidikan'))){
                $this->api_model->deletePendidikanAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Pendidikan anggota berhasil dihapus.");
            
            } else if(!empty($this->input->post('tambahSakramen'))){
                $this->api_model->addSakramenAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editSakramen'))){
                $this->api_model->updateSakramenAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusSakramen'))){
                $this->api_model->deleteSakramenAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Sakramen anggota berhasil dihapus.");
            
            } else if(!empty($this->input->post('tambahBahasa'))){
                $this->api_model->addBahasaAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editBahasa'))){
                $this->api_model->updateBahasaAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusBahasa'))){
                $this->api_model->deleteBahasaAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Bahasa anggota berhasil dihapus.");
            
            } else if(!empty($this->input->post('tambahDokumen'))){
                $this->api_model->addDokumenAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editDokumen'))){
                $this->api_model->updateDokumenAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusDokumen'))){
                $this->api_model->deleteDokumenAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Dokumen anggota berhasil dihapus.");
            
            } else if(!empty($this->input->post('tambahRelasi'))){
                $this->api_model->addRelasiAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editRelasi'))){
                $this->api_model->updateRelasiAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusRelasi'))){
                $this->api_model->deleteRelasiAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Relasi anggota berhasil dihapus.");
            
            } else if(!empty($this->input->post('tambahPerutusan'))){
                $config['upload_path'] = FCPATH.'/uploads/sk-perutusan/';
                $config['allowed_types'] = 'pdf|jpg|jpeg|png';
                $config['file_name'] = "SK_Perutusan_" . $data->id ."_". time() . rand(100, 999);
                $config['overwrite'] = true;
                $this->load->library('upload', $config);
                $data->fotoProfile = NULL;
                if ($this->upload->do_upload('fileData')){
                    $data->fileSK = $this->upload->data('file_name');
                }

                $this->api_model->addPerutusanAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil ditambahkan.");
            
            } else if(!empty($this->input->post('editPerutusan'))){
                $this->api_model->updatePerutusanAnggota($data);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil diubah.");
            
            } else if(!empty($this->input->post('hapusPerutusan'))){
                $this->api_model->deletePerutusanAnggota($data->id);
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Perutusan anggota berhasil dihapus.");
            } else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataPendidikan(){
            if(!empty($this->input->get("idPendidikan"))){
                $result = $this->api_model->getDataPendidikanById($this->input->get("idPendidikan"));
            }else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllPendidikanAnggota($this->input->get("idAnggota"));
            }else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataSakramen(){
            if(!empty($this->input->get("idSakramen"))){
                $result = $this->api_model->getDataSakramenById($this->input->get("idSakramen"));
            }else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllSakramenAnggota($this->input->get("idAnggota"));
            }else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataBahasa(){
            if(!empty($this->input->get("idBahasa"))){
                $result = $this->api_model->getDataBahasaById($this->input->get("idBahasa"));
            }else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllBahasaAnggota($this->input->get("idAnggota"));
            }else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataDokumen(){
            if(!empty($this->input->get("idDokumen"))){
                $result = $this->api_model->getDataDokumenById($this->input->get("idDokumen"));
            } else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllDokumenAnggota($this->input->get("idAnggota"));
            } else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataRelasi(){
            if(!empty($this->input->get("idRelasi"))){
                $result = $this->api_model->getDataRelasiById($this->input->get("idRelasi"));
            } else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllRelasiAnggota($this->input->get("idAnggota"));
            } else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function dataPerutusan(){
            if(!empty($this->input->get("idPerutusan"))){
                $result = $this->api_model->getDataPerutusanById($this->input->get("idPerutusan"));
            } else if(!empty($this->input->get("idAnggota"))){
                $result = $this->api_model->getAllPerutusanAnggota($this->input->get("idAnggota"));
            } else {
                $result = (object) array("status" => "error", "title" => "Invalid!", "message" => "Parameter yang dikirimkan tidak valid.");
            }
            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }

        public function sendEmail(){
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'idosj@jesuits.id',
                'smtp_pass' => 'Argopuro_24',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE,
                'newline' => "\r\n"
            );
            
            $this->email->initialize($config);
            $this->email->from($config['smtp_user']);
            $this->email->to('adrianfinantyo@gmail.com');
            $this->email->subject('Dear User');
            $message = "Halo test test test";
            $this->email->message($message);

            if($this->email->send()){
                $result = (object) array("status" => "success", "title" => "Berhasil!", "message" => "Email berhasil dikirim.");
            }else{
                $result = (object) array("status" => "error", "title" => "Gagal!", "message" => "Email gagal dikirim.");
            }

            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    }
?>