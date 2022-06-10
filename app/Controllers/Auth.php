<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;
use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $AuthModel;
    public function __construct(){
        $this->AuthModel = new AuthModel();
    }
    
    public function index()
    {
        $data = [
            'tittle' => 'Login',
        ];
        return view('layout/auth/layout_login', $data);
    }

    public function login(){
        $validation =  \Config\Services::validation();
        
        $email  = $this->request->getVar('email');
        $sandi  = $this->request->getVar('sandi');

        if (!$this->validate([
            // 'email'     => 'required|valid_email',
            'email'     => 'required',
            'sandi'     => 'required'
        ])) {
            $errors = $validation->getErrors();

            $response = array(
                'status'    => 500, 
                'Pesan'     => 'Silahkan Periksan Email / Password anda !', 
                'data'      => $errors
            );
        }
        else{
            $cek = $this->AuthModel->where('email', $email)
            ->where('sandi', $sandi)
            ->where('is_active', 1)
            ->first();

            if ($cek == null) {
                $response = array(
                    'status'    => 500, 
                    'Pesan'     => 'Silahkan Periksan Email / Password anda !', 
                    'data'      => 'User tidak ditemukan'
                );
            }else{

                // ====== SET SESSION =========
                $newdata = [
                    'username'      => $cek['username'],
                    'email'         => $cek['email'],
                    'wa'            => $cek['wa'],
                    'kode_pasangan' => $cek['kode_pasangan'],
                    'nama_user'     => $cek['nama_user'],
                    'logged_in'     => true,
                ];
                
                $this->session->set($newdata);

                $response = array(
                    'status'    => 200, 
                    'Pesan'     => 'Berhasil Login', 
                    'data'      => '-'
                );
            }
            
        }

        return json_encode($response);
    }

    public function logout(){
        $logout = $this->session->destroy();
        // echo "logout";
        
        $data = [
            'tittle' => 'Login',
        ];
        return view('layout/auth/layout_login', $data);
    }
}
