<?php
    defined('BASEPATH') OR exit('No direct script access allowed !');

    class Auth_Model extends CI_Model {
        public function login($username, $password){
            $this->db->where('username', $username);
            $result = $this->db->get('user')->row();
            if(!empty($result) && password_verify($password, $result->password)){
                return $result->password;
            }
            else return NULL;
        }

        public function getUserData($username){

            return $result;
        }

        public function verifyCookies(){
            $cookies = $this->input->cookie(array('login', 'userId', 'key'));
            if(!empty($cookies['login']) && !empty($cookies['userId']) && !empty($cookies['key'])) {
                $query = "SELECT u.*, namaRole FROM user u, role r WHERE idRole = r.id AND username = ?";
                $result = $this->db->query($query, array($cookies['userId']))->row();
                $this->session->namaLengkap = $result->namaLengkap;
                $this->session->role = $result->namaRole;
                if(!empty($result)){
                    if($result->password == urldecode($cookies['key'])){
                        return true;
                    }
                }
            }
            // Clear semua cookies karena tidak valid
            delete_cookie('login');
            delete_cookie('userId');
            delete_cookie('key');
            $this->session->sess_destroy();
            return false;
        }
    }

?>